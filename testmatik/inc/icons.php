<?php
/**
 * Inline SVG icons (Lucide-style strokes, ISC licence).
 *
 * @package Testmatik
 */

defined( 'ABSPATH' ) || exit;

/**
 * Return an inline SVG icon.
 *
 * @param string $name Icon name.
 * @param int    $size Pixel size.
 * @return string
 */
function testmatik_icon( $name, $size = 20 ) {
	static $paths = array(
		'keyboard' => '<rect x="2" y="5" width="20" height="14" rx="2.5"/><path d="M6 9h.01M10 9h.01M14 9h.01M18 9h.01M6 12.5h.01M10 12.5h.01M14 12.5h.01M18 12.5h.01M7.5 16h9"/>',
		'monitor'  => '<rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/>',
		'mic'      => '<rect x="9" y="2" width="6" height="12" rx="3"/><path d="M19 10v1a7 7 0 0 1-14 0v-1M12 18v4M8 22h8"/>',
		'camera'   => '<path d="M16 8.5 21 6v12l-5-2.5"/><rect x="2" y="6" width="14" height="12" rx="2"/>',
		'mouse'    => '<rect x="6" y="2" width="12" height="20" rx="6"/><path d="M12 6v4"/>',
		'speaker'  => '<path d="M11 5 6 9H2v6h4l5 4V5Z"/><path d="M15.5 8.5a5 5 0 0 1 0 7M19 5a10 10 0 0 1 0 14"/>',
		'search'   => '<circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/>',
		'arrow'    => '<path d="M5 12h14M13 6l6 6-6 6"/>',
		'check'    => '<path d="M20 6 9 17l-5-5"/>',
		'shield'   => '<path d="M12 22s8-3.5 8-10V5l-8-3-8 3v7c0 6.5 8 10 8 10Z"/><path d="m9 12 2 2 4-4"/>',
		'zap'      => '<path d="M13 2 3 14h9l-1 8 10-12h-9l1-8Z"/>',
		'gift'     => '<rect x="3" y="8" width="18" height="4" rx="1"/><path d="M12 8v13M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7M7.5 8a2.5 2.5 0 0 1 0-5C10 3 12 8 12 8s2-5 4.5-5a2.5 2.5 0 0 1 0 5"/>',
		'lock'     => '<rect x="4" y="11" width="16" height="10" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/>',
		'menu'     => '<path d="M4 6h16M4 12h16M4 18h16"/>',
		'close'    => '<path d="M18 6 6 18M6 6l12 12"/>',
		'sun'      => '<circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/>',
		'moon'     => '<path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8Z"/>',
		'chevron'  => '<path d="m6 9 6 6 6-6"/>',
		'book'     => '<path d="M4 19.5V5a2 2 0 0 1 2-2h14v16H6.5A2.5 2.5 0 0 0 4 21.5v-2ZM20 19v3H6.5"/>',
		'clock'    => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
		'mail'     => '<rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-10 6L2 7"/>',
		'info'     => '<circle cx="12" cy="12" r="9"/><path d="M12 16v-4M12 8h.01"/>',
		'alert'    => '<path d="M10.3 3.9 1.8 18a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0Z"/><path d="M12 9v4M12 17h.01"/>',
		'bulb'     => '<path d="M9 18h6M10 22h4M12 2a7 7 0 0 0-4 12.7c.6.5 1 1.3 1 2.3h6c0-1 .4-1.8 1-2.3A7 7 0 0 0 12 2Z"/>',
		'play'     => '<path d="m7 4 13 8-13 8V4Z"/>',
		'stop'     => '<rect x="6" y="6" width="12" height="12" rx="1.5"/>',
		'refresh'  => '<path d="M21 12a9 9 0 1 1-2.6-6.4L21 8M21 3v5h-5"/>',
		'expand'   => '<path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/>',
		'download' => '<path d="M12 3v12M7 10l5 5 5-5M5 21h14"/>',
		'cookie'   => '<path d="M21 12a9 9 0 1 1-9-9 4 4 0 0 0 4 4 4 4 0 0 0 5 5Z"/><path d="M8.5 9.5h.01M15.5 15.5h.01M10 15h.01M12 12h.01"/>',
		'list'     => '<path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/>',
		'laptop'   => '<rect x="4" y="4" width="16" height="11" rx="2"/><path d="M2 19h20"/>',
	);
	if ( ! isset( $paths[ $name ] ) ) {
		return '';
	}
	return sprintf(
		'<svg class="icon icon--%1$s" width="%2$d" height="%2$d" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">%3$s</svg>',
		esc_attr( $name ),
		(int) $size,
		$paths[ $name ]
	);
}
