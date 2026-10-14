---
keywords: how to make a favicon, favicon size, favicon.ico, add favicon to website, favicon for wordpress
title: How to Make a Favicon for Your Website (Sizes, Files and Setup)
category: Formats & Printing
tool: favicon-generator
seo_title: How to Make a Favicon – Sizes, Files and Website Setup
seo_desc: How to make a favicon that stays sharp at 16 px: the sizes and files a modern site needs, a free generator, and setup for HTML sites and WordPress.
excerpt: The files and sizes a modern favicon needs, how to design one that reads at 16 pixels, and how to install it on any site or WordPress.
---

A missing or blurry favicon makes a site look unfinished. This guide explains how to make a favicon that stays sharp at 16 pixels, which files a modern website needs, and how to install them on a hand-coded site or WordPress.

## What is a favicon?

A favicon is the small square icon that represents your site. It appears in browser tabs, bookmarks, history lists, on phone home screens when someone saves your site as a shortcut, and next to your site name in many search results. Because it shows up at so many sizes, one PNG is rarely enough.

## Favicon sizes and files a modern site needs

| File | Size | Where it is used |
|---|---|---|
| favicon.ico | 16, 32 and 48 px in one file | Classic favicon; requested directly at /favicon.ico |
| favicon-32x32.png | 32 × 32 | Browser tabs on sharper screens, bookmarks |
| apple-touch-icon.png | 180 × 180 | iPhone and iPad home screen; needs a solid background |
| android-chrome-192x192.png | 192 × 192 | Android home screen |
| android-chrome-512x512.png | 512 × 512 | Android and larger app-style icons |
| site.webmanifest | – | Tells Android which icons to use |

The Apple touch icon must have a solid background, because iOS does not support transparency there.

## Designing an icon that reads at 16 px

At 16 pixels you have roughly the space of one letter in this sentence, so detail turns to mush.

- **Use simple shapes.** One bold symbol beats a detailed illustration.
- **Use one or two letters** if you have no symbol. A single initial is easiest to read.
- **Drop the wordmark.** A company name next to a logo is unreadable at this size.
- **Keep strong contrast** and check it against both light and dark tab bars.
- **Leave some padding** so the edges are not clipped.

| Design choice | Result at 16 px |
|---|---|
| Full logo with company name | Unreadable smudge |
| Single bold symbol | Clear and recognisable |
| One letter in a thin font | Strokes break up or disappear |
| Dark logo on a transparent background | Can vanish on dark browser themes |
| Logo on a solid coloured background | Visible on any theme |

If your logo sits on a white box, remove it with the [Background Remover](tool:background-remover) or follow our guide to [making a logo background transparent](post:make-logo-background-transparent). A wide logo can be cut down to its symbol with [Crop image](tool:crop-image) at the 1:1 ratio.

## How to make a favicon with the free generator

The [favicon generator](tool:favicon-generator) builds every file in the table above from one source, in your browser, so your logo is never uploaded.

1. **Choose a mode:** **Image** for a logo, or **Text** for one or two characters or an emoji.
2. **Add your source.** In Image mode, drop a PNG, SVG, JPG or WebP file; SVG stays crisp at every size. In Text mode, type your letters and pick a text colour and font style (Sans, Serif or Bold).
3. **Pick a Shape:** Square, Rounded or Circle.
4. **Set the Background:** transparent or any colour. Text mode always uses a colour.
5. **Adjust Padding** (0–30 %) for breathing room.
6. **Check the preview** at 16, 32, 48 and 180 px and in the mock browser tab.
7. **Click Download favicon package** to get a ZIP with all the files.
8. **Copy the HTML snippet** with the **Copy** button.

If you chose a transparent background, pick a colour that suits your logo before downloading, because the Apple touch icon always gets a solid one. For why icons are PNG rather than JPG, see [PNG vs JPG](post:png-vs-jpg).

## How to add a favicon to a static or hand-coded website

1. Upload all the files from the ZIP to the **root folder** of your site, often called public_html, so favicon.ico is reachable at yoursite.com/favicon.ico.
2. Paste the snippet inside the **head** section of your page template, or of every page on a small site.
3. Open the site in a private window to check the tab.

## How to add a favicon to WordPress

1. Go to **Appearance → Customize → Site Identity**.
2. Under **Site Icon**, upload a 512 × 512 PNG, such as android-chrome-512x512.png from the package.
3. Click **Publish**.

It is still worth uploading **favicon.ico to the site root** with your host's file manager or FTP. Some crawlers request /favicon.ico directly without reading your HTML, and some hosts answer that request with their own 404 page if the file is missing.

## Why your favicon may not show yet

**Browser cache.** Browsers hold on to favicons and often show the old one after you replace it. Test in a private window or clear the cache.

**Search results.** Google needs a square favicon of at least 48 × 48 px that it can crawl. Even when everything is correct, it can take days or weeks to appear in results. Requesting indexing of your home page in Google Search Console can help it get picked up, but there is no way to force an instant update.

## Troubleshooting checklist

- **Old icon still showing:** check in a private window first.
- **Blurry in the tab:** too much detail; use one symbol or letter and raise contrast.
- **White box on the iPhone home screen:** choose a background colour that matches your brand.
- **Edges cut off:** increase Padding, especially with the Circle shape.
- **Missing on some pages:** add the snippet to the shared head section.
- **Generic globe in Google:** confirm the icon is square, at least 48 px and not blocked, then wait.

Need the square logo at other exact sizes? The [Image Resizer](tool:image-resizer) handles that.

## Key takeaways

- **A favicon set is several files:** favicon.ico (16/32/48), a 32 px PNG, a 180 px Apple touch icon, 192/512 Android icons and a manifest.
- **Design for 16 px first:** one symbol or letter, strong contrast, a little padding.
- **Upload to the site root** and paste the snippet into the head of every page.
- **On WordPress,** set a 512 × 512 Site Icon and still upload favicon.ico.
- **Be patient:** test in a private window and give Google time.

## Frequently asked questions

### What size should a favicon be?

Make favicon.ico with 16, 32 and 48 px versions, a 32 × 32 PNG, a 180 × 180 Apple touch icon, and 192 and 512 px Android icons.

### Do I still need a favicon.ico file?

Yes. Some crawlers and tools still request /favicon.ico directly, so keep it in your site root.

### How do I add a favicon in WordPress?

Go to Appearance → Customize → Site Identity and upload a 512 × 512 PNG as the Site Icon. Also upload favicon.ico to the site root.

### Why is my new favicon not showing?

Usually the browser is showing a cached copy, so check in a private window. Search results can take days or weeks to update.

### Can I make a favicon without a logo?

Yes. Use Text mode in the favicon generator to make an icon from one or two letters or an emoji on a coloured background.
