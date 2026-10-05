<?php
/**
 * Template helpers.
 *
 * @package Lumipix
 */

defined( 'ABSPATH' ) || exit;

/**
 * Breadcrumb trail as an array of [label, url] (last item has no URL).
 *
 * @return array<int, array{0:string,1:string}>
 */
function lumipix_breadcrumb_items() {
	$items = array( array( __( 'Home', 'lumipix' ), home_url( '/' ) ) );

	if ( is_singular( 'post' ) ) {
		$blog = (int) get_option( 'page_for_posts' );
		if ( $blog ) {
			$items[] = array( get_the_title( $blog ), get_permalink( $blog ) );
		}
		$cats = get_the_category();
		if ( $cats && ( ! $blog || get_the_title( $blog ) !== $cats[0]->name ) ) {
			$items[] = array( $cats[0]->name, get_category_link( $cats[0] ) );
		}
		$items[] = array( get_the_title(), '' );
	} elseif ( is_page() ) {
		$id  = get_queried_object_id();
		$key = lumipix_page_tool_key( $id );
		if ( $key ) {
			$tool   = lumipix_get_tool( $key );
			$groups = lumipix_tool_groups();
			$all    = lumipix_installer_page_id( 'tools' );
			if ( $all ) {
				$items[] = array( get_the_title( $all ), get_permalink( $all ) );
			}
			if ( ! empty( $tool['parent'] ) ) {
				$parent_url = lumipix_tool_url( $tool['parent'] );
				$parent     = lumipix_get_tool( $tool['parent'] );
				if ( $parent_url && $parent ) {
					$items[] = array( $parent['nav'], $parent_url );
				}
			} elseif ( isset( $groups[ $tool['group'] ] ) && ! $all ) {
				$items[] = array( $groups[ $tool['group'] ]['label'], '' );
			}
		} else {
			foreach ( array_reverse( get_post_ancestors( $id ) ) as $ancestor ) {
				$items[] = array( get_the_title( $ancestor ), get_permalink( $ancestor ) );
			}
		}
		$items[] = array( get_the_title( $id ), '' );
	} elseif ( is_category() || is_tag() || is_tax() ) {
		$blog = (int) get_option( 'page_for_posts' );
		if ( $blog ) {
			$items[] = array( get_the_title( $blog ), get_permalink( $blog ) );
		}
		$items[] = array( single_term_title( '', false ), '' );
	} elseif ( is_home() ) {
		$items[] = array( get_the_title( (int) get_option( 'page_for_posts' ) ), '' );
	} elseif ( is_author() ) {
		$blog = (int) get_option( 'page_for_posts' );
		if ( $blog ) {
			$items[] = array( get_the_title( $blog ), get_permalink( $blog ) );
		}
		$author  = get_queried_object();
		$items[] = array( $author ? $author->display_name : '', '' );
	} elseif ( is_search() ) {
		$items[] = array( __( 'Search', 'lumipix' ), '' );
	} elseif ( is_archive() ) {
		$items[] = array( wp_strip_all_tags( get_the_archive_title() ), '' );
	}
	return $items;
}

/**
 * Render breadcrumbs.
 */
function lumipix_breadcrumbs() {
	if ( is_front_page() ) {
		return;
	}
	$items = lumipix_breadcrumb_items();
	echo '<nav class="breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumb', 'lumipix' ) . '"><ol>';
	foreach ( $items as $i => $item ) {
		echo '<li>';
		if ( $item[1] && $i < count( $items ) - 1 ) {
			echo '<a href="' . esc_url( $item[1] ) . '">' . esc_html( $item[0] ) . '</a>';
		} else {
			echo '<span aria-current="page">' . esc_html( $item[0] ) . '</span>';
		}
		echo '</li>';
	}
	echo '</ol></nav>';
}

/**
 * A tool card (used on home, hubs, related grids).
 *
 * @param string $key     Tool key.
 * @param string $variant Card variant: default | compact.
 */
function lumipix_tool_card( $key, $variant = 'default' ) {
	$tool = lumipix_get_tool( $key );
	$url  = lumipix_tool_url( $key );
	if ( ! $tool || ! $url ) {
		return;
	}
	$groups = lumipix_tool_groups();
	$group  = isset( $groups[ $tool['group'] ] ) ? $groups[ $tool['group'] ]['label'] : '';
	?>
	<a class="tool-card tool-card--<?php echo esc_attr( $variant ); ?> tone-<?php echo esc_attr( $tool['group'] ); ?>" href="<?php echo esc_url( $url ); ?>" data-tool-search="<?php echo esc_attr( strtolower( $tool['nav'] . ' ' . $tool['h1'] . ' ' . $group ) ); ?>">
		<span class="tool-card__icon"><?php echo lumipix_icon( $tool['icon'], 22 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
		<span class="tool-card__body">
			<span class="tool-card__title"><?php echo esc_html( $tool['nav'] ); ?></span>
			<?php if ( 'compact' !== $variant ) : ?>
				<span class="tool-card__desc"><?php echo esc_html( $tool['lead'] ); ?></span>
			<?php endif; ?>
		</span>
		<span class="tool-card__arrow"><?php echo lumipix_icon( 'arrow-up-right', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
	</a>
	<?php
}

/**
 * Chips linking to tool presets.
 *
 * @param array<string, array<string, mixed>> $tools   Tools.
 * @param string                              $current Current key.
 */
function lumipix_tool_chips( $tools, $current = '' ) {
	$out = '';
	foreach ( $tools as $key => $tool ) {
		$url = lumipix_tool_url( $key );
		if ( ! $url ) {
			continue;
		}
		$is = ( $key === $current );
		$out .= sprintf(
			'<a class="chip%s" href="%s"%s>%s</a>',
			$is ? ' is-active' : '',
			esc_url( $url ),
			$is ? ' aria-current="page"' : '',
			esc_html( $tool['nav'] )
		);
	}
	if ( $out ) {
		echo '<div class="chips">' . $out . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput -- built from escaped parts.
	}
}

/**
 * Post card.
 *
 * @param WP_Post|int|null $post Post.
 */
function lumipix_post_card( $post = null ) {
	$post = get_post( $post );
	if ( ! $post ) {
		return;
	}
	$cats = get_the_category( $post->ID );
	?>
	<article class="post-card">
		<a class="post-card__media" href="<?php echo esc_url( get_permalink( $post ) ); ?>" tabindex="-1" aria-hidden="true">
			<?php
			if ( has_post_thumbnail( $post ) ) {
				echo get_the_post_thumbnail( $post, 'medium_large', array( 'loading' => 'lazy', 'sizes' => '(max-width: 700px) 100vw, 400px' ) );
			} else {
				echo '<span class="post-card__placeholder">' . lumipix_icon( 'image', 28 ) . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput
			}
			?>
		</a>
		<div class="post-card__body">
			<div class="post-card__meta">
				<?php if ( $cats ) : ?>
					<span class="pill"><?php echo esc_html( $cats[0]->name ); ?></span>
				<?php endif; ?>
				<span><?php echo esc_html( lumipix_reading_time( $post ) ); ?></span>
			</div>
			<h3 class="post-card__title"><a href="<?php echo esc_url( get_permalink( $post ) ); ?>"><?php echo esc_html( get_the_title( $post ) ); ?></a></h3>
			<p class="post-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt( $post ), 22 ) ); ?></p>
		</div>
	</article>
	<?php
}

/**
 * Human reading time.
 *
 * @param WP_Post|int|null $post Post.
 * @return string
 */
function lumipix_reading_time( $post = null ) {
	$post    = get_post( $post );
	$words   = $post ? str_word_count( wp_strip_all_tags( $post->post_content ) ) : 0;
	$minutes = max( 1, (int) ceil( $words / 220 ) );
	/* translators: %d: minutes */
	return sprintf( _n( '%d min read', '%d min read', $minutes, 'lumipix' ), $minutes );
}

/**
 * Ad slot. Renders nothing unless ads are enabled in the Customizer.
 *
 * @param string $position Slot position: tool-below | article-mid | sidebar.
 */
function lumipix_ad_slot( $position ) {
	if ( ! get_theme_mod( 'lumipix_ads_enabled', false ) ) {
		return;
	}
	$client = trim( (string) get_theme_mod( 'lumipix_ads_client', '' ) );
	$slot   = trim( (string) get_theme_mod( 'lumipix_ads_slot_' . str_replace( '-', '_', $position ), '' ) );
	if ( ! $client || ! $slot ) {
		return;
	}
	static $loader = false;
	if ( ! $loader ) {
		$loader = true;
		printf(
			'<script async src="%s" crossorigin="anonymous"></script>', // phpcs:ignore WordPress.WP.EnqueuedResources
			esc_url( 'https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=' . rawurlencode( $client ) )
		);
	}
	printf(
		'<aside class="ad-slot ad-slot--%1$s" aria-label="%2$s"><span class="ad-slot__label">%3$s</span><ins class="adsbygoogle" style="display:block" data-ad-client="%4$s" data-ad-slot="%5$s" data-ad-format="auto" data-full-width-responsive="true"></ins><script>(adsbygoogle=window.adsbygoogle||[]).push({});</script></aside>',
		esc_attr( $position ),
		esc_attr__( 'Advertisement', 'lumipix' ),
		esc_html__( 'Advertisement', 'lumipix' ),
		esc_attr( $client ),
		esc_attr( $slot )
	);
}

/**
 * Primary navigation: a saved menu if assigned, otherwise a smart default built from the registry.
 */
function lumipix_primary_nav() {
	if ( has_nav_menu( 'primary' ) ) {
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'nav-list',
				'depth'          => 2,
			)
		);
		return;
	}
	$groups = lumipix_tool_groups();
	echo '<ul class="nav-list">';
	echo '<li class="has-mega"><button class="nav-trigger" type="button" aria-expanded="false" aria-controls="mega-tools">' . esc_html__( 'Tools', 'lumipix' ) . lumipix_icon( 'chevron', 16 ) . '</button>'; // phpcs:ignore WordPress.Security.EscapeOutput
	echo '<div class="mega" id="mega-tools"><div class="mega__grid">';
	foreach ( $groups as $gkey => $group ) {
		echo '<div class="mega__col"><p class="mega__label">' . esc_html( $group['label'] ) . '</p><ul>';
		foreach ( lumipix_group_tools( $gkey ) as $key => $tool ) {
			$url = lumipix_tool_url( $key );
			if ( $url ) {
				echo '<li><a href="' . esc_url( $url ) . '">' . lumipix_icon( $tool['icon'], 16 ) . '<span>' . esc_html( $tool['nav'] ) . '</span></a></li>'; // phpcs:ignore WordPress.Security.EscapeOutput
			}
		}
		echo '</ul></div>';
	}
	$all = lumipix_installer_page_id( 'tools' );
	if ( $all ) {
		echo '<a class="mega__all" href="' . esc_url( get_permalink( $all ) ) . '">' . esc_html__( 'See all tools', 'lumipix' ) . lumipix_icon( 'arrow', 16 ) . '</a>'; // phpcs:ignore WordPress.Security.EscapeOutput
	}
	echo '</div></div></li>';

	$shortcuts = array(
		'compress-image'     => __( 'Compress', 'lumipix' ),
		'image-resizer'      => __( 'Resize', 'lumipix' ),
		'background-remover' => __( 'Remove background', 'lumipix' ),
	);
	foreach ( $shortcuts as $key => $label ) {
		$url = lumipix_tool_url( $key );
		if ( $url ) {
			$current = ( is_page() && lumipix_page_tool_key( get_queried_object_id() ) === $key ) ? ' aria-current="page"' : '';
			echo '<li><a href="' . esc_url( $url ) . '"' . $current . '>' . esc_html( $label ) . '</a></li>'; // phpcs:ignore WordPress.Security.EscapeOutput
		}
	}
	$blog = (int) get_option( 'page_for_posts' );
	if ( $blog ) {
		echo '<li><a href="' . esc_url( get_permalink( $blog ) ) . '"' . ( is_home() || is_singular( 'post' ) ? ' aria-current="page"' : '' ) . '>' . esc_html__( 'Guides', 'lumipix' ) . '</a></li>';
	}
	echo '</ul>';
}

/**
 * FAQs for a post or page: tool registry for tool pages, otherwise the
 * `_lumipix_faqs` meta (falling back to the bundled home FAQs on the front page).
 *
 * @param int|null $post_id Post ID (defaults to the queried object).
 * @return array<string, string>
 */
function lumipix_get_faqs( $post_id = null ) {
	$post_id = $post_id ? $post_id : get_queried_object_id();
	if ( ! $post_id ) {
		return array();
	}
	$key = lumipix_page_tool_key( $post_id );
	if ( $key ) {
		$tool = lumipix_get_tool( $key );
		return isset( $tool['faqs'] ) ? (array) $tool['faqs'] : array();
	}
	$faqs = get_post_meta( $post_id, '_lumipix_faqs', true );
	if ( ! $faqs && (int) get_option( 'page_on_front' ) === (int) $post_id ) {
		$pack = lumipix_pack_page( 'home' );
		$faqs = $pack ? $pack['faqs'] : array();
	}
	return is_array( $faqs ) ? array_filter( $faqs ) : array();
}

/**
 * Render an FAQ accordion.
 *
 * @param array<string, string> $faqs  Question => answer.
 * @param string                $title Heading.
 * @param string                $id    Heading ID.
 */
function lumipix_render_faqs( $faqs, $title = '', $id = 'faq-title' ) {
	if ( ! $faqs ) {
		return;
	}
	$title = $title ? $title : __( 'Frequently asked questions', 'lumipix' );
	?>
	<section class="faq-block" aria-labelledby="<?php echo esc_attr( $id ); ?>">
		<h2 id="<?php echo esc_attr( $id ); ?>" class="section-title section-title--sm"><?php echo esc_html( $title ); ?></h2>
		<div class="faq">
			<?php foreach ( $faqs as $q => $a ) : ?>
				<details class="faq__item">
					<summary><?php echo esc_html( $q ); ?><span class="faq__icon" aria-hidden="true"></span></summary>
					<p><?php echo esc_html( $a ); ?></p>
				</details>
			<?php endforeach; ?>
		</div>
	</section>
	<?php
}

/**
 * Add id attributes to H2 headings and return [html, toc].
 *
 * @param string $html Rendered content.
 * @return array{0: string, 1: array<string, string>}
 */
function lumipix_heading_anchors( $html ) {
	$toc  = array();
	$html = preg_replace_callback(
		'/<h2([^>]*)>(.*?)<\/h2>/s',
		function ( $m ) use ( &$toc ) {
			if ( false !== strpos( $m[1], ' id=' ) ) {
				return $m[0];
			}
			$text = wp_strip_all_tags( $m[2] );
			$id   = sanitize_title( $text );
			$base = $id;
			$n    = 2;
			while ( isset( $toc[ $id ] ) ) {
				$id = $base . '-' . $n++;
			}
			$toc[ $id ] = $text;
			return '<h2' . $m[1] . ' id="' . esc_attr( $id ) . '">' . $m[2] . '</h2>';
		},
		$html
	);
	return array( $html, $toc );
}

/**
 * Legal page links that exist.
 *
 * @return array<int, array{0: string, 1: string}>
 */
function lumipix_legal_links() {
	$out = array();
	foreach ( array( 'privacy', 'terms', 'cookies', 'disclaimer' ) as $key ) {
		$id = lumipix_installer_page_id( $key );
		if ( $id ) {
			$out[] = array( get_the_title( $id ), get_permalink( $id ) );
		}
	}
	$sitemap = lumipix_sitemap_url();
	if ( $sitemap ) {
		$out[] = array( __( 'Sitemap', 'lumipix' ), $sitemap );
	}
	return $out;
}

/**
 * Public contact email: Customizer value, else hello@<site domain>.
 *
 * @return string
 */
function lumipix_contact_email() {
	$email = sanitize_email( (string) get_theme_mod( 'lumipix_contact_email', '' ) );
	if ( ! $email ) {
		$host = wp_parse_url( home_url(), PHP_URL_HOST );
		if ( $host && false !== strpos( $host, '.' ) && 'localhost' !== $host ) {
			$email = 'hello@' . preg_replace( '/^www\./', '', $host );
		}
	}
	return is_email( $email ) ? $email : '';
}

/**
 * XML sitemap URL: Rank Math / Yoast / SEOPress / AIOSEO, else the WordPress core sitemap.
 *
 * @return string
 */
function lumipix_sitemap_url() {
	if ( defined( 'RANK_MATH_VERSION' ) || defined( 'WPSEO_VERSION' ) || defined( 'AIOSEO_VERSION' ) ) {
		$url = home_url( '/sitemap_index.xml' );
	} elseif ( defined( 'SEOPRESS_VERSION' ) ) {
		$url = home_url( '/sitemaps.xml' );
	} elseif ( function_exists( 'wp_sitemaps_get_server' ) && wp_sitemaps_get_server()->sitemaps_enabled() ) {
		$url = get_sitemap_url( 'index' );
	} else {
		$url = '';
	}
	return (string) apply_filters( 'lumipix_sitemap_url', $url );
}
