<?php
/**
 * Customizer: Appearance → Customize → Testmatik.
 *
 * @package Testmatik
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'customize_register',
	function ( $wp ) {
		$wp->add_panel( 'testmatik', array( 'title' => 'Testmatik', 'priority' => 30 ) );

		$sections = array(
			'testmatik_home'    => __( 'Ana sayfa', 'testmatik' ),
			'testmatik_footer'  => __( 'İletişim ve alt bilgi', 'testmatik' ),
			'testmatik_tracking' => __( 'Analitik, çerezler ve reklam', 'testmatik' ),
		);
		foreach ( $sections as $id => $title ) {
			$wp->add_section( $id, array( 'title' => $title, 'panel' => 'testmatik' ) );
		}

		$fields = array(
			// id, section, label, type, default, sanitize.
			array( 'testmatik_hero_badge', 'testmatik_home', __( 'Rozet metni', 'testmatik' ), 'text', 'Ücretsiz · Kayıt yok · Hiçbir şey yüklenmez', 'sanitize_text_field' ),
			array( 'testmatik_hero_title', 'testmatik_home', __( 'Başlık (vurgulamak için kelimeyi *yıldız* içine alın)', 'testmatik' ), 'text', 'Ücretsiz *online donanım testi*: klavye, ekran, ses ve kamera', 'sanitize_text_field' ),
			array( 'testmatik_hero_text', 'testmatik_home', __( 'Giriş metni', 'testmatik' ), 'textarea', 'Klavye, ekran, mikrofon, kamera, mouse ve hoparlör testlerini tarayıcınızda ücretsiz yapın. Kurulum yok, hesap yok; tüm testler cihazınızda çalışır.', 'sanitize_textarea_field' ),
			array( 'testmatik_home_title', 'testmatik_home', __( 'Ana sayfa SEO başlığı (boş: içerik paketinden)', 'testmatik' ), 'text', '', 'sanitize_text_field' ),
			array( 'testmatik_home_desc', 'testmatik_home', __( 'Ana sayfa meta açıklaması (boş: içerik paketinden)', 'testmatik' ), 'textarea', '', 'sanitize_textarea_field' ),
			array( 'testmatik_share_image', 'testmatik_home', __( 'Varsayılan paylaşım görseli URL (1200×630)', 'testmatik' ), 'url', '', 'esc_url_raw' ),
			array( 'testmatik_email', 'testmatik_footer', __( 'Herkese açık e-posta', 'testmatik' ), 'email', '', 'sanitize_email' ),
			array( 'testmatik_footer_text', 'testmatik_footer', __( 'Alt bilgi açıklaması', 'testmatik' ), 'textarea', 'Tarayıcıda çalışan ücretsiz donanım testleri. Ses, görüntü ve tuş vuruşlarınız cihazınızdan çıkmaz.', 'sanitize_textarea_field' ),
			array( 'testmatik_ga4', 'testmatik_tracking', __( 'Google Analytics 4 ölçüm kimliği (G-XXXX)', 'testmatik' ), 'text', '', 'sanitize_text_field' ),
			array( 'testmatik_consent_on', 'testmatik_tracking', __( 'Çerez onay bandını göster', 'testmatik' ), 'checkbox', false, 'wp_validate_boolean' ),
			array( 'testmatik_ads_on', 'testmatik_tracking', __( 'Reklam alanlarını aç (AdSense onayı sonrası)', 'testmatik' ), 'checkbox', false, 'wp_validate_boolean' ),
			array( 'testmatik_adsense_pub', 'testmatik_tracking', __( 'AdSense yayıncı kimliği (ca-pub-…)', 'testmatik' ), 'text', '', 'sanitize_text_field' ),
			array( 'testmatik_ad_below_tool', 'testmatik_tracking', __( 'Reklam alanı: aracın altı (slot ID)', 'testmatik' ), 'text', '', 'sanitize_text_field' ),
			array( 'testmatik_ad_in_article', 'testmatik_tracking', __( 'Reklam alanı: makale içi (slot ID)', 'testmatik' ), 'text', '', 'sanitize_text_field' ),
			array( 'testmatik_ad_sidebar', 'testmatik_tracking', __( 'Reklam alanı: kenar çubuğu (slot ID)', 'testmatik' ), 'text', '', 'sanitize_text_field' ),
		);
		foreach ( $fields as $f ) {
			$wp->add_setting( $f[0], array( 'default' => $f[4], 'sanitize_callback' => $f[5] ) );
			$wp->add_control( $f[0], array( 'label' => $f[2], 'section' => $f[1], 'type' => $f[3] ) );
		}
	}
);

/**
 * Hero title with *accent* markup turned into a styled span.
 *
 * @return string Safe HTML.
 */
function testmatik_hero_title_html() {
	$raw = (string) get_theme_mod( 'testmatik_hero_title', 'Ücretsiz *online donanım testi*: klavye, ekran, ses ve kamera' );
	return preg_replace( '/\*(.+?)\*/u', '<span class="accent">$1</span>', esc_html( $raw ) );
}

/**
 * Is analytics/ad tracking configured (and so consent needed)?
 *
 * @return bool
 */
function testmatik_needs_consent() {
	return (bool) get_theme_mod( 'testmatik_consent_on', false ) || '' !== trim( (string) get_theme_mod( 'testmatik_ga4', '' ) ) || ( get_theme_mod( 'testmatik_ads_on', false ) && get_theme_mod( 'testmatik_adsense_pub', '' ) );
}

// Google Consent Mode v2 defaults, GA4 and AdSense loaders (only when configured).
add_action(
	'wp_head',
	function () {
		$ga  = trim( (string) get_theme_mod( 'testmatik_ga4', '' ) );
		$pub = trim( (string) get_theme_mod( 'testmatik_adsense_pub', '' ) );
		$ads = get_theme_mod( 'testmatik_ads_on', false ) && $pub;
		// Consent defaults also guard tags added by plugins such as Site Kit; this runs before them.
		if ( ! $ga && ! $ads && ! testmatik_needs_consent() ) {
			return;
		}
		?>
<script>
window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}
gtag('consent','default',{ad_storage:'denied',ad_user_data:'denied',ad_personalization:'denied',analytics_storage:'denied',wait_for_update:500});
try{var c=JSON.parse(localStorage.getItem('tm-consent')||'null');if(c){gtag('consent','update',{analytics_storage:c.analytics?'granted':'denied',ad_storage:c.marketing?'granted':'denied',ad_user_data:c.marketing?'granted':'denied',ad_personalization:c.marketing?'granted':'denied'});}}catch(e){}
</script>
		<?php
		if ( $ga ) {
			printf( '<script async src="%s"></script>' . "\n", esc_url( 'https://www.googletagmanager.com/gtag/js?id=' . rawurlencode( $ga ) ) );
			printf( "<script>gtag('js',new Date());gtag('config',%s,{anonymize_ip:true});</script>\n", wp_json_encode( $ga ) );
		}
		if ( $ads ) {
			printf( '<script async src="%s" crossorigin="anonymous"></script>' . "\n", esc_url( 'https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=' . rawurlencode( $pub ) ) );
		}
	},
	3
);
