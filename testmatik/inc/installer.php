<?php
/**
 * One-click setup: creates tool pages, articles, legal pages, categories,
 * the static front page, the blog page and permalinks from the content pack.
 *
 * Runs once automatically when the theme is activated, and again from
 * Appearance → Testmatik Kurulum. It only adds what is missing and refreshes
 * items that nobody has edited since they were installed.
 *
 * @package Testmatik
 */

defined( 'ABSPATH' ) || exit;

/**
 * Categories used by the articles.
 *
 * @return array name => slug
 */
function testmatik_categories() {
	return array(
		'Klavye' => 'klavye',
		'Ekran'  => 'ekran',
		'Ses'    => 'ses',
		'Kamera' => 'kamera',
		'Mouse'  => 'mouse',
		'Rehber' => 'rehber',
	);
}

/**
 * Category descriptions (shown on category archives and used as meta descriptions).
 *
 * @return array slug => text
 */
function testmatik_category_descriptions() {
	return array(
		'klavye' => 'Klavye tuşları, Q ve F klavye düzeni, ghosting ve laptop klavye arızaları için adım adım rehberler.',
		'ekran'  => 'Ölü piksel, sıkışmış piksel ve ekran kusurlarını bulma ve giderme rehberleri.',
		'ses'    => 'Mikrofon ve hoparlör sorunlarını Windows, macOS ve telefonda çözmek için rehberler.',
		'kamera' => 'Laptop ve web kamerası sorunları, izinler ve görüntü kalitesi rehberleri.',
		'mouse'  => 'Mouse çift tıklama, tekerlek ve yan tuş sorunları ile polling rate rehberleri.',
		'rehber' => 'İkinci el cihaz kontrolü ve genel donanım testi rehberleri.',
	);
}

/**
 * Run the installer.
 *
 * @return array Log lines.
 */
function testmatik_install() {
	$log = array();

	// Site identity, only if still on WordPress defaults.
	$name = (string) get_option( 'blogname' );
	if ( '' === $name || in_array( $name, array( 'WordPress', 'My WordPress Website', 'My Blog', 'Bir WordPress Sitesi' ), true ) ) {
		update_option( 'blogname', 'Testmatik' );
		$log[] = 'Site adı: Testmatik';
	}
	$tag = (string) get_option( 'blogdescription' );
	if ( '' === $tag || in_array( $tag, array( 'Just another WordPress site', 'Bir başka WordPress sitesi' ), true ) ) {
		update_option( 'blogdescription', 'Ücretsiz online donanım testleri' );
	}

	// Permalinks: articles under /rehber/. Only changed while the site still uses a
	// WordPress default ("Plain" or "Day and name") and has no articles of its own yet,
	// so existing URLs are never broken.
	$structure = (string) get_option( 'permalink_structure' );
	$defaults  = array( '', '/%year%/%monthnum%/%day%/%postname%/', '/index.php/%year%/%monthnum%/%day%/%postname%/' );
	if ( in_array( $structure, $defaults, true ) && ! testmatik_site_has_own_posts() ) {
		// Through WP_Rewrite so links generated later in this same request use the new structure.
		global $wp_rewrite;
		$wp_rewrite->set_permalink_structure( '/rehber/%postname%/' );
		if ( '' === (string) get_option( 'category_base' ) ) {
			$wp_rewrite->set_category_base( 'kategori' );
		}
		$log[] = 'Kalıcı bağlantılar: /rehber/%postname%/';
	}

	// Categories.
	$cat_ids = array();
	$descs   = testmatik_category_descriptions();
	foreach ( testmatik_categories() as $cname => $cslug ) {
		$term = get_term_by( 'slug', $cslug, 'category' );
		if ( ! $term ) {
			$res = wp_insert_term( $cname, 'category', array( 'slug' => $cslug, 'description' => isset( $descs[ $cslug ] ) ? $descs[ $cslug ] : '' ) );
			if ( ! is_wp_error( $res ) ) {
				$cat_ids[ $cname ] = (int) $res['term_id'];
				$log[]             = 'Kategori oluşturuldu: ' . $cname;
			}
		} else {
			$cat_ids[ $cname ] = (int) $term->term_id;
		}
	}

	$touched = array();

	// Tool pages.
	$map = testmatik_tool_pages();
	foreach ( array_keys( testmatik_tools() ) as $key ) {
		$pack = testmatik_pack( 'tools', $key );
		if ( ! $pack ) {
			continue;
		}
		$id = testmatik_install_item( 'page', $key, $pack, $log );
		if ( $id ) {
			update_post_meta( $id, '_testmatik_tool', $key );
			$map[ $key ] = $id;
			$touched[]   = $id;
		}
	}
	update_option( 'testmatik_tool_pages', $map, false );

	// Pages (home has its own slug).
	$home_id = 0;
	foreach ( testmatik_pack_slugs( 'pages' ) as $slug ) {
		$pack = testmatik_pack( 'pages', $slug );
		if ( ! $pack ) {
			continue;
		}
		$id = testmatik_install_item( 'page', 'home' === $slug ? 'ana-sayfa' : $slug, $pack, $log );
		if ( $id ) {
			$touched[] = $id;
			if ( 'home' === $slug ) {
				$home_id = $id;
			}
		}
	}

	// Blog page.
	$blog = get_page_by_path( 'rehberler' );
	if ( ! $blog ) {
		$blog_id = wp_insert_post(
			array(
				'post_type'    => 'page',
				'post_status'  => 'publish',
				'post_title'   => 'Rehberler',
				'post_name'    => 'rehberler',
				'post_content' => '',
			)
		);
		$log[] = 'Sayfa oluşturuldu: Rehberler';
	} else {
		$blog_id = $blog->ID;
	}

	// Articles.
	foreach ( testmatik_pack_slugs( 'posts' ) as $slug ) {
		$pack = testmatik_pack( 'posts', $slug );
		if ( ! $pack ) {
			continue;
		}
		$id = testmatik_install_item( 'post', $slug, $pack, $log );
		if ( $id ) {
			$touched[] = $id;
			if ( ! empty( $pack['category'] ) && isset( $cat_ids[ $pack['category'] ] ) ) {
				wp_set_post_categories( $id, array( $cat_ids[ $pack['category'] ] ) );
			}
			if ( ! empty( $pack['tool'] ) ) {
				update_post_meta( $id, '_testmatik_tool', sanitize_key( $pack['tool'] ) );
			}
		}
	}

	// Second pass: now every target exists, turn link tokens into real URLs.
	foreach ( array_unique( $touched ) as $id ) {
		$content  = (string) get_post_field( 'post_content', $id );
		$resolved = testmatik_resolve_links( $content );
		if ( $resolved !== $content ) {
			wp_update_post( array( 'ID' => $id, 'post_content' => $resolved ) );
		}
		update_post_meta( $id, '_testmatik_pack_hash', md5( (string) get_post_field( 'post_content', $id ) ) );
	}

	// Front page and posts page.
	if ( $home_id && 'page' !== get_option( 'show_on_front' ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home_id );
		$log[] = 'Statik ana sayfa ayarlandı.';
	}
	if ( $home_id && ! get_option( 'page_on_front' ) ) {
		update_option( 'page_on_front', $home_id );
	}
	if ( $blog_id && ! get_option( 'page_for_posts' ) ) {
		update_option( 'page_for_posts', (int) $blog_id );
	}

	// Remove the WordPress sample content if it is untouched.
	$hello = get_page_by_path( 'hello-world', OBJECT, 'post' );
	if ( $hello && 1 === (int) $hello->ID && 'publish' === $hello->post_status ) {
		wp_trash_post( $hello->ID );
	}
	$sample = get_page_by_path( 'sample-page' );
	if ( $sample && 'publish' === $sample->post_status ) {
		wp_trash_post( $sample->ID );
	}

	update_option( 'testmatik_installed', TESTMATIK_VERSION, false );
	flush_rewrite_rules( false );
	$log[] = 'Kurulum tamamlandı.';
	return $log;
}

/**
 * Does the site have published articles that the installer did not create
 * (ignoring the WordPress "Hello world!" sample)?
 *
 * @return bool
 */
function testmatik_site_has_own_posts() {
	$ids = get_posts(
		array(
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => 20,
			'fields'         => 'ids',
			'no_found_rows'  => true,
		)
	);
	foreach ( $ids as $id ) {
		if ( 'hello-world' === get_post_field( 'post_name', $id ) || get_post_meta( $id, '_testmatik_pack_hash', true ) ) {
			continue;
		}
		return true;
	}
	return false;
}

/**
 * Create or refresh one page/post from a content pack.
 *
 * Existing items are refreshed only if their content still matches what the
 * installer wrote last time (i.e. nobody edited them).
 *
 * @param string $type page|post.
 * @param string $slug Slug.
 * @param array  $pack Content pack.
 * @param array  $log  Log (by reference).
 * @return int Post ID or 0.
 */
function testmatik_install_item( $type, $slug, $pack, &$log ) {
	$existing = get_page_by_path( $slug, OBJECT, $type );
	$html     = trim( $pack['html'] );
	$data     = array(
		'post_type'    => $type,
		'post_title'   => wp_strip_all_tags( $pack['title'] ),
		'post_name'    => $slug,
		'post_content' => $html,
		'post_excerpt' => isset( $pack['excerpt'] ) ? $pack['excerpt'] : '',
		'post_status'  => 'publish',
	);

	if ( $existing ) {
		$id     = (int) $existing->ID;
		$stored = (string) get_post_meta( $id, '_testmatik_pack_hash', true );
		$edited = ! $stored || md5( (string) $existing->post_content ) !== $stored;
		if ( $edited ) {
			testmatik_install_meta( $id, $pack, false );
			return $id;
		}
		$data['ID']          = $id;
		$data['post_status'] = $existing->post_status;
		wp_update_post( wp_slash( $data ) );
		testmatik_install_meta( $id, $pack, true );
		return $id;
	}

	$id = wp_insert_post( wp_slash( $data ), true );
	if ( is_wp_error( $id ) ) {
		$log[] = 'Hata (' . $slug . '): ' . $id->get_error_message();
		return 0;
	}
	testmatik_install_meta( $id, $pack, true );
	$log[] = ( 'post' === $type ? 'Makale' : 'Sayfa' ) . ' oluşturuldu: ' . $pack['title'];
	return (int) $id;
}

/**
 * SEO meta, intro and FAQs for an item. Never overwrites values someone changed by hand
 * unless $refresh is true and the stored value still equals the previous pack value.
 *
 * @param int   $id      Post ID.
 * @param array $pack    Content pack.
 * @param bool  $refresh Whether the item content was (re)written by the installer.
 */
function testmatik_install_meta( $id, $pack, $refresh ) {
	$pairs = array(
		'_testmatik_seo_title' => isset( $pack['seo_title'] ) ? $pack['seo_title'] : '',
		'_testmatik_seo_desc'  => isset( $pack['description'] ) ? $pack['description'] : '',
		'_testmatik_intro'     => isset( $pack['intro'] ) ? $pack['intro'] : '',
	);
	foreach ( $pairs as $k => $v ) {
		if ( $refresh || '' === (string) get_post_meta( $id, $k, true ) ) {
			update_post_meta( $id, $k, wp_slash( $v ) );
		}
	}
	if ( $refresh || ! get_post_meta( $id, '_testmatik_faqs', true ) ) {
		$faqs = isset( $pack['faqs'] ) && is_array( $pack['faqs'] ) ? $pack['faqs'] : array();
		update_post_meta( $id, '_testmatik_faqs', wp_slash( $faqs ) );
	}

	// Rank Math fields: filled only when empty, so manual changes are kept.
	$kw = isset( $pack['keywords'] ) && is_array( $pack['keywords'] ) ? implode( ',', array_slice( $pack['keywords'], 0, 5 ) ) : '';
	$rm = array(
		'rank_math_title'         => $pairs['_testmatik_seo_title'],
		'rank_math_description'   => $pairs['_testmatik_seo_desc'],
		'rank_math_focus_keyword' => $kw,
	);
	foreach ( $rm as $k => $v ) {
		if ( $v && '' === (string) get_post_meta( $id, $k, true ) ) {
			update_post_meta( $id, $k, wp_slash( $v ) );
		}
	}
	// Yoast fields, same rule.
	$yoast = array(
		'_yoast_wpseo_title'    => $pairs['_testmatik_seo_title'],
		'_yoast_wpseo_metadesc' => $pairs['_testmatik_seo_desc'],
		'_yoast_wpseo_focuskw'  => isset( $pack['keywords'][0] ) ? $pack['keywords'][0] : '',
	);
	foreach ( $yoast as $k => $v ) {
		if ( $v && '' === (string) get_post_meta( $id, $k, true ) ) {
			update_post_meta( $id, $k, wp_slash( $v ) );
		}
	}
}

// First activation: install automatically.
add_action(
	'after_switch_theme',
	function () {
		if ( ! get_option( 'testmatik_installed' ) && current_user_can( 'manage_options' ) ) {
			$log = testmatik_install();
			set_transient( 'testmatik_install_log', $log, 300 );
		} else {
			flush_rewrite_rules( false );
		}
	}
);
