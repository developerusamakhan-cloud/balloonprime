# Lumipix WordPress Theme

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

## Install

1. Upload `dist/lumipix.zip` in **Appearance → Themes → Add New → Upload Theme**, then activate.
2. Open **Appearance → Lumipix Setup** and click **Create missing items**. This creates:
   - all tool pages, the "All image tools" hub, Guides (blog), About, Contact, Privacy Policy, Terms
   - a static front page and blog page
   - 3 draft articles (outlines only)
   - a footer menu
   - pretty permalinks (`/blog/post-name/` for articles), but only if the site still uses "Plain" permalinks

   Setup only adds what is missing. It never overwrites existing content.
3. Review the **Privacy Policy** and **Terms** drafts and replace the placeholders.

## Customizer (Appearance → Customize → Lumipix)

- **Home page:** hero badge, heading (wrap a word in `*asterisks*` for the gradient serif accent), text, home SEO title and description, default share image.
- **Background remover:** Hugging Face model ID (default `Xenova/modnet`) and Transformers.js URL.
- **Ads (AdSense):** publisher ID and three slot IDs. Leave this off until the site has steady traffic.
- **Footer:** tagline.

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

Then run **Lumipix Setup** again to create the page.

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
