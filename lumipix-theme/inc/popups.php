<?php
/**
 * Cookie consent banner and the "Need a website?" lead popup.
 *
 * Consent is stored in a first-party cookie (lumipix_consent) for 180 days,
 * forwarded to Google Consent Mode v2, and exposed to other scripts:
 * - window.lumipixConsent  → { analytics: bool, marketing: bool } or null
 * - document event "lumipix:consent" fired whenever a choice is saved
 * - <script type="text/plain" data-lumipix-consent="analytics|marketing">
 *   blocks are activated once that category is allowed.
 *
 * The lead popup appears after a set time on the site (counted across
 * pages, only while the tab is visible) and at most once every 24 hours.
 *
 * @package Lumipix
 */

defined( 'ABSPATH' ) || exit;

/**
 * Customizer settings for both popups.
 *
 * @param WP_Customize_Manager $wp_customize Customizer.
 */
function lumipix_popups_customize( $wp_customize ) {
	$wp_customize->add_section(
		'lumipix_popups',
		array(
			'title'       => __( 'Cookie banner & lead popup', 'lumipix' ),
			'panel'       => 'lumipix',
			'description' => __( 'The lead popup is shown once every 24 hours per visitor, after the time below (counted across pages while the tab is open).', 'lumipix' ),
		)
	);
	$fields = array(
		'lumipix_cookie_enabled' => array( true, 'wp_validate_boolean', 'checkbox', __( 'Show the cookie banner', 'lumipix' ) ),
		'lumipix_lead_enabled'   => array( true, 'wp_validate_boolean', 'checkbox', __( 'Show the lead popup', 'lumipix' ) ),
		'lumipix_lead_delay'     => array( 90, 'absint', 'number', __( 'Lead popup delay (seconds)', 'lumipix' ) ),
		'lumipix_lead_url'       => array( 'https://vyntic.studio/', 'esc_url_raw', 'url', __( 'Lead popup link', 'lumipix' ) ),
		'lumipix_lead_title'     => array( lumipix_lead_default( 'title' ), 'sanitize_text_field', 'text', __( 'Lead popup heading', 'lumipix' ) ),
		'lumipix_lead_text'      => array( lumipix_lead_default( 'text' ), 'sanitize_textarea_field', 'textarea', __( 'Lead popup text', 'lumipix' ) ),
		'lumipix_lead_button'    => array( lumipix_lead_default( 'button' ), 'sanitize_text_field', 'text', __( 'Lead popup button', 'lumipix' ) ),
	);
	foreach ( $fields as $id => $f ) {
		$wp_customize->add_setting( $id, array( 'default' => $f[0], 'sanitize_callback' => $f[1] ) );
		$wp_customize->add_control( $id, array( 'label' => $f[3], 'section' => 'lumipix_popups', 'type' => $f[2] ) );
	}
}
add_action( 'customize_register', 'lumipix_popups_customize', 20 );

/**
 * Default lead popup copy.
 *
 * @param string $key title | text | button.
 * @return string
 */
function lumipix_lead_default( $key ) {
	$copy = array(
		'title'  => __( 'Want a website this fast?', 'lumipix' ),
		'text'   => __( 'Vyntic Studio designs and builds fast, modern, SEO-ready websites for businesses and creators – from the first idea to launch day.', 'lumipix' ),
		'button' => __( 'Get a free quote', 'lumipix' ),
	);
	return $copy[ $key ];
}

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
	if ( ! get_theme_mod( 'lumipix_cookie_enabled', true ) && ! get_theme_mod( 'lumipix_lead_enabled', true ) ) {
		return;
	}
	wp_enqueue_script( 'lumipix-popups', LUMIPIX_URI . '/assets/js/popups.js', array(), lumipix_asset_ver( 'assets/js/popups.js' ), array( 'strategy' => 'defer', 'in_footer' => true ) );
}
add_action( 'wp_enqueue_scripts', 'lumipix_popups_enqueue' );

/**
 * Lead popup link with campaign parameters.
 *
 * @return string
 */
function lumipix_lead_url() {
	$url = (string) get_theme_mod( 'lumipix_lead_url', 'https://vyntic.studio/' );
	if ( false !== strpos( $url, 'vyntic.studio' ) && false === strpos( $url, 'utm_' ) ) {
		$url = add_query_arg(
			array(
				'utm_source'   => 'lumipix',
				'utm_medium'   => 'popup',
				'utm_campaign' => 'website_lead',
			),
			$url
		);
	}
	return $url;
}

/**
 * Popup markup (hidden until the script decides to show it).
 */
function lumipix_popups_markup() {
	if ( get_theme_mod( 'lumipix_cookie_enabled', true ) ) {
		$policy = lumipix_installer_page_id( 'cookies' );
		?>
		<section class="consent" data-consent hidden role="dialog" aria-modal="false" aria-labelledby="consent-title" aria-describedby="consent-text">
			<div class="consent__glow" aria-hidden="true"></div>
			<div class="consent__head">
				<span class="consent__icon" aria-hidden="true">
					<svg viewBox="0 0 48 48" width="30" height="30"><defs><linearGradient id="ck" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#ffcf7a"/><stop offset="1" stop-color="#f29a3f"/></linearGradient></defs><path d="M24 4a20 20 0 1 0 20 20 7 7 0 0 1-8-7 7 7 0 0 1-7-7 6 6 0 0 1-5-6Z" fill="url(#ck)"/><circle cx="17" cy="20" r="2.6" fill="#7a4317"/><circle cx="27" cy="30" r="3" fill="#7a4317"/><circle cx="16" cy="31" r="2" fill="#7a4317"/><circle cx="33" cy="22" r="1.8" fill="#7a4317"/></svg>
				</span>
				<div>
					<h2 class="consent__title" id="consent-title"><?php esc_html_e( 'A few cookies, if that is okay?', 'lumipix' ); ?></h2>
					<p class="consent__text" id="consent-text">
						<?php esc_html_e( 'Your images never leave your device. We use a few cookies to keep the site running and, with your okay, to see which tools help people most.', 'lumipix' ); ?>
						<?php if ( $policy ) : ?>
							<a href="<?php echo esc_url( get_permalink( $policy ) ); ?>"><?php esc_html_e( 'Cookie policy', 'lumipix' ); ?></a>
						<?php endif; ?>
					</p>
				</div>
			</div>
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
			<div class="consent__actions">
				<button type="button" class="consent__btn consent__btn--primary" data-consent-accept><?php esc_html_e( 'Accept all', 'lumipix' ); ?></button>
				<button type="button" class="consent__btn" data-consent-essential><?php esc_html_e( 'Essential only', 'lumipix' ); ?></button>
				<button type="button" class="consent__btn" data-consent-customise><?php esc_html_e( 'Customise', 'lumipix' ); ?></button>
				<button type="button" class="consent__btn" data-consent-save hidden><?php esc_html_e( 'Save choices', 'lumipix' ); ?></button>
			</div>
		</section>
		<?php
	}

	if ( get_theme_mod( 'lumipix_lead_enabled', true ) && ! is_404() ) {
		$title = (string) get_theme_mod( 'lumipix_lead_title', lumipix_lead_default( 'title' ) );
		$text  = (string) get_theme_mod( 'lumipix_lead_text', lumipix_lead_default( 'text' ) );
		$label = (string) get_theme_mod( 'lumipix_lead_button', lumipix_lead_default( 'button' ) );
		?>
		<div class="lead" data-lead data-lead-delay="<?php echo esc_attr( max( 10, (int) get_theme_mod( 'lumipix_lead_delay', 90 ) ) ); ?>" hidden>
			<div class="lead__backdrop" data-lead-close></div>
			<div class="lead__dialog" role="dialog" aria-modal="true" aria-labelledby="lead-title" tabindex="-1">
				<button type="button" class="lead__close" data-lead-close aria-label="<?php esc_attr_e( 'Close', 'lumipix' ); ?>"><svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true"><path d="M6 6l12 12M18 6 6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></button>
				<div class="lead__visual" aria-hidden="true">
					<span class="lead__orb lead__orb--a"></span><span class="lead__orb lead__orb--b"></span>
					<div class="lead__browser">
						<div class="lead__bar"><i></i><i></i><i></i><span>yourbrand.com</span></div>
						<div class="lead__page">
							<div class="lead__nav"><b></b><em></em><em></em><em></em></div>
							<div class="lead__hero-line lead__hero-line--1"></div>
							<div class="lead__hero-line lead__hero-line--2"></div>
							<div class="lead__cta"></div>
							<div class="lead__cards"><span></span><span></span><span></span></div>
						</div>
					</div>
					<div class="lead__chip lead__chip--speed"><svg viewBox="0 0 36 36" width="34" height="34"><circle cx="18" cy="18" r="15" fill="none" stroke="rgba(255,255,255,.18)" stroke-width="4"/><circle class="lead__ring" cx="18" cy="18" r="15" fill="none" stroke="#3ddc97" stroke-width="4" stroke-linecap="round" stroke-dasharray="94.2" stroke-dashoffset="94.2" transform="rotate(-90 18 18)"/></svg><span><b data-lead-score>0</b><small><?php esc_html_e( 'Speed', 'lumipix' ); ?></small></span></div>
					<div class="lead__chip lead__chip--seo"><svg viewBox="0 0 24 24" width="16" height="16"><path d="M4 16l5-5 4 4 7-7" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg><?php esc_html_e( 'SEO-ready', 'lumipix' ); ?></div>
					<div class="lead__chip lead__chip--mobile"><svg viewBox="0 0 24 24" width="16" height="16"><rect x="7" y="3" width="10" height="18" rx="2.5" fill="none" stroke="currentColor" stroke-width="2"/></svg><?php esc_html_e( 'Mobile-first', 'lumipix' ); ?></div>
				</div>
				<div class="lead__body">
					<p class="lead__eyebrow"><span></span><?php esc_html_e( 'Need a website?', 'lumipix' ); ?></p>
					<h2 class="lead__title" id="lead-title"><?php echo esc_html( $title ); ?></h2>
					<p class="lead__text"><?php echo esc_html( $text ); ?></p>
					<ul class="lead__points">
						<li><?php esc_html_e( 'Custom design', 'lumipix' ); ?></li>
						<li><?php esc_html_e( 'Fast & SEO-ready', 'lumipix' ); ?></li>
						<li><?php esc_html_e( 'Built to convert', 'lumipix' ); ?></li>
					</ul>
					<a class="lead__cta-btn" href="<?php echo esc_url( lumipix_lead_url() ); ?>" target="_blank" rel="noopener" data-lead-go><?php echo esc_html( $label ); ?> <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true"><path d="M7 17 17 7M9 7h8v8" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
					<button type="button" class="lead__later" data-lead-close><?php esc_html_e( 'Maybe later', 'lumipix' ); ?></button>
					<p class="lead__by"><?php esc_html_e( 'A message from Vyntic Studio, the team behind Lumi Pix.', 'lumipix' ); ?></p>
				</div>
			</div>
		</div>
		<?php
	}
}
add_action( 'wp_footer', 'lumipix_popups_markup', 5 );
