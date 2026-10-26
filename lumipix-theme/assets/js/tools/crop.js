/**
 * Image cropper: drag/resize a crop box, aspect presets, exact pixel size,
 * rotate and flip. Crops at full resolution.
 */
(function () {
	'use strict';
	var L = window.Lumipix;
	if (!L) return;

	var MIN = 8;

	L.register('crop', function (el) {
		var stage = el.querySelector('[data-crop-stage]');
		var dlBtn = el.querySelector('[data-crop-download]');
		var wIn = el.querySelector('[data-crop-w]');
		var hIn = el.querySelector('[data-crop-h]');
		var aspectBtns = el.querySelectorAll('[data-aspect]');
		var tools = el.querySelectorAll('[data-rotate], [data-flip]');
		var list = el.querySelector('[data-list]');
		var src = null; // working canvas (after rotate/flip)
		var file = null;
		var aspect = 0; // 0 = free
		var box = null; // { x, y, w, h } in image pixels
		var view = null;
		var boxEl = null;
		var scale = 1;

		function build() {
			stage.innerHTML = '';
			view = document.createElement('div');
			view.className = 'crop-view';
			var shown = src;
			view.appendChild(shown);
			shown.className = 'crop-view__img';
			boxEl = document.createElement('div');
			boxEl.className = 'crop-box';
			boxEl.tabIndex = 0;
			boxEl.setAttribute('role', 'group');
			boxEl.setAttribute('aria-label', L.t('cropArea', 'Crop area: drag to move, use arrow keys to nudge'));
			boxEl.innerHTML = '<span class="crop-box__grid"></span>' + ['nw', 'ne', 'sw', 'se'].map(function (c) {
				return '<span class="crop-box__handle crop-box__handle--' + c + '" data-handle="' + c + '"></span>';
			}).join('');
			view.appendChild(boxEl);
			stage.appendChild(view);
			bindPointer();
			requestAnimationFrame(layout);
		}

		function layout() {
			if (!view || !src) return;
			scale = view.clientWidth / src.width || 1;
			draw();
		}

		function clamp() {
			box.w = Math.max(MIN, Math.min(box.w, src.width));
			box.h = Math.max(MIN, Math.min(box.h, src.height));
			box.x = Math.max(0, Math.min(box.x, src.width - box.w));
			box.y = Math.max(0, Math.min(box.y, src.height - box.h));
		}

		function draw() {
			if (!boxEl) return;
			clamp();
			boxEl.style.left = box.x * scale + 'px';
			boxEl.style.top = box.y * scale + 'px';
			boxEl.style.width = box.w * scale + 'px';
			boxEl.style.height = box.h * scale + 'px';
			if (document.activeElement !== wIn) wIn.value = Math.round(box.w);
			if (document.activeElement !== hIn) hIn.value = Math.round(box.h);
			app.announce(Math.round(box.w) + ' × ' + Math.round(box.h) + ' px');
		}

		/** Largest centred box with the current aspect ratio. */
		function fitAspect() {
			if (!aspect) {
				box = { x: 0, y: 0, w: src.width, h: src.height };
				return;
			}
			var w = src.width;
			var h = w / aspect;
			if (h > src.height) {
				h = src.height;
				w = h * aspect;
			}
			box = { x: (src.width - w) / 2, y: (src.height - h) / 2, w: w, h: h };
		}

		function bindPointer() {
			var drag = null;
			function point(e) {
				var r = view.getBoundingClientRect();
				return { x: (e.clientX - r.left) / scale, y: (e.clientY - r.top) / scale };
			}
			boxEl.addEventListener('pointerdown', function (e) {
				e.preventDefault();
				var handle = e.target.getAttribute('data-handle');
				drag = { handle: handle, start: point(e), box: { x: box.x, y: box.y, w: box.w, h: box.h } };
				boxEl.setPointerCapture(e.pointerId);
				boxEl.classList.add('is-dragging');
			});
			boxEl.addEventListener('pointermove', function (e) {
				if (!drag) return;
				var p = point(e);
				var dx = p.x - drag.start.x;
				var dy = p.y - drag.start.y;
				var b = drag.box;
				if (!drag.handle) {
					box.x = b.x + dx;
					box.y = b.y + dy;
					draw();
					return;
				}
				// The opposite corner stays fixed.
				var west = drag.handle.indexOf('w') >= 0;
				var north = drag.handle.indexOf('n') >= 0;
				var ax = west ? b.x + b.w : b.x;
				var ay = north ? b.y + b.h : b.y;
				var px = Math.max(0, Math.min(src.width, p.x));
				var py = Math.max(0, Math.min(src.height, p.y));
				var w = Math.max(MIN, Math.abs(px - ax));
				var h = Math.max(MIN, Math.abs(py - ay));
				if (aspect) {
					if (w / h > aspect) w = h * aspect;
					else h = w / aspect;
					var maxW = west ? ax : src.width - ax;
					var maxH = north ? ay : src.height - ay;
					if (w > maxW) {
						w = maxW;
						h = w / aspect;
					}
					if (h > maxH) {
						h = maxH;
						w = h * aspect;
					}
				}
				box = { x: west ? ax - w : ax, y: north ? ay - h : ay, w: w, h: h };
				draw();
			});
			['pointerup', 'pointercancel'].forEach(function (ev) {
				boxEl.addEventListener(ev, function () {
					drag = null;
					boxEl.classList.remove('is-dragging');
				});
			});
			boxEl.addEventListener('keydown', function (e) {
				var step = (e.shiftKey ? 10 : 1) / scale;
				var map = { ArrowLeft: [-step, 0], ArrowRight: [step, 0], ArrowUp: [0, -step], ArrowDown: [0, step] };
				if (!map[e.key]) return;
				e.preventDefault();
				box.x += map[e.key][0];
				box.y += map[e.key][1];
				draw();
			});
		}

		function setEnabled(on) {
			wIn.disabled = !on;
			hIn.disabled = !on;
			tools.forEach(function (b) {
				b.disabled = !on;
			});
			dlBtn.disabled = !on;
		}

		function transform(rotate, flip) {
			var w = rotate ? src.height : src.width;
			var h = rotate ? src.width : src.height;
			var c = L.makeCanvas(w, h);
			var ctx = c.getContext('2d');
			ctx.translate(w / 2, h / 2);
			if (rotate) ctx.rotate((rotate * Math.PI) / 180);
			if (flip) ctx.scale(-1, 1);
			ctx.drawImage(src, -src.width / 2, -src.height / 2);
			src = c;
			fitAspect();
			build();
		}

		var app = L.createApp(el, {
			multiple: false,
			onFiles: function (added) {
				file = added[0].file;
				list.innerHTML = '';
				L.loadImage(file)
					.then(function (img) {
						var c = L.makeCanvas(img.width, img.height);
						c.getContext('2d').drawImage(img.source, 0, 0);
						if (img.source.close) img.source.close();
						if (img.url) URL.revokeObjectURL(img.url);
						src = c;
						fitAspect();
						build();
						setEnabled(true);
					})
					.catch(function (err) {
						app.announce((err && err.message) || L.t('error'));
					});
			},
			onClear: function () {
				src = null;
				file = null;
				stage.innerHTML = '';
				view = boxEl = null;
				setEnabled(false);
			}
		});

		aspectBtns.forEach(function (b) {
			b.addEventListener('click', function () {
				var v = b.getAttribute('data-aspect');
				var parts = v.split(':');
				aspect = parts.length === 2 ? parseFloat(parts[0]) / parseFloat(parts[1]) : 0;
				aspectBtns.forEach(function (x) {
					x.classList.toggle('is-active', x === b);
				});
				if (src) {
					fitAspect();
					draw();
				}
			});
		});

		function fromInputs(changed) {
			if (!src) return;
			var w = parseFloat(wIn.value) || box.w;
			var h = parseFloat(hIn.value) || box.h;
			if (aspect) {
				if (changed === 'w') h = w / aspect;
				else w = h * aspect;
			}
			var cx = box.x + box.w / 2;
			var cy = box.y + box.h / 2;
			box = { x: cx - w / 2, y: cy - h / 2, w: Math.min(w, src.width), h: Math.min(h, src.height) };
			draw();
		}
		wIn.addEventListener('change', function () {
			fromInputs('w');
		});
		hIn.addEventListener('change', function () {
			fromInputs('h');
		});

		tools.forEach(function (b) {
			b.addEventListener('click', function () {
				if (!src) return;
				if (b.hasAttribute('data-flip')) transform(0, true);
				else transform(parseFloat(b.getAttribute('data-rotate')), false);
			});
		});

		window.addEventListener('resize', L.debounce(layout, 100));

		dlBtn.addEventListener('click', function () {
			if (!src) return;
			var opts = L.readOptions(el);
			var type = opts.format;
			if (!type || type === 'auto') type = /^image\/(jpeg|png|webp)$/.test(file.type) ? file.type : 'image/png';
			if (type === 'image/webp' && !L.supportsType('image/webp')) type = 'image/png';
			var w = Math.max(1, Math.round(box.w));
			var h = Math.max(1, Math.round(box.h));
			var out = L.makeCanvas(w, h);
			out.getContext('2d').drawImage(src, Math.round(box.x), Math.round(box.y), w, h, 0, 0, w, h);
			if (type === 'image/jpeg') out = L.flatten(out, '#ffffff');
			L.canvasToBlob(out, type, type === 'image/png' ? undefined : 0.92).then(function (blob) {
				L.download(blob, L.renameFile(file.name, type, 'cropped'));
				app.announce('✓ ' + w + ' × ' + h + ' px · ' + L.formatBytes(blob.size));
			});
		});

		setEnabled(false);
	});
})();
