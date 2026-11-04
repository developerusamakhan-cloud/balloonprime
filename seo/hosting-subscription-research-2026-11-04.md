# Research: adding hosting and a monthly website subscription to Vyntic Studio

**Date:** 4 November 2026
**Status:** research and recommendation only. Nothing on vyntic.studio has been changed.

**The idea:** clients pay a monthly fee. Vyntic builds the site, hosts it on Vyntic's own hosting and looks after it. No large upfront payment.

---

## 1. What Vyntic offers today (from the live site)

| Item | Live price | Note |
|---|---|---|
| Starter website | from $1,490 one-time | Up to 5 pages |
| Business website | from $2,990 one-time | Up to 12 pages |
| Online store | from $4,990 one-time | Shopify or WooCommerce |
| Essential care | $99 / month | Updates, daily backups, uptime monitoring, security scans |
| Growth care | $249 / month | Essential plus 3 hours of changes, speed report |
| Commerce care | $449 / month | Growth plus checkout testing, hourly DB backups, 6 hours of development |

All three website packages say **"Domain, hosting and paid plugins not included"**.

**Important conflict.** The site makes a clear promise in several places:
- "You own everything. Your code, your hosting, your logins. No lock-in, and no licence you have to keep paying us for." (`inc/content.php`)
- "You own everything we build: the theme, the content, the hosting account and every login." (articles)
- "Domain names, hosting ... are paid directly to those providers, so you own the accounts." (FAQ)

A subscription where Vyntic holds the hosting contradicts this unless the plan is designed carefully (see section 5). Those texts must be updated before launch.

---

## 2. How others sell this (market research)

Three common models were found:

| Model | How it works | Examples found |
|---|---|---|
| **A. Hosting added to care plans** | Client pays for the build once; the monthly care plan also includes hosting on the agency's servers | Higgens Media lists a tier of about $120/month for updates plus hosting. InMotion's agency guide describes bundling hosting inside the care plan price rather than as its own line item |
| **B. Pay-monthly website (subscription)** | Little or no upfront fee; one monthly fee covers design, hosting and care; usually a minimum term | Prices seen from about $99 to $450 a month. Minimum terms seen: none, 3 months, 12 months. One provider requires a 12-month minimum and charges the remaining months on early cancellation |
| **C. Fixed price, paid in instalments** | Normal project price spread over 12 months, with care included; the client owns the site from the start | StudioMeyer: fixed project price with 12 months of care included, pay once or over twelve months |

**Ownership on cancellation varies a lot:**
- Some providers keep the site while the subscription runs and delete it 14 to 30 days after cancellation.
- Some offer a buyout ("buy the website outright").
- Some only send the text and images, not the site itself.
- Buyer guides tell clients to check who controls the domain and whether they can take the files when they leave. Some designers publicly call "you don't own your website" a red flag.

These figures come from individual vendors' pages, not a market survey. They show what exists, not what Vyntic should charge.

---

## 3. The hosting side: how agencies host client sites

| Option | What it is | Cost basis (third-party figures, verify before buying) |
|---|---|---|
| **Own server + control panel** | Rent a VPS (DigitalOcean, Vultr, Hetzner, AWS) and manage WordPress sites with a panel such as SpinupWP, GridPane or RunCloud | Panel fees reported from about $8 to $19 per server per month on entry plans, plus the server itself. Unlimited sites per server on several panels |
| **Managed cloud (Cloudways)** | Cloudways runs the server for you; billed per server, not per site | Reported from about $14/month (1 GB); the commonly used 2 GB tier about $28/month. Backups storage extra |
| **White-label reseller** | Another company hosts; you resell under your brand | Per-site prices reported from about $5 to $45/month (InstaWP), $59 to $79/site with volume tiers (FatLab), or flat plans for 100 sites |

Sources disagree on exact panel prices. Confirm on each vendor's own pricing page.

**What Vyntic already has that helps:** its own Speed Optimizer (page cache, image optimisation), Index Assistant and AI Visibility plugins, and the Vyntic Hub for updates. These can be pre-installed on every hosted site and become a real reason to choose Vyntic hosting.

---

## 4. Risks and responsibilities that come with hosting

1. **Downtime becomes Vyntic's problem.** If the server goes down, every hosted client is down. A clear uptime target and a status page are needed.
2. **One server, many clients.** One hacked or overloaded site can affect others unless each site runs as an isolated system user. Panels like SpinupWP and GridPane offer this; check before choosing. WooCommerce stores should get their own server.
3. **Backups and restores.** Off-site backups (not on the same server), tested restores, and a stated retention period.
4. **Email.** Do not host client email on the web server. Use Google Workspace or Zoho, paid by the client. Email hosting brings deliverability and spam problems.
5. **Data protection.** The site targets the UK, the Netherlands, Singapore, New Zealand and others. When Vyntic hosts a client's site, Vyntic processes the client's visitor data (contact forms, orders). Clients in the UK and EU will expect a data processing agreement.
6. **Support expectations.** Hosting clients expect fast replies when the site is down, including weekends.
7. **Abuse and legal notices.** Copyright complaints and abuse reports about hosted sites come to the host.
8. **Payments.** A subscription needs automatic card billing. Stripe is widely reported as not available to Pakistan-based businesses (not confirmed officially in this research). Merchant-of-record services (Paddle, Lemon Squeezy, Polar) are built for software and may not accept a web design service; their eligibility for a Pakistan-based seller selling services was not confirmed. **This needs to be solved before launch**, either through how and where the business is registered or with a billing provider that confirms it accepts this business.

---

## 5. Recommendation: "Website on a monthly plan"

The owner's chosen model: **Vyntic builds a new site and the client pays a fixed amount every month.** The monthly fee covers the build, hosting and upkeep. It is not a care plan added to a paid project. (Model B in section 2.)

**How it should work**
- Low or no upfront payment. A small setup fee is common in the market and reduces the risk of clients leaving after one month.
- One monthly fee covers the build, hosting, updates, backups, monitoring and a small amount of changes.
- **Minimum term** so the build cost is recovered. 12 months is the most common term found.
- **Buyout:** during the minimum term, the client can take the site by paying the remaining months. After the term, the client can take a full copy at no extra cost.
- **The domain is always registered in the client's name.** This keeps the site's promise that the client is never locked in.
- If the client stops paying, the site is suspended after a stated grace period, not deleted at once. Backups are kept for a stated time.
- Start with brochure websites only. Online stores need more server resources and more support, so add them later.

**How the numbers could be built (illustration only, using Vyntic's own live prices; the actual price is your decision):**
- Starter website $1,490 spread over 12 months = about $124 a month.
- Plus the cost of hosting and upkeep (Vyntic's Essential care is $99 a month today; the hosting cost depends on the server setup in section 3).
- After the minimum term, the build is paid off, so the fee can drop or stay the same with more included.

Many subscription sellers charge more in total than their one-time price, to cover clients who leave early or stop paying. Whether Vyntic does the same is a business decision.

**Suggested plan shape (names and prices to be decided)**
| Plan | For | Includes |
|---|---|---|
| Starter monthly | New businesses | Up to 5 pages, hosting, updates, backups, monitoring, small monthly edits |
| Business monthly | Growing businesses | Up to 12 pages, service and location pages, everything in Starter, more monthly edits, speed report |

The existing one-time packages stay for clients who prefer to own and host the site themselves.

## 6. What must change on vyntic.studio before launch (drafts only, after approval)
1. Pricing page: a third tab, "Monthly website plans".
2. A short "Hosting" page: server setup, backups, uptime, what happens if you leave.
3. Rewrite the ownership texts: "Your code, your hosting, your logins" becomes a promise that the domain and a full copy of the site are always the client's, wherever it is hosted.
4. FAQ: "Domain, hosting and paid plugins not included" needs an exception for hosted plans.
5. Terms of service and refund policy: minimum term, notice period, buyout, what happens to the site after cancellation, backups, uptime target.
6. A data processing agreement for UK and EU clients.

## 7. Decisions needed from the owner
1. Which hosting setup: own server with a panel, Cloudways, or a white-label reseller.
2. Hosting price, and the monthly plan price and minimum term.
3. How recurring payments will be collected (section 4, point 8).
4. Whether stores are included or only brochure sites at first.
5. Setup fee or none.

---

## Sources
- Pay-monthly website offers and terms: https://profiletree.com/web-design-monthly-packages/ , https://digitalshiftmedia.com/pay-per-month-web-design , https://redefineweb.com/blog/pay-monthly-websites-for-small-businesses/ , https://redefineweb.com/blog/pay-monthly-websites-uk/ , https://kosmorph.gumroad.com/l/website-setup , https://www.cloudswitched.com/services/web-development/pay-monthly-website-uk , https://faq.ph9.com/cancellation-policy-on-off-the-shelf-ready-made-websites/faq_5843
- Ownership and cancellation: https://edhosting.com.au/?p=210790 , https://support.jottful.com/kb/article/27/do-i-get-to-keep-my-website-if-i-cancel-my-jottful-subscription-can-i-move-it-to-a-new-hosting-provider , https://www.ultimatewb.com/blog/?p=5740 , https://www.northwestregisteredagent.com/websites/website-ownership
- Care plans and bundling: https://higgensmedia.com/care-plans/ , https://www.inmotionhosting.com/blog/agency-recurring-revenue-model/ , https://studiomeyer.io/en/webdesign/preise , https://wpengine.com/resources/proposal-plan-website-care/
- Agency hosting: https://instawp.com/wordpress-hosting-models-for-agencies/ , https://fatlabwebsupport.com/pricing/agency/ , https://anchor.host/white-labeled-managed-wordpress-hosting/ , https://hosting.com/blog/solo-agency-hosting-stack/ , https://www.capterra.com/p/10012241/SpinupWP/pricing/ , https://gridpane.com/gridpane-vs/spinupwp/ , https://bloggersideas.com/cloudways-pricing
- Payments: https://learnwithhasan.com/payment-gateways/country/pakistan/ , https://www.change.org/p/bring-stripe-to-pakistan-empower-freelancers-startups-and-small-businesses , https://dodopayments.com/blogs/lemonsqueezy-review
