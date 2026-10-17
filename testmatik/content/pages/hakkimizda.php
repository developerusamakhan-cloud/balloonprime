<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'Hakkımızda',
	'seo_title'   => 'Hakkımızda: Ücretsiz Online Donanım Testleri | Testmatik',
	'description' => 'Testmatik hakkında: tarayıcıda çalışan ücretsiz online donanım testi araçları, gizlilik yaklaşımımız ve araçları nasıl geliştirdiğimizi buradan öğrenin.',
	'keywords'    => array( 'testmatik hakkında', 'testmatik nedir', 'online donanım testi', 'ücretsiz donanım testi', 'tarayıcıda donanım testi' ),
	'intro'       => 'Testmatik, donanımınızı tarayıcıda hızlı, ücretsiz ve gizliliğe saygılı biçimde test edebilmeniz için hazırlanmış bağımsız bir projedir.',
	'html'        => <<<'HTML'
<h2>Testmatik nedir?</h2>
<p>Testmatik bağımsız bir projedir. Klavyenizi, ekranınızı, mikrofonunuzu, kameranızı, mouse ve hoparlörünüzü program kurmadan, doğrudan tarayıcıdan test edebilmeniz için ücretsiz araçlar sunar. Sitedeki tüm içerik ve araçlar Türkçe hazırlanmıştır.</p>
<p>Fikrin çıkış noktası basit: Bir donanımın çalışıp çalışmadığını öğrenmek için yabancı dilde, reklamla dolu ya da kurulum isteyen araçlarla uğraşmak zorunda kalmamalısınız. Testmatik bu ihtiyaca sade ve anlaşılır bir cevap vermeyi amaçlar.</p>

<h2>Ne sunuyoruz?</h2>
<p>Şu anda sitede altı test aracı bulunuyor:</p>
<ul>
<li><a href="{tool:klavye-testi}">Klavye testi</a>: Türkçe Q ve Türkçe F düzenleriyle tüm tuşları kontrol etmenizi, aynı anda kaç tuşun algılandığını görmenizi sağlar.</li>
<li><a href="{tool:olu-piksel-testi}">Ölü piksel testi</a>: Tam ekran renklerle ölü ve sıkışmış pikselleri bulmanıza, piksel onarıcıyla sıkışmış pikselleri denemenize yardımcı olur.</li>
<li><a href="{tool:mikrofon-testi}">Mikrofon testi</a>: Canlı seviye göstergesi ve 5 saniyelik kayıtla sesinizin nasıl gittiğini dinlemenizi sağlar.</li>
<li><a href="{tool:kamera-testi}">Kamera testi</a>: Kameranızın gerçek çözünürlüğünü, FPS değerini ve görüntü kalitesini gösterir.</li>
<li><a href="{tool:mouse-testi}">Mouse testi</a>: Tuşları, tekerleği, çift tıklama sorununu ve polling rate değerini kontrol eder.</li>
<li><a href="{tool:hoparlor-testi}">Hoparlör testi</a>: Sağ ve sol kanalı, frekans taramasını ve özel tonları dinlemenizi sağlar.</li>
</ul>
<p>Araçların yanında, sık karşılaşılan sorunlar için adım adım çözüm rehberleri de yayınlıyoruz. Örneğin <a href="{post:laptop-klavye-calismiyor}">laptop klavye çalışmıyor</a> ya da <a href="{post:ikinci-el-laptop-kontrol}">ikinci el laptop alırken yapılması gereken testler</a> gibi yazılar, testte gördüğünüz sonucu nasıl yorumlayacağınızı ve sonraki adımı anlatır.</p>

<h2>İlkelerimiz</h2>
<h3>Gizlilik önce gelir</h3>
<p>Testmatik'teki her test sizin tarayıcınızda çalışır. Tuş basışlarınız, mikrofon kayıtlarınız ve kamera görüntünüz hiçbir sunucuya yüklenmez ve saklanmaz. Mikrofon ve kameraya yalnızca siz izin verdiğinizde erişilir. Ayrıntılar <a href="{page:gizlilik-politikasi}">gizlilik politikası</a> sayfasında yer alır.</p>
<h3>Doğru ve dürüst bilgi</h3>
<p>Araçlarımızın neyi ölçebildiğini ve neyi ölçemediğini açıkça yazarız. Örneğin <kbd>Fn</kbd> tuşu ve bazı medya tuşları hiçbir tarayıcı tarafından algılanamaz; bunu gizlemek yerine belirtiriz. Rehberlerimizde uydurma istatistiklere ya da kanıtlanmamış iddialara yer vermeyiz.</p>
<h3>Sadelik</h3>
<p>Bir testi başlatmak için birkaç saniye yeterli olmalı. Bu yüzden araçlarda gereksiz adımlardan, hesap açma zorunluluğundan ve karmaşık menülerden kaçınırız. Sonuçları renkler ve kısa açıklamalarla, teknik bilgisi olmayan birinin de anlayabileceği şekilde gösteririz.</p>
<h3>Ücretsiz erişim</h3>
<p>Tüm testler ücretsizdir ve öyle kalması hedeflenir. Projenin giderlerini karşılamak için ileride reklam gösterilebilir; bu durumda da reklamlar araçların kullanımını engellemeyecek şekilde yerleştirilir ve <a href="{page:cerez-politikasi}">çerez politikası</a> kapsamında onayınıza bağlı olur.</p>

<h2>Araçları nasıl geliştiriyoruz?</h2>
<p>Testmatik araçları, modern tarayıcıların sunduğu standart özellikler üzerine kuruludur. Klavye ve mouse olayları, tam ekran modu, ses çalma ve izinli mikrofon ile kamera erişimi gibi özellikler Chrome, Edge, Firefox ve Safari'nin güncel sürümlerinde desteklenir. Bu sayede ek eklenti ya da program gerekmez.</p>
<p>Her aracı farklı tarayıcılarda ve cihaz türlerinde deneyerek yayınlarız. Laptop, masaüstü bilgisayar ve telefon arasında davranış farkları olduğunda bunu ilgili sayfada açıkça belirtiriz. Örneğin klavye ve mouse testleri telefonda yalnızca fiziksel bir klavye ya da fare bağlıysa anlamlı sonuç verir.</p>
<p>Yeni bir özellik eklerken önce şu soruyu sorarız: Bu, kullanıcının sorununu daha hızlı anlamasına yardımcı olacak mı? Cevap evet değilse o özelliği eklemeyiz.</p>

<h2>Kimler için hazırlıyoruz?</h2>
<p>Testmatik'i ikinci el cihaz alanlar, yeni aldığı cihazı iade süresi dolmadan kontrol etmek isteyenler, oyuncular, uzaktan çalışanlar ve online derse katılan öğrenciler düşünülerek tasarladık. Ortak nokta, hızlı ve güvenilir bir cevaba ihtiyaç duymaları.</p>
<p>Bir teknisyen ya da servis çalışanı da müşterisinin cihazını hızlıca kontrol etmek için araçlarımızı kullanabilir. Testler herhangi bir kurulum gerektirmediği için farklı bilgisayarlarda aynı şekilde çalışır.</p>

<h2>Geri bildiriminiz değerli</h2>
<p>Araçları sürekli geliştirmeye çalışıyoruz. Bir testte hata bulduysanız, bir özelliğin eksik olduğunu düşünüyorsanız ya da bir rehberde yanlış bilgi gördüyseniz bize yazmanızı isteriz. <a href="{page:iletisim}">İletişim</a> sayfasındaki adres üzerinden ulaşabilirsiniz.</p>
<p>Siteyi kullanırken geçerli olan kurallar için <a href="{page:kullanim-sartlari}">kullanım şartları</a> sayfasına göz atabilir, tüm araçlara <a href="{home}">ana sayfadan</a> erişebilirsiniz.</p>
HTML
	,
	'faqs'        => array(),
);
