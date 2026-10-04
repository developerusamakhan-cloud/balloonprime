<?php
/**
 * Comments, pingbacks and trackbacks are switched off site-wide.
 *
 * Covers the front end (forms, lists, feeds, widgets), the admin
 * (menu, admin bar, dashboard) and XML-RPC pingbacks, including
 * self-pings created by internal links between articles.
 *
 * @package Lumipix
 */

defined( 'ABSPATH' ) || exit;

/**
 * Remove comment and trackback support from every post type.
 */
function lumipix_disable_comment_support() {
	foreach ( get_post_types() as $type ) {
		if ( post_type_supports( $type, 'comments' ) ) {
			remove_post_type_support( $type, 'comments' );
		}
		if ( post_type_supports( $type, 'trackbacks' ) ) {
			remove_post_type_support( $type, 'trackbacks' );
		}
	}
}
add_action( 'init', 'lumipix_disable_comment_support', 100 );

// Closed everywhere, and no existing comments or pings are shown.
add_filter( 'comments_open', '__return_false', 20 );
add_filter( 'pings_open', '__return_false', 20 );
add_filter( 'comments_array', '__return_empty_array', 10 );
add_filter( 'get_comments_number', '__return_zero' );
add_filter( 'feed_links_show_comments_feed', '__return_false' );

// No comment feeds.
add_action(
	'template_redirect',
	function () {
		if ( is_comment_feed() ) {
			wp_safe_redirect( home_url( '/' ), 301 );
			exit;
		}
	}
);

// No pingbacks: header, XML-RPC methods and self-pings.
add_filter(
	'wp_headers',
	function ( $headers ) {
		unset( $headers['X-Pingback'] );
		return $headers;
	}
);
add_filter(
	'xmlrpc_methods',
	function ( $methods ) {
		unset( $methods['pingback.ping'], $methods['pingback.extensions.getPingbacks'] );
		return $methods;
	}
);
add_action(
	'pre_ping',
	function ( &$links ) {
		$links = array();
	}
);

// No "Recent Comments" widget.
add_action(
	'widgets_init',
	function () {
		unregister_widget( 'WP_Widget_Recent_Comments' );
	},
	20
);

// Admin: hide the Comments menu, admin bar item and dashboard box.
add_action(
	'admin_menu',
	function () {
		remove_menu_page( 'edit-comments.php' );
		remove_submenu_page( 'options-general.php', 'options-discussion.php' );
	}
);
add_action(
	'admin_init',
	function () {
		global $pagenow;
		if ( in_array( $pagenow, array( 'edit-comments.php', 'options-discussion.php' ), true ) ) {
			wp_safe_redirect( admin_url() );
			exit;
		}
		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
	}
);
add_action(
	'admin_bar_menu',
	function ( $bar ) {
		$bar->remove_node( 'comments' );
	},
	100
);

/**
 * Make the setting match (used by setup): new posts closed, existing pings removed.
 */
function lumipix_close_comments_everywhere() {
	update_option( 'default_comment_status', 'closed' );
	update_option( 'default_ping_status', 'closed' );
	update_option( 'default_pingback_flag', 0 );
	global $wpdb;
	$wpdb->query( "UPDATE {$wpdb->posts} SET comment_status = 'closed', ping_status = 'closed'" ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery
	// Remove self-pingbacks that internal links created.
	$pings = get_comments(
		array(
			'type__in' => array( 'pingback', 'trackback' ),
			'fields'   => 'ids',
			'status'   => 'all',
			'number'   => 500,
		)
	);
	foreach ( $pings as $id ) {
		wp_delete_comment( $id, true );
	}
	return count( $pings );
}
