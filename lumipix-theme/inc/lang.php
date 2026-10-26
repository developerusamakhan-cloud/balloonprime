<?php
/**
 * Other-language tool pages (French and Brazilian Portuguese).
 *
 * Each language has a hub page (/fr/, /pt/) and translated landing pages for a
 * handful of tools, stored as Markdown in content/lang/<lang>/<tool>.md. The
 * pages reuse the English tool apps; the interface is translated through the
 * `lumipix` text domain on those pages only, so the English site is untouched.
 *
 * Pages are created automatically the first time the site loads after an
 * update that ships new language content (see LUMIPIX_LANG_REV).
 *
 * @package Lumipix
 */

defined( 'ABSPATH' ) || exit;

/** Bump when the bundled language pages change, so untouched pages are refreshed. */
define( 'LUMIPIX_LANG_REV', 5 );

/**
 * Languages with their own pages.
 *
 * @return array<string, array<string, string>>
 */
function lumipix_languages() {
	return array(
		'fr' => array(
			'name'     => 'Français',
			'locale'   => 'fr_FR',
			'hreflang' => 'fr',
			'html'     => 'fr-FR',
		),
		'pt' => array(
			'name'     => 'Português',
			'locale'   => 'pt_BR',
			'hreflang' => 'pt-BR',
			'html'     => 'pt-BR',
		),
	);
}

/**
 * Front matter and FAQs of a language Markdown file. Body links are not resolved
 * here, so building the registry never needs page lookups.
 *
 * @param string $path File path.
 * @return array{meta: array<string,string>, faqs: array<string,string>}
 */
function lumipix_lang_read( $path ) {
	$text = str_replace( "\r\n", "\n", (string) file_get_contents( $path ) ); // phpcs:ignore WordPress.WP.AlternativeFunctions
	$meta = array();
	if ( preg_match( '/^---\n(.*?)\n---\n/s', $text, $m ) ) {
		foreach ( explode( "\n", $m[1] ) as $line ) {
			if ( preg_match( '/^([a-z0-9_]+):\s*(.*)$/', $line, $kv ) ) {
				$meta[ $kv[1] ] = trim( $kv[2] );
			}
		}
	}
	$faqs = array();
	if ( preg_match( '/^##\s+(questions fréquentes|perguntas frequentes|faq)\s*$.*/imsu', $text, $f ) ) {
		$faqs = lumipix_md_parse( $f[0] )['faqs'];
	}
	return array(
		'meta' => $meta,
		'faqs' => $faqs,
	);
}

/**
 * Bundled language content: hubs and tools.
 *
 * @return array{hubs: array<string, array<string, mixed>>, tools: array<string, array<string, mixed>>}
 */
function lumipix_lang_pack() {
	static $pack = null;
	if ( null !== $pack ) {
		return $pack;
	}
	$pack = array(
		'hubs'  => array(),
		'tools' => array(),
		'pages' => array(),
	);
	$base = lumipix_tools();
	// Display order of the translated tools (menus, cards, chips).
	$order = array( '_hub', 'compress-image', 'image-resizer', 'image-to-pdf', 'background-remover', 'webp-to-jpg', 'png-to-jpg', 'passport-size-photo' );
	foreach ( array_keys( lumipix_languages() ) as $lang ) {
		$files = glob( LUMIPIX_DIR . '/content/lang/' . $lang . '/*.md' );
		usort(
			$files,
			function ( $a, $b ) use ( $order ) {
				$ia = array_search( basename( $a, '.md' ), $order, true );
				$ib = array_search( basename( $b, '.md' ), $order, true );
				return ( false === $ia ? 99 : $ia ) - ( false === $ib ? 99 : $ib );
			}
		);
		$keys = array();
		foreach ( $files as $file ) {
			$name = basename( $file, '.md' );
			$data = lumipix_lang_read( $file );
			$meta = $data['meta'];
			if ( '_hub' === $name ) {
				$pack['hubs'][ $lang ] = array(
					'lang'     => $lang,
					'file'     => $file,
					'slug'     => $meta['slug'] ?? $lang,
					'nav'      => $meta['nav'] ?? lumipix_languages()[ $lang ]['name'],
					'h1'       => $meta['h1'] ?? '',
					'title'    => $meta['title'] ?? '',
					'desc'     => $meta['desc'] ?? '',
					'lead'     => $meta['lead'] ?? '',
					'keywords' => $meta['keywords'] ?? '',
					'faqs'     => $data['faqs'],
				);
				continue;
			}
			if ( ! isset( $base[ $name ] ) || empty( $meta['slug'] ) ) {
				continue;
			}
			$key    = $lang . '-' . $name;
			$keys[] = $key;
			$tool   = $base[ $name ];
			// Optional tool settings for this language, e.g. config_width: 3 and config_presets: foto-3x4.
			foreach ( array( 'width', 'height', 'unit', 'sheet' ) as $opt ) {
				if ( isset( $meta[ 'config_' . $opt ] ) ) {
					$tool['config'][ $opt ] = is_numeric( $meta[ 'config_' . $opt ] ) ? (float) $meta[ 'config_' . $opt ] : $meta[ 'config_' . $opt ];
				}
			}
			if ( ! empty( $meta['config_presets'] ) ) {
				$tool['config']['presets'] = array_map( 'trim', explode( ',', $meta['config_presets'] ) );
			}

			$pack['tools'][ $key ] = array_merge(
				$tool,
				array(
					'lang'      => $lang,
					'source'    => $name,
					'file'      => $file,
					'parent'    => '',
					'slug'      => ( $pack['hubs'][ $lang ]['slug'] ?? $lang ) . '/' . $meta['slug'],
					'post_name' => $meta['slug'],
					'nav'       => $meta['nav'] ?? $tool['nav'],
					'h1'        => $meta['h1'] ?? $tool['h1'],
					'title'     => $meta['title'] ?? $tool['title'],
					'desc'      => $meta['desc'] ?? $tool['desc'],
					'lead'      => $meta['lead'] ?? $tool['lead'],
					'keywords'  => $meta['keywords'] ?? '',
					'faqs'      => $data['faqs'],
					'content'   => '',
				)
			);
		}
		// Related tools: the next three pages of the same language.
		$count = count( $keys );
		foreach ( $keys as $i => $key ) {
			$related = array();
			for ( $j = 1; $j < $count && count( $related ) < 3; $j++ ) {
				$related[] = $keys[ ( $i + $j ) % $count ];
			}
			$pack['tools'][ $key ]['related'] = $related;
		}

		// Company and legal pages (content/lang/LANG/pages/KEY.md).
		foreach ( (array) glob( LUMIPIX_DIR . '/content/lang/' . $lang . '/pages/*.md' ) as $file ) {
			$name = basename( $file, '.md' );
			$meta = lumipix_lang_read( $file )['meta'];
			if ( empty( $meta['slug'] ) || ! in_array( $name, lumipix_lang_page_keys(), true ) ) {
				continue;
			}
			$pack['pages'][ $lang ][ $name ] = array(
				'file'     => $file,
				'slug'     => $meta['slug'],
				'path'     => ( $pack['hubs'][ $lang ]['slug'] ?? $lang ) . '/' . $meta['slug'],
				'title'    => $meta['title'] ?? '',
				'seo'      => $meta['seo_title'] ?? '',
				'desc'     => $meta['desc'] ?? '',
				'keywords' => $meta['keywords'] ?? '',
			);
		}
	}
	return $pack;
}

/**
 * Installer keys of the company and legal pages that have translations.
 *
 * @return string[]
 */
function lumipix_lang_page_keys() {
	return array( 'about', 'contact', 'privacy', 'terms', 'cookies', 'disclaimer' );
}

/**
 * Page ID of a translated company or legal page.
 *
 * @param string $lang Language code.
 * @param string $key  Installer key, e.g. privacy.
 * @return int
 */
function lumipix_lang_page_id( $lang, $key ) {
	$ids = (array) get_option( 'lumipix_lang_pages', array() );
	$id  = isset( $ids[ 'page:' . $lang . ':' . $key ] ) ? (int) $ids[ 'page:' . $lang . ':' . $key ] : 0;
	return ( $id && 'publish' === get_post_status( $id ) ) ? $id : 0;
}

/**
 * Translated tool definitions, optionally for one language.
 *
 * @param string $lang Language code.
 * @return array<string, array<string, mixed>>
 */
function lumipix_lang_tools( $lang = '' ) {
	$tools = lumipix_lang_pack()['tools'];
	if ( ! $lang ) {
		return $tools;
	}
	return array_filter(
		$tools,
		function ( $t ) use ( $lang ) {
			return $t['lang'] === $lang;
		}
	);
}

/**
 * A translated tool definition.
 *
 * @param string $key Tool key, e.g. fr-compress-image.
 * @return array<string, mixed>|null
 */
function lumipix_lang_tool( $key ) {
	if ( ! preg_match( '/^[a-z]{2}-/', (string) $key ) ) {
		return null;
	}
	$tools = lumipix_lang_pack()['tools'];
	return isset( $tools[ $key ] ) ? $tools[ $key ] : null;
}

/**
 * Hub definition of a language.
 *
 * @param string $lang Language code.
 * @return array<string, mixed>|null
 */
function lumipix_lang_hub( $lang ) {
	$hubs = lumipix_lang_pack()['hubs'];
	return isset( $hubs[ $lang ] ) ? $hubs[ $lang ] : null;
}

/**
 * Page ID of a language hub.
 *
 * @param string $lang Language code.
 * @return int
 */
function lumipix_lang_hub_id( $lang ) {
	$ids = (array) get_option( 'lumipix_lang_pages', array() );
	$id  = isset( $ids[ 'hub:' . $lang ] ) ? (int) $ids[ 'hub:' . $lang ] : 0;
	return ( $id && 'publish' === get_post_status( $id ) ) ? $id : 0;
}

/**
 * URL of a language hub (empty when the page does not exist).
 *
 * @param string $lang Language code.
 * @return string
 */
function lumipix_lang_hub_url( $lang ) {
	$id = lumipix_lang_hub_id( $lang );
	return $id ? get_permalink( $id ) : '';
}

/**
 * Translations of an English tool, as lang => key, for pages that exist.
 *
 * @param string $base English tool key.
 * @return array<string, string>
 */
function lumipix_lang_versions( $base ) {
	$out = array();
	foreach ( array_keys( lumipix_languages() ) as $lang ) {
		$key = $lang . '-' . $base;
		if ( lumipix_lang_tool( $key ) && lumipix_tool_url( $key ) ) {
			$out[ $lang ] = $key;
		}
	}
	return $out;
}

/**
 * Language of the current request: a language code on translated pages, otherwise "en".
 *
 * @return string
 */
function lumipix_current_lang() {
	static $lang = null;
	if ( null !== $lang ) {
		return $lang;
	}
	if ( ! did_action( 'wp' ) ) {
		return 'en';
	}
	$lang = 'en';
	if ( is_page() ) {
		$value = (string) get_post_meta( get_queried_object_id(), '_lumipix_lang', true );
		if ( isset( lumipix_languages()[ $value ] ) ) {
			$lang = $value;
		}
	}
	return $lang;
}

/**
 * The tool key to link to in the current language (falls back to English).
 *
 * @param string $base English tool key.
 * @return string
 */
function lumipix_lang_key( $base ) {
	$lang = lumipix_current_lang();
	if ( 'en' !== $lang && lumipix_tool_url( $lang . '-' . $base ) ) {
		return $lang . '-' . $base;
	}
	return $base;
}

/* -------------------------------------------------------------------------
 * Interface translation
 * ---------------------------------------------------------------------- */

/**
 * Interface strings of a language (English source => translation).
 *
 * @param string $lang Language code.
 * @return array<string, string>
 */
function lumipix_lang_strings( $lang ) {
	static $cache = array();
	if ( ! isset( $cache[ $lang ] ) ) {
		$file           = LUMIPIX_DIR . '/inc/lang/' . sanitize_file_name( $lang ) . '.php';
		$cache[ $lang ] = file_exists( $file ) ? (array) include $file : array();
	}
	return $cache[ $lang ];
}

/**
 * Translate theme strings on translated pages.
 *
 * @param string $translation Translated text.
 * @param string $text        Original text.
 * @return string
 */
function lumipix_lang_gettext( $translation, $text ) {
	$strings = lumipix_lang_strings( lumipix_current_lang() );
	return isset( $strings[ $text ] ) ? $strings[ $text ] : $translation;
}

/**
 * Switch the interface language once the queried page is known.
 */
function lumipix_lang_setup_request() {
	if ( 'en' === lumipix_current_lang() ) {
		return;
	}
	add_filter( 'gettext_lumipix', 'lumipix_lang_gettext', 10, 2 );
	add_filter( 'language_attributes', 'lumipix_lang_attributes' );
	add_filter( 'rank_math/opengraph/facebook/og_locale', 'lumipix_lang_og_locale' );
}
add_action( 'wp', 'lumipix_lang_setup_request' );

/**
 * The html lang attribute on translated pages.
 *
 * @param string $output Attributes.
 * @return string
 */
function lumipix_lang_attributes( $output ) {
	$code = lumipix_languages()[ lumipix_current_lang() ]['html'];
	return preg_match( '/lang="[^"]*"/', $output ) ? preg_replace( '/lang="[^"]*"/', 'lang="' . $code . '"', $output ) : trim( $output . ' lang="' . $code . '"' );
}

/**
 * Open Graph locale on translated pages (Rank Math).
 *
 * @return string
 */
function lumipix_lang_og_locale() {
	return lumipix_languages()[ lumipix_current_lang() ]['locale'];
}

/* -------------------------------------------------------------------------
 * hreflang
 * ---------------------------------------------------------------------- */

/**
 * Alternate URLs of the current page, as hreflang => URL.
 *
 * @return array<string, string>
 */
function lumipix_lang_alternates() {
	if ( ! is_page() && ! is_front_page() ) {
		return array();
	}
	$langs = lumipix_languages();
	$out   = array();
	$id    = get_queried_object_id();

	$hub_lang = (string) get_post_meta( $id, '_lumipix_lang_hub', true );
	if ( is_front_page() || isset( $langs[ $hub_lang ] ) ) {
		$out['en'] = home_url( '/' );
		foreach ( $langs as $lang => $info ) {
			$url = lumipix_lang_hub_url( $lang );
			if ( $url ) {
				$out[ $info['hreflang'] ] = $url;
			}
		}
	} elseif ( lumipix_lang_page_key_of( $id ) ) {
		$page_key = lumipix_lang_page_key_of( $id );
		$english  = lumipix_installer_page_id( $page_key );
		if ( $english ) {
			$out['en'] = get_permalink( $english );
		}
		foreach ( $langs as $lang => $info ) {
			$lang_id = lumipix_lang_page_id( $lang, $page_key );
			if ( $lang_id ) {
				$out[ $info['hreflang'] ] = get_permalink( $lang_id );
			}
		}
	} else {
		$key = lumipix_page_tool_key( $id );
		if ( ! $key ) {
			return array();
		}
		$tool = lumipix_get_tool( $key );
		$base = ! empty( $tool['lang'] ) ? $tool['source'] : $key;
		$url  = lumipix_tool_url( $base );
		if ( $url ) {
			$out['en'] = $url;
		}
		foreach ( lumipix_lang_versions( $base ) as $lang => $lang_key ) {
			$out[ $langs[ $lang ]['hreflang'] ] = lumipix_tool_url( $lang_key );
		}
	}
	if ( count( $out ) < 2 || empty( $out['en'] ) ) {
		return array();
	}
	$out['x-default'] = $out['en'];
	return $out;
}

/**
 * Installer key of a company or legal page (English or translated), if any.
 *
 * @param int $id Page ID.
 * @return string
 */
function lumipix_lang_page_key_of( $id ) {
	$key = (string) get_post_meta( $id, '_lumipix_lang_page', true );
	if ( $key ) {
		return $key;
	}
	foreach ( lumipix_lang_page_keys() as $page_key ) {
		if ( (int) $id === lumipix_installer_page_id( $page_key ) ) {
			return $page_key;
		}
	}
	return '';
}

/**
 * Print hreflang links.
 */
function lumipix_lang_hreflang() {
	foreach ( lumipix_lang_alternates() as $code => $url ) {
		printf( '<link rel="alternate" hreflang="%s" href="%s">' . "\n", esc_attr( $code ), esc_url( $url ) );
	}
}
add_action( 'wp_head', 'lumipix_lang_hreflang', 4 );

/* -------------------------------------------------------------------------
 * Templates and links
 * ---------------------------------------------------------------------- */

/**
 * Route language hub pages to their template.
 *
 * @param string $template Template path.
 * @return string
 */
function lumipix_lang_template_include( $template ) {
	if ( is_page() && ! is_front_page() && get_post_meta( get_queried_object_id(), '_lumipix_lang_hub', true ) ) {
		$hub_template = locate_template( 'templates/lang-hub.php' );
		if ( $hub_template ) {
			return $hub_template;
		}
	}
	return $template;
}
add_filter( 'template_include', 'lumipix_lang_template_include', 20 );

/**
 * Primary navigation on translated pages, built like the English one: a tools
 * menu with every translated tool, then the three most used tools.
 *
 * @return bool Whether a navigation was printed.
 */
function lumipix_lang_nav() {
	$lang = lumipix_current_lang();
	if ( 'en' === $lang ) {
		return false;
	}
	$current = is_page() ? lumipix_page_tool_key( get_queried_object_id() ) : '';
	echo '<ul class="nav-list">';
	echo '<li class="has-mega"><button class="nav-trigger" type="button" aria-expanded="false" aria-controls="mega-tools">' . esc_html__( 'Tools', 'lumipix' ) . lumipix_icon( 'chevron', 16 ) . '</button>'; // phpcs:ignore WordPress.Security.EscapeOutput
	echo '<div class="mega mega--lang" id="mega-tools"><div class="mega__grid"><ul>';
	foreach ( lumipix_lang_tools( $lang ) as $key => $tool ) {
		$url = lumipix_tool_url( $key );
		if ( $url ) {
			echo '<li><a href="' . esc_url( $url ) . '"' . ( $key === $current ? ' aria-current="page"' : '' ) . '>' . lumipix_icon( $tool['icon'], 16 ) . '<span>' . esc_html( $tool['nav'] ) . '</span></a></li>'; // phpcs:ignore WordPress.Security.EscapeOutput
		}
	}
	echo '</ul>';
	$hub = lumipix_lang_hub_url( $lang );
	if ( $hub ) {
		echo '<a class="mega__all" href="' . esc_url( $hub ) . '">' . esc_html__( 'See all tools', 'lumipix' ) . lumipix_icon( 'arrow', 16 ) . '</a>'; // phpcs:ignore WordPress.Security.EscapeOutput
	}
	echo '</div></div></li>';

	$shortcuts = array(
		'compress-image'     => __( 'Compress', 'lumipix' ),
		'image-resizer'      => __( 'Resize', 'lumipix' ),
		'background-remover' => __( 'Remove background', 'lumipix' ),
	);
	foreach ( $shortcuts as $base => $label ) {
		$key = $lang . '-' . $base;
		$url = lumipix_tool_url( $key );
		if ( $url ) {
			echo '<li><a href="' . esc_url( $url ) . '"' . ( $key === $current ? ' aria-current="page"' : '' ) . '>' . esc_html( $label ) . '</a></li>';
		}
	}
	echo '</ul>';
	return true;
}

/**
 * Links of the language switcher: the same page in every language when it
 * exists, otherwise the home page or the language hub.
 *
 * @return array<int, array{code: string, name: string, hreflang: string, url: string}>
 */
function lumipix_lang_switch_links() {
	$alternates = lumipix_lang_alternates();
	$links      = array(
		array(
			'code'     => 'en',
			'name'     => 'English',
			'hreflang' => 'en',
			'url'      => ! empty( $alternates['en'] ) ? $alternates['en'] : home_url( '/' ),
		),
	);
	foreach ( lumipix_languages() as $lang => $info ) {
		$url = ! empty( $alternates[ $info['hreflang'] ] ) ? $alternates[ $info['hreflang'] ] : lumipix_lang_hub_url( $lang );
		if ( $url ) {
			$links[] = array(
				'code'     => $lang,
				'name'     => $info['name'],
				'hreflang' => $info['hreflang'],
				'url'      => $url,
			);
		}
	}
	return $links;
}

/**
 * Language switcher in the header.
 */
function lumipix_lang_switcher() {
	$links = lumipix_lang_switch_links();
	if ( count( $links ) < 2 ) {
		return;
	}
	$current = lumipix_current_lang();
	?>
	<div class="lang-switch" data-lang-switch>
		<button class="lang-switch__btn" type="button" aria-expanded="false" aria-controls="lang-switch-menu" aria-label="<?php esc_attr_e( 'Language', 'lumipix' ); ?>">
			<?php echo lumipix_icon( 'globe', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
			<span class="lang-switch__code"><?php echo esc_html( strtoupper( $current ) ); ?></span>
			<?php echo lumipix_icon( 'chevron', 14 ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		</button>
		<ul class="lang-switch__menu" id="lang-switch-menu" hidden>
			<?php foreach ( $links as $link ) : ?>
				<li><a href="<?php echo esc_url( $link['url'] ); ?>" hreflang="<?php echo esc_attr( $link['hreflang'] ); ?>" lang="<?php echo esc_attr( $link['hreflang'] ); ?>"<?php echo $link['code'] === $current ? ' aria-current="true"' : ''; ?>><span class="lang-switch__tag"><?php echo esc_html( strtoupper( $link['code'] ) ); ?></span><?php echo esc_html( $link['name'] ); ?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php
}

/**
 * Short "Also in" line with the language hubs, shown in the home page hero.
 */
function lumipix_language_strip() {
	$links = array();
	foreach ( lumipix_languages() as $lang => $info ) {
		$url = lumipix_lang_hub_url( $lang );
		if ( $url ) {
			$links[] = sprintf( '<a href="%s" hreflang="%s" lang="%s">%s</a>', esc_url( $url ), esc_attr( $info['hreflang'] ), esc_attr( $info['hreflang'] ), esc_html( $info['name'] ) );
		}
	}
	if ( ! $links ) {
		return;
	}
	echo '<p class="hero-langs">' . lumipix_icon( 'globe', 16 ) . '<span>' . esc_html__( 'Also in', 'lumipix' ) . '</span> ' . implode( ' <span aria-hidden="true">·</span> ', $links ) . '</p>'; // phpcs:ignore WordPress.Security.EscapeOutput
}

/**
 * Body class on translated pages.
 *
 * @param string[] $classes Classes.
 * @return string[]
 */
function lumipix_lang_body_class( $classes ) {
	if ( 'en' !== lumipix_current_lang() ) {
		$classes[] = 'is-translated';
		$classes[] = 'lang-' . lumipix_current_lang();
	}
	return $classes;
}
add_filter( 'body_class', 'lumipix_lang_body_class' );

/**
 * Footer column with the translated tools (replaces the English tool columns
 * on translated pages).
 */
function lumipix_lang_footer_col() {
	$lang = lumipix_current_lang();
	$hub  = lumipix_lang_hub_id( $lang );
	?>
	<div class="site-footer__col">
		<p class="site-footer__title"><?php echo esc_html( $hub ? get_the_title( $hub ) : __( 'All tools', 'lumipix' ) ); ?></p>
		<ul>
			<?php foreach ( lumipix_lang_tools( $lang ) as $key => $tool ) : ?>
				<?php $url = lumipix_tool_url( $key ); ?>
				<?php if ( $url ) : ?>
					<li><a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $tool['nav'] ); ?></a></li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php
}

/**
 * Footer company links on translated pages: translated About and Contact,
 * the language hub instead of the English tool list, and the English guides
 * marked as such.
 *
 * @param array<int, array{0:string,1:string}> $links Links.
 * @return array<int, array{0:string,1:string}>
 */
function lumipix_lang_company_links( $links ) {
	$lang = lumipix_current_lang();
	if ( 'en' === $lang ) {
		return $links;
	}
	$out = array();
	foreach ( array( 'about', 'tools', 'blog', 'contact' ) as $key ) {
		if ( 'tools' === $key ) {
			$id = lumipix_lang_hub_id( $lang );
		} elseif ( 'blog' === $key ) {
			$id = lumipix_installer_page_id( 'blog' );
			if ( $id ) {
				$out[] = array( __( 'Guides (English)', 'lumipix' ), get_permalink( $id ) );
			}
			continue;
		} else {
			$id = lumipix_lang_page_id( $lang, $key );
			$id = $id ? $id : lumipix_installer_page_id( $key );
		}
		if ( $id ) {
			$out[] = array( get_the_title( $id ), get_permalink( $id ) );
		}
	}
	return $out;
}
add_filter( 'lumipix_company_links', 'lumipix_lang_company_links' );

/**
 * Footer legal links on translated pages point to the translated pages.
 *
 * @param array<int, array{0:string,1:string}> $links Links.
 * @return array<int, array{0:string,1:string}>
 */
function lumipix_lang_legal_links( $links ) {
	$lang = lumipix_current_lang();
	if ( 'en' === $lang ) {
		return $links;
	}
	$out = array();
	foreach ( array( 'privacy', 'terms', 'cookies', 'disclaimer' ) as $key ) {
		$id = lumipix_lang_page_id( $lang, $key );
		$id = $id ? $id : lumipix_installer_page_id( $key );
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
add_filter( 'lumipix_legal_links', 'lumipix_lang_legal_links' );

/**
 * Cookie banner links to the cookie policy in the page language.
 *
 * @param int $id English cookie policy page ID.
 * @return int
 */
function lumipix_lang_cookie_policy_id( $id ) {
	$lang = lumipix_current_lang();
	if ( 'en' === $lang ) {
		return $id;
	}
	$lang_id = lumipix_lang_page_id( $lang, 'cookies' );
	return $lang_id ? $lang_id : $id;
}
add_filter( 'lumipix_cookie_policy_id', 'lumipix_lang_cookie_policy_id' );

/**
 * Language links shown in the footer of every page.
 */
function lumipix_language_links() {
	$links = array( array( 'en', 'English', 'en', home_url( '/' ) ) );
	foreach ( lumipix_languages() as $lang => $info ) {
		$url = lumipix_lang_hub_url( $lang );
		if ( $url ) {
			$links[] = array( $lang, $info['name'], $info['hreflang'], $url );
		}
	}
	if ( count( $links ) < 2 ) {
		return;
	}
	$current = lumipix_current_lang();
	echo '<nav class="lang-links" aria-label="' . esc_attr__( 'Languages', 'lumipix' ) . '">';
	echo lumipix_icon( 'globe', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput
	foreach ( $links as $link ) {
		printf(
			'<a href="%s" hreflang="%s" lang="%s"%s>%s</a>',
			esc_url( $link[3] ),
			esc_attr( $link[2] ),
			esc_attr( $link[2] ),
			$link[0] === $current ? ' aria-current="true"' : '',
			esc_html( $link[1] )
		);
	}
	echo '</nav>';
}

/**
 * "Also available in" links under an English tool, and back to English on translated tools.
 *
 * @param string $key Tool key of the page.
 */
function lumipix_lang_tool_switcher( $key ) {
	$tool = lumipix_get_tool( $key );
	if ( ! $tool ) {
		return;
	}
	$langs = lumipix_languages();
	$base  = ! empty( $tool['lang'] ) ? $tool['source'] : $key;
	$links = array();
	if ( ! empty( $tool['lang'] ) ) {
		$url = lumipix_tool_url( $base );
		if ( $url ) {
			$links[] = array( 'en', 'English', $url );
		}
	}
	foreach ( lumipix_lang_versions( $base ) as $lang => $lang_key ) {
		if ( $lang_key !== $key ) {
			$links[] = array( $langs[ $lang ]['hreflang'], lumipix_get_tool( $lang_key )['nav'] . ' (' . $langs[ $lang ]['name'] . ')', lumipix_tool_url( $lang_key ) );
		}
	}
	if ( ! $links ) {
		return;
	}
	echo '<div class="tool-family tool-langs"><p class="tool-family__label">' . esc_html__( 'Also available in', 'lumipix' ) . '</p><div class="chips">';
	foreach ( $links as $link ) {
		printf( '<a class="chip" href="%s" hreflang="%s" lang="%s">%s</a>', esc_url( $link[2] ), esc_attr( $link[0] ), esc_attr( $link[0] ), esc_html( $link[1] ) );
	}
	echo '</div></div>';
}
add_action( 'lumipix_tool_hero_after', 'lumipix_lang_tool_switcher' );

/**
 * Home and tools-hub section linking to every language hub and its tools.
 */
function lumipix_language_section() {
	$blocks = array();
	foreach ( lumipix_languages() as $lang => $info ) {
		$hub = lumipix_lang_hub_id( $lang );
		if ( $hub ) {
			$blocks[ $lang ] = $hub;
		}
	}
	if ( ! $blocks ) {
		return;
	}
	?>
	<section class="section section--tight" aria-labelledby="lang-title">
		<div class="container">
			<div class="section-head">
				<p class="kicker"><?php esc_html_e( 'Other languages', 'lumipix' ); ?></p>
				<h2 id="lang-title" class="section-title section-title--sm"><?php esc_html_e( 'Lumi Pix in your language', 'lumipix' ); ?></h2>
			</div>
			<div class="lang-grid">
				<?php foreach ( $blocks as $lang => $hub ) : ?>
					<div class="lang-card" lang="<?php echo esc_attr( lumipix_languages()[ $lang ]['html'] ); ?>">
						<p class="lang-card__name"><?php echo lumipix_icon( 'globe', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php echo esc_html( lumipix_languages()[ $lang ]['name'] ); ?></p>
						<a class="lang-card__hub" href="<?php echo esc_url( get_permalink( $hub ) ); ?>" hreflang="<?php echo esc_attr( lumipix_languages()[ $lang ]['hreflang'] ); ?>"><?php echo esc_html( get_the_title( $hub ) ); ?> <?php echo lumipix_icon( 'arrow', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a>
						<div class="chips">
							<?php foreach ( lumipix_lang_tools( $lang ) as $key => $tool ) : ?>
								<?php $url = lumipix_tool_url( $key ); ?>
								<?php if ( $url ) : ?>
									<a class="chip" href="<?php echo esc_url( $url ); ?>" hreflang="<?php echo esc_attr( lumipix_languages()[ $lang ]['hreflang'] ); ?>"><?php echo esc_html( $tool['nav'] ); ?></a>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php
}

/* -------------------------------------------------------------------------
 * Page creation
 * ---------------------------------------------------------------------- */

/**
 * Block markup of a language Markdown file (links resolved).
 *
 * @param string $file File path.
 * @return string
 */
function lumipix_lang_body( $file ) {
	return lumipix_md_parse( (string) file_get_contents( $file ) )['html']; // phpcs:ignore WordPress.WP.AlternativeFunctions
}

/**
 * Write content into a page and keep it marked as untouched.
 *
 * @param int    $id      Page ID.
 * @param string $content Block markup.
 */
function lumipix_lang_fill( $id, $content ) {
	global $wpdb;
	wp_update_post(
		array(
			'ID'           => $id,
			'post_content' => $content,
		)
	);
	$fresh = get_post( $id );
	$wpdb->update( $wpdb->posts, array( 'post_modified' => $fresh->post_date, 'post_modified_gmt' => $fresh->post_date_gmt ), array( 'ID' => $id ) ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery
	clean_post_cache( $id );
	update_post_meta( $id, '_lumipix_lang_rev', LUMIPIX_LANG_REV );
}

/**
 * Create the language hubs and tool pages that are missing, then fill
 * untouched pages with the current content.
 *
 * @return array<int, string> Log lines.
 */
function lumipix_lang_install() {
	$log  = array();
	$ids  = (array) get_option( 'lumipix_lang_pages', array() );
	$fill = array();

	foreach ( array_keys( lumipix_languages() ) as $lang ) {
		$hub = lumipix_lang_hub( $lang );
		if ( ! $hub ) {
			continue;
		}
		$hub_id = lumipix_lang_hub_id( $lang );
		if ( ! $hub_id ) {
			$existing = get_page_by_path( $hub['slug'] );
			$hub_id   = $existing ? (int) $existing->ID : (int) wp_insert_post(
				array(
					'post_type'   => 'page',
					'post_status' => 'publish',
					'post_title'  => $hub['h1'],
					'post_name'   => $hub['slug'],
				)
			);
			if ( ! $hub_id ) {
				continue;
			}
			$ids[ 'hub:' . $lang ] = $hub_id;
			/* translators: %s: page title */
			$log[] = sprintf( __( 'Created language page: %s', 'lumipix' ), $hub['h1'] );
		}
		update_post_meta( $hub_id, '_lumipix_lang', $lang );
		update_post_meta( $hub_id, '_lumipix_lang_hub', $lang );
		update_post_meta( $hub_id, '_lumipix_faqs', $hub['faqs'] );
		update_post_meta( $hub_id, '_lumipix_seo_title', $hub['title'] );
		update_post_meta( $hub_id, '_lumipix_seo_desc', $hub['desc'] );
		$fill[ $hub_id ] = $hub['file'];

		$order = 0;
		foreach ( lumipix_lang_tools( $lang ) as $key => $tool ) {
			++$order;
			$id = isset( $ids[ $key ] ) && 'publish' === get_post_status( (int) $ids[ $key ] ) ? (int) $ids[ $key ] : 0;
			if ( ! $id ) {
				$existing = get_page_by_path( $tool['slug'] );
				$id       = $existing ? (int) $existing->ID : (int) wp_insert_post(
					array(
						'post_type'   => 'page',
						'post_status' => 'publish',
						'post_title'  => $tool['h1'],
						'post_name'   => $tool['post_name'],
						'post_parent' => $hub_id,
						'menu_order'  => $order,
					)
				);
				if ( ! $id ) {
					continue;
				}
				$ids[ $key ] = $id;
				/* translators: %s: page title */
				$log[] = sprintf( __( 'Created tool page: %s', 'lumipix' ), $tool['h1'] );
			}
			update_post_meta( $id, '_lumipix_tool', $key );
			update_post_meta( $id, '_lumipix_lang', $lang );
			$fill[ $id ] = $tool['file'];
		}

		$pages = lumipix_lang_pack()['pages'];
		foreach ( isset( $pages[ $lang ] ) ? $pages[ $lang ] : array() as $key => $page ) {
			$id = lumipix_lang_page_id( $lang, $key );
			if ( ! $id ) {
				$existing = get_page_by_path( $page['path'] );
				$id       = $existing ? (int) $existing->ID : (int) wp_insert_post(
					array(
						'post_type'   => 'page',
						'post_status' => 'publish',
						'post_title'  => $page['title'],
						'post_name'   => $page['slug'],
						'post_parent' => $hub_id,
					)
				);
				if ( ! $id ) {
					continue;
				}
				$ids[ 'page:' . $lang . ':' . $key ] = $id;
				/* translators: %s: page title */
				$log[] = sprintf( __( 'Created language page: %s', 'lumipix' ), $page['title'] );
			}
			update_post_meta( $id, '_lumipix_lang', $lang );
			update_post_meta( $id, '_lumipix_lang_page', $key );
			update_post_meta( $id, '_lumipix_seo_title', $page['seo'] );
			update_post_meta( $id, '_lumipix_seo_desc', $page['desc'] );
			$fill[ $id ] = $page['file'];
		}
	}
	update_option( 'lumipix_lang_pages', $ids );

	// Second pass, once every page exists, so links between them resolve.
	foreach ( $fill as $id => $file ) {
		$post = get_post( $id );
		if ( ! $post || ( (int) get_post_meta( $id, '_lumipix_lang_rev', true ) >= LUMIPIX_LANG_REV ) ) {
			continue;
		}
		if ( '' !== trim( $post->post_content ) && ! lumipix_is_untouched( $post ) ) {
			continue; // Edited by hand: keep it.
		}
		lumipix_lang_fill( $id, lumipix_lang_body( $file ) );
	}

	if ( defined( 'RANK_MATH_VERSION' ) && function_exists( 'lumipix_rm_sync' ) ) {
		lumipix_rm_sync();
	}
	// New pages must show up in the cached XML sitemap.
	if ( method_exists( '\RankMath\Sitemap\Cache', 'invalidate_storage' ) ) {
		\RankMath\Sitemap\Cache::invalidate_storage();
	}
	update_option( 'lumipix_lang_rev_done', LUMIPIX_LANG_REV );
	return $log;
}

/**
 * Create or refresh the language pages after an update that ships new content.
 */
function lumipix_lang_maybe_install() {
	if ( (int) get_option( 'lumipix_lang_rev_done' ) >= LUMIPIX_LANG_REV || get_transient( 'lumipix_lang_installing' ) ) {
		return;
	}
	if ( ! lumipix_lang_pack()['hubs'] ) {
		return;
	}
	set_transient( 'lumipix_lang_installing', 1, 5 * MINUTE_IN_SECONDS );
	lumipix_lang_install();
	delete_transient( 'lumipix_lang_installing' );
}
add_action( 'init', 'lumipix_lang_maybe_install', 30 );

/**
 * Rank Math data for the language pages.
 *
 * @param array<int, array<string, string>> $items Items keyed by post ID.
 * @return array<int, array<string, string>>
 */
function lumipix_lang_rm_items( $items ) {
	foreach ( array_keys( lumipix_languages() ) as $lang ) {
		$hub    = lumipix_lang_hub( $lang );
		$hub_id = lumipix_lang_hub_id( $lang );
		if ( $hub && $hub_id ) {
			$items[ $hub_id ] = array(
				'title'    => $hub['title'],
				'desc'     => $hub['desc'],
				'keywords' => $hub['keywords'],
				'image'    => 'assets/og/home.jpg',
			);
		}
	}
	foreach ( lumipix_lang_pack()['pages'] as $lang => $pages ) {
		foreach ( $pages as $key => $page ) {
			$id = lumipix_lang_page_id( $lang, $key );
			if ( $id ) {
				$items[ $id ] = array(
					'title'    => $page['seo'],
					'desc'     => $page['desc'],
					'keywords' => $page['keywords'],
					'image'    => 'assets/og/home.jpg',
				);
			}
		}
	}
	foreach ( lumipix_lang_tools() as $key => $tool ) {
		$id = lumipix_tool_page_id( $key );
		if ( $id ) {
			$items[ $id ] = array(
				'title'    => $tool['title'],
				'desc'     => $tool['desc'],
				'keywords' => $tool['keywords'],
				'image'    => 'assets/og/tool-' . $tool['source'] . '.jpg',
			);
		}
	}
	return $items;
}
add_filter( 'lumipix_rm_items', 'lumipix_lang_rm_items' );
