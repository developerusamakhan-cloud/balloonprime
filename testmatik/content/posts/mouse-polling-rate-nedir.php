<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'Mouse Polling Rate (Hz) Nedir? 125, 500 ve 1000 Hz Farkı',
	'seo_title'   => 'Mouse Polling Rate Nedir? 125, 500 ve 1000 Hz | Testmatik',
	'description' => 'Mouse polling rate nedir, 125, 500 ve 1000 Hz arasındaki fark ne? DPI ile farkını öğrenin, mouse Hz testi yapın ve doğru ayarı nasıl seçeceğinizi görün.',
	'keywords'    => array( 'mouse polling rate nedir', 'hz testi mouse', 'mouse hz testi', 'mouse test hz', 'polling rate dpi farkı' ),
	'intro'       => 'Polling rate, farenizin konumunu bilgisayara saniyede kaç kez bildirdiğini gösterir. 125, 500 ve 1000 Hz arasındaki farkı, DPI ile ilişkisini ve farenizi nasıl test edeceğinizi anlatıyoruz.',
	'excerpt'     => 'Mouse polling rate (Hz) nedir, 1000 Hz gerçekten fark eder mi? DPI ile farkını, doğru ayarı ve tarayıcıda mouse Hz testi yapmayı anlatıyoruz.',
	'category'    => 'Mouse',
	'tool'        => 'mouse-testi',
	'date'        => '2026-10-31 06:00:00',
	'html'        => <<<'HTML'
<h2>Mouse polling rate nedir?</h2>
<p>Polling rate, Türkçede "yoklama hızı" ya da "rapor hızı" olarak da geçer ve farenin konum ve tuş bilgisini bilgisayara saniyede kaç kez gönderdiğini ifade eder. Birimi hertz (Hz) olarak verilir. 1000 Hz bir fare, saniyede bin kez "şu kadar hareket ettim, şu tuşa basıldı" bilgisini iletir.</p>
<p>Bu değer doğrudan iki rapor arasındaki süreyi belirler. Rapor aralığı ne kadar kısaysa imleç hareketi o kadar akıcı görünür ve tıklamanız bilgisayara o kadar erken ulaşır. Aradaki fark milisaniyelerle ölçülür; bu yüzden en çok rekabetçi oyunlarda konuşulur.</p>
<table>
<thead>
<tr><th>Polling rate</th><th>Rapor aralığı</th><th>Tipik kullanım</th></tr>
</thead>
<tbody>
<tr><td>125 Hz</td><td>8 ms</td><td>Standart ofis fareleri, birçok Bluetooth fare</td></tr>
<tr><td>250 Hz</td><td>4 ms</td><td>Bazı eski oyuncu fareleri</td></tr>
<tr><td>500 Hz</td><td>2 ms</td><td>Orta seviye oyuncu fareleri, günlük kullanım</td></tr>
<tr><td>1000 Hz</td><td>1 ms</td><td>Çoğu oyuncu faresinin varsayılan değeri</td></tr>
<tr><td>4000-8000 Hz</td><td>0,25-0,125 ms</td><td>Yeni nesil üst seviye oyuncu fareleri</td></tr>
</tbody>
</table>

<h2>125, 500 ve 1000 Hz arasındaki fark</h2>
<p>125 Hz bir fare her 8 milisaniyede bir rapor gönderir. Ofis işleri, internette gezinme ve belge düzenleme için bu fazlasıyla yeterlidir. Ancak yüksek yenileme hızlı bir monitörde fareyi hızlıca çevirdiğinizde imlecin küçük sıçramalarla ilerlediğini fark edebilirsiniz; çünkü ekran, fareden yeni veri gelmeden birkaç kare çizer.</p>
<p>500 Hz değerinde aralık 2 milisaniyeye iner. Çoğu kullanıcı için akıcılık ile sistem yükü arasında iyi bir dengedir. 1000 Hz ise 1 milisaniyelik aralık sunar ve bugün çoğu oyuncu faresinin fabrika ayarıdır. 500 ile 1000 Hz arasındaki farkı günlük kullanımda hissetmek zordur; 144 Hz ve üzeri bir monitörde hızlı nişan alırken ise fark daha belirgin olabilir.</p>
<h3>Yüksek polling rate her zaman daha mı iyi?</h3>
<p>Her zaman değil. 4000 veya 8000 Hz gibi çok yüksek değerler işlemciye daha fazla iş yükler, çünkü bilgisayarın saniyede binlerce raporu işlemesi gerekir. Bazı eski oyunlarda ve zayıf sistemlerde bu durum takılmalara yol açabilir. Kablosuz farelerde yüksek polling rate pil ömrünü de kısaltır. Bu yüzden üreticiler genellikle 1000 Hz'i dengeli bir varsayılan olarak sunar.</p>

<h2>Polling rate ile DPI arasındaki fark</h2>
<p>Bu iki kavram sık karıştırılır ama birbirinden tamamen farklıdır. DPI (ya da CPI), fareyi bir inç hareket ettirdiğinizde sensörün kaç birim saydığını gösterir; yani hassasiyetle ilgilidir. Polling rate ise bu bilginin bilgisayara ne sıklıkla gönderildiğini belirler; yani zamanlamayla ilgilidir.</p>
<ul>
<li><strong>DPI yükselirse:</strong> Aynı el hareketiyle imleç ekranda daha uzun mesafe kat eder.</li>
<li><strong>Polling rate yükselirse:</strong> İmlecin kat ettiği mesafe değişmez, ancak hareket daha sık ve daha küçük adımlarla güncellenir.</li>
</ul>
<p>Örneğin 800 DPI ve 1000 Hz bir fare ile 1600 DPI ve 1000 Hz bir fare aynı sıklıkta rapor gönderir, ama ikincisi aynı hareketle imleci iki kat uzağa taşır. DPI'yi düşük tutup Windows imleç hızını artırmak ya da tersini yapmak tamamen tercih meselesidir; polling rate bu dengeyi etkilemez.</p>

<div class="tm-cta" data-tool="mouse-testi"></div>

<h2>Mouse Hz testi nasıl yapılır?</h2>
<p>Farenizin gerçekte hangi hızda rapor gönderdiğini görmek için <a href="{tool:mouse-testi}">mouse Hz testi</a> aracımızı kullanabilirsiniz. Test, fareyi hareket ettirdiğiniz sırada tarayıcıya gelen hareket olaylarını sayar ve yaklaşık bir polling rate değeri gösterir.</p>
<ol class="tm-steps">
<li>Testi açın ve imleci test alanının üzerine getirin.</li>
<li>Fareyi masada hızlı ve kesintisiz biçimde, örneğin daireler çizerek hareket ettirin.</li>
<li>Birkaç saniye boyunca gösterilen Hz değerini izleyin; en yüksek ve en kararlı değer genellikle gerçeğe en yakın olanıdır.</li>
<li>Üretici yazılımında farklı bir polling rate seçtiyseniz testi tekrarlayıp değerlerin değişip değişmediğine bakın.</li>
</ol>
<div class="tm-callout tm-callout--info">
<p><strong>Bilgi:</strong> Tarayıcı tabanlı ölçüm bir tahmindir. Tarayıcılar bazı hareket olaylarını birleştirebildiği ve sistem yüküne göre davrandığı için sonuç, farenin gerçek değerinden biraz farklı çıkabilir. Fare yavaş hareket ettiğinde veya hiç hareket etmediğinde rapor da gönderilmez; bu yüzden ölçüm sırasında fareyi sürekli hareket ettirin.</p>
</div>
<p>Aynı araçta tuşları ve tekerleği de deneyebilir, beş saniyelik CPS testiyle saniyede kaç kez tıkladığınızı ölçebilirsiniz. Tüm ölçümler tarayıcınızda yapılır; hareket ve tıklama verileriniz hiçbir sunucuya gönderilmez.</p>
<h3>Sonuçları nasıl yorumlamalı?</h3>
<ul>
<li><strong>Değer seçtiğiniz ayara yakın ve kararlıysa:</strong> Fare beklendiği gibi çalışıyor.</li>
<li><strong>Değer sürekli 125 Hz civarındaysa:</strong> Fare varsayılan ayarda olabilir veya Bluetooth üzerinden bağlıdır.</li>
<li><strong>Değer sert biçimde düşüp yükseliyorsa:</strong> Kablosuz bağlantıda parazit, zayıf pil veya uzak alıcı olabilir.</li>
</ul>

<h2>Polling rate gecikmeyi ne kadar etkiler?</h2>
<p>Polling rate, toplam gecikmenin yalnızca bir parçasıdır. Bir tıklamanın ekranda karşılık bulması için farenin switch'i ve sensörü, USB bağlantısı, işletim sistemi, oyun motoru, ekran kartı ve monitör sırayla devreye girer. Polling rate'in bu zincire eklediği en kötü durum gecikmesi, rapor aralığı kadardır: 125 Hz'de en fazla 8 ms, 1000 Hz'de en fazla 1 ms.</p>
<p>Ortalama olarak ise bunun yaklaşık yarısı kadar bir fark oluşur, çünkü hareketiniz iki rapor arasındaki herhangi bir anda başlayabilir. 125 Hz'den 1000 Hz'e geçmek bu yüzden ölçülebilir bir iyileşmedir. 1000 Hz'den 8000 Hz'e geçmek ise en fazla 1 milisaniyenin altında bir kazanç sağlar; bu farkı hissedip hissetmemek kişiye ve kullanılan sisteme göre değişir.</p>
<p>Akıcılık açısından da benzer bir tablo vardır. Monitörünüz saniyede 60 kare çiziyorsa ve fare saniyede yalnızca 125 rapor gönderiyorsa her karede iki ya da üç güncelleme düşer; bu da çoğu zaman yeterlidir. 240 Hz bir monitörde ise 125 Hz bir fare her kareye güncelleme yetiştiremez ve imleç hareketinde düzensizlik görülebilir. Yüksek yenileme hızlı ekranlarda yüksek polling rate'in daha anlamlı olmasının nedeni budur.</p>

<h2>Polling rate nasıl değiştirilir?</h2>
<p>Windows'un kendi ayarlarında fare polling rate değerini değiştiren bir seçenek yoktur. Bu ayar farenin içindeki yazılım tarafından belirlenir ve üreticinin sunduğu yöntemlerle değiştirilir.</p>
<ol class="tm-steps">
<li><strong>Üretici yazılımı:</strong> Logitech G HUB, Razer Synapse, SteelSeries GG gibi uygulamalarda genellikle "Rapor hızı" veya "Polling rate" adıyla bir seçenek bulunur.</li>
<li><strong>Fare altındaki düğme:</strong> Bazı modellerde alt yüzeyde polling rate veya profil değiştiren küçük bir düğme vardır.</li>
<li><strong>Tuş kombinasyonu:</strong> Bazı fareler, kabloyu takarken belirli tuşları basılı tutarak farklı hızlara geçer. Bu yöntem modelden modele değiştiği için kullanım kılavuzuna bakın.</li>
</ol>
<p>Ayarı değiştirdikten sonra mutlaka yeniden test edin. Bazı farelerde ayarın farenin hafızasına kaydedilmesi için yazılımda ayrı bir kaydet adımı gerekir; aksi hâlde başka bir bilgisayara taktığınızda eski değere döner.</p>

<h2>Kablosuz ve Bluetooth farelerde polling rate</h2>
<p>2,4 GHz USB alıcıyla çalışan oyuncu fareleri bugün 1000 Hz ve üzerine çıkabilir. Bluetooth bağlantıda ise polling rate genellikle çok daha düşüktür ve birçok fare Bluetooth modunda 125 Hz civarında çalışır. Hem alıcı hem Bluetooth desteği olan bir fare kullanıyorsanız oyun için alıcı modunu tercih edin.</p>
<p>Kablosuz farede ölçülen değer dengesizse alıcıyı fareye yakın bir porta takın, gerekirse bir USB uzatma kablosu kullanın. USB 3.0 portlarının ve kablosuz modemlerin 2,4 GHz sinyale parazit yapabildiği bilinir. Pili zayıf olan farelerde de bağlantı kararsızlaşır; şarjı düşükse önce farenizi şarj edin.</p>

<h2>Hangi polling rate değerini seçmeli?</h2>
<table>
<thead>
<tr><th>Kullanım</th><th>Önerilen değer</th><th>Neden</th></tr>
</thead>
<tbody>
<tr><td>Ofis, internet, belge işleri</td><td>125-500 Hz</td><td>Fark hissedilmez, pil daha uzun dayanır</td></tr>
<tr><td>Genel oyun, 60-144 Hz monitör</td><td>500-1000 Hz</td><td>Akıcı hareket, düşük sistem yükü</td></tr>
<tr><td>Rekabetçi FPS, 240 Hz ve üzeri monitör</td><td>1000 Hz veya üzeri</td><td>Daha sık güncelleme, daha düşük gecikme</td></tr>
<tr><td>Eski veya zayıf bilgisayar</td><td>500-1000 Hz</td><td>Çok yüksek değerler takılmaya yol açabilir</td></tr>
</tbody>
</table>
<p>Monitörünüzün yenileme hızı da bu seçimi etkiler. Kendi ekranınızın kaç Hz'de çalıştığını Windows 11'de <strong>Ayarlar &gt; Sistem &gt; Ekran &gt; Gelişmiş ekran</strong> sayfasından görebilirsiniz. Testmatik şu an monitör yenileme hızını ölçmüyor; ekranın kendisini kontrol etmek için <a href="{tool:olu-piksel-testi}">ölü piksel testi</a> aracımızı kullanabilirsiniz. Ayarın nasıl değiştirileceğini <a href="{post:monitor-hz-ayarlama}">monitör Hz ayarlama</a> rehberimizde ayrıntılı anlatıyoruz.</p>

<h2>Polling rate ile karıştırılan sorunlar</h2>
<p>İmleç takılıyor veya tıklamalar garip davranıyorsa sorun her zaman polling rate değildir. Tek tıklamanın iki kez algılanması genellikle yıpranmış bir switch'e işaret eder; bunu <a href="{post:mouse-cift-tiklama-sorunu}">mouse çift tıklama sorunu</a> yazımızda inceliyoruz. Kaydırma sırasında sayfanın ters yöne zıplaması ise tekerlek sensörüyle ilgilidir ve <a href="{post:mouse-tekerlegi-sorunu}">mouse tekerleği sorunu</a> rehberimizde ele alınıyor.</p>
<p>Oyun kurulumunuzu baştan sona kontrol ediyorsanız <a href="{tool:klavye-testi}">klavye testi</a> ile aynı anda basılan tuş sayısını ölçebilir, anti-ghosting konusunu <a href="{post:klavye-ghosting-nedir}">klavye ghosting nedir</a> yazımızda okuyabilirsiniz. Yeni bir oyuncu faresi aldıysanız tüm tuşları ve polling rate değerini <a href="{tool:mouse-testi}">mouse test hz</a> aracıyla bir kez denemeniz, olası bir fabrika hatasını iade süresi bitmeden fark etmenizi sağlar.</p>
<p>Fare değerleri normal ama imleç hâlâ takılıyorsa bir sonraki adım olarak <a href="{post:monitor-hz-ayarlama}">ekran yenileme hızı ayarları</a> rehberimize göz atmanızı öneririz.</p>
HTML
	,
	'faqs'        => array(
		array( 'q' => 'Mouse polling rate nedir?', 'a' => 'Polling rate, farenin konum ve tuş bilgisini bilgisayara saniyede kaç kez gönderdiğini gösterir ve Hz ile ifade edilir. 1000 Hz bir fare her milisaniyede bir rapor gönderir. Değer yükseldikçe imleç hareketi daha sık güncellenir.' ),
		array( 'q' => '1000 Hz ile 500 Hz arasında fark hissedilir mi?', 'a' => 'Günlük kullanımda çoğu kişi farkı hissetmez. Yüksek yenileme hızlı bir monitörde hızlı nişan alırken 1000 Hz biraz daha akıcı ve tutarlı bir his verebilir. Ofis kullanımı için 500 Hz fazlasıyla yeterlidir.' ),
		array( 'q' => 'Polling rate ile DPI aynı şey mi?', 'a' => 'Hayır. DPI, fare bir inç hareket ettiğinde sensörün kaç birim saydığını, yani hassasiyeti gösterir. Polling rate ise bu bilginin bilgisayara ne sıklıkla gönderildiğini belirler. Biri mesafeyle, diğeri zamanlamayla ilgilidir.' ),
		array( 'q' => 'Mouse Hz testi neden farklı değerler gösteriyor?', 'a' => 'Fare yalnızca hareket ettiğinde rapor gönderir; yavaş veya duraksayan hareketlerde ölçülen değer düşer. Tarayıcılar da bazı hareket olaylarını birleştirebilir. En doğru sonuç için fareyi birkaç saniye hızlı ve kesintisiz hareket ettirin.' ),
		array( 'q' => 'Windows ayarlarından polling rate değiştirilebilir mi?', 'a' => 'Hayır, Windows ayarlarında böyle bir seçenek yoktur. Polling rate genellikle üreticinin yazılımından, farenin altındaki bir düğmeden veya modele özel bir tuş kombinasyonuyla değiştirilir. Hangi yöntemin geçerli olduğunu kullanım kılavuzunda bulabilirsiniz.' ),
		array( 'q' => 'Bluetooth farede polling rate neden düşük?', 'a' => 'Bluetooth bağlantı, düşük güç tüketimi için tasarlandığından genellikle 2,4 GHz USB alıcılara göre daha düşük rapor hızında çalışır. Birçok fare Bluetooth modunda 125 Hz civarında kalır. Oyun için alıcı modu veya kablolu bağlantı daha uygundur.' ),
	),
);
