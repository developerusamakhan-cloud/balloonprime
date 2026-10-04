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
					echo '<ul>';
					foreach ( array( 'about', 'tools', 'blog', 'contact' ) as $company_key ) {
						$company_id = lumipix_installer_page_id( $company_key );
						if ( $company_id ) {
							echo '<li><a href="' . esc_url( get_permalink( $company_id ) ) . '">' . esc_html( get_the_title( $company_id ) ) . '</a></li>';
						}
					}
					echo '</ul>';
				}
				?>
				<?php $contact_email = lumipix_contact_email(); ?>
				<?php if ( $contact_email ) : ?>
					<p class="site-footer__email"><a href="mailto:<?php echo esc_attr( antispambot( $contact_email ) ); ?>"><?php echo esc_html( antispambot( $contact_email ) ); ?></a></p>
				<?php endif; ?>
			</div>

			<div class="site-footer__col">
				<p class="site-footer__title"><?php esc_html_e( 'Legal', 'lumipix' ); ?></p>
				<ul>
					<?php foreach ( lumipix_legal_links() as $legal ) : ?>
						<li><a href="<?php echo esc_url( $legal[1] ); ?>"><?php echo esc_html( $legal[0] ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>

		<div class="site-footer__bottom">
			<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>. <?php esc_html_e( 'All rights reserved.', 'lumipix' ); ?> <?php esc_html_e( 'Lumi Pix is an independent service and is not affiliated with any government body, exam board or other brand mentioned on this site.', 'lumipix' ); ?></p>
			<nav class="site-footer__legal" aria-label="<?php esc_attr_e( 'Legal', 'lumipix' ); ?>">
				<?php foreach ( lumipix_legal_links() as $legal ) : ?>
					<a href="<?php echo esc_url( $legal[1] ); ?>"><?php echo esc_html( $legal[0] ); ?></a>
				<?php endforeach; ?>
			</nav>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
