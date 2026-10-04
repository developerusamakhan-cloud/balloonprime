<?php
/**
 * One-click site setup: creates tool pages, hub pages, legal pages,
 * the blog page, starter article drafts and menus.
 *
 * Nothing is created automatically. An admin runs it from
 * Appearance → Lumipix Setup, and it only adds what is missing.
 *
 * @package Lumipix
 */

defined( 'ABSPATH' ) || exit;

/**
 * Non-tool pages the installer manages.
 *
 * @return array<string, array<string, string>>
 */
function lumipix_installer_pages() {
	$p = function ( $text ) {
		return '<!-- wp:paragraph --><p>' . esc_html( $text ) . '</p><!-- /wp:paragraph -->';
	};
	$h = function ( $text ) {
		return '<!-- wp:heading --><h2 class="wp-block-heading">' . esc_html( $text ) . '</h2><!-- /wp:heading -->';
	};
	return array(
		'home'    => array(
			'title'    => __( 'Home', 'lumipix' ),
			'slug'     => 'home',
			'template' => '',
			'content'  => '',
		),
		'tools'   => array(
			'title'    => __( 'All image tools', 'lumipix' ),
			'slug'     => 'tools',
			'template' => 'templates/page-tools.php',
			'content'  => $p( __( 'Every Lumipix tool runs inside your browser. Your images are never uploaded, there is nothing to install and no account to create.', 'lumipix' ) ),
		),
		'blog'    => array(
			'title'    => __( 'Guides', 'lumipix' ),
			'slug'     => 'blog',
			'template' => '',
			'content'  => '',
		),
		'about'   => array(
			'title'    => __( 'About', 'lumipix' ),
			'slug'     => 'about',
			'template' => '',
			'content'  => $h( __( 'Image tools without the catch', 'lumipix' ) ) . $p( __( 'Lumipix started with a simple frustration: most online image tools upload your photos to a server, cap the free version, or hide the full-resolution download behind a signup. We think everyday image tasks should be instant, free and private.', 'lumipix' ) ) . $h( __( 'How it works', 'lumipix' ) ) . $p( __( 'Every tool is built on technology already inside your browser. When you compress, resize or remove a background, the work happens on your own device. Your images are never sent to us.', 'lumipix' ) ) . $h( __( 'How we keep it free', 'lumipix' ) ) . $p( __( 'Because there are no servers processing images, Lumipix costs very little to run. The site may show a small number of unobtrusive ads to cover what it does cost.', 'lumipix' ) ),
		),
		'privacy' => array(
			'title'    => __( 'Privacy Policy', 'lumipix' ),
			'slug'     => 'privacy-policy',
			'template' => '',
			'content'  => $p( __( 'Draft – review with a legal professional before publishing. Replace the bracketed placeholders.', 'lumipix' ) ) . $h( __( 'Your images', 'lumipix' ) ) . $p( __( 'Images you open in Lumipix tools are processed locally in your browser. They are not uploaded to or stored on our servers.', 'lumipix' ) ) . $h( __( 'Analytics and advertising', 'lumipix' ) ) . $p( __( '[Describe any analytics or advertising services you use, such as Google Analytics or Google AdSense, the cookies they set, and how visitors can opt out.]', 'lumipix' ) ) . $h( __( 'Third-party resources', 'lumipix' ) ) . $p( __( 'The background remover downloads an AI model and code library from a public content delivery network the first time you use it. These requests include standard technical data such as your IP address.', 'lumipix' ) ) . $h( __( 'Contact', 'lumipix' ) ) . $p( __( '[Your contact email address]', 'lumipix' ) ),
		),
		'terms'   => array(
			'title'    => __( 'Terms of Use', 'lumipix' ),
			'slug'     => 'terms',
			'template' => '',
			'content'  => $p( __( 'Draft – review with a legal professional before publishing.', 'lumipix' ) ) . $p( __( 'Lumipix tools are provided free of charge and as is, without warranties of any kind. You are responsible for the images you process and for having the right to use them. Results, especially for official applications, should be checked against the requirements of the organisation you submit them to.', 'lumipix' ) ),
		),
		'contact' => array(
			'title'    => __( 'Contact', 'lumipix' ),
			'slug'     => 'contact',
			'template' => '',
			'content'  => $p( __( 'Found a bug, have an idea for a tool, or want to partner with us? We read every message.', 'lumipix' ) ) . $p( __( '[Add your email address or a contact form block here.]', 'lumipix' ) ),
		),
	);
}

/**
 * Starter article drafts (outline only; written content is up to the editor).
 *
 * @return array<int, array<string, mixed>>
 */
function lumipix_installer_drafts() {
	$outline = function ( $intro, $headings ) {
		$html = '<!-- wp:paragraph --><p>' . esc_html( $intro ) . '</p><!-- /wp:paragraph -->';
		foreach ( $headings as $heading ) {
			$html .= '<!-- wp:heading --><h2 class="wp-block-heading">' . esc_html( $heading ) . '</h2><!-- /wp:heading --><!-- wp:paragraph --><p>' . esc_html__( '[Write this section.]', 'lumipix' ) . '</p><!-- /wp:paragraph -->';
		}
		return $html;
	};
	return array(
		array(
			'title'    => __( 'remove.bg Alternatives: 5 Free Background Removers in 2026', 'lumipix' ),
			'slug'     => 'remove-bg-alternatives',
			'category' => __( 'Comparisons', 'lumipix' ),
			'tool'     => 'background-remover',
			'content'  => $outline( __( '[Outline – verify every fact about third-party services before publishing.]', 'lumipix' ), array( __( 'What to look for in a background remover', 'lumipix' ), __( 'The alternatives compared', 'lumipix' ), __( 'Free HD downloads without signup', 'lumipix' ), __( 'Which one should you use?', 'lumipix' ) ) ),
		),
		array(
			'title'    => __( 'How to Compress a Photo for Online Application Forms', 'lumipix' ),
			'slug'     => 'compress-photo-for-online-forms',
			'category' => __( 'Guides', 'lumipix' ),
			'tool'     => 'compress-image',
			'content'  => $outline( __( '[Outline – link to the PPSC, FPSC and NTS photo pages.]', 'lumipix' ), array( __( 'Why forms reject your photo', 'lumipix' ), __( 'Find the exact limit', 'lumipix' ), __( 'Compress in three steps', 'lumipix' ), __( 'Signature and document scans', 'lumipix' ) ) ),
		),
		array(
			'title'    => __( 'How to Resize an Image Without Photoshop (Free)', 'lumipix' ),
			'slug'     => 'resize-image-without-photoshop',
			'category' => __( 'Guides', 'lumipix' ),
			'tool'     => 'image-resizer',
			'content'  => $outline( __( '[Outline – targets "how resize image in photoshop".]', 'lumipix' ), array( __( 'Resizing in Photoshop', 'lumipix' ), __( 'The faster free way', 'lumipix' ), __( 'Pixels vs. print size', 'lumipix' ), __( 'Common sizes cheat sheet', 'lumipix' ) ) ),
		),
	);
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
		$rows[ 'page:' . $key ] = array(
			'label'  => $page['title'],
			'exists' => (bool) lumipix_installer_page_id( $key ),
			'url'    => lumipix_installer_page_id( $key ) ? get_permalink( lumipix_installer_page_id( $key ) ) : '',
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
	return $rows;
}

/**
 * Run the installer. Only adds missing items.
 *
 * @return array<int, string> Log lines.
 */
function lumipix_run_installer() {
	$log = array();
	$ids = (array) get_option( 'lumipix_installed_pages', array() );

	// Pretty permalinks (only when the site still uses the default "plain" structure).
	if ( '' === (string) get_option( 'permalink_structure' ) ) {
		update_option( 'permalink_structure', '/blog/%postname%/' );
		$log[] = __( 'Permalinks set to /blog/post-name/ for articles (pages stay at /page-name/).', 'lumipix' );
	}

	// Core pages.
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
					'post_type'    => 'page',
					'post_status'  => 'publish',
					'post_title'   => $page['title'],
					'post_name'    => $page['slug'],
					'post_content' => $page['content'],
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

	// Tool pages (main tools first so presets can be children-agnostic).
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

	// Starter drafts.
	if ( ! get_option( 'lumipix_drafts_created' ) ) {
		foreach ( lumipix_installer_drafts() as $draft ) {
			if ( get_page_by_path( $draft['slug'], OBJECT, 'post' ) ) {
				continue;
			}
			$cat = term_exists( $draft['category'], 'category' );
			if ( ! $cat ) {
				$cat = wp_insert_term( $draft['category'], 'category' );
			}
			$cat_id = is_array( $cat ) ? (int) $cat['term_id'] : (int) $cat;
			wp_insert_post(
				array(
					'post_type'     => 'post',
					'post_status'   => 'draft',
					'post_title'    => $draft['title'],
					'post_name'     => $draft['slug'],
					'post_content'  => $draft['content'],
					'post_category' => $cat_id ? array( $cat_id ) : array(),
					'meta_input'    => array( '_lumipix_related_tool' => $draft['tool'] ),
				)
			);
			/* translators: %s: post title */
			$log[] = sprintf( __( 'Created draft article: %s', 'lumipix' ), $draft['title'] );
		}
		update_option( 'lumipix_drafts_created', 1 );
	}

	// Footer menu with company pages (only if none assigned yet).
	$locations = get_theme_mod( 'nav_menu_locations', array() );
	if ( empty( $locations['footer'] ) ) {
		$menu_id = wp_create_nav_menu( __( 'Lumipix footer', 'lumipix' ) );
		if ( ! is_wp_error( $menu_id ) ) {
			foreach ( array( 'about', 'blog', 'contact', 'privacy', 'terms' ) as $key ) {
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
