<?php
/**
 * Rank Math integration: fills the SEO title, meta description, five focus
 * keywords and the social image of every page, tool page and article the
 * theme created, from the bundled content pack.
 *
 * A field is only written when it is empty or still holds the value this
 * theme wrote last time, so anything edited in the Rank Math box is kept.
 *
 * @package Lumipix
 */

defined( 'ABSPATH' ) || exit;

/** Bump when the bundled keywords, titles or descriptions change. */
define( 'LUMIPIX_RM_REV', 1 );

/**
 * SEO data for everything the theme manages.
 *
 * @return array<int, array{title: string, desc: string, keywords: string, image: string}> Keyed by post ID.
 */
function lumipix_rm_items() {
	$items = array();

	foreach ( lumipix_installer_pages() as $key => $page ) {
		$id = lumipix_installer_page_id( $key );
		if ( ! $id ) {
			continue;
		}
		if ( 'blog' === $key ) {
			$items[ $id ] = array(
				'title'    => __( 'Image Guides & Tutorials – Compress, Resize, Edit | Lumi Pix', 'lumipix' ),
				'desc'     => __( 'Image guides and tutorials: short, practical guides to compressing, resizing and editing images, from exact KB sizes to passport photos.', 'lumipix' ),
				'keywords' => 'image guides, image tutorials, how to compress image, how to resize image, remove background guide',
				'image'    => 'assets/og/home.jpg',
			);
			continue;
		}
		$pack = lumipix_pack_page( $page['file'] );
		if ( ! $pack ) {
			continue;
		}
		$items[ $id ] = array(
			'title'    => $pack['meta']['seo_title'] ?? '',
			'desc'     => $pack['meta']['seo_desc'] ?? '',
			'keywords' => $pack['meta']['keywords'] ?? '',
			'image'    => 'assets/og/home.jpg',
		);
	}

	foreach ( lumipix_tools() as $key => $tool ) {
		$id = lumipix_tool_page_id( $key );
		if ( ! $id ) {
			continue;
		}
		$file = LUMIPIX_DIR . '/content/tools/' . sanitize_file_name( $key ) . '.md';
		$meta = file_exists( $file ) ? lumipix_md_parse( (string) file_get_contents( $file ) )['meta'] : array(); // phpcs:ignore WordPress.WP.AlternativeFunctions
		$title = (string) get_post_meta( $id, '_lumipix_seo_title', true );
		$desc  = (string) get_post_meta( $id, '_lumipix_seo_desc', true );
		$items[ $id ] = array(
			'title'    => $title ? $title : $tool['title'],
			'desc'     => $desc ? $desc : ( $meta['seo_desc'] ?? $tool['desc'] ),
			'keywords' => $meta['keywords'] ?? '',
			'image'    => 'assets/og/tool-' . $key . '.jpg',
		);
	}

	foreach ( lumipix_pack_posts() as $item ) {
		$post = get_page_by_path( $item['slug'], OBJECT, 'post' );
		if ( ! $post ) {
			continue;
		}
		$meta = lumipix_md_parse( (string) file_get_contents( $item['file'] ) )['meta']; // phpcs:ignore WordPress.WP.AlternativeFunctions
		$items[ $post->ID ] = array(
			'title'    => $meta['seo_title'] ?? ( $meta['title'] ?? '' ),
			'desc'     => $meta['seo_desc'] ?? '',
			'keywords' => $meta['keywords'] ?? '',
			'image'    => '', // Rank Math uses the featured image.
		);
	}

	return $items;
}

/**
 * Write the Rank Math fields, keeping anything edited by hand.
 *
 * @return int Number of posts updated.
 */
function lumipix_rm_sync() {
	$updated = 0;
	foreach ( lumipix_rm_items() as $id => $data ) {
		$keywords = implode( ',', array_filter( array_map( 'trim', explode( ',', $data['keywords'] ) ) ) );
		$values   = array(
			'rank_math_title'          => $data['title'],
			'rank_math_description'    => $data['desc'],
			'rank_math_focus_keyword'  => $keywords,
			'rank_math_facebook_image' => $data['image'] && file_exists( LUMIPIX_DIR . '/' . $data['image'] ) ? LUMIPIX_URI . '/' . $data['image'] : '',
		);
		$written = (array) get_post_meta( $id, '_lumipix_rm', true );
		$changed = false;
		foreach ( $values as $meta_key => $value ) {
			if ( '' === $value ) {
				continue;
			}
			$current = (string) get_post_meta( $id, $meta_key, true );
			$ours    = isset( $written[ $meta_key ] ) ? (string) $written[ $meta_key ] : null;
			if ( '' !== $current && $current !== $ours ) {
				continue; // Edited in Rank Math: leave it alone.
			}
			if ( $current !== $value ) {
				update_post_meta( $id, $meta_key, $value );
				$changed = true;
			}
			$written[ $meta_key ] = $value;
		}
		if ( ! empty( $values['rank_math_facebook_image'] ) && ! get_post_meta( $id, 'rank_math_twitter_use_facebook', true ) ) {
			update_post_meta( $id, 'rank_math_twitter_use_facebook', 'on' );
		}
		update_post_meta( $id, '_lumipix_rm', $written );
		if ( $changed ) {
			++$updated;
		}
	}
	update_option( 'lumipix_rm_rev_done', LUMIPIX_RM_REV );
	return $updated;
}

/**
 * Sync automatically once Rank Math is active, and again after a theme
 * update that ships new SEO data.
 */
function lumipix_rm_maybe_sync() {
	if ( ! defined( 'RANK_MATH_VERSION' ) || ! current_user_can( 'manage_options' ) ) {
		return;
	}
	if ( (int) get_option( 'lumipix_rm_rev_done' ) >= LUMIPIX_RM_REV && (int) get_option( 'lumipix_rm_pack_rev' ) >= (int) get_option( 'lumipix_pack_rev_done' ) ) {
		return;
	}
	lumipix_rm_sync();
	update_option( 'lumipix_rm_pack_rev', (int) get_option( 'lumipix_pack_rev_done' ) );
}
add_action( 'admin_init', 'lumipix_rm_maybe_sync', 20 );
