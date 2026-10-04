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
	$author_id    = (int) get_the_author_meta( 'ID' );
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
					<a class="article__author" href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>">
						<span class="avatar"><?php echo get_avatar( $author_id, 64, '', get_the_author() ); ?></span>
						<span><?php the_author(); ?></span>
					</a>
					<span aria-hidden="true">·</span>
					<time datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>">
						<?php
						/* translators: %s: date */
						printf( esc_html__( 'Updated %s', 'lumipix' ), esc_html( get_the_modified_date() ) );
						?>
					</time>
					<span aria-hidden="true">·</span>
					<span><?php echo esc_html( lumipix_reading_time() ); ?></span>
				</div>
			</div>
		</header>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="container article__media-wrap">
				<figure class="article__media"><?php the_post_thumbnail( 'full', array( 'fetchpriority' => 'high', 'sizes' => '(max-width: 1140px) 100vw, 1076px' ) ); ?></figure>
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
				<?php lumipix_author_box( $author_id ); ?>
			</div>

			<aside class="article__aside">
				<div class="article__aside-inner">
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
					<?php
					$side_guides = lumipix_related_posts( get_the_ID(), 4 );
					if ( $side_guides ) :
						?>
						<div class="aside-card">
							<p class="aside-card__title"><?php echo lumipix_icon( 'book', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Related guides', 'lumipix' ); ?></p>
							<ul class="aside-guides">
								<?php foreach ( $side_guides as $guide ) : ?>
									<li><a href="<?php echo esc_url( get_permalink( $guide ) ); ?>"><?php echo esc_html( get_the_title( $guide ) ); ?></a></li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>
					<?php lumipix_ad_slot( 'sidebar' ); ?>
				</div>
			</aside>
		</div>
	</article>

	<?php
	// Latest guides not already listed in the sidebar.
	$related = get_posts(
		array(
			'posts_per_page' => 3,
			'post__not_in'   => array_merge( array( get_the_ID() ), isset( $side_guides ) ? wp_list_pluck( $side_guides, 'ID' ) : array() ),
			'no_found_rows'  => true,
		)
	);
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
endwhile;

get_footer();
