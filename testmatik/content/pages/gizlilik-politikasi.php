<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'Gizlilik Politikası',
	'seo_title'   => 'Gizlilik Politikası: Verileriniz Cihazınızda Kalır | Testmatik',
	'description' => 'Testmatik gizlilik politikası: testler tarayıcınızda çalışır, ses, görüntü ve tuş basışları sunucuya gönderilmez. Çerezler, KVKK ve GDPR haklarınız burada.',
	'keywords'    => array( 'testmatik gizlilik politikası', 'testmatik kvkk', 'testmatik gdpr', 'online test gizlilik', 'testmatik kişisel veriler' ),
	'intro'       => 'Testmatik\'teki testler tamamen tarayıcınızda çalışır. Bu sayfada hangi verilerin işlenebileceğini, hangilerinin asla cihazınızdan çıkmadığını ve haklarınızı açıklıyoruz.',
	'html'        => <<<'HTML'
<h2>Kısaca</h2>
<p>Testmatik bağımsız bir projedir ve gizliliğinize saygıyı temel ilke olarak kabul eder. Sitedeki tüm donanım testleri sizin tarayıcınızda çalışır. Mikrofon kaydınız, kamera görüntünüz ve bastığınız tuşlar hiçbir sunucuya gönderilmez ve hiçbir yerde saklanmaz.</p>
<p>Bu gizlilik politikası, testmatik.app adresindeki siteyi kullanırken hangi bilgilerin işlenebileceğini, bunların hangi amaçla kullanılabileceğini ve sahip olduğunuz hakları açıklar.</p>

<h2>Testler sırasında veriler cihazınızda kalır</h2>
<p>Testmatik araçları, modern tarayıcıların standart özelliklerini kullanarak doğrudan sizin cihazınızda çalışır. Her araç için durum şöyledir:</p>
<ul>
<li><strong><a href="{tool:klavye-testi}">Klavye testi</a>:</strong> Bastığınız tuşlar yalnızca ekranda işaretlenmek ve sayılmak için tarayıcı içinde işlenir. Tuş basışları kaydedilmez ve hiçbir yere gönderilmez.</li>
<li><strong><a href="{tool:mikrofon-testi}">Mikrofon testi</a>:</strong> Ses yalnızca seviye göstergesi ve dalga formu için tarayıcıda işlenir. "5 saniye kaydet" ile aldığınız kayıt sadece o sekmenin belleğinde tutulur ve sayfayı kapattığınızda silinir.</li>
<li><strong><a href="{tool:kamera-testi}">Kamera testi</a>:</strong> Görüntü yalnızca ekranınızdaki önizlemede gösterilir. "Fotoğraf çek" ile alınan görüntü sunucuya gitmez, doğrudan cihazınıza PNG dosyası olarak kaydedilir.</li>
<li><strong><a href="{tool:mouse-testi}">Mouse testi</a>, <a href="{tool:olu-piksel-testi}">ölü piksel testi</a> ve <a href="{tool:hoparlor-testi}">hoparlör testi</a>:</strong> Bu araçlar kişisel veri toplamaz; tıklama sayıları ve ayarlar yalnızca sayfa açıkken tarayıcınızda tutulur.</li>
</ul>
<p>Mikrofon ve kameraya erişim için tarayıcınız sizden açıkça izin ister. İzin vermediğiniz sürece site bu cihazlara erişemez. Verdiğiniz izni istediğiniz zaman tarayıcınızın site ayarlarından geri alabilirsiniz.</p>

<h2>İşlenebilecek bilgiler</h2>
<h3>Teknik kayıtlar</h3>
<p>Her web sitesinde olduğu gibi, siteye eriştiğinizde barındırma altyapısı güvenlik ve hizmetin sürekliliği amacıyla standart sunucu kayıtları tutabilir. Bu kayıtlar IP adresi, tarayıcı türü, ziyaret edilen sayfa ve erişim zamanı gibi teknik bilgileri içerebilir. Bu bilgiler testlerin içeriğini kapsamaz.</p>
<h3>Çerez tercihi</h3>
<p>Site, çerez onay tercihinizi hatırlamak için tarayıcınızda bir çerez ya da benzeri bir kayıt kullanabilir. Bu kayıt, her ziyaretinizde aynı soruyu tekrar sormamak için gereklidir.</p>
<h3>Analiz ve reklam</h3>
<p>Testmatik ileride sitenin nasıl kullanıldığını anlamak için Google Analytics, giderlerini karşılamak için ise Google AdSense kullanabilir. Bu hizmetler kullanılmaya başlandığında, ilgili çerezler yalnızca siz onay verdikten sonra etkinleştirilir. Onay vermezseniz araçları yine eksiksiz kullanabilirsiniz.</p>
<p>Bu hizmetler kullanıldığında Google, kendi gizlilik politikası kapsamında cihaz ve kullanım bilgilerini işleyebilir. Ayrıntılar ve tercihlerinizi nasıl değiştireceğiniz için <a href="{page:cerez-politikasi}">çerez politikası</a> sayfasına bakabilirsiniz.</p>
<h3>Bize yazdığınızda</h3>
<p>Bize e-posta gönderdiğinizde e-posta adresiniz ve mesajınızın içeriği, yalnızca size yanıt vermek ve bildirdiğiniz sorunu çözmek amacıyla kullanılır. Bu bilgiler üçüncü kişilerle paylaşılmaz ve pazarlama amacıyla kullanılmaz.</p>

<h2>Bilgilerin kullanım amaçları</h2>
<p>İşlenebilecek sınırlı bilgiler şu amaçlarla kullanılabilir:</p>
<ul>
<li>Sitenin güvenli ve kesintisiz çalışmasını sağlamak</li>
<li>Çerez tercihinizi hatırlamak</li>
<li>Onay vermeniz hâlinde sitenin kullanımını anonim ya da toplu olarak analiz etmek ve reklam göstermek</li>
<li>İletişim taleplerinize yanıt vermek</li>
</ul>
<p>Testmatik kişisel verilerinizi satmaz ve yukarıda belirtilen amaçlar dışında kullanmaz.</p>

<h2>Veri güvenliği</h2>
<p>Site her zaman HTTPS üzerinden, yani şifreli bağlantıyla sunulur. Bu, tarayıcınız ile site arasındaki trafiğin üçüncü kişilerce okunmasını zorlaştırır. Ayrıca tarayıcılar, mikrofon ve kameraya erişimi yalnızca güvenli bağlantı üzerinden açılan sayfalara izin verir. Test verileri sunucuya hiç ulaşmadığı için sunucu tarafında bu verilere ilişkin bir sızıntı riski de oluşmaz.</p>

<h2>Saklama süresi</h2>
<p>Test verileri hiç saklanmadığı için silinmesi gereken bir test kaydı da yoktur. Çerez tercihiniz, tarayıcınızın çerezlerini silene ya da çerezin süresi dolana kadar cihazınızda kalır. E-posta yazışmaları, talebiniz sonuçlandıktan sonra makul bir süre içinde silinir.</p>

<h2>KVKK ve GDPR kapsamındaki haklarınız</h2>
<p>Türkiye'de 6698 sayılı Kişisel Verilerin Korunması Kanunu (KVKK), Avrupa Birliği'nde ise Genel Veri Koruma Tüzüğü (GDPR) kişisel verileriniz üzerinde size çeşitli haklar tanır. Genel olarak şu haklara sahipsiniz:</p>
<ul>
<li>Kişisel verilerinizin işlenip işlenmediğini öğrenme ve işlenmişse bilgi talep etme</li>
<li>Verilerin işlenme amacını ve amacına uygun kullanılıp kullanılmadığını öğrenme</li>
<li>Eksik veya yanlış işlenmiş verilerin düzeltilmesini isteme</li>
<li>Verilerin silinmesini ya da yok edilmesini talep etme</li>
<li>Verdiğiniz onayı istediğiniz zaman geri alma</li>
<li>Verilerin işlenmesine itiraz etme ve ilgili veri koruma otoritesine şikâyette bulunma</li>
</ul>
<p>Bu haklarınızı kullanmak için <strong>iletisim@testmatik.app</strong> adresine yazabilirsiniz. Talebinizi yasal süreler içinde yanıtlamaya özen gösteririz.</p>

<h2>Çocukların gizliliği</h2>
<p>Testmatik herkesin kullanabileceği genel amaçlı bir araçtır ve bilerek çocuklardan kişisel veri toplamaz. Testler herhangi bir kişisel bilgi girmenizi gerektirmez.</p>

<h2>Değişiklikler</h2>
<p>Bu gizlilik politikası, sitedeki hizmetler değiştikçe güncellenebilir. Örneğin analiz ya da reklam hizmetleri devreye alındığında bu sayfa buna göre düzenlenir. Önemli değişiklikleri bu sayfada yayınlarız; siteyi kullanmaya devam etmeden önce sayfayı zaman zaman kontrol etmenizi öneririz.</p>

<h2>İletişim</h2>
<p>Gizlilikle ilgili her türlü soru için <strong>iletisim@testmatik.app</strong> adresine yazabilir ya da <a href="{page:iletisim}">iletişim</a> sayfasını ziyaret edebilirsiniz. Sitenin kullanım koşulları için <a href="{page:kullanim-sartlari}">kullanım şartları</a> sayfasına göz atabilirsiniz.</p>
HTML
	,
	'faqs'        => array(
		array( 'q' => 'Mikrofon testinde sesim kaydediliyor mu?', 'a' => 'Ses yalnızca tarayıcınızda işlenir. 5 saniyelik kayıt sadece o sekmenin belleğinde tutulur, hiçbir sunucuya gönderilmez ve sayfayı kapattığınızda silinir.' ),
		array( 'q' => 'Kamera görüntüm bir yere gönderiliyor mu?', 'a' => 'Hayır. Görüntü yalnızca ekranınızdaki önizlemede gösterilir. Fotoğraf çektiğinizde dosya doğrudan sizin cihazınıza kaydedilir.' ),
	),
);
