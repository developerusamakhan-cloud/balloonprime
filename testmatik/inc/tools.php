<?php
/**
 * Tool registry: one entry per test page.
 *
 * Extend with the `testmatik_tools` filter from a child theme or plugin.
 *
 * @package Testmatik
 */

defined( 'ABSPATH' ) || exit;

/**
 * All tools, keyed by slug.
 *
 * @return array
 */
function testmatik_tools() {
	static $tools = null;
	if ( null !== $tools ) {
		return $tools;
	}
	$tools = apply_filters(
		'testmatik_tools',
		array(
			'klavye-testi'     => array(
				'name'     => 'Klavye Testi',
				'short'    => 'Klavye',
				'icon'     => 'keyboard',
				'tone'     => 'indigo',
				'script'   => 'keyboard',
				'category' => 'Klavye',
				'blurb'    => 'Her tuşu tek tek kontrol edin. Türkçe Q ve F düzeni, ghosting ve NKRO ölçümü.',
				'tags'     => array( 'Q klavye', 'F klavye', 'NKRO' ),
				'keywords' => 'klavye tuş q f keyboard ghosting nkro',
			),
			'olu-piksel-testi' => array(
				'name'     => 'Ölü Piksel Testi',
				'short'    => 'Ekran',
				'icon'     => 'monitor',
				'tone'     => 'rose',
				'script'   => 'pixel',
				'category' => 'Ekran',
				'blurb'    => 'Tam ekran renklerle ölü ve sıkışmış pikselleri bulun, piksel onarıcıyı deneyin.',
				'tags'     => array( 'Monitör', 'Laptop', 'Telefon' ),
				'keywords' => 'ölü piksel ekran monitör sıkışmış piksel dead pixel',
			),
			'mikrofon-testi'   => array(
				'name'     => 'Mikrofon Testi',
				'short'    => 'Mikrofon',
				'icon'     => 'mic',
				'tone'     => 'emerald',
				'script'   => 'mic',
				'category' => 'Ses',
				'blurb'    => 'Ses seviyesini canlı görün, 5 saniye kaydedip kendinizi dinleyin.',
				'tags'     => array( 'Kulaklık', 'USB', 'Laptop' ),
				'keywords' => 'mikrofon ses kayıt kulaklık mic',
			),
			'kamera-testi'     => array(
				'name'     => 'Kamera Testi',
				'short'    => 'Kamera',
				'icon'     => 'camera',
				'tone'     => 'sky',
				'script'   => 'camera',
				'category' => 'Kamera',
				'blurb'    => 'Web kameranızı açın; gerçek çözünürlüğü, FPS değerini ve görüntü kalitesini görün.',
				'tags'     => array( 'Webcam', '1080p', 'FPS' ),
				'keywords' => 'kamera webcam web kamera çözünürlük fps',
			),
			'mouse-testi'      => array(
				'name'     => 'Mouse Testi',
				'short'    => 'Mouse',
				'icon'     => 'mouse',
				'tone'     => 'amber',
				'script'   => 'mouse',
				'category' => 'Mouse',
				'blurb'    => 'Tıklamaları, tekerleği ve yan tuşları sınayın; çift tıklama sorununu yakalayın.',
				'tags'     => array( 'Çift tıklama', 'Hz', 'CPS' ),
				'keywords' => 'mouse fare tıklama çift tıklama double click hz cps',
			),
			'hoparlor-testi'   => array(
				'name'     => 'Hoparlör Testi',
				'short'    => 'Hoparlör',
				'icon'     => 'speaker',
				'tone'     => 'violet',
				'script'   => 'speaker',
				'category' => 'Ses',
				'blurb'    => 'Sol ve sağ kanalı ayrı dinleyin, 20 Hz – 20 kHz frekans taraması yapın.',
				'tags'     => array( 'Sağ / sol', 'Frekans', 'Kulaklık' ),
				'keywords' => 'hoparlör kulaklık ses sağ sol stereo frekans',
			),
		)
	);
	return $tools;
}

/**
 * One tool, or null.
 *
 * @param string $key Tool key.
 * @return array|null
 */
function testmatik_get_tool( $key ) {
	$tools = testmatik_tools();
	return isset( $tools[ $key ] ) ? $tools[ $key ] : null;
}

/**
 * Map of tool key => page ID (stored by the installer, repaired on demand).
 *
 * @return array
 */
function testmatik_tool_pages() {
	$map = get_option( 'testmatik_tool_pages', array() );
	return is_array( $map ) ? $map : array();
}

/**
 * Page ID for a tool, or 0.
 *
 * @param string $key Tool key.
 * @return int
 */
function testmatik_tool_page_id( $key ) {
	$map = testmatik_tool_pages();
	$id  = isset( $map[ $key ] ) ? (int) $map[ $key ] : 0;
	if ( $id && 'publish' === get_post_status( $id ) ) {
		return $id;
	}
	$found = get_posts(
		array(
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'meta_key'       => '_testmatik_tool', // phpcs:ignore WordPress.DB.SlowDBQuery
			'meta_value'     => $key, // phpcs:ignore WordPress.DB.SlowDBQuery
			'posts_per_page' => 1,
			'fields'         => 'ids',
			'no_found_rows'  => true,
		)
	);
	if ( $found ) {
		$map[ $key ] = (int) $found[0];
		update_option( 'testmatik_tool_pages', $map, false );
		return (int) $found[0];
	}
	return 0;
}

/**
 * Permalink of a tool page, or empty string.
 *
 * @param string $key Tool key.
 * @return string
 */
function testmatik_tool_url( $key ) {
	$id = testmatik_tool_page_id( $key );
	return $id ? get_permalink( $id ) : '';
}

/**
 * Tool key shown on the current (or given) page, or empty string.
 *
 * @param int $post_id Post ID.
 * @return string
 */
function testmatik_page_tool( $post_id = 0 ) {
	$post_id = $post_id ? $post_id : get_queried_object_id();
	if ( ! $post_id ) {
		return '';
	}
	$key = (string) get_post_meta( $post_id, '_testmatik_tool', true );
	return ( $key && testmatik_get_tool( $key ) ) ? $key : '';
}
