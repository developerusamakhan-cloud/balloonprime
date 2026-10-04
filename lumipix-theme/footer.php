<?php
/**
 * Site footer – a link-rich footer that connects every tool page.
 *
 * @package Lumipix
 */

defined( 'ABSPATH' ) || exit;
?>
</main>

<footer class="site-footer">
	<div class="container">
		<div class="site-footer__grid">
			<div class="site-footer__brand">
				<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php echo lumipix_logo_mark( 28 ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
					<span class="brand__name"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
				</a>
				<p><?php echo esc_html( get_theme_mod( 'lumipix_footer_text', __( 'Fast, private image tools that run in your browser. No uploads, no signups, no watermarks.', 'lumipix' ) ) ); ?></p>
				<p class="privacy-pill"><?php echo lumipix_icon( 'shield', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?> <?php esc_html_e( 'Your images never leave your device', 'lumipix' ); ?></p>
			</div>

			<?php foreach ( lumipix_tool_groups() as $gkey => $group ) : ?>
				<div class="site-footer__col">
					<p class="site-footer__title"><?php echo esc_html( $group['label'] ); ?></p>
					<ul>
						<?php foreach ( lumipix_group_tools( $gkey ) as $key => $tool ) : ?>
							<?php $url = lumipix_tool_url( $key ); ?>
							<?php if ( $url ) : ?>
								<li><a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $tool['nav'] ); ?></a></li>
							<?php endif; ?>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endforeach; ?>

			<div class="site-footer__col">
				<p class="site-footer__title"><?php esc_html_e( 'Company', 'lumipix' ); ?></p>
				<?php
				if ( has_nav_menu( 'footer' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'container'      => false,
							'depth'          => 1,
						)
					);
				} else {
					$company = array_filter( array( lumipix_installer_page_id( 'about' ), lumipix_installer_page_id( 'contact' ), lumipix_installer_page_id( 'privacy' ) ) );
					if ( $company ) {
						echo '<ul>';
						wp_list_pages(
							array(
								'title_li' => '',
								'depth'    => 1,
								'include'  => implode( ',', $company ),
							)
						);
						echo '</ul>';
					}
				}
				?>
			</div>
		</div>

		<div class="site-footer__bottom">
			<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>. <?php esc_html_e( 'All rights reserved.', 'lumipix' ); ?></p>
			<p><?php esc_html_e( 'Made for people who just need it done.', 'lumipix' ); ?></p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
