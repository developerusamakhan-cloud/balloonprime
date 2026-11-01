/* Testmatik: Klavye hız testi. Words are typed and scored in the browser only. */
(function () {
	'use strict';
	var root = document.querySelector('[data-tm-app="typing"]');
	if (!root) { return; }

	function $(ref) { return root.querySelector('[data-ref="' + ref + '"]'); }

	var WORDS = ('ve bir bu da için ile çok daha ama gibi olarak sonra kadar her şey ben sen o biz siz onlar ne nasıl neden nerede zaman gün yıl ay hafta saat dakika ' +
		'ev okul iş yol su ekmek çay kahve kitap kalem masa sandalye kapı pencere oda bahçe deniz göl dağ orman ağaç çiçek yaprak güneş yağmur kar rüzgar bulut gece sabah akşam öğle ' +
		'anne baba kardeş çocuk arkadaş komşu öğretmen öğrenci doktor şoför aile insan kişi halk ülke şehir köy mahalle sokak cadde meydan pazar market dükkan fırın ' +
		'gelmek gitmek yapmak etmek olmak almak vermek bakmak görmek duymak bilmek istemek sevmek yazmak okumak konuşmak düşünmek çalışmak oturmak kalkmak yürümek koşmak ' +
		'büyük küçük uzun kısa yeni eski güzel iyi kötü sıcak soğuk hızlı yavaş kolay zor açık kapalı temiz kirli doğru yanlış önemli farklı aynı yakın uzak ' +
		'beyaz siyah kırmızı mavi yeşil sarı turuncu mor pembe gri kahverengi renk ses ışık hava toprak ateş taş demir altın para fiyat hesap ' +
		'bilgisayar klavye ekran telefon internet program dosya mesaj haber gazete radyo televizyon film müzik şarkı oyun resim fotoğraf soru cevap fikir düşünce ' +
		'sağlık spor futbol maç takım yarış başarı sonuç neden amaç plan proje görev toplantı rapor belge imza tarih saatler hafta sonu tatil yolculuk otobüs tren uçak gemi araba ' +
		'şimdi bugün yarın dün hemen biraz artık yine hala belki sadece bile hiç asla hep bazen genellikle özellikle gerçekten birlikte yalnız önce ' +
		'merhaba teşekkür lütfen tamam evet hayır güle görüşmek kolay gelsin hoş geldiniz afiyet olsun geçmiş olsun ' +
		'yemek kahvaltı akşam yemeği meyve elma armut üzüm portakal limon domates biber patates soğan peynir zeytin yumurta süt bal şeker tuz ' +
		'öğrenmek öğretmek anlamak anlatmak sormak cevaplamak açmak kapatmak başlamak bitirmek beklemek bulmak kaybetmek kazanmak satmak ödemek ' +
		'çalışkan dikkatli sabırlı mutlu üzgün yorgun hazır meşgul sakin heyecanlı güçlü zayıf akıllı cesur nazik dürüst ' +
		'güney kuzey doğu batı sağ sol ön arka üst alt iç dış orta köşe kenar yan karşı ' +
		'ışık çığ şöyle böyle öyle şu çünkü eğer ya da hem ise değil var yok').split(/\s+/);

	var input = $('input');
	var box = $('words');
	var timerEl = $('timer');
	var duration = 60;
	var seq = [];
	var spans = [];
	var idx = 0;
	var startAt = 0;
	var tick = null;
	var running = false;
	var finished = false;
	var res = { ok: 0, bad: 0, okChars: 0, typed: 0 };

	function shuffleWords(n) {
		var out = [];
		var last = '';
		while (out.length < n) {
			var w = WORDS[Math.floor(Math.random() * WORDS.length)];
			if (w && w !== last) { out.push(w); last = w; }
		}
		return out;
	}

	function fmt(sec) {
		sec = Math.max(0, Math.ceil(sec));
		return Math.floor(sec / 60) + ':' + ('0' + (sec % 60)).slice(-2);
	}

	function build() {
		seq = shuffleWords(Math.max(150, duration * 2));
		box.innerHTML = '';
		spans = seq.map(function (w) {
			var s = document.createElement('span');
			s.textContent = w;
			box.appendChild(s);
			box.appendChild(document.createTextNode(' '));
			return s;
		});
		box.scrollTop = 0;
		idx = 0;
		mark();
	}

	function mark() {
		spans.forEach(function (s, i) { s.classList.toggle('is-current', i === idx); });
		var cur = spans[idx];
		if (cur && spans[0]) {
			// Keep the current word on the second visible line.
			var lh = parseFloat(window.getComputedStyle(box).lineHeight) || 40;
			var row = Math.round((cur.offsetTop - spans[0].offsetTop) / lh);
			box.scrollTop = Math.max(0, row - 1) * lh;
		}
	}

	function elapsedMin() {
		if (!startAt) { return 0; }
		return Math.min(duration, (Date.now() - startAt) / 1000) / 60;
	}

	function stats() {
		var m = elapsedMin();
		var wpm = m > 0 ? Math.round(res.ok / m) : 0;
		var kpm = m > 0 ? Math.round(res.okChars / m) : 0;
		var total = res.ok + res.bad;
		$('wpm').textContent = String(wpm);
		$('kpm').textContent = String(kpm);
		$('acc').textContent = total ? Math.round((res.ok / total) * 100) + '%' : '-';
		$('wrong').textContent = String(res.bad);
		return { wpm: wpm, kpm: kpm, acc: total ? Math.round((res.ok / total) * 100) : 0 };
	}

	function level(wpm) {
		if (wpm < 20) { return 'Başlangıç seviyesi. Düzenli pratikle kısa sürede yükselir.'; }
		if (wpm < 35) { return 'Ortalama bir hız. Günlük yazışmalar için yeterli.'; }
		if (wpm < 50) { return 'Ortalamanın üzerinde. On parmak yazıyor olmanız muhtemel.'; }
		if (wpm < 70) { return 'Hızlı. Ofis ve sınav pratiği için güçlü bir sonuç.'; }
		return 'Çok hızlı. Bu hız profesyonel yazı yazanlar arasında bile iyi sayılır.';
	}

	function bestKey() { return 'tm_typing_best_' + duration; }

	function readBest() {
		try { return parseInt(window.localStorage.getItem(bestKey()), 10) || 0; } catch (e) { return 0; }
	}

	function showBest() {
		var b = readBest();
		$('best').textContent = b
			? 'Bu sürede en iyi sonucunuz: ' + b + ' net kelime/dk. Sonuçlar yalnızca bu tarayıcıda saklanır.'
			: 'En iyi sonucunuz yalnızca bu tarayıcıda saklanır; hiçbir yere gönderilmez.';
	}

	function finish() {
		running = false;
		finished = true;
		clearInterval(tick);
		timerEl.textContent = '0:00';
		input.disabled = true;
		var s = stats();
		var best = readBest();
		if (s.wpm > best) {
			try { window.localStorage.setItem(bestKey(), String(s.wpm)); } catch (e) { /* storage blocked */ }
		}
		$('rwpm').textContent = String(s.wpm);
		$('rlevel').textContent = level(s.wpm);
		$('rdetail').textContent = res.ok + ' doğru, ' + res.bad + ' hatalı kelime · ' + s.kpm + ' vuruş/dk · %' + s.acc + ' doğruluk' + (s.wpm > best && best ? ' · Yeni rekor!' : '');
		$('result').hidden = false;
		root.querySelectorAll('[data-duration]').forEach(function (b) { b.disabled = false; });
		showBest();
		if (typeof window.gtag === 'function') {
			window.gtag('event', 'tool_action', { tool: 'klavye-hiz-testi', action: 'finish_' + duration, value: s.wpm });
		}
	}

	function start() {
		running = true;
		startAt = Date.now();
		root.querySelectorAll('[data-duration]').forEach(function (b) { b.disabled = true; });
		tick = setInterval(function () {
			var left = duration - (Date.now() - startAt) / 1000;
			timerEl.textContent = fmt(left);
			stats();
			if (left <= 0) { finish(); }
		}, 200);
	}

	function submit(word) {
		var target = seq[idx];
		var span = spans[idx];
		if (!span) { return; }
		span.classList.remove('is-typing-bad');
		if (word === target) {
			res.ok++;
			res.okChars += target.length + 1;
			span.classList.add('is-ok');
		} else {
			res.bad++;
			span.classList.add('is-bad');
		}
		res.typed += word.length + 1;
		idx++;
		if (idx >= spans.length - 20) {
			shuffleWords(100).forEach(function (w) {
				seq.push(w);
				var s = document.createElement('span');
				s.textContent = w;
				box.appendChild(s);
				box.appendChild(document.createTextNode(' '));
				spans.push(s);
			});
		}
		mark();
		stats();
	}

	function reset() {
		clearInterval(tick);
		running = false;
		finished = false;
		startAt = 0;
		res = { ok: 0, bad: 0, okChars: 0, typed: 0 };
		input.disabled = false;
		input.value = '';
		timerEl.textContent = fmt(duration);
		$('result').hidden = true;
		root.querySelectorAll('[data-duration]').forEach(function (b) { b.disabled = false; });
		build();
		stats();
		showBest();
	}

	input.addEventListener('input', function () {
		if (finished) { return; }
		var v = input.value.normalize ? input.value.normalize('NFC') : input.value;
		if (!running && v.trim()) { start(); }
		if (/\s/.test(v)) {
			var parts = v.split(/\s+/);
			var rest = parts.pop();
			parts.forEach(function (p) { if (p) { submit(p); } });
			input.value = rest;
			v = rest;
		}
		var cur = spans[idx];
		if (cur) { cur.classList.toggle('is-typing-bad', v.length > 0 && seq[idx].indexOf(v) !== 0); }
	});

	input.addEventListener('paste', function (e) { e.preventDefault(); });

	root.addEventListener('click', function (e) {
		var d = e.target.closest('[data-duration]');
		if (d && !running) {
			duration = parseInt(d.getAttribute('data-duration'), 10) || 60;
			root.querySelectorAll('[data-duration]').forEach(function (b) {
				var on = b === d;
				b.classList.toggle('is-active', on);
				b.setAttribute('aria-pressed', on ? 'true' : 'false');
			});
			reset();
			input.focus();
			return;
		}
		if (e.target.closest('[data-action="reset"]') || e.target.closest('[data-action="again"]')) {
			reset();
			input.focus();
		}
	});

	box.addEventListener('click', function () { input.focus(); });

	reset();
})();
