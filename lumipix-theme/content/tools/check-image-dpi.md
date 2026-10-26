---
keywords: image resolution checker, image dpi checker, image dpi check, how to find image dpi, check image dpi
seo_desc: Free image resolution checker: see the stored DPI, pixel size and the largest sharp print at 300 DPI for up to 20 photos. Nothing is uploaded or changed.
---

"Is my photo 300 DPI?" usually comes up right before a print order, or when a form says "minimum 300 DPI". Drop your photo into this image resolution checker and you'll see its DPI and, more usefully, how big it can print and still look sharp. Nothing is changed, and nothing is uploaded.

## Two parts to the answer

Most people only look at one of them. The first is the DPI value written inside the file. The second, which matters more, is whether the image has enough pixels for the size you want to print. This checker shows both, for up to 20 images at once.

## How to check the DPI of an image

1. **Drop your images**, up to 20 at a time, from your computer or phone.
2. **Read the results.** Each image gets its own card with the details below.
3. **Need a different value?** Use the button under the results to open the Change DPI tool.

Nothing is saved, edited or downloaded. Your files stay exactly as they were.

## What you'll see

| Result | What it means |
|---|---|
| Stored DPI and source | The value in the file and where it was found: JFIF, EXIF or PNG pHYs |
| No DPI stored | The file has no value, so most apps assume 72 or 96 |
| Pixel dimensions | Width x height in pixels, the real measure of detail |
| Print size at stored DPI | How big it prints if software follows the file's value |
| Largest sharp print at 300 DPI | The biggest size in cm and inches for a crisp print |
| Verdict | A quick summary, like "Big enough for a 4x6 in print at 300 DPI" |

## Where DPI is stored

A JPG can keep its DPI in two places: the JFIF header and the EXIF data. Different programs read different places, which is why Windows Properties and an online form can disagree about the same photo. The checker tells you which one it found. PNG files keep the value in a block called pHYs. Lots of files, including most screenshots and images saved from websites or chat apps, have no DPI at all. Then the result says **No DPI stored**, and apps fall back to their own default, usually 72 or 96.

## Why pixels matter more than the number

DPI is just a label that sets the print size. It doesn't add or remove detail. A 600 x 400 pixel image tagged 300 DPI prints sharply at only 2 x 1.33 inches. A 3000 x 2000 pixel image tagged 72 DPI can print sharply at 10 x 6.67 inches once its DPI is set to 300. That's why the most useful line in the results is the largest size the image prints sharply at 300 DPI. Our article on [what DPI means](post:what-is-dpi) covers this properly.

## Pixels needed at 300 DPI

Compare your pixel dimensions with this table. If your image is at least this big, it can print sharply at that size.

| Print size | Pixels needed at 300 DPI |
|---|---|
| 10 x 15 cm | 1181 x 1772 |
| 4 x 6 in | 1200 x 1800 |
| 5 x 7 in | 1500 x 2100 |
| 8 x 10 in | 2400 x 3000 |
| A4 (210 x 297 mm) | 2480 x 3508 |

For more sizes and the maths behind them, see the [print size guide in inches](post:image-size-in-inches-print-guide).

## What to do next

- **Enough pixels, wrong DPI number.** The image is fine, only the label is off. You can [change image DPI](tool:change-image-dpi) to 300. For JPG and PNG that rewrites the value without compressing the photo again.
- **Not enough pixels for your print.** Pick a smaller print size, or find a bigger original. To prepare a file for an exact size like 10 x 15 cm, [resize image into inches](tool:resize-image-in-cm) or centimetres, but remember that enlarging adds pixels, not real detail.
- **No DPI stored.** Very common and usually harmless. If a print shop or form insists on a value, set one with the Change DPI tool.
- **It's only for screens.** Forget about DPI. Websites, phones and social apps show pixels, not inches.

## Things that confuse people

- **Another app shows a different DPI.** Programs read different headers, and some show their own default when nothing is stored. The checker names the exact source it found, so you know what the file really says.
- **My phone photo shows 72 DPI, or none.** That says nothing about its quality. Phone photos usually have plenty of pixels. Look at the largest sharp print line instead.
- **A downloaded image says No DPI stored.** Websites and apps often drop this when they save or compress images. It doesn't mean the image is low quality.
- **The verdict says it's too small.** DPI can't fix that. Use a bigger original or print smaller.

The checker reads your files on your own device. No upload, no account and no watermark, on Windows, Mac, Android and iPhone.

<!-- more -->
## Checking a batch before a print order

Drop every photo for the order at once and look down the verdicts first. Any image that isn't big enough for your planned size stands out straight away. Fix the label on the rest with the Change DPI tool, and replace or shrink the few that are too small before you send the order. Our walkthrough on [how to check if a photo is 300 DPI](post:how-to-check-if-photo-is-300-dpi) shows the same checks on Windows, Mac and phones. Printing passport photos? The [passport size photo creator](tool:passport-size-photo) handles the size and DPI in one go.
