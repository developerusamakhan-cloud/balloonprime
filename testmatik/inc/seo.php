<?php
/**
 * SEO: titles, meta description, Open Graph, robots and JSON-LD.
 *
 * Titles, descriptions and Open Graph step aside when Rank Math, Yoast, SEOPress or AIOSEO
 * is active. WebApplication and FAQPage schema are always printed, because those plugins
 * do not know about the tools or the FAQ meta box.
 *
 * @package Testmatik
 */

defined( 'ABSPATH' ) || exit;

/**
 * Is an SEO plugin handling titles and meta?
 *
 * @return bool
 */
function testmatik_seo_plugin_active() {
	return defined( 'RANK_MATH_VERSION' ) || defined( 'WPSEO_VERSION' ) || defined( 'SEOPRESS_VERSION' ) || defined( 'AIOSEO_VERSION' );
}

/**
 * SEO title for the current request.
 *
 * @return string
 */
function testmatik_seo_title() {
	if ( is_front_page() ) {
		$t = get_theme_mod( 'testmatik_home_title', '' );
		if ( ! $t ) {
			$id = (int) get_option( 'page_on_front' );
			$t  = $id ? (string) get_post_meta( $id, '_testmatik_seo_title', true ) : '';
		}
		return $t ? $t : get_bloginfo( 'name' ) . ' | ' . get_bloginfo( 'description' );
	}
	if ( is_singular() || ( is_home() && get_option( 'page_for_posts' ) ) ) {
		$t = (string) get_post_meta( is_singular() ? get_queried_object_id() : (int) get_option( 'page_for_posts' ), '_testmatik_seo_title', true );
		if ( $t ) {
			return $t;
		}
	}
	return '';
}

/**
 * Meta description for the current request.
 *
 * @return string
 */
function testmatik_seo_description() {
	$d = '';
	if ( is_front_page() ) {
		$d = get_theme_mod( 'testmatik_home_desc', '' );
		if ( ! $d ) {
			$id = (int) get_option( 'page_on_front' );
			$d  = $id ? (string) get_post_meta( $id, '_testmatik_seo_desc', true ) : '';
		}
	} elseif ( is_singular() ) {
		$id = get_queried_object_id();
		$d  = (string) get_post_meta( $id, '_testmatik_seo_desc', true );
		if ( ! $d ) {
			$d = has_excerpt( $id ) ? get_the_excerpt( $id ) : wp_trim_words( wp_strip_all_tags( (string) get_post_field( 'post_content', $id ) ), 28, '…' );
		}
	} elseif ( is_category() ) {
		$d = wp_strip_all_tags( (string) category_description() );
		if ( ! $d ) {
			/* translators: %s category name */
			$d = sprintf( __( '%s kategorisindeki rehberler: sorunları adım adım çözün ve donanımınızı ücretsiz test edin.', 'testmatik' ), single_cat_title( '', false ) );
		}
	} elseif ( is_home() ) {
		$d = (string) get_post_meta( (int) get_option( 'page_for_posts' ), '_testmatik_seo_desc', true );
		$d = $d ? $d : __( 'Klavye, ekran, mikrofon, kamera, mouse ve hoparlör sorunları için adım adım Türkçe çözüm rehberleri.', 'testmatik' );
	}
	return trim( preg_replace( '/\s+/', ' ', (string) $d ) );
}

add_filter(
	'pre_get_document_title',
	function ( $title ) {
		if ( testmatik_seo_plugin_active() ) {
			return $title;
		}
		$t = testmatik_seo_title();
		return $t ? $t : $title;
	},
	20
);

add_filter(
	'document_title_separator',
	function () {
		return '|';
	}
);

add_action(
	'wp_head',
	function () {
		if ( testmatik_seo_plugin_active() ) {
			return;
		}
		$desc  = testmatik_seo_description();
		$title = wp_get_document_title();
		$url   = is_singular() ? get_permalink() : ( is_front_page() ? home_url( '/' ) : '' );
		if ( ! $url && ( is_home() || is_category() ) ) {
			$url = is_category() ? get_category_link( get_queried_object_id() ) : testmatik_blog_url();
		}
		$image = testmatik_share_image();

		if ( $desc ) {
			echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
		}
		if ( is_search() || is_404() ) {
			echo '<meta name="robots" content="noindex, follow">' . "\n";
		} else {
			echo '<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1">' . "\n";
		}
		if ( ( is_home() || is_category() ) && $url ) {
			echo '<link rel="canonical" href="' . esc_url( $url ) . '">' . "\n";
		}
		echo '<meta property="og:locale" content="tr_TR">' . "\n";
		echo '<meta property="og:type" content="' . ( is_singular( 'post' ) ? 'article' : 'website' ) . '">' . "\n";
		echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '">' . "\n";
		echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
		if ( $desc ) {
			echo '<meta property="og:description" content="' . esc_attr( $desc ) . '">' . "\n";
		}
		if ( $url ) {
			echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";
		}
		if ( $image ) {
			echo '<meta property="og:image" content="' . esc_url( $image ) . '">' . "\n";
		}
		echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
		if ( is_singular( 'post' ) ) {
			echo '<meta property="article:published_time" content="' . esc_attr( get_the_date( 'c' ) ) . '">' . "\n";
			echo '<meta property="article:modified_time" content="' . esc_attr( get_the_modified_date( 'c' ) ) . '">' . "\n";
		}
	},
	2
);

/**
 * Share image: featured image, else the Customizer default, else the site icon.
 *
 * @return string
 */
function testmatik_share_image() {
	if ( is_singular() && has_post_thumbnail() ) {
		$src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
		if ( $src ) {
			return $src[0];
		}
	}
	$default = get_theme_mod( 'testmatik_share_image', '' );
	if ( $default ) {
		return $default;
	}
	return get_site_icon_url( 512 );
}

/**
 * Print JSON-LD.
 */
add_action(
	'wp_head',
	function () {
		$graph   = array();
		$plugin  = testmatik_seo_plugin_active();
		$home    = home_url( '/' );
		$site_id = $home . '#website';
		$org_id  = $home . '#organization';

		if ( ! $plugin ) {
			$org = array(
				'@type' => 'Organization',
				'@id'   => $org_id,
				'name'  => get_bloginfo( 'name' ),
				'url'   => $home,
			);
			$icon = get_site_icon_url( 512 );
			if ( $icon ) {
				$org['logo'] = $icon;
			}
			$graph[] = $org;
			if ( is_front_page() ) {
				$graph[] = array(
					'@type'      => 'WebSite',
					'@id'        => $site_id,
					'url'        => $home,
					'name'       => get_bloginfo( 'name' ),
					'inLanguage' => 'tr-TR',
					'publisher'  => array( '@id' => $org_id ),
				);
			}
		}

		$key = is_page() ? testmatik_page_tool() : '';
		if ( $key ) {
			$tool    = testmatik_get_tool( $key );
			$graph[] = array(
				'@type'               => 'WebApplication',
				'@id'                 => get_permalink() . '#app',
				'name'                => $tool['name'],
				'url'                 => get_permalink(),
				'description'         => testmatik_seo_description(),
				'applicationCategory' => 'UtilitiesApplication',
				'operatingSystem'     => 'Windows, macOS, Linux, Android, iOS',
				'dateModified'        => get_the_modified_date( 'c' ),
				'creator'             => array( '@id' => $org_id ),
				'publisher'           => array( '@id' => $org_id ),
				'browserRequirements' => 'Requires JavaScript. Requires HTML5.',
				'inLanguage'          => 'tr-TR',
				'isAccessibleForFree' => true,
				'offers'              => array(
					'@type'         => 'Offer',
					'price'         => '0',
					'priceCurrency' => 'TRY',
				),
			);
		}

		if ( is_page() && 'testler' === get_post_field( 'post_name', get_queried_object_id() ) ) {
			$list = array();
			$pos  = 0;
			foreach ( testmatik_tools() as $tkey => $t ) {
				$turl = testmatik_tool_url( $tkey );
				if ( ! $turl ) {
					continue;
				}
				$list[] = array(
					'@type'    => 'ListItem',
					'position' => ++$pos,
					'name'     => $t['name'],
					'url'      => $turl,
				);
			}
			if ( $list ) {
				$graph[] = array(
					'@type'           => 'ItemList',
					'@id'             => get_permalink() . '#tools',
					'name'            => get_the_title(),
					'numberOfItems'   => count( $list ),
					'itemListElement' => $list,
				);
			}
		}

		if ( is_singular( 'post' ) && ! $plugin ) {
			$id      = get_queried_object_id();
			$article = array(
				'@type'            => 'BlogPosting',
				'@id'              => get_permalink( $id ) . '#article',
				'headline'         => get_the_title( $id ),
				'description'      => testmatik_seo_description(),
				'datePublished'    => get_the_date( 'c', $id ),
				'dateModified'     => get_the_modified_date( 'c', $id ),
				'inLanguage'       => 'tr-TR',
				'mainEntityOfPage' => get_permalink( $id ),
				'author'           => testmatik_schema_author(),
				'publisher'        => array( '@id' => $org_id ),
			);
			$img = testmatik_share_image();
			if ( $img ) {
				$article['image'] = $img;
			}
			$graph[] = $article;
		}

		if ( ! $plugin && ! is_front_page() ) {
			$crumbs = testmatik_breadcrumb_items();
			if ( count( $crumbs ) > 1 ) {
				$list = array();
				foreach ( $crumbs as $i => $c ) {
					$item = array(
						'@type'    => 'ListItem',
						'position' => $i + 1,
						'name'     => $c[0],
					);
					if ( $c[1] ) {
						$item['item'] = $c[1];
					}
					$list[] = $item;
				}
				$graph[] = array(
					'@type'           => 'BreadcrumbList',
					'itemListElement' => $list,
				);
			}
		}

		$faq_source = 0;
		if ( is_singular() ) {
			$faq_source = is_front_page() ? (int) get_option( 'page_on_front' ) : get_queried_object_id();
		} elseif ( is_home() && ! is_paged() ) {
			$faq_source = (int) get_option( 'page_for_posts' );
		}
		if ( $faq_source ) {
			$faqs = testmatik_get_faqs( $faq_source );
			if ( $faqs ) {
				$main = array();
				foreach ( $faqs as $f ) {
					$main[] = array(
						'@type'          => 'Question',
						'name'           => $f['q'],
						'acceptedAnswer' => array(
							'@type' => 'Answer',
							'text'  => $f['a'],
						),
					);
				}
				$graph[] = array(
					'@type'      => 'FAQPage',
					'mainEntity' => $main,
				);
			}
		}

		if ( ! $graph ) {
			return;
		}
		echo '<script type="application/ld+json">' . wp_json_encode(
			array(
				'@context' => 'https://schema.org',
				'@graph'   => $graph,
			),
			JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
		) . "</script>\n";
	},
	30
);

/*
 * Rank Math prints only a BreadcrumbList on pages whose schema type is "None", which is
 * its default for pages. Add the Organization, WebSite and WebPage nodes it leaves out,
 * with the same @ids Rank Math uses elsewhere, so tool and legal pages join the site graph.
 */
add_filter(
	'rank_math/json_ld',
	function ( $data ) {
		if ( ! is_page() || is_front_page() || ! is_array( $data ) ) {
			return $data;
		}
		$types = array();
		foreach ( $data as $node ) {
			if ( is_array( $node ) && isset( $node['@type'] ) ) {
				$types = array_merge( $types, (array) $node['@type'] );
			}
		}
		if ( array_intersect( $types, array( 'WebPage', 'AboutPage', 'ContactPage', 'CollectionPage' ) ) ) {
			return $data;
		}
		$home    = home_url( '/' );
		$url     = get_permalink();
		$org_id  = $home . '#organization';
		$site_id = $home . '#website';
		if ( ! in_array( 'Organization', $types, true ) ) {
			$org  = array(
				'@type' => 'Organization',
				'@id'   => $org_id,
				'name'  => get_bloginfo( 'name' ),
				'url'   => $home,
			);
			$icon = get_site_icon_url( 512 );
			if ( $icon ) {
				$org['logo'] = $icon;
			}
			$data['testmatikOrganization'] = $org;
		}
		if ( ! in_array( 'WebSite', $types, true ) ) {
			$data['testmatikWebSite'] = array(
				'@type'      => 'WebSite',
				'@id'        => $site_id,
				'url'        => $home,
				'name'       => get_bloginfo( 'name' ),
				'inLanguage' => 'tr',
				'publisher'  => array( '@id' => $org_id ),
			);
		}
		$slug = get_post_field( 'post_name', get_queried_object_id() );
		$page = array(
			'@type'         => 'hakkimizda' === $slug ? 'AboutPage' : ( 'iletisim' === $slug ? 'ContactPage' : 'WebPage' ),
			'@id'           => $url . '#webpage',
			'url'           => $url,
			'name'          => wp_get_document_title(),
			'description'   => testmatik_seo_description(),
			'datePublished' => get_the_date( 'c' ),
			'dateModified'  => get_the_modified_date( 'c' ),
			'isPartOf'      => array( '@id' => $site_id ),
			'publisher'     => array( '@id' => $org_id ),
			'inLanguage'    => 'tr',
		);
		if ( in_array( 'BreadcrumbList', $types, true ) ) {
			$page['breadcrumb'] = array( '@id' => $url . '#breadcrumb' );
		}
		if ( testmatik_page_tool() ) {
			$page['mainEntity'] = array( '@id' => $url . '#app' );
		}
		if ( has_post_thumbnail() ) {
			$page['primaryImageOfPage'] = array(
				'@type' => 'ImageObject',
				'url'   => get_the_post_thumbnail_url( null, 'full' ),
			);
		}
		$data['testmatikWebPage'] = $page;
		return $data;
	},
	99
);

/**
 * Author of guide posts: the editorial team as an Organization, linked to the About page.
 *
 * @return array
 */
function testmatik_schema_author() {
	$about = get_page_by_path( 'hakkimizda' );
	return array(
		'@type'    => 'Organization',
		'name'     => __( 'Testmatik Teknik Ekibi', 'testmatik' ),
		'url'      => $about ? get_permalink( $about ) : home_url( '/' ),
		'parentOrganization' => array( '@id' => home_url( '/' ) . '#organization' ),
	);
}

// Rank Math names the WordPress user ("admin") as a Person on posts; use the team instead.
add_filter(
	'rank_math/json_ld',
	function ( $data ) {
		if ( ! is_singular( 'post' ) || ! is_array( $data ) ) {
			return $data;
		}
		$person_ids = array();
		foreach ( $data as $key => $node ) {
			if ( is_array( $node ) && isset( $node['@type'] ) && 'Person' === $node['@type'] ) {
				if ( ! empty( $node['@id'] ) ) {
					$person_ids[] = $node['@id'];
				}
				unset( $data[ $key ] );
			}
		}
		foreach ( $data as $key => $node ) {
			if ( ! is_array( $node ) || ! isset( $node['author'] ) ) {
				continue;
			}
			$ref = isset( $node['author']['@id'] ) ? $node['author']['@id'] : '';
			if ( ! $ref || in_array( $ref, $person_ids, true ) || ( isset( $node['author']['@type'] ) && 'Person' === $node['author']['@type'] ) ) {
				$data[ $key ]['author'] = testmatik_schema_author();
			}
		}
		return $data;
	},
	100
);

// Better core sitemap: drop users and tags, keep pages, posts and categories.
add_filter(
	'wp_sitemaps_add_provider',
	function ( $provider, $name ) {
		return 'users' === $name ? false : $provider;
	},
	10,
	2
);
add_filter(
	'wp_sitemaps_taxonomies',
	function ( $taxonomies ) {
		unset( $taxonomies['post_tag'], $taxonomies['post_format'] );
		return $taxonomies;
	}
);

// Author archives add nothing on this site; send them to the blog.
add_action(
	'template_redirect',
	function () {
		if ( is_author() || is_attachment() ) {
			$target = is_attachment() && wp_get_post_parent_id( get_queried_object_id() ) ? get_permalink( wp_get_post_parent_id( get_queried_object_id() ) ) : ( testmatik_blog_url() ? testmatik_blog_url() : home_url( '/' ) );
			wp_safe_redirect( $target, 301 );
			exit;
		}
	}
);

/*
 * Old WordPress sample URLs that Google saw before the site launched: send them to the
 * closest real page instead of a 404.
 */
add_action(
	'template_redirect',
	function () {
		if ( ! is_404() ) {
			return;
		}
		$path = trim( (string) wp_parse_url( isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '', PHP_URL_PATH ), '/' ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
		$map  = array(
			'hello-world'    => '/',
			'merhaba-dunya'  => '/',
			'sample-page'    => '/',
			'ornek-sayfa'    => '/',
			'privacy-policy' => '/gizlilik-politikasi/',
		);
		if ( isset( $map[ $path ] ) ) {
			wp_safe_redirect( home_url( $map[ $path ] ), 301 );
			exit;
		}
	},
	1
);

/**
 * Languages that have at least one published post or page (Polylang). A language added
 * for later work stays invisible until its first page goes live.
 *
 * @return string[] Language slugs.
 */
function testmatik_live_languages() {
	static $live = null;
	if ( null !== $live ) {
		return $live;
	}
	$live = array();
	if ( ! function_exists( 'pll_languages_list' ) ) {
		return $live;
	}
	foreach ( pll_languages_list( array( 'fields' => 'slug' ) ) as $slug ) {
		$found = get_posts(
			array(
				'post_type'      => array( 'post', 'page' ),
				'post_status'    => 'publish',
				'lang'           => '', // Count by the language taxonomy directly, not the current language.
				'tax_query'      => array( array( 'taxonomy' => 'language', 'field' => 'slug', 'terms' => $slug ) ), // phpcs:ignore WordPress.DB.SlowDBQuery
				'posts_per_page' => 1,
				'fields'         => 'ids',
				'no_found_rows'  => true,
			)
		);
		if ( $found ) {
			$live[] = $slug;
		}
	}
	return $live;
}

// An empty language folder (/pt/, /pl/ before launch) is a 404, not a copy of a Turkish page.
add_action(
	'template_redirect',
	function () {
		if ( ! function_exists( 'pll_current_language' ) || ! function_exists( 'pll_default_language' ) ) {
			return;
		}
		$lang = pll_current_language();
		if ( ! $lang || pll_default_language() === $lang || in_array( $lang, testmatik_live_languages(), true ) ) {
			return;
		}
		global $wp_query;
		$wp_query->set_404();
		status_header( 404 );
		nocache_headers();
	},
	2
);

// No hreflang link to a language that has no pages yet.
add_filter(
	'pll_rel_hreflang_attributes',
	function ( $hreflangs ) {
		if ( ! function_exists( 'pll_default_language' ) || ! is_array( $hreflangs ) ) {
			return $hreflangs;
		}
		$live = testmatik_live_languages();
		foreach ( $hreflangs as $code => $url ) {
			foreach ( pll_languages_list( array( 'fields' => 'slug' ) ) as $slug ) {
				if ( pll_default_language() !== $slug && ! in_array( $slug, $live, true ) && false !== strpos( (string) $url, home_url( '/' . $slug . '/' ) ) ) {
					unset( $hreflangs[ $code ] );
				}
			}
		}
		return $hreflangs;
	}
);
