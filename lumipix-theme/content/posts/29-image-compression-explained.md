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

## Frequently asked questions

### Does compressing an image reduce its quality?

Lossless compression does not. Lossy compression removes some detail, but at sensible settings the difference is not visible.

### Which is better, lossy or lossless?

Lossy for photos where small files matter. Lossless for graphics, text and images you will edit further.

### Why does my compressed image look blocky?

The quality setting was too low for the image's size. Reduce the dimensions a little so a higher quality fits the same file size.
