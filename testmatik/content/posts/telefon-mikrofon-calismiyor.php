<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'Telefon Mikrofonu Çalışmıyor? iPhone ve Android Çözümleri',
	'seo_title'   => 'Telefon Mikrofon Çalışmıyor: iPhone ve Android | Testmatik',
	'description' => 'Telefon mikrofon çalışmıyor mu? iPhone ve Android için izinleri, Bluetooth yönlendirmesini ve temizliği kontrol edin; WhatsApp sorunlarını adım adım çözün.',
	'keywords'    => array( 'telefon mikrofon çalışmıyor', 'iphone mikrofon çalışmıyor', 'samsung mikrofon testi', 'whatsapp mikrofon çalışmıyor', 'telefon mikrofon testi' ),
	'intro'       => 'Karşı taraf sizi duymuyor, sesli mesajlar boş mu kaydediliyor? Telefon mikrofonu sorunlarının çoğu izin, Bluetooth veya kir kaynaklıdır ve birkaç dakikada çözülebilir.',
	'excerpt'     => 'iPhone veya Android telefonunuzda mikrofon çalışmıyorsa izinleri, Bluetooth bağlantısını ve mikrofon deliklerini kontrol edin. Adım adım test ve çözüm yollarını anlatıyoruz.',
	'category'    => 'Ses',
	'tool'        => 'mikrofon-testi',
	'date'        => '2026-10-29 06:00:00',
	'html'        => <<<'HTML'
<h2>Telefon mikrofonu neden çalışmaz?</h2>
<p>Telefonda mikrofon sorunu genellikle iki şekilde ortaya çıkar: ya hiçbir uygulamada ses alınmaz ya da yalnızca belirli bir uygulamada, örneğin WhatsApp'ta veya bir oyunda sorun yaşanır. Bu ayrım, nedeni bulmak için en önemli ipucudur. Tüm uygulamaları etkileyen bir sorun donanıma veya sistem ayarına, tek bir uygulamayı etkileyen sorun ise çoğu zaman izinlere işaret eder.</p>
<p>Modern telefonların çoğunda birden fazla mikrofon bulunur. Genellikle biri alt kenarda, biri üstte veya kulaklık hoparlörünün yakınında, biri de arka kamera çevresindedir. Telefon görüşmeleri, video kaydı ve gürültü engelleme bu mikrofonları farklı kombinasyonlarla kullanır. Bu yüzden bir mikrofon arızalıyken diğer işlevler normal çalışmaya devam edebilir.</p>

<h2>Belirtilere göre olası nedenler</h2>
<table>
<thead>
<tr><th>Belirti</th><th>Olası neden</th><th>İlk yapılacak</th></tr>
</thead>
<tbody>
<tr><td>Yalnızca bir uygulamada ses yok</td><td>Uygulamanın mikrofon izni kapalı</td><td>Uygulama izinlerini açın</td></tr>
<tr><td>Görüşmede karşı taraf duymuyor</td><td>Ses Bluetooth cihaza yönleniyor</td><td>Bluetooth'u kapatıp deneyin</td></tr>
<tr><td>Ses çok kısık veya boğuk</td><td>Mikrofon deliği tıkalı, kılıf kapatıyor</td><td>Kılıfı çıkarın, delikleri temizleyin</td></tr>
<tr><td>Video kaydında ses var, görüşmede yok</td><td>Alt mikrofon arızalı olabilir</td><td>Kayıt testiyle mikrofonları karşılaştırın</td></tr>
<tr><td>Hiçbir yerde ses yok</td><td>Yazılım hatası veya donanım arızası</td><td>Yeniden başlatın, güncelleyin, servise başvurun</td></tr>
</tbody>
</table>

<h2>Telefon mikrofon testi nasıl yapılır?</h2>
<p>Çözüme geçmeden önce mikrofonun gerçekten ses alıp almadığını görmek işinizi kolaylaştırır. <a href="{tool:mikrofon-testi}">Telefon mikrofon testi</a> aracı, telefonunuzun tarayıcısında çalışır ve uygulama yüklemenizi gerektirmez.</p>
<ol class="tm-steps">
<li>Testi telefonunuzdaki tarayıcıda açın. Android'de Chrome, iPhone'da Safari sorunsuz çalışır.</li>
<li>Tarayıcı mikrofon izni istediğinde <strong>İzin ver</strong> seçeneğine dokunun.</li>
<li>Normal ses tonuyla konuşun ve canlı seviye göstergesinin, dalga formunun ve tepe seviyesinin hareket edip etmediğine bakın.</li>
<li><strong>5 saniye kaydet</strong> düğmesine basın, birkaç cümle söyleyin ve kaydı dinleyin.</li>
<li>Sesiniz cızırtılı, boğuk veya çok uzaktan geliyorsa bir sonraki bölümdeki temizlik adımlarına geçin.</li>
</ol>
<p>Test ayrıca kullanılan cihazın adını, örnekleme hızını ve kanal sayısını gösterir. Bluetooth kulaklık bağlıysa cihaz adı genellikle kulaklığın adı olur; bu, sesin nereden alındığını anlamanın hızlı bir yoludur.</p>
<div class="tm-callout tm-callout--info">
<p><strong>Bilgi:</strong> Test tamamen tarayıcınızda çalışır. Sesiniz ve yaptığınız 5 saniyelik kayıt hiçbir sunucuya gönderilmez, yalnızca telefonunuzda oynatılır.</p>
</div>

<div class="tm-cta" data-tool="mikrofon-testi"></div>

<h2>iPhone mikrofon çalışmıyor: çözümler</h2>
<h3>Uygulama izinlerini kontrol edin</h3>
<p><strong>Ayarlar &gt; Gizlilik ve Güvenlik &gt; Mikrofon</strong> sayfasını açın. Burada mikrofon erişimi isteyen tüm uygulamalar listelenir. Sorun yaşadığınız uygulamanın yanındaki anahtar kapalıysa açın ve uygulamayı tamamen kapatıp yeniden başlatın.</p>
<p>Tarayıcı üzerinden yaptığınız testte izin penceresi çıkmıyorsa Safari'nin site ayarlarına bakın. Güncel iOS sürümlerinde bu ayar <strong>Ayarlar &gt; Uygulamalar &gt; Safari &gt; Mikrofon</strong> altında, eski sürümlerde <strong>Ayarlar &gt; Safari &gt; Mikrofon</strong> altında bulunur.</p>
<h3>Mikrofonları ayrı ayrı deneyin</h3>
<p>Ses Notları uygulamasında kısa bir kayıt yapın; bu kayıt genellikle alt mikrofonu kullanır. Ardından Kamera uygulamasında önce arka, sonra ön kamerayla kısa birer video çekip dinleyin. Kayıtlardan biri net, diğeri sessiz veya boğuksa sorun büyük olasılıkla belirli bir mikrofondadır.</p>
<h3>Mikrofon modunu kontrol edin</h3>
<p>Desteklenen iPhone modellerinde görüşme sırasında Denetim Merkezi'nden mikrofon modu seçilebilir. <strong>Ses Yalıtımı</strong> modu arka plan gürültüsünü bastırır, ancak bazı ortamlarda sesinizi de beklenenden kısık iletebilir. Sorun yaşıyorsanız <strong>Standart</strong> modu deneyin.</p>

<h2>Android ve Samsung mikrofon testi ve çözümleri</h2>
<h3>Mikrofon erişimi ve uygulama izinleri</h3>
<p>Android 12 ve sonraki sürümlerde hızlı ayarlar panelinde tüm uygulamaların mikrofon erişimini tek dokunuşla kapatan bir <strong>Mikrofon erişimi</strong> düğmesi bulunur. Bu düğme kapalıysa hiçbir uygulama ses alamaz. Hızlı ayarlar panelini aşağı çekip düğmenin açık olduğunu kontrol edin.</p>
<p>Tek bir uygulamada sorun varsa <strong>Ayarlar &gt; Uygulamalar</strong> bölümünde ilgili uygulamayı seçin, <strong>İzinler &gt; Mikrofon</strong> yolunu izleyin ve izni verin. Menü adları üreticiye ve Android sürümüne göre biraz farklılık gösterebilir. Chrome'daki testte sorun varsa Chrome'un <strong>Ayarlar &gt; Site ayarları &gt; Mikrofon</strong> bölümünü kontrol edin.</p>
<h3>Samsung Members ile tanılama</h3>
<p>Samsung telefonlarda önceden yüklü gelen Samsung Members uygulamasında, birçok modelde mikrofon dahil donanım bileşenlerini kontrol eden bir telefon tanılama bölümü bulunur. Bu tanılama, Samsung mikrofon testi için resmi ve pratik bir yoldur. Sonucu tarayıcıdaki testle karşılaştırarak sorunun donanımda mı yoksa bir uygulamada mı olduğunu daha net görebilirsiniz.</p>
<h3>Güvenli modda deneyin</h3>
<p>Android'de güvenli mod, üçüncü taraf uygulamaları geçici olarak devre dışı bırakır. Güvenli modda mikrofon düzgün çalışıyorsa sonradan yüklediğiniz bir uygulama, örneğin bir ses kaydedici veya arama kayıt uygulaması, mikrofonu meşgul ediyor olabilir. Güvenli moda giriş yöntemi modele göre değişir; çoğu cihazda güç menüsündeki <strong>Kapat</strong> seçeneğine uzun basmak yeterlidir.</p>

<h2>WhatsApp mikrofon çalışmıyor</h2>
<p>WhatsApp'ta sesli mesaj kaydedilmiyor veya sesli aramada karşı taraf sizi duymuyorsa önce uygulamanın mikrofon izni olduğundan emin olun. iPhone'da <strong>Ayarlar</strong> içinde WhatsApp'ı bulup Mikrofon anahtarını açın; Android'de yukarıda anlattığımız uygulama izinleri yolunu kullanın.</p>
<p>İzin açıksa ama sorun sürüyorsa WhatsApp'ı en güncel sürüme güncelleyin, telefonu yeniden başlatın ve aynı anda mikrofon kullanan başka bir uygulamanın açık olmadığını kontrol edin. Aynı sorun diğer uygulamalarda da varsa sorun WhatsApp'a özgü değildir.</p>

<h2>Bluetooth, kılıf ve temizlik</h2>
<ul>
<li><strong>Bluetooth yönlendirmesi:</strong> Kulaklık, araç kiti veya akıllı saat bağlıysa görüşmeler o cihazın mikrofonunu kullanabilir. Bluetooth'u geçici olarak kapatıp yeniden deneyin.</li>
<li><strong>Kılıf ve ekran koruyucu:</strong> Kalın veya uyumsuz bir kılıf alt mikrofon deliğini, bazı ekran koruyucular üst mikrofonu kapatabilir. Kılıfı çıkarıp testi tekrarlayın.</li>
<li><strong>Temizlik:</strong> Mikrofon deliklerini kuru ve yumuşak bir diş fırçasıyla nazikçe fırçalayın.</li>
<li><strong>Güncelleme:</strong> iOS veya Android güncellemeleri ses yazılımındaki hataları da düzeltebilir.</li>
</ul>
<div class="tm-callout tm-callout--warn">
<p><strong>Uyarı:</strong> Mikrofon deliklerine iğne, kürdan veya benzeri sivri cisimler sokmayın. Deliklerin arkasında su ve toza karşı koruma sağlayan ince bir zar bulunabilir ve bu zar kolayca delinir.</p>
</div>

<h2>Yalnızca görüşmelerde sorun varsa</h2>
<p>Kayıtlarda sesiniz net çıkıyor ama telefon görüşmelerinde karşı taraf sizi duymuyorsa sorun her zaman mikrofonda değildir. Önce farklı bir kişiyi arayın ve hoparlör modunu açıp kapatarak deneyin. Hoparlör modunda telefon genellikle farklı bir mikrofon kombinasyonu kullanır; bu yüzden bir modda sorun olup diğerinde olmaması belirli bir mikrofonun arızalı olduğuna işaret edebilir.</p>
<p>Şebeke kaynaklı sorunlar da benzer belirtiler yaratır. Sinyalin zayıf olduğu yerlerde ses kesik kesik iletilir. Mobil veri veya Wi-Fi üzerinden yapılan aramalarda ise internet bağlantısının kalitesi belirleyicidir. Aynı sorunu farklı konumlarda ve farklı uygulamalarla deneyerek karşılaştırın.</p>
<p>Görüşmelerde sesiniz yankılı veya robotik geliyorsa karşı tarafın cihazı da etkili olabilir. Aynı kişiyle başka bir uygulama üzerinden konuşmayı deneyin. Sorun yalnızca belirli bir kişiyle yaşanıyorsa büyük olasılıkla sizin telefonunuzda değildir.</p>
<p>Görüşme sırasında yanlışlıkla sessiz düğmesine dokunmak da sık yaşanan bir durumdur. Arama ekranındaki mikrofon simgesinin üzeri çizili değilse sessize alma kapalıdır. Telefonu kulağınıza tutarken yanağınızın ekrana değmesi de sessize alma düğmesine basılmasına neden olabilir; bu durumda yakınlık sensörünün üzerini kapatan kalın bir ekran koruyucu veya kılıf etkili olabilir.</p>

<h2>Ne zaman servise başvurmalı?</h2>
<p>İzinler, Bluetooth, temizlik ve güncelleme denemelerinden sonra testte hâlâ hiç ses yoksa ya da kayıtlarda sürekli cızırtı varsa sorun büyük olasılıkla donanımsaldır. Telefon suyla temas ettiyse veya düştüyse bu ihtimal daha da artar. Telefonunuz garanti süresindeyse yetkili servise veya satıcıya başvurun ve tarayıcıdaki test sonucunu gösterin.</p>
<p>Servise gitmeden önce önemli verilerinizi yedekleyin. Bazı onarımlarda cihaz sıfırlanabilir. Sorunu tarif ederken hangi uygulamalarda ve hangi durumlarda yaşandığını, hangi adımları denediğinizi not almanız teşhisi hızlandırır.</p>

<h2>İlgili testler ve rehberler</h2>
<p>Kulaklıklı görüşmelerde sorun yaşıyorsanız <a href="{post:kulaklik-mikrofon-calismiyor}">kulaklık mikrofonu çalışmıyor</a> rehberimize, bilgisayarda yaşanan sorunlar için <a href="{post:mikrofon-calismiyor}">Windows 11 mikrofon çalışmıyor</a> yazımıza göz atın. Telefonunuzun hoparlörünü veya kulaklığını kontrol etmek için <a href="{tool:hoparlor-testi}">hoparlör testi</a> ile sağ ve sol kanalı dinleyebilir, <a href="{post:kulaklik-testi-sag-sol}">kulaklık testi</a> rehberimizden yöntemin ayrıntılarını öğrenebilirsiniz. Görüntülü aramalar için <a href="{tool:kamera-testi}">kamera testi</a> ile ön ve arka kamerayı, ekran sorunları için <a href="{post:dokunmatik-ekran-testi}">dokunmatik ekran testi</a> rehberimizi kullanabilirsiniz.</p>
<p>Çözümleri uyguladıktan sonra <a href="{tool:mikrofon-testi}">online mikrofon test</a> aracında 5 saniyelik bir kayıt daha yapın; sesinizi net duyuyorsanız sorun giderilmiş demektir.</p>
HTML
	,
	'faqs'        => array(
		array( 'q' => 'Telefon mikrofonum neden aniden çalışmayı bıraktı?', 'a' => 'En sık nedenler kapalı bir uygulama izni, sesi başka bir cihaza yönlendiren Bluetooth bağlantısı ve tıkanmış mikrofon delikleridir. Önce telefonu yeniden başlatın, Bluetooth\'u kapatın ve kılıfı çıkararak deneyin. Sorun sürerse izinleri kontrol edin.' ),
		array( 'q' => 'iPhone mikrofonunun çalışıp çalışmadığını nasıl anlarım?', 'a' => 'Ses Notları uygulamasında kısa bir kayıt yapın, ardından ön ve arka kamerayla birer video çekip dinleyin. Böylece farklı mikrofonları ayrı ayrı denemiş olursunuz. Tarayıcıdaki mikrofon testiyle de canlı seviyeyi görebilirsiniz.' ),
		array( 'q' => 'Samsung mikrofon testi nasıl yapılır?', 'a' => 'Birçok Samsung modelinde önceden yüklü Samsung Members uygulamasındaki telefon tanılama bölümü mikrofonu test eder. Alternatif olarak tarayıcıda bir mikrofon testi açıp 5 saniyelik kayıt yapabilir ve sesinizi geri dinleyebilirsiniz.' ),
		array( 'q' => 'WhatsApp\'ta sesli mesaj neden kaydedilmiyor?', 'a' => 'Genellikle WhatsApp\'ın mikrofon izni kapalıdır. iPhone\'da Ayarlar içinde WhatsApp\'ı, Android\'de Ayarlar > Uygulamalar > WhatsApp > İzinler yolunu kontrol edin. İzin açıksa uygulamayı güncelleyin ve telefonu yeniden başlatın.' ),
		array( 'q' => 'Mikrofon deliğini nasıl temizlerim?', 'a' => 'Kuru ve yumuşak bir diş fırçasıyla deliği nazikçe fırçalayın. İğne veya kürdan gibi sivri cisimler kullanmayın, çünkü deliğin arkasındaki koruyucu zar zarar görebilir. Sıvı temizleyici de kullanmayın.' ),
		array( 'q' => 'Telefon mikrofon testi sesimi kaydedip saklıyor mu?', 'a' => 'Hayır. Test tamamen tarayıcınızda çalışır ve 5 saniyelik kayıt yalnızca cihazınızda oynatılır. Sesiniz hiçbir sunucuya gönderilmez veya saklanmaz.' ),
	),
);
