<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'Kullanım Şartları',
	'seo_title'   => 'Kullanım Şartları: Site ve Araç Kullanım Koşulları | Testmatik',
	'description' => 'Testmatik kullanım şartları: ücretsiz online donanım testi araçlarının kullanım koşulları, sorumluluk sınırları, güvenlik uyarıları ve fikri haklar hakkında.',
	'keywords'    => array( 'testmatik kullanım şartları', 'testmatik kullanım koşulları', 'testmatik sorumluluk reddi', 'online test kullanım şartları', 'testmatik yasal bilgiler' ),
	'intro'       => 'Testmatik\'i kullanarak aşağıdaki şartları kabul etmiş olursunuz. Lütfen siteyi kullanmadan önce bu sayfayı dikkatlice okuyun.',
	'html'        => <<<'HTML'
<h2>Genel bilgiler</h2>
<p>Bu kullanım şartları, testmatik.app adresinde sunulan web sitesinin ve sitedeki tüm test araçlarının kullanımını düzenler. Testmatik bağımsız bir projedir. Siteye erişerek ya da araçları kullanarak bu şartları okuduğunuzu ve kabul ettiğinizi beyan etmiş olursunuz.</p>
<p>Şartları kabul etmiyorsanız lütfen siteyi kullanmayın. Kişisel verilerin nasıl işlendiğine dair bilgiler ayrı olarak <a href="{page:gizlilik-politikasi}">gizlilik politikası</a> ve <a href="{page:cerez-politikasi}">çerez politikası</a> sayfalarında yer alır.</p>

<h2>Hizmetin kapsamı</h2>
<p>Testmatik; <a href="{tool:klavye-testi}">klavye testi</a>, <a href="{tool:olu-piksel-testi}">ölü piksel testi</a>, <a href="{tool:mikrofon-testi}">mikrofon testi</a>, <a href="{tool:kamera-testi}">kamera testi</a>, <a href="{tool:mouse-testi}">mouse testi</a> ve <a href="{tool:hoparlor-testi}">hoparlör testi</a> gibi ücretsiz, tarayıcı tabanlı araçlar ile donanım sorunlarına yönelik bilgilendirici rehberler sunar.</p>
<p>Araçlar, cihazınızın temel işlevlerini kontrol etmenize yardımcı olmak amacıyla hazırlanmıştır. Profesyonel bir teknik servis incelemesinin, üretici tanılama yazılımlarının ya da laboratuvar ölçümlerinin yerini tutmaz.</p>

<h2>Sonuçların doğruluğu</h2>
<p>Test sonuçları; tarayıcınızın, işletim sisteminizin, sürücülerinizin ve donanımınızın sağladığı bilgilere dayanır. Bu nedenle sonuçlar her zaman kesin bir donanım teşhisi anlamına gelmez. Bazı sınırlamalar araçların doğasından kaynaklanır:</p>
<ul>
<li><kbd>Fn</kbd> tuşu ve bazı medya tuşları donanım düzeyinde işlendiği için hiçbir tarayıcı tarafından algılanamaz.</li>
<li>Mouse testindeki polling rate (Hz) değeri bir tahmindir ve tarayıcının olayları iletme biçiminden etkilenebilir.</li>
<li>Kamera testinde gösterilen çözünürlük, kameranın tarayıcıya sunduğu en iyi değerdir; kameranın teknik belgesindeki değerden farklı olabilir.</li>
<li>Mikrofon testindeki örnekleme hızı ve kanal sayısı, tarayıcının bildirdiği değerlerdir.</li>
</ul>
<p>Bir test sonucuna dayanarak cihaz satın alma, iade ya da onarım gibi kararlar vermeden önce sonucu başka bir tarayıcıda veya cihazda doğrulamanızı öneririz.</p>

<h2>Teknik gereksinimler</h2>
<p>Araçlar; Chrome, Edge, Firefox ve Safari'nin güncel sürümlerinde çalışacak şekilde hazırlanmıştır. Mikrofon ve kamera testleri, tarayıcıların güvenlik kuralları gereği yalnızca HTTPS bağlantısıyla ve sizin izninizle çalışır. Eski bir tarayıcı, kısıtlı bir şirket bilgisayarı ya da engellenmiş izinler nedeniyle bazı özellikler kullanılamayabilir. Bu durumlar Testmatik'in kontrolü dışındadır.</p>

<h2>Güvenlik uyarıları</h2>
<div class="tm-callout tm-callout--warn">
<p><strong>Uyarı:</strong> Ölü piksel testindeki piksel onarıcı ve tam ekran renk geçişleri hızlı yanıp sönen ışıklar içerir. Işığa duyarlı epilepsiniz varsa ya da yanıp sönen ışıklardan rahatsız oluyorsanız bu bölümleri kullanmayın.</p>
</div>
<div class="tm-callout tm-callout--warn">
<p><strong>Uyarı:</strong> Hoparlör testindeki tonları ve frekans taramasını her zaman düşük ses seviyesiyle başlatın, özellikle kulaklık kullanıyorsanız. Yüksek ses seviyesi işitmenize ve hoparlörünüze zarar verebilir.</p>
</div>
<p>Araçları kendi sorumluluğunuzda ve bu uyarılara dikkat ederek kullanmanız gerekir.</p>

<h2>Kullanıcı yükümlülükleri</h2>
<p>Siteyi kullanırken aşağıdaki kurallara uymayı kabul edersiniz:</p>
<ul>
<li>Siteyi yürürlükteki mevzuata aykırı amaçlarla kullanmamak</li>
<li>Sitenin işleyişini bozacak, aşırı yük oluşturacak ya da güvenliğini tehlikeye atacak girişimlerde bulunmamak</li>
<li>Siteye otomatik araçlarla, olağan kullanımı aşan şekilde erişmemek</li>
<li>Başkasına ait cihazları, sahibinin bilgisi ve izni olmadan test etmemek; özellikle başkasının mikrofonuna veya kamerasına izinsiz erişmeye çalışmamak</li>
</ul>

<h2>Fikri mülkiyet</h2>
<p>Sitedeki metinler, rehberler, tasarım ve araçların kodu dahil tüm içerik Testmatik'e aittir ve ilgili mevzuat kapsamında korunur. İçerikleri kişisel ve ticari olmayan amaçlarla okuyabilir, paylaşmak için sayfa bağlantısını kullanabilirsiniz.</p>
<p>İçeriklerin tamamını ya da bir bölümünü izin almadan kopyalamak, başka bir sitede yayınlamak veya ticari amaçla kullanmak yasaktır. Kısa alıntılar, kaynak olarak Testmatik belirtilmek koşuluyla yapılabilir.</p>

<h2>Sorumluluğun sınırlandırılması</h2>
<p>Testmatik, araçları ve içerikleri "olduğu gibi" sunar. Sitenin kesintisiz, hatasız ya da her cihazla tam uyumlu çalışacağına dair bir garanti verilmez. Sitenin kullanımından, test sonuçlarının yorumlanmasından veya rehberlerdeki adımların uygulanmasından doğabilecek doğrudan ya da dolaylı zararlardan, yürürlükteki mevzuatın izin verdiği ölçüde Testmatik sorumlu tutulamaz.</p>
<p>Rehberlerimizde sürücü güncelleme, BIOS ayarı ya da cihazı açma gibi işlemlerden söz edildiğinde, bu işlemleri yapmadan önce önemli verilerinizi yedeklemeniz ve garanti koşullarınızı kontrol etmeniz sizin sorumluluğunuzdadır. Emin olmadığınız durumlarda yetkili servise başvurmanızı öneririz.</p>

<h2>Reklamlar ve üçüncü taraf hizmetler</h2>
<p>Site ileride reklam ve analiz hizmetleri kullanabilir. Bu hizmetler yalnızca onayınız alındıktan sonra etkinleştirilir. Reklamlarda yer alan ürün ve hizmetler ilgili reklamverenlerin sorumluluğundadır; Testmatik bunları onayladığı anlamına gelmez.</p>

<h2>Hizmette değişiklik</h2>
<p>Testmatik, sitedeki araçları ve içerikleri önceden bildirimde bulunmaksızın değiştirme, yeni özellikler ekleme ya da bazı araçları kaldırma hakkını saklı tutar. Hizmet ücretsiz olarak sunulduğundan, belirli bir aracın süresiz olarak erişilebilir kalacağı taahhüt edilmez.</p>

<h2>Şartlarda değişiklik</h2>
<p>Bu kullanım şartları zaman zaman güncellenebilir. Güncel metin her zaman bu sayfada yayınlanır. Değişikliklerden sonra siteyi kullanmaya devam etmeniz, güncellenmiş şartları kabul ettiğiniz anlamına gelir.</p>

<h2>Uygulanacak hukuk</h2>
<p>Bu şartlar Türkiye Cumhuriyeti mevzuatına tabidir. Tüketici olarak sahip olduğunuz ve yürürlükteki mevzuattan doğan haklarınız saklıdır.</p>

<h2>İletişim</h2>
<p>Kullanım şartlarıyla ilgili sorularınız için <strong>iletisim@testmatik.app</strong> adresine yazabilir ya da <a href="{page:iletisim}">iletişim</a> sayfasını kullanabilirsiniz. Tüm araçlara <a href="{home}">ana sayfadan</a> ulaşabilirsiniz.</p>
HTML
	,
	'faqs'        => array(),
);
