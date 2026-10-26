<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'Mikrofon Testi',
	'seo_title'   => 'Mikrofon Testi: Online Mikrofon Test Etme Aracı | Testmatik',
	'description' => 'Ücretsiz online mikrofon test aracı: canlı ses seviyesi, dalga formu ve 5 saniyelik kayıtla mikrofonunuzu dinleyin. Kurulum yok, ses hiçbir yere gönderilmez.',
	'keywords'    => array( 'mikrofon test', 'mikrofon testi', 'online mikrofon test', 'kulaklık mikrofon testi', 'telefon mikrofon testi' ),
	'intro'       => 'Mikrofonunuzun çalışıp çalışmadığını canlı ses seviyesi ve 5 saniyelik kayıtla hemen görün. Laptop, USB, kulaklık ve telefon mikrofonlarında çalışır; ses hiçbir yere gönderilmez.',
	'html'        => <<<'HTML'
<h2>Mikrofon test nasıl yapılır?</h2>
<p>Bu online mikrofon test aracı, mikrofonunuzun ses alıp almadığını, sesi ne kadar güçlü aldığını ve kaydın kulağa nasıl geldiğini birkaç saniyede gösterir. Toplantıdan, online dersten veya oyundan önce kısa bir mikrofon testi, karşı tarafın sizi duymadığı o tanıdık anı önler.</p>
<ol class="tm-steps">
<li>Testi başlatın. Tarayıcınız mikrofon erişimi için izin isteyecektir; çıkan pencerede <strong>İzin ver</strong> seçeneğine tıklayın.</li>
<li>Birden fazla mikrofonunuz varsa (örneğin laptopun dahili mikrofonu ve bir kulaklık) açılır listeden test etmek istediğinizi seçin.</li>
<li>Normal ses tonunuzla konuşun. Seviye göstergesi ve dalga formu sesinizle birlikte hareket etmelidir.</li>
<li><strong>5 saniye kaydet</strong> düğmesine basın ve kısa bir cümle söyleyin.</li>
<li>Kaydı oynatıp kendinizi dinleyin. Ses net, yeterince yüksek ve cızırtısız mı, kulağınızla kontrol edin.</li>
</ol>
<p>Kaydı dinlerken kulaklık kullanmanızı öneririz. Hoparlörden dinlediğinizde aynı odadaki ses mikrofona geri dönebilir ve değerlendirmeyi zorlaştırır.</p>

<h2>Sonuçlar nasıl okunur?</h2>
<h3>Seviye göstergesi ve tepe seviye</h3>
<p>Canlı seviye göstergesi mikrofonun o anda aldığı sesin gücünü gösterir. Normal konuşmada çubuğun belirgin şekilde hareket etmesi ve ortalara kadar çıkması iyi bir işarettir. Siz susarken de çubuk sürekli yüksekte duruyorsa ortamda fan, klima veya elektriksel bir uğultu gibi bir gürültü kaynağı vardır.</p>
<p>Tepe seviye, test boyunca ulaşılan en yüksek değeri tutar. Bu değer konuşurken sık sık en üste dayanıyorsa mikrofon kazancı fazladır ve ses bozulabilir (kırpılma). Tersine, bağırsanız bile tepe seviye düşük kalıyorsa giriş seviyesi çok kısıktır ya da yanlış mikrofon seçilmiştir.</p>
<h3>Dalga formu</h3>
<p>Dalga formu sesinizin şeklini canlı olarak çizer. Konuşurken iniş çıkışlar görmeniz, susunca çizginin düzleşmesi beklenir. Hiç konuşmadığınız hâlde düzenli ve sürekli bir dalga görüyorsanız arka planda sabit bir gürültü vardır.</p>
<h3>Cihaz bilgileri</h3>
<ul>
<li><strong>Cihaz adı:</strong> Tarayıcının gerçekte hangi mikrofonu kullandığını gösterir. Beklediğiniz cihaz değilse açılır listeden doğru olanı seçin.</li>
<li><strong>Örnekleme hızı:</strong> Saniyede alınan örnek sayısıdır. Bilgisayarlarda 44.100 Hz ve 48.000 Hz yaygın değerlerdir. Bluetooth kulaklıklarda daha düşük değerler görebilirsiniz.</li>
<li><strong>Kanal sayısı:</strong> 1 kanal mono, 2 kanal stereo demektir. Konuşma için mono mikrofon tamamen yeterlidir.</li>
</ul>

<h2>Tarayıcıda mikrofon izni nasıl verilir?</h2>
<p>Tarayıcılar güvenlik gereği mikrofonu yalnızca HTTPS ile açılan sayfalarda ve sizin izninizle kullanır. Daha önce izni reddettiyseniz tarayıcı bir daha sormaz; izni elle açmanız gerekir.</p>
<table>
<thead>
<tr><th>Tarayıcı</th><th>İzni açma yolu</th></tr>
</thead>
<tbody>
<tr><td>Chrome</td><td>Adres çubuğunun solundaki site bilgisi simgesine tıklayın ve Mikrofon iznini açın. Genel ayar: Ayarlar &gt; Gizlilik ve güvenlik &gt; Site ayarları &gt; Mikrofon.</td></tr>
<tr><td>Edge</td><td>Adres çubuğundaki site bilgisi simgesinden Mikrofon iznini değiştirin. Genel ayar: Ayarlar &gt; Çerezler ve site izinleri &gt; Mikrofon.</td></tr>
<tr><td>Firefox</td><td>Adres çubuğundaki izin simgesinden engellenen izni kaldırın. Genel ayar: Ayarlar &gt; Gizlilik ve Güvenlik &gt; İzinler &gt; Mikrofon.</td></tr>
<tr><td>Safari (Mac)</td><td>Safari &gt; Ayarlar &gt; Web Siteleri &gt; Mikrofon bölümünden siteyi İzin Ver olarak ayarlayın.</td></tr>
<tr><td>Safari (iPhone, iPad)</td><td>Ayarlar &gt; Safari &gt; Mikrofon bölümünden Sor veya İzin Ver seçin.</td></tr>
</tbody>
</table>
<p>İzni değiştirdikten sonra sayfayı yenileyin. Tarayıcı izin verildiğini gösterdiği hâlde ses gelmiyorsa engel büyük ihtimalle işletim sistemindedir.</p>

<h2>Windows 11 ve macOS gizlilik ayarları</h2>
<h3>Windows 11</h3>
<p><strong>Ayarlar &gt; Gizlilik ve güvenlik &gt; Mikrofon</strong> bölümünü açın. Mikrofon erişimi ve Uygulamaların mikrofonunuza erişmesine izin ver seçenekleri açık olmalıdır. Chrome, Edge ve Firefox masaüstü uygulaması olduğu için aynı sayfadaki Masaüstü uygulamalarının mikrofonunuza erişmesine izin ver seçeneği de açık olmalıdır.</p>
<p>Ardından <strong>Ayarlar &gt; Sistem &gt; Ses</strong> bölümünde Giriş başlığı altından doğru mikrofonu seçin ve giriş ses düzeyini kontrol edin. Mikrofon listede hiç görünmüyorsa Aygıt Yöneticisi'nde Ses girişleri ve çıkışları altında cihazın tanınıp tanınmadığına bakın.</p>
<h3>macOS</h3>
<p><strong>Sistem Ayarları &gt; Gizlilik ve Güvenlik &gt; Mikrofon</strong> bölümünde kullandığınız tarayıcının anahtarı açık olmalıdır. Anahtarı yeni açtıysanız tarayıcıyı tamamen kapatıp yeniden başlatın. Giriş aygıtını ve giriş düzeyini <strong>Sistem Ayarları &gt; Ses &gt; Giriş</strong> bölümünden seçebilirsiniz.</p>

<h2>Kulaklık, USB ve telefon mikrofonları</h2>
<h3>Laptop dahili mikrofonu</h3>
<p>Laptoplarda dahili mikrofon genellikle ekranın üst çerçevesinde, kameranın yanında küçük delikler hâlinde bulunur; bazı modellerde ise klavyenin yanında veya kasanın alt kenarındadır. Bu deliklerin kapalı olmaması, ekran kapağına yapıştırılan kamera kapaklarının mikrofonu örtmemesi gerekir.</p>
<p>Birçok laptopta mikrofonu tamamen kapatan bir sessiz tuşu veya <kbd>Fn</kbd> ile kullanılan bir kısayol bulunur ve bazı modellerde bu tuşun üzerindeki ışık mikrofonun kapalı olduğunu gösterir. Seviye göstergesi hiç kıpırdamıyorsa önce bu tuşu kontrol edin. Harici bir kulaklık taktığınızda sistem dahili mikrofondan kulaklığa geçebileceği için cihaz adını da mutlaka okuyun.</p>
<h3>Kulaklık mikrofon testi</h3>
<p>Kablolu kulaklıklarda bağlantı tipine dikkat edin. Laptopların çoğunda kulaklık ve mikrofon için tek bir birleşik 3,5 mm giriş bulunur ve mikrofonlu kulaklığın dört kutuplu (TRRS) fişi bu girişte çalışır. Masaüstü bilgisayarlarda genellikle ayrı bir pembe mikrofon girişi vardır; tek fişli bir kulaklığı bu girişlere bağlamak için çoğu zaman bir ayırıcı kablo gerekir.</p>
<p>Bluetooth kulaklıklarda mikrofon devreye girdiğinde kulaklık genellikle konuşma moduna geçer ve ses kalitesi belirgin şekilde düşer. Bu normaldir. Windows'ta aynı kulaklık için birden fazla giriş görünebilir; mikrofon olarak Hands-Free veya kulaklık adını taşıyan girişi seçin.</p>
<h3>USB mikrofonlar</h3>
<p>USB mikrofonlar genellikle sürücü gerektirmez ve listede kendi model adıyla görünür. Ses gelmiyorsa mikrofonun üzerindeki sessiz düğmesini, kazanç düğmesini ve farklı bir USB portunu kontrol edin.</p>
<h3>Telefon mikrofon testi</h3>
<p>Telefonda sayfayı tarayıcıda açıp izni verdiğinizde test aynı şekilde çalışır. Android'de izni daha önce reddettiyseniz Ayarlar &gt; Uygulamalar bölümünden tarayıcınızı seçip İzinler altında mikrofonu açın; iPhone'da Ayarlar &gt; Safari &gt; Mikrofon yolunu kullanın. Telefon kılıfının veya ekran koruyucunun mikrofon deliklerini kapatmadığından emin olun.</p>

<h2>Sık görülen sorunlar ve çözümleri</h2>
<table>
<thead>
<tr><th>Belirti</th><th>Olası neden</th><th>Çözüm</th></tr>
</thead>
<tbody>
<tr><td>İzin penceresi hiç çıkmıyor</td><td>İzin daha önce reddedilmiş</td><td>Adres çubuğundaki site izinlerinden mikrofonu açıp sayfayı yenileyin</td></tr>
<tr><td>İzin verildi ama seviye göstergesi hareketsiz</td><td>Yanlış cihaz seçili veya işletim sistemi erişimi kapalı</td><td>Listeden başka mikrofonu seçin; Windows veya macOS gizlilik ayarlarını kontrol edin</td></tr>
<tr><td>Liste boş, mikrofon görünmüyor</td><td>Cihaz tanınmıyor veya devre dışı</td><td>Bağlantıyı değiştirin; Aygıt Yöneticisi'nde cihazı etkinleştirin veya sürücüyü yeniden yükleyin</td></tr>
<tr><td>Ses çok kısık</td><td>Giriş düzeyi düşük, mikrofon uzakta</td><td>Ayarlar &gt; Sistem &gt; Ses altında giriş düzeyini artırın; mikrofona yaklaşın</td></tr>
<tr><td>Ses cızırtılı veya bozuk</td><td>Kazanç çok yüksek, gevşek kablo</td><td>Giriş düzeyini düşürün; kabloyu ve fişi kontrol edin</td></tr>
<tr><td>Kayıtta sürekli uğultu</td><td>Fan, klima veya topraklama gürültüsü</td><td>Gürültü kaynağından uzaklaşın; laptopu şarjdan çıkarıp tekrar deneyin</td></tr>
<tr><td>Kulaklık mikrofonu algılanmıyor</td><td>Fiş tipi uyumsuz veya yanlış giriş</td><td>Birleşik girişte dört kutuplu fiş kullanın; masaüstünde ayırıcı kablo deneyin</td></tr>
</tbody>
</table>
<div class="tm-callout tm-callout--tip">
<p><strong>İpucu:</strong> Mikrofon bu testte sorunsuz çalışıyor ama toplantı uygulamasında karşı taraf sizi duymuyorsa sorun donanımda değildir. Uygulamanın kendi ses ayarlarını açın ve orada seçili mikrofonun, testte doğru çalışan cihazla aynı olduğunu kontrol edin. Uygulama içindeki sessiz düğmesinin açık kalması da sık yaşanan bir durumdur.</p>
</div>
<p>Bu adımlar sorunu çözmediyse <a href="{post:mikrofon-calismiyor}">mikrofon çalışmıyor</a> rehberimizde Windows 11, laptop ve kulaklık için daha ayrıntılı çözümler bulabilirsiniz.</p>

<h2>Daha temiz bir ses için ipuçları</h2>
<ul>
<li><strong>Mesafe:</strong> Masaüstü ve USB mikrofonlarda ağzınızla mikrofon arasında bir karış kadar mesafe bırakın. Çok yaklaşmak boğuk ve patlamalı bir ses, çok uzaklaşmak ise odanın yankısını getirir.</li>
<li><strong>Açı:</strong> Mikrofonu doğrudan ağzınızın önüne değil, biraz yanına yerleştirin. Böylece P ve B harflerindeki hava patlamaları kayda daha az yansır.</li>
<li><strong>Ortam:</strong> Halı, perde ve kitaplık gibi yumuşak yüzeyler yankıyı azaltır. Boş ve sert duvarlı odalarda ses daha uzaktan geliyormuş gibi duyulur.</li>
<li><strong>Karşılaştırma:</strong> Birden fazla mikrofonunuz varsa her biriyle aynı cümleyi 5 saniye kaydedip dinleyin. Hangisinin daha net olduğunu kulağınızla kolayca anlarsınız.</li>
</ul>

<h2>Gizlilik: sesiniz cihazınızdan çıkmaz</h2>
<p>Mikrofon testi tamamen tarayıcınızda çalışır. Canlı ses ve 5 saniyelik kayıt hiçbir sunucuya yüklenmez, hiçbir yerde saklanmaz. Kayıt yalnızca siz dinleyebilesiniz diye tarayıcının belleğinde tutulur ve sayfadan ayrıldığınızda kaybolur.</p>

<h2>Görüntülü görüşme öncesi diğer kontroller</h2>
<p>Mikrofonunuz hazırsa görüntünüzü <a href="{tool:kamera-testi}">kamera testi</a> ile, karşı tarafı net duyup duymadığınızı <a href="{tool:hoparlor-testi}">hoparlör ve kulaklık testi</a> ile kontrol edin. Kamera görüntü vermiyorsa <a href="{post:laptop-kamera-calismiyor}">laptop kamera çalışmıyor</a> rehberine bakın. Mikrofon kulaklıkta ya da telefonda sorun çıkarıyorsa <a href="{post:kulaklik-mikrofon-calismiyor}">kulaklık mikrofonu çalışmıyor</a> ve <a href="{post:telefon-mikrofon-calismiyor}">telefon mikrofonu çalışmıyor</a> rehberleri işinize yarar. İkinci el laptop alırken mikrofonu, tuşları <a href="{tool:klavye-testi}">klavye testi</a> ile ve tüm donanımı <a href="{post:ikinci-el-laptop-kontrol}">ikinci el laptop kontrol listesi</a> ile birlikte deneyin.</p>
HTML
	,
	'faqs'        => array(
		array( 'q' => 'Mikrofon testi nasıl yapılır?', 'a' => 'Testi başlatıp tarayıcının mikrofon iznini onaylayın, listeden mikrofonunuzu seçin ve konuşun. Seviye göstergesi hareket ediyorsa mikrofon ses alıyordur. 5 saniye kaydet düğmesiyle kısa bir kayıt alıp dinleyerek ses kalitesini de kontrol edebilirsiniz.' ),
		array( 'q' => 'Mikrofon izni verdim ama ses gelmiyor, neden?', 'a' => 'Büyük ihtimalle yanlış mikrofon seçilidir ya da işletim sistemi erişimi engelliyordur. Önce listeden başka bir mikrofonu deneyin. Windows 11 için Ayarlar > Gizlilik ve güvenlik > Mikrofon, macOS için Sistem Ayarları > Gizlilik ve Güvenlik > Mikrofon bölümünde tarayıcınızın izinli olduğundan emin olun.' ),
		array( 'q' => 'Kulaklık mikrofon testi nasıl yapılır?', 'a' => 'Kulaklığı bağlayın, testi başlatın ve açılır listeden kulaklığın mikrofonunu seçin. Kablolu kulaklıklarda laptopun birleşik girişi dört kutuplu fiş ister. Bluetooth kulaklıklarda mikrofon açıldığında ses kalitesinin düşmesi normaldir.' ),
		array( 'q' => 'Telefon mikrofon testi yapılabilir mi?', 'a' => 'Evet. Sayfayı telefonunuzun tarayıcısında açıp mikrofon iznini verin; seviye göstergesi ve kayıt özelliği aynı şekilde çalışır. İzin daha önce reddedildiyse iPhone için Ayarlar > Safari > Mikrofon, Android için tarayıcının uygulama izinlerini kontrol edin.' ),
		array( 'q' => 'Seviye göstergesi sürekli en üstte, bu sorun mu?', 'a' => 'Konuşurken tepe seviye sık sık en üste dayanıyorsa mikrofon kazancı fazladır ve ses bozulabilir. Windows 11 için Ayarlar > Sistem > Ses altında, macOS için Sistem Ayarları > Ses > Giriş bölümünde giriş düzeyini biraz düşürün.' ),
		array( 'q' => 'Kaydettiğim ses bir yere yükleniyor mu?', 'a' => 'Hayır. Test tamamen tarayıcınızda çalışır; canlı ses ve 5 saniyelik kayıt hiçbir sunucuya gönderilmez ve saklanmaz. Kayıt yalnızca dinleyebilmeniz için tarayıcının belleğinde tutulur.' ),
		array( 'q' => 'Örnekleme hızı ne anlama geliyor?', 'a' => 'Örnekleme hızı, mikrofondan saniyede kaç ses örneği alındığını gösterir. Bilgisayarlarda 44.100 Hz ve 48.000 Hz yaygındır ve konuşma için fazlasıyla yeterlidir. Bluetooth kulaklıklarda daha düşük değerler görülebilir.' ),
	),
);
