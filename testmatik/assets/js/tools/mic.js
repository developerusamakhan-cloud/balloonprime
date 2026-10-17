/* Testmatik – Mikrofon testi. Audio never leaves the device. */
(function () {
	'use strict';
	var root = document.querySelector('[data-tm-app="mic"]');
	if (!root) { return; }

	function $(ref) { return root.querySelector('[data-ref="' + ref + '"]'); }

	var startBtn = root.querySelector('[data-action="start"]');
	var recBtn = root.querySelector('[data-action="record"]');
	var select = $('device');
	var canvas = $('scope');
	var c2d = canvas.getContext('2d');
	var stream = null, ctx = null, analyser = null, source = null, raf = 0;
	var peakDb = -Infinity, peakHoldAt = 0, peakShown = -Infinity;
	var recorder = null, audioUrl = '';

	function status(msg) { $('status').textContent = msg || ''; }

	function supported() {
		return navigator.mediaDevices && navigator.mediaDevices.getUserMedia && (window.AudioContext || window.webkitAudioContext);
	}

	function errText(err) {
		var n = err && err.name;
		if (n === 'NotAllowedError' || n === 'SecurityError') { return 'Mikrofon izni reddedildi. Adres çubuğundaki kilit simgesinden izni açıp sayfayı yenileyin.'; }
		if (n === 'NotFoundError' || n === 'OverconstrainedError') { return 'Mikrofon bulunamadı. Bağlantıyı ve sistem ses ayarlarını kontrol edin.'; }
		if (n === 'NotReadableError' || n === 'AbortError') { return 'Mikrofon başka bir uygulama tarafından kullanılıyor olabilir (Zoom, Teams, Discord…). Onu kapatıp tekrar deneyin.'; }
		return 'Mikrofon açılamadı: ' + (err && err.message ? err.message : 'bilinmeyen hata');
	}

	function stop() {
		cancelAnimationFrame(raf);
		if (recorder && recorder.state === 'recording') { recorder.stop(); }
		if (stream) { stream.getTracks().forEach(function (t) { t.stop(); }); }
		if (ctx) { ctx.close().catch(function () {}); }
		stream = ctx = analyser = source = null;
		root.classList.remove('is-live');
		$('startlabel').textContent = 'Mikrofonu başlat';
		recBtn.disabled = true;
		$('fill').style.width = '0%';
		$('level').textContent = '–';
	}

	function start(deviceId) {
		if (!supported()) { status('Tarayıcınız mikrofon erişimini desteklemiyor. Chrome, Edge, Firefox veya Safari’nin güncel sürümünü deneyin.'); return; }
		if (!window.isSecureContext) { status('Mikrofon yalnızca güvenli (https://) bağlantıda çalışır.'); return; }
		stop();
		var nr = $('nr').checked;
		var constraints = { audio: { echoCancellation: nr, noiseSuppression: nr, autoGainControl: nr } };
		if (deviceId) { constraints.audio.deviceId = { exact: deviceId }; }
		status('İzin bekleniyor…');
		navigator.mediaDevices.getUserMedia(constraints).then(function (s) {
			stream = s;
			var AC = window.AudioContext || window.webkitAudioContext;
			ctx = new AC();
			source = ctx.createMediaStreamSource(s);
			analyser = ctx.createAnalyser();
			analyser.fftSize = 2048;
			analyser.smoothingTimeConstant = 0.2;
			source.connect(analyser);
			if (ctx.state === 'suspended') { ctx.resume(); }
			var track = s.getAudioTracks()[0];
			var set = track.getSettings ? track.getSettings() : {};
			$('rate').textContent = (set.sampleRate || ctx.sampleRate).toLocaleString('tr-TR') + ' Hz';
			$('channels').textContent = String(set.channelCount || 1) + (set.channelCount === 2 ? ' (stereo)' : ' (mono)');
			$('label').textContent = track.label ? 'Kullanılan mikrofon: ' + track.label : '';
			root.classList.add('is-live');
			$('startlabel').textContent = 'Durdur';
			recBtn.disabled = typeof MediaRecorder === 'undefined';
			peakDb = -Infinity;
			status('Konuşun veya parmağınızla hafifçe mikrofona dokunun; çubuk hareket etmeli.');
			listDevices(set.deviceId);
			loop();
		}).catch(function (err) { status(errText(err)); });
	}

	function listDevices(currentId) {
		if (!navigator.mediaDevices.enumerateDevices) { return; }
		navigator.mediaDevices.enumerateDevices().then(function (devices) {
			var mics = devices.filter(function (d) { return d.kind === 'audioinput'; });
			select.innerHTML = '';
			mics.forEach(function (d, i) {
				var o = document.createElement('option');
				o.value = d.deviceId;
				o.textContent = d.label || ('Mikrofon ' + (i + 1));
				if (d.deviceId === currentId) { o.selected = true; }
				select.appendChild(o);
			});
			select.disabled = mics.length < 2;
		});
	}

	function loop() {
		if (!analyser) { return; }
		var buf = new Float32Array(analyser.fftSize);
		if (analyser.getFloatTimeDomainData) { analyser.getFloatTimeDomainData(buf); } else {
			var b8 = new Uint8Array(analyser.fftSize); analyser.getByteTimeDomainData(b8);
			for (var j = 0; j < b8.length; j++) { buf[j] = (b8[j] - 128) / 128; }
		}
		var sum = 0, max = 0;
		for (var i = 0; i < buf.length; i++) { var v = buf[i]; sum += v * v; if (Math.abs(v) > max) { max = Math.abs(v); } }
		var rms = Math.sqrt(sum / buf.length);
		var db = rms > 0 ? 20 * Math.log10(rms) : -Infinity;
		var pdb = max > 0 ? 20 * Math.log10(max) : -Infinity;
		var now = performance.now();
		if (pdb > peakShown || now - peakHoldAt > 1500) { peakShown = pdb; peakHoldAt = now; }
		if (pdb > peakDb) { peakDb = pdb; }
		var pct = function (d) { return Math.max(0, Math.min(100, ((d + 60) / 60) * 100)); };
		$('fill').style.width = pct(db) + '%';
		$('fill').classList.toggle('is-hot', db > -6);
		$('peak').style.left = pct(peakShown) + '%';
		$('level').textContent = isFinite(db) ? db.toFixed(1) + ' dB' : '–∞ dB';
		$('peakv').textContent = isFinite(peakDb) ? peakDb.toFixed(1) + ' dB' : '–';
		draw(buf);
		raf = requestAnimationFrame(loop);
	}

	function draw(buf) {
		var w = canvas.width, h = canvas.height;
		var style = getComputedStyle(root);
		c2d.clearRect(0, 0, w, h);
		c2d.strokeStyle = style.getPropertyValue('--line') || '#ddd';
		c2d.lineWidth = 1;
		c2d.beginPath(); c2d.moveTo(0, h / 2); c2d.lineTo(w, h / 2); c2d.stroke();
		c2d.strokeStyle = style.getPropertyValue('--tone') || '#059669';
		c2d.lineWidth = 2.5;
		c2d.beginPath();
		var step = buf.length / w;
		for (var x = 0; x < w; x++) {
			var y = h / 2 - buf[Math.floor(x * step)] * (h / 2) * 0.95;
			if (x === 0) { c2d.moveTo(x, y); } else { c2d.lineTo(x, y); }
		}
		c2d.stroke();
	}

	function record() {
		if (!stream || typeof MediaRecorder === 'undefined') { return; }
		var chunks = [];
		try { recorder = new MediaRecorder(stream); } catch (e) { status('Bu tarayıcı kayıt yapamıyor.'); return; }
		recorder.ondataavailable = function (e) { if (e.data && e.data.size) { chunks.push(e.data); } };
		recorder.onstop = function () {
			if (audioUrl) { URL.revokeObjectURL(audioUrl); }
			var blob = new Blob(chunks, { type: recorder.mimeType || 'audio/webm' });
			audioUrl = URL.createObjectURL(blob);
			var a = $('audio');
			a.src = audioUrl;
			a.hidden = false;
			a.play().catch(function () {});
			$('reclabel').textContent = 'Tekrar kaydet';
			recBtn.disabled = !stream;
			status('Kayıt hazır. Sesiniz net ve cızırtısız duyuluyorsa mikrofonunuz sağlıklı çalışıyor.');
		};
		recorder.start();
		recBtn.disabled = true;
		var left = 5;
		$('reclabel').textContent = 'Kaydediliyor… ' + left;
		var t = setInterval(function () {
			left--;
			if (left <= 0) {
				clearInterval(t);
				if (recorder.state === 'recording') { recorder.stop(); }
			} else { $('reclabel').textContent = 'Kaydediliyor… ' + left; }
		}, 1000);
	}

	startBtn.addEventListener('click', function () { if (stream) { stop(); status(''); } else { start(); } });
	select.addEventListener('change', function () { start(select.value); });
	$('nr').addEventListener('change', function () { if (stream) { start(select.value || undefined); } });
	recBtn.addEventListener('click', record);
	window.addEventListener('pagehide', stop);
}());
