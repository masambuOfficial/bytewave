@extends('layouts.app')

@section('title', 'Portfolio ')

@section('content')
    <!-- Page Header Start -->
    <div class="w-full py-20 bg-cover bg-center bg-no-repeat relative" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset('css/img/bg-1.jpg') }}');">
        <div class="max-w-7xl mx-auto px-4 text-center py-12">
            <h1 class="text-5xl md:text-6xl text-yellow-500 mb-6 font-bold animate-fade-in-down">Our Portfolio</h1>
            <nav aria-label="breadcrumb" class="animate-fade-in-down">
                <ol class="flex justify-center items-center space-x-2 text-white">
                    <li><a class="text-white hover:text-yellow-500 transition-colors" href="{{ url('/') }}">Home</a></li>
                    <li class="before:content-['/'] before:mx-2">Portfolio</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Portfolio Start -->
    <div class="w-full py-12 my-12">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="text-center mx-auto pb-12 max-w-2xl">
                <h5 class="text-blue-600 text-lg font-semibold mb-2">Our Work</h5>
                <h1 class="text-4xl md:text-5xl text-yellow-500 font-bold">Featured Projects & Success Stories</h1>
            </div>

            <!-- Portfolio Categories -->
            @if($portfolios->isNotEmpty() && $portfolios->pluck('category')->unique()->count() > 1)
            <div class="text-center mb-12">
                <div class="inline-flex flex-wrap gap-3 justify-center" role="group" aria-label="Portfolio categories">
                    <button type="button" class="filter-btn px-6 py-2 rounded-full border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white transition-all duration-300 active" data-filter="*">All</button>
                    @foreach($portfolios->pluck('category')->unique() as $category)
                        <button type="button" class="filter-btn px-6 py-2 rounded-full border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white transition-all duration-300" data-filter=".{{ Str::slug($category) }}">
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
                        <div class="transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">
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
                                    <div class="w-full h-64 bg-black">
                                        <iframe class="w-full h-64" src="{{ $embedSrc }}" title="{{ $portfolio->title }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe>
                                    </div>
                                @else
                                    <img src="{{ $src ? $src : asset($portfolio->image_url) }}"
                                         class="w-full h-64 object-cover"
                                         alt="{{ $portfolio->title }}">
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/55 to-black/10 opacity-0 group-hover:opacity-100 transition-all duration-300">
                                    <div class="absolute inset-x-0 bottom-0 p-5 translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                                        <p class="text-white/70 text-xs font-medium tracking-wide uppercase mb-1">{{ $portfolio->category }}</p>
                                        <h5 class="text-white text-lg font-semibold leading-snug line-clamp-2" style="text-shadow: 0 2px 12px rgba(0,0,0,.65);">{{ $portfolio->title }}</h5>
                                        <div class="mt-4">
                                            <a href="{{ route('portfolios.show', $portfolio->slug) }}"
                                               class="inline-flex items-center gap-2 bg-white/10 text-white px-4 py-2 rounded-full border border-white/20 hover:bg-white/20 transition-colors">
                                                <span class="text-sm font-medium">View</span>
                                                <i class="fas fa-arrow-right text-xs"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-6 bg-gray-50">
                                <h4 class="text-2xl font-bold mb-2">{{ $portfolio->title }}</h4>
                                <p class="text-gray-600 mb-4">{{ Str::limit($portfolio->description, 100) }}</p>
                                @if($portfolio->technologies)
                                    <div class="flex flex-wrap gap-2 mb-4">
                                        @foreach($portfolio->technologies as $tech)
                                            <span class="bg-blue-600 text-white text-xs px-3 py-1 rounded-full">{{ $tech }}</span>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-500 text-sm">
                                        <i class="fas fa-calendar-alt mr-1"></i>
                                        {{ $portfolio->completion_date->format('M Y') }}
                                    </span>
                                    <a href="{{ route('portfolios.show', $portfolio->slug) }}" class="text-blue-600 hover:text-blue-800 transition-colors">
                                        Learn More <i class="fas fa-arrow-right ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-xl text-gray-600">No portfolio items available at the moment.</p>
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
    <div class="w-full bg-blue-600 py-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-center">
                <div class="lg:col-span-2">
                    <h1 class="text-4xl font-bold mb-4 text-white">Ready to Start Your Project?</h1>
                    <p class="text-white text-lg mb-4">Let's discuss how we can help bring your vision to life. Our team is ready to deliver exceptional results for your business.</p>
                </div>
                <div class="lg:text-right">
                    <a href="{{ route('contact') }}" class="inline-block bg-white text-blue-600 px-8 py-4 rounded-full font-semibold hover:bg-gray-100 transition-colors">Get Started</a>
                </div>
            </div>
        </div>
    </div>
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
                btn.classList.remove('active', 'bg-blue-600', 'text-white');
                btn.classList.add('text-blue-600');
            });
            this.classList.add('active', 'bg-blue-600', 'text-white');
            this.classList.remove('text-blue-600');

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