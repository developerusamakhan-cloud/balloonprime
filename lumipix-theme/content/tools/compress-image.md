## Compress images to the exact size you need

Most image compressors give you a quality slider and leave you to guess. You move it, save, check the file size, and try again. The Lumi Pix Image Compressor works the other way round: you tell it the size you need, such as 20KB, 100KB or 1MB, and it finds the sharpest version of your image that fits under that limit.

It runs entirely in your browser. Your photos are never uploaded to a server, which makes it fast on slow connections and safe for personal documents such as ID cards, certificates and signatures.

## How to use the compressor

1. **Choose a target.** Tap one of the quick sizes or type your own number and pick KB or MB.
2. **Drop your images.** Drag them onto the drop area, click **Choose files**, or paste an image with Ctrl+V. You can add up to 20 at once.
3. **Download.** Each result shows its new size and a **Fits target** badge. Download files one by one or use **Download all**.

If you change the target after adding images, they are compressed again automatically.

## How the target-size engine works

Behind the scenes, the compressor does what an expert would do by hand, in about a second:

1. It tries a high quality first. If that already fits, you get the best possible result.
2. If not, it searches for the highest quality that still fits your limit.
3. If that quality would be too low to look good, it reduces the image dimensions slightly and searches again.

This balance matters. A large photo squeezed into a small file at very low quality looks blocky. A slightly smaller photo at a sensible quality looks clean. The compressor always aims for the clean result.

## Which target should you choose?

| Use | Typical target |
|---|---|
| Signature for an online form | 10–30KB |
| Passport-style photo for a form | 20–100KB |
| Document scan, ID card, certificate | 100–300KB |
| Profile picture | 100–200KB |
| Website image | 100–300KB |
| Email attachment | Under 1MB |

When a form gives a limit, always follow it exactly. Our guide to [compressing photos for online application forms](post:compress-photo-for-online-forms) walks through a complete example with a photo, signature and document.

## Ready-made sizes

If you know the limit, these pages open with the target already set:

- [Compress to 20KB](tool:compress-image-to-20kb) for signatures and small profile photos
- [Compress to 50KB](tool:compress-image-to-50kb) for passport-style photographs
- [Compress to 100KB](tool:compress-image-to-100kb), the most common form limit
- [Compress to 200KB](tool:compress-image-to-200kb) for document scans
- [Compress to 1MB](tool:compress-image-to-1mb) when you want to keep nearly all the detail

For recruitment forms, there are dedicated pages for [PPSC](tool:compress-photo-for-ppsc), [FPSC](tool:compress-photo-for-fpsc) and [NTS](tool:compress-photo-for-nts) with suitable quick sizes.

## JPG or WebP?

By default, results are saved as **JPG**, which every website and form accepts. If you are preparing images for your own website, choose **WebP** under **Save as**; WebP files are usually smaller at the same visual quality. If your browser cannot create WebP, the tool falls back to JPG automatically.

PNG files you add are converted to JPG, which is far more efficient for photos. Transparent areas become white. If you need to keep transparency, use the [Image Resizer](tool:image-resizer) and save as PNG instead.

## Advanced option: maximum width

Under **Advanced options** you can set a maximum width in pixels. This is useful when:

- a form also limits the dimensions, for example to 600 pixels wide
- you are preparing images for a website and know the display width
- you want small text in a document to stay readable rather than very large but blurry

Leave it empty to let the compressor decide.

## Tips for the best result

- **Start from the original file.** Photos forwarded through messaging apps have already lost detail.
- **Crop first.** Removing empty background gives more of the file budget to what matters.
- **Use a plain background** for portraits; patterns and textures need many more bytes.
- **Check at 100% zoom** before uploading anything important.
- **Keep your originals.** Compression is permanent, so always work on a copy.

For a deeper explanation of what makes files large and how to shrink them without visible loss, read [how to lower image file size without losing quality](post:how-to-lower-image-file-size) and [how to reduce image size in KB](post:how-to-reduce-image-size-in-kb).

## Private by design

Many online compressors upload your images, process them on a server and send them back. Lumi Pix uses the image encoder built into your browser, so the work happens on your device. Nothing is stored, nothing is shared, and there is no account to create. When you close the tab, the images are gone from the page's memory.

## Works on every device

The compressor works in current versions of Chrome, Safari, Edge and Firefox on Windows, Mac, Android and iPhone. On a phone, tap **Choose files** to pick photos from your gallery; downloads are saved to the Downloads folder on Android and the Files app on iPhone. iPhone HEIC photos are converted to JPG automatically in Safari.

<!-- more -->
## Real-world scenarios

**A job application with three uploads.** The form wants a photo under 50KB, a signature under 20KB and a CNIC copy under 200KB. Set 50KB and drop the photo, then switch to 20KB for the signature, then 200KB for the ID card. Each result is ready in seconds.

**An email that keeps bouncing.** Ten holiday photos at 4MB each make a 40MB email. Set 1MB, drop all ten, and click **Download all**. The new set is under 10MB and looks the same on screen.

**A slow website.** Product photos straight from the camera slow every page. Set a maximum width of 1600 pixels under **Advanced options**, a target of 250KB, and process the whole folder in batches of 20.

**A marketplace listing.** Many listing sites limit images to around 1MB or less. Compress to the limit and your photos upload without errors, even on mobile data.

## Compression vs resizing

Compression makes the file smaller in kilobytes. Resizing changes the dimensions in pixels. They are related: fewer pixels almost always mean a smaller file. The compressor reduces dimensions only when necessary to reach your target. If you need exact dimensions, such as 600×800 pixels, use the [Image Resizer](tool:image-resizer) first, then compress here with the maximum width left empty.

## Supported formats

| You can open | You can save as |
|---|---|
| JPG, PNG, WebP, AVIF, GIF (first frame), HEIC in Safari | JPG or WebP |

PNG and other formats are converted to the format you choose. Animated GIFs are compressed as a still image.

## Frequently compared limits

| Target | Good for | Typical width of a portrait |
|---|---|---|
| 20KB | Signatures, thumbnails | 300–500 px |
| 50KB | Form photographs | 600–1000 px |
| 100KB | Most forms, profile photos | 1000–1600 px |
| 200KB | Documents, website images | 1500–2000 px |
| 1MB | Email, listings, sharing | Usually full size |

These are guides; each image compresses differently depending on its content.
