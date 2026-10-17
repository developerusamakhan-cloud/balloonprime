<?php
/**
 * Template helpers: logo, navigation, breadcrumbs, cards, ad slots.
 *
 * @package Testmatik
 */

defined( 'ABSPATH' ) || exit;

/**
 * Logo mark SVG (a keycap with a check mark).
 *
 * @param int $size Size in px.
 * @return string
 */
function testmatik_logo_mark( $size = 32 ) {
	return sprintf(
		'<svg class="logo-mark" width="%1$d" height="%1$d" viewBox="0 0 32 32" aria-hidden="true" focusable="false"><defs><linearGradient id="tmg" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#22c55e"/><stop offset="1" stop-color="#0ea5e9"/></linearGradient></defs><rect x="2" y="2" width="28" height="28" rx="8" fill="url(#tmg)"/><rect x="6.5" y="5.5" width="19" height="17" rx="5" fill="#fff" fill-opacity=".22"/><path d="m10.5 15.5 3.8 3.8 7.2-8" fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		(int) $size
	);
}

/**
 * Site logo link.
 */
function testmatik_site_logo() {
	if ( has_custom_logo() ) {
		the_custom_logo();
		return;
	}
	printf(
		'<a class="logo" href="%1$s" rel="home">%2$s<span class="logo__text">Test<span>matik</span></span></a>',
		esc_url( home_url( '/' ) ),
		testmatik_logo_mark( 32 ) // phpcs:ignore WordPress.Security.EscapeOutput
	);
}

/**
 * URL of a page by path, or empty string.
 *
 * @param string $path Page path.
 * @return string
 */
function testmatik_page_url( $path ) {
	$page = get_page_by_path( $path );
	return ( $page && 'publish' === $page->post_status ) ? get_permalink( $page ) : '';
}

/**
 * Blog (Rehberler) URL.
 *
 * @return string
 */
function testmatik_blog_url() {
	$id = (int) get_option( 'page_for_posts' );
	return $id ? get_permalink( $id ) : '';
}

/**
 * Primary navigation (built from the tool registry; a "primary" menu overrides it).
 */
function testmatik_primary_nav() {
	if ( has_nav_menu( 'primary' ) ) {
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'nav__list',
				'depth'          => 2,
			)
		);
		return;
	}
	$current = is_page() ? testmatik_page_tool() : '';
	?>
	<ul class="nav__list">
		<li class="nav__item nav__item--mega">
			<button class="nav__link nav__trigger" type="button" aria-expanded="false" aria-controls="mega-tests" data-mega-trigger>
				<?php esc_html_e( 'Testler', 'testmatik' ); ?><?php echo testmatik_icon( 'chevron', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
			</button>
			<div class="mega" id="mega-tests" data-mega>
				<div class="mega__grid">
					<?php
					foreach ( testmatik_tools() as $key => $tool ) :
						$url = testmatik_tool_url( $key );
						if ( ! $url ) {
							continue;
						}
						?>
						<a class="mega__link tone-<?php echo esc_attr( $tool['tone'] ); ?><?php echo $current === $key ? ' is-current' : ''; ?>" href="<?php echo esc_url( $url ); ?>"<?php echo $current === $key ? ' aria-current="page"' : ''; ?>>
							<span class="mega__icon"><?php echo testmatik_icon( $tool['icon'], 20 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
							<span><strong><?php echo esc_html( $tool['name'] ); ?></strong><small><?php echo esc_html( $tool['blurb'] ); ?></small></span>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		</li>
		<?php
		$links = array(
			array( testmatik_blog_url(), __( 'Rehberler', 'testmatik' ) ),
			array( testmatik_page_url( 'hakkimizda' ), __( 'Hakkımızda', 'testmatik' ) ),
		);
		foreach ( $links as $l ) :
			if ( ! $l[0] ) {
				continue;
			}
			?>
			<li class="nav__item"><a class="nav__link" href="<?php echo esc_url( $l[0] ); ?>"><?php echo esc_html( $l[1] ); ?></a></li>
		<?php endforeach; ?>
	</ul>
	<?php
}

/**
 * Breadcrumb trail as an array of array( label, url ).
 *
 * @return array
 */
function testmatik_breadcrumb_items() {
	$items = array( array( __( 'Ana sayfa', 'testmatik' ), home_url( '/' ) ) );
	if ( is_singular( 'post' ) ) {
		$blog = testmatik_blog_url();
		if ( $blog ) {
			$items[] = array( get_the_title( (int) get_option( 'page_for_posts' ) ), $blog );
		}
		$cats = get_the_category();
		if ( $cats ) {
			$items[] = array( $cats[0]->name, get_category_link( $cats[0] ) );
		}
		$items[] = array( get_the_title(), '' );
	} elseif ( is_page() ) {
		if ( testmatik_page_tool() ) {
			$items[] = array( __( 'Testler', 'testmatik' ), home_url( '/#testler' ) );
		}
		foreach ( array_reverse( get_post_ancestors( get_the_ID() ) ) as $anc ) {
			$items[] = array( get_the_title( $anc ), get_permalink( $anc ) );
		}
		$items[] = array( get_the_title(), '' );
	} elseif ( is_category() ) {
		$blog = testmatik_blog_url();
		if ( $blog ) {
			$items[] = array( get_the_title( (int) get_option( 'page_for_posts' ) ), $blog );
		}
		$items[] = array( single_cat_title( '', false ), '' );
	} elseif ( is_home() ) {
		$items[] = array( get_the_title( (int) get_option( 'page_for_posts' ) ), '' );
	} elseif ( is_search() ) {
		$items[] = array( __( 'Arama', 'testmatik' ), '' );
	}
	return $items;
}

/**
 * Print breadcrumbs.
 */
function testmatik_breadcrumbs() {
	$items = testmatik_breadcrumb_items();
	if ( count( $items ) < 2 ) {
		return;
	}
	echo '<nav class="breadcrumbs" aria-label="' . esc_attr__( 'Konum', 'testmatik' ) . '"><ol>';
	$last = count( $items ) - 1;
	foreach ( $items as $i => $item ) {
		if ( $i === $last || ! $item[1] ) {
			echo '<li aria-current="page"><span>' . esc_html( $item[0] ) . '</span></li>';
		} else {
			echo '<li><a href="' . esc_url( $item[1] ) . '">' . esc_html( $item[0] ) . '</a></li>';
		}
	}
	echo '</ol></nav>';
}

/**
 * Tool card.
 *
 * @param string $key     Tool key.
 * @param string $variant card|compact.
 */
function testmatik_tool_card( $key, $variant = 'card' ) {
	$tool = testmatik_get_tool( $key );
	$url  = testmatik_tool_url( $key );
	if ( ! $tool || ! $url ) {
		return;
	}
	?>
	<a class="tool-card tool-card--<?php echo esc_attr( $variant ); ?> tone-<?php echo esc_attr( $tool['tone'] ); ?>" href="<?php echo esc_url( $url ); ?>" data-search="<?php echo esc_attr( mb_strtolower( $tool['name'] . ' ' . $tool['keywords'], 'UTF-8' ) ); ?>">
		<span class="tool-card__icon"><?php echo testmatik_icon( $tool['icon'], 'compact' === $variant ? 20 : 26 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
		<span class="tool-card__body">
			<span class="tool-card__title"><?php echo esc_html( $tool['name'] ); ?></span>
			<span class="tool-card__text"><?php echo esc_html( $tool['blurb'] ); ?></span>
			<?php if ( 'card' === $variant ) : ?>
				<span class="tool-card__tags">
					<?php foreach ( $tool['tags'] as $tag ) : ?>
						<span class="tag"><?php echo esc_html( $tag ); ?></span>
					<?php endforeach; ?>
				</span>
			<?php endif; ?>
		</span>
		<span class="tool-card__go" aria-hidden="true"><?php echo testmatik_icon( 'arrow', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
	</a>
	<?php
}

/**
 * Article card.
 *
 * @param WP_Post $p Post.
 */
function testmatik_post_card( $p ) {
	$cats = get_the_category( $p->ID );
	$key  = (string) get_post_meta( $p->ID, '_testmatik_tool', true );
	$tool = $key ? testmatik_get_tool( $key ) : null;
	$tone = $tool ? $tool['tone'] : 'indigo';
	?>
	<article class="post-card tone-<?php echo esc_attr( $tone ); ?>">
		<a class="post-card__link" href="<?php echo esc_url( get_permalink( $p ) ); ?>">
			<span class="post-card__media">
				<?php if ( has_post_thumbnail( $p ) ) : ?>
					<?php echo get_the_post_thumbnail( $p, 'testmatik-card', array( 'loading' => 'lazy', 'alt' => '' ) ); ?>
				<?php else : ?>
					<span class="post-card__art" aria-hidden="true"><?php echo testmatik_icon( $tool ? $tool['icon'] : 'book', 40 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
				<?php endif; ?>
			</span>
			<span class="post-card__body">
				<?php if ( $cats ) : ?>
					<span class="post-card__cat"><?php echo esc_html( $cats[0]->name ); ?></span>
				<?php endif; ?>
				<span class="post-card__title"><?php echo esc_html( get_the_title( $p ) ); ?></span>
				<span class="post-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt( $p ), 22 ) ); ?></span>
				<span class="post-card__meta"><?php echo testmatik_icon( 'clock', 14 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php echo esc_html( sprintf( /* translators: %d minutes */ __( '%d dk okuma', 'testmatik' ), testmatik_reading_time( $p->ID ) ) ); ?></span>
			</span>
		</a>
	</article>
	<?php
}

/**
 * Ad slot (off unless an AdSense publisher ID and the slot ID are set in the Customizer).
 *
 * @param string $slot below_tool|in_article|sidebar.
 */
function testmatik_ad_slot( $slot ) {
	$pub = trim( (string) get_theme_mod( 'testmatik_adsense_pub', '' ) );
	$id  = trim( (string) get_theme_mod( 'testmatik_ad_' . $slot, '' ) );
	if ( ! $pub || ! $id || ! get_theme_mod( 'testmatik_ads_on', false ) ) {
		return;
	}
	printf(
		'<div class="ad-slot ad-slot--%1$s"><span class="ad-slot__label">%4$s</span><ins class="adsbygoogle" style="display:block" data-ad-client="%2$s" data-ad-slot="%3$s" data-ad-format="auto" data-full-width-responsive="true"></ins><script>(adsbygoogle=window.adsbygoogle||[]).push({});</script></div>',
		esc_attr( $slot ),
		esc_attr( $pub ),
		esc_attr( $id ),
		esc_html__( 'Reklam', 'testmatik' )
	);
}

/**
 * Public contact email.
 *
 * @return string
 */
function testmatik_contact_email() {
	$email = sanitize_email( (string) get_theme_mod( 'testmatik_email', '' ) );
	if ( ! $email ) {
		$host  = wp_parse_url( home_url(), PHP_URL_HOST );
		$email = 'iletisim@' . ( $host ? preg_replace( '/^www\./', '', $host ) : 'testmatik.app' );
	}
	return $email;
}
