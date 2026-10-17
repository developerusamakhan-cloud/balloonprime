<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'Klavye Testi',
	'seo_title'   => 'Klavye Testi: Online Tuş Testi (Q ve F) | Testmatik',
	'description' => 'Ücretsiz online klavye testi: Türkçe Q ve F düzeninde her tuşu tek tek kontrol edin, ghosting ve NKRO değerini ölçün. Kurulum yok, tuşlar kaydedilmez.',
	'keywords'    => array( 'klavye testi', 'klavye test', 'klavye testi tuş', 'türkçe klavye testi', 'f klavye testi' ),
	'intro'       => 'Klavyenizdeki her tuşu tarayıcıda saniyeler içinde kontrol edin. Türkçe Q ve F düzeni, aynı anda basılan tuş ölçümü ve tuş geçmişi; kurulum yok, tuş vuruşlarınız kaydedilmez.',
	'html'        => <<<'HTML'
<h2>Klavye testi nasıl yapılır?</h2>
<p>Bu online klavye testi, klavyenizdeki her tuşun bilgisayara doğru sinyal gönderip göndermediğini birkaç dakikada gösterir. Program kurmanız gerekmez; sayfayı açıp tuşlara basmaya başlamanız yeterlidir. Laptop klavyeleri, masaüstü klavyeler, mekanik klavyeler ve kablosuz klavyelerle aynı şekilde çalışır.</p>
<ol class="tm-steps">
<li>Klavyenizin üzerindeki harf dizilimine bakın. Sol üstte Q, W, E, R harfleri varsa <strong>Türkçe Q</strong>, F, G, Ğ, I harfleri varsa <strong>Türkçe F</strong> düzenini seçin. Varsayılan seçim Türkçe Q'dur.</li>
<li>Tuşlara basmadan önce sayfanın boş bir alanına bir kez tıklayın. Böylece tarayıcının odağı test alanına geçer ve tuş vuruşları adres çubuğuna gitmez.</li>
<li>Tuşlara tek tek basın. Basılı tuttuğunuz tuş ekrandaki klavyede mavi yanar, bıraktığınızda yeşile döner.</li>
<li>Satır satır ilerleyin: rakamlar, harfler, Türkçe karakterler (Ğ, Ü, Ş, İ, Ö, Ç), ardından <kbd>Shift</kbd>, <kbd>Ctrl</kbd>, <kbd>Alt</kbd>, <kbd>AltGr</kbd>, ok tuşları ve varsa sayısal tuş takımı.</li>
<li>Ekranda hâlâ renksiz kalan tuşları not edin. Testi baştan almak isterseniz <strong>Sıfırla</strong> düğmesine basın.</li>
</ol>
<div class="tm-callout tm-callout--tip">
<p><strong>İpucu:</strong> Klavye testi tuş tuş yapıldığında en sık atlanan tuşlar <kbd>AltGr</kbd>, sağ <kbd>Shift</kbd>, sağ <kbd>Ctrl</kbd>, <kbd>Insert</kbd>, <kbd>Pause</kbd> ve sayısal tuş takımındaki <kbd>Enter</kbd> tuşudur. Bu tuşlar günlük kullanımda az basıldığı için arızaları da genellikle geç fark edilir. Sol ve sağ eşleri olan tuşların ikisini de ayrı ayrı deneyin; tarayıcı bunları farklı <code>code</code> değerleriyle bildirir.</p>
</div>
<p>Ekrandaki test edilen tuş sayacı, kaç farklı tuşun en az bir kez algılandığını gösterir. Bütün klavyeyi taradıktan sonra bu sayının klavyenizdeki tuş sayısına yakın olması beklenir. Fn gibi bazı özel tuşların neden sayılmadığını aşağıda açıklıyoruz.</p>

<h2>Türkçe klavye testi: Q ve F düzeni arasında geçiş</h2>
<p>Türkiye'de iki klavye düzeni kullanılır. Türkçe Q, İngilizce QWERTY dizilimine Türkçe harflerin eklenmiş hâlidir ve laptopların büyük çoğunluğunda bu düzen bulunur. Türkçe F ise Türkçe harf sıklığı göz önünde bulundurularak tasarlanmış, özellikle on parmak yazanların ve bazı kurumların tercih ettiği düzendir.</p>
<p>Testteki Q/F seçimi ekrandaki klavyenin etiketlerini değiştirir. F klavye testi yaparken F düzenini, Q klavye test ederken Q düzenini seçmeniz, bastığınız tuşla ekranda yanan tuşun aynı yerde görünmesini sağlar. Tarayıcının bildirdiği <code>code</code> değeri ise tuşun fiziksel konumunu anlatır ve düzenden bağımsızdır: Sol üstteki ilk harf tuşu iki düzende de <code>KeyQ</code> olarak görünür.</p>
<table>
<thead>
<tr><th>Özellik</th><th>Türkçe Q</th><th>Türkçe F</th></tr>
</thead>
<tbody>
<tr><td>Üst harf sırası</td><td>Q W E R T Y U I O P Ğ Ü</td><td>F G Ğ I O D R N H P Q W</td></tr>
<tr><td>Nerede yaygın?</td><td>Laptopların ve hazır masaüstü setlerin çoğu</td><td>On parmak yazanlar, daktilo geleneğinden gelen kullanıcılar</td></tr>
<tr><td>Kimin için kolay?</td><td>İngilizce klavyeye alışkın olanlar</td><td>Türkçe metinleri hızlı yazmak isteyenler</td></tr>
<tr><td>Testte seçim</td><td>Varsayılan düzen</td><td>Düzen düğmesiyle geçilir</td></tr>
</tbody>
</table>
<p>Hangisinin size uygun olduğunu merak ediyorsanız <a href="{post:q-klavye-f-klavye-farki}">Q klavye ve F klavye farkı</a> rehberimiz iki düzeni ayrıntılı olarak karşılaştırıyor.</p>

<h2>Sonuçlar nasıl okunur?</h2>
<h3>Renkler</h3>
<ul>
<li><strong>Mavi:</strong> Tuş şu anda basılı ve tarayıcı tarafından algılanıyor.</li>
<li><strong>Yeşil:</strong> Tuş en az bir kez sorunsuz algılandı.</li>
<li><strong>Renksiz:</strong> Tuş henüz hiç algılanmadı. Ya basmadınız ya da tuş sinyal göndermiyor.</li>
</ul>
<h3>Son tuş ve tuş geçmişi</h3>
<p>Son tuş alanında bastığınız tuşun adı ve <code>code</code> değeri görünür. Bu bilgi, yanlış karakter sorunlarında çok işe yarar. Örneğin <kbd>Ç</kbd> tuşuna bastığınızda test doğru konumu gösteriyor ama yazarken başka bir karakter çıkıyorsa sorun büyük ihtimalle donanımda değil, Windows veya macOS'taki dil ayarındadır.</p>
<p>Geçmiş listesi son basılan tuşları sırayla gösterir. Tek bir basışta aynı tuş için iki kayıt düşüyorsa tuş çift basıyor olabilir; bu durum özellikle yıpranmış mekanik switch'lerde görülür.</p>
<h3>Aynı anda basılan maksimum tuş: ghosting ve NKRO</h3>
<p>Bu sayaç, klavyenizin kaç tuşu birlikte algılayabildiğini gösterir. Oyunlarda sık kullanılan <kbd>W</kbd>, <kbd>A</kbd>, <kbd>S</kbd>, <kbd>D</kbd>, <kbd>Shift</kbd> ve <kbd>Space</kbd> tuşlarını birlikte basılı tutun ve sayacın kaça çıktığına bakın.</p>
<p>Basit membran klavyelerde bazı kombinasyonlar iki veya üç tuştan sonra algılanmaz; buna ghosting ya da tuş engelleme denir. Anti-ghosting özellikli klavyeler belirli bölgelerde daha fazla tuşu destekler. 6KRO klavyeler altı normal tuşu ve değiştirici tuşları, NKRO (n-key rollover) klavyeler ise basılan tüm tuşları ayrı ayrı iletebilir. Konunun teknik ayrıntıları için <a href="{post:klavye-ghosting-nedir}">klavye ghosting nedir</a> yazımıza göz atabilirsiniz.</p>
<div class="tm-callout tm-callout--info">
<p><strong>Bilgi:</strong> Fn tuşu hiçbir tarayıcı tarafından algılanamaz. Laptoplarda Fn, klavyenin kendi denetleyicisinde donanımsal olarak işlenir ve tarayıcıya ayrı bir tuş olarak ulaşmaz. Ses ve parlaklık gibi bazı medya tuşları da aynı nedenle testte görünmeyebilir. Bu bir arıza değildir: Fn ile kullandığınız kısayollar beklendiği gibi çalışıyorsa tuş sağlamdır.</p>
</div>
<p>Benzer şekilde <kbd>Windows</kbd> tuşu, <kbd>Alt</kbd> + <kbd>Tab</kbd> veya <kbd>Print Screen</kbd> gibi sistem kısayolları önce işletim sistemi tarafından yakalanabilir. Bu tuşlar testte gecikmeli görünebilir ya da hiç görünmeyebilir; sorunun klavyede olduğunu düşünmeden önce kısayolun kendisinin çalışıp çalışmadığına bakın.</p>

<h2>Sık görülen sorunlar ve çözümleri</h2>
<table>
<thead>
<tr><th>Belirti</th><th>Olası neden</th><th>Çözüm</th></tr>
</thead>
<tbody>
<tr><td>Bir tuş hiç yeşile dönmüyor</td><td>Tuşun altında kir veya sıvı kalıntısı, arızalı switch</td><td>Cihazı kapatıp basınçlı havayla temizleyin; mekanik klavyede switch'i kontrol edin</td></tr>
<tr><td>Aynı bölgedeki birkaç tuş birlikte çalışmıyor</td><td>Klavye devresinde bir hat kopukluğu veya laptopta yassı kablo sorunu</td><td>Harici klavyede kabloyu ve portu değiştirin; laptopta servise başvurun</td></tr>
<tr><td>Bastığınız tuş yerine başka karakter çıkıyor</td><td>İşletim sisteminde yanlış klavye düzeni seçili</td><td>Windows 11: Ayarlar &gt; Zaman ve dil &gt; Dil ve bölge; macOS: Sistem Ayarları &gt; Klavye &gt; Metin Girişi</td></tr>
<tr><td>Tek basışta iki kayıt düşüyor</td><td>Yıpranmış veya kirli switch</td><td>Switch'i temizleyin ya da değiştirin; garantideyse değişim talep edin</td></tr>
<tr><td>Aynı anda basılan tuş sayısı 2–3'te kalıyor</td><td>Membran klavyenin ghosting sınırı</td><td>Oyun için anti-ghosting veya NKRO destekli klavye tercih edin</td></tr>
<tr><td>Kablosuz klavyede tuşlar kaçıyor</td><td>Zayıf pil, uzak alıcı, kablosuz parazit</td><td>Pili değiştirin, alıcıyı klavyeye yakın bir porta takın</td></tr>
<tr><td>Hiçbir tuş algılanmıyor</td><td>Sayfa odakta değil, bağlantı veya sürücü sorunu</td><td>Sayfaya tıklayın; Aygıt Yöneticisi &gt; Klavyeler altından aygıtı kaldırıp bilgisayarı yeniden başlatın</td></tr>
<tr><td>Tuş bırakıldığı hâlde basılı görünüyor</td><td>Sıkışan tuş veya Yapışkan Tuşlar özelliği</td><td>Tuşu birkaç kez basıp bırakın; Ayarlar &gt; Erişilebilirlik &gt; Klavye bölümünden Yapışkan tuşları kapatın</td></tr>
</tbody>
</table>
<p>Laptopunuzda birden fazla tuş tepki vermiyorsa <a href="{post:laptop-klavye-calismiyor}">laptop klavye çalışmıyor</a> rehberindeki adımları sırayla deneyin; sürücüden BIOS kontrolüne kadar tüm olasılıkları orada ele alıyoruz.</p>

<h2>Laptop klavyesi ve mekanik klavye: nelere dikkat etmeli?</h2>
<h3>Laptop klavyeleri</h3>
<p>Laptop klavyeleri genellikle ince makas mekanizmalıdır ve anakarta yassı bir kabloyla bağlanır. Bu yüzden sıvı teması veya kablo gevşemesi çoğu zaman tek bir tuşu değil, bir sırayı ya da bölgeyi etkiler. Aynı anda algılanan tuş sayısı da oyun klavyelerine göre düşük çıkabilir; bu genellikle tasarım sınırıdır, arıza değildir.</p>
<p>Testi yaparken harici bir klavye bağlıysa çıkarın; böylece yalnızca dahili klavyeyi ölçtüğünüzden emin olursunuz. Sayısal tuş takımı olmayan modellerde Num Lock ve benzeri kombinasyonların üreticiye göre değiştiğini unutmayın.</p>
<h3>Mekanik klavyeler</h3>
<p>Mekanik klavyelerde her tuşun altında ayrı bir switch bulunur. Bir tuş tek basışta iki kez yazıyorsa ya da bazen hiç tepki vermiyorsa sorun çoğunlukla o switch'tedir. Switch'leri çıkarılabilen (hot-swap) modellerde sorunlu switch'i başka bir tuşunkiyle yer değiştirerek arızanın switch'te mi yoksa devrede mi olduğunu anlayabilirsiniz.</p>
<p>Bazı klavyelerde NKRO bir tuş kombinasyonuyla veya üreticinin yazılımından açılır. Ayarı değiştirdikten sonra aynı anda basılan tuş sayacını tekrar kontrol ederek değişikliğin işe yarayıp yaramadığını görebilirsiniz.</p>
<h3>Kablosuz klavyeler</h3>
<p>Bluetooth veya USB alıcılı klavyelerde önce pil seviyesini kontrol edin. Testte kaçan tuşlar alıcıyı klavyeye yaklaştırınca düzeliyorsa sorun bağlantıdadır, tuşlarda değil.</p>

<h2>İkinci el alırken klavye testi</h2>
<p>İkinci el laptop veya klavye alırken klavye testini tuş tuş yapın: Satıcının yanında tüm satırları tarayın, Türkçe karakterleri ve ok tuşlarını mutlaka deneyin. Aynı sırada ekranı <a href="{tool:olu-piksel-testi}">ölü piksel testi</a> ile, touchpad ya da fareyi <a href="{tool:mouse-testi}">mouse testi</a> ile, dahili mikrofonu da <a href="{tool:mikrofon-testi}">mikrofon testi</a> ile kontrol etmek yalnızca birkaç dakika sürer. Kontrol listesinin tamamını <a href="{post:ikinci-el-laptop-kontrol}">ikinci el laptop alırken yapılması gereken testler</a> yazımızda bulabilirsiniz.</p>

<h2>Gizlilik: tuş vuruşlarınız kaydedilmez</h2>
<p>Klavye testi tamamen tarayıcınızda çalışır. Bastığınız tuşlar hiçbir sunucuya gönderilmez ve hiçbir yerde saklanmaz. Yine de alışkanlık olarak test sırasında şifre gibi kişisel bilgiler yazmamanızı öneririz.</p>

<h2>Diğer donanım testleri</h2>
<p>Görüntülü görüşmeden önce <a href="{tool:kamera-testi}">kamera testi</a> ile görüntünüzü, <a href="{tool:hoparlor-testi}">hoparlör testi</a> ile sağ ve sol ses kanallarını kontrol edebilirsiniz. Tüm araçlar ücretsizdir, kayıt gerektirmez ve aynı gizlilik ilkesiyle çalışır.</p>
HTML
	,
	'faqs'        => array(
		array( 'q' => 'Klavye testi nasıl yapılır?', 'a' => 'Sayfayı açın, klavyenizin dizilimine göre Türkçe Q veya Türkçe F düzenini seçin ve tuşlara tek tek basın. Algılanan tuşlar yeşile döner, hiç renk almayan tuşlar sinyal göndermiyor olabilir. Testi baştan almak için Sıfırla düğmesini kullanabilirsiniz.' ),
		array( 'q' => 'Fn tuşu neden testte görünmüyor?', 'a' => 'Fn tuşu laptopun klavye denetleyicisinde donanımsal olarak işlenir ve tarayıcıya hiçbir zaman ayrı bir tuş olarak ulaşmaz. Bu nedenle hiçbir online klavye testi Fn tuşunu algılayamaz. Fn ile çalışan ses veya parlaklık kısayolları çalışıyorsa tuş sağlamdır.' ),
		array( 'q' => 'Türkçe F klavye testi yapabilir miyim?', 'a' => 'Evet. Düzen düğmesiyle Türkçe F dizilimine geçtiğinizde ekrandaki klavyenin etiketleri F düzenine göre değişir. Böylece bastığınız tuş ekranda doğru yerde yanar ve Ğ, Ş, İ gibi Türkçe karakterleri kolayca kontrol edersiniz.' ),
		array( 'q' => 'Aynı anda basılan tuş sayısı kaç olmalı?', 'a' => 'Günlük yazı için iki veya üç tuş yeterlidir. Oyunlarda ise birden fazla tuşa aynı anda basıldığı için en az altı tuşu algılayan bir klavye daha rahat bir deneyim sunar. NKRO destekli klavyeler basılan tüm tuşları ayrı ayrı iletebilir.' ),
		array( 'q' => 'Tuş testte doğru görünüyor ama yazarken farklı karakter çıkıyor, neden?', 'a' => 'Bu durumda donanım büyük ihtimalle sağlamdır ve sorun işletim sistemindeki klavye düzenidir. Windows 11 için Ayarlar > Zaman ve dil > Dil ve bölge, macOS için Sistem Ayarları > Klavye > Metin Girişi bölümünden doğru Türkçe Q veya F düzenini seçin.' ),
		array( 'q' => 'Klavye testi tuş vuruşlarımı kaydediyor mu?', 'a' => 'Hayır. Test tamamen tarayıcınızda çalışır, bastığınız tuşlar hiçbir sunucuya gönderilmez ve saklanmaz. Yine de test sırasında şifre gibi kişisel bilgiler yazmamanızı öneririz.' ),
		array( 'q' => 'Mekanik ve kablosuz klavyelerle çalışır mı?', 'a' => 'Evet. Test, laptop klavyeleri, masaüstü klavyeler, mekanik klavyeler ve Bluetooth ya da USB alıcılı kablosuz klavyelerle aynı şekilde çalışır. Kablosuz klavyede tuşlar kaçıyorsa önce pili ve alıcının konumunu kontrol edin.' ),
	),
);
