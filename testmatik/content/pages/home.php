<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'Ana Sayfa',
	'seo_title'   => 'Online Klavye, Mikrofon, Kamera ve Ekran Testi | Testmatik',
	'description' => 'Ücretsiz online donanım testi: klavye testi, ölü piksel testi, mikrofon test, kamera, mouse ve hoparlör testi. Kurulum yok, veriler cihazınızdan çıkmaz.',
	'keywords'    => array( 'online donanım testi', 'klavye testi', 'ölü piksel testi', 'mikrofon test', 'kamera testi' ),
	'intro'       => 'Klavyenizi, ekranınızı, mikrofonunuzu, kameranızı, mouse ve hoparlörünüzü tarayıcıda saniyeler içinde test edin. Ücretsiz, kurulumsuz ve tamamen cihazınızda çalışır.',
	'html'        => <<<'HTML'
<h2>Testmatik nedir?</h2>
<p>Testmatik, bilgisayarınızın ve telefonunuzun temel donanımlarını doğrudan tarayıcıdan kontrol etmenizi sağlayan ücretsiz bir online donanım testi sitesidir. Program indirmeniz, hesap açmanız ya da bir şey kurmanız gerekmez. Sayfayı açar, testi başlatır ve sonucu anında görürsünüz.</p>
<p>Sitede altı araç bulunur: klavye, ölü piksel, mikrofon, kamera, mouse ve hoparlör testi. Her biri tek bir soruya net cevap vermek için tasarlandı: "Bu parça gerçekten çalışıyor mu?" Bir tuşun basıp basmadığını, ekranda takılı kalmış bir piksel olup olmadığını ya da mikrofonun sesinizi alıp almadığını birkaç dakika içinde öğrenebilirsiniz.</p>
<p>Testmatik bağımsız bir projedir. Amacımız, teknik bilgisi az olan kullanıcıların da donanım sorunlarını kendi başına tespit edebilmesi ve gerekirse servise giderken elinde somut bir bulgu olmasıdır.</p>

<h2>Testmatik araçları</h2>
<p>Aşağıda her aracın ne yaptığını, hangi durumlarda işinize yarayacağını ve sonuçları nasıl yorumlayacağınızı kısaca bulabilirsiniz. Ayrıntılı kullanım adımları her aracın kendi sayfasında yer alır.</p>

<h3>Klavye testi</h3>
<p><a href="{tool:klavye-testi}">Online klavye testi</a>, ekranda gerçek bir klavye düzeni gösterir ve bastığınız her tuşu anında işaretler. Varsayılan düzen Türkçe Q'dur; tek tıkla Türkçe F düzenine geçebilirsiniz. Basılı tuş mavi yanar, en az bir kez çalışmış tuş yeşile döner. Böylece tüm klavyeyi gezdikten sonra hâlâ gri kalan tuşlar, sorunlu olanları gösterir.</p>
<p>Araç ayrıca test edilen tuş sayısını, son basılan tuşun adını ve <code>code</code> değerini, son basışların geçmişini ve aynı anda basılı tutulan en fazla tuş sayısını gösterir. Bu son değer, ghosting, anti-ghosting ve NKRO desteğini kontrol etmek için kullanışlıdır. Laptop, masaüstü, mekanik ve kablosuz klavyelerle çalışır.</p>
<p>Dürüst olmak gerekirse <kbd>Fn</kbd> tuşu ve bazı medya tuşları hiçbir tarayıcı tarafından algılanamaz, çünkü bunları laptop donanım düzeyinde kendisi işler. Bu tuşlar testte yanmıyorsa bu, arızalı oldukları anlamına gelmez.</p>

<h3>Ölü piksel testi</h3>
<p><a href="{tool:olu-piksel-testi}">Ölü piksel testi</a>, ekranınızı tam ekran düz renklerle doldurarak bozuk pikselleri görünür hâle getirir. "Testi başlat" düğmesine bastığınızda sırasıyla siyah, beyaz, kırmızı, yeşil, mavi, gri, camgöbeği, macenta ve sarı renkleri görebilirsiniz. Rengi tıklayarak, ekrana dokunarak, ok tuşlarıyla ya da boşluk tuşuyla değiştirirsiniz. "Otomatik" mod rengi her 3 saniyede bir kendiliğinden değiştirir, <kbd>Esc</kbd> ile çıkarsınız.</p>
<p>Siyah zeminde parlayan bir nokta genellikle sıkışmış pikseldir; beyaz zeminde siyah kalan bir nokta ise ölü piksel olabilir. Sıkışmış pikseller için araçtaki piksel onarıcıyı kullanabilirsiniz: hızla rastgele renkler yanıp sönen küçük bir kareyi sorunlu noktanın üzerine sürükleyip 10–30 dakika bırakırsınız. Hızlı yanıp sönen ışıklar nedeniyle ışığa duyarlı epilepsisi olan kişilerin bu bölümü kullanmaması gerekir. Test monitör, laptop, telefon ve tarayıcısı olan televizyonlarda çalışır.</p>

<h3>Mikrofon testi</h3>
<p><a href="{tool:mikrofon-testi}">Online mikrofon testi</a>, tarayıcınızın mikrofon izni istemesiyle başlar. İzin verdikten sonra açılır listeden test etmek istediğiniz mikrofonu seçersiniz. Konuştuğunuzda canlı seviye göstergesi ve dalga formu hareket eder, en yüksek seviye (tepe değeri) ayrıca gösterilir.</p>
<p>"5 saniye kaydet" düğmesiyle kısa bir kayıt alıp hemen dinleyebilir, sesinizin karşı tarafa nasıl gittiğini kendiniz duyabilirsiniz. Araç ayrıca cihaz adını, örnekleme hızını ve kanal sayısını listeler. Böylece toplantı uygulamasında doğru mikrofonun seçili olup olmadığını da anlarsınız.</p>
<p>Laptop dahili mikrofonları, USB mikrofonlar, kulaklık mikrofonları ve telefon mikrofonlarıyla kullanılabilir. Kayıt yalnızca tarayıcınızda tutulur ve sayfayı kapattığınızda kaybolur.</p>

<h3>Kamera testi</h3>
<p><a href="{tool:kamera-testi}">Web kamera testi</a>, kamera iznini verdiğiniz anda canlı önizlemeyi açar. Birden fazla kameranız varsa açılır listeden seçim yapabilir, ayna görüntüsünü açıp kapatabilirsiniz. Ekranda kameranın adı, gerçek çözünürlük (örneğin 1280×720), ölçülen FPS ve en-boy oranı yer alır.</p>
<p>720p, 1080p ve 4K düğmeleriyle daha yüksek çözünürlük isteyebilirsiniz; kamera desteklediği en iyi değeri verir. Bu sayede "Full HD" diye satılan bir kameranın gerçekte hangi çözünürlükte çalıştığını görürsünüz. "Fotoğraf çek" düğmesi o anki görüntüyü PNG olarak cihazınıza kaydeder.</p>
<p>Görüntü hiçbir sunucuya gönderilmez. Laptop kamerası, harici USB webcam ve telefon kamerasıyla çalışır.</p>

<h3>Mouse testi</h3>
<p><a href="{tool:mouse-testi}">Mouse testi</a>, ekrandaki fare çiziminde sol, sağ, orta (tekerlek), geri ve ileri tuşlarını basışınıza göre yakar ve her birinin tıklama sayısını tutar. Tekerleği yukarı ve aşağı çevirdiğinizde ayrı sayaçlar artar.</p>
<p>En çok işe yarayan bölüm çift tıklama (chatter) dedektörüdür. Aynı tuştan gelen iki tıklama belirlenen eşikten (varsayılan 80 ms) daha kısa arayla gelirse araç bunu işaretler. Bu, tek tıkladığınız hâlde bilgisayarın çift tıklama algılamasına neden olan aşınmış bir switch'in tipik belirtisidir.</p>
<p>Fareyi hareket ettirirken polling rate (Hz) tahmini görebilir, 5 saniyelik CPS (saniyedeki tıklama) testiyle hızınızı ölçebilirsiniz. Test alanında sağ tık menüsü engellenir, böylece sağ tuşu rahatça deneyebilirsiniz.</p>

<h3>Hoparlör testi</h3>
<p><a href="{tool:hoparlor-testi}">Hoparlör ve kulaklık testi</a>, sağ ve sol kanalın doğru bağlanıp bağlanmadığını hızlıca gösterir. Sol, Sağ ya da Her iki düğmesine basarak test sesini istediğiniz kanalda çalarsınız. Sesi sağ kulakta duymanız gereken yerde sol kulakta duyuyorsanız kablo, ayar ya da kulaklık takılış yönü hatalı olabilir.</p>
<p>Frekans taraması 20 Hz ile 20 kHz arasında ilerler ve o anki frekansı ekranda gösterir. Böylece hoparlörünüzün ya da kulağınızın hangi aralıkta sesi duyulmaz hâle getirdiğini görebilirsiniz. Özel ton üreticisiyle istediğiniz frekansı seçip çalabilir, ses seviyesi kaydırıcısıyla yüksekliği ayarlarsınız.</p>
<p>Teste her zaman düşük sesle başlayın, özellikle kulaklık kullanıyorsanız. Yüksek frekanslı tonlar yüksek seviyede kulağı rahatsız edebilir.</p>

<div class="tm-callout tm-callout--tip">
<p><strong>İpucu:</strong> Bir donanımın arızalı olup olmadığından emin değilseniz önce testi başka bir tarayıcıda tekrarlayın. Sonuç değişmiyorsa sorun büyük olasılıkla donanımdadır; değişiyorsa tarayıcı ya da izin ayarlarına bakmak gerekir.</p>
</div>

<h2>Testmatik kimler için?</h2>
<p>Donanım testine ihtiyaç duymak için teknisyen olmak gerekmez. Testmatik'i en sık şu durumlarda kullanabilirsiniz:</p>
<ul>
<li><strong>İkinci el alım yapanlar:</strong> Laptop, monitör ya da telefon alırken satıcının yanında birkaç dakikada klavyeyi, ekranı, kamerayı ve sesi kontrol edebilirsiniz. Adım adım kontrol listesi için <a href="{post:ikinci-el-laptop-kontrol}">ikinci el laptop alırken yapılması gereken testler</a> rehberine göz atın.</li>
<li><strong>Oyuncular:</strong> Mouse'ta çift tıklama, klavyede ghosting ya da kulaklıkta yanlış kanal gibi sorunlar oyun deneyimini doğrudan etkiler. Polling rate ve aynı anda basılan tuş sayısı gibi değerleri kendiniz görebilirsiniz.</li>
<li><strong>Uzaktan çalışanlar:</strong> Önemli bir görüntülü toplantıdan önce kameranın ve mikrofonun doğru seçildiğini, sesin net gittiğini kontrol etmek birkaç dakikanızı alır.</li>
<li><strong>Öğrenciler:</strong> Online derse ya da sınava girmeden önce kamera ve mikrofonun çalıştığından emin olmak, son dakika sürprizlerini önler.</li>
</ul>
<p>Bunların yanında yeni bir cihaz aldıktan sonra iade süresi dolmadan kontrol yapmak ya da servise götürmeden önce sorunu netleştirmek de yaygın kullanım alanlarıdır.</p>

<h2>Tarayıcı tabanlı test nasıl çalışır?</h2>
<p>Modern tarayıcılar, web sayfalarının klavye ve fare olaylarını okumasına, ekranı tam ekrana almasına, ses çalmasına ve izin verildiğinde mikrofon ile kameraya erişmesine olanak tanır. Testmatik bu standart tarayıcı özelliklerini kullanır. Sizin ek bir yazılım kurmanıza gerek kalmaz.</p>
<p>Klavye, mouse, ölü piksel ve hoparlör testleri izin gerektirmez. Mikrofon ve kamera testlerinde ise tarayıcınız adres çubuğunun yanında bir izin penceresi açar. "İzin ver" seçeneğini seçmediğiniz sürece site bu cihazlara erişemez.</p>
<h3>İzin penceresi çıkmıyorsa</h3>
<p>Daha önce izni reddettiyseniz tarayıcı bir daha sormayabilir. Bu durumda adres çubuğundaki kilit ya da ayar simgesine tıklayıp mikrofon ve kamera iznini "İzin ver" olarak değiştirin ve sayfayı yenileyin.</p>
<p>Windows 11'de ayrıca <strong>Ayarlar &gt; Gizlilik ve güvenlik &gt; Mikrofon</strong> (veya Kamera) bölümünde masaüstü uygulamalarının erişiminin açık olduğunu kontrol edin. macOS'ta <strong>Sistem Ayarları &gt; Gizlilik ve Güvenlik</strong> altında Mikrofon ve Kamera listelerinde tarayıcınızın işaretli olması gerekir.</p>

<h2>Gizlilik: verileriniz cihazınızda kalır</h2>
<p>Testmatik'teki tüm testler tarayıcınızın içinde çalışır. Bastığınız tuşlar, mikrofon kaydınız ve kamera görüntünüz hiçbir sunucuya yüklenmez ve hiçbir yerde saklanmaz. Mikrofon testinde aldığınız 5 saniyelik kayıt yalnızca o sekmenin belleğinde durur; sayfayı kapattığınızda silinir.</p>
<p>Kamera testinde çektiğiniz fotoğraf da sunucuya gitmez, doğrudan sizin cihazınıza PNG dosyası olarak iner. Ayrıntılar için <a href="{page:gizlilik-politikasi}">gizlilik politikası</a> ve <a href="{page:cerez-politikasi}">çerez politikası</a> sayfalarını okuyabilirsiniz.</p>

<h2>Sık karşılaşılan sorunlar ve çözüm rehberleri</h2>
<p>Test sonucunda bir sorun gördüyseniz bir sonraki adım nedenini bulmaktır. Rehber bölümümüzde en sık karşılaşılan donanım sorunları için adım adım çözümler bulabilirsiniz:</p>
<ul>
<li>Tuşlar hiç tepki vermiyorsa <a href="{post:laptop-klavye-calismiyor}">laptop klavye çalışmıyor</a> rehberi sürücü, Filtre Tuşları ve donanım kontrollerini sırayla anlatır.</li>
<li>Hangi düzeni seçeceğinize karar veremiyorsanız <a href="{post:q-klavye-f-klavye-farki}">Q klavye ve F klavye farkı</a> yazımız iki düzeni karşılaştırır.</li>
<li>Oyunda bazı tuş kombinasyonları çalışmıyorsa <a href="{post:klavye-ghosting-nedir}">klavye ghosting nedir</a> rehberinde anti-ghosting ve NKRO kavramlarını bulabilirsiniz.</li>
<li>Ekranda parlak ya da siyah bir nokta gördüyseniz <a href="{post:olu-piksel-nasil-duzeltilir}">ölü piksel nasıl düzeltilir</a> yazısı neyin onarılabileceğini açıklar.</li>
<li>Karşı taraf sizi duymuyorsa <a href="{post:mikrofon-calismiyor}">mikrofon çalışmıyor</a> rehberi Windows 11, laptop ve kulaklık için çözümleri sıralar.</li>
<li>Görüntülü görüşmede siyah ekran görüyorsanız <a href="{post:laptop-kamera-calismiyor}">laptop kamera çalışmıyor</a> yazısındaki adımları deneyin.</li>
<li>Tek tıklamada iki tıklama algılanıyorsa <a href="{post:mouse-cift-tiklama-sorunu}">mouse çift tıklama sorunu</a> rehberi nedenleri ve çözümleri anlatır.</li>
</ul>
<table>
<thead>
<tr><th>Belirti</th><th>Önce bu testi yapın</th></tr>
</thead>
<tbody>
<tr><td>Bazı tuşlar yazmıyor</td><td>Klavye testi</td></tr>
<tr><td>Ekranda sabit renkli nokta</td><td>Ölü piksel testi</td></tr>
<tr><td>Toplantıda sesim gitmiyor</td><td>Mikrofon testi</td></tr>
<tr><td>Kamera siyah görüntü veriyor</td><td>Kamera testi</td></tr>
<tr><td>Tek tıkta çift tıklama</td><td>Mouse testi</td></tr>
<tr><td>Ses yalnızca bir taraftan geliyor</td><td>Hoparlör testi</td></tr>
</tbody>
</table>

<h2>Daha doğru sonuç için birkaç öneri</h2>
<ol class="tm-steps">
<li>Testten önce diğer sekmeleri ve görüntülü görüşme uygulamalarını kapatın. Zoom, Teams veya Discord açıkken mikrofon ve kamera başka bir uygulama tarafından kullanılıyor olabilir.</li>
<li>Ölü piksel testini yaparken ekranı temizleyin. Toz ve parmak izi, ilk bakışta bozuk piksel gibi görünebilir.</li>
<li>Klavye testinde tuşları tek tek, sonra da sık kullandığınız kombinasyonlarla deneyin. Böylece hem tekil arızaları hem de ghosting sorunlarını yakalarsınız.</li>
<li>Kablosuz mouse ya da klavye kullanıyorsanız pilinin dolu olduğundan emin olun. Zayıf pil, kopuk bağlantı ve kaçan tıklamalar gibi arıza belirtilerine yol açabilir.</li>
<li>Bulduğunuz sorunu not alın ya da ekran görüntüsünü kaydedin. Servise veya satıcıya giderken somut bir kanıt işinizi kolaylaştırır.</li>
</ol>

<h2>Tarayıcı uyumluluğu</h2>
<p>Testmatik; Google Chrome, Microsoft Edge, Mozilla Firefox ve Safari'nin güncel sürümlerinde çalışacak şekilde hazırlanmıştır. En iyi sonuç için tarayıcınızı güncel tutmanızı öneririz. Eski sürümlerde bazı özellikler, örneğin tam ekran ya da cihaz seçimi, beklendiği gibi çalışmayabilir.</p>
<p>Mikrofon ve kameraya erişim, tarayıcıların güvenlik kuralı gereği yalnızca HTTPS ile açılan sayfalarda mümkündür. Testmatik her zaman güvenli bağlantı üzerinden sunulur. Adres çubuğunda kilit simgesini görmüyorsanız sayfayı doğru adresten açtığınızı kontrol edin.</p>
<p>Telefonlarda ölü piksel, mikrofon, kamera ve hoparlör testleri sorunsuz çalışır. Klavye ve mouse testleri için ise fiziksel bir klavye ya da fare bağlı olmalıdır; ekran klavyesi tüm tuş olaylarını standart biçimde göndermez.</p>
<div class="tm-callout tm-callout--info">
<p><strong>Bilgi:</strong> Bir testte hata bulduğunuzu düşünüyorsanız kullandığınız tarayıcıyı, cihazı ve hangi testte sorun yaşadığınızı <a href="{page:iletisim}">iletişim</a> sayfasındaki adrese yazabilirsiniz.</p>
</div>

<h2>Neden Testmatik?</h2>
<p>Testmatik'i oluştururken üç ilkeyi önemsedik: hız, sadelik ve gizlilik. Araçlar birkaç saniyede açılır, gereksiz adım içermez ve sonuçları Türkçe, anlaşılır biçimde gösterir. Türkçe Q ve F klavye düzenlerini birlikte destekleyen bir klavye testi gibi ayrıntılar, Türkiye'deki kullanıcıların gerçek ihtiyaçları düşünülerek eklendi.</p>
<p>Tüm araçlar ücretsizdir. Projenin arka planını merak ediyorsanız <a href="{page:hakkimizda}">hakkımızda</a> sayfasını, kullanım koşulları için <a href="{page:kullanim-sartlari}">kullanım şartları</a> sayfasını inceleyebilirsiniz.</p>
HTML
	,
	'faqs'        => array(
		array( 'q' => 'Testmatik ücretsiz mi?', 'a' => 'Evet, Testmatik\'teki tüm testler ücretsizdir. Hesap açmanız, kayıt olmanız ya da bir program indirmeniz gerekmez. Sayfayı açıp testi hemen başlatabilirsiniz.' ),
		array( 'q' => 'Online donanım testi güvenli mi?', 'a' => 'Testmatik\'teki testler tamamen tarayıcınızda çalışır. Tuş basışlarınız, ses kaydınız ve kamera görüntünüz hiçbir sunucuya gönderilmez ve saklanmaz. Mikrofon ve kameraya ancak siz izin verirseniz erişilir.' ),
		array( 'q' => 'Program kurmam gerekiyor mu?', 'a' => 'Hayır. Tüm araçlar Chrome, Edge, Firefox ve Safari gibi güncel tarayıcıların standart özellikleriyle çalışır. Ek eklenti ya da yazılım gerekmez.' ),
		array( 'q' => 'Mikrofon veya kamera izni neden isteniyor?', 'a' => 'Tarayıcılar, bir sitenin mikrofon ya da kameraya erişmesine yalnızca kullanıcı onay verdiğinde izin verir. İzin vermezseniz test başlayamaz. İzni istediğiniz zaman adres çubuğundaki site ayarlarından geri alabilirsiniz.' ),
		array( 'q' => 'Fn tuşu klavye testinde neden yanmıyor?', 'a' => 'Fn tuşu ve bazı medya tuşları laptop tarafından donanım düzeyinde işlenir ve tarayıcıya hiç iletilmez. Bu nedenle hiçbir online klavye testi bu tuşları algılayamaz. Testte yanmamaları arızalı oldukları anlamına gelmez.' ),
		array( 'q' => 'Testmatik telefonda çalışır mı?', 'a' => 'Evet. Ölü piksel, mikrofon, kamera ve hoparlör testleri telefon tarayıcılarında çalışır. Klavye ve mouse testleri için telefona fiziksel bir klavye ya da fare bağlamanız gerekir.' ),
		array( 'q' => 'Mikrofon veya kamera listede görünmüyorsa ne yapmalıyım?', 'a' => 'Önce cihazın takılı olduğunu ve başka bir uygulamanın onu kullanmadığını kontrol edin. Ardından tarayıcı izinlerini ve Windows 11\'de Ayarlar > Gizlilik ve güvenlik altındaki mikrofon ve kamera erişimini kontrol edip sayfayı yenileyin.' ),
		array( 'q' => 'Test sonucu sorun gösteriyorsa donanım kesin arızalı mı?', 'a' => 'Her zaman değil. Sorun sürücü, izin ya da ayar kaynaklı olabilir. Testi başka bir tarayıcıda ve mümkünse başka bir cihazda tekrarlayın; sonuç aynıysa donanım arızası olasılığı yüksektir.' ),
	),
);
