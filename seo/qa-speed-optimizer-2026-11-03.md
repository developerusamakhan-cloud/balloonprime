# QA report: Vyntic Speed Optimizer 1.5.1 → 1.5.2

**Date:** 3 November 2026

**Environment:** local WordPress 6.5 test install (PHP 8.3, SQLite) with pretty permalinks. The release zips were installed fresh. Index Assistant 1.2.4 and AI Visibility 1.2.6 were also active.

**Result:** every check below passed. QA found two small issues, both fixed in 1.5.2.

## 1. Install and activation
| Check | Result |
|---|---|
| Deactivate removes the page cache drop-in | PASS |
| Activate reinstalls the drop-in and turns on `WP_CACHE` | PASS |
| Cache status fully active (enabled, drop-in, WP_CACHE) | PASS |
| Weekly PageSpeed and cache clean-up jobs scheduled | PASS |
| No PHP warnings or notices from the plugin in debug.log | PASS |

## 2. Front end (logged-out visitor)
| Check | Result |
|---|---|
| First visit MISS, then HIT (about 2 ms instead of 73 ms) | PASS |
| "Cached by Vyntic" note and Last-Modified header on cached pages | PASS |
| gzip served from cache | PASS |
| `?utm_source=` links served from cache; other query strings skip it | PASS |
| 304 Not Modified for conditional requests | PASS |
| Logged-in visitors, POST requests and `?vso_off=1` skip the cache | PASS |
| Editing a page clears its cached copy | PASS |
| Per page "Never cache this page" | PASS |
| Per page "Disable optimizations" | PASS |
| Delay JavaScript (external script held until interaction) | PASS |
| YouTube click-to-load replaces the iframe | PASS |
| First image gets high priority; images after the first 3 lazy load | PASS |
| HTML minified (371 lines → 100) | PASS |
| While paused, visitors get the original page | PASS |

## 3. Admin screens
| Check | Result |
|---|---|
| Every switch on Cache (4), CSS & JS (10), Images (6), Fonts (3) and Tweaks (8): flip, save, stored, restore | PASS |
| Number, text area and dropdown fields save | PASS |
| Safe, Balanced and Extreme profiles apply the right options | PASS |
| Active badge on the current profile; "Off" no longer a profile | PASS |
| A manual change turns the profile into Custom | PASS |
| Pause from Tools, paused banner on Overview and settings pages, resume | PASS |
| API key: save, masked display, replace, remove | PASS |
| Weekly check on/off updates the schedule | PASS |
| Export (valid JSON, never includes the API key), import, bad file rejected, reset | PASS |
| Clear all cache | PASS |
| Database cleanup list and clean button | PASS |
| WebP bulk progress: running, stop, continue, done | PASS |
| Dashboard widget, admin bar menu, editor sidebar box | PASS |
| No horizontal scroll on phones (all 8 sections) | PASS |
| No JavaScript or PHP errors on any plugin page | PASS |

## 4. PageSpeed errors
| Check | Result |
|---|---|
| Google quota reply (HTTP 429, RESOURCE_EXHAUSTED or "Quota exceeded") recognised; other errors are not | PASS |
| "Test now" shows the plain free-limit message, never Google's raw text | PASS |
| Weekly check retries 6 hours later, at most 3 times | PASS |
| Network failure shows an error and nothing breaks | PASS |

## 5. Other Vyntic plugins (regression)
| Check | Result |
|---|---|
| Index Assistant and AI Visibility: every tab loads, notices below the banner | PASS |
| Shared Vyntic plugins page | PASS |
| Index Assistant client report and CSV download | PASS |

## Issues found and fixed in 1.5.2
1. **Quota message started with "Something went wrong:".** It now shows only the plain explanation.
2. **Command-line PHP received a cached page.** A PHP script run from the command line could be answered with the cached homepage instead of running. Real sites rarely do this (server cron uses WP-CLI or `wp-cron.php`, which were already excluded), but it is now blocked.

## Not tested here
- **Live Google PageSpeed scores:** Google cannot be reached from the test environment. The quota and error paths were tested with simulated Google replies.
- **Browser cache rules in `.htaccess`:** the test server is not Apache.
- **Real image conversion to WebP:** the test site has no media library images. The progress UI was tested with simulated batches.
