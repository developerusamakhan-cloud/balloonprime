<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'Ölü Piksel Testi',
	'seo_title'   => 'Ölü Piksel Testi: Monitör ve Telefon Ekran Testi | Testmatik',
	'description' => 'Ücretsiz ölü piksel testi: monitör, laptop, TV ve telefon ekranını tam ekran renklerle tarayın, sıkışmış pikseli piksel onarıcıyla düzeltmeyi deneyin.',
	'keywords'    => array( 'ölü piksel testi', 'monitör ölü piksel testi', 'telefon ölü piksel testi', 'ölü piksel testi nasıl yapılır', 'ekran testi' ),
	'intro'       => 'Ekranınızı tam ekran düz renklerle tarayarak ölü, sıkışmış ve parlak pikselleri birkaç dakikada bulun. Monitör, laptop, TV ve telefonda çalışır; kurulum gerekmez.',
	'html'        => <<<'HTML'
<h2>Ölü piksel testi nasıl yapılır?</h2>
<p>Ölü piksel testi, ekranı sırayla tek renkle doldurarak normalde gözden kaçan kusurlu pikselleri görünür hâle getirir. Kalabalık bir masaüstü görüntüsünde fark edilmeyen küçük bir nokta, düz siyah ya da düz beyaz zeminde hemen göze çarpar. Yeni aldığınız bir monitörü, ikinci el bir laptopu veya telefonunuzu bu yöntemle birkaç dakikada kontrol edebilirsiniz.</p>
<ol class="tm-steps">
<li>Ekranı yumuşak, kuru bir mikrofiber bezle silin. Toz zerresi ile kusurlu piksel ilk bakışta birbirine çok benzer.</li>
<li>Ekran parlaklığını orta-yüksek bir seviyeye getirin; gece ışığı, mavi ışık filtresi gibi renk değiştiren modları geçici olarak kapatın.</li>
<li><strong>Testi başlat</strong> düğmesine basın. Test tam ekran açılır ve ekranın tamamı tek renge boyanır.</li>
<li>Rengi değiştirmek için ekrana tıklayın ya da dokunun, ok tuşlarını veya boşluk tuşunu kullanın. Her renkte ekranı köşeden köşeye, yaklaşık 30–50 cm mesafeden dikkatle tarayın.</li>
<li>Elleriniz serbest kalsın istiyorsanız <strong>Otomatik</strong> modunu açın; renk her 3 saniyede bir kendiliğinden değişir.</li>
<li>Testten çıkmak için <kbd>Esc</kbd> tuşuna basın. Bulduğunuz noktaların yerini ve hangi renklerde göründüğünü not edin.</li>
</ol>

<h2>Hangi renk neyi gösterir?</h2>
<p>Testte dokuz renk bulunur: siyah, beyaz, kırmızı, yeşil, mavi, gri, camgöbeği, macenta ve sarı. Her pikselin kırmızı, yeşil ve mavi olmak üzere üç alt pikseli vardır; renkler bu alt pikselleri ayrı ayrı ve birlikte zorlayacak şekilde seçilmiştir.</p>
<table>
<thead>
<tr><th>Renk</th><th>Ne arıyorsunuz?</th></tr>
</thead>
<tbody>
<tr><td>Siyah</td><td>Sürekli yanan parlak noktalar ve renkli sıkışmış pikseller. Ayrıca ekran kenarlarındaki ışık sızmaları.</td></tr>
<tr><td>Beyaz</td><td>Hiç ışık vermeyen siyah noktalar (ölü pikseller) ve panel içindeki toz lekeleri.</td></tr>
<tr><td>Kırmızı, yeşil, mavi</td><td>Tek bir alt pikselin arızası. Örneğin kırmızı zeminde siyah görünen nokta, kırmızı alt pikselin yanmadığını gösterir.</td></tr>
<tr><td>Camgöbeği, macenta, sarı</td><td>İki alt pikselin birlikte çalışması gereken renkler; eksik ya da fazla yanan alt pikseli doğrulamaya yarar.</td></tr>
<tr><td>Gri</td><td>Renk ve parlaklık düzensizlikleri, lekeler ve bantlanma. Piksel kusurlarını da daha yumuşak bir zeminde gösterir.</td></tr>
</tbody>
</table>

<h2>Ölü piksel, sıkışmış piksel ve parlak nokta farkı</h2>
<p>Bu üç terim sık sık birbirinin yerine kullanılır, ama sorunun düzeltilip düzeltilemeyeceği hangisiyle karşı karşıya olduğunuza bağlıdır.</p>
<table>
<thead>
<tr><th>Kusur</th><th>Nasıl görünür?</th><th>Düzelme ihtimali</th></tr>
</thead>
<tbody>
<tr><td>Ölü piksel</td><td>Hiç ışık vermez; özellikle beyaz ve açık renklerde siyah bir nokta olarak görünür.</td><td>Yazılımla düzelmesi beklenmez; genellikle kalıcı bir donanım arızasıdır.</td></tr>
<tr><td>Sıkışmış piksel</td><td>Bir veya iki alt piksel sürekli açık kalır; nokta her renkte kırmızı, yeşil, mavi ya da bunların karışımı olarak görünür.</td><td>Bazen piksel onarıcı gibi hızlı renk değişimleriyle düzelebilir.</td></tr>
<tr><td>Parlak nokta</td><td>Üç alt piksel birden sürekli yanar; siyah zeminde beyaz bir nokta olarak öne çıkar.</td><td>Sıkışmış piksel gibi denenebilir, ancak sonuç garanti değildir.</td></tr>
</tbody>
</table>
<p>Tek pikselden büyük, bulanık kenarlı açık lekeler genellikle piksel kusuru değildir. LCD ekranlarda bu tür lekeler basınç izi, katmanlar arasına girmiş toz ya da arka aydınlatma düzensizliğinden kaynaklanabilir. OLED ekranlarda ise uzun süre aynı görüntüyü göstermekten oluşan iz (burn-in) farklı bir sorundur ve bu testte en çok gri zeminde fark edilir.</p>

<h3>Kusurlu pikseller neden oluşur?</h3>
<p>LCD panellerde her alt pikseli ince film transistör (TFT) adı verilen küçük bir anahtar kontrol eder. Bu transistör üretim sırasında hatalı çıkarsa ya da zamanla bozulursa alt piksel ya hiç açılmaz ya da açık konumda takılı kalır. OLED ekranlarda ise her alt piksel kendi ışığını ürettiği için ışık veren katmandaki bir kusur doğrudan siyah nokta olarak görünür.</p>
<p>Kusurlu pikseller çoğunlukla üretimden kalır ve cihaz yeniyken fark edilir. Darbe, ekrana uygulanan basınç ya da sıvı teması da sonradan yeni kusurlar oluşturabilir. Bu yüzden testi yalnızca satın alırken değil, ekrana bir şey çarptığından şüphelendiğinizde de tekrarlamak faydalıdır.</p>

<h2>Monitör, laptop, telefon ve TV'de ekran testi</h2>
<h3>Monitör ve laptop</h3>
<p>Monitör ölü piksel testi için tarayıcıyı test etmek istediğiniz ekranda açın. Birden fazla monitör kullanıyorsanız tarayıcı penceresini önce o ekrana taşıyın, sonra testi başlatın; tam ekran modu pencerenin bulunduğu ekranı kaplar. Windows'ta ölçeklendirme ayarının testi etkilemesi beklenmez, çünkü renk ekranın her pikselini doldurur.</p>
<div class="tm-callout tm-callout--tip">
<p><strong>İpucu:</strong> Şüphelendiğiniz bir noktayı daha net görmek için telefonunuzun kamerasını ekrana yaklaştırıp yakınlaştırın. Kamera görüntüsünde nokta tek bir pikselin boyutundaysa ve ekranı silince kaybolmuyorsa büyük ihtimalle gerçek bir piksel kusurudur.</p>
</div>
<p>Laptoplarda menteşeye yakın alt kenarı ve köşeleri ayrıca kontrol edin; bu bölgeler bakarken en kolay atlanan yerlerdir. İkinci el bir cihaz alıyorsanız ekran testini klavye ve diğer donanım kontrolleriyle birlikte yapın.</p>
<h3>Telefon ve tablet</h3>
<p>Telefon ölü piksel testi için sayfayı mobil tarayıcınızda açıp <strong>Testi başlat</strong> düğmesine dokunun ve renkleri dokunarak değiştirin. Bazı mobil tarayıcılarda adres çubuğu veya sistem çubukları tamamen gizlenmeyebilir; bu durumda telefonu yatay ve dikey çevirerek ekranın kenarlarını ayrı ayrı kontrol edin. Otomatik parlaklığı kapatmak, renklerin daha tutarlı görünmesini sağlar.</p>
<h3>Televizyon</h3>
<p>Akıllı televizyonun kendi tarayıcısıyla sayfayı açabilir ya da bir bilgisayarı HDMI ile televizyona bağlayıp testi oradan çalıştırabilirsiniz. Bilgisayar bağlıyken televizyonun görüntü ayarlarında ekrana sığdır veya tam piksel benzeri bir seçenek arayın; aşırı tarama (overscan) açıksa görüntünün kenarları kesilir ve kenardaki pikselleri göremezsiniz. Büyük ekranlarda bir sandalyeye oturup bölüm bölüm tarama yapmak daha sağlıklı sonuç verir.</p>

<h2>Piksel onarıcı nasıl kullanılır?</h2>
<p>Testin içindeki piksel onarıcı, hızla rastgele renkler arasında yanıp sönen küçük bir karedir. Amaç, sıkışmış alt pikseli sürekli açılıp kapanmaya zorlayarak yeniden normal çalışmasını sağlamaktır.</p>
<div class="tm-callout tm-callout--warn">
<p><strong>Uyarı:</strong> Piksel onarıcı hızlı yanıp sönen renkler kullanır. Işığa duyarlı epilepsiniz veya bu tür bir rahatsızlık geçmişiniz varsa bu özelliği kullanmayın. Kullanırken de kareye doğrudan bakmayın; onarıcı çalışırken başka bir işle ilgilenin.</p>
</div>
<ol class="tm-steps">
<li>Önce ölü piksel testiyle sorunlu noktanın yerini bulun ve hangi renklerde göründüğünü not edin.</li>
<li>Piksel onarıcıyı açın ve yanıp sönen kareyi sürükleyerek sıkışmış pikselin tam üzerine getirin.</li>
<li>Kareyi 10–30 dakika boyunca orada bırakın. Ekran koruyucunun veya uyku modunun devreye girmediğinden emin olun.</li>
<li>Süre dolunca testi yeniden çalıştırıp noktayı kontrol edin. Gerekirse işlemi birkaç kez tekrarlayın.</li>
</ol>
<p>Piksel onarıcı yalnızca sıkışmış piksellerde işe yarayabilir; hiç ışık vermeyen ölü piksellerde sonuç beklemeyin. Başarı her ekranda farklıdır ve garanti edilemez. Ekrana bastırarak düzeltme gibi fiziksel yöntemleri ve diğer seçenekleri <a href="{post:olu-piksel-nasil-duzeltilir}">ölü piksel ve sıkışmış piksel nasıl düzeltilir</a> rehberimizde riskleriyle birlikte anlattık.</p>

<h2>Garanti ve iade: kusurlu piksel bulursanız</h2>
<p>Ekran panellerindeki piksel kusurları için ISO 9241-307 standardı, bir panelde kabul edilebilecek kusurlu piksel sayısına göre sınıflar tanımlar. Üreticiler panellerinin hangi sınıfa uyduğunu ve kaç kusurlu pikseli garanti kapsamında değişim sebebi saydığını kendi politikalarıyla belirler. Bu politikalar marka ve hatta model bazında değişebilir; parlak noktalarla siyah noktalar için farklı sınırlar uygulanması da yaygındır.</p>
<ul>
<li><strong>Hemen test edin:</strong> Yeni ekranı kutusundan çıkardığınız gün test etmek, iade ve değişim sürecinde elinizi güçlendirir. İnternetten yapılan alışverişlerde cayma hakkı süresini kaçırmamaya dikkat edin.</li>
<li><strong>Kanıt toplayın:</strong> Kusurlu pikseli telefonunuzun kamerasıyla yakından fotoğraflayın. Siyah zemindeki parlak noktalar ve beyaz zemindeki siyah noktalar fotoğrafta daha net çıkar.</li>
<li><strong>Politikayı okuyun:</strong> Üreticinin destek sayfasında piksel politikasını ve garanti koşullarını arayın; belirsizse satıcıya veya üreticinin destek hattına yazılı olarak sorun.</li>
<li><strong>Konumu belirtin:</strong> Başvururken kusurun ekranın neresinde olduğunu ve hangi renklerde göründüğünü açıkça yazın.</li>
</ul>

<h2>Sık görülen durumlar</h2>
<table>
<thead>
<tr><th>Belirti</th><th>Olası neden</th><th>Ne yapmalı?</th></tr>
</thead>
<tbody>
<tr><td>Nokta ekranı silince kayboldu</td><td>Toz veya leke</td><td>Sorun yok; ekranı düzenli temizleyin.</td></tr>
<tr><td>Her renkte aynı renkli nokta</td><td>Sıkışmış piksel</td><td>Piksel onarıcıyı 10–30 dakika deneyin.</td></tr>
<tr><td>Açık renklerde siyah nokta</td><td>Ölü piksel</td><td>Garanti koşullarını kontrol edin.</td></tr>
<tr><td>Siyah zeminde kenarlarda ışık</td><td>Arka aydınlatma sızması</td><td>Odayı karartıp normal parlaklıkta tekrar bakın; belirginse satıcıya danışın.</td></tr>
<tr><td>Test tam ekran açılmıyor</td><td>Tarayıcı kısıtlaması veya gömülü pencere</td><td>Sayfayı ana tarayıcıda açın ya da tarayıcının tam ekran kısayolunu kullanın.</td></tr>
</tbody>
</table>

<h2>Gizlilik</h2>
<p>Ölü piksel testi tamamen tarayıcınızda çalışır. Ekranınızla ilgili hiçbir bilgi bir sunucuya gönderilmez ve saklanmaz; test yalnızca ekranı renklerle doldurur.</p>

<h2>Diğer testler ve rehberler</h2>
<p>Ekranı kontrol ettikten sonra tuşları <a href="{tool:klavye-testi}">klavye testi</a> ile, dahili kamerayı <a href="{tool:kamera-testi}">web kamera testi</a> ile, fare tuşlarını ve çift tıklama sorununu <a href="{tool:mouse-testi}">mouse testi</a> ile, hoparlörleri de <a href="{tool:hoparlor-testi}">sağ sol ses testi</a> ile deneyebilirsiniz. İkinci el bir cihaz alıyorsanız <a href="{post:ikinci-el-laptop-kontrol}">ikinci el laptop alırken yapılması gereken testler</a> listesi tüm kontrolleri tek sayfada topluyor.</p>
HTML
	,
	'faqs'        => array(
		array( 'q' => 'Ölü piksel testi nasıl yapılır?', 'a' => 'Ekranı temizleyin, Testi başlat düğmesine basın ve tam ekranda renkleri tıklayarak, ok tuşlarıyla veya boşluk tuşuyla değiştirin. Her renkte ekranı köşeden köşeye tarayın. Otomatik modda renk her 3 saniyede bir değişir, Esc tuşu testten çıkarır.' ),
		array( 'q' => 'Ölü piksel ile sıkışmış piksel arasındaki fark nedir?', 'a' => 'Ölü piksel hiç ışık vermez ve açık renklerde siyah nokta olarak görünür. Sıkışmış pikselde bir veya iki alt piksel sürekli açık kalır, bu yüzden nokta kırmızı, yeşil, mavi veya karışım bir renkte görünür. Sıkışmış pikseller bazen düzelebilir, ölü pikseller genellikle kalıcıdır.' ),
		array( 'q' => 'Piksel onarıcı ölü pikseli düzeltir mi?', 'a' => 'Piksel onarıcı yalnızca sıkışmış piksellerde işe yarayabilir. Hiç ışık vermeyen ölü piksellerde genellikle sonuç alınmaz. Sıkışmış piksellerde de başarı garanti değildir; kareyi 10–30 dakika bırakıp birkaç kez denemek gerekebilir.' ),
		array( 'q' => 'Telefon ölü piksel testi yapılabilir mi?', 'a' => 'Evet. Sayfayı telefonun tarayıcısında açın, Testi başlat düğmesine dokunun ve renkleri dokunarak değiştirin. Bazı tarayıcılarda sistem çubukları görünür kalabileceği için telefonu yatay ve dikey çevirerek kenarları ayrıca kontrol edin.' ),
		array( 'q' => 'Piksel onarıcı epilepsi için tehlikeli mi?', 'a' => 'Piksel onarıcı hızla yanıp sönen renkler kullandığı için ışığa duyarlı epilepsisi olan kişilerde risk oluşturabilir. Böyle bir rahatsızlığınız varsa bu özelliği kullanmayın. Kullanırken de kareye doğrudan bakmamanızı öneririz.' ),
		array( 'q' => 'Kaç ölü piksel garanti kapsamına girer?', 'a' => 'Bu tamamen üreticinin piksel politikasına bağlıdır. ISO 9241-307 standardı kusurlu piksel sınıflarını tanımlar, markalar da panellerinin hangi sınıfa uyduğunu ve hangi durumda değişim yapacaklarını kendileri belirler. Kesin bilgi için cihazınızın garanti belgesine veya üreticinin destek sayfasına bakın.' ),
		array( 'q' => 'Test sırasında ekranımla ilgili bilgi kaydediliyor mu?', 'a' => 'Hayır. Test tamamen tarayıcınızda çalışır ve yalnızca ekranı renklerle doldurur. Hiçbir bilgi sunucuya gönderilmez veya saklanmaz.' ),
	),
);
