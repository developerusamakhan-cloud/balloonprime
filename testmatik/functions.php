<?php
/**
 * Testmatik bootstrap.
 *
 * @package Testmatik
 */

defined( 'ABSPATH' ) || exit;

define( 'TESTMATIK_DIR', get_template_directory() );
define( 'TESTMATIK_URI', get_template_directory_uri() );
define( 'TESTMATIK_VERSION', wp_get_theme( get_template() )->get( 'Version' ) );

foreach ( array( 'icons', 'tools', 'setup', 'content', 'template-tags', 'tool-apps', 'seo', 'customizer', 'installer', 'admin' ) as $testmatik_file ) {
	require TESTMATIK_DIR . '/inc/' . $testmatik_file . '.php';
}
unset( $testmatik_file );
