# Lumi Pix WordPress Theme

A fast, premium theme for **Lumipix.tools**: a browser-based image tools site. The tools work out of the box, and every image is processed on the visitor's device. Nothing is uploaded.

## What's included

| Area | Details |
|---|---|
| **Working tools** | Compress to an exact size (KB/MB, batch up to 20), Image Resizer (px, %, cm, mm, inch + DPI, presets, aspect lock, fit/fill/stretch), AI Background Remover (Transformers.js, on-device), White/solid-colour Background Remover |
| **Tool landing pages** | 15 pages: Image Compressor, 20KB / 50KB / 100KB / 200KB / 1MB, PPSC / FPSC / NTS form photos, Image Resizer, Instagram, Passport photo, Signature, Background Remover, Remove White Background |
| **Internal linking** | Mega menu, link-rich footer, breadcrumbs, preset chips, "Related tools" grid on every tool page, auto CTA card inside articles, "Helpful guides" on tool pages, sidebar tools card on posts, "All tools" hub page |
| **SEO** | Per-tool titles and meta descriptions, Open Graph, JSON-LD (WebApplication, FAQPage, BreadcrumbList, BlogPosting, WebSite, Organization). Generic SEO output steps aside automatically when Yoast, Rank Math, SEOPress or AIOSEO is active |
| **Blog** | Blog index with category chips, article template with sticky tools sidebar, reading time, related posts |
| **Design** | Geist + Instrument Serif (self-hosted), light and dark mode, bento grid home page, fully responsive |
| **Performance** | No jQuery, no page builder, tool scripts load only on tool pages, fonts preloaded, emoji script removed |
| **Monetisation ready** | AdSense slots (below tool, in article, sidebar), **off by default** |

## What's new in 1.3

- **Longer content:** every article is 1,100–1,500 words, and every tool page has long-form copy (stored in `content/tools/<key>.md`), with more internal links.
- **Authors:** four author profiles (Ayesha Khan, Hamza Iqbal, Daniel Brooks, Sara Malik) with avatars, an author box under each article and author archive pages. Articles are assigned by category. Edit names and bios in **Users**, or replace the profiles with your real team.
- **Comments are switched off** site-wide: no forms, no pingbacks, no comments menu.
- **Design:** full-width featured images, a sticky article sidebar 20px below the header, cleaner tables, and a simpler footer (legal links live in the bottom bar).

After updating, open **Appearance → Lumi Pix Setup** and run it once. Articles and tool pages you have not edited are refreshed with the new content; their dates and schedule stay the same. Anything you edited yourself is left alone.

## Content pack (new in 1.1)

Setup also installs ready-made content from the `content/` folder:

- **30 articles** (`content/posts/*.md`, 1,100–1,500 words each). The first 15 are published right away; the other 15 are **scheduled every 2 days at 09:00** (site timezone). Every article has an SEO title, meta description, excerpt, category, related tool, internal links to tool pages and earlier articles, an FAQ section (with FAQPage schema) and a 1200×630 featured image that doubles as its social share image.
- **Page content with FAQs** for Home (about 1,700 words), All tools, About, Contact, Privacy Policy, Terms of Use, Cookie Policy and Disclaimer.
- **Social share images** for the home page and every tool page (`assets/og/`). Regenerate them with `node tools/og-images.js` (see the script header) after changing titles.

Links in the content are written as `tool:<key>`, `post:<slug>` and `page:<key>` and are turned into real URLs on install, so they work with any permalink setting.

Scheduled posts are published by WordPress cron, which runs when someone visits the site. On low-traffic sites, ask your host to set up a real cron job for `wp-cron.php` so posts go live on time.

Setup never overwrites content you have edited. Pages and posts are only filled in if they are new or still untouched.

## Install

1. Upload `dist/lumipix.zip` in **Appearance → Themes → Add New → Upload Theme**, then activate.
2. Open **Appearance → Lumi Pix Setup** and click **Create missing items**. This creates:
   - all tool pages, the "All image tools" hub, Guides (blog), About, Contact, Privacy Policy, Terms
   - a static front page and blog page
   - 3 draft articles (outlines only)
   - a footer menu
   - pretty permalinks (`/blog/post-name/` for articles), but only if the site still uses "Plain" permalinks

   Setup only adds what is missing. It never overwrites existing content.
3. Set your contact email in **Appearance → Customize → Lumi Pix → Footer**.
4. Read the legal pages once (Privacy Policy, Terms of Use, Cookie Policy, Disclaimer). They are written for this site, but a quick review by a legal professional is recommended, especially before enabling ads in the EU/UK, where a cookie consent banner is required.

## Updating the theme

The version lives in one place: the `Version:` line in `style.css`. The PHP code reads it from there, and every CSS/JS file is loaded with the version plus its file time, so visitors get the new files right after an update.

**To release an update**, build the zip with the script, which bumps the version automatically:

```
tools/build-zip.sh          # 1.2.0 -> 1.2.1 (fixes)
tools/build-zip.sh minor    # 1.2.1 -> 1.3.0 (new features/content)
tools/build-zip.sh major    # 1.3.0 -> 2.0.0
```

**To install an update on the site:** Appearance → Themes → Add New → Upload Theme → choose the new `lumipix.zip` → **Replace current with uploaded**. WordPress shows the current and the new version side by side. Your pages, posts, menus and Customizer settings are kept. If you use a caching plugin or Cloudflare, purge its cache once after updating.

## Customizer (Appearance → Customize → Lumi Pix)

- **Home page:** hero badge, heading (wrap a word in `*asterisks*` for the gradient serif accent), text, home SEO title and description, default share image.
- **Background remover:** Hugging Face model ID (default `Xenova/modnet`) and Transformers.js URL.
- **Ads (AdSense):** publisher ID and three slot IDs. Leave this off until the site has steady traffic.
- **Footer:** tagline and the **public contact email** (used in the footer, Contact page and legal pages; defaults to `hello@<your domain>`, so create that mailbox or change it here).

The site icon (favicon) and logo use the standard WordPress settings. Until a Site Icon is set, the Lumipix mark is used.

## Editing pages

- Every tool page is a normal WordPress page. The text below the tool is regular block content, so edit it freely.
- The **Lumipix tool** box in the page sidebar decides which tool appears on the page. Pick any tool to create a new landing page, e.g. a "Compress photo for university admission" page using the compressor.
- **SEO title** and **Meta description** fields are in the same box (hidden when an SEO plugin is active).
- On posts, pick a **Related tool**. A tool card is inserted after the second paragraph and the article is listed on that tool's page.

## Shortcodes

```
[lumipix_tool key="compress-image-to-50kb"]   working tool inside any post or page
[lumipix_cta tool="background-remover"]      call-to-action card linking to a tool
```

Tool keys: `compress-image`, `compress-image-to-20kb`, `compress-image-to-50kb`, `compress-image-to-100kb`, `compress-image-to-200kb`, `compress-image-to-1mb`, `compress-photo-for-ppsc`, `compress-photo-for-fpsc`, `compress-photo-for-nts`, `image-resizer`, `resize-image-for-instagram`, `passport-size-photo`, `resize-signature`, `background-remover`, `remove-white-background`.

## Adding tools in code

All tool pages are defined in `inc/tools.php`. Add entries with the `lumipix_tools` filter from a child theme or plugin:

```php
add_filter( 'lumipix_tools', function ( $tools ) {
	$tools['compress-image-to-30kb'] = array_merge( $tools['compress-image-to-20kb'], array(
		'slug'   => 'compress-image-to-30kb',
		'nav'    => 'Compress to 30KB',
		'h1'     => 'Compress image to 30KB',
		'title'  => 'Compress Image to 30KB Online – Free',
		'desc'   => '…',
		'config' => array( 'target' => 30, 'unit' => 'KB', 'maxWidth' => 800 ),
	) );
	return $tools;
} );
```

Then run **Lumi Pix Setup** again to create the page.

## Background remover: important notes

- It loads Transformers.js from jsDelivr and the model from Hugging Face the first time a visitor uses it. The browser caches both.
- **Check the model's licence before commercial use.** The default `Xenova/modnet` (MODNet) is designed for portraits. Some popular models, such as `briaai/RMBG-1.4`, are licensed for non-commercial use only.
- Test it once on your live site with a few real photos (portraits and products) before promoting it.

## File map

```
functions.php            bootstrap
inc/tools.php            tool registry (pages, SEO copy, FAQs, presets)
inc/tool-apps.php        tool UI markup
inc/content.php          shortcodes, article CTAs, related content
inc/seo.php              titles, meta, Open Graph, JSON-LD
inc/installer.php        one-click setup
inc/admin.php            setup screen, meta boxes
inc/customizer.php       Customizer settings
inc/template-tags.php    breadcrumbs, cards, navigation, ad slots
templates/tool.php       tool landing page layout
templates/page-tools.php "All tools" hub (page template)
assets/js/tools/*.js     tool engines (core, compress, resize, bg, colorkey)
assets/css/main.css      all styles (design tokens at the top)
```

## Credits

- Fonts: Geist and Instrument Serif, SIL Open Font License 1.1.
- Icons: Lucide-style paths (ISC).
- Background removal: Transformers.js (Apache-2.0).
