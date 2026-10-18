<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'Kulaklık Mikrofonu Çalışmıyor? Kablolu ve Bluetooth Çözümleri',
	'seo_title'   => 'Kulaklık Mikrofon Çalışmıyor? Kablolu ve Bluetooth | Testmatik',
	'description' => 'Kulaklık mikrofon çalışmıyor mu? 3,5 mm jak uyumu, Bluetooth profilleri, PS5, Xbox ve Discord ayarlarıyla kablolu ve kablosuz kulaklık sorunlarını çözün.',
	'keywords'    => array( 'kulaklık mikrofon çalışmıyor', 'kulaklık mikrofon testi', 'bluetooth kulaklık mikrofon sorunu', 'oyuncu kulaklığı mikrofon', 'hyperx mikrofon çalışmıyor' ),
	'intro'       => 'Kulaklıktan ses geliyor ama karşı taraf sizi duymuyorsa sorun çoğu zaman jak tipinde, Bluetooth profilinde veya bir sessize alma düğmesindedir. Kablolu, kablosuz ve konsol kulaklıkları için adım adım çözümler.',
	'excerpt'     => 'Kulaklık mikrofonu çalışmıyorsa nedeni jak uyumsuzluğu, Bluetooth profili veya konsol ayarı olabilir. Kablolu, Bluetooth ve oyuncu kulaklıkları için çözümler.',
	'category'    => 'Ses',
	'tool'        => 'mikrofon-testi',
	'date'        => '2026-11-02 06:00:00',
	'html'        => <<<'HTML'
<h2>Kulaklık mikrofonu neden çalışmaz?</h2>
<p>Kulaklık mikrofonu sorunları, bilgisayarın dahili mikrofonundaki sorunlardan farklıdır. Burada işin içine kablo ve jak tipi, Bluetooth bağlantı profili, kulaklığın üzerindeki sessize alma düğmesi ve kullandığınız platformun (PC, PS5, Xbox, Discord) kendi ses ayarları girer. Bu yüzden genel Windows çözümlerinden önce kulaklığa özgü noktaları kontrol etmek daha hızlı sonuç verir.</p>
<p>Windows'taki genel adımları, yani gizlilik izinlerini ve sürücü ayarlarını <a href="{post:mikrofon-calismiyor}">mikrofon çalışmıyor</a> rehberimizde anlatıyoruz. Bu yazı kulaklıklara, konsollara ve Bluetooth bağlantılara odaklanıyor.</p>
<table>
<thead>
<tr><th>Belirti</th><th>Olası neden</th><th>İlk çözüm</th></tr>
</thead>
<tbody>
<tr><td>Ses geliyor, mikrofon hiç algılanmıyor</td><td>Jak uyumsuzluğu (3 ve 4 kutuplu)</td><td>Doğru girişe takmak veya ayırıcı adaptör</td></tr>
<tr><td>Bluetooth'ta mikrofon yok ya da ses kalitesi düşüyor</td><td>Yanlış profil seçimi (A2DP / HFP)</td><td>Windows'ta "Hands-Free" cihazını seçmek</td></tr>
<tr><td>Mikrofon seviyesi hiç kıpırdamıyor</td><td>Kulaklıktaki sessize alma düğmesi</td><td>Düğmeyi, ışığı ve mikrofon kolunu kontrol etmek</td></tr>
<tr><td>PC'de çalışıyor, konsolda çalışmıyor</td><td>Konsol giriş cihazı veya parti ayarı</td><td>Konsolun ses menüsünden girişi seçmek</td></tr>
<tr><td>Sadece Discord'da duyulmuyor</td><td>Uygulamanın giriş cihazı veya hassasiyet ayarı</td><td>Ses ve Görüntü ayarlarını düzeltmek</td></tr>
</tbody>
</table>

<h2>Önce mikrofonu test edin</h2>
<p>Sorunun kulaklıkta mı yoksa bir uygulamada mı olduğunu anlamanın en kolay yolu, mikrofonu uygulamalardan bağımsız olarak denemektir. <a href="{tool:mikrofon-testi}">Kulaklık mikrofon testi</a> aracımızı açın, tarayıcının mikrofon izni isteğini onaylayın ve açılır listeden kulaklığınızı seçin.</p>
<ol class="tm-steps">
<li>Listede kulaklığın adının görünüp görünmediğine bakın. Görünmüyorsa sorun bağlantı veya donanım tarafındadır.</li>
<li>Konuşurken canlı seviye göstergesinin ve dalga formunun hareket edip etmediğini izleyin.</li>
<li>"5 saniye kaydet" düğmesine basın, birkaç cümle söyleyin ve kaydı dinleyin.</li>
<li>Gösterilen cihaz adı, örnekleme hızı ve kanal sayısına bakın. Bluetooth kulaklıklarda düşük bir örnekleme hızı görmeniz normaldir.</li>
</ol>
<p>Kayıt temiz geliyorsa kulaklık sağlamdır; sorun konsolda veya kullandığınız uygulamadadır. Test tamamen tarayıcınızda çalışır ve ses kaydınız hiçbir sunucuya yüklenmez.</p>

<div class="tm-cta" data-tool="mikrofon-testi"></div>

<h2>Kablolu kulaklıklar: jak tipi ve bağlantı</h2>
<h3>3 kutuplu ve 4 kutuplu jak farkı</h3>
<p>Mikrofonlu kulaklıkların çoğu tek bir 3,5 mm jak kullanır ve bu jakın ucunda üç siyah çizgiyle ayrılmış dört bölüm bulunur. Buna 4 kutuplu (TRRS) jak denir; ses ve mikrofon aynı uçtan geçer. Yalnızca iki çizgisi olan 3 kutuplu (TRS) jak ise sadece ses taşır, mikrofon sinyali yoktur.</p>
<p>Laptopların ve telefonların çoğunda kulaklık simgeli tek bir birleşik giriş bulunur ve 4 kutuplu jakı destekler. Masaüstü bilgisayarlarda ise genellikle ayrı yeşil (ses çıkışı) ve pembe (mikrofon) girişler vardır. Tek jaklı bir kulaklığı yalnızca yeşil girişe takarsanız ses gelir ama mikrofon çalışmaz. Bu durumda bir ucu dişi 4 kutuplu, diğer ucu ayrı ses ve mikrofon fişi olan bir ayırıcı (Y) adaptör kullanmanız gerekir.</p>
<div class="tm-callout tm-callout--tip">
<p><strong>İpucu:</strong> Bazı eski kulaklık ve telefonlar farklı bir kablolama standardı (OMTP) kullanır. Mikrofon çok kısık geliyor veya ses yalnızca konuşurken bozuluyorsa kulaklığı başka bir cihazda deneyin; sorun bu uyumsuzluk olabilir.</p>
</div>
<h3>USB ve USB-C kulaklıklar</h3>
<p>USB kulaklıklar kendi ses kartıyla gelir ve Windows'ta ayrı bir ses cihazı olarak görünür. Mikrofonu algılanmıyorsa farklı bir USB portu deneyin, USB çoklayıcı yerine doğrudan bilgisayara takın ve <strong>Ayarlar &gt; Sistem &gt; Ses</strong> sayfasındaki <strong>Giriş</strong> bölümünde doğru cihazın seçili olduğundan emin olun. Oyuncu kulaklıklarının bazıları 3,5 mm jakla birlikte bir USB ses adaptörüyle gelir; adaptörün üzerindeki sessize alma düğmesini de kontrol edin.</p>

<h2>Sessize alma düğmesi ve mikrofon kolu</h2>
<p>En sık gözden kaçan neden budur. Birçok kulaklıkta kablonun üzerinde bir kontrol ünitesi, kulak kabının üzerinde bir düğme ya da mikrofon kolunu yukarı kaldırınca sessize alan bir mekanizma bulunur. Bazı modellerde sessize alındığını gösteren küçük bir ışık yanar.</p>
<ul>
<li>Kablodaki kontrol ünitesinde mikrofon anahtarının açık konumda olduğunu kontrol edin.</li>
<li>Kolu yukarı kaldırınca susan modellerde kolu tamamen aşağı indirin.</li>
<li>Çıkarılabilir mikrofonlu kulaklıklarda mikrofonu yuvasına sonuna kadar itin. HyperX ve benzeri oyuncu kulaklıklarında yarım takılmış bir mikrofon, "hyperx mikrofon çalışmıyor" şikâyetlerinde ilk kontrol edilmesi gereken noktadır.</li>
<li>Üreticinin yazılımı varsa (örneğin HyperX NGENUITY, Logitech G HUB, SteelSeries GG) uygulama içinde mikrofonun kapalı olmadığını kontrol edin.</li>
</ul>

<h2>Bluetooth kulaklıklarda mikrofon sorunu</h2>
<p>Bluetooth kulaklıklar iki farklı profil kullanır. A2DP profili yüksek kaliteli stereo müzik içindir ama mikrofonu desteklemez. HFP (Hands-Free) veya HSP profili mikrofonu etkinleştirir, ancak bu modda ses kalitesi belirgin biçimde düşer. Windows bu yüzden aynı kulaklığı iki ayrı cihaz olarak gösterebilir: biri müzik için, diğeri adında "Hands-Free" geçen mikrofonlu bağlantı için.</p>
<ol class="tm-steps">
<li><strong>Ayarlar &gt; Sistem &gt; Ses</strong> sayfasında giriş cihazı olarak kulaklığın Hands-Free bağlantısını seçin.</li>
<li>Kullandığınız uygulamada (Zoom, Teams, Discord) hem giriş hem çıkış cihazını aynı Hands-Free bağlantıya ayarlayın.</li>
<li>Mikrofon hâlâ çalışmıyorsa kulaklığı <strong>Ayarlar &gt; Bluetooth ve cihazlar</strong> bölümünden kaldırıp yeniden eşleştirin.</li>
<li>Kulaklık aynı anda telefonunuza da bağlıysa telefondaki Bluetooth'u kapatın; çoklu bağlantı mikrofonu başka cihaza yönlendirebilir.</li>
</ol>
<p>Görüşme sırasında müziğin boğuklaşması bir arıza değil, profil değişiminin doğal sonucudur. Yeni nesil Bluetooth LE Audio destekli kulaklıklar ve uyumlu bilgisayarlar bu kalite düşüşünü azaltabilir, ancak bunun için hem kulaklığın hem bilgisayarın donanımının bu özelliği desteklemesi gerekir. Kayıt kalitesinin önemli olduğu durumlarda kablolu bağlantı veya kulaklığın kendi USB alıcısı daha iyi sonuç verir.</p>

<h2>Oyuncu kulaklığı mikrofonu: PS5, Xbox ve Discord</h2>
<h3>PS5</h3>
<p>Kulaklığı DualSense kolunun altındaki 3,5 mm girişe, USB porta veya kulaklığın kablosuz alıcısıyla bağlayabilirsiniz. Kolun ortasındaki mikrofon düğmesi sessize alma işlevi görür; turuncu yanıyorsa mikrofon kapalıdır. <strong>Ayarlar &gt; Ses &gt; Mikrofon</strong> bölümünden giriş cihazını seçebilir ve mikrofon seviyesini ayarlayabilirsiniz. PS5 genel olarak Bluetooth kulaklıklarla doğrudan ses bağlantısını desteklemez; Bluetooth kulaklık kullanacaksanız bir USB adaptör gerekebilir.</p>
<h3>Xbox</h3>
<p>Xbox Kablosuz Oyun Kumandası'nın altında 3,5 mm kulaklık girişi bulunur. Kulaklığı takın ve <strong>Ayarlar &gt; Genel &gt; Ses seviyesi ve ses çıkışı</strong> bölümünden mikrofon izleme ve sohbet ayarlarını kontrol edin. Mikrofonunuz arkadaşlarınızla çalışıp oyunda çalışmıyorsa hesabınızın gizlilik ve sesli sohbet izinlerine bakın. Xbox da standart Bluetooth kulaklıkları ses için doğrudan desteklemez; Xbox uyumlu kablosuz kulaklıklar kendi bağlantı yöntemini kullanır.</p>
<h3>Discord</h3>
<p>Discord'da <strong>Kullanıcı Ayarları &gt; Ses ve Görüntü</strong> bölümünü açın. <strong>Giriş Cihazı</strong> olarak "Varsayılan" yerine doğrudan kulaklığınızı seçin. Giriş modu "Ses Etkinliği" ise giriş hassasiyeti çubuğunun konuşmanızı yakalayacak seviyede olduğunu kontrol edin; çok yüksekse sesiniz hiç iletilmez. Aynı sayfadaki mikrofon testiyle kendinizi duyabilirsiniz. Bir değişiklikten sonra sorun sürerse ses ayarlarını sıfırlama seçeneğini deneyin.</p>

<h2>Mikrofon çalışıyor ama ses kötü geliyorsa</h2>
<p>Bazen mikrofon algılanır ama karşı taraf sesinizi çok kısık, boğuk veya cızırtılı duyar. Bu da kulaklık mikrofonlarında sık görülen bir durumdur ve genellikle birkaç ayarla düzelir.</p>
<ul>
<li><strong>Mikrofon çok kısık:</strong> Windows'ta <strong>Ayarlar &gt; Sistem &gt; Ses</strong> sayfasında giriş cihazına tıklayın ve giriş ses düzeyini artırın. Mikrofon kolunu ağzınızın birkaç santim yanına getirin.</li>
<li><strong>Ses boğuk:</strong> Bluetooth kulaklık kullanıyorsanız bu, Hands-Free profilinin doğal sınırıdır. Mümkünse kablolu bağlantıya veya kulaklığın USB alıcısına geçin.</li>
<li><strong>Cızırtı ve uğultu:</strong> Kabloyu güç adaptörlerinden uzak tutun, USB hub yerine doğrudan porta takın ve masaüstünde ön panel yerine arka paneldeki girişi deneyin.</li>
<li><strong>Kendi sesiniz yankılanıyor:</strong> Karşı taraf kendi sesini duyuyorsa onun hoparlörü mikrofonuna sızıyor olabilir; kulaklık kullanmasını önerin.</li>
</ul>
<p>Her değişiklikten sonra mikrofon testindeki 5 saniyelik kaydı tekrar dinleyin. Seviye göstergesi konuşurken orta bölgeye ulaşıyor ve tepe seviyesi sürekli en üstte kalmıyorsa ayar dengelidir.</p>

<h2>Hâlâ çalışmıyorsa</h2>
<ul>
<li>Kulaklığı bir telefonda veya başka bir bilgisayarda deneyin. Hiçbir cihazda mikrofon çalışmıyorsa kablo veya mikrofon kapsülü arızalı olabilir.</li>
<li>Kabloyu jaka yakın yerden hafifçe oynatırken mikrofon testinde seviyenin kesilip gelmediğini izleyin; kesiliyorsa kabloda kopukluk vardır.</li>
<li>Garanti süresi devam ediyorsa test sonuçlarınızla satıcıya veya üreticiye başvurun.</li>
</ul>
<p>Mikrofon tarafını çözdükten sonra kulaklığın iki kanalını da <a href="{tool:hoparlor-testi}">sağ sol ses testi</a> ile kontrol edebilir, ayrıntılı adımlar için <a href="{post:kulaklik-testi-sag-sol}">kulaklık testi</a> rehberimize bakabilirsiniz. Görüntülü görüşme kurulumunuzu tamamlamak için <a href="{tool:kamera-testi}">web kamera testi</a> yapabilir, görüntü sorunlarında <a href="{post:laptop-kamera-calismiyor}">laptop kamera çalışmıyor</a> yazımızı okuyabilirsiniz. Sorun telefonunuzun kendi mikrofonundaysa <a href="{post:telefon-mikrofon-calismiyor}">telefon mikrofonu çalışmıyor</a> rehberimiz iPhone ve Android için ayrı çözümler sunuyor.</p>
HTML
	,
	'faqs'        => array(
		array( 'q' => 'Kulaklıktan ses geliyor ama mikrofon neden çalışmıyor?', 'a' => 'En sık neden jak uyumsuzluğudur: tek jaklı 4 kutuplu bir kulaklık, masaüstündeki yalnızca ses çıkışı olan yeşil girişe takıldığında mikrofon çalışmaz. Kulaklıktaki sessize alma düğmesi veya yanlış seçilmiş giriş cihazı da aynı belirtiye yol açar.' ),
		array( 'q' => 'Bluetooth kulaklık mikrofonunu kullanınca ses neden kötüleşiyor?', 'a' => 'Mikrofon açıldığında kulaklık, müzik için kullanılan A2DP profilinden mikrofonu destekleyen Hands-Free profiline geçer. Bu profil daha düşük ses kalitesiyle çalışır. Bu bir arıza değildir; yüksek kalite gerekiyorsa kablolu bağlantı daha iyi sonuç verir.' ),
		array( 'q' => 'Masaüstü bilgisayarda tek jaklı kulaklığın mikrofonu nasıl çalışır?', 'a' => 'Ayrı yeşil ve pembe girişleri olan masaüstü bilgisayarlarda ayırıcı (Y) adaptör kullanmanız gerekir. Adaptör, kulaklığın 4 kutuplu jakını ayrı ses ve mikrofon fişlerine böler. Ön paneldeki birleşik giriş varsa doğrudan oraya da takabilirsiniz.' ),
		array( 'q' => 'PS5\'te kulaklık mikrofonu neden çalışmıyor?', 'a' => 'Önce DualSense kolundaki mikrofon düğmesinin turuncu yanmadığından emin olun. Ardından Ayarlar > Ses > Mikrofon bölümünden doğru giriş cihazını seçin ve seviyeyi kontrol edin. Kulaklığı kolun 3,5 mm girişine tam oturacak şekilde taktığınızı da doğrulayın.' ),
		array( 'q' => 'Discord\'da mikrofonum neden duyulmuyor?', 'a' => 'Ses ve Görüntü ayarlarında giriş cihazının doğru kulaklık olduğundan ve giriş hassasiyetinin çok yüksek ayarlanmadığından emin olun. Bas-Konuş modu açıksa konuşurken atadığınız tuşa basmanız gerekir. Mikrofon tarayıcı testinde çalışıyorsa sorun Discord ayarlarındadır.' ),
		array( 'q' => 'Kulaklık mikrofon testi kaydımı saklıyor mu?', 'a' => 'Hayır. Mikrofon testi tamamen tarayıcınızda çalışır; ses ve kayıtlar hiçbir sunucuya yüklenmez. Sayfayı kapattığınızda 5 saniyelik kayıt da silinir.' ),
	),
);
