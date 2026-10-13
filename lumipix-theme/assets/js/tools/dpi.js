/**
 * DPI checker and changer.
 *
 * JPG: reads/writes the JFIF density and the EXIF X/YResolution tags.
 * PNG: reads/writes the pHYs chunk.
 * Pixels are never re-encoded for JPG and PNG; other formats become PNG.
 */
(function () {
	'use strict';
	var L = window.Lumipix;
	if (!L) return;

	var INCH = 2.54;

	/* ------------------------------------------------------------ Reading */

	function isJpeg(b) {
		return b[0] === 0xff && b[1] === 0xd8;
	}
	function isPng(b) {
		return b[0] === 0x89 && b[1] === 0x50 && b[2] === 0x4e && b[3] === 0x47;
	}

	/** Walk JPEG segments until the image data starts. */
	function jpegSegments(b) {
		var out = [];
		var i = 2;
		while (i + 4 <= b.length && b[i] === 0xff) {
			var marker = b[i + 1];
			if (marker === 0xd8 || (marker >= 0xd0 && marker <= 0xd7) || marker === 0x01) {
				i += 2;
				continue;
			}
			if (marker === 0xda || marker === 0xd9) break;
			var len = (b[i + 2] << 8) | b[i + 3];
			out.push({ marker: marker, start: i, data: i + 4, len: len });
			i += 2 + len;
		}
		return out;
	}

	function isJfif(b, seg) {
		return seg.marker === 0xe0 && b[seg.data] === 0x4a && b[seg.data + 1] === 0x46 && b[seg.data + 2] === 0x49 && b[seg.data + 3] === 0x46 && b[seg.data + 4] === 0;
	}
	function isExif(b, seg) {
		return seg.marker === 0xe1 && b[seg.data] === 0x45 && b[seg.data + 1] === 0x78 && b[seg.data + 2] === 0x69 && b[seg.data + 3] === 0x66;
	}

	/** EXIF IFD0 resolution tags: { x:{entry,offset}, y:{…}, unit:{entry} , view } */
	function exifResolution(b, seg) {
		var t = seg.data + 6;
		var view = new DataView(b.buffer, b.byteOffset, b.byteLength);
		var le = b[t] === 0x49;
		if (!le && b[t] !== 0x4d) return null;
		var ifd = t + view.getUint32(t + 4, le);
		if (ifd + 2 > b.length) return null;
		var count = view.getUint16(ifd, le);
		var res = { t: t, le: le, view: view };
		for (var k = 0; k < count; k++) {
			var e = ifd + 2 + k * 12;
			if (e + 12 > b.length) break;
			var tag = view.getUint16(e, le);
			if (tag === 0x011a) res.x = t + view.getUint32(e + 8, le);
			else if (tag === 0x011b) res.y = t + view.getUint32(e + 8, le);
			else if (tag === 0x0128) res.unit = e + 8;
		}
		return res;
	}

	function rational(view, off, le) {
		var n = view.getUint32(off, le);
		var d = view.getUint32(off + 4, le);
		return d ? n / d : 0;
	}

	function pngChunks(b) {
		var out = [];
		var view = new DataView(b.buffer, b.byteOffset, b.byteLength);
		var i = 8;
		while (i + 12 <= b.length) {
			var len = view.getUint32(i);
			var type = String.fromCharCode(b[i + 4], b[i + 5], b[i + 6], b[i + 7]);
			out.push({ type: type, start: i, data: i + 8, len: len });
			if (type === 'IEND') break;
			i += 12 + len;
		}
		return out;
	}

	/** { dpi, source } or { dpi: 0 } */
	function readDpi(b) {
		if (isJpeg(b)) {
			var found = { dpi: 0, sources: [] };
			jpegSegments(b).forEach(function (seg) {
				if (isJfif(b, seg)) {
					var units = b[seg.data + 7];
					var x = (b[seg.data + 8] << 8) | b[seg.data + 9];
					if (units === 1 && x) {
						found.dpi = found.dpi || x;
						found.sources.push('JFIF');
					} else if (units === 2 && x) {
						found.dpi = found.dpi || x * INCH;
						found.sources.push('JFIF');
					}
				} else if (isExif(b, seg)) {
					try {
						var r = exifResolution(b, seg);
						if (r && r.x) {
							var unit = r.unit ? r.view.getUint16(r.unit, r.le) : 2;
							var v = rational(r.view, r.x, r.le);
							if (v) {
								var d = unit === 3 ? v * INCH : v;
								// EXIF is what Windows and Photoshop show first.
								found.dpi = d;
								found.sources.unshift('EXIF');
							}
						}
					} catch (e) {}
				}
			});
			return found;
		}
		if (isPng(b)) {
			var view = new DataView(b.buffer, b.byteOffset, b.byteLength);
			var phys = pngChunks(b).filter(function (c) {
				return c.type === 'pHYs';
			})[0];
			if (phys && b[phys.data + 8] === 1) {
				return { dpi: view.getUint32(phys.data) * 0.0254, sources: ['PNG pHYs'] };
			}
			return { dpi: 0, sources: [] };
		}
		return { dpi: 0, sources: [] };
	}

	/* ------------------------------------------------------------ Writing */

	function concat(parts) {
		var total = parts.reduce(function (s, p) {
			return s + p.length;
		}, 0);
		var out = new Uint8Array(total);
		var o = 0;
		parts.forEach(function (p) {
			out.set(p, o);
			o += p.length;
		});
		return out;
	}

	function writeJpegDpi(src, dpi) {
		var b = new Uint8Array(src);
		var d = Math.max(1, Math.min(65535, Math.round(dpi)));
		var segs = jpegSegments(b);
		var hasJfif = false;
		segs.forEach(function (seg) {
			if (isJfif(b, seg)) {
				hasJfif = true;
				b[seg.data + 7] = 1;
				b[seg.data + 8] = d >> 8;
				b[seg.data + 9] = d & 0xff;
				b[seg.data + 10] = d >> 8;
				b[seg.data + 11] = d & 0xff;
			} else if (isExif(b, seg)) {
				try {
					var r = exifResolution(b, seg);
					if (r) {
						[r.x, r.y].forEach(function (off) {
							if (off && off + 8 <= b.length) {
								r.view.setUint32(off, d, r.le);
								r.view.setUint32(off + 4, 1, r.le);
							}
						});
						if (r.unit) r.view.setUint16(r.unit, 2, r.le);
					}
				} catch (e) {}
			}
		});
		if (hasJfif) return b;
		var app0 = new Uint8Array([0xff, 0xe0, 0x00, 0x10, 0x4a, 0x46, 0x49, 0x46, 0x00, 0x01, 0x01, 0x01, d >> 8, d & 0xff, d >> 8, d & 0xff, 0x00, 0x00]);
		return concat([b.subarray(0, 2), app0, b.subarray(2)]);
	}

	function writePngDpi(src, dpi) {
		var b = new Uint8Array(src);
		var ppm = Math.round(dpi / 0.0254);
		var chunk = new Uint8Array(21);
		var view = new DataView(chunk.buffer);
		view.setUint32(0, 9);
		chunk.set([0x70, 0x48, 0x59, 0x73], 4); // pHYs
		view.setUint32(8, ppm);
		view.setUint32(12, ppm);
		chunk[16] = 1;
		view.setUint32(17, L.crc32(chunk.subarray(4, 17)));
		var chunks = pngChunks(b);
		var phys = chunks.filter(function (c) {
			return c.type === 'pHYs';
		})[0];
		if (phys) {
			return concat([b.subarray(0, phys.start), chunk, b.subarray(phys.start + 12 + phys.len)]);
		}
		var idat = chunks.filter(function (c) {
			return c.type === 'IDAT';
		})[0];
		var at = idat ? idat.start : 33;
		return concat([b.subarray(0, at), chunk, b.subarray(at)]);
	}

	/* ------------------------------------------------------------ Helpers */

	function printSize(w, h, dpi) {
		var wi = w / dpi;
		var hi = h / dpi;
		var r1 = function (v) {
			return (Math.round(v * 10) / 10).toString();
		};
		return r1(wi * INCH) + ' × ' + r1(hi * INCH) + ' cm (' + r1(wi) + ' × ' + r1(hi) + ' in)';
	}

	var PRINTS = [
		{ label: 'A4', w: 8.27, h: 11.69 },
		{ label: '5×7 in', w: 5, h: 7 },
		{ label: '4×6 in', w: 4, h: 6 },
		{ label: '35×45 mm', w: 1.378, h: 1.772 }
	];

	function biggestPrint(w, h) {
		var lw = Math.max(w, h) / 300;
		var sw = Math.min(w, h) / 300;
		for (var i = 0; i < PRINTS.length; i++) {
			var p = PRINTS[i];
			if (lw >= Math.max(p.w, p.h) * 0.98 && sw >= Math.min(p.w, p.h) * 0.98) return p.label;
		}
		return '';
	}

	function dims(file, bytes) {
		var b = new Uint8Array(bytes);
		if (isPng(b)) {
			var v = new DataView(bytes);
			return Promise.resolve({ w: v.getUint32(16), h: v.getUint32(20) });
		}
		return L.loadImage(file).then(function (img) {
			var r = { w: img.width, h: img.height };
			if (img.source.close) img.source.close();
			if (img.url) URL.revokeObjectURL(img.url);
			return r;
		});
	}

	/* ---------------------------------------------------------------- App */

	L.register('dpi', function (el, config) {
		var check = config.mode === 'check';
		var dpiInput = el.querySelector('[data-opt="dpi"]');
		var quick = el.querySelectorAll('[data-dpi-quick]');
		var changeUrl = config.changeUrl || '';

		function targetDpi() {
			var v = parseFloat(dpiInput && dpiInput.value);
			return Math.max(1, Math.min(2400, v || 300));
		}

		function syncQuick() {
			quick.forEach(function (b) {
				b.classList.toggle('is-active', parseFloat(b.getAttribute('data-dpi-quick')) === targetDpi());
			});
		}

		var app = L.createApp(el, {
			multiple: true,
			zipName: 'lumipix-dpi',
			summary: check
				? function (ok) {
						return ok.length + ' ' + (ok.length === 1 ? L.t('imageChecked', 'image checked') : L.t('imagesChecked', 'images checked'));
				  }
				: null,
			process: function (item) {
				var file = item.file;
				return file.arrayBuffer().then(function (buf) {
					var b = new Uint8Array(buf);
					return dims(file, buf).then(function (size) {
						var px = size.w + ' × ' + size.h + ' px';
						if (check) {
							var info = readDpi(b);
							var best = biggestPrint(size.w, size.h);
							var meta =
								(info.dpi
									? '<strong>' + Math.round(info.dpi) + ' DPI</strong> <span class="muted">(' + L.escapeHtml(info.sources.join(' + ')) + ')</span>'
									: '<strong>' + L.escapeHtml(L.t('noDpi', 'No DPI stored')) + '</strong> <span class="muted">' + L.escapeHtml(L.t('noDpiHint', '(apps usually assume 72 or 96)')) + '</span>') +
								' · ' + px +
								(info.dpi ? '<br>' + L.escapeHtml(L.t('printsAt', 'Prints at')) + ' ' + printSize(size.w, size.h, info.dpi) : '') +
								'<br>' + L.escapeHtml(L.t('sharpUpTo', 'Sharp up to')) + ' ' + printSize(size.w, size.h, 300) + ' ' + L.escapeHtml(L.t('at300', 'at 300 DPI')) +
								(best ? ' · ' + L.escapeHtml(L.t('bigEnough', 'big enough for')) + ' ' + L.escapeHtml(best) : '');
							var good = info.dpi >= 299;
							return {
								blob: null,
								meta: meta,
								badge: '<span class="badge ' + (good ? 'badge--ok' : 'badge--warn') + '">' + (info.dpi ? Math.round(info.dpi) + ' DPI' : L.escapeHtml(L.t('notSet', 'Not set'))) + '</span>',
								action: changeUrl ? { href: changeUrl, label: L.t('changeDpi', 'Change DPI') } : null
							};
						}
						var dpi = targetDpi();
						var job;
						if (isJpeg(b)) {
							job = Promise.resolve({ bytes: writeJpegDpi(buf, dpi), type: 'image/jpeg' });
						} else if (isPng(b)) {
							job = Promise.resolve({ bytes: writePngDpi(buf, dpi), type: 'image/png' });
						} else {
							job = L.loadImage(file).then(function (img) {
								var c = L.makeCanvas(img.width, img.height);
								c.getContext('2d').drawImage(img.source, 0, 0);
								return L.canvasToBlob(c, 'image/png').then(function (blob) {
									return blob.arrayBuffer().then(function (pb) {
										return { bytes: writePngDpi(pb, dpi), type: 'image/png' };
									});
								});
							});
						}
						return job.then(function (res) {
							var blob = new Blob([res.bytes], { type: res.type });
							return {
								blob: blob,
								name: L.renameFile(file.name, res.type, Math.round(dpi) + 'dpi'),
								meta: '<strong>' + Math.round(dpi) + ' DPI</strong> · ' + px + '<br>' + L.escapeHtml(L.t('printsAt', 'Prints at')) + ' ' + printSize(size.w, size.h, dpi),
								badge: '<span class="badge badge--ok">' + L.icon('check') + ' ' + L.escapeHtml(res.type === file.type ? L.t('noRecompress', 'No re-compression') : L.t('convertedPng', 'Saved as PNG')) + '</span>'
							};
						});
					});
				});
			}
		});

		if (dpiInput) {
			dpiInput.addEventListener('input', function () {
				syncQuick();
				app.rerun();
			});
			quick.forEach(function (b) {
				b.addEventListener('click', function () {
					dpiInput.value = b.getAttribute('data-dpi-quick');
					syncQuick();
					app.rerun();
				});
			});
			syncQuick();
		}
	});

	L.readDpi = readDpi;
})();
