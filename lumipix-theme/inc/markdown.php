<?php
/**
 * Minimal Markdown → block markup converter for the bundled content pack.
 *
 * Supported: front matter (key: value), ## / ### headings, paragraphs,
 * "- " lists, "1. " lists, "> " quotes, pipe tables, **bold**, `code`,
 * [links](url). Link targets may use tool:<key> and post:<slug>, resolved
 * to real permalinks when the content is installed.
 *
 * A "## Frequently asked questions" section is not added to the body:
 * each "### question" + answer paragraph becomes an entry in `faqs`,
 * which the theme renders (with FAQPage schema) below the content.
 *
 * @package Lumipix
 */

defined( 'ABSPATH' ) || exit;

/**
 * Parse a content-pack Markdown file.
 *
 * @param string $text Raw file contents.
 * @return array{meta: array<string,string>, html: string, faqs: array<string,string>}
 */
function lumipix_md_parse( $text ) {
	$text = str_replace( "\r\n", "\n", (string) $text );
	$meta = array();
	if ( preg_match( '/^---\n(.*?)\n---\n/s', $text, $m ) ) {
		foreach ( explode( "\n", $m[1] ) as $line ) {
			if ( preg_match( '/^([a-z_]+):\s*(.*)$/', $line, $kv ) ) {
				$meta[ $kv[1] ] = trim( $kv[2] );
			}
		}
		$text = substr( $text, strlen( $m[0] ) );
	}

	$lines  = explode( "\n", $text );
	$blocks = array();
	$faqs   = array();
	$in_faq = false;
	$faq_q  = '';
	$count  = count( $lines );

	for ( $i = 0; $i < $count; $i++ ) {
		$line = rtrim( $lines[ $i ] );
		if ( '' === trim( $line ) || 0 === strpos( trim( $line ), '<!--' ) ) {
			continue; // Blank lines and HTML comments (editorial markers) are skipped.
		}

		if ( preg_match( '/^##\s+(.*)$/', $line, $m ) && ! preg_match( '/^###/', $line ) ) {
			if ( preg_match( '/^(faq|faqs|frequently asked questions)$/i', trim( $m[1] ) ) ) {
				$in_faq = true;
				continue;
			}
			$in_faq   = false;
			$blocks[] = lumipix_md_heading( $m[1], 2 );
			continue;
		}

		if ( preg_match( '/^###\s+(.*)$/', $line, $m ) ) {
			if ( $in_faq ) {
				$faq_q = trim( $m[1] );
				continue;
			}
			$blocks[] = lumipix_md_heading( $m[1], 3 );
			continue;
		}

		// Collect a paragraph-like run of lines.
		if ( preg_match( '/^(-|\d+\.)\s+/', $line ) ) {
			$ordered = (bool) preg_match( '/^\d+\./', $line );
			$items   = array();
			while ( $i < $count && preg_match( '/^(-|\d+\.)\s+(.*)$/', rtrim( $lines[ $i ] ), $m ) ) {
				$items[] = $m[2];
				$i++;
			}
			$i--;
			if ( ! $in_faq ) {
				$blocks[] = lumipix_md_list( $items, $ordered );
			}
			continue;
		}

		if ( 0 === strpos( $line, '|' ) ) {
			$rows = array();
			while ( $i < $count && 0 === strpos( trim( $lines[ $i ] ), '|' ) ) {
				$rows[] = trim( $lines[ $i ] );
				$i++;
			}
			$i--;
			$blocks[] = lumipix_md_table( $rows );
			continue;
		}

		if ( 0 === strpos( $line, '>' ) ) {
			$quote = array();
			while ( $i < $count && 0 === strpos( $lines[ $i ], '>' ) ) {
				$quote[] = ltrim( substr( $lines[ $i ], 1 ) );
				$i++;
			}
			$i--;
			$blocks[] = '<!-- wp:quote --><blockquote class="wp-block-quote"><!-- wp:paragraph --><p>' . lumipix_md_inline( implode( ' ', $quote ) ) . '</p><!-- /wp:paragraph --></blockquote><!-- /wp:quote -->';
			continue;
		}

		$para = array( trim( $line ) );
		while ( $i + 1 < $count && '' !== trim( $lines[ $i + 1 ] ) && ! preg_match( '/^(#|-\s|\d+\.\s|\||>)/', $lines[ $i + 1 ] ) ) {
			$i++;
			$para[] = trim( $lines[ $i ] );
		}
		$para_text = implode( ' ', $para );
		if ( $in_faq ) {
			if ( $faq_q ) {
				$faqs[ $faq_q ] = isset( $faqs[ $faq_q ] ) ? $faqs[ $faq_q ] . ' ' . $para_text : $para_text;
			}
			continue;
		}
		$blocks[] = '<!-- wp:paragraph --><p>' . lumipix_md_inline( $para_text ) . '</p><!-- /wp:paragraph -->';
	}

	// FAQ answers keep their links as plain text (they are also used in schema).
	foreach ( $faqs as $q => $a ) {
		$faqs[ $q ] = trim( preg_replace( '/\[([^\]]+)\]\([^)]+\)/', '$1', str_replace( array( '**', '`' ), '', $a ) ) );
	}

	return array(
		'meta' => $meta,
		'html' => implode( "\n\n", $blocks ),
		'faqs' => $faqs,
	);
}

/**
 * Heading block.
 *
 * @param string $text  Text.
 * @param int    $level Level.
 * @return string
 */
function lumipix_md_heading( $text, $level ) {
	$attrs = 2 === $level ? '' : ' {"level":' . (int) $level . '}';
	return sprintf( '<!-- wp:heading%1$s --><h%2$d class="wp-block-heading">%3$s</h%2$d><!-- /wp:heading -->', $attrs, $level, lumipix_md_inline( trim( $text ) ) );
}

/**
 * List block.
 *
 * @param string[] $items   Items.
 * @param bool     $ordered Ordered.
 * @return string
 */
function lumipix_md_list( $items, $ordered ) {
	$tag  = $ordered ? 'ol' : 'ul';
	$html = '<!-- wp:list' . ( $ordered ? ' {"ordered":true}' : '' ) . ' --><' . $tag . ' class="wp-block-list">';
	foreach ( $items as $item ) {
		$html .= '<!-- wp:list-item --><li>' . lumipix_md_inline( $item ) . '</li><!-- /wp:list-item -->';
	}
	return $html . '</' . $tag . '><!-- /wp:list -->';
}

/**
 * Table block (first row is the header; a separator row is skipped).
 *
 * @param string[] $rows Pipe rows.
 * @return string
 */
function lumipix_md_table( $rows ) {
	$cells = function ( $row ) {
		return array_map( 'trim', explode( '|', trim( $row, '|' ) ) );
	};
	$head = $cells( array_shift( $rows ) );
	$html = '<!-- wp:table --><figure class="wp-block-table"><table><thead><tr>';
	foreach ( $head as $c ) {
		$html .= '<th>' . lumipix_md_inline( $c ) . '</th>';
	}
	$html .= '</tr></thead><tbody>';
	foreach ( $rows as $row ) {
		if ( preg_match( '/^\|?[\s:\-|]+\|?$/', $row ) ) {
			continue;
		}
		$html .= '<tr>';
		foreach ( $cells( $row ) as $c ) {
			$html .= '<td>' . lumipix_md_inline( $c ) . '</td>';
		}
		$html .= '</tr>';
	}
	return $html . '</tbody></table></figure><!-- /wp:table -->';
}

/**
 * Inline formatting with escaping.
 *
 * @param string $text Text.
 * @return string
 */
function lumipix_md_inline( $text ) {
	$links = array();
	$text  = preg_replace_callback(
		'/\[([^\]]+)\]\(([^)\s]+)\)/',
		function ( $m ) use ( &$links ) {
			$url   = lumipix_md_resolve_url( $m[2] );
			$label = $m[1];
			$token = "\x01" . count( $links ) . "\x01";
			$links[] = $url
				? '<a href="' . esc_url( $url ) . '">' . lumipix_md_emphasis( esc_html( $label ) ) . '</a>'
				: lumipix_md_emphasis( esc_html( $label ) );
			return $token;
		},
		$text
	);
	$text = lumipix_md_emphasis( esc_html( $text ) );
	return preg_replace_callback(
		"/\x01(\d+)\x01/",
		function ( $m ) use ( $links ) {
			return $links[ (int) $m[1] ];
		},
		$text
	);
}

/**
 * Bold and code on already-escaped text.
 *
 * @param string $html Escaped text.
 * @return string
 */
function lumipix_md_emphasis( $html ) {
	$html = preg_replace( '/\*\*(.+?)\*\*/', '<strong>$1</strong>', $html );
	return preg_replace( '/`([^`]+)`/', '<code>$1</code>', $html );
}

/**
 * Resolve tool:/post:/page: link targets.
 *
 * @param string $target Link target.
 * @return string URL or empty string when the target does not exist.
 */
function lumipix_md_resolve_url( $target ) {
	if ( 0 === strpos( $target, 'tool:' ) ) {
		return lumipix_tool_url( substr( $target, 5 ) );
	}
	if ( 0 === strpos( $target, 'page:' ) ) {
		$id = lumipix_installer_page_id( substr( $target, 5 ) );
		return $id ? get_permalink( $id ) : '';
	}
	if ( 0 === strpos( $target, 'post:' ) ) {
		return lumipix_pack_post_url( substr( $target, 5 ) );
	}
	return $target;
}

/**
 * Pretty URL of a pack post, also for posts that are still scheduled.
 *
 * @param string $slug Post slug.
 * @return string
 */
function lumipix_pack_post_url( $slug ) {
	$post = get_page_by_path( $slug, OBJECT, 'post' );
	if ( ! $post ) {
		return '';
	}
	if ( 'publish' === $post->post_status ) {
		return get_permalink( $post );
	}
	// Build the URL the post will have once it is published (works with any permalink structure).
	$future              = clone $post;
	$future->post_status = 'publish';
	return get_permalink( $future );
}
