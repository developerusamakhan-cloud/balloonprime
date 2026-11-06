<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'iPhone Kamera Açılmıyor veya Siyah Ekran Veriyor? Çözüm Yolları',
	'seo_title'   => 'iPhone Kamera Açılmıyor: Siyah Ekran Çözümü | Testmatik',
	'description' => 'iPhone kamera açılmıyor, siyah ekran veriyor ya da ön kamera çalışmıyor mu? Zorla yeniden başlatma, izinler ve Ekran Süresi ayarını adım adım kontrol edin.',
	'keywords'    => array( 'iphone kamera açılmıyor', 'iphone ön kamera açılmıyor', 'iphone kamera siyah ekran', 'iphone arka kamera açılmıyor', 'iphone kamera titriyor' ),
	'intro'       => 'iPhone kamerası siyah ekranla açılıyor, uygulama hiç açılmıyor ya da yalnızca bir kamera çalışmıyorsa birkaç dakikalık kontrolle sorunun yazılımda mı donanımda mı olduğunu anlayabilirsiniz.',
	'excerpt'     => 'iPhone kamera açılmıyorsa zorla yeniden başlatma, kamera izinleri, Ekran Süresi kısıtlamaları ve iOS güncellemesiyle başlayın. Face ID ile ön kameranın birlikte bozulması donanım işaretidir.',
	'category'    => 'Kamera',
	'tool'        => 'kamera-testi',
	'date'        => '2026-11-06 07:30:00',
	'html'        => <<<'HTML'
<p>iPhone kamera açılmıyor sorunu genellikle siyah ekran olarak görünür: Kamera uygulaması açılır ama vizörde görüntü yoktur, deklanşör çalışmaz ya da kameralar arasında geçiş yaparken uygulama donar. Bazen de yalnızca WhatsApp veya Instagram gibi bir uygulamada kamera açılmaz. Bu sorunların çoğu bir yeniden başlatma ya da izin ayarıyla düzelir. Aşağıdaki adımlar en kolaydan en kapsamlıya doğru sıralanmıştır.</p>
<p>Android telefon kullanıyorsanız <a href="{post:telefonda-kamera-acilmiyor}">telefonda kamera açılmıyor</a> rehberindeki adımlar sizin için daha uygun olacaktır.</p>

<h2>1. Kamera uygulamasını kapatıp yeniden açın</h2>
<p>Ekranın altından yukarı kaydırıp ortada bekleyin, açık uygulamalar görünür. Kamera uygulamasını yukarı iterek tamamen kapatın ve tekrar açın. Ardından ön ve arka kamera arasında birkaç kez geçiş yapın. Bazen yalnızca bir kamera takılı kalır ve geçiş yapmak onu yeniden başlatır.</p>

<h2>2. iPhone'u zorla yeniden başlatın</h2>
<p>Normal kapatıp açmak yetmediğinde zorla yeniden başlatma, arka planda takılı kalan kamera işlemini temizler ve verilerinize dokunmaz. Face ID'li modellerde ve iPhone 8 ile sonrasında sırasıyla şunu yapın: Sesi aç tuşuna basıp bırakın, sesi kıs tuşuna basıp bırakın, ardından yan tuşu Apple logosu görünene kadar basılı tutun.</p>

<h2>3. Kamerayı tarayıcıda test edin</h2>
<p>Kamera uygulaması çalışmıyorsa kameranın kendisinin görüntü verip vermediğini ayrı bir yoldan kontrol etmek, sorunu daraltır. Safari'de <a href="{tool:kamera-testi}">online kamera testi</a> sayfasını açın ve kamera iznine "İzin Ver" deyin. Görüntü geliyorsa kamera donanımı çalışıyordur; sorun Kamera uygulamasında ya da bir ayardadır. Test ayrıca kameranın gerçek çözünürlüğünü ve FPS değerini gösterir.</p>
<p>Safari kamera izni istemiyorsa <strong>Ayarlar &gt; Safari &gt; Kamera</strong> ayarının "Reddet" olmadığından emin olun. iOS 18 ve sonrasında bu ayar <strong>Ayarlar &gt; Uygulamalar &gt; Safari</strong> altında yer alır.</p>

<div class="tm-cta" data-tool="kamera-testi"></div>

<h2>4. Uygulamaların kamera iznini kontrol edin</h2>
<p>Kamera yalnızca belirli bir uygulamada açılmıyorsa izni kapalı olabilir. <strong>Ayarlar &gt; Gizlilik ve Güvenlik &gt; Kamera</strong> yolunu izleyin. Burada kamerayı isteyen tüm uygulamalar listelenir; sorun yaşadığınız uygulamanın anahtarını açın. Uygulama listede hiç görünmüyorsa uygulamayı açıp kamera özelliğini bir kez kullanmayı deneyin, iOS izni o anda sorar.</p>

<h2>5. Ekran Süresi kısıtlamasına bakın</h2>
<p>Kamera uygulamasının simgesi ana ekranda hiç görünmüyorsa ya da kilit ekranındaki kamera kısayolu çalışmıyorsa Ekran Süresi kısıtlaması açık olabilir. <strong>Ayarlar &gt; Ekran Süresi &gt; İçerik ve Gizlilik Kısıtlamaları &gt; İzin Verilen Uygulamalar</strong> bölümüne girin ve <strong>Kamera</strong> anahtarının açık olduğundan emin olun. Bu ayar özellikle çocuklara verilen veya ikinci el alınan telefonlarda açık kalabiliyor.</p>

<h2>6. Lens ve kılıfı kontrol edin</h2>
<p>Siyah ekranın bazen çok basit bir nedeni vardır: Lensin önündeki bir çıkartma, kılıfın kamera açıklığına denk gelmeyen kenarı ya da kamera camına takılan koruyucu. Kılıfı çıkarın, lensi mikrofiber bir bezle silin ve kamerayı yeniden açın.</p>

<h2>7. iOS'u güncelleyin</h2>
<p>Bazı kamera hataları yazılım kaynaklıdır ve Apple bunları güncellemelerle düzeltir. <strong>Ayarlar &gt; Genel &gt; Yazılım Güncelleme</strong> yolundan bekleyen bir güncelleme olup olmadığına bakın. Güncellemeden önce iCloud yedeğinin güncel olduğundan emin olun.</p>

<h2>8. Tüm ayarları sıfırlayın</h2>
<p>Yukarıdaki adımlar işe yaramadıysa, verileri silmeden yalnızca ayarları varsayılana döndüren sıfırlamayı deneyebilirsiniz: <strong>Ayarlar &gt; Genel &gt; iPhone'u Aktar veya Sıfırla &gt; Sıfırla &gt; Tüm Ayarları Sıfırla</strong>. Fotoğraflarınız, uygulamalarınız ve mesajlarınız silinmez; ancak Wi-Fi şifreleri, duvar kâğıdı ve gizlilik ayarları sıfırlanır.</p>

<h2>Ön kamera açılmıyor, Face ID de çalışmıyor</h2>
<p>Face ID'li iPhone'larda ön kamera ile yüz tanıma aynı TrueDepth modülünü kullanır. Ön kamera siyah ekran veriyor ve aynı anda Face ID "kullanılamıyor" uyarısı çıkıyorsa sorun büyük olasılıkla donanımdadır. Telefon düştüyse ya da ekranı yakın zamanda değiştirildiyse bu modülün kablosu zarar görmüş olabilir. Bu durumda yetkili servise başvurmanız gerekir.</p>

<h2>Arka kamera titriyor veya tıkırdıyor</h2>
<p>Arka kamera açıldığında görüntü titriyor, odaklanmıyor ya da kameradan tıkırtı sesi geliyorsa optik görüntü sabitleme parçası zarar görmüş olabilir. Apple, motosiklet motorları gibi yüksek şiddetli titreşimlere uzun süre maruz kalmanın bu sisteme zarar verebileceğini belirtir. iPhone'u motosiklet gidonuna sabitleyerek navigasyon için kullanıyorsanız bu olasılığı göz önünde bulundurun. Bu sorun yazılımla düzelmez, kamera modülünün değişmesi gerekir.</p>

<h2>Ne zaman servise gitmelisiniz?</h2>
<p>Zorla yeniden başlatmadan sonra da hiçbir kamera açılmıyorsa, tarayıcıdaki test de görüntü vermiyorsa ve tüm ayarları sıfırlamak işe yaramadıysa sorun donanımdadır. Garanti kapsamındaysanız Apple Destek uygulamasından ya da yetkili servisten randevu alın. Servise gitmeden önce iCloud veya bilgisayara tam yedek alın.</p>

<h2>İlgili testler ve rehberler</h2>
<p>Görüntülü aramada karşı taraf sizi duymuyorsa <a href="{post:telefon-mikrofon-calismiyor}">telefon mikrofonu çalışmıyor</a> rehberinde iPhone için ayrı adımlar bulunur. Mikrofonunuzu hemen kontrol etmek için <a href="{tool:mikrofon-testi}">mikrofon testi</a> de Safari'de çalışır. Görüntü açılıyor ama kalitesi düşükse <a href="{post:web-kamera-goruntu-kalitesi}">kamera görüntü kalitesini artırma</a> yazısındaki ışık önerileri telefonda da geçerlidir.</p>
HTML
	,
	'faqs'        => array(
		array( 'q' => 'iPhone kamera neden siyah ekran veriyor?', 'a' => 'En sık neden arka planda takılı kalan kamera işlemidir ve zorla yeniden başlatmayla düzelir. Lensi kapatan bir kılıf veya koruyucu, kapalı izinler ya da Ekran Süresi kısıtlaması da siyah ekrana yol açabilir.' ),
		array( 'q' => 'iPhone zorla yeniden başlatma verileri siler mi?', 'a' => 'Hayır. Zorla yeniden başlatma yalnızca telefonu yeniden başlatır; fotoğraflar, uygulamalar ve mesajlar silinmez.' ),
		array( 'q' => 'iPhone ön kamera açılmıyor ama arka kamera çalışıyor, neden?', 'a' => 'Face ID de çalışmıyorsa TrueDepth modülünde donanım sorunu olabilir. Face ID çalışıyorsa önce kılıfı ve ekran koruyucuyu çıkarın, kamera uygulamasını kapatıp açın ve zorla yeniden başlatmayı deneyin.' ),
		array( 'q' => 'Kamera simgesi ana ekrandan kayboldu, ne yapmalıyım?', 'a' => 'Ayarlar > Ekran Süresi > İçerik ve Gizlilik Kısıtlamaları > İzin Verilen Uygulamalar bölümünde Kamera anahtarını açın. Simge kısıtlama kalktığında geri gelir.' ),
		array( 'q' => 'Tüm ayarları sıfırlamak fotoğrafları siler mi?', 'a' => 'Hayır. Tüm Ayarları Sıfırla seçeneği yalnızca ayarları varsayılana döndürür. Fotoğraflar ve uygulamalar yerinde kalır, ancak Wi-Fi şifrelerini yeniden girmeniz gerekir.' ),
		array( 'q' => 'iPhone kameramın çalışıp çalışmadığını nasıl test ederim?', 'a' => 'Safari ile bir online kamera testi açıp izin verin. Görüntü geliyorsa kamera donanımı çalışıyordur ve sorun Kamera uygulamasında veya bir ayardadır.' ),
	),
);
