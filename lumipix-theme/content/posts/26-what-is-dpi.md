---
title: What Is DPI? DPI vs PPI vs Pixels Explained Simply
category: Formats & Printing
tool: image-resizer
seo_title: What Is DPI? DPI vs PPI vs Pixels Explained in Plain English
seo_desc: DPI, PPI and pixels explained simply: what each means, when DPI matters, why 300 DPI is the print standard and why it does not matter on screens.
excerpt: A plain-English explanation of DPI, PPI and pixels, and the only time the number actually matters.
---

DPI is one of the most misunderstood terms in digital images. Forms ask for "300 DPI", phones save photos at "72 DPI", and people worry their pictures are low quality. Here is what the numbers really mean.

## Pixels: the real size of an image

A digital image is a grid of tiny coloured squares called pixels. A 4000 × 3000 image has 12 million of them, also called 12 megapixels. The pixel count is the image's true resolution. It decides how much detail it holds.

## PPI: pixels per inch

PPI (pixels per inch) describes how densely pixels are packed when an image is displayed or printed at a physical size. 300 PPI means 300 pixels in every inch.

## DPI: dots per inch

Strictly speaking, DPI describes how many ink dots a **printer** places per inch. In everyday use, and in most software, DPI and PPI are used interchangeably for the value stored in an image file. That is how this guide uses it too.

## The key point: DPI only matters for printing

The DPI value in a file is a **label**. It does not change the pixels. On a screen, a 1200 × 800 image looks exactly the same whether it is labelled 72 DPI or 300 DPI.

When you print, the label tells the software how big to make the print:

**print size (inches) = pixels ÷ DPI**

A 1200 × 1800 image prints at 4 × 6 inches at 300 DPI, or 8 × 12 inches at 150 DPI.

## Why 300 DPI?

At normal viewing distance, the human eye cannot distinguish individual pixels at around 300 per inch. That makes 300 DPI the standard for photos and documents held in the hand. Posters and banners viewed from further away look fine at 150 DPI or less.

## Common situations

**"The form asks for 300 DPI."** Make sure the image has enough pixels for the stated print size at 300 DPI, and set the DPI value in the file. The [Image Resizer](tool:image-resizer) does both when you resize in cm, mm or inches and save as JPG.

**"My phone photo says 72 DPI."** That is just a default label. A 12-megapixel phone photo can print sharply at up to about 13 × 10 inches at 300 DPI.

**"Can I increase DPI to improve quality?"** Changing the number does not add detail. Adding pixels by enlarging can smooth an image slightly, but real detail must come from the camera.

## How to check and change DPI

Our step-by-step guide on [how to check if a photo is 300 DPI](post:how-to-check-if-photo-is-300-dpi) covers Windows and Mac. For print sizes and the pixels each needs, see the [print size chart](post:image-size-in-inches-print-guide).

For passport and ID photos, the [passport photo maker](tool:passport-size-photo) sets the size and 300 DPI automatically.

## Quick reference

| Term | Means | Matters for |
|---|---|---|
| Pixels | The actual image size | Everything |
| PPI | Pixels per inch at a physical size | Printing, displays |
| DPI | Printer dots per inch (often used to mean PPI) | Printing |

## DPI myths, explained

**"Images for the web must be 72 DPI."** This is a leftover from early computer screens. Browsers ignore the DPI value completely; only pixel dimensions matter on screen.

**"A 300 DPI image is higher quality."** Not by itself. A 600×400 image at 300 DPI has exactly the same detail as the same image labelled 72 DPI.

**"Increasing DPI makes a photo sharper."** Changing the label does nothing to sharpness. Adding pixels can make a print larger, but the extra pixels are estimated, not real detail.

**"Phones take low-resolution photos because they say 72 DPI."** Phone photos have millions of pixels. The 72 is just a default label.

## Screen resolution: PPI on displays

Screens also have a pixel density. A typical laptop has around 100–150 pixels per inch, while phones often exceed 400. That is why the same image looks smaller and sharper on a phone. It also explains why websites use images at about twice the displayed size: high-density screens show more pixels in the same space.

## DPI for different jobs

| Job | What to set |
|---|---|
| Website, social media, email | Ignore DPI; set pixel dimensions |
| Online form asking for "300 DPI" | Correct pixel size for the stated print size, and 300 in the file |
| Photo prints and passport photos | 300 DPI at the exact print size |
| Posters and canvases | 150–200 DPI is usually enough |
| Scanning documents | 300 DPI; 600 DPI for fine detail or enlargement |

## Calculating DPI quickly

Divide the image width in pixels by the print width in inches. For centimetres, divide the pixels by the centimetres and multiply by 2.54.

- 2400 px over 8 inches = 300 DPI
- 1800 px over 15 cm = 120 pixels per cm × 2.54 ≈ 305 DPI

If the result is 300 or higher, the print will be sharp when held in the hand.

## Setting DPI correctly in practice

The simplest approach is to work in the units of the final job. In the [Image Resizer](tool:image-resizer), switch the unit to **cm**, **mm** or **inch**, enter the print size and the DPI, and save as **JPG**. The tool calculates the pixels and writes the DPI value into the file, so printers and photo labs size it correctly.

For passport and ID photos, the [passport photo maker](tool:passport-size-photo) does this automatically. If the file then needs to be smaller for an online form, the [Image Compressor](tool:compress-image) keeps the DPI value.

## When DPI is not the problem

If a print looks blurry even at 300 DPI, the cause is usually elsewhere: the photo was out of focus, it was heavily compressed earlier, or it was enlarged from a small original. Check the source image at 100% zoom on screen. If it is soft there, it will be soft in print too. Our guide on [how to lower image file size](post:how-to-lower-image-file-size) explains how compression affects detail.

## Summary

Pixels are the real resolution. DPI is an instruction for printing. Set pixels for screens, set DPI and print size together for paper, and do not worry about the 72 DPI label on phone photos.

<!-- expanded -->
## Frequently asked questions

### What does DPI mean?

DPI stands for dots per inch. In image files it is a label that tells printers how many pixels to place in each inch of paper.

### Is higher DPI better quality?

Only if the image also has more pixels. Changing the DPI label alone does not change quality, only the print size.

### What DPI should I use for screens?

It does not matter. Screens only care about pixel dimensions.

### Why do websites say images should be 72 DPI?

It is an old convention. Browsers ignore DPI; only the pixel dimensions affect how an image appears on screen.

### Is 300 DPI the same as 300 PPI?

In everyday use, yes. Strictly, PPI describes image pixels and DPI describes printer dots, but software uses the terms interchangeably for the value stored in a file.
