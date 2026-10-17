# Testmatik content spec (Turkish, phase 1)

Site: **Testmatik** (https://testmatik.app) — free browser-based hardware tests in Turkish.
Brand voice: friendly, clear, expert ("siz" form, not "sen"). Native, natural Turkish. No machine-translation feel,
no filler, no keyword stuffing. Short paragraphs (2–4 sentences). Concrete steps, real numbers, real menu names
(Windows 11: "Ayarlar > Sistem > Ses", "Aygıt Yöneticisi", macOS: "Sistem Ayarları > Gizlilik ve Güvenlik").
Every claim must be true. Never invent statistics, studies, user counts or reviews.

Privacy promise (true, use it): every test runs in the visitor's browser; nothing (audio, video, keystrokes) is
uploaded or stored on a server.

## File format

Each content item is one PHP file that returns an array. Use a **nowdoc** (`<<<'HTML'`) for HTML so nothing needs
escaping. The closing `HTML` must be alone at column 0, followed on the next line by `,`.

```php
<?php
defined( 'ABSPATH' ) || exit;

return array(
	'title'       => 'Klavye Testi',                       // page/post title (H1 is printed by the theme)
	'seo_title'   => 'Klavye Testi: Online Tuş Testi (Q ve F) | Testmatik', // 50–62 chars incl. " | Testmatik"
	'description' => '…',                                  // meta description, 140–158 characters, includes primary keyword
	'keywords'    => array( 'klavye testi', 'klavye test', '…' ), // exactly 5, first = primary keyword
	'intro'       => '…',                                  // 1–2 sentence lead shown under the H1 (max 220 chars)
	// posts only:
	'excerpt'     => '…',                                  // 1–2 sentences, max 200 chars
	'category'    => 'Klavye',                             // one of: Klavye, Ekran, Ses, Kamera, Mouse, Rehber
	'tool'        => 'klavye-testi',                       // related tool key (see map)
	'html'        => <<<'HTML'
<h2>…</h2>
<p>…</p>
HTML
	,
	'faqs'        => array(
		array( 'q' => 'Soru?', 'a' => 'Cevap (2–4 cümle, düz metin, HTML yok).' ),
	),
);
```

## HTML rules

- Do **not** use `<h1>`. Start with `<h2>`. Use `<h2>` for sections, `<h3>` for sub-sections.
- Allowed tags: h2, h3, p, ul, ol, li, strong, em, a, table, thead, tbody, tr, th, td, kbd, code, div (only with classes below), br.
- Allowed classes:
  - `<div class="tm-callout tm-callout--tip">` (ipucu), `tm-callout--warn` (uyarı), `tm-callout--info` (bilgi). Content inside: `<p>` with a leading `<strong>İpucu:</strong>` etc.
  - `<ol class="tm-steps">` for numbered step lists.
  - `<div class="tm-cta" data-tool="klavye-testi"></div>` — an empty div; the theme turns it into a "Testi başlat" card for that tool. Use 1 per article (after the 2nd or 3rd section). Tool pages don't need it.
- Tables: a header row in `<thead>`. Use tables where comparison helps (e.g. Q vs F, symptoms vs causes).
- Use `<kbd>` for keys (e.g. `<kbd>Fn</kbd> + <kbd>F12</kbd>`).
- No inline styles, no images, no scripts, no emojis.

## Internal links (mandatory)

Write links with tokens in `href`; the theme replaces them with real URLs:
- Tools: `{tool:KEY}` e.g. `<a href="{tool:klavye-testi}">klavye testi</a>`
- Articles: `{post:SLUG}` e.g. `<a href="{post:laptop-klavye-calismiyor}">laptop klavye çalışmıyor</a>`
- Pages: `{page:SLUG}` e.g. `<a href="{page:iletisim}">iletişim</a>`, home: `{home}`

Use descriptive, keyword-rich, varied anchor text (not "buraya tıklayın"). Each tool page: at least 6 internal links
(3+ to other tools, 2+ to articles). Each article: at least 6 internal links (its related tool 2× max, 2+ other tools,
2+ other articles). Home: link every tool and every article. Do not link a page to itself.
No external links.

## Site map (keys, slugs, keyword targets)

### Tools (pages)
| key / slug | Title | Primary keyword (monthly TR searches) | Secondary keywords |
|---|---|---|---|
| klavye-testi | Klavye Testi | klavye testi (27.1K, also "klavye test" 27.1K) | klavye testi tuş, online klavye testi, türkçe klavye testi, f klavye testi, q klavye test |
| olu-piksel-testi | Ölü Piksel Testi | ölü piksel testi (27.1K) | monitör ölü piksel testi, telefon ölü piksel testi, ölü piksel testi nasıl yapılır, ekran testi |
| mikrofon-testi | Mikrofon Testi | mikrofon test (27.1K) / mikrofon testi (6.6K) | online mikrofon test, mikrofon test etme, kulaklık mikrofon testi, telefon mikrofon testi |
| kamera-testi | Kamera Testi | kamera testi (6.6K) | web kamera testi, webcam test, laptop kamera testi, kamera çözünürlük testi |
| mouse-testi | Mouse Testi | mouse test (6.6K) | double click mouse test, çift tıklama testi, dpi mouse test, mouse test hz |
| hoparlor-testi | Hoparlör Testi | hoparlör testi (720) | sağ sol ses testi, kulaklık testi, stereo ses testi, ses frekans testi |

### What each tool actually does (describe ONLY these features)
- **klavye-testi**: on-screen keyboard with **Türkçe Q** (default) and **Türkçe F** layouts (toggle). A pressed key lights up blue; a key that has worked once turns green. Shows: tested keys count, last key (key name, `code`), max keys pressed at the same time (to check ghosting / anti-ghosting / NKRO), a history of recent key presses, and a reset button. Fn key and some media keys cannot be detected by any browser (the laptop handles them in hardware) — mention this honestly. Works with laptop, desktop, mechanical and wireless keyboards.
- **olu-piksel-testi**: "Testi başlat" opens full screen. Colours: siyah, beyaz, kırmızı, yeşil, mavi, gri, camgöbeği, macenta, sarı. Change colour by clicking/tapping, arrow keys or the space bar; "Otomatik" mode changes every 3 seconds; Esc exits. Also a **piksel onarıcı** (stuck pixel fixer): a small square that flashes rapid random colours, which the user drags over a stuck pixel and leaves for 10–30 minutes. Flashing warning for people with photosensitive epilepsy. Works on monitors, laptops, TVs (via browser) and phones.
- **mikrofon-testi**: browser asks permission; device dropdown to pick a microphone; live level meter, a waveform visual, peak level; "5 saniye kaydet" then play back to hear yourself; shows device name, sample rate (örnekleme hızı) and channel count. Works with laptop mics, USB mics, headset/kulaklık mics, phone mics.
- **kamera-testi**: permission prompt, camera dropdown, live preview, mirror toggle, shows actual resolution (e.g. 1280×720), measured FPS, aspect ratio and camera name; resolution request buttons (720p, 1080p, 4K – the camera gives its best supported); "Fotoğraf çek" saves a PNG snapshot to the device.
- **mouse-testi**: a mouse diagram where left, right, middle (tekerlek), back (geri) and forward (ileri) buttons light up and count clicks; scroll up/down counter; **çift tıklama (chatter) dedektörü**: flags when two clicks of the same button arrive faster than a threshold (default 80 ms) — a typical sign of a worn switch; a **polling rate (Hz)** estimate while moving the mouse; a 5-second **CPS** (clicks per second) test. Right-click menu is blocked inside the test area.
- **hoparlor-testi**: buttons to play a test tone on **Sol**, **Sağ** or **Her iki** channels; a **frekans taraması** (sweep 20 Hz–20 kHz) showing the current frequency; a custom tone generator (pick a frequency); volume slider. Warn to start at low volume, especially with headphones.

### Articles (posts, URL /rehber/slug/)
| slug | Working title | Primary keyword (vol) | Related tool | Category |
|---|---|---|---|---|
| laptop-klavye-calismiyor | Laptop Klavye Çalışmıyor? Adım Adım Çözüm Rehberi | laptop klavye çalışmıyor (1.6K) — also klavye çalışmıyor (1K), bilgisayarda klavye çalışmıyor (590), windows 11 klavye çalışmıyor; brand mentions lenovo/hp/asus/casper/monster | klavye-testi | Klavye |
| q-klavye-f-klavye-farki | Q Klavye ve F Klavye Farkı: Hangisini Seçmeli? | q klavye f klavye farkı | klavye-testi | Klavye |
| klavye-ghosting-nedir | Klavye Ghosting Nedir? Anti-Ghosting ve NKRO Rehberi | klavye ghosting nedir | klavye-testi | Klavye |
| olu-piksel-nasil-duzeltilir | Ölü Piksel ve Sıkışmış Piksel Nasıl Düzeltilir? | ölü piksel nasıl düzeltilir | olu-piksel-testi | Ekran |
| mikrofon-calismiyor | Mikrofon Çalışmıyor? Windows 11, Laptop ve Kulaklık İçin Çözümler | mikrofon çalışmıyor (320) — laptopta mikrofon çalışmıyor (260), kulaklık mikrofon çalışmıyor (210), bilgisayar mikrofon çalışmıyor (210), windows 11 mikrofon çalışmıyor | mikrofon-testi | Ses |
| laptop-kamera-calismiyor | Laptop Kamera Çalışmıyor? 10 Kesin Çözüm | laptop kamera çalışmıyor | kamera-testi | Kamera |
| mouse-cift-tiklama-sorunu | Mouse Çift Tıklama Sorunu: Nedenleri ve Çözümü | mouse çift tıklama sorunu | mouse-testi | Mouse |
| ikinci-el-laptop-kontrol | İkinci El Laptop Alırken Yapılması Gereken 9 Test | ikinci el laptop alırken nelere dikkat edilmeli | klavye-testi (links all tools) | Rehber |

### Pages
| slug | Title |
|---|---|
| (home) | Ana Sayfa |
| hakkimizda | Hakkımızda |
| iletisim | İletişim |
| gizlilik-politikasi | Gizlilik Politikası |
| kullanim-sartlari | Kullanım Şartları |
| cerez-politikasi | Çerez Politikası |

Contact email to use in pages: **iletisim@testmatik.app**. Operator description: "Testmatik bağımsız bir projedir."
Do not invent a company address, phone number, team names or founding story.

## Length (count words in `html` only, excluding FAQs)
- Home: **1,500–2,000** words + 8 FAQs.
- Tool pages: **1,100–1,500** words + 6–8 FAQs.
- Articles: **1,100–1,500** words + 5–7 FAQs.
- Hakkımızda: 500–700. İletişim: 300–450. Legal pages: 600–1,000 each (FAQs optional: 0–3).

## Tool page structure (suggested)
1. `<h2>` Bu araç ne işe yarar / nasıl kullanılır (numbered `tm-steps`)
2. Sonuçlar nasıl okunur (what green/blue etc. mean)
3. Sık görülen sorunlar ve çözümleri (table: belirti → olası neden → çözüm)
4. Device-specific tips (laptop vs. masaüstü, Windows vs. macOS vs. telefon)
5. Gizlilik (nothing uploaded)
6. Related tools / guides paragraph with links

## Home page structure
The theme already renders: hero, tool cards grid, features. The `html` is the long guide section below. Cover: what
Testmatik is, each tool (one `<h3>` each, 120–200 words, linked), who uses it (ikinci el alım, oyuncular, uzaktan
çalışanlar, öğrenciler), how browser-based testing and permissions work, privacy, troubleshooting overview linking
articles, browser compatibility (Chrome, Edge, Firefox, Safari; HTTPS requirement for mic/camera).

## Quality check before finishing
Run `php -l` on every file. Count words with:
`php -r '$a=require "FILE"; echo str_word_count(strip_tags($a["html"]), 0, "çÇğĞıİöÖşŞüÜâÂîÎûÛ");'`
(define ABSPATH first: `php -r 'define("ABSPATH",1); $a=require "FILE"; …'`).
