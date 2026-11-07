<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'Klavye Hız Testi',
	'seo_title'   => 'Klavye Hız Testi: Dakikada Kaç Kelime? | Testmatik',
	'description' => 'Ücretsiz klavye hız testi: Türkçe kelimelerle 1, 3 veya 5 dakika yazın; net kelime/dakika, vuruş/dakika ve doğruluk oranınızı anında görün. Kayıt yok.',
	'keywords'    => array( 'klavye hız testi', '10 parmak klavye hız testi', 'katiplik klavye testi', 'yazma hızı testi', 'on parmak hız testi' ),
	'intro'       => 'Dakikada kaç kelime yazdığınızı Türkçe kelimelerle ölçün. 1, 3 veya 5 dakikalık süre seçin; net kelime, vuruş sayısı ve doğruluk oranı anında hesaplanır.',
	'html'        => <<<'HTML'
<h2>Klavye hız testi nasıl yapılır?</h2>
<p>Bu klavye hız testi, Türkçe metin yazarken dakikada kaç kelimeyi doğru yazdığınızı ölçer. Ekrana sık kullanılan Türkçe kelimeler gelir; siz kutuya yazdıkça süre işler ve sonuç test biterken hazır olur. Kayıt olmanız ya da bir program kurmanız gerekmez.</p>
<ol>
<li><strong>Süreyi seçin.</strong> Hızlı bir ölçüm için 1 dakika yeterlidir. Daha güvenilir bir sonuç istiyorsanız 3 veya 5 dakikayı seçin; uzun testlerde yorgunluk ve dikkat de hesaba girer.</li>
<li><strong>Yazmaya başlayın.</strong> Kutuya ilk harfi yazdığınız anda sayaç başlar. Sıradaki kelime vurgulanır.</li>
<li><strong>Her kelimeden sonra boşluk tuşuna basın.</strong> Doğru yazılan kelime yeşile, hatalı kelime kırmızıya döner. Yazarken bir harfi yanlış girerseniz kelime hemen kırmızı zemin alır, böylece boşluğa basmadan düzeltebilirsiniz.</li>
<li><strong>Sonucu okuyun.</strong> Süre dolunca net kelime/dakika, vuruş/dakika, doğruluk oranı ve hatalı kelime sayısı gösterilir. En iyi sonucunuz yalnızca bu tarayıcıda saklanır.</li>
</ol>
<p>Test kelimeleri her denemede karışık gelir. Aynı metni ezberleyip hızınızı yapay olarak yükseltmeniz bu yüzden zordur ve sonuç gerçek yazma hızınıza daha yakın olur.</p>

<h2>Sonuçlar ne anlama geliyor?</h2>
<p>Ekrandaki dört değer farklı şeyleri ölçer. Hızınızı başkalarıyla karşılaştırırken hangi değerden söz edildiğine dikkat edin; bir site kelimeyi, bir başkası vuruşu sayabilir.</p>
<table>
<thead><tr><th>Değer</th><th>Nasıl hesaplanır?</th><th>Ne işe yarar?</th></tr></thead>
<tbody>
<tr><td>Net kelime / dk</td><td>Doğru yazılan kelime sayısı, geçen dakikaya bölünür</td><td>Asıl hız ölçüsü. Hatalı kelimeler bu sayıya girmez.</td></tr>
<tr><td>Vuruş / dk</td><td>Doğru kelimelerdeki harfler ve boşluklar, dakikaya bölünür</td><td>Kelime uzunluğundan etkilenmez. Sınavlarda ve kurslarda sık kullanılır.</td></tr>
<tr><td>Doğruluk</td><td>Doğru kelimelerin, yazılan tüm kelimelere oranı</td><td>Hızlı ama özensiz mi yazdığınızı gösterir.</td></tr>
<tr><td>Hatalı kelime</td><td>Boşluğa basıldığında yanlış olan kelimeler</td><td>Hangi alışkanlıkların sizi yavaşlattığını anlamaya yardım eder.</td></tr>
</tbody>
</table>
<p>Türkçe kelimeler İngilizceye göre ortalama olarak daha uzundur. Bu yüzden İngilizce bir sitede ölçtüğünüz kelime/dakika değeri, Türkçe testte biraz daha düşük çıkabilir. Vuruş/dakika değeri bu farktan daha az etkilenir.</p>

<h2>Ortalama yazma hızı kaç olmalı?</h2>
<p>Kesin bir sınır yoktur ama aşağıdaki aralıklar Türkçe metin için kabaca bir fikir verir. Araç da sonucunuzu bu aralıklara göre yorumlar.</p>
<table>
<thead><tr><th>Net kelime / dk</th><th>Seviye</th></tr></thead>
<tbody>
<tr><td>20'nin altı</td><td>Başlangıç. Genellikle klavyeye bakarak, birkaç parmakla yazılır.</td></tr>
<tr><td>20-34</td><td>Ortalama. Günlük yazışmalar ve mesajlar için yeterli.</td></tr>
<tr><td>35-49</td><td>Ortalamanın üzerinde. Çoğunlukla on parmak tekniği kullanılır.</td></tr>
<tr><td>50-69</td><td>Hızlı. Ofis işleri ve yazılı sınav pratiği için güçlü bir seviye.</td></tr>
<tr><td>70 ve üzeri</td><td>Çok hızlı. Bu hıza düzenli ve uzun süreli pratikle ulaşılır.</td></tr>
</tbody>
</table>
<p>Hızdan önce doğruluğa bakın. Yüzde 95'in altında bir doğrulukla yazıyorsanız, hızı artırmaya çalışmak hataları da artırır. Önce hatasız yazmayı, sonra hızlanmayı hedeflemek daha kalıcı sonuç verir.</p>

<h2>10 parmak klavye hız testi için ipuçları</h2>
<p>On parmak yazmayı yeni öğreniyorsanız ilk günlerde hızınızın düşmesi normaldir. Eski alışkanlığınız henüz daha hızlıdır; birkaç hafta düzenli çalıştıktan sonra yeni teknik onu geçer.</p>
<ul>
<li><strong>Parmakları temel sıraya koyun.</strong> Q klavyede sol el A, S, D, F; sağ el J, K, L, Ş tuşlarının üzerinde durur. F ve J tuşlarındaki küçük çıkıntılar, klavyeye bakmadan yerinizi bulmanız için vardır.</li>
<li><strong>Ekrana bakın, klavyeye değil.</strong> Başta yavaşlatır ama asıl hız artışı buradan gelir.</li>
<li><strong>Ritmi koruyun.</strong> Kolay kelimelerde hızlanıp zor kelimelerde durmak yerine her harfe eşit tempo vermeye çalışın.</li>
<li><strong>Kısa ve sık çalışın.</strong> Günde 15-20 dakika, haftada bir uzun çalışmadan daha etkilidir. Bu testi günde birkaç kez 1 dakikalık modda tekrarlamak ilerlemenizi izlemenin kolay bir yoludur.</li>
<li><strong>Türkçe harfleri ayrıca çalışın.</strong> Ğ, Ü, Ş, İ, Ö ve Ç en sık hata yapılan tuşlardır. Test kelimeleri bu harfleri bilinçli olarak içerir.</li>
</ul>
<p>F klavye kullanıyorsanız temel sıra farklıdır. İki düzen arasındaki farkı ve hangisinin size uygun olduğunu <a href="{post:q-klavye-f-klavye-farki}">Q klavye ve F klavye farkı</a> yazısında bulabilirsiniz.</p>

<h2>Yazma hızını artırmak için 4 haftalık plan</h2>
<p>Hızınızı ölçmek kolaydır; artırmak düzen ister. Aşağıdaki plan, günde yaklaşık 20 dakika ayırabilen biri için hazırlandı. Her haftanın başında ve sonunda bu testi 3 dakikalık modda yapıp sonucu bir yere not edin.</p>
<ol>
<li><strong>1. hafta: Temel sıra ve doğruluk.</strong> Sadece temel sıradaki harflerle ve kısa kelimelerle çalışın. Hedef hız değil, klavyeye bakmadan yüzde 95 doğruluğa ulaşmak. Hızınızın geçici olarak düşmesi bu aşamada beklenen bir durumdur.</li>
<li><strong>2. hafta: Üst ve alt sıralar.</strong> Her gün bir sıraya odaklanın. Parmağınızın her tuştan sonra temel sıraya döndüğünden emin olun; bu alışkanlık ilerideki hızın temelidir.</li>
<li><strong>3. hafta: Türkçe harfler ve sık kelimeler.</strong> Ğ, Ş, Ü, İ, Ö ve Ç içeren kelimeleri ayrı çalışın. "bir", "için", "olarak", "daha" gibi sık geçen kelimeleri akıcı yazmak, metin içindeki hızınızı belirgin şekilde artırır.</li>
<li><strong>4. hafta: Süre ve tempo.</strong> 5 dakikalık testlerle dayanıklılığınızı ölçün. İlk dakika ile son dakika arasındaki hız farkı azaldıkça tekniğiniz oturmuş demektir.</li>
</ol>
<p>Dört haftanın sonunda çoğu kişi başlangıç hızını belirgin şekilde geçer. İlerleme durursa bir süre hızı bırakıp yeniden doğruluğa odaklanmak çoğu zaman tıkanıklığı açar.</p>

<h2>Katiplik klavye testi pratiği</h2>
<p>Zabıt katipliği ve benzeri kadrolarda adaylardan genellikle uygulamalı bir klavye sınavı istenir. Sınavın süresi, kullanılacak klavye düzeni ve geçme ölçütü kurumdan kuruma değişir ve sınav ilanında açıkça yazılır. Hazırlanırken önce ilandaki koşulları okuyun, sonra çalışmanızı o koşullara göre düzenleyin.</p>
<p>Bu araçtaki 3 ve 5 dakikalık süreler sınav temposuna alışmak için kullanışlıdır. Sınavlarda çoğu zaman hatalı vuruşlar puandan düşüldüğü için doğruluk oranınızı da takip edin. Sınavda Q mı F mi kullanacağınız belirtilmişse pratiği de aynı düzende yapın; düzen değiştirmek ilk günlerde hızınızı belirgin şekilde düşürür.</p>
<p>Kendi bilgisayarınızda çalışırken bazı tuşlar takılıyor veya basmıyorsa sonuçlarınız da yanıltıcı olur. Teste başlamadan önce <a href="{tool:klavye-testi}">klavye testi</a> ile tüm tuşların sinyal gönderdiğinden emin olun.</p>

<h2>Sonucunuz beklediğinizden düşükse</h2>
<p>Hız bazen teknikten değil, ekipmandan ya da ortamdan düşer. Şunlara bakın:</p>
<ul>
<li><strong>Tuşlar geç algılanıyor veya iki kez yazıyor.</strong> Laptop klavyelerinde kir ve sıvı teması bu soruna yol açabilir. Adım adım çözümler <a href="{post:laptop-klavye-calismiyor}">laptop klavye çalışmıyor</a> rehberinde.</li>
<li><strong>Hızlı yazarken bazı harfler kayboluyor.</strong> Klavyeniz aynı anda basılı kalan tuşları algılayamıyor olabilir. Hızlı yazanlar, bir tuşu bırakmadan diğerine basar. Bu konu <a href="{post:klavye-ghosting-nedir}">klavye ghosting nedir</a> yazısında anlatılıyor.</li>
<li><strong>Yanlış düzen seçili.</strong> Klavyeniz Q iken Windows'ta F düzeni seçiliyse (ya da tersi) harfler farklı çıkar ve tüm kelimeler hatalı sayılır.</li>
<li><strong>Kablosuz klavyede pil zayıf.</strong> Zayıf pil, bağlantıda kısa kopmalara ve harf kaçırmaya neden olabilir.</li>
</ul>

<h2>Telefonda ve tablette çalışır mı?</h2>
<p>Evet. Test telefon ve tablette de açılır, ekran klavyesiyle ya da bağlı bir Bluetooth klavyeyle yazabilirsiniz. Yine de ekran klavyesindeki sonuçlar fiziksel klavyeyle karşılaştırılamaz. Otomatik düzeltme ve kelime önerileri bazı kelimeleri değiştirebileceği için telefonda test yaparken bu özellikleri kapatmanız daha doğru bir sonuç verir.</p>

<h2>Gizlilik</h2>
<p>Klavye hız testi tamamen tarayıcınızda çalışır. Yazdığınız kelimeler hiçbir sunucuya gönderilmez. En iyi sonucunuz yalnızca kendi tarayıcınızın yerel depolamasında tutulur; tarayıcı verilerini temizlediğinizde silinir.</p>

<h2>İlgili testler ve rehberler</h2>
<p>Yazarken tuşların gerçekten çalıştığını <a href="{tool:klavye-testi}">online klavye testi</a> ile, farenizin çift tıklama yapıp yapmadığını <a href="{tool:mouse-testi}">mouse testi</a> ile kontrol edebilirsiniz. Lenovo kullanıyorsanız Fn ve arka ışık sorunları için <a href="{post:lenovo-laptop-klavye-calismiyor}">Lenovo laptop klavye çalışmıyor</a> yazısı işinize yarar. İkinci el bir laptop alacaksanız klavyeyi de içeren tüm kontroller <a href="{post:ikinci-el-laptop-kontrol}">ikinci el laptop alırken yapılması gereken testler</a> listesinde. Ekran, ses, kamera ve fare için diğer araçlar <a href="{page:testler}">tüm testler</a> sayfasında.</p>
HTML
	,
	'faqs'        => array(
		array( 'q' => 'Klavye hız testi nasıl hesaplanır?', 'a' => 'Doğru yazdığınız kelime sayısı geçen süreye bölünür ve dakika başına net kelime olarak gösterilir. Hatalı kelimeler bu sayıya girmez. Vuruş/dakika ise doğru kelimelerdeki harfler ve boşluklar sayılarak hesaplanır.' ),
		array( 'q' => 'Dakikada kaç kelime yazmak iyi sayılır?', 'a' => 'Türkçe metinde dakikada 20-34 net kelime ortalama, 35-49 ortalamanın üzerinde, 50 ve üzeri hızlı kabul edilebilir. Bu aralıklar genel bir fikir verir; doğruluk oranınız da en az hız kadar önemlidir.' ),
		array( 'q' => 'Kelime/dakika ile vuruş/dakika arasındaki fark nedir?', 'a' => 'Kelime/dakika doğru yazılan kelimeleri, vuruş/dakika ise bu kelimelerdeki karakterleri sayar. Uzun kelimeler kelime hızını düşürür ama vuruş hızını etkilemez. Bu yüzden sınavlarda ve kurslarda çoğunlukla vuruş sayısı kullanılır.' ),
		array( 'q' => 'Katiplik sınavına bu testle hazırlanabilir miyim?', 'a' => 'Bu test hız ve doğruluk pratiği için uygundur. Ancak sınavın süresi, klavye düzeni ve geçme ölçütü kuruma göre değişir ve sınav ilanında yazar. İlandaki koşulları okuyup pratiğinizi aynı süre ve düzende yapmanız gerekir.' ),
		array( 'q' => 'Q klavye ile F klavye arasında hız farkı var mı?', 'a' => 'F klavye Türkçedeki harf sıklığına göre tasarlandığı için iyi öğrenildiğinde daha az parmak hareketi gerektirir. Günlük kullanımda ise hızı belirleyen asıl etken, hangi düzende ne kadar pratik yaptığınızdır.' ),
		array( 'q' => 'Test sonuçlarım kaydediliyor mu?', 'a' => 'Hayır. Yazdığınız kelimeler hiçbir yere gönderilmez. Sadece en iyi sonucunuz, bir sonraki denemede karşılaştırabilmeniz için kendi tarayıcınızda saklanır.' ),
		array( 'q' => 'Telefonda klavye hız testi yapabilir miyim?', 'a' => 'Evet, test telefon ve tablette çalışır. Daha doğru bir sonuç için otomatik düzeltme ve kelime önerilerini kapatın. Ekran klavyesiyle alınan sonuç, fiziksel klavyeyle ölçülen hızla doğrudan karşılaştırılmamalıdır.' ),
	),
);
