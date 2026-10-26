@foreach(\App\Models\Portfolio::textBlocks($text ?? '') as $block)
    @if($block['type'] === 'p')
        <p class="{{ $class ?? 'text-bytewave-ink leading-relaxed' }} {{ $loop->last ? '' : 'mb-4' }}">{{ $block['items'][0] }}</p>
    @else
        <{{ $block['type'] }} class="{{ $block['type'] === 'ol' ? 'list-decimal' : 'list-disc' }} pl-6 space-y-1 text-bytewave-ink leading-relaxed {{ $loop->last ? '' : 'mb-4' }}">
            @foreach($block['items'] as $item)
                <li>{{ $item }}</li>
            @endforeach
        </{{ $block['type'] }}>
    @endif
@endforeach
