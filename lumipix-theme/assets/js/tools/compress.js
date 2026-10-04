/**
 * Compress to a target file size.
 *
 * Strategy: try high quality first; otherwise binary-search the encoder quality
 * for the largest file under the target. If even a modest quality is too big,
 * scale the image down a little and search again. Targets are treated as
 * 1 KB = 1000 bytes so results also pass portals that count 1 KB = 1024 bytes.
 */
(function () {
	'use strict';
	var L = window.Lumipix;
	if (!L) return;

	var MIN_GOOD_QUALITY = 0.5;

	function targetBytes(opts) {
		var value = Math.max(0.001, opts.target || 100);
		return Math.floor(value * (opts.unit === 'MB' ? 1000 * 1000 : 1000));
	}

	function encode(canvas, type, q) {
		return L.canvasToBlob(canvas, type, q);
	}

	/** Largest blob <= limit, searching quality in [lo, hi]. */
	function searchQuality(canvas, type, limit, lo, hi) {
		var best = null;
		var bestQ = 0;
		var steps = 7;
		function step(i) {
			if (i >= steps) return Promise.resolve({ blob: best, q: bestQ });
			var mid = (lo + hi) / 2;
			return encode(canvas, type, mid).then(function (blob) {
				if (blob.size <= limit) {
					best = blob;
					bestQ = mid;
					lo = mid;
				} else {
					hi = mid;
				}
				return step(i + 1);
			});
		}
		return step(0);
	}

	function compress(item, opts) {
		var type = opts.format === 'image/webp' && L.supportsType('image/webp') ? 'image/webp' : 'image/jpeg';
		var limit = targetBytes(opts);
		var file = item.file;

		return L.loadImage(file).then(function (img) {
			var w = img.width;
			var h = img.height;

			// Already small enough and in the requested format: keep the original untouched.
			if (file.size <= limit && file.type === type && (!opts.maxWidth || w <= opts.maxWidth)) {
				return { blob: file, width: w, height: h, fits: true, untouched: true };
			}

			var scale = 1;
			if (opts.maxWidth && w > opts.maxWidth) scale = opts.maxWidth / w;

			var attempt = 0;

			function tryScale() {
				attempt++;
				var tw = Math.max(1, Math.round(w * scale));
				var th = Math.max(1, Math.round(h * scale));
				var canvas = L.resample(img.source, w, h, tw, th);
				if (type === 'image/jpeg') canvas = L.flatten(canvas, '#ffffff');

				return encode(canvas, type, 0.92).then(function (high) {
					if (high.size <= limit) {
						return { blob: high, width: tw, height: th, fits: true };
					}
					return searchQuality(canvas, type, limit, 0.04, 0.92).then(function (res) {
						if (res.blob && (res.q >= MIN_GOOD_QUALITY || attempt >= 8 || tw <= 64)) {
							return { blob: res.blob, width: tw, height: th, fits: true };
						}
						// Estimate how much to shrink from the size at the minimum good quality.
						return encode(canvas, type, MIN_GOOD_QUALITY).then(function (mid) {
							if (attempt >= 8 || tw <= 64 || th <= 64) {
								if (res.blob) return { blob: res.blob, width: tw, height: th, fits: true };
								return encode(canvas, type, 0.04).then(function (low) {
									return { blob: low, width: tw, height: th, fits: low.size <= limit };
								});
							}
							var factor = Math.sqrt(limit / mid.size) * 0.95;
							scale *= Math.min(0.9, Math.max(0.35, factor));
							return tryScale();
						});
					});
				});
			}

			return tryScale().then(function (res) {
				if (img.source.close) img.source.close();
				if (img.url) URL.revokeObjectURL(img.url);
				return res;
			});
		}).then(function (res) {
			var outType = res.untouched ? file.type : type;
			var meta =
				'<span>' + L.formatBytes(file.size) + '</span><span class="arrow">→</span><strong>' + L.formatBytes(res.blob.size) + '</strong>' +
				'<span>' + res.width + '×' + res.height + '</span>';
			var badge = res.fits
				? '<span class="badge badge--ok">' + L.icon('check') + L.escapeHtml(L.t('underTarget')) + '</span>'
				: '<span class="badge badge--warn">' + L.escapeHtml(L.t('overTarget')) + '</span>';
			return {
				blob: res.blob,
				name: L.renameFile(file.name, outType, 'compressed'),
				meta: meta,
				badge: badge
			};
		});
	}

	L.register('compress', function (el, config) {
		var quick = el.querySelectorAll('[data-quick]');
		var targetInput = el.querySelector('[data-opt="target"]');
		var unitSelect = el.querySelector('[data-opt="unit"]');

		var app = L.createApp(el, {
			multiple: true,
			process: function (item) {
				return compress(item, L.readOptions(el));
			}
		});

		function syncQuick() {
			var v = parseFloat(targetInput.value);
			quick.forEach(function (b) {
				b.classList.toggle('is-active', unitSelect.value === 'KB' && parseFloat(b.getAttribute('data-quick')) === v);
			});
		}

		quick.forEach(function (btn) {
			btn.addEventListener('click', function () {
				targetInput.value = btn.getAttribute('data-quick');
				unitSelect.value = 'KB';
				syncQuick();
				app.rerun();
			});
		});
		el.querySelectorAll('[data-opt]').forEach(function (node) {
			node.addEventListener('input', function () {
				syncQuick();
				app.rerun();
			});
		});
		syncQuick();
	});
})();
