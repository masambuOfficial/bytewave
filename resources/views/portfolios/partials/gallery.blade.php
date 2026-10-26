@php
    // The featured media is shown at the top of the page, so it is not repeated here.
    $primaryPath = $portfolio->getPrimaryMediaPath();
    $primaryEmbed = $portfolio->getPrimaryMediaEmbed();
    $galleryItems = ($portfolio->media ?? collect())->reject(function ($m) use ($primaryPath, $primaryEmbed) {
        return ($m->media_path && $m->media_path === $primaryPath)
            || ($m->media_embed && $m->media_embed === $primaryEmbed);
    });
@endphp
@if($galleryItems->isNotEmpty())
<section class="mt-16 md:mt-20" aria-label="Gallery">
    <h2 class="text-2xl md:text-3xl font-bold text-bytewave-ink mb-8">{{ $portfolio->isMultimedia() ? 'The work' : 'More media' }}</h2>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($galleryItems as $media)
            @php
                $mType = $media->media_type;
                $mSrc = $media->media_path ? asset('storage/' . ltrim($media->media_path, '/')) : null;
                $mEmbed = \App\Models\Portfolio::embedSrcFromRaw($media->media_embed);
            @endphp
            <div class="aspect-[4/3] overflow-hidden rounded-xl border border-bytewave-blue/20 bg-bytewave-blue/5">
                @if($mType === 'video' && $mSrc)
                    <video class="h-full w-full object-cover" controls playsinline preload="metadata">
                        <source src="{{ $mSrc }}" type="video/mp4">
                    </video>
                @elseif($mType === 'embed' && $mEmbed)
                    <iframe class="h-full w-full" src="{{ $mEmbed }}" title="{{ $portfolio->title }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe>
                @else
                    <img loading="lazy" decoding="async" src="{{ $mSrc }}" class="h-full w-full object-cover" alt="{{ $portfolio->title }}">
                @endif
            </div>
        @endforeach
    </div>
</section>
@endif
