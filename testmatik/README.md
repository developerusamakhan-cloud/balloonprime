# Testmatik WordPress Theme

Fast, SEO-focused theme for **testmatik.app**: free hardware tests that run in the visitor's browser. Turkish content pack included (phase 1); Polish and Portuguese are planned as next languages.

## What's included

| Area | Details |
|---|---|
| **6 working tools** | Klavye testi (Türkçe Q + F layouts, ghosting/NKRO "max keys at once", key history), Ölü piksel testi (9 full-screen colours, auto mode, stuck-pixel fixer with epilepsy consent), Mikrofon testi (device picker, level meter, waveform, 5 s record + playback), Kamera testi (device picker, 720p/1080p/4K request, real resolution, measured FPS, PNG snapshot), Mouse testi (5 buttons, wheel, double-click/chatter detector with threshold, polling-rate Hz, 5 s CPS), Hoparlör testi (left/right/both, 20 Hz–20 kHz sweep, tone generator) |
| **Content pack** | Home (1,579 words + 8 FAQs), 6 tool pages (1,140–1,200 words + 7 FAQs each), 8 guide articles (1,120–1,190 words + 6 FAQs each), Hakkımızda, İletişim, Gizlilik, Kullanım Şartları, Çerez Politikası |
| **Internal linking** | 27–42 internal links per tool page and article: in-text links, mega menu, sidebar tool list, CTA card inside articles, related guides on tool pages, related articles, link-rich footer, breadcrumbs |
| **SEO** | Per-page SEO title, meta description, Open Graph, `lang="tr-TR"`, JSON-LD (WebApplication, FAQPage, BreadcrumbList, BlogPosting, WebSite, Organization), clean `/rehber/slug/` article URLs, core sitemap without users/tags. Title/meta/OG step aside automatically for Rank Math, Yoast, SEOPress or AIOSEO; Rank Math and Yoast fields (title, description, focus keywords) are pre-filled |
| **Design** | Plus Jakarta Sans + JetBrains Mono (self-hosted, Turkish characters), light and dark mode, keycap visual language, responsive down to 320 px |
| **Performance** | No jQuery, no page builder, block-library CSS removed, each tool's script loads only on its own page, font preload, emoji script removed |
| **Privacy and ads** | Nothing is uploaded. Cookie banner with Google Consent Mode v2 appears automatically once you add GA4 or AdSense. Ad slots are off by default |

## Install

1. **Appearance → Themes → Add New → Upload Theme**, choose `testmatik.zip`, then **Activate**.
2. On first activation the theme builds the site automatically: tool pages, guides, legal pages, categories, static front page, "Rehberler" blog page and `/rehber/%postname%/` permalinks. The log is shown in **Appearance → Testmatik Kurulum**.
3. **Settings → General → Site Language**: choose **Türkçe**.
4. **Appearance → Customize → Site Identity**: upload a site icon (an SVG fallback is used until then).
5. Add the site to **Google Search Console** and submit `/wp-sitemap.xml` (or `/sitemap_index.xml` with Rank Math).

Setup never overwrites content you edited. Running **Appearance → Testmatik Kurulum → Eksikleri oluştur / içeriği yenile** again only adds missing items and refreshes untouched ones (useful after a theme update with new content).

Permalinks are changed only if the site still uses a WordPress default (Plain or Day-and-name) and has no articles of its own, so existing URLs are never broken.

## Editing

- Every tool page is a normal page. The **Testmatik** box under the editor sets which tool is shown, the intro line, SEO title/description (hidden when an SEO plugin is active) and FAQs (`Soru :: Cevap`, one per line; FAQPage schema is generated automatically).
- On articles, the **Related tool** adds a side card and lists the article on that tool's page.
- `[testmatik_cta tool="klavye-testi"]` inserts a call-to-action card anywhere.

## Customizer (Appearance → Customize → Testmatik)

- **Ana sayfa:** badge, H1 (wrap words in `*asterisks*` for the gradient accent), lead text, optional SEO title/description, default share image.
- **İletişim ve alt bilgi:** public email (defaults to `iletisim@<domain>`), footer text.
- **Analitik, çerezler ve reklam:** GA4 ID, AdSense publisher ID and three slot IDs, ads on/off, cookie banner toggle.

## Adding a language later

Recommended: Polylang. Keep Turkish as the default language without a URL prefix; add Polish (`/pl/`) and Portuguese (`/pt/`) and translate pages one by one. Tool UI strings are wrapped in the `testmatik` text domain, so they can be translated with Loco Translate or a `.po` file in `languages/`.

## Content files

`content/tools/*.php`, `content/posts/*.php`, `content/pages/*.php` each return an array (title, seo_title, description, 5 keywords, intro, html, faqs). Links are written as `{tool:key}`, `{post:slug}`, `{page:slug}` and turned into real URLs on install. See `content/SPEC.md` for the writing rules.

## Building the zip

```
tools/build-zip.sh          # bumps patch version (1.0.0 -> 1.0.1) and writes dist/testmatik.zip
tools/build-zip.sh minor    # 1.0.1 -> 1.1.0
tools/build-zip.sh none     # keep version
```

## File map

```
functions.php          bootstrap
inc/tools.php          tool registry
inc/tool-apps.php      tool UI markup
inc/content.php        content pack loader, link tokens, FAQs, CTA cards, TOC
inc/seo.php            titles, meta, Open Graph, JSON-LD, sitemap tweaks
inc/installer.php      one-click setup
inc/admin.php          setup screen and meta box
inc/customizer.php     Customizer, consent mode, GA4/AdSense loaders
inc/template-tags.php  logo, nav, breadcrumbs, cards, ad slots
assets/js/tools/*.js   tool engines (keyboard, pixel, mic, camera, mouse, speaker)
assets/css/main.css    all styles (tokens at the top)
```

## Credits

Fonts: Plus Jakarta Sans and JetBrains Mono, SIL Open Font License 1.1. Icons: Lucide-style paths (ISC).
