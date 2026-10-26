<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'Laptop Klavye Çalışmıyor? Adım Adım Çözüm Rehberi',
	'seo_title'   => 'Laptop Klavye Çalışmıyor? Adım Adım Çözüm | Testmatik',
	'description' => 'Laptop klavye çalışmıyor mu? Filtre Tuşları, sürücü, BIOS kontrolü, Fn Lock ve sıvı teması için adım adım çözümler; Lenovo, HP, Asus ve Casper için ipuçları.',
	'keywords'    => array( 'laptop klavye çalışmıyor', 'klavye çalışmıyor', 'bilgisayarda klavye çalışmıyor', 'windows 11 klavye çalışmıyor', 'laptop klavye tuşları çalışmıyor' ),
	'intro'       => 'Laptop klavyeniz aniden yanıt vermiyorsa paniğe gerek yok. Sorunun yazılımdan mı donanımdan mı kaynaklandığını birkaç dakikada ayırt edip adım adım çözebilirsiniz.',
	'excerpt'     => 'Laptop klavye çalışmıyor mu? Yeniden başlatmadan Filtre Tuşları, sürücü ve BIOS kontrolüne kadar sorunu adım adım çözün, servise ne zaman gideceğinizi öğrenin.',
	'category'    => 'Klavye',
	'tool'        => 'klavye-testi',
	'html'        => <<<'HTML'
<h2>Önce sorunu tanımlayın: Klavyenin tamamı mı, bazı tuşlar mı?</h2>
<p>"Laptop klavye çalışmıyor" şikâyeti aslında birkaç farklı durumu kapsar. Klavyenin tamamen tepkisiz olması, yalnızca birkaç tuşun basmaması, harf yerine rakam yazması ya da tuşların gecikmeli algılanması farklı nedenlere işaret eder. Çözüme başlamadan önce hangi durumda olduğunuzu netleştirmek, gereksiz uğraşı önler.</p>
<p>En hızlı yol, tuşları tek tek denemektir. <a href="{tool:klavye-testi}">Online klavye testi</a> aracımızı açıp tüm tuşlara sırayla basın. Basılan tuş mavi yanar, bir kez çalışmış tuş yeşile döner. Yeşile dönmeyen tuşlar, sorunun hangi bölgede yoğunlaştığını gösterir. Test tamamen tarayıcınızda çalışır; bastığınız tuşlar hiçbir sunucuya gönderilmez.</p>
<div class="tm-callout tm-callout--info">
<p><strong>Bilgi:</strong> <kbd>Fn</kbd> tuşu ve bazı medya tuşları donanım seviyesinde işlendiği için hiçbir tarayıcı tarafından algılanamaz. Testte bu tuşların yanmaması arıza anlamına gelmez.</p>
</div>

<h2>Belirtiye göre olası nedenler</h2>
<table>
<thead>
<tr><th>Belirti</th><th>Olası neden</th><th>İlk denenecek çözüm</th></tr>
</thead>
<tbody>
<tr><td>Hiçbir tuş çalışmıyor</td><td>Sürücü hatası, Filtre Tuşları, gevşek şerit kablo</td><td>Yeniden başlatma, Filtre Tuşları kontrolü</td></tr>
<tr><td>Harf yerine rakam yazıyor</td><td>Num Lock açık (sayısal tuş takımı olmayan modellerde)</td><td><kbd>Num Lock</kbd> veya <kbd>Fn</kbd> + <kbd>Num Lock</kbd></td></tr>
<tr><td>F tuşları ses/parlaklık değiştiriyor</td><td>Fn Lock (eylem tuşu modu) açık</td><td><kbd>Fn</kbd> + <kbd>Esc</kbd> veya BIOS ayarı</td></tr>
<tr><td>Tuşlara uzun basmak gerekiyor</td><td>Filtre Tuşları etkin</td><td>Erişilebilirlik ayarlarından kapatın</td></tr>
<tr><td>Belirli bir sıra veya bölge çalışmıyor</td><td>Sıvı teması, kablo ya da membran hasarı</td><td>BIOS testi, ardından servis</td></tr>
<tr><td>Yanlış karakterler çıkıyor</td><td>Yanlış klavye düzeni (Q/F) seçili</td><td>Dil ve bölge ayarlarından düzeni kontrol edin</td></tr>
</tbody>
</table>
<p>Son satırdaki durum çok sık karıştırılır. Bilgisayarda Türkçe F seçiliyken Q klavye kullanıyorsanız tuşlar "çalışmıyor" gibi görünür ama aslında farklı harfler yazar. Ayrıntılar için <a href="{post:q-klavye-f-klavye-farki}">Q klavye ve F klavye farkı</a> rehberimize göz atabilirsiniz.</p>

<h2>Adım adım çözüm: Basit olandan başlayın</h2>
<div class="tm-cta" data-tool="klavye-testi"></div>
<h3>1. Bilgisayarı tamamen yeniden başlatın</h3>
<p>Kulağa basit gelse de çoğu geçici sürücü hatası yeniden başlatmayla düzelir. Windows 11'de "Kapat" yerine <strong>Yeniden başlat</strong> seçeneğini kullanın. Hızlı başlatma özelliği açıksa "Kapat" komutu sistemi tam olarak sıfırlamaz; yeniden başlatma ise sürücüleri baştan yükler.</p>
<p>Klavye tamamen tepkisizken yazı yazmanız gerekirse ekran klavyesini açabilirsiniz: <kbd>Windows</kbd> + <kbd>Ctrl</kbd> + <kbd>O</kbd> kısayolu ya da <strong>Ayarlar &gt; Erişilebilirlik &gt; Klavye &gt; Ekran klavyesi</strong> yolu işinizi görür.</p>

<h3>2. Filtre Tuşları'nı kapatın</h3>
<p>Filtre Tuşları (Filter Keys), kısa ve tekrarlanan tuş vuruşlarını yok sayan bir erişilebilirlik özelliğidir. Sağ <kbd>Shift</kbd> tuşunu yaklaşık 8 saniye basılı tutmak bu özelliği farkında olmadan açabilir. Sonuçta tuşlar ya hiç algılanmaz ya da ancak uzun basınca yazar.</p>
<ol class="tm-steps">
<li><strong>Ayarlar &gt; Erişilebilirlik &gt; Klavye</strong> yolunu izleyin.</li>
<li><strong>Filtre Tuşları</strong> anahtarını kapalı konuma getirin.</li>
<li>Aynı sayfada <strong>Yapışkan Tuşlar</strong> ve <strong>İki Durumlu Tuşlar</strong> ayarlarını da kontrol edin.</li>
<li>Klavye testinde tuşları yeniden deneyin.</li>
</ol>

<h3>3. Klavye sürücüsünü Aygıt Yöneticisi'nden yeniden yükleyin</h3>
<p>Windows 11 klavye çalışmıyor sorununun en yaygın nedenlerinden biri, bir güncellemeden sonra bozulan sürücüdür.</p>
<ol class="tm-steps">
<li>Başlat düğmesine sağ tıklayıp <strong>Aygıt Yöneticisi</strong>'ni açın (fareyle ya da dokunmatik yüzeyle).</li>
<li><strong>Klavyeler</strong> bölümünü genişletin. Sarı ünlem işareti olan bir cihaz varsa sorun büyük olasılıkla buradadır.</li>
<li>Laptop klavyesine (genellikle "Standart PS/2 Klavye" veya "HID Klavye Aygıtı") sağ tıklayıp <strong>Cihazı kaldır</strong>'ı seçin.</li>
<li>Bilgisayarı yeniden başlatın. Windows sürücüyü otomatik olarak tekrar yükler.</li>
<li>Sorun sürerse üreticinin destek sayfasından modelinize uygun yonga seti ve klavye sürücülerini indirin.</li>
</ol>
<p>Harici USB klavye takılıyken laptop klavyesi çalışmıyorsa, harici klavyeyi çıkarıp yeniden deneyin. Bazı nadir durumlarda iki cihazın sürücüleri çakışabilir.</p>
<p>Masaüstü bir bilgisayarda klavye çalışmıyorsa durum biraz daha basittir. Kabloyu farklı bir USB bağlantı noktasına, mümkünse doğrudan kasanın arkasındaki girişe takın; USB çoğaltıcılar ve ön panel girişleri yeterli güç vermeyebilir. Kablosuz klavyelerde pilleri yenileyin, alıcıyı başka bir porta takın ve Bluetooth modellerde cihazı <strong>Ayarlar &gt; Bluetooth ve cihazlar</strong> bölümünden kaldırıp yeniden eşleştirin.</p>

<h3>4. Num Lock ve Fn Lock durumunu kontrol edin</h3>
<p>Sayısal tuş takımı olmayan bazı eski veya kompakt laptoplarda Num Lock açıldığında <kbd>U</kbd>, <kbd>I</kbd>, <kbd>O</kbd>, <kbd>J</kbd>, <kbd>K</kbd>, <kbd>L</kbd> ve <kbd>M</kbd> gibi harfler rakam yazmaya başlar. Bu durumda <kbd>Num Lock</kbd> ya da <kbd>Fn</kbd> + <kbd>Num Lock</kbd> kombinasyonuyla özelliği kapatın.</p>
<p>F tuşlarınız F5 yerine ses açıyorsa Fn Lock etkindir. Birçok modelde <kbd>Fn</kbd> + <kbd>Esc</kbd> bu modu değiştirir; bazı modellerde ise ayar yalnızca BIOS menüsünde bulunur.</p>

<h2>BIOS testi: Donanım mı, yazılım mı?</h2>
<p>Bu adım, sorunun kaynağını kesin olarak ayırmanın en güvenilir yoludur. BIOS (veya UEFI) menüsü Windows'tan bağımsız çalışır. Klavye BIOS içinde düzgün çalışıyorsa donanım sağlamdır ve sorun Windows tarafındadır. BIOS'ta da tuşlar tepki vermiyorsa sorun büyük olasılıkla donanımsaldır.</p>
<ol class="tm-steps">
<li>Bilgisayarı tamamen kapatın.</li>
<li>Açarken üreticinizin BIOS tuşuna art arda basın. Yaygın tuşlar <kbd>F2</kbd>, <kbd>Del</kbd>, <kbd>F10</kbd> ve <kbd>Esc</kbd>'dir.</li>
<li>BIOS menüsünde ok tuşlarıyla gezinin, mümkünse bir metin alanına birkaç harf yazmayı deneyin.</li>
<li>Herhangi bir ayarı değiştirmeden <strong>kaydetmeden çıkın</strong> (Exit Without Saving).</li>
</ol>
<div class="tm-callout tm-callout--tip">
<p><strong>İpucu:</strong> Klavye BIOS'a girmenize bile izin vermiyorsa bir USB klavye takıp aynı denemeyi yapın. Harici klavye çalışıp dahili klavye çalışmıyorsa bu da donanımsal bir soruna işaret eder.</p>
</div>

<h2>Donanımsal nedenler: Sıvı teması ve şerit kablo</h2>
<h3>Sıvı teması</h3>
<p>Klavyeye çay, kahve ya da su döküldüyse ilk kural cihazı hemen kapatıp şarjdan çıkarmaktır. Ardından laptopu ters "V" şeklinde açarak sıvının akmasını sağlayın. Saç kurutma makinesiyle sıcak hava vermeyin; ısı plastik parçalara zarar verebilir. Şekerli içecekler kuruduktan sonra bile yapışkan kalıntı bırakır ve tuş temaslarını bozar. Bu durumda profesyonel temizlik gerekebilir.</p>
<p>Sıvı teması sonrası klavyenin bir bölümü çalışıp bir bölümü çalışmıyorsa, membran katmanındaki iletken yollar zarar görmüş olabilir. Laptop klavyeleri genellikle tek parça değiştirilir.</p>

<h3>Gevşek veya hasarlı şerit kablo</h3>
<p>Laptop klavyesi anakarta ince bir şerit (flex) kabloyla bağlanır. Düşme, darbe ya da daha önceki bir servis işlemi bu kablonun yerinden oynamasına neden olabilir. Belirti genellikle tüm klavyenin ya da belirli tuş sıralarının aynı anda çalışmamasıdır. Kabloyu yeniden takmak için kasanın açılması gerekir; garanti kapsamındaysanız bunu kendiniz yapmayın.</p>

<h2>Markaya göre dikkat edilmesi gerekenler</h2>
<p>Lenovo, HP, Asus, Casper ve Monster gibi markaların çoğu, klavye davranışını etkileyen kendi yardımcı uygulamalarını sunar. Bu uygulamalar Fn Lock, klavye aydınlatması, kısayol tuşları ve sürücü güncellemelerini yönetebilir.</p>
<ul>
<li><strong>Lenovo:</strong> Lenovo Vantage uygulamasında Fn tuşu davranışı ve sistem güncellemeleri yer alır. Modele göre ayrıntılı adımlar <a href="{post:lenovo-laptop-klavye-calismiyor}">Lenovo laptop klavye çalışmıyor</a> rehberinde. Birçok modelde <kbd>Fn</kbd> + <kbd>Esc</kbd> Fn Lock'u değiştirir.</li>
<li><strong>HP:</strong> HP Support Assistant sürücü güncellemelerini ve donanım tanılamayı içerir. Eylem tuşu modu birçok modelde BIOS'tan değiştirilebilir.</li>
<li><strong>Asus:</strong> MyASUS uygulaması sürücü güncellemeleri, tanılama ve kısayol tuşu ayarları sunar.</li>
<li><strong>Casper ve Monster:</strong> Özellikle oyuncu serilerinde üreticinin kendi kontrol merkezi yazılımı klavye aydınlatmasını ve tuş işlevlerini yönetir. Bu yazılım güncel değilse ya da bozulmuşsa klavye beklenmedik davranabilir.</li>
</ul>
<p>Hangi marka olursa olsun, sürücüleri üçüncü taraf "sürücü güncelleyici" programlardan değil, üreticinin resmi destek sayfasından indirmeniz en güvenli yoldur.</p>

<h2>Ne zaman servise gitmelisiniz?</h2>
<p>Aşağıdaki durumlardan biri geçerliyse yazılımsal adımları tekrarlamak yerine yetkili servise başvurun:</p>
<ul>
<li>Klavye BIOS menüsünde de çalışmıyor.</li>
<li>Sıvı döküldükten sonra sorun başladı.</li>
<li>Belirli tuş sıraları veya bölgeler topluca devre dışı.</li>
<li>Tuşlar fiziksel olarak sıkışıyor, kırık ya da yerinden çıkmış.</li>
<li>Cihaz garanti kapsamında ve kasayı açmak garantiyi etkileyebilir.</li>
</ul>
<p>Servise gitmeden önce hangi tuşların çalışmadığını not almanız işi kolaylaştırır. Klavye testinde yeşile dönmeyen tuşların ekran görüntüsünü alarak teknisyene somut bilgi verebilirsiniz.</p>
<p>Onarım beklerken işinizi aksatmamak için harici bir USB ya da Bluetooth klavye kullanabilirsiniz. Servise vermeden önce önemli dosyalarınızı yedeklemeyi ve gerekiyorsa hesap şifrelerinizi güvenceye alın. Garanti dışı onarımlarda klavyenin tek başına mı yoksa üst kasayla birlikte mi değiştirileceğini önceden sormak, maliyet konusunda sürpriz yaşamamanızı sağlar.</p>

<h2>Diğer donanımları da kontrol edin</h2>
<p>Klavye sorunu bazen tek başına gelmez. Özellikle düşme veya sıvı teması sonrası diğer bileşenleri de test etmek iyi bir fikirdir. Dokunmatik yüzey ya da harici farenin tuşlarını <a href="{tool:mouse-testi}">mouse testi</a> ile, ekranda hasar olup olmadığını <a href="{tool:olu-piksel-testi}">ölü piksel testi</a> ile kontrol edebilirsiniz. Klavyeniz çalışıyor ama aynı anda basılan tuşlardan bazıları algılanmıyorsa sorun arıza değil, <a href="{post:klavye-ghosting-nedir}">klavye ghosting</a> sınırı olabilir.</p>
<p>İkinci el bir laptop almayı düşünüyorsanız, klavyeyle birlikte tüm donanımı sırayla nasıl kontrol edeceğinizi <a href="{post:ikinci-el-laptop-kontrol}">ikinci el laptop alırken yapılması gereken testler</a> rehberimizde bulabilirsiniz. Sorunu çözdükten sonra son bir kez <a href="{tool:klavye-testi}">klavye tuş testi</a> yaparak tüm tuşların yeşile döndüğünden emin olun.</p>
HTML
	,
	'faqs'        => array(
		array( 'q' => 'Laptop klavyem neden birden çalışmayı bıraktı?', 'a' => 'En yaygın nedenler bozulan sürücü, yanlışlıkla açılan Filtre Tuşları, Windows güncellemesi sonrası oluşan uyumsuzluk veya gevşeyen şerit kablodur. Önce bilgisayarı yeniden başlatın, ardından Filtre Tuşları ayarını ve Aygıt Yöneticisi\'ni kontrol edin.' ),
		array( 'q' => 'Klavyenin donanımsal mı yazılımsal mı arızalı olduğunu nasıl anlarım?', 'a' => 'Bilgisayarı açarken BIOS menüsüne girin ve ok tuşlarıyla gezinmeyi deneyin. Klavye BIOS içinde çalışıyorsa donanım sağlamdır ve sorun Windows tarafındadır. BIOS içinde de çalışmıyorsa sorun büyük olasılıkla donanımsaldır.' ),
		array( 'q' => 'Laptop klavyem harf yerine rakam yazıyor, ne yapmalıyım?', 'a' => 'Sayısal tuş takımı olmayan bazı laptoplarda Num Lock açıkken bazı harf tuşları rakam yazar. Num Lock tuşuna ya da Fn ile Num Lock kombinasyonuna basarak bu özelliği kapatın.' ),
		array( 'q' => 'Windows 11 güncellemesinden sonra klavye çalışmıyor, çözümü nedir?', 'a' => 'Aygıt Yöneticisi\'nde Klavyeler bölümünden laptop klavyesine sağ tıklayıp Cihazı kaldır seçeneğini kullanın ve bilgisayarı yeniden başlatın. Sorun sürerse üreticinin destek sayfasından modelinize uygun güncel sürücüleri yükleyin.' ),
		array( 'q' => 'Klavye testinde Fn tuşu neden yanmıyor?', 'a' => 'Fn tuşu laptopun kendi donanımı tarafından işlenir ve işletim sistemine ayrı bir tuş olarak iletilmez. Bu nedenle hiçbir tarayıcı Fn tuşunu algılayamaz. Testte yanmaması bir arıza belirtisi değildir.' ),
		array( 'q' => 'Klavyeye sıvı döküldü, kendim kurutabilir miyim?', 'a' => 'Cihazı hemen kapatıp şarjdan çıkarın ve ters V şeklinde bırakarak sıvının akmasını sağlayın. Sıcak hava kullanmayın. Şekerli bir içecek döküldüyse veya kuruduktan sonra tuşlar çalışmıyorsa profesyonel temizlik için servise başvurmanız gerekir.' ),
	),
);
