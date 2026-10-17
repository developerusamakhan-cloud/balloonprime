<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'Ölü Piksel ve Sıkışmış Piksel Nasıl Düzeltilir?',
	'seo_title'   => 'Ölü Piksel Nasıl Düzeltilir? Sıkışmış Piksel | Testmatik',
	'description' => 'Ölü piksel nasıl düzeltilir? Ölü ve sıkışmış piksel farkını, piksel onarıcı kullanımını, garanti ve iade adımlarını ve OLED yanmasından farkını öğrenin.',
	'keywords'    => array( 'ölü piksel nasıl düzeltilir', 'sıkışmış piksel düzeltme', 'ölü piksel tamiri', 'stuck pixel düzeltme', 'ekranda renkli nokta' ),
	'intro'       => 'Ekranınızda sürekli siyah ya da renkli kalan bir nokta mı var? Bunun ölü mü yoksa sıkışmış piksel mi olduğunu anlayın, neyin düzelebileceğini ve neyin düzelmeyeceğini öğrenin.',
	'excerpt'     => 'Ölü piksel ile sıkışmış piksel aynı şey değil. Hangisinin düzelebileceğini, piksel onarıcıyı nasıl kullanacağınızı ve garanti sürecini bu rehberde bulabilirsiniz.',
	'category'    => 'Ekran',
	'tool'        => 'olu-piksel-testi',
	'html'        => <<<'HTML'
<h2>Ölü piksel ile sıkışmış piksel arasındaki fark</h2>
<p>Bir LCD ekran milyonlarca pikselden oluşur ve her piksel genellikle kırmızı, yeşil ve mavi olmak üzere üç alt pikselden meydana gelir. Bu alt piksellerin parlaklığını her biri için ayrı bir transistör kontrol eder. Bir noktanın "bozuk" görünmesinin nedeni, bu yapının neresinde sorun olduğuna göre değişir.</p>
<p><strong>Ölü piksel</strong>, hiçbir renkte ışık vermeyen pikseldir. Beyaz bir arka planda küçük siyah bir nokta olarak görünür. Genellikle pikseli kontrol eden transistörün ya da bağlantısının kalıcı olarak arızalanmasından kaynaklanır.</p>
<p><strong>Sıkışmış piksel</strong> (stuck pixel) ise bir ya da birkaç alt pikselin sürekli açık kalmasıdır. Ekranda ne gösterilirse gösterilsin kırmızı, yeşil, mavi ya da bunların karışımı bir renkte yanar. Özellikle siyah arka planda belirgin şekilde fark edilir. Sürekli beyaz yanan noktalar da çoğu zaman bu gruba girer ve bazen "sıcak piksel" olarak adlandırılır.</p>
<table>
<thead>
<tr><th>Özellik</th><th>Ölü piksel</th><th>Sıkışmış piksel</th></tr>
</thead>
<tbody>
<tr><td>Görünüm</td><td>Siyah nokta</td><td>Kırmızı, yeşil, mavi veya beyaz nokta</td></tr>
<tr><td>En iyi görüldüğü arka plan</td><td>Beyaz veya açık renkler</td><td>Siyah veya koyu renkler</td></tr>
<tr><td>Olası neden</td><td>Transistör veya bağlantı arızası</td><td>Sürekli açık kalan alt piksel</td></tr>
<tr><td>Düzelme ihtimali</td><td>Çok düşük</td><td>Bazen düzelebilir</td></tr>
</tbody>
</table>

<h2>Önce tespit edin: Hangi tür piksel sorunu var?</h2>
<p>Düzeltmeye çalışmadan önce sorunun gerçekten bir piksel arızası olduğundan emin olun. Ekranda toz, leke ya da küçük bir parçacık da benzer bir görüntü oluşturabilir. Ekranı kapatıp mikrofiber bir bezle nazikçe silin; nokta yerinde kalıyorsa piksel testine geçin.</p>
<ol class="tm-steps">
<li><a href="{tool:olu-piksel-testi}">Ölü piksel testi</a> aracını açın ve <strong>Testi başlat</strong> ile tam ekrana geçin.</li>
<li>Tıklayarak, ok tuşlarıyla ya da boşluk tuşuyla siyah, beyaz, kırmızı, yeşil, mavi, gri, camgöbeği, macenta ve sarı renkler arasında geçiş yapın.</li>
<li>Siyah ekranda yanan nokta sıkışmış piksele, beyaz ekranda görünen siyah nokta ölü piksele işaret eder.</li>
<li>Noktanın yerini not edin; kenara yakın mı, ortada mı, kaç tane olduğunu kaydedin.</li>
<li>İşiniz bitince <kbd>Esc</kbd> tuşuyla tam ekrandan çıkın.</li>
</ol>
<p>Test tamamen tarayıcınızda çalışır ve hiçbir veri sunucuya gönderilmez. Monitör, laptop, televizyon tarayıcısı ve telefonlarda aynı şekilde kullanılabilir.</p>

<h2>Neler düzelebilir, neler düzelmez?</h2>
<div class="tm-cta" data-tool="olu-piksel-testi"></div>
<p>Dürüst olmak gerekirse, internette "ölü pikseli kesin düzelten" yöntemler olarak paylaşılanların çoğu aslında sıkışmış pikseller için geçerlidir. Gerçek bir ölü piksel, yani transistörü arızalanmış bir piksel, yazılımla ya da ev yöntemleriyle genellikle geri getirilemez.</p>
<p>Sıkışmış piksellerde ise durum daha umut vericidir. Bu piksellerin bir kısmı, hızlı renk değişimleriyle uyarıldığında ya da kendiliğinden, zamanla normale dönebilir. Ancak bunun her zaman işe yarayacağının garantisi yoktur. Bazı sıkışmış pikseller hiçbir yönteme yanıt vermez.</p>
<p>Tek başına küçük bir ölü piksel, ekranın geri kalanının sağlıklı olduğu anlamına da gelebilir. Kenarda kalan ve günlük kullanımda gözünüze çarpmayan tek bir nokta, çoğu kullanıcı için zamanla fark edilmez hâle gelir. Ancak arızalı piksellerin sayısı artıyorsa ya da bir bölgede küme hâlinde yayılıyorsa bu, panelde daha geniş bir sorunun işareti olabilir ve servise başvurmanız gerekir.</p>
<div class="tm-callout tm-callout--info">
<p><strong>Bilgi:</strong> Yeni bir cihazda fark ettiğiniz piksel sorunu için onarım denemeden önce garanti ve iade seçeneklerinizi kontrol edin. Bazı durumlarda değişim talep etmek çok daha hızlı ve kesin bir çözümdür.</p>
</div>

<h2>Piksel onarıcı ile sıkışmış piksel düzeltme</h2>
<p>Piksel onarıcı, sıkışmış pikselin üzerinde çok hızlı ve rastgele renk değişimleri yaparak alt piksellerin sürekli açılıp kapanmasını sağlar. Bu "piksel egzersizi" bazı durumlarda takılı kalan alt pikselin yeniden normal çalışmasına yardımcı olabilir.</p>
<div class="tm-callout tm-callout--warn">
<p><strong>Uyarı:</strong> Piksel onarıcı hızla yanıp sönen renkler kullanır. Işığa duyarlı epilepsi geçmişi olan kişiler bu aracı kullanmamalı ve çalışırken ekrana bakmamalıdır.</p>
</div>
<ol class="tm-steps">
<li>Ölü piksel testi sayfasındaki <strong>piksel onarıcı</strong> bölümünü açın.</li>
<li>Ekranda beliren küçük yanıp sönen kareyi sürükleyerek sıkışmış pikselin tam üzerine yerleştirin.</li>
<li>Kareyi 10–30 dakika boyunca orada bırakın. Bu sırada ekrana bakmanıza gerek yoktur.</li>
<li>Süre dolunca kareyi kaldırın ve test ekranlarıyla pikseli yeniden kontrol edin.</li>
<li>Sonuç alamazsanız işlemi birkaç kez, farklı günlerde tekrarlayabilirsiniz.</li>
</ol>
<p>Bu süre boyunca ekranın uyku moduna geçmemesi için güç ayarlarını geçici olarak değiştirmeniz gerekebilir. Windows 11'de bunu <strong>Ayarlar &gt; Sistem &gt; Güç ve pil</strong> bölümünden, macOS'ta ise <strong>Sistem Ayarları &gt; Kilit Ekranı</strong> bölümünden yapabilirsiniz.</p>

<h3>Hafif baskı yöntemi ve riskleri</h3>
<p>İnternette sıkça önerilen bir diğer yöntem, ekran kapalıyken sıkışmış pikselin bulunduğu noktaya yumuşak bir bez üzerinden çok hafif baskı uygulamak ve ardından ekranı açmaktır. Bu yöntem bazı sıkışmış piksellerde işe yarayabilir, ancak ciddi riskler taşır.</p>
<ul>
<li>Fazla baskı, çevredeki sağlam pikselleri de bozabilir ya da kalıcı bir leke oluşturabilir.</li>
<li>Laptop ve ince monitör panelleri oldukça hassastır; panel çatlayabilir.</li>
<li>Fiziksel hasar izleri garanti kapsamını etkileyebilir.</li>
<li>Dokunmatik ekranlarda ve telefonlarda bu yöntem önerilmez.</li>
</ul>
<p>Cihazınız garanti kapsamındaysa baskı yöntemini denemeyin. Garanti süresi dolmuş ve başka seçeneğiniz kalmamışsa bile, sivri bir uç yerine yumuşak bir bez kullanın ve kesinlikle güç uygulamayın.</p>

<h2>Garanti ve iade süreci</h2>
<p>Piksel sorunu yeni bir cihazda ortaya çıktıysa, onarım denemeleriyle vakit kaybetmek yerine resmi yolları değerlendirin. Türkiye'de internetten yapılan alışverişlerde genellikle 14 günlük cayma hakkı bulunur. Bunun yanında ekranlar da diğer elektronik ürünler gibi garanti kapsamındadır.</p>
<p>Üreticilerin çoğu, piksel arızaları için kendi politikalarını belirler. Bu politikalar, ekranda belirli sayıda ya da belirli konumda arızalı piksel bulunmasını değişim için koşul olarak öngörebilir. Ekranın ortasındaki bir piksel ile köşedeki bir piksel farklı değerlendirilebilir. Bu nedenle başvurmadan önce üreticinizin piksel politikasını okuyun.</p>
<ol class="tm-steps">
<li>Ölü piksel testiyle sorunu belgeleyin; arızalı pikselin görüldüğü renkte ekranın fotoğrafını çekin.</li>
<li>Faturanızı ve satın alma tarihini hazırlayın.</li>
<li>Satıcının veya üreticinin piksel politikasını ve garanti koşullarını inceleyin.</li>
<li>Önce satıcıyla, gerekirse yetkili servisle iletişime geçin.</li>
<li>Talebiniz reddedilirse gerekçeyi yazılı olarak isteyin.</li>
</ol>
<p>İkinci el bir laptop ya da monitör alırken ekranı satın almadan önce test etmek, sonradan yaşanacak tartışmaları önler. Bu ve diğer kontroller için <a href="{post:ikinci-el-laptop-kontrol}">ikinci el laptop kontrol rehberimize</a> göz atabilirsiniz.</p>

<h2>OLED yanması (burn-in) farklı bir sorundur</h2>
<p>OLED ekranlarda her piksel kendi ışığını üretir. Uzun süre aynı görüntü, örneğin bir kanal logosu, görev çubuğu ya da oyun arayüzü gösterildiğinde, bu bölgedeki pikseller diğerlerinden daha hızlı yıpranabilir. Sonuçta ekranda soluk ama kalıcı bir iz kalır. Buna <strong>yanma</strong> (burn-in) denir.</p>
<p>Yanma, tek bir pikselin arızası değil, bir bölgenin eşit olmayan şekilde yaşlanmasıdır. Bu nedenle piksel onarıcı yanmayı düzeltmez. Birçok OLED televizyon, monitör ve telefonda bulunan piksel yenileme gibi dahili bakım özellikleri, geçici görüntü kalıntılarını azaltmaya yardımcı olabilir. Kalıcı yanma ise genellikle panel değişimi gerektirir.</p>
<p>Yanma riskini azaltmak için ekran koruyucuları ve otomatik kararma özelliklerini açık tutun, parlaklığı gereğinden yüksek ayarlamayın ve sabit görüntülerin ekranda saatlerce kalmasını önleyin.</p>

<h2>Telefon, laptop ve televizyonlarda dikkat edilecekler</h2>
<p>Piksel sorunları her ekran türünde görülebilir, ama yaklaşım cihaza göre biraz değişir.</p>
<ul>
<li><strong>Telefonlar:</strong> Çoğu modern telefon OLED ekran kullanır. Ekranda sabit bir nokta görürseniz önce koruyucu cam altında toz ya da hava kabarcığı olmadığından emin olun. Telefon ekranlarına kesinlikle baskı uygulamayın.</li>
<li><strong>Laptoplar:</strong> Ekran panelleri ince ve esnektir. Kapağı kapatırken klavye ile ekran arasında küçük bir nesne kalması, piksel hasarına benzeyen izler bırakabilir.</li>
<li><strong>Televizyonlar:</strong> Ölü piksel testini televizyonun dahili tarayıcısından açabilirsiniz. Büyük ekranlarda birkaç metre geriden bakınca fark edilmeyen tek bir piksel, yakından bakıldığında görünür olabilir.</li>
<li><strong>Monitörler:</strong> Yeni bir monitörü kurar kurmaz test edin. Sorunu ne kadar erken fark ederseniz iade ve değişim seçenekleriniz o kadar geniştir.</li>
</ul>
<p>Hangi cihazda olursa olsun, sorunu ilk fark ettiğiniz anda belgelemek, ileride garanti başvurusu yapmanız gerektiğinde işinizi kolaylaştırır.</p>

<h2>Diğer donanımları da test edin</h2>
<p>Ekranı kontrol ederken diğer bileşenleri de gözden geçirmek iyi bir fikirdir. Laptopunuzun dahili kamerasını <a href="{tool:kamera-testi}">kamera testi</a> ile, tüm tuşları ise <a href="{tool:klavye-testi}">klavye testi</a> ile birkaç dakikada deneyebilirsiniz. Kamerada görüntü gelmiyorsa <a href="{post:laptop-kamera-calismiyor}">laptop kamera çalışmıyor</a>, klavyede tuşlar tepki vermiyorsa <a href="{post:laptop-klavye-calismiyor}">laptop klavye çalışmıyor</a> rehberlerimiz adım adım çözüm sunar. Piksel onarımından sonra sonucu kontrol etmek için <a href="{tool:olu-piksel-testi}">monitör ölü piksel testini</a> yeniden çalıştırmayı unutmayın.</p>
HTML
	,
	'faqs'        => array(
		array( 'q' => 'Ölü piksel kendiliğinden düzelir mi?', 'a' => 'Gerçek bir ölü piksel, yani transistörü arızalanmış bir piksel genellikle kendiliğinden düzelmez. Sıkışmış pikseller ise bazen zamanla ya da piksel onarıcı gibi yöntemlerle normale dönebilir.' ),
		array( 'q' => 'Ölü piksel ile sıkışmış piksel nasıl ayırt edilir?', 'a' => 'Ölü piksel beyaz ekranda siyah bir nokta olarak görünür ve hiçbir renkte ışık vermez. Sıkışmış piksel ise siyah ekranda kırmızı, yeşil, mavi veya beyaz renkte sürekli yanar. Ölü piksel testinde renkler arasında geçiş yaparak kolayca ayırt edebilirsiniz.' ),
		array( 'q' => 'Piksel onarıcıyı ne kadar süre çalıştırmalıyım?', 'a' => 'Yanıp sönen kareyi sıkışmış pikselin üzerine yerleştirip 10 ila 30 dakika bırakın. Sonuç alamazsanız işlemi farklı günlerde birkaç kez tekrarlayabilirsiniz. Her pikselin yanıt vereceğinin garantisi yoktur.' ),
		array( 'q' => 'Ekrana bastırarak piksel düzeltmek güvenli mi?', 'a' => 'Riskli bir yöntemdir. Fazla baskı çevredeki pikselleri bozabilir, paneli çatlatabilir ve garantiyi etkileyebilir. Cihazınız garanti kapsamındaysa bu yöntemi denemeyin, önce satıcıya veya servise başvurun.' ),
		array( 'q' => 'Yeni monitörde ölü piksel varsa iade edebilir miyim?', 'a' => 'Bu, satıcının ve üreticinin piksel politikasına bağlıdır. İnternetten yapılan alışverişlerde genellikle 14 günlük cayma hakkı bulunur; bunun dışında garanti koşulları geçerlidir. Sorunu fotoğrafla belgeleyip faturanızla birlikte satıcıya başvurun.' ),
		array( 'q' => 'Piksel onarıcı OLED yanmasını düzeltir mi?', 'a' => 'Hayır. OLED yanması tek bir pikselin arızası değil, bir bölgenin eşit olmayan şekilde yıpranmasıdır. Cihazınızdaki piksel yenileme gibi dahili bakım özellikleri geçici kalıntılara yardımcı olabilir, kalıcı yanma ise genellikle panel değişimi gerektirir.' ),
	),
);
