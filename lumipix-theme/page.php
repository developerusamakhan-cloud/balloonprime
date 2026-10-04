<?php
/**
 * Generic page.
 *
 * @package Lumipix
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<section class="page-hero page-hero--compact">
		<div class="hero__bg" aria-hidden="true"><span class="glow glow--a"></span><span class="grid-lines"></span></div>
		<div class="container container--prose">
			<?php lumipix_breadcrumbs(); ?>
			<h1 class="page-hero__title"><?php the_title(); ?></h1>
		</div>
	</section>
	<section class="section section--tight">
		<div class="container container--prose">
			<div class="prose">
				<?php
				the_content();
				wp_link_pages();
				?>
			</div>
			<?php lumipix_render_faqs( lumipix_get_faqs( get_the_ID() ) ); ?>
		</div>
	</section>
	<?php
endwhile;

get_footer();
