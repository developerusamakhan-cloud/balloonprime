---
keywords: how to change image dpi, image dpi change online, how to convert image dpi, image resolution for print, change image dpi
seo_desc: How to change image DPI to 300, 600 or any value without re-compressing: drop your photo here. JPG and PNG keep identical quality. Free, no upload.
---

Use this tool to change image DPI to 300 or any other value in seconds, without touching a single pixel of your photo.

## Set the DPI a print shop or form asks for

Print shops, publishers, photo labs and some application forms ask for images "at 300 DPI". Very often the image already has enough pixels, but the file says 72 or 96 DPI, or has no DPI at all, and gets rejected. This tool rewrites the DPI value stored in the file so it reads exactly what was requested. It works on up to 20 images at once, entirely in your browser.

## How to change the DPI of an image

1. **Drop your images**, up to 20 at a time.
2. **Choose the DPI.** Click one of the quick buttons (72, 96, 150, 200, 300 or 600) or type a custom value from 1 to 2400.
3. **Check the new print size.** Each result shows how large the image prints at that DPI, in centimetres and inches.
4. **Download** each file, or click **Download all** to save one ZIP.

## What DPI really is

DPI (dots per inch) is a number stored inside the image file. It tells printers and layout programs how many pixels to place in each inch of paper. It does not change the pixels themselves. The same 3000 × 2000 pixel photo can be labelled 72 DPI or 300 DPI; only the suggested print size changes.

This is the most important thing to understand: **changing DPI does not add pixels, sharpen the image or improve quality.** A small, blurry photo set to 600 DPI is still small and blurry; it just prints at a smaller size. Our article on [what DPI means](post:what-is-dpi) explains this in more detail.

## Same pixels, different print size

The print size is simply pixels divided by DPI. Here is a 1800 × 1200 pixel photo at different settings:

| DPI | Print size (inches) | Print size (cm) |
|---|---|---|
| 72 | 25 × 16.7 | 63.5 × 42.3 |
| 150 | 12 × 8 | 30.5 × 20.3 |
| 300 | 6 × 4 | 15.2 × 10.2 |
| 600 | 3 × 2 | 7.6 × 5.1 |

Higher DPI means a smaller, denser print from the same pixels. That is why 300 DPI is the usual target for sharp photo prints, while screens ignore the value entirely.

## No quality loss for JPG and PNG

For JPG and PNG files, only the DPI value stored in the file is rewritten. The image data is not re-compressed, so the quality is identical to the original and the file size barely changes.

For JPG, both the JFIF header and the EXIF resolution are updated. That matters, because different programs read different places: Windows Properties, Photoshop and print shops will all see the new value. For PNG, the DPI is written in the pHYs chunk, the standard place for resolution in PNG files.

Other formats (WebP, AVIF, GIF and BMP) are converted to PNG with the DPI set. PNG is lossless and reliably stores a DPI value, so the converted file looks the same as the original while carrying the new resolution.

## When you need more pixels, not more DPI

If a print shop needs a 4 × 6 inch photo at 300 DPI, the image must be at least 1200 × 1800 pixels. Setting the DPI alone cannot get you there if the photo is smaller. To produce an exact print size, use [Resize image in cm](tool:resize-image-in-cm), which sets both the pixel dimensions and the DPI for the size you need. Keep in mind that enlarging a small image adds pixels but not detail, so always start from the largest original you have.

Not sure whether your file is big enough? The [Check image DPI](tool:check-image-dpi) tool shows the stored DPI and the largest size the image prints sharply at 300 DPI.

## Common problems and fixes

- **The form still says the DPI is wrong.** Some checkers read EXIF only, others read JFIF. This tool updates both for JPG, so download the new file and upload that one, not the original.
- **The image prints tiny after setting 300 DPI.** The photo has too few pixels for a large print. Resize to the size you need instead.
- **The file looks the same on screen.** That is expected. Screens show pixels and ignore DPI.
- **My WebP came back as a PNG.** WebP, AVIF, GIF and BMP are saved as PNG so the DPI is stored reliably. If you need a JPG, convert the PNG and set the DPI again.
- **The PNG is larger than expected.** Files converted from compressed formats such as WebP become lossless PNGs. Use the [Image Compressor](tool:compress-image) if size matters more than the DPI value.

## Which DPI should you choose?

Always follow the exact value you were given. If nobody specified one, these are the usual starting points:

| Purpose | DPI to set | Note |
|---|---|---|
| Website, social media, email | 72 or 96 | Screens ignore DPI; any value works |
| Posters and large prints seen from a distance | 150 or 200 | Fewer pixels needed per inch |
| Photo prints, brochures, documents | 300 | The most common print request |
| Line art, logos, detailed scans | 600 | Only useful if the image has the pixels |

## Practical tips

Ask the printer what size they will print before changing anything, then check that pixels divided by the DPI gives at least that size. If an upload form only asks for "300 DPI" and states no print size, setting the value here is usually all it needs. For anything shown only on screens, the DPI value makes no difference, so leave it alone.

## Private and free

Your photos never leave your device. There is no upload, no account and no watermark, and the tool works on Windows, Mac, Android and iPhone.

<!-- more -->
## Related guides

- [How to check if a photo is 300 DPI](post:how-to-check-if-photo-is-300-dpi)
- [Image size in inches: a print guide](post:image-size-in-inches-print-guide)

## Changing DPI for a batch of files

Drop all the photos for one job together, pick the DPI once and click **Download all**. Every file keeps its own pixel dimensions, and each result shows its own print size, so you can quickly spot any image that would print smaller than the rest.
