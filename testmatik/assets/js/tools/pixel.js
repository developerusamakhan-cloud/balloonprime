/* Testmatik – Ölü piksel testi ve piksel onarıcı. */
(function () {
	'use strict';
	var root = document.querySelector('[data-tm-app="pixel"]');
	if (!root) { return; }

	function $(ref) { return root.querySelector('[data-ref="' + ref + '"]'); }

	var colors = JSON.parse($('colors').textContent); // [[hex, name], ...]
	var stage = $('stage');
	var hud = $('hud');
	var index = 0;
	var autoTimer = null;
	var hudTimer = null;
	var touchX = null;

	// The stage must live on <body> so position:fixed is never clipped by a parent.
	document.body.appendChild(stage);
	var fixbox = $('fixbox');
	document.body.appendChild(fixbox);

	function paint() {
		stage.style.background = colors[index][0];
		stage.querySelector('[data-ref="cname"]').textContent = colors[index][1] + ' (' + (index + 1) + '/' + colors.length + ')';
		// Dark text on light colours.
		var light = ['#ffffff', '#00ff00', '#00ffff', '#ffff00'].indexOf(colors[index][0]) !== -1;
		stage.classList.toggle('is-light', light);
		showHud();
	}

	function showHud() {
		hud.classList.add('is-visible');
		clearTimeout(hudTimer);
		hudTimer = setTimeout(function () { hud.classList.remove('is-visible'); }, 1800);
	}

	function next(step) {
		index = (index + step + colors.length) % colors.length;
		paint();
	}

	function setAuto(on) {
		clearInterval(autoTimer);
		autoTimer = null;
		if (on) { autoTimer = setInterval(function () { next(1); }, 3000); }
		$('auto').checked = !!on;
	}

	function isOpen() { return !stage.hidden; }

	function open(at) {
		index = typeof at === 'number' ? at : 0;
		stage.hidden = false;
		document.documentElement.classList.add('tm-noscroll');
		paint();
		stage.focus();
		var req = stage.requestFullscreen || stage.webkitRequestFullscreen;
		if (req) {
			try { var p = req.call(stage); if (p && p.catch) { p.catch(function () {}); } } catch (e) { /* overlay fallback */ }
		}
		if ($('auto').checked) { setAuto(true); }
	}

	function close() {
		setAuto(false);
		stage.hidden = true;
		document.documentElement.classList.remove('tm-noscroll');
		var fs = document.fullscreenElement || document.webkitFullscreenElement;
		if (fs) {
			var exit = document.exitFullscreen || document.webkitExitFullscreen;
			try { exit.call(document); } catch (e) { /* ignore */ }
		}
		root.querySelector('[data-action="start"]').focus();
	}

	root.querySelector('[data-action="start"]').addEventListener('click', function () { open(0); });
	root.querySelectorAll('[data-color-index]').forEach(function (b) {
		b.addEventListener('click', function () { open(parseInt(b.getAttribute('data-color-index'), 10)); });
	});
	$('auto').addEventListener('change', function () { if (isOpen()) { setAuto(this.checked); } });

	stage.addEventListener('click', function (e) {
		if (e.target.closest('[data-action="exit"]')) { close(); return; }
		next(1);
	});
	stage.addEventListener('mousemove', showHud);
	stage.addEventListener('touchstart', function (e) { touchX = e.touches[0].clientX; }, { passive: true });
	stage.addEventListener('touchend', function (e) {
		if (touchX === null) { return; }
		var dx = e.changedTouches[0].clientX - touchX;
		touchX = null;
		if (Math.abs(dx) > 40) { e.preventDefault(); next(dx < 0 ? 1 : -1); }
	});

	document.addEventListener('keydown', function (e) {
		if (!isOpen()) { return; }
		switch (e.key) {
			case 'Escape': e.preventDefault(); close(); break;
			case 'ArrowRight': case 'ArrowDown': case ' ': case 'Enter': e.preventDefault(); next(1); break;
			case 'ArrowLeft': case 'ArrowUp': case 'Backspace': e.preventDefault(); next(-1); break;
			case 'a': case 'A': e.preventDefault(); setAuto(!autoTimer); showHud(); break;
		}
	});
	// Leaving browser full screen with Esc also closes the test.
	['fullscreenchange', 'webkitfullscreenchange'].forEach(function (ev) {
		document.addEventListener(ev, function () {
			if (!(document.fullscreenElement || document.webkitFullscreenElement) && isOpen()) { close(); }
		});
	});

	/* ---------- Stuck pixel fixer ---------- */
	var consent = $('consent');
	var fixBtn = root.querySelector('[data-action="fixer"]');
	var canvas = fixbox.querySelector('canvas'); // fixbox now lives on <body>, outside root
	var ctx = canvas.getContext('2d');
	var fixTimer = null;
	var palette = ['#ff0000', '#00ff00', '#0000ff', '#ffffff', '#000000'];

	consent.addEventListener('change', function () { fixBtn.disabled = !consent.checked; });

	function sizeFixer() {
		var s = parseInt($('fixsize').value, 10);
		canvas.width = s; canvas.height = s;
		fixbox.style.width = s + 'px'; fixbox.style.height = s + 'px';
	}

	function flash() {
		var cell = 4;
		for (var y = 0; y < canvas.height; y += cell) {
			for (var x = 0; x < canvas.width; x += cell) {
				ctx.fillStyle = palette[(Math.random() * palette.length) | 0];
				ctx.fillRect(x, y, cell, cell);
			}
		}
	}

	function openFixer() {
		if (!consent.checked) { return; }
		sizeFixer();
		fixbox.hidden = false;
		var s = canvas.width;
		fixbox.style.left = Math.max(8, (window.innerWidth - s) / 2) + 'px';
		fixbox.style.top = Math.max(8, (window.innerHeight - s) / 2) + 'px';
		clearInterval(fixTimer);
		fixTimer = setInterval(flash, 50);
	}

	function closeFixer() {
		clearInterval(fixTimer);
		fixTimer = null;
		fixbox.hidden = true;
	}

	fixBtn.addEventListener('click', openFixer);
	$('fixsize').addEventListener('input', function () { if (!fixbox.hidden) { sizeFixer(); } });
	fixbox.querySelector('[data-action="fixclose"]').addEventListener('click', closeFixer);

	// Drag the fixer with mouse or finger.
	var drag = null;
	fixbox.addEventListener('pointerdown', function (e) {
		if (e.target.closest('button')) { return; }
		drag = { x: e.clientX - fixbox.offsetLeft, y: e.clientY - fixbox.offsetTop };
		fixbox.setPointerCapture(e.pointerId);
	});
	fixbox.addEventListener('pointermove', function (e) {
		if (!drag) { return; }
		var s = fixbox.offsetWidth;
		fixbox.style.left = Math.min(window.innerWidth - s, Math.max(0, e.clientX - drag.x)) + 'px';
		fixbox.style.top = Math.min(window.innerHeight - s, Math.max(0, e.clientY - drag.y)) + 'px';
	});
	fixbox.addEventListener('pointerup', function () { drag = null; });
	document.addEventListener('keydown', function (e) { if (e.key === 'Escape' && !fixbox.hidden && stage.hidden) { closeFixer(); } });
}());
