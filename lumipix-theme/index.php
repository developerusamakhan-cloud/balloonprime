<?php
/**
 * Blog index and generic fallback (also used for archives and search).
 *
 * @package Lumipix
 */

defined( 'ABSPATH' ) || exit;

get_header();

if ( is_home() ) {
	$heading = get_the_title( (int) get_option( 'page_for_posts' ) );
	$lead    = __( 'Short, practical guides for everyday image tasks – and the free tools to finish them.', 'lumipix' );
} elseif ( is_search() ) {
	/* translators: %s: search query */
	$heading = sprintf( __( 'Results for “%s”', 'lumipix' ), get_search_query() );
	$lead    = '';
} elseif ( is_archive() ) {
	$heading = wp_strip_all_tags( get_the_archive_title() );
	$lead    = wp_strip_all_tags( get_the_archive_description() );
} else {
	$heading = __( 'Latest', 'lumipix' );
	$lead    = '';
}
?>
<section class="page-hero page-hero--compact">
	<div class="hero__bg" aria-hidden="true"><span class="glow glow--a"></span><span class="grid-lines"></span></div>
	<div class="container">
		<?php lumipix_breadcrumbs(); ?>
		<h1 class="page-hero__title"><?php echo esc_html( $heading ? $heading : __( 'Guides', 'lumipix' ) ); ?></h1>
		<?php if ( $lead ) : ?>
			<p class="page-hero__lead"><?php echo esc_html( $lead ); ?></p>
		<?php endif; ?>
		<?php
		if ( is_home() || is_category() ) {
			$cats = get_categories( array( 'hide_empty' => true ) );
			if ( $cats ) {
				echo '<div class="chips">';
				$blog_url = get_permalink( (int) get_option( 'page_for_posts' ) );
				if ( $blog_url ) {
					printf( '<a class="chip%s" href="%s">%s</a>', is_home() ? ' is-active' : '', esc_url( $blog_url ), esc_html__( 'All', 'lumipix' ) );
				}
				foreach ( $cats as $cat ) {
					printf( '<a class="chip%s" href="%s">%s</a>', is_category( $cat->term_id ) ? ' is-active' : '', esc_url( get_category_link( $cat ) ), esc_html( $cat->name ) );
				}
				echo '</div>';
			}
		}
		?>
	</div>
</section>

<section class="section section--tight">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<div class="post-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					if ( 'post' === get_post_type() ) {
						lumipix_post_card();
					} else {
						?>
						<article class="post-card post-card--plain">
							<div class="post-card__body">
								<h3 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<p class="post-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
							</div>
						</article>
						<?php
					}
				endwhile;
				?>
			</div>
			<div class="pagination">
				<?php
				the_posts_pagination(
					array(
						'mid_size'  => 1,
						'prev_text' => __( 'Previous', 'lumipix' ),
						'next_text' => __( 'Next', 'lumipix' ),
					)
				);
				?>
			</div>
		<?php else : ?>
			<div class="empty-state">
				<p><?php esc_html_e( 'Nothing here yet.', 'lumipix' ); ?></p>
				<?php get_search_form(); ?>
			</div>
		<?php endif; ?>
	</div>
</section>
<?php
get_footer();
