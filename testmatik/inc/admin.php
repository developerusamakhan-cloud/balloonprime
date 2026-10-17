<?php
/**
 * Admin: setup screen and the "Testmatik" meta box (tool, SEO, intro, FAQs).
 *
 * @package Testmatik
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'admin_menu',
	function () {
		add_theme_page( 'Testmatik Kurulum', 'Testmatik Kurulum', 'manage_options', 'testmatik-setup', 'testmatik_setup_screen' );
	}
);

/** Setup screen. */
function testmatik_setup_screen() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$log = array();
	if ( isset( $_POST['testmatik_install'] ) && check_admin_referer( 'testmatik_install' ) ) {
		$log = testmatik_install();
	}
	$stored = get_transient( 'testmatik_install_log' );
	if ( ! $log && $stored ) {
		$log = $stored;
		delete_transient( 'testmatik_install_log' );
	}
	?>
	<div class="wrap">
		<h1>Testmatik Kurulum</h1>
		<p>Bu ekran içerik paketindeki araç sayfalarını, rehberleri, yasal sayfaları, kategorileri, ana sayfayı ve kalıcı bağlantıları oluşturur. <strong>Var olan ve sizin düzenlediğiniz içerik asla değiştirilmez.</strong> Dokunulmamış içerik, tema güncellemesiyle gelen yeni sürümle yenilenir.</p>
		<form method="post">
			<?php wp_nonce_field( 'testmatik_install' ); ?>
			<p><button class="button button-primary button-hero" name="testmatik_install" value="1">Eksikleri oluştur / içeriği yenile</button></p>
		</form>
		<?php if ( $log ) : ?>
			<h2>Sonuç</h2>
			<ul style="list-style:disc;padding-left:20px">
				<?php foreach ( $log as $line ) : ?>
					<li><?php echo esc_html( $line ); ?></li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
		<h2>Araç sayfaları</h2>
		<table class="widefat striped" style="max-width:820px">
			<thead><tr><th>Araç</th><th>Sayfa</th><th>Durum</th></tr></thead>
			<tbody>
			<?php foreach ( testmatik_tools() as $key => $tool ) : $id = testmatik_tool_page_id( $key ); ?>
				<tr>
					<td><?php echo esc_html( $tool['name'] ); ?></td>
					<td><?php echo $id ? '<a href="' . esc_url( get_permalink( $id ) ) . '" target="_blank" rel="noopener">' . esc_html( wp_parse_url( get_permalink( $id ), PHP_URL_PATH ) ) . '</a>' : '–'; ?></td>
					<td><?php echo $id ? '✔' : 'Eksik'; ?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		<h2>Önerilen sonraki adımlar</h2>
		<ol style="list-style:decimal;padding-left:20px;max-width:820px">
			<li><strong>Ayarlar → Genel → Site Dili</strong>: Türkçe seçin.</li>
			<li><strong>Rank Math</strong> kullanıyorsanız kurulum sihirbazını tamamlayın; başlık, açıklama ve odak anahtar kelimeler sayfalara zaten yazıldı.</li>
			<li><strong>Google Search Console</strong>'a siteyi ekleyin ve <code><?php echo esc_html( home_url( '/wp-sitemap.xml' ) ); ?></code> (veya Rank Math kullanıyorsanız <code>/sitemap_index.xml</code>) haritasını gönderin.</li>
			<li><strong>Görünüm → Özelleştir → Site Kimliği</strong>: site simgesini (favicon) yükleyin.</li>
			<li><strong>Görünüm → Özelleştir → Testmatik</strong>: iletişim e-postasını kontrol edin. Analytics/AdSense eklerseniz çerez bandı otomatik açılır.</li>
		</ol>
	</div>
	<?php
}

add_action(
	'admin_notices',
	function () {
		if ( ! current_user_can( 'manage_options' ) || get_option( 'testmatik_installed' ) ) {
			return;
		}
		$screen = get_current_screen();
		if ( $screen && 'appearance_page_testmatik-setup' === $screen->id ) {
			return;
		}
		printf(
			'<div class="notice notice-info"><p>%s <a class="button button-primary" href="%s">%s</a></p></div>',
			esc_html__( 'Testmatik teması hazır. Sayfaları ve içeriği tek tıkla oluşturun.', 'testmatik' ),
			esc_url( admin_url( 'themes.php?page=testmatik-setup' ) ),
			esc_html__( 'Kurulumu aç', 'testmatik' )
		);
	}
);

// Meta box on pages and posts.
add_action(
	'add_meta_boxes',
	function () {
		foreach ( array( 'page', 'post' ) as $type ) {
			add_meta_box( 'testmatik_meta', 'Testmatik', 'testmatik_meta_box', $type, 'normal', 'default' );
		}
	}
);

/**
 * Meta box markup.
 *
 * @param WP_Post $post Post.
 */
function testmatik_meta_box( $post ) {
	wp_nonce_field( 'testmatik_meta', 'testmatik_meta_nonce' );
	$tool  = (string) get_post_meta( $post->ID, '_testmatik_tool', true );
	$title = (string) get_post_meta( $post->ID, '_testmatik_seo_title', true );
	$desc  = (string) get_post_meta( $post->ID, '_testmatik_seo_desc', true );
	$intro = (string) get_post_meta( $post->ID, '_testmatik_intro', true );
	$lines = array();
	foreach ( testmatik_get_faqs( $post->ID ) as $f ) {
		$lines[] = $f['q'] . ' :: ' . $f['a'];
	}
	$plugin = testmatik_seo_plugin_active();
	?>
	<p>
		<label for="tm-tool"><strong><?php echo 'page' === $post->post_type ? 'Bu sayfada gösterilecek araç' : 'İlgili araç (makale içinde kart ve araç sayfasında liste)'; ?></strong></label><br>
		<select id="tm-tool" name="testmatik_tool">
			<option value="">— Yok —</option>
			<?php foreach ( testmatik_tools() as $key => $t ) : ?>
				<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $tool, $key ); ?>><?php echo esc_html( $t['name'] ); ?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<p><label for="tm-intro"><strong>Giriş metni</strong> (başlığın altında gösterilir)</label><br><textarea id="tm-intro" name="testmatik_intro" rows="2" style="width:100%"><?php echo esc_textarea( $intro ); ?></textarea></p>
	<?php if ( ! $plugin ) : ?>
		<p><label for="tm-title"><strong>SEO başlığı</strong></label><br><input id="tm-title" type="text" name="testmatik_seo_title" value="<?php echo esc_attr( $title ); ?>" style="width:100%"></p>
		<p><label for="tm-desc"><strong>Meta açıklama</strong> (140–158 karakter)</label><br><textarea id="tm-desc" name="testmatik_seo_desc" rows="2" style="width:100%"><?php echo esc_textarea( $desc ); ?></textarea></p>
	<?php else : ?>
		<p><em>SEO başlığı ve açıklaması SEO eklentiniz tarafından yönetiliyor.</em></p>
	<?php endif; ?>
	<p><label for="tm-faqs"><strong>SSS</strong> — her satıra bir soru: <code>Soru :: Cevap</code> (FAQPage şeması otomatik eklenir)</label><br><textarea id="tm-faqs" name="testmatik_faqs" rows="8" style="width:100%;font-family:monospace"><?php echo esc_textarea( implode( "\n", $lines ) ); ?></textarea></p>
	<?php
}

add_action(
	'save_post',
	function ( $post_id ) {
		if ( ! isset( $_POST['testmatik_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['testmatik_meta_nonce'] ) ), 'testmatik_meta' ) ) {
			return;
		}
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		$tool = isset( $_POST['testmatik_tool'] ) ? sanitize_key( wp_unslash( $_POST['testmatik_tool'] ) ) : '';
		if ( $tool && testmatik_get_tool( $tool ) ) {
			update_post_meta( $post_id, '_testmatik_tool', $tool );
			if ( 'page' === get_post_type( $post_id ) ) {
				delete_option( 'testmatik_tool_pages' );
			}
		} else {
			delete_post_meta( $post_id, '_testmatik_tool' );
		}
		if ( isset( $_POST['testmatik_intro'] ) ) {
			update_post_meta( $post_id, '_testmatik_intro', sanitize_textarea_field( wp_unslash( $_POST['testmatik_intro'] ) ) );
		}
		if ( isset( $_POST['testmatik_seo_title'] ) ) {
			update_post_meta( $post_id, '_testmatik_seo_title', sanitize_text_field( wp_unslash( $_POST['testmatik_seo_title'] ) ) );
		}
		if ( isset( $_POST['testmatik_seo_desc'] ) ) {
			update_post_meta( $post_id, '_testmatik_seo_desc', sanitize_textarea_field( wp_unslash( $_POST['testmatik_seo_desc'] ) ) );
		}
		if ( isset( $_POST['testmatik_faqs'] ) ) {
			$faqs = array();
			foreach ( preg_split( '/\r\n|\r|\n/', (string) wp_unslash( $_POST['testmatik_faqs'] ) ) as $line ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- sanitized per field below.
				$parts = array_map( 'trim', explode( '::', $line, 2 ) );
				if ( 2 === count( $parts ) && '' !== $parts[0] && '' !== $parts[1] ) {
					$faqs[] = array( 'q' => sanitize_text_field( $parts[0] ), 'a' => sanitize_text_field( $parts[1] ) );
				}
			}
			update_post_meta( $post_id, '_testmatik_faqs', $faqs );
		}
	}
);
