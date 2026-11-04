<?php
/**
 * Tool registry: one entry per test page.
 *
 * Extend with the `testmatik_tools` filter from a child theme or plugin.
 *
 * @package Testmatik
 */

defined( 'ABSPATH' ) || exit;

/**
 * All tools, keyed by slug.
 *
 * @return array
 */
function testmatik_tools() {
	static $tools = null;
	if ( null !== $tools ) {
		return $tools;
	}
	$tools = apply_filters(
		'testmatik_tools',
		array(
			'klavye-testi'     => array(
				'name'     => 'Klavye Testi',
				'short'    => 'Klavye',
				'icon'     => 'keyboard',
				'tone'     => 'indigo',
				'script'   => 'keyboard',
				'category' => 'Klavye',
				'blurb'    => 'Her tuşu tek tek kontrol edin. Türkçe Q ve F düzeni, ghosting ve NKRO ölçümü.',
				'tags'     => array( 'Q klavye', 'F klavye', 'NKRO' ),
				'keywords' => 'klavye tuş q f keyboard ghosting nkro',
				'method'   => 'Tarayıcının klavye olaylarını (keydown ve keyup) dinler. Her tuş, ekrandaki harften bağımsız olarak fiziksel konumunu belirten code değeriyle eşleştirilir; bu yüzden Q ve F düzeni arasında geçiş yapsanız da aynı fiziksel tuş yanar. Basılı tuş mavi görünür, en az bir kez sinyal göndermiş tuş yeşile döner. "Aynı anda en çok" değeri, aynı anda basılı tutulan ve henüz bırakılmamış tuşların en yüksek sayısıdır; ghosting ve NKRO sınırını bu sayı gösterir. Fn ve bazı medya tuşları klavye denetleyicisinde işlendiği için tarayıcıya hiç ulaşmaz, bu yüzden testte görünmemeleri arıza anlamına gelmez. Tuş vuruşları hiçbir yere gönderilmez ve sayfayı yenilediğinizde silinir.',
			),
			'klavye-hiz-testi' => array(
				'name'     => 'Klavye Hız Testi',
				'short'    => 'Hız',
				'icon'     => 'clock',
				'tone'     => 'sky',
				'script'   => 'typing',
				'category' => 'Klavye',
				'blurb'    => 'Dakikada kaç kelime yazdığınızı ölçün. 1, 3 veya 5 dakika, Türkçe kelimelerle.',
				'tags'     => array( 'Kelime/dk', '10 parmak', 'Katiplik' ),
				'keywords' => 'klavye hız testi yazma hızı kelime dakika 10 parmak on parmak katiplik wpm',
				'method'   => 'Kelimeler, sık kullanılan Türkçe kelimelerden oluşan bir listeden her denemede rastgele seçilir. Süre ilk harfi yazdığınız anda başlar. Boşluğa bastığınızda yazdığınız kelime ekrandakiyle harfi harfine karşılaştırılır; Türkçe karakterler dahil tam eşleşme gerekir. Net kelime/dakika, doğru kelime sayısının geçen dakikaya bölünmesidir. Vuruş/dakika, doğru kelimelerdeki harflere her kelime için bir boşluk eklenip dakikaya bölünmesiyle bulunur. Doğruluk, doğru kelimelerin yazılan tüm kelimelere oranıdır. Hatalı kelimeler hız hesabına girmez ve metin yapıştırma kapalıdır. En iyi sonucunuz yalnızca tarayıcınızın yerel depolamasında tutulur, hiçbir sunucuya gönderilmez.',
			),
			'olu-piksel-testi' => array(
				'name'     => 'Ölü Piksel Testi',
				'short'    => 'Ekran',
				'icon'     => 'monitor',
				'tone'     => 'rose',
				'script'   => 'pixel',
				'category' => 'Ekran',
				'blurb'    => 'Tam ekran renklerle ölü ve sıkışmış pikselleri bulun, piksel onarıcıyı deneyin.',
				'tags'     => array( 'Monitör', 'Laptop', 'Telefon' ),
				'keywords' => 'ölü piksel ekran monitör sıkışmış piksel dead pixel',
				'method'   => 'Ekranı tam ekran modunda tek bir düz renkle doldurur: siyah, beyaz, kırmızı, yeşil, mavi, gri, camgöbeği, macenta ve sarı. Düz renk, ekrandaki tüm pikselleri aynı değeri göstermeye zorlar; bu sayede çevresinden farklı kalan nokta kolayca görülür. Siyah zeminde parlayan nokta genellikle sıkışmış piksel, beyaz zeminde karanlık kalan nokta ise ölü pikseldir. Otomatik mod rengi 3 saniyede bir değiştirir. Piksel onarıcı, sürüklediğiniz küçük karenin rengini 50 milisaniyede bir, yani saniyede yaklaşık 20 kez değiştirir. Bu yöntem bazı sıkışmış piksellerde işe yarar, ölü piksellerde ise genellikle sonuç vermez. Test, ekranınız hakkında hiçbir bilgi okumaz ve göndermez.',
			),
			'mikrofon-testi'   => array(
				'name'     => 'Mikrofon Testi',
				'short'    => 'Mikrofon',
				'icon'     => 'mic',
				'tone'     => 'emerald',
				'script'   => 'mic',
				'category' => 'Ses',
				'blurb'    => 'Ses seviyesini canlı görün, 5 saniye kaydedip kendinizi dinleyin.',
				'tags'     => array( 'Kulaklık', 'USB', 'Laptop' ),
				'keywords' => 'mikrofon ses kayıt kulaklık mic',
				'method'   => 'Mikrofon sesini tarayıcının ses arayüzüyle (Web Audio) okur. Ses seviyesi, her ekran karesinde 2048 örneklik bir pencerenin RMS değerinden, yani ortalama gücünden hesaplanır ve desibel olarak gösterilir. Bu ölçekte 0 dB mikrofonun kaydedebileceği en yüksek seviyedir, sessizlik ise eksi sonsuza yaklaşır; normal konuşma genellikle -30 ile -10 dB arasında görünür. Tepe değeri, aynı penceredeki en yüksek anlık örnektir. 5 saniyelik kayıt tarayıcının kayıt özelliğiyle yalnızca cihazınızın belleğinde tutulur ve sayfadan ayrıldığınızda silinir. Gürültü engelleme düğmesi tarayıcının kendi ses işlemesini açıp kapatır. Sesiniz hiçbir sunucuya gönderilmez.',
			),
			'kamera-testi'     => array(
				'name'     => 'Kamera Testi',
				'short'    => 'Kamera',
				'icon'     => 'camera',
				'tone'     => 'sky',
				'script'   => 'camera',
				'category' => 'Kamera',
				'blurb'    => 'Web kameranızı açın; gerçek çözünürlüğü, FPS değerini ve görüntü kalitesini görün.',
				'tags'     => array( 'Webcam', '1080p', 'FPS' ),
				'keywords' => 'kamera webcam web kamera çözünürlük fps',
				'method'   => 'Kameranızı tarayıcı izniyle açar ve görüntüyü yalnızca bu sayfada gösterir. Gösterilen çözünürlük, kameranın o anda gerçekten gönderdiği görüntü boyutudur ve tarayıcının bildirdiği değerden okunur; kutudaki ya da ilandaki değerden değil. FPS, ekrana gelen kareler sayılarak ölçülür: destekleyen tarayıcılarda her yeni kamera karesi tek tek sayılır, diğerlerinde ekran yenilemesine göre yaklaşık bir değer hesaplanır. Düşük ışıkta birçok kamera pozlama süresini uzatır ve FPS düşer; bu bir arıza değildir. Fotoğraf çekme özelliği görüntüyü yalnızca cihazınıza kaydeder. Görüntünüz hiçbir yere yüklenmez ve kaydedilmez.',
			),
			'mouse-testi'      => array(
				'name'     => 'Mouse Testi',
				'short'    => 'Mouse',
				'icon'     => 'mouse',
				'tone'     => 'amber',
				'script'   => 'mouse',
				'category' => 'Mouse',
				'blurb'    => 'Tıklamaları, tekerleği ve yan tuşları sınayın; çift tıklama sorununu yakalayın.',
				'tags'     => array( 'Çift tıklama', 'Hz', 'CPS' ),
				'keywords' => 'mouse fare tıklama çift tıklama double click hz cps',
				'method'   => 'Fare tuşlarını tarayıcının işaretçi olaylarıyla izler; sol, orta, sağ, geri ve ileri tuşları ayrı ayrı sayılır. Çift tıklama dedektörü, aynı tuşa yapılan iki basış arasındaki süreyi milisaniye düzeyinde ölçer. Bu süre eşikten (varsayılan 80 ms) kısaysa basış şüpheli sayılır, çünkü parmakla bilerek bu kadar hızlı iki kez basmak çok zordur. Eşiği 20 ile 200 ms arasında değiştirebilirsiniz. Polling rate, fare hareket ederken her yarım saniyede gelen hareket olaylarının sayılmasıyla tahmin edilir; tarayıcı destekliyorsa işlenmemiş ham olaylar kullanılır. Tarayıcı ve sistem olayları birleştirebildiği için bu değer bir tahmindir. CPS testi, 5 saniyedeki sol tıklama sayısını süreye böler.',
			),
			'hoparlor-testi'   => array(
				'name'     => 'Hoparlör Testi',
				'short'    => 'Hoparlör',
				'icon'     => 'speaker',
				'tone'     => 'violet',
				'script'   => 'speaker',
				'category' => 'Ses',
				'blurb'    => 'Sol ve sağ kanalı ayrı dinleyin, 20 Hz ile 20 kHz arası frekans taraması yapın.',
				'tags'     => array( 'Sağ / sol', 'Frekans', 'Kulaklık' ),
				'keywords' => 'hoparlör kulaklık ses sağ sol stereo frekans',
				'method'   => 'Test seslerini tarayıcının ses üreteciyle (Web Audio osilatörü) anında üretir; hiçbir ses dosyası indirilmez. Sol ve sağ testlerinde ses, stereo kaydırma ile yalnızca bir kanala gönderilir; sesi ters taraftan duyuyorsanız kablolama, kulaklığın takılışı veya sistem ayarı ters olabilir. Frekans taraması 20 saniye içinde 20 Hz\'den 20.000 Hz\'e logaritmik olarak yükselir, böylece bas, orta ve tiz bölgelerin her birine yeterli süre ayrılır. Ton üreteci seçtiğiniz frekansta sabit bir ton çalar. Çok düşük ve çok yüksek frekansları duymamak çoğu zaman hoparlörün ya da insan kulağının sınırıdır. Kulaklıkla test ederken sesi düşük seviyede başlatın.',
			),
		)
	);
	return $tools;
}

/**
 * One tool, or null.
 *
 * @param string $key Tool key.
 * @return array|null
 */
function testmatik_get_tool( $key ) {
	$tools = testmatik_tools();
	return isset( $tools[ $key ] ) ? $tools[ $key ] : null;
}

/**
 * Map of tool key => page ID (stored by the installer, repaired on demand).
 *
 * @return array
 */
function testmatik_tool_pages() {
	$map = get_option( 'testmatik_tool_pages', array() );
	return is_array( $map ) ? $map : array();
}

/**
 * Page ID for a tool, or 0.
 *
 * @param string $key Tool key.
 * @return int
 */
function testmatik_tool_page_id( $key ) {
	$map = testmatik_tool_pages();
	$id  = isset( $map[ $key ] ) ? (int) $map[ $key ] : 0;
	if ( $id && 'publish' === get_post_status( $id ) ) {
		return $id;
	}
	$found = get_posts(
		array(
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'meta_key'       => '_testmatik_tool', // phpcs:ignore WordPress.DB.SlowDBQuery
			'meta_value'     => $key, // phpcs:ignore WordPress.DB.SlowDBQuery
			'posts_per_page' => 1,
			'fields'         => 'ids',
			'no_found_rows'  => true,
		)
	);
	if ( $found ) {
		$map[ $key ] = (int) $found[0];
		update_option( 'testmatik_tool_pages', $map, false );
		return (int) $found[0];
	}
	return 0;
}

/**
 * Permalink of a tool page, or empty string.
 *
 * @param string $key Tool key.
 * @return string
 */
function testmatik_tool_url( $key ) {
	$id = testmatik_tool_page_id( $key );
	return $id ? get_permalink( $id ) : '';
}

/**
 * Tool key shown on the current (or given) page, or empty string.
 *
 * @param int $post_id Post ID.
 * @return string
 */
function testmatik_page_tool( $post_id = 0 ) {
	$post_id = $post_id ? $post_id : get_queried_object_id();
	if ( ! $post_id ) {
		return '';
	}
	$key = (string) get_post_meta( $post_id, '_testmatik_tool', true );
	return ( $key && testmatik_get_tool( $key ) ) ? $key : '';
}
