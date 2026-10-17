/* Testmatik – Hoparlör testi: sol/sağ kanal, frekans taraması, ton üreteci (Web Audio). */
(function () {
	'use strict';
	var root = document.querySelector('[data-tm-app="speaker"]');
	if (!root) { return; }

	function $(ref) { return root.querySelector('[data-ref="' + ref + '"]'); }

	var ctx = null, master = null;
	var current = null; // { osc, gain, kind, stopAt }
	var sweepRaf = 0;

	function status(msg) { $('status').textContent = msg || ''; }

	function audio() {
		var AC = window.AudioContext || window.webkitAudioContext;
		if (!AC) { status('Tarayıcınız Web Audio desteklemiyor.'); return null; }
		if (!ctx) {
			ctx = new AC();
			master = ctx.createGain();
			master.gain.value = vol();
			master.connect(ctx.destination);
		}
		if (ctx.state === 'suspended') { ctx.resume(); }
		return ctx;
	}

	function vol() { var v = parseInt($('vol').value, 10) / 100; return v * v * 0.6; }

	// Slider 0..1000 → 20 Hz .. 20 kHz (logarithmic).
	function sliderToHz(v) { return Math.round(20 * Math.pow(1000, v / 1000)); }
	function hzToSlider(hz) { return Math.round(1000 * Math.log(hz / 20) / Math.log(1000)); }
	function fmt(hz) { return hz >= 1000 ? (hz / 1000).toFixed(hz >= 10000 ? 1 : 2).replace('.', ',') + ' kHz' : Math.round(hz) + ' Hz'; }

	function stopCurrent() {
		cancelAnimationFrame(sweepRaf);
		if (current) {
			var c = current; current = null;
			try {
				var t = ctx.currentTime;
				c.gain.gain.cancelScheduledValues(t);
				c.gain.gain.setValueAtTime(c.gain.gain.value, t);
				c.gain.gain.linearRampToValueAtTime(0, t + 0.04);
				c.osc.stop(t + 0.05);
			} catch (e) { /* already stopped */ }
		}
		root.querySelectorAll('.is-playing').forEach(function (el) { el.classList.remove('is-playing'); });
		$('sweeplabel').textContent = 'Taramayı başlat';
		$('tonelabel').textContent = 'Çal';
	}

	function makeTone(freq, pan, type) {
		var a = audio(); if (!a) { return null; }
		var osc = a.createOscillator();
		var gain = a.createGain();
		osc.type = type || 'sine';
		osc.frequency.value = freq;
		gain.gain.value = 0;
		var node = gain;
		if (a.createStereoPanner) {
			var p = a.createStereoPanner(); p.pan.value = pan; gain.connect(p); node = p;
		} else {
			// Older Safari: route to one channel with a merger.
			var merger = a.createChannelMerger(2);
			if (pan <= 0) { gain.connect(merger, 0, 0); }
			if (pan >= 0) { gain.connect(merger, 0, 1); }
			node = merger;
		}
		osc.connect(gain);
		node.connect(master);
		osc.start();
		gain.gain.linearRampToValueAtTime(1, a.currentTime + 0.03);
		return { osc: osc, gain: gain };
	}

	/* Left / both / right: three short beeps. */
	root.querySelectorAll('[data-pan]').forEach(function (btn) {
		btn.addEventListener('click', function () {
			stopCurrent();
			var pan = parseFloat(btn.getAttribute('data-pan'));
			var t = makeTone(523.25, pan, 'sine'); if (!t) { return; }
			current = t;
			btn.classList.add('is-playing');
			var now = ctx.currentTime, g = t.gain.gain;
			g.cancelScheduledValues(now);
			g.setValueAtTime(0, now);
			for (var i = 0; i < 3; i++) {
				var s = now + i * 0.45;
				g.linearRampToValueAtTime(1, s + 0.02);
				g.setValueAtTime(1, s + 0.28);
				g.linearRampToValueAtTime(0, s + 0.32);
			}
			t.osc.stop(now + 1.4);
			t.osc.onended = function () { if (current === t) { current = null; btn.classList.remove('is-playing'); } };
			status(pan < 0 ? 'Şimdi yalnızca SOL kanal çalıyor.' : (pan > 0 ? 'Şimdi yalnızca SAĞ kanal çalıyor.' : 'Şimdi iki kanal birlikte (ortada) çalıyor.'));
		});
	});

	/* Sweep 20 Hz → 20 kHz in 20 s. */
	root.querySelector('[data-action="sweep"]').addEventListener('click', function () {
		if (current && current.kind === 'sweep') { stopCurrent(); status(''); return; }
		stopCurrent();
		var t = makeTone(20, 0, 'sine'); if (!t) { return; }
		t.kind = 'sweep'; current = t;
		var start = ctx.currentTime, dur = 20;
		t.osc.frequency.setValueAtTime(20, start);
		t.osc.frequency.exponentialRampToValueAtTime(20000, start + dur);
		t.osc.stop(start + dur + 0.05);
		$('sweeplabel').textContent = 'Durdur';
		this.classList.add('is-playing');
		status('Tarama çalıyor. Sesi duymayı bıraktığınız frekansı not edin.');
		var tick = function () {
			if (current !== t) { return; }
			var p = Math.min(1, (ctx.currentTime - start) / dur);
			var hz = 20 * Math.pow(1000, p);
			$('sweepfill').style.width = (p * 100) + '%';
			$('sweepfreq').textContent = fmt(hz);
			if (p >= 1) { stopCurrent(); status('Tarama bitti.'); return; }
			sweepRaf = requestAnimationFrame(tick);
		};
		tick();
	});

	/* Tone generator. */
	var exactHz = 0; // set by preset chips so they play the exact frequency
	function freq() { return exactHz || sliderToHz(parseInt($('freq').value, 10)); }
	function showFreq() { $('freqv').textContent = fmt(freq()); }
	$('freq').addEventListener('input', function () {
		exactHz = 0;
		showFreq();
		if (current && current.kind === 'tone') { current.osc.frequency.setTargetAtTime(freq(), ctx.currentTime, 0.02); }
	});
	$('wave').addEventListener('change', function () { if (current && current.kind === 'tone') { current.osc.type = this.value; } });
	root.querySelector('[data-action="tone"]').addEventListener('click', function () {
		if (current && current.kind === 'tone') { stopCurrent(); status(''); return; }
		stopCurrent();
		var t = makeTone(freq(), 0, $('wave').value); if (!t) { return; }
		t.kind = 'tone'; current = t;
		$('tonelabel').textContent = 'Durdur';
		this.classList.add('is-playing');
	});
	root.querySelectorAll('[data-hz]').forEach(function (chip) {
		chip.addEventListener('click', function () {
			exactHz = parseInt(chip.getAttribute('data-hz'), 10);
			$('freq').value = hzToSlider(exactHz);
			showFreq();
			if (current && current.kind === 'tone') { current.osc.frequency.setTargetAtTime(freq(), ctx.currentTime, 0.02); }
		});
	});

	$('vol').addEventListener('input', function () {
		$('volv').textContent = this.value + '%';
		if (master) { master.gain.setTargetAtTime(vol(), ctx.currentTime, 0.02); }
	});

	window.addEventListener('pagehide', stopCurrent);
	showFreq();
}());
