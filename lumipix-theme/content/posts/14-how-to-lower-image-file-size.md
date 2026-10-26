---
keywords: lower image file size, reduce file size without losing quality, make image smaller, shrink image file size, optimize images
title: How to Lower Image File Size Without Losing Quality
category: Compression
tool: compress-image
seo_title: How to Lower Image File Size Without Losing Quality
seo_desc: Seven practical ways to lower image file size without losing quality: dimensions, format, quality settings, metadata and more.
excerpt: Seven practical techniques that make images much smaller while keeping them looking sharp.
---

"Without losing quality" is the tricky part of making images smaller. All compression removes some information. The trick is to remove information nobody will ever notice. Use these seven ways to lower image file size together and you can often cut a file down to a small fraction of its size with no visible difference.

## 1. Match the dimensions to where the image is shown

This is the biggest win by far. A photo shown 800 pixels wide on a website doesn't need to be 4000 pixels wide. Bring the dimensions down to the size it's actually displayed at, or twice that for sharp screens, and most of the file disappears without any visible change. Use the [image resizer](tool:image-resizer).

## 2. Use a sensible JPG quality

A JPG quality of roughly 75 to 85 is the sweet spot for most photos. The file is far smaller than at 100, and the difference is very hard to spot. Below about 60, blocky patches start to show, especially around edges and in skies.

## 3. Pick the right format

- **Photos:** JPG or WebP
- **Logos, screenshots, flat graphics:** PNG
- **Websites that support it:** WebP or AVIF for both

A photo saved as PNG can easily be ten times the size of the same photo as JPG. Our [PNG vs JPG guide](post:png-vs-jpg) explains when to use which.

## 4. Crop out what you don't need

Empty sky, walls and floor still cost bytes. Crop tight around the subject and you cut the pixel count, so the detail that's left gets more of the file.

## 5. Let a tool find the quality for you

Instead of guessing a quality number, tell the tool the size you need. The [image compressor](tool:compress-image) looks for the highest quality that fits your limit and only shrinks the dimensions when it has to. That gives you the best possible image for the size.

## 6. Don't compress compressed images again

Every time a JPG is opened and saved again, a bit more detail goes. Images sent through chat apps are already heavily compressed. Go back to the original whenever you can.

## 7. Strip out what you can't see

Photos carry hidden data like camera details, location and sometimes a thumbnail preview. Saving the image again through a browser tool like Lumi Pix gives you a clean file without that extra baggage, which is also good for privacy.

## How much smaller can you expect?

| Starting point | After resizing and compressing |
|---|---|
| A 4MB phone photo for a website | 150 to 300KB |
| A 3MB photo for an email | 300KB to 1MB |
| A 5MB photo for a form | 50 to 100KB |

It depends on what's in the image. Fine textures like grass and gravel need more bytes than smooth skin and skies.

## A quick routine

1. Crop to the subject.
2. Resize to the display size.
3. Compress to your target, or use a preset like [compress image to 200KB](tool:compress-image-to-200kb).
4. Compare the result with the original at 100% zoom.

## Where the savings come from

Here's roughly what happens to a phone photo going onto a blog, step by step:

| Step | What changes | Effect on file size |
|---|---|---|
| The original from your phone | Around 4000 x 3000 pixels | Usually a few MB |
| Cropped to the subject | Fewer pixels | A bit smaller |
| Resized for the blog, about 1500 px wide | Far fewer pixels | Much smaller, often under 1MB |
| Compressed to a target | Same pixels, tuned quality | A few hundred KB or less |

Most of the saving comes from resizing, which is why it should always be the first step.

## Platform by platform

**WordPress and other websites.** Upload images at a sensible width, 1200 to 2000 pixels, instead of straight from the camera. You can also [convert PNG to WebP](tool:png-to-webp) for lighter pages.

**Email.** [Compress image to 1MB](tool:compress-image-to-1mb) per photo so messages send quickly and don't fill up the other person's inbox.

**Online forms.** Use the exact KB limit in the image compressor. Our [50KB guide](post:how-to-compress-image-to-50kb) explains the process in detail.

**Chat apps.** They compress images anyway. Sending one that's already compressed avoids a second heavy round and often looks better.

## What not to do

- **Don't use a very low quality on a big image.** Shrink the dimensions instead.
- **Don't save photos as PNG** to make them "better". It just makes them much bigger.
- **Don't save screenshots of text as low quality JPGs.** The text goes fuzzy. Use PNG or a higher quality.
- **Don't delete your originals.** Compression is permanent, so keep the full-size files for printing.

## Checking the quality properly

Compare the original and the compressed version side by side at 100% zoom, not zoomed out. Look at:

- **Skies and smooth gradients**, where banding shows up first.
- **Edges and text**, where blocky bits appear.
- **Faces and skin**, where too much compression looks waxy.

If it all looks right at the size the image will be shown, you're good.

## Doing a whole folder

When you've got lots of images, apply the same settings to all of them at once. You can [resize images in bulk](tool:resize-image-in-bulk), up to 20 at a time, download them, then drop the results into the compressor with your target size. Both tools run in your browser, so even a folder of private photos stays on your device. Want the theory behind it all? Read [image compression explained](post:image-compression-explained).

## The short version

- **Resize first.** Matching the dimensions to where the image is shown gives the biggest saving.
- **Use quality 75 to 85** for photos, or let a target size compressor choose.
- **Pick the right format:** JPG or WebP for photos, PNG for graphics.
- **Crop away empty space**, and don't compress already compressed images.
- **Keep your originals** for printing. Compression is permanent.

<!-- topup -->
<!-- expanded -->
## Frequently asked questions

### Can I reduce file size without any quality loss at all?

Lossless optimisation of PNG files can save a little with zero change, but for big savings you need lossy compression. At sensible settings, you won't see the difference.

### What JPG quality should I use?

Around 75 to 85 for photos is a good balance. If you have a specific limit, use a target size compressor.

### Why are photos from my phone so large?

Phone cameras capture 12 megapixels or more at high quality. Great for printing, but far more than websites, emails and forms need.

### What is the fastest way to reduce file size?

Reduce the pixel dimensions first. That usually removes most of the file size without any visible change at normal viewing size.

### Does lowering file size affect printing?

Yes, if you reduce the pixels below what the print size needs. Keep the originals for printing and use smaller copies online.
