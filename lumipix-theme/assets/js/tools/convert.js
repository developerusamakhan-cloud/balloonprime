/**
 * Image converter: any image the browser can open → JPG, PNG or WebP.
 * SVG files are rasterised at 1×, 2×, 4× or a custom width.
 */
(function () {
	'use strict';
	var L = window.Lumipix;
	if (!L) return;

	var MAX_SIDE = 16384;

	function isSvg(file) {
		return file.type === 'image/svg+xml' || /\.svg$/i.test(file.name);
	}

	/** Natural size of an SVG from width/height or the viewBox. */
	function svgSize(doc) {
		var root = doc.documentElement;
		var num = function (v) {
			var m = /^\s*([\d.]+)\s*(px)?\s*$/.exec(v || '');
			return m ? parseFloat(m[1]) : 0;
		};
		var w = num(root.getAttribute('width'));
		var h = num(root.getAttribute('height'));
		var vb = (root.getAttribute('viewBox') || '').split(/[\s,]+/).map(parseFloat);
		if ((!w || !h) && vb.length === 4 && vb[2] > 0 && vb[3] > 0) {
			if (w && !h) h = (w * vb[3]) / vb[2];
			else if (h && !w) w = (h * vb[2]) / vb[3];
			else {
				w = vb[2];
				h = vb[3];
			}
		}
		return { w: w || 300, h: h || 150 };
	}

	/** Rasterise an SVG file to a canvas at the requested width. */
	function loadSvg(file, scale, customWidth) {
		return file.text().then(function (text) {
			var doc = new DOMParser().parseFromString(text, 'image/svg+xml');
			if (doc.getElementsByTagName('parsererror').length || doc.documentElement.nodeName.toLowerCase() !== 'svg') {
				throw new Error(L.t('unsupported'));
			}
			var size = svgSize(doc);
			var tw = customWidth > 0 ? customWidth : size.w * (scale || 1);
			var k = Math.min(tw / size.w, MAX_SIDE / size.w, MAX_SIDE / size.h);
			var w = Math.max(1, Math.round(size.w * k));
			var h = Math.max(1, Math.round(size.h * k));
			var root = doc.documentElement;
			if (!root.getAttribute('viewBox')) root.setAttribute('viewBox', '0 0 ' + size.w + ' ' + size.h);
			root.setAttribute('width', w);
			root.setAttribute('height', h);
			var blob = new Blob([new XMLSerializer().serializeToString(doc)], { type: 'image/svg+xml' });
			var url = URL.createObjectURL(blob);
			return new Promise(function (resolve, reject) {
				var img = new Image();
				img.onload = function () {
					var c = L.makeCanvas(w, h);
					c.getContext('2d').drawImage(img, 0, 0, w, h);
					URL.revokeObjectURL(url);
					resolve(c);
				};
				img.onerror = function () {
					URL.revokeObjectURL(url);
					reject(new Error(L.t('unsupported')));
				};
				img.src = url;
			});
		});
	}

	var ICO_SIZES = [16, 32, 48, 64, 128, 256];

	/** Centre the image on a transparent square, scaled to `size`. */
	function squareAt(canvas, size) {
		var k = Math.min(size / canvas.width, size / canvas.height);
		var w = Math.max(1, Math.round(canvas.width * k));
		var h = Math.max(1, Math.round(canvas.height * k));
		var scaled = L.resample(canvas, canvas.width, canvas.height, w, h);
		var out = L.makeCanvas(size, size);
		out.getContext('2d').drawImage(scaled, Math.round((size - w) / 2), Math.round((size - h) / 2));
		return out;
	}

	/** Build a .ico file holding PNG images at the standard icon sizes. */
	function makeIco(canvas) {
		return Promise.all(
			ICO_SIZES.map(function (s) {
				return L.canvasToBlob(squareAt(canvas, s), 'image/png').then(function (b) {
					return b.arrayBuffer().then(function (buf) {
						return { size: s, bytes: new Uint8Array(buf) };
					});
				});
			})
		).then(function (pngs) {
			var header = new DataView(new ArrayBuffer(6 + 16 * pngs.length));
			header.setUint16(0, 0, true);
			header.setUint16(2, 1, true);
			header.setUint16(4, pngs.length, true);
			var offset = 6 + 16 * pngs.length;
			pngs.forEach(function (p, i) {
				var o = 6 + 16 * i;
				header.setUint8(o, p.size >= 256 ? 0 : p.size);
				header.setUint8(o + 1, p.size >= 256 ? 0 : p.size);
				header.setUint8(o + 2, 0);
				header.setUint8(o + 3, 0);
				header.setUint16(o + 4, 1, true);
				header.setUint16(o + 6, 32, true);
				header.setUint32(o + 8, p.bytes.length, true);
				header.setUint32(o + 12, offset, true);
				offset += p.bytes.length;
			});
			return new Blob([header.buffer].concat(pngs.map(function (p) { return p.bytes; })), { type: 'image/x-icon' });
		});
	}

	function toCanvas(img) {
		var c = L.makeCanvas(img.width, img.height);
		c.getContext('2d').drawImage(img.source, 0, 0);
		if (img.source.close) img.source.close();
		if (img.url) URL.revokeObjectURL(img.url);
		return c;
	}

	L.register('convert', function (el, config) {
		var fmtSel = el.querySelector('[data-opt="to"]');
		var qualityField = el.querySelector('[data-quality-field]');
		var bgField = el.querySelector('[data-bg-field]');
		var svgField = el.querySelector('[data-svg-field]');
		var customW = el.querySelector('[data-opt="svgWidth"]');
		var scaleBtns = el.querySelectorAll('[data-scale]');
		var qualityOut = el.querySelector('[data-out="quality"]');
		var scale = parseFloat(config.scale) || 1;

		if (!L.supportsType('image/webp')) {
			var webpOpt = fmtSel.querySelector('option[value="image/webp"]');
			if (webpOpt) webpOpt.disabled = true;
			if (fmtSel.value === 'image/webp') fmtSel.value = 'image/png';
		}

		function refresh() {
			var to = fmtSel.value;
			qualityField.hidden = to === 'image/png' || to === 'image/x-icon';
			bgField.hidden = to !== 'image/jpeg';
			if (svgField) svgField.hidden = !config.svg;
			scaleBtns.forEach(function (b) {
				b.classList.toggle('is-active', !parseFloat(customW && customW.value) && parseFloat(b.getAttribute('data-scale')) === scale);
			});
			if (qualityOut) qualityOut.textContent = el.querySelector('[data-opt="quality"]').value;
		}

		var app = L.createApp(el, {
			multiple: true,
			zipName: 'lumipix-converted',
			process: function (item) {
				var opts = L.readOptions(el);
				var to = opts.to || 'image/jpeg';
				var file = item.file;
				var job = isSvg(file)
					? loadSvg(file, scale, opts.svgWidth || 0)
					: L.loadImage(file).then(toCanvas);
				return job.then(function (canvas) {
					if (to === 'image/x-icon') {
						return makeIco(canvas).then(function (blob) {
							return {
								blob: blob,
								name: L.renameFile(file.name, to),
								meta:
									L.escapeHtml(L.formatBytes(file.size)) +
									' → <strong>' +
									L.escapeHtml(L.formatBytes(blob.size)) +
									'</strong> · ICO · ' +
									ICO_SIZES.join(', ') +
									' px',
								badge: ''
							};
						});
					}
					var out = to === 'image/jpeg' ? L.flatten(canvas, opts.background || '#ffffff') : canvas;
					var q = to === 'image/png' ? undefined : Math.max(0.01, Math.min(1, (opts.quality || 92) / 100));
					return L.canvasToBlob(out, to, q).then(function (blob) {
						return {
							blob: blob,
							name: L.renameFile(file.name, to),
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
			node.addEventListener('input', function () {
				refresh();
				app.rerun();
			});
			node.addEventListener('change', function () {
				refresh();
				app.rerun();
			});
		});
		scaleBtns.forEach(function (b) {
			b.addEventListener('click', function () {
				scale = parseFloat(b.getAttribute('data-scale')) || 1;
				if (customW) customW.value = '';
				refresh();
				app.rerun();
			});
		});
		refresh();
	});
})();
