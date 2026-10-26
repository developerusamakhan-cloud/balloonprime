<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'Lenovo Laptop Klavye Çalışmıyor? Modele Göre Çözümler',
	'seo_title'   => 'Lenovo Laptop Klavye Çalışmıyor? Çözümler | Testmatik',
	'description' => 'Lenovo laptop klavye çalışmıyor mu? Fn Lock, Lenovo Vantage, BIOS testi ve sürücü adımlarıyla IdeaPad, ThinkPad ve Legion modellerinde sorunu çözün.',
	'keywords'    => array( 'lenovo laptop klavye çalışmıyor', 'lenovo klavye çalışmıyor', 'lenovo fn tuşu', 'lenovo vantage klavye', 'thinkpad klavye çalışmıyor' ),
	'intro'       => 'Lenovo laptopunuzda bazı tuşlar tepki vermiyor, F tuşları ters çalışıyor ya da klavye tamamen sustuysa çoğu zaman sebep bir ayar veya sürücüdür. Adım adım kontrol edelim.',
	'excerpt'     => 'Lenovo laptop klavyesi çalışmıyorsa Fn Lock, Lenovo Vantage ayarları, sürücü ve BIOS kontrolüyle sorunun yazılımsal mı donanımsal mı olduğunu bulun.',
	'category'    => 'Klavye',
	'tool'        => 'klavye-testi',
	'date'        => '2026-11-06 06:00:00',
	'html'        => <<<'HTML'
<h2>Önce sorunu tanımlayın</h2>
<p>"Lenovo laptop klavye çalışmıyor" şikâyeti aslında birkaç farklı durumu kapsar. Klavyenin tamamı mı susuyor, yalnızca birkaç tuş mu basmıyor, yoksa F1-F12 tuşları beklediğinizden farklı mı davranıyor? Her birinin nedeni ve çözümü ayrıdır, bu yüzden ilk adım belirtiyi netleştirmektir.</p>
<p>Bu rehber Lenovo'ya özgü ayarlara odaklanır: Fn Lock, Lenovo Vantage, BIOS ve ThinkPad'lerdeki tuş düzeni. Markadan bağımsız genel Windows adımlarını daha ayrıntılı görmek isterseniz <a href="{post:laptop-klavye-calismiyor}">laptop klavye çalışmıyor</a> rehberimize de göz atabilirsiniz.</p>
<table>
<thead>
<tr><th>Belirti</th><th>Olası neden</th><th>İlk denenecek çözüm</th></tr>
</thead>
<tbody>
<tr><td>F tuşları ses veya parlaklık değiştiriyor</td><td>Fn Lock veya kısayol tuşu modu</td><td><kbd>Fn</kbd> + <kbd>Esc</kbd> ya da Lenovo Vantage</td></tr>
<tr><td>Sağdaki sayı tuşları çalışmıyor</td><td>Num Lock kapalı</td><td><kbd>Num Lock</kbd> tuşuna basmak</td></tr>
<tr><td>Tuşlar gecikmeli basıyor veya hiç basmıyor</td><td>Filtre tuşları açık</td><td>Erişilebilirlik ayarlarını kapatmak</td></tr>
<tr><td>Klavyenin tamamı tepkisiz</td><td>Sürücü, Windows hatası veya donanım</td><td>Yeniden başlatma, BIOS testi</td></tr>
<tr><td>Yalnızca bir bölge çalışmıyor</td><td>Sıvı teması veya bağlantı kablosu</td><td>Harici klavyeyle karşılaştırma, servis</td></tr>
</tbody>
</table>

<h2>Hangi tuşların çalışmadığını test edin</h2>
<p>Tahmin yürütmek yerine sorunu görünür hâle getirin. Ücretsiz <a href="{tool:klavye-testi}">klavye testi</a> aracında ekrandaki klavyede bastığınız tuş mavi yanar, en az bir kez çalışmış tuş yeşile döner. Böylece yeşile dönmeyen tuşları birkaç dakikada listeleyebilirsiniz. Araç Türkçe Q ve Türkçe F düzenlerini destekler, son basılan tuşun adını ve <code>code</code> değerini de gösterir.</p>
<ol class="tm-steps">
<li>Testi açın ve klavye düzeninizi (Q veya F) seçin.</li>
<li>Tüm harf, rakam, noktalama ve yön tuşlarına sırayla basın.</li>
<li>Yeşile dönmeyen tuşları not edin.</li>
<li>Birkaç tuşa aynı anda basarak eş zamanlı tuş sayısını kontrol edin.</li>
</ol>
<div class="tm-callout tm-callout--info">
<p><strong>Bilgi:</strong> <kbd>Fn</kbd> tuşu ve bazı medya tuşları hiçbir tarayıcı tarafından algılanamaz, çünkü laptop bunları donanım seviyesinde işler. Testte bu tuşların yanmaması arıza anlamına gelmez. Test tamamen tarayıcınızda çalışır; tuş vuruşlarınız hiçbir sunucuya gönderilmez.</p>
</div>

<div class="tm-cta" data-tool="klavye-testi"></div>

<h2>Fn Lock ve F tuşları sorunu</h2>
<p>Lenovo laptoplarda en sık karşılaşılan şikâyet, F1-F12 tuşlarının işlev tuşu yerine ses, parlaklık veya mikrofon kısayolu gibi davranmasıdır. Bu bir arıza değil, tercihtir. Birçok Lenovo modelinde varsayılan ayar kısayol tuşlarına öncelik verir; <kbd>F5</kbd> ile sayfayı yenilemek için <kbd>Fn</kbd> + <kbd>F5</kbd> basmanız gerekir.</p>
<p>Birçok modelde <kbd>Fn</kbd> + <kbd>Esc</kbd> kombinasyonu Fn Lock'u açıp kapatır. Esc tuşunun üzerinde küçük bir kilit simgesi veya ışık varsa modelinizde bu özellik büyük olasılıkla bulunur; ışığın yanması Fn Lock'un açık olduğunu gösterir. Kombinasyon işe yaramıyorsa ayarı Lenovo Vantage'dan veya BIOS'tan değiştirebilirsiniz.</p>
<h3>Lenovo Vantage ile klavye ayarları</h3>
<p>Lenovo Vantage, birçok Lenovo laptopta önceden yüklü gelen ve Microsoft Store'dan da indirilebilen resmi yardımcı uygulamadır. Uygulamanın cihaz ayarları bölümünde, sürüme göre adı değişebilen giriş veya klavye ayarları bulunur. Burada genellikle şunları yönetebilirsiniz:</p>
<ul>
<li>F tuşlarının öncelikli davranışı (işlev tuşu mu, kısayol tuşu mu)</li>
<li>Klavye arka ışığı seviyesi veya otomatik kapanma</li>
<li>ThinkPad modellerinde <kbd>Fn</kbd> ve <kbd>Ctrl</kbd> tuşlarının yerini değiştirme</li>
</ul>
<p>Vantage ayrıca sistem güncellemesi bölümünden Lenovo'nun modelinize özel sürücü ve BIOS güncellemelerini bulmanıza yardımcı olur. Klavye sorunu bir Windows güncellemesinden sonra başladıysa bu bölümü mutlaka kontrol edin.</p>

<h2>ThinkPad, IdeaPad ve Legion farkları</h2>
<h3>ThinkPad</h3>
<p>ThinkPad'lerde <kbd>Fn</kbd> tuşu klavyenin sol alt köşesindedir ve <kbd>Ctrl</kbd> onun sağında kalır. Başka markalardan geçen kullanıcılar <kbd>Ctrl</kbd> + <kbd>C</kbd> yapmak isterken <kbd>Fn</kbd> tuşuna bastıkları için kısayolların bozuk olduğunu düşünebilir. Bu iki tuşun yeri Lenovo Vantage'dan veya BIOS'taki ilgili seçenekten değiştirilebilir. ThinkPad'lerde BIOS'a girmek için birçok modelde açılışta <kbd>F1</kbd> tuşu kullanılır.</p>
<h3>IdeaPad ve Yoga</h3>
<p>IdeaPad ve Yoga serisinde BIOS'a genellikle açılışta <kbd>F2</kbd> (bazen <kbd>Fn</kbd> + <kbd>F2</kbd>) ile girilir. Birçok modelde kasanın kenarında küçük bir Novo düğmesi veya iğne deliği bulunur; laptop kapalıyken bu düğmeye basmak BIOS ve önyükleme seçeneklerinin listelendiği Novo menüsünü açar. 2'si 1 arada Yoga modellerinde ekran tablet konumuna katlandığında klavye bilerek devre dışı bırakılır; bu normal bir davranıştır.</p>
<h3>Legion</h3>
<p>Legion oyuncu laptoplarında klavye ışıklandırması ve bazı tuş davranışları üreticinin oyun yazılımı üzerinden yönetilir. Arka ışık birçok Lenovo modelinde olduğu gibi <kbd>Fn</kbd> + <kbd>Boşluk</kbd> ile değiştirilebilir. Oyun sırasında Windows tuşu çalışmıyorsa, oyun modu veya Windows tuşu kilidi gibi bir ayarın açık olup olmadığını kontrol edin.</p>

<h2>Windows tarafında yapılacak kontroller</h2>
<p>Lenovo'ya özgü ayarlar sorunu çözmediyse Windows ayarlarına geçin:</p>
<ol class="tm-steps">
<li>Laptopu tamamen yeniden başlatın. Kapat-aç yerine <strong>Yeniden başlat</strong> seçeneğini kullanın; hızlı başlatma açıkken "Kapat" sistemi tam olarak sıfırlamaz.</li>
<li><strong>Ayarlar &gt; Erişilebilirlik &gt; Klavye</strong> sayfasında <strong>Yapışkan tuşlar</strong> ve <strong>Filtre tuşları</strong> seçeneklerinin kapalı olduğundan emin olun. Filtre tuşları kısa basışları yok sayar ve klavye bozuk gibi görünür.</li>
<li><strong>Aygıt Yöneticisi</strong>'ni açın, <strong>Klavyeler</strong> altındaki cihaza sağ tıklayıp <strong>Cihazı kaldır</strong> deyin ve bilgisayarı yeniden başlatın. Windows sürücüyü otomatik olarak yeniden yükler.</li>
<li><strong>Ayarlar &gt; Saat ve dil &gt; Dil ve bölge</strong> bölümünde doğru klavye düzeninin seçili olduğunu kontrol edin. Yanlış düzen seçiliyse ş, ğ, ı gibi harfler farklı karakterler yazar.</li>
<li>Denetim Masası'ndaki güç seçeneklerinden <strong>Hızlı başlatmayı aç</strong> seçeneğini geçici olarak kapatıp sorunun tekrarlanıp tekrarlanmadığına bakın.</li>
</ol>

<h2>BIOS testi: yazılım mı, donanım mı?</h2>
<p>Klavyenin hiç çalışmadığı durumlarda en öğretici test BIOS'a girmektir. BIOS, Windows'tan ve sürücülerden bağımsız çalışır. Laptopu açarken modelinize uygun tuşa (birçok modelde <kbd>F2</kbd> veya <kbd>F1</kbd>) basın ya da Novo düğmesini kullanın. BIOS menüsünde yön tuşlarıyla gezinebiliyorsanız klavye donanımı büyük olasılıkla sağlamdır ve sorun Windows tarafındadır.</p>
<p>BIOS'ta da tuşlar tepki vermiyorsa sorun donanımsal olabilir: klavye bağlantı kablosu yerinden oynamış, sıvı teması olmuş veya klavye arızalanmış olabilir. Bu noktada bir USB klavye takarak bilgisayarın geri kalanının çalıştığını doğrulayın.</p>
<p>Harici klavye sorunsuz çalışıyorsa, servise gidene kadar onu kullanmaya devam edebilirsiniz. Bazı kullanıcılar sorun yalnızca belirli bir sıcaklıkta veya laptop belli bir açıyla tutulduğunda ortaya çıktığını fark eder; bu da gevşek bir bağlantıya işaret edebilir. Bu tür ayrıntıları not almak, servise arızayı anlatırken işinize yarar.</p>
<div class="tm-callout tm-callout--warn">
<p><strong>Uyarı:</strong> Klavyeye sıvı döküldüyse laptopu hemen kapatın, şarjdan çıkarın ve kurumadan açmayın. Kendi başınıza kasayı açmak garanti koşullarını etkileyebilir; önce yetkili servise danışın.</p>
</div>

<h2>Güç sıfırlama ve batarya</h2>
<p>Tüm tuşların aniden kilitlendiği bazı durumlarda kısa bir güç sıfırlaması işe yarar. Şarj adaptörünü çıkarın ve güç düğmesini 10-15 saniye basılı tutun, ardından laptopu yeniden açın. Bazı Lenovo modellerinde alt kasada acil durum sıfırlama deliği de bulunur; varsa yerini modelinizin kullanım kılavuzunda bulabilirsiniz.</p>
<p>Batarya şişmesi de klavyeyi dolaylı olarak etkileyebilir. Klavye yüzeyi yukarı doğru kabarıyor, touchpad zor basıyor veya kasa aralanıyorsa laptopu kullanmayı bırakın ve servise başvurun. Şişmiş bir batarya güvenlik riski taşır.</p>

<h2>Tek tek tuşlar takılıyorsa: temizlik</h2>
<p>Yalnızca bir veya iki tuş zor basıyor, takılıyor ya da bazen hiç algılanmıyorsa sorun çoğu zaman tuşun altına giren toz veya kırıntıdır. Laptopu kapatın, şarjdan çıkarın ve tuş aralıklarını basınçlı havayla, kısa püskürtmelerle temizleyin. Kutuyu dik tutun; ters tutulduğunda soğuk sıvı püskürtebilir.</p>
<p>Laptop klavyelerindeki tuş kapakları ince plastik mandallarla tutturulur ve kolayca kırılabilir. Bu yüzden tuş kapağını sökmeyi yalnızca modelinize ait servis kılavuzundaki talimatlara göre deneyin. Temizlikten sonra klavye testinde ilgili tuşa 20-30 kez basın; tuş her seferinde mavi yanıyorsa sorun giderilmiştir.</p>
<h3>Klavye arka ışığı yanmıyor</h3>
<p>Arka ışık yanmıyorsa önce <kbd>Fn</kbd> + <kbd>Boşluk</kbd> kombinasyonuyla seviyeleri deneyin; birçok modelde kapalı, düşük ve yüksek arasında geçiş yapar. Lenovo Vantage'da arka ışığın belirli bir süre sonra otomatik kapanması gibi bir seçenek de bulunabilir. Modelinizde arka ışıklı klavye olup olmadığını teknik özelliklerinden kontrol edin; aynı serinin her yapılandırmasında bulunmayabilir.</p>

<h2>Garanti ve servis</h2>
<p>Lenovo, cihazınızın garanti durumunu seri numarasıyla sorgulayabileceğiniz bir destek sitesi sunar. Seri numarası genellikle laptopun altındaki etikette yazar. Servise başvurmadan önce klavye testinde çalışmayan tuşların ekran görüntüsünü almanız, arızayı açıkça anlatmanızı kolaylaştırır. Türkiye'de tüketicilere satılan ürünlerde yasal garanti süresi en az iki yıldır.</p>

<h2>İlgili testler ve rehberler</h2>
<p>Klavyeyi kontrol ederken laptopun diğer parçalarını da gözden geçirmek iyi bir fikirdir. <a href="{tool:mouse-testi}">mouse testi</a> ile touchpad ve fare tuşlarını, <a href="{tool:olu-piksel-testi}">ölü piksel testi</a> ile ekranı kontrol edebilirsiniz. Oyunlarda aynı anda basılan tuşlar kayboluyorsa <a href="{post:klavye-ghosting-nedir}">klavye ghosting nedir</a> yazımız, düzen değiştirmeyi düşünüyorsanız <a href="{post:q-klavye-f-klavye-farki}">Q klavye ve F klavye farkı</a> rehberimiz işinize yarar.</p>
<p>İkinci el bir Lenovo almayı düşünüyorsanız satıcıyla buluşmadan önce <a href="{post:ikinci-el-laptop-kontrol}">ikinci el laptop kontrol listesini</a> yanınıza alın. Sorunu çözdükten sonra <a href="{tool:klavye-testi}">online klavye testi</a> ile tüm tuşların yeşile döndüğünü bir kez daha doğrulayın.</p>
HTML
	,
	'faqs'        => array(
		array( 'q' => 'Lenovo laptopta Fn Lock nasıl açılır veya kapatılır?', 'a' => 'Birçok Lenovo modelinde Fn + Esc kombinasyonu Fn Lock\'u açıp kapatır. Esc tuşundaki küçük ışık genellikle Fn Lock\'un açık olduğunu gösterir. Bu kombinasyon modelinizde çalışmıyorsa ayarı Lenovo Vantage uygulamasından veya BIOS\'tan değiştirebilirsiniz.' ),
		array( 'q' => 'Lenovo laptopta F tuşları neden ses ve parlaklık değiştiriyor?', 'a' => 'Birçok Lenovo modelinde varsayılan olarak kısayol tuşlarına öncelik verilir. Bu durumda klasik F1-F12 işlevi için Fn tuşuyla birlikte basmanız gerekir. Fn Lock\'u değiştirerek veya Lenovo Vantage\'daki ilgili ayarla bu davranışı tersine çevirebilirsiniz.' ),
		array( 'q' => 'Lenovo laptopta BIOS\'a nasıl girilir?', 'a' => 'IdeaPad, Yoga ve Legion modellerinin çoğunda açılışta F2, ThinkPad modellerinin çoğunda ise F1 tuşu kullanılır. Birçok IdeaPad modelinde laptop kapalıyken Novo düğmesine basarak açılan menüden de BIOS\'a girebilirsiniz. Tam yöntem modele göre değişebileceği için kullanım kılavuzunu kontrol edin.' ),
		array( 'q' => 'Klavye BIOS\'ta çalışıyor ama Windows\'ta çalışmıyorsa ne yapmalıyım?', 'a' => 'Bu durumda donanım büyük olasılıkla sağlamdır ve sorun Windows tarafındadır. Filtre tuşları ve yapışkan tuşlar ayarlarını kontrol edin, Aygıt Yöneticisi\'nden klavye sürücüsünü kaldırıp yeniden başlatın ve Lenovo Vantage üzerinden güncellemeleri yükleyin.' ),
		array( 'q' => 'Klavye testinde Fn tuşu neden yanmıyor?', 'a' => 'Fn tuşu laptopun kendi donanımı tarafından işlenir ve işletim sistemine ayrı bir tuş olarak gönderilmez. Bu yüzden hiçbir tarayıcı Fn tuşunu algılayamaz. Testte yanmaması tuşun bozuk olduğu anlamına gelmez.' ),
		array( 'q' => 'Yoga laptopumda klavye tablet modunda neden çalışmıyor?', 'a' => 'Ekran tablet veya çadır konumuna katlandığında klavye ve touchpad yanlışlıkla basılmasın diye bilerek devre dışı bırakılır. Ekranı normal laptop konumuna getirdiğinizde klavye yeniden çalışmalıdır. Çalışmıyorsa laptopu yeniden başlatıp tekrar deneyin.' ),
	),
);
