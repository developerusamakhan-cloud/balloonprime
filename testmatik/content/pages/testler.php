<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'Bilgisayar Testleri',
	'seo_title'   => 'Bilgisayar Testleri: Tüm Online Donanım Testleri | Testmatik',
	'description' => 'Ücretsiz bilgisayar testleri: klavye, klavye hızı, ölü piksel, mikrofon, kamera, mouse ve hoparlör testini tarayıcıda yapın. Program kurmadan, kayıt olmadan.',
	'keywords'    => array( 'bilgisayar testleri', 'bilgisayar test', 'laptop test', 'donanım testi', 'online donanım testi' ),
	'intro'       => 'Bilgisayarınızın, laptopunuzun veya telefonunuzun parçalarını tek tek kontrol edin. Tüm testler tarayıcıda çalışır; program kurmanız, kayıt olmanız gerekmez ve hiçbir veri cihazınızdan çıkmaz.',
	'html'        => <<<'HTML'
<h2>Hangi testi seçmeliyim?</h2>
<p>Yaşadığınız soruna göre doğru testi aşağıdan bulabilirsiniz. Her test birkaç dakika sürer ve sonucu hemen gösterir.</p>
<table>
<thead><tr><th>Sorun</th><th>Kullanılacak test</th></tr></thead>
<tbody>
<tr><td>Bazı tuşlar yazmıyor ya da geç basıyor</td><td><a href="{tool:klavye-testi}">Klavye testi</a></td></tr>
<tr><td>Dakikada kaç kelime yazdığınızı merak ediyorsunuz</td><td><a href="{tool:klavye-hiz-testi}">Klavye hız testi</a></td></tr>
<tr><td>Ekranda parlayan ya da siyah kalan bir nokta var</td><td><a href="{tool:olu-piksel-testi}">Ölü piksel testi</a></td></tr>
<tr><td>Görüşmede karşı taraf sizi duymuyor</td><td><a href="{tool:mikrofon-testi}">Mikrofon testi</a></td></tr>
<tr><td>Kamera siyah ekran veriyor ya da görüntü bulanık</td><td><a href="{tool:kamera-testi}">Kamera testi</a></td></tr>
<tr><td>Fare kendi kendine çift tıklıyor, tekerlek zıplıyor</td><td><a href="{tool:mouse-testi}">Mouse testi</a></td></tr>
<tr><td>Kulaklığın bir tarafı az ses veriyor, hoparlör cızırdıyor</td><td><a href="{tool:hoparlor-testi}">Hoparlör testi</a></td></tr>
</tbody>
</table>

<h2>Bir laptopu baştan sona test etmek için sıra</h2>
<p>Yeni ya da ikinci el bir laptop aldıysanız bütün testleri şu sırayla yapmak yaklaşık 15 dakika sürer:</p>
<ol>
<li><strong>Ekran:</strong> Ölü piksel testiyle siyah, beyaz ve ana renklerde ekranı köşeden köşeye tarayın.</li>
<li><strong>Klavye:</strong> Klavye testinde her tuşa bir kez basın; hâlâ gri kalan tuş varsa not edin.</li>
<li><strong>Dokunmatik yüzey ve fare:</strong> Mouse testinde sol ve sağ tıklamayı, kaydırmayı deneyin.</li>
<li><strong>Kamera ve mikrofon:</strong> Kamera testinde görüntüyü, mikrofon testinde 5 saniyelik kaydı kontrol edin.</li>
<li><strong>Hoparlör:</strong> Sol ve sağ kanalı ayrı ayrı dinleyin, frekans taramasında cızırtı olup olmadığına bakın.</li>
</ol>
<p>Pil sağlığı, portlar ve ısınma gibi tarayıcının ölçemediği konular için <a href="{post:ikinci-el-laptop-kontrol}">ikinci el laptop kontrol listesi</a> adım adım yol gösterir.</p>

<h2>Testler nasıl çalışır?</h2>
<p>Bu testler tarayıcının yerleşik özelliklerini kullanır: klavye ve fare olaylarını dinler, kamera ve mikrofona yalnızca siz izin verdiğinizde erişir, sesleri tarayıcının ses üreteciyle oluşturur. Ses kaydınız, kamera görüntünüz ve tuş vuruşlarınız hiçbir sunucuya gönderilmez. Her test sayfasında "Bu test nasıl ölçüyor?" bölümü, sonucun nasıl hesaplandığını ayrıntılı olarak anlatır.</p>
<p>Testler Windows, macOS ve Linux bilgisayarlarda, Android telefonlarda ve iPhone'da güncel Chrome, Edge, Firefox ve Safari ile çalışır. Kamera ve mikrofon testleri için tarayıcının izin istemesine "İzin ver" demeniz yeterlidir.</p>

<h2>Test sorun gösterirse</h2>
<p>Test bir sorun bulduysa çözüm adımları için rehberlere bakın: <a href="{post:laptop-klavye-calismiyor}">laptop klavye çalışmıyor</a>, <a href="{post:mikrofon-calismiyor}">mikrofon çalışmıyor</a>, <a href="{post:laptop-kamera-calismiyor}">laptop kamera çalışmıyor</a>, <a href="{post:telefonda-kamera-acilmiyor}">telefonda kamera açılmıyor</a> ve <a href="{post:mouse-cift-tiklama-sorunu}">mouse çift tıklama sorunu</a>. Tüm yazıları <a href="{page:rehberler}">rehberler</a> sayfasında bulabilirsiniz.</p>
HTML
	,
	'faqs'        => array(
		array( 'q' => 'Bilgisayar testleri ücretsiz mi?', 'a' => 'Evet. Tüm testler ücretsizdir; kayıt olmanız ya da program kurmanız gerekmez. Testler doğrudan tarayıcınızda çalışır.' ),
		array( 'q' => 'Testler verilerimi kaydediyor mu?', 'a' => 'Hayır. Tuş vuruşları, ses kaydı ve kamera görüntüsü cihazınızda işlenir ve hiçbir sunucuya gönderilmez. Sayfayı kapattığınızda silinir.' ),
		array( 'q' => 'Laptopun tüm donanımını test etmek ne kadar sürer?', 'a' => 'Ekran, klavye, fare, kamera, mikrofon ve hoparlör testlerini sırayla yapmak yaklaşık 15 dakika sürer. Pil sağlığı ve portlar için ayrıca birkaç dakika ayırın.' ),
		array( 'q' => 'Telefonda bu testleri yapabilir miyim?', 'a' => 'Evet. Ölü piksel, kamera, mikrofon ve hoparlör testleri telefonda da çalışır. Klavye ve mouse testleri için fiziksel klavye veya fare bağlamanız gerekir.' ),
		array( 'q' => 'Test bir sorun gösterirse ne yapmalıyım?', 'a' => 'Önce testi başka bir tarayıcıda tekrarlayın. Sonuç aynıysa ilgili rehberdeki adımları uygulayın; sorun sürerse donanım arızası olasılığı yüksektir ve servise başvurmanız gerekir.' ),
	),
);
