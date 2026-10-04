/**
 * Image resizer: pixels, percent, cm, mm and inches (with DPI), presets,
 * aspect lock, and fit / fill / stretch modes.
 */
(function () {
	'use strict';
	var L = window.Lumipix;
	if (!L) return;

	var MAX_SIDE = 16384;
	var PHYSICAL = { cm: 2.54, mm: 25.4, in: 1 };

	function toPx(value, unit, dpi) {
		if (unit in PHYSICAL) return (value / PHYSICAL[unit]) * dpi;
		return value;
	}

	function fromPx(px, unit, dpi) {
		if (unit in PHYSICAL) return (px / dpi) * PHYSICAL[unit];
		return px;
	}

	function round(v, unit) {
		if (unit === 'px') return Math.round(v);
		return Math.round(v * 100) / 100;
	}

	/** Output pixel size for one image. */
	function targetSize(opts, locked, w, h) {
		var dpi = opts.dpi || 300;
		var tw;
		var th;
		if (opts.unit === '%') {
			var pct = (opts.width || 100) / 100;
			return { w: Math.round(w * pct), h: Math.round(h * pct), exact: false };
		}
		if (locked) {
			tw = toPx(opts.width || w, opts.unit, dpi);
			th = (tw * h) / w;
			return { w: Math.round(tw), h: Math.round(th), exact: false };
		}
		tw = toPx(opts.width || w, opts.unit, dpi);
		th = toPx(opts.height || h, opts.unit, dpi);
		return { w: Math.round(tw), h: Math.round(th), exact: true };
	}

	function render(img, size, opts) {
		var w = img.width;
		var h = img.height;
		var tw = Math.min(MAX_SIDE, Math.max(1, size.w));
		var th = Math.min(MAX_SIDE, Math.max(1, size.h));

		if (!size.exact || opts.fit === 'stretch') {
			return L.resample(img.source, w, h, tw, th);
		}

		if (opts.fit === 'cover') {
			var s = Math.max(tw / w, th / h);
			var cw = Math.round(tw / s);
			var ch = Math.round(th / s);
			var crop = L.makeCanvas(cw, ch);
			crop.getContext('2d').drawImage(img.source, Math.round((w - cw) / 2), Math.round((h - ch) / 2), cw, ch, 0, 0, cw, ch);
			return L.resample(crop, cw, ch, tw, th);
		}

		// contain: fit inside and fill the rest with the background colour.
		var k = Math.min(tw / w, th / h);
		var iw = Math.max(1, Math.round(w * k));
		var ih = Math.max(1, Math.round(h * k));
		var inner = L.resample(img.source, w, h, iw, ih);
		var out = L.makeCanvas(tw, th);
		var ctx = out.getContext('2d');
		ctx.fillStyle = opts.background || '#ffffff';
		ctx.fillRect(0, 0, tw, th);
		ctx.drawImage(inner, Math.round((tw - iw) / 2), Math.round((th - ih) / 2));
		return out;
	}

	function outputType(opts, file) {
		var type = opts.format;
		if (!type || type === 'auto') {
			type = /^image\/(jpeg|png|webp)$/.test(file.type) ? file.type : 'image/png';
		}
		if (type === 'image/webp' && !L.supportsType('image/webp')) type = 'image/png';
		return type;
	}

	L.register('resize', function (el, config) {
		var lockBtn = el.querySelector('[data-lock]');
		var wInput = el.querySelector('[data-opt="width"]');
		var hInput = el.querySelector('[data-opt="height"]');
		var unitSel = el.querySelector('[data-opt="unit"]');
		var dpiInput = el.querySelector('[data-opt="dpi"]');
		var fitSel = el.querySelector('[data-opt="fit"]');
		var dpiField = el.querySelector('[data-dpi-field]');
		var fitField = el.querySelector('[data-fit-field]');
		var bgField = el.querySelector('[data-bg-field]');
		var hint = el.querySelector('[data-dims-hint]');
		var presetBtns = el.querySelectorAll('[data-preset]');
		var presets = config.preset || {};
		var lockDefault = el.querySelector('[data-opt="lockDefault"]');
		var locked = lockDefault ? lockDefault.value === '1' : true;
		var firstAspect = null; // width / height of the first image
		var lastUnit = unitSel.value;

		function setLocked(v) {
			locked = v;
			lockBtn.setAttribute('aria-pressed', String(v));
			if (v) syncHeight();
			refresh();
		}

		function syncHeight() {
			if (!locked || unitSel.value === '%') return;
			var w = parseFloat(wInput.value);
			if (!w) return;
			var aspect = firstAspect || (parseFloat(wInput.value) / parseFloat(hInput.value)) || 1;
			hInput.value = round(w / aspect, unitSel.value);
		}

		function refresh() {
			var unit = unitSel.value;
			var physical = unit in PHYSICAL;
			dpiField.hidden = !physical;
			hInput.disabled = unit === '%';
			lockBtn.disabled = unit === '%';
			fitField.hidden = locked || unit === '%';
			var fmtSel = el.querySelector('[data-opt="format"]');
			var toJpeg = fmtSel && fmtSel.value === 'image/jpeg';
			// Show the colour for padding (fit mode) or for filling transparency when saving as JPG.
			bgField.hidden = !toJpeg && (locked || unit === '%' || fitSel.value !== 'contain');
			presetBtns.forEach(function (b) {
				var p = presets[b.getAttribute('data-preset')];
				b.classList.toggle('is-active', !!p && !locked && p.unit === unit && +p.w === +wInput.value && +p.h === +hInput.value);
			});
			// Hint with the resulting pixel size for the first image (or the typed size).
			var opts = L.readOptions(el);
			var base = firstAspect ? { w: 1000 * firstAspect, h: 1000 } : { w: opts.width || 1, h: opts.height || 1 };
			if (firstSize) base = firstSize;
			var size = targetSize(opts, locked, base.w, base.h);
			var text = size.w + ' × ' + size.h + ' px';
			if (physical) text += ' · ' + (opts.dpi || 300) + ' DPI';
			hint.textContent = text;
		}

		var firstSize = null;

		var app = L.createApp(el, {
			multiple: true,
			process: function (item) {
				var opts = L.readOptions(el);
				return L.loadImage(item.file).then(function (img) {
					if (!firstSize) {
						firstSize = { w: img.width, h: img.height };
						firstAspect = img.width / img.height;
						if (locked) {
							syncHeight();
						}
						refresh();
						opts = L.readOptions(el);
					}
					var size = targetSize(opts, locked, img.width, img.height);
					var canvas = render(img, size, opts);
					var type = outputType(opts, item.file);
					if (type === 'image/jpeg') canvas = L.flatten(canvas, opts.background || '#ffffff');
					var q = type === 'image/png' ? undefined : 0.92;
					if (img.source.close) img.source.close();
					if (img.url) URL.revokeObjectURL(img.url);
					return L.canvasToBlob(canvas, type, q).then(function (blob) {
						if (type === 'image/jpeg' && opts.unit in PHYSICAL) {
							return L.setJpegDpi(blob, opts.dpi || 300).then(function (b) {
								return { blob: b, type: type, w: canvas.width, h: canvas.height };
							});
						}
						return { blob: blob, type: type, w: canvas.width, h: canvas.height };
					});
				}).then(function (res) {
					return {
						blob: res.blob,
						name: L.renameFile(item.file.name, res.type, res.w + 'x' + res.h),
						meta:
							'<span>' + L.formatBytes(item.file.size) + '</span><span class="arrow">→</span><strong>' + res.w + '×' + res.h + '</strong><span>' + L.formatBytes(res.blob.size) + '</span>'
					};
				});
			},
			onClear: function () {
				firstSize = null;
				firstAspect = null;
				refresh();
			}
		});

		lockBtn.addEventListener('click', function () {
			setLocked(!locked);
			app.rerun();
		});

		wInput.addEventListener('input', function () {
			syncHeight();
			refresh();
			app.rerun();
		});
		hInput.addEventListener('input', function () {
			if (locked && unitSel.value !== '%') {
				var h = parseFloat(hInput.value);
				var aspect = firstAspect || 1;
				if (h) wInput.value = round(h * aspect, unitSel.value);
			}
			refresh();
			app.rerun();
		});

		unitSel.addEventListener('change', function () {
			// Convert the current numbers to the new unit so the size stays the same.
			var unit = unitSel.value;
			var dpi = parseFloat(dpiInput.value) || 300;
			if (unit === '%') {
				wInput.value = 100;
			} else if (lastUnit !== '%') {
				var pxW = toPx(parseFloat(wInput.value) || 0, lastUnit, dpi);
				var pxH = toPx(parseFloat(hInput.value) || 0, lastUnit, dpi);
				wInput.value = round(fromPx(pxW, unit, dpi), unit);
				hInput.value = round(fromPx(pxH, unit, dpi), unit);
			} else if (firstSize) {
				wInput.value = round(fromPx(firstSize.w, unit, dpi), unit);
				hInput.value = round(fromPx(firstSize.h, unit, dpi), unit);
			}
			lastUnit = unit;
			refresh();
			app.rerun();
		});

		[dpiInput, fitSel, el.querySelector('[data-opt="background"]'), el.querySelector('[data-opt="format"]')].forEach(function (node) {
			if (!node) return;
			node.addEventListener('input', function () {
				refresh();
				app.rerun();
			});
		});

		presetBtns.forEach(function (btn) {
			btn.addEventListener('click', function () {
				var p = presets[btn.getAttribute('data-preset')];
				if (!p) return;
				unitSel.value = p.unit;
				lastUnit = p.unit;
				wInput.value = p.w;
				hInput.value = p.h;
				if (p.dpi) dpiInput.value = p.dpi;
				if (fitSel.value === 'stretch') fitSel.value = 'cover';
				locked = false;
				lockBtn.setAttribute('aria-pressed', 'false');
				refresh();
				app.rerun();
			});
		});

		lockBtn.setAttribute('aria-pressed', String(locked));
		refresh();
	});
})();
