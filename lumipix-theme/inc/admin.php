<?php
/**
 * Admin: setup screen, notices and editor meta boxes.
 *
 * @package Lumipix
 */

defined( 'ABSPATH' ) || exit;

/**
 * Setup screen under Appearance.
 */
function lumipix_admin_menu() {
	add_theme_page( __( 'Lumi Pix Setup', 'lumipix' ), __( 'Lumi Pix Setup', 'lumipix' ), 'manage_options', 'lumipix-setup', 'lumipix_setup_screen' );
}
add_action( 'admin_menu', 'lumipix_admin_menu' );

/**
 * Handle the setup form.
 */
function lumipix_handle_setup() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'You are not allowed to do this.', 'lumipix' ) );
	}
	check_admin_referer( 'lumipix_setup' );
	$log = lumipix_run_installer();
	set_transient( 'lumipix_setup_log', $log, 120 );
	update_option( 'lumipix_setup_done', 1 );
	wp_safe_redirect( admin_url( 'themes.php?page=lumipix-setup&done=1' ) );
	exit;
}
add_action( 'admin_post_lumipix_setup', 'lumipix_handle_setup' );

/**
 * Setup screen markup.
 */
function lumipix_setup_screen() {
	$status = lumipix_installer_status();
	$log    = get_transient( 'lumipix_setup_log' );
	delete_transient( 'lumipix_setup_log' );
	$missing = count( array_filter( $status, fn( $r ) => ! $r['exists'] ) );
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Lumi Pix Setup', 'lumipix' ); ?></h1>
		<p><?php esc_html_e( 'Creates the tool pages, hub page, blog, legal pages, starter article drafts and footer menu. It only adds what is missing and never overwrites your content.', 'lumipix' ); ?></p>
		<?php if ( $log ) : ?>
			<div class="notice notice-success"><ul style="list-style:disc;padding-left:20px">
				<?php foreach ( (array) $log as $line ) : ?>
					<li><?php echo esc_html( $line ); ?></li>
				<?php endforeach; ?>
			</ul></div>
		<?php endif; ?>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="lumipix_setup">
			<?php wp_nonce_field( 'lumipix_setup' ); ?>
			<?php
			submit_button(
				$missing
					/* translators: %d: number of missing items */
					? sprintf( _n( 'Create %d missing item', 'Create %d missing items', $missing, 'lumipix' ), $missing )
					: __( 'Re-check setup', 'lumipix' )
			);
			?>
		</form>
		<table class="widefat striped" style="max-width:760px">
			<thead><tr><th><?php esc_html_e( 'Page', 'lumipix' ); ?></th><th><?php esc_html_e( 'Status', 'lumipix' ); ?></th></tr></thead>
			<tbody>
			<?php foreach ( $status as $row ) : ?>
				<tr>
					<td><?php echo $row['url'] ? '<a href="' . esc_url( $row['url'] ) . '" target="_blank" rel="noopener">' . esc_html( $row['label'] ) . '</a>' : esc_html( $row['label'] ); ?></td>
					<td><?php echo $row['exists'] ? '✅ ' . esc_html__( 'Ready', 'lumipix' ) : '— ' . esc_html__( 'Missing', 'lumipix' ); ?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		<h2><?php esc_html_e( 'Shortcodes', 'lumipix' ); ?></h2>
		<p><code>[lumipix_tool key="compress-image-to-50kb"]</code> – <?php esc_html_e( 'embed a working tool inside any post or page.', 'lumipix' ); ?></p>
		<p><code>[lumipix_cta tool="background-remover"]</code> – <?php esc_html_e( 'a call-to-action card linking to a tool.', 'lumipix' ); ?></p>
		<p><?php esc_html_e( 'Tool keys:', 'lumipix' ); ?> <code><?php echo esc_html( implode( ', ', array_keys( lumipix_tools() ) ) ); ?></code></p>
	</div>
	<?php
}

/**
 * Nudge admins to run setup after activating the theme.
 */
function lumipix_setup_notice() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	if ( get_option( 'lumipix_setup_done' ) ) {
		if ( (int) get_option( 'lumipix_pack_rev_done', 1 ) < LUMIPIX_PACK_REV ) {
			$screen = get_current_screen();
			if ( $screen && 'appearance_page_lumipix-setup' === $screen->id ) {
				return;
			}
			printf(
				'<div class="notice notice-warning"><p><strong>%s</strong> %s <a class="button button-primary" href="%s">%s</a></p></div>',
				esc_html__( 'Lumi Pix update:', 'lumipix' ),
				esc_html__( 'this version adds new tools and content. Run Setup to create the new tool pages and refresh untouched content. Pages and posts you edited yourself are not changed.', 'lumipix' ),
				esc_url( admin_url( 'themes.php?page=lumipix-setup' ) ),
				esc_html__( 'Run setup', 'lumipix' )
			);
		}
		return;
	}
	$screen = get_current_screen();
	if ( $screen && 'appearance_page_lumipix-setup' === $screen->id ) {
		return;
	}
	printf(
		'<div class="notice notice-info"><p><strong>%s</strong> %s <a class="button button-primary" href="%s">%s</a></p></div>',
		esc_html__( 'Lumi Pix is active.', 'lumipix' ),
		esc_html__( 'Create the tool pages, blog and menus in one click.', 'lumipix' ),
		esc_url( admin_url( 'themes.php?page=lumipix-setup' ) ),
		esc_html__( 'Open setup', 'lumipix' )
	);
}
add_action( 'admin_notices', 'lumipix_setup_notice' );

/**
 * Register meta boxes.
 */
function lumipix_add_meta_boxes() {
	add_meta_box( 'lumipix_tool', __( 'Lumi Pix tool', 'lumipix' ), 'lumipix_tool_meta_box', 'page', 'side', 'high' );
	add_meta_box( 'lumipix_post', __( 'Lumi Pix', 'lumipix' ), 'lumipix_post_meta_box', 'post', 'side', 'default' );
}
add_action( 'add_meta_boxes', 'lumipix_add_meta_boxes' );

/**
 * Shared SEO fields.
 *
 * @param WP_Post $post Post.
 */
function lumipix_seo_fields( $post ) {
	if ( lumipix_seo_plugin_active() ) {
		return;
	}
	?>
	<p><label for="lumipix_seo_title"><strong><?php esc_html_e( 'SEO title', 'lumipix' ); ?></strong></label>
	<input type="text" class="widefat" id="lumipix_seo_title" name="lumipix_seo_title" value="<?php echo esc_attr( get_post_meta( $post->ID, '_lumipix_seo_title', true ) ); ?>" placeholder="<?php esc_attr_e( 'Defaults to the tool title', 'lumipix' ); ?>"></p>
	<p><label for="lumipix_seo_desc"><strong><?php esc_html_e( 'Meta description', 'lumipix' ); ?></strong></label>
	<textarea class="widefat" rows="3" id="lumipix_seo_desc" name="lumipix_seo_desc"><?php echo esc_textarea( get_post_meta( $post->ID, '_lumipix_seo_desc', true ) ); ?></textarea></p>
	<?php
}

/**
 * Tool picker on pages.
 *
 * @param WP_Post $post Post.
 */
function lumipix_tool_meta_box( $post ) {
	wp_nonce_field( 'lumipix_meta', 'lumipix_meta_nonce' );
	$current = get_post_meta( $post->ID, '_lumipix_tool', true );
	?>
	<p><label for="lumipix_tool_key"><?php esc_html_e( 'Show this tool at the top of the page', 'lumipix' ); ?></label></p>
	<select class="widefat" id="lumipix_tool_key" name="lumipix_tool_key">
		<option value=""><?php esc_html_e( '— None (normal page) —', 'lumipix' ); ?></option>
		<?php foreach ( lumipix_tools() as $key => $tool ) : ?>
			<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $current, $key ); ?>><?php echo esc_html( $tool['nav'] ); ?></option>
		<?php endforeach; ?>
	</select>
	<?php
	lumipix_seo_fields( $post );
}

/**
 * Related tool + SEO on posts.
 *
 * @param WP_Post $post Post.
 */
function lumipix_post_meta_box( $post ) {
	wp_nonce_field( 'lumipix_meta', 'lumipix_meta_nonce' );
	$current = get_post_meta( $post->ID, '_lumipix_related_tool', true );
	?>
	<p><label for="lumipix_related_tool"><strong><?php esc_html_e( 'Related tool', 'lumipix' ); ?></strong></label></p>
	<select class="widefat" id="lumipix_related_tool" name="lumipix_related_tool">
		<option value=""><?php esc_html_e( '— None —', 'lumipix' ); ?></option>
		<?php foreach ( lumipix_tools() as $key => $tool ) : ?>
			<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $current, $key ); ?>><?php echo esc_html( $tool['nav'] ); ?></option>
		<?php endforeach; ?>
	</select>
	<p class="description"><?php esc_html_e( 'Adds a tool card after the second paragraph and lists this article on the tool page.', 'lumipix' ); ?></p>
	<?php
	lumipix_seo_fields( $post );
}

/**
 * Save meta.
 *
 * @param int $post_id Post ID.
 */
function lumipix_save_meta( $post_id ) {
	if ( ! isset( $_POST['lumipix_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['lumipix_meta_nonce'] ) ), 'lumipix_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$fields = array(
		'lumipix_tool_key'     => '_lumipix_tool',
		'lumipix_related_tool' => '_lumipix_related_tool',
	);
	foreach ( $fields as $field => $meta ) {
		if ( isset( $_POST[ $field ] ) ) {
			$val = sanitize_key( wp_unslash( $_POST[ $field ] ) );
			if ( $val && lumipix_get_tool( $val ) ) {
				update_post_meta( $post_id, $meta, $val );
			} else {
				delete_post_meta( $post_id, $meta );
			}
		}
	}
	if ( isset( $_POST['lumipix_seo_title'] ) ) {
		update_post_meta( $post_id, '_lumipix_seo_title', sanitize_text_field( wp_unslash( $_POST['lumipix_seo_title'] ) ) );
	}
	if ( isset( $_POST['lumipix_seo_desc'] ) ) {
		update_post_meta( $post_id, '_lumipix_seo_desc', sanitize_textarea_field( wp_unslash( $_POST['lumipix_seo_desc'] ) ) );
	}
}
add_action( 'save_post', 'lumipix_save_meta' );
