/**
 * AI background remover – runs a Transformers.js segmentation model
 * in the visitor's browser (WebGPU when available, otherwise WebAssembly).
 * The library and model are fetched once from a CDN and cached by the browser.
 */
(function () {
	'use strict';
	var L = window.Lumipix;
	if (!L) return;

	var modelPromise = null;

	function loadModel(onProgress) {
		if (modelPromise) return modelPromise;
		var lib = (L.config.bgLibrary || '').replace(/\/+$/, '');
		var model = L.config.bgModel || 'Xenova/modnet';
		var files = {};

		var progress = function (e) {
			if (!e || e.status !== 'progress' || !e.file) return;
			files[e.file] = { loaded: e.loaded || 0, total: e.total || 0 };
			var loaded = 0;
			var total = 0;
			Object.keys(files).forEach(function (k) {
				loaded += files[k].loaded;
				total += files[k].total;
			});
			if (total) onProgress(loaded / total, total);
		};

		modelPromise = import(/* webpackIgnore: true */ lib)
			.then(function (tf) {
				if (tf.env) {
					tf.env.allowLocalModels = false;
				}
				var create = function (device) {
					var opts = { progress_callback: progress };
					if (device) opts.device = device;
					return tf.pipeline('background-removal', model, opts).then(function (pipe) {
						return { pipe: pipe, device: device || 'wasm' };
					});
				};
				if (navigator.gpu) {
					return create('webgpu').catch(function () {
						return create(null);
					});
				}
				return create(null);
			})
			.catch(function (err) {
				modelPromise = null;
				throw err;
			});
		return modelPromise;
	}

	function compose(cutout, bg) {
		var out = L.makeCanvas(cutout.width, cutout.height);
		var ctx = out.getContext('2d');
		if (bg && bg !== 'transparent') {
			ctx.fillStyle = bg;
			ctx.fillRect(0, 0, out.width, out.height);
		}
		ctx.drawImage(cutout, 0, 0);
		return out;
	}

	L.register('bg', function (el, config) {
		var status = el.querySelector('[data-model-status]');
		var statusText = el.querySelector('[data-model-text]');
		var bar = el.querySelector('[data-model-progress]');
		var barFill = bar ? bar.querySelector('span') : null;
		var swatches = el.querySelectorAll('[data-bg]');
		var custom = el.querySelector('[data-bg-custom]');
		var list = el.querySelector('[data-list]');
		var background = 'transparent';
		var state = null; // { file, cutout (canvas), originalUrl }

		function setStatus(kind, text) {
			status.classList.remove('is-loading', 'is-ready', 'is-error');
			if (kind) status.classList.add('is-' + kind);
			if (text) statusText.textContent = text;
		}

		function renderResult() {
			if (!state || !state.cutout) return;
			var pane = list.querySelector('[data-after]');
			pane.innerHTML = '';
			var canvas = compose(state.cutout, background);
			canvas.setAttribute('role', 'img');
			canvas.setAttribute('aria-label', 'Result');
			pane.appendChild(canvas);
			pane.classList.toggle('checker', background === 'transparent');
			var label = document.createElement('span');
			label.className = 'preview__label';
			label.textContent = 'After';
			pane.appendChild(label);
		}

		function exportResult(type) {
			if (!state || !state.cutout) return;
			var bg = background;
			if (type === 'image/jpeg' && bg === 'transparent') bg = '#ffffff';
			var canvas = compose(state.cutout, bg);
			L.canvasToBlob(canvas, type, type === 'image/jpeg' ? 0.95 : undefined).then(function (blob) {
				L.download(blob, L.renameFile(state.file.name, type, 'no-bg'));
			});
		}

		function process(file) {
			if (state && state.originalUrl) URL.revokeObjectURL(state.originalUrl);
			state = { file: file, cutout: null, originalUrl: URL.createObjectURL(file) };
			var current = state;

			list.innerHTML =
				'<li class="preview-item">' +
				'<div class="preview">' +
				'<div class="preview__pane"><img alt="" src="' + current.originalUrl + '"><span class="preview__label">Before</span></div>' +
				'<div class="preview__pane" data-after><span class="spinner" aria-hidden="true"></span></div>' +
				'</div>' +
				'<div class="preview__actions" data-actions></div>' +
				'</li>';

			setStatus('loading', L.t('loadingModel'));
			if (bar) bar.hidden = false;

			return loadModel(function (ratio) {
				if (barFill) barFill.style.width = Math.round(ratio * 100) + '%';
			})
				.then(function (model) {
					if (current !== state) return;
					if (bar) bar.hidden = true;
					setStatus('loading', L.t('runningModel'));
					// Downscale very large photos before inference; the mask is applied at full size.
					return L.loadImage(file).then(function (img) {
						var src = L.makeCanvas(img.width, img.height);
						src.getContext('2d').drawImage(img.source, 0, 0);
						if (img.source.close) img.source.close();
						if (img.url) URL.revokeObjectURL(img.url);
						return model.pipe(src).then(function (output) {
							var raw = Array.isArray(output) ? output[0] : output;
							return raw.toCanvas();
						});
					});
				})
				.then(function (cutout) {
					if (!cutout || current !== state) return;
					state.cutout = cutout;
					setStatus('ready', L.t('done') + ' · ' + cutout.width + '×' + cutout.height);
					renderResult();
					var actions = list.querySelector('[data-actions]');
					var png = document.createElement('button');
					png.type = 'button';
					png.className = 'btn btn--primary';
					png.innerHTML = L.icon('download') + 'PNG';
					png.addEventListener('click', function () {
						exportResult('image/png');
					});
					var jpg = document.createElement('button');
					jpg.type = 'button';
					jpg.className = 'btn btn--ghost';
					jpg.innerHTML = L.icon('download') + 'JPG';
					jpg.addEventListener('click', function () {
						exportResult('image/jpeg');
					});
					actions.appendChild(jpg);
					actions.appendChild(png);
				})
				.catch(function (err) {
					if (window.console) console.error(err); // eslint-disable-line no-console
					if (bar) bar.hidden = true;
					setStatus('error', L.t('modelFailed'));
					var after = list.querySelector('[data-after]');
					if (after) after.innerHTML = '';
				});
		}

		L.createApp(el, {
			multiple: false,
			onFiles: function (items) {
				process(items[0].file);
			},
			onClear: function () {
				if (state && state.originalUrl) URL.revokeObjectURL(state.originalUrl);
				state = null;
				list.innerHTML = '';
			}
		});

		function selectSwatch(btn, value) {
			swatches.forEach(function (s) {
				s.classList.toggle('is-active', s === btn);
				s.setAttribute('aria-checked', String(s === btn));
			});
			if (custom) custom.parentNode.classList.toggle('is-active', !btn);
			background = value;
			renderResult();
		}
		swatches.forEach(function (btn) {
			btn.addEventListener('click', function () {
				selectSwatch(btn, btn.getAttribute('data-bg'));
			});
		});
		if (custom) {
			custom.addEventListener('input', function () {
				selectSwatch(null, custom.value);
			});
		}

		// Preset background from the page config (e.g. the white background tool).
		if (config && config.background) {
			var preset = null;
			swatches.forEach(function (sw) {
				if ((sw.getAttribute('data-bg') || '').toLowerCase() === config.background.toLowerCase()) preset = sw;
			});
			if (preset) {
				selectSwatch(preset, config.background);
			} else if (custom) {
				custom.value = config.background;
				selectSwatch(null, config.background);
			}
		}
	});
})();
