<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'İletişim',
	'seo_title'   => 'İletişim: Soru, Öneri ve Hata Bildirimi | Testmatik',
	'description' => 'Testmatik iletişim sayfası: online donanım testi araçlarıyla ilgili soru, öneri ve hata bildirimlerinizi iletisim@testmatik.app adresine gönderebilirsiniz.',
	'keywords'    => array( 'testmatik iletişim', 'testmatik e-posta', 'testmatik hata bildirimi', 'testmatik öneri', 'testmatik destek' ),
	'intro'       => 'Sorularınız, önerileriniz ve hata bildirimleriniz için bize e-posta ile ulaşabilirsiniz. Her mesajı okuyoruz.',
	'html'        => <<<'HTML'
<h2>Bize nasıl ulaşabilirsiniz?</h2>
<p>Testmatik ile ilgili tüm sorularınız, önerileriniz ve hata bildirimleriniz için tek iletişim kanalımız e-postadır. Mesajınızı <strong>iletisim@testmatik.app</strong> adresine gönderebilirsiniz.</p>
<p>Testmatik bağımsız bir proje olduğu için yanıt süresi değişebilir. Yine de her mesajı okumaya ve mümkün olan en kısa sürede dönüş yapmaya çalışıyoruz.</p>

<h2>Hangi konularda yazabilirsiniz?</h2>
<ul>
<li>Bir testin yanlış sonuç verdiğini ya da hiç açılmadığını düşünüyorsanız</li>
<li>Bir tuşun, mouse düğmesinin veya cihazın algılanmadığını fark ettiyseniz</li>
<li>Rehberlerimizde eksik ya da hatalı bir bilgi gördüyseniz</li>
<li>Yeni bir araç ya da özellik önermek istiyorsanız</li>
<li>Gizlilik ve çerezlerle ilgili bir sorunuz varsa</li>
</ul>
<p>Donanımınızın kendisiyle ilgili arızalarda, örneğin bir tuşun fiziksel olarak kırılması gibi durumlarda, cihazınızın üreticisine ya da yetkili servise başvurmanız gerekir. Bu tür onarımları biz yapamayız, ancak sorunu doğru tarif etmeniz için testlerimiz yardımcı olabilir.</p>

<h2>Hata bildirirken nelere yer vermelisiniz?</h2>
<p>Bir testin beklendiği gibi çalışmadığını düşünüyorsanız aşağıdaki bilgileri eklemeniz, sorunu bizim tarafımızda yeniden oluşturmamızı ve daha hızlı çözmemizi sağlar:</p>
<ol class="tm-steps">
<li><strong>Hangi test:</strong> Sorunu yaşadığınız aracı yazın; örneğin <a href="{tool:klavye-testi}">klavye testi</a>, <a href="{tool:mikrofon-testi}">mikrofon testi</a> ya da <a href="{tool:kamera-testi}">kamera testi</a>.</li>
<li><strong>Tarayıcı ve sürümü:</strong> Chrome, Edge, Firefox ya da Safari kullandığınızı ve mümkünse sürüm numarasını belirtin. Sürümü genellikle tarayıcının "Hakkında" bölümünde bulabilirsiniz.</li>
<li><strong>Cihaz ve işletim sistemi:</strong> Laptop, masaüstü ya da telefon olduğunu, marka ve modeli, Windows 11, macOS, Android veya iOS gibi işletim sistemini yazın.</li>
<li><strong>Kullandığınız donanım:</strong> Klavye, mouse, mikrofon ya da kamera harici bir cihazsa modelini ve kablolu mu kablosuz mu olduğunu ekleyin.</li>
<li><strong>Ne oldu, ne bekliyordunuz:</strong> Hangi adımda ne gördüğünüzü kısaca anlatın. Ekran görüntüsü eklemek çoğu zaman çok yardımcı olur.</li>
</ol>
<div class="tm-callout tm-callout--warn">
<p><strong>Uyarı:</strong> Lütfen e-postanıza şifre, kimlik numarası ya da benzeri kişisel bilgiler eklemeyin. Hata bildirimi için bunlara ihtiyacımız yoktur.</p>
</div>

<h2>Yazmadan önce</h2>
<p>Sorununuzun cevabı rehberlerimizde olabilir. Mikrofonunuz algılanmıyorsa <a href="{post:mikrofon-calismiyor}">mikrofon çalışmıyor</a>, kameranız açılmıyorsa <a href="{post:laptop-kamera-calismiyor}">laptop kamera çalışmıyor</a> yazısındaki adımları deneyebilirsiniz.</p>
<p>Verilerinizin nasıl işlendiğini merak ediyorsanız <a href="{page:gizlilik-politikasi}">gizlilik politikası</a> sayfasını okuyabilirsiniz. Kısaca: testler tarayıcınızda çalışır ve ses, görüntü ya da tuş basışlarınız sunucuya gönderilmez.</p>

<h2>Öneri ve iş birliği</h2>
<p>Yeni bir test fikriniz, bir rehberde düzeltilmesi gereken bir bilgi ya da sitenin kullanımıyla ilgili bir öneriniz varsa aynı adrese yazabilirsiniz. Konu satırına "Öneri" ya da "Hata" yazmanız, mesajları daha hızlı ayırmamıza yardımcı olur.</p>
HTML
	,
	'faqs'        => array(),
);
