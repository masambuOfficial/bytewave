@foreach(\App\Models\Portfolio::textBlocks($text ?? '') as $block)
    @if($block['type'] === 'p')
        <p class="{{ $class ?? 'text-bytewave-ink leading-relaxed' }} {{ $loop->last ? '' : 'mb-4' }}">{{ $block['items'][0] }}</p>
    @elseif($block['type'] === 'ul')
        {{-- Bullet lists render as check-icon lists, in two columns once they get long --}}
        <ul class="grid gap-3 {{ count($block['items']) > 6 ? 'sm:grid-cols-2 sm:gap-x-8' : '' }} {{ $loop->last ? '' : 'mb-4' }}">
            @foreach($block['items'] as $item)
                <li class="flex items-start gap-3 text-bytewave-ink leading-relaxed">
                    <svg class="mt-1.5 h-4 w-4 shrink-0 text-bytewave-blue" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    <span>{{ $item }}</span>
                </li>
            @endforeach
        </ul>
    @else
        <ol class="list-decimal pl-6 space-y-1 text-bytewave-ink leading-relaxed {{ $loop->last ? '' : 'mb-4' }}">
            @foreach($block['items'] as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ol>
    @endif
@endforeach
