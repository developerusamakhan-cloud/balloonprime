<?php
/**
 * Tool landing page (any page with a Lumipix tool attached).
 *
 * Layout: breadcrumbs → heading → working tool → preset chips → how-to →
 * editable page content → FAQ → related tools → guides.
 *
 * @package Lumipix
 */

defined( 'ABSPATH' ) || exit;

get_header();

$page_id = get_queried_object_id();
$key     = lumipix_page_tool_key( $page_id );
$tool    = lumipix_get_tool( $key );
$family  = lumipix_tool_family( $key );
$groups  = lumipix_tool_groups();

$steps = array(
	'compress' => array( __( 'Choose the size you need', 'lumipix' ), __( 'Drop one or more images', 'lumipix' ), __( 'Download the result', 'lumipix' ) ),
	'resize'   => array( __( 'Pick a preset or type a size', 'lumipix' ), __( 'Drop your images', 'lumipix' ), __( 'Download at the exact size', 'lumipix' ) ),
	'bg'       => array( __( 'Drop a photo', 'lumipix' ), __( 'AI removes the background on your device', 'lumipix' ), __( 'Download a transparent PNG', 'lumipix' ) ),
	'colorkey' => array( __( 'Drop a logo, signature or scan', 'lumipix' ), __( 'Adjust tolerance if needed', 'lumipix' ), __( 'Download a transparent PNG', 'lumipix' ) ),
);
$app_steps = isset( $steps[ $tool['app'] ] ) ? $steps[ $tool['app'] ] : $steps['compress'];

while ( have_posts() ) :
	the_post();
	?>
	<section class="tool-hero tone-<?php echo esc_attr( $tool['group'] ); ?>">
		<div class="hero__bg" aria-hidden="true"><span class="glow glow--a"></span><span class="grid-lines"></span></div>
		<div class="container container--tool">
			<?php lumipix_breadcrumbs(); ?>
			<div class="tool-hero__head">
				<p class="eyebrow"><span class="eyebrow__dot"></span><?php echo esc_html( isset( $groups[ $tool['group'] ] ) ? $groups[ $tool['group'] ]['label'] : '' ); ?> · <?php esc_html_e( 'Free · Private · No signup', 'lumipix' ); ?></p>
				<h1 class="tool-hero__title"><?php echo esc_html( get_the_title() ); ?></h1>
				<p class="tool-hero__lead"><?php echo esc_html( $tool['lead'] ); ?></p>
			</div>
			<div class="tool-shell">
				<?php echo lumipix_render_tool_app( $key ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
			</div>
			<?php if ( count( $family ) > 1 ) : ?>
				<div class="tool-family">
					<p class="tool-family__label"><?php esc_html_e( 'Quick presets', 'lumipix' ); ?></p>
					<?php lumipix_tool_chips( $family, $key ); ?>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<?php lumipix_ad_slot( 'tool-below' ); ?>

	<section class="section section--tight">
		<div class="container container--tool">
			<ol class="steps">
				<?php foreach ( $app_steps as $i => $step ) : ?>
					<li class="step"><span class="step__num"><?php echo esc_html( $i + 1 ); ?></span><span class="step__text"><?php echo esc_html( $step ); ?></span></li>
				<?php endforeach; ?>
			</ol>
		</div>
	</section>

	<section class="section section--tight">
		<div class="container container--prose">
			<div class="prose">
				<?php the_content(); ?>
			</div>
		</div>
	</section>

	<?php if ( ! empty( $tool['faqs'] ) ) : ?>
		<section class="section section--tight" aria-labelledby="faq-title">
			<div class="container container--prose">
				<h2 id="faq-title" class="section-title section-title--sm"><?php esc_html_e( 'Frequently asked questions', 'lumipix' ); ?></h2>
				<div class="faq">
					<?php foreach ( $tool['faqs'] as $q => $a ) : ?>
						<details class="faq__item">
							<summary><?php echo esc_html( $q ); ?><span class="faq__icon" aria-hidden="true"></span></summary>
							<p><?php echo esc_html( $a ); ?></p>
						</details>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php
	$related = array_filter(
		isset( $tool['related'] ) ? (array) $tool['related'] : array(),
		function ( $k ) {
			return (bool) lumipix_tool_url( $k );
		}
	);
	if ( $related ) :
		?>
		<section class="section section--tight" aria-labelledby="related-title">
			<div class="container container--tool">
				<h2 id="related-title" class="section-title section-title--sm"><?php esc_html_e( 'Related tools', 'lumipix' ); ?></h2>
				<div class="tool-grid tool-grid--3">
					<?php
					foreach ( $related as $rkey ) {
						lumipix_tool_card( $rkey );
					}
					?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php
	$guides = lumipix_tool_guides( $key, 3 );
	if ( $guides ) :
		?>
		<section class="section section--tight" aria-labelledby="guides-title">
			<div class="container container--tool">
				<h2 id="guides-title" class="section-title section-title--sm"><?php esc_html_e( 'Helpful guides', 'lumipix' ); ?></h2>
				<div class="post-grid">
					<?php
					foreach ( $guides as $g ) {
						lumipix_post_card( $g );
					}
					?>
				</div>
			</div>
		</section>
	<?php endif; ?>
	<?php
endwhile;

get_footer();
