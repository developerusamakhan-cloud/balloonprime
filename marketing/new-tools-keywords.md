# Testmatik – new tool keyword check (Turkey)

Source: Ubersuggest, Turkey (locId 2792), Turkish. Checked 2026-10-26.
SD = SEO difficulty (0–100, lower is easier). DA = domain authority of ranking sites.

## Results

| Tool | Main keyword(s) | Monthly searches | SD | Who ranks on page 1 | Verdict |
|---|---|---|---|---|---|
| Klavye hız testi | klavye hız testi · katiplik klavye testi · 10 parmak klavye hız testi | 90,500 · 1,900 · 1,600 | 15 · 10 · 18 | #1 m5bilisim (DA 23), #2 katiponline (DA 5), #3 xbitlabs (DA 65), rest DA 6–26 | **WINNABLE – biggest** |
| CPS testi | cps test | 33,100 | 27 | Chrome Web Store, Play Store apps, English sites DA 22–37. No Turkish tool page in top 10 | **WINNABLE** (gap: no Turkish page) |
| Gamepad testi (+ titreşim) | gamepad tester · gamepad test · titreşim testi | 18,100 · 4,400 · 110 | 23 · 23 · 11 | hexgaming (DA 39), thetest.com (DA 4) at #3, App Store pages. No Turkish tool page | **WINNABLE** |
| Ekran / monitör Hz testi | ekran hz testi · monitör hz testi | 1,600 · 590 | 16 | Blog post (DA 33), screenhztest (DA 12), cpscount (DA 8), pctester (DA 2) | **WINNABLE** |
| Kulaklık testi (tool page) | kulaklık testi | 1,300 | 15 | xbitlabs (DA 65), matfixcustoms (DA 5) at #3, denerim (DA 3) at #7 | **WINNABLE** (reuses the speaker engine) |
| Dokunmatik ekran testi | dokunmatik ekran testi | 320 | – | xbitlabs (DA 65), touchscreen-test (DA 6), seowebyazilim (DA 4) | WINNABLE but small |
| Reaksiyon testi | reaksiyon testi · reaksiyon süresi testi | 390 · 110 | 15 · 18 | – | Small; quick to build |
| Duyma (işitme) testi | duyma testi | 320 | 13 | Hearing-aid brands (Phonak, ReSound, Signia, Widex: DA 54–63) and hospitals | **SKIP** – health topic, strong brands |
| Renk körlüğü testi | renk körlüğü testi | no data | – | – | **HOLD** – Ubersuggest has no data; health topic |
| Internet hız / ping | – | – | – | Speedtest, Fast.com | **SKIP** (needs a server) |

## Build order (by traffic potential vs. effort)

1. **Klavye hız testi** – 90.5K/month, weak competitors. Add Q/F layouts and a "katiplik" (clerk exam) mode.
2. **CPS testi** – 33.1K/month; the click-counting code already exists in the mouse test.
3. **Gamepad testi** – 18.1K + 4.4K/month; buttons, sticks (drift), triggers, vibration via the Gamepad API.
4. **Ekran Hz testi** – 1.6K/month; refresh rate can be measured in the browser with requestAnimationFrame.
5. **Kulaklık testi** – 1.3K/month; built on the speaker tool, plus a latency check.
6. Dokunmatik ekran testi and reaksiyon testi – small, add later.

## Notes
- Phone vibration (titreşim) works only on Android browsers; iPhone Safari does not support the Vibration API. Gamepad vibration works in Chrome/Edge for most controllers.
- When the Ekran Hz testi goes live, the existing guides that say "Testmatik does not measure Hz yet" (monitor-hz-ayarlama) must be updated.
