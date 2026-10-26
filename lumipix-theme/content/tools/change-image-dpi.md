---
keywords: how to change image dpi, image dpi change online, how to convert image dpi, image resolution for print, change image dpi
seo_desc: How to change image DPI to 300, 600 or any value without re-compressing: drop your photo here. JPG and PNG keep identical quality. Free, no upload.
---

The print shop says "300 DPI please", and your file says 72. Here's how to change the image DPI in a few seconds: drop the photo, pick the number, download. For JPG and PNG, not a single pixel of your photo is touched, so the quality stays exactly the same. Nothing is uploaded.

## Set the DPI a printer or form asks for

Print shops, publishers, photo labs and some application forms want images "at 300 DPI". Very often the image already has plenty of pixels, but the file says 72 or 96 DPI, or has no DPI at all, and it gets turned away. This tool rewrites the DPI value stored in the file so it says exactly what was asked for. Up to 20 images at once, all in your browser.

## How to change the DPI of an image

1. **Drop your images**, up to 20 at a time.
2. **Choose the DPI.** Tap a quick button (72, 96, 150, 200, 300 or 600) or type any value from 1 to 2400.
3. **Check the new print size.** Each result shows how big the image prints at that DPI, in centimetres and inches.
4. **Download** each file, or tap **Download all** for one ZIP.

## What DPI actually is

DPI, or dots per inch, is a number stored inside the image file. It tells printers and layout programs how many pixels to put in each inch of paper. It doesn't change the pixels themselves. The same 3000 x 2000 pixel photo can be labelled 72 DPI or 300 DPI, and only the suggested print size changes.

This is the bit that trips people up: **changing the DPI doesn't add pixels, sharpen the image or improve quality.** A small, blurry photo set to 600 DPI is still small and blurry. It just prints smaller. Our article on [what DPI means](post:what-is-dpi) explains it in more detail.

## Same pixels, different print size

Print size is just pixels divided by DPI. Here's an 1800 x 1200 pixel photo at different settings:

| DPI | Print size (inches) | Print size (cm) |
|---|---|---|
| 72 | 25 x 16.7 | 63.5 x 42.3 |
| 150 | 12 x 8 | 30.5 x 20.3 |
| 300 | 6 x 4 | 15.2 x 10.2 |
| 600 | 3 x 2 | 7.6 x 5.1 |

Higher DPI means a smaller, denser print from the same pixels. That's why 300 DPI is the usual target for sharp photo prints, while screens ignore the number completely.

## No quality loss for JPG and PNG

For JPG and PNG, only the DPI value in the file is rewritten. The image itself isn't compressed again, so the quality is identical to the original and the file size barely changes.

For JPG, both the JFIF header and the EXIF resolution are updated. That matters, because different programs look in different places. Windows Properties, Photoshop and print shops will all see the new value. For PNG, the DPI goes in the pHYs chunk, which is the standard spot.

Other formats (WebP, AVIF, GIF and BMP) are converted to PNG with the DPI set. PNG is lossless and stores DPI reliably, so the new file looks the same as the original but carries the new resolution.

## When you need more pixels, not more DPI

If a print shop wants a 4 x 6 inch photo at 300 DPI, the image needs at least 1200 x 1800 pixels. Changing the DPI alone can't get you there if the photo is smaller. To make a file for an exact print size, [resize image into inches](tool:resize-image-in-cm) or centimetres, which sets both the pixels and the DPI. Bear in mind that enlarging a small image adds pixels, not detail, so start from the biggest original you have.

Not sure if your file is big enough? The [image resolution checker](tool:check-image-dpi) shows the stored DPI and the largest size the image prints sharply at 300 DPI.

## If something's not right

- **The form still says the DPI is wrong.** Some checkers read EXIF only, others read JFIF. This tool updates both for JPG, so make sure you upload the new file, not the original.
- **The image prints tiny after setting 300 DPI.** It doesn't have enough pixels for a big print. Resize it to the size you need instead.
- **It looks the same on screen.** That's expected. Screens show pixels and ignore DPI.
- **My WebP came back as a PNG.** WebP, AVIF, GIF and BMP are saved as PNG so the DPI is stored reliably. If you need a JPG, convert the PNG and set the DPI again.
- **The PNG is bigger than expected.** Files converted from compressed formats like WebP become lossless PNGs. If size matters more than DPI, use the [image compressor](tool:compress-image), which keeps the DPI of a JPG.

## Which DPI should you pick?

Always use the exact number you were given. If nobody said, these are the usual starting points:

| Purpose | DPI to set | Note |
|---|---|---|
| Website, social media, email | 72 or 96 | Screens ignore DPI, so any value works |
| Posters and big prints seen from a distance | 150 or 200 | Fewer pixels needed per inch |
| Photo prints, brochures, documents | 300 | The most common request |
| Line art, logos, detailed scans | 600 | Only useful if the image has the pixels |

Before changing anything, ask the printer what size they'll print, then check that pixels divided by DPI gives at least that. If an upload form only says "300 DPI" with no print size, setting the value here is usually all it needs. Your photos never leave your device, with no account and no watermark.

<!-- more -->
## Doing a batch

Drop all the photos for one job together, pick the DPI once and tap **Download all**. Every file keeps its own pixel size, and each result shows its own print size, so you'll quickly spot any image that would print smaller than the rest.

For more on getting print sizes right, see [how to check if a photo is 300 DPI](post:how-to-check-if-photo-is-300-dpi) and our [print size guide](post:image-size-in-inches-print-guide). Making ID photos? The [passport size photo creator](tool:passport-size-photo) sets 300 DPI for you.
