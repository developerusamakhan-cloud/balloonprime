<?php
/**
 * Home page.
 *
 * @package Lumipix
 */

defined( 'ABSPATH' ) || exit;

get_header();

$groups   = lumipix_tool_groups();
$features = array(
	array( 'compress-image', 'compress', __( 'Compress to an exact size', 'lumipix' ), __( 'Type 20KB, 50KB or 200KB and get the sharpest file that fits. Built for forms that reject anything over the limit.', 'lumipix' ), array( '20KB', '50KB', '100KB', '200KB' ) ),
	array( 'image-resizer', 'resize', __( 'Resize for print and social', 'lumipix' ), __( 'Pixels, centimetres or inches with DPI. One-tap presets for Instagram, passports and HD.', 'lumipix' ), array( '1080×1350', '35×45 mm', '1920×1080' ) ),
	array( 'background-remover', 'background', __( 'Remove backgrounds with AI', 'lumipix' ), __( 'Full-resolution transparent PNGs, free. The model runs on your device.', 'lumipix' ), array( 'PNG', 'HD', 'No signup' ) ),
);
?>

<section class="hero">
	<div class="hero__bg" aria-hidden="true"><span class="glow glow--a"></span><span class="glow glow--b"></span><span class="grid-lines"></span></div>
	<div class="container hero__inner">
		<p class="eyebrow"><span class="eyebrow__dot"></span><?php echo esc_html( get_theme_mod( 'lumipix_hero_eyebrow', __( 'Free · No signup · 100% private', 'lumipix' ) ) ); ?></p>
		<h1 class="hero__title"><?php echo lumipix_hero_title_html(); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped in helper. ?></h1>
		<p class="hero__lead"><?php echo esc_html( get_theme_mod( 'lumipix_hero_text', __( 'Compress to an exact KB size, resize for print or Instagram, and remove backgrounds with AI that runs on your device. Fast, free, and private by design.', 'lumipix' ) ) ); ?></p>

		<form class="tool-search" role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>" data-tool-search-form>
			<label class="visually-hidden" for="hero-search"><?php esc_html_e( 'Search tools', 'lumipix' ); ?></label>
			<?php echo lumipix_icon( 'search', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
			<input id="hero-search" type="search" name="s" autocomplete="off" placeholder="<?php esc_attr_e( 'What do you need? Try “50kb”, “instagram” or “passport”', 'lumipix' ); ?>" data-tool-search-input>
			<kbd>/</kbd>
		</form>

		<ul class="trust-row">
			<li><?php echo lumipix_icon( 'shield', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Never uploaded', 'lumipix' ); ?></li>
			<li><?php echo lumipix_icon( 'zap', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Instant results', 'lumipix' ); ?></li>
			<li><?php echo lumipix_icon( 'gift', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Free HD downloads', 'lumipix' ); ?></li>
		</ul>
	</div>
</section>

<section class="section section--tight" id="tools">
	<div class="container">
		<div class="bento">
			<?php
			foreach ( $features as $i => $f ) :
				list( $key, $tone, $title, $text, $tags ) = $f;
				$url = lumipix_tool_url( $key );
				if ( ! $url ) {
					continue;
				}
				$tool = lumipix_get_tool( $key );
				?>
				<a class="bento__card bento__card--<?php echo esc_attr( $i ); ?> tone-<?php echo esc_attr( $tone ); ?>" href="<?php echo esc_url( $url ); ?>">
					<span class="bento__icon"><?php echo lumipix_icon( $tool['icon'], 22 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
					<span class="bento__title"><?php echo esc_html( $title ); ?></span>
					<span class="bento__text"><?php echo esc_html( $text ); ?></span>
					<span class="bento__tags">
						<?php foreach ( $tags as $tag ) : ?>
							<span class="tag"><?php echo esc_html( $tag ); ?></span>
						<?php endforeach; ?>
					</span>
					<?php if ( 0 === $i ) : ?>
						<span class="bento__demo" aria-hidden="true">
							<span class="demo-row">
								<span class="demo-row__thumb"></span>
								<span class="demo-row__body"><span class="demo-row__name">passport-photo.jpg</span><span class="demo-row__meta">4.2 MB <span class="demo-row__arrow">→</span> <b>49.6 KB</b> · 600×771</span></span>
								<span class="demo-row__badge"><?php echo lumipix_icon( 'check', 14 ); // phpcs:ignore WordPress.Security.EscapeOutput ?>Fits 50KB</span>
							</span>
							<span class="demo-row demo-row--2">
								<span class="demo-row__thumb"></span>
								<span class="demo-row__body"><span class="demo-row__name">signature.png</span><span class="demo-row__meta">1.1 MB <span class="demo-row__arrow">→</span> <b>18.9 KB</b> · 500×180</span></span>
								<span class="demo-row__badge"><?php echo lumipix_icon( 'check', 14 ); // phpcs:ignore WordPress.Security.EscapeOutput ?>Fits 20KB</span>
							</span>
						</span>
					<?php else : ?>
						<span class="bento__visual bento__visual--<?php echo esc_attr( $tone ); ?>" aria-hidden="true"><span></span><span></span><span></span></span>
					<?php endif; ?>
					<span class="bento__go"><?php esc_html_e( 'Open tool', 'lumipix' ); ?> <?php echo lumipix_icon( 'arrow', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section" aria-labelledby="all-tools-title">
	<div class="container">
		<div class="section-head">
			<p class="kicker"><?php esc_html_e( 'Popular tasks', 'lumipix' ); ?></p>
			<h2 id="all-tools-title" class="section-title"><?php esc_html_e( 'One click to the exact job', 'lumipix' ); ?></h2>
			<p class="section-lead"><?php esc_html_e( 'Every preset opens the tool already set up, so you just drop your image.', 'lumipix' ); ?></p>
		</div>
		<?php foreach ( $groups as $gkey => $group ) : ?>
			<div class="tool-group" data-tool-group>
				<h3 class="tool-group__title"><?php echo lumipix_icon( $group['icon'], 18 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php echo esc_html( $group['label'] ); ?></h3>
				<div class="tool-grid">
					<?php
					foreach ( array_keys( lumipix_group_tools( $gkey ) ) as $key ) {
						lumipix_tool_card( $key, 'compact' );
					}
					?>
				</div>
			</div>
		<?php endforeach; ?>
		<p class="tool-search-empty" data-tool-search-empty hidden><?php esc_html_e( 'No tool matches that yet. Try a size like “100kb” or a word like “resize”.', 'lumipix' ); ?></p>
	</div>
</section>

<?php if ( lumipix_tool_url( 'compress-image' ) ) : ?>
<section class="section section--panel" aria-labelledby="try-title">
	<div class="container">
		<div class="section-head">
			<p class="kicker"><?php esc_html_e( 'Try it here', 'lumipix' ); ?></p>
			<h2 id="try-title" class="section-title"><?php esc_html_e( 'Compress a photo without leaving this page', 'lumipix' ); ?></h2>
		</div>
		<div class="tool-shell">
			<?php echo lumipix_render_tool_app( 'compress-image' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		</div>
	</div>
</section>
<?php endif; ?>

<section class="section" aria-labelledby="why-title">
	<div class="container">
		<div class="section-head">
			<p class="kicker"><?php esc_html_e( 'Why Lumipix', 'lumipix' ); ?></p>
			<h2 id="why-title" class="section-title"><?php esc_html_e( 'Built differently, on purpose', 'lumipix' ); ?></h2>
		</div>
		<div class="features">
			<div class="feature">
				<span class="feature__icon"><?php echo lumipix_icon( 'lock', 22 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
				<h3><?php esc_html_e( 'Private by design', 'lumipix' ); ?></h3>
				<p><?php esc_html_e( 'Your photos are processed by your own browser. There is no upload, so there is nothing for anyone to store, scan or leak.', 'lumipix' ); ?></p>
			</div>
			<div class="feature">
				<span class="feature__icon"><?php echo lumipix_icon( 'zap', 22 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
				<h3><?php esc_html_e( 'Instant, even on slow internet', 'lumipix' ); ?></h3>
				<p><?php esc_html_e( 'No waiting for a 5MB photo to upload and download again. Results appear as fast as your device can draw them.', 'lumipix' ); ?></p>
			</div>
			<div class="feature">
				<span class="feature__icon"><?php echo lumipix_icon( 'gift', 22 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
				<h3><?php esc_html_e( 'Free for real', 'lumipix' ); ?></h3>
				<p><?php esc_html_e( 'No account, no watermark, no “HD costs extra”. Running on your device keeps our costs low, so the full result stays free.', 'lumipix' ); ?></p>
			</div>
		</div>
	</div>
</section>

<?php
$latest = get_posts( array( 'posts_per_page' => 3, 'no_found_rows' => true ) );
if ( $latest ) :
	$blog_id = (int) get_option( 'page_for_posts' );
	?>
<section class="section" aria-labelledby="guides-title">
	<div class="container">
		<div class="section-head section-head--row">
			<div>
				<p class="kicker"><?php esc_html_e( 'Guides', 'lumipix' ); ?></p>
				<h2 id="guides-title" class="section-title"><?php esc_html_e( 'Learn the quick way to do it', 'lumipix' ); ?></h2>
			</div>
			<?php if ( $blog_id ) : ?>
				<a class="btn btn--ghost" href="<?php echo esc_url( get_permalink( $blog_id ) ); ?>"><?php esc_html_e( 'All guides', 'lumipix' ); ?> <?php echo lumipix_icon( 'arrow', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a>
			<?php endif; ?>
		</div>
		<div class="post-grid">
			<?php
			foreach ( $latest as $p ) {
				lumipix_post_card( $p );
			}
			?>
		</div>
	</div>
</section>
<?php endif; ?>

<section class="section">
	<div class="container">
		<div class="cta-band">
			<div class="cta-band__glow" aria-hidden="true"></div>
			<h2><?php esc_html_e( 'Your next upload limit is no longer a problem.', 'lumipix' ); ?></h2>
			<p><?php esc_html_e( 'Bookmark Lumipix and get it done in seconds, every time.', 'lumipix' ); ?></p>
			<?php $u = lumipix_tool_url( 'compress-image' ); ?>
			<?php if ( $u ) : ?>
				<a class="btn btn--light btn--lg" href="<?php echo esc_url( $u ); ?>"><?php esc_html_e( 'Compress an image', 'lumipix' ); ?> <?php echo lumipix_icon( 'arrow', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php
get_footer();
