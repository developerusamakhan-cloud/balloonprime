<?php
/**
 * 404.
 *
 * @package Testmatik
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<section class="page-hero page-hero--404">
	<div class="container container--prose">
		<p class="kicker">404</p>
		<h1 class="page-hero__title"><?php esc_html_e( 'Bu sayfa bulunamadı', 'testmatik' ); ?></h1>
		<p class="page-hero__lead"><?php esc_html_e( 'Aradığınız sayfa taşınmış ya da hiç var olmamış olabilir. Aşağıdaki testlerden birine geçin.', 'testmatik' ); ?></p>
		<p><a class="btn btn--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Ana sayfaya dön', 'testmatik' ); ?></a></p>
	</div>
</section>
<section class="section section--tight">
	<div class="container">
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
