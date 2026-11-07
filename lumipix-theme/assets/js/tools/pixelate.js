/**
 * Pixelate an image / make pixel art: average blocks of pixels, optionally
 * limit the colours, then scale back up with hard edges (or keep one pixel
 * per block). Everything runs in the browser.
 */
(function () {
	'use strict';
	var L = window.Lumipix;
	if (!L) return;

	var MAX_SIDE = 8000;

	/** Reduce each channel to `levels` steps (levels <= 1 means no change). */
	function posterize(canvas, levels) {
		if (!levels || levels < 2) return;
		var ctx = canvas.getContext('2d');
		var data = ctx.getImageData(0, 0, canvas.width, canvas.height);
		var d = data.data;
		var step = 255 / (levels - 1);
		for (var i = 0; i < d.length; i += 4) {
			d[i] = Math.round(Math.round(d[i] / step) * step);
			d[i + 1] = Math.round(Math.round(d[i + 1] / step) * step);
			d[i + 2] = Math.round(Math.round(d[i + 2] / step) * step);
		}
		ctx.putImageData(data, 0, 0);
	}

	/** Source image to a canvas, capped at MAX_SIDE. */
	function toCanvas(img) {
		var k = Math.min(1, MAX_SIDE / img.width, MAX_SIDE / img.height);
		var w = Math.max(1, Math.round(img.width * k));
		var h = Math.max(1, Math.round(img.height * k));
		var c = L.makeCanvas(w, h);
		c.getContext('2d').drawImage(img.source, 0, 0, w, h);
		if (img.source.close) img.source.close();
		if (img.url) URL.revokeObjectURL(img.url);
		return c;
	}

	function pixelate(src, block, levels, small) {
		var w = src.width;
		var h = src.height;
		var bw = Math.max(1, Math.round(w / block));
		var bh = Math.max(1, Math.round(h / block));
		// Averaging downscale gives each block its mean colour.
		var tiny = L.resample(src, w, h, bw, bh);
		posterize(tiny, levels);
		if (small) return tiny;
		var out = L.makeCanvas(w, h);
		var ctx = out.getContext('2d');
		ctx.imageSmoothingEnabled = false;
		ctx.drawImage(tiny, 0, 0, bw, bh, 0, 0, w, h);
		return out;
	}

	L.register('pixelate', function (el, config) {
		var blockOut = el.querySelector('[data-out="block"]');
		var fmtSel = el.querySelector('[data-opt="to"]');
		var bgField = el.querySelector('[data-bg-field]');

		function refresh() {
			var opts = L.readOptions(el);
			if (blockOut) blockOut.textContent = (opts.block || 12) + ' px';
			if (bgField) bgField.hidden = fmtSel.value !== 'image/jpeg';
		}

		var app = L.createApp(el, {
			multiple: true,
			zipName: 'lumipix-pixelated',
			process: function (item) {
				var opts = L.readOptions(el);
				var block = Math.max(2, Math.min(200, opts.block || config.block || 12));
				var levels = parseInt(opts.levels, 10) || 0;
				var small = opts.output === 'small';
				var to = opts.to || 'image/png';
				var file = item.file;
				return L.loadImage(file)
					.then(toCanvas)
					.then(function (src) {
						var canvas = pixelate(src, block, levels, small);
						var out = to === 'image/jpeg' ? L.flatten(canvas, opts.background || '#ffffff') : canvas;
						var q = to === 'image/png' ? undefined : 0.92;
						return L.canvasToBlob(out, to, q).then(function (blob) {
							return {
								blob: blob,
								name: L.renameFile(file.name, to, small ? 'pixel-art' : 'pixelated'),
								meta:
									L.escapeHtml(L.formatBytes(file.size)) +
									' → <strong>' +
									L.escapeHtml(L.formatBytes(blob.size)) +
									'</strong> · ' +
									canvas.width +
									'×' +
									canvas.height +
									' · ' +
									L.extFor(to).toUpperCase(),
								badge: ''
							};
						});
					});
			}
		});

		el.querySelectorAll('[data-opt]').forEach(function (node) {
			['input', 'change'].forEach(function (ev) {
				node.addEventListener(ev, function () {
					refresh();
					app.rerun();
				});
			});
		});
		refresh();
	});
})();
