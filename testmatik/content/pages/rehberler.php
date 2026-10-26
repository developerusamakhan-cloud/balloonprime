<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'Rehberler',
	'seo_title'   => 'Donanım Sorunları İçin Çözüm Rehberleri | Testmatik',
	'description' => 'Klavye, ekran, mikrofon, kamera, mouse ve hoparlör sorunları için adım adım Türkçe çözüm rehberleri. Sorunu ücretsiz online testlerle doğrulayın.',
	'keywords'    => array( 'donanım sorunları çözüm', 'klavye sorunu çözümü', 'mikrofon sorunu çözümü', 'laptop sorunları', 'donanım testi rehberi' ),
	'intro'       => 'Klavye, ekran, mikrofon, kamera, mouse ve hoparlör sorunları için adım adım Türkçe çözüm rehberleri.',
	'html'        => <<<'HTML'
<h2>Bu rehberler kimin için?</h2>
<p>Bir tuş yazmıyor, mikrofon sesinizi iletmiyor ya da kamera siyah ekran veriyorsa ilk soru hep aynıdır: Sorun donanımda mı, ayarlarda mı? Rehberlerimiz bu soruya hızlı ve doğru yanıt bulmanız için hazırlandı. Her yazı, sorunu önce ücretsiz bir testle doğrulamanızı, ardından en basit çözümden en kapsamlısına doğru ilerlemenizi sağlar.</p>
<p>Yazılar Windows 11, macOS, Android ve iPhone için ayrı adımlar içerir. Teknik bilgi gerektirmez; menü yolları ve ayar adları ekranda gördüğünüz şekilde yazılmıştır.</p>

<h2>Önce test edin, sonra çözün</h2>
<p>Birçok sorun aslında bir ayardan kaynaklanır. Bu yüzden bir parçayı değiştirmeden veya servise götürmeden önce cihazı test etmek zaman ve para kazandırır:</p>
<ul>
<li><strong>Klavye:</strong> <a href="{tool:klavye-testi}">Klavye testi</a> ile hangi tuşların sinyal gönderdiğini görün, ardından <a href="{post:laptop-klavye-calismiyor}">laptop klavye çalışmıyor</a> rehberindeki adımları uygulayın.</li>
<li><strong>Ekran:</strong> <a href="{tool:olu-piksel-testi}">Ölü piksel testi</a> kusurlu pikselleri gösterir; <a href="{post:olu-piksel-nasil-duzeltilir}">ölü piksel nasıl düzeltilir</a> yazısı neyin onarılabileceğini anlatır.</li>
<li><strong>Ses:</strong> <a href="{tool:mikrofon-testi}">Mikrofon testi</a> ve <a href="{tool:hoparlor-testi}">hoparlör testi</a> ile giriş ve çıkışı ayrı ayrı kontrol edin; <a href="{post:mikrofon-calismiyor}">mikrofon çalışmıyor</a> rehberi Windows ayarlarını adım adım açıklar.</li>
<li><strong>Kamera ve mouse:</strong> <a href="{tool:kamera-testi}">Kamera testi</a> çözünürlüğü ve FPS değerini gösterir, <a href="{tool:mouse-testi}">mouse testi</a> çift tıklamayı yakalar. Ayrıntılar için <a href="{post:mouse-cift-tiklama-sorunu}">mouse çift tıklama sorunu</a> yazısına bakın.</li>
</ul>

<h2>Belirli bir sorun için</h2>
<ul>
<li><strong>Marka ve klavye düzeni:</strong> <a href="{post:lenovo-laptop-klavye-calismiyor}">Lenovo laptop klavye çalışmıyor</a>, <a href="{post:q-klavye-f-klavye-farki}">Q klavye ve F klavye farkı</a>, <a href="{post:klavye-ghosting-nedir}">klavye ghosting nedir</a>.</li>
<li><strong>Ekran ve kamera:</strong> <a href="{post:monitor-hz-ayarlama}">monitör Hz ayarlama</a>, <a href="{post:dokunmatik-ekran-testi}">dokunmatik ekran testi</a>, <a href="{post:web-kamera-goruntu-kalitesi}">web kamera görüntü kalitesi</a>, <a href="{post:laptop-kamera-calismiyor}">laptop kamera çalışmıyor</a>.</li>
<li><strong>Ses:</strong> <a href="{post:laptop-hoparlor-cizirti}">laptop hoparlör cızırtı</a>, <a href="{post:kulaklik-testi-sag-sol}">kulaklık sağ sol testi</a>, <a href="{post:kulaklik-mikrofon-calismiyor}">kulaklık mikrofonu çalışmıyor</a>, <a href="{post:telefon-mikrofon-calismiyor}">telefon mikrofonu çalışmıyor</a>.</li>
<li><strong>Mouse:</strong> <a href="{post:mouse-tekerlegi-sorunu}">mouse tekerleği sorunu</a>, <a href="{post:mouse-polling-rate-nedir}">mouse polling rate nedir</a>.</li>
</ul>

<h2>İkinci el cihaz alıyorsanız</h2>
<p>Kullanılmış bir laptop veya monitör alırken birkaç dakikalık kontrol, sonradan çıkabilecek masraflı sorunları önler. <a href="{post:ikinci-el-laptop-kontrol}">İkinci el laptop kontrol listesi</a>, tüm testleri satıcının yanında hangi sırayla yapmanız gerektiğini anlatır.</p>
<p>Yeni rehberler düzenli olarak eklenir. Aradığınız konuyu bulamazsanız <a href="{page:iletisim}">iletişim</a> sayfasından bize yazabilirsiniz.</p>
HTML
	,
	'faqs'        => array(
		array( 'q' => 'Rehberlerdeki çözümler hangi cihazlarda işe yarar?', 'a' => 'Yazılar Windows 11, macOS, Android ve iPhone için ayrı adımlar içerir. Marka ve modele göre değişen menüler için genel yolu verir, farklılık olabilecek yerleri ayrıca belirtiriz.' ),
		array( 'q' => 'Testler ve rehberler ücretli mi?', 'a' => 'Hayır. Tüm testler ve rehberler ücretsizdir; hesap açmanız veya program yüklemeniz gerekmez. Testler tamamen tarayıcınızda çalışır.' ),
		array( 'q' => 'Sorun donanımda mı ayarda mı nasıl anlarım?', 'a' => 'Önce ilgili testi yapın. Test cihazı algılıyorsa sorun büyük olasılıkla bir uygulama veya ayardan kaynaklanır. Test hiçbir sinyal göstermiyorsa bağlantıyı, sürücüyü ve donanımı kontrol etmeniz gerekir.' ),
		array( 'q' => 'Hangi sıklıkla yeni rehber ekleniyor?', 'a' => 'Kullanıcıların en çok aradığı sorunlara göre düzenli olarak yeni rehberler yayımlıyoruz. Önermek istediğiniz bir konu varsa iletişim sayfasından bize yazabilirsiniz.' ),
	),
);
