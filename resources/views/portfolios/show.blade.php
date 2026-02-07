@extends('layouts.app')

@section('title', $portfolio->title . ' - BYTEWAVE')

@section('content')
    <!-- Page Header Start -->
    <div class="w-full py-20 bg-cover bg-center bg-no-repeat relative" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset('css/img/bg-1.jpg') }}');">
        <div class="max-w-7xl mx-auto px-4 text-center py-12">
            <h1 class="text-5xl md:text-6xl text-yellow-500 mb-6 font-bold animate-fade-in-down">{{ $portfolio->title }}</h1>
            <nav aria-label="breadcrumb" class="animate-fade-in-down">
                <ol class="flex justify-center items-center space-x-2 text-white">
                    <li><a class="text-white hover:text-yellow-500 transition-colors" href="{{ url('/') }}">Home</a></li>
                    <li class="before:content-['/'] before:mx-2"><a class="text-white hover:text-yellow-500 transition-colors" href="{{ route('portfolios.index') }}">Portfolio</a></li>
                    <li class="before:content-['/'] before:mx-2">{{ $portfolio->title }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Portfolio Details Start -->
    <div class="w-full py-12 my-12">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Project Image -->
                <div class="animate-fade-in">
                    <div class="relative">
                        @php
                            $type = $portfolio->getPrimaryMediaType();
                            $src = $portfolio->primaryMediaPublicUrl();
                            $embedSrc = $portfolio->primaryEmbedSrc();
                        @endphp

                        @if($type === 'video' && $src)
                            <video class="w-full rounded-lg shadow-lg max-h-[500px] object-cover" controls playsinline preload="metadata">
                                <source src="{{ $src }}" type="video/mp4">
                            </video>
                        @elseif($type === 'embed' && $embedSrc)
                            <div class="w-full rounded-lg shadow-lg overflow-hidden" style="max-height: 500px;">
                                <iframe class="w-full" style="height: 500px;" src="{{ $embedSrc }}" title="{{ $portfolio->title }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe>
                            </div>
                        @else
                            <img src="{{ $src ? $src : asset($portfolio->image_url) }}"
                                 class="w-full rounded-lg shadow-lg max-h-[500px] object-cover"
                                 alt="{{ $portfolio->title }}">
                        @endif
                        @if($portfolio->project_url)
                            <a href="{{ $portfolio->project_url }}" 
                               target="_blank" 
                               class="absolute top-0 right-0 m-4 bg-yellow-500 text-white px-6 py-3 rounded-full hover:bg-yellow-600 transition-colors inline-flex items-center">
                                <i class="fas fa-external-link-alt mr-2"></i>Visit Project
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Project Details -->
                <div class="animate-fade-in">
                    <div class="h-full">
                        <h2 class="text-4xl md:text-5xl font-bold mb-6">{{ $portfolio->title }}</h2>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                            <div>
                                <h6 class="text-blue-600 font-semibold text-sm uppercase mb-2">Client</h6>
                                <p class="text-gray-700">{{ $portfolio->client ?? 'Confidential' }}</p>
                            </div>
                            <div>
                                <h6 class="text-blue-600 font-semibold text-sm uppercase mb-2">Completion Date</h6>
                                <p class="text-gray-700">{{ $portfolio->completion_date->format('F Y') }}</p>
                            </div>
                            <div>
                                <h6 class="text-blue-600 font-semibold text-sm uppercase mb-2">Category</h6>
                                <p class="text-gray-700">{{ $portfolio->category }}</p>
                            </div>
                            @if($portfolio->technologies)
                            <div>
                                <h6 class="text-blue-600 font-semibold text-sm uppercase mb-2">Technologies Used</h6>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($portfolio->technologies as $tech)
                                        <span class="bg-blue-600 text-white text-xs px-3 py-1 rounded-full">{{ $tech }}</span>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="mb-6">
                            <h5 class="text-blue-600 font-semibold text-xl mb-3">Project Overview</h5>
                            <p class="text-lg text-gray-700 leading-relaxed mb-4">{{ $portfolio->description }}</p>
                        </div>

                        <div class="mb-6">
                            <h5 class="text-blue-600 font-semibold text-xl mb-3">Work Done</h5>
                            <p class="text-gray-700 leading-relaxed">{{ $portfolio->work_done }}</p>
                        </div>

                        <div class="mt-8 p-6 bg-gray-50 rounded-lg">
                            <h4 class="text-2xl font-bold mb-3">Start Your Project with Us</h4>
                            <p class="text-gray-600 mb-4">Interested in working with us? Let's discuss your project and create something amazing together.</p>
                            <a href="{{ route('contact') }}" class="inline-block bg-blue-600 text-white px-8 py-4 rounded-full font-semibold hover:bg-blue-700 transition-colors">
                                Get Started
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @if($relatedPortfolios->isNotEmpty())
            <!-- Related Projects Start -->
            <div class="mt-20 pt-12 border-t border-gray-200">
                <div class="text-center mx-auto pb-12 max-w-2xl">
                    <h5 class="text-blue-600 text-lg font-semibold mb-2">More Projects</h5>
                    <h1 class="text-4xl md:text-5xl text-yellow-500 font-bold">Similar Projects</h1>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($relatedPortfolios as $relatedPortfolio)
                        <div class="group">
                            <div class="transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">
                                <div class="relative overflow-hidden rounded-t-lg">
                                    <img src="{{ asset($relatedPortfolio->image_url) }}" 
                                         class="w-full h-64 object-cover" 
                                         alt="{{ $relatedPortfolio->title }}">
                                    <div class="absolute inset-0 bg-black bg-opacity-70 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
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
            <div class="mt-20 pt-12 border-t border-gray-200">
                <div class="text-center mx-auto pb-12 max-w-2xl">
                    <h5 class="text-blue-600 text-lg font-semibold mb-2">Gallery</h5>
                    <h1 class="text-4xl md:text-5xl text-yellow-500 font-bold">More Media</h1>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($portfolio->media as $media)
                        @php
                            $mType = $media->media_type;
                            $mSrc = $media->media_path ? asset('storage/' . ltrim($media->media_path, '/')) : null;
                            $mEmbed = \App\Models\Portfolio::embedSrcFromRaw($media->media_embed);
                        @endphp
                        <div class="bg-gray-50 rounded-lg overflow-hidden shadow">
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
            <div class="text-center mt-12">
                <a href="{{ route('portfolios.index') }}" class="text-blue-600 hover:text-blue-800 transition-colors inline-flex items-center text-lg">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Portfolio
                </a>
            </div>
        </div>
    </div>
    <!-- Portfolio Details End -->
@endsection
