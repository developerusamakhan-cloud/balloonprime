<?php
/**
 * Retired tool pages.
 *
 * Near-duplicate preset pages with little or no search demand are folded
 * into a stronger page: the tool is removed from the registry (menus, grids,
 * related tools, sitemap), its page is set to draft once, internal links point
 * at the target, and the old URL answers with a 301 to the target.
 *
 * @package Lumipix
 */

defined( 'ABSPATH' ) || exit;

/**
 * Retired tools: key => array( old slug, target tool key ).
 *
 * @return array<string, array{0: string, 1: string}>
 */
function lumipix_retired_tools() {
	return apply_filters(
		'lumipix_retired_tools',
		array(
			'compress-image-to-10kb'  => array( 'compress-image-to-10kb', 'compress-image-to-20kb' ),
			'compress-image-to-50kb'  => array( 'compress-image-to-50kb', 'compress-image' ),
			'compress-image-to-100kb' => array( 'compress-image-to-100kb', 'compress-image' ),
			'compress-image-to-200kb' => array( 'compress-image-to-200kb', 'compress-image' ),
			'compress-image-to-500kb' => array( 'compress-image-to-500kb', 'compress-image' ),
			'compress-image-to-1mb'   => array( 'compress-image-to-1mb', 'compress-image' ),
			'compress-image-to-2mb'   => array( 'compress-image-to-2mb', 'compress-image' ),
			'compress-image-to-5mb'   => array( 'compress-image-to-5mb', 'compress-image' ),
			'compress-photo-for-ppsc' => array( 'compress-photo-for-ppsc-form', 'compress-image' ),
			'compress-photo-for-fpsc' => array( 'compress-photo-for-fpsc-form', 'compress-image' ),
			'compress-photo-for-nts'  => array( 'compress-photo-for-nts-form', 'compress-image' ),
		)
	);
}

/**
 * Target tool key for a retired key, or '' when the key is not retired.
 *
 * @param string $key Tool key.
 * @return string
 */
function lumipix_retired_target( $key ) {
	$retired = lumipix_retired_tools();
	return isset( $retired[ $key ] ) ? $retired[ $key ][1] : '';
}

/**
 * Drop retired tools from the registry.
 *
 * @param array<string, array<string, mixed>> $tools Tools.
 * @return array<string, array<string, mixed>>
 */
function lumipix_filter_retired_tools( $tools ) {
	foreach ( array_keys( lumipix_retired_tools() ) as $key ) {
		unset( $tools[ $key ] );
	}
	foreach ( $tools as $key => $tool ) {
		if ( ! empty( $tool['related'] ) ) {
			$tools[ $key ]['related'] = array_values( array_diff( (array) $tool['related'], array_keys( lumipix_retired_tools() ) ) );
		}
	}
	return $tools;
}
add_filter( 'lumipix_tools', 'lumipix_filter_retired_tools', 99 );

/**
 * 301 old URLs to the target page. Runs before WordPress decides on a 404.
 */
function lumipix_redirect_retired_tools() {
	if ( is_admin() ) {
		return;
	}
	$path = trim( (string) wp_parse_url( isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '', PHP_URL_PATH ), '/' ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
	if ( '' === $path || false !== strpos( $path, '/' ) ) {
		return;
	}
	foreach ( lumipix_retired_tools() as $retired ) {
		if ( $path === $retired[0] ) {
			$url = lumipix_tool_url( $retired[1] );
			if ( $url ) {
				wp_safe_redirect( $url, 301 );
				exit;
			}
		}
	}
}
add_action( 'template_redirect', 'lumipix_redirect_retired_tools', 1 );

/**
 * Set the pages of retired tools to draft (once per list change), so they
 * leave the sitemap and search. Nothing is deleted.
 */
function lumipix_unpublish_retired_tools() {
	$sig = md5( wp_json_encode( lumipix_retired_tools() ) );
	if ( get_option( 'lumipix_retired_sig' ) === $sig ) {
		return;
	}
	update_option( 'lumipix_retired_sig', $sig );
	foreach ( lumipix_retired_tools() as $key => $retired ) {
		$ids = get_posts(
			array(
				'post_type'      => 'page',
				'post_status'    => 'publish',
				'posts_per_page' => 5,
				'fields'         => 'ids',
				'meta_key'       => '_lumipix_tool', // phpcs:ignore WordPress.DB.SlowDBQuery
				'meta_value'     => $key, // phpcs:ignore WordPress.DB.SlowDBQuery
			)
		);
		$page = get_page_by_path( $retired[0] );
		if ( $page && 'publish' === $page->post_status ) {
			$ids[] = (int) $page->ID;
		}
		foreach ( array_unique( array_map( 'intval', $ids ) ) as $id ) {
			wp_update_post(
				array(
					'ID'          => $id,
					'post_status' => 'draft',
				)
			);
		}
	}
	if ( defined( 'RANK_MATH_VERSION' ) && method_exists( '\\RankMath\\Sitemap\\Cache', 'invalidate_storage' ) ) {
		\RankMath\Sitemap\Cache::invalidate_storage();
	}
}
add_action( 'init', 'lumipix_unpublish_retired_tools', 25 );
