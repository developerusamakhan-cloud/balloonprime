/* Testmatik – Mouse testi: tuşlar, tekerlek, çift tıklama (chatter), polling rate, CPS. */
(function () {
	'use strict';
	var root = document.querySelector('[data-tm-app="mouse"]');
	if (!root) { return; }

	function $(ref) { return root.querySelector('[data-ref="' + ref + '"]'); }

	var area = $('area');
	var counts = [0, 0, 0, 0, 0];
	var chatter = [0, 0, 0, 0, 0];
	var lastDown = [0, 0, 0, 0, 0];
	var lastClickAt = 0;
	var scroll = { up: 0, down: 0 };
	var threshold = 80;
	var names = ['Sol tık', 'Orta tuş', 'Sağ tık', 'Geri tuşu', 'İleri tuşu'];

	function flash(sel) {
		var el = area.querySelector(sel);
		if (!el) { return; }
		el.classList.add('is-on');
		clearTimeout(el._t);
		el._t = setTimeout(function () { el.classList.remove('is-on'); }, 160);
	}

	function render() {
		counts.forEach(function (n, b) {
			root.querySelector('[data-count="' + b + '"]').textContent = String(n);
			var c = root.querySelector('[data-chatter="' + b + '"]');
			c.textContent = chatter[b] ? '⚠ ' + chatter[b] : '';
			var row = root.querySelector('[data-row="' + b + '"]');
			row.classList.toggle('is-ok', n > 0);
			row.classList.toggle('is-bad', chatter[b] > 0);
		});
		$('scroll').textContent = scroll.up + ' / ' + scroll.down;
		var total = chatter.reduce(function (a, b) { return a + b; }, 0);
		$('chatter').textContent = String(total);
	}

	function onDown(e) {
		var b = e.button;
		if (b < 0 || b > 4) { return; }
		e.preventDefault();
		var now = performance.now();
		if (lastClickAt) { $('gap').textContent = Math.round(now - lastClickAt) + ' ms'; }
		lastClickAt = now;
		if (lastDown[b] && now - lastDown[b] < threshold) {
			chatter[b]++;
			$('chattertext').textContent = names[b] + ': iki tıklama arası ' + Math.round(now - lastDown[b]) + ' ms (eşik ' + threshold + ' ms). Tek bastıysanız bu, yıpranmış bir mikro anahtarın (çift tıklama sorunu) belirtisidir.';
			$('chatteralert').hidden = false;
		}
		lastDown[b] = now;
		counts[b]++;
		area.querySelectorAll('[data-btn="' + b + '"]').forEach(function (el) { el.classList.add('is-down', 'is-ok'); });
		render();
	}

	function onUp(e) {
		var b = e.button;
		if (b < 0 || b > 4) { return; }
		e.preventDefault();
		area.querySelectorAll('[data-btn="' + b + '"]').forEach(function (el) { el.classList.remove('is-down'); });
	}

	area.addEventListener('mousedown', onDown);
	area.addEventListener('mouseup', onUp);
	// Stop the right-click menu and the browser back/forward action on side buttons.
	area.addEventListener('contextmenu', function (e) { e.preventDefault(); });
	area.addEventListener('auxclick', function (e) { e.preventDefault(); });
	window.addEventListener('mouseup', function (e) {
		if ((e.button === 3 || e.button === 4) && area.contains(e.target)) { e.preventDefault(); }
	});
	area.addEventListener('wheel', function (e) {
		e.preventDefault();
		if (e.deltaY < 0) { scroll.up++; flash('[data-scroll="up"]'); } else if (e.deltaY > 0) { scroll.down++; flash('[data-scroll="down"]'); }
		area.querySelector('[data-btn="1"]').classList.add('is-ok');
		render();
	}, { passive: false });

	/* Polling rate: count raw pointer events per second while the mouse moves. */
	var evCount = 0, winStart = performance.now(), hzMax = 0, idleTimer = 0;
	var rawType = 'onpointerrawupdate' in window ? 'pointerrawupdate' : 'pointermove';
	area.addEventListener(rawType, function (e) {
		if (e.pointerType && e.pointerType !== 'mouse') { return; }
		var n = 1;
		if (rawType === 'pointermove' && e.getCoalescedEvents) { n = e.getCoalescedEvents().length || 1; }
		evCount += n;
		var now = performance.now();
		var dt = now - winStart;
		if (dt >= 500) {
			var hz = Math.round(evCount / (dt / 1000));
			$('hz').textContent = String(hz);
			if (hz > hzMax && hz < 9000) { hzMax = hz; $('hzmax').textContent = String(hzMax); }
			evCount = 0; winStart = now;
		}
		clearTimeout(idleTimer);
		idleTimer = setTimeout(function () { evCount = 0; winStart = performance.now(); $('hz').textContent = '0'; }, 400);
	});

	$('thr').addEventListener('input', function () {
		threshold = parseInt(this.value, 10);
		$('thrv').textContent = threshold + ' ms';
	});

	/* CPS test */
	var pad = $('cpspad'), cpsOn = false, cpsClicks = 0, cpsStart = 0, cpsTimer = 0;
	pad.addEventListener('mousedown', function (e) {
		if (e.button !== 0) { return; }
		e.preventDefault();
		if (!cpsOn) {
			cpsOn = true; cpsClicks = 0; cpsStart = performance.now();
			pad.classList.add('is-running');
			cpsTimer = setInterval(function () {
				var t = (performance.now() - cpsStart) / 1000;
				if (t >= 5) {
					clearInterval(cpsTimer); cpsOn = false;
					pad.classList.remove('is-running');
					$('cpsmain').textContent = (cpsClicks / 5).toFixed(1) + ' CPS';
					$('cpssub').textContent = cpsClicks + ' tıklama · tekrar için tıklayın';
				} else {
					$('cpssub').textContent = (5 - t).toFixed(1) + ' sn kaldı';
				}
			}, 100);
		}
		cpsClicks++;
		$('cpsmain').textContent = String(cpsClicks);
	});
	pad.addEventListener('click', function (e) { e.preventDefault(); });

	root.querySelector('[data-action="reset"]').addEventListener('click', function () {
		counts = [0, 0, 0, 0, 0]; chatter = [0, 0, 0, 0, 0]; lastDown = [0, 0, 0, 0, 0]; scroll = { up: 0, down: 0 };
		hzMax = 0; lastClickAt = 0;
		$('hz').textContent = '0'; $('hzmax').textContent = '0'; $('gap').textContent = '–';
		$('chatteralert').hidden = true;
		area.querySelectorAll('.is-ok').forEach(function (el) { el.classList.remove('is-ok'); });
		$('cpsmain').textContent = 'Başlat'; $('cpssub').textContent = 'Tıklayarak başlayın';
		render();
	});

	render();
}());
