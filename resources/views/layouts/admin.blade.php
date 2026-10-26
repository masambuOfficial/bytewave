<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GSMXYXJ375"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-GSMXYXJ375');
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - BYTEWAVE Admin</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Mona Sans: the same font as the public site -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mona+Sans:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css" rel="stylesheet">

    <style>
        * {
            font-family: 'Mona Sans', ui-sans-serif, system-ui, sans-serif;
        }
    </style>

    <style>
        /* Brand palette (BRAND.md): Blue, White, Ink. The old variable names are kept so page CSS keeps working:
           --bytewave-blue-dark is now Ink, --bytewave-blue-light is Blue at 10%. */
        :root {
            --bytewave-blue: #0773B9;
            --bytewave-blue-dark: #0B1F33;
            --bytewave-blue-light: #E6F1F8;

            /* Bootstrap, pointed at the brand palette */
            --bs-primary: #0773B9;
            --bs-primary-rgb: 7, 115, 185;
            --bs-secondary: #546270;
            --bs-secondary-rgb: 84, 98, 112;
            --bs-success: #17703F;
            --bs-success-rgb: 23, 112, 63;
            --bs-danger: #C0392B;
            --bs-danger-rgb: 192, 57, 43;
            --bs-warning: #92600C;
            --bs-warning-rgb: 146, 96, 12;
            --bs-info: #0773B9;
            --bs-info-rgb: 7, 115, 185;
            --bs-light: #F3F8FC;
            --bs-light-rgb: 243, 248, 252;
            --bs-dark: #0B1F33;
            --bs-dark-rgb: 11, 31, 51;
            --bs-body-color: #0B1F33;
            --bs-body-color-rgb: 11, 31, 51;
            --bs-secondary-color: #546270;
            --bs-border-color: #CDE3F1;
            --bs-link-color: #0773B9;
            --bs-link-color-rgb: 7, 115, 185;
            --bs-link-hover-color: #0B1F33;
            --bs-link-hover-color-rgb: 11, 31, 51;
            --bs-body-font-family: 'Mona Sans', ui-sans-serif, system-ui, sans-serif;
        }

        /* Buttons: Blue, hover Ink (BRAND.md 6.1) */
        .btn-primary {
            --bs-btn-bg: #0773B9; --bs-btn-border-color: #0773B9;
            --bs-btn-hover-bg: #0B1F33; --bs-btn-hover-border-color: #0B1F33;
            --bs-btn-active-bg: #0B1F33; --bs-btn-active-border-color: #0B1F33;
            --bs-btn-disabled-bg: #0773B9; --bs-btn-disabled-border-color: #0773B9;
            --bs-btn-focus-shadow-rgb: 7, 115, 185;
        }
        .btn-outline-primary {
            --bs-btn-color: #0773B9; --bs-btn-border-color: #0773B9;
            --bs-btn-hover-bg: #0773B9; --bs-btn-hover-border-color: #0773B9;
            --bs-btn-active-bg: #0B1F33; --bs-btn-active-border-color: #0B1F33;
            --bs-btn-focus-shadow-rgb: 7, 115, 185;
        }
        .btn-secondary, .btn-outline-secondary {
            --bs-btn-color: #546270; --bs-btn-border-color: #546270;
            --bs-btn-hover-bg: #546270; --bs-btn-hover-border-color: #546270;
            --bs-btn-active-bg: #0B1F33; --bs-btn-active-border-color: #0B1F33;
        }
        .btn-secondary { --bs-btn-color: #FFFFFF; --bs-btn-bg: #546270; }
        .btn-danger { --bs-btn-bg: #C0392B; --bs-btn-border-color: #C0392B; --bs-btn-hover-bg: #0B1F33; --bs-btn-hover-border-color: #0B1F33; --bs-btn-active-bg: #0B1F33; --bs-btn-active-border-color: #0B1F33; }
        .btn-outline-danger { --bs-btn-color: #C0392B; --bs-btn-border-color: #C0392B; --bs-btn-hover-bg: #C0392B; --bs-btn-hover-border-color: #C0392B; --bs-btn-active-bg: #C0392B; --bs-btn-active-border-color: #C0392B; }
        .btn-success { --bs-btn-bg: #17703F; --bs-btn-border-color: #17703F; --bs-btn-hover-bg: #0B1F33; --bs-btn-hover-border-color: #0B1F33; --bs-btn-active-bg: #0B1F33; --bs-btn-active-border-color: #0B1F33; }
        .btn-outline-success { --bs-btn-color: #17703F; --bs-btn-border-color: #17703F; --bs-btn-hover-bg: #17703F; --bs-btn-hover-border-color: #17703F; --bs-btn-active-bg: #17703F; --bs-btn-active-border-color: #17703F; }
        .btn-warning { --bs-btn-color: #FFFFFF; --bs-btn-bg: #92600C; --bs-btn-border-color: #92600C; --bs-btn-hover-color: #FFFFFF; --bs-btn-hover-bg: #0B1F33; --bs-btn-hover-border-color: #0B1F33; --bs-btn-active-color: #FFFFFF; --bs-btn-active-bg: #0B1F33; --bs-btn-active-border-color: #0B1F33; }
        .btn-dark { --bs-btn-bg: #0B1F33; --bs-btn-border-color: #0B1F33; --bs-btn-hover-bg: #0773B9; --bs-btn-hover-border-color: #0773B9; --bs-btn-active-bg: #0773B9; --bs-btn-active-border-color: #0773B9; }
        .alert-info { --bs-alert-color: #0B1F33; --bs-alert-bg: #E6F1F8; --bs-alert-border-color: #CDE3F1; }
        .btn-light { --bs-btn-bg: #F3F8FC; --bs-btn-border-color: #CDE3F1; --bs-btn-color: #0B1F33; --bs-btn-hover-bg: #E6F1F8; --bs-btn-hover-border-color: #CDE3F1; --bs-btn-hover-color: #0B1F33; }

        /* The ByteWave button (the admin.button component): same format as the public site's call-to-action */
        .bw-btn {
            --bw-bg: #0773B9; --bw-fg: #FFFFFF; --bw-hover: #0B1F33; --bw-arrow-bg: #FFFFFF; --bw-arrow-fg: #0773B9; --bw-move: 28px;
            display: inline-flex; align-items: center; gap: 0.75rem;
            height: 48px; padding: 6px 6px 6px 20px;
            border: 0; border-radius: 8px 8px 16px 8px;
            background: var(--bw-bg); color: var(--bw-fg);
            font-size: 0.9rem; font-weight: 600; line-height: 1; white-space: nowrap;
            text-decoration: none; cursor: pointer; overflow: hidden;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .bw-btn:hover { background: var(--bw-hover); color: var(--bw-fg); text-decoration: none; }
        .bw-btn:focus-visible { outline: 3px solid #0773B9; outline-offset: 2px; }
        .bw-btn:disabled, .bw-btn.disabled { opacity: 0.6; cursor: not-allowed; }
        .bw-btn__label { position: relative; display: inline-block; overflow: hidden; height: 20px; line-height: 20px; }
        .bw-btn__label > span { display: inline-block; transition: transform 0.3s ease; }
        .bw-btn__label > span + span { position: absolute; left: 0; top: 100%; }
        .bw-btn:hover .bw-btn__label > span { transform: translateY(-100%); }
        .bw-btn__arrow {
            position: relative; overflow: hidden; flex: 0 0 36px; width: 36px; height: 36px;
            border-radius: 6px; background: var(--bw-arrow-bg); color: var(--bw-arrow-fg);
        }
        .bw-btn__arrow svg { position: absolute; inset: 0; margin: auto; width: 16px; height: 16px; transition: transform 0.3s ease; }
        .bw-btn__arrow svg + svg { transform: translateX(calc(var(--bw-move) * -1)); }
        .bw-btn:hover .bw-btn__arrow svg:first-child { transform: translateX(var(--bw-move)); }
        .bw-btn:hover .bw-btn__arrow svg + svg { transform: translateX(0); }
        /* Cancel, back and reset are solid Blue like every other button, so pairs such as Filter and Reset stay balanced.
           The variant name is kept so existing markup keeps working. */
        .bw-btn--secondary { }
        .bw-btn--danger { --bw-bg: #C0392B; --bw-arrow-fg: #C0392B; }
        /* Compact, for toolbars and table headers */
        .bw-btn--sm { height: 40px; padding: 4px 4px 4px 16px; gap: 0.6rem; font-size: 0.85rem; border-radius: 6px 6px 12px 6px; }
        .bw-btn--sm .bw-btn__arrow { flex-basis: 32px; width: 32px; height: 32px; }
        @media (prefers-reduced-motion: reduce) { .bw-btn, .bw-btn * { transition: none !important; } }

        /* Form fields: Ink 50% border (3:1), Blue focus */
        .form-control, .form-select { border-color: #858F99; color: #0B1F33; }
        .form-control::placeholder { color: #546270; }
        .form-control:focus, .form-select:focus { border-color: #0773B9; box-shadow: 0 0 0 0.2rem rgba(7, 115, 185, 0.2); }

        /* Date picker (flatpickr), on the brand palette: Blue, White, Ink */
        .flatpickr-calendar { font-family: 'Mona Sans', ui-sans-serif, system-ui, sans-serif; border-radius: 8px; border: 1px solid #CDE3F1; box-shadow: 0 8px 24px rgba(11, 31, 51, 0.12); color: #0B1F33; }
        .flatpickr-calendar.arrowTop:before, .flatpickr-calendar.arrowTop:after { border-bottom-color: #0773B9; }
        .flatpickr-calendar.arrowBottom:before, .flatpickr-calendar.arrowBottom:after { border-top-color: #FFFFFF; }
        .flatpickr-months { background: #0773B9; border-radius: 7px 7px 0 0; }
        .flatpickr-months .flatpickr-month, .flatpickr-current-month .flatpickr-monthDropdown-months, .flatpickr-current-month input.cur-year { color: #FFFFFF; fill: #FFFFFF; font-weight: 600; }
        .flatpickr-current-month .flatpickr-monthDropdown-months { background: #0773B9; }
        .flatpickr-current-month .flatpickr-monthDropdown-months:hover, .flatpickr-current-month .flatpickr-monthDropdown-months:focus { background: #0B1F33; }
        .flatpickr-current-month .flatpickr-monthDropdown-months .flatpickr-monthDropdown-month { background: #0773B9; color: #FFFFFF; }
        .numInputWrapper:hover { background: rgba(255, 255, 255, 0.12); }
        .numInputWrapper span.arrowUp:after { border-bottom-color: #FFFFFF; }
        .numInputWrapper span.arrowDown:after { border-top-color: #FFFFFF; }
        .flatpickr-months .flatpickr-prev-month, .flatpickr-months .flatpickr-next-month { color: #FFFFFF; fill: #FFFFFF; }
        .flatpickr-months .flatpickr-prev-month:hover svg, .flatpickr-months .flatpickr-next-month:hover svg { fill: #FFFFFF; opacity: .75; }
        .flatpickr-weekdays { background: #F3F8FC; }
        span.flatpickr-weekday { background: #F3F8FC; color: #546270; font-weight: 600; }
        .flatpickr-day { color: #0B1F33; border-radius: 6px; }
        .flatpickr-day:hover, .flatpickr-day:focus { background: #E6F1F8; border-color: #E6F1F8; }
        .flatpickr-day.today { border-color: #0773B9; }
        .flatpickr-day.today:hover, .flatpickr-day.today:focus { background: #0773B9; border-color: #0773B9; color: #FFFFFF; }
        .flatpickr-day.selected, .flatpickr-day.selected:hover, .flatpickr-day.selected:focus { background: #0773B9; border-color: #0773B9; color: #FFFFFF; }
        .flatpickr-day.prevMonthDay, .flatpickr-day.nextMonthDay, .flatpickr-day.flatpickr-disabled { color: #546270; }
        .flatpickr-day.flatpickr-disabled, .flatpickr-day.flatpickr-disabled:hover { color: #858F99; }
        /* Admin forms (.pf): flat, quiet, Blue/White/Ink only (BRAND.md) */
    /* Portfolio form: flat, quiet, Blue/White/Ink only (BRAND.md) */
    .pf { max-width: 1180px; margin: 0 auto; }
    .pf--narrow { max-width: 820px; }
    .pf-head { display: flex; justify-content: space-between; align-items: flex-end; gap: 1rem; margin-bottom: 1.75rem; }
    .pf-head h1 { font-size: 1.5rem; font-weight: 700; color: #0B1F33; margin: 0; letter-spacing: -0.01em; }
    .pf-head p { margin: .25rem 0 0; color: #546270; font-size: .9rem; }
    .pf-back { color: #546270; text-decoration: none; font-size: .875rem; white-space: nowrap; }
    .pf-back:hover { color: #0773B9; }

    .pf-panel { background: #fff; border: 1px solid #CDE3F1; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.25rem; }
    .pf-panel__title { font-size: .72rem; font-weight: 700; letter-spacing: .09em; text-transform: uppercase; color: #0773B9; margin: 0 0 1.25rem; display: flex; justify-content: space-between; align-items: center; }
    .pf-panel__title .badge { text-transform: none; letter-spacing: 0; font-weight: 500; background: #F3F8FC !important; color: #546270 !important; border: 0 !important; }

    .pf .form-label { font-size: .8125rem; font-weight: 600; color: #0B1F33; margin-bottom: .4rem; }
    .pf .form-control, .pf .form-select { border-radius: 8px; border-color: #CDE3F1; padding: .6rem .8rem; font-size: .925rem; background-color: #fff; }
    .pf .form-control::placeholder { color: #858F99; }
    .pf textarea.form-control { resize: vertical; line-height: 1.55; }
    .pf .hint { display: block; margin-top: .4rem; font-size: .78rem; color: #546270; }
    .pf .mb-field { margin-bottom: 1.15rem; }
    .pf .mb-field:last-child { margin-bottom: 0; }

    .pf-sub { padding: 1.25rem 0; border-top: 1px solid #E6F1F8; }
    .pf-sub:first-of-type { border-top: 0; padding-top: 0; }
    .pf-sub:last-child { padding-bottom: 0; }
    .pf-sub__head { display: flex; justify-content: space-between; align-items: baseline; margin-bottom: .6rem; }
    .pf-sub__head .form-label { margin: 0; }
    .pf-link-btn { background: none; border: 0; padding: 0; color: #0773B9; font-size: .8125rem; font-weight: 600; cursor: pointer; }
    .pf-link-btn:hover { color: #0B1F33; }
    .pf .repeat-row .btn { border-color: #CDE3F1; color: #546270; border-radius: 8px; }
    .pf .repeat-row .btn:hover { background: #F3F8FC; color: #C0392B; border-color: #CDE3F1; }
    .pf .repeat-row.border { border-color: #E6F1F8 !important; background: #F3F8FC; border-radius: 10px !important; padding: .75rem !important; }

    .pf-details summary { list-style: none; cursor: pointer; }
    .pf-details summary::-webkit-details-marker { display: none; }
    .pf-details summary::after { content: '+'; font-size: 1.1rem; font-weight: 400; color: #546270; }
    .pf-details[open] summary::after { content: '\2212'; }

    .image-preview { width: 100%; height: 100%; object-fit: cover; }
    .preview-wrapper { position: relative; width: 100%; height: 200px; border: 1px dashed #CDE3F1; border-radius: 10px; background: #F3F8FC; display: flex; align-items: center; justify-content: center; overflow: hidden; }
    .preview-wrapper:hover .preview-overlay { opacity: 1; }
    .preview-overlay { position: absolute; inset: 0; background: rgba(11, 31, 51, 0.55); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity .2s; }
    #placeholderText { color: #546270; }
    #placeholderText i { font-size: 1.75rem; color: #0773B9; opacity: .6; }

    .technologies-input { border: 0; padding: 0; min-height: 0; margin-top: .75rem; display: flex; flex-wrap: wrap; gap: .4rem; }
    .technology-tag { display: inline-flex; align-items: center; gap: .4rem; background: #E6F1F8; color: #0B1F33; padding: .25rem .65rem; margin: 0; border-radius: 999px; font-size: .8125rem; }
    .technology-tag .remove { margin: 0; cursor: pointer; color: #546270; line-height: 1; }
    .technology-tag .remove:hover { color: #C0392B; }
    .pf .input-group .btn-primary { border-radius: 0 8px 8px 0; }

    .pf-side { position: sticky; top: 1rem; }
    .pf-actions { position: sticky; bottom: 0; z-index: 5; display: flex; justify-content: flex-end; align-items: center; gap: 1.25rem; padding: 1rem 0; margin-top: .5rem; background: rgba(243, 248, 252, .94); backdrop-filter: blur(4px); border-top: 1px solid #CDE3F1; }

    /* Hints: bare <small class="text-muted"> inside a form panel reads as a hint */
    .pf small.text-muted, .pf .form-text { display: block; margin-top: .4rem; font-size: .78rem; color: #546270 !important; }
    .pf .form-check-input { border-color: #858F99; }
    .pf .form-check-label { font-size: .9rem; color: #0B1F33; }
    .pf .form-switch .form-check-input { width: 2.25em; height: 1.2em; }
    .pf .input-group-text { background: #F3F8FC; border-color: #CDE3F1; color: #546270; border-radius: 8px 0 0 8px; }
    .pf .input-group > .form-control:not(:first-child), .pf .input-group > .form-select:not(:first-child) { border-radius: 0 8px 8px 0; }
    .pf .input-group > .form-control:not(:last-child) { border-radius: 8px 0 0 8px; }
    .pf .input-group > .btn { border-radius: 0 8px 8px 0; }
    .pf input[type="file"].form-control { padding: .45rem .6rem; }
    .pf .pf-note { margin: 0; padding-left: 1.1rem; font-size: .8125rem; color: #546270; line-height: 1.7; }
    .pf-preview { text-align: center; }
    .pf-preview__stage { padding: 1.5rem; background: #F3F8FC; border-radius: 10px; }
    .pf-avatar { width: 72px; height: 72px; border-radius: 50%; background: #0773B9; color: #fff; display: inline-flex; align-items: center; justify-content: center; font-size: 1.75rem; font-weight: 600; }
    .ck.ck-editor__editable { border-radius: 0 0 8px 8px !important; }
    .ck.ck-toolbar { border-radius: 8px 8px 0 0 !important; border-color: #CDE3F1 !important; background: #F3F8FC !important; }
    .ck.ck-editor__main > .ck-editor__editable { border-color: #CDE3F1 !important; }

    /* Older forms that have not moved to .pf yet pick up the same quiet look */
    .card:has(form) { box-shadow: none !important; border: 1px solid #CDE3F1; border-radius: 12px; }
    .card:has(form) > .card-header { background: #fff; border-bottom: 1px solid #E6F1F8; }
    .card:has(form) .form-label, .card:has(form) label:not(.form-check-label) { font-size: .8125rem; font-weight: 600; color: #0B1F33; }
    .card:has(form) .form-control, .card:has(form) .form-select { border-radius: 8px; border-color: #CDE3F1; }

        .bw-date-wrap { position: relative; }
        .bw-date-wrap .form-control { padding-right: 2.5rem; }
        .bw-date-icon { position: absolute; right: .9rem; top: 50%; transform: translateY(-50%); color: #0773B9; pointer-events: none; }
        input.flatpickr-input[readonly], input.form-control.input[readonly] { background-color: #FFFFFF; cursor: pointer; }
        .form-check-input:checked { background-color: #0773B9; border-color: #0773B9; }
        .text-muted { color: #546270 !important; }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #F3F8FC;
            color: #0B1F33;
        }

        /* Top Bar Styling */
        .admin-topbar {
            background: var(--bytewave-blue);
            box-shadow: 0 4px 12px rgba(7, 115, 185, 0.15);
            padding: 0 2rem;
            height: 70px;
            display: flex;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .topbar-logo {
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            flex-shrink: 0;
        }

        .topbar-logo img {
            height: 40px;
            width: auto;
        }

        .topbar-logo span {
            color: white;
            font-weight: 700;
            font-size: 1.3rem;
            letter-spacing: -0.5px;
        }

        .topbar-spacer {
            flex: 1;
        }

        .admin-dropdown {
            margin-left: auto;
        }

        .admin-dropdown .dropdown-toggle {
            color: #FFFFFF !important;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: .6rem;
            font-weight: 600;
            font-size: .9rem;
            padding: .35rem .6rem .35rem .35rem;
            border-radius: 999px;
            transition: background-color .15s ease;
        }
        .admin-dropdown .dropdown-toggle:hover,
        .admin-dropdown .dropdown-toggle.show { background-color: rgba(255, 255, 255, .14); }
        .admin-dropdown .dropdown-toggle::after {
            border: 0; width: .5rem; height: .5rem; margin: 0 .15rem 0 0;
            border-right: 1.5px solid currentColor; border-bottom: 1.5px solid currentColor;
            transform: translateY(-2px) rotate(45deg); transition: transform .15s ease;
        }
        .admin-dropdown .dropdown-toggle.show::after { transform: translateY(1px) rotate(-135deg); }
        .admin-dropdown .dropdown-toggle:focus-visible { outline: 2px solid #FFFFFF; outline-offset: 2px; }

        .admin-avatar {
            width: 32px; height: 32px; border-radius: 50%;
            background: #FFFFFF; color: #0773B9;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: .78rem; font-weight: 700; letter-spacing: .02em; flex-shrink: 0;
        }

        .admin-dropdown .dropdown-menu {
            min-width: 240px;
            padding: .4rem;
            margin-top: .6rem !important;
            background: #FFFFFF;
            border: 1px solid #CDE3F1;
            border-radius: 12px;
            box-shadow: 0 12px 32px rgba(11, 31, 51, .14);
        }
        .admin-menu-head { display: flex; align-items: center; gap: .75rem; padding: .7rem .75rem .8rem; }
        .admin-menu-head .admin-avatar { width: 38px; height: 38px; background: #0773B9; color: #FFFFFF; font-size: .85rem; }
        .admin-menu-name { display: block; font-size: .9rem; font-weight: 600; color: #0B1F33; line-height: 1.25; }
        .admin-menu-meta { display: block; font-size: .78rem; color: #546270; line-height: 1.35; word-break: break-all; }
        .admin-menu-role {
            display: inline-block; margin-top: .3rem; padding: .05rem .5rem;
            font-size: .68rem; font-weight: 600; letter-spacing: .04em; text-transform: uppercase;
            color: #0B1F33; background: #E6F1F8; border-radius: 999px;
        }
        .admin-dropdown .dropdown-divider { margin: .3rem 0; border-color: #E6F1F8; }

        .admin-dropdown .dropdown-item {
            display: flex; align-items: center; gap: .65rem;
            color: #0B1F33; font-size: .875rem; font-weight: 500;
            padding: .55rem .75rem; margin: 0;
            border-radius: 8px; transition: background-color .15s ease, color .15s ease;
        }
        .admin-dropdown .dropdown-item i { width: 1rem; text-align: center; color: #546270; transition: color .15s ease; }
        .admin-dropdown .dropdown-item:hover,
        .admin-dropdown .dropdown-item:focus { background-color: #F3F8FC; color: #0B1F33; }
        .admin-dropdown .dropdown-item:hover i { color: #0773B9; }
        .admin-dropdown .dropdown-item--danger:hover,
        .admin-dropdown .dropdown-item--danger:focus { background-color: #FBECEA; color: #C0392B; }
        .admin-dropdown .dropdown-item--danger:hover i { color: #C0392B; }

        .admin-dropdown form {
            display: contents;
        }

        /* Sidebar Styling */
        .admin-sidebar {
            background: var(--bytewave-blue);
            min-height: calc(100vh - 70px);
            padding: 2rem 0;
            position: fixed;
            left: 0;
            top: 70px;
            width: 280px;
            overflow-y: auto;
            box-shadow: 4px 0 12px rgba(11, 31, 51, 0.1);
        }

        .admin-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .admin-sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .admin-sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.5);
            border-radius: 3px;
        }

        .sidebar-item {
            list-style: none;
            margin: 0.5rem 0;
            padding: 0 1rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1.25rem;
            color: #FFFFFF;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
            position: relative;
        }

        .sidebar-link:hover {
            background-color: rgba(255, 255, 255, 0.12);
            color: white;
            padding-left: 1.75rem;
        }

        .sidebar-link.active {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            font-weight: 700;
            padding-left: 1.75rem;
            border-left: 4px solid #F1C442;
        }

        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background-color: #F1C442;
            border-radius: 0 4px 4px 0;
        }

        .sidebar-link i {
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
        }

        .sidebar-badge {
            margin-left: auto;
            min-width: 22px;
            height: 22px;
            padding: 0 7px;
            border-radius: 11px;
            background-color: #FFFFFF;
            color: var(--bytewave-blue);
            font-size: 0.75rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-section-title {
            color: #FFFFFF;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 1.5rem 1.5rem 0.75rem 1.5rem;
            margin-top: 1rem;
        }

        .sidebar-group-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.5rem;
            width: 100%;
            background: none;
            border: 0;
            text-align: left;
            cursor: pointer;
            margin-top: 0.5rem;
        }
        .sidebar-group-toggle > span:first-child { flex: 1; }
        .sidebar-group-toggle:hover { background: rgba(255, 255, 255, 0.08); }
        .sidebar-group-toggle:focus-visible { outline: 2px solid #FFFFFF; outline-offset: -2px; }
        .sidebar-chev { font-size: 0.7rem; transition: transform 0.2s ease; }
        .sidebar-group.open .sidebar-chev { transform: rotate(180deg); }
        .sidebar-group:not(.open) .sidebar-group-list { display: none; }

        .sidebar-section-title:first-child {
            margin-top: 0;
        }

        .sidebar-toggle {
            display: none;
            position: fixed;
            bottom: 2rem;
            left: 2rem;
            width: 50px;
            height: 50px;
            background-color: var(--bytewave-blue);
            border: none;
            border-radius: 50%;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(7, 115, 185, 0.3);
            z-index: 999;
        }

        .sidebar-toggle:hover {
            background-color: var(--bytewave-blue-dark);
            transform: scale(1.1);
        }

        /* Main Content */
        .admin-main {
            margin-left: 280px;
            padding: 2rem;
            min-height: calc(100vh - 70px);
            /* Brand pattern: Blue-at-5% base, edges are flat so it tiles without seams */
            background-color: #F3F8FC;
            /* Flat base-colour veil over the image: raise the .82 to fade the pattern further, lower it to strengthen it */
            background-image: linear-gradient(rgba(243, 248, 252, .82), rgba(243, 248, 252, .82)), url('{{ asset('images/email-pattern.png') }}');
            background-size: auto, 1350px auto;
            background-repeat: no-repeat, repeat;
            background-attachment: fixed, fixed;
        }

        /* Alert Styling */
        .alert-success {
            border: none;
            background: rgba(7, 115, 185, 0.08);
            color: var(--bytewave-blue-dark);
            border-left: 4px solid var(--bytewave-blue);
            border-radius: 8px;
        }

        .alert-danger {
            border: none;
            background: rgba(192, 57, 43, 0.08);
            color: #C0392B;
            border-left: 4px solid #C0392B;
            border-radius: 8px;
        }

        .btn-close {
            filter: brightness(0) saturate(100%) invert(20%) sepia(60%) saturate(800%) hue-rotate(185deg);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .admin-sidebar {
                width: 100%;
                position: fixed;
                left: 0;
                top: 70px;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                z-index: 999;
                border-radius: 0;
            }

            .admin-sidebar.show {
                transform: translateX(0);
            }

            .sidebar-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .admin-main {
                margin-left: 0;
                padding: 1.5rem;
            }

            .topbar-logo span {
                font-size: 1.1rem;
            }

            .admin-topbar {
                padding: 0 1rem;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Top Bar -->
    <nav class="admin-topbar">
        <a href="{{ route('admin.dashboard') }}" class="topbar-logo">
            <img src="{{ asset('images/BYTEWAVE_INVESTMENTS-LOGO.png') }}" alt="BYTEWAVE">
        </a>

        <div class="topbar-spacer"></div>

        <!-- Admin Dropdown -->
        <div class="admin-dropdown dropdown">
            @php
                $adminInitials = collect(preg_split('/\s+/', trim(Auth::user()->name)))->filter()->take(2)
                    ->map(fn ($w) => mb_strtoupper(mb_substr($w, 0, 1)))->implode('');
            @endphp
            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Account menu">
                <span class="admin-avatar" aria-hidden="true">{{ $adminInitials }}</span>
                <span>{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li class="admin-menu-head">
                    <span class="admin-avatar" aria-hidden="true">{{ $adminInitials }}</span>
                    <span>
                        <span class="admin-menu-name">{{ Auth::user()->name }}</span>
                        <span class="admin-menu-meta">{{ Auth::user()->email }}</span>
                        <span class="admin-menu-role">{{ Auth::user()->roleLabel() }}</span>
                    </span>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item dropdown-item--danger">
                            <i class="fas fa-sign-out-alt" aria-hidden="true"></i>Log out
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside class="admin-sidebar" id="adminSidebar">
        <!-- Dashboard -->
        <ul style="list-style: none;">
            <li class="sidebar-item">
                <a href="{{ route('admin.dashboard') }}" 
                   class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        </ul>

        <!-- Website Content Section -->
        @if(collect(['products','services','posts','portfolios','testimonials','client-logos'])->contains(fn ($m) => auth()->user()->canAccess($m)))
        <div class="sidebar-group" data-group="website">
        <button type="button" class="sidebar-section-title sidebar-group-toggle" aria-expanded="false"><span>Website Content</span>@php $pendingTestimonialsCount = auth()->user()->canAccess('testimonials') ? \App\Models\Testimonial::where('status', 'pending')->count() : 0; @endphp@if($pendingTestimonialsCount > 0)<span class="sidebar-badge" title="{{ $pendingTestimonialsCount }} awaiting approval">{{ $pendingTestimonialsCount > 99 ? '99+' : $pendingTestimonialsCount }}</span>@endif<i class="fas fa-chevron-down sidebar-chev" aria-hidden="true"></i></button>
        <ul class="sidebar-group-list" style="list-style: none;">
            @if(auth()->user()->canAccess('products'))
            <li class="sidebar-item">
                <a href="{{ route('admin.products.index') }}" 
                   class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="fas fa-box"></i>
                    <span>Products</span>
                </a>
            </li>
            @endif
            @if(auth()->user()->canAccess('services'))
            <li class="sidebar-item">
                <a href="{{ route('admin.services.index') }}" 
                   class="sidebar-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                    <i class="fas fa-handshake"></i>
                    <span>Services</span>
                </a>
            </li>
            @endif
            @if(auth()->user()->canAccess('posts'))
            <li class="sidebar-item">
                <a href="{{ route('admin.posts.index') }}" 
                   class="sidebar-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                    <i class="fas fa-pen-fancy"></i>
                    <span>Blog Posts</span>
                </a>
            </li>
            @endif
            @if(auth()->user()->canAccess('portfolios'))
            <li class="sidebar-item">
                <a href="{{ route('admin.portfolios.index') }}" 
                   class="sidebar-link {{ request()->routeIs('admin.portfolios.*') ? 'active' : '' }}">
                    <i class="fas fa-briefcase"></i>
                    <span>Portfolio</span>
                </a>
            </li>
            @endif
            @if(auth()->user()->canAccess('testimonials'))
            <li class="sidebar-item">
                <a href="{{ route('admin.testimonials.index') }}" 
                   class="sidebar-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                    <i class="fas fa-comments"></i>
                    <span>Testimonials</span>
                    @php $pendingTestimonials = \App\Models\Testimonial::where('status', 'pending')->count(); @endphp
                    @if($pendingTestimonials > 0)
                        <span class="sidebar-badge" title="{{ $pendingTestimonials }} awaiting approval">{{ $pendingTestimonials > 99 ? '99+' : $pendingTestimonials }}</span>
                    @endif
                </a>
            </li>
            @endif
            @if(auth()->user()->canAccess('client-logos'))
            <li class="sidebar-item">
                <a href="{{ route('admin.client-logos.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.client-logos.*') ? 'active' : '' }}">
                    <i class="fas fa-images"></i>
                    <span>Client Logos</span>
                </a>
            </li>
            @endif
        </ul>
        </div>

        <!-- Business Management Section -->
        @endif

        @if(collect(['clients','tasks','client-services','quotations','invoices'])->contains(fn ($m) => auth()->user()->canAccess($m)))
        <div class="sidebar-group" data-group="business">
        <button type="button" class="sidebar-section-title sidebar-group-toggle" aria-expanded="false"><span>Business Management</span><i class="fas fa-chevron-down sidebar-chev" aria-hidden="true"></i></button>
        <ul class="sidebar-group-list" style="list-style: none;">
            @if(auth()->user()->canAccess('clients'))
            <li class="sidebar-item">
                <a href="{{ route('admin.clients.index') }}" 
                   class="sidebar-link {{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Clients</span>
                </a>
            </li>
            @endif
            @if(auth()->user()->canAccess('tasks'))
            <li class="sidebar-item">
                <a href="{{ route('admin.tasks.index') }}" 
                   class="sidebar-link {{ request()->routeIs('admin.tasks.*') ? 'active' : '' }}">
                    <i class="fas fa-tasks"></i>
                    <span>Task Management</span>
                </a>
            </li>
            @endif
            @if(auth()->user()->canAccess('client-services'))
            <li class="sidebar-item">
                <a href="{{ route('admin.client-services.index') }}" 
                   class="sidebar-link {{ request()->routeIs('admin.client-services.*') ? 'active' : '' }}">
                    <i class="fas fa-cogs"></i>
                    <span>Client Services</span>
                </a>
            </li>
            @endif
            @if(auth()->user()->canAccess('quotations'))
            <li class="sidebar-item">
                <a href="{{ route('admin.quotations.index') }}" 
                   class="sidebar-link {{ request()->routeIs('admin.quotations.*') ? 'active' : '' }}">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <span>Quotations</span>
                </a>
            </li>
            @endif
            @if(auth()->user()->canAccess('invoices'))
            <li class="sidebar-item">
                <a href="{{ route('admin.invoices.index') }}" 
                   class="sidebar-link {{ request()->routeIs('admin.invoices.*') ? 'active' : '' }}">
                    <i class="fas fa-file-invoice"></i>
                    <span>Invoices</span>
                </a>
            </li>
            @endif
        </ul>
        </div>
        @endif

        @if(auth()->user()->canAccess('staff'))
        <div class="sidebar-group" data-group="admin">
        <button type="button" class="sidebar-section-title sidebar-group-toggle" aria-expanded="false"><span>Administration</span><i class="fas fa-chevron-down sidebar-chev" aria-hidden="true"></i></button>
        <ul class="sidebar-group-list" style="list-style: none;">
            <li class="sidebar-item">
                <a href="{{ route('admin.staff.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.staff.*') ? 'active' : '' }}">
                    <i class="fas fa-user-shield"></i>
                    <span>Staff &amp; Roles</span>
                </a>
            </li>
        </ul>
        </div>
        @endif
    </aside>

    <!-- Main Content -->
    <main class="admin-main">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle" style="margin-right: 0.5rem;"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle" style="margin-right: 0.5rem;"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Sidebar Toggle for Mobile -->
    <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle Sidebar">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        // Changes only the label of a ByteWave button (.bw-btn), so the arrow and the hover animation survive
        window.bwLabel = function (btn, text) {
            btn.querySelectorAll('.bw-btn__label > span').forEach(function (s) { s.textContent = text; });
        };
        document.addEventListener('DOMContentLoaded', function() {
            // Expandable sidebar groups: the group holding the current page opens itself; others remember what you chose
            document.querySelectorAll('.sidebar-group').forEach(function (group) {
                var key = 'bwSidebar:' + group.dataset.group;
                var btn = group.querySelector('.sidebar-group-toggle');
                var stored = null;
                try { stored = localStorage.getItem(key); } catch (e) {}
                var open = !!group.querySelector('.sidebar-link.active') || stored === '1';
                var set = function (state) {
                    group.classList.toggle('open', state);
                    btn.setAttribute('aria-expanded', state ? 'true' : 'false');
                };
                set(open);
                btn.addEventListener('click', function () {
                    var next = !group.classList.contains('open');
                    set(next);
                    try { localStorage.setItem(key, next ? '1' : '0'); } catch (e) {}
                });
            });

            const sidebar = document.getElementById('adminSidebar');
            const toggleBtn = document.getElementById('sidebarToggle');

            if (toggleBtn) {
                toggleBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });

                // Close sidebar when clicking a link on mobile
                sidebar.querySelectorAll('.sidebar-link').forEach(link => {
                    link.addEventListener('click', function() {
                        if (window.innerWidth <= 768) {
                            sidebar.classList.remove('show');
                        }
                    });
                });
            }

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 768) {
                    const isClickInside = sidebar.contains(event.target) || toggleBtn.contains(event.target);
                    if (!isClickInside && sidebar.classList.contains('show')) {
                        sidebar.classList.remove('show');
                    }
                }
            });
        });
    </script>
    
    {{-- Shared Send Email Modal --}}
    <div class="modal fade" id="sendEmailModal" tabindex="-1" aria-labelledby="sendEmailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="sendEmailForm" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="sendEmailModalLabel">
                            <i class="fas fa-paper-plane me-2 text-primary"></i>
                            <span id="sendEmailModalTitle">Send Document</span>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 p-2 rounded d-flex align-items-center justify-content-between" style="background:#CDE3F1;border:1px solid #CDE3F1">
                            <span style="font-size:.85rem;color:#0773B9"><i class="fas fa-eye me-2"></i>Always preview before sending</span>
                            <a id="sendEmailPreviewBtn" href="#" target="_blank"
                               class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-external-link-alt me-1"></i> Preview
                            </a>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">To</label>
                            <input type="text" id="sendEmailTo" class="form-control bg-light" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">CC <span class="text-muted fw-normal">(optional — comma-separated)</span></label>
                            <input type="text" name="cc" id="sendEmailCc" class="form-control" placeholder="e.g. manager@company.com, boss@company.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">BCC <span class="text-muted fw-normal">(optional — comma-separated)</span></label>
                            <input type="text" name="bcc" id="sendEmailBcc" class="form-control" placeholder="e.g. accounts@company.com">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <x-admin.button type="button" data-bs-dismiss="modal" variant="secondary">Cancel</x-admin.button>
                        <x-admin.button type="submit" id="sendEmailSubmitBtn">Send</x-admin.button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var modalEl = document.getElementById('sendEmailModal');
            if (!modalEl) return;

            var sendForm = document.getElementById('sendEmailForm');
            var sendBtn  = document.getElementById('sendEmailSubmitBtn');

            document.querySelectorAll('[data-send-modal]').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    document.getElementById('sendEmailModalTitle').textContent = this.dataset.title;
                    document.getElementById('sendEmailTo').value = this.dataset.to;
                    sendForm.action = this.dataset.action;
                    document.getElementById('sendEmailCc').value = '';
                    document.getElementById('sendEmailBcc').value = '';
                    sendBtn.disabled = false;
                    bwLabel(sendBtn, 'Send');
                    var previewBtn = document.getElementById('sendEmailPreviewBtn');
                    if (previewBtn) previewBtn.href = this.dataset.preview || '#';
                    bootstrap.Modal.getOrCreateInstance(modalEl).show();
                });
            });

            sendForm.addEventListener('submit', function () {
                sendBtn.disabled = true;
                bwLabel(sendBtn, 'Sending…');
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script>
    <script>
        // Branded date picker for every date field. The form still submits Y-m-d.
        document.querySelectorAll('input[type="date"]').forEach(function (el) {
            const fp = flatpickr(el, { dateFormat: 'Y-m-d', altInput: true, altFormat: 'j M Y', allowInput: false, disableMobile: true });
            const alt = fp.altInput;
            alt.placeholder = el.getAttribute('placeholder') || 'Select date';
            const wrap = document.createElement('div');
            wrap.className = 'bw-date-wrap';
            alt.parentNode.insertBefore(wrap, alt);
            wrap.appendChild(alt);
            wrap.insertAdjacentHTML('beforeend', '<i class="far fa-calendar-alt bw-date-icon" aria-hidden="true"></i>');
        });
    </script>
    @stack('scripts')
</body>
</html>
