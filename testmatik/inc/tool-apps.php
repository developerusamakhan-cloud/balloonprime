<?php
/**
 * Tool UI markup. The behaviour lives in assets/js/tools/<script>.js.
 *
 * Every app works without a server: nothing is uploaded.
 *
 * @package Testmatik
 */

defined( 'ABSPATH' ) || exit;

/**
 * Render a tool app.
 *
 * @param string $key Tool key.
 * @return string
 */
function testmatik_render_tool_app( $key ) {
	$tool = testmatik_get_tool( $key );
	if ( ! $tool ) {
		return '';
	}
	$fn = 'testmatik_app_' . $tool['script'];
	if ( ! function_exists( $fn ) ) {
		return '';
	}
	ob_start();
	echo '<div class="app app--' . esc_attr( $tool['script'] ) . ' tone-' . esc_attr( $tool['tone'] ) . '" data-tm-app="' . esc_attr( $tool['script'] ) . '" data-tm-tool="' . esc_attr( $key ) . '">';
	echo '<noscript><p class="app__notice">' . esc_html__( 'Bu test için tarayıcınızda JavaScript açık olmalıdır.', 'testmatik' ) . '</p></noscript>';
	$fn();
	echo '</div>';
	return (string) ob_get_clean();
}

/**
 * Small stat tile.
 *
 * @param string $label Label.
 * @param string $ref   data-ref name.
 * @param string $value Initial value.
 */
function testmatik_stat( $label, $ref, $value = '–' ) {
	printf(
		'<div class="stat"><span class="stat__label">%1$s</span><span class="stat__value" data-ref="%2$s">%3$s</span></div>',
		esc_html( $label ),
		esc_attr( $ref ),
		esc_html( $value )
	);
}

/** Keyboard test. */
function testmatik_app_keyboard() {
	?>
	<div class="app__bar">
		<div class="seg" role="group" aria-label="<?php esc_attr_e( 'Klavye düzeni', 'testmatik' ); ?>">
			<button type="button" class="seg__btn is-active" data-layout="q" aria-pressed="true"><?php esc_html_e( 'Türkçe Q', 'testmatik' ); ?></button>
			<button type="button" class="seg__btn" data-layout="f" aria-pressed="false"><?php esc_html_e( 'Türkçe F', 'testmatik' ); ?></button>
		</div>
		<label class="switch"><input type="checkbox" data-ref="full" checked> <span><?php esc_html_e( 'Tam boy (numpad)', 'testmatik' ); ?></span></label>
		<button type="button" class="btn btn--ghost btn--sm" data-action="reset"><?php echo testmatik_icon( 'refresh', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Sıfırla', 'testmatik' ); ?></button>
	</div>
	<p class="app__hint" data-ref="hint"><?php echo testmatik_icon( 'keyboard', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span><?php esc_html_e( 'Başlamak için klavyenizde herhangi bir tuşa basın. Basılan tuş mavi, çalıştığı doğrulanan tuş yeşil olur.', 'testmatik' ); ?></span></p>
	<div class="kb-wrap" data-ref="board" tabindex="0" aria-label="<?php esc_attr_e( 'Sanal klavye', 'testmatik' ); ?>"></div>
	<div class="stats">
		<?php
		testmatik_stat( __( 'Test edilen tuş', 'testmatik' ), 'tested', '0' );
		testmatik_stat( __( 'Son tuş', 'testmatik' ), 'last' );
		testmatik_stat( __( 'Kod (code)', 'testmatik' ), 'code' );
		testmatik_stat( __( 'Aynı anda en çok', 'testmatik' ), 'max', '0' );
		?>
	</div>
	<div class="app__log"><p class="app__log-title"><?php esc_html_e( 'Son basılan tuşlar', 'testmatik' ); ?></p><ol data-ref="log"></ol></div>
	<p class="app__note"><?php echo testmatik_icon( 'info', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span><?php esc_html_e( 'Fn tuşu ve bazı medya tuşları donanım tarafından işlenir; hiçbir tarayıcı bunları göremez. Bu tuşların tepki vermemesi arıza anlamına gelmez.', 'testmatik' ); ?></span></p>
	<?php
}

/** Dead pixel test. */
function testmatik_app_pixel() {
	$colors = array(
		'#000000' => __( 'Siyah', 'testmatik' ),
		'#ffffff' => __( 'Beyaz', 'testmatik' ),
		'#ff0000' => __( 'Kırmızı', 'testmatik' ),
		'#00ff00' => __( 'Yeşil', 'testmatik' ),
		'#0000ff' => __( 'Mavi', 'testmatik' ),
		'#808080' => __( 'Gri', 'testmatik' ),
		'#00ffff' => __( 'Camgöbeği', 'testmatik' ),
		'#ff00ff' => __( 'Macenta', 'testmatik' ),
		'#ffff00' => __( 'Sarı', 'testmatik' ),
	);
	?>
	<div class="pixel-hero">
		<div class="pixel-swatches" aria-hidden="true">
			<?php foreach ( $colors as $hex => $name ) : ?>
				<span style="background:<?php echo esc_attr( $hex ); ?>"></span>
			<?php endforeach; ?>
		</div>
		<div class="pixel-hero__actions">
			<button type="button" class="btn btn--primary btn--lg" data-action="start"><?php echo testmatik_icon( 'expand', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Testi başlat (tam ekran)', 'testmatik' ); ?></button>
			<label class="switch"><input type="checkbox" data-ref="auto"> <span><?php esc_html_e( 'Otomatik (3 sn)', 'testmatik' ); ?></span></label>
		</div>
		<p class="app__hint"><?php echo testmatik_icon( 'info', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span><?php esc_html_e( 'Renk değiştirmek için tıklayın, dokunun veya ok tuşlarını / boşluk tuşunu kullanın. Çıkmak için Esc.', 'testmatik' ); ?></span></p>
	</div>
	<div class="pixel-colors" role="group" aria-label="<?php esc_attr_e( 'Bir renkle başlat', 'testmatik' ); ?>">
		<?php $i = 0; foreach ( $colors as $hex => $name ) : ?>
			<button type="button" class="pixel-chip" data-color-index="<?php echo (int) $i++; ?>"><span style="background:<?php echo esc_attr( $hex ); ?>"></span><?php echo esc_html( $name ); ?></button>
		<?php endforeach; ?>
	</div>
	<div class="fixer">
		<div class="fixer__head">
			<span class="fixer__icon"><?php echo testmatik_icon( 'zap', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
			<div>
				<h3 class="fixer__title"><?php esc_html_e( 'Piksel onarıcı', 'testmatik' ); ?></h3>
				<p><?php esc_html_e( 'Hızla renk değiştiren kareyi sıkışmış pikselin üzerine sürükleyin ve 10–30 dakika bekleyin.', 'testmatik' ); ?></p>
			</div>
		</div>
		<div class="callout callout--warn"><?php echo testmatik_icon( 'alert', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><p><strong><?php esc_html_e( 'Işığa duyarlı epilepsi uyarısı:', 'testmatik' ); ?></strong> <?php esc_html_e( 'Onarıcı hızlı yanıp sönen renkler gösterir. Işığa duyarlılığınız varsa kullanmayın ve çalışırken ekrana bakmayın.', 'testmatik' ); ?></p></div>
		<label class="check"><input type="checkbox" data-ref="consent"> <span><?php esc_html_e( 'Uyarıyı okudum ve anladım.', 'testmatik' ); ?></span></label>
		<div class="fixer__actions">
			<button type="button" class="btn btn--dark" data-action="fixer" disabled><?php esc_html_e( 'Onarıcıyı aç', 'testmatik' ); ?></button>
			<label class="range"><span><?php esc_html_e( 'Kare boyutu', 'testmatik' ); ?></span><input type="range" min="40" max="300" value="120" data-ref="fixsize"></label>
		</div>
	</div>
	<div class="pixel-stage" data-ref="stage" hidden tabindex="-1">
		<div class="pixel-stage__hud" data-ref="hud"><span data-ref="cname"></span><span><?php esc_html_e( 'Tıkla / ok tuşları: değiştir · A: otomatik · Esc: çıkış', 'testmatik' ); ?></span></div>
		<button type="button" class="pixel-stage__close" data-action="exit" aria-label="<?php esc_attr_e( 'Testi kapat', 'testmatik' ); ?>"><?php echo testmatik_icon( 'close', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></button>
	</div>
	<div class="fixer-box" data-ref="fixbox" hidden><canvas width="120" height="120" data-ref="fixcanvas"></canvas><button type="button" data-action="fixclose" aria-label="<?php esc_attr_e( 'Onarıcıyı kapat', 'testmatik' ); ?>"><?php echo testmatik_icon( 'close', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></button></div>
	<script type="application/json" data-ref="colors"><?php echo wp_json_encode( array_map( null, array_keys( $colors ), array_values( $colors ) ) ); ?></script>
	<?php
}

/** Microphone test. */
function testmatik_app_mic() {
	?>
	<div class="app__bar">
		<button type="button" class="btn btn--primary" data-action="start"><?php echo testmatik_icon( 'mic', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span data-ref="startlabel"><?php esc_html_e( 'Mikrofonu başlat', 'testmatik' ); ?></span></button>
		<label class="select"><span class="visually-hidden"><?php esc_html_e( 'Mikrofon seçin', 'testmatik' ); ?></span><select data-ref="device" disabled><option><?php esc_html_e( 'Önce izin verin', 'testmatik' ); ?></option></select></label>
		<label class="switch"><input type="checkbox" data-ref="nr"> <span><?php esc_html_e( 'Gürültü engelleme', 'testmatik' ); ?></span></label>
	</div>
	<p class="app__hint" data-ref="hint"><?php echo testmatik_icon( 'lock', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span><?php esc_html_e( 'Tarayıcınız mikrofon izni isteyecek. Ses cihazınızda kalır, hiçbir yere gönderilmez.', 'testmatik' ); ?></span></p>
	<div class="meter" aria-hidden="true"><div class="meter__fill" data-ref="fill"></div><div class="meter__peak" data-ref="peak"></div><div class="meter__scale"><span>-60</span><span>-40</span><span>-20</span><span>-10</span><span>0 dB</span></div></div>
	<canvas class="scope" data-ref="scope" width="960" height="180" aria-label="<?php esc_attr_e( 'Ses dalgası', 'testmatik' ); ?>"></canvas>
	<div class="stats">
		<?php
		testmatik_stat( __( 'Seviye', 'testmatik' ), 'level' );
		testmatik_stat( __( 'Tepe', 'testmatik' ), 'peakv' );
		testmatik_stat( __( 'Örnekleme hızı', 'testmatik' ), 'rate' );
		testmatik_stat( __( 'Kanal', 'testmatik' ), 'channels' );
		?>
	</div>
	<p class="app__device" data-ref="label"></p>
	<div class="recorder">
		<button type="button" class="btn btn--dark" data-action="record" disabled><?php echo testmatik_icon( 'play', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span data-ref="reclabel"><?php esc_html_e( '5 saniye kaydet', 'testmatik' ); ?></span></button>
		<audio controls data-ref="audio" hidden></audio>
	</div>
	<p class="app__status" data-ref="status" role="status" aria-live="polite"></p>
	<?php
}

/** Camera test. */
function testmatik_app_camera() {
	?>
	<div class="app__bar">
		<button type="button" class="btn btn--primary" data-action="start"><?php echo testmatik_icon( 'camera', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span data-ref="startlabel"><?php esc_html_e( 'Kamerayı başlat', 'testmatik' ); ?></span></button>
		<label class="select"><span class="visually-hidden"><?php esc_html_e( 'Kamera seçin', 'testmatik' ); ?></span><select data-ref="device" disabled><option><?php esc_html_e( 'Önce izin verin', 'testmatik' ); ?></option></select></label>
		<div class="seg" role="group" aria-label="<?php esc_attr_e( 'Çözünürlük isteği', 'testmatik' ); ?>">
			<button type="button" class="seg__btn is-active" data-res="720" aria-pressed="true">720p</button>
			<button type="button" class="seg__btn" data-res="1080" aria-pressed="false">1080p</button>
			<button type="button" class="seg__btn" data-res="2160" aria-pressed="false">4K</button>
		</div>
	</div>
	<div class="cam">
		<video data-ref="video" playsinline muted autoplay></video>
		<div class="cam__empty" data-ref="empty"><?php echo testmatik_icon( 'camera', 40 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><p><?php esc_html_e( 'Kamera kapalı. Başlatınca tarayıcınız izin isteyecek; görüntü cihazınızdan çıkmaz.', 'testmatik' ); ?></p></div>
	</div>
	<div class="app__bar app__bar--end">
		<label class="switch"><input type="checkbox" data-ref="mirror" checked> <span><?php esc_html_e( 'Ayna görüntü', 'testmatik' ); ?></span></label>
		<button type="button" class="btn btn--ghost btn--sm" data-action="snap" disabled><?php echo testmatik_icon( 'download', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Fotoğraf çek', 'testmatik' ); ?></button>
		<button type="button" class="btn btn--ghost btn--sm" data-action="stop" disabled><?php echo testmatik_icon( 'stop', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Durdur', 'testmatik' ); ?></button>
	</div>
	<div class="stats">
		<?php
		testmatik_stat( __( 'Çözünürlük', 'testmatik' ), 'res' );
		testmatik_stat( __( 'FPS (ölçülen)', 'testmatik' ), 'fps' );
		testmatik_stat( __( 'En-boy oranı', 'testmatik' ), 'aspect' );
		testmatik_stat( __( 'Megapiksel', 'testmatik' ), 'mp' );
		?>
	</div>
	<p class="app__device" data-ref="label"></p>
	<p class="app__status" data-ref="status" role="status" aria-live="polite"></p>
	<?php
}

/** Mouse test. */
function testmatik_app_mouse() {
	$buttons = array(
		0 => __( 'Sol tık', 'testmatik' ),
		1 => __( 'Orta (tekerlek)', 'testmatik' ),
		2 => __( 'Sağ tık', 'testmatik' ),
		3 => __( 'Geri (yan tuş)', 'testmatik' ),
		4 => __( 'İleri (yan tuş)', 'testmatik' ),
	);
	?>
	<div class="mouse-grid">
		<div class="mouse-area" data-ref="area" tabindex="0" aria-label="<?php esc_attr_e( 'Mouse test alanı', 'testmatik' ); ?>">
			<svg class="mouse-svg" viewBox="0 0 160 240" aria-hidden="true">
				<path class="m-body" d="M80 6c38 0 66 30 66 72v80c0 42-28 76-66 76S14 200 14 158V78C14 36 42 6 80 6Z"/>
				<path class="m-btn" data-btn="0" d="M78 8C42 9 16 38 16 78v14h62V8Z"/>
				<path class="m-btn" data-btn="2" d="M82 8c36 1 62 30 62 70v14H82V8Z"/>
				<rect class="m-btn m-wheel" data-btn="1" x="72" y="30" width="16" height="38" rx="8"/>
				<path class="m-scroll" data-scroll="up" d="M80 22l-6 6h12z"/>
				<path class="m-scroll" data-scroll="down" d="M80 76l-6-6h12z"/>
				<rect class="m-btn" data-btn="4" x="8" y="100" width="10" height="26" rx="4"/>
				<rect class="m-btn" data-btn="3" x="8" y="132" width="10" height="26" rx="4"/>
			</svg>
			<p class="mouse-area__hint"><?php esc_html_e( 'İmleci bu alana getirip tüm tuşlara basın, tekerleği çevirin.', 'testmatik' ); ?></p>
		</div>
		<div class="mouse-side">
			<ul class="btn-list">
				<?php foreach ( $buttons as $b => $label ) : ?>
					<li data-row="<?php echo (int) $b; ?>"><span class="dot"></span><span class="btn-list__name"><?php echo esc_html( $label ); ?></span><span class="btn-list__count" data-count="<?php echo (int) $b; ?>">0</span><span class="btn-list__chatter" data-chatter="<?php echo (int) $b; ?>" title="<?php esc_attr_e( 'Şüpheli çift tıklama', 'testmatik' ); ?>"></span></li>
				<?php endforeach; ?>
				<li><span class="dot dot--scroll"></span><span class="btn-list__name"><?php esc_html_e( 'Tekerlek yukarı / aşağı', 'testmatik' ); ?></span><span class="btn-list__count" data-ref="scroll">0 / 0</span></li>
			</ul>
			<label class="range"><span><?php esc_html_e( 'Çift tıklama eşiği', 'testmatik' ); ?> <b data-ref="thrv">80 ms</b></span><input type="range" min="20" max="200" step="5" value="80" data-ref="thr"></label>
		</div>
	</div>
	<div class="alert alert--danger" data-ref="chatteralert" hidden><?php echo testmatik_icon( 'alert', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span data-ref="chattertext"></span></div>
	<div class="stats">
		<?php
		testmatik_stat( __( 'Polling rate (Hz)', 'testmatik' ), 'hz', '0' );
		testmatik_stat( __( 'En yüksek Hz', 'testmatik' ), 'hzmax', '0' );
		testmatik_stat( __( 'Şüpheli çift tıklama', 'testmatik' ), 'chatter', '0' );
		testmatik_stat( __( 'Son iki tık arası', 'testmatik' ), 'gap' );
		?>
	</div>
	<div class="cps">
		<div>
			<h3 class="cps__title"><?php esc_html_e( 'CPS testi (5 saniye)', 'testmatik' ); ?></h3>
			<p><?php esc_html_e( 'Başlata basın ve kutuya 5 saniye boyunca olabildiğince hızlı sol tıklayın.', 'testmatik' ); ?></p>
		</div>
		<button type="button" class="cps__pad" data-ref="cpspad"><span data-ref="cpsmain"><?php esc_html_e( 'Başlat', 'testmatik' ); ?></span><small data-ref="cpssub"><?php esc_html_e( 'Tıklayarak başlayın', 'testmatik' ); ?></small></button>
	</div>
	<div class="app__bar app__bar--end"><button type="button" class="btn btn--ghost btn--sm" data-action="reset"><?php echo testmatik_icon( 'refresh', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Sıfırla', 'testmatik' ); ?></button></div>
	<?php
}

/** Speaker test. */
function testmatik_app_speaker() {
	?>
	<div class="callout callout--warn"><?php echo testmatik_icon( 'alert', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><p><strong><?php esc_html_e( 'Önce sesi kısın.', 'testmatik' ); ?></strong> <?php esc_html_e( 'Özellikle kulaklıkla teste düşük seviyeden başlayın ve yavaşça artırın.', 'testmatik' ); ?></p></div>
	<label class="range range--wide"><span><?php esc_html_e( 'Ses seviyesi', 'testmatik' ); ?> <b data-ref="volv">30%</b></span><input type="range" min="0" max="100" value="30" data-ref="vol"></label>
	<div class="channels">
		<button type="button" class="channel" data-pan="-1"><?php echo testmatik_icon( 'speaker', 28 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><strong><?php esc_html_e( 'Sol', 'testmatik' ); ?></strong><small><?php esc_html_e( 'Sadece sol kanal', 'testmatik' ); ?></small></button>
		<button type="button" class="channel" data-pan="0"><?php echo testmatik_icon( 'speaker', 28 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><strong><?php esc_html_e( 'Her iki', 'testmatik' ); ?></strong><small><?php esc_html_e( 'Stereo, ortada', 'testmatik' ); ?></small></button>
		<button type="button" class="channel" data-pan="1"><?php echo testmatik_icon( 'speaker', 28 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><strong><?php esc_html_e( 'Sağ', 'testmatik' ); ?></strong><small><?php esc_html_e( 'Sadece sağ kanal', 'testmatik' ); ?></small></button>
	</div>
	<div class="sweep">
		<div class="sweep__head">
			<div>
				<h3><?php esc_html_e( 'Frekans taraması', 'testmatik' ); ?></h3>
				<p><?php esc_html_e( '20 Hz’den 20 kHz’e 20 saniyede yükselir. Sesi duymayı bıraktığınız noktayı not edin.', 'testmatik' ); ?></p>
			</div>
			<button type="button" class="btn btn--primary" data-action="sweep"><?php echo testmatik_icon( 'play', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span data-ref="sweeplabel"><?php esc_html_e( 'Taramayı başlat', 'testmatik' ); ?></span></button>
		</div>
		<div class="sweep__track"><div class="sweep__fill" data-ref="sweepfill"></div></div>
		<p class="sweep__freq"><span data-ref="sweepfreq">20 Hz</span></p>
	</div>
	<div class="tone">
		<h3><?php esc_html_e( 'Ton üreteci', 'testmatik' ); ?></h3>
		<div class="tone__row">
			<label class="range range--wide"><span><?php esc_html_e( 'Frekans', 'testmatik' ); ?> <b data-ref="freqv">440 Hz</b></span><input type="range" min="0" max="1000" value="500" data-ref="freq"></label>
			<label class="select"><span class="visually-hidden"><?php esc_html_e( 'Dalga şekli', 'testmatik' ); ?></span><select data-ref="wave"><option value="sine"><?php esc_html_e( 'Sinüs', 'testmatik' ); ?></option><option value="square"><?php esc_html_e( 'Kare', 'testmatik' ); ?></option><option value="triangle"><?php esc_html_e( 'Üçgen', 'testmatik' ); ?></option><option value="sawtooth"><?php esc_html_e( 'Testere', 'testmatik' ); ?></option></select></label>
			<button type="button" class="btn btn--dark" data-action="tone"><?php echo testmatik_icon( 'play', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span data-ref="tonelabel"><?php esc_html_e( 'Çal', 'testmatik' ); ?></span></button>
		</div>
		<div class="presets" role="group" aria-label="<?php esc_attr_e( 'Hazır frekanslar', 'testmatik' ); ?>">
			<?php foreach ( array( 50, 100, 440, 1000, 5000, 10000, 15000 ) as $hz ) : ?>
				<button type="button" class="chip" data-hz="<?php echo (int) $hz; ?>"><?php echo esc_html( $hz >= 1000 ? ( $hz / 1000 ) . ' kHz' : $hz . ' Hz' ); ?></button>
			<?php endforeach; ?>
		</div>
	</div>
	<p class="app__status" data-ref="status" role="status" aria-live="polite"></p>
	<?php
}
