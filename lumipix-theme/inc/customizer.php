<?php
/**
 * Customizer settings (Appearance → Customize → Lumipix).
 *
 * @package Lumipix
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register settings.
 *
 * @param WP_Customize_Manager $wp_customize Manager.
 */
function lumipix_customize_register( $wp_customize ) {
	$wp_customize->add_panel(
		'lumipix',
		array(
			'title'    => __( 'Lumipix', 'lumipix' ),
			'priority' => 30,
		)
	);

	// Home page.
	$wp_customize->add_section( 'lumipix_home', array( 'title' => __( 'Home page', 'lumipix' ), 'panel' => 'lumipix' ) );
	$home = array(
		'lumipix_hero_eyebrow' => array( __( 'Hero badge', 'lumipix' ), __( 'Free · No signup · 100% private', 'lumipix' ) ),
		'lumipix_hero_title'   => array( __( 'Hero heading (wrap a word in *asterisks* for the serif accent)', 'lumipix' ), __( 'Image tools that *never* upload your photos', 'lumipix' ) ),
		'lumipix_hero_text'    => array( __( 'Hero text', 'lumipix' ), __( 'Compress to an exact KB size, resize for print or Instagram, and remove backgrounds with AI that runs on your device. Fast, free, and private by design.', 'lumipix' ) ),
		'lumipix_home_title'   => array( __( 'Home SEO title', 'lumipix' ), __( 'Free Image Tools – Compress, Resize & Remove Background', 'lumipix' ) ),
		'lumipix_home_desc'    => array( __( 'Home meta description', 'lumipix' ), __( 'Compress images to an exact KB size, resize in pixels or cm, and remove backgrounds with on-device AI. Free, no signup, and your photos never leave your device.', 'lumipix' ) ),
	);
	foreach ( $home as $id => $def ) {
		$wp_customize->add_setting( $id, array( 'default' => $def[1], 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_control( $id, array( 'label' => $def[0], 'section' => 'lumipix_home', 'type' => ( 'lumipix_hero_text' === $id || 'lumipix_home_desc' === $id ) ? 'textarea' : 'text' ) );
	}
	$wp_customize->add_setting( 'lumipix_og_image', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'lumipix_og_image', array( 'label' => __( 'Default social share image (1200×630)', 'lumipix' ), 'section' => 'lumipix_home' ) ) );

	// Background remover engine.
	$wp_customize->add_section(
		'lumipix_bg',
		array(
			'title'       => __( 'Background remover', 'lumipix' ),
			'panel'       => 'lumipix',
			'description' => __( 'The background remover runs a Transformers.js model in the visitor\'s browser. Check the licence of any model before using it commercially.', 'lumipix' ),
		)
	);
	$wp_customize->add_setting( 'lumipix_bg_model', array( 'default' => 'Xenova/modnet', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'lumipix_bg_model', array( 'label' => __( 'Hugging Face model ID', 'lumipix' ), 'section' => 'lumipix_bg', 'type' => 'text' ) );
	$wp_customize->add_setting( 'lumipix_bg_library', array( 'default' => 'https://cdn.jsdelivr.net/npm/@huggingface/transformers@3.8.1', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( 'lumipix_bg_library', array( 'label' => __( 'Transformers.js module URL', 'lumipix' ), 'section' => 'lumipix_bg', 'type' => 'url' ) );

	// Ads.
	$wp_customize->add_section(
		'lumipix_ads',
		array(
			'title'       => __( 'Ads (AdSense)', 'lumipix' ),
			'panel'       => 'lumipix',
			'description' => __( 'Ads are placed below the tool, in the middle of articles and in the blog sidebar – never above the tool. Leave disabled until the site has steady traffic.', 'lumipix' ),
		)
	);
	$wp_customize->add_setting( 'lumipix_ads_enabled', array( 'default' => false, 'sanitize_callback' => 'wp_validate_boolean' ) );
	$wp_customize->add_control( 'lumipix_ads_enabled', array( 'label' => __( 'Enable ads', 'lumipix' ), 'section' => 'lumipix_ads', 'type' => 'checkbox' ) );
	$ads = array(
		'lumipix_ads_client'           => __( 'Publisher ID (ca-pub-…)', 'lumipix' ),
		'lumipix_ads_slot_tool_below'  => __( 'Slot ID – below tool', 'lumipix' ),
		'lumipix_ads_slot_article_mid' => __( 'Slot ID – in article', 'lumipix' ),
		'lumipix_ads_slot_sidebar'     => __( 'Slot ID – blog sidebar', 'lumipix' ),
	);
	foreach ( $ads as $id => $label ) {
		$wp_customize->add_setting( $id, array( 'default' => '', 'sanitize_callback' => 'lumipix_sanitize_ad_id' ) );
		$wp_customize->add_control( $id, array( 'label' => $label, 'section' => 'lumipix_ads', 'type' => 'text' ) );
	}

	// Footer.
	$wp_customize->add_section( 'lumipix_footer', array( 'title' => __( 'Footer', 'lumipix' ), 'panel' => 'lumipix' ) );
	$wp_customize->add_setting( 'lumipix_footer_text', array( 'default' => __( 'Fast, private image tools that run in your browser. No uploads, no signups, no watermarks.', 'lumipix' ), 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'lumipix_footer_text', array( 'label' => __( 'Footer tagline', 'lumipix' ), 'section' => 'lumipix_footer', 'type' => 'textarea' ) );
}
add_action( 'customize_register', 'lumipix_customize_register' );

/**
 * Keep ad IDs to safe characters.
 *
 * @param string $value Value.
 * @return string
 */
function lumipix_sanitize_ad_id( $value ) {
	return preg_replace( '/[^A-Za-z0-9\-]/', '', (string) $value );
}

/**
 * Hero heading with *serif accent* markup.
 *
 * @return string Safe HTML.
 */
function lumipix_hero_title_html() {
	$raw  = (string) get_theme_mod( 'lumipix_hero_title', __( 'Image tools that *never* upload your photos', 'lumipix' ) );
	$safe = esc_html( $raw );
	return preg_replace( '/\*(.+?)\*/', '<em class="serif-accent">$1</em>', $safe );
}
