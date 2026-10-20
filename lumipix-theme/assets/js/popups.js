/**
 * Lumipix cookie consent banner.
 */
(function () {
	'use strict';

	var COOKIE = 'lumipix_consent';

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
})();
