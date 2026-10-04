---
title: How to Resize an Image in Photoshop (and a Faster Free Way)
category: Resizing
tool: image-resizer
seo_title: How to Resize an Image in Photoshop – Plus a Free Faster Alternative
seo_desc: Step-by-step: resize an image in Photoshop with Image Size, keep quality and set DPI. Or skip Photoshop and resize free in your browser in seconds.
excerpt: The exact Photoshop steps for resizing without distortion, and a free browser alternative when you just need it done.
---

Photoshop is the classic tool for resizing images, and it does the job well. But if all you need is a photo at a specific size, opening a professional editor can feel like using a crane to lift a cup. This guide covers both: the proper Photoshop method, and a faster free alternative.

## Resizing in Photoshop, step by step

1. Open your image and choose **Image → Image Size** (shortcut **Alt+Ctrl+I** on Windows, **Option+Cmd+I** on Mac).
2. Make sure the **chain icon** between Width and Height is linked so the proportions stay the same.
3. Choose the unit: **Pixels** for screens, **Centimeters** or **Inches** for print.
4. Type the new width. The height updates automatically.
5. For print, set **Resolution** to 300 pixels per inch.
6. Keep **Resample** ticked if you want to change the pixel count. Untick it if you only want to change the print size without altering pixels.
7. Click **OK**, then **File → Export → Export As** or **Save a Copy** to save the result.

### Which resample option should you choose?

Photoshop's **Automatic** setting is a sensible default. For reducing size, **Bicubic Sharper** keeps edges crisp. For enlarging, **Preserve Details 2.0** gives the best results, although no method can invent detail that was never captured.

### Resizing to an exact size with a different shape

If you need, say, 1080×1350 from a landscape photo, Image Size will either distort the picture or refuse to match both numbers. Use the **Crop tool (C)** with a ratio of 4:5 first, then resize. Alternatively, use **Image → Canvas Size** to add a border around the picture.

## The faster free way

For everyday tasks, a browser tool is quicker. The [Lumi Pix Image Resizer](tool:image-resizer) does the same job without an account or installation, and your photos never leave your device.

1. Drop one or more images onto the page.
2. Type the width and height, or tap a preset.
3. Choose a unit: px, %, cm, mm or inch. For print, set the DPI.
4. Pick how the image should fit: **Fit** adds a background, **Fill** crops the edges, **Stretch** forces the exact size.
5. Download.

It also handles a few things that take extra steps in Photoshop:

- **Batch resizing:** drop up to 20 images and they are all resized at once.
- **DPI in the file:** when you resize in centimetres or inches, the DPI is written into the JPG so it prints at the right size.
- **Social presets:** the [Instagram resizer](tool:resize-image-for-instagram) has portrait, square and story sizes ready to go.

## Which should you use?

| Task | Best choice |
|---|---|
| Retouching, layers, detailed editing | Photoshop |
| One-off resize for a form, website or social post | Browser tool |
| Resize 20 photos to the same size | Browser tool |
| Print sizing with DPI | Either |
| No Photoshop licence | Browser tool |

If the file also needs to meet a KB limit, resize first, then use the [Image Compressor](tool:compress-image). Our guide on [reducing image size in KB](post:how-to-reduce-image-size-in-kb) explains why that order gives the best result.

## Resizing for common tasks, compared

Here is how the same jobs look in Photoshop and in the browser.

| Task | In Photoshop | In the browser |
|---|---|---|
| 1200 px wide for a blog | Image Size, type 1200, export | Type 1200 with the lock on, download |
| 1080×1350 for Instagram | Crop at 4:5, then Image Size | Tap the Instagram portrait preset |
| Passport photo 35×45 mm | New canvas at 300 ppi, place and crop | Open the passport photo maker, choose the size |
| 20 product photos to 1000×1000 | Record an action, run a batch | Drop 20 photos, set 1000×1000, Download all |
| Print at 6×4 inches | Image Size in inches at 300 ppi | Unit inch, DPI 300, type 6×4 |

Photoshop gives you more control at every step, but for these everyday jobs the browser route takes a fraction of the time.

## Photoshop batch resizing with actions

If you do use Photoshop for many files, an action saves repetition:

1. Open one image, then open the **Actions** panel and click **Create new action**.
2. Perform the resize with **Image → Image Size** and save the file.
3. Stop recording.
4. Choose **File → Automate → Batch**, pick your action and the source folder, and run it.

The [Image Resizer](tool:image-resizer) does the same for up to 20 images without recording anything: drop them, set the size and click **Download all**.

## Keeping quality when you resize

Whatever tool you use, these rules protect quality:

- **Resize from the original.** Each round of resizing and saving loses a little detail.
- **Reduce rather than enlarge.** Making an image smaller keeps it sharp; enlarging can only stretch existing pixels.
- **Use the right format.** JPG for photos, PNG for graphics and text. See [PNG vs JPG](post:png-vs-jpg) for the details.
- **Sharpen lightly after a big reduction.** Photoshop's **Unsharp Mask** at a low amount restores crispness; browser tools apply high-quality resampling automatically.

## Free alternatives to Photoshop

Besides browser tools, there are free desktop editors:

- **GIMP** (Windows, Mac, Linux): **Image → Scale Image** works much like Photoshop's Image Size.
- **Paint** (Windows): **Resize** by percentage or pixels, best for quick jobs.
- **Preview** (Mac): **Tools → Adjust Size**, with a handy list of common sizes.

These are good options when you also need to draw or annotate. For pure resizing, a dedicated tool is simpler.

## When the file also needs to be small

Resizing reduces file size, but not always enough for strict limits. After resizing, use the [Image Compressor](tool:compress-image) to reach a target such as 100KB. Our guide on [reducing image size in KB](post:how-to-reduce-image-size-in-kb) explains why resizing first and compressing second gives the best result.

## Key takeaways

- **Image → Image Size** is the Photoshop command for resizing; keep the chain linked to avoid distortion.
- **Crop first** when the new shape differs from the original, then resize.
- **Reduce rather than enlarge** wherever possible; enlarging cannot add real detail.
- **For everyday jobs**, a browser resizer is faster and handles presets, print sizes and batches without a licence.
- **Resize first, compress second** when a file also has to meet a KB limit.

<!-- topup -->
<!-- expanded -->
## Frequently asked questions

### How do I resize an image in Photoshop without losing quality?

Reduce rather than enlarge where possible, keep the proportions linked, and use Bicubic Sharper when making images smaller. Save as a high-quality JPG or PNG.

### How do I resize in Photoshop without stretching the image?

Keep the chain icon linked in Image Size. If you need a different shape, crop to the new ratio first or add canvas.

### Is there a free alternative to Photoshop for resizing?

Yes. Browser tools such as the Lumi Pix Image Resizer resize in pixels, centimetres or inches with DPI for free, without uploading your photos.

### What is the shortcut for Image Size in Photoshop?

Alt+Ctrl+I on Windows and Option+Cmd+I on Mac.

### Can I resize images in Photoshop Express or on my phone?

Yes, mobile editors offer basic resizing. For exact pixel or print sizes, a browser tool with units and DPI is often quicker.
