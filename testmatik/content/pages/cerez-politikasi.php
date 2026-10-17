<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'Çerez Politikası',
	'seo_title'   => 'Çerez Politikası: Çerez Türleri ve Tercihleriniz | Testmatik',
	'description' => 'Testmatik çerez politikası: zorunlu, analitik ve pazarlama çerezleri, hangi çerezlerin onayınıza bağlı olduğu ve çerez tercihinizi nasıl değiştirebileceğiniz.',
	'keywords'    => array( 'testmatik çerez politikası', 'testmatik çerezler', 'çerez ayarları', 'analitik çerezler', 'pazarlama çerezleri' ),
	'intro'       => 'Bu sayfada Testmatik\'te kullanılabilecek çerezleri, her birinin amacını ve tercihlerinizi istediğiniz zaman nasıl değiştirebileceğinizi açıklıyoruz.',
	'html'        => <<<'HTML'
<h2>Çerez nedir?</h2>
<p>Çerezler, bir web sitesini ziyaret ettiğinizde tarayıcınıza kaydedilen küçük metin dosyalarıdır. Siteler çerezleri; tercihlerinizi hatırlamak, sayfaların düzgün çalışmasını sağlamak, ziyaret istatistiklerini ölçmek ya da reklam göstermek gibi amaçlarla kullanır. Benzer amaçlarla tarayıcının yerel depolama alanı da kullanılabilir; bu politikada bunların hepsini "çerez" olarak anıyoruz.</p>
<p>Bu çerez politikası, testmatik.app adresindeki sitenin hangi çerez kategorilerini kullanabileceğini ve bu konudaki tercihlerinizi nasıl yöneteceğinizi açıklar. Kişisel verilerle ilgili genel bilgiler için <a href="{page:gizlilik-politikasi}">gizlilik politikası</a> sayfamızı okuyabilirsiniz.</p>

<h2>Testler çerez gerektirmez</h2>
<p>Önemli bir noktayı baştan belirtelim: Testmatik'teki donanım testleri çalışmak için çerezlere ihtiyaç duymaz. <a href="{tool:klavye-testi}">Klavye testi</a>, <a href="{tool:mikrofon-testi}">mikrofon testi</a>, <a href="{tool:kamera-testi}">kamera testi</a> ve diğer araçlar tamamen tarayıcınızda çalışır. Tuş basışlarınız, ses kaydınız ve kamera görüntünüz çerezlere yazılmaz, sunucuya gönderilmez ve saklanmaz.</p>
<p>Analitik ve pazarlama çerezlerini reddetseniz bile tüm araçları eksiksiz kullanabilirsiniz.</p>

<h2>Çerez kategorileri</h2>
<p>Sitede kullanılabilecek çerezler üç kategoriye ayrılır. Zorunlu çerezler dışındaki tüm kategoriler yalnızca sizin onayınızla etkinleştirilir.</p>
<table>
<thead>
<tr><th>Kategori</th><th>Amaç</th><th>Onay gerekir mi?</th></tr>
</thead>
<tbody>
<tr><td>Zorunlu</td><td>Çerez tercihinizi hatırlamak ve sitenin temel işleyişini sağlamak</td><td>Hayır</td></tr>
<tr><td>Analitik</td><td>Sitenin nasıl kullanıldığını toplu olarak ölçmek (örneğin Google Analytics)</td><td>Evet</td></tr>
<tr><td>Pazarlama</td><td>Reklam göstermek ve reklamların performansını ölçmek (örneğin Google AdSense)</td><td>Evet</td></tr>
</tbody>
</table>

<h3>Zorunlu çerezler</h3>
<p>Bu çerezler sitenin düzgün çalışması için gereklidir ve kapatılamaz. Testmatik'te bu kategorideki temel kayıt, çerez onay tercihinizi saklar. Böylece siteyi her ziyaretinizde aynı soruyla karşılaşmazsınız ve verdiğiniz karara uygun davranılır.</p>
<p>Zorunlu çerezler sizi tanımlamak, reklam göstermek ya da başka sitelerde takip etmek için kullanılmaz.</p>

<h3>Analitik çerezler</h3>
<p>Testmatik, hangi araçların daha çok kullanıldığını, sayfaların ne kadar hızlı açıldığını ve ziyaretçilerin hangi rehberleri faydalı bulduğunu anlamak için Google Analytics kullanabilir. Bu bilgiler siteyi geliştirmemize yardımcı olur.</p>
<p>Analitik çerezler yalnızca siz "analitik" kategorisine onay verdikten sonra yüklenir. Onay vermezseniz Google Analytics etkinleştirilmez. Bu çerezler ziyaret edilen sayfalar, ziyaret süresi, cihaz ve tarayıcı türü gibi bilgileri toplayabilir; test içeriklerinizi ise kapsamaz.</p>

<h3>Pazarlama çerezleri</h3>
<p>Testmatik, ücretsiz kalabilmek için ileride Google AdSense aracılığıyla reklam gösterebilir. Pazarlama çerezleri, reklamların gösterilmesi, aynı reklamın tekrar tekrar gösterilmesinin sınırlandırılması ve onay vermeniz hâlinde ilgi alanlarınıza uygun reklamlar sunulması için kullanılabilir.</p>
<p>Bu çerezler yalnızca "pazarlama" kategorisine onay vermenizden sonra etkinleştirilir. Bu çerezler kullanıldığında Google, kendi gizlilik politikası ve çerez kuralları çerçevesinde veri işleyebilir.</p>

<h2>Çerezler ne kadar süre saklanır?</h2>
<p>Çerezler, saklanma sürelerine göre ikiye ayrılır. Oturum çerezleri tarayıcınızı kapattığınızda silinir. Kalıcı çerezler ise belirlenen süre dolana ya da siz onları silene kadar cihazınızda kalır.</p>
<p>Çerez tercihinizi saklayan zorunlu kayıt kalıcıdır; böylece kararınız sonraki ziyaretlerinizde de hatırlanır. Analitik ve pazarlama çerezlerinin süreleri, onay vermeniz hâlinde ilgili hizmet sağlayıcısı olan Google'ın belirlediği sürelere tabidir. Hangi çerezlerin kayıtlı olduğunu ve ne zaman sona ereceklerini tarayıcınızın geliştirici araçlarından ya da site verileri bölümünden görebilirsiniz.</p>

<h2>Üçüncü taraf çerezleri</h2>
<p>Analitik ve pazarlama kategorilerindeki çerezler, Testmatik tarafından değil, bu hizmetleri sağlayan üçüncü taraf tarafından yerleştirilir. Bu nedenle bu çerezlerin işleyişi ilgili sağlayıcının kendi politikalarına da tabidir. Testmatik, onayınız olmadan hiçbir üçüncü taraf çerezinin yüklenmemesini hedefler.</p>

<h2>Tercihlerinizi nasıl değiştirebilirsiniz?</h2>
<p>Siteyi ilk ziyaretinizde size çerez tercihleriniz sorulur. Verdiğiniz kararı istediğiniz zaman değiştirebilirsiniz:</p>
<ol class="tm-steps">
<li>Herhangi bir sayfanın en altına, site alt bilgisine (footer) inin.</li>
<li><strong>"Çerez ayarları"</strong> bağlantısına tıklayın.</li>
<li>Açılan pencerede analitik ve pazarlama kategorilerini ayrı ayrı açın veya kapatın.</li>
<li>Seçiminizi kaydedin. Yeni tercihiniz hemen geçerli olur.</li>
</ol>
<p>Onayınızı geri çektiğinizde ilgili hizmetler bundan sonraki ziyaretlerinizde yüklenmez. Daha önce kaydedilmiş çerezleri tamamen kaldırmak için tarayıcınızın çerezlerini de silebilirsiniz.</p>

<h2>Tarayıcı üzerinden çerez yönetimi</h2>
<p>Çerezleri tarayıcı ayarlarınızdan da yönetebilirsiniz. Tüm güncel tarayıcılar, kayıtlı çerezleri görüntüleme, silme ve belirli siteler için engelleme seçenekleri sunar:</p>
<ul>
<li><strong>Chrome:</strong> Ayarlar &gt; Gizlilik ve güvenlik &gt; Üçüncü taraf çerezleri</li>
<li><strong>Edge:</strong> Ayarlar &gt; Çerezler ve site izinleri</li>
<li><strong>Firefox:</strong> Ayarlar &gt; Gizlilik ve Güvenlik &gt; Çerezler ve site verileri</li>
<li><strong>Safari:</strong> Ayarlar &gt; Gizlilik</li>
</ul>
<p>Menü adları tarayıcı sürümüne göre küçük farklılıklar gösterebilir. Tüm çerezleri engellerseniz zorunlu çerez de kaydedilemeyeceği için çerez tercihiniz her ziyarette yeniden sorulabilir.</p>

<h2>Politikadaki değişiklikler</h2>
<p>Sitede kullanılan hizmetler değiştikçe bu çerez politikası güncellenebilir. Örneğin analiz veya reklam hizmetleri devreye alındığında ya da yeni bir hizmet eklendiğinde bu sayfa buna göre düzenlenir. Güncel metin her zaman bu adreste yayınlanır.</p>

<h2>İletişim</h2>
<p>Çerezlerle ilgili sorularınız için <strong>iletisim@testmatik.app</strong> adresine yazabilir veya <a href="{page:iletisim}">iletişim</a> sayfamızı ziyaret edebilirsiniz. Sitenin genel kullanım koşulları için <a href="{page:kullanim-sartlari}">kullanım şartları</a> sayfasına bakabilirsiniz.</p>
HTML
	,
	'faqs'        => array(
		array( 'q' => 'Çerezleri reddedersem testleri kullanabilir miyim?', 'a' => 'Evet. Testmatik\'teki tüm donanım testleri çerez gerektirmez. Analitik ve pazarlama çerezlerini reddetseniz bile tüm araçları eksiksiz kullanabilirsiniz.' ),
		array( 'q' => 'Çerez tercihimi sonradan nasıl değiştiririm?', 'a' => 'Sayfanın en altındaki "Çerez ayarları" bağlantısına tıklayarak analitik ve pazarlama kategorilerini istediğiniz zaman açıp kapatabilirsiniz. Yeni tercihiniz hemen geçerli olur.' ),
	),
);
