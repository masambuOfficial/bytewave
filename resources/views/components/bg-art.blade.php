{{--
    Faint background art: ICT and multimedia line icons mixed with flat geometric shapes. See BRAND.md, "Background art".

    Put it inside a section that has `relative isolate`, as the first child:
        <section class="relative isolate py-12 md:py-20"> <x-bg-art layout="white" /> ... </section>

    layout: white | tint (light sections, drawn in Blue) | dark (Blue or dark sections, drawn in white)
    flip:   mirrors the arrangement left to right, so neighbouring sections don't look identical

    Strength (8%) and size (80%) were chosen in the design preview. It sits behind the content (-z-10 inside `isolate`),
    clips itself, ignores the pointer, and is hidden from assistive technology. The symbols live in <x-art-sprite>.
--}}
@props(['layout' => 'white', 'flip' => false])

@php
    // [symbol, left %, top %, size px, rotation deg, hidden on phones]
    $layouts = [
        'white' => [
            ['g-quarter', -4, -8, 190, 0, false], ['i-code', 82, 8, 84, 12, false], ['g-hex', 88, 52, 120, 10, true],
            ['i-video', 3, 62, 92, -10, false], ['g-dots', 64, 80, 110, 0, true], ['g-wave', 0, 32, 130, 0, true],
            ['i-network', 72, 70, 78, 8, true], ['g-plus', 93, 30, 34, 0, true], ['g-rings', 20, 86, 100, 0, true], ['i-chip', 90, -2, 70, -8, true],
        ],
        'tint' => [
            ['g-half', 76, -6, 210, 0, false], ['i-camera', 4, 10, 90, -12, false], ['g-square', 86, 60, 110, 14, false],
            ['i-live', 6, 66, 88, 0, true], ['g-dashed', -6, 84, 170, 0, true], ['i-server', 84, 30, 84, 6, true],
            ['g-zigzag', 44, 84, 130, 0, true], ['i-mic', 60, -3, 70, 10, true], ['g-diamond', 26, 6, 34, 0, true], ['g-chevrons', 94, 88, 60, 0, true],
        ],
        'dark' => [
            ['g-rings', -5, -14, 210, 0, false], ['g-disc', 88, 60, 150, 0, false], ['i-photo', 6, 64, 90, -8, false],
            ['i-code', 86, 6, 84, 10, false], ['g-wave', 2, 34, 130, 0, true], ['g-bracket', 90, 30, 80, 0, true],
            ['i-wave', 68, 78, 76, 0, true], ['g-plus', 26, 82, 34, 0, true], ['g-hex', 44, -6, 90, -12, true],
        ],
    ];
    $filled = ['g-disc', 'g-half', 'g-quarter', 'g-diamond', 'g-plus', 'g-dots'];
    $items = $layouts[$layout] ?? $layouts['white'];
    $color = $layout === 'dark' ? 'text-white' : 'text-bytewave-blue';
    $scale = 0.8;
@endphp

<div {{ $attributes->merge(['class' => "absolute inset-0 -z-10 overflow-hidden pointer-events-none select-none {$color}"]) }} style="opacity: 0.08;" aria-hidden="true">
    @foreach ($items as [$id, $x, $y, $size, $rot, $far])
        @php
            $left = $flip ? 100 - $x : $x;
            $angle = $flip ? -$rot : $rot;
            $px = (int) round($size * $scale);
            $paint = in_array($id, $filled, true)
                ? 'fill: currentColor; stroke: none;'
                : 'fill: none; stroke: currentColor; stroke-width: 1.7; stroke-linecap: round; stroke-linejoin: round;';
        @endphp
        <svg class="absolute {{ $far ? 'hidden md:block' : '' }}" style="left: {{ $left }}%; top: {{ $y }}%; width: {{ $px }}px; height: {{ $px }}px; transform: rotate({{ $angle }}deg); {{ $paint }}" focusable="false"><use href="#{{ $id }}"/></svg>
    @endforeach
</div>
