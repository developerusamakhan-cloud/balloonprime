<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'Laptop Kamera Çalışmıyor? 10 Kesin Çözüm',
	'seo_title'   => 'Laptop Kamera Çalışmıyor? 10 Kesin Çözüm Yolu | Testmatik',
	'description' => 'Laptop kamera çalışmıyor mu? Kamera kapağı, Fn tuşu, Windows 11 kamera izni, sürücü, tarayıcı izni ve BIOS ayarı dahil 10 çözümü sırayla deneyin.',
	'keywords'    => array( 'laptop kamera çalışmıyor', 'laptop kamerası açılmıyor', 'web kamera çalışmıyor', 'windows 11 kamera çalışmıyor', 'bilgisayar kamera görüntü vermiyor' ),
	'intro'       => 'Laptop kameranız siyah ekran veriyor ya da hiç algılanmıyorsa paniğe gerek yok. Sorunların çoğu basit bir kapak, tuş veya izin ayarından kaynaklanır.',
	'excerpt'     => 'Laptop kamerası açılmıyor veya siyah ekran veriyorsa kapak, Fn tuşu, Windows 11 izni ve sürücüden BIOS ayarına kadar 10 çözümü sırayla deneyin.',
	'category'    => 'Kamera',
	'tool'        => 'kamera-testi',
	'html'        => <<<'HTML'
<h2>Önce hızlı bir teşhis yapın</h2>
<p>Laptop kamera çalışmıyor şikâyetinin arkasında genellikle üç durumdan biri vardır: kamera hiçbir uygulamada açılmıyordur, yalnızca belirli bir programda veya sitede çalışmıyordur ya da açılıyor ama görüntü tamamen siyahtır. Hangi durumda olduğunuzu bilmek, aşağıdaki çözümlerden hangisiyle başlamanız gerektiğini gösterir.</p>
<p>Uygulamalardan bağımsız bir kontrol için tarayıcınızda <a href="{tool:kamera-testi}">laptop kamera testi</a> sayfasını açıp izin verin. Canlı önizleme geliyorsa kamera, sürücü ve Windows tarafı çalışıyordur; sorun kullandığınız uygulamadadır. Kamera listede hiç görünmüyorsa veya hata alıyorsanız sistem adımlarına geçin.</p>
<div class="tm-callout tm-callout--info">
<p><strong>Bilgi:</strong> Testmatik kamera testi tamamen tarayıcınızda çalışır. Görüntünüz hiçbir sunucuya gönderilmez ve kaydedilmez; çektiğiniz fotoğraf yalnızca kendi cihazınıza kaydedilir.</p>
</div>

<h2>Belirtiye göre nereden başlamalı?</h2>
<table>
<thead>
<tr><th>Belirti</th><th>Olası neden</th><th>Deneyeceğiniz çözüm</th></tr>
</thead>
<tbody>
<tr><td>Görüntü tamamen siyah</td><td>Gizlilik kapağı kapalı</td><td>1</td></tr>
<tr><td>Kamera hiç algılanmıyor</td><td>Fn tuşu, sürücü veya BIOS</td><td>2, 5, 9</td></tr>
<tr><td>"Kamera kullanımda" uyarısı</td><td>Başka bir uygulama kamerayı tutuyor</td><td>4</td></tr>
<tr><td>Yalnızca bir sitede çalışmıyor</td><td>Tarayıcı izni engellenmiş</td><td>6</td></tr>
<tr><td>Hiçbir uygulamada izin yok</td><td>Windows gizlilik ayarı veya antivirüs</td><td>3, 7</td></tr>
</tbody>
</table>

<h2>1. Gizlilik kapağını kontrol edin</h2>
<p>Pek çok yeni laptopta kameranın üzerinde kaydırmalı küçük bir fiziksel kapak bulunur. Kapak kapalıyken kamera aslında çalışır ama görüntü siyah ya da çizgili görünür. Bazı modellerde bu kapak klavyenin yanındaki bir anahtarla elektronik olarak da kontrol edilir. Kameranın üstüne yakından bakın; kırmızı veya çizgili bir yüzey görüyorsanız kapağı açın.</p>

<h2>2. Fn kamera tuşuna bakın</h2>
<p>Bazı laptoplarda F tuşlarından birinin üzerinde üstü çizili kamera simgesi bulunur. Bu tuş kamerayı donanım düzeyinde kapatır ve Windows kamerayı hiç görmez. İlgili tuşa tek başına veya <kbd>Fn</kbd> ile birlikte basın, ardından testi yeniden deneyin. Hangi tuşun kamerayı kontrol ettiği markaya ve modele göre değişir.</p>

<div class="tm-cta" data-tool="kamera-testi"></div>

<h2>3. Windows 11 kamera gizlilik ayarını açın</h2>
<p>Windows 11'de tüm uygulamaların kamera erişimi tek bir gizlilik sayfasından yönetilir. Burada izin kapalıysa kamera sağlam olsa bile hiçbir program görüntü alamaz.</p>
<ol class="tm-steps">
<li><kbd>Win</kbd> + <kbd>I</kbd> ile Ayarlar'ı açın.</li>
<li><strong>Gizlilik ve güvenlik &gt; Kamera</strong> bölümüne gidin.</li>
<li><strong>Kamera erişimi</strong> anahtarını açın.</li>
<li><strong>Uygulamaların kameranıza erişmesine izin verin</strong> seçeneğini açın ve listedeki uygulamanızı kontrol edin.</li>
<li>Chrome, Zoom veya Discord gibi programlar için <strong>Masaüstü uygulamalarının kameranıza erişmesine izin verin</strong> anahtarını da açın.</li>
</ol>
<p>Ayrıca <strong>Ayarlar &gt; Bluetooth ve cihazlar &gt; Kameralar</strong> sayfasında kameranın listede olduğunu ve devre dışı bırakılmadığını kontrol edin.</p>

<h2>4. Kamerayı kullanan başka uygulamayı kapatın</h2>
<p>Windows'ta bir kamerayı aynı anda genellikle yalnızca bir uygulama kullanabilir. Arka planda açık kalan Teams, Zoom, Skype veya bir tarayıcı sekmesi kamerayı tutuyorsa diğer program "kamera başka bir uygulama tarafından kullanılıyor" hatası verir ya da siyah ekran gösterir. Görüntülü görüşme uygulamalarını görev çubuğundaki gizli simgeler dahil tamamen kapatın. Emin değilseniz bilgisayarı yeniden başlatmak en hızlı çözümdür.</p>
<p>Kameranın yanındaki küçük ışık da ipucu verir. Hiçbir programı bilerek açmadığınız hâlde ışık yanıyorsa kamera arka planda bir uygulama tarafından kullanılıyordur. Windows 11, kamerayı o anda kullanan uygulamayı <strong>Gizlilik ve güvenlik &gt; Kamera</strong> sayfasındaki son etkinlik bilgisinde gösterebilir.</p>

<h2>5. Sürücüyü Aygıt Yöneticisi'nden yenileyin</h2>
<p>Başlat düğmesine sağ tıklayıp <strong>Aygıt Yöneticisi</strong>'ni açın. Kamera genellikle <strong>Kameralar</strong> veya <strong>Görüntüleme aygıtları</strong> başlığı altında yer alır.</p>
<ol class="tm-steps">
<li>Aygıtın üzerinde aşağı ok simgesi varsa devre dışıdır; sağ tıklayıp <strong>Cihazı etkinleştir</strong> deyin.</li>
<li>Sarı ünlem varsa <strong>Sürücüyü güncelleştir</strong> seçeneğini deneyin.</li>
<li>Sonuç alamazsanız <strong>Cihazı kaldır</strong> deyin ve üst menüden <strong>Eylem &gt; Donanım değişikliklerini tara</strong> ile aygıtı yeniden yükletin.</li>
<li>Kamera hiçbir başlık altında görünmüyorsa <strong>Görünüm &gt; Gizli cihazları göster</strong> seçeneğini açın ve laptop üreticisinin destek sayfasından modelinize özel sürücüyü indirin.</li>
</ol>

<h2>6. Tarayıcı kamera iznini düzeltin</h2>
<p>Kamera Windows Kamera uygulamasında çalışıyor ama bir web sitesinde çalışmıyorsa site izni engellenmiştir. Chrome ve Edge'de adres çubuğunun solundaki site ayarları simgesine tıklayın, <strong>Kamera</strong> iznini <strong>İzin ver</strong> yapın ve sayfayı yenileyin. Birden fazla kamera varsa tarayıcı ayarlarında varsayılan kameranın doğru seçildiğinden emin olun. Tarayıcılar kamera erişimini yalnızca HTTPS bağlantılı sayfalara verir.</p>
<p>Firefox'ta da adres çubuğundaki simgeden engellenen izni kaldırabilirsiniz. Gizli pencerede izinlerin her oturumda yeniden sorulduğunu unutmayın.</p>

<h2>7. Antivirüsün web kamerası korumasını kontrol edin</h2>
<p>Bazı güvenlik yazılımlarında "web kamerası koruması" gibi adlarla anılan bir özellik bulunur. Bu özellik, izin listesinde olmayan programların kameraya erişimini engeller. Antivirüs programınızın gizlilik veya koruma ayarlarını açın, kullandığınız uygulamaya izin verin ya da kısa süreliğine korumayı kapatıp deneyin. Testten sonra korumayı yeniden açmayı unutmayın.</p>

<h2>8. Windows Kamera uygulamasıyla deneyin</h2>
<p>Başlat menüsünde "Kamera" yazarak Windows'un yerleşik Kamera uygulamasını açın. Bu uygulama tarayıcıdan ve üçüncü taraf programlardan bağımsız olduğu için iyi bir karşılaştırma noktasıdır. Burada görüntü geliyorsa sorun diğer uygulamanın ayarlarındadır. "Kameranızı bulamıyoruz" mesajı ve 0xA00F4244 hata kodu alıyorsanız Windows kamerayı hiç görmüyordur; 2, 5 ve 9 numaralı çözümlere dönün.</p>

<h2>9. BIOS'ta kamera kapatılmış olabilir</h2>
<p>Özellikle kurumsal laptoplarda ve ikinci el cihazlarda kamera BIOS/UEFI ayarlarından devre dışı bırakılmış olabilir. Bilgisayarı yeniden başlatırken üreticinin BIOS tuşuna (genellikle <kbd>F2</kbd>, <kbd>F10</kbd>, <kbd>Del</kbd> veya <kbd>Esc</kbd>) basarak ayarlara girin. Güvenlik veya Aygıt Yapılandırması gibi bölümlerde kamera seçeneğini arayın ve etkinleştirin. BIOS'ta emin olmadığınız diğer ayarları değiştirmeyin.</p>

<h2>10. Donanım arızasını değerlendirin</h2>
<p>Tüm adımlara rağmen kamera hiçbir yerde görünmüyorsa arıza donanımsal olabilir. Laptopun ekran kapağındaki kamera kablosu, menteşe bölgesinden geçtiği için zamanla yıpranabilir veya bir ekran değişimi sonrası takılmadan unutulmuş olabilir. Garanti kapsamındaysanız yetkili servise başvurun. Beklerken bir USB web kamerası pratik bir geçici çözümdür.</p>
<p>Arızayı daraltmak için bir USB web kamerası takıp aynı testi yapabilirsiniz. Harici kamera sorunsuz çalışıyorsa Windows, tarayıcı ve uygulama ayarları doğrudur; sorun yalnızca dahili kameradadır. Bu bilgi, servise başvururken arızayı net biçimde anlatmanızı da kolaylaştırır.</p>

<h2>Kamera açılıyor ama görüntü kötüyse</h2>
<p>Bazen kamera çalışır ama görüntü bulanık, karanlık veya takılarak gelir. Bu durumda sorun bir ayar ya da ortam koşulu olabilir; donanımın bozuk olduğu anlamına gelmez.</p>
<ul>
<li><strong>Bulanık görüntü:</strong> Laptop kameraları ekran kapağının üst kenarında durduğu için lens kolayca parmak izi ve toz toplar. Mikrofiber bir bezle nazikçe silin.</li>
<li><strong>Karanlık veya grenli görüntü:</strong> Küçük kamera sensörleri zayıf ışıkta zorlanır. Işık kaynağını arkanıza değil, karşınıza alın. Windows 11'de <strong>Ayarlar &gt; Bluetooth ve cihazlar &gt; Kameralar</strong> sayfasında kameraya tıklayarak parlaklık ve kontrast gibi temel ayarları değiştirebilirsiniz.</li>
<li><strong>Takılan görüntü:</strong> Düşük FPS çoğu zaman yetersiz ışıktan kaynaklanır, çünkü kamera pozlama süresini uzatır. Güç tasarrufu modu ve yoğun işlemci kullanımı da akıcılığı düşürebilir.</li>
<li><strong>Beklenenden düşük çözünürlük:</strong> Uygulamalar kameradan her zaman en yüksek çözünürlüğü istemez. Testte 720p ve 1080p düğmeleriyle kameranın gerçekten neyi desteklediğini görebilirsiniz.</li>
</ul>
<p>Windows Hello yüz tanıma kullanan bazı laptoplarda normal kameranın yanında ayrı bir kızılötesi kamera bulunur. Listede iki kamera görüyorsanız görüntülü görüşme için kızılötesi olanı değil, renkli görüntü veren kamerayı seçin.</p>

<h2>macOS kullanıyorsanız</h2>
<p>Mac'lerde kamera için ayrı bir sürücü kurulmaz. Uygulamanın izinli olduğunu <strong>Sistem Ayarları &gt; Gizlilik ve Güvenlik &gt; Kamera</strong> bölümünden kontrol edin; izni yeni verdiyseniz uygulamayı kapatıp yeniden açın. Kamera kullanılırken yanında yeşil bir ışık yanar. Sorun sürerse kamerayı kullanabilecek tüm uygulamaları kapatıp Mac'i yeniden başlatın.</p>
<p>Mac'te kamera yalnızca bir kullanıcı hesabında çalışmıyorsa <strong>Sistem Ayarları &gt; Ekran Süresi</strong> altındaki içerik ve gizlilik kısıtlamalarını da kontrol edin. Bu kısıtlamalar etkinse kameranın kullanımı engellenmiş olabilir. Kurumsal Mac'lerde ise kamera, şirketin yönetim profiliyle kapatılmış olabilir; bu durumda BT ekibinize başvurun.</p>

<h2>İlgili testler ve rehberler</h2>
<p>Görüntülü görüşmelerde sesiniz de gitmiyorsa <a href="{tool:mikrofon-testi}">mikrofon testi</a> ile mikrofonunuzu, karşı tarafı duyamıyorsanız <a href="{tool:hoparlor-testi}">hoparlör testi</a> ile çıkış sesini kontrol edin. Ayrıntılı ses çözümleri için <a href="{post:mikrofon-calismiyor}">mikrofon çalışmıyor</a> rehberimize bakabilirsiniz.</p>
<p>Kullanılmış bir bilgisayar almayı düşünüyorsanız kamerayı da kapsayan <a href="{post:ikinci-el-laptop-kontrol}">ikinci el laptop alırken yapılacak testler</a> yazımız işinize yarayacak. Sorunu çözdükten sonra <a href="{tool:kamera-testi}">web kamera testi</a> ile çözünürlüğü ve FPS değerini kontrol ederek kameranın tam performansla çalıştığından emin olun.</p>
HTML
	,
	'faqs'        => array(
		array( 'q' => 'Laptop kameram neden siyah ekran veriyor?', 'a' => 'En sık neden kameranın üzerindeki fiziksel gizlilik kapağının kapalı olmasıdır. Kapak açıksa başka bir uygulamanın kamerayı kullanıp kullanmadığını kontrol edin. Sorun sürerse sürücüyü Aygıt Yöneticisi üzerinden yeniden yükleyin.' ),
		array( 'q' => 'Kamera Aygıt Yöneticisi\'nde hiç görünmüyorsa ne yapmalıyım?', 'a' => 'Önce Fn kamera tuşunu ve BIOS ayarlarını kontrol edin, çünkü ikisi de kamerayı Windows\'tan tamamen gizleyebilir. Ardından gizli cihazları gösterip üreticinin sürücüsünü kurun. Yine görünmüyorsa kamera kablosu veya modülü arızalı olabilir.' ),
		array( 'q' => 'Kamera Windows Kamera uygulamasında çalışıyor ama Zoom\'da çalışmıyor, neden?', 'a' => 'Bu durumda donanım sağlamdır. Zoom ayarlarında doğru kameranın seçildiğini ve Windows\'ta masaüstü uygulamalarının kamera izninin açık olduğunu kontrol edin. Arka planda kamerayı tutan başka bir uygulama olmadığından da emin olun.' ),
		array( 'q' => 'Kamera testi görüntümü kaydediyor mu?', 'a' => 'Hayır. Test tamamen tarayıcınızda çalışır ve görüntü hiçbir sunucuya gönderilmez. Fotoğraf çek düğmesine basarsanız PNG dosyası yalnızca kendi cihazınıza kaydedilir.' ),
		array( 'q' => 'Laptop kamerası neden düşük kaliteli görünüyor?', 'a' => 'Pek çok laptop kamerası 720p çözünürlüktedir ve zayıf ışıkta görüntü grenli olur. Kamera testinde gerçek çözünürlüğü ve FPS değerini görebilirsiniz. Yüzünüze önden gelen iyi bir ışık ve temiz bir lens görüntüyü belirgin şekilde iyileştirir.' ),
		array( 'q' => 'Mac\'te kamera çalışmıyorsa sürücü kurmam gerekir mi?', 'a' => 'Hayır, Mac\'lerde dahili kamera için ayrı sürücü gerekmez. Sistem Ayarları > Gizlilik ve Güvenlik > Kamera bölümünden uygulamaya izin verin ve uygulamayı yeniden açın. Sorun sürerse Mac\'i yeniden başlatın.' ),
	),
);
