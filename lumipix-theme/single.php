<?php
/**
 * Single article.
 *
 * @package Lumipix
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	$related_tool = lumipix_post_related_tool( get_the_ID() );
	$cats         = get_the_category();
	?>
	<article <?php post_class( 'article' ); ?>>
		<header class="article__header">
			<div class="hero__bg" aria-hidden="true"><span class="glow glow--a"></span><span class="grid-lines"></span></div>
			<div class="container article__head">
				<?php lumipix_breadcrumbs(); ?>
				<?php if ( $cats ) : ?>
					<a class="pill" href="<?php echo esc_url( get_category_link( $cats[0] ) ); ?>"><?php echo esc_html( $cats[0]->name ); ?></a>
				<?php endif; ?>
				<h1 class="article__title"><?php the_title(); ?></h1>
				<?php if ( has_excerpt() ) : ?>
					<p class="article__lead"><?php echo esc_html( get_the_excerpt() ); ?></p>
				<?php endif; ?>
				<div class="article__meta">
					<span class="avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?></span>
					<span><?php the_author(); ?></span>
					<span aria-hidden="true">·</span>
					<time datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>"><?php
						/* translators: %s: date */
						printf( esc_html__( 'Updated %s', 'lumipix' ), esc_html( get_the_modified_date() ) );
					?></time>
					<span aria-hidden="true">·</span>
					<span><?php echo esc_html( lumipix_reading_time() ); ?></span>
				</div>
			</div>
		</header>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="container container--wide-media">
				<figure class="article__media"><?php the_post_thumbnail( 'lumipix-hero', array( 'fetchpriority' => 'high' ) ); ?></figure>
			</div>
		<?php endif; ?>

		<div class="container article__layout">
			<div class="prose article__content">
				<?php
				the_content();
				wp_link_pages();
				?>
				<?php lumipix_render_faqs( lumipix_get_faqs( get_the_ID() ) ); ?>
				<?php lumipix_ad_slot( 'article-mid' ); ?>
				<?php
				$tags = get_the_tags();
				if ( $tags ) :
					?>
					<div class="chips article__tags">
						<?php foreach ( $tags as $tag ) : ?>
							<a class="chip" href="<?php echo esc_url( get_tag_link( $tag ) ); ?>">#<?php echo esc_html( $tag->name ); ?></a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>

			<aside class="article__aside">
				<div class="aside-card">
					<p class="aside-card__title"><?php echo lumipix_icon( 'sparkles', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Free image tools', 'lumipix' ); ?></p>
					<ul class="aside-links">
						<?php
						$aside_keys = array_unique( array_filter( array( $related_tool, 'compress-image', 'image-resizer', 'background-remover', 'remove-white-background' ) ) );
						foreach ( array_slice( $aside_keys, 0, 4 ) as $k ) :
							$t = lumipix_get_tool( $k );
							$u = lumipix_tool_url( $k );
							if ( ! $t || ! $u ) {
								continue;
							}
							?>
							<li><a href="<?php echo esc_url( $u ); ?>"><span class="aside-links__icon tone-<?php echo esc_attr( $t['group'] ); ?>"><?php echo lumipix_icon( $t['icon'], 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><?php echo esc_html( $t['nav'] ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php lumipix_ad_slot( 'sidebar' ); ?>
				<?php if ( is_active_sidebar( 'blog-sidebar' ) ) : ?>
					<?php dynamic_sidebar( 'blog-sidebar' ); ?>
				<?php endif; ?>
			</aside>
		</div>
	</article>

	<?php
	$related = lumipix_related_posts( get_the_ID(), 3 );
	if ( $related ) :
		?>
		<section class="section section--tight" aria-labelledby="more-title">
			<div class="container">
				<h2 id="more-title" class="section-title section-title--sm"><?php esc_html_e( 'Keep reading', 'lumipix' ); ?></h2>
				<div class="post-grid">
					<?php
					foreach ( $related as $r ) {
						lumipix_post_card( $r );
					}
					?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php
	if ( comments_open() || get_comments_number() ) {
		echo '<div class="container container--prose">';
		comments_template();
		echo '</div>';
	}
endwhile;

get_footer();
