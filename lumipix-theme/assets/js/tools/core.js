/**
 * Lumipix tool core: shared helpers and the app framework used by every tool.
 * Everything runs locally in the browser – no file ever leaves the device.
 */
(function () {
	'use strict';

	var cfg = window.LumipixConfig || { i18n: {}, maxFiles: 20 };
	var t = function (key, fallback) {
		return (cfg.i18n && cfg.i18n[key]) || fallback || key;
	};

	/* ------------------------------------------------------------ Helpers */

	function formatBytes(bytes) {
		if (!isFinite(bytes)) return '–';
		if (bytes < 1024) return bytes + ' B';
		if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(bytes < 10240 ? 1 : 0) + ' KB';
		return (bytes / 1024 / 1024).toFixed(2) + ' MB';
	}

	function escapeHtml(s) {
		return String(s).replace(/[&<>"']/g, function (c) {
			return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
		});
	}

	function extFor(type) {
		return { 'image/jpeg': 'jpg', 'image/png': 'png', 'image/webp': 'webp', 'image/avif': 'avif' }[type] || 'png';
	}

	function renameFile(name, type, suffix) {
		var base = String(name || 'image').replace(/\.[^.]+$/, '');
		return base + (suffix ? '-' + suffix : '') + '.' + extFor(type);
	}

	/**
	 * Decode a file into something drawable, honouring EXIF orientation.
	 * Resolves to { source, width, height }.
	 */
	function loadImage(file) {
		if (window.createImageBitmap) {
			return createImageBitmap(file, { imageOrientation: 'from-image' })
				.then(function (bmp) {
					return { source: bmp, width: bmp.width, height: bmp.height };
				})
				.catch(function () {
					return loadViaElement(file);
				});
		}
		return loadViaElement(file);
	}

	function loadViaElement(file) {
		return new Promise(function (resolve, reject) {
			var url = URL.createObjectURL(file);
			var img = new Image();
			img.decoding = 'async';
			img.onload = function () {
				resolve({ source: img, width: img.naturalWidth, height: img.naturalHeight, url: url });
			};
			img.onerror = function () {
				URL.revokeObjectURL(url);
				reject(new Error(t('unsupported')));
			};
			img.src = url;
		});
	}

	function makeCanvas(w, h) {
		var c = document.createElement('canvas');
		c.width = Math.max(1, Math.round(w));
		c.height = Math.max(1, Math.round(h));
		return c;
	}

	/**
	 * High-quality resample: halve repeatedly, then draw the final step.
	 * Avoids the aliasing of a single large downscale.
	 */
	function resample(source, sw, sh, tw, th) {
		var cur = source;
		var cw = sw;
		var ch = sh;
		while (cw / 2 >= tw && ch / 2 >= th) {
			var nw = Math.round(cw / 2);
			var nh = Math.round(ch / 2);
			var step = makeCanvas(nw, nh);
			var sctx = step.getContext('2d');
			sctx.imageSmoothingEnabled = true;
			sctx.imageSmoothingQuality = 'high';
			sctx.drawImage(cur, 0, 0, cw, ch, 0, 0, nw, nh);
			cur = step;
			cw = nw;
			ch = nh;
		}
		var out = makeCanvas(tw, th);
		var ctx = out.getContext('2d');
		ctx.imageSmoothingEnabled = true;
		ctx.imageSmoothingQuality = 'high';
		ctx.drawImage(cur, 0, 0, cw, ch, 0, 0, out.width, out.height);
		return out;
	}

	function canvasToBlob(canvas, type, quality) {
		return new Promise(function (resolve, reject) {
			canvas.toBlob(
				function (blob) {
					if (blob) resolve(blob);
					else reject(new Error(t('error')));
				},
				type,
				quality
			);
		});
	}

	/** Paint a solid background under transparent pixels (needed for JPG). */
	function flatten(canvas, color) {
		var out = makeCanvas(canvas.width, canvas.height);
		var ctx = out.getContext('2d');
		ctx.fillStyle = color || '#ffffff';
		ctx.fillRect(0, 0, out.width, out.height);
		ctx.drawImage(canvas, 0, 0);
		return out;
	}

	/** Browser support check for an output type (e.g. WebP in old Safari). */
	var typeSupport = {};
	function supportsType(type) {
		if (type in typeSupport) return typeSupport[type];
		var c = makeCanvas(1, 1);
		typeSupport[type] = c.toDataURL(type).indexOf('data:' + type) === 0;
		return typeSupport[type];
	}

	/**
	 * Write DPI into a JPEG's JFIF header so it prints at the intended size.
	 * Returns the original blob when there is no JFIF APP0 segment.
	 */
	function setJpegDpi(blob, dpi) {
		return blob.arrayBuffer().then(function (buf) {
			var b = new Uint8Array(buf);
			// SOI + APP0 marker + "JFIF\0"
			if (b[0] === 0xff && b[1] === 0xd8 && b[2] === 0xff && b[3] === 0xe0 && b[6] === 0x4a && b[7] === 0x46 && b[8] === 0x49 && b[9] === 0x46 && b[10] === 0x00) {
				var d = Math.max(1, Math.min(65535, Math.round(dpi)));
				b[13] = 1; // units: dots per inch
				b[14] = d >> 8;
				b[15] = d & 0xff;
				b[16] = d >> 8;
				b[17] = d & 0xff;
				return new Blob([b], { type: 'image/jpeg' });
			}
			return blob;
		});
	}

	/* CRC-32 (used by ZIP and PNG chunks). */
	var crcTable = null;
	function crc32(bytes, crc) {
		if (!crcTable) {
			crcTable = new Uint32Array(256);
			for (var n = 0; n < 256; n++) {
				var c = n;
				for (var k = 0; k < 8; k++) c = c & 1 ? 0xedb88320 ^ (c >>> 1) : c >>> 1;
				crcTable[n] = c >>> 0;
			}
		}
		crc = crc === undefined ? 0xffffffff : crc ^ 0xffffffff;
		for (var i = 0; i < bytes.length; i++) crc = crcTable[(crc ^ bytes[i]) & 0xff] ^ (crc >>> 8);
		return (crc ^ 0xffffffff) >>> 0;
	}

	/** Make every name in a list unique: photo.jpg, photo-2.jpg, … */
	function uniqueNames(names) {
		var seen = {};
		return names.map(function (name) {
			var key = name.toLowerCase();
			if (!seen[key]) {
				seen[key] = 1;
				return name;
			}
			var n = ++seen[key];
			var dot = name.lastIndexOf('.');
			var out = dot > 0 ? name.slice(0, dot) + '-' + n + name.slice(dot) : name + '-' + n;
			seen[out.toLowerCase()] = 1;
			return out;
		});
	}

	/**
	 * Build a ZIP (stored, no compression – images are already compressed).
	 * files: [{ name, blob }] → Promise<Blob>
	 */
	function makeZip(files) {
		var names = uniqueNames(
			files.map(function (f) {
				return f.name;
			})
		);
		return Promise.all(
			files.map(function (f) {
				return f.blob.arrayBuffer().then(function (b) {
					return new Uint8Array(b);
				});
			})
		).then(function (datas) {
			var enc = new TextEncoder();
			var parts = [];
			var central = [];
			var offset = 0;
			var d = new Date();
			var dosTime = (d.getHours() << 11) | (d.getMinutes() << 5) | (d.getSeconds() >> 1);
			var dosDate = ((d.getFullYear() - 1980) << 9) | ((d.getMonth() + 1) << 5) | d.getDate();
			datas.forEach(function (data, i) {
				var name = enc.encode(names[i]);
				var crc = crc32(data);
				var local = new DataView(new ArrayBuffer(30));
				local.setUint32(0, 0x04034b50, true);
				local.setUint16(4, 20, true);
				local.setUint16(6, 0x0800, true); // UTF-8 names
				local.setUint16(8, 0, true);
				local.setUint16(10, dosTime, true);
				local.setUint16(12, dosDate, true);
				local.setUint32(14, crc, true);
				local.setUint32(18, data.length, true);
				local.setUint32(22, data.length, true);
				local.setUint16(26, name.length, true);
				local.setUint16(28, 0, true);
				parts.push(local.buffer, name, data);
				var cd = new DataView(new ArrayBuffer(46));
				cd.setUint32(0, 0x02014b50, true);
				cd.setUint16(4, 20, true);
				cd.setUint16(6, 20, true);
				cd.setUint16(8, 0x0800, true);
				cd.setUint16(10, 0, true);
				cd.setUint16(12, dosTime, true);
				cd.setUint16(14, dosDate, true);
				cd.setUint32(16, crc, true);
				cd.setUint32(20, data.length, true);
				cd.setUint32(24, data.length, true);
				cd.setUint16(28, name.length, true);
				cd.setUint32(42, offset, true);
				central.push(cd.buffer, name);
				offset += 30 + name.length + data.length;
			});
			var cdSize = central.reduce(function (s, p) {
				return s + (p.byteLength !== undefined ? p.byteLength : p.length);
			}, 0);
			var end = new DataView(new ArrayBuffer(22));
			end.setUint32(0, 0x06054b50, true);
			end.setUint16(8, datas.length, true);
			end.setUint16(10, datas.length, true);
			end.setUint32(12, cdSize, true);
			end.setUint32(16, offset, true);
			return new Blob(parts.concat(central, [end.buffer]), { type: 'application/zip' });
		});
	}

	function download(blob, filename) {
		var url = URL.createObjectURL(blob);
		var a = document.createElement('a');
		a.href = url;
		a.download = filename;
		document.body.appendChild(a);
		a.click();
		a.remove();
		setTimeout(function () {
			URL.revokeObjectURL(url);
		}, 4000);
	}

	function debounce(fn, wait) {
		var timer;
		return function () {
			var args = arguments;
			var self = this;
			clearTimeout(timer);
			timer = setTimeout(function () {
				fn.apply(self, args);
			}, wait);
		};
	}

	function icon(name) {
		var paths = {
			download: '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/>',
			check: '<path d="M20 6 9 17l-5-5"/>',
			alert: '<circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/>'
		};
		return '<svg class="icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' + (paths[name] || '') + '</svg>';
	}

	/* ------------------------------------------------------- App framework */

	/**
	 * Wires the shared UI (dropzone, paste, results list, download all)
	 * and calls `handlers.process(item)` for every file.
	 *
	 * handlers: {
	 *   multiple: bool,
	 *   process(item) -> Promise<{ blob, name, meta, badge, preview }>,
	 *   onFiles(items)  optional – custom rendering (single-file apps)
	 * }
	 */
	function createApp(el, handlers) {
		var input = el.querySelector('[data-file-input]');
		var dropzone = el.querySelector('[data-dropzone]');
		var results = el.querySelector('[data-results]');
		var list = el.querySelector('[data-list]');
		var summary = el.querySelector('[data-summary]');
		var clearBtn = el.querySelector('[data-clear]');
		var allBtn = el.querySelector('[data-download-all]');
		var items = [];
		var runId = 0;

		function addFiles(fileList) {
			var files = Array.prototype.filter.call(fileList || [], function (f) {
				return f && (/^image\//.test(f.type) || /\.(heic|heif|avif|jxl)$/i.test(f.name));
			});
			if (!files.length) return;
			if (!handlers.multiple) {
				clear();
				files = files.slice(0, 1);
			} else if (items.length + files.length > cfg.maxFiles) {
				files = files.slice(0, Math.max(0, cfg.maxFiles - items.length));
				announce(t('tooMany'));
			}
			var added = files.map(function (file) {
				var item = { file: file, row: null, result: null };
				items.push(item);
				return item;
			});
			results.hidden = false;
			if (handlers.onFiles) {
				handlers.onFiles(added, api);
			} else {
				added.forEach(function (item) {
					item.row = createRow(item);
					list.appendChild(item.row.el);
				});
				runItems(added, runId);
			}
		}

		function runItems(subset, id) {
			var chain = Promise.resolve();
			subset.forEach(function (item) {
				chain = chain.then(function () {
					if (id !== runId) return;
					item.row.busy();
					return handlers
						.process(item)
						.then(function (res) {
							if (id !== runId) return;
							item.result = res;
							item.row.done(res);
						})
						.catch(function (err) {
							if (id !== runId) return;
							item.result = null;
							item.row.fail(err);
						});
				});
			});
			return chain.then(function () {
				if (id === runId) updateSummary();
			});
		}

		function rerun() {
			if (!items.length || handlers.onFiles) return;
			runId++;
			runItems(items, runId);
		}

		function createRow(item) {
			var li = document.createElement('li');
			li.className = 'result';
			li.innerHTML =
				'<div class="result__thumb"></div>' +
				'<div class="result__info"><p class="result__name"></p><p class="result__meta"></p></div>' +
				'<div class="result__actions"></div>';
			li.querySelector('.result__name').textContent = item.file.name;
			var thumb = li.querySelector('.result__thumb');
			var meta = li.querySelector('.result__meta');
			var actions = li.querySelector('.result__actions');
			var thumbUrl = URL.createObjectURL(item.file);
			var img = new Image();
			img.alt = '';
			img.src = thumbUrl;
			thumb.appendChild(img);
			return {
				el: li,
				busy: function () {
					li.classList.remove('is-error');
					meta.innerHTML = '<span class="spinner" aria-hidden="true"></span> ' + escapeHtml(t('processing'));
					actions.innerHTML = '';
				},
				done: function (res) {
					meta.innerHTML = res.meta + (res.badge ? ' ' + res.badge : '');
					actions.innerHTML = '';
					if (res.action) {
						var link = document.createElement('a');
						link.className = 'btn btn--ghost btn--sm';
						link.href = res.action.href;
						link.textContent = res.action.label;
						actions.appendChild(link);
					}
					if (!res.blob) return;
					var btn = document.createElement('button');
					btn.type = 'button';
					btn.className = 'btn btn--primary btn--sm';
					btn.innerHTML = icon('download') + escapeHtml(t('download'));
					btn.addEventListener('click', function () {
						download(res.blob, res.name);
					});
					actions.appendChild(btn);
				},
				fail: function (err) {
					li.classList.add('is-error');
					meta.innerHTML = icon('alert') + ' ' + escapeHtml((err && err.message) || t('error'));
					actions.innerHTML = '';
				},
				destroy: function () {
					URL.revokeObjectURL(thumbUrl);
				}
			};
		}

		function updateSummary() {
			var ok = items.filter(function (i) {
				return i.result;
			});
			if (allBtn) allBtn.hidden = ok.length < 2;
			if (!summary) return;
			if (handlers.summary) {
				summary.textContent = handlers.summary(ok, items);
				return;
			}
			if (!ok.length) {
				summary.textContent = '';
				return;
			}
			var before = 0;
			var after = 0;
			ok.forEach(function (i) {
				before += i.file.size;
				after += i.result.blob.size;
			});
			var pct = before ? Math.min(99, Math.round((1 - after / before) * 100)) : 0;
			var text = ok.length + ' / ' + items.length + ' · ' + formatBytes(before) + ' → ' + formatBytes(after);
			summary.innerHTML = escapeHtml(text) + (pct > 0 ? ' · <strong>' + pct + '% ' + escapeHtml(t('saved')) + '</strong>' : '');
		}

		function announce(msg) {
			if (summary) summary.textContent = msg;
		}

		function clear() {
			runId++;
			items.forEach(function (i) {
				if (i.row) i.row.destroy();
			});
			items = [];
			list.innerHTML = '';
			results.hidden = true;
			if (summary) summary.textContent = '';
			if (allBtn) allBtn.hidden = true;
			if (input) input.value = '';
			if (handlers.onClear) handlers.onClear();
		}

		/* Events */
		if (input) {
			input.addEventListener('change', function () {
				addFiles(input.files);
				input.value = '';
			});
		}
		if (dropzone) {
			['dragenter', 'dragover'].forEach(function (ev) {
				dropzone.addEventListener(ev, function (e) {
					e.preventDefault();
					dropzone.classList.add('is-dragover');
				});
			});
			['dragleave', 'drop'].forEach(function (ev) {
				dropzone.addEventListener(ev, function (e) {
					e.preventDefault();
					dropzone.classList.remove('is-dragover');
				});
			});
			dropzone.addEventListener('drop', function (e) {
				if (e.dataTransfer) addFiles(e.dataTransfer.files);
			});
		}
		if (clearBtn) clearBtn.addEventListener('click', clear);
		if (allBtn) {
			allBtn.addEventListener('click', function () {
				var ok = items.filter(function (i) {
					return i.result;
				});
				// One ZIP instead of many downloads (browsers often block multiple downloads).
				makeZip(
					ok.map(function (i) {
						return { name: i.result.name, blob: i.result.blob };
					})
				).then(function (zip) {
					download(zip, (handlers.zipName || 'lumipix-images') + '.zip');
				});
			});
		}

		var api = {
			el: el,
			items: function () {
				return items;
			},
			rerun: debounce(rerun, 250),
			addFiles: addFiles,
			clear: clear,
			announce: announce,
			updateSummary: updateSummary
		};
		apps.push(api);
		return api;
	}

	/* Paste goes to the first app on the page. */
	var apps = [];
	document.addEventListener('paste', function (e) {
		if (!apps.length || !e.clipboardData) return;
		var tag = (document.activeElement && document.activeElement.tagName) || '';
		if (/INPUT|TEXTAREA/.test(tag) && document.activeElement.type !== 'file') return;
		var files = [];
		Array.prototype.forEach.call(e.clipboardData.items || [], function (it) {
			if (it.kind === 'file') {
				var f = it.getAsFile();
				if (f) files.push(f);
			}
		});
		if (files.length) {
			e.preventDefault();
			apps[0].addFiles(files);
			apps[0].el.scrollIntoView({ behavior: 'smooth', block: 'start' });
		}
	});

	/** Read all [data-opt] controls inside an app element. */
	function readOptions(el) {
		var out = {};
		el.querySelectorAll('[data-opt]').forEach(function (node) {
			var key = node.getAttribute('data-opt');
			var v = node.value;
			out[key] = node.type === 'number' || node.type === 'range' ? (v === '' ? null : parseFloat(v)) : v;
		});
		return out;
	}

	/* Mount every app on the page once all app scripts have registered. */
	var registry = {};
	function mountAll() {
		document.querySelectorAll('[data-lumipix-app]').forEach(function (el) {
			if (el.__lumipix) return;
			var name = el.getAttribute('data-lumipix-app');
			if (!registry[name]) return;
			var config = {};
			try {
				config = JSON.parse(el.getAttribute('data-config') || '{}') || {};
			} catch (e) {}
			el.__lumipix = true;
			registry[name](el, config);
		});
	}

	window.Lumipix = {
		config: cfg,
		t: t,
		register: function (name, fn) {
			registry[name] = fn;
			if (document.readyState !== 'loading') mountAll();
		},
		createApp: createApp,
		readOptions: readOptions,
		formatBytes: formatBytes,
		escapeHtml: escapeHtml,
		extFor: extFor,
		renameFile: renameFile,
		loadImage: loadImage,
		makeCanvas: makeCanvas,
		resample: resample,
		canvasToBlob: canvasToBlob,
		flatten: flatten,
		supportsType: supportsType,
		setJpegDpi: setJpegDpi,
		crc32: crc32,
		makeZip: makeZip,
		uniqueNames: uniqueNames,
		download: download,
		debounce: debounce,
		icon: icon
	};

	document.addEventListener('DOMContentLoaded', mountAll);
})();
