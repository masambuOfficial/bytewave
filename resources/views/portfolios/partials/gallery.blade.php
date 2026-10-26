@if($portfolio->media && $portfolio->media->isNotEmpty())
<div class="mt-24 pt-14 border-t border-bytewave-blue/20">
    <div class="text-center mx-auto pb-10 max-w-2xl">
        <p class="text-bytewave-blue text-sm font-semibold uppercase tracking-wide mb-2">Gallery</p>
        <h2 class="text-3xl md:text-4xl font-bold text-bytewave-ink">{{ $portfolio->isMultimedia() ? 'The Work' : 'More Media' }}</h2>
    </div>

    <div class="flex flex-wrap justify-center gap-6">
        @foreach($portfolio->media as $media)
            @php
                $mType = $media->media_type;
                $mSrc = $media->media_path ? asset('storage/' . ltrim($media->media_path, '/')) : null;
                $mEmbed = \App\Models\Portfolio::embedSrcFromRaw($media->media_embed);
            @endphp
            <div class="w-full sm:w-[calc(50%-0.75rem)] lg:w-[calc(33.333%-1rem)] max-w-sm bg-bytewave-blue/5 rounded-lg overflow-hidden shadow border border-bytewave-blue/20">
                @if($mType === 'video' && $mSrc)
                    <video class="w-full h-64 object-cover" controls playsinline preload="metadata">
                        <source src="{{ $mSrc }}" type="video/mp4">
                    </video>
                @elseif($mType === 'embed' && $mEmbed)
                    <iframe class="w-full h-64" src="{{ $mEmbed }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe>
                @else
                    <img loading="lazy" decoding="async" src="{{ $mSrc }}" class="w-full h-64 object-cover" alt="{{ $portfolio->title }}">
                @endif
            </div>
        @endforeach
    </div>
</div>
@endif
