<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'Mikrofon Çalışmıyor? Windows 11, Laptop ve Kulaklık İçin Çözümler',
	'seo_title'   => 'Mikrofon Çalışmıyor? Windows 11 ve Laptop Çözümü | Testmatik',
	'description' => 'Mikrofon çalışmıyor mu? Windows 11 gizlilik izni, varsayılan giriş aygıtı, sürücü, kulaklık jakı ve Discord, Teams, Zoom ayarları için adım adım çözüm.',
	'keywords'    => array( 'mikrofon çalışmıyor', 'laptopta mikrofon çalışmıyor', 'kulaklık mikrofon çalışmıyor', 'bilgisayar mikrofon çalışmıyor', 'windows 11 mikrofon çalışmıyor' ),
	'intro'       => 'Mikrofonunuz sesinizi almıyorsa sorun çoğu zaman donanımda değil, bir izin ya da yanlış seçilmiş aygıttadır. Bu rehberde en olası nedenden başlayarak adım adım ilerliyoruz.',
	'excerpt'     => 'Windows 11, laptop ve kulaklık mikrofonu çalışmıyorsa gizlilik izni, giriş aygıtı, sürücü ve jak uyumunu sırayla kontrol ederek sorunu bulun.',
	'category'    => 'Ses',
	'tool'        => 'mikrofon-testi',
	'html'        => <<<'HTML'
<h2>Önce sorunun nerede olduğunu anlayın</h2>
<p>"Mikrofon çalışmıyor" şikâyeti üç farklı duruma işaret edebilir: mikrofon hiçbir yerde ses almıyordur, yalnızca belirli bir uygulamada çalışmıyordur ya da ses alıyor ama çok kısık veya cızırtılıdır. Hangisini yaşadığınızı bilmek, doğru çözüme çok daha hızlı ulaşmanızı sağlar.</p>
<p>En kolay ayrım yöntemi, mikrofonu uygulamadan bağımsız olarak denemektir. Tarayıcınızda <a href="{tool:mikrofon-testi}">online mikrofon testi</a> açın, izin verin ve konuşun. Seviye göstergesi hareket ediyorsa donanım ve Windows tarafı büyük olasılıkla sağlamdır; sorun Discord, Teams veya Zoom gibi uygulamanın kendi ayarlarındadır. Gösterge hiç kıpırdamıyorsa aşağıdaki sistem adımlarıyla devam edin.</p>
<p>Adımları sırayla uygulamanızı öneririz. Her değişiklikten sonra testi yeniden deneyin; böylece sorunu hangi ayarın çözdüğünü bilir, aynı durumla tekrar karşılaştığınızda dakikalar içinde düzeltebilirsiniz.</p>
<div class="tm-callout tm-callout--info">
<p><strong>Bilgi:</strong> Testmatik testleri tamamen tarayıcınızda çalışır. Sesiniz hiçbir sunucuya yüklenmez ve kaydedilmez; "5 saniye kaydet" ile aldığınız kayıt yalnızca kendi cihazınızda çalınır.</p>
</div>

<h2>Belirti ve olası neden tablosu</h2>
<table>
<thead>
<tr><th>Belirti</th><th>Olası neden</th><th>İlk bakılacak yer</th></tr>
</thead>
<tbody>
<tr><td>Hiçbir uygulama sesi almıyor</td><td>Gizlilik izni kapalı, aygıt devre dışı</td><td>Ayarlar &gt; Gizlilik ve güvenlik &gt; Mikrofon</td></tr>
<tr><td>Yanlış mikrofon devrede</td><td>Varsayılan giriş aygıtı farklı seçili</td><td>Ayarlar &gt; Sistem &gt; Ses &gt; Giriş</td></tr>
<tr><td>Ses çok kısık</td><td>Giriş sesi düşük, mikrofon uzak</td><td>Aygıt özelliklerindeki giriş sesi</td></tr>
<tr><td>Kulaklık mikrofonu algılanmıyor</td><td>TRS/TRRS jak uyumsuzluğu</td><td>Bağlantı noktası ve adaptör</td></tr>
<tr><td>Yalnızca tarayıcıda çalışmıyor</td><td>Site izni engellenmiş</td><td>Adres çubuğundaki site ayarları</td></tr>
<tr><td>Yalnızca bir uygulamada çalışmıyor</td><td>Uygulamada başka giriş aygıtı seçili</td><td>Uygulamanın ses ayarları</td></tr>
</tbody>
</table>

<h2>Windows 11 mikrofon çalışmıyor: gizlilik iznini açın</h2>
<p>Windows 11'de mikrofon erişimi merkezi bir gizlilik anahtarıyla yönetilir. Bu anahtar kapalıysa sürücü ve donanım sağlam olsa bile hiçbir uygulama sesinizi duyamaz. Güncellemelerden sonra veya bir güvenlik aracı kullandıysanız bu ayar sessizce kapanmış olabilir.</p>
<ol class="tm-steps">
<li><kbd>Win</kbd> + <kbd>I</kbd> ile Ayarlar'ı açın.</li>
<li><strong>Gizlilik ve güvenlik &gt; Mikrofon</strong> bölümüne gidin.</li>
<li><strong>Mikrofon erişimi</strong> anahtarını açın.</li>
<li><strong>Uygulamaların mikrofonunuza erişmesine izin verin</strong> seçeneğini açın ve listede kullandığınız uygulamanın izinli olduğunu kontrol edin.</li>
<li>Chrome, Discord veya Zoom gibi programlar için en alttaki <strong>Masaüstü uygulamalarının mikrofonunuza erişmesine izin verin</strong> anahtarını da açın.</li>
</ol>
<p>Son madde sıkça gözden kaçar. Mağazadan indirilmeyen klasik programların hepsi bu tek anahtara bağlıdır.</p>

<div class="tm-cta" data-tool="mikrofon-testi"></div>

<h2>Varsayılan giriş aygıtını ve giriş sesini kontrol edin</h2>
<p>Bilgisayarınızda birden fazla mikrofon olabilir: laptopun dahili mikrofonu, kulaklık mikrofonu, web kamerasının mikrofonu ya da bir USB mikrofon. Windows bazen konuşmadığınız aygıtı seçer. <strong>Ayarlar &gt; Sistem &gt; Ses</strong> sayfasında <strong>Giriş</strong> başlığı altındaki listeden kullanmak istediğiniz mikrofonu seçin.</p>
<p>Aygıtın adına tıkladığınızda <strong>Giriş sesi</strong> kaydırıcısını görürsünüz. Bu değer 0 ya da çok düşükse mikrofon "çalışmıyor" gibi görünür. Değeri 70–90 aralığına getirip <strong>Testi başlat</strong> düğmesiyle deneyin. Aynı sayfada aygıtın <strong>İzin verme</strong> ile devre dışı bırakılmadığından da emin olun.</p>
<h3>Özel mod ve ses geliştirmeleri</h3>
<p>Klasik ses ayarlarına <strong>Ayarlar &gt; Sistem &gt; Ses &gt; Diğer ses ayarları</strong> yolundan ulaşabilirsiniz. <strong>Kayıt</strong> sekmesinde mikrofonu seçip <strong>Özellikler &gt; Gelişmiş</strong> bölümüne girin. "Uygulamaların bu cihazın denetimini özel olarak almasına izin ver" seçeneği açıkken bir program mikrofonu kilitleyip diğerlerinin erişimini engelleyebilir. Sorun yaşıyorsanız bu kutuyu kaldırmayı deneyin.</p>

<h2>Sürücüyü güncelleyin veya yeniden yükleyin</h2>
<p>Laptopta mikrofon çalışmıyor ve izinler doğruysa sıradaki şüpheli ses sürücüsüdür. Başlat düğmesine sağ tıklayıp <strong>Aygıt Yöneticisi</strong>'ni açın. <strong>Ses girişleri ve çıkışları</strong> altında mikrofonunuzu bulun; üzerinde sarı ünlem varsa sürücü sorunludur.</p>
<ol class="tm-steps">
<li>Mikrofona sağ tıklayıp <strong>Sürücüyü güncelleştir</strong> seçeneğini deneyin.</li>
<li>Sonuç alamazsanız <strong>Cihazı kaldır</strong> deyin, ardından bilgisayarı yeniden başlatın. Windows aygıtı tekrar tanıyıp sürücüyü yükler.</li>
<li>Yeni laptoplarda dahili mikrofon çoğu zaman "Intel Smart Sound Technology" gibi bir ses denetleyicisine bağlıdır. <strong>Ses, video ve oyun denetleyicileri</strong> ile <strong>Sistem aygıtları</strong> altındaki öğeleri de kontrol edin.</li>
<li>En sağlıklı sürücü genellikle laptop üreticisinin destek sayfasında modelinize özel yayımlanandır.</li>
</ol>
<div class="tm-callout tm-callout--tip">
<p><strong>İpucu:</strong> Bazı laptoplarda üzerinde çarpı işaretli mikrofon simgesi bulunan bir mikrofon kapatma tuşu vardır. Kulaklıklarda da kablo üzerinde sessize alma anahtarı olabilir. Karmaşık adımlara geçmeden bunlara mutlaka bakın.</p>
</div>
<h3>USB ve Bluetooth mikrofonlar</h3>
<p>USB mikrofon kullanıyorsanız kabloyu doğrudan bilgisayarın üzerindeki bir porta takın; güç vermeyen USB çoklayıcılar ve uzun uzatma kabloları bağlantı kopmalarına yol açabilir. Farklı bir port denemek, özellikle ön paneldeki girişlerde sorun yaşanıyorsa çoğu zaman yeterlidir. Aygıt Yöneticisi'nde mikrofon görünüp kayboluyorsa bağlantı kararsızdır.</p>
<p>Bluetooth kulaklıklarda ise mikrofon kullanıldığında Windows, kulaklığı daha düşük kaliteli bir görüşme moduna geçirir. Ses listesinde aynı kulaklığın iki ayrı girişi görünebilir; "Hands-Free" veya benzeri adı taşıyanı giriş aygıtı olarak seçin. Kulaklığı eşleştirmeden kaldırıp yeniden eşleştirmek de çoğu tanıma sorununu çözer.</p>

<h2>Kulaklık mikrofon çalışmıyor: TRS ve TRRS farkı</h2>
<p>Kulaklık mikrofon çalışmıyor sorununun en sık nedeni 3,5 mm jak uyumsuzluğudur. Telefon tipi kulaklıklarda tek bir fiş hem sesi hem mikrofonu taşır. Bu fişin üzerinde üç siyah halka, yani dört temas noktası bulunur ve buna TRRS denir. Yalnızca ses taşıyan fişlerde iki halka vardır; bunlar TRS fişlerdir.</p>
<ul>
<li><strong>Laptoplarda</strong> genellikle tek bir kombo jak bulunur ve TRRS fişi bekler. Buraya iki halkalı bir fiş takarsanız sesi duyarsınız ama mikrofon çalışmaz.</li>
<li><strong>Masaüstü bilgisayarlarda</strong> çoğu zaman ayrı yeşil (kulaklık) ve pembe (mikrofon) girişler vardır. Tek fişli kulaklığı yalnızca yeşil girişe takarsanız mikrofon algılanmaz. Bu durumda bir TRRS'den çift TRS'ye ayırıcı (Y kablo) gerekir.</li>
<li>Kulaklıktaki iki ayrı fişi laptopun kombo jakına bağlamak için ise tersi yönde bir adaptör kullanılır.</li>
</ul>
<p>Eski bazı kulaklıklar farklı bir kablo dizilimi (OMTP) kullanır; günümüzde yaygın olan CTIA düzenine sahip cihazlarda bu kulaklıklarda mikrofon çalışmayabilir veya ses boğuk gelebilir. Fişi tam oturtmak, portu kuru bir fırçayla temizlemek ve kulaklığı başka bir cihazda denemek de hızlı eleme yapmanızı sağlar.</p>

<h2>Tarayıcıda mikrofon izni</h2>
<p>Mikrofon Windows'ta çalışıyor ama bir web sitesinde çalışmıyorsa site izni engellenmiştir. Chrome ve Edge'de adres çubuğunun solundaki site ayarları simgesine tıklayıp <strong>Mikrofon</strong> iznini <strong>İzin ver</strong> olarak değiştirin ve sayfayı yenileyin. Firefox'ta aynı simgeden geçici olarak engellenen izni kaldırabilirsiniz. Tarayıcıların mikrofona yalnızca HTTPS bağlantılı sayfalarda erişim verdiğini de unutmayın.</p>

<h2>Discord, Teams ve Zoom ayarları</h2>
<p>Bilgisayar mikrofon çalışmıyor gibi görünse de sorun bazen yalnızca tek bir uygulamadadır. Her uygulamanın Windows'tan bağımsız bir giriş aygıtı seçimi vardır:</p>
<ul>
<li><strong>Discord:</strong> Kullanıcı Ayarları &gt; Ses ve Görüntü bölümünde Giriş Cihazı'nı seçin. Giriş hassasiyeti çok yüksek ayarlıysa sesiniz kesilir; otomatik hassasiyeti açmayı deneyin.</li>
<li><strong>Microsoft Teams:</strong> Ayarlar &gt; Cihazlar altında mikrofonu seçin ve test araması yapın.</li>
<li><strong>Zoom:</strong> Ayarlar &gt; Ses bölümünde mikrofonu seçin, "Mikrofonu test et" ile deneyin. Toplantıda kendinizi sessize almadığınızı da kontrol edin.</li>
</ul>
<p>Aynı anda birden fazla görüşme uygulaması açıksa birini kapatın; bazı aygıtlar paylaşım sırasında takılabilir.</p>

<h2>Telefon ve macOS için notlar</h2>
<p>Telefonda mikrofon sorunlarının çoğu toz dolmuş mikrofon deliklerinden, kılıfların delikleri kapatmasından veya uygulama izinlerinden kaynaklanır. iPhone'da <strong>Ayarlar &gt; Gizlilik ve Güvenlik &gt; Mikrofon</strong>, Android'de ise Ayarlar'daki uygulama izinleri bölümünden ilgili uygulamaya izin verin. Telefon mikrofonunu da tarayıcı üzerinden aynı testle deneyebilirsiniz.</p>
<p>Mac'te önce <strong>Sistem Ayarları &gt; Gizlilik ve Güvenlik &gt; Mikrofon</strong> bölümünde uygulamanın izinli olduğuna bakın. Ardından <strong>Sistem Ayarları &gt; Ses &gt; Giriş</strong> sekmesinde doğru aygıtı seçip giriş düzeyini artırın. İzni yeni verdiğiniz uygulamayı kapatıp yeniden açmanız gerekebilir.</p>

<h2>Hâlâ çözülmediyse</h2>
<p>Tüm adımlara rağmen mikrofon hiçbir cihazda ses almıyorsa arıza donanımsal olabilir. Harici bir USB mikrofon veya başka bir kulaklıkla deneme yapın; o çalışıyorsa sorun dahili mikrofondadır ve servis gerekir. Görüşmelerde karşı tarafı duyamıyorsanız <a href="{tool:hoparlor-testi}">hoparlör testi</a> ile çıkış tarafını, görüntü sorunu yaşıyorsanız <a href="{tool:kamera-testi}">web kamera testi</a> ile kamerayı kontrol edin.</p>
<p>Kamera tarafında sorun varsa <a href="{post:laptop-kamera-calismiyor}">laptop kamera çalışmıyor</a> rehberimize, klavyede sorun yaşıyorsanız <a href="{post:laptop-klavye-calismiyor}">laptop klavye çalışmıyor</a> yazımıza göz atın. Kullanılmış bir bilgisayar almadan önce mikrofonu da kapsayan <a href="{post:ikinci-el-laptop-kontrol}">ikinci el laptop kontrol listesini</a> uygulayabilir, düzeltmelerden sonra <a href="{tool:mikrofon-testi}">mikrofon test</a> aracıyla sonucu doğrulayabilirsiniz.</p>
HTML
	,
	'faqs'        => array(
		array( 'q' => 'Windows 11 güncellemesinden sonra mikrofonum neden çalışmıyor?', 'a' => 'Güncellemeler bazen mikrofon gizlilik iznini sıfırlar veya sürücüyü değiştirir. Önce Ayarlar > Gizlilik ve güvenlik > Mikrofon bölümündeki anahtarları kontrol edin. Sorun sürerse Aygıt Yöneticisi üzerinden sürücüyü kaldırıp bilgisayarı yeniden başlatın.' ),
		array( 'q' => 'Kulaklığımdan ses geliyor ama mikrofonu çalışmıyor, neden?', 'a' => 'En sık neden jak uyumsuzluğudur. Tek fişli kulaklık masaüstündeki yeşil girişe takıldığında yalnızca ses iletilir. Ayırıcı bir Y kablo kullanın veya kulaklığı kombo jaklı bir laptopta deneyin.' ),
		array( 'q' => 'Mikrofon testinde ses görünüyor ama Discord beni duymuyor, ne yapmalıyım?', 'a' => 'Bu durumda donanım sağlamdır, sorun Discord ayarlarındadır. Ses ve Görüntü bölümünde doğru giriş cihazını seçin ve giriş hassasiyetini kontrol edin. Discord için masaüstü uygulamalarının mikrofon izninin açık olduğundan da emin olun.' ),
		array( 'q' => 'Laptop mikrofonum çok kısık, nasıl yükseltirim?', 'a' => 'Ayarlar > Sistem > Ses bölümünde mikrofonunuza tıklayıp Giriş sesi değerini artırın. Mikrofon deliklerinin kapalı olmadığından ve laptopa çok uzak oturmadığınızdan emin olun. Ses hâlâ kısıksa harici bir kulaklık mikrofonu daha net sonuç verir.' ),
		array( 'q' => 'Mikrofon testi sırasında sesim kaydediliyor mu?', 'a' => 'Hayır. Test tamamen tarayıcınızda çalışır ve ses hiçbir sunucuya gönderilmez. Kısa kayıt yalnızca cihazınızda oynatılır ve sayfayı kapattığınızda silinir.' ),
		array( 'q' => 'Mikrofonun bozuk olduğunu nasıl anlarım?', 'a' => 'İzinleri, giriş aygıtını ve sürücüyü kontrol ettiğiniz hâlde mikrofon farklı uygulamalarda ve tarayıcıda hiç ses almıyorsa arıza olasılığı yüksektir. Aynı mikrofonu başka bir cihazda deneyin. Orada da çalışmıyorsa sorun donanımdadır.' ),
	),
);
