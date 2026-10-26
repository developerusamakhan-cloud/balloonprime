<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'Kamera Testi',
	'seo_title'   => 'Kamera Testi: Online Web Kamera ve Webcam Testi | Testmatik',
	'description' => 'Ücretsiz kamera testi ile web kameranızı tarayıcıda deneyin: canlı önizleme, gerçek çözünürlük, FPS ve en-boy oranı. Kurulum yok, görüntü kaydedilmez.',
	'keywords'    => array( 'kamera testi', 'web kamera testi', 'webcam test', 'laptop kamera testi', 'kamera çözünürlük testi' ),
	'intro'       => 'Web kameranızın çalışıp çalışmadığını saniyeler içinde görün. Canlı önizleme, gerçek çözünürlük ve ölçülen FPS değeriyle kameranızı tarayıcıdan, kurulum yapmadan test edin.',
	'html'        => <<<'HTML'
<h2>Kamera testi nasıl yapılır?</h2>
<p>Bu araç, bilgisayarınıza veya telefonunuza bağlı kameranın gerçekten görüntü verip vermediğini ve bu görüntünün hangi kalitede geldiğini gösterir. Görüntülü görüşmeden, online sınavdan ya da iş toplantısından önce birkaç saniyelik bir web kamera testi, son dakika sürprizlerini önler.</p>
<ol class="tm-steps">
<li><strong>Testi başlatın.</strong> Tarayıcınız kameraya erişim izni isteyecektir. Çıkan pencerede <strong>İzin ver</strong> seçeneğine tıklayın.</li>
<li><strong>Kamerayı seçin.</strong> Birden fazla kameranız varsa (örneğin laptopun dahili kamerası ve harici bir USB webcam) açılır listeden test etmek istediğinizi seçin.</li>
<li><strong>Canlı önizlemeyi kontrol edin.</strong> Görüntü geliyorsa kamera donanımı ve sürücüsü temel olarak çalışıyor demektir. Netliğe, renklere ve görüntüde takılma olup olmadığına bakın.</li>
<li><strong>Çözünürlük isteyin.</strong> <strong>720p</strong>, <strong>1080p</strong> veya <strong>4K</strong> düğmelerinden birine basın. Kamera, desteklediği en yakın ve en iyi değeri verir.</li>
<li><strong>Bilgileri okuyun.</strong> Gerçek çözünürlük, ölçülen FPS, en-boy oranı ve kamera adı ekranda görünür.</li>
<li><strong>İsterseniz fotoğraf çekin.</strong> <strong>Fotoğraf çek</strong> düğmesi o anki kareyi PNG dosyası olarak cihazınıza kaydeder.</li>
</ol>
<p>Önizlemedeki görüntü size ters geliyorsa <strong>ayna</strong> seçeneğini açıp kapatabilirsiniz. Ayna görünümü sadece sizin ekranınızdaki önizlemeyi etkiler; çoğu görüntülü görüşme uygulaması da kendi önizlemenizi aynalı gösterir, karşı taraf ise sizi normal yönde görür.</p>

<h2>Sonuçlar nasıl okunur?</h2>
<p>Kamera testi, kameranın kutusunda yazan değeri değil, tarayıcının o anda gerçekten aldığı görüntüyü ölçer. Bu yüzden sonuçlar bazen beklentinizden düşük çıkabilir; bu her zaman bir arıza anlamına gelmez.</p>
<h3>Çözünürlük</h3>
<p>Ekranda <code>1280×720</code> görüyorsanız kamera 720p (HD), <code>1920×1080</code> görüyorsanız 1080p (Full HD) görüntü veriyordur. 4K düğmesine bastığınız halde 1080p görünüyorsa kameranız 4K desteklemiyordur; araç size kameranın verebildiği en iyi değeri gösterir. Birçok laptop kamerası hâlâ 720p'dir, bu nedenle bu sonuç normaldir.</p>
<h3>FPS (kare hızı)</h3>
<p>Ölçülen FPS, saniyede kaç kare geldiğini gösterir. Görüntülü görüşme için 24-30 FPS akıcı bir görüntü sağlar. Kare hızı 15'in altına düşüyorsa görüntü takılır gibi görünür. Pek çok kamera karanlık ortamda daha fazla ışık toplamak için kare hızını kendiliğinden düşürür; odayı aydınlattığınızda FPS'nin yükseldiğini görebilirsiniz.</p>
<h3>En-boy oranı ve kamera adı</h3>
<p>En-boy oranı genellikle 16:9 veya 4:3 olur. Kamera adı, tarayıcının hangi cihazı kullandığını gösterir. Burada beklemediğiniz bir isim, örneğin sanal bir kamera yazılımının adı görüyorsanız listeden doğru kamerayı seçin.</p>

<h3>Kamera çözünürlük testi: hangi değer ne anlama gelir?</h3>
<p>Aşağıdaki tablo, testte en sık göreceğiniz çözünürlükleri ve bunların günlük kullanımdaki karşılığını özetler. Değerler piksel cinsinden genişlik × yüksekliktir.</p>
<table>
<thead>
<tr><th>Ekranda görünen</th><th>Adı</th><th>Nerede yeterli?</th></tr>
</thead>
<tbody>
<tr><td><code>640×480</code></td><td>VGA (4:3)</td><td>Eski veya çok ucuz kameralar; görüntülü görüşmede soluk ve yumuşak görünür</td></tr>
<tr><td><code>1280×720</code></td><td>720p / HD</td><td>Zoom, Teams ve Google Meet görüşmeleri için genellikle yeterli</td></tr>
<tr><td><code>1920×1080</code></td><td>1080p / Full HD</td><td>Net toplantı görüntüsü, canlı yayın ve video kaydı</td></tr>
<tr><td><code>3840×2160</code></td><td>4K / UHD</td><td>Üst segment webcam'ler; görüşme uygulamaları çoğu zaman bunu daha düşük çözünürlüğe indirir</td></tr>
</tbody>
</table>
<p>Bir şeyi bilmekte fayda var: görüşme uygulamaları internet hızınıza göre görüntüyü sıkıştırır. Testte 1080p görmeniz, karşı tarafın da her zaman 1080p göreceği anlamına gelmez; ancak kameranın kendisinin bu kaliteyi verebildiğini kanıtlar.</p>

<h2>Sık görülen kamera sorunları ve çözümleri</h2>
<table>
<thead>
<tr><th>Belirti</th><th>Olası neden</th><th>Çözüm</th></tr>
</thead>
<tbody>
<tr><td>Siyah ekran, ama izin verildi</td><td>Gizlilik kapağı kapalı veya kamera tuşla devre dışı</td><td>Kamera üzerindeki sürgüyü açın, laptopta kamera tuşuna basın</td></tr>
<tr><td>İzin penceresi hiç çıkmıyor</td><td>Daha önce “Engelle” seçilmiş</td><td>Adres çubuğundaki kilit simgesinden kamera iznini “İzin ver” yapın</td></tr>
<tr><td>“Kamera kullanımda” hatası</td><td>Zoom, Teams veya başka bir sekme kamerayı tutuyor</td><td>Diğer uygulamaları ve sekmeleri kapatıp sayfayı yenileyin</td></tr>
<tr><td>Listede kamera görünmüyor</td><td>Sürücü sorunu veya kamera işletim sisteminde kapalı</td><td>Aygıt Yöneticisi'nde “Kameralar” altını kontrol edin</td></tr>
<tr><td>Görüntü karanlık ve kumlu</td><td>Yetersiz ışık</td><td>Yüzünüze önden ışık verin, arkanızdaki pencereyi kapatın</td></tr>
<tr><td>Düşük FPS, takılan görüntü</td><td>Düşük ışık, USB bant genişliği, yoğun işlemci yükü</td><td>Ortamı aydınlatın, kamerayı başka bir USB portuna takın</td></tr>
<tr><td>Görüntü bulanık</td><td>Lens kirli veya otomatik odak zorlanıyor</td><td>Lensi mikrofiber bezle silin, kameraya 50 cm'den yakın durmayın</td></tr>
</tbody>
</table>

<h2>Laptop kamera testi: kapak, Fn tuşu ve sürücü</h2>
<p>Laptopta kamera testi siyah ekranla sonuçlanıyorsa sorun çoğu zaman donanım arızası değildir. Önce şu üç noktayı kontrol edin.</p>
<h3>Fiziksel gizlilik kapağı</h3>
<p>Lenovo, HP ve Dell başta olmak üzere birçok yeni laptopta kameranın üzerinde küçük bir sürgülü kapak bulunur. Kapak kapalıyken kamera çalışır ama yalnızca siyah ya da çok koyu bir görüntü verir. Bazı modellerde kapak kapandığında lensin önünde kırmızı veya çizgili bir işaret görünür.</p>
<h3>Kamera tuşu ve Fn kombinasyonları</h3>
<p>Bazı laptoplarda klavyenin üst sırasında üzerinde kamera simgesi olan bir tuş vardır; örneğin <kbd>F8</kbd>, <kbd>F10</kbd> ya da <kbd>Fn</kbd> + <kbd>F6</kbd> gibi. Bu tuş kamerayı donanım düzeyinde kapatır ve kamera Aygıt Yöneticisi'nden bile kaybolabilir. Tuşun yeri markaya ve modele göre değişir, bu yüzden klavyenizde kamera simgesini arayın.</p>
<h3>İşletim sistemi izinleri</h3>
<p>Windows 11'de <strong>Ayarlar &gt; Gizlilik ve güvenlik &gt; Kamera</strong> yolunu izleyin; “Kamera erişimi” ve “Uygulamaların kameranıza erişmesine izin verin” seçenekleri açık olmalı. macOS'ta <strong>Sistem Ayarları &gt; Gizlilik ve Güvenlik &gt; Kamera</strong> bölümünde kullandığınız tarayıcının yanındaki anahtar açık olmalıdır. Daha ayrıntılı adımlar için <a href="{post:laptop-kamera-calismiyor}">laptop kamera çalışmıyor sorununa 10 çözüm</a> rehberimize bakabilirsiniz.</p>

<h2>Görüntülü görüşmeler için ışık ve kadraj ipuçları</h2>
<p>Kameranızın çözünürlüğü yüksek olsa bile kötü ışıkta görüntü kalitesi düşer. Küçük sensörlü laptop kameraları özellikle ışığa duyarlıdır. Birkaç basit ayarla aynı kameradan çok daha iyi sonuç alabilirsiniz.</p>
<ul>
<li><strong>Işığı önünüze alın.</strong> Pencere ya da lamba yüzünüze bakmalı, arkanızda olmamalı. Arkadan gelen ışık yüzünüzü karanlık bir siluete çevirir.</li>
<li><strong>Yumuşak ışık tercih edin.</strong> Doğrudan güneş sert gölgeler yapar. Perde ya da beyaz bir duvardan yansıyan ışık daha doğal görünür.</li>
<li><strong>Kamerayı göz hizasına getirin.</strong> Laptopu birkaç kitabın üzerine koymak, alttan çekim açısını düzeltir.</li>
<li><strong>Lensi temizleyin.</strong> Parmak izi, görüntüyü puslu gösterir ve en sık gözden kaçan sorunlardan biridir.</li>
<li><strong>Sesi de kontrol edin.</strong> Görüntü kadar ses de önemlidir; görüşmeden önce <a href="{tool:mikrofon-testi}">online mikrofon testi</a> ile sesinizin net gidip gitmediğine bakın.</li>
</ul>
<div class="tm-callout tm-callout--tip">
<p><strong>İpucu:</strong> Işık ayarını yaparken bu sayfadaki FPS değerini izleyin. Ortam aydınlandıkça kare hızının yükseldiğini görürseniz kameranız düşük ışık nedeniyle yavaşlıyordu demektir.</p>
</div>

<h2>Masaüstü, harici webcam ve telefon</h2>
<p><strong>Harici USB webcam:</strong> Görüntü gelmiyorsa kamerayı doğrudan bilgisayara takın, USB çoklayıcı kullanmayın. 1080p ve üzeri kameralar için mümkünse arka paneldeki portları tercih edin. Kamera başka bir porta takıldığında Windows sürücüyü yeniden kurabilir.</p>
<p><strong>Windows:</strong> Kamera listede hiç yoksa <strong>Aygıt Yöneticisi</strong>'ni açıp “Kameralar” veya “Görüntüleme aygıtları” altına bakın. Sarı ünlem varsa sürücüyü kaldırıp bilgisayarı yeniden başlatın.</p>
<p><strong>macOS:</strong> MacBook kameraları ayrı sürücü gerektirmez. Görüntü yoksa kameranın başka bir uygulamada açık olup olmadığını kontrol edin ve tarayıcının kamera iznini doğrulayın.</p>
<p><strong>Birden fazla kamera:</strong> Laptopa harici webcam taktığınızda ya da OBS gibi bir yayın programı sanal kamera eklediğinde listede birkaç seçenek görürsünüz. Görüşme uygulamaları bazen yanlış kamerayı varsayılan seçer. Bu sayfada her birini sırayla seçip hangisinin gerçek görüntü verdiğini görmek, uygulama ayarlarında doğru cihazı seçmenizi kolaylaştırır.</p>
<p><strong>Telefon:</strong> Mobil tarayıcıda açılır listeden ön ve arka kamera arasında geçiş yapabilirsiniz. Telefonların çoğu tarayıcıya ana kameranın tüm çözünürlüğünü vermez; bu yüzden 1080p gibi bir değer görmeniz normaldir.</p>
<div class="tm-callout tm-callout--info">
<p><strong>Bilgi:</strong> Tarayıcılar kamera erişimine yalnızca güvenli (HTTPS) bağlantılarda izin verir. Testmatik HTTPS üzerinden çalıştığı için bu konuda ek bir ayar yapmanız gerekmez.</p>
</div>

<h2>Gizlilik: görüntünüz hiçbir yere gönderilmez</h2>
<p>Kamera testi tamamen tarayıcınızda çalışır. Canlı görüntü, çekilen fotoğraflar ve ölçülen değerler hiçbir sunucuya yüklenmez ve saklanmaz. <strong>Fotoğraf çek</strong> düğmesiyle aldığınız PNG dosyası yalnızca kendi cihazınıza kaydedilir. Sekmeyi kapattığınızda kamera erişimi de sona erer.</p>

<h2>İlgili testler ve rehberler</h2>
<p>Kamerayı kontrol ettikten sonra diğer donanımları da test etmek isteyebilirsiniz. Ekranınızda parlamayan noktalar olup olmadığını <a href="{tool:olu-piksel-testi}">ölü piksel testi</a> ile, görüşmede karşı tarafı duyup duymadığınızı <a href="{tool:hoparlor-testi}">hoparlör ve kulaklık testi</a> ile kontrol edebilirsiniz. Tuşlarda sorun varsa <a href="{tool:klavye-testi}">klavye testi</a> aracımızı kullanın.</p>
<p>İkinci el bir laptop almayı düşünüyorsanız <a href="{post:ikinci-el-laptop-kontrol}">ikinci el laptop alırken yapılması gereken testler</a> rehberimiz kamera dahil tüm kontrolleri tek listede toplar. Mikrofonunuz da sorun çıkarıyorsa <a href="{post:mikrofon-calismiyor}">mikrofon çalışmıyor çözümleri</a> yazısına bakın. Görüntü çalışıyor ama soluk veya bulanıksa <a href="{post:web-kamera-goruntu-kalitesi}">web kamera görüntü kalitesini artırma</a> yazısındaki ışık ve ayar önerileri işe yarar.</p>
HTML
	,
	'faqs'        => array(
		array( 'q' => 'Kamera testi güvenli mi, görüntüm kaydediliyor mu?', 'a' => 'Evet, güvenlidir. Test tamamen tarayıcınızda çalışır ve görüntünüz hiçbir sunucuya gönderilmez veya saklanmaz. Fotoğraf çekerseniz PNG dosyası yalnızca kendi cihazınıza kaydedilir.' ),
		array( 'q' => 'Kamera izni verdim ama ekran siyah, neden?', 'a' => 'En sık neden laptop üzerindeki fiziksel gizlilik kapağının kapalı olmasıdır. Ayrıca bazı laptoplarda kamera, klavyedeki kamera simgeli tuş veya Fn kombinasyonu ile kapatılmış olabilir. Kameranın başka bir uygulamada açık olmadığından da emin olun.' ),
		array( 'q' => 'Kameram 1080p olduğu halde test 720p gösteriyor, arızalı mı?', 'a' => 'Mutlaka değil. Önce 1080p düğmesine basarak bu çözünürlüğü isteyin. Yine 720p görünüyorsa kamera USB bağlantısı, sürücü ayarı veya gerçek sensör çözünürlüğü nedeniyle bu değeri veriyor olabilir; kameranın teknik özelliklerini kontrol edin.' ),
		array( 'q' => 'Görüntülü görüşme için kaç FPS yeterli?', 'a' => 'Akıcı bir görüntü için 24 ile 30 FPS arası yeterlidir. 15 FPS altında görüntü takılır gibi görünür. Karanlık ortamda kameralar kare hızını düşürdüğü için önce ışığı iyileştirmeyi deneyin.' ),
		array( 'q' => 'Daha önce kamera iznini engelledim, nasıl geri açarım?', 'a' => 'Adres çubuğundaki kilit veya ayar simgesine tıklayın ve kamera iznini İzin ver olarak değiştirin. Ardından sayfayı yenileyin. Windows veya macOS gizlilik ayarlarında da tarayıcının kameraya erişimi açık olmalıdır.' ),
		array( 'q' => 'Telefon kamerasını da test edebilir miyim?', 'a' => 'Evet. Sayfayı telefonunuzun tarayıcısında açıp izin verdiğinizde ön ve arka kamera arasında listeden geçiş yapabilirsiniz. Telefonlar tarayıcıya genellikle ana kameranın tam çözünürlüğünü vermez, bu nedenle daha düşük bir değer görmeniz normaldir.' ),
		array( 'q' => 'Önizlemede görüntüm neden ters görünüyor?', 'a' => 'Önizleme varsayılan olarak ayna gibi gösterilebilir, çünkü insanlar kendilerini bu şekilde görmeye alışkındır. Ayna seçeneğiyle bunu değiştirebilirsiniz. Bu ayar yalnızca sizin önizlemenizi etkiler.' ),
	),
);
