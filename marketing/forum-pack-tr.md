# Testmatik: Turkish forum answers and free directories

Where to post: Technopat Sosyal, DonanımHaber forum, ShiftDelete.Net forum.

Rules for posting:
- Answer only in threads where the person has exactly this problem. Search the forum for the phrase in the heading.
- Change a sentence or two each time. Never paste the same text in two threads.
- One link per answer, at the point where it helps. Read each forum's rules on links and self-promotion first; if they ask you to say the site is yours, say so.
- 2-3 answers a day is enough. Reply again if the person asks a follow-up; those threads get the most views.

---

## 1. Some laptop keys don't work
**Thread phrases:** "laptop klavye bazı tuşlar çalışmıyor", "klavyede birkaç tuş basmıyor"

Önce sorunun donanımda mı yazılımda mı olduğunu ayırmak lazım. Windows'ta Ayarlar > Erişilebilirlik > Klavye kısmından Filtre Tuşları açık mı bakın, açıksa kapatın. Sonra Aygıt Yöneticisi'nde klavyeyi kaldırıp bilgisayarı yeniden başlatın, sürücü kendisi tekrar yüklenir.

Hâlâ basmayan tuş varsa tarayıcıdan bir tuş testi yapın. Ben şunu kullanıyorum, basılan her tuş yeşile dönüyor, hangi tuşun hiç sinyal göndermediği net görünüyor: https://testmatik.app/klavye-testi/

Test ettiğinizde tuş hiç yanmıyorsa büyük ihtimalle donanımsal. BIOS'a girip orada da tuşların çalışıp çalışmadığına bakarsanız emin olursunuz.

---

## 2. Games miss a key when several are pressed together
**Thread phrases:** "aynı anda 3 tuşa basınca çalışmıyor", "klavye ghosting", "W A Shift birlikte basmıyor"

Bu büyük ihtimalle arıza değil, klavyenin aynı anda algılayabildiği tuş sınırı. Çoğu ofis ve laptop klavyesi belirli kombinasyonlarda 2-3 tuştan sonra yeni tuşu almaz, buna tuş engelleme ya da halk arasında ghosting deniyor.

Kaç tuşu birlikte aldığını görmek için tuşları tek tek basılı tutarak deneyebilirsiniz. Şu testte "aynı anda en çok" diye bir sayaç var: https://testmatik.app/klavye-testi/

Oyunda sorun çıkaran kombinasyon sınırın üstündeyse anti-ghosting ya da NKRO destekli bir klavye çözüm olur. Tek başına basılan bir tuş çalışmıyorsa o zaman durum farklı, o arızadır.

---

## 3. Checking a new monitor for dead pixels
**Thread phrases:** "ölü piksel nasıl kontrol edilir", "yeni monitör ölü piksel testi"

Monitörü tek renk tam ekranla kontrol etmek en kolayı. Siyah, beyaz, kırmızı, yeşil ve mavi zeminlerde ekranı köşeden köşeye yaklaşık yarım metreden tarayın. Siyahta parlayan bir nokta genelde sıkışmış piksel, beyazda siyah kalan nokta ölü piksel olur.

Tarayıcıda tam ekran renk testi için bunu kullanabilirsiniz, program kurmanız gerekmiyor: https://testmatik.app/olu-piksel-testi/

Sorun çıkarsa fotoğrafını çekin ve iade süresi içinde satıcıya bildirin. Sıkışmış piksel bazen hızlı renk değiştiren bir kareyle düzelebiliyor ama ölü piksel genelde düzelmiyor.

---

## 4. Microphone not working on Discord
**Thread phrases:** "discord mikrofon ses gitmiyor", "mikrofonum sesimi almıyor"

Önce sorunun Discord'da mı yoksa mikrofonda mı olduğunu ayıralım. Windows'ta Ayarlar > Gizlilik ve güvenlik > Mikrofon kısmında uygulamaların mikrofona erişimi açık mı bakın. Sonra Ses ayarlarında doğru giriş aygıtının seçili olduğundan emin olun.

Mikrofonun gerçekten ses alıp almadığını görmek için tarayıcıda bir test yapabilirsiniz. Burada canlı ses seviyesi çıkıyor, 5 saniye kaydedip dinleyebiliyorsunuz: https://testmatik.app/mikrofon-testi/

Testte ses varsa sorun Discord ayarındadır: Ses ve Görüntü kısmından giriş cihazını elle seçin ve giriş hassasiyetini otomatikten çıkarıp deneyin.

---

## 5. One side of the headphones is quieter
**Thread phrases:** "kulaklığın bir tarafı az ses veriyor", "sağ kulaklık çalışmıyor"

Önce ayarı eleyin: Windows'ta Ses > Çıkış aygıtı > Özellikler içinde sol ve sağ denge eşit mi bakın. Mono ses seçeneği açıksa da kapatın.

Sonra sol ve sağ kanalı ayrı ayrı dinleyin. Şu sayfada sol, sağ ve iki kanal için ayrı düğmeler var, ayrıca frekans taramasıyla cızırtı olup olmadığını da duyuyorsunuz: https://testmatik.app/hoparlor-testi/

Başka bir cihazda da aynı taraf kısık geliyorsa sorun kulaklıkta. Kablolu kulaklıklarda en sık neden jak ya da kablonun kırıldığı yer oluyor.

---

## 6. Mouse double-clicks by itself
**Thread phrases:** "mouse kendi kendine çift tıklıyor", "tek tıklayınca iki kere tıklıyor"

Bu genelde mouse switch'inin yıpranmasından olur. Önce Windows'ta Denetim Masası > Fare > Çift tıklatma hızı ayarını kontrol edin, çok yavaşa çekiliyse tek tıklar çift sayılabilir.

Sorunun gerçekten switch'te olup olmadığını görmek için bir tıklama testi yapın. Şurada çok kısa aralıkla gelen ikinci tıklamaları ayrıca işaretliyor: https://testmatik.app/mouse-testi/

Rahat tempoda 50 kez tıkladığınızda birkaç tane şüpheli çift tık çıkıyorsa switch değişimi ya da garanti gerekir. Kablosuz mouse'ta pili ve alıcının uzaklığını da kontrol edin.

---

## 7. Laptop camera shows a black screen
**Thread phrases:** "laptop kamera siyah ekran", "kamera açılmıyor"

Birçok laptopta kameranın üstünde küçük bir kapak ya da klavyede kamera kapatma tuşu oluyor, önce onu kontrol edin. Sonra Ayarlar > Gizlilik ve güvenlik > Kamera kısmında erişimin açık olduğuna bakın.

Tarayıcıda kameranın görüntü verip vermediğini ve gerçek çözünürlüğünü şuradan görebilirsiniz: https://testmatik.app/kamera-testi/

Testte de görüntü yoksa Aygıt Yöneticisi'nde Kameralar altında cihaz görünüyor mu bakın. Hiç görünmüyorsa BIOS'ta kamera kapatılmış olabilir.

---

## 8. Buying a used laptop: what to check
**Thread phrases:** "ikinci el laptop alırken nelere dikkat", "kullanılmış laptop kontrol"

Satıcının yanında en az 15-20 dakika ayırın. Ekranda ölü piksel, klavyede basmayan tuş, kamera, mikrofon ve hoparlörün sağ ve sol kanalı, şarj soketi ve USB portlarına tek tek bakın. Pil sağlığı için Windows'ta komut satırına `powercfg /batteryreport` yazıp rapordaki tam şarj kapasitesini tasarım kapasitesiyle karşılaştırın.

Bu kontrolleri sırasıyla anlatan bir liste var, testleri de tarayıcıdan yapabiliyorsunuz: https://testmatik.app/ikinci-el-laptop-kontrol/

Kasada vida izi, menteşede gevşeklik ve yüksek ısınma da önemli; 10 dakika video açık bırakıp alt kasaya elinizle dokunun.

---

## 9. A 144 Hz monitor that still feels like 60 Hz
**Thread phrases:** "144hz monitör 60hz gözüküyor", "monitör hz ayarlama"

Yenileme hızı çoğu zaman elle seçilmesi gereken bir ayar. Ayarlar > Sistem > Ekran > Gelişmiş ekran kısmından yenileme hızını 144 Hz'e çekin. Listede yoksa en sık neden kablo: monitörle gelen DisplayPort kablosunu doğrudan ekran kartına takın, anakarttaki porta değil.

Windows, ekran kartı paneli ve kablo tarafını adım adım anlatan rehber burada: https://testmatik.app/monitor-hz-ayarlama/

Laptopta prizden çıkınca Hz düşüyorsa güç ayarlarında dinamik yenileme hızı açık olabilir.

---

## 10. Measuring typing speed while learning touch typing
**Thread phrases:** "10 parmak hız testi", "katiplik sınavı klavye hızı", "dakikada kaç kelime"

Hızı ölçerken net kelimeye bakın, yani hatalı kelimeler düşülmüş sayıya. Başta yüzde 95 doğruluğa odaklanmak hızı da kalıcı olarak artırıyor. Her gün 15-20 dakika çalışmak haftada bir uzun çalışmadan çok daha etkili.

Türkçe kelimelerle 1, 3 veya 5 dakikalık test yapabildiğiniz bir yer: https://testmatik.app/klavye-hiz-testi/

Katiplik sınavına hazırlanıyorsanız süreyi ve klavye düzenini (Q ya da F) sınav ilanına göre seçin; ilanda belirtilen düzende pratik yapmak önemli.

---

# Free directories and launch sites

Submit testmatik.app with a short English description. Check each site's current rules before posting; some review submissions or limit them to one per week.

| Site | What to submit | Notes |
|---|---|---|
| AlternativeTo (alternativeto.net) | Testmatik as an alternative to keyboardtester.com and webcamtests.com | Free listing |
| SaaSHub (saashub.com) | Free web app listing | Free |
| Product Hunt (producthunt.com) | One launch for the whole site | Launch on a weekday morning (US time) |
| Indie Hackers (indiehackers.com) | Product page plus a short post on building it | pixelcheckup.com got a real link here |
| Hacker News "Show HN" (news.ycombinator.com) | "Show HN: Free hardware tests in the browser, nothing uploaded" | One post only |
| Reddit r/SideProject | Short post with what is different (privacy, Turkish Q/F layouts) | Read sub rules first |
| Uneed (uneed.best) | Free tool listing | Free queue |
| Fazier (fazier.com) | Launch listing | Free tier |
| MicroLaunch (microlaunch.net) | Launch listing | Free tier |
| Peerlist (peerlist.io) | Project launch | Needs a profile |
| BetaList (betalist.com) | Listing | Free queue can be slow |
| Launching Next (launchingnext.com) | Listing | Free |
| Technopat Sosyal profile | Site link in the forum signature, if the rules allow | Turkish audience |
