@extends('layouts.app')

@section('title', 'Audio-Visual Production & Livestreaming in Uganda | ByteWave')
@section('meta_description', 'Professional video production, event livestreaming, photography and multimedia services in Kampala, Uganda from ByteWave Investments.')

@section('content')
    <!-- Page Header Start -->
    <div class="relative bg-cover bg-center py-20" style="background: linear-gradient(rgba(11, 31, 51, 0.5), rgba(11, 31, 51, 0.5)), url('/service_images/bytewave_audio_visual.jpg') center center no-repeat; background-size: cover;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-12">
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 animate-fadeInDown">Audio-Visual Production</h1>
            <nav aria-label="breadcrumb" class="animate-fadeInDown">
                <ol class="flex justify-center items-center space-x-2 text-white">
                    <li><a class="hover:underline transition-colors" href="{{ url('/') }}">Home</a></li>
                    <li class="before:content-['/'] before:mx-2"><a class="hover:underline transition-colors" href="{{ route('services.index') }}">Services</a></li>
                    <li class="before:content-['/'] before:mx-2">Audio-Visual Production</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        
        <!-- Overview Section -->
        <div class="mb-16">
            <div class="flex items-center mb-6">
                <span class="w-1 h-12 bg-bytewave-blue mr-4"></span>
                <h2 class="text-4xl font-bold text-bytewave-ink">Overview</h2>
            </div>
            <p class="text-xl text-bytewave-ink leading-relaxed">
                At BYTEWAVE, we bring your vision to life through professional audio-visual production services. 
                From concept to completion, we deliver high-quality video content, live streaming solutions, and 
                post-production excellence that engages your audience and elevates your brand.
            </p>
        </div>

        <!-- What We Offer Section -->
        <div class="mb-16">
            <div class="flex items-center mb-8">
                <span class="w-1 h-12 bg-bytewave-blue mr-4"></span>
                <h2 class="text-4xl font-bold text-bytewave-ink">What We Offer</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Video Production -->
                <div class="bg-bytewave-blue/5 p-8 rounded-2xl border border-bytewave-blue/20 hover:shadow-xl transition-all duration-300 group">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-16 h-16 bg-bytewave-blue rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-video text-white text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-bytewave-ink mb-2">Video Production</h3>
                            <p class="text-bytewave-ink/70 mb-4">Professional video creation from start to finish</p>
                        </div>
                    </div>
                    <ul class="space-y-3">
                        <li class="flex items-start text-bytewave-ink">
                            <i class="fas fa-check-circle text-bytewave-blue mt-1 mr-3 flex-shrink-0"></i>
                            <span>Corporate videos & promotional content</span>
                        </li>
                        <li class="flex items-start text-bytewave-ink">
                            <i class="fas fa-check-circle text-bytewave-blue mt-1 mr-3 flex-shrink-0"></i>
                            <span>Event coverage & documentation</span>
                        </li>
                        <li class="flex items-start text-bytewave-ink">
                            <i class="fas fa-check-circle text-bytewave-blue mt-1 mr-3 flex-shrink-0"></i>
                            <span>Training & educational videos</span>
                        </li>
                        <li class="flex items-start text-bytewave-ink">
                            <i class="fas fa-check-circle text-bytewave-blue mt-1 mr-3 flex-shrink-0"></i>
                            <span>Product demonstrations</span>
                        </li>
                    </ul>
                </div>

                <!-- Live Streaming -->
                <div class="bg-bytewave-blue/5 p-8 rounded-2xl border border-bytewave-blue/20 hover:shadow-xl transition-all duration-300 group">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-16 h-16 bg-bytewave-blue rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-broadcast-tower text-white text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-bytewave-ink mb-2">Live Streaming</h3>
                            <p class="text-bytewave-ink/70 mb-4">Real-time broadcasting for your events</p>
                        </div>
                    </div>
                    <ul class="space-y-3">
                        <li class="flex items-start text-bytewave-ink">
                            <i class="fas fa-check-circle text-bytewave-blue mt-1 mr-3 flex-shrink-0"></i>
                            <span>Real-time event broadcasting</span>
                        </li>
                        <li class="flex items-start text-bytewave-ink">
                            <i class="fas fa-check-circle text-bytewave-blue mt-1 mr-3 flex-shrink-0"></i>
                            <span>Webinars & virtual conferences</span>
                        </li>
                        <li class="flex items-start text-bytewave-ink">
                            <i class="fas fa-check-circle text-bytewave-blue mt-1 mr-3 flex-shrink-0"></i>
                            <span>Social media live sessions</span>
                        </li>
                        <li class="flex items-start text-bytewave-ink">
                            <i class="fas fa-check-circle text-bytewave-blue mt-1 mr-3 flex-shrink-0"></i>
                            <span>Multi-platform streaming</span>
                        </li>
                    </ul>
                </div>

                <!-- Post-Production -->
                <div class="bg-bytewave-blue/5 p-8 rounded-2xl border border-bytewave-blue/20 hover:shadow-xl transition-all duration-300 group">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-16 h-16 bg-bytewave-blue rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-film text-white text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-bytewave-ink mb-2">Post-Production</h3>
                            <p class="text-bytewave-ink/70 mb-4">Polish your content to perfection</p>
                        </div>
                    </div>
                    <ul class="space-y-3">
                        <li class="flex items-start text-bytewave-ink">
                            <i class="fas fa-check-circle text-bytewave-blue mt-1 mr-3 flex-shrink-0"></i>
                            <span>Video editing & color grading</span>
                        </li>
                        <li class="flex items-start text-bytewave-ink">
                            <i class="fas fa-check-circle text-bytewave-blue mt-1 mr-3 flex-shrink-0"></i>
                            <span>Audio mixing & enhancement</span>
                        </li>
                        <li class="flex items-start text-bytewave-ink">
                            <i class="fas fa-check-circle text-bytewave-blue mt-1 mr-3 flex-shrink-0"></i>
                            <span>Motion graphics & animations</span>
                        </li>
                        <li class="flex items-start text-bytewave-ink">
                            <i class="fas fa-check-circle text-bytewave-blue mt-1 mr-3 flex-shrink-0"></i>
                            <span>Visual effects</span>
                        </li>
                    </ul>
                </div>

                <!-- Photography -->
                <div class="bg-bytewave-blue/5 p-8 rounded-2xl border border-bytewave-blue/20 hover:shadow-xl transition-all duration-300 group">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-16 h-16 bg-bytewave-success rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-camera text-white text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-bytewave-ink mb-2">Photography</h3>
                            <p class="text-bytewave-ink/70 mb-4">Capture moments that matter</p>
                        </div>
                    </div>
                    <ul class="space-y-3">
                        <li class="flex items-start text-bytewave-ink">
                            <i class="fas fa-check-circle text-bytewave-blue mt-1 mr-3 flex-shrink-0"></i>
                            <span>Event photography</span>
                        </li>
                        <li class="flex items-start text-bytewave-ink">
                            <i class="fas fa-check-circle text-bytewave-blue mt-1 mr-3 flex-shrink-0"></i>
                            <span>Corporate headshots</span>
                        </li>
                        <li class="flex items-start text-bytewave-ink">
                            <i class="fas fa-check-circle text-bytewave-blue mt-1 mr-3 flex-shrink-0"></i>
                            <span>Product photography</span>
                        </li>
                        <li class="flex items-start text-bytewave-ink">
                            <i class="fas fa-check-circle text-bytewave-blue mt-1 mr-3 flex-shrink-0"></i>
                            <span>Professional photo editing</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Why Choose Us Section -->
        <div class="mb-16 bg-bytewave-blue/5 p-12 rounded-2xl">
            <div class="flex items-center mb-8">
                <span class="w-1 h-12 bg-bytewave-blue mr-4"></span>
                <h2 class="text-4xl font-bold text-bytewave-ink">Why Choose BYTEWAVE?</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-20 h-20 bg-bytewave-blue rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-award text-white text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-bytewave-ink mb-2">Professional Quality</h3>
                    <p class="text-bytewave-ink/70">Industry-standard equipment and experienced professionals</p>
                </div>
                
                <div class="text-center">
                    <div class="w-20 h-20 bg-bytewave-blue rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-clock text-white text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-bytewave-ink mb-2">Timely Delivery</h3>
                    <p class="text-bytewave-ink/70">We respect deadlines and deliver on time, every time</p>
                </div>
                
                <div class="text-center">
                    <div class="w-20 h-20 bg-bytewave-blue rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-lightbulb text-white text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-bytewave-ink mb-2">Creative Excellence</h3>
                    <p class="text-bytewave-ink/70">Innovative storytelling that captivates your audience</p>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-bytewave-blue rounded-2xl p-12 text-center text-white">
            <h2 class="text-4xl font-bold mb-4">Ready to Bring Your Vision to Life?</h2>
            <p class="text-xl mb-8 text-white">Let's create something amazing together. Contact us today to discuss your project.</p>
            <x-cta-button :href="route('contact')" text="Get Started" variant="light" />
        </div>

        <!-- Back Button -->
        <div class="mt-12">
            <a href="{{ route('services.index') }}" 
               class="inline-flex items-center text-bytewave-blue hover:text-bytewave-ink font-semibold transition-colors duration-300">
                <i class="fas fa-arrow-left mr-2"></i>Back to Services
            </a>
        </div>
    </div>
@endsection

@section('styles')
<style>
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fadeInDown {
        animation: fadeInDown 0.6s ease-out;
    }
</style>
@endsection
