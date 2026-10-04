---
title: How to Convert PNG to JPG on a Mac
category: Formats & Printing
tool: image-resizer
seo_title: How to Convert PNG to JPG on Mac – Preview, Finder & Batch Methods
seo_desc: Convert PNG to JPG on macOS using Preview, Finder Quick Actions, or a free browser tool for batches. Control quality and file size.
excerpt: Preview, Finder and a batch-friendly browser method for turning PNGs into JPGs on macOS.
---

macOS has excellent built-in tools for converting images, if you know where to look. Here are the quickest ways to turn a PNG into a JPG on a Mac.

## Method 1: Preview

1. Open the PNG in **Preview** (double-click it).
2. Choose **File → Export**.
3. Set **Format** to **JPEG**.
4. Drag the **Quality** slider. Preview shows the resulting file size below it.
5. Click **Save**.

**Tip:** hold the Option key when opening the Format menu to see more formats.

## Method 2: Several files with Preview

1. Select all the PNGs in Finder and open them together in Preview.
2. In the sidebar, select all the thumbnails (Cmd+A).
3. Choose **File → Export Selected Images**, then click **Options**, set the format to JPEG and choose a folder.

## Method 3: Finder Quick Actions

In recent versions of macOS, select one or more images in Finder, right-click, and choose **Quick Actions → Convert Image**. Pick **JPEG** and a size, then click **Convert to JPEG**. The new files appear next to the originals.

## Method 4: A browser tool

If you also want to resize, set an exact pixel size, or choose the background colour for transparent areas, use the [Image Resizer](tool:image-resizer):

1. Drop up to 20 PNGs.
2. Set **Save as** to **JPG**. Use the **%** unit at 100 to keep the original size.
3. Pick a background colour for transparent areas.
4. Download.

Nothing is uploaded; the conversion happens in Safari, Chrome or Firefox on your Mac.

## Transparency and screenshots

Mac screenshots are saved as PNG by default, which is why they can be large. Converting them to JPG saves space, but text can look slightly soft. For screenshots with lots of text, PNG is often the better choice. Our [PNG vs JPG guide](post:png-vs-jpg) explains the trade-off, and the Windows version of this guide is [here](post:how-to-convert-png-to-jpg-on-windows).

## Hitting a size limit

If the JPG must be under a certain size for a form or email, use the [Image Compressor](tool:compress-image) and type the limit.

## Changing the default screenshot format

If you would rather your Mac saved screenshots as JPG from the start, you can change the default with a Terminal command:

`defaults write com.apple.screencapture type jpg`

Log out and back in, or restart, for it to take effect. To switch back to PNG, run the same command with `png` instead of `jpg`. Most people keep PNG for crisp text and convert only the screenshots they need to share.

## Converting HEIC photos at the same time

iPhone photos synced to a Mac are often HEIC files. Preview and the Finder **Convert Image** quick action can convert HEIC to JPEG in the same way as PNG. The browser method also accepts HEIC in Safari, which can decode it. If you want your iPhone to save JPG in the first place, choose **Settings → Camera → Formats → Most Compatible**.

## Controlling quality and file size

In Preview's export window, the **Quality** slider changes the JPG quality and shows the estimated file size. As a guide:

| Slider position | Typical use |
|---|---|
| Best | Archiving, printing |
| Around three quarters | Sharing, websites |
| Around half | Email, messaging |
| Least | Rarely useful; artefacts appear |

For an exact target, such as an online form limit, the [Image Compressor](tool:compress-image) is easier because you type the KB value directly.

## Using Automator or Shortcuts for many files

If you convert images regularly, the **Shortcuts** app on recent versions of macOS can convert images in bulk. Create a shortcut with the **Convert Image** action, set the format to JPEG, and add it to the Finder's Quick Actions. The Finder method described above does the same without setup, so start there.

## Troubleshooting

- **Transparent areas turn black or white:** JPG cannot store transparency. If you need a specific background colour, use the [Image Resizer](tool:image-resizer) and choose the colour before converting.
- **The JPG looks blurry:** the quality slider was too low. Export again at a higher setting.
- **The file is still large:** the image has a lot of pixels. Reduce the dimensions in **Tools → Adjust Size** before exporting.

## Mac vs Windows: same result, different menus

Whichever computer you use, the conversion is the same: the image is decoded and re-encoded as JPG. If you switch between machines, the Windows steps are in our [PNG to JPG on Windows guide](post:how-to-convert-png-to-jpg-on-windows). For deciding whether to convert at all, see [PNG vs JPG](post:png-vs-jpg), and for strict size limits, read [how to reduce image size in KB](post:how-to-reduce-image-size-in-kb).

## Keeping originals safe

Preview's **Export** creates a new file and leaves the original untouched. **Save** after changing the format in some apps may replace the original. When in doubt, use Export, or work on a copy, so you can always go back to the full-quality PNG.

## Key takeaways

- **Preview → File → Export → JPEG** converts a single image and shows the file size as you adjust quality.
- **Export Selected Images** in Preview, or the Finder **Convert Image** quick action, converts many files at once.
- **HEIC photos** from an iPhone convert to JPG in the same way.
- **Transparency is lost** in JPG; choose a background colour with a browser tool, or keep PNG.
- **Use Export, not Save**, to keep the original untouched.
- **For an exact KB limit**, use a target-size compressor after converting.

## Which method should you use?

For one image, Preview is quickest. For a folder of images, the Finder quick action saves time. If you also need to resize to an exact size, choose a background colour, or hit a file size for a form, a browser tool does it all in one step and works the same on any Mac.

<!-- topup -->
<!-- expanded -->
## Frequently asked questions

### How do I change a PNG to JPG on a Mac?

Open it in Preview, choose File → Export, set Format to JPEG and save.

### Can I convert many PNGs to JPG at once on a Mac?

Yes. Use Finder's Convert Image quick action, Preview's Export Selected Images, or drop them into a browser tool.

### Why is my JPG blurry after converting?

The quality slider was set low. Export again at a higher quality setting.

### How do I make my Mac save screenshots as JPG?

Run defaults write com.apple.screencapture type jpg in Terminal, then log out and back in.

### Can Preview convert HEIC to JPG?

Yes. Open the HEIC photo in Preview, choose File → Export and select JPEG.

### Does converting to JPG change the image dimensions?

Not unless you choose to resize. Preview and the Finder quick action keep the original size by default, and the browser tool keeps it when you use 100%.
