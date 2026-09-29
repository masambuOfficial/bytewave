@extends('layouts.app')

@section('title', 'Our Portfolio – Websites, Systems & Media Projects | ByteWave')
@section('meta_description', 'See websites, management systems, livestreams and design projects delivered by ByteWave Investments for clients across Uganda.')

@push('schema')
    <x-breadcrumb-schema :items="['Home' => route('home'), 'Portfolio' => url()->current()]" />
@endpush

@section('content')
    <!-- Page Header Start -->
    <div class="w-full bg-bytewave-blue/10 relative">
        <span class="sr-only">Our Portfolio</span>
        <img src="{{ asset('images/bytewave_portfolio.webp') }}"
             alt="Refine Portfolio - Built with Heart"
             width="592" height="178"
             class="w-full h-auto md:max-h-[340px] object-cover object-center block">
        {{-- Flat Ink overlay so the breadcrumb stays readable over the photo. --}}
        <div class="absolute inset-0 pointer-events-none"
             style="background: rgba(11, 31, 51, 0.75);"></div>
        <nav aria-label="breadcrumb" class="absolute inset-x-0 bottom-0 pb-3 md:pb-5 animate-fade-in-down">
            <ol class="flex justify-center items-center space-x-2 text-white text-sm md:text-base">
                <li><a class="text-white hover:underline transition-colors" href="{{ url('/') }}">Home</a></li>
                <li class="before:content-['/'] before:mx-2">Portfolio</li>
            </ol>
        </nav>
    </div>
    <!-- Page Header End -->

    <!-- Portfolio Start -->
    <div class="relative isolate w-full py-12 my-12">
        <x-bg-art layout="white" />
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="text-center mx-auto pb-12 max-w-2xl">
                <h5 class="text-bytewave-blue text-lg font-semibold mb-2">Our Work</h5>
                <h1 class="text-4xl md:text-5xl text-bytewave-ink font-bold">Featured Projects & Success Stories</h1>
            </div>

            <!-- Portfolio Categories -->
            @if($portfolios->isNotEmpty() && $portfolios->pluck('category')->unique()->count() > 1)
            <div class="text-center mb-12">
                <div class="inline-flex flex-wrap gap-3 justify-center" role="group" aria-label="Portfolio categories">
                    <button type="button" class="filter-btn px-6 py-2 rounded-full border-2 border-bytewave-blue text-bytewave-blue hover:bg-bytewave-ink hover:text-white transition-all duration-300 active" data-filter="*">All</button>
                    @foreach($portfolios->pluck('category')->unique() as $category)
                        <button type="button" class="filter-btn px-6 py-2 rounded-full border-2 border-bytewave-blue text-bytewave-blue hover:bg-bytewave-ink hover:text-white transition-all duration-300" data-filter=".{{ Str::slug($category) }}">
                            {{ $category }}
                        </button>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Portfolio Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 portfolio-container">
                @forelse($portfolios as $portfolio)
                    <div class="portfolio-item {{ Str::slug($portfolio->category) }} group">
                        <div class="h-full flex flex-col overflow-hidden rounded-xl bg-bytewave-blue/5 shadow-md transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">
                            <div class="relative overflow-hidden">
                                @php
                                    $type = $portfolio->getPrimaryMediaType();
                                    $src = $portfolio->primaryMediaPublicUrl();
                                    $embedSrc = $portfolio->primaryEmbedSrc();
                                @endphp
                                @if($type === 'video' && $src)
                                    <video class="w-full h-64 object-cover" muted playsinline preload="metadata">
                                        <source src="{{ $src }}" type="video/mp4">
                                    </video>
                                @elseif($type === 'embed' && $embedSrc)
                                    <div class="w-full h-64 bg-bytewave-ink">
                                        <iframe class="w-full h-64" src="{{ $embedSrc }}" title="{{ $portfolio->title }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe>
                                    </div>
                                @else
                                    <img loading="lazy" decoding="async" src="{{ $src ? $src : asset($portfolio->image_url) }}"
                                         class="w-full h-64 object-cover"
                                         alt="{{ $portfolio->title }}">
                                @endif
                                <div class="absolute inset-0 bg-bytewave-ink/80 opacity-0 group-hover:opacity-100 transition-all duration-300">
                                    <div class="absolute inset-x-0 bottom-0 p-5 translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                                        <p class="text-white/70 text-xs font-medium tracking-wide uppercase mb-1">{{ $portfolio->category }}</p>
                                        <h5 class="text-white text-lg font-semibold leading-snug line-clamp-2" style="text-shadow: 0 2px 12px rgba(11, 31, 51, .65);">{{ $portfolio->title }}</h5>
                                        <div class="mt-4">
                                            <x-cta-button :href="route('portfolios.show', $portfolio->slug)" text="View" variant="light" size="sm" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-6 flex flex-1 flex-col">
                                <h4 class="text-xl leading-7 font-bold mb-2 line-clamp-2 min-h-14" title="{{ $portfolio->title }}">{{ $portfolio->title }}</h4>
                                <p class="text-bytewave-ink/70 leading-6 mb-4 line-clamp-3 min-h-18">{{ Str::limit($portfolio->description, 220) }}</p>
                                {{-- One reserved row for technology chips; extra chips are clipped so every card keeps the same height --}}
                                <div class="flex flex-wrap gap-2 mb-5 h-7 overflow-hidden">
                                    @foreach(collect($portfolio->technologies ?? [])->take(3) as $tech)
                                        <span class="bg-bytewave-blue text-white text-xs leading-5 px-3 py-1 rounded-full whitespace-nowrap">{{ $tech }}</span>
                                    @endforeach
                                    @if(count($portfolio->technologies ?? []) > 3)
                                        <span class="bg-bytewave-blue/10 text-bytewave-ink text-xs leading-5 px-3 py-1 rounded-full whitespace-nowrap">+{{ count($portfolio->technologies) - 3 }}</span>
                                    @endif
                                </div>
                                <div class="mt-auto pt-4 border-t border-bytewave-blue/20 flex justify-between items-center">
                                    <span class="text-bytewave-ink/70 text-sm">
                                        <i class="fas fa-calendar-alt mr-1"></i>
                                        {{ $portfolio->completion_date->format('M Y') }}
                                    </span>
                                    <a href="{{ route('portfolios.show', $portfolio->slug) }}" class="text-bytewave-blue hover:text-bytewave-ink transition-colors">
                                        Learn More <i class="fas fa-arrow-right ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-xl text-bytewave-ink/70">No portfolio items available at the moment.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-12">
                {{ $portfolios->links('vendor.pagination.bytewave') }}
            </div>
        </div>
    </div>
    <!-- Portfolio End -->

    <!-- Call to Action Start -->
    <section class="relative isolate py-12 md:py-20" aria-labelledby="portfolio-cta-heading">
        <x-bg-art layout="tint" flip />
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-bytewave-blue/20 bg-bytewave-blue/5 px-6 py-10 md:px-12 md:py-14 flex flex-col md:flex-row md:items-center md:justify-between gap-8 text-center md:text-left">
                <div class="max-w-2xl">
                    <p class="text-bytewave-blue font-semibold text-base uppercase tracking-wider mb-3 before:content-[''] before:inline-block before:w-1.5 before:h-1.5 before:bg-bytewave-gold before:mr-2 before:align-middle">Start a project</p>
                    <h2 id="portfolio-cta-heading" class="text-3xl md:text-4xl font-bold text-bytewave-ink mb-3">Ready to Start Your Project?</h2>
                    <p class="text-lg text-bytewave-ink/70">Let's discuss how we can help bring your vision to life. Our team is ready to deliver exceptional results for your business.</p>
                </div>
                <div class="flex-shrink-0 flex justify-center">
                    <x-cta-button :href="route('contact')" text="Get Started" />
                </div>
            </div>
        </div>
    </section>
    <!-- Call to Action End -->
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const portfolioItems = document.querySelectorAll('.portfolio-item');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filterValue = this.getAttribute('data-filter');
            
            // Update active button styling
            filterButtons.forEach(btn => {
                btn.classList.remove('active', 'bg-bytewave-blue', 'text-white');
                btn.classList.add('text-bytewave-blue');
            });
            this.classList.add('active', 'bg-bytewave-blue', 'text-white');
            this.classList.remove('text-bytewave-blue');

            // Filter portfolio items
            portfolioItems.forEach(item => {
                if (filterValue === '*') {
                    // Show all items
                    item.style.display = 'block';
                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transform = 'scale(1)';
                    }, 10);
                } else {
                    // Check if item has the filter class
                    const filterClass = filterValue.replace('.', '');
                    if (item.classList.contains(filterClass)) {
                        item.style.display = 'block';
                        setTimeout(() => {
                            item.style.opacity = '1';
                            item.style.transform = 'scale(1)';
                        }, 10);
                    } else {
                        item.style.opacity = '0';
                        item.style.transform = 'scale(0.8)';
                        setTimeout(() => {
                            item.style.display = 'none';
                        }, 300);
                    }
                }
            });
        });
    });

    // Initialize all items as visible with transition
    portfolioItems.forEach(item => {
        item.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
        item.style.opacity = '1';
        item.style.transform = 'scale(1)';
    });
});
</script>
@endsection