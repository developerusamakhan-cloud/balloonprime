/**
 * Image to PDF: one image per page, scaled to fit and centred.
 * The PDF is written by hand (JPEG images embedded with DCTDecode), so no
 * library is needed and nothing leaves the device.
 */
(function () {
	'use strict';
	var L = window.Lumipix;
	if (!L) return;

	var PAGES = { a4: [595.28, 841.89], letter: [612, 792] };
	var QUALITY = {
		high: { q: 0.92, max: 3508 },
		balanced: { q: 0.85, max: 2480 },
		small: { q: 0.72, max: 1600 }
	};

	/** Encode one image as JPEG bytes no larger than `max` on the long side. */
	function encode(file, preset) {
		return L.loadImage(file).then(function (img) {
			var k = Math.min(1, preset.max / Math.max(img.width, img.height));
			var w = Math.max(1, Math.round(img.width * k));
			var h = Math.max(1, Math.round(img.height * k));
			var canvas = k < 1 ? L.resample(img.source, img.width, img.height, w, h) : (function () {
				var c = L.makeCanvas(w, h);
				c.getContext('2d').drawImage(img.source, 0, 0);
				return c;
			})();
			if (img.source.close) img.source.close();
			if (img.url) URL.revokeObjectURL(img.url);
			return L.canvasToBlob(L.flatten(canvas, '#ffffff'), 'image/jpeg', preset.q).then(function (blob) {
				return blob.arrayBuffer().then(function (buf) {
					return { bytes: new Uint8Array(buf), w: w, h: h, pxW: img.width, pxH: img.height };
				});
			});
		});
	}

	function num(n) {
		return (Math.round(n * 100) / 100).toString();
	}

	/** Assemble a PDF from encoded pages. */
	function buildPdf(images, opts) {
		var enc = new TextEncoder();
		var parts = [];
		var offsets = [];
		var length = 0;
		function push(chunk) {
			var bytes = typeof chunk === 'string' ? enc.encode(chunk) : chunk;
			parts.push(bytes);
			length += bytes.length;
		}
		function obj(id, body) {
			offsets[id] = length;
			push(id + ' 0 obj\n');
			body();
			push('\nendobj\n');
		}

		var margin = parseFloat(opts.margin) || 0;
		var pageIds = [];
		push('%PDF-1.4\n');
		push(new Uint8Array([0x25, 0xe2, 0xe3, 0xcf, 0xd3, 0x0a]));

		images.forEach(function (im, i) {
			var base = 3 + i * 3;
			// Page size in points (96 px per inch for "same as image").
			var imgW = im.pxW * 0.75;
			var imgH = im.pxH * 0.75;
			var pw;
			var ph;
			if (opts.page === 'fit') {
				pw = imgW + margin * 2;
				ph = imgH + margin * 2;
			} else {
				var size = PAGES[opts.page] || PAGES.a4;
				var landscape = opts.orient === 'landscape' || (opts.orient === 'auto' && im.w > im.h);
				pw = landscape ? size[1] : size[0];
				ph = landscape ? size[0] : size[1];
			}
			var aw = Math.max(1, pw - margin * 2);
			var ah = Math.max(1, ph - margin * 2);
			var s = Math.min(aw / imgW, ah / imgH);
			var dw = imgW * s;
			var dh = imgH * s;
			var dx = (pw - dw) / 2;
			var dy = (ph - dh) / 2;
			var content = 'q ' + num(dw) + ' 0 0 ' + num(dh) + ' ' + num(dx) + ' ' + num(dy) + ' cm /Im' + i + ' Do Q';

			pageIds.push(base);
			obj(base, function () {
				push('<< /Type /Page /Parent 2 0 R /MediaBox [0 0 ' + num(pw) + ' ' + num(ph) + '] /Resources << /XObject << /Im' + i + ' ' + (base + 2) + ' 0 R >> >> /Contents ' + (base + 1) + ' 0 R >>');
			});
			obj(base + 1, function () {
				push('<< /Length ' + content.length + ' >>\nstream\n' + content + '\nendstream');
			});
			obj(base + 2, function () {
				push('<< /Type /XObject /Subtype /Image /Width ' + im.w + ' /Height ' + im.h + ' /ColorSpace /DeviceRGB /BitsPerComponent 8 /Filter /DCTDecode /Length ' + im.bytes.length + ' >>\nstream\n');
				push(im.bytes);
				push('\nendstream');
			});
		});

		obj(1, function () {
			push('<< /Type /Catalog /Pages 2 0 R >>');
		});
		obj(2, function () {
			push('<< /Type /Pages /Kids [' + pageIds.map(function (id) { return id + ' 0 R'; }).join(' ') + '] /Count ' + pageIds.length + ' >>');
		});

		var total = 3 + images.length * 3;
		var xref = length;
		var table = 'xref\n0 ' + total + '\n0000000000 65535 f \n';
		for (var id = 1; id < total; id++) {
			table += String(offsets[id]).padStart(10, '0') + ' 00000 n \n';
		}
		push(table);
		push('trailer\n<< /Size ' + total + ' /Root 1 0 R /Info << /Producer (Lumi Pix) >> >>\nstartxref\n' + xref + '\n%%EOF\n');
		return new Blob(parts, { type: 'application/pdf' });
	}

	L.register('pdf', function (el) {
		var list = el.querySelector('[data-list]');
		var createBtn = el.querySelector('[data-pdf-create]');
		var rows = []; // { item, li }
		var dragging = null;
		var building = false;

		function renumber() {
			rows.forEach(function (r, i) {
				r.li.querySelector('.result__page').textContent = i + 1;
				r.li.querySelector('[data-up]').disabled = i === 0;
				r.li.querySelector('[data-down]').disabled = i === rows.length - 1;
			});
			createBtn.disabled = !rows.length || building;
			app.announce(rows.length ? rows.length + ' ' + (rows.length === 1 ? L.t('page', 'page') : L.t('pages', 'pages')) : '');
		}

		function move(row, delta) {
			var i = rows.indexOf(row);
			var j = i + delta;
			if (j < 0 || j >= rows.length) return;
			rows.splice(i, 1);
			rows.splice(j, 0, row);
			list.innerHTML = '';
			rows.forEach(function (r) {
				list.appendChild(r.li);
			});
			renumber();
		}

		function remove(row) {
			var i = rows.indexOf(row);
			if (i < 0) return;
			rows.splice(i, 1);
			row.li.remove();
			URL.revokeObjectURL(row.url);
			var all = app.items();
			var k = all.indexOf(row.item);
			if (k >= 0) all.splice(k, 1);
			if (!rows.length) app.clear();
			else renumber();
		}

		function addRow(item) {
			var li = document.createElement('li');
			li.className = 'result result--page';
			li.draggable = true;
			var url = URL.createObjectURL(item.file);
			li.innerHTML =
				'<span class="result__page" aria-hidden="true"></span>' +
				'<div class="result__thumb"><img alt="" src="' + url + '"></div>' +
				'<div class="result__info"><p class="result__name"></p><p class="result__meta"></p></div>' +
				'<div class="result__actions">' +
				'<button type="button" class="icon-btn icon-btn--sm" data-up aria-label="' + L.escapeHtml(L.t('moveUp', 'Move up')) + '">↑</button>' +
				'<button type="button" class="icon-btn icon-btn--sm" data-down aria-label="' + L.escapeHtml(L.t('moveDown', 'Move down')) + '">↓</button>' +
				'<button type="button" class="icon-btn icon-btn--sm" data-remove aria-label="' + L.escapeHtml(L.t('remove', 'Remove')) + '">×</button>' +
				'</div>';
			li.querySelector('.result__name').textContent = item.file.name;
			li.querySelector('.result__meta').textContent = L.formatBytes(item.file.size);
			var row = { item: item, li: li, url: url };
			li.querySelector('[data-up]').addEventListener('click', function () {
				move(row, -1);
			});
			li.querySelector('[data-down]').addEventListener('click', function () {
				move(row, 1);
			});
			li.querySelector('[data-remove]').addEventListener('click', function () {
				remove(row);
			});
			li.addEventListener('dragstart', function (e) {
				dragging = row;
				li.classList.add('is-dragging');
				if (e.dataTransfer) e.dataTransfer.effectAllowed = 'move';
			});
			li.addEventListener('dragend', function () {
				dragging = null;
				li.classList.remove('is-dragging');
			});
			li.addEventListener('dragover', function (e) {
				if (!dragging || dragging === row) return;
				e.preventDefault();
				var rect = li.getBoundingClientRect();
				var after = e.clientY > rect.top + rect.height / 2;
				var from = rows.indexOf(dragging);
				rows.splice(from, 1);
				var to = rows.indexOf(row) + (after ? 1 : 0);
				rows.splice(to, 0, dragging);
				list.innerHTML = '';
				rows.forEach(function (r) {
					list.appendChild(r.li);
				});
				renumber();
			});
			rows.push(row);
			list.appendChild(li);
		}

		var app = L.createApp(el, {
			multiple: true,
			onFiles: function (added) {
				added.forEach(addRow);
				renumber();
			},
			onClear: function () {
				rows.forEach(function (r) {
					URL.revokeObjectURL(r.url);
				});
				rows = [];
				createBtn.disabled = true;
			}
		});

		createBtn.addEventListener('click', function () {
			if (!rows.length || building) return;
			building = true;
			createBtn.disabled = true;
			el.classList.add('is-working');
			var opts = L.readOptions(el);
			var preset = QUALITY[opts.quality] || QUALITY.balanced;
			var encoded = [];
			var chain = Promise.resolve();
			rows.forEach(function (r, i) {
				chain = chain.then(function () {
					app.announce(L.t('processing') + ' ' + (i + 1) + ' / ' + rows.length);
					return encode(r.item.file, preset).then(function (res) {
						encoded.push(res);
						r.li.querySelector('.result__meta').textContent = L.formatBytes(r.item.file.size) + ' · ' + res.pxW + '×' + res.pxH;
					});
				});
			});
			chain
				.then(function () {
					var pdf = buildPdf(encoded, opts);
					var first = rows[0].item.file.name.replace(/\.[^.]+$/, '');
					var name = (rows.length > 1 ? first + '-and-' + (rows.length - 1) + '-more' : first) + '.pdf';
					L.download(pdf, name);
					app.announce('✓ ' + L.t('pdfReady', 'PDF ready') + ' · ' + rows.length + ' ' + (rows.length === 1 ? L.t('page', 'page') : L.t('pages', 'pages')) + ' · ' + L.formatBytes(pdf.size));
				})
				.catch(function (err) {
					app.announce((err && err.message) || L.t('error'));
				})
				.then(function () {
					building = false;
					createBtn.disabled = !rows.length;
					el.classList.remove('is-working');
				});
		});
		createBtn.disabled = true;
	});
})();
