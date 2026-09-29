# SEO Playbook — Go-To Guide for Any Client Site

A reusable, step-by-step reference for doing SEO on any website: custom Laravel/PHP builds, WordPress, and other CMSs (Shopify, Wix, Squarespace, Joomla, Drupal, Webflow). Written from real work on the ByteWave site (Laravel, cPanel/LiteSpeed, Uganda), generalised so it works for any client.

> **How to use this file:** Start at [Section 1](#1-the-big-picture-and-workflow) to see the overall order of work, then jump to the section you need. Every section has numbered steps you can follow without remembering anything. Copy-paste snippets are marked with code blocks. UI labels in Google/Bing/WordPress change occasionally, so if a button has moved, search for the feature name.

---

## Table of Contents

1. [The big picture and workflow](#1-the-big-picture-and-workflow)
2. [New client kickoff (discovery + access checklist)](#2-new-client-kickoff)
3. [Keyword research and page planning](#3-keyword-research-and-page-planning)
4. [Accounts to set up (free)](#4-accounts-to-set-up-free)
5. [Technical SEO checklist](#5-technical-seo-checklist)
6. [On-page SEO checklist](#6-on-page-seo-checklist)
7. [Structured data (schema) templates](#7-structured-data-schema-templates)
8. [Implementation: Laravel / custom PHP](#8-implementation-laravel--custom-php)
9. [Implementation: WordPress](#9-implementation-wordpress)
10. [Implementation: other CMSs](#10-implementation-other-cmss)
11. [Local SEO and Google Business Profile](#11-local-seo-and-google-business-profile)
12. [Content strategy](#12-content-strategy)
13. [Backlinks and off-page](#13-backlinks-and-off-page)
14. [Performance and Core Web Vitals](#14-performance-and-core-web-vitals)
15. [Launch / migration / redesign checklist](#15-launch--migration--redesign-checklist)
16. [Monitoring, reporting and maintenance](#16-monitoring-reporting-and-maintenance)
17. [Troubleshooting (things that go wrong)](#17-troubleshooting)
18. [Lessons learned (ByteWave project)](#18-lessons-learned-bytewave-project)
19. [Paid options (later)](#19-paid-options-later)
20. [Client handover and pricing notes](#20-client-handover-and-pricing-notes)
21. [Glossary and quick reference](#21-glossary-and-quick-reference)

---

## 1. The big picture and workflow

SEO = making it easy for search engines to **find, understand and trust** a site, and making the pages match what people search for.

Three pillars:

| Pillar | Question it answers | Examples |
|---|---|---|
| **Technical** | Can search engines crawl and index it quickly? | HTTPS, sitemap, robots.txt, speed, redirects, canonicals |
| **On-page / content** | Does each page clearly match a search? | Titles, descriptions, headings, copy, images, internal links, schema |
| **Off-page / authority** | Do others trust and mention it? | Backlinks, reviews, Google Business Profile, citations, brand mentions |

**Recommended order of work (do it in this order for every client):**

1. Kickoff, goals, access (Section 2)
2. Keyword research and page map (Section 3)
3. Set up Search Console, Bing, Analytics, GBP (Section 4)
4. Technical fixes (Section 5)
5. On-page fixes and schema (Sections 6, 7, then 8/9/10 for the platform)
6. Submit sitemap, request indexing (Section 4)
7. Local SEO / listings / reviews (Section 11)
8. Content plan and publishing (Section 12)
9. Backlinks (Section 13)
10. Monitor monthly and iterate (Section 16)

**Realistic timeline to tell clients:** brand-name searches improve in days to weeks. Competitive keywords usually take **3 to 6+ months** of steady work. Nobody can guarantee rank #1; never promise it.

---

## 2. New client kickoff

### 2.1 Questions to ask the client

- [ ] What does the business sell/offer? Which services make the most profit?
- [ ] Who is the ideal customer? Which location(s) do they serve?
- [ ] Physical address / service-area business? Opening hours? Phone/WhatsApp/email?
- [ ] Top 3 competitors (who do they lose customers to)?
- [ ] Main goal: calls, form leads, walk-ins, online sales, bookings?
- [ ] Existing site? Old domain? Is it being redesigned or migrated? (see Section 15)
- [ ] Existing profiles: Google Business Profile, Facebook, LinkedIn, Instagram, directories?
- [ ] Any past SEO work or penalties? Any agency previously involved?

### 2.2 Access to request

- [ ] Domain registrar / DNS access (needed for DNS verification)
- [ ] Hosting (cPanel/SSH/FTP) or CMS admin login
- [ ] Google account to own Search Console + Analytics (prefer the **client's** account, add yourself as an owner/admin so they keep control)
- [ ] Google Business Profile access (request manager access, don't take ownership)
- [ ] Social profile admin access

> **Tip:** Always set up analytics and Search Console under the client's Google account and add yourself as a user. That way the client keeps the data if you part ways.

### 2.3 Baseline snapshot (before changing anything)

1. Note current Google indexed page count: search `site:clientdomain.com` in Google.
2. Screenshot Search Console Performance (if it exists) and Analytics traffic.
3. Run PageSpeed Insights (https://pagespeed.web.dev) on home + 1 inner page; save mobile score.
4. Record current rankings for 5–10 target keywords (manual or tool).
5. Save these in a doc so you can show improvement later.

---

## 3. Keyword research and page planning

### 3.1 Free method (step by step)

1. **Brainstorm seed terms.** List each service/product + location: e.g. `website design Kampala`, `POS system Uganda`.
2. **Google Autocomplete.** Type the seed in Google and note suggestions.
3. **"People also ask" and "Related searches".** Copy them at the bottom of results. Great blog topics.
4. **Search Console → Performance → Queries** (once data exists). Find queries with many impressions but few clicks: those pages need better titles/content.
5. **Google Trends** (trends.google.com) to compare terms and check seasonality.
6. **Look at competitors.** Search your keywords; open the top 3–5 results; note their page titles, headings, length, and what they cover that you don't.
7. Optional free tools: Google Keyword Planner (needs a free Google Ads account), Ubersuggest (limited free), AnswerThePublic (limited), Bing Webmaster → Keyword Research.

### 3.2 Search intent (very important)

Match the page type to intent:

| Intent | Example query | Page to build |
|---|---|---|
| Informational | "how much does a website cost in Uganda" | Blog post / guide |
| Commercial investigation | "best SACCO software" | Comparison / product page |
| Transactional | "buy POS system Kampala" | Product/service page with clear CTA |
| Navigational | "bytewave investments" | Home page (brand) |
| Local | "web designer near me" | Location page + Google Business Profile |

If Google's top results are all blog posts, a product page won't rank for it, and vice versa. **Look at what Google shows, then build that type.**

### 3.3 Keyword-to-page map (do this in a spreadsheet)

| Page URL | Primary keyword | Secondary keywords | Intent | Status |
|---|---|---|---|---|
| / | brand + main service + location | … | Navigational/Commercial | Live |
| /services/web-design | web design Kampala | website developer, web design company | Transactional | To write |

**Rules:**
- **One primary keyword per page.** Two pages targeting the same keyword compete against each other (cannibalisation).
- 3–6 related secondary keywords per page, used naturally.
- Give every important service its **own page** rather than one long "Services" page.

---

## 4. Accounts to set up (free)

### 4.1 Google Search Console (GSC)

Purpose: see how Google sees the site, submit sitemap, find errors, view search queries.

**Step by step**
1. Go to https://search.google.com/search-console and sign in with the client's Google account.
2. Click **Add property**.
3. Choose **Domain** (recommended; covers http/https/www/subdomains) and enter `example.com`, or **URL prefix** (`https://example.com/`) if you can't edit DNS.
4. **Verify ownership:**
   - *Domain property:* copy the TXT record → add it in DNS (registrar/cPanel Zone Editor/Cloudflare) → wait a few minutes → click **Verify**.
   - *URL prefix:* choose HTML tag → paste the `<meta name="google-site-verification" ...>` into the site `<head>` (or upload the HTML file; or verify via Google Analytics / Tag Manager if already installed).
5. Left menu → **Sitemaps** → enter `sitemap.xml` (or `sitemap_index.xml` for Yoast) → **Submit**.
6. Left menu → **URL inspection** → paste the home page URL → **Request indexing**. Repeat for key pages (limited quota per day).
7. Add users: **Settings → Users and permissions → Add user** (Owner for you and client).

**Status meanings for sitemaps**
- *Success* = fetched and parsed.
- *Couldn't fetch* right after first submit is common and often temporary (can take hours to a day). Verify the URL loads in a browser and returns HTTP 200 (see Section 17).

### 4.2 Bing Webmaster Tools

Purpose: Bing + Yahoo + DuckDuckGo + parts of AI search. 10 minutes; do it for every site.

**Step by step**
1. Go to https://www.bing.com/webmasters and sign in (Microsoft/Google/Facebook account).
2. Choose **Import** → **Continue with Google** → allow access → tick the site → **Import**. (This imports the GSC property and verifies ownership automatically.)
3. If the import page is blank: open `https://www.bing.com/webmasters/home` directly, use an Incognito window, disable ad blockers, or try Edge.
4. **Manual fallback:** **Add a site** → enter URL → verify using: **meta tag** (`msvalidate.01`), **XML file** (`BingSiteAuth.xml` uploaded to site root), or **DNS CNAME**.
5. **Sitemaps** → confirm `sitemap.xml` is listed, else **Submit sitemap**.
6. **URL Submission** → submit key pages.
7. Optional: **Bing Places** (https://www.bingplaces.com) → import from Google Business Profile.

### 4.3 Google Analytics 4 (GA4)

**Step by step**
1. https://analytics.google.com → **Admin → Create → Account/Property** (client's Google account).
2. Enter property name, time zone, currency.
3. **Data streams → Web** → enter site URL → create → copy the **Measurement ID** (`G-XXXXXXXXXX`).
4. Install the tag:
   - **Custom site:** paste the gtag snippet in the layout `<head>`.
   - **WordPress:** use *Site Kit by Google* (or a header-injection plugin, or the Google Analytics option in your SEO plugin/theme).
   - **Shopify/Wix/Squarespace:** paste the Measurement ID in the platform's Google Analytics integration field.
5. Verify: open the site, then Analytics → **Reports → Realtime**; you should see yourself.
6. **Admin → Product links → Search Console links** → link GA4 with GSC.
7. Mark conversions: **Admin → Events** → toggle "Mark as key event" for form submits, phone clicks, purchases.
8. Internal traffic filter (optional): **Admin → Data streams → Configure tag settings → Define internal traffic** to exclude your own IP.

> **Privacy note:** Depending on the client's audience (e.g. EU/UK visitors), a cookie consent banner may be legally required. Check local law and tell the client.

### 4.4 Google Tag Manager (optional)

Use when the client wants many tags (Ads, Meta Pixel, GA4) without editing code each time. Create a container, paste both snippets once, then manage tags in the GTM UI.

### 4.5 Google Business Profile (GBP)

See Section 11 for the full walkthrough.

### 4.6 Other free webmaster tools (optional)

- **Yandex Webmaster** (relevant for Russian-speaking audiences)
- **Baidu Webmaster** (China)
- **Naver Webmaster** (Korea)

---

## 5. Technical SEO checklist

Run through this for every site. Tick each box.

### 5.1 HTTPS and canonical host

- [ ] Valid SSL certificate on all pages, no mixed-content warnings.
- [ ] `http://` redirects (301) to `https://`.
- [ ] Only ONE host version works: choose `https://example.com` **or** `https://www.example.com`; 301 the other to it.
- [ ] Trailing-slash behaviour consistent (pick one; redirect the other).
- [ ] Canonical tag matches the chosen host.

**Test:**
```bash
curl -I http://example.com/
curl -I http://www.example.com/
curl -I https://www.example.com/
# Each should return: HTTP 301 and Location: https://example.com/
```

**Apache/LiteSpeed `.htaccess` (force https + non-www)** — place *before* the framework/CMS rewrite rules:
```apache
# Force HTTPS and non-www (skip localhost for dev)
RewriteEngine On
RewriteCond %{HTTP_HOST} !^(localhost|127\.0\.0\.1)(:\d+)?$ [NC]
RewriteCond %{HTTPS} off [OR]
RewriteCond %{HTTP_HOST} ^www\. [NC]
RewriteCond %{HTTP_HOST} ^(?:www\.)?(.+)$ [NC]
RewriteRule ^ https://%1%{REQUEST_URI} [L,R=301]
```
For "force www" instead, use:
```apache
RewriteCond %{HTTP_HOST} !^www\. [NC]
RewriteRule ^ https://www.%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```
**Behind Cloudflare/proxy?** `%{HTTPS}` may always read "off" and cause a redirect loop. Use `%{HTTP:X-Forwarded-Proto}` instead, or do the redirect in Cloudflare (Rules → Redirect Rules / "Always Use HTTPS").

**Nginx:**
```nginx
server {
    listen 80;
    server_name example.com www.example.com;
    return 301 https://example.com$request_uri;
}
server {
    listen 443 ssl;
    server_name www.example.com;
    return 301 https://example.com$request_uri;
}
```

> **cPanel warning:** cPanel adds a PHP handler block at the bottom of `.htaccess` (`# php -- BEGIN cPanel-generated handler`). **Never delete it**; it sets the PHP version. See Section 18.

### 5.2 robots.txt

Location: `https://example.com/robots.txt` (site root).

**Generic template:**
```
User-agent: *
Disallow: /admin
Disallow: /login
Disallow: /register
Disallow: /cart
Disallow: /checkout
Disallow: /?s=
Disallow: /search

Sitemap: https://example.com/sitemap.xml
```

**WordPress template:**
```
User-agent: *
Disallow: /wp-admin/
Allow: /wp-admin/admin-ajax.php
Disallow: /?s=
Disallow: /search/

Sitemap: https://example.com/sitemap_index.xml
```

**Rules and warnings**
- `Disallow:` (empty) = allow everything. `Disallow: /` = block **everything** (a classic disaster on launch).
- robots.txt stops **crawling**, not always **indexing**. To keep a page out of Google, use `noindex` (and don't block it in robots.txt, or Google can't see the noindex tag).
- Don't block CSS/JS files Google needs to render the page.
- Staging sites: block with password protection (HTTP auth) or `noindex`, not only robots.txt.
- **WordPress gotcha:** Settings → Reading → "Discourage search engines from indexing this site" must be **UNCHECKED** on the live site.

### 5.3 XML sitemap

**Rules**
- Include only **indexable, canonical, 200-status** URLs.
- Exclude: noindex pages, redirects, 404s, admin, thank-you pages, forms, duplicate/filter URLs.
- Use the exact canonical host in every `<loc>`.
- `lastmod` should reflect real content changes (Google mostly ignores `priority` and `changefreq`, but they're harmless).
- Max 50,000 URLs or 50 MB per sitemap; use a sitemap index for more.
- Reference it in robots.txt and submit in GSC + Bing.

**Sitemap sources by platform**
- Laravel: `spatie/laravel-sitemap` (see Section 8.6).
- WordPress: Yoast (`/sitemap_index.xml`), Rank Math (`/sitemap_index.xml`), or core WP (`/wp-sitemap.xml`). **Use only one** (disable the others).
- Shopify: automatic `/sitemap.xml`.
- Wix/Squarespace/Webflow: automatic `/sitemap.xml`.

### 5.4 Indexation control

Meta robots tag:
```html
<meta name="robots" content="index, follow, max-image-preview:large">
<!-- to block a page: -->
<meta name="robots" content="noindex, follow">
```
Or HTTP header: `X-Robots-Tag: noindex`.

**Usually `noindex`:** thank-you pages, internal search results, login/register, cart/checkout/account, tag/author archives with thin content, paginated filter combinations, testimonial submit forms, staging.

**Never `noindex`:** home, service/product pages, main blog posts, contact, about.

### 5.5 Canonical tags

```html
<link rel="canonical" href="https://example.com/services/web-design">
```
- Every indexable page has a **self-referencing canonical** (absolute URL, with correct host and protocol).
- Use canonicals to point duplicate/parameter URLs (`?utm_source=`, `?sort=`) to the clean URL.
- Don't canonicalise to a page that is noindex or redirects.

### 5.6 URL structure

- Lowercase, hyphen-separated, short, descriptive: `/services/web-design`, not `/index.php?id=23`.
- No dates in URLs for evergreen content.
- Keep URLs stable. If you must change one, 301 the old to the new.
- WordPress: **Settings → Permalinks → "Post name"** (`/%postname%/`).

### 5.7 Redirects

- Use **301** (permanent) for moved pages; **302** only for genuine temporary moves.
- Avoid redirect chains (A→B→C); point A→C directly.
- After a redesign, map every old URL to its new equivalent (Section 15).

Apache example:
```apache
Redirect 301 /old-page https://example.com/new-page
```
WordPress: use *Redirection* plugin or Rank Math/Yoast Premium redirect manager.

### 5.8 Status codes and error pages

- Deleted pages → **404** or **410**, with a helpful custom 404 page (search box, links to main pages).
- Don't redirect all 404s to the home page (soft-404 issue).
- Server errors (5xx) hurt crawling; monitor uptime.

### 5.9 Mobile-friendliness

Google uses **mobile-first indexing**: the mobile version is what gets ranked.
- [ ] `<meta name="viewport" content="width=device-width, initial-scale=1">`
- [ ] Tap targets not too close; font size ≥ 16px for body text.
- [ ] Content identical on mobile and desktop (don't hide content on mobile).
- Test on a real phone and Chrome DevTools device mode.

### 5.10 Internationalisation (only if multiple languages/regions)

```html
<link rel="alternate" hreflang="en" href="https://example.com/">
<link rel="alternate" hreflang="fr" href="https://example.com/fr/">
<link rel="alternate" hreflang="x-default" href="https://example.com/">
```
Each language version must link to all versions including itself. Set `<html lang="en">`.

### 5.11 JavaScript rendering

- Server-side render (SSR) or ensure critical content/links exist in the HTML. Pure client-side SPAs can delay or hurt indexing.
- Use real `<a href>` links, not JS click handlers, for navigation.
- Test with GSC **URL inspection → Test live URL → View tested page** to see what Google renders.

### 5.12 Security and trust

- [ ] HTTPS everywhere; HSTS optional.
- [ ] Keep CMS/plugins updated (hacked sites get deindexed).
- [ ] Check GSC → **Security & Manual Actions** monthly.
- [ ] Privacy Policy and Terms pages; contact details visible (trust signals).

---

## 6. On-page SEO checklist

Apply to **every important page**.

### 6.1 Title tag (`<title>`)

- Unique per page, **≈ 50–60 characters** (Google truncates by pixel width).
- Put the primary keyword near the front, then brand.
- Pattern: `Primary Keyword – Benefit/Qualifier | Brand`
- Examples:
  - Home: `ByteWave Investments – Software, Web & ICT Solutions in Uganda`
  - Service: `Website Design in Kampala | ByteWave`
  - Blog: `How Much Does a Website Cost in Uganda? (2026 Guide) | ByteWave`
- Never leave titles blank, duplicated, or as just "Home" / "Untitled".

### 6.2 Meta description

- Unique per page, **≈ 120–160 characters**.
- Written as a mini ad: what the page offers + a reason to click + soft call to action.
- Include the primary keyword naturally (Google bolds matches).
- Google may rewrite it; that's normal.

### 6.3 Headings

- Exactly **one `<h1>`** per page, containing the primary topic/keyword.
- Then `<h2>` for main sections, `<h3>` for sub-sections. Don't skip levels for styling; use CSS for styling.
- Use headings for structure, not just for making text big.
- Watch out: page-header banners, logos or hidden text accidentally using `<h1>` (we found duplicate H1s on contact and portfolio pages).

### 6.4 Body content

- Answer the search intent fully in the first screen; then go deeper.
- Use the keyword and related terms naturally. **No keyword stuffing.**
- Write for humans: short paragraphs, bullets, tables, clear calls to action.
- Length follows the topic: service pages typically 500–1,000+ words; guides 1,500+; don't pad.
- Include real expertise: prices/ranges, process steps, FAQs, case studies, photos of real work, client quotes (E-E-A-T: Experience, Expertise, Authoritativeness, Trust).
- Add author name/bio on blog posts; add "last updated" dates when relevant.

### 6.5 Images

- **Descriptive filenames:** `kampala-web-design-team.jpg` not `IMG_2043.jpg`.
- **Alt text** on every meaningful image (describe what it shows, naturally include keyword only if it fits). Decorative images: `alt=""`.
- **Compress** (TinyPNG, Squoosh, ShortPixel, Imagify) and use **WebP/AVIF** where possible.
- **Correct dimensions:** don't serve a 4000px image in a 400px slot.
- Set `width` and `height` attributes to prevent layout shift.
- **Lazy-load** below-the-fold images: `<img loading="lazy" decoding="async" ...>`. **Do not** lazy-load the main hero/LCP image.

### 6.6 Internal linking

- Every page should be reachable within 3 clicks of the home page.
- Link related pages to each other with descriptive anchor text (`our website design services`, not `click here`).
- Blog posts should link to relevant service/product pages (this passes authority to money pages).
- Breadcrumbs on deep pages (also add breadcrumb schema).
- Add "Related posts/services" blocks.
- Find orphan pages (no internal links) with a crawler (Screaming Frog) and link to them.

### 6.7 External linking

- Link out to authoritative sources when it helps the reader.
- Add `rel="nofollow"` (or `rel="sponsored"` for paid links, `rel="ugc"` for user comments).

### 6.8 Open Graph and Twitter cards (social sharing previews)

```html
<meta property="og:title" content="Page title">
<meta property="og:description" content="Short description">
<meta property="og:image" content="https://example.com/images/share-1200x630.jpg">
<meta property="og:url" content="https://example.com/page">
<meta property="og:type" content="website"> <!-- article for blog posts -->
<meta property="og:site_name" content="Brand Name">
<meta property="og:locale" content="en_US">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Page title">
<meta name="twitter:description" content="Short description">
<meta name="twitter:image" content="https://example.com/images/share-1200x630.jpg">
```
- Use a **1200×630 px** share image (not a tiny favicon). Test with Facebook Sharing Debugger (developers.facebook.com/tools/debug) and LinkedIn Post Inspector.

### 6.9 Favicon and branding

- Provide `favicon.ico`, PNG icons and `apple-touch-icon`. Google shows the favicon in mobile results; it must be a multiple of 48px, square.

### 6.10 Page-type templates

**Service page outline:** H1 (service + location) → short pitch → benefits → process steps → pricing guidance → portfolio proof → testimonials → FAQ → strong CTA.

**Product page outline:** H1 (product name) → key benefits → features → screenshots/demo → pricing → FAQ → CTA (demo/quote).

**Location page outline:** H1 (service in city) → unique local content (areas, landmarks, local clients) → map/address → reviews → CTA. **Never** publish dozens of near-identical city pages (doorway pages).

**Blog post outline:** H1 (matches search) → quick answer → table of contents → sections with H2/H3 → images/tables → FAQs → author bio → CTA linking to service page.

---

## 7. Structured data (schema) templates

Use **JSON-LD** in `<script type="application/ld+json">`. Put it in `<head>` or body. Only mark up content that is **visible on the page**. Validate every template.

**Validators**
- Google Rich Results Test: https://search.google.com/test/rich-results (only shows types eligible for rich results)
- Schema Markup Validator: https://validator.schema.org (shows all types)
- GSC → **Enhancements** reports once Google has crawled

> **Reminder:** valid schema doesn't guarantee rich results; it helps Google understand the page.

### 7.1 Organization / LocalBusiness (site-wide, or home page)

Use `LocalBusiness` (or a more specific subtype like `ProfessionalService`, `Dentist`, `Restaurant`, `LegalService`) if there's a physical location or service area.

```json
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": ["LocalBusiness", "ProfessionalService"],
      "@id": "https://example.com/#organization",
      "name": "Business Name",
      "description": "One or two sentences about what the business does and where.",
      "url": "https://example.com/",
      "logo": "https://example.com/images/logo.png",
      "image": "https://example.com/images/storefront.jpg",
      "telephone": "+256700000000",
      "email": "info@example.com",
      "priceRange": "$$",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Plot 1, Example Street",
        "addressLocality": "Kampala",
        "addressCountry": "UG"
      },
      "geo": { "@type": "GeoCoordinates", "latitude": 0.3476, "longitude": 32.5825 },
      "openingHoursSpecification": [{
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday"],
        "opens": "08:00", "closes": "17:00"
      }],
      "areaServed": [{ "@type": "Country", "name": "Uganda" }],
      "sameAs": [
        "https://www.facebook.com/example",
        "https://www.linkedin.com/company/example"
      ]
    },
    {
      "@type": "WebSite",
      "@id": "https://example.com/#website",
      "url": "https://example.com/",
      "name": "Business Name",
      "publisher": { "@id": "https://example.com/#organization" },
      "inLanguage": "en"
    }
  ]
}
```

### 7.2 BreadcrumbList

```json
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "Home", "item": "https://example.com/" },
    { "@type": "ListItem", "position": 2, "name": "Services", "item": "https://example.com/services" },
    { "@type": "ListItem", "position": 3, "name": "Web Design", "item": "https://example.com/services/web-design" }
  ]
}
```

### 7.3 Article / BlogPosting

```json
{
  "@context": "https://schema.org",
  "@type": "BlogPosting",
  "headline": "Post title",
  "description": "Short summary",
  "image": "https://example.com/images/post.jpg",
  "datePublished": "2026-01-15T09:00:00+03:00",
  "dateModified": "2026-02-01T10:00:00+03:00",
  "author": { "@type": "Person", "name": "Author Name" },
  "publisher": {
    "@type": "Organization",
    "name": "Business Name",
    "logo": { "@type": "ImageObject", "url": "https://example.com/images/logo.png" }
  },
  "mainEntityOfPage": "https://example.com/blog/post-slug"
}
```

### 7.4 Service

```json
{
  "@context": "https://schema.org",
  "@type": "Service",
  "name": "Website Design",
  "description": "What the service includes.",
  "serviceType": "Web design",
  "provider": { "@id": "https://example.com/#organization" },
  "areaServed": { "@type": "Country", "name": "Uganda" }
}
```

### 7.5 Product (with offer)

```json
{
  "@context": "https://schema.org",
  "@type": "Product",
  "name": "Product name",
  "description": "Product description",
  "image": "https://example.com/images/product.jpg",
  "sku": "SKU-123",
  "brand": { "@type": "Brand", "name": "Brand" },
  "offers": {
    "@type": "Offer",
    "price": "199.00",
    "priceCurrency": "USD",
    "availability": "https://schema.org/InStock",
    "url": "https://example.com/products/product-slug"
  }
}
```
Add `aggregateRating`/`review` **only** if the reviews are real and visible on the page.

### 7.6 FAQPage

```json
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [{
    "@type": "Question",
    "name": "How long does a website take?",
    "acceptedAnswer": { "@type": "Answer", "text": "Usually 2–4 weeks depending on scope." }
  }]
}
```
Note: Google now shows FAQ rich results only for a limited set of sites, but the markup is still harmless and useful for understanding.

### 7.7 Other useful types

- `Review` / `AggregateRating` (real, visible reviews only)
- `Event`, `JobPosting`, `Recipe`, `VideoObject`, `Course`, `SoftwareApplication`, `HowTo` (check current Google eligibility)
- `Person` for author pages.

### 7.8 Step by step: adding and testing schema

1. Pick the schema type per page template (Section 7.1–7.7).
2. Generate JSON-LD (fill the template with real data, or generate dynamically from the database/CMS).
3. Paste into the page head/body (Laravel: see Section 8.5; WordPress: plugin, Section 9.7).
4. Open Rich Results Test → **URL** tab → enter the live URL → **Test URL**.
5. Fix errors (red). Warnings (orange) about optional fields are okay.
6. Also run validator.schema.org for non-rich-result types.
7. Watch GSC → Enhancements for site-wide issues.

---

## 8. Implementation: Laravel / custom PHP

(All examples from the ByteWave Laravel project; adapt names.)

### 8.1 Layout head with per-page overrides

`resources/views/layouts/app.blade.php`:
```blade
<title>@hasSection('title')@yield('title')@else Brand Name @endif</title>
<meta name="description" content="@yield('meta_description', 'Default site description.')">
<meta name="robots" content="@yield('robots', 'index, follow, max-image-preview:large')">
<link rel="canonical" href="@yield('canonical', url()->current())">

<meta property="og:title" content="@yield('og_title', trim($__env->yieldContent('title', 'Brand')))">
<meta property="og:description" content="@yield('og_description', 'Default share description')">
<meta property="og:image" content="@yield('og_image', asset('images/logo.png'))">
<meta property="og:url" content="@yield('og_url', url()->current())">
<meta property="og:type" content="@yield('og_type', 'website')">
<meta property="og:site_name" content="Brand Name">
<meta name="twitter:card" content="summary_large_image">

@stack('schema')
```

Per page:
```blade
@extends('layouts.app')
@section('title', 'Website Design in Kampala | ByteWave')
@section('meta_description', 'Custom website design for businesses in Kampala...')
@section('robots', 'noindex, follow')   {{-- only on pages you don't want indexed --}}
```

> **Blade gotchas:** escape apostrophes inside single-quoted `@section('x', '...')` strings (e.g. avoid `ByteWave's` or write `ByteWave\'s`). In JSON-LD inside Blade, write `@@context`, `@@type`, `@@id` (double `@` outputs a single `@`).

### 8.2 `url()->current()` canonical caveat

`url()->current()` uses the request host. If both `www` and non-www serve the site, canonicals will follow whichever host was visited. Fix by forcing one host at the server level (Section 5.1), or hard-code the domain from `config('app.url')`:
```blade
<link rel="canonical" href="{{ rtrim(config('app.url'), '/') . '/' . ltrim(request()->path(), '/') }}">
```
Also make sure `APP_URL` in `.env` is the production https URL.

### 8.3 Dynamic meta from the database

Add a nullable `meta_title` / `meta_description` column to products, services, portfolios, posts so the client can edit them:
```php
// migration
Schema::table('products', function (Blueprint $t) {
    $t->string('meta_description', 320)->nullable();
});
```
```blade
@section('meta_description', $product->meta_description ?: Str::limit(strip_tags($product->description), 160))
```
Add the field to the model `$fillable`, controller validation (`'meta_description' => 'nullable|string|max:320'`) and the admin form.

### 8.4 Reusable breadcrumb schema component

`resources/views/components/breadcrumb-schema.blade.php`:
```blade
@props(['items'])
@php
    $list = []; $position = 1;
    foreach ($items as $name => $url) {
        $list[] = ['@type' => 'ListItem', 'position' => $position++, 'name' => (string) $name, 'item' => $url];
    }
    $data = ['@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => $list];
@endphp
<script type="application/ld+json">{!! json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP) !!}</script>
```
Usage:
```blade
@push('schema')
    <x-breadcrumb-schema :items="[
        'Home' => route('home'),
        'Services' => route('services.index'),
        $service->name => url()->current(),
    ]" />
@endpush
```
(`JSON_HEX_TAG` prevents `</script>` in data from breaking the page.)

### 8.5 Schema in Blade

Site-wide LocalBusiness + WebSite in the layout; `Article`, `Product`, `Service`, `FAQPage` in `@push('schema')` blocks on the relevant views. Use `@json($value)` for safe escaping.

### 8.6 Sitemap with spatie/laravel-sitemap

```bash
composer require spatie/laravel-sitemap
php artisan make:command GenerateSitemap
```
```php
$sitemap = Sitemap::create();
$sitemap->add(Url::create(route('home'))->setPriority(1.0)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY));
Blog::published()->get()->each(fn ($b) =>
    $sitemap->add(Url::create(route('blog.show', $b->slug))->setLastModificationDate($b->updated_at)));
$sitemap->writeToFile(public_path('sitemap.xml'));
```
Schedule daily in `routes/console.php`:
```php
app(Schedule::class)->command('sitemap:generate')->daily();
```
Make sure the server cron runs the scheduler: `* * * * * cd /path/to/app && php artisan schedule:run >> /dev/null 2>&1`.

**Decision: track or ignore `public/sitemap.xml` in Git?**
- If the server regenerates it daily, add `public/sitemap.xml` to `.gitignore` (avoids pull conflicts on the server). Then after first deploy run `php artisan sitemap:generate` once.
- Ensure `APP_URL` is the production URL when generating (otherwise URLs come out as `localhost`).
- Exclude noindex pages (forms, admin) from the sitemap.

### 8.7 Lazy-loading, deferring and script hygiene

- Add `loading="lazy" decoding="async"` to below-the-fold `<img>`.
- Remove unused libraries (we found an unused Framer Motion CDN script in `<head>`).
- Move non-critical scripts to the end of `<body>` or add `defer`.
- Keep `async` on analytics.

### 8.8 Deploy commands (Laravel, cPanel/SSH)

```bash
cd ~/app && git pull origin main \
 && composer install --no-dev --optimize-autoloader \
 && php artisan migrate --force \
 && php artisan optimize:clear \
 && php artisan config:cache && php artisan route:cache && php artisan view:cache
php artisan sitemap:generate
```
If Blade throws a strange syntax error after edits: run `php artisan view:clear` (stale compiled views).

### 8.9 Quick local audit script idea

Render key URLs via the kernel and check title, description, robots, number of `<h1>`, JSON-LD validity. (Used on ByteWave; a 15-line PHP script that loops URLs and `preg_match`es the HTML.) Or use a crawler (Screaming Frog free ≤ 500 URLs).

---

## 9. Implementation: WordPress

### 9.1 Initial settings (do first, every WP site)

1. **Settings → Reading:** ensure **"Discourage search engines from indexing this site" is UNCHECKED** (live site).
2. **Settings → Permalinks:** choose **Post name**. Save.
3. **Settings → General:** set correct Site Title, Tagline; use `https://` for WordPress Address and Site Address; pick one host (www vs non-www).
4. **Settings → Discussion:** limit comment spam (require approval; consider disabling comments on pages).
5. Set **Timezone** and **Language**.
6. Delete unused plugins/themes, sample page/post ("Hello world", "Sample Page").
7. Ensure an SSL certificate is installed; use *Really Simple SSL* only if needed.

### 9.2 Pick ONE SEO plugin

| Plugin | Notes |
|---|---|
| **Rank Math** (free) | Many free features (redirects, schema, 404 monitor, local SEO); friendly setup wizard |
| **Yoast SEO** (free) | Very popular, simple; some features (redirects, more schema) are premium |
| **AIOSEO** | Similar; good WooCommerce/local options |
| **SEOPress** | Lightweight, generous free tier |

Never run two SEO plugins simultaneously (duplicate tags/sitemaps).

### 9.3 Rank Math setup, step by step

1. Plugins → Add New → search "Rank Math SEO" → Install → Activate.
2. Run the **Setup Wizard**: choose site type (business/blog/shop), enter business info (name, logo, phone, social profiles).
3. **Sitemap Settings:** enable; include Posts, Pages, Products; exclude tags/authors if thin.
4. **Titles & Meta:** set title templates (e.g. `%title% | %sitename%`); noindex low-value archives (tags, author archives, date archives) unless useful.
5. **General Settings → Links:** strip category base if desired; enable redirects.
6. **Local SEO** tab: fill in business details, hours, phone, map coordinates.
7. Connect Google account in **General Settings → Analytics** to see GSC/GA data (optional).
8. **Rank Math → Sitemap Settings** → copy sitemap URL (`/sitemap_index.xml`) → submit in GSC and Bing.

### 9.4 Yoast SEO setup, step by step

1. Install/activate **Yoast SEO**.
2. **Yoast → Settings → Site basics:** run the setup; enter site name, logo, organisation details.
3. **Settings → Content types:** set which types appear in search; set title/description templates.
4. **Settings → Advanced → Crawl optimization** (tidy up head clutter).
5. **Settings → Site features:** ensure **XML sitemaps** is on → sitemap at `/sitemap_index.xml`.
6. For each page/post: use the **Yoast panel** at the bottom of the editor → set focus keyphrase, SEO title, meta description. Aim for green traffic lights but treat them as guidance, not gospel.

### 9.5 On-page work per page (WordPress editor)

1. Open the page/post → find the SEO plugin panel.
2. Set **focus keyword**, **SEO title**, **meta description**, **slug** (short, keyword-based).
3. Ensure a single **H1** (theme usually uses the page title as H1; avoid adding another H1 in content).
4. Add alt text to each image (Media Library → image → Alt Text).
5. Add internal links to 2–3 related pages/posts.
6. Set a **featured image** (used as the social share image).
7. Preview → Publish → **Inspect URL in GSC → Request indexing**.

### 9.6 Recommended plugin stack (keep it lean)

| Purpose | Options |
|---|---|
| SEO | Rank Math **or** Yoast (one only) |
| Caching/speed | LiteSpeed Cache (on LiteSpeed hosts), WP Rocket (paid), W3 Total Cache, WP Fastest Cache |
| Images | ShortPixel, Imagify, Smush, EWWW (WebP conversion + compression) |
| Security | Wordfence, Sucuri, or Solid Security |
| Backups | UpdraftPlus, Duplicator, or host backups |
| Forms | WPForms, Contact Form 7, Fluent Forms |
| Redirects | Redirection (or built into Rank Math) |
| Analytics | Site Kit by Google |
| Cookie consent | Complianz, CookieYes (if required) |

**Avoid bloat:** every plugin adds load and attack surface. Remove what you don't use.

### 9.7 Schema in WordPress

- Rank Math and Yoast output Organization/WebSite/Article schema automatically; configure in the plugin (Titles & Meta → Local SEO / Schema).
- Per-page schema types: Rank Math → Schema tab in the editor; Yoast → Schema tab in the sidebar.
- FAQ: use the plugin's FAQ block (Rank Math/Yoast blocks add FAQPage schema).
- LocalBusiness: Rank Math → Titles & Meta → Local SEO.
- Test as in Section 7.8.

### 9.8 WordPress performance quick wins

1. Choose a lightweight theme (GeneratePress, Astra, Kadence, Blocksy). Avoid heavy multipurpose themes with dozens of bundled scripts.
2. Install a caching plugin and enable page cache, browser cache, GZIP/Brotli, CSS/JS minify (test carefully).
3. Convert images to WebP; enable lazy loading (WP core does this by default for images).
4. Limit plugins; disable unused ones.
5. Use a CDN (Cloudflare free) if the audience is geographically spread.
6. Host on a decent server (LiteSpeed, PHP 8.1+); enable object cache if available.
7. Test with PageSpeed Insights before/after.

### 9.9 WooCommerce SEO (online stores)

- Unique product titles/descriptions (not manufacturer copy).
- Product schema (auto by Rank Math/Yoast WooCommerce add-ons); add reviews.
- `noindex` cart, checkout, my-account pages (plugins do this).
- Use clean category structure; write category descriptions.
- Handle filters/parameters with canonicals; avoid indexing endless filter combos.
- Add breadcrumbs; enable them in the SEO plugin and theme.
- Out-of-stock: keep page if it'll return; else 301 to a relevant category.

### 9.10 Migrating an old site into WordPress

See Section 15 (crucial: redirect map and keeping URLs).

---

## 10. Implementation: other CMSs

### 10.1 Shopify

1. Online Store → Preferences: set **page title** and **meta description** for the home page; upload a **social sharing image**.
2. Every product/collection/page has a **Search engine listing** section: edit page title, meta description, URL handle.
3. Sitemap is automatic at `/sitemap.xml`; submit to GSC/Bing.
4. Use **Google & YouTube** sales channel to connect Merchant Center/Analytics.
5. Alt text on product images; compress images; use apps sparingly (each adds scripts).
6. Duplicate URLs: Shopify uses canonicals for `/collections/x/products/y`; keep the theme's canonical tag intact.
7. Add schema via theme (most modern themes include Product schema); test in Rich Results Test.

### 10.2 Wix

1. **Marketing & SEO → SEO → SEO Setup Checklist** (Wix Guide): follow the wizard.
2. Per page: **Pages → ⋯ → SEO basics** → set title, description, URL slug; **Social share** tab for the share image.
3. Connect the domain, enable SSL (automatic).
4. Sitemap auto at `/sitemap.xml`. Connect GSC through **Marketing & SEO → Google Search Console**.
5. Add structured data in **Advanced SEO → Structured data markup** (custom JSON-LD).
6. Limitations: less control over code/speed; keep pages lightweight.

### 10.3 Squarespace

1. **Settings → Marketing → SEO** (site-wide title format, description).
2. Per page: gear icon → **SEO** tab → title, description; **Social Image** tab.
3. Sitemap auto `/sitemap.xml`. Connect GSC via **Settings → Marketing → Search Console** (verifies automatically).
4. Add code injection in **Settings → Advanced → Code Injection** for schema/analytics.
5. Enable SSL and set the primary domain (**Settings → Domains**) to avoid www duplicates.

### 10.4 Webflow

1. **Project settings → SEO:** disable "Disable Webflow subdomain indexing" (if the custom domain is live, this prevents duplicate content from `*.webflow.io`).
2. Per page: **Page settings → SEO Settings** → title, description, slug, OG image.
3. CMS collections: use **dynamic fields** in SEO settings (`{{Name}} | Brand`).
4. **Auto-generate sitemap:** Project settings → SEO → sitemap.
5. Add JSON-LD in custom code embeds (page-level or site-level).
6. 301 redirects: Project settings → Hosting → **301 redirects**.

### 10.5 Joomla

1. **System → Global Configuration → Site:** enable **SEF URLs** and **URL Rewriting** (rename `htaccess.txt` to `.htaccess`), site meta description.
2. Use an SEO extension (e.g. sh404SEF, or built-in article "Publishing" tab for meta title/description).
3. Set **Metadata** on each article/menu item; unique meta description.
4. Sitemap: extension like **OSMap**.
5. Force HTTPS/www in Global Configuration + `.htaccess` rules (Section 5.1).

### 10.6 Drupal

1. Install modules: **Metatag**, **Pathauto** (clean URLs), **Simple XML Sitemap**, **Redirect**, **Schema.org Metatag** (optional).
2. Configure Metatag defaults per content type (title/description tokens).
3. Enable Pathauto patterns (`/blog/[node:title]`).
4. Generate sitemap; submit to GSC/Bing.

### 10.7 Other/headless (Next.js, Nuxt, Gatsby, etc.)

- Prefer SSR/SSG so content is in the HTML.
- Set metadata via framework APIs (Next.js `metadata` / `generateMetadata`; Nuxt `useSeoMeta`).
- Generate sitemap.xml and robots.txt (e.g. `next-sitemap`).
- Ensure canonical, OG tags and JSON-LD render server-side.
- Watch for client-side-only routing that hides links.

---

## 11. Local SEO and Google Business Profile

### 11.1 Set up / claim a Google Business Profile, step by step

1. Go to https://www.google.com/business/ (or search your business name on Google/Maps and click **Claim this business**).
2. Sign in with the account that will own it (ideally a business Gmail the client controls).
3. Enter the exact **business name** (no keyword stuffing; use the real, signage-consistent name).
4. Choose the **primary category** carefully (the most important ranking field). Add secondary categories that truly apply.
5. Add a physical **address** (if customers visit) or set a **service area** (if you travel to customers). Hide the address if it's home-based.
6. Add **phone** (local number preferred), **website URL**, and **opening hours** (add special hours for holidays).
7. **Verify** (postcard, phone/SMS, email, or video verification; options vary). Follow the prompts; video verification requires showing the premises, signage and business tools.
8. After verification, complete every field (see 11.2).

### 11.2 Fully optimise the profile

- [ ] Business description (750 chars max; natural, includes services + location, no promotional spam/URLs)
- [ ] Services list with descriptions and prices where possible
- [ ] Products (if relevant)
- [ ] Attributes (women-led, wheelchair accessible, online appointments, etc.)
- [ ] **Photos:** logo, cover, exterior, interior, team, work samples (add new photos monthly)
- [ ] Short intro video
- [ ] Booking/appointment link, WhatsApp/messaging if enabled
- [ ] **Posts** weekly/biweekly (offers, updates, projects)
- [ ] **Q&A:** seed common questions and answer them
- [ ] Website link with UTM: `?utm_source=google&utm_medium=organic&utm_campaign=gbp` so traffic is trackable

### 11.3 Reviews (the biggest local ranking lever)

1. Get your **review link**: GBP → **Get more reviews** → copy/share the link (or short QR code).
2. Ask **every satisfied client**, right after delivery (WhatsApp/SMS/email message with the link, or a QR code on receipts/invoices).
3. **Never** buy reviews, offer incentives that violate policy, or review-gate (only asking happy clients via a filter).
4. **Reply to every review** within a few days: thank positives; respond calmly and professionally to negatives (offer to fix offline).
5. Report fake/spam reviews via **Flag as inappropriate**.
6. Show reviews on the website too (with real schema if visible).

Message template:
> Hi [Name], thank you for choosing [Business]. If you're happy with our work, would you kindly leave us a short Google review? It takes 1 minute and helps others find us: [link]. Thank you!

### 11.4 NAP consistency and citations

**NAP = Name, Address, Phone.** Keep it **identical** everywhere (website footer, GBP, Facebook, directories).

**Step by step**
1. Decide the canonical NAP format (e.g. "Plot 12, Example Rd, Kampala" and `+256 700 000 000`).
2. Check the website footer/contact page/schema use the same format.
3. List the business on: Bing Places, Apple Business Connect, Facebook Business Page, LinkedIn Company Page, Yelp (if relevant), Foursquare, local chamber/association directories, industry directories, country-specific directories (e.g. for Uganda: local business directories, UIA, UCC lists where applicable), Clutch/GoodFirms (agencies), Cylex, Hotfrog, Yellow Pages of the country.
4. Track each listing in a sheet (URL, login, date, status).
5. Search for old/duplicate listings and merge or remove them.

### 11.5 Location/service-area pages

- Create a page for each **genuine** service area with unique content (specific examples, local projects, testimonials from that area, map, local phone).
- Don't create hundreds of thin city pages.
- Embed a Google Map on the contact page; include address as text (not just an image).

### 11.6 Local link building ideas

Sponsor a local event, join chambers/associations, get listed on partner/supplier websites, local news mentions, university/community partnerships.

---

## 12. Content strategy

### 12.1 Build a content plan (step by step)

1. From keyword research (Section 3), list 20–50 questions your customers ask.
2. Group them into **topic clusters**: one **pillar page** (broad topic, e.g. "Website Design Services") + several **cluster posts** (specific questions) linking to the pillar and each other.
3. Prioritise by: business value × search demand × ease of ranking.
4. Create a calendar: e.g. 2–4 posts per month, consistently. Quality beats quantity.
5. For each post: brief (target keyword, intent, outline, competitors' gaps, internal links, CTA).
6. Publish → request indexing → share on social/email → note in tracking sheet.
7. After 60–90 days review Search Console; improve underperformers (better title, more depth, more internal links).

### 12.2 Content types that work for service businesses

- **Case studies** (problem → solution → results, screenshots, client quote). Turn every portfolio item into one.
- **Guides/how-tos** ("How to choose a POS system", "How much does a website cost in [country]").
- **Comparisons** ("WordPress vs custom website for small business").
- **Checklists/templates** (downloadable, good for backlinks).
- **FAQ pages** (real questions from sales calls).
- **Local content** (events, regulations, market insights).
- **Video** (YouTube embeds; also YouTube SEO).

### 12.3 Content quality checklist (E-E-A-T)

- [ ] Written from real experience; unique insights, real numbers, real photos.
- [ ] Accurate and up to date; cite sources.
- [ ] Clear author with bio.
- [ ] Answers the query fully; better than what currently ranks.
- [ ] Well formatted (headings, bullets, images, tables).
- [ ] Original, not copied or thinly spun. **Avoid mass-published auto-generated/news-scraped content**: it doesn't build authority for a services company and can trigger quality filters.

### 12.4 Refreshing old content

Every 6–12 months: update stats, dates, screenshots; improve intro; add new sections/FAQs; re-request indexing; update `dateModified`.

### 12.5 AI-assisted content: rules

Use AI for outlines and drafts if you like, but always add first-hand expertise, verify facts, edit heavily, and never publish unreviewed bulk output.

---

## 13. Backlinks and off-page

Links from reputable, relevant sites act as votes of trust. Quality and relevance beat quantity.

### 13.1 Free ways to earn links (step by step)

1. **Client footer credit:** add "Website by [Your Agency]" linking to your site on every site you build (agree with clients up front; use a natural anchor text like your brand name).
2. **Directories & citations** (Section 11.4): these are baseline links.
3. **Partner/supplier pages:** ask suppliers, partners, associations you belong to to list you.
4. **Guest posts** on relevant blogs/publications in your niche or region.
5. **Local press:** send press releases for launches, awards, CSR events, and notable projects.
6. **Podcasts/webinars/interviews:** speaking spots usually include a link.
7. **Create link-worthy assets:** original research/surveys, free tools/calculators, templates, infographics, comprehensive guides.
8. **HARO-style requests / expert quotes:** respond to journalist queries with real expertise (e.g. Qwoted, Featured, or local equivalents).
9. **Broken link building:** find broken links on relevant sites (Check My Links extension), offer your relevant page as the replacement.
10. **Unlinked mentions:** search your brand name; ask sites that mention you without a link to add one.
11. **Social profiles:** LinkedIn, Facebook, X, YouTube, Instagram, GitHub (for developers): complete profiles with website links.
12. **Alumni/community/university** pages, hackathon sponsorships, local NGOs.

### 13.2 What to avoid

- Buying links or link packages, PBNs, link farms, blog-comment spam, mass directory submissions, exact-match anchor spam. These risk manual actions/penalties.
- Paid/sponsored links must use `rel="sponsored"`.

### 13.3 Anchor text guidance

Mix: brand name (most), URL, generic ("this guide"), partial-match, and only occasionally exact-match keywords.

### 13.4 Disavow

Rarely needed. Use Google's Disavow tool only if you have a manual action or a large volume of clearly spammy, paid links you can't remove.

### 13.5 Social media

Social links are usually nofollow and not a direct ranking factor, but social profiles help brand visibility, branded searches and content distribution. Keep profiles consistent and linked to the site (`sameAs` in schema).

---

## 14. Performance and Core Web Vitals

Google's page experience signals: **LCP** (Largest Contentful Paint, target ≤ 2.5s), **INP** (Interaction to Next Paint, ≤ 200ms), **CLS** (Cumulative Layout Shift, ≤ 0.1).

### 14.1 Measure

1. https://pagespeed.web.dev → enter URL → check **Mobile** first (lab + field data).
2. GSC → **Experience → Core Web Vitals** (field data over ~28 days; needs traffic).
3. Chrome DevTools → **Lighthouse** tab.
4. WebPageTest.org / GTmetrix for waterfalls.

### 14.2 Fix in this order (biggest wins first)

1. **Images:** compress, resize to displayed dimensions, WebP/AVIF, `loading="lazy"` below fold, **preload the hero image**:
   ```html
   <link rel="preload" as="image" href="/images/hero.webp" fetchpriority="high">
   ```
2. **Remove unused JS/CSS/libraries** (audit `<head>` scripts, page builders, sliders).
3. **Defer non-critical JS**: `defer`/`async`; move scripts to end of body.
4. **Fonts:** self-host or use `font-display: swap`; limit weights/families; `preconnect` to font origins.
5. **Reduce render-blocking CSS:** inline critical CSS, load the rest async (or use a caching/optimisation plugin).
6. **Caching + compression:** server cache, browser cache headers, GZIP/Brotli.
7. **CDN:** Cloudflare (free tier) for static assets and DDoS protection.
8. **Server response (TTFB):** good hosting, PHP 8.1+, OPcache, database indexing, object cache.
9. **Avoid layout shift:** set `width`/`height` on images/iframes/ads; reserve space for embeds and banners.
10. **Third-party scripts** (chat widgets, pixels): load late, or remove if not valuable.

### 14.3 Laravel-specific

```bash
php artisan config:cache && php artisan route:cache && php artisan view:cache
composer install --no-dev --optimize-autoloader
```
Enable OPcache on the server, build assets with Vite for production (`npm run build`), eager-load relationships to avoid N+1 queries, cache heavy queries.

---

## 15. Launch / migration / redesign checklist

Most SEO disasters happen during launches. Follow this order.

### 15.1 Before launch (staging)

- [ ] Staging is blocked from indexing (password/HTTP auth or `noindex`).
- [ ] Crawl the **old site** (Screaming Frog) and export all URLs, titles, meta, status codes, and top pages from GSC/Analytics.
- [ ] Create a **redirect map** (old URL → new URL) for every page that changes address. Keep URLs identical when possible.
- [ ] Keep/transfer the best-performing content (don't delete high-traffic pages without a replacement).
- [ ] New site has titles, descriptions, H1s, alt text, canonicals, schema.
- [ ] Internal links point to final URLs (no links to staging domain).
- [ ] robots.txt on staging blocks all; **prepare the live version** so you don't ship the block.
- [ ] Sitemap ready; analytics installed and tested.
- [ ] Speed tests pass; mobile tested on real devices.
- [ ] Forms, phone links, and tracking events tested.

### 15.2 Launch day

1. Point DNS / deploy to production.
2. **Remove noindex / password** and replace the staging robots.txt with the live one.
3. WordPress: uncheck **Discourage search engines**.
4. Install/confirm SSL; test redirects (http→https, www→non-www).
5. Implement all **301 redirects** from the map; test 20–30 old URLs with `curl -I`.
6. Submit the new sitemap in GSC + Bing.
7. **URL inspection → Request indexing** on key pages.
8. Verify GA4 real-time works.
9. Check `site:domain.com` and crawl the live site for errors (404s, redirect chains, noindex mistakes).

### 15.3 After launch (first 4 weeks)

- [ ] Daily for week 1: GSC **Pages** report for errors; **Crawl stats**; uptime.
- [ ] Fix new 404s that appear (redirect them to the best match).
- [ ] Watch rankings/traffic; small dips right after a migration are normal, but big sustained drops mean a redirect or indexing problem.
- [ ] Use GSC **Change of Address** tool if the **domain** changed (Settings → Change of address; requires both properties verified and 301s in place).
- [ ] Update external profiles (GBP, social, directories) with the new URL.
- [ ] Ask key backlink sources to update links to new URLs (if they changed).

### 15.4 Domain change specifics

1. Keep the old domain and its 301s live for **at least 12 months** (ideally forever).
2. 301 each old URL → the same path on the new domain.
3. Add both domains to GSC; use Change of Address.
4. Update sitemap, canonicals, schema, OG tags, `APP_URL`, robots.txt sitemap line.

---

## 16. Monitoring, reporting and maintenance

### 16.1 Weekly (10 minutes)

- [ ] GSC → **Pages**: new errors? "Crawled – currently not indexed"? "Discovered – not indexed"?
- [ ] GSC → **Security & Manual actions**: clear?
- [ ] New reviews on GBP: reply.
- [ ] Publish/schedule content.

### 16.2 Monthly (1 hour)

- [ ] GSC → **Performance**: compare last 28 days vs previous; top queries/pages; find queries with **high impressions + low CTR** and improve titles/descriptions; find queries ranking **positions 8–20** and strengthen those pages (more depth, internal links, backlinks).
- [ ] GA4: organic sessions, top landing pages, conversions from organic.
- [ ] Core Web Vitals report.
- [ ] Crawl the site (Screaming Frog free) for broken links, missing titles/descriptions, duplicate H1s, redirect chains.
- [ ] Check backlinks (GSC → **Links**; free Ahrefs Webmaster Tools).
- [ ] GBP insights: calls, direction requests, website clicks; post 2–4 updates.
- [ ] Update WordPress core/plugins/themes; check backups.

### 16.3 Quarterly

- [ ] Content audit: update old posts; merge or prune thin content.
- [ ] Competitor check: new pages/backlinks.
- [ ] Re-run PageSpeed on main templates.
- [ ] Review the keyword map; add new target pages.
- [ ] Review schema errors in GSC Enhancements.

### 16.4 Reporting to clients (simple template)

Include: organic clicks/impressions (GSC), organic sessions and conversions (GA4), top 5 landing pages, top 10 queries and positions, GBP calls/directions, new reviews, work completed, plan for next month. Screenshots + 3 bullet insights beat long reports.

### 16.5 Useful free tools

| Tool | Use |
|---|---|
| Google Search Console | Indexing, queries, errors |
| Bing Webmaster Tools | Bing indexing, SEO reports |
| Google Analytics 4 | Traffic + conversions |
| PageSpeed Insights / Lighthouse | Performance |
| Rich Results Test / validator.schema.org | Schema validation |
| Screaming Frog (free ≤ 500 URLs) | Crawling/audits |
| Ahrefs Webmaster Tools (free) | Backlinks + site audit for verified sites |
| Google Trends | Demand trends |
| Google Keyword Planner | Keyword volumes |
| Ubersuggest / AnswerThePublic | Free-tier keyword ideas |
| Google Mobile-Friendly checks (Lighthouse) | Mobile |
| Facebook Debugger / LinkedIn Post Inspector | Share previews |
| SecurityHeaders.com, SSL Labs | Security/SSL checks |
| Check My Links (Chrome ext.) | Broken links |
| MozBar / SEOquake / Detailed SEO (Chrome ext.) | Quick on-page views |

---

## 17. Troubleshooting

### 17.1 Sitemap shows "Couldn't fetch" in Search Console

1. Open `https://example.com/sitemap.xml` in a browser: does it load? (An XML "no style information" message is normal.)
2. `curl -I https://example.com/sitemap.xml` → must be **HTTP 200**, `Content-Type: application/xml` or `text/xml`.
3. Confirm it isn't blocked by robots.txt, a login wall, a firewall/Cloudflare "under attack" mode, or an error page (500).
4. Confirm the URLs inside use the **same host** as the GSC property (www vs non-www, https).
5. Confirm valid XML (no HTML errors/whitespace before `<?xml`; no PHP notices).
6. Use GSC **URL inspection → Test live URL** on the sitemap URL.
7. Wait 24–48 hours; **remove and resubmit** the sitemap if it stays stuck.

### 17.2 "Crawled – currently not indexed"

Google saw the page but chose not to index it (usually quality/duplication).
1. Improve content depth/uniqueness; add internal links from strong pages; add it to the sitemap.
2. Check it isn't a near-duplicate of another page; consolidate.
3. Request indexing after improving.

### 17.3 "Discovered – currently not indexed"

Google knows the URL but hasn't crawled it yet (often low site authority or crawl budget). Add internal links, ensure a fast server, build a few backlinks, be patient.

### 17.4 "Page with redirect", "Not found (404)", "Soft 404"

- Redirects: normal for old URLs; ensure the sitemap lists final URLs only.
- 404: fix internal links; redirect if the page moved; leave 404 for truly removed pages.
- Soft 404: page returns 200 but looks empty/error-like; return a real 404 or add content.

### 17.5 "Duplicate without user-selected canonical" / "Alternate page with proper canonical tag"

Add self-referencing canonicals; consolidate duplicate URLs (http/https, www/non-www, parameters, trailing slash).

### 17.6 "Excluded by 'noindex' tag"

Confirm it's intentional. On WordPress check "Discourage search engines" and per-page SEO plugin settings; on Laravel check the `robots` section.

### 17.7 Site not showing in Google at all

1. `site:example.com` in Google: any results?
2. GSC verified? Sitemap submitted? URL inspection → Request indexing.
3. Check robots.txt isn't `Disallow: /`; no site-wide noindex; WordPress "Discourage search engines" unchecked.
4. Check Security & Manual Actions.
5. New sites can take days to weeks to appear; build a few links (GBP, social, directories).

### 17.8 Rankings dropped suddenly

1. Check GSC Manual Actions and Security issues.
2. Did something change? Redesign, URL change, robots/noindex, canonical, server errors, hacked content.
3. Check for Google core-update dates (compare timing); if aligned, improve content quality and E-E-A-T rather than chasing quick fixes.
4. Check for lost backlinks, competitors improving, seasonality.

### 17.9 Rich Results Test shows only some schema

Normal: it only lists types eligible for rich results. `LocalBusiness` shows as "Local businesses"; `Organization`/`WebSite` may not appear. Use validator.schema.org to see everything.

### 17.10 "Organization: non-critical issues" warning

Optional recommended fields are missing (e.g. `contactPoint`, `foundingDate`, `aggregateRating`). Add them if accurate; otherwise ignore.

### 17.11 Duplicate content between http/https or www/non-www

Fix with 301s (Section 5.1), consistent canonical, and consistent internal links/sitemap.

### 17.12 PageSpeed "resources couldn't be loaded"

Usually third-party or blocked resources (analytics, fonts, CDN files blocked in Google's tester). Not an indexing problem unless it's your own critical CSS/JS: check robots.txt isn't blocking `/css`, `/js`.

### 17.13 Pull conflicts on the server (Git) after adding sitemap to .gitignore

Server-edited tracked files (`sitemap.xml`, `.htaccess`) block `git pull`. Steps in Section 18.

---

## 18. Lessons learned (ByteWave project)

Real problems hit while doing this on a Laravel site hosted on cPanel/LiteSpeed. Keep these in mind on similar builds.

1. **`http://` and `www.` both returned 200** (no redirect) → duplicate content risk. Fixed with `.htaccess` rules (Section 5.1). Always test with `curl -I` for all four host/protocol combos.
2. **cPanel's PHP handler block** (`# php -- BEGIN cPanel-generated handler ... # END`) lived only in the server's `.htaccess`. A `git pull` failed because the server file was locally modified. Procedure used:
   ```bash
   cp public/.htaccess ~/htaccess.server.bak
   git checkout -- public/.htaccess public/sitemap.xml
   git pull origin main
   cat >> public/.htaccess <<'EOF'

   # php -- BEGIN cPanel-generated handler, do not edit
   # Set the “ea-php81” package as the default “PHP” programming language.
   <IfModule mime_module>
     AddHandler application/x-httpd-ea-php81 .php .php8 .phtml
   </IfModule>
   # php -- END cPanel-generated handler, do not edit
   EOF
   # ...rest of deploy (composer, migrate, caches) then: php artisan sitemap:generate
   ```
   Don't put the handler block in the repo (it breaks local XAMPP and changes per server).
3. **Generated `sitemap.xml` tracked in Git** caused pull conflicts. Fix: add `public/sitemap.xml` to `.gitignore`, `git rm --cached public/sitemap.xml`, regenerate on the server after deploy.
4. **Local database was stale** vs production, so a locally generated sitemap missed newer posts. Generate the sitemap on the server (scheduled daily), not locally.
5. **APP_URL must be the production URL** when generating sitemaps or building canonicals.
6. **Unescaped apostrophe** in a Blade `@section('meta_description', '...ByteWave's...')` caused a syntax error (HTTP 500 on that page). Avoid apostrophes or escape them.
7. **Stale compiled Blade views** produced confusing syntax errors after bulk edits → run `php artisan view:clear`.
8. **Unused JS libraries** (Framer Motion) were loading in `<head>`. Audit `<head>` scripts on every build.
9. **Duplicate `<h1>`** from banner + section headings on contact/portfolio pages. Keep exactly one.
10. **Default share image was a favicon** (tiny). Use a proper 1200×630 image.
11. **Sitemap included the testimonial submit form** (a noindex page). Keep noindex pages out of the sitemap.
12. **The Search Console "Couldn't fetch"** on first submit was temporary; the file was fine (HTTP 200, application/xml).
13. **The Rich Results Test** only showed "Local businesses" and "Organization" for the home page; that's expected.
14. **Auto-fetched news posts** aren't valuable for a services company's authority. Invest in original case studies and guides instead.
15. **Line endings (CRLF vs LF):** when editing with scripts on Windows, preserve the original line endings to avoid whole-file diffs.

---

## 19. Paid options (later)

Do the free work first. Paid options accelerate results but don't replace fundamentals.

| Option | What it does | When it makes sense |
|---|---|---|
| **Google Ads (Search)** | Immediate top-of-page ads for high-intent keywords | Need leads now; know the value of a lead; landing pages ready |
| **Google Local Services / local ads** | Pay-per-lead ads with a Google Guaranteed badge in some regions | Local trades/services where available |
| **Meta / LinkedIn / TikTok / X ads** | Awareness and retargeting | Visual products, B2B (LinkedIn), retargeting site visitors |
| **SEO tools** (Semrush, Ahrefs, Moz, SE Ranking, Mangools) | Keyword research, rank tracking, backlink analysis, site audits | Managing several clients or competitive niches |
| **Screaming Frog (paid)** | Unlimited crawling, integrations | Sites > 500 URLs |
| **Content writers / editors** | Consistent, quality content | You have keyword plans but no time |
| **PR / sponsored posts / guest posts** | Links + brand exposure | Reputable, relevant outlets only; use `rel="sponsored"` for paid |
| **Digital PR / link-building agencies** | Outreach at scale | Competitive niches; vet carefully, avoid link schemes |
| **Review/reputation tools** (Birdeye, Podium, Trustpilot) | Automate review requests | Businesses with lots of customers |
| **Premium directories** (Clutch sponsorship, etc.) | Visibility in B2B directories | Agencies/B2B services |
| **Caching/optimisation plugins** (WP Rocket, Perfmatters) | Speed | WordPress sites needing quick wins |
| **CDN/security** (Cloudflare Pro, Sucuri) | Speed/security | Higher-traffic or targeted sites |
| **Email marketing** (Mailchimp, Brevo, etc.) | Nurture and content distribution | Building an owned audience |

**Ads + SEO together:** Use ads to test which keywords convert, then build organic pages for the winners.

---

## 20. Client handover and pricing notes

### 20.1 What to deliver

- [ ] Documentation of what was done (this checklist with ticks).
- [ ] Access list (GSC, GA4, GBP, Bing) with the client as owner.
- [ ] Keyword-to-page map.
- [ ] Content calendar.
- [ ] Monthly report template.
- [ ] Training on editing meta titles/descriptions and adding content.

### 20.2 Packages you could offer (ideas)

| Package | Includes |
|---|---|
| **SEO Setup (one-off)** | Audit, technical fixes, on-page (titles/meta/headings/alt/schema), Search Console + Bing + GA4 setup, sitemap/robots, GBP optimisation |
| **Local SEO** | Setup + citations, review system, monthly GBP posts, local landing pages |
| **Monthly SEO retainer** | Monitoring, content (e.g. 2–4 posts), link building, reporting, ongoing fixes |
| **Migration / redesign SEO** | Redirect map, launch checklist, post-launch monitoring |

### 20.3 Set expectations in writing

- SEO is a long-term investment (3–6+ months for competitive terms).
- No guaranteed rankings; promise activities and reports, not positions.
- The client must provide content/photos/reviews and timely feedback.
- Agree who owns accounts and content.

---

## 21. Glossary and quick reference

| Term | Meaning |
|---|---|
| **SERP** | Search Engine Results Page |
| **Crawl / Index / Rank** | Bots fetch pages → store them → order them for queries |
| **Canonical** | The preferred URL for duplicate/similar pages |
| **noindex / nofollow** | Don't show in results / don't pass link value |
| **301 / 302** | Permanent / temporary redirect |
| **Backlink** | A link from another site to yours |
| **Anchor text** | The clickable text of a link |
| **Schema / JSON-LD** | Structured data describing page content |
| **E-E-A-T** | Experience, Expertise, Authoritativeness, Trust |
| **NAP** | Name, Address, Phone |
| **GBP** | Google Business Profile |
| **GSC** | Google Search Console |
| **CWV** | Core Web Vitals (LCP, INP, CLS) |
| **LCP / INP / CLS** | Loading / interactivity / visual stability metrics |
| **CTR** | Click-through rate (clicks ÷ impressions) |
| **Cannibalisation** | Two of your pages competing for the same keyword |
| **Orphan page** | A page with no internal links to it |
| **Thin content** | Little unique value on a page |
| **Doorway pages** | Mass near-duplicate pages made to rank for locations/keywords (avoid) |
| **Mobile-first indexing** | Google ranks using the mobile version of your site |
| **Crawl budget** | How many pages Google will crawl on your site in a period |
| **SSR/SSG** | Server-side rendering / static site generation |

### 21.1 One-page master checklist (print this)

**Setup**
- [ ] GSC verified + sitemap submitted + key pages requested
- [ ] Bing Webmaster imported + sitemap ok
- [ ] GA4 installed + linked to GSC + conversions marked
- [ ] GBP claimed, verified, fully filled, review link shared

**Technical**
- [ ] HTTPS, single canonical host (301s tested)
- [ ] robots.txt correct (not blocking live site) + sitemap line
- [ ] Sitemap: only canonical 200 URLs, no noindex pages
- [ ] Canonicals on every page; noindex on low-value pages
- [ ] Mobile-friendly; no mixed content; 404 page ok
- [ ] Speed: images optimised, scripts trimmed, caching on

**On-page**
- [ ] Unique title + description per page
- [ ] One H1 per page; logical H2/H3
- [ ] Alt text; descriptive filenames; lazy-load below-fold
- [ ] Internal links between related pages; breadcrumbs
- [ ] OG/Twitter tags with a 1200×630 image
- [ ] Schema: Organization/LocalBusiness + WebSite; Article/Product/Service/FAQ/Breadcrumb where relevant; validated

**Off-page & content**
- [ ] NAP consistent; directory listings done
- [ ] Review process in place; replying to reviews
- [ ] Content plan + publishing cadence
- [ ] Backlink outreach started; client footer credit added

**Ongoing**
- [ ] Weekly: GSC errors, reviews, publish
- [ ] Monthly: Performance report, crawl, GBP posts, updates
- [ ] Quarterly: content refresh, competitor review

---

*Last updated: 2026-09-29. Review this file every few months; Google's tools and rules change, so verify anything critical (especially schema eligibility and policy details) against Google Search Central (https://developers.google.com/search) before applying it to a client site.*
