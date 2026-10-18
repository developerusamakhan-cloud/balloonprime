<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'Monitör Hz Ayarlama: Ekran Yenileme Hızı Nasıl Değiştirilir?',
	'seo_title'   => 'Monitör Hz Ayarlama: Yenileme Hızı Değiştirme | Testmatik',
	'description' => 'Monitör Hz ayarlama rehberi: Windows 11, Windows 10 ve ekran kartı panelinde yenileme hızını 144 Hz veya üstüne çekin, kablo sınırlarını kontrol edin.',
	'keywords'    => array( 'monitör hz ayarlama', 'ekran hz testi', 'monitör hz nedir', 'monitör hz ayarlama win 11', '144 hz ayarlama' ),
	'intro'       => '144 Hz bir monitör aldınız ama her şey hâlâ 60 Hz gibi mi görünüyor? Yenileme hızı çoğu zaman elle seçilmesi gereken bir ayardır. Windows ve ekran kartı ayarlarını adım adım anlatıyoruz.',
	'excerpt'     => 'Monitörünüzün yenileme hızını Windows 11, Windows 10 ve ekran kartı panelinden nasıl değiştireceğinizi, kablo sınırlarını ve Hz değerinin nasıl kontrol edileceğini anlatıyoruz.',
	'category'    => 'Ekran',
	'tool'        => 'olu-piksel-testi',
	'date'        => '2026-10-25 06:00:00',
	'html'        => <<<'HTML'
<h2>Monitör Hz nedir?</h2>
<p>Hz (hertz), monitörün ekrandaki görüntüyü saniyede kaç kez yenilediğini gösterir. 60 Hz bir monitör görüntüyü saniyede 60 kez, 144 Hz bir monitör 144 kez çizer. Yenileme hızı arttıkça iki kare arasındaki süre kısalır: 60 Hz'de her kare yaklaşık 16,7 milisaniye ekranda kalırken bu süre 144 Hz'de yaklaşık 6,9 milisaniyeye düşer.</p>
<p>Bunun pratik karşılığı daha akıcı hareket ve daha net takiptir. Fare imleci, kaydırılan web sayfaları ve özellikle hızlı oyunlar yüksek yenileme hızında belirgin şekilde daha yumuşak görünür. Yalnız şunu unutmayın: Hz, monitörün gösterebileceği kare sayısının üst sınırıdır. Oyunun saniyede ürettiği kare sayısı (FPS) bu değerin çok altındaysa yüksek Hz'in faydası sınırlı kalır.</p>

<h2>Monitör neden düşük Hz'de çalışır?</h2>
<p>Yeni bir yüksek yenileme hızlı monitör takıldığında Windows her zaman en yüksek değeri otomatik seçmez. Birçok kullanıcı aylarca 60 Hz'de çalıştığını fark etmez. En sık nedenler şunlardır:</p>
<table>
<thead>
<tr><th>Neden</th><th>Belirti</th><th>Çözüm</th></tr>
</thead>
<tbody>
<tr><td>Windows'ta düşük değer seçili</td><td>Listede yüksek değer var ama 60 Hz seçili</td><td>Gelişmiş ekran ayarından değeri değiştirin</td></tr>
<tr><td>Yetersiz kablo veya port</td><td>Listede yüksek değer hiç görünmüyor</td><td>DisplayPort veya daha yeni bir HDMI sürümü kullanın</td></tr>
<tr><td>Kablo anakarta takılı</td><td>Masaüstünde düşük Hz, oyunlarda düşük performans</td><td>Kabloyu ekran kartının portuna takın</td></tr>
<tr><td>Eski veya genel ekran sürücüsü</td><td>Sınırlı çözünürlük ve Hz seçenekleri</td><td>Ekran kartı sürücüsünü güncelleyin</td></tr>
<tr><td>Laptopta güç tasarrufu</td><td>Prizden çıkınca Hz düşüyor</td><td>Güç modu ve dinamik yenileme hızı ayarlarını kontrol edin</td></tr>
</tbody>
</table>

<h2>Windows 11'de monitör Hz ayarlama</h2>
<p>Windows 11'de yenileme hızını değiştirmek birkaç tıklama sürer:</p>
<ol class="tm-steps">
<li>Masaüstünde boş bir yere sağ tıklayın ve <strong>Ekran ayarları</strong> seçeneğine tıklayın. Alternatif olarak <strong>Ayarlar &gt; Sistem &gt; Ekran</strong> yolunu izleyin.</li>
<li>Birden fazla monitörünüz varsa üstteki şemadan ayarlamak istediğiniz ekranı seçin.</li>
<li>Sayfanın alt kısmındaki <strong>Gelişmiş ekran</strong> bağlantısına tıklayın.</li>
<li><strong>Yenileme hızı seçin</strong> açılır listesinden en yüksek değeri, örneğin 144 Hz'i seçin.</li>
<li>Ekran kısa bir süre kararabilir. Görüntü geri geldiğinde açılan pencerede <strong>Değişiklikleri koru</strong> seçeneğine tıklayın.</li>
</ol>
<p>Aynı sayfada monitörün şu anda hangi yenileme hızında çalıştığı da yazar. Bu bilgi, ayrı bir program gerekmeden basit bir ekran Hz testi işlevi görür. Bazı laptoplarda listede "Dinamik" ile başlayan bir seçenek de bulunur. Bu mod, Windows'un yenileme hızını kullanıma göre otomatik değiştirmesine izin verir ve pil ömrüne katkı sağlar.</p>

<div class="tm-cta" data-tool="olu-piksel-testi"></div>

<h2>Windows 10'da yenileme hızını değiştirme</h2>
<p>Windows 10'da ayar biraz daha derindedir:</p>
<ol class="tm-steps">
<li><strong>Ayarlar &gt; Sistem &gt; Ekran</strong> sayfasını açın.</li>
<li><strong>Gelişmiş ekran ayarları</strong> bağlantısına tıklayın.</li>
<li>Güncel sürümlerde <strong>Yenileme hızı</strong> listesi doğrudan bu sayfada bulunur. Yoksa <strong>Ekran bağdaştırıcısı özellikleri</strong> bağlantısını açın.</li>
<li>Açılan pencerede <strong>Monitör</strong> sekmesine geçin ve <strong>Ekran yenileme hızı</strong> listesinden istediğiniz değeri seçip <strong>Tamam</strong> deyin.</li>
</ol>

<h2>Ekran kartı panelinden 144 Hz ayarlama</h2>
<p>Windows ayarı çoğu durumda yeterlidir, ancak ekran kartı yazılımı da aynı seçeneği sunar ve bazen daha fazla ayrıntı gösterir.</p>
<h3>NVIDIA</h3>
<p>Masaüstüne sağ tıklayıp <strong>NVIDIA Denetim Masası</strong> uygulamasını açın. <strong>Ekran &gt; Çözünürlüğü değiştir</strong> bölümünde monitörünüzü seçin ve <strong>Yenileme hızı</strong> listesinden en yüksek değeri belirleyin. Aynı menüdeki G-SYNC ayarları, uyumlu monitörlerde değişken yenileme hızını etkinleştirmenizi sağlar.</p>
<h3>AMD ve Intel</h3>
<p>AMD kartlarda <strong>AMD Software: Adrenalin Edition</strong> içindeki ekran ayarlarından FreeSync seçeneğini açabilirsiniz. Yenileme hızının kendisi genellikle Windows ayarlarından seçilir. Intel grafiklerde de aynı şekilde Windows ayarı ve Intel'in grafik yazılımı birlikte kullanılır.</p>
<div class="tm-callout tm-callout--tip">
<p><strong>İpucu:</strong> Değişken yenileme hızı (G-SYNC, FreeSync) kullanıyorsanız monitörün kendi menüsünde de bu özelliğin açık olduğundan emin olun. Bazı monitörlerde bu seçenek varsayılan olarak kapalı gelir.</p>
</div>

<h2>Kablo ve port sınırları</h2>
<p>Yenileme hızı listesinde beklediğiniz değer hiç yoksa sorun büyük olasılıkla bağlantıdadır. Her bağlantı standardının taşıyabileceği veri miktarı sınırlıdır ve yüksek çözünürlükle yüksek Hz birlikte daha fazla bant genişliği ister.</p>
<table>
<thead>
<tr><th>Bağlantı</th><th>4K'da tipik üst sınır</th><th>Not</th></tr>
</thead>
<tbody>
<tr><td>HDMI 1.4</td><td>30 Hz</td><td>Eski monitör ve kartlarda yaygın</td></tr>
<tr><td>HDMI 2.0</td><td>60 Hz</td><td>Düşük çözünürlüklerde daha yüksek Hz mümkün</td></tr>
<tr><td>HDMI 2.1</td><td>120 Hz</td><td>Yeni ekran kartları ve monitörler</td></tr>
<tr><td>DisplayPort 1.2</td><td>60 Hz</td><td>1440p yüksek Hz için yaygın tercih</td></tr>
<tr><td>DisplayPort 1.4</td><td>120 Hz</td><td>Sıkıştırma (DSC) ile daha yüksek değerler</td></tr>
</tbody>
</table>
<p>Pratikte en sağlam yol, monitörün kutusundan çıkan kabloyu ve kullanım kılavuzunda önerilen portu kullanmaktır. Birçok yüksek yenileme hızlı monitörde en yüksek değere yalnızca DisplayPort üzerinden ulaşılır. Masaüstü bilgisayarlarda kablonun anakarttaki değil, ekran kartındaki porta takılı olduğundan emin olun. Ucuz adaptörler ve dönüştürücüler de yenileme hızını sınırlayabilir.</p>

<h2>Laptoplarda yenileme hızı</h2>
<p>Yüksek yenileme hızlı ekrana sahip laptoplarda durum biraz farklıdır. Birçok model, pil ömrünü uzatmak için prizden çıkarıldığında yenileme hızını otomatik olarak düşürür. Bu davranış genellikle Windows'un güç modu ayarlarından ve üreticinin kendi kontrol uygulamasından yönetilir.</p>
<ul>
<li><strong>Güç modu:</strong> <strong>Ayarlar &gt; Sistem &gt; Güç ve pil</strong> sayfasında güç modunu kontrol edin. Pil tasarrufu açıkken ekran daha düşük hızda çalışabilir.</li>
<li><strong>Dinamik yenileme hızı:</strong> Destekleyen laptoplarda Gelişmiş ekran sayfasındaki dinamik seçenek, okuma gibi sabit işlerde hızı düşürür, kaydırma ve oyunda yükseltir.</li>
<li><strong>Harici monitör:</strong> Laptopa bağlı harici monitörün yenileme hızı, laptopun kullandığı portun desteklediği değerle sınırlıdır. USB-C üzerinden görüntü aktarımında portun hangi standardı desteklediğini kılavuzdan kontrol edin.</li>
</ul>

<h2>Değişken yenileme hızı ve oyunlar</h2>
<p>Yenileme hızını en yükseğe çekmek kadar oyun içi ayarlar da önemlidir. Bazı oyunlar kendi grafik menülerinde ayrı bir yenileme hızı veya kare sınırı ayarı sunar. Windows'ta 144 Hz seçili olsa bile oyun 60 FPS ile sınırlanmışsa akıcılık artmaz. Oyunun grafik ayarlarında tam ekran modunu, yenileme hızını ve dikey eşitleme seçeneğini kontrol edin.</p>
<p>Windows 11'de <strong>Ayarlar &gt; Sistem &gt; Ekran &gt; Grafik</strong> bölümündeki varsayılan grafik ayarları arasında, desteklenen sistemlerde değişken yenileme hızıyla ilgili seçenekler de bulunur. Monitörünüz G-SYNC veya FreeSync destekliyorsa bu özellik, ekranın yenileme hızını oyunun ürettiği kare sayısına uydurarak yırtılmayı ve takılmayı azaltır.</p>

<h2>Monitörün kendi menüsünü kontrol edin</h2>
<p>Bazı monitörler en yüksek yenileme hızını yalnızca ekran menüsünde (OSD) ilgili seçenek açıldığında sunar. Menüde "overclock", "hız aşırtma" veya benzeri bir ayar varsa bunu etkinleştirdikten sonra Windows listesini yeniden kontrol edin. Ayrıca bazı modellerde HDMI girişinin sürümü menüden seçilir; eski sürüm seçiliyse yenileme hızı düşük kalabilir.</p>
<p>Monitör menüsünde genellikle o anki giriş sinyalini gösteren bir bilgi ekranı da bulunur. Burada çözünürlük ve yenileme hızı birlikte yazar. Windows'ta seçtiğiniz değer ile monitörün bildirdiği değer aynıysa ayar doğru uygulanmış demektir. İki değer farklıysa kablo, port veya sürücü tarafını yeniden kontrol edin.</p>
<p>Menüdeki tepki süresi veya "overdrive" ayarı ise Hz'den farklı bir şeydir. Bu ayarın çok yüksek seviyesi hareketli nesnelerin arkasında parlak izlere yol açabilir. Görüntü bozulursa orta seviyeyi deneyin.</p>

<h2>Ayardan sonra ekranı test edin</h2>
<p>Testmatik şu anda yenileme hızını ölçmez; geçerli değeri yukarıda anlattığımız Windows ayarlarından kontrol edebilirsiniz. Ancak ayar değişikliğinden, yeni bir kablodan veya yeni monitörün ilk kurulumundan sonra panelin kendisini kontrol etmek iyi bir alışkanlıktır.</p>
<p><a href="{tool:olu-piksel-testi}">Monitör ölü piksel testi</a> ekranı siyah, beyaz, kırmızı, yeşil, mavi ve diğer düz renklerle tam ekran doldurur. Renkleri tıklayarak, ok tuşlarıyla veya boşluk tuşuyla değiştirebilir, otomatik modda her üç saniyede bir geçiş yaptırabilirsiniz. Böylece ölü veya sıkışmış pikselleri ve düz renklerde belirgin hâle gelen lekeleri kolayca fark edersiniz.</p>
<div class="tm-callout tm-callout--info">
<p><strong>Bilgi:</strong> Test tamamen tarayıcınızda çalışır ve hiçbir veri sunucuya gönderilmez. Testten çıkmak için <kbd>Esc</kbd> tuşuna basmanız yeterlidir.</p>
</div>

<h2>İlgili testler ve rehberler</h2>
<p>Ekranda sabit renkte bir nokta görürseniz <a href="{post:olu-piksel-nasil-duzeltilir}">ölü piksel nasıl düzeltilir</a> rehberimize bakın. Yüksek yenileme hızlı bir monitörü oyun için kuruyorsanız <a href="{tool:mouse-testi}">mouse test hz</a> aracıyla farenizin polling rate değerini ve <a href="{tool:klavye-testi}">online klavye testi</a> ile tuşlarınızı da kontrol edin. Fare tarafındaki Hz kavramı için <a href="{post:mouse-polling-rate-nedir}">mouse polling rate nedir</a> yazımız, telefon ve tablet ekranları için <a href="{post:dokunmatik-ekran-testi}">dokunmatik ekran testi</a> rehberimiz işinize yarayacaktır. Kullanılmış bir laptop alıyorsanız <a href="{post:ikinci-el-laptop-kontrol}">ikinci el laptop kontrol listesi</a> ekran kontrollerini de kapsar.</p>
<p>Ekranla ilgili bir sonraki adım olarak <a href="{post:olu-piksel-nasil-duzeltilir}">sıkışmış piksel onarımı</a> rehberimiz panel kusurlarını nasıl ayırt edeceğinizi ayrıntılı anlatır.</p>
HTML
	,
	'faqs'        => array(
		array( 'q' => 'Monitörümün kaç Hz olduğunu nasıl öğrenirim?', 'a' => 'Windows 11\'de Ayarlar > Sistem > Ekran > Gelişmiş ekran sayfasını açın. Burada monitörün şu anki yenileme hızı ve seçilebilecek değerler listelenir. Monitörün desteklediği en yüksek değeri kullanım kılavuzunda veya kutusunda da bulabilirsiniz.' ),
		array( 'q' => 'Yenileme hızı listesinde 144 Hz neden görünmüyor?', 'a' => 'En sık neden kablo veya porttur. Eski bir HDMI kablosu ya da anakarttaki port yüksek değerleri desteklemeyebilir. Monitörle gelen kabloyu, mümkünse DisplayPort bağlantısıyla ekran kartına takın ve ekran sürücüsünü güncelleyin.' ),
		array( 'q' => '60 Hz ile 144 Hz arasındaki fark gerçekten hissedilir mi?', 'a' => 'Çoğu kullanıcı farkı fare imlecini hareket ettirirken veya sayfa kaydırırken hemen fark eder. 144 Hz\'de her kare yaklaşık 6,9 milisaniye ekranda kalır, 60 Hz\'de bu süre yaklaşık 16,7 milisaniyedir. Oyunlarda faydayı görmek için bilgisayarın da yeterli FPS üretmesi gerekir.' ),
		array( 'q' => 'Yüksek Hz monitöre zarar verir mi?', 'a' => 'Monitörün resmi olarak desteklediği değerleri kullanmak güvenlidir. Bu değerler üretici tarafından belirlenmiştir. Özel çözünürlük araçlarıyla desteklenen sınırın üzerine çıkmak ise görüntü sorunlarına yol açabilir ve önerilmez.' ),
		array( 'q' => 'Laptopum prizden çıkınca neden Hz düşüyor?', 'a' => 'Birçok laptop pil tasarrufu için yenileme hızını otomatik düşürür. Windows 11\'deki dinamik yenileme hızı seçeneği de bu şekilde çalışır. Sabit yüksek değer istiyorsanız Gelişmiş ekran sayfasında sabit bir değer seçin ve üreticinin güç yönetimi uygulamasını kontrol edin.' ),
		array( 'q' => 'Testmatik ekran Hz testi yapabiliyor mu?', 'a' => 'Hayır, Testmatik şu anda monitör yenileme hızını ölçmez. Geçerli değeri Windows ekran ayarlarından görebilirsiniz. Panelin kendisini ise ölü piksel testiyle düz renklerde kontrol edebilirsiniz.' ),
	),
);
