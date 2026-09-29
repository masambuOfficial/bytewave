{{--
    Symbol sprite for the faint background art (see <x-bg-art>). Included once in layouts/app.blade.php.
    Icons are drawn on a 48 grid, geometric shapes on a 100 grid. Fill and stroke come from the <svg> that uses them.
--}}
<svg width="0" height="0" style="position:absolute" aria-hidden="true" focusable="false">
    <defs>
        {{-- ICT --}}
        <symbol id="i-code" viewBox="0 0 48 48"><path d="M16 14 6 24l10 10M32 14l10 10-10 10M28 9 20 39"/></symbol>
        <symbol id="i-chip" viewBox="0 0 48 48"><rect x="13" y="13" width="22" height="22" rx="3"/><rect x="20" y="20" width="8" height="8" rx="1"/><path d="M19 7v6M24 7v6M29 7v6M19 35v6M24 35v6M29 35v6M7 19h6M7 24h6M7 29h6M35 19h6M35 24h6M35 29h6"/></symbol>
        <symbol id="i-network" viewBox="0 0 48 48"><circle cx="24" cy="24" r="5"/><circle cx="24" cy="8" r="3.5"/><circle cx="9" cy="38" r="3.5"/><circle cx="39" cy="38" r="3.5"/><path d="M24 11.5V19M20.5 27.5 11.5 35M27.5 27.5l9 7.5"/></symbol>
        <symbol id="i-server" viewBox="0 0 48 48"><rect x="7" y="7" width="34" height="14" rx="2.5"/><rect x="7" y="27" width="34" height="14" rx="2.5"/><path d="M14 14h.01M14 34h.01M22 14h13M22 34h13"/></symbol>
        <symbol id="i-cloud" viewBox="0 0 48 48"><path d="M14 37h21a8 8 0 0 0 1.5-15.9A11.5 11.5 0 0 0 14.6 19 9 9 0 0 0 14 37z"/></symbol>
        <symbol id="i-circuit" viewBox="0 0 48 48"><path d="M5 12h14l7 9h17M5 24h9l7 9h22M5 36h17l4-5"/><circle cx="44" cy="21" r="2"/><circle cx="44" cy="33" r="2"/><circle cx="27" cy="30" r="2"/></symbol>
        {{-- Multimedia --}}
        <symbol id="i-video" viewBox="0 0 48 48"><rect x="5" y="9" width="38" height="30" rx="5"/><path d="M20 17.5v13l11-6.5z"/></symbol>
        <symbol id="i-camera" viewBox="0 0 48 48"><path d="M5 16h9l3-5h14l3 5h9v22H5z"/><circle cx="24" cy="26" r="7"/></symbol>
        <symbol id="i-mic" viewBox="0 0 48 48"><rect x="18" y="5" width="12" height="23" rx="6"/><path d="M11 23a13 13 0 0 0 26 0M24 36v7M17 43h14"/></symbol>
        <symbol id="i-wave" viewBox="0 0 48 48"><path d="M6 20v8M12 14v20M18 8v32M24 16v16M30 11v26M36 17v14M42 21v6"/></symbol>
        <symbol id="i-live" viewBox="0 0 48 48"><circle cx="24" cy="24" r="3"/><path d="M16 16a11 11 0 0 0 0 16M32 16a11 11 0 0 1 0 16M10 10a19 19 0 0 0 0 28M38 10a19 19 0 0 1 0 28"/></symbol>
        <symbol id="i-headphones" viewBox="0 0 48 48"><path d="M8 30v-6a16 16 0 0 1 32 0v6"/><rect x="6" y="28" width="9" height="13" rx="3"/><rect x="33" y="28" width="9" height="13" rx="3"/></symbol>
        <symbol id="i-photo" viewBox="0 0 48 48"><rect x="5" y="8" width="38" height="32" rx="3"/><circle cx="16" cy="19" r="3.5"/><path d="M5 35l11-11 8 8 8-10 11 12"/></symbol>
        {{-- Geometric, filled --}}
        <symbol id="g-disc" viewBox="0 0 100 100"><circle cx="50" cy="50" r="50"/></symbol>
        <symbol id="g-half" viewBox="0 0 100 100"><path d="M0 70a50 50 0 0 1 100 0z"/></symbol>
        <symbol id="g-quarter" viewBox="0 0 100 100"><path d="M0 100V0a100 100 0 0 1 100 100z"/></symbol>
        <symbol id="g-diamond" viewBox="0 0 100 100"><path d="M50 0 100 50 50 100 0 50z"/></symbol>
        <symbol id="g-plus" viewBox="0 0 100 100"><path d="M40 0h20v40h40v20H60v40H40V60H0V40h40z"/></symbol>
        <symbol id="g-dots" viewBox="0 0 100 100"><g>@foreach ([10, 30, 50, 70, 90] as $cy)@foreach ([10, 30, 50, 70, 90] as $cx)<circle cx="{{ $cx }}" cy="{{ $cy }}" r="4"/>@endforeach @endforeach</g></symbol>
        {{-- Geometric, outlined --}}
        <symbol id="g-ring" viewBox="0 0 100 100"><circle cx="50" cy="50" r="46" stroke-width="3.4"/></symbol>
        <symbol id="g-rings" viewBox="0 0 100 100"><g stroke-width="3.4"><circle cx="50" cy="50" r="46"/><circle cx="50" cy="50" r="31"/><circle cx="50" cy="50" r="16"/></g></symbol>
        <symbol id="g-dashed" viewBox="0 0 100 100"><circle cx="50" cy="50" r="46" stroke-width="3.4" stroke-dasharray="3 9"/></symbol>
        <symbol id="g-hex" viewBox="0 0 100 100"><path d="M50 4 90 27v46L50 96 10 73V27z" stroke-width="3.4"/></symbol>
        <symbol id="g-square" viewBox="0 0 100 100"><rect x="12" y="12" width="76" height="76" rx="12" stroke-width="3.4"/></symbol>
        <symbol id="g-wave" viewBox="0 0 100 100"><path d="M0 50q12.5-32 25 0t25 0 25 0 25 0" stroke-width="3.4"/></symbol>
        <symbol id="g-zigzag" viewBox="0 0 100 100"><path d="M0 62 17 38 33 62 50 38 67 62 83 38 100 62" stroke-width="3.4"/></symbol>
        <symbol id="g-chevrons" viewBox="0 0 100 100"><path d="M20 18 52 50 20 82M50 18 82 50 50 82" stroke-width="3.4"/></symbol>
        <symbol id="g-bracket" viewBox="0 0 100 100"><path d="M4 32V4h28M96 68v28H68" stroke-width="3.4"/></symbol>
    </defs>
</svg>
