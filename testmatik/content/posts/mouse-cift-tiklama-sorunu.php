<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'Mouse Çift Tıklama Sorunu: Nedenleri ve Çözümü',
	'seo_title'   => 'Mouse Çift Tıklama Sorunu: Nedenleri ve Çözümü | Testmatik',
	'description' => 'Mouse çift tıklama sorunu mu yaşıyorsunuz? Yıpranmış switch, Windows çift tıklatma hızı ve kablosuz parazit gibi nedenleri test edin, doğru çözümü bulun.',
	'keywords'    => array( 'mouse çift tıklama sorunu', 'mouse kendi kendine çift tıklıyor', 'mouse çift tıklama yapıyor', 'double click sorunu', 'mouse tıklama sorunu çözümü' ),
	'intro'       => 'Tek tıkladığınızda klasörler iki kez açılıyor ya da sürüklediğiniz dosya yolda düşüyorsa mouse çift tıklama sorunu yaşıyorsunuz demektir. Nedenini bulmak birkaç dakika sürer.',
	'excerpt'     => 'Mouse kendi kendine çift tıklıyorsa nedeni yıpranmış switch, Windows ayarı veya kablosuz parazit olabilir. Nasıl tespit edeceğinizi ve çözümleri anlatıyoruz.',
	'category'    => 'Mouse',
	'tool'        => 'mouse-testi',
	'html'        => <<<'HTML'
<h2>Mouse çift tıklama sorunu nedir?</h2>
<p>Mouse çift tıklama sorunu, tuşa bir kez bastığınız hâlde bilgisayarın iki tıklama algılamasıdır. İngilizcede "double click" veya "chatter" olarak da bilinir. Belirtiler genellikle şöyledir: tek tıkla seçmek istediğiniz dosya açılır, web sayfasında bir bağlantı iki sekmede açılır, oyunlarda tek atış yerine iki atış yapılır ya da bir dosyayı sürüklerken mouse tuşu kendiliğinden bırakılmış gibi davranır.</p>
<p>Sorun başta ara sıra ortaya çıkar, sonra sıklaşır. Bu yüzden erkenden teşhis etmek önemlidir. İyi haber şu ki her çift tıklama sorunu bozuk mouse anlamına gelmez; bazen tek bir Windows ayarı veya zayıf bir pil bile aynı belirtiyi üretir.</p>

<h2>Olası nedenler</h2>
<table>
<thead>
<tr><th>Neden</th><th>Tipik belirti</th><th>Çözüm yönü</th></tr>
</thead>
<tbody>
<tr><td>Yıpranmış mikro switch</td><td>Tek tuşta, zamanla artan çift tıklama</td><td>Garanti, değişim veya switch onarımı</td></tr>
<tr><td>Switch kontak sıçraması (chatter)</td><td>Çok kısa aralıklı ikinci tıklama</td><td>Yazılımsal debounce, switch değişimi</td></tr>
<tr><td>Windows çift tıklatma hızı</td><td>Yavaş ardışık tıklamalar çift tıklama sayılıyor</td><td>Ayarı orta seviyeye çekmek</td></tr>
<tr><td>Statik elektrik veya kirli kontak</td><td>Ani başlayan, düzensiz sorun</td><td>Temizlik, güç kesme</td></tr>
<tr><td>Kablosuz parazit veya zayıf pil</td><td>Takılma, kopma, rastgele tıklama</td><td>Pil değişimi, alıcıyı yaklaştırmak</td></tr>
</tbody>
</table>
<h3>Yıpranmış mikro switch</h3>
<p>Mouse tuşlarının altında küçük mekanik anahtarlar, yani mikro switch'ler bulunur. Her basışta içindeki metal yaprak bir kontağa değer. Milyonlarca tıklamanın ardından bu yaprak esnekliğini kaybedebilir veya kontak yüzeyi oksitlenebilir. Sonuçta tek bir basış sırasında kontak birkaç kez açılıp kapanır ve bilgisayar bunu iki ayrı tıklama olarak okur. Sorunun en yaygın nedeni budur ve genellikle en çok kullanılan sol tuşta başlar.</p>
<h3>Kontak sıçraması (chatter)</h3>
<p>Her mekanik switch basıldığında kısa bir süre "sıçrar". Mouse'un içindeki yazılım bu sıçramayı birkaç milisaniyelik bir bekleme süresiyle filtreler; buna debounce denir. Switch yıprandığında sıçrama bu süreden uzun sürer ve filtre onu yakalayamaz. Bazı oyuncu farelerinde tepki süresini kısaltmak için debounce süresi çok düşük tutulur, bu da yeni bir farede bile ara sıra çift tıklamaya yol açabilir.</p>
<h3>Windows çift tıklatma hızı</h3>
<p>Windows, iki tıklamanın çift tıklama sayılması için aralarında ne kadar süre geçebileceğini bir ayarla belirler. Bu ayar çok yavaş seviyedeyse hızlı ardışık iki tek tıklamanız çift tıklama gibi algılanır. Bu durumda donanım sağlamdır; yalnızca ayar yanlıştır.</p>
<h3>Statik elektrik ve kirli kontaklar</h3>
<p>Tuşun etrafına giren toz, yiyecek kırıntısı veya dökülen sıvı kalıntısı mekanizmayı etkileyebilir. Bazı kullanıcılar statik elektrik birikmesinin de geçici sorunlara yol açtığını bildirir. Bu tür sorunlar genellikle aniden başlar ve temizlikten sonra azalır.</p>
<h3>Kablosuz parazit ve pil</h3>
<p>Kablosuz farelerde pil zayıfladığında sinyal kararsızlaşır; imleç takılır ve tıklamalar düzensiz algılanabilir. USB alıcısının metal yüzeylerin arkasında kalması, bilgisayardan uzakta olması veya USB 3.0 portlarının yanına takılması da 2,4 GHz bağlantıyı bozabilir.</p>

<div class="tm-cta" data-tool="mouse-testi"></div>

<h2>Çift tıklama dedektörüyle sorunu tespit edin</h2>
<p>Hissettiğiniz sorunu ölçülebilir hâle getirmek için <a href="{tool:mouse-testi}">çift tıklama testi</a> aracını kullanabilirsiniz. Testteki çift tıklama (chatter) dedektörü, aynı tuşa ait iki tıklama belirlenen eşikten daha kısa aralıkla gelirse bunu işaretler. Varsayılan eşik 80 milisaniyedir. Bir insanın bilerek bu kadar kısa aralıkla iki kez tıklaması zordur; bu yüzden işaretlenen tıklamalar yıpranmış switch için güçlü bir işarettir.</p>
<ol class="tm-steps">
<li>Testi açın ve fareyi test alanının üzerine getirin.</li>
<li>Şüphelendiğiniz tuşa, normal hızda ve her seferinde tek bir kez olacak şekilde 50–100 kez basın.</li>
<li>Tıklama sayacının bastığınız sayıyla uyuşup uyuşmadığına bakın.</li>
<li>Dedektörün çift tıklama uyarısı verip vermediğini kontrol edin.</li>
<li>Aynı denemeyi sağ, orta, geri ve ileri tuşlarla da tekrarlayın.</li>
</ol>
<p>Tuşu yavaşça, yarı basılı tutarak denemek de sorunu ortaya çıkarabilir; yıpranmış switch'ler en çok bu ara konumda sıçrar. Sayaç bastığınızdan fazlasını gösteriyorsa sorun büyük olasılıkla donanımsaldır. Hiç uyarı yoksa ama Windows'ta hâlâ çift tıklama yaşıyorsanız ayarlara ve yazılıma bakmanız gerekir.</p>
<div class="tm-callout tm-callout--info">
<p><strong>Bilgi:</strong> Test tamamen tarayıcınızda çalışır; tıklama ve hareket verileri hiçbir sunucuya gönderilmez. Test alanında sağ tık menüsü engellenir, böylece sağ tuşu da rahatça deneyebilirsiniz.</p>
</div>

<h2>Windows ayarlarını kontrol edin</h2>
<p>Donanım sağlam görünüyorsa önce Windows tarafını düzeltin:</p>
<ol class="tm-steps">
<li><strong>Ayarlar &gt; Bluetooth ve cihazlar &gt; Fare</strong> sayfasını açın.</li>
<li><strong>Ek fare ayarları</strong> bağlantısına tıklayın; Fare Özellikleri penceresi açılır.</li>
<li><strong>Düğmeler</strong> sekmesindeki <strong>Çift tıklatma hızı</strong> kaydırıcısını orta seviyeye getirin ve yanındaki klasör simgesiyle deneyin.</li>
<li>Aynı sekmedeki <strong>Tıklatma Kilidi</strong> seçeneğinin kapalı olduğundan emin olun. Açıksa tuşu kısa süre basılı tuttuğunuzda tuş kilitli kalır ve sürükleme davranışı bozulur.</li>
</ol>
<p>Dosya Gezgini'nde öğeler tek tıkla açılıyorsa bu bir arıza değil, klasör ayarıdır. Dosya Gezgini'nde <strong>Seçenekler</strong> penceresini açın ve <strong>Genel</strong> sekmesinde "Bir öğeyi açmak için çift tıklat" seçeneğini işaretleyin.</p>

<h2>Yazılımsal debounce seçenekleri</h2>
<p>Pek çok oyuncu faresinin üretici yazılımında "debounce süresi" veya "tıklama gecikmesi" gibi adlarla bir ayar bulunur. Bu değeri birkaç milisaniye artırmak, hafif yıpranmış bir switch'in sıçramalarını filtreleyebilir. Karşılığında tıklama tepkisi çok az gecikir; günlük kullanımda bu fark hissedilmez. Bazı modellerde üretici, bu sorunu gidermek için güncel bir firmware de yayımlayabilir.</p>
<p>Üretici yazılımı olmayan farelerde, aynı tuştan çok kısa aralıkla gelen ikinci tıklamayı yok sayan üçüncü taraf yardımcı programlar da vardır. Bu araçlar geçici bir çözümdür: switch yıprandıkça sorun büyür ve filtre yetersiz kalır. Ayrıca yalnızca güvendiğiniz kaynaklardan program indirmeye dikkat edin.</p>

<h2>Temizlik ve basit denemeler</h2>
<ul>
<li>Kablolu fareyi çıkarın, kablosuz farenin pilini veya bataryasını kapatın ve birkaç dakika bekleyin.</li>
<li>Tuşların kenarlarını basınçlı hava ile temizleyin. Sıvı dökülmüşse hafif nemli bir bezle silin; fareyi asla suya batırmayın.</li>
<li>Kablosuz farede pili yenileyin ve USB alıcısını fareye yakın bir porta, gerekiyorsa bir uzatma kablosuyla takın.</li>
<li>Fareyi başka bir bilgisayarda deneyin. Sorun orada da varsa kaynak faredir.</li>
</ul>

<h2>Kablosuz farelerde ek kontroller</h2>
<p>Kablosuz bir farede çift tıklamanın yanında imleç takılması veya kısa kopmalar da yaşıyorsanız sorun switch'ten çok bağlantıda olabilir. Test aracındaki polling rate (Hz) tahmini burada işe yarar: fareyi düzenli hareket ettirirken değer sürekli ve sert biçimde düşüp yükseliyorsa sinyal kararsızdır. Bu belirti genellikle zayıf pil, uzak alıcı veya parazitle ilişkilidir.</p>
<p>Bluetooth farelerde fareyi Windows'ta <strong>Ayarlar &gt; Bluetooth ve cihazlar</strong> bölümünden kaldırıp yeniden eşleştirmek bağlantı sorunlarının çoğunu giderir. Kablosuz kulaklık, hoparlör ve Wi-Fi modem gibi cihazların fareye ve alıcıya çok yakın olmamasına da dikkat edin. Bağlantıyı düzelttikten sonra dedektör hâlâ çift tıklama gösteriyorsa sorun gerçekten switch'tedir.</p>

<h2>Switch değiştirmek mantıklı mı?</h2>
<p>Mikro switch'i değiştirmek teknik olarak mümkündür ve pek çok fareyi yeniden kullanılabilir hâle getirir. Ancak işlem fareyi açmayı, eski switch'in lehimini sökmeyi ve yenisini lehimlemeyi gerektirir. Lehim deneyiminiz yoksa devre kartına zarar verme riski yüksektir. Yeni switch'in bacak yapısı ve boyutu da eskisiyle uyumlu olmalıdır.</p>
<div class="tm-callout tm-callout--warn">
<p><strong>Uyarı:</strong> Fareyi açmak çoğu zaman garantiyi geçersiz kılar. Vidalar genellikle kaydırma pedlerinin veya etiketlerin altında gizlidir ve bu parçalar söküldükten sonra eskisi gibi yapışmayabilir.</p>
</div>

<h2>Garanti kapsamında değişim</h2>
<p>Fareniz hâlâ garanti süresindeyse kendiniz müdahale etmeden önce satıcıya veya üreticiye başvurun. Türkiye'de tüketicilere satılan ürünlerde yasal garanti süresi en az iki yıldır. Test aracında aldığınız çift tıklama uyarısının ekran görüntüsünü ve sorunu gösteren kısa bir video kaydını başvurunuza eklemek, arızayı açıkça anlatmanıza yardımcı olur.</p>
<p>Fatura veya sipariş kaydınızı saklamayı unutmayın. Bazı üreticiler yasal sürenin üzerinde kendi garanti sürelerini de sunar; ürün kutusunu, kullanım kılavuzunu veya üreticinin destek sayfasını kontrol ederek farenizin hangi kapsama girdiğini öğrenebilirsiniz.</p>

<h2>İlgili testler ve rehberler</h2>
<p>Fare sorunu genellikle tek başına gelmez; bir laptopu veya masaüstü seti kontrol ediyorsanız <a href="{tool:klavye-testi}">klavye testi</a> ile tüm tuşları, <a href="{tool:olu-piksel-testi}">ölü piksel testi</a> ile ekranı da kontrol edin. Touchpad ve klavye sorunları için <a href="{post:laptop-klavye-calismiyor}">laptop klavye çalışmıyor</a> rehberimize, kullanılmış bir cihaz alacaksanız <a href="{post:ikinci-el-laptop-kontrol}">ikinci el laptop kontrol listesine</a> bakabilirsiniz. Ghosting gibi klavyeye özgü konular için de <a href="{post:klavye-ghosting-nedir}">klavye ghosting nedir</a> yazımızı okuyabilirsiniz.</p>
<p>Çözüm sonrasında <a href="{tool:mouse-testi}">mouse test</a> aracındaki dedektörle tuşları yeniden deneyin; birkaç yüz tıklamada hiç uyarı çıkmıyorsa sorun giderilmiş demektir.</p>
HTML
	,
	'faqs'        => array(
		array( 'q' => 'Mouse neden kendi kendine çift tıklıyor?', 'a' => 'En yaygın neden, tuşun altındaki mikro switch\'in yıpranmasıdır. Yıpranan switch tek basışta birkaç kez temas eder ve bilgisayar bunu iki tıklama olarak algılar. Windows çift tıklatma hızı ayarı veya kablosuz farelerde zayıf pil de benzer belirtilere yol açabilir.' ),
		array( 'q' => 'Mouse çift tıklama sorunu kendiliğinden geçer mi?', 'a' => 'Kir veya pil kaynaklı sorunlar temizlik ya da pil değişimiyle geçebilir. Switch yıpranmasından kaynaklanan sorun ise genellikle zamanla artar. Yazılımsal debounce belirtiyi bir süre azaltabilir ama kalıcı çözüm switch veya fare değişimidir.' ),
		array( 'q' => 'Çift tıklama dedektörü neden 80 ms eşik kullanıyor?', 'a' => 'İnsanın aynı tuşa bilerek 80 milisaniyeden kısa aralıkla iki kez basması oldukça zordur. Bu yüzden bu sürenin altındaki ikinci tıklamalar büyük olasılıkla switch sıçramasından kaynaklanır. Eşik, sorunu gerçek tıklamalarla karıştırmadan yakalamak için makul bir başlangıç noktasıdır.' ),
		array( 'q' => 'Yeni aldığım oyuncu faresi de çift tıklıyor, normal mi?', 'a' => 'Yeni bir farede bu beklenen bir durum değildir. Önce üretici yazılımında debounce ayarı olup olmadığına bakın ve firmware güncellemesini kontrol edin. Sorun sürerse ürünü garanti kapsamında satıcıya iade edin veya değiştirin.' ),
		array( 'q' => 'Mouse switch\'ini kendim değiştirebilir miyim?', 'a' => 'Lehim deneyiminiz varsa mümkündür, ancak fareyi açmak çoğu zaman garantiyi geçersiz kılar. Uyumlu bir switch seçmeniz ve devre kartına zarar vermemeniz gerekir. Garantisi devam eden bir farede önce satıcıya başvurmak daha doğrudur.' ),
		array( 'q' => 'Mouse testi verilerimi kaydediyor mu?', 'a' => 'Hayır. Test tamamen tarayıcınızda çalışır ve tıklamalarınız veya fare hareketleriniz hiçbir sunucuya gönderilmez. Sayfayı kapattığınızda tüm sayaçlar sıfırlanır.' ),
	),
);
