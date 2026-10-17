<?php
/**
 * Single article.
 *
 * @package Testmatik
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	$id    = get_the_ID();
	$intro = (string) get_post_meta( $id, '_testmatik_intro', true );
	$key   = (string) get_post_meta( $id, '_testmatik_tool', true );
	$tool  = $key ? testmatik_get_tool( $key ) : null;
	$cats  = get_the_category();
	list( $html, $toc ) = testmatik_heading_anchors( apply_filters( 'the_content', get_the_content() ) );
	?>
	<article <?php post_class( 'article' ); ?>>
		<header class="article-hero<?php echo $tool ? ' tone-' . esc_attr( $tool['tone'] ) : ''; ?>">
			<div class="container container--article">
				<?php testmatik_breadcrumbs(); ?>
				<?php if ( $cats ) : ?>
					<a class="pill" href="<?php echo esc_url( get_category_link( $cats[0] ) ); ?>"><?php echo esc_html( $cats[0]->name ); ?></a>
				<?php endif; ?>
				<h1 class="article-hero__title"><?php the_title(); ?></h1>
				<?php if ( $intro ) : ?><p class="article-hero__lead"><?php echo esc_html( $intro ); ?></p><?php endif; ?>
				<p class="article-meta">
					<span><?php echo testmatik_icon( 'clock', 15 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php echo esc_html( sprintf( /* translators: %d minutes */ __( '%d dk okuma', 'testmatik' ), testmatik_reading_time( $id ) ) ); ?></span>
					<span><?php esc_html_e( 'Güncellendi:', 'testmatik' ); ?> <time datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>"><?php echo esc_html( get_the_modified_date( 'j F Y' ) ); ?></time></span>
				</p>
			</div>
		</header>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="container container--article article-figure"><?php the_post_thumbnail( 'large', array( 'loading' => 'eager', 'fetchpriority' => 'high' ) ); ?></div>
		<?php endif; ?>

		<div class="container">
			<div class="layout-article">
				<div class="prose article__body">
					<?php echo $html; // phpcs:ignore WordPress.Security.EscapeOutput -- post content. ?>
					<?php testmatik_ad_slot( 'in_article' ); ?>
					<?php testmatik_render_faqs( testmatik_get_faqs( $id ) ); ?>
				</div>
				<aside class="layout-article__side">
					<?php testmatik_render_toc( $toc ); ?>
					<?php if ( $tool && testmatik_tool_url( $key ) ) : ?>
						<div class="side-cta tone-<?php echo esc_attr( $tool['tone'] ); ?>">
							<span class="side-cta__icon"><?php echo testmatik_icon( $tool['icon'], 22 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
							<p class="side-cta__title"><?php echo esc_html( $tool['name'] ); ?></p>
							<p><?php echo esc_html( $tool['blurb'] ); ?></p>
							<a class="btn btn--primary btn--block" href="<?php echo esc_url( testmatik_tool_url( $key ) ); ?>"><?php esc_html_e( 'Testi başlat', 'testmatik' ); ?></a>
						</div>
					<?php endif; ?>
					<?php testmatik_ad_slot( 'sidebar' ); ?>
				</aside>
			</div>
		</div>
	</article>

	<?php
	$related = get_posts(
		array(
			'posts_per_page' => 3,
			'post__not_in'   => array( $id ),
			'category__in'   => $cats ? wp_list_pluck( $cats, 'term_id' ) : array(),
			'no_found_rows'  => true,
		)
	);
	if ( count( $related ) < 3 ) {
		$related = array_merge(
			$related,
			get_posts(
				array(
					'posts_per_page' => 3 - count( $related ),
					'post__not_in'   => array_merge( array( $id ), wp_list_pluck( $related, 'ID' ) ),
					'no_found_rows'  => true,
				)
			)
		);
	}
	if ( $related ) :
		?>
		<section class="section section--tight">
			<div class="container">
				<div class="section-head"><p class="kicker"><?php esc_html_e( 'Okumaya devam edin', 'testmatik' ); ?></p><h2 class="section-title"><?php esc_html_e( 'İlgili rehberler', 'testmatik' ); ?></h2></div>
				<div class="post-grid">
					<?php
					foreach ( $related as $p ) {
						testmatik_post_card( $p );
					}
					?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<section class="section section--tight">
		<div class="container">
			<div class="section-head"><p class="kicker"><?php esc_html_e( 'Ücretsiz araçlar', 'testmatik' ); ?></p><h2 class="section-title"><?php esc_html_e( 'Donanımınızı şimdi test edin', 'testmatik' ); ?></h2></div>
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
endwhile;

get_footer();
