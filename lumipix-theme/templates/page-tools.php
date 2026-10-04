<?php
/**
 * Template Name: All tools (hub)
 *
 * Hub page listing every tool, grouped. Strong internal-linking page.
 *
 * @package Lumipix
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<section class="page-hero">
	<div class="hero__bg" aria-hidden="true"><span class="glow glow--a"></span><span class="grid-lines"></span></div>
	<div class="container">
		<?php lumipix_breadcrumbs(); ?>
		<h1 class="page-hero__title"><?php the_title(); ?></h1>
		<p class="page-hero__lead"><?php esc_html_e( 'Every Lumi Pix tool runs inside your browser. Your images are never uploaded, there is nothing to install and no account to create.', 'lumipix' ); ?></p>
		<form class="tool-search tool-search--inline" role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>" data-tool-search-form>
			<label class="visually-hidden" for="hub-search"><?php esc_html_e( 'Filter tools', 'lumipix' ); ?></label>
			<?php echo lumipix_icon( 'search', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
			<input id="hub-search" type="search" name="s" autocomplete="off" placeholder="<?php esc_attr_e( 'Filter tools…', 'lumipix' ); ?>" data-tool-search-input>
		</form>
	</div>
</section>

<section class="section section--tight">
	<div class="container">
		<?php foreach ( lumipix_tool_groups() as $gkey => $group ) : ?>
			<div class="tool-group" data-tool-group>
				<div class="tool-group__head">
					<h2 class="tool-group__title"><?php echo lumipix_icon( $group['icon'], 20 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php echo esc_html( $group['label'] ); ?></h2>
					<p><?php echo esc_html( $group['desc'] ); ?></p>
				</div>
				<div class="tool-grid tool-grid--3">
					<?php
					foreach ( array_keys( lumipix_group_tools( $gkey ) ) as $key ) {
						lumipix_tool_card( $key );
					}
					?>
				</div>
			</div>
		<?php endforeach; ?>
		<p class="tool-search-empty" data-tool-search-empty hidden><?php esc_html_e( 'No tool matches that yet.', 'lumipix' ); ?></p>
	</div>
</section>
<?php
while ( have_posts() ) :
	the_post();
	if ( '' !== trim( get_the_content() ) ) :
		?>
<section class="section section--tight">
	<div class="container container--prose">
		<div class="prose"><?php the_content(); ?></div>
	</div>
</section>
		<?php
	endif;
endwhile;
?>
<?php $hub_faqs = lumipix_get_faqs( get_queried_object_id() ); ?>
<?php if ( $hub_faqs ) : ?>
<section class="section section--tight">
	<div class="container container--prose">
		<?php lumipix_render_faqs( $hub_faqs ); ?>
	</div>
</section>
<?php endif; ?>
<?php
get_footer();
