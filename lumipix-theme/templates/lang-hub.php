<?php
/**
 * Language hub (/fr/, /pt/): the translated tools of one language plus the
 * page content and FAQ. Selected automatically, see inc/lang.php.
 *
 * @package Lumipix
 */

defined( 'ABSPATH' ) || exit;

get_header();

$lang = (string) get_post_meta( get_queried_object_id(), '_lumipix_lang_hub', true );
$hub  = lumipix_lang_hub( $lang );
?>
<section class="page-hero">
	<div class="hero__bg" aria-hidden="true"><span class="glow glow--a"></span><span class="grid-lines"></span></div>
	<div class="container">
		<?php lumipix_breadcrumbs(); ?>
		<p class="eyebrow"><span class="eyebrow__dot"></span><?php esc_html_e( 'Free · Private · No signup', 'lumipix' ); ?></p>
		<h1 class="page-hero__title"><?php the_title(); ?></h1>
		<?php if ( $hub && $hub['lead'] ) : ?>
			<p class="page-hero__lead"><?php echo esc_html( $hub['lead'] ); ?></p>
		<?php endif; ?>
	</div>
</section>

<section class="section section--tight">
	<div class="container">
		<div class="tool-grid tool-grid--3">
			<?php
			foreach ( array_keys( lumipix_lang_tools( $lang ) ) as $key ) {
				lumipix_tool_card( $key );
			}
			?>
		</div>
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

<section class="section section--tight">
	<div class="container container--prose">
		<?php lumipix_render_faqs( lumipix_get_faqs() ); ?>
	</div>
</section>

<?php
get_footer();
