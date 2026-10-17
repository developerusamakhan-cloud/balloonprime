<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'Klavye Ghosting Nedir? Anti-Ghosting ve NKRO Rehberi',
	'seo_title'   => 'Klavye Ghosting Nedir? Anti-Ghosting ve NKRO | Testmatik',
	'description' => 'Klavye ghosting nedir, tuş engelleme ile farkı ne? Anti-ghosting, NKRO ve 6KRO kavramlarını öğrenin, klavyenizin aynı anda kaç tuşu algıladığını test edin.',
	'keywords'    => array( 'klavye ghosting nedir', 'anti ghosting nedir', 'nkro nedir', 'klavye ghosting testi', '6kro nedir' ),
	'intro'       => 'Oyunda aynı anda birkaç tuşa bastığınızda bazı komutlar kayboluyorsa sorun klavyenizin sınırları olabilir. Ghosting, anti-ghosting ve NKRO kavramlarını sade bir dille açıklıyoruz.',
	'excerpt'     => 'Klavye ghosting nedir, anti-ghosting ve NKRO ne işe yarar? Klavyenizin aynı anda kaç tuşu algıladığını öğrenin ve ücretsiz klavye testiyle kendiniz deneyin.',
	'category'    => 'Klavye',
	'tool'        => 'klavye-testi',
	'html'        => <<<'HTML'
<h2>Klavye ghosting nedir?</h2>
<p>Ghosting, birden fazla tuşa aynı anda bastığınızda klavyenin aslında basmadığınız bir tuşu da basılmış gibi algılamasıdır. Kelime anlamıyla "hayalet tuş" olarak düşünebilirsiniz. Örneğin üç tuşa birlikte bastığınızda ekranda dördüncü, alakasız bir karakter belirebilir.</p>
<p>Günlük kullanımda bu kavram genellikle daha geniş bir anlamda kullanılır: Aynı anda basılan tuşlardan bazılarının hiç algılanmaması da halk arasında "ghosting" olarak anılır. Teknik olarak bu ikinci durumun adı <strong>tuş engelleme</strong> (key blocking veya jamming) olsa da iki sorun aynı kökten gelir: klavyenin içindeki tuş matrisi.</p>

<h2>Ghosting ile tuş engelleme arasındaki fark</h2>
<table>
<thead>
<tr><th>Durum</th><th>Ne olur?</th><th>Kullanıcı ne fark eder?</th></tr>
</thead>
<tbody>
<tr><td>Ghosting</td><td>Basılmayan bir tuş, basılmış gibi bildirilir</td><td>Beklenmedik karakterler veya istemediğiniz komutlar</td></tr>
<tr><td>Tuş engelleme (blocking)</td><td>Klavye, hayalet tuş riskini görünce son basılan tuşu yok sayar</td><td>Bastığınız bir tuş hiç algılanmaz</td></tr>
<tr><td>Anti-ghosting</td><td>Belirli tuş kombinasyonları sorunsuz algılanacak şekilde tasarım</td><td>Yaygın oyun tuşlarında sorun yaşanmaz</td></tr>
<tr><td>NKRO</td><td>Her tuş bağımsız olarak algılanır</td><td>Kaç tuşa basarsanız basın hepsi kaydedilir</td></tr>
</tbody>
</table>
<p>Günümüzdeki klavyelerin çoğu gerçek ghosting yerine tuş engelleme yapar. Yani yanlış bir tuş göndermek yerine güvenli tarafta kalıp şüpheli tuşu görmezden gelir. Bu, yazı yazarken neredeyse hiç fark edilmez; ancak oyunlarda karakteriniz koşarken zıplamıyorsa ya da eğilirken ateş edemiyorsanız sebebi bu olabilir.</p>

<h2>Neden olur? Tuş matrisi ve diyotlar</h2>
<p>Bir klavyede 100'ü aşkın tuş bulunur, ama klavyenin içindeki denetleyici yongada her tuş için ayrı bir bağlantı noktası yoktur. Bunun yerine tuşlar, satır ve sütunlardan oluşan bir ızgaraya, yani <strong>matrise</strong> yerleştirilir. Her tuş bir satır ile bir sütunun kesiştiği noktadadır. Denetleyici satırları sırayla tarar ve hangi sütunda sinyal oluştuğuna bakarak basılan tuşu belirler.</p>
<p>Sorun, bir dikdörtgenin üç köşesini oluşturan üç tuşa aynı anda basıldığında başlar. Elektrik akımı bu üç tuş üzerinden dolanarak dördüncü köşeye ulaşabilir ve denetleyici o köşedeki tuşu da basılı sanar. İşte bu "hayalet" tuştur.</p>
<p>Bunun kesin çözümü, her tuşun yanına küçük bir <strong>diyot</strong> eklemektir. Diyot akımın yalnızca tek yönde geçmesine izin verir; böylece akım tuşlar arasında geri dolanamaz. Birçok mekanik klavye bu sayede her tuşu bağımsız okuyabilir. Ucuz membran klavyelerde ve çoğu laptop klavyesinde ise maliyet ve yer nedeniyle her tuşa diyot konmaz; bu klavyeler sorunu tuş engellemeyle yönetir.</p>
<div class="tm-cta" data-tool="klavye-testi"></div>

<h2>Anti-ghosting, NKRO ve 6KRO ne anlama gelir?</h2>
<h3>Anti-ghosting</h3>
<p>Anti-ghosting, pazarlamada en çok kullanılan ama en belirsiz terimdir. Genellikle klavyenin belirli bir bölgedeki tuşları (çoğunlukla <kbd>W</kbd>, <kbd>A</kbd>, <kbd>S</kbd>, <kbd>D</kbd>, <kbd>Shift</kbd>, <kbd>Ctrl</kbd> ve <kbd>Boşluk</kbd> çevresi) birlikte sorunsuz algılayacak şekilde tasarlandığı anlamına gelir. "Anti-ghosting" yazan bir klavye, tüm tuşları aynı anda algılayacağı anlamına gelmez. Hangi tuşların kapsandığını üretici her zaman belirtmez; bu yüzden kendiniz test etmeniz en doğrusudur.</p>

<h3>NKRO (N-Key Rollover)</h3>
<p>"Rollover", klavyenin aynı anda kaç tuşu doğru algılayabildiğini ifade eder. NKRO, yani N-key rollover, klavyedeki tüm tuşların aynı anda basılı olsa bile tek tek algılanabildiği anlamına gelir. Bu genellikle her tuşa diyot eklenmiş mekanik klavyelerde bulunur. Bazı modellerde NKRO bir tuş kombinasyonu veya üreticinin yazılımı ile açılıp kapatılabilir.</p>

<h3>6KRO ve USB sınırı</h3>
<p>6KRO, aynı anda altı normal tuş artı değiştirici tuşların (<kbd>Ctrl</kbd>, <kbd>Shift</kbd>, <kbd>Alt</kbd> ve <kbd>Windows</kbd>) algılanması demektir. Bu sınır klavyenin kendisinden değil, USB standardındaki "boot protokolü"nden gelir. Bu protokol, klavyenin BIOS gibi basit ortamlarda da sürücüsüz çalışabilmesi için tasarlanmıştır ve her rapor paketinde yalnızca altı normal tuşa yer ayırır. Değiştirici tuşlar ise ayrı bitlerle bildirildiği için bu altı tuşa dahil değildir.</p>
<p>USB üzerinden NKRO sunan klavyeler, işletim sistemine farklı bir rapor biçimi kullanarak bu sınırı aşar. Uyumluluk sorunu yaşanmaması için bazı klavyeler varsayılan olarak 6KRO modunda başlar.</p>

<h2>Klavyenizi nasıl test edersiniz?</h2>
<p>Klavyenizin gerçekte kaç tuşu birlikte algıladığını öğrenmek için ürün kutusundaki iddialara güvenmek yerine kendiniz denemeniz en sağlıklı yoldur. <a href="{tool:klavye-testi}">Klavye ghosting testi</a> için aracımız, aynı anda basılı tutulan en yüksek tuş sayısını gösterir.</p>
<ol class="tm-steps">
<li>Klavye testini açın ve sayfanın odakta olduğundan emin olun.</li>
<li>Oyunlarda sık kullandığınız kombinasyonu basılı tutun; örneğin <kbd>W</kbd> + <kbd>A</kbd> + <kbd>Shift</kbd> + <kbd>Boşluk</kbd>.</li>
<li>Ekrandaki "aynı anda basılan en fazla tuş" değerine ve mavi yanan tuşlara bakın.</li>
<li>Tuş sayısını birer birer artırın. Yeni bastığınız tuş yanmıyorsa klavyeniz o kombinasyonda engelleme yapıyor demektir.</li>
<li>Farklı bölgelerdeki tuş gruplarıyla denemeyi tekrarlayın; sınır bölgeden bölgeye değişebilir.</li>
</ol>
<div class="tm-callout tm-callout--info">
<p><strong>Bilgi:</strong> Test, klavyenin bilgisayara ne bildirdiğini gösterir. <kbd>Fn</kbd> tuşu ve bazı medya tuşları donanım seviyesinde işlendiği için hiçbir tarayıcıda görünmez. Ayrıca test tamamen tarayıcınızda çalışır; tuş vuruşlarınız hiçbir sunucuya gönderilmez.</p>
</div>
<p>Laptop klavyelerinde iki ya da üç tuştan sonra engelleme görmek oldukça olağandır ve bir arıza belirtisi değildir. Ancak tek bir tuş tek başına basıldığında bile algılanmıyorsa sorun ghosting değil, arızadır. Bu durumda <a href="{post:laptop-klavye-calismiyor}">laptop klavye çalışmıyor</a> rehberimizdeki adımları izleyin.</p>
<p>Sonuçları yorumlarken şunu da unutmayın: Klavye 6KRO modunda çalışıyorsa test, altı normal tuştan sonra yeni tuşları göstermez. Klavyenizde NKRO modu varsa onu etkinleştirip testi tekrarlayın ve iki sonucu karşılaştırın. Kablosuz modellerde testi hem kablolu hem kablosuz bağlantıda ayrı ayrı yapmak, farklı modlardaki davranışı görmenizi sağlar. Böylece satın aldığınız klavyenin kutudaki iddiayı gerçekten karşılayıp karşılamadığını birkaç dakikada öğrenebilirsiniz.</p>

<h2>Klavye türüne göre ne beklemelisiniz?</h2>
<table>
<thead>
<tr><th>Klavye türü</th><th>Tipik durum</th><th>Not</th></tr>
</thead>
<tbody>
<tr><td>Laptop klavyesi</td><td>Belirli kombinasyonlarda tuş engelleme</td><td>Her tuşa diyot konması nadirdir</td></tr>
<tr><td>Ucuz membran klavye</td><td>Sınırlı rollover, bölgeye göre değişir</td><td>Yazı için genellikle yeterlidir</td></tr>
<tr><td>Oyuncu membran klavye</td><td>Belirli tuş bölgesinde anti-ghosting</td><td>Kapsanan tuşları test edin</td></tr>
<tr><td>Mekanik klavye</td><td>Çoğunlukla 6KRO veya NKRO</td><td>Modele ve bağlantı moduna bağlıdır</td></tr>
</tbody>
</table>
<p>Bu tablo genel bir eğilimi gösterir; aynı türdeki iki klavye arasında bile büyük farklar olabilir. Kesin bilgiyi yalnızca üreticinin teknik özellikleri ve sizin yapacağınız test verir.</p>

<h2>Ghosting sanılan diğer sorunlar</h2>
<p>Her tuş kaybı rollover sınırından kaynaklanmaz. Aşağıdaki durumlar da benzer belirtiler gösterebilir:</p>
<ul>
<li><strong>Filtre Tuşları:</strong> Windows'ta bu erişilebilirlik özelliği açıksa kısa ve hızlı tuş vuruşları yok sayılır. <strong>Ayarlar &gt; Erişilebilirlik &gt; Klavye</strong> bölümünden kontrol edebilirsiniz.</li>
<li><strong>Yıpranmış anahtar:</strong> Tek bir tuş bazen basmıyor ya da tek basışta iki kez yazıyorsa sorun matris değil, o tuşun anahtarıdır.</li>
<li><strong>Kablosuz bağlantı sorunları:</strong> Zayıf pil veya parazit, tuşların gecikmeli ya da eksik iletilmesine yol açabilir.</li>
<li><strong>Oyun içi ayarlar:</strong> Bazı oyunlar aynı anda yalnızca belirli sayıda tuş atamasını işler; klavye her şeyi doğru gönderse bile komut kaybolabilir.</li>
</ul>
<p>Bu yüzden önce masaüstünde klavye testiyle klavyenin ne gönderdiğini görün. Testte tüm tuşlar algılanıyor ama oyunda sorun yaşıyorsanız, ayarları oyun tarafında aramak gerekir.</p>

<h2>Oyuncular için ne kadar önemli?</h2>
<p>Yazı yazmak, internette gezinmek ve ofis işleri için 6KRO bile fazlasıyla yeterlidir; insanlar normal yazarken nadiren üçten fazla tuşa aynı anda basar. Ghosting ve rollover asıl olarak şu durumlarda önem kazanır:</p>
<ul>
<li><strong>Hareket ve aksiyonu birleştiren oyunlar:</strong> FPS oyunlarında koşarken, çapraz hareket ederken, eğilip zıplarken dört beş tuş birlikte basılı olabilir.</li>
<li><strong>Ritim ve dövüş oyunları:</strong> Hızlı kombinasyonlarda birden fazla tuşun aynı anda tanınması gerekir.</li>
<li><strong>Aynı klavyeyi paylaşan iki oyuncu:</strong> Klavyenin iki ucundaki tuşlar birlikte kullanıldığında sınıra kolayca ulaşılır.</li>
<li><strong>Hızlı yazanlar:</strong> Çok hızlı on parmak yazanlar, bir tuşu bırakmadan diğerine bastığı için zaman zaman sınıra takılabilir.</li>
</ul>
<p>Oyun klavyesi alırken anahtar türü ve tuş hissi kadar rollover özelliğine de bakın. "Full NKRO" ya da "N-key rollover" ifadesi genellikle en güvenli seçenektir. Bütçeniz kısıtlıysa, en azından oyunlarda kullandığınız tuş bölgesinde anti-ghosting sunan bir modeli tercih edin ve satın aldıktan sonra mutlaka test edin.</p>

<h2>Diğer giriş cihazlarını da gözden geçirin</h2>
<p>Oyun performansını etkileyen tek bileşen klavye değildir. Farenizde istemediğiniz çift tıklamalar oluyorsa <a href="{post:mouse-cift-tiklama-sorunu}">mouse çift tıklama sorunu</a> rehberimize, faredeki tuşların ve polling rate değerinin durumuna ise <a href="{tool:mouse-testi}">mouse testi</a> ile bakabilirsiniz. Yeni bir oyun monitörü aldıysanız <a href="{tool:olu-piksel-testi}">ölü piksel testi</a> yapmayı unutmayın. Klavyenizin düzeni hakkında kafanız karışıksa <a href="{post:q-klavye-f-klavye-farki}">Q ve F klavye farkı</a> yazımız yardımcı olacaktır.</p>
HTML
	,
	'faqs'        => array(
		array( 'q' => 'Klavye ghosting nedir?', 'a' => 'Ghosting, birden fazla tuşa aynı anda basıldığında klavyenin basılmayan bir tuşu da basılmış gibi algılamasıdır. Günlük dilde aynı anda basılan bazı tuşların hiç algılanmaması da ghosting olarak anılır; bunun teknik adı tuş engellemedir.' ),
		array( 'q' => 'Anti-ghosting ile NKRO aynı şey mi?', 'a' => 'Hayır. Anti-ghosting genellikle belirli tuş gruplarının birlikte sorunsuz algılanması anlamına gelir. NKRO ise klavyedeki tüm tuşların aynı anda basılı olsa bile tek tek algılanabildiğini ifade eder ve daha kapsamlıdır.' ),
		array( 'q' => '6KRO yeterli mi?', 'a' => 'Yazı yazmak ve günlük kullanım için 6KRO fazlasıyla yeterlidir. Altı normal tuşa ek olarak Ctrl, Shift, Alt ve Windows gibi değiştirici tuşlar da algılanır. Çok yoğun tuş kombinasyonu gerektiren oyunlarda NKRO daha rahat bir deneyim sunar.' ),
		array( 'q' => 'Klavyemin kaç tuşu aynı anda algıladığını nasıl öğrenirim?', 'a' => 'Testmatik klavye testini açıp tuşları birer birer basılı tutun. Araç, aynı anda basılan en yüksek tuş sayısını gösterir. Yeni bastığınız tuş yanmıyorsa klavyeniz o kombinasyonda sınıra ulaşmıştır.' ),
		array( 'q' => 'Laptop klavyesinde ghosting olması arıza mıdır?', 'a' => 'Genellikle hayır. Laptop klavyelerinin çoğu maliyet ve yer nedeniyle her tuşa diyot içermez ve belirli kombinasyonlarda tuş engelleme yapar. Ancak tek başına basılan bir tuş algılanmıyorsa bu ghosting değil, bir arızadır.' ),
		array( 'q' => 'Kablosuz klavyelerde NKRO olur mu?', 'a' => 'Olabilir, ancak bu tamamen modele bağlıdır. Bazı kablosuz ve Bluetooth klavyeler kablolu bağlantıda NKRO sunarken kablosuz modda farklı bir sınırla çalışabilir. Ürün bilgilerini kontrol edin ve satın aldıktan sonra her iki modda da test edin.' ),
	),
);
