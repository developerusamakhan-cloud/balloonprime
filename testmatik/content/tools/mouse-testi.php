<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'Mouse Testi',
	'seo_title'   => 'Mouse Test: Çift Tıklama, Hz ve CPS Testi | Testmatik',
	'description' => 'Online mouse test: tüm tuşları ve tekerleği deneyin, çift tıklama (double click) sorununu yakalayın, polling rate (Hz) ölçün ve CPS testinizi yapın.',
	'keywords'    => array( 'mouse test', 'double click mouse test', 'çift tıklama testi', 'mouse test hz', 'dpi mouse test' ),
	'intro'       => 'Farenizin tüm tuşlarını, tekerleğini ve tıklama mekanizmasını tarayıcıda test edin. Çift tıklama sorununu yakalayın, polling rate (Hz) değerini görün ve CPS skorunuzu ölçün.',
	'html'        => <<<'HTML'
<h2>Mouse test nasıl yapılır?</h2>
<p>Bu araç, farenizin her tuşunun doğru algılanıp algılanmadığını, tıklamaların tek mi yoksa istemeden çift mi geldiğini ve farenin bilgisayara ne sıklıkla veri gönderdiğini gösterir. Kablolu, kablosuz, Bluetooth ve oyuncu fareleriyle, ayrıca laptop touchpad'iyle de çalışır.</p>
<ol class="tm-steps">
<li><strong>İmleci test alanına getirin.</strong> Ekrandaki fare çiziminin bulunduğu alan testin yapıldığı yerdir. Bu alanda sağ tık menüsü engellenir, böylece sağ tuşu rahatça deneyebilirsiniz.</li>
<li><strong>Her tuşa ayrı ayrı basın.</strong> Sol, sağ, orta (tekerlek), geri ve ileri tuşları basıldığında çizimde yanar ve her birinin tıklama sayısı artar.</li>
<li><strong>Tekerleği çevirin.</strong> Yukarı ve aşağı kaydırma sayaçları ayrı ayrı artar. Tekerleği yavaşça bir yöne çevirip sayacın yalnızca o yönde arttığını kontrol edin.</li>
<li><strong>Çift tıklama dedektörünü izleyin.</strong> Aynı tuşa normal hızda tek tek tıklayın. Araç, tek tıklamanız iki tıklama olarak geldiğinde uyarı verir.</li>
<li><strong>Fareyi hareket ettirin.</strong> Fareyi test alanında hızlı ve sürekli daireler çizerek oynatın; polling rate (Hz) tahmini ekranda görünür.</li>
<li><strong>CPS testini başlatın.</strong> 5 saniye boyunca olabildiğince hızlı tıklayın ve saniyedeki tıklama sayınızı görün.</li>
</ol>

<h2>Sonuçlar nasıl okunur?</h2>
<h3>Tuş ve tekerlek sayaçları</h3>
<p>Her bastığınızda ilgili tuş çizimde yanmalı ve sayacı tam olarak bir artmalıdır. Bir tuşa bastığınız halde hiçbir şey olmuyorsa ya tuş arızalıdır ya da farenin yazılımı o tuşa başka bir görev atamıştır. Tekerleği bir yöne çevirdiğinizde ters yöndeki sayacın da arttığını görüyorsanız tekerlek kodlayıcısı (encoder) kirlenmiş veya aşınmış olabilir.</p>
<h3>Çift tıklama (chatter) dedektörü ve eşik değeri</h3>
<p>Mekanik bir fare tuşu basıldığında içindeki metal kontaklar çok kısa bir süre titreşir. Sağlam bir mouse bu titreşimi filtreler ve tek bir tıklama gönderir. Kontaklar aşındığında ise titreşim filtreyi aşar ve bilgisayar tek basışınızı iki tıklama olarak algılar. Buna <strong>chatter</strong> ya da halk arasında <strong>çift tıklama sorunu</strong> denir.</p>
<p>Araç, aynı tuştan gelen iki tıklama arasındaki süreyi ölçer. Bu süre eşik değerinden kısaysa (varsayılan <strong>80 ms</strong>) tıklamayı şüpheli olarak işaretler. İnsan parmağı bilinçli olarak art arda tıklasa bile iki tıklama arasında genellikle bundan daha uzun süre geçer; bu yüzden 80 ms altındaki çift tıklamalar çoğunlukla aşınmış bir switch işaretidir.</p>
<div class="tm-callout tm-callout--tip">
<p><strong>İpucu:</strong> Double click mouse test sırasında bilerek hızlı çift tıklamayın. Rahat bir tempoda 50-100 kez tek tek tıklayın. Birkaç tane bile uyarı çıkıyorsa sorun büyük olasılıkla tuşun kendisindedir.</p>
</div>
<h3>Polling rate (Hz)</h3>
<p>Polling rate, farenin konum bilgisini bilgisayara saniyede kaç kez gönderdiğidir. 125 Hz, her 8 milisaniyede bir; 500 Hz her 2 ms'de bir; 1000 Hz ise her 1 ms'de bir güncelleme demektir. Ofis farelerinin çoğu 125 Hz civarında çalışır, oyuncu fareleri genellikle 1000 Hz destekler, bazı yeni modeller 4000 Hz ve üzerini sunar.</p>
<p>Araçtaki değer bir <strong>tahmindir</strong>. Tarayıcı, ekran yenileme hızı ve işlemci yükü ölçümü etkileyebilir; bu yüzden 1000 Hz bir fare için 900 ile 1000 arasında dalgalanan değerler görmek normaldir. Ölçüm, fareyi yalnızca hareket ettirirken oluşur. Fare dururken veri gönderilmediği için hareket etmeden değer okunamaz.</p>
<h3>CPS testi</h3>
<p>CPS (clicks per second), 5 saniyede yaptığınız tıklamaların saniyeye düşen ortalamasıdır. Bu bir donanım ölçümünden çok sizin tıklama hızınızı gösterir. Yine de CPS testi sırasında çift tıklama uyarıları çıkıyorsa, hızlı tıklamada fark edilmeyen bir switch sorununu ortaya çıkarabilir.</p>

<h2>DPI ve polling rate arasındaki fark</h2>
<p>“DPI mouse test” araması yapan pek çok kişi aslında polling rate ile DPI'ı karıştırır. İkisi tamamen farklı şeylerdir ve bu araç <strong>DPI değil, polling rate</strong> ölçer.</p>
<table>
<thead>
<tr><th>Özellik</th><th>DPI (CPI)</th><th>Polling rate (Hz)</th></tr>
</thead>
<tbody>
<tr><td>Ne anlatır?</td><td>Fare bir inç hareket ettiğinde imlecin kaç piksel gittiği (hassasiyet)</td><td>Farenin bilgisayara saniyede kaç kez veri gönderdiği</td></tr>
<tr><td>Tipik değerler</td><td>800, 1600, 3200 DPI</td><td>125, 500, 1000 Hz</td></tr>
<tr><td>Hissettirdiği</td><td>İmlecin hızlı veya yavaş gitmesi</td><td>Hareketin akıcılığı ve gecikme</td></tr>
<tr><td>Nereden değişir?</td><td>Farenin DPI düğmesi veya üretici yazılımı</td><td>Üretici yazılımı veya farenin altındaki düğme</td></tr>
<tr><td>Bu araçta</td><td>Ölçülmez</td><td>Tahmini olarak ölçülür</td></tr>
</tbody>
</table>
<p>DPI'ı tarayıcıdan güvenilir biçimde ölçmek mümkün değildir, çünkü işletim sisteminin imleç hızı ve “işaretçi hassasiyetini artır” ayarı hareketi değiştirir. DPI'ı öğrenmenin en doğru yolu farenin kutusuna, teknik özelliklerine veya üretici yazılımına bakmaktır.</p>

<h2>Sık görülen mouse sorunları ve çözümleri</h2>
<table>
<thead>
<tr><th>Belirti</th><th>Olası neden</th><th>Çözüm</th></tr>
</thead>
<tbody>
<tr><td>Tek tıklama çift algılanıyor</td><td>Aşınmış switch, kontak titreşimi</td><td>Garanti varsa değişim; yoksa switch değişimi veya yeni fare</td></tr>
<tr><td>Sürükle-bırak yarıda kopuyor</td><td>Basılı tutarken switch bağlantıyı kısa süre kesiyor</td><td>Çift tıklama dedektörüyle doğrulayın, switch değişimi gerekir</td></tr>
<tr><td>Tekerlek ters yöne atlıyor</td><td>Kirli veya aşınmış tekerlek kodlayıcısı</td><td>Basınçlı hava ile temizleyin; sürerse kodlayıcı değişmeli</td></tr>
<tr><td>Geri/ileri tuşları çalışmıyor</td><td>Tuşlara yazılımla başka görev atanmış</td><td>Üretici yazılımında tuş atamasını varsayılana döndürün</td></tr>
<tr><td>Polling rate beklenenden düşük</td><td>Yazılımda düşük Hz seçili, USB çoklayıcı, kablosuz parazit</td><td>Yazılımda 1000 Hz seçin, alıcıyı doğrudan PC'ye takın</td></tr>
<tr><td>İmleç takılıyor veya zıplıyor</td><td>Kirli sensör, parlak yüzey, zayıf pil</td><td>Sensörü temizleyin, mousepad kullanın, pili değiştirin</td></tr>
<tr><td>Hiçbir tuş algılanmıyor</td><td>Bağlantı veya sürücü sorunu</td><td>Başka bir USB portu deneyin, Aygıt Yöneticisi'ni kontrol edin</td></tr>
</tbody>
</table>
<p>Çift tıklama sorunu ile ilgili tüm nedenleri ve geçici çözümleri <a href="{post:mouse-cift-tiklama-sorunu}">mouse çift tıklama sorunu ve çözümü</a> rehberimizde ayrıntılı olarak anlattık.</p>

<h2>Kablosuz, oyuncu faresi ve touchpad için ipuçları</h2>
<p><strong>Kablosuz fareler:</strong> 2,4 GHz alıcılı farelerde alıcıyı fareye yakın tutun. Alıcı kasanın arkasında ve metal bir yüzeyin arkasında kalıyorsa polling rate dalgalanabilir. Alıcıyı uzatma kablosuyla masaya almak çoğu zaman sorunu çözer. Bluetooth fareler genellikle daha düşük ve daha değişken polling rate değerleri verir; bu normaldir.</p>
<p><strong>Oyuncu fareleri:</strong> Fareniz 1000 Hz desteklediği halde test 125 Hz civarında gösteriyorsa üretici yazılımında (Logitech G HUB, Razer Synapse, SteelSeries GG gibi) polling rate ayarını kontrol edin. Bazı farelerin altında Hz seçimi için fiziksel bir düğme bulunur.</p>
<p><strong>Laptop touchpad:</strong> Touchpad'in sol ve sağ tıklama alanlarını da bu araçla deneyebilirsiniz. İki parmakla kaydırma, tekerlek sayaçlarını artırır. Touchpad'ler çoğu zaman orta, geri ve ileri tuşlarına sahip değildir.</p>
<p><strong>Windows ve macOS:</strong> Windows'ta <strong>Ayarlar &gt; Bluetooth ve cihazlar &gt; Fare</strong> bölümünde birincil tuş seçimini kontrol edin; sol ve sağ tuşlar yer değiştirmiş olabilir. macOS'ta <strong>Sistem Ayarları &gt; Fare</strong> altında ikincil tıklama ayarını görebilirsiniz.</p>
<div class="tm-callout tm-callout--warn">
<p><strong>Uyarı:</strong> Garantisi devam eden bir fareyi açmayın. Çift tıklama sorununu bu testle kaydedip satıcıya veya üreticiye başvurmak, kendiniz switch değiştirmekten daha güvenli bir yoldur.</p>
</div>

<h2>Yeni veya ikinci el fare için 2 dakikalık kontrol listesi</h2>
<p>Yeni aldığınız bir fareyi iade süresi dolmadan ya da ikinci el bir fareyi satın almadan önce aşağıdaki sırayla test etmek, sorunları erken yakalamanızı sağlar.</p>
<ul>
<li><strong>Tüm tuşlar:</strong> Sol, sağ, orta, geri ve ileri tuşlarına beşer kez basın; her sayaç tam beş artmalı.</li>
<li><strong>Çift tıklama:</strong> Sol tuşa rahat bir tempoda en az 100 kez tıklayın, ardından sağ tuşu da aynı şekilde deneyin. Hiç uyarı çıkmaması idealdir.</li>
<li><strong>Basılı tutma:</strong> Masaüstünde bir dosyayı birkaç saniye sürükleyin. Dosya yolda bırakılıyorsa switch basılı tutmada bağlantıyı kesiyordur.</li>
<li><strong>Tekerlek:</strong> Tekerleği yukarı ve aşağı yönde tık tık çevirin; yalnızca doğru yöndeki sayaç artmalı. Tekerleğe basarak orta tuşu da deneyin.</li>
<li><strong>Polling rate:</strong> Fareyi hızlıca hareket ettirip değerin kutuda yazan değere yakın olup olmadığına bakın.</li>
<li><strong>Sensör:</strong> İmleci yavaşça ve hızlıca hareket ettirin; titreme veya ani sıçrama olmamalı.</li>
</ul>
<p>Bu kontroller, özellikle çok kullanılmış oyuncu farelerinde sık görülen aşınmayı kısa sürede ortaya çıkarır.</p>

<h2>Gizlilik</h2>
<p>Mouse testi tamamen tarayıcınızda çalışır. Tıklamalarınız, imleç hareketleriniz ve ölçüm sonuçları hiçbir sunucuya gönderilmez ve saklanmaz. Sayfayı kapattığınızda tüm sayaçlar sıfırlanır.</p>

<h2>İlgili testler ve rehberler</h2>
<p>Farenizi kontrol ettikten sonra klavyenizi de denemek için <a href="{tool:klavye-testi}">online klavye testi</a> aracımızı kullanabilirsiniz; oyuncular için aynı anda kaç tuşun algılandığını da gösterir. Ekranınızda takılı veya ölü nokta olup olmadığını <a href="{tool:olu-piksel-testi}">ölü piksel testi</a> ile, kulaklığınızın sağ ve sol kanalını <a href="{tool:hoparlor-testi}">sağ sol ses testi</a> ile kontrol edin. Yayın veya görüntülü görüşme düzeninizi tamamlamak için <a href="{tool:kamera-testi}">web kamera testi</a> de yapabilirsiniz.</p>
<p>Klavye kaynaklı sorunlar için <a href="{post:klavye-ghosting-nedir}">klavye ghosting nedir</a> rehberimize, ikinci el bir laptop veya oyuncu bilgisayarı alıyorsanız <a href="{post:ikinci-el-laptop-kontrol}">ikinci el laptop alırken yapılması gereken testler</a> yazısına bakın.</p>
<p>Testte tekerlek ters yöne kayıyor ya da zıplıyorsa <a href="{post:mouse-tekerlegi-sorunu}">mouse tekerleği aşağı yukarı sorunu</a> rehberindeki temizlik ve ayar adımlarını deneyin. Ölçtüğünüz Hz değerinin ne anlama geldiğini <a href="{post:mouse-polling-rate-nedir}">mouse polling rate nedir</a> yazısında bulabilirsiniz.</p>
HTML
	,
	'faqs'        => array(
		array( 'q' => 'Mouse çift tıklama yapıyor, nasıl anlarım?', 'a' => 'Test alanında aynı tuşa normal bir tempoda tek tek tıklayın. Çift tıklama dedektörü, iki tıklama eşik değerinden (varsayılan 80 ms) daha kısa aralıkla gelirse uyarı verir. Birkaç uyarı bile görüyorsanız switch büyük olasılıkla aşınmıştır.' ),
		array( 'q' => 'Double click mouse test sonucunda 80 ms ne anlama geliyor?', 'a' => '80 ms, aynı tuştan gelen iki tıklama arasındaki süre için kullanılan varsayılan eşik değeridir. İnsanın bilinçli olarak yaptığı tıklamalar arasında genellikle daha uzun süre geçer. Bu sürenin altındaki çift tıklamalar çoğu zaman tuşun içindeki kontakların titreşmesinden kaynaklanır.' ),
		array( 'q' => 'Bu araç DPI ölçüyor mu?', 'a' => 'Hayır. Araç DPI değil, polling rate (Hz) tahmini yapar. DPI, işletim sisteminin imleç ayarlarından etkilendiği için tarayıcıdan güvenilir şekilde ölçülemez. DPI değerini farenin teknik özelliklerinden veya üretici yazılımından öğrenebilirsiniz.' ),
		array( 'q' => 'Oyun için kaç Hz polling rate gerekir?', 'a' => 'Oyuncu farelerinde yaygın standart 1000 Hz, yani her milisaniyede bir güncellemedir. 500 Hz de çoğu oyuncu için yeterli akıcılık sağlar. 125 Hz ofis kullanımı için uygundur ama hızlı oyunlarda hareket daha az akıcı hissedilebilir.' ),
		array( 'q' => 'Polling rate değeri neden sürekli değişiyor?', 'a' => 'Değer bir tahmindir ve tarayıcı, ekran yenileme hızı ve işlemci yükünden etkilenir. Fareyi yavaş hareket ettirdiğinizde de düşük çıkabilir. En doğru sonuç için fareyi test alanında hızlı ve sürekli daireler çizerek oynatın.' ),
		array( 'q' => 'Geri ve ileri tuşları test edilebilir mi?', 'a' => 'Evet. Farenizin yan tarafındaki geri ve ileri tuşları çizimde yanar ve ayrı ayrı sayılır. Bir yan tuş hiç tepki vermiyorsa farenin yazılımında o tuşa farklı bir görev atanmış olabilir.' ),
		array( 'q' => 'CPS testi farenin sağlamlığını gösterir mi?', 'a' => 'CPS testi asıl olarak sizin tıklama hızınızı ölçer. Ancak hızlı tıklama sırasında çift tıklama uyarıları çıkıyorsa bu, tuşta bir sorun olduğuna işaret edebilir. Farenin sağlığı için asıl göstergeniz çift tıklama dedektörüdür.' ),
	),
);
