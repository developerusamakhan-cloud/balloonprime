/**
 * Lumipix – site interactions: header, navigation, theme toggle, tool search.
 */
(function () {
	'use strict';

	var root = document.documentElement;
	var body = document.body;

	/* Header shadow on scroll */
	var header = document.querySelector('[data-header]');
	if (header) {
		var onScroll = function () {
			header.classList.toggle('is-scrolled', window.scrollY > 8);
		};
		onScroll();
		window.addEventListener('scroll', onScroll, { passive: true });
	}

	/* Theme toggle */
	var toggle = document.querySelector('[data-theme-toggle]');
	if (toggle) {
		toggle.addEventListener('click', function () {
			var current = root.getAttribute('data-theme');
			if (!current) {
				current = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
			}
			var next = current === 'dark' ? 'light' : 'dark';
			root.setAttribute('data-theme', next);
			try {
				localStorage.setItem('lumipix-theme', next);
			} catch (e) {}
		});
	}

	/* Mobile navigation */
	var navToggle = document.querySelector('[data-nav-toggle]');
	if (navToggle) {
		navToggle.addEventListener('click', function () {
			var open = !body.classList.contains('nav-open');
			body.classList.toggle('nav-open', open);
			navToggle.setAttribute('aria-expanded', String(open));
		});
	}

	/* Mega menu */
	document.querySelectorAll('.has-mega').forEach(function (item) {
		var trigger = item.querySelector('.nav-trigger');
		if (!trigger) return;
		var setOpen = function (open) {
			item.classList.toggle('is-open', open);
			trigger.setAttribute('aria-expanded', String(open));
		};
		var hoverable = window.matchMedia('(hover: hover) and (min-width: 921px)');
		var timer;
		var hoverOpenedAt = 0;
		trigger.addEventListener('click', function (e) {
			e.stopPropagation();
			// A click right after hovering open should keep the menu open, not close it.
			if (hoverable.matches && Date.now() - hoverOpenedAt < 600) return;
			setOpen(!item.classList.contains('is-open'));
		});
		item.addEventListener('mouseenter', function () {
			if (!hoverable.matches) return;
			clearTimeout(timer);
			if (!item.classList.contains('is-open')) hoverOpenedAt = Date.now();
			setOpen(true);
		});
		item.addEventListener('mouseleave', function () {
			if (!hoverable.matches) return;
			timer = setTimeout(function () {
				setOpen(false);
			}, 160);
		});
		document.addEventListener('click', function (e) {
			if (!item.contains(e.target)) setOpen(false);
		});
		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape' && item.classList.contains('is-open')) {
				setOpen(false);
				trigger.focus();
			}
		});
	});

	/* Tool search: filters tool cards in place; submits to site search if nothing is on the page. */
	var searchInput = document.querySelector('[data-tool-search-input]');
	var cards = document.querySelectorAll('[data-tool-search]');
	if (searchInput && cards.length) {
		var empty = document.querySelector('[data-tool-search-empty]');
		var groups = document.querySelectorAll('[data-tool-group]');
		var normalise = function (s) {
			return s.toLowerCase().replace(/\s+/g, ' ').replace(/(\d)\s*(kb|mb)/g, '$1$2').trim();
		};
		var filter = function () {
			var q = normalise(searchInput.value);
			var terms = q ? q.split(' ') : [];
			var shown = 0;
			cards.forEach(function (card) {
				var hay = normalise(card.getAttribute('data-tool-search') || '');
				var hit = terms.every(function (t) {
					return hay.indexOf(t) !== -1;
				});
				card.hidden = !hit;
				if (hit) shown++;
			});
			groups.forEach(function (g) {
				g.hidden = !g.querySelector('[data-tool-search]:not([hidden])');
			});
			if (empty) empty.hidden = shown !== 0;
		};
		searchInput.addEventListener('input', filter);
		var form = searchInput.closest('form');
		if (form) {
			form.addEventListener('submit', function (e) {
				var first = document.querySelector('[data-tool-search]:not([hidden])');
				if (first && searchInput.value.trim()) {
					e.preventDefault();
					window.location.href = first.href;
				}
			});
			// Scroll the results into view when typing in the hero.
			searchInput.addEventListener('focus', function () {
				var target = document.getElementById('all-tools-title');
				if (target && window.innerWidth < 920) {
					setTimeout(function () {
						searchInput.scrollIntoView({ block: 'start', behavior: 'smooth' });
					}, 250);
				}
			});
		}
		document.addEventListener('keydown', function (e) {
			var tag = (document.activeElement && document.activeElement.tagName) || '';
			if (e.key === '/' && !/INPUT|TEXTAREA|SELECT/.test(tag)) {
				e.preventDefault();
				searchInput.focus();
			}
		});
	}
})();
