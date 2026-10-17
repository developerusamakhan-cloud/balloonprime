<?php
/**
 * Content pack loader, link tokens, FAQs, CTA cards and table of contents.
 *
 * @package Testmatik
 */

defined( 'ABSPATH' ) || exit;

/**
 * Load one content pack file.
 *
 * @param string $type tools|posts|pages.
 * @param string $slug File slug.
 * @return array|null
 */
function testmatik_pack( $type, $slug ) {
	$file = TESTMATIK_DIR . '/content/' . $type . '/' . sanitize_file_name( $slug ) . '.php';
	if ( ! file_exists( $file ) ) {
		return null;
	}
	$data = include $file;
	if ( ! is_array( $data ) || empty( $data['html'] ) ) {
		return null;
	}
	$data['slug'] = $slug;
	return $data;
}

/**
 * Slugs available in a content pack folder.
 *
 * @param string $type tools|posts|pages.
 * @return string[]
 */
function testmatik_pack_slugs( $type ) {
	$files = glob( TESTMATIK_DIR . '/content/' . $type . '/*.php' );
	$slugs = array();
	foreach ( (array) $files as $file ) {
		$slugs[] = basename( $file, '.php' );
	}
	return $slugs;
}

/**
 * Replace {tool:x}, {post:x}, {page:x} and {home} tokens with URLs.
 *
 * Links to items that do not exist (yet) become plain text so crawlers never hit a 404.
 *
 * @param string $html HTML.
 * @return string
 */
function testmatik_resolve_links( $html ) {
	if ( false === strpos( $html, '{' ) ) {
		return $html;
	}
	// Whole anchors first, so a missing target can be unwrapped.
	$html = preg_replace_callback(
		'#<a\s+href="\{(tool|post|page):([a-z0-9\-]+)\}"([^>]*)>(.*?)</a>#su',
		function ( $m ) {
			$url = testmatik_token_url( $m[1], $m[2] );
			return $url ? '<a href="' . esc_url( $url ) . '"' . $m[3] . '>' . $m[4] . '</a>' : $m[4];
		},
		$html
	);
	$html = str_replace( '{home}', esc_url( home_url( '/' ) ), $html );
	return $html;
}

/**
 * URL for a link token.
 *
 * @param string $type tool|post|page.
 * @param string $slug Slug or tool key.
 * @return string
 */
function testmatik_token_url( $type, $slug ) {
	if ( 'tool' === $type ) {
		return testmatik_tool_url( $slug );
	}
	$post = get_page_by_path( $slug, OBJECT, 'post' === $type ? 'post' : 'page' );
	if ( $post && 'publish' === $post->post_status ) {
		return get_permalink( $post );
	}
	return '';
}

/**
 * FAQs stored for a post: array of array( q, a ).
 *
 * @param int $post_id Post ID.
 * @return array
 */
function testmatik_get_faqs( $post_id ) {
	$faqs = get_post_meta( $post_id, '_testmatik_faqs', true );
	if ( ! is_array( $faqs ) ) {
		return array();
	}
	return array_values(
		array_filter(
			$faqs,
			function ( $f ) {
				return is_array( $f ) && ! empty( $f['q'] ) && ! empty( $f['a'] );
			}
		)
	);
}

/**
 * Print an FAQ accordion.
 *
 * @param array  $faqs  FAQs.
 * @param string $title Heading.
 * @param string $id    Section id.
 */
function testmatik_render_faqs( $faqs, $title = '', $id = 'sss' ) {
	if ( ! $faqs ) {
		return;
	}
	$title = $title ? $title : __( 'Sık sorulan sorular', 'testmatik' );
	?>
	<section class="faq" id="<?php echo esc_attr( $id ); ?>" aria-labelledby="<?php echo esc_attr( $id ); ?>-title">
		<h2 class="faq__title" id="<?php echo esc_attr( $id ); ?>-title"><?php echo esc_html( $title ); ?></h2>
		<div class="faq__list">
			<?php foreach ( $faqs as $i => $f ) : ?>
				<details class="faq__item"<?php echo 0 === $i ? ' open' : ''; ?>>
					<summary><span><?php echo esc_html( $f['q'] ); ?></span><?php echo testmatik_icon( 'chevron', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></summary>
					<div class="faq__answer"><p><?php echo esc_html( $f['a'] ); ?></p></div>
				</details>
			<?php endforeach; ?>
		</div>
	</section>
	<?php
}

/**
 * CTA card linking to a tool.
 *
 * @param string $key Tool key.
 * @return string
 */
function testmatik_cta_card( $key ) {
	$tool = testmatik_get_tool( $key );
	$url  = testmatik_tool_url( $key );
	if ( ! $tool || ! $url ) {
		return '';
	}
	return sprintf(
		'<aside class="cta-card tone-%1$s"><span class="cta-card__icon">%2$s</span><span class="cta-card__body"><strong>%3$s</strong><span>%4$s</span></span><a class="btn btn--primary" href="%5$s">%6$s %7$s</a></aside>',
		esc_attr( $tool['tone'] ),
		testmatik_icon( $tool['icon'], 24 ),
		esc_html( sprintf( /* translators: %s tool name */ __( 'Ücretsiz %s', 'testmatik' ), $tool['name'] ) ),
		esc_html( $tool['blurb'] ),
		esc_url( $url ),
		esc_html__( 'Testi başlat', 'testmatik' ),
		testmatik_icon( 'arrow', 16 )
	);
}

// Content filters: tokens, CTA placeholders, responsive tables.
add_filter(
	'the_content',
	function ( $html ) {
		$html = testmatik_resolve_links( $html );
		$html = preg_replace_callback(
			'#<div class="tm-cta" data-tool="([a-z0-9\-]+)">\s*</div>#',
			function ( $m ) {
				return testmatik_cta_card( $m[1] );
			},
			$html
		);
		$html = preg_replace( '#<table(\s[^>]*)?>#', '<div class="table-wrap"><table$1>', $html );
		$html = str_replace( '</table>', '</table></div>', $html );
		return $html;
	},
	20
);

// Shortcodes: [testmatik_cta tool="klavye-testi"] and [testmatik_tool key="klavye-testi"].
add_shortcode(
	'testmatik_cta',
	function ( $atts ) {
		$atts = shortcode_atts( array( 'tool' => '' ), $atts );
		return testmatik_cta_card( sanitize_key( $atts['tool'] ) );
	}
);

/**
 * Add ids to <h2> headings and return the table of contents.
 *
 * @param string $html HTML.
 * @return array array( html, toc ) where toc is id => label.
 */
function testmatik_heading_anchors( $html ) {
	$toc  = array();
	$used = array();
	$html = preg_replace_callback(
		'#<h2([^>]*)>(.*?)</h2>#su',
		function ( $m ) use ( &$toc, &$used ) {
			$label = trim( wp_strip_all_tags( $m[2] ) );
			if ( preg_match( '/id="([^"]+)"/', $m[1], $idm ) ) {
				$id = $idm[1];
			} else {
				$id = sanitize_title( remove_accents( testmatik_tr_ascii( $label ) ) );
				$id = $id ? $id : 'bolum';
				$base = $id;
				$n    = 2;
				while ( isset( $used[ $id ] ) ) {
					$id = $base . '-' . $n++;
				}
				$m[1] .= ' id="' . esc_attr( $id ) . '"';
			}
			$used[ $id ] = true;
			$toc[ $id ]  = $label;
			return '<h2' . $m[1] . '>' . $m[2] . '</h2>';
		},
		$html
	);
	return array( $html, $toc );
}

/**
 * Turkish letters to ASCII for anchors and slugs.
 *
 * @param string $text Text.
 * @return string
 */
function testmatik_tr_ascii( $text ) {
	return strtr(
		$text,
		array(
			'ç' => 'c', 'Ç' => 'c', 'ğ' => 'g', 'Ğ' => 'g', 'ı' => 'i', 'İ' => 'i',
			'ö' => 'o', 'Ö' => 'o', 'ş' => 's', 'Ş' => 's', 'ü' => 'u', 'Ü' => 'u',
		)
	);
}

/**
 * Print the table of contents.
 *
 * @param array $toc id => label.
 */
function testmatik_render_toc( $toc ) {
	if ( count( $toc ) < 3 ) {
		return;
	}
	?>
	<nav class="toc" aria-label="<?php esc_attr_e( 'Bu sayfada', 'testmatik' ); ?>" data-toc>
		<p class="toc__title"><?php echo testmatik_icon( 'list', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Bu sayfada', 'testmatik' ); ?></p>
		<ol>
			<?php foreach ( $toc as $id => $label ) : ?>
				<li><a href="#<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $label ); ?></a></li>
			<?php endforeach; ?>
		</ol>
	</nav>
	<?php
}

/**
 * Reading time in minutes.
 *
 * @param int $post_id Post ID.
 * @return int
 */
function testmatik_reading_time( $post_id ) {
	$words = count( preg_split( '/\s+/u', trim( wp_strip_all_tags( (string) get_post_field( 'post_content', $post_id ) ) ) ) );
	return max( 1, (int) round( $words / 200 ) );
}

/**
 * Articles linked to a tool (meta _testmatik_tool), newest first.
 *
 * @param string $key   Tool key.
 * @param int    $count How many.
 * @param int    $exclude Post ID to exclude.
 * @return WP_Post[]
 */
function testmatik_tool_posts( $key, $count = 3, $exclude = 0 ) {
	return get_posts(
		array(
			'post_type'      => 'post',
			'posts_per_page' => $count,
			'meta_key'       => '_testmatik_tool', // phpcs:ignore WordPress.DB.SlowDBQuery
			'meta_value'     => $key, // phpcs:ignore WordPress.DB.SlowDBQuery
			'post__not_in'   => $exclude ? array( $exclude ) : array(),
			'no_found_rows'  => true,
		)
	);
}
