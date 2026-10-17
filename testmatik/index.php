<?php
/**
 * Blog index, category archives and search results.
 *
 * @package Testmatik
 */

defined( 'ABSPATH' ) || exit;

get_header();

if ( is_search() ) {
	/* translators: %s search query */
	$title = sprintf( __( '“%s” için sonuçlar', 'testmatik' ), get_search_query() );
	$lead  = '';
} elseif ( is_category() ) {
	$title = single_cat_title( '', false );
	$lead  = wp_strip_all_tags( (string) category_description() );
} elseif ( is_home() && get_option( 'page_for_posts' ) ) {
	$title = get_the_title( (int) get_option( 'page_for_posts' ) );
	$lead  = __( 'Klavye, ekran, mikrofon, kamera, mouse ve hoparlör sorunları için adım adım Türkçe çözüm rehberleri.', 'testmatik' );
} else {
	$title = get_the_archive_title();
	$lead  = '';
}
$current_cat = is_category() ? get_queried_object_id() : 0;
$cats        = get_categories( array( 'hide_empty' => true ) );
?>

<section class="page-hero page-hero--blog">
	<div class="container">
		<?php testmatik_breadcrumbs(); ?>
		<h1 class="page-hero__title"><?php echo esc_html( $title ); ?></h1>
		<?php if ( $lead ) : ?><p class="page-hero__lead"><?php echo esc_html( $lead ); ?></p><?php endif; ?>
		<?php if ( $cats && ! is_search() ) : ?>
			<nav class="chips" aria-label="<?php esc_attr_e( 'Kategoriler', 'testmatik' ); ?>">
				<?php $blog = testmatik_blog_url(); ?>
				<?php if ( $blog ) : ?>
					<a class="chip<?php echo $current_cat ? '' : ' is-active'; ?>" href="<?php echo esc_url( $blog ); ?>"><?php esc_html_e( 'Tümü', 'testmatik' ); ?></a>
				<?php endif; ?>
				<?php foreach ( $cats as $c ) : ?>
					<a class="chip<?php echo $current_cat === $c->term_id ? ' is-active' : ''; ?>" href="<?php echo esc_url( get_category_link( $c ) ); ?>"><?php echo esc_html( $c->name ); ?></a>
				<?php endforeach; ?>
			</nav>
		<?php endif; ?>
	</div>
</section>

<section class="section section--tight">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<div class="post-grid">
				<?php
				while ( have_posts() ) {
					the_post();
					testmatik_post_card( get_post() );
				}
				?>
			</div>
			<div class="pagination">
				<?php
				the_posts_pagination(
					array(
						'prev_text' => __( '← Önceki', 'testmatik' ),
						'next_text' => __( 'Sonraki →', 'testmatik' ),
					)
				);
				?>
			</div>
		<?php else : ?>
			<div class="empty">
				<p><?php esc_html_e( 'Burada henüz bir şey yok. Testlerden birini deneyin:', 'testmatik' ); ?></p>
			</div>
		<?php endif; ?>
	</div>
</section>

<section class="section section--tight">
	<div class="container">
		<div class="section-head"><p class="kicker"><?php esc_html_e( 'Ücretsiz araçlar', 'testmatik' ); ?></p><h2 class="section-title"><?php esc_html_e( 'Donanımınızı test edin', 'testmatik' ); ?></h2></div>
		<div class="tool-grid">
			<?php
			foreach ( array_keys( testmatik_tools() ) as $k ) {
				testmatik_tool_card( $k );
			}
			?>
		</div>
	</div>
</section>

<?php
get_footer();
