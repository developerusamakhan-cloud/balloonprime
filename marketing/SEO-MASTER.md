# Testmatik SEO master file

The single source of truth for testmatik.app: what exists, what was decided, what went wrong, and what is next.
Update the "Log" and "Next actions" sections at the end of every work session. Last updated: 2026-11-07.

---

## 1. Rules (always)

1. **Owner speaks Roman Urdu; everything written is English** (or the content language: Turkish, Portuguese, Polish). Never write Roman Urdu.
2. **No long dashes** (en dash or em dash) in content, UI, images or pins. Use a hyphen or rewrite.
3. **No AI tone, no stock phrases**: "göz atın", "unutmayın", "deneyim sunar", "Bu rehberde", "worth noting" and similar. Write like a knowledgeable person.
4. **No excuses.** When something underperforms, own the decision, show the data, and ship the fix in the same session.
5. **Verify before claiming.** Every claim about a tool must match the code. Every number must come from a tool result (Ubersuggest, live server check). Say when something could not be checked.
6. **No fake freshness.** "Updated" dates are the real post modified date, never an auto "current month" badge.
7. **No paid or bulk links.** pixelcheckup.com bought spam links and lost most of its traffic (771 visits in Aug 2026 to 104 in Sep).
8. **Ask before** installing plugins, deleting anything, or site-wide changes. Take a backup first.
9. **Turkish site must never break.** Snapshot all URLs before risky changes and compare after.

---

## 2. Site facts

| Item | Value |
|---|---|
| Domain | https://testmatik.app (Hostinger, WordPress, Hostinger CDN) |
| Theme | Custom `testmatik`, repo `developerusamakhan-cloud/balloonprime`, folder `testmatik/`, branch `ccr-a2f7fe03-qqgqms` |
| Theme version live | 1.0.13 |
| SEO plugin | Rank Math (titles, sitemap `sitemap_index.xml`, IndexNow on) |
| Multilingual | Polylang 3.9.1: tr default at root, pt in `/pt/`, pl in `/pl/`, no browser redirect |
| Analytics | GA4 G-VVMQ6PHR40 (property 559438311) via Site Kit; consent mode v2 in theme |
| Search Console | Verified. Site Kit lacks the Search Console permission, so Claude cannot read GSC data. Owner must send screenshots or re-grant the scope in Site Kit |
| Supermetrics | Has 7 other sites, not testmatik.app |
| Semrush | Out of API units |
| Ubersuggest project | id `908c22833953d8d9d84209ec066895478edff25de8682736b72eb663010b0154`, Turkey, weekly, 57 keywords, 10 competitors |
| IndexNow key | stored in Rank Math option `rank-math-options-instant-indexing` (key file served at `/{key}.txt`) |
| Contact email | iletisim@testmatik.app shown on Contact page. Owner must confirm it receives mail |
| DB backup | `wp-content/testmatik-backup-20261104-091035.sql.php` (before Polylang) |
| Plan page | https://claude.ai/artifact/Wk13uunwGV5AtiYreW3ueY |

### Page IDs
Home 18, Rehberler (blog) 21, İletişim 19, Hakkımızda 17, Klavye Hız Testi 285, iPhone kamera guide 366, Telefonda kamera guide 382, Bilgisayar Testleri hub (/testler/) 434. Site icon 146.

### How to deploy (proven method)
1. Edit locally, `php -l`, test tools in Playwright, run `testmatik/tools/build-zip.sh`, commit, push.
2. Write a one-time plugin `plugins/testmatik-diag/testmatik-diag.php` with an activation hook that downloads files from `raw.githubusercontent.com/.../<new sha>/testmatik/<file>`, checks the live file equals the previous commit, writes, loads the homepage, and rolls back on failure.
3. If content packs changed, call `testmatik_install()` in the same hook (it only rewrites items nobody edited by hand).
4. New posts: set language with `pll_set_post_language( $id, 'tr' )`, submit URLs to IndexNow (api.indexnow.org and yandex.com/indexnow).
5. Bump `Version:` in live `style.css` with edit_file (live style.css differs from repo, never overwrite it).
6. Deactivate and delete the diag plugin.
Note: testmatik.app is not reachable from the Claude sandbox; all live checks go through the diag plugin.

---

## 3. Tools (live)

| Tool | URL | Main keyword (TR) | Searches/mo | SD |
|---|---|---|---|---|
| Klavye testi | /klavye-testi/ | klavye testi | 22,200 | 16 |
| Klavye hız testi | /klavye-hiz-testi/ | klavye hız testi | 90,500 | 15 |
| Ölü piksel testi | /olu-piksel-testi/ | ölü piksel testi | 6,600 | 12 |
| Mikrofon testi | /mikrofon-testi/ | mikrofon test | 5,400 | 21 |
| Kamera testi | /kamera-testi/ | kamera testi | | 16 |
| Mouse testi | /mouse-testi/ | mouse test | 2,400 | 15 |
| Hoparlör testi | /hoparlor-testi/ | hoparlör testi | | 20 |

Hub page: /testler/ "Bilgisayar Testleri" (bilgisayar testleri 480, SD 16; bilgisayar test 480, SD 18; laptop test 110). Tools grouped by category from the registry, ItemList schema. Linked from the menu ("Tüm testler" item and "Tüm testleri gör" in the Testler dropdown), header button, footer, homepage and every tool breadcrumb.

Every tool page has: WebApplication + FAQPage schema, team byline with real update date, "Bu test nasıl ölçüyor?" methodology written from the code, about 1,300+ words, featured image, Pinterest pin.

Next tools (researched, `marketing/new-tools-keywords.md`): CPS test (TR 33,100 + BR 22,200 + PL 22,200), Gamepad tester (18,100), Ekran Hz testi (1,600), Kulaklık testi (1,300).

---

## 4. Content (Turkish guides)

All guides: BlogPosting schema with author "Testmatik Teknik Ekibi" (Organization), FAQs, tool CTA, internal links, featured image.

| Slug | Main keyword | Tool | Publish date |
|---|---|---|---|
| laptop-klavye-calismiyor | laptop klavye çalışmıyor (1,600) | klavye | Oct 2026 |
| mikrofon-calismiyor | mikrofon çalışmıyor | mikrofon | Oct 2026 |
| laptop-kamera-calismiyor | laptop kamera çalışmıyor | kamera | Oct 2026 |
| mouse-cift-tiklama-sorunu | mouse çift tıklama sorunu | mouse | Oct 2026 |
| olu-piksel-nasil-duzeltilir | ölü piksel nasıl düzeltilir | ölü piksel | Oct 2026 |
| q-klavye-f-klavye-farki | q klavye f klavye farkı | klavye | Oct 2026 |
| klavye-ghosting-nedir | klavye ghosting nedir | klavye | Oct 2026 |
| ikinci-el-laptop-kontrol | ikinci el laptop alırken nelere dikkat edilmeli | klavye | Oct 2026 |
| kulaklik-testi-sag-sol | kulaklık testi | hoparlör | 18 Oct |
| monitor-hz-ayarlama | monitör hz ayarlama | ölü piksel | 25 Oct |
| mouse-tekerlegi-sorunu | mouse tekerleği aşağı yukarı sorunu | mouse | 27 Oct |
| telefon-mikrofon-calismiyor | telefon mikrofon çalışmıyor | mikrofon | 29 Oct |
| mouse-polling-rate-nedir | mouse polling rate nedir | mouse | 31 Oct |
| kulaklik-mikrofon-calismiyor | kulaklık mikrofon çalışmıyor | mikrofon | 2 Nov |
| dokunmatik-ekran-testi | dokunmatik ekran testi | ölü piksel | 4 Nov |
| lenovo-laptop-klavye-calismiyor | lenovo laptop klavye çalışmıyor | klavye | 6 Nov |
| telefonda-kamera-acilmiyor | telefonda kamera açılmıyor (590, SD 14) | kamera | 6 Nov (long-tail) |
| iphone-kamera-acilmiyor | iphone kamera açılmıyor (480, SD 14) | kamera | 6 Nov (long-tail) |
| laptop-hoparlor-cizirti | laptop hoparlör cızırtı | hoparlör | 8 Nov (scheduled) |
| web-kamera-goruntu-kalitesi | web kamera görüntü kalitesi | kamera | 10 Nov (scheduled) |

Long-tail queue (one a day, live immediately): `marketing/longtail-plan-tr.md`.

---

## 5. What went wrong and what was learned

| Date | Problem | Cause | Fix / lesson |
|---|---|---|---|
| Oct 2026 | Google saw a blank "Hello world" homepage for about a week | Hostinger CDN cached HTML for 7 days | Theme sends `Cache-Control: public, max-age=600, s-maxage=3600`. Purge CDN in hPanel after big changes |
| Oct-Nov 2026 | Near zero impressions | Targeted only big head keywords; new domain, 0 links | Mix long-tail (SD 20 or lower) from day one. Started 6 Nov |
| Nov 2026 | "Low competition" misunderstood as "quick" | Competitors with DA 3-5 took 5-7 months and 45-87 linking sites | Always state the time and links needed next to any "winnable" verdict |
| Oct 2026 | Pin text claimed features the tool did not have | Copy written before checking code | Check every claim against the code |
| Oct 2026 | Long dashes and stock phrases in content | Writing habits | Grep for `–`, `—` and stock phrases before every publish |
| Nov 2026 | 7 old posts had broken Article schema | Leftover Rank Math `rank_math_rich_snippet` meta without article type | Removed the meta; check schema after every deploy |
| Nov 2026 | Rank Math printed author "admin" (Person) | WordPress user name | Theme filter replaces it with the team Organization |

---

## 6. Strategy

1. **Long-tail first** (2026-11 to 2027-01): one Turkish guide a day from the long-tail list, all SD 20 or lower.
2. **Links**: 10 real linking sites by end of December, 25 by end of February. Forum answers (Technopat, DonanımHaber, ShiftDelete; `marketing/forum-pack-tr.md`), Pinterest (7 pins, `marketing/pinterest/PINS.md`), directories. Never paid links.
3. **New languages**: Brazilian Portuguese first, Polish second (`marketing/multilingual-url-map.md`). Biggest PT keywords: teste de digitação 60,500, teste de teclado 40,500 (#1 has DA 6), teste de microfone 33,100. Polish gap: no real tool page on page one for test mikrofonu (18,100).
4. **New tools**: CPS test next (77,500 searches/mo across three countries).
5. **Expectations**: first long-tail impressions in 1-3 weeks after publishing; main keywords 3-6 months, only with links.

---

## 7. Next actions

| When | Action | Owner | Status |
|---|---|---|---|
| Daily from 7 Nov | Publish next long-tail guide (WhatsApp kamera, Zoom/Teams kamera, Valorant mikrofon...) | Claude | Pending |
| 7 Nov | Portuguese foundation: translatable theme strings, pt_BR translation, language switcher, /pt/ home and legal pages | Claude | Pending |
| After foundation | teste de teclado (ABNT2) and teste de microfone | Claude | Pending |
| 10-11 Nov | CPS test in TR, PT, PL | Claude | Pending |
| Every Monday | Check Ubersuggest rankings, owner's GSC screenshots, update this file | Claude | Pending |
| Now | Request indexing in GSC for new URLs; post 1 pin a day; 2-3 forum answers a day | Owner | Pending |
| Now | Send Bing and Yandex Webmaster verification codes | Owner | Pending |
| Now | Confirm iletisim@testmatik.app receives mail | Owner | Pending |
| Now | Send GSC screenshots: Performance (3 months, Queries) and Pages report | Owner | Pending |

---

## 8. Log

| Date | Done |
|---|---|
| Oct 2026 | Theme, 6 tools, 18 guides, Rank Math, GA4 with consent, favicon, Pinterest pins 01-06, footer credit |
| 26 Oct | New tool keyword research (Ubersuggest, Turkey) |
| 28 Oct | Mobile header fix; favicon checks (Google favicon service not updated yet) |
| 1 Nov | Klavye Hız Testi tool live; pin 07; keyword tracking expanded to 57 |
| 1-3 Nov | Audit: page schema fixed, en dashes removed, stock phrases rewritten, internal links added; competitor backlink check |
| 4 Nov | IndexNow on (29 URLs accepted by Bing and Yandex); PT/PL keyword research and URL map; forum pack; DB backup; Polylang installed (31 Turkish URLs unchanged) |
| 4 Nov | Team byline, real update date, methodology on every tool, team author schema |
| 6 Nov | Long-tail research (14 guides, about 3,300 searches/mo); first 2 long-tail guides live with images, sent to IndexNow |
| 7 Nov | Bilgisayar Testleri hub page /testler/ live (page 434), linked from menu, header, footer, homepage, breadcrumbs; sent to IndexNow |
