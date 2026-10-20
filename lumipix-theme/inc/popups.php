<?php
/**
 * Cookie consent banner.
 *
 * Consent is stored in a first-party cookie (lumipix_consent) for 180 days,
 * forwarded to Google Consent Mode v2, and exposed to other scripts:
 * - window.lumipixConsent  → { analytics: bool, marketing: bool } or null
 * - document event "lumipix:consent" fired whenever a choice is saved
 * - <script type="text/plain" data-lumipix-consent="analytics|marketing">
 *   blocks are activated once that category is allowed.
 *
 * @package Lumipix
 */

defined( 'ABSPATH' ) || exit;

/**
 * Customizer setting for the cookie banner.
 *
 * @param WP_Customize_Manager $wp_customize Customizer.
 */
function lumipix_popups_customize( $wp_customize ) {
	$wp_customize->add_section(
		'lumipix_popups',
		array(
			'title' => __( 'Cookie banner', 'lumipix' ),
			'panel' => 'lumipix',
		)
	);
	$wp_customize->add_setting( 'lumipix_cookie_enabled', array( 'default' => true, 'sanitize_callback' => 'wp_validate_boolean' ) );
	$wp_customize->add_control( 'lumipix_cookie_enabled', array( 'label' => __( 'Show the cookie banner', 'lumipix' ), 'section' => 'lumipix_popups', 'type' => 'checkbox' ) );
}
add_action( 'customize_register', 'lumipix_popups_customize', 20 );

/**
 * Google Consent Mode v2 defaults, printed before any tag can load.
 */
function lumipix_consent_mode_defaults() {
	if ( ! get_theme_mod( 'lumipix_cookie_enabled', true ) ) {
		return;
	}
	?>
<script>
window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}
(function(){var c=null;try{var m=document.cookie.match(/(?:^|; )lumipix_consent=([^;]*)/);if(m){c=JSON.parse(decodeURIComponent(m[1]));}}catch(e){}
var a=c&&c.a?'granted':'denied',k=c&&c.m?'granted':'denied';
gtag('consent','default',{analytics_storage:a,ad_storage:k,ad_user_data:k,ad_personalization:k,functionality_storage:'granted',security_storage:'granted',wait_for_update:500});
window.lumipixConsent=c?{analytics:!!c.a,marketing:!!c.m}:null;})();
</script>
	<?php
}
add_action( 'wp_head', 'lumipix_consent_mode_defaults', 1 );

/**
 * Popup script.
 */
function lumipix_popups_enqueue() {
	if ( ! get_theme_mod( 'lumipix_cookie_enabled', true ) ) {
		return;
	}
	wp_enqueue_script( 'lumipix-popups', LUMIPIX_URI . '/assets/js/popups.js', array(), lumipix_asset_ver( 'assets/js/popups.js' ), array( 'strategy' => 'defer', 'in_footer' => true ) );
}
add_action( 'wp_enqueue_scripts', 'lumipix_popups_enqueue' );

/**
 * Cookie banner markup (hidden until the script decides to show it).
 */
function lumipix_popups_markup() {
	if ( get_theme_mod( 'lumipix_cookie_enabled', true ) ) {
		$policy = (int) apply_filters( 'lumipix_cookie_policy_id', lumipix_installer_page_id( 'cookies' ) );
		?>
		<section class="consent" data-consent hidden role="dialog" aria-modal="false" aria-labelledby="consent-title" aria-describedby="consent-text">
			<h2 class="consent__title" id="consent-title"><?php esc_html_e( 'Cookie settings', 'lumipix' ); ?></h2>
			<div class="consent__prefs" data-consent-prefs hidden>
				<div class="consent__row">
					<div><strong><?php esc_html_e( 'Essential', 'lumipix' ); ?></strong><span><?php esc_html_e( 'Keep the site, tools and your choices working.', 'lumipix' ); ?></span></div>
					<span class="consent__always"><?php esc_html_e( 'Always on', 'lumipix' ); ?></span>
				</div>
				<label class="consent__row">
					<div><strong><?php esc_html_e( 'Analytics', 'lumipix' ); ?></strong><span><?php esc_html_e( 'Anonymous stats that show which pages help people most.', 'lumipix' ); ?></span></div>
					<input type="checkbox" class="switch" data-consent-cat="analytics">
				</label>
				<label class="consent__row">
					<div><strong><?php esc_html_e( 'Marketing', 'lumipix' ); ?></strong><span><?php esc_html_e( 'Personalised ads that keep the tools free.', 'lumipix' ); ?></span></div>
					<input type="checkbox" class="switch" data-consent-cat="marketing">
				</label>
			</div>
			<div class="consent__bar">
				<span class="consent__icon" aria-hidden="true">
					<svg viewBox="0 0 48 48" width="22" height="22"><defs><linearGradient id="ck" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#ffcf7a"/><stop offset="1" stop-color="#f29a3f"/></linearGradient></defs><path d="M24 4a20 20 0 1 0 20 20 7 7 0 0 1-8-7 7 7 0 0 1-7-7 6 6 0 0 1-5-6Z" fill="url(#ck)"/><circle cx="17" cy="20" r="2.6" fill="#7a4317"/><circle cx="27" cy="30" r="3" fill="#7a4317"/><circle cx="16" cy="31" r="2" fill="#7a4317"/><circle cx="33" cy="22" r="1.8" fill="#7a4317"/></svg>
				</span>
				<p class="consent__text" id="consent-text">
					<?php esc_html_e( 'We use cookies for the site, stats and ads. Your images never leave your device.', 'lumipix' ); ?>
					<?php if ( $policy ) : ?>
						<a href="<?php echo esc_url( get_permalink( $policy ) ); ?>"><?php esc_html_e( 'Cookie policy', 'lumipix' ); ?></a>
					<?php endif; ?>
				</p>
				<div class="consent__actions">
					<button type="button" class="consent__btn consent__btn--primary" data-consent-accept><?php esc_html_e( 'Accept all', 'lumipix' ); ?></button>
					<button type="button" class="consent__btn" data-consent-essential><?php esc_html_e( 'Reject', 'lumipix' ); ?></button>
					<button type="button" class="consent__btn" data-consent-customise><?php esc_html_e( 'Customise', 'lumipix' ); ?></button>
					<button type="button" class="consent__btn" data-consent-save hidden><?php esc_html_e( 'Save choices', 'lumipix' ); ?></button>
				</div>
			</div>
		</section>
		<?php
	}
}
add_action( 'wp_footer', 'lumipix_popups_markup', 5 );
