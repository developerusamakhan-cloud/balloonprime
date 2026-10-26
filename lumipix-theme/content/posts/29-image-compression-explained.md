---
keywords: image compression, lossy vs lossless, lossy compression, lossless compression, jpg compression
title: Image Compression Explained: Lossy vs Lossless in Plain English
category: Compression
tool: compress-image
seo_title: What Is Image Compression? Lossy vs Lossless Explained Simply
seo_desc: How image compression works, the difference between lossy and lossless, why JPGs get blocky and how to compress images well. A non-technical guide.
excerpt: What actually happens when an image is compressed, and why some methods lose quality while others do not.
---

Every image you see online has been compressed. Without it, a single phone photo would be around 36MB and web pages would crawl. This is image compression explained without the maths: how it works, and how to use it well.

## Why images need compressing

A photo is a grid of pixels, and each pixel stores colour information, usually three bytes. So a 12 megapixel photo needs about 36 million bytes in its raw form. Compression finds clever ways to store the same picture in far fewer bytes.

## Lossless compression

Lossless compression makes the file smaller **without changing a single pixel**. It works by spotting patterns. If a row has 500 identical white pixels, it's much cheaper to store "500 x white" than to list each one.

PNG uses lossless compression. It's brilliant for logos, diagrams and screenshots with big flat areas, but not for photos, where neighbouring pixels are rarely identical.

## Lossy compression

Lossy compression makes much bigger savings by **throwing away information you're unlikely to notice**. JPG, for example:

1. separates brightness from colour, because your eyes are more sensitive to brightness detail
2. stores the colour at a lower resolution
3. splits the image into small blocks and simplifies the fine detail inside each one

The **quality setting** controls how hard that simplifying goes. At high quality you can't see the changes. At very low quality the blocks start showing: blocky skies, smudged edges and halos around text.

## Lossy vs lossless at a glance

| | Lossless | Lossy |
|---|---|---|
| Changes pixels? | No | Yes, slightly |
| Typical savings for photos | Small | Very large |
| Formats | PNG, lossless WebP | JPG, lossy WebP, AVIF |
| Best for | Graphics, text, editing | Photos for the web, email, forms |

## Why saving a JPG again makes it worse

Every time a JPG is opened and saved again, the lossy steps run again and a little more detail goes. After many rounds, the image looks noticeably worse. That's why you should always compress from the original, and why photos forwarded through chat apps look worse and worse over time.

## Resolution vs compression

Two different things make a file smaller:

- **fewer pixels** (resizing), and
- **fewer bytes per pixel** (compression).

For a strict limit, the best result nearly always comes from both: a sensible pixel size plus moderate compression. That's exactly what the [image compressor](tool:compress-image) does when you give it a target like [compress image to 50KB](tool:compress-image-to-50kb). For practical tips, see [how to lower image file size without losing quality](post:how-to-lower-image-file-size).

## What's in the picture changes everything

Compression works by finding patterns and removing detail your eye won't miss. So what's in an image has a big effect on its final size:

| Image content | Compresses | Why |
|---|---|---|
| Clear sky, plain wall, studio background | Very well | Big smooth areas |
| Portrait with a soft background | Well | Smooth skin and blur |
| Busy street, leaves, gravel | Poorly | Fine detail everywhere |
| Screenshot with flat colours | Very well as PNG | Lots of identical pixels |
| Grainy low light photo | Poorly | Random detail is hard to compress |

That's why two photos with the same dimensions can end up very different sizes, and why a plain background helps when you're trying to hit a strict limit.

## Chroma subsampling, in plain English

One trick JPG uses is called chroma subsampling. Your eye notices changes in brightness far more than changes in colour, so JPG stores colour at a lower resolution than brightness. In photos you'll never see it. In images with thin coloured lines, or red text on blue, it can cause slight colour fringing. That's another reason to save graphics as PNG.

## Spotting compression problems

- **Blocking.** Visible 8 x 8 squares in smooth areas like skies.
- **Ringing.** Halos around sharp edges and text.
- **Banding.** Smooth gradients turning into visible steps.
- **Smearing.** Fine textures like hair or grass going mushy.

If you see these at normal viewing size, the image has been squeezed too hard. The fix is usually to make it a little smaller in pixels and use a higher quality.

## How a target size compressor works

When you ask the image compressor for, say, 100KB, it doesn't just pick a quality number. It:

1. tries a high quality first and checks the size
2. if the file's too big, searches for the highest quality that fits
3. if that quality would be too low, shrinks the dimensions slightly and searches again

It's the same process an expert would follow by hand, done in about a second. The ready-made pages, like [compress image to 200KB](tool:compress-image-to-200kb), run the same logic with the target already set.

## Compression in everyday apps

Lots of apps compress images without asking. Chat apps shrink photos to save data, social networks recompress uploads, and some cloud services have "storage saver" modes. That's why a photo forwarded several times looks worse each time. When quality matters, send the original as a document, or compress it yourself once to a sensible size before sending.

## Newer formats

WebP and AVIF use more advanced techniques to get smaller files at the same quality, and they support both lossy and lossless modes. Our [WebP vs JPG guide](post:webp-vs-jpg) explains when to use them, and you can [convert PNG to WebP](tool:png-to-webp) when you want lighter images on a website.

## Choosing the right approach

- **For a strict upload limit:** use a target size compressor.
- **For a website:** resize to the width it's shown at, then compress to around 100 to 300KB, or use WebP.
- **For keeping:** leave the originals untouched.
- **For graphics and screenshots:** use PNG, which is lossless. See [PNG vs JPG](post:png-vs-jpg).

Once you understand the trade-off between pixels and quality, you can make small files that still look great. And that's really the whole point.

## The short version

- **Lossless** keeps every pixel. **Lossy** removes detail you're unlikely to see.
- **Fewer pixels at moderate quality** beats lots of pixels at very low quality.
- **Don't keep saving JPGs over and over.** Always start from the original.

<!-- topup -->
<!-- expanded -->
## Frequently asked questions

### Does compressing an image reduce its quality?

Lossless compression doesn't. Lossy compression removes some detail, but at sensible settings you won't see the difference.

### Which is better, lossy or lossless?

Lossy for photos where small files matter. Lossless for graphics, text and images you'll edit further.

### Why does my compressed image look blocky?

The quality was too low for the image's size. Make it a little smaller in pixels so a higher quality fits in the same file size.

### Why do some photos compress much smaller than others?

Smooth areas like skies and plain walls compress really well, while detailed textures like leaves or gravel need far more bytes.

### Does sending photos on messaging apps reduce their quality?

Usually, yes. Many apps compress photos to save data. Send the original as a document if quality matters.
