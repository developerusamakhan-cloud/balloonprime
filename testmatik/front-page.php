<?php
/**
 * Home page.
 *
 * @package Testmatik
 */

defined( 'ABSPATH' ) || exit;

get_header();

$home_id = (int) get_option( 'page_on_front' );
$tools   = testmatik_tools();
?>

<section class="hero">
	<div class="hero__bg" aria-hidden="true"><span class="hero__orb hero__orb--a"></span><span class="hero__orb hero__orb--b"></span><span class="hero__dots"></span></div>
	<div class="container hero__inner">
		<div class="hero__copy">
			<p class="badge"><span class="badge__pulse"></span><?php echo esc_html( get_theme_mod( 'testmatik_hero_badge', 'Ücretsiz · Kayıt yok · Hiçbir şey yüklenmez' ) ); ?></p>
			<h1 class="hero__title"><?php echo testmatik_hero_title_html(); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped in helper. ?></h1>
			<p class="hero__lead"><?php echo esc_html( get_theme_mod( 'testmatik_hero_text', 'Klavye, ekran, mikrofon, kamera, mouse ve hoparlör testlerini tarayıcınızda ücretsiz yapın. Kurulum yok, hesap yok; tüm testler cihazınızda çalışır.' ) ); ?></p>
			<form class="finder" role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>" data-finder>
				<label class="visually-hidden" for="finder-input"><?php esc_html_e( 'Test ara', 'testmatik' ); ?></label>
				<?php echo testmatik_icon( 'search', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				<input id="finder-input" type="search" name="s" autocomplete="off" placeholder="<?php esc_attr_e( 'Ne test etmek istersiniz? “klavye”, “piksel”, “mikrofon”…', 'testmatik' ); ?>" data-finder-input>
				<kbd>/</kbd>
			</form>
			<ul class="trust">
				<li><?php echo testmatik_icon( 'shield', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Veriniz cihazınızda kalır', 'testmatik' ); ?></li>
				<li><?php echo testmatik_icon( 'zap', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Anında sonuç', 'testmatik' ); ?></li>
				<li><?php echo testmatik_icon( 'gift', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( '%100 ücretsiz', 'testmatik' ); ?></li>
			</ul>
		</div>
		<div class="hero__visual" aria-hidden="true">
			<div class="keys-demo">
				<?php
				$demo = array( 'Q', 'W', 'E', 'R', 'T', 'Y', 'A', 'S', 'D', 'F', 'G', 'H', 'Ş', 'İ', 'Ğ', 'Ü', 'Ö', 'Ç' );
				foreach ( $demo as $i => $k ) {
					printf( '<span class="keys-demo__key" style="--d:%d">%s</span>', (int) $i, esc_html( $k ) );
				}
				?>
			</div>
			<div class="hero__chips">
				<span class="hero-chip tone-emerald"><?php echo testmatik_icon( 'mic', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?>-12 dB</span>
				<span class="hero-chip tone-sky"><?php echo testmatik_icon( 'camera', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?>1920×1080 · 30 FPS</span>
				<span class="hero-chip tone-amber"><?php echo testmatik_icon( 'mouse', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?>1000 Hz</span>
			</div>
		</div>
	</div>
</section>

<section class="section section--tools" id="testler" aria-labelledby="tools-title">
	<div class="container">
		<div class="section-head">
			<p class="kicker"><?php esc_html_e( 'Testler', 'testmatik' ); ?></p>
			<h2 id="tools-title" class="section-title"><?php esc_html_e( 'Ne test etmek istiyorsunuz?', 'testmatik' ); ?></h2>
			<p class="section-lead"><?php esc_html_e( 'Bir test seçin; birkaç saniye içinde cihazınızın çalışıp çalışmadığını görün.', 'testmatik' ); ?></p>
		</div>
		<div class="tool-grid" data-finder-grid>
			<?php
			foreach ( array_keys( $tools ) as $key ) {
				testmatik_tool_card( $key );
			}
			?>
		</div>
		<p class="finder-empty" data-finder-empty hidden><?php esc_html_e( 'Bu aramayla eşleşen bir test yok. “klavye”, “ekran” veya “ses” yazmayı deneyin.', 'testmatik' ); ?></p>
	</div>
</section>

<section class="section section--steps" aria-labelledby="how-title">
	<div class="container">
		<div class="section-head">
			<p class="kicker"><?php esc_html_e( 'Nasıl çalışır', 'testmatik' ); ?></p>
			<h2 id="how-title" class="section-title"><?php esc_html_e( 'Üç adımda kesin sonuç', 'testmatik' ); ?></h2>
		</div>
		<ol class="steps">
			<li class="step"><span class="step__num">1</span><h3><?php esc_html_e( 'Testi seçin', 'testmatik' ); ?></h3><p><?php esc_html_e( 'Klavye, ekran, mikrofon, kamera, mouse veya hoparlör. Program indirmeniz gerekmez.', 'testmatik' ); ?></p></li>
			<li class="step"><span class="step__num">2</span><h3><?php esc_html_e( 'İzin verin, deneyin', 'testmatik' ); ?></h3><p><?php esc_html_e( 'Mikrofon ve kamera için tarayıcınız izin ister. Tuşlara basın, konuşun, tıklayın.', 'testmatik' ); ?></p></li>
			<li class="step"><span class="step__num">3</span><h3><?php esc_html_e( 'Sonucu okuyun', 'testmatik' ); ?></h3><p><?php esc_html_e( 'Renkler, sayaçlar ve ölçümler sorunun donanımda mı yazılımda mı olduğunu gösterir.', 'testmatik' ); ?></p></li>
		</ol>
	</div>
</section>

<section class="section" aria-labelledby="why-title">
	<div class="container">
		<div class="section-head">
			<p class="kicker"><?php esc_html_e( 'Neden Testmatik', 'testmatik' ); ?></p>
			<h2 id="why-title" class="section-title"><?php esc_html_e( 'Hızlı, gizli ve tamamen ücretsiz', 'testmatik' ); ?></h2>
		</div>
		<div class="features">
			<div class="feature"><span class="feature__icon"><?php echo testmatik_icon( 'lock', 22 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><h3><?php esc_html_e( 'Gizlilik önce gelir', 'testmatik' ); ?></h3><p><?php esc_html_e( 'Sesiniz, görüntünüz ve tuş vuruşlarınız tarayıcınızda işlenir. Sunucuya hiçbir şey gönderilmez.', 'testmatik' ); ?></p></div>
			<div class="feature"><span class="feature__icon"><?php echo testmatik_icon( 'zap', 22 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><h3><?php esc_html_e( 'Kurulum yok', 'testmatik' ); ?></h3><p><?php esc_html_e( 'Windows, macOS, Linux, Android ve iPhone’da güncel bir tarayıcı yeterli. Sayfayı açın, test başlasın.', 'testmatik' ); ?></p></div>
			<div class="feature"><span class="feature__icon"><?php echo testmatik_icon( 'bulb', 22 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><h3><?php esc_html_e( 'Türkçe çözüm rehberleri', 'testmatik' ); ?></h3><p><?php esc_html_e( 'Test bir sorun gösterirse ne yapacağınızı adım adım anlatan Türkçe rehberlerle yalnız kalmazsınız.', 'testmatik' ); ?></p></div>
		</div>
	</div>
</section>

<?php
$home_raw = $home_id ? (string) get_post_field( 'post_content', $home_id ) : '';
if ( '' === trim( $home_raw ) ) {
	$pack     = testmatik_pack( 'pages', 'home' );
	$home_raw = $pack ? $pack['html'] : '';
}
if ( '' !== trim( $home_raw ) ) :
	list( $home_html, $home_toc ) = testmatik_heading_anchors( apply_filters( 'the_content', $home_raw ) ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals
	?>
<section class="section section--guide" aria-label="<?php esc_attr_e( 'Rehber', 'testmatik' ); ?>">
	<div class="container">
		<div class="layout-guide">
			<aside class="layout-guide__side"><?php testmatik_render_toc( $home_toc ); ?></aside>
			<div class="prose">
				<?php echo $home_html; // phpcs:ignore WordPress.Security.EscapeOutput -- post content. ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>

<?php
$home_faqs = $home_id ? testmatik_get_faqs( $home_id ) : array();
if ( $home_faqs ) :
	?>
<section class="section section--tight">
	<div class="container container--prose">
		<?php testmatik_render_faqs( $home_faqs ); ?>
	</div>
</section>
<?php endif; ?>

<?php
$latest = get_posts( array( 'posts_per_page' => 6, 'no_found_rows' => true ) );
if ( $latest ) :
	$blog = testmatik_blog_url();
	?>
<section class="section" aria-labelledby="guides-title">
	<div class="container">
		<div class="section-head section-head--row">
			<div>
				<p class="kicker"><?php esc_html_e( 'Rehberler', 'testmatik' ); ?></p>
				<h2 id="guides-title" class="section-title"><?php esc_html_e( 'Sorunu bulduysanız, çözümü burada', 'testmatik' ); ?></h2>
			</div>
			<?php if ( $blog ) : ?>
				<a class="btn btn--ghost" href="<?php echo esc_url( $blog ); ?>"><?php esc_html_e( 'Tüm rehberler', 'testmatik' ); ?> <?php echo testmatik_icon( 'arrow', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a>
			<?php endif; ?>
		</div>
		<div class="post-grid">
			<?php
			foreach ( $latest as $p ) {
				testmatik_post_card( $p );
			}
			?>
		</div>
	</div>
</section>
<?php endif; ?>

<section class="section">
	<div class="container">
		<div class="cta-band">
			<div>
				<h2><?php esc_html_e( 'İkinci el laptop mı alıyorsunuz?', 'testmatik' ); ?></h2>
				<p><?php esc_html_e( 'Ekranı, klavyeyi, kamerayı ve sesi satıcının yanında beş dakikada kontrol edin.', 'testmatik' ); ?></p>
			</div>
			<?php
			$check = get_page_by_path( 'ikinci-el-laptop-kontrol', OBJECT, 'post' );
			$u     = ( $check && 'publish' === $check->post_status ) ? get_permalink( $check ) : testmatik_tool_url( 'olu-piksel-testi' );
			if ( $u ) :
				?>
				<a class="btn btn--light btn--lg" href="<?php echo esc_url( $u ); ?>"><?php esc_html_e( 'Kontrol listesini aç', 'testmatik' ); ?> <?php echo testmatik_icon( 'arrow', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php
get_footer();
