@props(['items'])
@php
    $list = [];
    $position = 1;
    foreach ($items as $name => $url) {
        $list[] = [
            '@type' => 'ListItem',
            'position' => $position++,
            'name' => (string) $name,
            'item' => $url,
        ];
    }
    $data = ['@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => $list];
@endphp
<script type="application/ld+json">{!! json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP) !!}</script>
