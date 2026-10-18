/* Testmatik – site behaviour: navigation, theme, finder, table of contents, consent. */
(function () {
	'use strict';
	var doc = document.documentElement;

	/* Mobile navigation */
	var toggle = document.querySelector('[data-nav-toggle]');
	if (toggle) {
		toggle.addEventListener('click', function () {
			var open = doc.classList.toggle('nav-open');
			toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
		});
	}

	/* Mega menu */
	var trigger = document.querySelector('[data-mega-trigger]');
	if (trigger) {
		var item = trigger.parentElement;
		var setMega = function (open) {
			item.classList.toggle('is-open', open);
			trigger.setAttribute('aria-expanded', open ? 'true' : 'false');
		};
		trigger.addEventListener('click', function (e) { e.stopPropagation(); setMega(!item.classList.contains('is-open')); });
		document.addEventListener('click', function (e) { if (!item.contains(e.target)) { setMega(false); } });
		document.addEventListener('keydown', function (e) { if (e.key === 'Escape') { setMega(false); } });
	}

	/* Light / dark theme */
	var themeBtn = document.querySelector('[data-theme-toggle]');
	if (themeBtn) {
		themeBtn.addEventListener('click', function () {
			var current = doc.getAttribute('data-theme');
			if (!current) { current = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'; }
			var next = current === 'dark' ? 'light' : 'dark';
			doc.setAttribute('data-theme', next);
			try { localStorage.setItem('tm-theme', next); } catch (e) { /* storage blocked */ }
		});
	}

	/* Home finder: filter tool cards as you type */
	var finder = document.querySelector('[data-finder]');
	if (finder) {
		var input = finder.querySelector('[data-finder-input]');
		var cards = Array.prototype.slice.call(document.querySelectorAll('[data-finder-grid] [data-search]'));
		var empty = document.querySelector('[data-finder-empty]');
		var norm = function (s) { return (s || '').toLocaleLowerCase('tr-TR').trim(); };
		var filter = function () {
			var q = norm(input.value);
			var shown = 0;
			cards.forEach(function (c) {
				var hit = !q || c.getAttribute('data-search').indexOf(q) !== -1;
				c.hidden = !hit;
				if (hit) { shown++; }
			});
			if (empty) { empty.hidden = shown > 0; }
		};
		input.addEventListener('input', filter);
		finder.addEventListener('submit', function (e) {
			var first = cards.filter(function (c) { return !c.hidden; })[0];
			if (first && input.value.trim()) { e.preventDefault(); window.location.href = first.href; }
		});
		document.addEventListener('keydown', function (e) {
			if (e.key === '/' && document.activeElement && !/INPUT|TEXTAREA|SELECT/.test(document.activeElement.tagName) && !document.querySelector('[data-tm-app]')) {
				e.preventDefault(); input.focus();
			}
		});
	}

	/* Table of contents: highlight the section in view */
	var toc = document.querySelector('[data-toc]');
	if (toc && 'IntersectionObserver' in window) {
		var links = {};
		toc.querySelectorAll('a[href^="#"]').forEach(function (a) { links[decodeURIComponent(a.getAttribute('href').slice(1))] = a; });
		var heads = Object.keys(links).map(function (id) { return document.getElementById(id); }).filter(Boolean);
		var obs = new IntersectionObserver(function (entries) {
			entries.forEach(function (en) {
				if (en.isIntersecting) {
					Object.keys(links).forEach(function (k) { links[k].classList.remove('is-active'); });
					if (links[en.target.id]) { links[en.target.id].classList.add('is-active'); }
				}
			});
		}, { rootMargin: '0px 0px -70% 0px' });
		heads.forEach(function (h) { obs.observe(h); });
	}

	/* GA4 tool events: works with any gtag on the page (Site Kit or the theme loader) */
	var track = function (name, params) {
		if (typeof window.gtag === 'function') { window.gtag('event', name, params); }
	};
	var app = document.querySelector('[data-tm-tool]');
	if (app) {
		var toolName = app.getAttribute('data-tm-tool');
		var started = false;
		var start = function (how) {
			if (started) { return; }
			started = true;
			track('tool_start', { tool_name: toolName, start_method: how });
		};
		var seen = {};
		app.addEventListener('click', function (e) {
			var btn = e.target.closest('button, [role="button"]');
			if (!btn || !app.contains(btn)) { return; }
			var action = btn.getAttribute('data-action') || (btn.getAttribute('data-color-index') !== null ? 'color' : '') ||
				(btn.getAttribute('data-res') ? 'resolution' : '') || (btn.getAttribute('data-pan') ? 'channel' : '') ||
				(btn.getAttribute('data-hz') ? 'tone' : '') || (btn.getAttribute('data-layout') ? 'layout' : '') || 'button';
			start('click');
			// One event per action and page keeps the reports readable.
			if (!seen[action]) {
				seen[action] = true;
				track('tool_action', { tool_name: toolName, tool_action: action });
			}
		});
		if (app.getAttribute('data-tm-app') === 'keyboard') {
			document.addEventListener('keydown', function () { start('key'); }, { once: true });
		}
		if (app.getAttribute('data-tm-app') === 'mouse') {
			app.addEventListener('mousedown', function () { start('click'); }, { once: true });
		}
		// Camera and microphone: report whether the browser permission was granted.
		var md = navigator.mediaDevices;
		if (md && typeof md.getUserMedia === 'function') {
			var gum = md.getUserMedia.bind(md);
			var reported = {};
			var report = function (result) {
				if (reported[result]) { return; }
				reported[result] = true;
				track('tool_permission', { tool_name: toolName, permission_result: result });
			};
			md.getUserMedia = function (c) {
				start('permission');
				return gum(c).then(function (s) {
					report('granted');
					return s;
				}, function (err) {
					report((err && err.name) || 'error');
					throw err;
				});
			};
		}
	}

	/* Clicks on tool cards and CTA buttons that lead to a tool */
	document.addEventListener('click', function (e) {
		var a = e.target.closest('.cta-card a, a.tool-card, [data-search]');
		if (!a || !a.href) { return; }
		track('tool_cta_click', { link_url: a.href, cta_type: a.closest('.cta-card') ? 'article_cta' : 'tool_card' });
	});

	/* Cookie consent (Google Consent Mode v2) */
	var banner = document.querySelector('[data-consent]');
	if (banner) {
		var read = function () { try { return JSON.parse(localStorage.getItem('tm-consent') || 'null'); } catch (e) { return null; } };
		var save = function (c) {
			c.at = Date.now();
			try { localStorage.setItem('tm-consent', JSON.stringify(c)); } catch (e) { /* storage blocked */ }
			if (typeof window.gtag === 'function') {
				window.gtag('consent', 'update', {
					analytics_storage: c.analytics ? 'granted' : 'denied',
					ad_storage: c.marketing ? 'granted' : 'denied',
					ad_user_data: c.marketing ? 'granted' : 'denied',
					ad_personalization: c.marketing ? 'granted' : 'denied'
				});
			}
			banner.hidden = true;
		};
		var stored = read();
		var expired = !stored || (Date.now() - (stored.at || 0)) > 180 * 864e5;
		if (expired) { banner.hidden = false; }
		var opts = banner.querySelector('[data-consent-opts]');
		var box = function (k) { return banner.querySelector('[data-consent-key="' + k + '"]'); };
		banner.querySelector('[data-consent-accept]').addEventListener('click', function () { save({ analytics: true, marketing: true }); });
		banner.querySelector('[data-consent-reject]').addEventListener('click', function () { save({ analytics: false, marketing: false }); });
		banner.querySelector('[data-consent-custom]').addEventListener('click', function () {
			if (opts.hidden) {
				opts.hidden = false;
				this.textContent = 'Seçimi kaydet';
			} else {
				save({ analytics: box('analytics').checked, marketing: box('marketing').checked });
			}
		});
		document.querySelectorAll('[data-consent-open]').forEach(function (b) {
			b.addEventListener('click', function () {
				var s = read() || {};
				box('analytics').checked = !!s.analytics;
				box('marketing').checked = !!s.marketing;
				opts.hidden = false;
				banner.querySelector('[data-consent-custom]').textContent = 'Seçimi kaydet';
				banner.hidden = false;
			});
		});
	}
}());
