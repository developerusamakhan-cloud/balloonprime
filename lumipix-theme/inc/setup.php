<?php
/**
 * Theme setup, assets and template routing.
 *
 * @package Lumipix
 */

defined( 'ABSPATH' ) || exit;

/**
 * Theme supports and menus.
 */
function lumipix_setup() {
	load_theme_textdomain( 'lumipix', LUMIPIX_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 64,
			'width'       => 240,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
	add_editor_style( 'assets/css/editor.css' );

	add_image_size( 'lumipix-card', 720, 450, true );
	add_image_size( 'lumipix-hero', 1440, 810, true );

	register_nav_menus(
		array(
			'primary' => __( 'Primary navigation', 'lumipix' ),
			'footer'  => __( 'Footer – company links', 'lumipix' ),
		)
	);

	// Brand palette in the block editor.
	add_theme_support(
		'editor-color-palette',
		array(
			array( 'name' => __( 'Ink', 'lumipix' ), 'slug' => 'ink', 'color' => '#0E0F1C' ),
			array( 'name' => __( 'Violet', 'lumipix' ), 'slug' => 'violet', 'color' => '#5B3DF5' ),
			array( 'name' => __( 'Rose', 'lumipix' ), 'slug' => 'rose', 'color' => '#E0479E' ),
			array( 'name' => __( 'Amber', 'lumipix' ), 'slug' => 'amber', 'color' => '#FFB547' ),
			array( 'name' => __( 'Paper', 'lumipix' ), 'slug' => 'paper', 'color' => '#FAFAF7' ),
		)
	);
}
add_action( 'after_setup_theme', 'lumipix_setup' );

/**
 * Content width for embeds.
 */
function lumipix_content_width() {
	$GLOBALS['content_width'] = 760;
}
add_action( 'after_setup_theme', 'lumipix_content_width', 0 );

/**
 * Sidebar for blog posts.
 */
function lumipix_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Blog sidebar', 'lumipix' ),
			'id'            => 'blog-sidebar',
			'description'   => __( 'Shown beside blog posts, below the free tools card.', 'lumipix' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'lumipix_widgets_init' );

/**
 * Asset version helper.
 *
 * @param string $rel Relative path inside the theme.
 * @return string
 */
function lumipix_asset_ver( $rel ) {
	// Theme version + file time: browsers and caching plugins fetch fresh files after every update.
	$path = LUMIPIX_DIR . '/' . $rel;
	return file_exists( $path ) ? LUMIPIX_VERSION . '.' . filemtime( $path ) : LUMIPIX_VERSION;
}

/**
 * Front-end assets. Tool scripts are only loaded on pages that host a tool.
 */
function lumipix_enqueue() {
	wp_enqueue_style( 'lumipix', LUMIPIX_URI . '/assets/css/main.css', array(), lumipix_asset_ver( 'assets/css/main.css' ) );
	wp_enqueue_script( 'lumipix-site', LUMIPIX_URI . '/assets/js/site.js', array(), lumipix_asset_ver( 'assets/js/site.js' ), array( 'strategy' => 'defer', 'in_footer' => true ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Classic-theme block styles are enough; drop the global styles bloat we do not use.
	wp_dequeue_style( 'classic-theme-styles' );
}
add_action( 'wp_enqueue_scripts', 'lumipix_enqueue' );

/**
 * Enqueue the scripts an app needs. Called while rendering a tool.
 *
 * @param string $app App name.
 */
function lumipix_enqueue_app( $app ) {
	$deps = array();
	wp_enqueue_script( 'lumipix-tool-core', LUMIPIX_URI . '/assets/js/tools/core.js', array(), lumipix_asset_ver( 'assets/js/tools/core.js' ), array( 'strategy' => 'defer', 'in_footer' => true ) );
	$deps[] = 'lumipix-tool-core';

	$file = 'assets/js/tools/' . sanitize_key( $app ) . '.js';
	if ( file_exists( LUMIPIX_DIR . '/' . $file ) ) {
		wp_enqueue_script( 'lumipix-app-' . $app, LUMIPIX_URI . '/' . $file, $deps, lumipix_asset_ver( $file ), array( 'strategy' => 'defer', 'in_footer' => true ) );
	}

	static $localized = false;
	if ( ! $localized ) {
		$localized = true;
		wp_localize_script(
			'lumipix-tool-core',
			'LumipixConfig',
			array(
				'bgModel'     => get_theme_mod( 'lumipix_bg_model', 'Xenova/modnet' ),
				'bgLibrary'   => get_theme_mod( 'lumipix_bg_library', 'https://cdn.jsdelivr.net/npm/@huggingface/transformers@3.8.1' ),
				'maxFiles'    => 20,
				'i18n'        => array(
					'saved'        => __( 'saved', 'lumipix' ),
					'download'     => __( 'Download', 'lumipix' ),
					'downloadAll'  => __( 'Download all', 'lumipix' ),
					'processing'   => __( 'Processing…', 'lumipix' ),
					'done'         => __( 'Done', 'lumipix' ),
					'error'        => __( 'Something went wrong with this file.', 'lumipix' ),
					'unsupported'  => __( 'This file type cannot be opened by your browser.', 'lumipix' ),
					'tooMany'      => __( 'Only the first 20 files were added.', 'lumipix' ),
					'loadingModel' => __( 'Downloading AI model (one time only)…', 'lumipix' ),
					'runningModel' => __( 'Removing background…', 'lumipix' ),
					'modelFailed'  => __( 'The AI model could not be loaded. Check your connection and try again.', 'lumipix' ),
					'underTarget'  => __( 'Fits target', 'lumipix' ),
					'overTarget'   => __( 'Smallest possible – still above target', 'lumipix' ),
				),
			)
		);
	}
}

/**
 * Preload the main font file for faster first paint.
 */
function lumipix_preload_fonts() {
	printf(
		'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
		esc_url( LUMIPIX_URI . '/assets/fonts/geist-latin.woff2' )
	);
}
add_action( 'wp_head', 'lumipix_preload_fonts', 1 );

/**
 * Fallback favicon until a Site Icon is set in the Customizer.
 */
function lumipix_fallback_favicon() {
	if ( ! has_site_icon() ) {
		printf( '<link rel="icon" href="%s" type="image/svg+xml">' . "\n", esc_url( LUMIPIX_URI . '/assets/img/logo-mark.svg' ) );
	}
}
add_action( 'wp_head', 'lumipix_fallback_favicon', 3 );

/**
 * Apply the stored colour scheme before paint to avoid a flash.
 */
function lumipix_theme_bootstrap_script() {
	echo "<script>(function(){try{var t=localStorage.getItem('lumipix-theme');if(t==='dark'||t==='light'){document.documentElement.setAttribute('data-theme',t);}}catch(e){}})();</script>\n";
}
add_action( 'wp_head', 'lumipix_theme_bootstrap_script', 0 );

/**
 * Route pages that host a tool to the tool template.
 *
 * @param string $template Template path.
 * @return string
 */
function lumipix_template_include( $template ) {
	if ( is_page() && ! is_front_page() && lumipix_page_tool_key( get_queried_object_id() ) ) {
		$tool_template = locate_template( 'templates/tool.php' );
		if ( $tool_template ) {
			return $tool_template;
		}
	}
	return $template;
}
add_filter( 'template_include', 'lumipix_template_include' );

/**
 * Body classes.
 *
 * @param string[] $classes Classes.
 * @return string[]
 */
function lumipix_body_class( $classes ) {
	if ( is_page() && lumipix_page_tool_key( get_queried_object_id() ) ) {
		$classes[] = 'is-tool-page';
	}
	return $classes;
}
add_filter( 'body_class', 'lumipix_body_class' );

/**
 * Remove emoji scripts (performance).
 */
function lumipix_disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
}
add_action( 'init', 'lumipix_disable_emojis' );

/**
 * Shorter excerpts.
 *
 * @return int
 */
function lumipix_excerpt_length() {
	return 24;
}
add_filter( 'excerpt_length', 'lumipix_excerpt_length' );

/**
 * Excerpt suffix.
 *
 * @return string
 */
function lumipix_excerpt_more() {
	return '…';
}
add_filter( 'excerpt_more', 'lumipix_excerpt_more' );
