---
keywords: favicon generator, favicon maker, ico generator, create favicon from image, favicon.ico
seo_desc: Free favicon generator: turn a logo, letter or emoji into favicon.ico, Apple touch icon and Android icons, plus a ready HTML snippet. No upload.
---

This free favicon generator turns your logo, a letter or an emoji into a complete set of website icons, including favicon.ico, in one download.

## Every icon your site needs in one ZIP

A favicon is the small icon shown in browser tabs, bookmarks, history lists and, on phones, on the home screen when someone saves your site. Different places ask for different sizes and formats, which is why one PNG is rarely enough. This tool builds all the common files from a single source, shows you exactly how they will look, and gives you the HTML to install them. Everything runs in your browser, so your logo is never uploaded.

## How to create a favicon

1. **Choose a mode.** Pick **Image** to use a logo, or **Text** to use one or two characters or an emoji.
2. **Add your source.** In **Image** mode, drop a PNG, SVG, JPG or WebP file. In **Text** mode, type your letters and choose a text colour and font style (Sans, Serif or Bold).
3. **Pick a Shape:** Square, Rounded or Circle.
4. **Set the Background.** Leave it transparent or choose any colour. Text mode always uses a background colour.
5. **Adjust Padding** (0–30 %) so the icon has some breathing room.
6. **Check the preview** at 16, 32, 48 and 180 px and in the mock browser tab.
7. **Click Download favicon package** and copy the HTML snippet with the **Copy** button.

## What is inside the package

| File | Size | Where it is used |
|---|---|---|
| favicon.ico | 16, 32 and 48 px in one file | Classic favicon; requested directly at /favicon.ico |
| favicon-16x16.png | 16 × 16 | Browser tabs |
| favicon-32x32.png | 32 × 32 | Browser tabs on sharper screens, bookmarks |
| apple-touch-icon.png | 180 × 180 | iPhone and iPad home screen (solid background) |
| android-chrome-192x192.png | 192 × 192 | Android home screen |
| android-chrome-512x512.png | 512 × 512 | Android and larger app-style icons |
| site.webmanifest | – | Tells Android which icons to use |

The Apple touch icon always gets a solid background, because iOS does not support transparency there. If you chose a transparent background, pick a colour that suits your logo before downloading.

## Create a favicon from an image

Square logos give the best result, because a favicon is always square. If your logo is wide, such as a name next to a symbol, use only the symbol. A full wordmark becomes unreadable at 16 pixels. Cut the symbol out with the [Crop image](tool:crop-image) tool using the **1:1** ratio, then drop it here.

SVG is the ideal source if you have it, because it stays crisp at every size. A large PNG with a transparent background is the next best choice. If your logo only exists on a white or coloured background, remove it first with the [Background Remover](tool:background-remover), or follow our guide to [making a logo background transparent](post:make-logo-background-transparent).

## Text and emoji favicons

No logo yet? **Text** mode makes a clean icon from an initial, two letters or an emoji. One character is usually easiest to read in a tab. Use strong contrast between text colour and background, and try **Bold** if thin strokes disappear at 16 px. A **Rounded** or **Circle** shape gives text icons a more finished look.

## Choosing shape, background and padding

| Setting | Good choice when | Watch out for |
|---|---|---|
| Square, transparent | Your logo already has a distinct shape | Thin dark logos can vanish on dark browser themes |
| Rounded or Circle, coloured | You want a badge-like icon that stands out | Corners of the logo may be cut if padding is too low |
| Padding 0–10 % | Small, simple symbols | Icon can look cramped in the 180 px preview |
| Padding 15–30 % | Circle shapes and detailed logos | Detail gets smaller at 16 px |

Always judge the 16 px preview first. If you cannot recognise the icon there, simplify the source rather than adding detail.

## Installing the favicon on your site

Upload all the files from the ZIP to the root folder of your site (often called public_html), so they sit next to your home page. Then paste the HTML snippet inside the `<head>` section of your pages. Most site builders and themes have one place where you can add code to every page's head.

**WordPress:** you can instead set a 512 × 512 PNG as the Site Icon under Appearance → Customize → Site Identity. Uploading favicon.ico to the site root as well is still worthwhile, because some crawlers request /favicon.ico directly without reading your HTML.

## Common problems and fixes

- **The old icon still shows.** Browsers cache favicons stubbornly. Open the site in a private window or clear the cache to see the new one.
- **The icon looks blurry or muddy in the tab.** The source has too much detail. Use a single symbol or letter and raise contrast.
- **A white box appears on the iPhone home screen.** That is the solid background of the Apple touch icon. Choose a background colour that matches your brand.
- **Google still shows a generic globe.** Google requires a square favicon that is at least 48 × 48 px and crawlable. It can take days or weeks to appear in search results after you install it.
- **The edges of the logo are cut off.** Increase **Padding**, especially with the **Circle** shape.

## Tips for a favicon that works

Keep it simple: one shape, one or two colours. Test it against both a light and a dark tab bar using the preview. Reuse the same colour as your logo or header so visitors connect the tab to your site. Keep your source file, so you can generate a new package in seconds if you change the colour or shape later.

## Private and free

Your logo is processed on your own device, with no upload, no account and no watermark. The favicon generator works on Windows, Mac, Android and iPhone.

<!-- more -->
## Related tools and guides

- [Image Resizer](tool:image-resizer) to make a square logo at an exact pixel size for other uses
- [PNG vs JPG](post:png-vs-jpg) to understand why PNG is the right format for icons

## A quick checklist before you publish

1. Check the 16 px preview: is the icon still recognisable?
2. Check the 180 px preview: does the background look right as a phone icon?
3. Upload all seven files to the site root, not only favicon.ico.
4. Paste the snippet into the head of every page.
5. Open the site in a private window and look at the tab.

Once the icon shows correctly in your browser, you are done. Search engines will pick it up on their own schedule.
