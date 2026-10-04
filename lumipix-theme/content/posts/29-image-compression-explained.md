---
title: Image Compression Explained: Lossy vs Lossless in Plain English
category: Compression
tool: compress-image
seo_title: What Is Image Compression? Lossy vs Lossless Explained Simply
seo_desc: How image compression works, the difference between lossy and lossless, why JPGs get blocky and how to compress images well. A non-technical guide.
excerpt: What actually happens when an image is compressed, and why some methods lose quality while others do not.
---

Every image you see online has been compressed. Without compression, a single phone photo would take around 36MB, and web pages would load painfully slowly. This guide explains, without the maths, how compression works and how to use it well.

## Why images need compressing

A photo is a grid of pixels, and each pixel stores colour information, typically three bytes. A 12-megapixel photo therefore needs about 36 million bytes in raw form. Compression finds ways to store the same picture in far fewer bytes.

## Lossless compression

Lossless compression shrinks the file **without changing a single pixel**. It works by spotting patterns. If a row has 500 identical white pixels, it is more efficient to store "500 × white" than to list each one.

PNG uses lossless compression. It works brilliantly for logos, diagrams and screenshots with large flat areas, but not for photos, where neighbouring pixels are rarely identical.

## Lossy compression

Lossy compression achieves much bigger savings by **discarding information people are unlikely to notice**. JPG, for example:

1. separates brightness from colour, because our eyes are more sensitive to brightness detail;
2. stores colour at lower resolution;
3. splits the image into small blocks and simplifies fine detail within each block.

The **quality setting** controls how aggressively detail is simplified. At high quality the changes are invisible. At very low quality, the blocks become visible as "artefacts": blocky skies, smudged edges and halos around text.

## Lossy vs lossless at a glance

| | Lossless | Lossy |
|---|---|---|
| Changes pixels? | No | Yes, slightly |
| Typical savings for photos | Small | Very large |
| Formats | PNG, lossless WebP | JPG, lossy WebP, AVIF |
| Best for | Graphics, text, editing | Photos for web, email, forms |

## Why re-saving JPGs makes them worse

Each time a JPG is decoded and saved again, the lossy steps run again and a little more detail is lost. After many rounds, images become visibly degraded. That is why you should always compress from the original file, and why images forwarded through messaging apps look worse over time.

## Resolution vs compression

Two different things make a file smaller:

- **Fewer pixels** (resizing), and
- **fewer bytes per pixel** (compression).

For a strict limit, the best result usually comes from a combination: a sensible pixel size plus moderate compression. That is exactly what the [Image Compressor](tool:compress-image) does when you give it a target such as [50KB](tool:compress-image-to-50kb). For practical tips, see [how to lower image file size without losing quality](post:how-to-lower-image-file-size).

## Newer formats

WebP and AVIF use more advanced techniques to get smaller files at the same visual quality and support both lossy and lossless modes. Our [WebP vs JPG guide](post:webp-vs-jpg) explains when to use them.

## How file size relates to what is in the picture

Compression works by finding patterns and removing detail the eye will not miss. That means the content of an image strongly affects its final size:

| Image content | Compresses | Why |
|---|---|---|
| Clear sky, plain wall, studio background | Very well | Large smooth areas |
| Portrait with soft background | Well | Smooth skin and blur |
| City street, foliage, gravel | Poorly | Fine detail everywhere |
| Screenshot with flat colours | Very well as PNG | Repeated identical pixels |
| Photo noise from low light | Poorly | Random detail is hard to compress |

This is why two photos with the same dimensions can produce very different file sizes, and why a plain background helps when you need to hit a strict limit.

## Chroma subsampling in plain English

One trick JPG uses is called chroma subsampling. The eye notices changes in brightness far more than changes in colour, so JPG stores colour at a lower resolution than brightness. For photos this is invisible. For images with thin coloured lines or red text on blue, it can cause slight colour fringing, which is another reason to save graphics as PNG.

## Compression artefacts and how to spot them

- **Blocking:** visible 8×8 squares in smooth areas such as skies.
- **Ringing:** halos around sharp edges and text.
- **Banding:** smooth gradients turning into visible steps.
- **Smearing:** fine textures such as hair or grass becoming mushy.

If you see these at normal viewing size, the image has been compressed too hard. The fix is usually to reduce the dimensions a little and use a higher quality.

## How a target-size compressor works

When you ask the [Image Compressor](tool:compress-image) for, say, 100KB, it does not simply pick a quality number. It:

1. tries a high quality first and checks the size;
2. if the file is too large, searches for the highest quality that fits;
3. if that quality would be too low, reduces the dimensions slightly and searches again.

This is the same process an expert would follow by hand, done in a second. The presets, such as [compress to 50KB](tool:compress-image-to-50kb) and [compress to 200KB](tool:compress-image-to-200kb), run the same logic with the target already set.

## Compression in everyday apps

Many apps compress images without asking. Messaging apps reduce photos to save data, social networks recompress uploads, and some cloud services offer "storage saver" modes. This is why a photo forwarded several times looks worse each time. When quality matters, share the original file as a document, or compress it yourself once to a sensible size before sending.

## Choosing the right approach

- **For a strict upload limit:** use a target-size compressor.
- **For a website:** resize to the displayed width, then compress to around 100–300KB, or use WebP. See [WebP vs JPG](post:webp-vs-jpg).
- **For archiving:** keep the originals untouched.
- **For graphics and screenshots:** use PNG, which is lossless. See [PNG vs JPG](post:png-vs-jpg).

Understanding the trade-off between pixels and quality lets you make smaller files that still look great, which is the whole point of compression.

## Key takeaways

- **Lossless** keeps every pixel; **lossy** removes detail you are unlikely to see.
- **Fewer pixels plus moderate quality** beats many pixels at very low quality.
- **Avoid re-saving JPGs repeatedly**; always start from the original.

<!-- topup -->
<!-- expanded -->
## Frequently asked questions

### Does compressing an image reduce its quality?

Lossless compression does not. Lossy compression removes some detail, but at sensible settings the difference is not visible.

### Which is better, lossy or lossless?

Lossy for photos where small files matter. Lossless for graphics, text and images you will edit further.

### Why does my compressed image look blocky?

The quality setting was too low for the image's size. Reduce the dimensions a little so a higher quality fits the same file size.

### Why do some photos compress much smaller than others?

Smooth areas such as skies and plain walls compress very well, while detailed textures such as leaves or gravel need many more bytes.

### Does sending photos on messaging apps reduce their quality?

Usually yes. Many apps compress photos to save data. Send the original as a document if quality matters.
