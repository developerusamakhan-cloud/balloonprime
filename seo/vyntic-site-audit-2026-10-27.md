# Vyntic Studio site audit, 27 October 2026

Checked after the speed optimization (theme 3.1.3). The full site was crawled from the sitemap: 112 URLs and 139 internal links.

## 1. Is anything broken?

| Check | Result |
|---|---|
| Pages returning 200 | 112 of 112 |
| PHP errors on any page | None |
| Internal links that 404 | None |
| Internal links that go through a redirect | None (was 18 before the fixes) |
| Links to the wrong domain (vynticstudio.com) | None (was 4) |
| Response time | Usually 0.5 to 0.9 s. A few one-off spikes happened during the crawl burst and the sitemap rebuild. |

### Fixed during the audit
- **Author links.** About page team cards and the author box on every post linked to `/author/...`, which redirects to the homepage. Names are now plain text (`single.php`, `template-parts/team.php`).
- **Old URLs in posts.** A content filter now rewrites old URLs in post content to the new ones, so no visitor or crawler hits a redirect (`inc/redirects.php`). Two more old service slugs were added to the redirect map.
- **Sitemap.** The sitemap was stale and missing five pages:
  - /services/branding/
  - /services/ebook-design/
  - /services/vector-art/
  - /what-is-a-google-business-profile/
  - /chatgpt-seo/

  It was rebuilt once and all five are now listed.
- **Speed Optimizer plugin page.** /plugins/vyntic-speed-optimizer/ was set to private today, so it was returning 404. It now redirects to /plugins/ while it stays private.

## 2. Long dashes

There are none left in visible text across all 112 pages.

Cleaned:
- 12 blog posts
- the Host With Wander case study
- the Terms of Service and the Cookie Policy (punctuation only, wording unchanged)

## 3. Humanized content and facts

Twelve older posts were rewritten in plain, natural English:
4582, 4759, 4766, 4770, 4776, 4782, 4789, 4792, 4795, 4800, 4806 and 4812.

**Removed: invented or unsupported numbers and claims**
- "4.2 seconds to under 1 second"
- "7 to 27 percent"
- "300 to 600KB"
- "40 to 60% cheaper"
- store counts and market shares
- a mislabelled "2024 Portent study"
- old Shopify prices
- "quarterly restore testing as standard"
- "we build WordPress exclusively"
- "every site comes with a care plan"
- "we have done this migration many times"
- "documented results for every project"

**Removed: price ranges that contradicted /pricing/**
- "$3,000 to $5,000"
- "$15,000 to $50,000"

**Kept with a source**
- W3Techs: about 43% of websites run WordPress
- Google 2017: +32% bounce probability from 1 s to 3 s
- Google WebP documentation: files about 25 to 34% smaller

**Care plan wording now matches /care-plans/**
- weekly updates
- daily off-site backups
- uptime monitoring and security scans
- Commerce plan: hourly database backups and checkout testing

**Other cleanup**
- Planning-note HTML comments were removed from posts 4800, 4806 and 4812.
- A stray `<pre>` was removed from post 4812.
- Broken sentences in the Host With Wander case study were repaired.
- Images were given alt text.
- Categories corrected: 4800 is now Performance and 4812 is now Development (both were Security).

## 4. Internal linking

Every rewritten post now links to:
- its matching service page
- two or three related guides
- the free audit and contact pages

Examples:
- The speed post links to the Core Web Vitals guides and the speed optimization service.
- The WooCommerce post links to the WooCommerce development, Shopify development and migration services.
- The Shopify migration post links to the migration SEO checklist.

## 5. For you to decide (not changed)

- **Cookie Policy** names Cloudflare cookies, including `__cfduid`, which Cloudflare retired in 2021. The site is on Hostinger's CDN, and it also loads Tawk.to and Google Analytics through Site Kit. The policy should be reviewed so it matches what the site really uses.
- **Case study copy** has a few phrases you may want to soften:
  - "saves Dutch households hundreds of euros each year" (GasWaterLicht)
  - "delivers returns that generic agencies cannot match" (Sugar's Property)
- **Leftover classes.** Six case studies still carry hidden copy-paste classes (`font-claude-response-body`). They are invisible to visitors and harmless.
- **Search Console.** Request indexing for the three new service pages and the 12 rewritten posts.
