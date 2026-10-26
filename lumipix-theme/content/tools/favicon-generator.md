---
keywords: favicon to ico, favicon for free, favicon generator, favicon maker, favicon.ico
seo_desc: Free favicon to ICO generator: turn a logo, letter or emoji into favicon.ico, Apple touch icon and Android icons, plus a ready HTML snippet. No upload.
---

That little icon in the browser tab makes a site look finished, and it's easy to get wrong. This free favicon to ICO generator turns your logo, a letter or an emoji into every icon your website needs, favicon.ico included, in one download. You get a preview at real sizes and the HTML to install it, and your logo isn't uploaded.

## Every icon your site needs in one ZIP

A favicon shows up in browser tabs, bookmarks and history, and on phones it's the home screen icon when someone saves your site. Different places want different sizes and formats, which is why a single PNG is rarely enough. This tool builds all the usual files from one source.

## How to make a favicon

1. **Choose a mode.** **Image** to use a logo, or **Text** to use one or two characters or an emoji.
2. **Add your source.** In Image mode, drop a PNG, SVG, JPG or WebP file. In Text mode, type your letters and pick a text colour and font style (Sans, Serif or Bold).
3. **Pick a Shape:** Square, Rounded or Circle.
4. **Set the Background.** Leave it transparent or choose any colour. Text mode always uses a background colour.
5. **Adjust Padding** (0 to 30%) so the icon has a bit of breathing room.
6. **Check the preview** at 16, 32, 48 and 180 px, and in the mock browser tab.
7. **Click Download favicon package** and copy the HTML snippet with the **Copy** button.

## What's in the package

| File | Size | Where it's used |
|---|---|---|
| favicon.ico | 16, 32 and 48 px in one file | The classic favicon, requested directly at /favicon.ico |
| favicon-16x16.png | 16 x 16 | Browser tabs |
| favicon-32x32.png | 32 x 32 | Tabs on sharper screens, bookmarks |
| apple-touch-icon.png | 180 x 180 | iPhone and iPad home screen (solid background) |
| android-chrome-192x192.png | 192 x 192 | Android home screen |
| android-chrome-512x512.png | 512 x 512 | Android and bigger app style icons |
| site.webmanifest | | Tells Android which icons to use |

The Apple touch icon always gets a solid background, because iOS doesn't support transparency there. If you chose transparent, pick a colour that suits your logo before downloading.

## Making a favicon from a logo

Square logos work best, because a favicon is always square. If your logo is wide, like a name next to a symbol, use just the symbol. A full wordmark is unreadable at 16 pixels. Cut the symbol out with the [crop image tools](tool:crop-image) using the **1:1** ratio, then drop it here.

SVG is the ideal source if you have it, since it stays crisp at every size. If you only have SVG and need PNG versions for other places too, the [online SVG to PNG converter](tool:svg-to-png) makes them at any size. A big PNG with a transparent background is the next best thing. If your logo only exists on a white or coloured background, [remove white background from image](tool:remove-white-background) files first, or follow our guide on how to [make a logo background transparent](post:make-logo-background-transparent).

## Text and emoji favicons

No logo yet? **Text** mode makes a clean icon from an initial, two letters or an emoji. One character is usually easiest to read in a tab. Use strong contrast between the text and the background, and try **Bold** if thin strokes disappear at 16 px. **Rounded** or **Circle** gives text icons a more finished look.

## Shape, background and padding

| Setting | Good when | Watch out for |
|---|---|---|
| Square, transparent | Your logo already has a clear shape | Thin dark logos can vanish on dark browser themes |
| Rounded or Circle, coloured | You want a badge style icon that stands out | Corners of the logo can get cut if padding is too low |
| Padding 0 to 10% | Small, simple symbols | It can look cramped at 180 px |
| Padding 15 to 30% | Circles and detailed logos | Detail gets smaller at 16 px |

Always judge the 16 px preview first. If you can't recognise the icon there, simplify the source rather than adding detail.

## Installing it on your site

Upload all the files from the ZIP to the root folder of your site (often called public_html), so they sit next to your home page. Then paste the HTML snippet into the `<head>` section of your pages. Most site builders and themes have one place to add code to the head of every page.

**On WordPress**, you can set a 512 x 512 PNG as the Site Icon under Appearance, Customize, Site Identity instead. It's still worth uploading favicon.ico to the site root as well, because some crawlers ask for /favicon.ico directly without reading your HTML.

## If something's not right

- **The old icon still shows.** Browsers hang on to favicons. Open the site in a private window or clear the cache to see the new one.
- **It looks blurry or muddy in the tab.** The source has too much detail. Use a single symbol or letter and raise the contrast.
- **A white box on the iPhone home screen.** That's the solid background of the Apple touch icon. Pick a background colour that matches your brand.
- **Google still shows a plain globe.** Google needs a square favicon of at least 48 x 48 px that it can crawl. It can take days or weeks to appear in search results.
- **The edges of the logo are cut off.** Add more padding, especially with Circle.

Keep it simple: one shape, one or two colours. Check it against light and dark tab bars in the preview, and use the same colour as your logo or header so people connect the tab to your site. Your logo is processed on your own device, with no upload, no account and no watermark.

<!-- more -->
## A quick checklist before you publish

1. Check the 16 px preview. Is the icon still recognisable?
2. Check the 180 px preview. Does the background look right as a phone icon?
3. Upload all seven files to the site root, not just favicon.ico.
4. Paste the snippet into the head of every page.
5. Open the site in a private window and look at the tab.

Once it shows correctly in your browser, you're done. Search engines will pick it up in their own time. Keep your source file, so you can make a new package in seconds if you change the colour or shape later.
