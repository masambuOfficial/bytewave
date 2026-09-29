# ByteWave Website Branding Manual

The single source of truth for how the ByteWave website looks: colour, type, shape, components and documents. It covers the public site, the admin panel and printed documents (invoices, receipts, quotations).

> **How to use this file:** Section 2 is the whole colour system. It is short on purpose. Section 8 lists every old colour and what replaces it. Every value here has been checked for contrast; do not add new colours, use the ones in Section 2.

**Status:** adopted direction, not yet applied in code. Section 10 is the work plan.

---

## Table of Contents

1. [Principles](#1-principles)
2. [Colour](#2-colour)
3. [Logo](#3-logo)
4. [Typography](#4-typography)
5. [Shape, spacing and elevation](#5-shape-spacing-and-elevation)
6. [Components](#6-components)
7. [Documents and print](#7-documents-and-print)
8. [Migration map (old → new)](#8-migration-map-old--new)
9. [Accessibility rules](#9-accessibility-rules)
10. [Implementation plan](#10-implementation-plan)
11. [Quick reference and open decisions](#11-quick-reference-and-open-decisions)

---

## 1. Principles

1. **Three colours: Blue, White, Ink, plus a gold detail.** That is the entire brand palette. Gold `#F1C442` (`bytewave-gold`) has these jobs only, all of them tiny graphics: the 6px square marker that shows the active and hovered link in the main menu; the small icons in the footer (list chevrons and the address, phone and email icons; 3.06:1 on Blue, fine for icons); the short 3px bar under each footer column heading; and the small square dot in the white badge above the home hero headline ("Your Trusted ICT & Multimedia Partner"); the rotating phrase in the home hero headline, which sits on a solid gold chip with brand-blue text, first letters capitalised (the one large gold shape, by the owner's choice; blue on gold is 3.06:1, which passes only because the text is large bold headline text; never use it for small text, and never white on gold); the small square before each section label (the uppercase blue eyebrows); the active dash in the hero slide indicator; the filled stars in the home testimonial slider (on the dark card only); the bar on the About quote block; the short bar above each number in the stats band; the arrow in the back-to-top button; and the active-item bar in the admin sidebar. New uses need the owner's OK. It is never used for text, buttons, backgrounds, cards, or anything else. Nothing else is used for branding.
2. **One blue.** It is the logo blue. There is no second blue, no dark blue, no light blue, no stock Tailwind `blue-*`.
3. **Shades come from opacity, not new colours.** A lighter blue is the same blue at lower strength (`bytewave-blue/5`). Softer text is Ink at lower strength (`bytewave-ink/70`). This keeps everything in one family.
4. **Gold only as tiny sprinkles, and no gradients.** The logo's gold shape is retired (Section 3). Apart from the sprinkles listed in principle 1, nothing on the site is gold or yellow. Backgrounds, buttons and overlays are flat colours: no colour fades anywhere. Image scrims are a flat Ink tint (for example `bg-bytewave-ink/60`), never a fade to transparent.
5. **Same brand everywhere.** The public site, the admin panel and a printed invoice use the same palette and the same font.
6. **Readable before pretty.** Every pairing must pass the contrast rules in Section 9. A combination that looks good but fails is not allowed.

---

## 2. Colour

### 2.1 The palette

| Name | Hex | Tailwind token | Job |
|---|---|---|---|
| **Blue** | `#0773B9` | `bytewave-blue` | Buttons, links, icons, headings, footer background, active states |
| **White** | `#FFFFFF` | `white` | Page and card backgrounds, text on Blue |
| **Ink** | `#0B1F33` | `bytewave-ink` | Body text, headings, button hover, dark overlays |

Blue is the exact blue sampled from the logo file (`#0773B9`). Ink is a very dark blue-black, chosen so it sits naturally next to the Blue instead of being neutral black or grey.

### 2.2 Strengths (opacity)

Use the opacity modifier in Tailwind (`bg-bytewave-blue/5`). In print and PDF views, where Tailwind may not load, use the literal hex on the right.

| Recipe | Result on white | Use |
|---|---|---|
| Blue at 5% | `#F3F8FC` | Alternate section backgrounds, table header rows, card hover |
| Blue at 10% | `#E6F1F8` | Icon tiles, selected rows, tags |
| Blue at 20% | `#CDE3F1` | Borders and dividers on light backgrounds |
| Ink at 100% | `#0B1F33` | Headings, body text |
| Ink at 70% | `#546270` | Secondary text, captions |
| Ink at 50% | `#858F99` | Input borders only. Never for text |

Do not use any strength not in this table. In particular, **Ink at 60% or lighter is never used for text** (4.45:1 and below fails).

### 2.3 Text on backgrounds

| Background | Text allowed | Contrast |
|---|---|---|
| White | Ink (16.69), Ink 70% (6.25), Blue (5.05) | Pass |
| Blue at 5% | Ink (15.61), Ink 70% (5.85), Blue (4.72) | Pass |
| Blue at 10% | Ink only. Blue text is 4.40, which fails | Ink (14.55) |
| Blue at 20% | Ink only | Pass |
| **Blue (solid)** | **White at 100% only** (5.05) | See below |
| Ink (solid) | White (16.69) | Pass |

Two rules follow from this:

- **Text on solid Blue is pure white.** White at 90% is 4.40:1 and at 80% is 3.81:1, both failing. Footer links, footer body text and button labels on Blue are 100% white. Separate primary from secondary text by size and weight, not by dimming.
- **Ink text is never placed on solid Blue** (3.31:1).

### 2.4 Status colours (functional exception)

Success, error and warning need colours that mean something, and the brand palette cannot provide them. These are the **only** colours allowed outside Blue, White and Ink. They are used for state only, mostly in the admin panel and forms, always with a word beside them ("Paid", "Overdue"), and never for decoration.

| State | Text and icon | Badge background | Text on white |
|---|---|---|---|
| Success | `#17703F` | `#E3F5EA` | 6.13 |
| Danger | `#C0392B` | `#FDEDEC` | 5.44 |
| Warning | `#92600C` | `#FFF1D1` | 5.38 |

Informational messages use Blue at 10% with Ink text, not a fourth colour.

Suggested tokens: `bytewave-success`, `bytewave-danger`, `bytewave-warning` and their `-bg` versions.

---

## 3. Logo

The logo is a blue "ByteWave" wordmark with a mark made of two blue triangles and a parallelogram between them, plus the line "Investments-SMC LTD" and the tagline "Let's talk Solutions".

### 3.1 Change: retire the gold

The parallelogram in the current logo file is gold (`#F1C442`). With gold removed from the brand, the mark needs a new colour for that shape. Options, in order of preference:

| Option | Result |
|---|---|
| **A. Blue at 60% (about `#6AABD5`)** | Two-tone blue mark. The shapes stay clearly separate. **Recommended.** It is still the same blue, only lighter. |
| B. Ink `#0B1F33` | Crisp and strong, but heavier and darker than the rest of the mark |
| C. Solid Blue for everything | Simplest, but the mark loses its separation and movement |

**Decision needed** (Section 11). Until the logo is updated, the site's use of the current gold logo will not match the rest of the brand.

### 3.2 Versions

| Version | Use on | Status |
|---|---|---|
| Full colour (Blue wordmark, chosen parallelogram colour) | White and Blue-at-5% backgrounds | Needs to be recoloured |
| Reversed (all white; the parallelogram at 60% white) | Solid Blue (footer, hero overlay) and Ink | **Needs to be made** |

The full-colour logo is never placed on solid Blue or on a photograph. The blue disappears.

### 3.3 Rules

- Clear space around the logo is at least the height of the parallelogram on every side.
- Minimum height on screen: 32px. The header uses 40px (`h-10`).
- Never recolour outside the versions above, stretch, rotate, add shadows or effects.
- Export as SVG (preferred) and PNG. Replace the files in `public/images` (`ByteWave_Logo.png`, `BYTEWAVE_INVESTMENTS-LOGO.png`).
- The tagline "Let's talk Solutions" may be used as a small hero kicker.

---

## 4. Typography

**Typeface: Mona Sans** (Google Fonts, already loaded on the public site). One family for the whole system.

- The admin panel currently uses Outfit (`layouts/admin.blade.php`). It moves to Mona Sans so admin and public site match.
- Fallback stack, already in `app.css`: `'Mona Sans', ui-sans-serif, system-ui, sans-serif`.
- Documents rendered as PDF must confirm Mona Sans loads, or fall back to a system sans-serif.

### 4.1 Scale

| Role | Size (desktop) | Weight | Tracking | Colour |
|---|---|---|---|---|
| Display / hero H1 | 48-60px | 800 | -0.02em | White on hero and Blue, Ink on white |
| H2 | 32-40px | 700 | -0.015em | Ink |
| H3 | 24px | 700 | -0.01em | Ink |
| H4 / card title | 18-20px | 700 | 0 | Ink |
| Body | 16px, line-height 1.6 | 400 | 0 | Ink, or Ink 70% for secondary |
| Small / caption | 14px | 400-500 | 0 | Ink 70% |
| Eyebrow / kicker | 12-13px, UPPERCASE | 700 | 0.12em | Blue on light, White on Blue |
| Button | 15-16px | 700 | 0 | White on Blue |

Headings are balanced (`text-wrap: balance`), body measure is about 65 characters, no more than three weights on one page, and numbers in tables and invoices use tabular figures (`tabular-nums`).

---

## 5. Shape, spacing and elevation

- **Signature shape:** the CTA button has an asymmetric corner, with the bottom-right larger than the others. This is a brand mark; use it on buttons and nowhere else. The corner scales with the button so it keeps the same proportion (about a third of the height): `8px 8px 20px 8px` on the 60px public button, `8px 8px 16px 8px` on the 48px sizes, and `6px 6px 12px 6px` on the 40px admin compact size.
- **Radius scale:** inputs and small controls `rounded-lg` (8px), cards `rounded-xl` (12px), large panels and images `rounded-2xl` (16px), pills and avatars `rounded-full`.
- **Spacing:** 4px base unit. Section padding 64-96px vertical on desktop, 40-56px on mobile. Side gutters never below 16px.
- **Borders:** 1px `bytewave-blue/20`.
- **Elevation:** flat by default. One soft shadow for floating elements (menus, modals): `0 8px 24px rgba(11, 31, 51, 0.12)`, tinted with Ink, not black.

---

## 6. Components

### 6.1 Buttons

| Button | Background | Text | Arrow square | Hover |
|---|---|---|---|---|
| **Primary CTA** (on white or light) | Blue | White | White square, Blue arrow | Background becomes Ink |
| **Primary CTA on Blue or hero** | White | Blue | Blue square, White arrow | Background becomes Blue at 5%, text Ink |
| **Secondary** | Transparent, 1.5px Blue border | Blue | none | Fill Blue at 10%, text Ink |
| **Secondary on Blue or hero** | Transparent, 1.5px White border | White | none | Fill white at 10% |
| **Text link** | none | Blue | none | Ink, underline |
| **Destructive** | Danger `#C0392B` | White | none | Ink |

**One button format.** Every call-to-action on the public site is the `<x-cta-button>` component (`resources/views/components/cta-button.blade.php`): the asymmetric corner (`8px 8px 20px 8px`), a label that slides up on hover, and an arrow square that swaps on hover. Never hand-write a button; use the component.

| Use | Markup |
|---|---|
| Link, on white or light | `<x-cta-button :href="..." text="..." />` |
| Link, on a Blue band or hero | add `variant="light"` (white button, Blue text) |
| Form submit | add `type="submit"` (renders a real `<button>`) |
| Compact (cards, inline forms) | add `size="sm"` (48px instead of 60px) |
| Fill the container | add `full-width` |
| Custom label markup (Alpine states) | put it in the slot instead of `text` |

Rules: hover on the primary CTA goes to **Ink**, never to stock Tailwind `blue-600` or `blue-700`. One primary CTA per screen area. Sizes are 60px (default) and 48px (`sm`). A button on a white card takes the default variant; `light` is only for Blue backgrounds, because a white button on white disappears. Filter chips, slider arrows, accordion headers, pagination and text links ("Learn more →", "Back to…") are UI controls, not CTAs, and are not built with this component. Icon-only buttons (search, close) use a plain Blue square with Ink hover.

**Admin panel.** The admin uses the same format through `<x-admin.button>` (`components/admin/button.blade.php`, styles `.bw-btn` in `layouts/admin.blade.php`), because the admin loads Bootstrap and not Tailwind. Every admin button is solid Blue (Add, Save, Create, Filter, Cancel, Back, Reset), so pairs of buttons stay balanced; `variant="secondary"` is accepted but looks the same, and `variant="danger"` is red; `size="sm"` (40px) for toolbars. Icon-only row actions (edit, delete, approve) and the inline "add line" controls stay compact. To change a button's label from a script, use `bwLabel(button, 'Saving…')`, never `innerHTML`, so the arrow survives.

### 6.2 Links

Blue, weight 600, underline on hover with colour change to Ink. On Blue backgrounds (footer) links are 100% white with an underline on hover.

### 6.3 Header and navigation

The header sits over the hero. Link text is always white; it never turns blue, because blue text is unreadable on the hero photo. The active and hovered link show the small square marker that is already in the header, drawn in **gold** and 6px (`w-1.5 h-1.5`), and the active link is also semibold. The dropdown panel is white: items are Ink, and hover or active items use Blue text on Blue at 5%. If the header is ever placed on a white background, links are Ink with the same marker in Blue. Use the reversed logo over dark hero images and the full-colour logo on white.

### 6.4 Hero

The hero is a photograph with an **Ink** overlay (from Ink at 70% to Ink at 40%), replacing the current black overlay. Headline is white, body text white, kicker white uppercase. Primary CTA on hero and an optional secondary on hero. No decorative gradients between blues.

### 6.5 Cards and sections

Sections alternate White and Blue at 5%. Cards are white with a 1px `bytewave-blue/20` border and `rounded-xl`. Icon tiles are Blue at 10% with a Blue icon. Tags ("Popular", "New") are Blue at 10% with Ink text, `rounded-full`. Nothing on a card uses any other colour.

### 6.6 Forms

Input: white, 1.5px `bytewave-ink/50` border, `rounded-lg`, 46px tall, Ink text, Ink 70% placeholder. Focus: 2px Blue ring with a 2px offset. Error: Danger border and message. Labels Ink, 14px, weight 600. The submit button is a primary CTA.

### 6.7 Footer

The footer is solid **Blue**. All text is **100% white** (Section 2.3). Column headings are white and bold (700), each with a short gold bar beneath (40px wide, 3px tall, `bg-bytewave-gold`). List links are white, weight 500, and slide 8px to the right on hover (`hover:translate-x-2`); contact rows do the same, with their divider on a wrapper so the line stays put. Bottom-row links underline on hover. **Social icons** are outlined circles (2px white border, white icon, transparent fill); on hover they fill white, the icon turns Blue, and the circle lifts 4px with a soft shadow. Never gold, and never a hover state that hides the icon. The back-to-top button is an Ink circle with a 2px white ring so it is visible on both white and the Blue footer. No other colours.

### 6.8 Admin panel

Same palette and font. Page background White; alternate areas Blue at 5%. Sidebar is solid Blue with 100% white text; the active item has a 3px white left rule and a white 15% background overlay. Tables: header row Blue at 5% with Ink 70% uppercase 12px text, rows separated by `bytewave-blue/20`, tabular figures. Status uses Section 2.4 badges. Primary actions are Blue buttons.

### 6.9 Charts and data

Series order: Blue, Ink, Blue 60%, Ink 60%, Blue 30%. Grid lines `bytewave-blue/20`, labels Ink 70%. Never use status colours for data series.

### 6.10 Background art

Sections carry faint decorative art: fine line icons for ICT (code, chip, network, server, cloud, circuit) and multimedia (video, camera, microphone, sound wave, broadcast, headphones, photo), mixed with flat geometric shapes (disc, half and quarter disc, diamond, cross, dot grid, rings, dashed ring, hexagon, rounded square, wave, zigzag, chevrons, corner marks). It was approved in a design preview.

- **Strength 8%, size 80%.** Blue on light sections, white on solid blue ones. Never at a higher strength.
- **Flat only.** No gradients, no blur, no gold. Outlined shapes use the icon stroke weight.
- **Never behind small text or forms.** The art lives in the corners and margins; the layouts are fixed for that reason.
- **Use the component:** put `relative isolate` on the section and `<x-bg-art layout="white|tint|dark" />` as its first child. Use `flip` on neighbouring sections so they don't repeat. Symbols are defined once in `components/art-sprite.blade.php` (included in the layout); the art is inline SVG with no image downloads, is hidden from assistive technology and ignores the pointer.
- **Phones** show only the larger shapes (the smaller ones are hidden below 768px).
- **Where it is not used:** photo banners (the photo is already busy), the testimonial form page, login, the footer, and the client-logo and testimonial sliders.

---

## 7. Documents and print

Invoices, receipts and quotations are seen by clients and must match the website. Use literal hex values, not Tailwind classes, because print and PDF views may not load Tailwind.

- **Header:** the full-colour logo on white, company details on the right, and a 3px Blue rule (`#0773B9`) above the document title (INVOICE, RECEIPT, QUOTATION) in Ink.
- **Items table:** a solid Blue header row (`#0773B9`) with white uppercase text, rows separated by `#CDE3F1` rules, subtotal and "amount in words" rows on `#F3F8FC`.
- **Total row:** solid Blue with white bold text (5.05:1).
- **Text:** body `#0B1F33`, labels and notes `#546270`. Paid and balance rows on receipts use the status colours (`#17703F` on `#E3F5EA`, `#C0392B` on `#FDEDEC`).
- **Print button** (screen only, hidden when printing): Blue.
- **Font:** DejaVu Sans, because DomPDF cannot load web fonts. Mona Sans would need its font files installed for DomPDF (open decision 4).
- The old `#1565C0` blue is gone from all three templates (step 7 done).
- Currency uses tabular numerals, right-aligned. The business bills in UGX and USD.

---

## 8. Migration map (old → new)

### 8.1 Colours

| Found in code | Count | Replace with |
|---|---|---|
| `bytewave-blue` (`#0773B8`) | 94 | `bytewave-blue` (`#0773B9`, effectively unchanged) |
| Tailwind `blue-50`, `blue-100` | | `bytewave-blue/5`, `bytewave-blue/10` |
| Tailwind `blue-500`, `blue-600`, `blue-700`, `#3B82F6`, `#2563EB` (including the footer's `bg-blue-600`) | 181 uses of `blue-*` | `bytewave-blue`; hover `bytewave-ink` |
| `bytewave-blue-50 … -900` | ~35 | `bytewave-blue/5 … /20`, or `bytewave-ink` for the darkest steps |
| `#1565C0` (print) | 20 | `#0773B9` |
| `#007BFF`, `#0056B3`, `#EFF6FF` | | `#0773B9`, `#0773B9`, `#F3F8FC` |
| `bytewave-gold` (all steps), `#FBB145`, `#F59E0B`, `yellow-*` | ~145 | Removed. Replace per Section 6 (blue, white or Ink) |
| Tailwind `gray-*` | 290 (public) | `bytewave-ink`, `bytewave-ink/70`, `bytewave-blue/20`, `bytewave-blue/5` |
| `#6B7A85`, `#8A97A0`, `#4B5A63`, `#6C757D`, `#64748B`, `#94A3B8` | 31, 21, 7, 4, 4, 6 | `#546270` (Ink 70%) |
| `#1F2A33`, `#1A1A1A`, `#0F172A`, `#333`, `#444` | | `#0B1F33` (Ink) |
| `#EEF1F4`, `#F1F4F7`, `#F4F6F8`, `#F1F3F5`, `#F1F5F9`, `#F8FAFC`, `#FAFBFC`, `#F6F6F6` | | `#F3F8FC` (Blue 5%) or white |
| `#DCE3E8`, `#E2E8EE`, `#DEE2E6` | | `#CDE3F1` (Blue 20%) |
| `#1E8E4F`, `#2E7D32` | | `#17703F` |
| `#E74C3C` | | `#C0392B` |
| `theme-color` `#ffffff` | | `#0773B9` |
| `body style="background-color: #F6F6F6"` | | `bg-white` |
| Black hero overlay `from-black/70 to-black/40` | | `from-bytewave-ink/70 to-bytewave-ink/40` |

### 8.2 Known one-offs in `home.blade.php`

- Line 130-131: CTA passes `bg-blue-500` and `hover:bg-blue-600`. Remove the overrides so the component default applies.
- Line 450: gradient `#0773B8 → #04456E` becomes solid Blue.
- Line 637: gold-to-yellow gradient card becomes solid Blue with white text.
- Line 650: `from-blue-600 to-blue-700` becomes solid Blue.
- Line 373: `from-gray-900 to-gray-800` becomes solid Ink.
- Line 144: the slider indicator `bg-bytewave-gold` becomes `bg-white`.
- Footer line 117: the gold back-to-top button becomes a Blue button with a white arrow (hover Ink).

### 8.3 Files

`resources/css/app.css` (tokens), `resources/views/components/cta-button.blade.php` (defaults and hover), `resources/views/layouts/{app,auth,admin}.blade.php`, `layouts/partials/{header,footer}.blade.php`, `home.blade.php`, all other public views, all `admin/*` views (about 250 hex literals), the three print views (`admin/invoices/print`, `admin/invoices/receipt`, `admin/quotations/print`), and `public/css/style.css` and `public/css/bootstrap.min.css` (both deleted in step 8).

### 8.4 Tokens for `resources/css/app.css`

```css
@theme {
    --font-sans: 'Mona Sans', ui-sans-serif, system-ui, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji',
        'Segoe UI Symbol', 'Noto Color Emoji';

    /* BYTEWAVE brand: Blue, White, Ink. Use opacity for lighter strengths, e.g. bg-bytewave-blue/5 */
    --color-bytewave-blue: #0773B9;
    --color-bytewave-ink: #0B1F33;

    /* Status: functional only, never decorative */
    --color-bytewave-success: #17703F;
    --color-bytewave-success-bg: #E3F5EA;
    --color-bytewave-danger: #C0392B;
    --color-bytewave-danger-bg: #FDEDEC;
    --color-bytewave-warning: #92600C;
    --color-bytewave-warning-bg: #FFF1D1;
}
```

Removing the old `bytewave-blue-50…900` and `bytewave-gold-*` tokens will break any class still using them. That is intended: each break is a place that needs review.

---

## 9. Accessibility rules

Measured with the WCAG contrast formula. Minimums: **4.5:1** for normal text, **3:1** for large text (24px, or 19px bold), icons and input borders.

| Pairing | Ratio | Verdict |
|---|---|---|
| White on Blue | 5.05 | Pass |
| Blue on White | 5.05 | Pass |
| Blue on Blue 5% | 4.72 | Pass |
| Blue on Blue 8% | 4.53 | Borderline. Do not go above 5% |
| Blue on Blue 10% | 4.40 | **Fail** for text. Use Ink |
| White at 90% on Blue | 4.40 | **Fail**. Use 100% white |
| White at 80% on Blue | 3.81 | **Fail** |
| Ink on White | 16.69 | Pass |
| Ink 70% on White | 6.25 | Pass |
| Ink 70% on Blue 5% | 5.85 | Pass |
| Ink 60% on White | 4.45 | **Fail**. Do not use for text |
| Ink 50% input border on White | 3.28 | Pass (needs 3:1) |
| White on Ink | 16.69 | Pass |
| Ink on solid Blue | 3.31 | **Fail**. Never |

Also:
- Every interactive element has a visible focus state (2px Blue ring, 2px offset). Never remove outlines without replacing them.
- State is never shown by colour alone: badges carry a word (Paid, Overdue).
- Respect `prefers-reduced-motion` for button and hero animations.

---

## 10. Implementation plan

Each step is a separate, reviewable change.

1. **Tokens.** Replace the colour block in `resources/css/app.css` with Section 8.4. Rebuild assets.
2. **Blue everywhere.** Replace stock `blue-*` and all `bytewave-blue-*` steps with `bytewave-blue`, its opacity strengths or `bytewave-ink` (Section 8.1). Fix the CTA component and the `home.blade.php` overrides. Update `theme-color` and the body background.
3. **Remove gold.** Find every use with `grep -rniE "gold|yellow|FBB145|F59E0B" resources/views` and replace per Section 6. This is the largest manual step; review page by page rather than find-and-replace.
4. **Neutrals.** Replace `gray-*` and the grey hex codes with Ink, Ink 70% and Blue strengths.
5. **Footer and hero.** Solid Blue footer with 100% white text; Ink overlay on the hero.
6. **Admin panel.** Switch the font to Mona Sans, replace hex literals with tokens, apply the status badges.
7. **Print documents.** Replace `#1565C0` and the neutrals with the literal hex values in Section 7, and add the Blue total rule.
8. **Cleanup (done).** `public/css/style.css` and the unused `public/css/bootstrap.min.css` are deleted. The back-to-top button now appears after scrolling, the legacy pages have the standard image banner, and banners with a missing photo fall back to solid Ink.
9. **Logo.** Recolour the parallelogram, export the reversed version, replace the files (Section 3).
10. **Verify.** Review the home page, one inner page, the login page, the admin dashboard and one printed invoice at phone and desktop widths.

---

## 11. Quick reference and open decisions

**Cheat sheet**

- Palette: **Blue** `#0773B9`, **White** `#FFFFFF`, **Ink** `#0B1F33`. Nothing else.
- Lighter shades = the same colour at lower opacity. Blue 5% for backgrounds, Blue 20% for borders, Ink 70% for secondary text.
- On solid Blue, text is 100% white. Never Ink, never dimmed white.
- Primary button: Blue, hover Ink. On hero or Blue: White, hover Blue 5%.
- Footer: solid Blue. Hero overlay: Ink.
- No gold, no yellow, no stock Tailwind blues.
- One font: **Mona Sans**. Signature button corner `8px 8px 20px 8px`.

**Open decisions**

1. **Logo parallelogram colour.** Blue at 60% (recommended), Ink, or solid Blue. Decide before step 9.
2. **Reversed logo.** A white version is needed for the footer and hero. It does not exist yet.
3. **Ink button hover.** Blue-to-Ink is a strong change. If it feels too heavy, the alternative is the same Blue with a 2px Ink underline on the label. Try it on the first button and decide.
4. **Print fonts.** Confirm Mona Sans embeds in the PDF generator or choose a fallback.
