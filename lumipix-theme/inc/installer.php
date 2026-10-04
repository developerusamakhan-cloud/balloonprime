<?php
/**
 * One-click site setup: creates tool pages, the hub, blog, company and legal
 * pages, the article content pack (published + scheduled) with featured
 * images, and the footer menu.
 *
 * Nothing runs automatically. An admin starts it from Appearance → Lumi Pix Setup.
 * It only adds what is missing and never overwrites content someone has edited.
 *
 * @package Lumipix
 */

defined( 'ABSPATH' ) || exit;

/** How many pack articles are published immediately; the rest are scheduled. */
define( 'LUMIPIX_PACK_PUBLISH_NOW', 15 );

/** Days between scheduled articles. */
define( 'LUMIPIX_PACK_INTERVAL_DAYS', 2 );

/**
 * Non-tool pages the installer manages. Content comes from content/pages/<file>.md.
 *
 * @return array<string, array<string, string>>
 */
function lumipix_installer_pages() {
	return array(
		'home'       => array( 'title' => __( 'Home', 'lumipix' ), 'slug' => 'home', 'template' => '', 'file' => 'home' ),
		'tools'      => array( 'title' => __( 'All image tools', 'lumipix' ), 'slug' => 'tools', 'template' => 'templates/page-tools.php', 'file' => 'tools' ),
		'blog'       => array( 'title' => __( 'Guides', 'lumipix' ), 'slug' => 'blog', 'template' => '', 'file' => '' ),
		'about'      => array( 'title' => __( 'About Lumi Pix', 'lumipix' ), 'slug' => 'about', 'template' => '', 'file' => 'about' ),
		'contact'    => array( 'title' => __( 'Contact', 'lumipix' ), 'slug' => 'contact', 'template' => '', 'file' => 'contact' ),
		'privacy'    => array( 'title' => __( 'Privacy Policy', 'lumipix' ), 'slug' => 'privacy-policy', 'template' => '', 'file' => 'privacy-policy' ),
		'terms'      => array( 'title' => __( 'Terms of Use', 'lumipix' ), 'slug' => 'terms', 'template' => '', 'file' => 'terms' ),
		'cookies'    => array( 'title' => __( 'Cookie Policy', 'lumipix' ), 'slug' => 'cookie-policy', 'template' => '', 'file' => 'cookie-policy' ),
		'disclaimer' => array( 'title' => __( 'Disclaimer', 'lumipix' ), 'slug' => 'disclaimer', 'template' => '', 'file' => 'disclaimer' ),
	);
}

/**
 * Parsed Markdown for a bundled page (cached per request).
 *
 * @param string $file File name without extension.
 * @return array{meta: array<string,string>, html: string, faqs: array<string,string>}|null
 */
function lumipix_pack_page( $file ) {
	static $cache = array();
	if ( ! $file ) {
		return null;
	}
	if ( ! array_key_exists( $file, $cache ) ) {
		$path            = LUMIPIX_DIR . '/content/pages/' . sanitize_file_name( $file ) . '.md';
		$cache[ $file ] = file_exists( $path ) ? lumipix_md_parse( (string) file_get_contents( $path ) ) : null; // phpcs:ignore WordPress.WP.AlternativeFunctions
	}
	return $cache[ $file ];
}

/**
 * Bundled articles, in publishing order.
 *
 * @return array<int, array{file: string, slug: string}>
 */
function lumipix_pack_posts() {
	$files = glob( LUMIPIX_DIR . '/content/posts/*.md' );
	sort( $files );
	$out = array();
	foreach ( $files as $file ) {
		$out[] = array(
			'file' => $file,
			'slug' => preg_replace( '/^\d+-/', '', basename( $file, '.md' ) ),
		);
	}
	return $out;
}

/**
 * Page ID created by the installer for a key.
 *
 * @param string $key Installer key.
 * @return int
 */
function lumipix_installer_page_id( $key ) {
	$ids = (array) get_option( 'lumipix_installed_pages', array() );
	$id  = isset( $ids[ $key ] ) ? (int) $ids[ $key ] : 0;
	if ( $id && 'publish' === get_post_status( $id ) ) {
		return $id;
	}
	return 0;
}

/**
 * Status of everything the installer manages.
 *
 * @return array<string, array<string, mixed>>
 */
function lumipix_installer_status() {
	$rows = array();
	foreach ( lumipix_installer_pages() as $key => $page ) {
		$id                     = lumipix_installer_page_id( $key );
		$rows[ 'page:' . $key ] = array(
			'label'  => $page['title'],
			'exists' => (bool) $id,
			'url'    => $id ? get_permalink( $id ) : '',
		);
	}
	foreach ( lumipix_tools() as $key => $tool ) {
		$id                     = lumipix_tool_page_id( $key );
		$rows[ 'tool:' . $key ] = array(
			'label'  => $tool['nav'],
			'exists' => (bool) $id,
			'url'    => $id ? get_permalink( $id ) : '',
		);
	}
	foreach ( lumipix_pack_posts() as $item ) {
		$post                         = get_page_by_path( $item['slug'], OBJECT, 'post' );
		$rows[ 'post:' . $item['slug'] ] = array(
			'label'  => $post ? $post->post_title . ( 'future' === $post->post_status ? ' — ' . sprintf( /* translators: %s: date */ __( 'scheduled %s', 'lumipix' ), get_the_date( '', $post ) ) : '' ) : $item['slug'],
			'exists' => (bool) $post && in_array( $post->post_status, array( 'publish', 'future' ), true ),
			'url'    => $post && 'publish' === $post->post_status ? get_permalink( $post ) : '',
		);
	}
	return $rows;
}

/**
 * Whether a page/post is untouched since the installer created it.
 *
 * @param WP_Post $post Post.
 * @return bool
 */
function lumipix_is_untouched( $post ) {
	if ( ! $post ) {
		return false;
	}
	$content = (string) $post->post_content;
	return $post->post_modified_gmt === $post->post_date_gmt
		|| '' === trim( $content )
		|| false !== strpos( $content, '[Write this section.]' )
		// WordPress's own privacy policy template (created on install).
		|| false !== strpos( $content, 'privacy-policy-tutorial' )
		// Placeholder content from earlier versions of this theme.
		|| false !== strpos( $content, 'Draft – review with a legal professional' );
}

/**
 * Import a bundled image into the Media Library once and return its ID.
 *
 * @param string $rel     Path relative to the theme directory.
 * @param string $title   Attachment title / alt text.
 * @param int    $parent  Parent post ID.
 * @return int
 */
function lumipix_import_image( $rel, $title, $parent = 0 ) {
	$src = LUMIPIX_DIR . '/' . $rel;
	if ( ! file_exists( $src ) ) {
		return 0;
	}
	$found = get_posts(
		array(
			'post_type'      => 'attachment',
			'post_status'    => 'inherit',
			'posts_per_page' => 1,
			'fields'         => 'ids',
			'meta_key'       => '_lumipix_source', // phpcs:ignore WordPress.DB.SlowDBQuery
			'meta_value'     => $rel, // phpcs:ignore WordPress.DB.SlowDBQuery
		)
	);
	if ( $found ) {
		return (int) $found[0];
	}
	$upload = wp_upload_bits( basename( $src ), null, (string) file_get_contents( $src ) ); // phpcs:ignore WordPress.WP.AlternativeFunctions
	if ( ! empty( $upload['error'] ) ) {
		return 0;
	}
	$type = wp_check_filetype( $upload['file'] );
	$id   = wp_insert_attachment(
		array(
			'post_mime_type' => $type['type'],
			'post_title'     => $title,
			'post_status'    => 'inherit',
		),
		$upload['file'],
		$parent
	);
	if ( ! $id || is_wp_error( $id ) ) {
		return 0;
	}
	require_once ABSPATH . 'wp-admin/includes/image.php';
	wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $upload['file'] ) );
	update_post_meta( $id, '_wp_attachment_image_alt', $title );
	update_post_meta( $id, '_lumipix_source', $rel );
	return (int) $id;
}

/**
 * Run the installer. Only adds missing items.
 *
 * @return array<int, string> Log lines.
 */
function lumipix_run_installer() {
	$log = array();
	$ids = (array) get_option( 'lumipix_installed_pages', array() );

	// Site name and tagline (only when still on WordPress defaults).
	$name = (string) get_option( 'blogname' );
	if ( in_array( $name, array( '', 'My WordPress Blog', 'My WordPress Website', 'WordPress', 'Lumipix' ), true ) ) {
		update_option( 'blogname', 'Lumi Pix' );
		$log[] = __( 'Site name set to Lumi Pix.', 'lumipix' );
	}
	$tagline = (string) get_option( 'blogdescription' );
	if ( in_array( $tagline, array( '', 'Just another WordPress site' ), true ) ) {
		update_option( 'blogdescription', __( 'Free, private image tools that run in your browser', 'lumipix' ) );
	}

	// Pretty permalinks (only when the site still uses the default "plain" structure).
	if ( '' === (string) get_option( 'permalink_structure' ) ) {
		update_option( 'permalink_structure', '/blog/%postname%/' );
		$GLOBALS['wp_rewrite']->init();
		$log[] = __( 'Permalinks set to /blog/post-name/ for articles (pages stay at /page-name/).', 'lumipix' );
	}

	// Core pages (content is filled in a second pass so links can resolve).
	foreach ( lumipix_installer_pages() as $key => $page ) {
		if ( lumipix_installer_page_id( $key ) ) {
			continue;
		}
		$existing = get_page_by_path( $page['slug'] );
		if ( $existing ) {
			$ids[ $key ] = $existing->ID;
			if ( 'publish' !== $existing->post_status ) {
				wp_update_post( array( 'ID' => $existing->ID, 'post_status' => 'publish' ) );
			}
			/* translators: %s: page title */
			$log[] = sprintf( __( 'Linked existing page: %s', 'lumipix' ), $existing->post_title );
		} else {
			$id = wp_insert_post(
				array(
					'post_type'   => 'page',
					'post_status' => 'publish',
					'post_title'  => $page['title'],
					'post_name'   => $page['slug'],
				)
			);
			if ( $id && ! is_wp_error( $id ) ) {
				$ids[ $key ] = $id;
				/* translators: %s: page title */
				$log[] = sprintf( __( 'Created page: %s', 'lumipix' ), $page['title'] );
			}
		}
		if ( ! empty( $ids[ $key ] ) && $page['template'] ) {
			update_post_meta( $ids[ $key ], '_wp_page_template', $page['template'] );
		}
	}
	update_option( 'lumipix_installed_pages', $ids );

	// Static front page + blog page.
	if ( ! empty( $ids['home'] ) && ! empty( $ids['blog'] ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', (int) $ids['home'] );
		update_option( 'page_for_posts', (int) $ids['blog'] );
	}

	// Tool pages (main tools first).
	$tools = lumipix_tools();
	uasort(
		$tools,
		function ( $a, $b ) {
			return (int) ! empty( $a['parent'] ) - (int) ! empty( $b['parent'] );
		}
	);
	$order = 0;
	foreach ( $tools as $key => $tool ) {
		++$order;
		if ( lumipix_tool_page_id( $key ) ) {
			continue;
		}
		$existing = get_page_by_path( $tool['slug'] );
		if ( $existing ) {
			update_post_meta( $existing->ID, '_lumipix_tool', $key );
			/* translators: %s: page title */
			$log[] = sprintf( __( 'Attached tool to existing page: %s', 'lumipix' ), $existing->post_title );
			continue;
		}
		$id = wp_insert_post(
			array(
				'post_type'    => 'page',
				'post_status'  => 'publish',
				'post_title'   => $tool['h1'],
				'post_name'    => $tool['slug'],
				'post_content' => $tool['content'],
				'menu_order'   => $order,
				'meta_input'   => array( '_lumipix_tool' => $key ),
			)
		);
		if ( $id && ! is_wp_error( $id ) ) {
			/* translators: %s: page title */
			$log[] = sprintf( __( 'Created tool page: %s', 'lumipix' ), $tool['h1'] );
		}
	}

	// Remove WordPress's sample content if nobody has edited it.
	foreach ( array( array( 'hello-world', 'post' ), array( 'sample-page', 'page' ) ) as $sample ) {
		$sp = get_page_by_path( $sample[0], OBJECT, $sample[1] );
		if ( $sp && $sp->post_modified_gmt === $sp->post_date_gmt ) {
			wp_trash_post( $sp->ID );
			/* translators: %s: post title */
			$log[] = sprintf( __( 'Moved WordPress sample content to trash: %s', 'lumipix' ), $sp->post_title );
		}
	}

	// Articles: create every post first (so cross-links resolve), then fill content.
	$log = array_merge( $log, lumipix_install_pack_posts() );

	// Page content and FAQs from the bundled Markdown (only for untouched pages).
	foreach ( lumipix_installer_pages() as $key => $page ) {
		$id   = lumipix_installer_page_id( $key );
		$pack = lumipix_pack_page( $page['file'] );
		if ( ! $id || ! $pack || get_post_meta( $id, '_lumipix_pack', true ) ) {
			continue;
		}
		$post = get_post( $id );
		if ( ! lumipix_is_untouched( $post ) && ! in_array( $key, array( 'home' ), true ) ) {
			continue;
		}
		if ( 'home' !== $key || '' === trim( $post->post_content ) ) {
			wp_update_post(
				array(
					'ID'           => $id,
					'post_content' => lumipix_md_parse( (string) file_get_contents( LUMIPIX_DIR . '/content/pages/' . $page['file'] . '.md' ) )['html'], // phpcs:ignore WordPress.WP.AlternativeFunctions -- re-parse so links resolve now.
				)
			);
		}
		update_post_meta( $id, '_lumipix_faqs', $pack['faqs'] );
		if ( ! empty( $pack['meta']['seo_title'] ) ) {
			update_post_meta( $id, '_lumipix_seo_title', $pack['meta']['seo_title'] );
		}
		if ( ! empty( $pack['meta']['seo_desc'] ) ) {
			update_post_meta( $id, '_lumipix_seo_desc', $pack['meta']['seo_desc'] );
		}
		update_post_meta( $id, '_lumipix_pack', LUMIPIX_VERSION );
		/* translators: %s: page title */
		$log[] = sprintf( __( 'Added content and FAQs: %s', 'lumipix' ), $post->post_title );
	}

	// Footer menu with company pages (only if none assigned yet).
	$locations = get_theme_mod( 'nav_menu_locations', array() );
	if ( empty( $locations['footer'] ) ) {
		$menu_id = wp_create_nav_menu( __( 'Lumi Pix company', 'lumipix' ) );
		if ( ! is_wp_error( $menu_id ) ) {
			foreach ( array( 'about', 'tools', 'blog', 'contact' ) as $key ) {
				if ( ! empty( $ids[ $key ] ) ) {
					wp_update_nav_menu_item(
						$menu_id,
						0,
						array(
							'menu-item-object-id' => (int) $ids[ $key ],
							'menu-item-object'    => 'page',
							'menu-item-type'      => 'post_type',
							'menu-item-status'    => 'publish',
						)
					);
				}
			}
			$locations['footer'] = $menu_id;
			set_theme_mod( 'nav_menu_locations', $locations );
			$log[] = __( 'Created the footer menu.', 'lumipix' );
		}
	}

	flush_rewrite_rules();

	if ( ! $log ) {
		$log[] = __( 'Everything was already set up. Nothing changed.', 'lumipix' );
	}
	return $log;
}

/**
 * Create the bundled articles: the first batch is published now, the rest
 * scheduled every LUMIPIX_PACK_INTERVAL_DAYS days at 09:00 site time.
 *
 * @return array<int, string> Log lines.
 */
function lumipix_install_pack_posts() {
	$log   = array();
	$items = lumipix_pack_posts();
	if ( ! $items ) {
		return $log;
	}

	$tz        = wp_timezone();
	$now       = new DateTimeImmutable( 'now', $tz );
	$first_day = $now->setTime( 9, 0 );
	$created   = array();

	// Pass 1: make sure every post exists (as draft) so links between them resolve.
	foreach ( $items as $index => $item ) {
		$post = get_page_by_path( $item['slug'], OBJECT, 'post' );
		if ( $post && ! lumipix_is_untouched( $post ) ) {
			continue;
		}
		if ( $post && in_array( $post->post_status, array( 'publish', 'future' ), true ) && get_post_meta( $post->ID, '_lumipix_pack', true ) ) {
			continue;
		}
		$parsed = lumipix_md_parse( (string) file_get_contents( $item['file'] ) ); // phpcs:ignore WordPress.WP.AlternativeFunctions
		$meta   = $parsed['meta'];
		$id     = $post ? $post->ID : wp_insert_post(
			array(
				'post_type'   => 'post',
				'post_status' => 'draft',
				'post_title'  => $meta['title'] ?? $item['slug'],
				'post_name'   => $item['slug'],
			)
		);
		if ( $id && ! is_wp_error( $id ) ) {
			$created[ $index ] = (int) $id;
		}
	}

	// Pass 2: content, meta, images and dates.
	$scheduled_n = 0;
	foreach ( $created as $index => $id ) {
		$item   = $items[ $index ];
		$parsed = lumipix_md_parse( (string) file_get_contents( $item['file'] ) ); // phpcs:ignore WordPress.WP.AlternativeFunctions
		$meta   = $parsed['meta'];

		$cat_ids = array();
		if ( ! empty( $meta['category'] ) ) {
			$cat = term_exists( $meta['category'], 'category' );
			if ( ! $cat ) {
				$descs = lumipix_pack_category_descriptions();
				$cat   = wp_insert_term( $meta['category'], 'category', array( 'description' => $descs[ $meta['category'] ] ?? '' ) );
			}
			if ( ! is_wp_error( $cat ) ) {
				$cat_ids[] = (int) ( is_array( $cat ) ? $cat['term_id'] : $cat );
			}
		}

		if ( $index < LUMIPIX_PACK_PUBLISH_NOW ) {
			// Published now, oldest first, a few minutes apart so the order is stable.
			$date   = $now->modify( '-' . ( ( LUMIPIX_PACK_PUBLISH_NOW - $index ) * 7 ) . ' minutes' );
			$status = 'publish';
		} else {
			++$scheduled_n;
			$date   = $first_day->modify( '+' . ( $scheduled_n * LUMIPIX_PACK_INTERVAL_DAYS ) . ' days' );
			$status = 'future';
		}

		wp_update_post(
			array(
				'ID'            => $id,
				'post_title'    => $meta['title'] ?? get_the_title( $id ),
				'post_content'  => $parsed['html'],
				'post_excerpt'  => $meta['excerpt'] ?? '',
				'post_status'   => $status,
				'post_date'     => $date->format( 'Y-m-d H:i:s' ),
				'post_date_gmt' => get_gmt_from_date( $date->format( 'Y-m-d H:i:s' ) ),
				'edit_date'     => true,
				'post_category' => $cat_ids,
			)
		);
		// Make modified == date so the post still counts as untouched.
		global $wpdb;
		$wpdb->update( // phpcs:ignore WordPress.DB.DirectDatabaseQuery
			$wpdb->posts,
			array(
				'post_modified'     => $date->format( 'Y-m-d H:i:s' ),
				'post_modified_gmt' => get_gmt_from_date( $date->format( 'Y-m-d H:i:s' ) ),
			),
			array( 'ID' => $id )
		);
		clean_post_cache( $id );

		if ( ! empty( $meta['tool'] ) && lumipix_get_tool( $meta['tool'] ) ) {
			update_post_meta( $id, '_lumipix_related_tool', $meta['tool'] );
		}
		if ( ! empty( $meta['seo_title'] ) ) {
			update_post_meta( $id, '_lumipix_seo_title', $meta['seo_title'] );
		}
		if ( ! empty( $meta['seo_desc'] ) ) {
			update_post_meta( $id, '_lumipix_seo_desc', $meta['seo_desc'] );
		}
		update_post_meta( $id, '_lumipix_faqs', $parsed['faqs'] );
		update_post_meta( $id, '_lumipix_pack', LUMIPIX_VERSION );

		$thumb = lumipix_import_image( 'assets/og/post-' . $item['slug'] . '.jpg', $meta['title'] ?? '', $id );
		if ( $thumb ) {
			set_post_thumbnail( $id, $thumb );
		}

		$log[] = 'publish' === $status
			/* translators: %s: post title */
			? sprintf( __( 'Published: %s', 'lumipix' ), $meta['title'] ?? '' )
			/* translators: 1: post title, 2: date */
			: sprintf( __( 'Scheduled: %1$s (%2$s)', 'lumipix' ), $meta['title'] ?? '', $date->format( 'j M Y, H:i' ) );
	}
	return $log;
}

/**
 * Descriptions for the article categories (shown on category pages and used as meta descriptions).
 *
 * @return array<string, string>
 */
function lumipix_pack_category_descriptions() {
	return array(
		'Compression'        => __( 'Guides to making images smaller: exact KB sizes, quality settings and formats, so uploads and emails go through first time.', 'lumipix' ),
		'Resizing'           => __( 'How to resize images in pixels, centimetres and inches, keep proportions, and batch resize many photos at once.', 'lumipix' ),
		'Background Removal' => __( 'Remove or replace backgrounds on photos, logos and signatures, with free tools that keep your images private.', 'lumipix' ),
		'Photos & IDs'       => __( 'Passport photos, signatures and document scans for online applications, prepared to the right size and format.', 'lumipix' ),
		'Social Media'       => __( 'Image sizes for Instagram, Facebook and other platforms, and how to post photos without awkward crops.', 'lumipix' ),
		'Formats & Printing' => __( 'JPG, PNG, WebP and DPI explained in plain English, with print size charts and conversion guides.', 'lumipix' ),
		'Comparisons'        => __( 'Honest comparisons of image tools and methods, so you can pick the right one for the job.', 'lumipix' ),
	);
}
