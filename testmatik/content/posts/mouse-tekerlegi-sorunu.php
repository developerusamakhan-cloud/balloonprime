<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'Mouse Tekerleği Zıplıyor: Aşağı Yukarı Sorunu ve Çözümü',
	'seo_title'   => 'Mouse Tekerleği Aşağı Yukarı Sorunu ve Çözümü | Testmatik',
	'description' => 'Mouse tekerleği aşağı yukarı sorunu mu var? Scroll zıplamasının nedenlerini test edin; temizlik, Windows ayarları ve encoder çözümlerini adım adım uygulayın.',
	'keywords'    => array( 'mouse tekerleği aşağı yukarı sorunu', 'mouse tekerleği düzgün çalışmıyor', 'mouse tekerleği çalışmıyor', 'scroll zıplama', 'mouse tekerleği temizleme' ),
	'intro'       => 'Sayfayı aşağı kaydırırken ekran bir anda yukarı mı zıplıyor? Mouse tekerleği aşağı yukarı sorunu çoğu zaman kir veya yıpranmış bir parçadan kaynaklanır ve nedenini birkaç dakikada bulabilirsiniz.',
	'excerpt'     => 'Mouse tekerleği ters yöne zıplıyor veya hiç kaydırmıyorsa nedeni kir, Windows ayarı ya da yıpranmış encoder olabilir. Test yöntemini ve çözümleri anlatıyoruz.',
	'category'    => 'Mouse',
	'tool'        => 'mouse-testi',
	'date'        => '2026-10-27 06:00:00',
	'html'        => <<<'HTML'
<h2>Mouse tekerleği aşağı yukarı sorunu nedir?</h2>
<p>Bu sorunda tekerleği tek bir yöne çevirmenize rağmen sayfa kısa bir an ters yöne hareket eder. Uzun bir web sayfasını aşağı kaydırırken ekranın bir iki satır yukarı sıçraması, Excel'de satırların ileri geri titremesi veya oyunda silah değiştirirken yanlış silaha geçilmesi tipik belirtilerdir. Halk arasında "scroll zıplama" olarak da bilinir.</p>
<p>Aynı aileden başka belirtiler de vardır: tekerlek bazı adımları hiç algılamaz, kaydırma çok yavaş veya çok hızlı gelir ya da tekerlek tamamen tepkisiz kalır. Bunların bir kısmı donanımsal, bir kısmı ise yalnızca ayarlarla ilgilidir. Doğru çözümü bulmak için önce sorunun hangisi olduğunu ayırt etmek gerekir.</p>

<h2>Mouse tekerleği nasıl çalışır?</h2>
<p>Çoğu farede tekerleğin ekseni, encoder adı verilen küçük bir parçaya bağlıdır. Mekanik encoder'larda tekerlek döndükçe içerideki metal kontaklar belirli bir sırayla açılıp kapanır. Fare bu sıraya bakarak hem kaç adım döndüğünüzü hem de dönüş yönünü hesaplar. Bazı modellerde ise ışık ve sensörle çalışan optik encoder kullanılır.</p>
<p>Mekanik encoder'ın kontakları kirlendiğinde veya aşındığında sinyal sırası bozulur. Fare bu bozuk sinyali kimi zaman ters yönde bir adım olarak yorumlar. Aşağı yukarı sorununun en yaygın nedeni budur. Tekerleğin her adımda hissettirdiği tık tık yapısı da genellikle aynı mekanizmanın parçasıdır.</p>

<h2>Olası nedenler</h2>
<table>
<thead>
<tr><th>Neden</th><th>Tipik belirti</th><th>Çözüm yönü</th></tr>
</thead>
<tbody>
<tr><td>Encoder içinde toz ve kir</td><td>Ara sıra ters yöne zıplama</td><td>Basınçlı hava ile temizlik</td></tr>
<tr><td>Aşınmış encoder</td><td>Zamanla artan, sürekli zıplama</td><td>Encoder değişimi, garanti</td></tr>
<tr><td>Tekerlekte saç veya tüy birikmesi</td><td>Tekerlek ağır dönüyor, adımlar kaçıyor</td><td>Tekerlek çevresini temizlemek</td></tr>
<tr><td>Windows kaydırma ayarı</td><td>Kaydırma çok yavaş veya çok hızlı</td><td>Satır sayısını ayarlamak</td></tr>
<tr><td>Kablosuz bağlantı sorunu</td><td>Kaydırma takılıyor, gecikiyor</td><td>Pil değişimi, alıcıyı yaklaştırmak</td></tr>
<tr><td>Üretici yazılımı veya sürücü</td><td>Tekerlek tuşu farklı işlev görüyor</td><td>Yazılım ayarını sıfırlamak</td></tr>
</tbody>
</table>

<div class="tm-cta" data-tool="mouse-testi"></div>

<h2>Sorunu mouse testiyle doğrulayın</h2>
<p>Hissettiğiniz zıplamayı sayılarla görmek, çözümün işe yarayıp yaramadığını anlamanın da en kolay yoludur. <a href="{tool:mouse-testi}">Mouse testi</a> aracı yukarı ve aşağı kaydırmaları ayrı sayaçlarla sayar, tekerlek tuşuna (orta tuş) yapılan tıklamaları da ayrıca gösterir.</p>
<ol class="tm-steps">
<li>Testi açın ve fareyi test alanının üzerine getirin.</li>
<li>Tekerleği yalnızca aşağı doğru, yavaş ve düzenli şekilde 20–30 adım çevirin.</li>
<li>Yukarı kaydırma sayacına bakın. Sağlam bir tekerlekte bu sayaç hiç artmamalıdır.</li>
<li>Aynı denemeyi yalnızca yukarı yönde yapın ve bu kez aşağı sayacını kontrol edin.</li>
<li>Denemeyi bir de hızlı çevirerek tekrarlayın; bazı aşınmış encoder'lar yalnızca hızlı dönüşte hata verir.</li>
<li>Tekerleğe birkaç kez basarak orta tuş sayacının her basışta bir arttığını doğrulayın.</li>
</ol>
<p>Tek yöne çevirdiğiniz hâlde ters yön sayacı artıyorsa sorun donanımsaldır ve büyük olasılıkla encoder'dan kaynaklanır. Sayaçlar doğru ama Windows'ta kaydırma hâlâ garipse ayarlara ve yazılıma odaklanın.</p>
<div class="tm-callout tm-callout--info">
<p><strong>Bilgi:</strong> Test tamamen tarayıcınızda çalışır; fare hareketleriniz ve tıklamalarınız hiçbir sunucuya gönderilmez. Tıklama tuşlarında da şüpheniz varsa aynı sayfadaki çift tıklama dedektörünü kullanabilirsiniz.</p>
</div>

<h2>Mouse tekerleği temizleme</h2>
<p>Encoder kirliliği çoğu zaman fareyi açmadan giderilebilir. Temizliğe başlamadan önce kablolu fareyi bilgisayardan çıkarın, kablosuz fareyi kapatın veya pilini çıkarın.</p>
<ol class="tm-steps">
<li>Tekerleğin çevresindeki boşluğa basınçlı hava püskürtün. Kutuyu dik tutun ve kısa aralıklarla sıkın.</li>
<li>Püskürtme sırasında tekerleği iki yöne de sürekli çevirin; böylece hava encoder'ın farklı noktalarına ulaşır.</li>
<li>Tekerlek çevresinde saç veya tüy görüyorsanız bir kürdan veya cımbızla dikkatlice çekin.</li>
<li>Tekerleğin lastik yüzeyini hafif nemli bir bezle silin ve tamamen kurumasını bekleyin.</li>
<li>Fareyi yeniden bağlayıp testi tekrarlayın.</li>
</ol>
<p>Birçok kullanıcı tekerleği hızlıca ve art arda iki yöne çevirmenin de kontaklardaki kiri bir süreliğine dağıttığını fark eder. Bu yöntem kalıcı bir çözüm değildir, ancak sorunun kirle ilgili olup olmadığını anlamanıza yardımcı olur.</p>
<div class="tm-callout tm-callout--warn">
<p><strong>Uyarı:</strong> Fareyi asla suya batırmayın ve tekerlek boşluğuna doğrudan sıvı dökmeyin. Elektronik kart ve encoder sıvıdan kolayca zarar görür.</p>
</div>

<h2>Windows kaydırma ayarlarını kontrol edin</h2>
<p>Tekerlek testte doğru çalışıyorsa sorun bir ayardan kaynaklanıyor olabilir. Windows 11'de şu adımları izleyin:</p>
<ol class="tm-steps">
<li><strong>Ayarlar &gt; Bluetooth ve cihazlar &gt; Fare</strong> sayfasını açın.</li>
<li><strong>Fare tekerleğini kaydırma miktarı</strong> seçeneğinin "Birden çok satır" olarak ayarlı olduğundan emin olun.</li>
<li><strong>Her seferinde kaydırılacak satır sayısı</strong> kaydırıcısıyla hızı ayarlayın. Varsayılan değer 3 satırdır.</li>
<li><strong>Üzerine geldiğimde etkin olmayan pencereleri kaydır</strong> seçeneğini açık tutun; kapalıysa fare başka bir pencerenin üzerindeyken kaydırma çalışmaz gibi görünür.</li>
</ol>
<p>Farenizin üretici yazılımı yüklüyse orada da kaydırma hızı, kaydırma yönü veya tekerlek tuşuna atanmış farklı bir işlev olabilir. Bir ayarın Windows ayarını geçersiz kıldığından şüpheleniyorsanız yazılımda varsayılan profile dönün.</p>
<h3>Yalnızca tek bir uygulamada mı?</h3>
<p>Sorun yalnızca bir tarayıcıda veya bir programda görülüyorsa farenizden çok o uygulamanın kaydırma davranışı etkilidir. Bazı tarayıcılarda yumuşak kaydırma özelliği hareketi farklı hissettirebilir. Aynı sayfayı başka bir tarayıcıda deneyerek karşılaştırın.</p>

<h2>Tekerleğin diğer işlevleri</h2>
<p>Birçok farede tekerlek yalnızca kaydırma yapmaz. Tekerleğe basmak orta tıklama anlamına gelir; tarayıcılarda bağlantıyı yeni sekmede açar veya sekmeyi kapatır. Bazı modellerde tekerlek sola ve sağa yatırılarak yatay kaydırma yapılır. Bu yan hareketler de zamanla aşınabilir ve istemeden yatay kaydırmaya yol açabilir.</p>
<p>Orta tuş basışlarının sayaçta ikişer ikişer arttığını görüyorsanız tekerleğin altındaki switch de yıpranmış olabilir. Bu durum, sol ve sağ tuşlardaki çift tıklama sorununun aynısıdır ve benzer şekilde ele alınır. Bazı farelerde tekerleğe basmak, serbest dönüş ile adımlı dönüş arasında geçiş yapar; bu modelde tekerlek beklenmedik şekilde kendi kendine dönüyorsa modu kontrol edin.</p>
<h3>Laptop touchpad ile karşılaştırın</h3>
<p>Laptop kullanıyorsanız aynı sayfada touchpad üzerinde iki parmakla kaydırmayı da deneyin. Touchpad ile kaydırma sorunsuz, fare ile sorunluysa sorun kesinlikle faredir. Her iki yöntemde de aynı tuhaflık varsa bir yazılım, sürücü veya uygulama ayarı etkili olabilir.</p>

<h2>Kablosuz farelerde ek kontroller</h2>
<p>Kablosuz farelerde kaydırmanın takılması veya gecikmesi her zaman encoder'dan kaynaklanmaz. Zayıf pil, bilgisayardan uzak duran USB alıcısı veya metal bir kasanın arkasında kalan alıcı bağlantıyı kararsız hâle getirir. Pili yenileyin ve alıcıyı fareye yakın bir porta takın. Bluetooth farelerde fareyi <strong>Ayarlar &gt; Bluetooth ve cihazlar</strong> bölümünden kaldırıp yeniden eşleştirmek de çoğu bağlantı sorununu giderir.</p>
<p>Mouse testindeki polling rate (Hz) tahmini burada da işinize yarar: fareyi düzenli hareket ettirirken değer sürekli sert biçimde düşüp yükseliyorsa sinyal kararsızdır.</p>

<h2>Encoder değişimi ve garanti</h2>
<p>Encoder aşınması özellikle uzun süre yoğun kullanılan farelerde görülür. Oyunlarda tekerleği silah değiştirmek için sık kullanıyorsanız veya gün boyu uzun belgeler ve tablolar arasında kaydırma yapıyorsanız bu parça diğerlerinden daha çabuk yıpranabilir. Sorun önce ara sıra ortaya çıkar, sonra sıklaşır; bu yüzden erken fark etmek, garanti süresi dolmadan başvurmanızı sağlar.</p>
<p>Temizlik ve ayarlar sorunu çözmüyorsa encoder büyük olasılıkla aşınmıştır. Encoder değiştirmek teknik olarak mümkündür, ancak fareyi açmayı ve parçayı devre kartından lehimle sökmeyi gerektirir. Yeni parçanın boyutu ve eksen yüksekliği eskisiyle uyumlu olmalıdır; aksi hâlde tekerlek ya oturmaz ya da adımları doğru algılamaz.</p>
<p>Fareniz garanti süresindeyse kendiniz müdahale etmeden önce satıcıya veya üreticiye başvurun. Türkiye'de tüketicilere satılan ürünlerde yasal garanti süresi en az iki yıldır. Test aracında ters yön sayacının arttığını gösteren bir ekran görüntüsü, arızayı açıkça anlatmanıza yardımcı olur. Fareyi açmanın çoğu zaman garantiyi geçersiz kıldığını unutmayın.</p>

<h2>İlgili testler ve rehberler</h2>
<p>Fare tuşlarınız tek tıklamada iki kez basıyorsa <a href="{post:mouse-cift-tiklama-sorunu}">mouse çift tıklama sorunu</a> rehberimize bakın. Oyuncuysanız <a href="{post:mouse-polling-rate-nedir}">mouse polling rate nedir</a> yazımız 125, 500 ve 1000 Hz farkını anlatıyor. Bir laptopu baştan sona kontrol ediyorsanız <a href="{tool:klavye-testi}">klavye testi</a> ile tuşları, <a href="{tool:olu-piksel-testi}">ölü piksel testi</a> ile ekranı da gözden geçirin; touchpad ve klavye sorunları için <a href="{post:laptop-klavye-calismiyor}">laptop klavye çalışmıyor</a> rehberimiz, kullanılmış cihazlar için <a href="{post:ikinci-el-laptop-kontrol}">ikinci el laptop kontrol listesi</a> işinize yarayacaktır.</p>
<p>Temizlik veya ayar değişikliğinden sonra <a href="{tool:mouse-testi}">scroll testi</a> sayaçlarıyla tekerleği yeniden deneyin; birkaç yüz adımda ters yön sayacı hiç artmıyorsa sorun giderilmiş demektir.</p>
HTML
	,
	'faqs'        => array(
		array( 'q' => 'Mouse tekerleği neden aşağı kaydırırken yukarı zıplıyor?', 'a' => 'En yaygın neden, tekerleğin bağlı olduğu encoder parçasının kirlenmesi veya aşınmasıdır. Bozulan kontaklar fareye yanlış sinyal gönderir ve fare bunu ters yönde bir adım olarak algılar. Basınçlı hava ile temizlik çoğu zaman sorunu azaltır.' ),
		array( 'q' => 'Mouse tekerleği sorununu nasıl test ederim?', 'a' => 'Bir mouse testi açın ve tekerleği yalnızca tek yöne 20 ila 30 adım çevirin. Ters yön sayacı artıyorsa sorun donanımsaldır. Sayaçlar doğruysa Windows kaydırma ayarlarını ve farenin yazılımını kontrol edin.' ),
		array( 'q' => 'Mouse tekerleği temizliği için fareyi açmam gerekir mi?', 'a' => 'Çoğu durumda hayır. Fareyi kapatıp tekerlek çevresine basınçlı hava püskürtürken tekerleği iki yöne çevirmek genellikle yeterlidir. Fareyi açmak çoğu zaman garantiyi geçersiz kılar.' ),
		array( 'q' => 'Mouse tekerleği hiç çalışmıyorsa ne yapmalıyım?', 'a' => 'Önce fareyi başka bir USB portunda veya başka bir bilgisayarda deneyin. Kablosuz farede pili değiştirin. Testte kaydırma sayaçları hiç artmıyorsa encoder veya bağlantısı arızalı olabilir; garanti kapsamındaysa satıcıya başvurun.' ),
		array( 'q' => 'Kaydırma hızını nereden değiştirebilirim?', 'a' => 'Windows 11\'de Ayarlar > Bluetooth ve cihazlar > Fare sayfasında her seferinde kaydırılacak satır sayısını ayarlayabilirsiniz. Varsayılan değer 3 satırdır. Farenizin üretici yazılımında da ayrı bir kaydırma hızı ayarı olabilir.' ),
		array( 'q' => 'Mouse testi verilerimi kaydediyor mu?', 'a' => 'Hayır. Test tamamen tarayıcınızda çalışır ve fare hareketleriniz, kaydırmalarınız veya tıklamalarınız hiçbir sunucuya gönderilmez. Sayfayı kapattığınızda tüm sayaçlar sıfırlanır.' ),
	),
);
