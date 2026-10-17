<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'İkinci El Laptop Alırken Yapılması Gereken 9 Test',
	'seo_title'   => 'İkinci El Laptop Alırken Yapılacak 9 Test | Testmatik',
	'description' => 'İkinci el laptop alırken nelere dikkat edilmeli? Ekran, klavye, kamera, mikrofon, hoparlör, pil sağlığı ve portlar için 9 testi kontrol listesiyle yapın.',
	'keywords'    => array( 'ikinci el laptop alırken nelere dikkat edilmeli', 'ikinci el laptop kontrol', 'ikinci el bilgisayar alırken nelere dikkat edilmeli', 'kullanılmış laptop alırken', 'laptop pil sağlığı kontrolü' ),
	'intro'       => 'Kullanılmış bir laptop iyi bir fırsat olabilir, ama gizli bir arıza o fırsatı hızla pahalı bir hataya çevirir. Bu 9 test, satın almadan önce yarım saatte yapılabilir.',
	'excerpt'     => 'İkinci el laptop alırken ekran, klavye, kamera, mikrofon, hoparlör, pil sağlığı ve portları kontrol etmek için 9 test ve yazdırılabilir kontrol listesi.',
	'category'    => 'Rehber',
	'tool'        => 'klavye-testi',
	'html'        => <<<'HTML'
<h2>Neden test etmeden almamalısınız?</h2>
<p>İkinci el laptop alırken nelere dikkat edilmeli sorusunun kısa cevabı şudur: dış görünüşe değil, çalışan parçalara bakın. Kozmetik olarak temiz bir cihazın klavyesinde ölü bir tuş, ekranında sıkışmış bir piksel veya bitmek üzere olan bir pili olabilir. Satıcı bunları bilmiyor olabilir ya da söylemeyebilir.</p>
<p>Aşağıdaki testlerin çoğu, laptoptaki tarayıcıdan ek program kurmadan yapılabilir. Testmatik araçları tamamen tarayıcıda çalışır; kamera görüntüsü, ses veya tuş basışları hiçbir sunucuya gönderilmez. Bu yüzden satıcının bilgisayarında güvenle kullanabilirsiniz. Yanınızda bir kulaklık, bir USB bellek ve mümkünse telefonunuzun şarj kablosunu bulundurun.</p>
<div class="tm-callout tm-callout--tip">
<p><strong>İpucu:</strong> Görüşmeyi laptopun şarj aletiyle birlikte yapın ve cihazı satıcının önünde soğukken açtırın. Böylece açılış süresini, fan sesini ve ısınmayı baştan sona gözlemleyebilirsiniz.</p>
</div>

<h2>1. Ekran: ölü ve sıkışmış piksel kontrolü</h2>
<p>Ekran bir laptopun en pahalı parçalarından biridir ve değişimi ciddi maliyet çıkarır. Tarayıcıda <a href="{tool:olu-piksel-testi}">ölü piksel testi</a> aracını açıp tam ekrana geçin. Siyah, beyaz, kırmızı, yeşil ve mavi renklerde ekranın her köşesine yakından bakın. Siyah zeminde parlayan bir nokta sıkışmış piksele, beyaz zeminde kara bir nokta ölü piksele işaret eder.</p>
<p>Gri ve beyaz renklerde ekran kenarlarında ışık sızması, sarımsı lekeler veya çizgiler olup olmadığına da bakın. Ekran kapağını yavaşça açıp kapatırken görüntü titriyor veya kesiliyorsa menteşe bölgesindeki ekran kablosu yıpranmış olabilir. Sıkışmış bir piksel bulursanız <a href="{post:olu-piksel-nasil-duzeltilir}">ölü piksel nasıl düzeltilir</a> rehberimizde neyin onarılabilir olduğunu öğrenebilirsiniz.</p>

<h2>2. Klavye: her tuşu tek tek deneyin</h2>
<p>Klavye arızası günlük kullanımı en çok etkileyen sorunlardan biridir. <a href="{tool:klavye-testi}">Klavye testi</a> sayfasını açın ve Türkçe Q veya F düzenini seçin. Her tuşa bir kez basın; çalışan tuşlar yeşile döner, böylece atladığınız veya tepki vermeyen tuşu kolayca görürsünüz. Ğ, Ü, Ş, İ, Ö, Ç gibi Türkçe karakterleri ve boşluk, Enter, Shift tuşlarını mutlaka kontrol edin.</p>
<p>Fn tuşu ve bazı medya tuşları tarayıcı tarafından algılanamaz, çünkü laptop bunları donanım düzeyinde işler. Bu tuşları ses ve parlaklık değişimini izleyerek ayrıca deneyin. Bir tuş çalışmıyorsa <a href="{post:laptop-klavye-calismiyor}">laptop klavye çalışmıyor</a> rehberimizdeki adımlar sorunun yazılımsal mı donanımsal mı olduğunu anlamanıza yardımcı olur.</p>

<div class="tm-cta" data-tool="klavye-testi"></div>

<h2>3. Touchpad ve mouse</h2>
<p>Touchpad'de imleci ekranın dört köşesine götürün, iki parmakla kaydırmayı ve sol/sağ tıklamayı deneyin. İmleç zıplıyorsa veya tıklama bölgesi sertleşmişse not alın. Touchpad'in yüzeyi kabarık görünüyorsa altındaki pil şişmiş olabilir; bu ciddi bir uyarı işaretidir.</p>
<p>Laptopla birlikte bir fare de satılıyorsa <a href="{tool:mouse-testi}">mouse testi</a> ile tüm tuşları ve tekerleği deneyin. Testteki çift tıklama dedektörü, yıpranmış bir switch'in neden olduğu istemsiz çift tıklamaları yakalar. Uyarı alırsanız nedenleri ve çözümleri <a href="{post:mouse-cift-tiklama-sorunu}">mouse çift tıklama sorunu</a> yazımızda bulabilirsiniz. Fare ucuz bir aksesuar olsa da pakete dahilse fiyatın bir parçasıdır; arızalıysa bunu pazarlıkta belirtin.</p>

<h2>4. Mikrofon</h2>
<p><a href="{tool:mikrofon-testi}">Mikrofon testi</a> sayfasında tarayıcıya izin verin ve normal ses tonuyla konuşun. Seviye göstergesi hareket etmeli, "5 saniye kaydet" ile aldığınız kayıt net ve cızırtısız duyulmalıdır. Laptopta birden fazla mikrofon görünüyorsa dahili mikrofonu seçtiğinizden emin olun. Yanınızdaki kulaklığı takıp kulaklık mikrofonunu ve kulaklık jakını da aynı şekilde deneyin.</p>
<p>Ses hiç gelmiyorsa hemen arıza diye düşünmeyin; Windows gizlilik ayarı kapalı olabilir. Kontrol adımları için <a href="{post:mikrofon-calismiyor}">mikrofon çalışmıyor</a> rehberimize bakabilirsiniz.</p>

<h2>5. Kamera</h2>
<p><a href="{tool:kamera-testi}">Kamera testi</a> ile canlı önizlemeyi açın. Görüntünün net olduğunu, renklerin doğal göründüğünü ve ekranda gösterilen çözünürlük ile FPS değerinin makul olduğunu kontrol edin. Pek çok laptop kamerası 720p'dir; ilanda 1080p yazıyorsa test bunu doğrulamanızı sağlar.</p>
<p>Görüntü siyahsa önce kameranın üzerindeki gizlilik kapağına ve kamera tuşuna bakın. Diğer olası nedenler için <a href="{post:laptop-kamera-calismiyor}">laptop kamera çalışmıyor</a> yazımızdaki çözümleri inceleyebilirsiniz.</p>

<h2>6. Hoparlör</h2>
<p>Hoparlörler sık göz ardı edilir, ama bir kanalın bozuk olması yaygın bir sorundur. <a href="{tool:hoparlor-testi}">Hoparlör testi</a> sayfasında sesi düşük seviyeden başlatarak Sol, Sağ ve Her iki kanalı ayrı ayrı çalın. Her iki tarafın da eşit ve net duyulması gerekir. Frekans taramasıyla yüksek seste cızırtı veya titreşim olup olmadığını dinleyin. Kulaklık jakını da aynı testle kontrol edin.</p>

<h2>7. Pil sağlığı: powercfg raporu</h2>
<p>Pil, ikinci el laptoplarda en çok yıpranan parçadır. Windows'ta pil sağlığını görmek için ek program gerekmez:</p>
<ol class="tm-steps">
<li>Başlat menüsünde "cmd" yazıp <strong>Komut İstemi</strong>'ni açın.</li>
<li><code>powercfg /batteryreport</code> komutunu yazıp <kbd>Enter</kbd> tuşuna basın.</li>
<li>Komut, raporun kaydedildiği yolu gösterir; genellikle kullanıcı klasörünüzdeki <code>battery-report.html</code> dosyasıdır. Bu dosyayı tarayıcıda açın.</li>
<li>"Installed batteries" bölümünde <strong>DESIGN CAPACITY</strong> (tasarım kapasitesi) ve <strong>FULL CHARGE CAPACITY</strong> (tam şarj kapasitesi) değerlerini bulun.</li>
<li>Tam şarj kapasitesini tasarım kapasitesine bölüp 100 ile çarpın. Sonuç, pilin kalan sağlık yüzdesidir.</li>
</ol>
<p>Örneğin tasarım kapasitesi 50.000 mWh, tam şarj kapasitesi 40.000 mWh ise pil yaklaşık yüzde 80 sağlıktadır. Raporda <strong>CYCLE COUNT</strong> (şarj döngüsü sayısı) da yer alabilir, ancak bazı piller bu bilgiyi vermez. Mac'te ise <strong>Sistem Ayarları &gt; Pil</strong> bölümündeki pil sağlığı bilgisine ve Sistem Bilgisi'ndeki Güç bölümünde yer alan döngü sayısına bakabilirsiniz.</p>
<div class="tm-callout tm-callout--warn">
<p><strong>Uyarı:</strong> Kasa kabarıksa, touchpad yerinden yükselmişse veya alt kapak tam oturmuyorsa pil şişmiş olabilir. Şişmiş pil güvenlik riski taşır; böyle bir cihazı pil değiştirilmeden kullanmayın.</p>
</div>

<h2>8. Portlar ve şarj</h2>
<p>Tüm USB portlarına USB belleği tek tek takıp tanındığını doğrulayın. HDMI çıkışı varsa ve imkânınız olursa bir monitöre bağlayın. Şarj aletini taktığınızda şarj göstergesinin hemen "şarj oluyor" durumuna geçmesi gerekir. Şarj soketi gevşekse veya kablo oynatıldığında şarj kesilip geliyorsa soket hasarlı olabilir. USB-C ile şarj olan modellerde şarjın hangi portlardan yapılabildiğini de deneyin.</p>

<h2>9. Performans ve ısı</h2>
<p>Laptopu 10–15 dakika boyunca yüksek çözünürlüklü bir video oynatarak veya birkaç ağır sekme açarak çalıştırın. Bu sürede fanın sürekli yüksek devirde çalışıp çalışmadığını, klavyenin üst kısmının aşırı ısınıp ısınmadığını ve sistemin donup donmadığını gözlemleyin. Aşırı ısınma çoğu zaman tozla tıkanmış fanlara veya kurumuş termal macuna işaret eder.</p>
<p>Görev Yöneticisi'ni (<kbd>Ctrl</kbd> + <kbd>Shift</kbd> + <kbd>Esc</kbd>) açarak <strong>Performans</strong> sekmesinde işlemci, bellek ve disk bilgilerinin ilandakiyle uyuştuğunu kontrol edin. Bu sırada Windows'un etkin olduğunu, BIOS şifresi ve kurumsal yönetim kilidi bulunmadığını da doğrulayın.</p>

<h2>Testlerin yanında sorulması gerekenler</h2>
<p>Donanım testleri cihazın bugünkü durumunu gösterir, ama geçmişini anlatmaz. Satıcıya birkaç soru sormak sürprizleri azaltır:</p>
<ul>
<li><strong>Fatura ve garanti:</strong> Fatura varsa satın alma tarihini ve kalan garanti süresini öğrenin. Laptopun alt yüzündeki seri numarasını üreticinin destek sayfasında sorgulayarak garanti durumunu doğrulayabilirsiniz.</li>
<li><strong>Servis geçmişi:</strong> Ekran, klavye veya ana kart daha önce değiştirildiyse bunun yetkili serviste yapılıp yapılmadığını sorun.</li>
<li><strong>Sıvı teması:</strong> Klavyenin altında yapışkanlık, lekeler veya tuşlarda düzensiz sertlik sıvı dökülmesine işaret edebilir.</li>
<li><strong>Depolama:</strong> Görev Yöneticisi'nde diskin türünü ve boyutunu kontrol edin. SSD'li bir laptopun saniyeler içinde açılması gerekir; açılış çok uzun sürüyorsa disk yorgun olabilir.</li>
<li><strong>Hesaplar:</strong> Satıcının Microsoft veya Apple hesabından çıkış yaptığından, cihazın sıfırlanabilir durumda olduğundan emin olun.</li>
</ul>
<p>Satıcı cihazı göstermeden önce sıfırladıysa, testleri yine de Windows kurulum sonrasında tarayıcıdan yapabilirsiniz. Tarayıcı açılamıyorsa klavye ve ekranı en azından kurulum ekranlarında gözle kontrol edin.</p>

<h2>İkinci el laptop kontrol listesi</h2>
<table>
<thead>
<tr><th>Test</th><th>Nasıl yapılır</th><th>Kabul edilebilir sonuç</th></tr>
</thead>
<tbody>
<tr><td>Ekran</td><td>Ölü piksel testi, tüm renkler</td><td>Ölü veya sıkışmış piksel yok, ışık sızması az</td></tr>
<tr><td>Klavye</td><td>Klavye testi, tüm tuşlar</td><td>Tüm tuşlar yeşil</td></tr>
<tr><td>Touchpad / mouse</td><td>Köşeler, kaydırma, mouse testi</td><td>Zıplama ve çift tıklama yok</td></tr>
<tr><td>Mikrofon</td><td>Mikrofon testi ve 5 saniyelik kayıt</td><td>Net, cızırtısız kayıt</td></tr>
<tr><td>Kamera</td><td>Kamera testi, çözünürlük ve FPS</td><td>Net görüntü, ilandaki çözünürlük</td></tr>
<tr><td>Hoparlör</td><td>Sol, sağ ve frekans taraması</td><td>İki kanal eşit, cızırtı yok</td></tr>
<tr><td>Pil sağlığı</td><td><code>powercfg /batteryreport</code></td><td>Kapasite tasarımın yüzde 80'i civarı veya üstü</td></tr>
<tr><td>Portlar ve şarj</td><td>USB bellek, HDMI, şarj aleti</td><td>Tüm portlar çalışıyor, şarj kesilmiyor</td></tr>
<tr><td>Performans ve ısı</td><td>15 dakikalık yük, Görev Yöneticisi</td><td>Donma yok, makul ısı, donanım ilanla uyumlu</td></tr>
</tbody>
</table>
<p>Kontrol listesinde bir veya iki küçük kusur çıkması alımdan vazgeçmeniz gerektiği anlamına gelmez. Bu kusurları fiyat pazarlığında kullanabilirsiniz. Ancak ekran, ana kart veya şişmiş pil gibi pahalı sorunlarda daha temkinli olun.</p>
HTML
	,
	'faqs'        => array(
		array( 'q' => 'İkinci el laptop alırken en önemli kontrol nedir?', 'a' => 'Ekran ve pil, değişimi en pahalı ve en sık sorun çıkaran parçalardır. Ölü piksel testiyle ekranı, powercfg pil raporuyla pil sağlığını mutlaka kontrol edin. Ardından klavye, kamera, mikrofon ve hoparlörü deneyin.' ),
		array( 'q' => 'Pil sağlığı yüzde kaç olursa kabul edilebilir?', 'a' => 'Kesin bir sınır yoktur, ama tam şarj kapasitesinin tasarım kapasitesinin yüzde 80 civarında veya üstünde olması genellikle iyi kabul edilir. Daha düşük değerlerde pil süresi belirgin biçimde kısalır. Bu durumda pil değişim maliyetini fiyata yansıtabilirsiniz.' ),
		array( 'q' => 'powercfg /batteryreport komutu nerede çalıştırılır?', 'a' => 'Komut İstemi veya PowerShell penceresinde çalıştırılır ve yönetici yetkisi gerekmez. Komut, battery-report.html adlı raporu oluşturup kaydedildiği yolu gösterir. Dosyayı tarayıcıda açarak kapasite değerlerini görebilirsiniz.' ),
		array( 'q' => 'Testleri satıcının bilgisayarında yapmak güvenli mi?', 'a' => 'Evet. Testmatik testleri tamamen tarayıcıda çalışır ve kamera görüntüsü, ses veya tuş basışları hiçbir sunucuya gönderilmez. Herhangi bir program kurmanıza da gerek yoktur.' ),
		array( 'q' => 'Testlerin hepsi ne kadar sürer?', 'a' => 'Ekran, klavye, kamera, mikrofon ve hoparlör testleri birkaç dakika içinde tamamlanır. Pil raporu ve port kontrolüyle birlikte yaklaşık 15 dakika ayırın. Isı testi için de 10–15 dakika eklerseniz toplamda yarım saat yeterlidir.' ),
		array( 'q' => 'Mac alırken de aynı testler geçerli mi?', 'a' => 'Ekran, klavye, kamera, mikrofon, hoparlör ve mouse testleri tarayıcıda çalıştığı için Mac\'te de aynı şekilde yapılır. Pil sağlığı için powercfg yerine Sistem Ayarları > Pil bölümüne ve Sistem Bilgisi\'ndeki döngü sayısına bakın.' ),
	),
);
