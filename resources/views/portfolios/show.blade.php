@extends('layouts.app')

@section('title', $portfolio->title . ' - BYTEWAVE')
@section('meta_description', $portfolio->meta_description ?: Str::limit(strip_tags($portfolio->description), 160))
@section('og_type', 'website')

@push('schema')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@type": "CreativeWork",
    "name": @json($portfolio->title),
    "description": @json($portfolio->description),
    "creator": {
        "@type": "LocalBusiness",
        "name": @json(config('company.name'))
    }
}
</script>
    <x-breadcrumb-schema :items="[
        'Home' => route('home'),
        'Portfolio' => route('portfolios.index'),
        $portfolio->title => url()->current(),
    ]" />
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
        $heroImage = $heroImage ?: asset('images/bg-1.jpg');
    @endphp
    <!-- Page Header Start -->
    <div class="w-full py-16 bg-cover bg-center bg-no-repeat relative" style="background-image: linear-gradient(rgba(11, 31, 51, 0.85), rgba(11, 31, 51, 0.85)), url('{{ $heroImage }}'); background-color: #0B1F33;">
        <div class="max-w-4xl mx-auto px-4 text-center py-8">
            <span class="inline-block text-xs font-semibold tracking-widest uppercase text-white mb-4 animate-fade-in-down">{{ $portfolio->category }}</span>
            <h1 class="text-3xl md:text-5xl text-white mb-6 font-bold leading-tight animate-fade-in-down">{{ $portfolio->title }}</h1>
            <nav aria-label="breadcrumb" class="animate-fade-in-down">
                <ol class="flex justify-center items-center space-x-2 text-white/60 text-sm">
                    <li><a class="hover:underline transition-colors" href="{{ url('/') }}">Home</a></li>
                    <li class="before:content-['/'] before:mx-2"><a class="hover:underline transition-colors" href="{{ route('portfolios.index') }}">Portfolio</a></li>
                    <li class="before:content-['/'] before:mx-2 text-white/90">{{ Str::limit($portfolio->title, 40) }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Portfolio Details Start -->
    <div class="relative isolate w-full py-16">
        <x-bg-art layout="white" flip />
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14">
                <!-- Project Image -->
                <div class="lg:col-span-5 animate-fade-in">
                    <div class="lg:sticky lg:top-28">
                        <div class="relative rounded-2xl overflow-hidden shadow-lg border border-bytewave-blue/20">
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
                                <x-cta-button :href="$portfolio->project_url" target="_blank" rel="noopener" text="Visit Project" variant="light" size="sm" class="absolute top-4 right-4" />
                            @endif
                        </div>

                        @if($portfolio->technologies)
                            @if($portfolio->isMultimedia())
                                <p class="text-xs font-semibold tracking-wide uppercase text-bytewave-ink/70 mt-6 -mb-3">Tools &amp; Equipment</p>
                            @endif
                            <div class="flex flex-wrap gap-2 mt-6">
                                @foreach($portfolio->technologies as $tech)
                                    <span class="bg-bytewave-blue/5 text-bytewave-blue border border-bytewave-blue/20 text-xs font-medium px-3 py-1.5 rounded-full">{{ $tech }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Project Details -->
                <div class="lg:col-span-7 animate-fade-in">
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-6 pb-8 mb-8 border-b border-bytewave-blue/20">
                        <div>
                            <p class="text-xs font-semibold tracking-wide uppercase text-bytewave-ink/70 mb-1">Client</p>
                            <p class="text-bytewave-ink font-medium">{{ $portfolio->client ?? 'Confidential' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold tracking-wide uppercase text-bytewave-ink/70 mb-1">Completed</p>
                            <p class="text-bytewave-ink font-medium">{{ $portfolio->completion_date->format('F Y') }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold tracking-wide uppercase text-bytewave-ink/70 mb-1">Category</p>
                            <p class="text-bytewave-ink font-medium">{{ $portfolio->category }}</p>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h2 class="text-xs font-semibold tracking-widest uppercase text-bytewave-blue mb-3 before:content-[''] before:inline-block before:w-1.5 before:h-1.5 before:bg-bytewave-gold before:mr-2 before:align-middle">Overview</h2>
                        @include('portfolios.partials.text', ['text' => $portfolio->description, 'class' => 'text-lg text-bytewave-ink leading-relaxed'])
                    </div>

                    {{-- Legacy: only for projects with no case study --}}
                    @if($portfolio->work_done && !$portfolio->challenge && !$portfolio->solution && empty($portfolio->process_steps))
                    <div class="mb-10">
                        <h2 class="text-xs font-semibold tracking-widest uppercase text-bytewave-blue mb-3 before:content-[''] before:inline-block before:w-1.5 before:h-1.5 before:bg-bytewave-gold before:mr-2 before:align-middle">Work Done</h2>
                        @include('portfolios.partials.text', ['text' => $portfolio->work_done])
                    </div>
                    @endif

                    <div class="p-6 sm:p-8 bg-bytewave-blue/5 rounded-2xl border border-bytewave-blue/20">
                        <h3 class="text-xl font-bold mb-2 text-bytewave-ink">Start Your Project with Us</h3>
                        <p class="text-bytewave-ink/70 mb-5">Interested in working with us? Let's discuss your project and create something amazing together.</p>
                        <x-cta-button :href="route('contact')" text="Get Started" />
                    </div>
                </div>
            </div>

            @if($portfolio->isMultimedia())
                @include('portfolios.partials.gallery')
            @endif

            {{-- Case study sections: each renders only when filled in --}}
            @if(!empty($portfolio->highlights))
            @php
                $highlightCols = [1 => 'lg:grid-cols-1', 2 => 'lg:grid-cols-2', 3 => 'lg:grid-cols-3'][count($portfolio->highlights)] ?? 'lg:grid-cols-4';
            @endphp
            <div class="mt-20 grid grid-cols-2 {{ $highlightCols }} gap-4">
                @foreach($portfolio->highlights as $highlight)
                    <div class="rounded-2xl bg-bytewave-ink text-white p-6 text-center">
                        <p class="text-3xl md:text-4xl font-bold">{{ $highlight['value'] }}</p>
                        <p class="text-sm text-white/70 mt-2">{{ $highlight['label'] }}</p>
                    </div>
                @endforeach
            </div>
            @endif

            @if($portfolio->challenge || $portfolio->solution)
            <div class="mt-20 grid grid-cols-1 md:grid-cols-2 gap-6">
                @if($portfolio->challenge)
                <div class="p-6 sm:p-8 rounded-2xl border border-bytewave-blue/20 bg-white">
                    <h2 class="text-xs font-semibold tracking-widest uppercase text-bytewave-blue mb-3">The Challenge</h2>
                    @include('portfolios.partials.text', ['text' => $portfolio->challenge])
                </div>
                @endif
                @if($portfolio->solution)
                <div class="p-6 sm:p-8 rounded-2xl bg-bytewave-blue/5 border border-bytewave-blue/20">
                    <h2 class="text-xs font-semibold tracking-widest uppercase text-bytewave-blue mb-3">Our Solution</h2>
                    @include('portfolios.partials.text', ['text' => $portfolio->solution])
                </div>
                @endif
            </div>
            @endif

            @if(!empty($portfolio->process_steps))
            <div class="mt-20">
                <div class="text-center mx-auto pb-10 max-w-2xl">
                    <p class="text-bytewave-blue text-sm font-semibold uppercase tracking-wide mb-2">Our Approach</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-bytewave-ink">How We Did It</h2>
                </div>
                <ol class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($portfolio->process_steps as $step)
                        <li class="flex gap-4 p-6 rounded-2xl border border-bytewave-blue/20 bg-white">
                            <span class="shrink-0 w-10 h-10 rounded-full bg-bytewave-blue text-white font-bold flex items-center justify-center">{{ $loop->iteration }}</span>
                            <div>
                                @if($step['title'] !== '')
                                    <h3 class="text-lg font-bold text-bytewave-ink mb-2">{{ $step['title'] }}</h3>
                                @endif
                                @include('portfolios.partials.text', ['text' => $step['description'], 'class' => 'text-bytewave-ink/80 leading-relaxed'])
                            </div>
                        </li>
                    @endforeach
                </ol>
            </div>
            @endif

            @if($portfolio->results)
            <div class="mt-20 max-w-3xl mx-auto text-center">
                <p class="text-bytewave-blue text-sm font-semibold uppercase tracking-wide mb-2">The Outcome</p>
                <h2 class="text-3xl md:text-4xl font-bold text-bytewave-ink mb-6">Results</h2>
                <div class="text-left">
                    @include('portfolios.partials.text', ['text' => $portfolio->results, 'class' => 'text-lg text-bytewave-ink leading-relaxed'])
                </div>
            </div>
            @endif

            @if($portfolio->testimonial)
            <figure class="mt-20 max-w-3xl mx-auto p-8 rounded-2xl bg-bytewave-blue/5 border border-bytewave-blue/20 text-center">
                <blockquote class="text-xl text-bytewave-ink leading-relaxed">&ldquo;{{ $portfolio->testimonial }}&rdquo;</blockquote>
                @if($portfolio->testimonial_author)
                    <figcaption class="mt-4 text-sm font-semibold text-bytewave-blue">{{ $portfolio->testimonial_author }}</figcaption>
                @endif
            </figure>
            @endif

            @if($relatedPortfolios->isNotEmpty())
            <!-- Related Projects Start -->
            <div class="mt-24 pt-14 border-t border-bytewave-blue/20">
                <div class="text-center mx-auto pb-10 max-w-2xl">
                    <p class="text-bytewave-blue text-sm font-semibold uppercase tracking-wide mb-2 before:content-[''] before:inline-block before:w-1.5 before:h-1.5 before:bg-bytewave-gold before:mr-2 before:align-middle">More Projects</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-bytewave-ink">Similar Projects</h2>
                </div>
                <div class="flex flex-wrap justify-center gap-6">
                    @foreach($relatedPortfolios as $relatedPortfolio)
                        <div class="group w-full sm:w-[calc(50%-0.75rem)] lg:w-[calc(33.333%-1rem)] max-w-sm">
                            <div class="transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl rounded-lg overflow-hidden shadow-sm border border-bytewave-blue/20">
                                <div class="relative overflow-hidden">
                                    <img loading="lazy" decoding="async" src="{{ asset($relatedPortfolio->image_url) }}"
                                         class="w-full h-64 object-cover"
                                         alt="{{ $relatedPortfolio->title }}">
                                    <div class="absolute inset-0 bg-bytewave-ink/70 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-center px-4">
                                        <h5 class="text-white text-xl font-semibold mb-2">{{ $relatedPortfolio->title }}</h5>
                                        <p class="text-white/70 mb-4">{{ $relatedPortfolio->category }}</p>
                                        <x-cta-button :href="route('portfolios.show', $relatedPortfolio->slug)" text="View Details" variant="light" size="sm" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Related Projects End -->
            @endif

            @unless($portfolio->isMultimedia())
                @include('portfolios.partials.gallery')
            @endunless

            <!-- Back to Portfolio -->
            <div class="text-center mt-16">
                <a href="{{ route('portfolios.index') }}" class="text-bytewave-blue hover:text-bytewave-ink transition-colors inline-flex items-center text-sm font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Portfolio
                </a>
            </div>
        </div>
    </div>
    <!-- Portfolio Details End -->
@endsection
