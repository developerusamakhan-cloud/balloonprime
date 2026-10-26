<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'Laptop Hoparlörü Cızırtı Yapıyor? Nedenleri ve Çözümleri',
	'seo_title'   => 'Laptop Hoparlör Cızırtı: Nedenleri ve Çözümü | Testmatik',
	'description' => 'Laptop hoparlör cızırtı yapıyor mu? Sesin çatallanmasına yol açan ayar, sürücü ve donanım nedenlerini test edin, hoparlörün patlak olup olmadığını öğrenin.',
	'keywords'    => array( 'laptop hoparlör cızırtı', 'hoparlör cızırtı yapıyor', 'laptop ses bozuk geliyor', 'ses çatallanıyor', 'hoparlör patlak mı' ),
	'intro'       => 'Laptopunuzdan gelen ses cızırdıyor, yüksek seste çatallanıyor ya da tıkırtılar duyuyorsanız sorun her zaman bozuk hoparlör değildir. Nedeni birkaç basit testle ayırabilirsiniz.',
	'excerpt'     => 'Laptop hoparlörü cızırtı yapıyorsa nedeni ses ayarı, sürücü, uygulama veya hasarlı hoparlör olabilir. Sorunu nasıl ayıracağınızı ve çözümleri anlatıyoruz.',
	'category'    => 'Ses',
	'tool'        => 'hoparlor-testi',
	'date'        => '2026-11-08 06:00:00',
	'html'        => <<<'HTML'
<h2>Cızırtının türünü belirleyin</h2>
<p>"Laptop ses bozuk geliyor" dediğimizde aslında birbirinden farklı birkaç sesten söz ediyor olabiliriz. Sürekli bir hışırtı, yalnızca yüksek seste ortaya çıkan çatallanma, düzensiz aralıklarla gelen tıkırtı ve pıtırtılar ya da belirli bas notalarında duyulan titreşim farklı nedenlere işaret eder. Laptop hoparlör cızırtı sorununda çözüme ulaşmanın en kısa yolu, önce hangi tür cızırtıyı duyduğunuzu netleştirmektir.</p>
<table>
<thead>
<tr><th>Belirti</th><th>Olası neden</th><th>Çözüm yönü</th></tr>
</thead>
<tbody>
<tr><td>Yalnızca yüksek seste çatallanma</td><td>Aşırı ses seviyesi, ses iyileştirmeleri</td><td>Sesi kısmak, iyileştirmeleri kapatmak</td></tr>
<tr><td>Düzensiz tıkırtı ve pıtırtı</td><td>Sürücü veya sistem gecikmesi</td><td>Sürücü güncellemesi, güç modu</td></tr>
<tr><td>Sadece tek hoparlörde cızırtı</td><td>O hoparlörde fiziksel hasar</td><td>Kanal testi, servis</td></tr>
<tr><td>Belirli bas frekanslarında titreşim</td><td>Gevşek parça veya yırtık membran</td><td>Frekans taraması, servis</td></tr>
<tr><td>Kulaklıkta da aynı bozulma</td><td>Kaynak dosya, uygulama veya sürücü</td><td>Farklı kaynakla denemek</td></tr>
</tbody>
</table>

<h2>Önce kaynağı ayırın: dosya mı, uygulama mı, laptop mu?</h2>
<p>Cızırtı tek bir videoda veya tek bir uygulamada duyuluyorsa sorun büyük olasılıkla kaynaktadır. Düşük kaliteli bir video, internet bağlantısı zayıfken yapılan görüntülü görüşme veya hatalı bir ses dosyası sağlam bir hoparlörden de bozuk ses çıkarır. Aynı sesi farklı bir uygulamada ve farklı bir dosyayla deneyin.</p>
<p>Ardından laptopa bir kulaklık takın. Kulaklıkta ses temizse sorunun hoparlör donanımında olma olasılığı artar. Kulaklıkta da aynı bozulmayı duyuyorsanız sorun yazılımda, sürücüde veya kaynağın kendisindedir. Bu basit ayrım, gereksiz servis masrafından kurtarabilir.</p>
<p>Tarayıcıda çalan seslerde sorun yaşıyorsanız aynı içeriği farklı bir tarayıcıda da açın. Bir tarayıcı eklentisi, ses efekti uygulayan bir uzantı veya çok sayıda açık sekme de ses akışını bozabilir. Sorun yalnızca tek bir tarayıcıda görülüyorsa eklentileri tek tek kapatarak kaynağı bulabilirsiniz; bu durumda hoparlör donanımınız büyük olasılıkla sağlamdır.</p>

<h2>Hoparlör testiyle sorunu tespit edin</h2>
<p>Kontrollü bir test sesi kullanmak, müzik veya videoyla denemekten çok daha güvenilir sonuç verir. Ücretsiz <a href="{tool:hoparlor-testi}">hoparlör testi</a> aracında test tonunu <strong>Sol</strong>, <strong>Sağ</strong> veya <strong>Her iki</strong> kanalda çalabilir, 20 Hz ile 20 kHz arasında bir <strong>frekans taraması</strong> başlatabilir ve istediğiniz frekansta özel bir ton üretebilirsiniz.</p>
<ol class="tm-steps">
<li>Laptopun sesini düşük bir seviyeye getirin ve testteki ses kaydırıcısını da kısık başlatın.</li>
<li>Önce yalnızca <strong>Sol</strong>, sonra yalnızca <strong>Sağ</strong> kanalı çalın. Cızırtı tek tarafta mı, iki tarafta mı, not edin.</li>
<li>Frekans taramasını başlatın ve ekranda gösterilen frekansı izleyin.</li>
<li>Titreşim veya cızırtı belirli bir frekans aralığında ortaya çıkıyorsa o değeri not edin.</li>
<li>Not ettiğiniz frekansı özel ton üreteciyle tekrar çalarak sorunun tekrarlanıp tekrarlanmadığını doğrulayın.</li>
</ol>
<p>Laptop hoparlörleri küçük olduğu için çok düşük frekansları zaten zayıf verir; tarama başında sesin neredeyse hiç duyulmaması normaldir. Önemli olan, iki kanal arasında belirgin bir fark olup olmadığı ve belirli bir frekansta tıkırtı veya vızıltı duyulup duyulmadığıdır.</p>
<div class="tm-callout tm-callout--warn">
<p><strong>Uyarı:</strong> Test tonlarını her zaman düşük seste başlatın, özellikle kulaklık kullanıyorsanız. Saf tonlar müziğe göre daha rahatsız edici olabilir ve yüksek seste kulağınıza zarar verebilir.</p>
</div>

<div class="tm-cta" data-tool="hoparlor-testi"></div>

<h2>Hoparlör patlak mı? Donanım belirtileri</h2>
<p>Hoparlörün içindeki membran yırtıldığında veya bobin yerinden oynadığında ses, seviyeden bağımsız olarak sürekli bozuk gelir. Tipik belirtiler şunlardır:</p>
<ul>
<li>Cızırtı yalnızca bir kanalda ve her kaynakta aynı şekilde duyuluyor.</li>
<li>Ses kısık olsa bile bas notalarda vızıltı veya "kâğıt titremesi" gibi bir ses geliyor.</li>
<li>Frekans taramasında belirli bir aralıkta tıkırtı belirgin biçimde artıyor.</li>
<li>Kulaklık takıldığında ses tamamen temiz.</li>
</ul>
<p>Bazen sorun hoparlörün kendisinde değil, çevresindedir. Hoparlör ızgarasındaki toz, gevşemiş bir kasa vidası veya laptopun altındaki bir nesne de belirli frekanslarda titreşim yapabilir. Laptopu düz ve sert bir yüzeye koyup tekrar deneyin; ızgaraları yumuşak bir fırçayla temizleyin.</p>

<h2>Windows ses ayarlarını düzenleyin</h2>
<p>Donanımda belirgin bir sorun görünmüyorsa Windows 11 ayarlarına geçin:</p>
<ol class="tm-steps">
<li><strong>Ayarlar &gt; Sistem &gt; Ses</strong> sayfasını açın ve çıkış cihazı olarak laptop hoparlörlerini seçin.</li>
<li>Hoparlör cihazına tıklayarak özellikler sayfasına girin.</li>
<li><strong>Ses geliştirmeleri</strong> seçeneğini kapatın ve aynı test sesini tekrar çalın. Bazı iyileştirmeler, özellikle yüksek seste, bozulmaya yol açabilir.</li>
<li><strong>Biçim</strong> açılır listesinden farklı bir örnekleme hızı seçin (örneğin 24 bit, 48000 Hz) ve sonucu karşılaştırın.</li>
<li>Uygulamalardaki ses seviyesini değil, Windows ses seviyesini kontrol edin; birden fazla katmanda ses artırma yapılması bozulmayı artırır.</li>
</ol>
<p>Laptopunuzda üreticinin yüklediği ayrı bir ses uygulaması (ekolayzır, "bas artırma" veya surround efektleri sunan bir yazılım) varsa bu efektleri de geçici olarak kapatın. Küçük laptop hoparlörlerinde aşırı bas artırma, hoparlörün fiziksel sınırını zorlayarak çatallanmaya neden olur.</p>
<div class="tm-callout tm-callout--tip">
<p><strong>İpucu:</strong> Ses seviyesini yüzde 100 yerine yüzde 70-80 civarında tutmak, küçük hoparlörlerde bozulmayı belirgin biçimde azaltır. Daha yüksek ses gerekiyorsa harici bir hoparlör veya kulaklık daha iyi bir seçenektir.</p>
</div>

<h2>Sürücü ve sistem gecikmesi</h2>
<p>Düzensiz aralıklarla gelen pıtırtı ve tıkırtılar genellikle ses verisinin hoparlöre zamanında ulaşamamasından kaynaklanır. Ses sürücüsü, Wi-Fi veya diğer donanım sürücüleri sistemi kısa süreliğine meşgul ettiğinde ses akışında boşluklar oluşur. Bu tür bir sorun hem hoparlörde hem kulaklıkta duyulur.</p>
<ul>
<li><strong>Aygıt Yöneticisi</strong>'nde <strong>Ses, video ve oyun denetleyicileri</strong> bölümündeki ses aygıtına sağ tıklayıp sürücüyü güncelleyin.</li>
<li>Sorun bir güncellemeden sonra başladıysa aynı menüdeki <strong>Özellikler &gt; Sürücü</strong> sekmesinden sürücüyü geri almayı deneyin.</li>
<li>En güncel ses sürücüsünü laptop üreticinizin destek sayfasından indirin; genel sürücüler bazen modelinize özel ayarları içermez.</li>
<li><strong>Ayarlar &gt; Sistem &gt; Güç ve pil</strong> bölümünde güç modunu geçici olarak <strong>En iyi performans</strong> seçeneğine alıp sorunun azalıp azalmadığına bakın.</li>
</ul>

<h2>Bluetooth ve harici bağlantılar</h2>
<p>Bluetooth kulaklık veya hoparlörde duyduğunuz cızırtı genellikle laptop hoparlörüyle ilgili değildir. Uzaklık, arada duvar olması veya aynı anda bir mikrofon kullanılması Bluetooth sesini bozabilir. Bluetooth cihazlarda mikrofon devreye girdiğinde ses kalitesinin belirgin şekilde düşmesi de bilinen bir durumdur. Bu konuyu kulaklık odaklı rehberimizde ayrıca ele alıyoruz.</p>
<p>Laptop şarja takılıyken kulaklık çıkışından gelen bir uğultu duyuyorsanız sorun topraklama veya şarj adaptöründen kaynaklanan elektriksel parazit olabilir. Adaptörü çıkarıp pil ile deneyin; uğultu kayboluyorsa farklı bir prize veya orijinal adaptöre geçmek çoğu zaman yeterli olur.</p>

<h2>Kanal dengesi ve mono ses ayarı</h2>
<p>Bazen bir hoparlör bozuk değil, yalnızca daha kısık çalışıyordur ve bu durum diğer tarafın cızırtısını daha belirgin hâle getirir. Windows 11'de hoparlör özellikleri sayfasındaki <strong>Ses</strong> bölümünde sol ve sağ kanal seviyelerini ayrı ayrı görebilirsiniz. İki değerin aynı olduğundan emin olun.</p>
<p><strong>Ayarlar &gt; Erişilebilirlik &gt; Ses</strong> sayfasındaki <strong>Mono ses</strong> seçeneği açıksa iki kanal tek bir sese birleştirilir. Bu, tek kulağıyla daha iyi duyan kullanıcılar için faydalı bir özelliktir; ancak kanal testi yaparken kapalı olmalıdır, aksi hâlde sol ve sağ tonlar her iki hoparlörden aynı anda gelir ve hangi tarafın bozuk olduğunu ayırt edemezsiniz.</p>

<h2>Sıvı, nem ve darbe sonrası cızırtı</h2>
<p>Laptopa sıvı döküldükten veya cihaz düştükten sonra başlayan cızırtı genellikle donanımsaldır. Hoparlör membranına ulaşan sıvı kuruduğunda kalıntı bırakabilir ve membranın serbestçe titreşmesini engelleyebilir. Darbe ise hoparlörün bağlantısını gevşetebilir veya kasaya temas etmesine yol açabilir.</p>
<p>Böyle bir durumda laptopu kapatıp şarjdan çıkarın ve tamamen kuruduğundan emin olmadan yüksek seste ses çalmayın. Saç kurutma makinesi gibi sıcak hava kaynakları iç parçalara zarar verebileceği için önerilmez. Sorun kurumadan sonra da devam ediyorsa yetkili servise danışın.</p>

<h2>Ne zaman servise gitmeli?</h2>
<p>Sol ve sağ kanal testinde bir taraf her kaynakta bozuk geliyor, kulaklıkta ses temiz kalıyor ve ayarlar sorunu değiştirmiyorsa hoparlör büyük olasılıkla fiziksel olarak hasarlıdır. Laptop hoparlörleri genellikle değiştirilebilir parçalardır, ancak bazı modellerde kasanın önemli bir bölümünü sökmek gerekir. Cihaz garanti kapsamındaysa kendi başınıza açmak yerine yetkili servise başvurun. Türkiye'de tüketicilere satılan ürünlerde yasal garanti süresi en az iki yıldır.</p>

<h2>İlgili testler ve rehberler</h2>
<p>Ses sorunlarını çözerken mikrofonunuzu da kontrol etmek isteyebilirsiniz: <a href="{tool:mikrofon-testi}">mikrofon testi</a> ile kayıt yapıp kendi sesinizi dinleyebilirsiniz. Görüntülü görüşmeler için <a href="{tool:kamera-testi}">kamera testi</a> de işinize yarar. Mikrofonla ilgili sorunlar için <a href="{post:mikrofon-calismiyor}">mikrofon çalışmıyor</a> rehberimize, kullanılmış bir cihaz alacaksanız <a href="{post:ikinci-el-laptop-kontrol}">ikinci el laptop kontrol listemize</a> bakın.</p>
<p>Kulaklıkla ilgili ses dengesizliği yaşıyorsanız <a href="{post:kulaklik-testi-sag-sol}">kulaklık testi: sağ ve sol kanal kontrolü</a> yazımız, kablolu ya da Bluetooth kulaklık mikrofonu sorunları için <a href="{post:kulaklik-mikrofon-calismiyor}">kulaklık mikrofonu çalışmıyor</a> rehberimiz en yakın kaynaktır. Çözümleri uyguladıktan sonra <a href="{tool:hoparlor-testi}">sağ sol ses testi</a> ile her iki kanalı yeniden dinleyin.</p>
HTML
	,
	'faqs'        => array(
		array( 'q' => 'Laptop hoparlörüm neden yüksek seste cızırtı yapıyor?', 'a' => 'Küçük laptop hoparlörleri yüksek seste fiziksel sınırlarına yaklaşır ve ses çatallanabilir. Ses iyileştirmeleri veya bas artırma efektleri bu bozulmayı artırır. Ses geliştirmelerini kapatıp sesi biraz kısarak tekrar deneyin.' ),
		array( 'q' => 'Hoparlörün patlak olduğunu nasıl anlarım?', 'a' => 'Patlak bir hoparlör genellikle tek kanalda, her kaynakta ve düşük seste bile bozuk ses verir. Kulaklık takıldığında ses temizse hoparlör hasarı olasılığı yüksektir. Sol ve sağ kanalı ayrı ayrı çalarak hangi tarafın bozuk olduğunu belirleyebilirsiniz.' ),
		array( 'q' => 'Cızırtı kulaklıkta da varsa sorun nedir?', 'a' => 'Bu durumda sorun hoparlör donanımında değil, kaynak dosyada, uygulamada veya ses sürücüsündedir. Farklı bir dosya ve uygulamayla deneyin, ses sürücüsünü güncelleyin ya da geri alın. Düzensiz pıtırtılar sistem gecikmesine işaret edebilir.' ),
		array( 'q' => 'Frekans taraması neden başta hiç ses vermiyor?', 'a' => 'Laptop hoparlörleri çok küçük olduğu için düşük frekansları zayıf üretir veya hiç üretemez. Tarama yükseldikçe sesin duyulmaya başlaması normaldir. Önemli olan belirli bir frekansta tıkırtı veya titreşim olup olmadığıdır.' ),
		array( 'q' => 'Şarja takınca laptoptan uğultu geliyor, neden?', 'a' => 'Bu genellikle şarj adaptörü veya prizden kaynaklanan elektriksel parazittir ve en çok kulaklık çıkışında duyulur. Adaptörü çıkarıp pil ile deneyin. Uğultu kayboluyorsa farklı bir priz veya orijinal adaptör kullanmak çoğu zaman sorunu çözer.' ),
		array( 'q' => 'Hoparlör testi sesimi veya verilerimi kaydediyor mu?', 'a' => 'Hayır. Test sesleri tarayıcınızda üretilir ve hiçbir veri sunucuya gönderilmez. Araç mikrofon izni de istemez, yalnızca hoparlörünüzden ses çalar.' ),
	),
);
