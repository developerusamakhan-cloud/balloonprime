<?php
/**
 * Footer.
 *
 * @package Testmatik
 */

defined( 'ABSPATH' ) || exit;

$guides = get_posts( array( 'posts_per_page' => 6, 'no_found_rows' => true ) );
$legal  = array(
	'gizlilik-politikasi' => __( 'Gizlilik Politikası', 'testmatik' ),
	'kullanim-sartlari'   => __( 'Kullanım Şartları', 'testmatik' ),
	'cerez-politikasi'    => __( 'Çerez Politikası', 'testmatik' ),
);
?>
</main>
<footer class="site-footer">
	<div class="container">
		<div class="site-footer__grid">
			<div class="site-footer__brand">
				<?php testmatik_site_logo(); ?>
				<p><?php echo esc_html( get_theme_mod( 'testmatik_footer_text', 'Tarayıcıda çalışan ücretsiz donanım testleri. Ses, görüntü ve tuş vuruşlarınız cihazınızdan çıkmaz.' ) ); ?></p>
				<p class="site-footer__mail"><?php echo testmatik_icon( 'mail', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><a href="mailto:<?php echo esc_attr( antispambot( testmatik_contact_email() ) ); ?>"><?php echo esc_html( antispambot( testmatik_contact_email() ) ); ?></a></p>
			</div>
			<div>
				<p class="site-footer__title"><?php esc_html_e( 'Testler', 'testmatik' ); ?></p>
				<ul>
					<?php foreach ( testmatik_tools() as $key => $tool ) : $u = testmatik_tool_url( $key ); ?>
						<?php if ( $u ) : ?><li><a href="<?php echo esc_url( $u ); ?>"><?php echo esc_html( $tool['name'] ); ?></a></li><?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php if ( $guides ) : ?>
			<div>
				<p class="site-footer__title"><?php esc_html_e( 'Rehberler', 'testmatik' ); ?></p>
				<ul>
					<?php foreach ( $guides as $g ) : ?>
						<li><a href="<?php echo esc_url( get_permalink( $g ) ); ?>"><?php echo esc_html( get_the_title( $g ) ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>
			<div>
				<p class="site-footer__title"><?php esc_html_e( 'Testmatik', 'testmatik' ); ?></p>
				<ul>
					<?php
					$pages = array(
						'hakkimizda' => __( 'Hakkımızda', 'testmatik' ),
						'iletisim'   => __( 'İletişim', 'testmatik' ),
					);
					foreach ( $pages as $slug => $label ) :
						$u = testmatik_page_url( $slug );
						if ( $u ) :
							?>
							<li><a href="<?php echo esc_url( $u ); ?>"><?php echo esc_html( $label ); ?></a></li>
							<?php
						endif;
					endforeach;
					$blog = testmatik_blog_url();
					if ( $blog ) :
						?>
						<li><a href="<?php echo esc_url( $blog ); ?>"><?php esc_html_e( 'Tüm rehberler', 'testmatik' ); ?></a></li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
		<div class="site-footer__bottom">
			<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'Tüm testler ücretsizdir ve cihazınızda çalışır.', 'testmatik' ); ?></p>
			<ul>
				<?php foreach ( $legal as $slug => $label ) : $u = testmatik_page_url( $slug ); ?>
					<?php if ( $u ) : ?><li><a href="<?php echo esc_url( $u ); ?>"><?php echo esc_html( $label ); ?></a></li><?php endif; ?>
				<?php endforeach; ?>
				<?php if ( testmatik_needs_consent() ) : ?>
					<li><button type="button" class="linklike" data-consent-open><?php esc_html_e( 'Çerez ayarları', 'testmatik' ); ?></button></li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</footer>
<?php if ( testmatik_needs_consent() ) : ?>
<div class="consent" data-consent hidden role="dialog" aria-labelledby="consent-title" aria-live="polite">
	<div class="consent__body">
		<p class="consent__title" id="consent-title"><?php echo testmatik_icon( 'cookie', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Çerez tercihleriniz', 'testmatik' ); ?></p>
		<p><?php esc_html_e( 'Zorunlu çerezler sitenin çalışması içindir. Analitik ve pazarlama çerezlerini yalnızca onay verirseniz kullanırız. Test verileriniz hiçbir durumda cihazınızdan çıkmaz.', 'testmatik' ); ?>
		<?php $cp = testmatik_page_url( 'cerez-politikasi' ); if ( $cp ) : ?> <a href="<?php echo esc_url( $cp ); ?>"><?php esc_html_e( 'Çerez Politikası', 'testmatik' ); ?></a><?php endif; ?></p>
		<div class="consent__opts" data-consent-opts hidden>
			<label class="check"><input type="checkbox" checked disabled> <span><?php esc_html_e( 'Zorunlu', 'testmatik' ); ?></span></label>
			<label class="check"><input type="checkbox" data-consent-key="analytics"> <span><?php esc_html_e( 'Analitik', 'testmatik' ); ?></span></label>
			<label class="check"><input type="checkbox" data-consent-key="marketing"> <span><?php esc_html_e( 'Pazarlama', 'testmatik' ); ?></span></label>
		</div>
	</div>
	<div class="consent__actions">
		<button type="button" class="btn btn--ghost btn--sm" data-consent-custom><?php esc_html_e( 'Ayarla', 'testmatik' ); ?></button>
		<button type="button" class="btn btn--ghost btn--sm" data-consent-reject><?php esc_html_e( 'Reddet', 'testmatik' ); ?></button>
		<button type="button" class="btn btn--primary btn--sm" data-consent-accept><?php esc_html_e( 'Tümünü kabul et', 'testmatik' ); ?></button>
	</div>
</div>
<?php endif; ?>
<?php wp_footer(); ?>
</body>
</html>
