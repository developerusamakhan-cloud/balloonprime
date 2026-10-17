<?php
/**
 * Search form.
 *
 * @package Testmatik
 */

defined( 'ABSPATH' ) || exit;
$testmatik_sid = 's-' . wp_unique_id();
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="visually-hidden" for="<?php echo esc_attr( $testmatik_sid ); ?>"><?php esc_html_e( 'Ara', 'testmatik' ); ?></label>
	<input type="search" id="<?php echo esc_attr( $testmatik_sid ); ?>" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Rehberlerde ara…', 'testmatik' ); ?>">
	<button type="submit" class="btn btn--primary btn--sm"><?php esc_html_e( 'Ara', 'testmatik' ); ?></button>
</form>
