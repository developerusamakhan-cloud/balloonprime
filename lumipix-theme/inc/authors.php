<?php
/**
 * Editorial team: author accounts for the content pack, local avatars,
 * the author box under articles and the author archive header.
 *
 * Authors are created by Lumi Pix Setup with the "author" role and a random
 * password (they cannot log in until someone resets it). Rename them, change
 * their bios or replace them with your real team in Users → Profile.
 *
 * @package Lumipix
 */

defined( 'ABSPATH' ) || exit;

/**
 * Author profiles bundled with the theme.
 *
 * @return array<string, array<string, mixed>>
 */
function lumipix_pack_authors() {
	return apply_filters(
		'lumipix_pack_authors',
		array(
			'emily-carter'  => array(
				'name'       => 'Emily Carter',
				'role_label' => __( 'Compression & online forms', 'lumipix' ),
				'bio'        => __( 'Emily writes the Lumi Pix guides on compressing photos and preparing images for online applications. She focuses on clear, step-by-step instructions that work on any phone.', 'lumipix' ),
				'categories' => array( 'Compression' ),
			),
			'james-walker'  => array(
				'name'       => 'James Walker',
				'role_label' => __( 'Resizing, ID photos & signatures', 'lumipix' ),
				'bio'        => __( 'James covers resizing, passport photos and signatures. He tests every method on real phones and computers before writing it up.', 'lumipix' ),
				'categories' => array( 'Resizing', 'Photos & IDs' ),
			),
			'daniel-brooks' => array(
				'name'       => 'Daniel Brooks',
				'role_label' => __( 'Image formats & printing', 'lumipix' ),
				'bio'        => __( 'Daniel explains image formats, DPI and printing in plain English, so you can choose the right file for screen or paper without the jargon.', 'lumipix' ),
				'categories' => array( 'Formats & Printing' ),
			),
			'olivia-bennett' => array(
				'name'       => 'Olivia Bennett',
				'role_label' => __( 'Background removal & social media', 'lumipix' ),
				'bio'        => __( 'Olivia writes about background removal, product photos and social media image sizes, with a focus on getting professional results from free tools.', 'lumipix' ),
				'categories' => array( 'Background Removal', 'Comparisons', 'Social Media' ),
			),
		)
	);
}

/**
 * Rename author accounts created by earlier theme versions to the current
 * profiles. Runs once; only touches users the theme created itself.
 */
function lumipix_migrate_pack_authors() {
	if ( (int) get_option( 'lumipix_authors_rev' ) >= 2 ) {
		return;
	}
	global $wpdb;
	$renamed  = array(
		'ayesha-khan' => 'emily-carter',
		'hamza-iqbal' => 'james-walker',
		'sara-malik'  => 'olivia-bennett',
	);
	$profiles = lumipix_pack_authors();
	add_filter( 'send_email_change_email', '__return_false' );
	foreach ( $renamed as $old => $new ) {
		if ( ! isset( $profiles[ $new ] ) ) {
			continue;
		}
		$ids = get_users(
			array(
				'meta_key'   => '_lumipix_author', // phpcs:ignore WordPress.DB.SlowDBQuery
				'meta_value' => $old, // phpcs:ignore WordPress.DB.SlowDBQuery
				'fields'     => 'ID',
			)
		);
		foreach ( $ids as $id ) {
			$p     = $profiles[ $new ];
			$parts = explode( ' ', $p['name'], 2 );
			$login = sanitize_user( str_replace( '-', '', $new ), true );
			if ( ! username_exists( $login ) ) {
				$wpdb->update( $wpdb->users, array( 'user_login' => $login ), array( 'ID' => $id ) ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery
			}
			wp_update_user(
				array(
					'ID'            => $id,
					'display_name'  => $p['name'],
					'nickname'      => $p['name'],
					'first_name'    => $parts[0],
					'last_name'     => $parts[1] ?? '',
					'user_nicename' => $new,
					'user_email'    => $new . '@authors.lumipix.invalid',
					'description'   => $p['bio'],
				)
			);
			update_user_meta( $id, '_lumipix_author', $new );
			clean_user_cache( $id );
		}
	}
	remove_filter( 'send_email_change_email', '__return_false' );
	update_option( 'lumipix_authors_rev', 2 );
}
add_action( 'admin_init', 'lumipix_migrate_pack_authors' );

/**
 * Create (or find) the user for an author profile.
 *
 * @param string $slug Profile key.
 * @return int User ID or 0.
 */
function lumipix_ensure_author( $slug ) {
	$profiles = lumipix_pack_authors();
	if ( ! isset( $profiles[ $slug ] ) ) {
		return 0;
	}
	$existing = get_users(
		array(
			'meta_key'   => '_lumipix_author', // phpcs:ignore WordPress.DB.SlowDBQuery
			'meta_value' => $slug, // phpcs:ignore WordPress.DB.SlowDBQuery
			'number'     => 1,
			'fields'     => 'ID',
		)
	);
	if ( $existing ) {
		return (int) $existing[0];
	}
	$p     = $profiles[ $slug ];
	$parts = explode( ' ', $p['name'], 2 );
	$login = sanitize_user( str_replace( '-', '', $slug ), true );
	if ( username_exists( $login ) ) {
		$login .= wp_rand( 10, 99 );
	}
	$id = wp_insert_user(
		array(
			'user_login'    => $login,
			'user_pass'     => wp_generate_password( 32, true, true ),
			'user_email'    => $slug . '@authors.lumipix.invalid',
			'display_name'  => $p['name'],
			'nickname'      => $p['name'],
			'first_name'    => $parts[0],
			'last_name'     => $parts[1] ?? '',
			'user_nicename' => $slug,
			'description'   => $p['bio'],
			'role'          => 'author',
		)
	);
	if ( is_wp_error( $id ) ) {
		return 0;
	}
	update_user_meta( $id, '_lumipix_author', $slug );
	return (int) $id;
}

/**
 * Author user for a category name (falls back to the first profile).
 *
 * @param string $category Category name.
 * @return int User ID.
 */
function lumipix_author_for_category( $category ) {
	foreach ( lumipix_pack_authors() as $slug => $p ) {
		if ( in_array( $category, $p['categories'], true ) ) {
			return lumipix_ensure_author( $slug );
		}
	}
	$keys = array_keys( lumipix_pack_authors() );
	return $keys ? lumipix_ensure_author( $keys[0] ) : 0;
}

/**
 * Use the bundled avatar image for pack authors.
 *
 * @param array<string, mixed> $args        Avatar args.
 * @param mixed                $id_or_email User, ID, email or comment.
 * @return array<string, mixed>
 */
function lumipix_pack_avatar( $args, $id_or_email ) {
	$user_id = 0;
	if ( is_numeric( $id_or_email ) ) {
		$user_id = (int) $id_or_email;
	} elseif ( $id_or_email instanceof WP_User ) {
		$user_id = $id_or_email->ID;
	} elseif ( $id_or_email instanceof WP_Post ) {
		$user_id = (int) $id_or_email->post_author;
	} elseif ( is_string( $id_or_email ) && is_email( $id_or_email ) ) {
		$u       = get_user_by( 'email', $id_or_email );
		$user_id = $u ? $u->ID : 0;
	}
	if ( ! $user_id ) {
		return $args;
	}
	$slug = (string) get_user_meta( $user_id, '_lumipix_author', true );
	if ( $slug && file_exists( LUMIPIX_DIR . '/assets/avatars/' . $slug . '.png' ) ) {
		$args['url']          = LUMIPIX_URI . '/assets/avatars/' . $slug . '.png';
		$args['found_avatar'] = true;
	}
	return $args;
}
add_filter( 'pre_get_avatar_data', 'lumipix_pack_avatar', 10, 2 );

/**
 * Author box shown at the end of articles.
 *
 * @param int $user_id User ID.
 */
function lumipix_author_box( $user_id ) {
	$user = get_userdata( $user_id );
	if ( ! $user ) {
		return;
	}
	$slug     = (string) get_user_meta( $user_id, '_lumipix_author', true );
	$profiles = lumipix_pack_authors();
	$label    = $slug && isset( $profiles[ $slug ] ) ? $profiles[ $slug ]['role_label'] : '';
	$bio      = (string) get_the_author_meta( 'description', $user_id );
	?>
	<aside class="author-box" aria-label="<?php esc_attr_e( 'About the author', 'lumipix' ); ?>">
		<a class="author-box__avatar" href="<?php echo esc_url( get_author_posts_url( $user_id ) ); ?>"><?php echo get_avatar( $user_id, 128, '', $user->display_name ); ?></a>
		<div class="author-box__body">
			<p class="author-box__eyebrow"><?php esc_html_e( 'Written by', 'lumipix' ); ?></p>
			<p class="author-box__name"><a href="<?php echo esc_url( get_author_posts_url( $user_id ) ); ?>"><?php echo esc_html( $user->display_name ); ?></a><?php echo $label ? ' <span>· ' . esc_html( $label ) . '</span>' : ''; ?></p>
			<?php if ( $bio ) : ?>
				<p class="author-box__bio"><?php echo esc_html( $bio ); ?></p>
			<?php endif; ?>
		</div>
	</aside>
	<?php
}
