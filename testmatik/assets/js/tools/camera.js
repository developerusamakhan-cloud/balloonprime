/* Testmatik – Kamera testi. Video never leaves the device. */
(function () {
	'use strict';
	var root = document.querySelector('[data-tm-app="camera"]');
	if (!root) { return; }

	function $(ref) { return root.querySelector('[data-ref="' + ref + '"]'); }

	var video = $('video');
	var select = $('device');
	var startBtn = root.querySelector('[data-action="start"]');
	var snapBtn = root.querySelector('[data-action="snap"]');
	var stopBtn = root.querySelector('[data-action="stop"]');
	var stream = null, want = 720, frames = 0, fpsStart = 0, fpsTimer = 0, vfcId = 0, rafId = 0;

	var RES = { 720: [1280, 720], 1080: [1920, 1080], 2160: [3840, 2160] };

	function status(msg) { $('status').textContent = msg || ''; }

	function errText(err) {
		var n = err && err.name;
		if (n === 'NotAllowedError' || n === 'SecurityError') { return 'Kamera izni reddedildi. Adres çubuğundaki kilit simgesinden kamerayı “İzin ver” yapıp sayfayı yenileyin.'; }
		if (n === 'NotFoundError') { return 'Kamera bulunamadı. Laptoplarda gizlilik kapağını ve Fn kamera tuşunu, Windows’ta Ayarlar > Gizlilik ve güvenlik > Kamera iznini kontrol edin.'; }
		if (n === 'NotReadableError' || n === 'AbortError') { return 'Kamera başka bir uygulama tarafından kullanılıyor olabilir (Zoom, Teams, Kamera uygulaması…). Onu kapatıp tekrar deneyin.'; }
		if (n === 'OverconstrainedError') { return 'Kamera bu çözünürlüğü desteklemiyor. Daha düşük bir çözünürlük seçin.'; }
		return 'Kamera açılamadı: ' + (err && err.message ? err.message : 'bilinmeyen hata');
	}

	function gcd(a, b) { return b ? gcd(b, a % b) : a; }
	function aspect(w, h) {
		var r = w / h;
		var known = [[16 / 9, '16:9'], [4 / 3, '4:3'], [16 / 10, '16:10'], [1, '1:1'], [21 / 9, '21:9'], [9 / 16, '9:16'], [3 / 4, '3:4']];
		for (var i = 0; i < known.length; i++) { if (Math.abs(r - known[i][0]) < 0.02) { return known[i][1]; } }
		var g = gcd(w, h); return (w / g) + ':' + (h / g);
	}

	function stopFps() {
		clearInterval(fpsTimer);
		if (vfcId && video.cancelVideoFrameCallback) { video.cancelVideoFrameCallback(vfcId); }
		cancelAnimationFrame(rafId);
		vfcId = rafId = 0;
	}

	function measureFps() {
		stopFps();
		frames = 0; fpsStart = performance.now();
		if (video.requestVideoFrameCallback) {
			var onFrame = function () { frames++; vfcId = video.requestVideoFrameCallback(onFrame); };
			vfcId = video.requestVideoFrameCallback(onFrame);
		} else {
			var lastTime = -1;
			var tick = function () { if (video.currentTime !== lastTime) { frames++; lastTime = video.currentTime; } rafId = requestAnimationFrame(tick); };
			rafId = requestAnimationFrame(tick);
		}
		fpsTimer = setInterval(function () {
			var now = performance.now();
			var fps = frames / ((now - fpsStart) / 1000);
			$('fps').textContent = fps ? fps.toFixed(1) : '-';
			frames = 0; fpsStart = now;
			showRes();
		}, 1000);
	}

	function showRes() {
		var w = video.videoWidth, h = video.videoHeight;
		if (!w) { return; }
		$('res').textContent = w + '×' + h;
		$('aspect').textContent = aspect(w, h);
		$('mp').textContent = (w * h / 1e6).toFixed(2) + ' MP';
	}

	function stop() {
		stopFps();
		if (stream) { stream.getTracks().forEach(function (t) { t.stop(); }); }
		stream = null;
		video.srcObject = null;
		root.classList.remove('is-live');
		snapBtn.disabled = stopBtn.disabled = true;
		$('startlabel').textContent = 'Kamerayı başlat';
	}

	function start(deviceId) {
		if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) { status('Tarayıcınız kamera erişimini desteklemiyor. Güncel Chrome, Edge, Firefox veya Safari deneyin.'); return; }
		if (!window.isSecureContext) { status('Kamera yalnızca güvenli (https://) bağlantıda çalışır.'); return; }
		var size = RES[want];
		var c = { video: { width: { ideal: size[0] }, height: { ideal: size[1] } }, audio: false };
		if (deviceId) { c.video.deviceId = { exact: deviceId }; }
		stop();
		status('İzin bekleniyor…');
		navigator.mediaDevices.getUserMedia(c).then(function (s) {
			stream = s;
			video.srcObject = s;
			var p = video.play(); if (p && p.catch) { p.catch(function () {}); }
			var track = s.getVideoTracks()[0];
			var set = track.getSettings ? track.getSettings() : {};
			$('label').textContent = track.label ? 'Kullanılan kamera: ' + track.label : '';
			root.classList.add('is-live');
			snapBtn.disabled = stopBtn.disabled = false;
			$('startlabel').textContent = 'Yeniden başlat';
			status('');
			video.onloadedmetadata = function () {
				showRes();
				var got = video.videoHeight;
				if (got && got < size[1]) { status('İstenen: ' + size[1] + 'p. Kameranızın verebildiği en yüksek değer: ' + video.videoWidth + '×' + got + '.'); }
			};
			measureFps();
			listDevices(set.deviceId);
		}).catch(function (err) { status(errText(err)); });
	}

	function listDevices(currentId) {
		if (!navigator.mediaDevices.enumerateDevices) { return; }
		navigator.mediaDevices.enumerateDevices().then(function (devices) {
			var cams = devices.filter(function (d) { return d.kind === 'videoinput'; });
			select.innerHTML = '';
			cams.forEach(function (d, i) {
				var o = document.createElement('option');
				o.value = d.deviceId;
				o.textContent = d.label || ('Kamera ' + (i + 1));
				if (d.deviceId === currentId) { o.selected = true; }
				select.appendChild(o);
			});
			select.disabled = cams.length < 2;
		});
	}

	function snap() {
		if (!video.videoWidth) { return; }
		var cv = document.createElement('canvas');
		cv.width = video.videoWidth; cv.height = video.videoHeight;
		var g = cv.getContext('2d');
		if ($('mirror').checked) { g.translate(cv.width, 0); g.scale(-1, 1); }
		g.drawImage(video, 0, 0);
		cv.toBlob(function (blob) {
			if (!blob) { return; }
			var a = document.createElement('a');
			a.href = URL.createObjectURL(blob);
			a.download = 'kamera-testi-' + cv.width + 'x' + cv.height + '.png';
			document.body.appendChild(a); a.click(); a.remove();
			setTimeout(function () { URL.revokeObjectURL(a.href); }, 2000);
			status('Fotoğraf cihazınıza kaydedildi (' + cv.width + '×' + cv.height + ').');
		}, 'image/png');
	}

	function applyMirror() { root.classList.toggle('is-mirrored', $('mirror').checked); }

	startBtn.addEventListener('click', function () { start(select.disabled ? undefined : select.value); });
	stopBtn.addEventListener('click', function () { stop(); status(''); });
	snapBtn.addEventListener('click', snap);
	select.addEventListener('change', function () { start(select.value); });
	$('mirror').addEventListener('change', applyMirror);
	root.querySelectorAll('[data-res]').forEach(function (b) {
		b.addEventListener('click', function () {
			want = parseInt(b.getAttribute('data-res'), 10);
			root.querySelectorAll('[data-res]').forEach(function (x) { x.classList.toggle('is-active', x === b); x.setAttribute('aria-pressed', x === b ? 'true' : 'false'); });
			if (stream) { start(select.disabled ? undefined : select.value); }
		});
	});
	window.addEventListener('pagehide', stop);
	applyMirror();
}());
