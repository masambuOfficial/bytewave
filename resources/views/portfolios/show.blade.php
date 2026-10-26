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
        $type = $portfolio->getPrimaryMediaType();
        $src = $portfolio->primaryMediaPublicUrl();
        $embedSrc = $portfolio->primaryEmbedSrc();
        $label = "text-xs font-semibold tracking-widest uppercase text-bytewave-blue before:content-[''] before:inline-block before:w-1.5 before:h-1.5 before:bg-bytewave-gold before:mr-2 before:align-middle";
        $summaryBlocks = \App\Models\Portfolio::textBlocks($portfolio->description);
        $summary = $portfolio->meta_description ?: Str::limit($summaryBlocks[0]['items'][0] ?? '', 160);

        $stats = collect($portfolio->highlights ?? [])
            ->filter(fn ($h) => filled($h['value'] ?? null) && filled($h['label'] ?? null))
            ->take(4)->values();
        $statCols = [1 => 'grid-cols-1', 2 => 'grid-cols-2', 3 => 'grid-cols-1 sm:grid-cols-3', 4 => 'grid-cols-2 lg:grid-cols-4'][$stats->count()] ?? '';

        $hasCase = $portfolio->challenge || $portfolio->solution;
        $hasSteps = !empty($portfolio->process_steps);
        $legacyWork = $portfolio->work_done && !$portfolio->challenge && !$portfolio->solution && !$hasSteps;
        $section = 'py-8 first:pt-0 last:pb-0';
    @endphp

    <article class="w-full">
        <!-- Hero -->
        <header class="w-full bg-bytewave-ink">
            <div class="max-w-6xl mx-auto px-4 pt-20 pb-12 md:pt-28 md:pb-16 text-center">
                @if($portfolio->category)
                    <p class="text-xs font-semibold tracking-widest uppercase text-white/70 mb-4 before:content-[''] before:inline-block before:w-1.5 before:h-1.5 before:bg-bytewave-gold before:mr-2 before:align-middle">{{ $portfolio->category }}</p>
                @endif
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold leading-tight text-white max-w-4xl mx-auto">{{ $portfolio->title }}</h1>
                @if($summary)
                    <p class="mt-4 text-lg text-white/80 max-w-2xl mx-auto">{{ $summary }}</p>
                @endif
                <nav aria-label="breadcrumb" class="mt-8">
                    <ol class="flex flex-wrap justify-center items-center gap-x-2 text-white/70 text-sm">
                        <li><a class="hover:text-white transition-colors" href="{{ url('/') }}">Home</a></li>
                        <li class="before:content-['/'] before:mr-2"><a class="hover:text-white transition-colors" href="{{ route('portfolios.index') }}">Portfolio</a></li>
                        <li class="before:content-['/'] before:mr-2 text-white" aria-current="page">{{ Str::limit($portfolio->title, 40) }}</li>
                    </ol>
                </nav>
            </div>
        </header>

        <div class="relative isolate">
            <x-bg-art layout="white" flip />
            <div class="max-w-6xl mx-auto px-4 py-10 md:py-14">
                <!-- Featured media -->
                <div class="overflow-hidden rounded-2xl border border-bytewave-blue/20 bg-bytewave-ink/5">
                    @if($type === 'video' && $src)
                        <video class="aspect-video w-full object-cover" controls playsinline preload="metadata">
                            <source src="{{ $src }}" type="video/mp4">
                        </video>
                    @elseif($type === 'embed' && $embedSrc)
                        <iframe class="aspect-video w-full" src="{{ $embedSrc }}" title="{{ $portfolio->title }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe>
                    @else
                        <img src="{{ $src ?: asset($portfolio->image_url) }}" class="aspect-video w-full object-cover" alt="{{ $portfolio->title }}">
                    @endif
                </div>

                <!-- Content (8) + sidebar (4) -->
                <div class="mt-10 md:mt-14 grid grid-cols-1 gap-10 lg:grid-cols-12 lg:gap-14">
                    <div class="lg:col-span-8 divide-y divide-bytewave-blue/20">
                        <section class="{{ $section }}">
                            <h2 class="{{ $label }} mb-4">Overview</h2>
                            @include('portfolios.partials.text', ['text' => $portfolio->description, 'class' => 'text-lg text-bytewave-ink leading-relaxed'])
                        </section>

                        {{-- Legacy: only for projects with no case study --}}
                        @if($legacyWork)
                        <section class="{{ $section }}">
                            <h2 class="{{ $label }} mb-4">Work done</h2>
                            @include('portfolios.partials.text', ['text' => $portfolio->work_done])
                        </section>
                        @endif

                        {{-- Side by side only when both exist; otherwise the one that exists takes the full width --}}
                        @if($hasCase)
                        <section class="{{ $section }} grid grid-cols-1 gap-8 {{ $portfolio->challenge && $portfolio->solution ? 'md:grid-cols-2 md:gap-10' : '' }}">
                            @if($portfolio->challenge)
                            <div>
                                <h2 class="{{ $label }} mb-4">The challenge</h2>
                                @include('portfolios.partials.text', ['text' => $portfolio->challenge])
                            </div>
                            @endif
                            @if($portfolio->solution)
                            <div>
                                <h2 class="{{ $label }} mb-4">Our solution</h2>
                                @include('portfolios.partials.text', ['text' => $portfolio->solution])
                            </div>
                            @endif
                        </section>
                        @endif

                        @if($hasSteps)
                        <section class="{{ $section }}">
                            <h2 class="{{ $label }} mb-6">How we did it</h2>
                            <ol>
                                @foreach($portfolio->process_steps as $step)
                                    <li class="relative pl-14 {{ $loop->last ? '' : 'pb-8' }}">
                                        @unless($loop->last)
                                            <span class="absolute left-5 top-10 bottom-0 w-px -translate-x-1/2 bg-bytewave-blue/20" aria-hidden="true"></span>
                                        @endunless
                                        <span class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-full bg-bytewave-blue text-sm font-semibold text-white">{{ $loop->iteration }}</span>
                                        @if(($step['title'] ?? '') !== '')
                                            <h3 class="pt-2 text-lg font-bold leading-snug text-bytewave-ink">{{ $step['title'] }}</h3>
                                        @endif
                                        <div class="{{ ($step['title'] ?? '') !== '' ? 'mt-1' : 'pt-2' }}">
                                            @include('portfolios.partials.text', ['text' => $step['description'] ?? '', 'class' => 'text-bytewave-ink/80 leading-relaxed'])
                                        </div>
                                    </li>
                                @endforeach
                            </ol>
                        </section>
                        @endif

                        @if($portfolio->results)
                        <section class="{{ $section }}">
                            <h2 class="{{ $label }} mb-4">Results</h2>
                            @include('portfolios.partials.text', ['text' => $portfolio->results])
                        </section>
                        @endif

                        @if($portfolio->testimonial)
                        <section class="{{ $section }}">
                            <figure class="border-l-2 border-bytewave-blue pl-6">
                                <blockquote class="text-xl leading-relaxed text-bytewave-ink">&ldquo;{{ $portfolio->testimonial }}&rdquo;</blockquote>
                                @if($portfolio->testimonial_author)
                                    <figcaption class="mt-3 text-sm font-semibold text-bytewave-blue">{{ $portfolio->testimonial_author }}</figcaption>
                                @endif
                            </figure>
                        </section>
                        @endif
                    </div>

                    <!-- Sidebar: meta always lives here, so a short page still has a filled right side -->
                    <aside class="lg:col-span-4 max-lg:order-first">
                        <div class="lg:sticky lg:top-28 rounded-2xl border border-bytewave-blue/20 bg-bytewave-blue/5 p-6">
                            <dl class="space-y-5">
                                <div>
                                    <dt class="text-xs font-semibold tracking-wide uppercase text-bytewave-ink/70 mb-1">Client</dt>
                                    <dd class="font-medium text-bytewave-ink">{{ $portfolio->client ?: 'Confidential' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs font-semibold tracking-wide uppercase text-bytewave-ink/70 mb-1">Completed</dt>
                                    <dd class="font-medium text-bytewave-ink">{{ $portfolio->completion_date->format('F Y') }}</dd>
                                </div>
                                @if($portfolio->category)
                                <div>
                                    <dt class="text-xs font-semibold tracking-wide uppercase text-bytewave-ink/70 mb-1">Category</dt>
                                    <dd class="font-medium text-bytewave-ink">{{ $portfolio->category }}</dd>
                                </div>
                                @endif
                                @if(!empty($portfolio->technologies))
                                <div>
                                    <dt class="text-xs font-semibold tracking-wide uppercase text-bytewave-ink/70 mb-2">{{ $portfolio->isMultimedia() ? 'Tools & equipment' : 'Technologies' }}</dt>
                                    <dd class="flex flex-wrap gap-2">
                                        @foreach($portfolio->technologies as $tech)
                                            <span class="bg-white text-bytewave-ink border border-bytewave-blue/20 text-xs font-medium px-3 py-1.5 rounded-full">{{ $tech }}</span>
                                        @endforeach
                                    </dd>
                                </div>
                                @endif
                            </dl>
                            @if($portfolio->project_url)
                                <a href="{{ $portfolio->project_url }}" target="_blank" rel="noopener"
                                   class="mt-6 flex w-full items-center justify-center gap-2 rounded-lg border border-bytewave-blue bg-white px-4 py-3 text-sm font-semibold text-bytewave-blue transition-colors hover:bg-bytewave-blue hover:text-white">
                                    Visit project <i class="fas fa-arrow-up-right-from-square text-xs"></i>
                                </a>
                            @endif
                        </div>
                    </aside>
                </div>

                <!-- Stats: at most four, one column per item -->
                @if($stats->isNotEmpty())
                <section class="mt-14 md:mt-20 overflow-hidden rounded-xl border border-bytewave-blue/20 bg-bytewave-blue/20" aria-label="Key figures">
                    <div class="grid gap-px {{ $statCols }}">
                        @foreach($stats as $stat)
                            <div class="bg-white p-5 sm:p-6">
                                <p class="text-2xl sm:text-3xl font-bold text-bytewave-ink">{{ $stat['value'] }}</p>
                                <p class="mt-1 text-sm text-bytewave-ink/70">{{ $stat['label'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </section>
                @endif

                @include('portfolios.partials.gallery')

                <!-- Similar projects -->
                @if($relatedPortfolios->isNotEmpty())
                <section class="mt-16 md:mt-20" aria-labelledby="related-heading">
                    <h2 id="related-heading" class="text-2xl md:text-3xl font-bold text-bytewave-ink mb-8">Similar projects</h2>
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($relatedPortfolios as $related)
                            @php
                                $relThumb = $related->getPrimaryMediaType() === 'embed' ? $related->primaryEmbedThumbnailUrl() : null;
                                $relThumb = $relThumb ?: ($related->hasImage() && $related->image_url !== 'images/no-image.png' ? asset($related->image_url) : null);
                            @endphp
                            <a href="{{ route('portfolios.show', $related->slug) }}" class="group block overflow-hidden rounded-lg border border-bytewave-blue/20 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                                <div class="relative h-56 overflow-hidden bg-bytewave-blue/5">
                                    @if($relThumb)
                                        <img loading="lazy" decoding="async" src="{{ $relThumb }}" class="h-full w-full object-cover" alt="{{ $related->title }}">
                                    @else
                                        <div class="flex h-full w-full items-center justify-center text-bytewave-blue/40" aria-hidden="true"><i class="fas fa-image text-4xl"></i></div>
                                    @endif
                                    <div class="absolute inset-0 flex flex-col items-center justify-center bg-bytewave-ink/70 px-4 text-center opacity-0 transition-opacity duration-300 group-hover:opacity-100 group-focus-visible:opacity-100">
                                        <h3 class="mb-1 text-lg font-semibold text-white">{{ $related->title }}</h3>
                                        <p class="text-white/70">{{ $related->category }}</p>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <p class="text-xs font-semibold uppercase tracking-widest text-bytewave-blue">{{ $related->category }}</p>
                                    <h3 class="mt-1 line-clamp-2 font-bold text-bytewave-ink">{{ $related->title }}</h3>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
                @endif
            </div>
        </div>

        <!-- CTA band -->
        <section class="w-full bg-bytewave-ink">
            <div class="max-w-6xl mx-auto px-4 py-10 md:py-12 flex flex-col md:flex-row md:items-center md:justify-between gap-6 text-center md:text-left">
                <div>
                    <h2 class="text-2xl font-bold text-white">Have a similar project?</h2>
                    <p class="mt-1 text-white/70">Tell us what you need and we will get back to you with a plan and a quote.</p>
                </div>
                <div class="flex justify-center md:flex-shrink-0">
                    <x-cta-button :href="route('contact')" text="Get a quote" variant="light" />
                </div>
            </div>
        </section>
    </article>
@endsection
