<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'Telefonda Kamera Açılmıyor? Android İçin Adım Adım Çözüm',
	'seo_title'   => 'Telefonda Kamera Açılmıyor: Android Çözümleri | Testmatik',
	'description' => 'Telefonda kamera açılmıyor veya siyah ekran mı veriyor? Samsung, Xiaomi ve diğer Android telefonlarda izin, önbellek ve donanım kontrolünü adım adım yapın.',
	'keywords'    => array( 'telefonda kamera açılmıyor', 'samsung kamera açılmıyor', 'xiaomi kamera açılmıyor', 'telefonda ön kamera açılmıyor', 'redmi kamera açılmıyor' ),
	'intro'       => 'Kamera uygulaması açılıp kapanıyor, siyah ekran veriyor ya da hiç açılmıyorsa sorunun çoğu zaman bir izin, dolu önbellek veya arka planda kamerayı tutan başka bir uygulama olduğunu görürsünüz.',
	'excerpt'     => 'Android telefonda kamera açılmıyorsa önce kameranın gerçekten çalışıp çalışmadığını test edin, sonra izinleri, önbelleği ve kamerayı kullanan diğer uygulamaları sırayla kontrol edin.',
	'category'    => 'Kamera',
	'tool'        => 'kamera-testi',
	'date'        => '2026-11-06 07:00:00',
	'html'        => <<<'HTML'
<p>Telefonda kamera açılmıyor sorunu genellikle üç şekilde karşınıza çıkar: kamera uygulaması açılır açılmaz kapanır, uygulama açılır ama ekran siyah kalır ya da "kamera başarısız" benzeri bir hata çıkar. Bu üç durumun nedeni çoğu zaman yazılımdır. Kameranın kendisi bozulmuş olsa bile önce yazılım tarafını elemek gerekir, çünkü servise gitmeden çözülebilecek bir şeyi parça değişimiyle çözmeye çalışmak hem para hem zaman kaybıdır.</p>
<p>Aşağıdaki adımlar Samsung, Xiaomi, Redmi, Oppo, realme ve diğer Android telefonlar için geçerlidir. Menü adları markaya göre biraz değişebilir; farklı olabilecek yerleri ayrıca belirttik. iPhone kullanıyorsanız <a href="{post:iphone-kamera-acilmiyor}">iPhone kamera açılmıyor</a> rehberine geçin.</p>

<h2>1. Önce sorun kamerada mı uygulamada mı, bunu ayırın</h2>
<p>İlk soru şu: Kamera hiçbir uygulamada mı açılmıyor, yoksa sadece tek bir uygulamada mı? WhatsApp, Instagram veya görüntülü görüşme uygulamasında kamera açılmıyor ama telefonun kendi kamera uygulaması çalışıyorsa sorun büyük olasılıkla o uygulamanın izinlerindedir. Hiçbir yerde açılmıyorsa sistem ya da donanım tarafına bakmak gerekir.</p>
<p>Bu ayrımı hızlıca yapmanın bir yolu da tarayıcıdan kamera testi açmaktır. Chrome ile <a href="{tool:kamera-testi}">online kamera testi</a> sayfasını açıp izin verin. Görüntü geliyorsa kamera donanımı ve sürücüsü çalışıyor demektir; sorun kamera uygulamasında veya bir uygulamanın izninde aranmalıdır. Test ön ve arka kamerayı da ayrı ayrı seçmenize izin verir.</p>

<div class="tm-cta" data-tool="kamera-testi"></div>

<h2>2. Telefonu yeniden başlatın</h2>
<p>Basit görünse de en sık işe yarayan adım budur. Kamera bir uygulama tarafından açık bırakılmışsa ve o uygulama arka planda takılı kalmışsa, kamerayı başka hiçbir uygulama kullanamaz. Yeniden başlatma bu kilidi kaldırır. Telefonu kapatıp açtıktan sonra ilk iş kamera uygulamasını açın, başka uygulamaya geçmeyin.</p>

<h2>3. Kamera erişimi anahtarını kontrol edin</h2>
<p>Android 12 ve sonraki sürümlerde bildirim panelinde bir <strong>Kamera erişimi</strong> anahtarı bulunur. Bu anahtar kapalıysa tüm uygulamalar için kamera engellenir ve kamera açılmıyor gibi görünür. Bildirim panelini iki kez aşağı kaydırın, hızlı ayarlarda kamera simgesini arayın ve açık olduğundan emin olun. Simge görünmüyorsa düzenle (kalem) simgesine dokunup panele ekleyebilirsiniz.</p>
<p>Aynı ayara <strong>Ayarlar &gt; Güvenlik ve gizlilik &gt; Gizlilik</strong> yolundan da ulaşabilirsiniz. Xiaomi ve Redmi telefonlarda bu bölüm <strong>Ayarlar &gt; Gizlilik koruması</strong> altında olabilir.</p>

<h2>4. Uygulamanın kamera iznini açın</h2>
<p>Sorun belirli bir uygulamadaysa o uygulamanın izinlerine bakın: <strong>Ayarlar &gt; Uygulamalar</strong> bölümünden uygulamayı bulun, <strong>İzinler &gt; Kamera</strong> kısmına girin ve <strong>Uygulama kullanılırken izin ver</strong> seçeneğini işaretleyin. "Her seferinde sor" seçiliyse ve izin isteği daha önce reddedildiyse, uygulama bir daha sormadan kamerayı açmayabilir.</p>
<p>Uzun süre kullanmadığınız uygulamaların izinleri Android tarafından otomatik olarak geri alınabilir. Aylardır açmadığınız bir uygulamada kamera açılmıyorsa izinlerin silinmiş olması güçlü bir olasılıktır.</p>

<h2>5. Kamera uygulamasının önbelleğini temizleyin</h2>
<p>Kamera uygulaması açılıp hemen kapanıyorsa bozulmuş önbellek dosyaları neden olabilir. <strong>Ayarlar &gt; Uygulamalar</strong> bölümünde sistem uygulamalarını gösterin, <strong>Kamera</strong> uygulamasını açın ve <strong>Depolama &gt; Önbelleği temizle</strong> seçeneğine dokunun. Sorun sürerse aynı yerden <strong>Verileri sil</strong> seçeneğini deneyin. Bu işlem fotoğraflarınızı silmez; yalnızca kamera uygulamasının ayarlarını (çözünürlük, zamanlayıcı gibi) varsayılana döndürür.</p>
<p>Samsung telefonlarda sistem uygulamalarını görmek için uygulama listesinin sağ üstündeki filtre simgesinden "Sistem uygulamalarını göster" seçeneğini açmanız gerekebilir.</p>

<h2>6. Kamerayı kullanan uygulamaları kapatın</h2>
<p>Aynı anda yalnızca bir uygulama kamerayı kullanabilir. Arka planda açık kalmış bir görüntülü görüşme, QR kod okuyucu, el feneri uygulaması veya ekran kaydedici kamerayı kilitleyebilir. Son uygulamalar ekranını açıp hepsini kapatın. Kamera bundan sonra açılıyorsa hangi uygulamanın sorun çıkardığını bulmak için yakın zamanda yüklediklerinizi tek tek kontrol edin.</p>

<h2>7. Güvenli modda deneyin</h2>
<p>Güvenli mod, telefonu yalnızca sistem uygulamalarıyla başlatır. Birçok Android telefonda güç tuşuna basılı tutup ekrandaki <strong>Kapat</strong> seçeneğine uzun dokunduğunuzda güvenli mod seçeneği çıkar. Kamera güvenli modda sorunsuz açılıyorsa sorunu yüklediğiniz bir uygulama çıkarıyordur. Telefonu normal başlatın ve son yüklediğiniz uygulamaları kaldırarak deneyin.</p>

<h2>8. Yazılım güncellemesini kontrol edin</h2>
<p>Bazı kamera hataları belirli bir sistem güncellemesinden sonra başlar ve bir sonraki güncellemeyle düzelir. <strong>Ayarlar &gt; Yazılım güncelleme</strong> (Samsung) veya <strong>Ayarlar &gt; Telefon hakkında &gt; Sistem güncellemesi</strong> (Xiaomi) yolundan bekleyen bir güncelleme olup olmadığına bakın. Google Play'den Kamera uygulamasının güncellemesi de ayrıca yayınlanabilir.</p>

<h2>Ön kamera açılmıyor, arka kamera çalışıyor</h2>
<p>Yalnızca ön kamera açılmıyorsa ve uygulama içinde ön kameraya geçince ekran donuyor ya da siyah kalıyorsa olasılıklar şunlardır:</p>
<ul>
<li><strong>Ekran koruyucu veya kılıf:</strong> Kalın bir kılıf ya da kamera deliğini kapatan cam koruyucu, görüntüyü karartır. Kılıfı çıkarıp deneyin.</li>
<li><strong>Yüz tanıma çakışması:</strong> Bazı telefonlarda yüz tanıma ön kamerayı kullanır. Yüz tanıma ayarlarını geçici olarak kapatıp kamerayı yeniden açın.</li>
<li><strong>Açılır kamera mekanizması:</strong> Ön kamerası yukarı doğru açılan modellerde mekanizma takılmış olabilir. Bu durumda servis gerekir.</li>
<li><strong>Kablo bağlantısı:</strong> Telefon düşürüldükten sonra ön kamera çalışmıyorsa kameranın kablosu yerinden çıkmış olabilir.</li>
</ul>

<h2>Ne zaman servise götürmelisiniz?</h2>
<p>Yukarıdaki adımları denediniz, güvenli modda da kamera açılmıyor ve tarayıcıdaki kamera testi de görüntü vermiyorsa sorun donanımdadır. Telefon düştüyse, sıvıyla temas ettiyse ya da kamera camı içeriden buğulanmışsa bu olasılık daha da artar. Garanti süresi devam ediyorsa yetkili servise başvurun ve kendiniz açmayın; telefonu açmak çoğu zaman garantiyi geçersiz kılar.</p>
<p>Servise gitmeden önce fotoğraflarınızı yedekleyin. Kamera modülü değişimi genellikle verileri etkilemez ama servis yazılım sıfırlaması da yapabilir.</p>

<h2>İlgili testler ve rehberler</h2>
<p>Görüntülü görüşmede sesiniz de gitmiyorsa <a href="{post:telefon-mikrofon-calismiyor}">telefon mikrofonu çalışmıyor</a> rehberindeki adımlara bakın. Kamera açılıyor ama görüntü soluk veya bulanıksa <a href="{post:web-kamera-goruntu-kalitesi}">web kamera görüntü kalitesi</a> yazısındaki ışık önerileri telefonda da işe yarar. Bilgisayarınızın kamerası çalışmıyorsa <a href="{post:laptop-kamera-calismiyor}">laptop kamera çalışmıyor</a> rehberi ayrı adımlar içerir. Telefon ekranında sorun olup olmadığını <a href="{tool:olu-piksel-testi}">ölü piksel testi</a> ile kontrol edebilirsiniz.</p>
HTML
	,
	'faqs'        => array(
		array( 'q' => 'Telefonda kamera neden açılmıyor?', 'a' => 'En sık nedenler kapalı kamera erişimi anahtarı, reddedilmiş uygulama izni, bozulmuş önbellek ve kamerayı arka planda tutan başka bir uygulamadır. Donanım arızası genellikle telefon düştükten veya sıvıyla temas ettikten sonra görülür.' ),
		array( 'q' => 'Kamera uygulaması açılıp hemen kapanıyor, ne yapmalıyım?', 'a' => 'Ayarlar > Uygulamalar bölümünden Kamera uygulamasını bulun ve önce önbelleği, sorun sürerse verileri silin. Bu işlem fotoğraflarınızı silmez. Ardından telefonu yeniden başlatıp kamerayı başka bir uygulamaya geçmeden açın.' ),
		array( 'q' => 'Kameramın bozuk olup olmadığını nasıl anlarım?', 'a' => 'Tarayıcıdan bir kamera testi açın. Test görüntü gösteriyorsa kamera donanımı çalışıyordur ve sorun bir uygulamadadır. Güvenli modda bile kamera açılmıyor ve test de görüntü vermiyorsa sorun büyük olasılıkla donanımdadır.' ),
		array( 'q' => 'Sadece ön kamera açılmıyor, neden?', 'a' => 'Kamerayı kapatan kılıf veya koruyucu, yüz tanıma ayarlarıyla çakışma ya da düşme sonrası gevşeyen kablo en sık nedenlerdir. Kılıfı çıkarıp yüz tanımayı geçici kapatarak deneyin; düzelmezse servis gerekir.' ),
		array( 'q' => 'Önbelleği silmek fotoğrafları siler mi?', 'a' => 'Hayır. Kamera uygulamasının önbelleğini veya verilerini silmek galerideki fotoğraf ve videolara dokunmaz. Yalnızca kamera uygulamasının ayarları varsayılana döner.' ),
		array( 'q' => 'Güvenli modda kamera çalışıyorsa ne demektir?', 'a' => 'Güvenli modda kamera çalışıyorsa sorunu sonradan yüklediğiniz bir uygulama çıkarıyordur. Telefonu normal başlatıp son yüklediğiniz uygulamaları tek tek kaldırarak suçluyu bulabilirsiniz.' ),
	),
);
