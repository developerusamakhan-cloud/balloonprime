<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'Dokunmatik Ekran Testi: Telefon ve Tablet Ekranı Nasıl Kontrol Edilir?',
	'seo_title'   => 'Dokunmatik Ekran Testi: Telefon ve Tablet Kontrolü | Testmatik',
	'description' => 'Dokunmatik ekran testi nasıl yapılır? Android ve iPhone\'da ölü bölge, hayalet dokunma ve ölü pikseli yerleşik araçlarla kontrol edip sorunları çözün.',
	'keywords'    => array( 'dokunmatik ekran testi', 'telefon ölü piksel testi', 'ekran dokunma sorunu', 'hayalet dokunma', 'android dokunmatik test kodu' ),
	'intro'       => 'Ekranın bir bölgesi dokunmaya tepki vermiyor ya da telefon kendi kendine bir yerlere basıyorsa birkaç dakikalık bir test sorunu netleştirir. Telefon, tablet ve dokunmatik laptoplar için yöntemler.',
	'excerpt'     => 'Telefon veya tablet ekranında ölü bölge, hayalet dokunma ya da ölü piksel olup olmadığını yerleşik araçlarla nasıl test edeceğinizi ve sorunları nasıl çözeceğinizi anlatıyoruz.',
	'category'    => 'Ekran',
	'tool'        => 'olu-piksel-testi',
	'date'        => '2026-11-04 06:00:00',
	'html'        => <<<'HTML'
<h2>Dokunmatik ekran testi neden önemli?</h2>
<p>Dokunmatik ekran iki ayrı katmandan oluşur: görüntüyü oluşturan panel ve dokunuşları algılayan sensör katmanı (digitizer). Bu yüzden bir ekran kusursuz görünürken bir köşesi dokunmaya tepki vermeyebilir ya da tam tersi, dokunma sorunsuzken panelde ölü pikseller olabilir. Sağlıklı bir kontrol için ikisini ayrı ayrı test etmek gerekir.</p>
<p>Test özellikle ikinci el bir telefon veya tablet alırken, ekran değişiminden sonra ya da telefon düşürüldükten sonra işe yarar. Ekrandaki sorunları erkenden fark etmek, garanti veya iade hakkınızı zamanında kullanmanızı sağlar.</p>
<table>
<thead>
<tr><th>Belirti</th><th>Olası neden</th><th>Ne yapmalı?</th></tr>
</thead>
<tbody>
<tr><td>Belli bir bölge dokunmaya tepki vermiyor</td><td>Digitizer hasarı, ekran koruyucu kabarcığı</td><td>Koruyucuyu kontrol edip sürükleme testi yapmak</td></tr>
<tr><td>Telefon kendi kendine dokunuyor (hayalet dokunma)</td><td>Nem, kir, kalitesiz şarj aleti, çatlak ekran</td><td>Temizlik, şarj aletini değiştirmek, güvenli mod</td></tr>
<tr><td>Dokunuşlar kayıyor veya gecikiyor</td><td>Kalın koruyucu, yazılım sorunu</td><td>Dokunma hassasiyeti ayarı, güncelleme</td></tr>
<tr><td>Ekranda sabit siyah veya renkli nokta</td><td>Ölü veya sıkışmış piksel</td><td>Ölü piksel testi ve piksel onarıcı</td></tr>
</tbody>
</table>

<h2>Önce ekran panelini kontrol edin: ölü piksel testi</h2>
<p>Dokunma testine geçmeden önce görüntünün kendisini kontrol etmek mantıklıdır. Testmatik şu an dokunma girişini ölçmüyor, ancak <a href="{tool:olu-piksel-testi}">telefon ölü piksel testi</a> aracımız telefon ve tabletlerde tarayıcıdan doğrudan çalışır.</p>
<ol class="tm-steps">
<li>Telefonunuzun tarayıcısında testi açın ve "Testi başlat" düğmesine dokunun; ekran tam ekran moduna geçer.</li>
<li>Ekrana dokunarak siyah, beyaz, kırmızı, yeşil, mavi, gri, camgöbeği, macenta ve sarı renkler arasında geçiş yapın.</li>
<li>Her renkte ekranı yakından inceleyin. Siyah zeminde parlayan nokta sıkışmış piksele, beyaz zeminde siyah nokta ölü piksele işaret eder.</li>
<li>İsterseniz "Otomatik" modu açın; renkler her 3 saniyede bir kendiliğinden değişir.</li>
</ol>
<p>Sıkışmış bir piksel bulursanız piksel onarıcıyı deneyebilirsiniz: hızla renk değiştiren küçük kareyi pikselin üzerine sürükleyip 10–30 dakika bırakın. Bu yöntem her zaman sonuç vermez ama denemeye değer. Ayrıntılar için <a href="{post:olu-piksel-nasil-duzeltilir}">ölü piksel nasıl düzeltilir</a> rehberimize bakabilirsiniz.</p>
<div class="tm-callout tm-callout--warn">
<p><strong>Uyarı:</strong> Piksel onarıcı hızlı yanıp sönen renkler kullanır. Işığa duyarlı epilepsiniz varsa bu özelliği kullanmayın.</p>
</div>

<div class="tm-cta" data-tool="olu-piksel-testi"></div>

<h2>Android'de dokunmatik ekran testi</h2>
<h3>Geliştirici seçenekleriyle dokunuşları görün</h3>
<p>Android'in kendi içinde dokunuşları ekranda gösteren iki kullanışlı seçenek vardır ve bu yöntem neredeyse tüm Android telefonlarda çalışır.</p>
<ol class="tm-steps">
<li><strong>Ayarlar &gt; Telefon hakkında</strong> bölümünü açın ve <strong>Yapı numarası</strong> satırına art arda yedi kez dokunun. Samsung telefonlarda bu satır <strong>Telefon hakkında &gt; Yazılım bilgileri</strong> altındadır.</li>
<li>Ekran kilidi şifrenizi girdiğinizde geliştirici seçenekleri etkinleşir. Bu menü genellikle <strong>Ayarlar &gt; Sistem</strong> altında veya ana ayarlar listesinin en altında görünür.</li>
<li><strong>Dokunmaları göster</strong> seçeneğini açın; her dokunuşunuz ekranda küçük bir daireyle gösterilir.</li>
<li><strong>İşaretçi konumu</strong> seçeneğini açın; parmağınızı sürüklediğinizde çizgi oluşur ve ekranın üstünde koordinatlar görünür.</li>
</ol>
<p>Şimdi parmağınızı ekranın bir kenarından diğerine yavaşça, satır satır sürükleyin. Çizginin kesildiği veya kaydığı yerler ölü bölgeye işaret eder. Köşeleri ve klavyenin açıldığı alt bölgeyi özellikle dikkatle deneyin. Testi bitirince iki seçeneği de kapatmayı unutmayın.</p>
<h3>Üreticilerin test menüleri ve kodları</h3>
<p>Bazı üreticiler telefonlara gizli bir donanım test menüsü ekler. Bunlar resmi olarak her modelde garanti edilmez ve yazılım sürümüne göre değişebilir:</p>
<ul>
<li><strong>Samsung:</strong> Birçok modelde telefon uygulamasında <code>*#0*#</code> yazınca bir test menüsü açılır. Buradaki "Touch" bölümü ekranı karelere böler; tüm kareleri parmağınızla doldurduğunuzda test tamamlanır. Birçok yeni Samsung modelinde <strong>Ayarlar &gt; Pil ve cihaz bakımı &gt; Tanılama</strong> bölümünde veya Samsung Members uygulamasında dokunmatik ekran testi de bulunur.</li>
<li><strong>Xiaomi, Redmi ve POCO:</strong> Birçok modelde <code>*#*#6484#*#*</code> kodu, dokunmatik ekran testini de içeren bir donanım test menüsünü açar.</li>
<li><strong>Diğer markalar:</strong> Kodlar markaya ve modele göre değişir. Üreticinin destek uygulamasında veya ayarlarda "tanılama", "cihaz bakımı" gibi bölümlere bakın.</li>
</ul>
<div class="tm-callout tm-callout--info">
<p><strong>Bilgi:</strong> Bilmediğiniz kaynaklardan bulduğunuz kodları denemeyin. Bazı servis kodları ayarları sıfırlayabilir. Yalnızca kendi markanızın resmî destek sayfasında anlatılan yöntemleri kullanın.</p>
</div>

<h2>iPhone ve iPad'de dokunmatik ekran kontrolü</h2>
<p>iPhone ve iPad'de kullanıcıya açık bir gizli test kodu yoktur, ancak birkaç basit yöntemle ekranı rahatça kontrol edebilirsiniz:</p>
<ul>
<li><strong>Simge sürükleme testi:</strong> Ana ekrandaki bir uygulama simgesine basılı tutun, simgeler titremeye başladığında birini ekranın her köşesine ve kenarına yavaşça sürükleyin. Simge bir noktada düşüyorsa orada dokunma sorunu olabilir.</li>
<li><strong>Notlar ile çizim testi:</strong> Notlar uygulamasında yeni bir not açın, çizim aracını seçin ve ekranı yatay ve dikey çizgilerle doldurun. Kesilen çizgiler ölü bölgeyi gösterir.</li>
<li><strong>Dokunma ayarları:</strong> <strong>Ayarlar &gt; Erişilebilirlik &gt; Dokunma</strong> bölümünde dokunma süresi ve hassasiyetle ilgili seçenekleri bulabilirsiniz. Daha önce değiştirilmiş bir ayar, dokunuşların algılanmadığı izlenimi verebilir.</li>
</ul>
<p>Ekran değişimi yapılmış bir iPhone'da <strong>Ayarlar &gt; Genel &gt; Hakkında</strong> bölümünde parça ve servis geçmişine ilişkin bilgiler görünebilir. İkinci el alımda bu bölüme bakmak yararlıdır.</p>

<h2>Hayalet dokunma (ghost touch) nasıl çözülür?</h2>
<p>Hayalet dokunma, siz ekrana dokunmadığınız hâlde uygulamaların açılması, yazı yazılması veya ekranın kaymasıdır. Kesin çözüm nedene bağlıdır; aşağıdaki adımları sırayla deneyin:</p>
<ol class="tm-steps">
<li>Telefonu yeniden başlatın. Geçici bir yazılım hatası tek başına bu belirtiyi oluşturabilir.</li>
<li>Kılıfı ve ekran koruyucuyu çıkarın. Kabarcıklı, çatlak veya kenarı kalkmış koruyucular sık rastlanan bir nedendir.</li>
<li>Ekranı kuru, tüy bırakmayan bir bezle temizleyin. Nemli ellerle veya nemli ortamda dokunma sensörü yanlış algılama yapabilir.</li>
<li>Sorun yalnızca şarj sırasında oluyorsa farklı bir şarj aleti ve kablo deneyin. Kalitesiz şarj aletleri dokunma sensörüne elektriksel parazit yapabilir.</li>
<li>Android'de güvenli modda başlatın. Sorun güvenli modda kayboluyorsa yakın zamanda yüklediğiniz bir uygulama sorumlu olabilir.</li>
<li>İşletim sistemi güncellemelerini yükleyin. Son çare olarak verilerinizi yedekleyip fabrika ayarlarına sıfırlamayı düşünün.</li>
</ol>
<p>Bu adımlardan sonra sorun sürüyorsa, özellikle ekranda çatlak varsa veya telefon düşmüşse sorun büyük olasılıkla donanımsaldır ve yetkili servise başvurmanız gerekir.</p>
<div class="tm-callout tm-callout--tip">
<p><strong>İpucu:</strong> Kalın bir cam koruyucu kullanıyorsanız birçok Samsung modelinde <strong>Ayarlar &gt; Ekran &gt; Dokunma hassasiyeti</strong> seçeneğini açmak, dokunuşların daha iyi algılanmasını sağlar.</p>
</div>

<h2>Ekran değişiminden sonra dikkat edilmesi gerekenler</h2>
<p>Ekranı değiştirilmiş telefonlarda dokunma sorunları daha sık görülür. Yeni panelin kalitesi, montaj sırasında bağlantı kablosunun tam oturup oturmadığı ve ekranın gövdeye düzgün yapıştırılması doğrudan dokunma davranışını etkiler. Bu yüzden servisten cihazı teslim alırken testi orada, servis görevlisinin yanında yapmanız en doğrusudur.</p>
<ul>
<li>Dokunma testini tüm ekran yüzeyinde, özellikle kenarlarda ve köşelerde yapın; montaj kaynaklı sorunlar genellikle kenarlarda başlar.</li>
<li>Ekranı hafifçe bastırdığınızda görüntüde dalgalanma veya dokunma kaybı oluyorsa bunu hemen bildirin.</li>
<li>Ölü piksel testinde beyaz ve gri zeminde renk tonunun tüm ekranda eşit olup olmadığına bakın; kenarlarda ışık sızması veya renk farkı panel kalitesine dair ipucu verir.</li>
<li>Otomatik parlaklık ve yakınlık sensörünün çalıştığını kontrol edin: bir görüşme sırasında telefonu kulağınıza yaklaştırdığınızda ekran kararmalıdır.</li>
</ul>
<p>Sorunları teslim anında fark etmek, sonradan "bu arıza servisten önce de vardı" tartışmasını önler. Bulduklarınızın ekran görüntüsünü veya kısa bir videosunu çekmek de işinizi kolaylaştırır.</p>

<h2>Dokunmatik laptop ve Windows tabletler</h2>
<p>Windows 11 çalıştıran dokunmatik bir laptopta dokunuşlar kayıyorsa Denetim Masası'nda <strong>Tablet PC Ayarları</strong> bölümünü açıp <strong>Kalibre et</strong> seçeneğini kullanabilirsiniz. Ekran hiç tepki vermiyorsa <strong>Aygıt Yöneticisi &gt; İnsan Arabirim Aygıtları</strong> altındaki "HID uyumlu dokunmatik ekran" girdisini devre dışı bırakıp yeniden etkinleştirin ve üreticinin güncel sürücülerini yükleyin.</p>
<p>Dokunmatik laptoplarda ekranla birlikte diğer donanımları da kontrol etmek iyi bir fikirdir. <a href="{tool:klavye-testi}">Online klavye testi</a> ile tüm tuşları, <a href="{tool:mouse-testi}">mouse testi</a> ile touchpad tıklamalarını deneyebilirsiniz. Ekranın yenileme hızını ise <strong>Ayarlar &gt; Sistem &gt; Ekran &gt; Gelişmiş ekran</strong> sayfasından görebilirsiniz; ayrıntılar <a href="{post:monitor-hz-ayarlama}">monitör Hz ayarlama</a> rehberimizde.</p>

<h2>İkinci el alırken kısa kontrol listesi</h2>
<ul>
<li>Ölü piksel testini tüm renklerde, ekran parlaklığı en yüksekteyken yapın.</li>
<li>Dokunma testini köşeler dahil tüm ekranda, sürükleme yöntemiyle tamamlayın.</li>
<li>Klavyeyi açıp her harfe tek tek dokunun; alt bölgedeki ölü alanlar burada ortaya çıkar.</li>
<li>Telefonu birkaç dakika şarja takıp hayalet dokunma olup olmadığını izleyin.</li>
</ul>
<p>Telefonun diğer donanımlarını kontrol etmek için <a href="{post:telefon-mikrofon-calismiyor}">telefon mikrofonu çalışmıyor</a> yazımıza bakabilirsiniz. Bir laptop alıyorsanız tüm adımları içeren <a href="{post:ikinci-el-laptop-kontrol}">ikinci el laptop kontrol listesi</a> rehberimiz de işinizi kolaylaştıracaktır.</p>
HTML
	,
	'faqs'        => array(
		array( 'q' => 'Dokunmatik ekran testi nasıl yapılır?', 'a' => 'Android\'de geliştirici seçeneklerindeki "Dokunmaları göster" ve "İşaretçi konumu" ayarlarını açıp parmağınızı ekranın her yerinde sürükleyin. iPhone\'da bir uygulama simgesini ekranın her köşesine sürükleyebilir veya Notlar\'da çizim yapabilirsiniz. Çizginin kesildiği yerler sorunlu bölgeyi gösterir.' ),
		array( 'q' => 'Android dokunmatik test kodu nedir?', 'a' => 'Kodlar markaya göre değişir. Birçok Samsung modelinde *#0*#, birçok Xiaomi modelinde *#*#6484#*#* bir donanım test menüsü açar. Bu kodlar her modelde çalışmayabilir; bilmediğiniz kaynaklardan bulduğunuz kodları denemekten kaçının.' ),
		array( 'q' => 'Hayalet dokunma neden olur?', 'a' => 'Kabarcıklı veya çatlak ekran koruyucu, ekrandaki nem ve kir, kalitesiz şarj aletlerinin yarattığı parazit, yazılım hataları ve digitizer hasarı en sık nedenlerdir. Önce yeniden başlatma, temizlik ve şarj aleti değişimini deneyin. Sorun sürerse servise başvurun.' ),
		array( 'q' => 'Testmatik dokunmatik ekranı test edebilir mi?', 'a' => 'Testmatik şu an dokunma girişini ölçmüyor. Ekranın görüntü tarafını ise ölü piksel testiyle telefon ve tabletinizin tarayıcısından kontrol edebilirsiniz. Dokunma testi için telefonunuzun yerleşik araçlarını kullanmanızı öneririz.' ),
		array( 'q' => 'Ekran koruyucu dokunmayı etkiler mi?', 'a' => 'Kalın veya kötü yapıştırılmış koruyucular dokunma hassasiyetini düşürebilir ve kabarcıklı bölgelerde dokunuşlar algılanmayabilir. Birçok Samsung modelinde Dokunma hassasiyeti ayarı bu durumu iyileştirir. Sorun sürerse koruyucuyu çıkarıp yeniden test edin.' ),
		array( 'q' => 'Ölü piksel testi telefonda çalışır mı?', 'a' => 'Evet. Ölü piksel testi telefon ve tabletlerin tarayıcısında tam ekran açılır ve renkler ekrana dokunarak değiştirilir. Test cihazınızda çalışır ve hiçbir veri sunucuya gönderilmez.' ),
	),
);
