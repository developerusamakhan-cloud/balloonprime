# Lumi Pix (lumipix.tools): SEO master file

Read this first in every session. Update it in the same commit as any change to the site.
Last updated: 2026-11-07.

## 1. Goal and rules

- Goal: organic traffic from Google, then AdSense. Markets: **US and UK** (English pages).
- Keyword rule: **high search volume, low competition**. Target: US volume 1,000+/month and Ubersuggest SEO difficulty under 30. Check volume before building any page.
- Never invent facts or numbers. Volumes come from Ubersuggest (`keyword_overview`, locId 2840 = US) and carry the date checked.
- No long dashes anywhere. Natural, human tone. Built content in English (or the page's own language).
- Do not change titles, H1s or rewrite existing pages until **2026-12-04** (freeze, see section 6). Add new pages instead.
- Never delete content: retire with a 301 redirect (`lumipix-theme/inc/retired.php`).
- Do not touch other sites or other Ubersuggest projects (talkwyn.com is set up and stays as it is).
- Ask the owner before site-wide changes, deleting, or switching themes.

## 2. How the site is built

- WordPress, custom theme in `lumipix-theme/`. Live path `wp-content/themes/lumipix/`, written with the Lumipix WordPress MCP tools (`write_file`, `edit_file`). Every write is backed up and the site is auto-checked.
- Tools registry: `inc/tools.php`. Page copy: `content/tools/*.md`, guides: `content/posts/*.md`, other languages: `content/lang/{fr,pt}/`.
- Content only refreshes on the live site when `LUMIPIX_PACK_REV` in `inc/installer.php` is bumped (current: **13**; language pages use `LUMIPIX_LANG_REV` in `inc/lang.php`, current: **6**). Only "untouched" pages refresh (modified date = publish date). The Home page (ID 6) is touched, so edit it directly.
- Schema: tool pages output `WebApplication` + `FAQPage` (Rank Math's Article is removed on pages). Guides output `BlogPosting` with the author as an Organization.
- Author: all guides are credited to **Lumi Pix Team** (persona authors removed 2026-11-04; their archives 301 to the team archive).
- This container cannot open lumipix.tools directly (proxy blocks it). Use the MCP tools or ask the owner for screenshots.
- Speed (PageSpeed via Ubersuggest, 2026-11-06): mobile LCP 1.4 s, desktop LCP 0.4 s, CLS 0.002. Speed is not the problem. One redirect costs about 0.6 s on mobile (not fixed yet).

## 3. Keyword list (Ubersuggest, US, checked 2026-11-06)

### Active tool pages, sorted by volume

| Page (slug) | Main keyword | US volume | SD | Decision |
|---|---|---|---|---|
| webp-to-jpg | to convert webp to jpg | 22,200 | 13 | Keep, priority |
| png-to-jpg | turn png to jpg | 14,800 | 17 | Keep, priority |
| favicon-generator | favicon to ico | 12,100 | 16 | Keep, priority |
| webp-to-png | convert webp to png | 9,900 | 42 | Keep |
| image-resizer | resize image by size | 8,100 | 13 | Keep, priority |
| image-to-pdf | make jpg to pdf online | 8,100 (very seasonal) | 10 | Keep, priority |
| passport-size-photo | passport size photo creator | 5,400 | 19 | Keep, priority |
| avif-to-jpg | convert avif to jpg | 5,400 | 35 | Keep |
| background-remover | remove background for free online | 4,400 | 16 | Keep, priority |
| remove-white-background | remove white background from image | 4,400 | 56 | Keep |
| resize-image-for-instagram | resize photo for instagram | 3,600 | 16 | Keep, priority |
| change-image-dpi | how to change image dpi | 2,900 | 17 | Keep, priority |
| resize-image-in-bulk | resize image in bulk | 2,900 | 27 | Keep |
| passport-size-photo-india | passport size photo india | 2,400 | 24 | Keep |
| crop-image | crop image tools | 1,600 | 16 | Keep |
| svg-to-png | online svg to png converter | 1,600 | 27 | Keep |
| png-to-webp | convert png to webp | 1,600 | 44 | Keep |
| compress-image | reduce image size in online | 1,300 | 8 | Keep, hub for all KB sizes |
| resize-youtube-thumbnail | youtube thumbnail resizer | 1,000 | 16 | Keep |
| white-background-photo | passport photo with white background | 880 | 12 | Keep |
| check-image-dpi | image resolution checker | 720 | 10 | Keep |
| resize-image-in-cm | resize image into inches | 590 | 8 | Keep |
| canada-passport-photo | canada passport photo size | 480 | 25 | Keep, review later |
| compress-image-to-20kb | resize image to 20kb | 390 | 16 | Keep (ranked position 3 to 5 in GSC) |
| remove-black-background | remove black background from image | 390 | 37 | Keep, review later |
| resize-image-for-facebook | resize photo for facebook cover | 320 | 14 | Keep, review later |
| jpg-to-png | jpg to png online converter free | 320 | 16 | Keep, review later |
| resize-image-to-1920x1080 | resize image to 1920x1080 | 110 | 8 | Keep, review later |
| resize-signature | resize signature online | 10 | 13 | Keep for now (had GSC impressions at position 5), review later |

Portuguese: `pt/foto-3x4-online`, keyword "foto 3x4 online", Brazil volume 4,400, SD 19 (checked 2026-11-03). Page created 2026-10-26, not yet indexed on 2026-11-03.

### Retired on 2026-11-06 (301 redirect, page set to draft, nothing deleted)

| Old URL | US volume of main keyword | Redirects to |
|---|---|---|
| /compress-image-to-10kb/ | 20 | /compress-image-to-20kb/ |
| /compress-image-to-50kb/ | 140 | /compress-image/ |
| /compress-image-to-100kb/ | 210 | /compress-image/ |
| /compress-image-to-200kb/ | 110 | /compress-image/ |
| /compress-image-to-500kb/ | 90 | /compress-image/ |
| /compress-image-to-1mb/ | 260 | /compress-image/ |
| /compress-image-to-2mb/ | 390 | /compress-image/ |
| /compress-image-to-5mb/ | 110 | /compress-image/ |
| /compress-photo-for-ppsc-form/ | 0 (Pakistan) | /compress-image/ |
| /compress-photo-for-fpsc-form/ | not checked, Pakistan only | /compress-image/ |
| /compress-photo-for-nts-form/ | not checked, Pakistan only | /compress-image/ |

Reason: 12 near-identical preset pages with little US demand on a one-month-old site. To undo, remove the entry from `lumipix_retired_tools()` and republish the page.

### French pages (France, Ubersuggest, checked 2026-11-07)

Built 2026-10-18 (theme 1.8.0). No keyword research was recorded when they were made; volumes were checked afterwards.

| Page | Main keyword | France volume | SD |
|---|---|---|---|
| fr/image-en-pdf | image en pdf | 49,500 | 35 |
| fr/compresser-image | compresser image | 33,100 | 22 |
| fr/redimensionner-image | redimensionner image | 18,100 | 25 |
| fr/supprimer-arriere-plan | supprimer arrière plan | 12,100 | 41 |
| fr/convertir-webp-en-jpg | convertir webp en jpg | 5,400 | 24 |
| fr/convertir-png-en-jpg | convertir png en jpg | 4,400 | 10 |
| fr/ (hub) | outils image en ligne gratuit | no data | |

Decision: keep. Five of six tool pages meet the volume rule and four are under SD 30.

### New pages built on 2026-11-07

| Page (slug) | Main keyword | US volume | SD | Engine |
|---|---|---|---|---|
| pixelate-image | pixelate image (also "pixelate photo" 12,100, SD 22) | 14,800 | 23 | New `pixelate` app (`assets/js/tools/pixelate.js`) |
| jpeg-to-jpg | jpeg to jpg | 12,100 | 27 | Converter, JPG output |
| pixel-art-converter | pixel art converter | 4,400 | 16 | `pixelate` app preset: 16 px blocks, 64 colours |
| jpg-to-ico | jpg to ico (also covers "png to ico" 22,200, SD 43) | 3,600 | 23 | Converter with new ICO output (16 to 256 px) |

### Keyword research log (US, checked 2026-11-07)

Meets the rule, not built yet: invert image colors 2,400 (SD 29), black and white photo converter 1,900 (SD 25), image to black and white 1,600 (SD 26).

Too competitive for now (SD 30+): heic to jpg 246,000 (SD 40, also needs a HEIC decoder library), image color picker 40,500 (54), flip image 22,200 (39), mirror image 22,200 (54), png to ico 22,200 (43), blur image 18,100 (40), invert colors 18,100 (30), ico converter 9,900 (38), rotate image 8,100 (39), jpg to webp 8,100 (51), gif to png 8,100 (38), image to pixel art 6,600 (31), add text to photo 6,600 (64), tiff to jpg 5,400 (34), crop image into circle 4,400 (43), grayscale image 3,600 (47), image to base64 1,900 (56), blur face in photo 1,300 (28), convert to ico 1,000 (37), bmp to jpg 880 (34).

Reference: masterkit.online's likely winner "text repeater" (US 3,600, SD 19).

## 4. Data snapshots

- Google Search Console export (last 3 months, up to 2026-10-30): 623 impressions, 6 clicks. Daily impressions 8 to 136 from 16 to 25 Oct (average position 18 to 75), then 0 to 4 per day from 26 Oct.
- Top GSC queries then: "lumi pix" (36 impr), "20 kb photo size" (pos 42.7), "resize signature to 20kb" (pos 5).
- Backlinks (Ubersuggest, 2026-11-06): 5 referring domains, all follow, Domain Authority 1.
- Competitor reference masterkit.online (2026-11-06): 24 URLs, 16 tools, about 2,000 words per tool page, DA 1, 18 referring domains (17 nofollow). Owner's screenshot: 730 clicks and 4.46K impressions in 24 h, average position 4.9, 70% US.

## 5. Change log

| Date | Change | Why |
|---|---|---|
| 2026-10-25 | Titles, H1s, meta descriptions and focus keywords of tool pages retargeted (theme 1.8.4) | Target low competition keywords. In hindsight this reset Google's evaluation; impressions fell from 26 Oct |
| 2026-10-26 | Added bulk resize, India and Canada passport, 5MB pages, Brazilian foto 3x4 page, print sheets, unique FAQs (1.8.5 to 1.8.7) | More pages and keywords |
| 2026-10-26 to 11-01 | All 40 tool pages and 30 guides rewritten in a natural tone, long dashes removed, deployed live, PACK_REV 11 | Owner asked for human tone |
| 2026-11-04 | Persona authors replaced with "Lumi Pix Team", schema author set to Organization | Honest bylines, E-E-A-T |
| 2026-11-07 | New pages: pixelate-image, pixel-art-converter, jpg-to-ico, jpeg-to-jpg. New pixelate app, ICO output in the converter. PACK_REV 13 | High volume, low SD keywords from research |
| 2026-11-07 | Links to pt/foto-3x4-online added on the Portuguese hub, background remover, compressor and resizer pages. LANG_REV 6 | Page was not indexed; it had no in-text links |
| 2026-11-06 | 11 low-volume preset pages retired with 301 redirects, internal links repointed, Home page paragraph updated, PACK_REV 12 | Fewer thin pages, focus on high volume keywords |

## 6. Open tasks

| Task | Owner | Status |
|---|---|---|
| Freeze existing page titles and copy until 2026-12-04 | Claude | Active |
| Research new high volume, low SD keywords and build tools | Claude | Done 2026-11-07 (4 pages). Next candidates: invert image colors, black and white photo converter |
| Send a fresh Search Console Queries export (last 28 days) | Owner | Waiting |
| Submit site to directories (AlternativeTo, Product Hunt, SaaSHub, BetaList, free tool lists); point links at the priority pages | Owner | Waiting |
| Add the site to Bing Webmaster Tools (import from GSC) | Owner | Waiting |
| Forward hello@lumipix.tools to a real inbox (Cloudflare Email Routing) | Owner | Waiting |
| Check Settings > Reading "Discourage search engines" is off; GSC Manual actions shows no issues | Owner | Waiting |
| Add natural links to pt/foto-3x4-online from other Portuguese pages | Claude | Done 2026-11-07 |
| Redirect that costs about 0.6 s in the PageSpeed test | Claude | Checked 2026-11-07: the theme adds no redirect on the home page; the test most likely started from http:// or a www address, which the host redirects to https://lumipix.tools/. Visitors from Google land on https directly. Owner can confirm the Site Address in Settings > General is https://lumipix.tools |
| Request indexing in GSC for the 4 new pages: /pixelate-image/, /jpeg-to-jpg/, /pixel-art-converter/, /jpg-to-ico/ | Owner | Waiting |
| Apply for AdSense | Owner | Wait until traffic is steady |
