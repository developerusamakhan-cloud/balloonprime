<?php
/**
 * Content features: shortcodes, article → tool CTAs, tool → article links.
 *
 * @package Lumipix
 */

defined( 'ABSPATH' ) || exit;

/**
 * [lumipix_tool key="compress-image-to-50kb"] – embeds a working tool anywhere.
 *
 * @param array<string, string> $atts Attributes.
 * @return string
 */
function lumipix_tool_shortcode( $atts ) {
	$atts = shortcode_atts( array( 'key' => 'compress-image' ), $atts, 'lumipix_tool' );
	$key  = sanitize_key( $atts['key'] );
	if ( ! lumipix_get_tool( $key ) ) {
		return '';
	}
	return '<div class="embedded-tool">' . lumipix_render_tool_app( $key ) . '</div>';
}
add_shortcode( 'lumipix_tool', 'lumipix_tool_shortcode' );

/**
 * [lumipix_cta tool="background-remover"] – a call-to-action card linking to a tool.
 *
 * @param array<string, string> $atts Attributes.
 * @return string
 */
function lumipix_cta_shortcode( $atts ) {
	$atts = shortcode_atts( array( 'tool' => '' ), $atts, 'lumipix_cta' );
	return lumipix_cta_card( sanitize_key( $atts['tool'] ) );
}
add_shortcode( 'lumipix_cta', 'lumipix_cta_shortcode' );

/**
 * Tool CTA card markup.
 *
 * @param string $key Tool key.
 * @return string
 */
function lumipix_cta_card( $key ) {
	$tool = lumipix_get_tool( $key );
	$url  = lumipix_tool_url( $key );
	if ( ! $tool || ! $url ) {
		return '';
	}
	return sprintf(
		'<aside class="cta-card tone-%1$s"><span class="cta-card__icon">%2$s</span><div class="cta-card__body"><p class="cta-card__eyebrow">%3$s</p><p class="cta-card__title">%4$s</p><p class="cta-card__text">%5$s</p></div><a class="btn btn--primary" href="%6$s">%7$s %8$s</a></aside>',
		esc_attr( $tool['group'] ),
		lumipix_icon( $tool['icon'], 22 ),
		esc_html__( 'Free tool · no signup', 'lumipix' ),
		esc_html( $tool['h1'] ),
		esc_html( $tool['lead'] ),
		esc_url( $url ),
		esc_html__( 'Open tool', 'lumipix' ),
		lumipix_icon( 'arrow', 16 )
	);
}

/**
 * Related tool for a post (meta set in the editor sidebar), with a fallback.
 *
 * @param int $post_id Post ID.
 * @return string
 */
function lumipix_post_related_tool( $post_id ) {
	$key = (string) get_post_meta( $post_id, '_lumipix_related_tool', true );
	return ( $key && lumipix_get_tool( $key ) ) ? $key : '';
}

/**
 * Insert a CTA to the related tool after the second paragraph of a post.
 * Skipped when the post already contains a Lumipix shortcode.
 *
 * @param string $content Post content.
 * @return string
 */
function lumipix_inject_cta( $content ) {
	if ( ! is_singular( 'post' ) || ! in_the_loop() || ! is_main_query() ) {
		return $content;
	}
	if ( false !== strpos( $content, 'cta-card' ) || false !== strpos( $content, 'tool-app' ) ) {
		return $content;
	}
	$key = lumipix_post_related_tool( get_the_ID() );
	if ( ! $key ) {
		return $content;
	}
	$cta = lumipix_cta_card( $key );
	$pos = 0;
	for ( $i = 0; $i < 2; $i++ ) {
		$found = strpos( $content, '</p>', $pos );
		if ( false === $found ) {
			return $content . $cta;
		}
		$pos = $found + 4;
	}
	// Only inject mid-article when there is more content after the insertion point.
	if ( strlen( trim( substr( $content, $pos ) ) ) < 200 ) {
		return $content . $cta;
	}
	return substr( $content, 0, $pos ) . $cta . substr( $content, $pos );
}
add_filter( 'the_content', 'lumipix_inject_cta', 20 );

/**
 * Posts that link to a tool (via the related-tool field), newest first.
 *
 * @param string $key   Tool key.
 * @param int    $count How many.
 * @return WP_Post[]
 */
function lumipix_tool_guides( $key, $count = 3 ) {
	$tool = lumipix_get_tool( $key );
	if ( ! $tool ) {
		return array();
	}
	$keys = array_keys( lumipix_tool_family( $key ) );
	$q    = new WP_Query(
		array(
			'post_type'           => 'post',
			'posts_per_page'      => $count,
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
			'meta_query'          => array( // phpcs:ignore WordPress.DB.SlowDBQuery
				array(
					'key'     => '_lumipix_related_tool',
					'value'   => $keys,
					'compare' => 'IN',
				),
			),
		)
	);
	$posts = $q->posts;
	if ( count( $posts ) < $count ) {
		$more  = get_posts(
			array(
				'post_type'      => 'post',
				'posts_per_page' => $count - count( $posts ),
				'post__not_in'   => wp_list_pluck( $posts, 'ID' ),
				'no_found_rows'  => true,
			)
		);
		$posts = array_merge( $posts, $more );
	}
	return $posts;
}

/**
 * Related posts for a post (same category, then latest).
 *
 * @param int $post_id Post ID.
 * @param int $count   Count.
 * @return WP_Post[]
 */
function lumipix_related_posts( $post_id, $count = 3 ) {
	$cats  = wp_get_post_categories( $post_id );
	$posts = get_posts(
		array(
			'post_type'      => 'post',
			'posts_per_page' => $count,
			'post__not_in'   => array( $post_id ),
			'category__in'   => $cats,
			'no_found_rows'  => true,
		)
	);
	if ( count( $posts ) < $count ) {
		$posts = array_merge(
			$posts,
			get_posts(
				array(
					'post_type'      => 'post',
					'posts_per_page' => $count - count( $posts ),
					'post__not_in'   => array_merge( array( $post_id ), wp_list_pluck( $posts, 'ID' ) ),
					'no_found_rows'  => true,
				)
			)
		);
	}
	return $posts;
}

/**
 * [lumipix_email] – the public contact email as a mailto link.
 *
 * @return string
 */
function lumipix_email_shortcode() {
	$email = lumipix_contact_email();
	if ( ! $email ) {
		return esc_html__( '(contact email not set – add it under Appearance → Customize → Lumi Pix → Footer)', 'lumipix' );
	}
	return '<a href="mailto:' . esc_attr( antispambot( $email ) ) . '">' . esc_html( antispambot( $email ) ) . '</a>';
}
add_shortcode( 'lumipix_email', 'lumipix_email_shortcode' );

/**
 * [lumipix_site] – the site name (keeps legal pages correct if the name changes).
 *
 * @return string
 */
function lumipix_site_shortcode() {
	return esc_html( get_bloginfo( 'name' ) );
}
add_shortcode( 'lumipix_site', 'lumipix_site_shortcode' );
