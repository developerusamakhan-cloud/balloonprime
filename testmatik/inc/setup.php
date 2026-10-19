<?php
/**
 * Theme setup, assets and front-end clean-up.
 *
 * @package Testmatik
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'after_setup_theme',
	function () {
		load_theme_textdomain( 'testmatik', TESTMATIK_DIR . '/languages' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
		add_theme_support( 'custom-logo', array( 'height' => 64, 'width' => 64, 'flex-width' => true, 'flex-height' => true ) );
		add_theme_support( 'editor-styles' );
		add_editor_style( 'assets/css/editor.css' );
		register_nav_menus(
			array(
				'primary' => __( 'Üst menü (isteğe bağlı)', 'testmatik' ),
				'footer'  => __( 'Alt bilgi menüsü (isteğe bağlı)', 'testmatik' ),
			)
		);
		add_image_size( 'testmatik-card', 720, 405, true );
	}
);

/**
 * Asset version: theme version + file time, so updates bust caches.
 *
 * @param string $rel Path relative to the theme.
 * @return string
 */
function testmatik_asset_ver( $rel ) {
	$file = TESTMATIK_DIR . '/' . $rel;
	return TESTMATIK_VERSION . '.' . ( file_exists( $file ) ? filemtime( $file ) : '0' );
}

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_style( 'testmatik', TESTMATIK_URI . '/assets/css/main.css', array(), testmatik_asset_ver( 'assets/css/main.css' ) );
		wp_enqueue_script( 'testmatik-site', TESTMATIK_URI . '/assets/js/site.js', array(), testmatik_asset_ver( 'assets/js/site.js' ), array( 'strategy' => 'defer', 'in_footer' => true ) );

		$key = is_page() ? testmatik_page_tool() : '';
		if ( $key ) {
			$tool = testmatik_get_tool( $key );
			$rel  = 'assets/js/tools/' . $tool['script'] . '.js';
			if ( file_exists( TESTMATIK_DIR . '/' . $rel ) ) {
				wp_enqueue_script( 'testmatik-tool', TESTMATIK_URI . '/' . $rel, array(), testmatik_asset_ver( $rel ), array( 'strategy' => 'defer', 'in_footer' => true ) );
			}
		}

		// No block library CSS needed for this theme's content.
		if ( ! is_admin() ) {
			wp_dequeue_style( 'wp-block-library' );
			wp_dequeue_style( 'wp-block-library-theme' );
			wp_dequeue_style( 'global-styles' );
			wp_dequeue_style( 'classic-theme-styles' );
		}
	},
	20
);

// Preload the main font and set the theme colour before CSS loads.
add_action(
	'wp_head',
	function () {
		printf( '<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n", esc_url( TESTMATIK_URI . '/assets/fonts/jakarta-latin.woff2' ) );
		// A 48px-based /favicon.ico is what Google search results look for first.
		if ( file_exists( ABSPATH . 'favicon.ico' ) ) {
			printf( '<link rel="icon" href="%s" sizes="48x48">' . "\n", esc_url( home_url( '/favicon.ico' ) ) );
		}
		if ( ! has_site_icon() ) {
			printf( '<link rel="icon" href="%s" type="image/svg+xml">' . "\n", esc_url( TESTMATIK_URI . '/assets/img/favicon.svg' ) );
		}
		echo '<meta name="theme-color" content="#0b1020" media="(prefers-color-scheme: dark)">' . "\n";
		echo '<meta name="theme-color" content="#f7f8fb" media="(prefers-color-scheme: light)">' . "\n";
		// Apply a saved light/dark choice before paint to avoid a flash.
		echo "<script>try{var t=localStorage.getItem('tm-theme');if(t==='dark'||t==='light'){document.documentElement.setAttribute('data-theme',t);}}catch(e){}</script>\n";
	},
	1
);

// The site is Turkish; keep <html lang> correct even if the admin language is not.
add_filter(
	'language_attributes',
	function ( $output ) {
		if ( 0 !== strpos( get_locale(), 'tr' ) ) {
			$output = preg_replace( '/lang="[^"]*"/', 'lang="tr-TR"', $output );
		}
		return $output;
	}
);

// Clean up <head>.
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
add_filter( 'emoji_svg_url', '__return_false' );

// Comments are not used on a tools site.
add_filter( 'comments_open', '__return_false', 20 );
add_filter( 'pings_open', '__return_false', 20 );
add_filter( 'comments_array', '__return_empty_array', 10 );
add_action(
	'admin_menu',
	function () {
		remove_menu_page( 'edit-comments.php' );
	}
);

add_filter(
	'excerpt_length',
	function () {
		return 26;
	}
);
add_filter(
	'excerpt_more',
	function () {
		return '…';
	}
);

// Body classes for tool pages.
add_filter(
	'body_class',
	function ( $classes ) {
		$key = is_page() ? testmatik_page_tool() : '';
		if ( $key ) {
			$classes[] = 'is-tool';
			$classes[] = 'tool-' . sanitize_html_class( $key );
		}
		return $classes;
	}
);

// Search only articles and pages, never attachments.
add_action(
	'pre_get_posts',
	function ( $q ) {
		if ( ! is_admin() && $q->is_main_query() && $q->is_search() ) {
			$q->set( 'post_type', array( 'post', 'page' ) );
		}
	}
);

// Put the theme's favicon.ico in the site root once, so /favicon.ico does not 404.
add_action(
	'admin_init',
	function () {
		$dst = ABSPATH . 'favicon.ico';
		if ( ! file_exists( $dst ) && wp_is_writable( ABSPATH ) ) {
			copy( TESTMATIK_DIR . '/assets/img/favicon.ico', $dst );
		}
	}
);

// Let the CDN keep pages for an hour at most, so new and scheduled guides show up quickly.
add_action(
	'send_headers',
	function () {
		if ( is_admin() || is_user_logged_in() ) {
			return;
		}
		header( 'Cache-Control: public, max-age=600, s-maxage=3600' );
	}
);
