/* Testmatik – Klavye testi. Runs entirely in the browser. */
(function () {
	'use strict';
	var root = document.querySelector('[data-tm-app="keyboard"]');
	if (!root) { return; }

	function $(ref) { return root.querySelector('[data-ref="' + ref + '"]'); }

	// Key definition: [code, labelQ, labelF (optional), width]. Labels: "top|bottom" for two-symbol keys.
	var FN_ROW = [['Escape', 'Esc', null, 1], ['gap', '', null, 1], ['F1', 'F1'], ['F2', 'F2'], ['F3', 'F3'], ['F4', 'F4'], ['gap', '', null, 0.5], ['F5', 'F5'], ['F6', 'F6'], ['F7', 'F7'], ['F8', 'F8'], ['gap', '', null, 0.5], ['F9', 'F9'], ['F10', 'F10'], ['F11', 'F11'], ['F12', 'F12']];
	var MAIN = [
		[['Backquote', 'é|"', '*|+'], ['Digit1', '!|1'], ['Digit2', "'|2", '"|2'], ['Digit3', '^|3'], ['Digit4', '+|4', '$|4'], ['Digit5', '%|5'], ['Digit6', '&|6'], ['Digit7', '/|7', "'|7"], ['Digit8', '(|8'], ['Digit9', ')|9'], ['Digit0', '=|0'], ['Minus', '?|*', '?|/'], ['Equal', '_|-'], ['Backspace', '⌫ Geri', null, 2]],
		[['Tab', 'Tab ⇥', null, 1.5], ['KeyQ', 'Q', 'F'], ['KeyW', 'W', 'G'], ['KeyE', 'E', 'Ğ'], ['KeyR', 'R', 'I'], ['KeyT', 'T', 'O'], ['KeyY', 'Y', 'D'], ['KeyU', 'U', 'R'], ['KeyI', 'I', 'N'], ['KeyO', 'O', 'H'], ['KeyP', 'P', 'P'], ['BracketLeft', 'Ğ', 'Q'], ['BracketRight', 'Ü', 'W'], ['Enter', 'Enter', null, 1.5, 'enter-top']],
		[['CapsLock', 'Caps Lock', null, 1.75], ['KeyA', 'A', 'U'], ['KeyS', 'S', 'İ'], ['KeyD', 'D', 'E'], ['KeyF', 'F', 'A'], ['KeyG', 'G', 'Ü'], ['KeyH', 'H', 'T'], ['KeyJ', 'J', 'K'], ['KeyK', 'K', 'M'], ['KeyL', 'L', 'L'], ['Semicolon', 'Ş', 'Y'], ['Quote', 'İ', 'Ş'], ['Backslash', ';|,', 'X'], ['Enter', '↵', null, 1.25, 'enter-bottom']],
		[['ShiftLeft', '⇧ Shift', null, 1.25], ['IntlBackslash', '>|<'], ['KeyZ', 'Z', 'J'], ['KeyX', 'X', 'Ö'], ['KeyC', 'C', 'V'], ['KeyV', 'V', 'C'], ['KeyB', 'B', 'Ç'], ['KeyN', 'N', 'Z'], ['KeyM', 'M', 'S'], ['Comma', 'Ö', 'B'], ['Period', 'Ç', ':|.'], ['Slash', ':|.', ';|,'], ['ShiftRight', '⇧ Shift', null, 2.75]],
		[['ControlLeft', 'Ctrl', null, 1.25], ['MetaLeft', 'Win', null, 1.25], ['AltLeft', 'Alt', null, 1.25], ['Space', 'Boşluk', null, 6.25], ['AltRight', 'Alt Gr', null, 1.25], ['MetaRight', 'Win', null, 1.25], ['ContextMenu', 'Menü', null, 1.25], ['ControlRight', 'Ctrl', null, 1.25]]
	];
	var NAV_TOP = [['PrintScreen', 'PrtSc'], ['ScrollLock', 'ScrLk'], ['Pause', 'Pause']];
	var NAV = [
		[['Insert', 'Ins'], ['Home', 'Home'], ['PageUp', 'PgUp']],
		[['Delete', 'Del'], ['End', 'End'], ['PageDown', 'PgDn']],
		[],
		[['gap', '', null, 1], ['ArrowUp', '↑'], ['gap', '', null, 1]],
		[['ArrowLeft', '←'], ['ArrowDown', '↓'], ['ArrowRight', '→']]
	];
	var PAD = [
		[['NumLock', 'Num'], ['NumpadDivide', '/'], ['NumpadMultiply', '*'], ['NumpadSubtract', '−']],
		[['Numpad7', '7'], ['Numpad8', '8'], ['Numpad9', '9'], ['NumpadAdd', '+', null, 1, 'tall']],
		[['Numpad4', '4'], ['Numpad5', '5'], ['Numpad6', '6']],
		[['Numpad1', '1'], ['Numpad2', '2'], ['Numpad3', '3'], ['NumpadEnter', 'Enter', null, 1, 'tall']],
		[['Numpad0', '0', null, 2], ['NumpadDecimal', ',']]
	];

	var board = $('board');
	var layout = 'q';
	var tested = {};
	var pressed = {};
	var maxDown = 0;
	var history = [];
	var active = true;

	function label(def) {
		var l = (layout === 'f' && def[2]) ? def[2] : def[1];
		if (l.indexOf('|') > 0 && l.length > 1) {
			var p = l.split('|');
			return '<span class="k-top">' + escapeHtml(p[0]) + '</span><span class="k-bot">' + escapeHtml(p[1]) + '</span>';
		}
		return '<span>' + escapeHtml(l) + '</span>';
	}

	function keyEl(def) {
		var w = def[3] || 1;
		if (def[0] === 'gap') { return '<span class="k k--gap" style="--w:' + w + '"></span>'; }
		var cls = 'k' + (def[4] ? ' k--' + def[4] : '') + (tested[def[0]] ? ' is-ok' : '');
		return '<span class="' + cls + '" data-code="' + def[0] + '" style="--w:' + w + '">' + label(def) + '</span>';
	}

	function rows(list) {
		return list.map(function (r) { return '<div class="kb-row">' + r.map(keyEl).join('') + '</div>'; }).join('');
	}

	function render() {
		var full = $('full').checked;
		var html = '<div class="kb' + (full ? ' kb--full' : '') + '">';
		html += '<div class="kb-block kb-main"><div class="kb-row kb-row--fn">' + FN_ROW.map(keyEl).join('') + '</div>' + rows(MAIN) + '</div>';
		html += '<div class="kb-block kb-nav"><div class="kb-row kb-row--fn">' + NAV_TOP.map(keyEl).join('') + '</div>' + rows(NAV) + '</div>';
		if (full) { html += '<div class="kb-block kb-pad"><div class="kb-row kb-row--fn kb-row--blank"></div>' + rows(PAD) + '</div>'; }
		html += '</div>';
		board.innerHTML = html;
		updateStats();
	}

	function allCodes() {
		var seen = {};
		board.querySelectorAll('[data-code]').forEach(function (el) { seen[el.getAttribute('data-code')] = 1; });
		return Object.keys(seen);
	}

	function updateStats() {
		var codes = allCodes();
		var n = codes.filter(function (c) { return tested[c]; }).length;
		$('tested').textContent = n + ' / ' + codes.length;
		$('max').textContent = String(maxDown);
	}

	function setKey(code, cls, on) {
		board.querySelectorAll('[data-code="' + code + '"]').forEach(function (el) { el.classList.toggle(cls, on); });
	}

	function keyName(e) {
		if (e.key === ' ') { return 'Boşluk'; }
		if (e.key === 'Dead') { return 'Ölü tuş'; }
		if (e.key === 'Unidentified') { return '?'; }
		return e.key.length === 1 ? e.key.toLocaleUpperCase('tr-TR') : e.key;
	}

	function log(e) {
		var t = new Date();
		var time = ('0' + t.getHours()).slice(-2) + ':' + ('0' + t.getMinutes()).slice(-2) + ':' + ('0' + t.getSeconds()).slice(-2);
		history.unshift('<li><kbd>' + escapeHtml(keyName(e)) + '</kbd><code>' + escapeHtml(e.code || '-') + '</code><span>' + time + '</span></li>');
		history = history.slice(0, 12);
		$('log').innerHTML = history.join('');
	}

	function escapeHtml(s) {
		return String(s).replace(/[&<>"']/g, function (c) { return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]; });
	}

	function markTested(code) {
		if (!code) { return; }
		if (!tested[code]) {
			tested[code] = true;
			setKey(code, 'is-ok', true);
		}
	}

	function onDown(e) {
		if (!active) { return; }
		var code = e.code;
		// Keep browser shortcuts that users rely on (reload, close tab) but stop scrolling, focus moves and menus.
		if (!(e.ctrlKey && /^Key[RWT]$/.test(code))) { e.preventDefault(); }
		root.classList.add('is-live');
		if (code) {
			pressed[code] = true;
			setKey(code, 'is-down', true);
			markTested(code);
		}
		var down = Object.keys(pressed).length;
		if (down > maxDown) { maxDown = down; }
		$('last').textContent = keyName(e);
		$('code').textContent = code || '-';
		if (!e.repeat) { log(e); }
		updateStats();
	}

	function onUp(e) {
		if (!active) { return; }
		var code = e.code;
		// Print Screen often fires only keyup on Windows.
		if (code === 'PrintScreen') { markTested(code); $('last').textContent = 'PrintScreen'; $('code').textContent = code; updateStats(); }
		delete pressed[code];
		setKey(code, 'is-down', false);
	}

	function clearDown() {
		pressed = {};
		board.querySelectorAll('.is-down').forEach(function (el) { el.classList.remove('is-down'); });
	}

	// Capture keys only while the tool is on screen, so the page stays usable below it.
	if ('IntersectionObserver' in window) {
		new IntersectionObserver(function (entries) {
			active = entries[0].isIntersecting;
			if (!active) { clearDown(); }
		}, { threshold: 0.25 }).observe(board);
	}

	window.addEventListener('keydown', onDown, true);
	window.addEventListener('keyup', onUp, true);
	window.addEventListener('blur', clearDown);

	root.querySelectorAll('[data-layout]').forEach(function (btn) {
		btn.addEventListener('click', function () {
			layout = btn.getAttribute('data-layout');
			root.querySelectorAll('[data-layout]').forEach(function (b) {
				var on = b === btn;
				b.classList.toggle('is-active', on);
				b.setAttribute('aria-pressed', on ? 'true' : 'false');
			});
			render();
			btn.blur();
		});
	});
	$('full').addEventListener('change', function () { render(); this.blur(); });
	root.querySelector('[data-action="reset"]').addEventListener('click', function () {
		tested = {}; maxDown = 0; history = []; clearDown();
		$('log').innerHTML = ''; $('last').textContent = '-'; $('code').textContent = '-';
		root.classList.remove('is-live');
		render();
		this.blur();
	});

	// Small screens start with the compact layout (no numpad).
	if (window.innerWidth < 900) { $('full').checked = false; }
	render();
}());
