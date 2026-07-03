@extends('layouts.app')

@section('title', $portfolio->title . ' - BYTEWAVE')
@section('meta_description', Str::limit($portfolio->description, 160))
@section('og_type', 'website')

@push('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "CreativeWork",
    "name": @json($portfolio->title),
    "description": @json($portfolio->description),
    "creator": {
        "@type": "LocalBusiness",
        "name": @json(config('company.name'))
    }
}
</script>
@endpush

@section('content')
    @php
        $heroImage = null;
        if ($portfolio->getPrimaryMediaType() === 'image' && $portfolio->primaryMediaPublicUrl()) {
            $heroImage = $portfolio->primaryMediaPublicUrl();
        } elseif ($portfolio->getPrimaryMediaType() === 'embed' && $portfolio->primaryEmbedThumbnailUrl()) {
            $heroImage = $portfolio->primaryEmbedThumbnailUrl();
        } elseif ($portfolio->hasImage()) {
            $heroImage = asset($portfolio->image_url);
        }
        $heroImage = $heroImage ?: asset('css/img/bg-1.jpg');
    @endphp
    <!-- Page Header Start -->
    <div class="w-full py-16 bg-cover bg-center bg-no-repeat relative" style="background-image: linear-gradient(rgba(15, 23, 42, 0.85), rgba(15, 23, 42, 0.85)), url('{{ $heroImage }}');">
        <div class="max-w-4xl mx-auto px-4 text-center py-8">
            <span class="inline-block text-xs font-semibold tracking-widest uppercase text-yellow-500 mb-4 animate-fade-in-down">{{ $portfolio->category }}</span>
            <h1 class="text-3xl md:text-5xl text-white mb-6 font-bold leading-tight animate-fade-in-down">{{ $portfolio->title }}</h1>
            <nav aria-label="breadcrumb" class="animate-fade-in-down">
                <ol class="flex justify-center items-center space-x-2 text-white/60 text-sm">
                    <li><a class="hover:text-yellow-500 transition-colors" href="{{ url('/') }}">Home</a></li>
                    <li class="before:content-['/'] before:mx-2"><a class="hover:text-yellow-500 transition-colors" href="{{ route('portfolios.index') }}">Portfolio</a></li>
                    <li class="before:content-['/'] before:mx-2 text-white/90">{{ Str::limit($portfolio->title, 40) }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Portfolio Details Start -->
    <div class="w-full py-16">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14">
                <!-- Project Image -->
                <div class="lg:col-span-5 animate-fade-in">
                    <div class="lg:sticky lg:top-28">
                        <div class="relative rounded-2xl overflow-hidden shadow-lg border border-gray-100">
                            @php
                                $type = $portfolio->getPrimaryMediaType();
                                $src = $portfolio->primaryMediaPublicUrl();
                                $embedSrc = $portfolio->primaryEmbedSrc();
                            @endphp

                            @if($type === 'video' && $src)
                                <video class="w-full max-h-[500px] object-cover" controls playsinline preload="metadata">
                                    <source src="{{ $src }}" type="video/mp4">
                                </video>
                            @elseif($type === 'embed' && $embedSrc)
                                <div class="w-full" style="max-height: 500px;">
                                    <iframe class="w-full" style="height: 500px;" src="{{ $embedSrc }}" title="{{ $portfolio->title }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe>
                                </div>
                            @else
                                <img src="{{ $src ? $src : asset($portfolio->image_url) }}"
                                     class="w-full max-h-[500px] object-cover"
                                     alt="{{ $portfolio->title }}">
                            @endif
                            @if($portfolio->project_url)
                                <a href="{{ $portfolio->project_url }}"
                                   target="_blank"
                                   class="absolute top-4 right-4 inline-flex items-center gap-2 bg-white/95 backdrop-blur text-blue-600 text-sm font-semibold px-4 py-2.5 rounded-full shadow hover:bg-white transition-colors">
                                    <i class="fas fa-external-link-alt text-xs"></i>Visit Project
                                </a>
                            @endif
                        </div>

                        @if($portfolio->technologies)
                            <div class="flex flex-wrap gap-2 mt-6">
                                @foreach($portfolio->technologies as $tech)
                                    <span class="bg-blue-50 text-blue-700 border border-blue-100 text-xs font-medium px-3 py-1.5 rounded-full">{{ $tech }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Project Details -->
                <div class="lg:col-span-7 animate-fade-in">
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-6 pb-8 mb-8 border-b border-gray-200">
                        <div>
                            <p class="text-xs font-semibold tracking-wide uppercase text-gray-400 mb-1">Client</p>
                            <p class="text-gray-900 font-medium">{{ $portfolio->client ?? 'Confidential' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold tracking-wide uppercase text-gray-400 mb-1">Completed</p>
                            <p class="text-gray-900 font-medium">{{ $portfolio->completion_date->format('F Y') }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold tracking-wide uppercase text-gray-400 mb-1">Category</p>
                            <p class="text-gray-900 font-medium">{{ $portfolio->category }}</p>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h2 class="text-xs font-semibold tracking-widest uppercase text-blue-600 mb-3">Overview</h2>
                        <p class="text-lg text-gray-700 leading-relaxed">{{ $portfolio->description }}</p>
                    </div>

                    <div class="mb-10">
                        <h2 class="text-xs font-semibold tracking-widest uppercase text-blue-600 mb-3">Work Done</h2>
                        <p class="text-gray-700 leading-relaxed">{{ $portfolio->work_done }}</p>
                    </div>

                    <div class="p-6 sm:p-8 bg-gray-50 rounded-2xl border border-gray-100">
                        <h3 class="text-xl font-bold mb-2 text-gray-900">Start Your Project with Us</h3>
                        <p class="text-gray-600 mb-5">Interested in working with us? Let's discuss your project and create something amazing together.</p>
                        <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 bg-blue-600 text-white px-7 py-3.5 rounded-full font-semibold hover:bg-blue-700 transition-colors">
                            Get Started <i class="fas fa-arrow-right text-sm"></i>
                        </a>
                    </div>
                </div>
            </div>

            @if($relatedPortfolios->isNotEmpty())
            <!-- Related Projects Start -->
            <div class="mt-24 pt-14 border-t border-gray-200">
                <div class="text-center mx-auto pb-10 max-w-2xl">
                    <p class="text-blue-600 text-sm font-semibold uppercase tracking-wide mb-2">More Projects</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Similar Projects</h2>
                </div>
                <div class="flex flex-wrap justify-center gap-6">
                    @foreach($relatedPortfolios as $relatedPortfolio)
                        <div class="group w-full sm:w-[calc(50%-0.75rem)] lg:w-[calc(33.333%-1rem)] max-w-sm">
                            <div class="transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl rounded-lg overflow-hidden shadow-sm border border-gray-100">
                                <div class="relative overflow-hidden">
                                    <img src="{{ asset($relatedPortfolio->image_url) }}"
                                         class="w-full h-64 object-cover"
                                         alt="{{ $relatedPortfolio->title }}">
                                    <div class="absolute inset-0 bg-black bg-opacity-70 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-center px-4">
                                        <h5 class="text-white text-xl font-semibold mb-2">{{ $relatedPortfolio->title }}</h5>
                                        <p class="text-white/70 mb-4">{{ $relatedPortfolio->category }}</p>
                                        <a href="{{ route('portfolios.show', $relatedPortfolio->slug) }}"
                                           class="bg-yellow-500 text-white px-6 py-2 rounded-full hover:bg-yellow-600 transition-colors">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Related Projects End -->
            @endif

            @if($portfolio->media && $portfolio->media->isNotEmpty())
            <div class="mt-24 pt-14 border-t border-gray-200">
                <div class="text-center mx-auto pb-10 max-w-2xl">
                    <p class="text-blue-600 text-sm font-semibold uppercase tracking-wide mb-2">Gallery</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">More Media</h2>
                </div>

                <div class="flex flex-wrap justify-center gap-6">
                    @foreach($portfolio->media as $media)
                        @php
                            $mType = $media->media_type;
                            $mSrc = $media->media_path ? asset('storage/' . ltrim($media->media_path, '/')) : null;
                            $mEmbed = \App\Models\Portfolio::embedSrcFromRaw($media->media_embed);
                        @endphp
                        <div class="w-full sm:w-[calc(50%-0.75rem)] lg:w-[calc(33.333%-1rem)] max-w-sm bg-gray-50 rounded-lg overflow-hidden shadow border border-gray-100">
                            @if($mType === 'video' && $mSrc)
                                <video class="w-full h-64 object-cover" controls playsinline preload="metadata">
                                    <source src="{{ $mSrc }}" type="video/mp4">
                                </video>
                            @elseif($mType === 'embed' && $mEmbed)
                                <iframe class="w-full h-64" src="{{ $mEmbed }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe>
                            @else
                                <img src="{{ $mSrc }}" class="w-full h-64 object-cover" alt="{{ $portfolio->title }}">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Back to Portfolio -->
            <div class="text-center mt-16">
                <a href="{{ route('portfolios.index') }}" class="text-blue-600 hover:text-blue-800 transition-colors inline-flex items-center text-sm font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Portfolio
                </a>
            </div>
        </div>
    </div>
    <!-- Portfolio Details End -->
@endsection
