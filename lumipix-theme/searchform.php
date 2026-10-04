<?php
/**
 * Search form.
 *
 * @package Lumipix
 */

defined( 'ABSPATH' ) || exit;

$lumipix_sid = 'search-' . wp_rand( 100, 999 );
?>
<form role="search" method="get" class="search-form tool-search tool-search--inline" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="visually-hidden" for="<?php echo esc_attr( $lumipix_sid ); ?>"><?php esc_html_e( 'Search', 'lumipix' ); ?></label>
	<?php echo lumipix_icon( 'search', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
	<input type="search" id="<?php echo esc_attr( $lumipix_sid ); ?>" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Search guides and tools…', 'lumipix' ); ?>">
</form>
