<?php
/**
 * Lumipix theme bootstrap.
 *
 * @package Lumipix
 */

defined( 'ABSPATH' ) || exit;

// Single source of truth: the Version line in style.css (bumped by tools/build-zip.sh).
define( 'LUMIPIX_VERSION', (string) wp_get_theme( get_template() )->get( 'Version' ) );
define( 'LUMIPIX_DIR', get_template_directory() );
define( 'LUMIPIX_URI', get_template_directory_uri() );

require LUMIPIX_DIR . '/inc/icons.php';
require LUMIPIX_DIR . '/inc/tools.php';
require LUMIPIX_DIR . '/inc/setup.php';
require LUMIPIX_DIR . '/inc/template-tags.php';
require LUMIPIX_DIR . '/inc/tool-apps.php';
require LUMIPIX_DIR . '/inc/content.php';
require LUMIPIX_DIR . '/inc/comments.php';
require LUMIPIX_DIR . '/inc/authors.php';
require LUMIPIX_DIR . '/inc/seo.php';
require LUMIPIX_DIR . '/inc/customizer.php';
require LUMIPIX_DIR . '/inc/markdown.php';
require LUMIPIX_DIR . '/inc/installer.php';

if ( is_admin() ) {
	require LUMIPIX_DIR . '/inc/admin.php';
}
