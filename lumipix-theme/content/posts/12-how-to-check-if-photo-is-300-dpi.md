---
title: How to Check if a Photo Is 300 DPI (and Change It if Not)
category: Formats & Printing
tool: image-resizer
seo_title: How to Check if a Photo Is 300 DPI – Windows, Mac and Online
seo_desc: Find the DPI of any image on Windows or Mac, understand what the number really means, and set a photo to 300 DPI correctly for printing.
excerpt: Where to find an image's DPI on Windows and Mac, what the number really means, and how to make a photo print-ready at 300 DPI.
---

Print shops, publishers and some application forms ask for images "at 300 DPI". Checking takes seconds, but the number is often misunderstood. Here is how to find it and what to do with it.

## How to check DPI on Windows

1. Right-click the image file and choose **Properties**.
2. Open the **Details** tab.
3. Under **Image**, look for **Horizontal resolution** and **Vertical resolution**. These show the DPI, for example 72 dpi or 300 dpi.

## How to check DPI on a Mac

1. Open the image in **Preview**.
2. Choose **Tools → Show Inspector** (or press Cmd+I).
3. The **General Info** tab shows **Image DPI**.

In Photoshop, the value is shown as **Resolution** in **Image → Image Size**.

## What the DPI number actually means

DPI is a **label** stored in the file that tells printing software how large to print it. It does not change the pixels. A 3000 × 2400 pixel image is:

- 10 × 8 inches at 300 DPI
- 41.7 × 33.3 inches at 72 DPI

Same image, same sharpness on screen, different print size. That is why the honest question is not "is it 300 DPI?" but "**does it have enough pixels for this print size at 300 DPI?**"

## Does my photo have enough pixels?

Multiply the print size in inches by 300:

- 4×6 inch print → needs 1200 × 1800 pixels
- 8×10 inch print → needs 2400 × 3000 pixels
- A4 → needs 2480 × 3508 pixels

If your image has at least that many pixels, it can print sharply at 300 DPI. Our [print size guide](post:image-size-in-inches-print-guide) has a full chart.

Phone photos often show 72 DPI in their properties even though they have millions of pixels. That is just the default label. The photo may still be perfect for printing.

## How to set a photo to 300 DPI

1. Open the [Image Resizer](tool:image-resizer).
2. Set the unit to **inch**, **cm** or **mm**, and DPI to **300**.
3. Enter the print size you want.
4. Under **Save as**, choose **JPG**, then download. The 300 DPI value is written into the JPG file, so its properties will show it.

If the image has fewer pixels than the print size needs, the resizer enlarges it. That fixes the label, but cannot add real detail, so very small images may still look soft when printed.

For passport and ID photos, the [passport photo maker](tool:passport-size-photo) sets 300 DPI automatically.

## Why do some forms ask for 300 DPI?

Organisations that print photos onto cards and certificates want enough detail for a clear print. Online-only forms usually care more about pixel dimensions and file size. If a form asks for both 300 DPI and a small file size, resize to the required physical size first, then [compress to the size limit](tool:compress-image).

## Frequently asked questions

### How do I know if my photo is 300 DPI?

On Windows, check Properties → Details → Resolution. On Mac, open Preview → Tools → Show Inspector and look for Image DPI.

### Is 72 DPI bad for printing?

Not necessarily. 72 DPI is just a label. What matters is whether the image has enough pixels for the print size at 300 DPI.

### Can I change 72 DPI to 300 DPI without losing quality?

Yes, if you only change the label and keep the pixels. The image will simply print smaller. Adding pixels to print larger cannot add real detail.
