/**
 * Colour-key background remover (white or any solid colour).
 * Pixels close to the key colour fade to transparent; partially transparent
 * edge pixels are "un-mixed" from the key colour to avoid a light halo.
 */
(function () {
	'use strict';
	var L = window.Lumipix;
	if (!L) return;

	var PREVIEW_MAX = 1400;

	function hexToRgb(hex) {
		var m = /^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i.exec(hex || '');
		return m ? [parseInt(m[1], 16), parseInt(m[2], 16), parseInt(m[3], 16)] : [255, 255, 255];
	}

	function rgbToHex(r, g, b) {
		return '#' + [r, g, b].map(function (v) {
			return ('0' + v.toString(16)).slice(-2);
		}).join('');
	}

	/** Apply the key to a canvas (in place) and return it. */
	function applyKey(canvas, key, tolerance, feather) {
		var ctx = canvas.getContext('2d', { willReadFrequently: true });
		var data = ctx.getImageData(0, 0, canvas.width, canvas.height);
		var px = data.data;
		var kr = key[0];
		var kg = key[1];
		var kb = key[2];
		var t = tolerance * 4.42; // 0–100 → 0–442 (max RGB distance)
		var f = Math.max(0.0001, feather * 4.42);
		for (var i = 0; i < px.length; i += 4) {
			var r = px[i];
			var g = px[i + 1];
			var b = px[i + 2];
			var dr = r - kr;
			var dg = g - kg;
			var db = b - kb;
			var d = Math.sqrt(dr * dr + dg * dg + db * db);
			if (d <= t) {
				px[i + 3] = 0;
			} else if (d < t + f) {
				var a = (d - t) / f;
				// Un-mix the key colour from semi-transparent pixels.
				px[i] = Math.max(0, Math.min(255, Math.round((r - kr * (1 - a)) / a)));
				px[i + 1] = Math.max(0, Math.min(255, Math.round((g - kg * (1 - a)) / a)));
				px[i + 2] = Math.max(0, Math.min(255, Math.round((b - kb * (1 - a)) / a)));
				px[i + 3] = Math.round(px[i + 3] * a);
			}
		}
		ctx.putImageData(data, 0, 0);
		return canvas;
	}

	L.register('colorkey', function (el) {
		var list = el.querySelector('[data-list]');
		var colorInput = el.querySelector('[data-opt="color"]');
		var pickBtn = el.querySelector('[data-pick]');
		var state = null; // { file, img, previewSrc (canvas) }
		var picking = false;

		function opts() {
			var o = L.readOptions(el);
			return { key: hexToRgb(o.color), tolerance: o.tolerance || 0, feather: o.feather || 0 };
		}

		function drawOriginal(maxSide) {
			var w = state.img.width;
			var h = state.img.height;
			var k = Math.min(1, maxSide / Math.max(w, h));
			var c = L.makeCanvas(w * k, h * k);
			c.getContext('2d').drawImage(state.img.source, 0, 0, c.width, c.height);
			return c;
		}

		function renderPreview() {
			if (!state) return;
			var o = opts();
			var c = L.makeCanvas(state.previewSrc.width, state.previewSrc.height);
			c.getContext('2d').drawImage(state.previewSrc, 0, 0);
			applyKey(c, o.key, o.tolerance, o.feather);
			var pane = list.querySelector('[data-after]');
			pane.querySelectorAll('canvas').forEach(function (n) {
				n.remove();
			});
			pane.insertBefore(c, pane.firstChild);
		}

		var renderSoon = L.debounce(renderPreview, 60);

		function exportResult(type) {
			if (!state) return;
			var o = opts();
			var full = drawOriginal(Infinity);
			applyKey(full, o.key, o.tolerance, o.feather);
			L.canvasToBlob(full, type).then(function (blob) {
				L.download(blob, L.renameFile(state.file.name, type, 'transparent'));
			});
		}

		function setPicking(v) {
			picking = v;
			if (pickBtn) pickBtn.setAttribute('aria-pressed', String(v));
			var before = list.querySelector('[data-before]');
			if (before) before.classList.toggle('is-picking', v);
		}

		function open(file) {
			L.loadImage(file).then(function (img) {
				state = { file: file, img: img, previewSrc: null };
				state.previewSrc = drawOriginal(PREVIEW_MAX);

				list.innerHTML =
					'<li class="preview-item"><div class="preview">' +
					'<div class="preview__pane is-picking" data-before><span class="preview__label">Before</span></div>' +
					'<div class="preview__pane checker" data-after><span class="preview__label">After</span></div>' +
					'</div><div class="preview__actions" data-actions></div></li>';

				var before = list.querySelector('[data-before]');
				var shown = L.makeCanvas(state.previewSrc.width, state.previewSrc.height);
				shown.getContext('2d').drawImage(state.previewSrc, 0, 0);
				before.insertBefore(shown, before.firstChild);
				setPicking(picking);

				// Click the original to pick the colour to remove.
				shown.addEventListener('click', function (e) {
					var rect = shown.getBoundingClientRect();
					var x = Math.floor(((e.clientX - rect.left) / rect.width) * shown.width);
					var y = Math.floor(((e.clientY - rect.top) / rect.height) * shown.height);
					var p = shown.getContext('2d').getImageData(x, y, 1, 1).data;
					colorInput.value = rgbToHex(p[0], p[1], p[2]);
					setPicking(false);
					renderPreview();
				});

				var actions = list.querySelector('[data-actions]');
				[['image/png', 'PNG', 'btn--primary'], ['image/webp', 'WebP', 'btn--ghost']].forEach(function (d) {
					if (d[0] === 'image/webp' && !L.supportsType('image/webp')) return;
					var b = document.createElement('button');
					b.type = 'button';
					b.className = 'btn ' + d[2];
					b.innerHTML = L.icon('download') + d[1];
					b.addEventListener('click', function () {
						exportResult(d[0]);
					});
					actions.insertBefore(b, actions.firstChild);
				});

				renderPreview();
				el.querySelector('[data-summary]').textContent = file.name + ' · ' + img.width + '×' + img.height;
			}).catch(function (err) {
				list.innerHTML = '<li class="result is-error"><p class="result__meta">' + L.escapeHtml(err.message || L.t('error')) + '</p></li>';
			});
		}

		L.createApp(el, {
			multiple: false,
			onFiles: function (items) {
				open(items[0].file);
			},
			onClear: function () {
				if (state && state.img.source.close) state.img.source.close();
				state = null;
				list.innerHTML = '';
			}
		});

		el.querySelectorAll('[data-opt]').forEach(function (node) {
			node.addEventListener('input', function () {
				var out = el.querySelector('[data-out="' + node.getAttribute('data-opt') + '"]');
				if (out) out.textContent = node.value;
				renderSoon();
			});
		});
		if (pickBtn) {
			pickBtn.addEventListener('click', function () {
				setPicking(!picking);
			});
		}
	});
})();
