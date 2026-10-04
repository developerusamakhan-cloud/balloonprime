<?php
/**
 * Not found – send visitors to the tools instead of a dead end.
 *
 * @package Lumipix
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<section class="page-hero">
	<div class="hero__bg" aria-hidden="true"><span class="glow glow--a"></span><span class="glow glow--b"></span><span class="grid-lines"></span></div>
	<div class="container hero__inner">
		<p class="eyebrow"><span class="eyebrow__dot"></span>404</p>
		<h1 class="hero__title"><?php esc_html_e( 'This page went', 'lumipix' ); ?> <em class="serif-accent"><?php esc_html_e( 'missing', 'lumipix' ); ?></em></h1>
		<p class="hero__lead"><?php esc_html_e( 'The tools are all still here, though. Pick one below.', 'lumipix' ); ?></p>
	</div>
</section>
<section class="section section--tight">
	<div class="container">
		<div class="tool-grid tool-grid--3">
			<?php
			foreach ( array_keys( lumipix_main_tools() ) as $key ) {
				lumipix_tool_card( $key );
			}
			?>
		</div>
	</div>
</section>
<?php
get_footer();
