/**
 * Lumipix – cookie consent banner and the "Need a website?" lead popup.
 */
(function () {
	'use strict';

	var COOKIE = 'lumipix_consent';
	var DAY = 864e5;

	var store = {
		get: function (k) {
			try {
				return window.localStorage.getItem(k);
			} catch (e) {
				return null;
			}
		},
		set: function (k, v) {
			try {
				window.localStorage.setItem(k, v);
			} catch (e) {}
		},
	};

	/* ---------------------------------------------------------- Consent */
	var banner = document.querySelector('[data-consent]');

	function readConsent() {
		var m = document.cookie.match(/(?:^|; )lumipix_consent=([^;]*)/);
		if (!m) return null;
		try {
			var c = JSON.parse(decodeURIComponent(m[1]));
			return { analytics: !!c.a, marketing: !!c.m };
		} catch (e) {
			return null;
		}
	}

	function activateScripts(consent) {
		document.querySelectorAll('script[type="text/plain"][data-lumipix-consent]').forEach(function (old) {
			if (!consent[old.getAttribute('data-lumipix-consent')]) return;
			var s = document.createElement('script');
			for (var i = 0; i < old.attributes.length; i++) {
				var a = old.attributes[i];
				if (a.name !== 'type' && a.name !== 'data-lumipix-consent') s.setAttribute(a.name, a.value);
			}
			s.text = old.text;
			old.parentNode.replaceChild(s, old);
		});
	}

	function saveConsent(analytics, marketing) {
		var value = encodeURIComponent(JSON.stringify({ a: analytics ? 1 : 0, m: marketing ? 1 : 0, t: Date.now() }));
		var secure = location.protocol === 'https:' ? '; Secure' : '';
		document.cookie = COOKIE + '=' + value + '; Max-Age=' + 180 * 86400 + '; Path=/; SameSite=Lax' + secure;
		var consent = { analytics: analytics, marketing: marketing };
		window.lumipixConsent = consent;
		if (typeof window.gtag === 'function') {
			var ads = marketing ? 'granted' : 'denied';
			window.gtag('consent', 'update', {
				analytics_storage: analytics ? 'granted' : 'denied',
				ad_storage: ads,
				ad_user_data: ads,
				ad_personalization: ads,
			});
		}
		activateScripts(consent);
		document.dispatchEvent(new CustomEvent('lumipix:consent', { detail: consent }));
		hideBanner();
	}

	function showBanner(withPrefs) {
		if (!banner) return;
		var current = readConsent() || { analytics: false, marketing: false };
		banner.querySelectorAll('[data-consent-cat]').forEach(function (box) {
			box.checked = !!current[box.getAttribute('data-consent-cat')];
		});
		togglePrefs(!!withPrefs);
		banner.hidden = false;
		requestAnimationFrame(function () {
			banner.classList.add('is-visible');
		});
	}

	function hideBanner() {
		if (!banner) return;
		banner.classList.remove('is-visible');
		setTimeout(function () {
			banner.hidden = true;
			document.dispatchEvent(new CustomEvent('lumipix:consent-closed'));
		}, 260);
	}

	function togglePrefs(open) {
		banner.querySelector('[data-consent-prefs]').hidden = !open;
		banner.querySelector('[data-consent-save]').hidden = !open;
		banner.querySelector('[data-consent-customise]').hidden = open;
	}

	if (banner) {
		var existing = readConsent();
		if (existing) {
			activateScripts(existing);
		} else {
			setTimeout(function () {
				showBanner(false);
			}, 600);
		}
		banner.querySelector('[data-consent-accept]').addEventListener('click', function () {
			saveConsent(true, true);
		});
		banner.querySelector('[data-consent-essential]').addEventListener('click', function () {
			saveConsent(false, false);
		});
		banner.querySelector('[data-consent-customise]').addEventListener('click', function () {
			togglePrefs(true);
		});
		banner.querySelector('[data-consent-save]').addEventListener('click', function () {
			var pick = {};
			banner.querySelectorAll('[data-consent-cat]').forEach(function (box) {
				pick[box.getAttribute('data-consent-cat')] = box.checked;
			});
			saveConsent(!!pick.analytics, !!pick.marketing);
		});
		document.querySelectorAll('[data-consent-open]').forEach(function (btn) {
			btn.addEventListener('click', function () {
				showBanner(true);
			});
		});
	}

	function bannerOpen() {
		return banner && !banner.hidden;
	}

	/* ------------------------------------------------------------- Lead */
	var lead = document.querySelector('[data-lead]');
	if (!lead) return;

	var SEEN = 'lumipix_lead_seen';
	var TIME = 'lumipix_lead_time';
	var delay = (parseInt(lead.getAttribute('data-lead-delay'), 10) || 90) * 1000;
	var dialog = lead.querySelector('.lead__dialog');
	var lastFocus = null;

	function seenRecently() {
		var t = parseInt(store.get(SEEN), 10);
		return t && Date.now() - t < DAY;
	}

	if (seenRecently()) return;

	// Time on site is counted across pages, only while the tab is visible.
	var spent = parseInt(store.get(TIME), 10) || 0;
	var tick = setInterval(function () {
		if (document.hidden) return;
		spent += 1000;
		if (spent % 5000 === 0) store.set(TIME, String(spent));
		if (spent >= delay) tryOpen();
	}, 1000);

	function busy() {
		// Never interrupt someone typing, dragging a file in or waiting for a tool.
		var el = document.activeElement;
		if (el && /INPUT|TEXTAREA|SELECT/.test(el.tagName) && el.type !== 'file') return true;
		if (document.querySelector('.is-dragover, .is-processing, .is-loading, .is-working, [aria-busy="true"]')) return true;
		return bannerOpen() || document.body.classList.contains('nav-open');
	}

	function tryOpen() {
		if (seenRecently()) {
			clearInterval(tick);
			return;
		}
		if (busy()) return;
		clearInterval(tick);
		open();
	}

	function animateScore() {
		var el = lead.querySelector('[data-lead-score]');
		var ring = lead.querySelector('.lead__ring');
		var target = 98;
		var start = null;
		var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
		function step(ts) {
			if (!start) start = ts;
			var p = reduce ? 1 : Math.min(1, (ts - start) / 1400);
			var eased = 1 - Math.pow(1 - p, 3);
			el.textContent = Math.round(target * eased);
			ring.style.strokeDashoffset = String(94.2 * (1 - (target / 100) * eased));
			if (p < 1) requestAnimationFrame(step);
		}
		requestAnimationFrame(step);
	}

	function open() {
		store.set(SEEN, String(Date.now()));
		store.set(TIME, '0');
		lastFocus = document.activeElement;
		lead.hidden = false;
		document.documentElement.classList.add('has-lead');
		requestAnimationFrame(function () {
			lead.classList.add('is-visible');
			dialog.focus();
			animateScore();
		});
		document.addEventListener('keydown', onKey);
	}

	function close() {
		lead.classList.remove('is-visible');
		document.removeEventListener('keydown', onKey);
		setTimeout(function () {
			lead.hidden = true;
			document.documentElement.classList.remove('has-lead');
			if (lastFocus && lastFocus.focus) lastFocus.focus();
		}, 280);
	}

	function onKey(e) {
		if (e.key === 'Escape') {
			close();
			return;
		}
		if (e.key !== 'Tab') return;
		var items = dialog.querySelectorAll('a[href], button');
		var first = items[0];
		var last = items[items.length - 1];
		if (e.shiftKey && document.activeElement === first) {
			e.preventDefault();
			last.focus();
		} else if (!e.shiftKey && document.activeElement === last) {
			e.preventDefault();
			first.focus();
		}
	}

	lead.querySelectorAll('[data-lead-close]').forEach(function (b) {
		b.addEventListener('click', close);
	});
	lead.querySelector('[data-lead-go]').addEventListener('click', function () {
		if (typeof window.gtag === 'function') window.gtag('event', 'lead_click', { destination: 'vyntic' });
		setTimeout(close, 150);
	});

	// For testing: add ?lumipix-lead to any URL to open the popup straight away.
	if (/[?&]lumipix-lead\b/.test(location.search)) {
		clearInterval(tick);
		setTimeout(open, 300);
	}
})();
