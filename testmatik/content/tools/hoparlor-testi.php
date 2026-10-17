<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'Hoparlör Testi',
	'seo_title'   => 'Hoparlör Testi: Sağ Sol Ses ve Kulaklık Testi | Testmatik',
	'description' => 'Ücretsiz hoparlör testi: sağ sol ses testiyle kanalları ayrı ayrı dinleyin, kulaklığınızı deneyin, 20 Hz–20 kHz frekans taraması ile cızırtıyı yakalayın.',
	'keywords'    => array( 'hoparlör testi', 'sağ sol ses testi', 'kulaklık testi', 'stereo ses testi', 'ses frekans testi' ),
	'intro'       => 'Hoparlörünüzün veya kulaklığınızın sol ve sağ kanalını ayrı ayrı dinleyin, frekans taramasıyla bas ve tiz performansını kontrol edin. Kurulum gerekmez, her şey tarayıcıda çalışır.',
	'html'        => <<<'HTML'
<h2>Hoparlör testi nasıl yapılır?</h2>
<p>Bu araç, hoparlörlerinizin veya kulaklığınızın ses verip vermediğini, sol ve sağ kanalların doğru yerde olup olmadığını ve farklı frekanslarda cızırtı ya da titreşim yapıp yapmadığını anlamanızı sağlar. Laptop hoparlörleri, masaüstü hoparlörler, kablolu kulaklıklar ve Bluetooth kulaklıklarla çalışır.</p>
<div class="tm-callout tm-callout--warn">
<p><strong>Uyarı:</strong> Teste mutlaka düşük ses seviyesiyle başlayın, özellikle kulaklık kullanıyorsanız. Test tonları sürekli ve tek frekanslı olduğu için müzikten daha yüksek ve rahatsız edici algılanabilir. Sesi ancak tonu rahatça duyduktan sonra yavaşça artırın.</p>
</div>
<ol class="tm-steps">
<li><strong>Ses seviyesini düşürün.</strong> Bilgisayarınızın genel sesini yaklaşık %20–30'a, sayfadaki ses kaydırıcısını da düşük bir seviyeye getirin.</li>
<li><strong>Sol kanalı deneyin.</strong> <strong>Sol</strong> düğmesine basın. Ses yalnızca sol hoparlörden veya sol kulaklıktan gelmelidir.</li>
<li><strong>Sağ kanalı deneyin.</strong> <strong>Sağ</strong> düğmesine basın. Bu kez ses yalnızca sağ taraftan gelmelidir.</li>
<li><strong>İki kanalı birlikte dinleyin.</strong> <strong>Her iki</strong> düğmesiyle ses ortadan, iki taraftan eşit gelmelidir.</li>
<li><strong>Frekans taramasını başlatın.</strong> Tarama 20 Hz'den 20 kHz'e kadar yükselir ve o anki frekansı ekranda gösterir. Cızırtı, tıkırtı veya sesin kesildiği noktaları not edin.</li>
<li><strong>Belirli bir frekansı inceleyin.</strong> Taramada sorun duyduğunuz frekansı ton üretecine girerek o sesi sürekli çalın ve kaynağını arayın.</li>
</ol>

<h2>Sonuçlar nasıl okunur?</h2>
<h3>Sağ sol ses testi</h3>
<p>Sol düğmesine bastığınızda ses sağdan geliyorsa kanallar ters bağlanmıştır. Bir tarafta hiç ses yoksa kablo, jak, hoparlör ya da kulaklığın o tarafı arızalı olabilir. Ses her iki taraftan eşit geliyorsa ve bu sırada sol veya sağ düğmesine basıyorsanız, işletim sistemindeki <strong>mono ses</strong> ayarı açık olabilir.</p>
<p>“Her iki” modunda ses bir tarafa kaymış gibi geliyorsa denge (balance) ayarını kontrol edin. Kulaklıklarda bu durum tek bir kulaklık hoparlörünün zayıflamasından da kaynaklanabilir.</p>
<h3>Frekans taraması ve duyma aralığı</h3>
<p>İnsan kulağı yaklaşık olarak 20 Hz ile 20 kHz arasındaki sesleri duyar. Bu aralık kişiden kişiye değişir ve üst sınır yaşla birlikte belirgin biçimde düşer. Bu yüzden tarama sonuna yaklaşırken sesi duymayı bırakmanız genellikle hoparlörünüzle değil, kulağınızın doğal sınırıyla ilgilidir. Aynı testi daha genç biri yaptığında daha yüksek frekansları duyabilir.</p>
<p>Alt uçta durum farklıdır: çok düşük frekanslarda (yaklaşık 20–60 Hz) sesi duymuyorsanız bunun nedeni büyük olasılıkla hoparlörün kendisidir. Küçük hoparlörler fiziksel olarak derin bas üretemez. Bu aralıkta sesi duymak yerine titreşim olarak hissedebilirsiniz.</p>
<table>
<thead>
<tr><th>Frekans aralığı</th><th>Ne duyulur?</th><th>Dikkat edilecek nokta</th></tr>
</thead>
<tbody>
<tr><td>20–60 Hz</td><td>Derin bas, daha çok hissedilir</td><td>Laptop ve küçük hoparlörler bu aralıkta çoğunlukla sessizdir</td></tr>
<tr><td>60–250 Hz</td><td>Bas ve davul vuruşları</td><td>Kasa titremesi ve cızırtı en sık bu aralıkta ortaya çıkar</td></tr>
<tr><td>250 Hz – 4 kHz</td><td>Konuşma ve vokaller</td><td>Bu aralıkta bozulma, görüşmelerde konuşmayı anlaşılmaz yapar</td></tr>
<tr><td>4–12 kHz</td><td>Netlik, “s” ve “ş” sesleri</td><td>Tiz hoparlörü (tweeter) arızasında bu bölge kaybolur</td></tr>
<tr><td>12–20 kHz</td><td>Çok ince tiz</td><td>Duyamamanız çoğunlukla yaşa bağlı ve normaldir</td></tr>
</tbody>
</table>

<h2>Sık görülen hoparlör ve kulaklık sorunları</h2>
<table>
<thead>
<tr><th>Belirti</th><th>Olası neden</th><th>Çözüm</th></tr>
</thead>
<tbody>
<tr><td>Sol ve sağ ters</td><td>Hoparlörler yer değiştirmiş, kulaklık ters takılmış</td><td>Hoparlörlerin yerini veya kablolarını değiştirin, kulaklıktaki L/R işaretlerine bakın</td></tr>
<tr><td>Tek taraftan ses geliyor</td><td>Kopuk kablo, yarım takılmış jak, denge ayarı</td><td>Jakı sonuna kadar takın, kabloyu oynatarak deneyin, denge ayarını ortalayın</td></tr>
<tr><td>Sol/sağ düğmesi fark etmiyor</td><td>Mono ses ayarı açık</td><td>İşletim sisteminin erişilebilirlik ayarlarında mono sesi kapatın</td></tr>
<tr><td>Belirli frekansta cızırtı</td><td>Gevşek vida, kasa rezonansı, yırtık hoparlör zarı</td><td>Ton üreteciyle o frekansı çalıp titreşen parçayı bulun</td></tr>
<tr><td>Yüksek seste bozulma</td><td>Hoparlör veya amfi kapasitesini aşıyor</td><td>Sesi biraz kısın, ekolayzerde bası azaltın</td></tr>
<tr><td>Hiç ses yok</td><td>Yanlış çıkış aygıtı seçili veya ses kapalı</td><td>Ayarlar &gt; Sistem &gt; Ses bölümünde doğru çıkışı seçin</td></tr>
<tr><td>Bluetooth kulaklıkta ses kalitesi düşük</td><td>Kulaklık “kulaklık seti” (mikrofonlu) modunda</td><td>Mikrofonu kullanan uygulamaları kapatın veya stereo profili seçin</td></tr>
</tbody>
</table>

<h3>Ters kanalları bulma ve düzeltme</h3>
<p>Masaüstü hoparlörlerde kanalların ters olması çok yaygındır; çoğu zaman hoparlörler masaya yanlış tarafta yerleştirilmiştir. Hangi hoparlörün “sol” olduğunu bulmak için Sol düğmesine basın ve sesin geldiği hoparlörü sol tarafınıza alın. Kulaklıklarda ise kulaklığın üzerindeki <strong>L</strong> (sol) ve <strong>R</strong> (sağ) işaretlerini kontrol edin. Kanallar yine de terse dönüyorsa ses kartı yazılımında veya ekolayzer programında kanal değiştirme seçeneği olabilir.</p>
<h3>Cızırtı ve titreşim yapan hoparlörü tespit etme</h3>
<p>Frekans taraması sırasında belirli bir noktada vızıltı, tıkırtı ya da “zırr” sesi duyuyorsanız ekranda gösterilen frekansı not edin. Ardından bu frekansı ton üretecinde sürekli çalın ve parmağınızla hoparlör kasasına, ızgaraya ve yakındaki eşyalara hafifçe dokunun. Ses dokunduğunuzda kesiliyorsa sorun hoparlörün kendisi değil, titreşen bir parçadır. Ses değişmiyorsa hoparlör zarı veya bobini hasar görmüş olabilir.</p>

<h3>Masaüstü hoparlör ve subwoofer kurulumu</h3>
<p>2.1 sistemlerde (iki hoparlör ve bir subwoofer) frekans taraması, kurulumun dengeli olup olmadığını görmenin pratik bir yoludur. Tarama düşük frekanslardayken sesin büyük kısmı subwoofer'dan, yükseldikçe uydu hoparlörlerden gelmelidir. Geçiş sırasında sesin belirgin biçimde kaybolduğu bir bölge varsa subwoofer'ın ses ve geçiş (crossover) düğmelerini ayarlayın.</p>
<p>Subwoofer'ı duvara veya köşeye çok yakın koymak bası abartabilir ve belirli frekanslarda uğultu yaratabilir. Ton üretecinde 40–100 Hz arasında birkaç değer çalıp subwoofer'ı birkaç on santimetre oynatarak en dengeli konumu bulabilirsiniz. Uydu hoparlörleri ise kulak hizasına yakın ve size doğru hafifçe çevrilmiş olarak yerleştirin; bu, sağ sol ses ayrımını da belirginleştirir.</p>

<h2>Laptop hoparlörü, kulaklık ve Bluetooth farkları</h2>
<p><strong>Laptop hoparlörleri:</strong> Küçük boyutları nedeniyle derin bası iyi veremezler; taramanın başında sesi zayıf duymanız normaldir. Hoparlörler laptopun altında veya yanında olabilir, bu yüzden laptopu yumuşak bir yüzeye koymak sesi boğar. Sol ve sağ hoparlör birbirine yakın olduğu için stereo ayrımı kulaklıktaki kadar belirgin değildir.</p>
<p><strong>Kablolu kulaklık:</strong> Kanal testi için en net sonucu verir. Ses tek taraftan kesilip geliyorsa kabloyu jaka yakın yerden ve kulaklığa girdiği yerden hafifçe bükerek deneyin; kopukluk genellikle bu noktalardadır.</p>
<p><strong>Bluetooth kulaklık:</strong> Ses biraz gecikmeyle başlayabilir, bu normaldir. Bir uygulama mikrofonu açtığında birçok Bluetooth kulaklık daha düşük kaliteli bir moda geçer ve ses boğuklaşır. Testi yaparken görüşme uygulamalarını kapatmanız daha doğru sonuç verir. Mikrofonunuzu ayrıca denemek için <a href="{tool:mikrofon-testi}">kulaklık mikrofon testi</a> aracımızı kullanabilirsiniz.</p>

<h2>Windows, macOS ve telefon ayarları</h2>
<p><strong>Windows 11:</strong> <strong>Ayarlar &gt; Sistem &gt; Ses</strong> bölümünden doğru çıkış aygıtını seçin. Aygıtın adına tıkladığınızda açılan sayfada sol ve sağ kanal seviyelerini ayrı ayrı görebilir ve dengeleyebilirsiniz. Mono ses ayarı <strong>Ayarlar &gt; Erişilebilirlik &gt; Ses</strong> altındadır.</p>
<p><strong>macOS:</strong> <strong>Sistem Ayarları &gt; Ses &gt; Çıkış</strong> bölümünde aygıtı seçip <strong>Denge</strong> kaydırıcısını ortalayın. Mono ayarı <strong>Sistem Ayarları &gt; Erişilebilirlik &gt; Ses</strong> altında bulunur.</p>
<p><strong>Telefon:</strong> Telefonun tek bir hoparlörü varsa sol ve sağ kanal farkını duyamazsınız; kanal testi için kulaklık takın. Birçok telefonda erişilebilirlik ayarlarında da mono ses ve denge seçenekleri yer alır.</p>
<div class="tm-callout tm-callout--tip">
<p><strong>İpucu:</strong> Ses hiç gelmiyorsa önce sayfadaki ses kaydırıcısının, ardından tarayıcı sekmesinin sessize alınmadığından emin olun. Sekmenin başlığına sağ tıklayıp sitenin sesinin kapatılmadığını kontrol edebilirsiniz.</p>
</div>

<h2>Güvenli ses seviyesi</h2>
<p>Uzun süre yüksek seste dinlemek işitmeye kalıcı zarar verebilir. Test tonlarını kısa süreli ve düşük–orta seviyede çalın. Özellikle yüksek frekanslarda sesi duymadığınızı düşünerek sesi sonuna kadar açmayın; duymasanız bile ses kulaklarınıza ve hoparlörünüze ulaşıyor olabilir. Kulaklarınızda çınlama veya rahatsızlık hissederseniz testi hemen durdurun.</p>
<p>Kulak içi kulaklıklar ses kaynağını kulak kanalına çok yakın getirdiği için aynı ses seviyesi bunlarda daha yüksek algılanır. Bu nedenle kulaklıkla test yaparken ses kaydırıcısını hoparlöre göre daha da düşük tutun. Çocukların kullandığı cihazlarda testi bir yetişkinin başlatması ve ses seviyesini önceden ayarlaması iyi bir alışkanlıktır.</p>

<h2>Gizlilik</h2>
<p>Hoparlör testi tamamen tarayıcınızda çalışır. Sesler cihazınızda üretilir; hiçbir veri sunucuya gönderilmez ve saklanmaz. Bu test için mikrofon veya kamera izni de istenmez.</p>

<h2>İlgili testler ve rehberler</h2>
<p>Ses düzeninizin tamamını kontrol etmek için <a href="{tool:mikrofon-testi}">online mikrofon testi</a> ile kaydınızı dinleyin, görüntülü görüşmeler öncesinde <a href="{tool:kamera-testi}">web kamera testi</a> yapın. Oyun kurulumunuzu tamamlıyorsanız <a href="{tool:mouse-testi}">mouse test</a> aracıyla çift tıklama ve polling rate kontrolü, <a href="{tool:klavye-testi}">klavye testi</a> ile de tuş kontrolü yapabilirsiniz.</p>
<p>Mikrofonunuz sesinizi iletmiyorsa <a href="{post:mikrofon-calismiyor}">mikrofon çalışmıyor çözümleri</a> rehberimize, ikinci el bir laptop alacaksanız hoparlör dahil tüm donanım kontrollerini içeren <a href="{post:ikinci-el-laptop-kontrol}">ikinci el laptop alırken yapılması gereken 9 test</a> yazımıza göz atın.</p>
HTML
	,
	'faqs'        => array(
		array( 'q' => 'Sağ sol ses testi nasıl yapılır?', 'a' => 'Sesi düşük seviyeye alın, ardından Sol ve Sağ düğmelerine sırayla basın. Ses her seferinde yalnızca ilgili taraftan gelmelidir. Ters geliyorsa hoparlörlerin yerini değiştirin veya kulaklığın L ve R işaretlerini kontrol edin.' ),
		array( 'q' => 'Frekans taramasında yüksek sesleri duyamıyorum, hoparlörüm bozuk mu?', 'a' => 'Büyük olasılıkla hayır. İnsan kulağının duyma aralığı yaklaşık 20 Hz ile 20 kHz arasındadır ve üst sınır yaşla birlikte düşer. Tarama sonunda sesi duymamanız çoğunlukla kulağın doğal sınırıyla ilgilidir.' ),
		array( 'q' => 'Laptop hoparlörümde bas sesleri neden duyulmuyor?', 'a' => 'Laptop hoparlörleri çok küçük olduğu için derin bas frekanslarını fiziksel olarak üretemez. Taramanın başında sesin zayıf veya hiç duyulmaması normaldir. Bas performansını gerçekten test etmek için kulaklık veya harici hoparlör kullanın.' ),
		array( 'q' => 'Kulaklıktan sadece bir taraf ses veriyor, ne yapmalıyım?', 'a' => 'Önce jakı sonuna kadar takın ve işletim sistemindeki denge ayarının ortada olduğunu kontrol edin. Kabloyu jak ve kulaklık girişine yakın yerlerden hafifçe bükerek deneyin; ses gidip geliyorsa kablo kopuktur. Bluetooth kulaklıklarda iki kulaklığı sıfırlayıp yeniden eşleştirin.' ),
		array( 'q' => 'Sol ve sağ düğmesine basınca ses iki taraftan da geliyor, neden?', 'a' => 'İşletim sisteminizde mono ses ayarı açık olabilir. Windows 11 için Ayarlar > Erişilebilirlik > Ses, macOS için Sistem Ayarları > Erişilebilirlik > Ses bölümünü kontrol edin. Tek hoparlörlü telefonlarda da kanal ayrımı duyulmaz.' ),
		array( 'q' => 'Hoparlör testi kulaklarıma zarar verir mi?', 'a' => 'Düşük seviyede ve kısa süreli kullanıldığında zarar vermez. Teste her zaman düşük sesle başlayın, özellikle kulaklıkla. Duymadığınız yüksek frekanslarda sesi sonuna kadar açmayın ve rahatsızlık hissederseniz hemen durdurun.' ),
		array( 'q' => 'Hoparlörümün cızırtı yaptığı frekansı nasıl bulurum?', 'a' => 'Frekans taramasını başlatın ve cızırtının duyulduğu anda ekranda gösterilen frekansı not edin. Ardından bu frekansı ton üretecinde sürekli çalarak kasaya ve çevredeki eşyalara dokunun. Böylece sesin hoparlörden mi yoksa titreşen bir parçadan mı geldiğini anlarsınız.' ),
	),
);
