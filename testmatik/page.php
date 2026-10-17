<?php
/**
 * Pages. Tool pages (with a "Testmatik" tool selected) use the tool layout.
 *
 * @package Testmatik
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	$key   = testmatik_page_tool();
	$intro = (string) get_post_meta( get_the_ID(), '_testmatik_intro', true );
	list( $html, $toc ) = testmatik_heading_anchors( apply_filters( 'the_content', get_the_content() ) );
	$faqs = testmatik_get_faqs( get_the_ID() );

	if ( $key ) :
		$tool = testmatik_get_tool( $key );
		?>
		<section class="tool-hero tone-<?php echo esc_attr( $tool['tone'] ); ?>">
			<div class="container container--tool">
				<?php testmatik_breadcrumbs(); ?>
				<div class="tool-hero__head">
					<span class="tool-hero__icon"><?php echo testmatik_icon( $tool['icon'], 28 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
					<div>
						<h1 class="tool-hero__title"><?php the_title(); ?></h1>
						<?php if ( $intro ) : ?><p class="tool-hero__lead"><?php echo esc_html( $intro ); ?></p><?php endif; ?>
					</div>
				</div>
				<div class="tool-shell">
					<?php echo testmatik_render_tool_app( $key ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</div>
				<ul class="tool-trust">
					<li><?php echo testmatik_icon( 'shield', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Hiçbir veri yüklenmez', 'testmatik' ); ?></li>
					<li><?php echo testmatik_icon( 'gift', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Ücretsiz, kayıt yok', 'testmatik' ); ?></li>
					<li><?php echo testmatik_icon( 'laptop', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Bilgisayar ve telefonda çalışır', 'testmatik' ); ?></li>
				</ul>
				<?php testmatik_ad_slot( 'below_tool' ); ?>
			</div>
		</section>

		<section class="section section--guide">
			<div class="container">
				<div class="layout-guide">
					<aside class="layout-guide__side">
						<?php testmatik_render_toc( $toc ); ?>
						<div class="side-tools">
							<p class="side-tools__title"><?php esc_html_e( 'Diğer testler', 'testmatik' ); ?></p>
							<?php
							foreach ( array_keys( testmatik_tools() ) as $other ) {
								if ( $other !== $key ) {
									testmatik_tool_card( $other, 'compact' );
								}
							}
							?>
						</div>
					</aside>
					<div class="prose">
						<?php echo $html; // phpcs:ignore WordPress.Security.EscapeOutput -- post content. ?>
						<?php testmatik_render_faqs( $faqs ); ?>
					</div>
				</div>
			</div>
		</section>

		<?php
		$related = testmatik_tool_posts( $key, 3 );
		if ( $related ) :
			?>
			<section class="section section--tight">
				<div class="container">
					<div class="section-head"><p class="kicker"><?php esc_html_e( 'Rehberler', 'testmatik' ); ?></p><h2 class="section-title"><?php echo esc_html( sprintf( /* translators: %s tool short name */ __( '%s sorunları için rehberler', 'testmatik' ), $tool['short'] ) ); ?></h2></div>
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
				<div class="section-head"><p class="kicker"><?php esc_html_e( 'Devam edin', 'testmatik' ); ?></p><h2 class="section-title"><?php esc_html_e( 'Diğer donanım testleri', 'testmatik' ); ?></h2></div>
				<div class="tool-grid">
					<?php
					foreach ( array_keys( testmatik_tools() ) as $other ) {
						if ( $other !== $key ) {
							testmatik_tool_card( $other );
						}
					}
					?>
				</div>
			</div>
		</section>

	<?php else : ?>

		<section class="page-hero">
			<div class="container container--prose">
				<?php testmatik_breadcrumbs(); ?>
				<h1 class="page-hero__title"><?php the_title(); ?></h1>
				<?php if ( $intro ) : ?><p class="page-hero__lead"><?php echo esc_html( $intro ); ?></p><?php endif; ?>
			</div>
		</section>
		<section class="section section--tight">
			<div class="container container--prose">
				<div class="prose">
					<?php echo $html; // phpcs:ignore WordPress.Security.EscapeOutput -- post content. ?>
				</div>
				<?php testmatik_render_faqs( $faqs ); ?>
			</div>
		</section>

	<?php
	endif;
endwhile;

get_footer();
