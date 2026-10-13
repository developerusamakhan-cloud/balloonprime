/**
 * Favicon generator: from a logo or from text. Builds favicon.ico (16/32/48),
 * PNG icons, apple-touch-icon, Android icons and site.webmanifest, zipped.
 */
(function () {
	'use strict';
	var L = window.Lumipix;
	if (!L) return;

	var SIZES = [
		{ name: 'favicon-16x16.png', size: 16 },
		{ name: 'favicon-32x32.png', size: 32 },
		{ name: 'apple-touch-icon.png', size: 180, solid: true },
		{ name: 'android-chrome-192x192.png', size: 192 },
		{ name: 'android-chrome-512x512.png', size: 512 }
	];
	var FONTS = {
		sans: '600 {s}px Geist, system-ui, -apple-system, "Segoe UI", sans-serif',
		bold: '800 {s}px Geist, system-ui, -apple-system, "Segoe UI", sans-serif',
		serif: '400 {s}px "Instrument Serif", Georgia, "Times New Roman", serif'
	};
	var SNIPPET =
		'<link rel="icon" href="/favicon.ico" sizes="48x48">\n' +
		'<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">\n' +
		'<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">\n' +
		'<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">\n' +
		'<link rel="manifest" href="/site.webmanifest">';

	function shapePath(ctx, size, shape) {
		ctx.beginPath();
		if (shape === 'circle') {
			ctx.arc(size / 2, size / 2, size / 2, 0, Math.PI * 2);
		} else if (shape === 'rounded') {
			var r = size * 0.22;
			ctx.moveTo(r, 0);
			ctx.arcTo(size, 0, size, size, r);
			ctx.arcTo(size, size, 0, size, r);
			ctx.arcTo(0, size, 0, 0, r);
			ctx.arcTo(0, 0, size, 0, r);
			ctx.closePath();
		} else {
			ctx.rect(0, 0, size, size);
		}
	}

	/** Draw one icon at `size` px. */
	function draw(size, state, solid) {
		var c = L.makeCanvas(size, size);
		var ctx = c.getContext('2d');
		ctx.imageSmoothingEnabled = true;
		ctx.imageSmoothingQuality = 'high';
		var transparent = state.mode === 'image' && state.transparent && !solid;
		ctx.save();
		shapePath(ctx, size, solid && state.mode === 'image' && state.transparent ? 'square' : state.shape);
		ctx.clip();
		if (!transparent) {
			ctx.fillStyle = state.mode === 'image' && state.transparent ? '#ffffff' : state.background;
			ctx.fillRect(0, 0, size, size);
		}
		var pad = size * (state.padding / 100);
		var box = size - pad * 2;
		if (state.mode === 'text') {
			var text = (state.text || '').trim() || 'L';
			var font = FONTS[state.font] || FONTS.sans;
			var fs = box * (Array.from(text).length > 1 ? 0.62 : 0.86);
			ctx.font = font.replace('{s}', fs.toFixed(1));
			// Shrink to fit the box.
			var mw = ctx.measureText(text).width;
			if (mw > box) {
				fs *= box / mw;
				ctx.font = font.replace('{s}', fs.toFixed(1));
			}
			ctx.fillStyle = state.color;
			ctx.textAlign = 'center';
			ctx.textBaseline = 'middle';
			var m = ctx.measureText(text);
			var asc = m.actualBoundingBoxAscent || fs * 0.7;
			var desc = m.actualBoundingBoxDescent || 0;
			ctx.fillText(text, size / 2, size / 2 + (asc - desc) / 2);
		} else if (state.image) {
			var iw = state.image.width;
			var ih = state.image.height;
			var k = Math.min(box / iw, box / ih);
			var dw = iw * k;
			var dh = ih * k;
			var src = k < 0.5 ? L.resample(state.image, iw, ih, Math.max(1, Math.round(dw)), Math.max(1, Math.round(dh))) : state.image;
			ctx.drawImage(src, (size - dw) / 2, (size - dh) / 2, dw, dh);
		}
		ctx.restore();
		return c;
	}

	/** ICO file with PNG-compressed entries. */
	function makeIco(pngs) {
		var header = new DataView(new ArrayBuffer(6 + pngs.length * 16));
		header.setUint16(0, 0, true);
		header.setUint16(2, 1, true);
		header.setUint16(4, pngs.length, true);
		var offset = 6 + pngs.length * 16;
		pngs.forEach(function (p, i) {
			var o = 6 + i * 16;
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
	}

	function pngBytes(canvas) {
		return L.canvasToBlob(canvas, 'image/png').then(function (b) {
			return b.arrayBuffer().then(function (buf) {
				return new Uint8Array(buf);
			});
		});
	}

	L.register('favicon', function (el) {
		var dropzone = el.querySelector('[data-dropzone]');
		var results = el.querySelector('[data-results]');
		var preview = el.querySelector('[data-favicon-preview]');
		var dlBtn = el.querySelector('[data-favicon-download]');
		var textFields = el.querySelector('[data-text-fields]');
		var transparentBox = el.querySelector('[data-transparent]');
		var transparentField = el.querySelector('[data-transparent-field]');
		var bgInput = el.querySelector('[data-opt="background"]');
		var padOut = el.querySelector('[data-out="padding"]');
		var modeBtns = el.querySelectorAll('[data-mode]');
		var mode = 'image';
		var image = null;
		var fileName = '';

		preview.innerHTML =
			'<div class="favicon-preview__tab"><span class="favicon-preview__dots"><i></i><i></i><i></i></span><span class="favicon-preview__tabitem"><canvas width="32" height="32" data-tab-icon></canvas><span data-tab-title></span></span></div>' +
			'<div class="favicon-preview__sizes" data-sizes></div>' +
			'<div class="favicon-preview__code"><div class="favicon-preview__codehead"><span>' + L.escapeHtml(L.t('htmlSnippet', 'HTML to paste inside <head>')) + '</span><button type="button" class="btn btn--ghost btn--sm" data-copy>' + L.escapeHtml(L.t('copy', 'Copy')) + '</button></div><pre><code></code></pre></div>';
		preview.querySelector('code').textContent = SNIPPET;
		preview.querySelector('[data-tab-title]').textContent = document.title.split(/[–|·-]/)[0].trim() || 'My website';
		var sizesEl = preview.querySelector('[data-sizes]');
		[16, 32, 48, 180].forEach(function (s) {
			var fig = document.createElement('figure');
			fig.className = 'favicon-preview__size';
			fig.innerHTML = '<span class="favicon-preview__box"><canvas width="' + s + '" height="' + s + '" data-size="' + s + '"></canvas></span><figcaption>' + s + '×' + s + '</figcaption>';
			sizesEl.appendChild(fig);
		});

		function state() {
			var o = L.readOptions(el);
			return {
				mode: mode,
				image: image,
				text: o.text,
				font: o.font,
				color: o.color,
				shape: o.shape,
				background: o.background,
				transparent: mode === 'image' && transparentBox.checked,
				padding: o.padding || 0
			};
		}

		function ready() {
			return mode === 'text' || !!image;
		}

		function render() {
			padOut.textContent = el.querySelector('[data-opt="padding"]').value + '%';
			textFields.hidden = mode !== 'text';
			transparentField.hidden = mode !== 'image';
			bgInput.disabled = mode === 'image' && transparentBox.checked;
			results.hidden = !ready();
			dlBtn.disabled = !ready();
			if (!ready()) return;
			var st = state();
			preview.querySelectorAll('canvas[data-size]').forEach(function (cv) {
				var s = parseInt(cv.getAttribute('data-size'), 10);
				var icon = draw(s, st, s === 180);
				var ctx = cv.getContext('2d');
				ctx.clearRect(0, 0, s, s);
				ctx.drawImage(icon, 0, 0);
			});
			var tab = preview.querySelector('[data-tab-icon]');
			var tctx = tab.getContext('2d');
			tctx.clearRect(0, 0, 32, 32);
			tctx.drawImage(draw(32, st, false), 0, 0);
			app.announce(mode === 'image' ? fileName : L.t('textFavicon', 'Text favicon'));
		}

		var app = L.createApp(el, {
			multiple: false,
			onFiles: function (added) {
				var file = added[0].file;
				fileName = file.name;
				var isSvg = file.type === 'image/svg+xml' || /\.svg$/i.test(file.name);
				var load = isSvg
					? new Promise(function (resolve, reject) {
							var url = URL.createObjectURL(file);
							var img = new Image();
							img.onload = function () {
								// Rasterise SVGs large so every size stays sharp.
								var w = img.naturalWidth || 512;
								var h = img.naturalHeight || 512;
								var k = 1024 / Math.max(w, h);
								var c = L.makeCanvas(w * k, h * k);
								c.getContext('2d').drawImage(img, 0, 0, c.width, c.height);
								URL.revokeObjectURL(url);
								resolve(c);
							};
							img.onerror = function () {
								URL.revokeObjectURL(url);
								reject(new Error(L.t('unsupported')));
							};
							img.src = url;
					  })
					: L.loadImage(file).then(function (img) {
							var c = L.makeCanvas(img.width, img.height);
							c.getContext('2d').drawImage(img.source, 0, 0);
							return c;
					  });
				load
					.then(function (c) {
						image = c;
						setMode('image');
					})
					.catch(function (err) {
						results.hidden = false;
						app.announce((err && err.message) || L.t('error'));
					});
			},
			onClear: function () {
				image = null;
				if (mode === 'image') render();
			}
		});

		function setMode(m) {
			mode = m;
			modeBtns.forEach(function (b) {
				b.classList.toggle('is-active', b.getAttribute('data-mode') === m);
			});
			dropzone.hidden = m === 'text';
			if (m === 'text' && bgInput.disabled) bgInput.disabled = false;
			render();
		}

		modeBtns.forEach(function (b) {
			b.addEventListener('click', function () {
				setMode(b.getAttribute('data-mode'));
			});
		});
		el.querySelectorAll('[data-opt], [data-transparent]').forEach(function (n) {
			n.addEventListener('input', render);
			n.addEventListener('change', render);
		});

		preview.querySelector('[data-copy]').addEventListener('click', function (e) {
			var btn = e.currentTarget;
			var done = function () {
				btn.textContent = L.t('copied', 'Copied');
				setTimeout(function () {
					btn.textContent = L.t('copy', 'Copy');
				}, 1600);
			};
			if (navigator.clipboard) navigator.clipboard.writeText(SNIPPET).then(done, done);
			else done();
		});

		dlBtn.addEventListener('click', function () {
			if (!ready()) return;
			var st = state();
			dlBtn.disabled = true;
			var files = [];
			var icoParts = [];
			var jobs = [16, 32, 48].map(function (s) {
				return pngBytes(draw(s, st, false)).then(function (bytes) {
					icoParts.push({ size: s, bytes: bytes });
				});
			});
			SIZES.forEach(function (def) {
				jobs.push(
					L.canvasToBlob(draw(def.size, st, !!def.solid), 'image/png').then(function (blob) {
						files.push({ name: def.name, blob: blob });
					})
				);
			});
			Promise.all(jobs)
				.then(function () {
					icoParts.sort(function (a, b) {
						return a.size - b.size;
					});
					files.unshift({ name: 'favicon.ico', blob: makeIco(icoParts) });
					var manifest = {
						name: '',
						short_name: '',
						icons: [
							{ src: '/android-chrome-192x192.png', sizes: '192x192', type: 'image/png' },
							{ src: '/android-chrome-512x512.png', sizes: '512x512', type: 'image/png' }
						],
						theme_color: st.mode === 'text' || !st.transparent ? st.background : '#ffffff',
						background_color: '#ffffff',
						display: 'standalone'
					};
					files.push({ name: 'site.webmanifest', blob: new Blob([JSON.stringify(manifest, null, 2)], { type: 'application/manifest+json' }) });
					files.push({ name: 'how-to-install.html', blob: new Blob(['<!-- Upload all files to your website root, then paste this inside <head>: -->\n' + SNIPPET + '\n'], { type: 'text/html' }) });
					return L.makeZip(files);
				})
				.then(function (zip) {
					L.download(zip, 'favicon-package.zip');
				})
				.catch(function (err) {
					app.announce((err && err.message) || L.t('error'));
				})
				.then(function () {
					dlBtn.disabled = false;
				});
		});

		render();
	});
})();
