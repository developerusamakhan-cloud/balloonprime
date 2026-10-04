<?php
/**
 * Lightweight SEO: titles, meta descriptions, Open Graph and JSON-LD.
 *
 * When Yoast, Rank Math, SEOPress or AIOSEO is active, the generic parts
 * (description, Open Graph, breadcrumb/website schema) are left to the plugin;
 * tool-specific schema (WebApplication + FAQPage) is always printed.
 *
 * @package Lumipix
 */

defined( 'ABSPATH' ) || exit;

/**
 * Whether a dedicated SEO plugin is active.
 *
 * @return bool
 */
function lumipix_seo_plugin_active() {
	return defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'SEOPRESS_VERSION' ) || defined( 'AIOSEO_VERSION' );
}

/**
 * Tool on the current request, if any.
 *
 * @return array<string, mixed>|null
 */
function lumipix_current_tool() {
	if ( ! is_page() ) {
		return null;
	}
	$key = lumipix_page_tool_key( get_queried_object_id() );
	return $key ? lumipix_get_tool( $key ) : null;
}

/**
 * SEO title for tool pages (the full <title>, without the site name suffix).
 *
 * @param array<string, string> $parts Title parts.
 * @return array<string, string>
 */
function lumipix_document_title_parts( $parts ) {
	if ( lumipix_seo_plugin_active() ) {
		return $parts;
	}
	$tool = lumipix_current_tool();
	if ( $tool ) {
		$custom = (string) get_post_meta( get_queried_object_id(), '_lumipix_seo_title', true );
		$parts['title'] = $custom ? $custom : $tool['title'];
	} elseif ( is_front_page() ) {
		$parts['title']   = get_bloginfo( 'name' );
		$parts['tagline'] = get_theme_mod( 'lumipix_home_title', __( 'Free Image Tools – Compress, Resize & Remove Background', 'lumipix' ) );
	} elseif ( is_singular() ) {
		$custom = (string) get_post_meta( get_queried_object_id(), '_lumipix_seo_title', true );
		if ( $custom ) {
			$parts['title'] = $custom;
		}
	}
	return $parts;
}
add_filter( 'document_title_parts', 'lumipix_document_title_parts' );

/**
 * Title separator.
 *
 * @return string
 */
function lumipix_title_separator() {
	return '·';
}
add_filter( 'document_title_separator', 'lumipix_title_separator' );

/**
 * Meta description for the current request.
 *
 * @return string
 */
function lumipix_meta_description() {
	$tool = lumipix_current_tool();
	if ( $tool ) {
		$custom = (string) get_post_meta( get_queried_object_id(), '_lumipix_seo_desc', true );
		return $custom ? $custom : $tool['desc'];
	}
	if ( is_front_page() ) {
		return (string) get_theme_mod( 'lumipix_home_desc', __( 'Compress images to an exact KB size, resize in pixels or cm, and remove backgrounds with on-device AI. Free, no signup, and your photos never leave your device.', 'lumipix' ) );
	}
	if ( is_singular() ) {
		$post = get_queried_object();
		$desc = (string) get_post_meta( $post->ID, '_lumipix_seo_desc', true );
		if ( ! $desc ) {
			$desc = has_excerpt( $post ) ? $post->post_excerpt : wp_trim_words( wp_strip_all_tags( strip_shortcodes( $post->post_content ) ), 28, '…' );
		}
		return $desc;
	}
	if ( is_category() || is_tag() ) {
		return wp_strip_all_tags( term_description() );
	}
	return (string) get_bloginfo( 'description' );
}

/**
 * Print meta description and Open Graph tags.
 */
function lumipix_head_meta() {
	if ( lumipix_seo_plugin_active() ) {
		return;
	}
	$desc = trim( preg_replace( '/\s+/', ' ', lumipix_meta_description() ) );
	if ( $desc ) {
		printf( '<meta name="description" content="%s">' . "\n", esc_attr( $desc ) );
	}
	$title = wp_get_document_title();
	$url   = is_singular() ? get_permalink() : ( is_front_page() ? home_url( '/' ) : '' );
	$image = '';
	if ( is_singular() && has_post_thumbnail() ) {
		$image = get_the_post_thumbnail_url( null, 'lumipix-hero' );
	}
	if ( ! $image ) {
		$image = (string) get_theme_mod( 'lumipix_og_image', '' );
	}
	printf( '<meta property="og:site_name" content="%s">' . "\n", esc_attr( get_bloginfo( 'name' ) ) );
	printf( '<meta property="og:type" content="%s">' . "\n", is_singular( 'post' ) ? 'article' : 'website' );
	printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $title ) );
	if ( $desc ) {
		printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( $desc ) );
	}
	if ( $url ) {
		printf( '<meta property="og:url" content="%s">' . "\n", esc_url( $url ) );
	}
	if ( $image ) {
		printf( '<meta property="og:image" content="%s">' . "\n", esc_url( $image ) );
	}
	printf( '<meta name="twitter:card" content="%s">' . "\n", $image ? 'summary_large_image' : 'summary' );
}
add_action( 'wp_head', 'lumipix_head_meta', 2 );

/**
 * Output JSON-LD.
 *
 * @param array<string, mixed> $data Schema graph item(s).
 */
function lumipix_print_jsonld( $data ) {
	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}

/**
 * Structured data.
 */
function lumipix_schema() {
	$graph  = array();
	$plugin = lumipix_seo_plugin_active();

	if ( is_front_page() && ! $plugin ) {
		$graph[] = array(
			'@type'           => 'WebSite',
			'@id'             => home_url( '/#website' ),
			'url'             => home_url( '/' ),
			'name'            => get_bloginfo( 'name' ),
			'description'     => lumipix_meta_description(),
			'potentialAction' => array(
				'@type'       => 'SearchAction',
				'target'      => home_url( '/?s={search_term_string}' ),
				'query-input' => 'required name=search_term_string',
			),
		);
		$graph[] = array(
			'@type' => 'Organization',
			'@id'   => home_url( '/#organization' ),
			'name'  => get_bloginfo( 'name' ),
			'url'   => home_url( '/' ),
			'logo'  => LUMIPIX_URI . '/assets/img/logo-512.png',
		);
	}

	$tool = lumipix_current_tool();
	if ( $tool ) {
		$graph[] = array(
			'@type'               => 'WebApplication',
			'name'                => $tool['h1'],
			'url'                 => get_permalink( get_queried_object_id() ),
			'description'         => $tool['desc'],
			'applicationCategory' => 'MultimediaApplication',
			'operatingSystem'     => 'Any (runs in the browser)',
			'browserRequirements' => 'Requires JavaScript and a modern browser',
			'isAccessibleForFree' => true,
			'offers'              => array(
				'@type'         => 'Offer',
				'price'         => '0',
				'priceCurrency' => 'USD',
			),
		);
		if ( ! empty( $tool['faqs'] ) ) {
			$faq = array();
			foreach ( $tool['faqs'] as $q => $a ) {
				$faq[] = array(
					'@type'          => 'Question',
					'name'           => $q,
					'acceptedAnswer' => array(
						'@type' => 'Answer',
						'text'  => $a,
					),
				);
			}
			$graph[] = array(
				'@type'      => 'FAQPage',
				'mainEntity' => $faq,
			);
		}
	}

	if ( is_singular( 'post' ) && ! $plugin ) {
		$post    = get_queried_object();
		$graph[] = array(
			'@type'            => 'BlogPosting',
			'headline'         => get_the_title( $post ),
			'datePublished'    => get_the_date( 'c', $post ),
			'dateModified'     => get_the_modified_date( 'c', $post ),
			'author'           => array(
				'@type' => 'Person',
				'name'  => get_the_author_meta( 'display_name', $post->post_author ),
			),
			'mainEntityOfPage' => get_permalink( $post ),
			'image'            => has_post_thumbnail( $post ) ? get_the_post_thumbnail_url( $post, 'lumipix-hero' ) : null,
			'publisher'        => array(
				'@type' => 'Organization',
				'name'  => get_bloginfo( 'name' ),
			),
		);
	}

	if ( ! is_front_page() && ! $plugin && ( is_singular() || is_archive() || is_home() ) ) {
		$list = array();
		foreach ( lumipix_breadcrumb_items() as $i => $item ) {
			$entry = array(
				'@type'    => 'ListItem',
				'position' => $i + 1,
				'name'     => $item[0],
			);
			if ( $item[1] ) {
				$entry['item'] = $item[1];
			}
			$list[] = $entry;
		}
		$graph[] = array(
			'@type'           => 'BreadcrumbList',
			'itemListElement' => $list,
		);
	}

	if ( $graph ) {
		lumipix_print_jsonld(
			array(
				'@context' => 'https://schema.org',
				'@graph'   => array_values( array_map( 'array_filter', $graph ) ),
			)
		);
	}
}
add_action( 'wp_head', 'lumipix_schema', 20 );
