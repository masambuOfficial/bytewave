@extends('layouts.app')

@section('title', 'About Us - BYTEWAVE')

@section('content')

    <!-- Page Header Start -->
    <header class="relative bg-cover bg-center py-20 mb-12" style="background: linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)), url('{{ asset('images/bytewave_computer_repair_and_maintenance.jpg') }}') center center no-repeat; background-size: cover;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-12">
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-bytewave-gold mb-6 animate-fadeInDown">Technology and Media, Moving Together</h1>
            <nav aria-label="breadcrumb" class="animate-fadeInDown">
                <ol class="flex justify-center items-center space-x-2 text-white text-lg">
                    <li><a href="{{ url('/') }}" class="hover:text-bytewave-gold transition-colors">Home</a></li>
                    <li class="text-white/50" aria-hidden="true">/</li>
                    <li class="text-bytewave-gold" aria-current="page">About</li>
                </ol>
            </nav>
        </div>
    </header>
    <!-- Page Header End -->

    <!-- About Story Start -->
    <section class="py-12 md:py-20" aria-labelledby="about-heading">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <div class="reveal">
                    <img src="{{ asset('images/bytewave_livestreaming_about_us.png') }}" alt="BYTEWAVE livestreaming and audio-visual production" class="w-full h-auto rounded-xl">
                </div>
                <div class="reveal">
                    <p class="text-bytewave-blue font-semibold text-base uppercase tracking-wider mb-4">About Us</p>
                    <h2 id="about-heading" class="text-3xl md:text-4xl font-bold text-bytewave-gold mb-6">About BYTEWAVE and Its Work</h2>
                    <div class="text-gray-600 text-lg leading-relaxed space-y-4 mb-8">
                        <p>The name says it: a byte of computing, a wave of sound and image.</p>
                        <p>BYTEWAVE was born from a simple observation — large companies have IT departments and budgets to match, while small and medium businesses compete in the same market without any of that. We started BYTEWAVE to close that gap.</p>
                        <p>Incorporated in 2024, our work now spans software engineering, web development, booking and event systems, livestreaming, audio-visual production, photography, brand identity, and ICT supply. Our flagship eBusiness Eco-Tour Portal connects over 200 artisans, homestays, and community tourism enterprises from Bwindi and Kibale to the global market. Our HESFB portal serves 20,000+ students. Our Likana Safaris booking system runs daily for a live tour operator. And our Ayad Learning System is currently in development.</p>
                        <blockquote class="border-l-4 border-bytewave-gold bg-bytewave-gold-50 rounded-r-lg px-6 py-4 text-xl font-semibold text-bytewave-blue-800 italic">
                            &ldquo;Real problems, solved properly, on time.&rdquo;
                        </blockquote>
                        <p>We compete on three things: speed, close customer care, and pricing that makes sense for growing organizations. Our team is a network of skilled freelancers and specialists, assembled to fit each project — keeping us fast, flexible, and cost-effective.</p>
                        <p>Based in Kampala, we deliver across Uganda, East Africa, and beyond. Our vision: to be a leading ICT and multimedia partner for organizations across Africa.</p>
                    </div>
                    <a href="{{ url('/contact') }}" class="inline-block bg-bytewave-blue text-white font-semibold px-8 py-3 rounded-full hover:bg-bytewave-gold transition-all duration-300 hover:scale-105 shadow-lg">Contact Us</a>
                </div>
            </div>
        </div>
    </section>
    <!-- About Story End -->

    <!-- What We Do Start -->
    <section class="py-12 md:py-20 bg-gray-50" aria-labelledby="services-heading">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 id="services-heading" class="reveal text-3xl md:text-4xl font-bold text-bytewave-gold text-center mb-12">What We Do</h2>
            <div class="reveal-group grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <x-about.service-card label="Software Engineering">
                    <x-slot:icon><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></x-slot:icon>
                </x-about.service-card>
                <x-about.service-card label="Web Development">
                    <x-slot:icon><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></x-slot:icon>
                </x-about.service-card>
                <x-about.service-card label="Booking & Event Systems">
                    <x-slot:icon><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/></x-slot:icon>
                </x-about.service-card>
                <x-about.service-card label="Livestreaming & AV Production">
                    <x-slot:icon><path d="m16 13 5.223 3.482a.5.5 0 0 0 .777-.416V7.87a.5.5 0 0 0-.752-.432L16 10.5"/><rect x="2" y="6" width="14" height="12" rx="2"/></x-slot:icon>
                </x-about.service-card>
                <x-about.service-card label="Photography & Brand Identity">
                    <x-slot:icon><path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"/><circle cx="12" cy="13" r="3"/></x-slot:icon>
                </x-about.service-card>
                <x-about.service-card label="ICT Equipment Supply">
                    <x-slot:icon><rect width="20" height="14" x="2" y="3" rx="2"/><line x1="8" x2="16" y1="21" y2="21"/><line x1="12" x2="12" y1="17" y2="21"/></x-slot:icon>
                </x-about.service-card>
            </div>
        </div>
    </section>
    <!-- What We Do End -->

    <!-- Proof In Numbers -->
    <x-about.stats-band />

    <!-- Flagship Work Start -->
    <section class="py-12 md:py-20" aria-labelledby="flagship-heading">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 id="flagship-heading" class="reveal text-3xl md:text-4xl font-bold text-bytewave-gold text-center mb-12">Flagship Work</h2>
            <div class="reveal-group grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <x-about.project-card
                    title="eBusiness Eco-Tour Portal"
                    description="Connecting 200+ artisans, homestays, and community tourism enterprises from Bwindi and Kibale to the global market."
                    :image="asset('clients/e-betp-logo.png')" />
                <x-about.project-card
                    title="HESFB Student Portal"
                    description="Serving 20,000+ students with loan scheme information and registration on any device."
                    :image="asset('clients/HESFB_logo-trimmed.png')" />
                <x-about.project-card
                    title="UVTAB Livestream"
                    description="Live broadcast of the May/June 2025 assessment results release."
                    :image="asset('clients/UVTAB-logo-trimmed.png')" />
            </div>
            <div class="reveal text-center mt-10">
                <a href="{{ route('portfolios.index') }}" class="inline-flex items-center gap-2 text-bytewave-blue font-semibold hover:text-bytewave-gold transition-colors duration-300">
                    View All Projects
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>
    </section>
    <!-- Flagship Work End -->

    <!-- Who We Serve Start -->
    <section class="py-12 md:py-20 bg-gray-50" aria-labelledby="clients-heading">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 id="clients-heading" class="reveal text-3xl md:text-4xl font-bold text-bytewave-gold text-center mb-12">Trusted By</h2>
            <ul class="reveal-group flex flex-wrap justify-center gap-3 md:gap-4">
                <x-about.client-pill>Likana Safaris Uganda</x-about.client-pill>
                <x-about.client-pill>Ayad Consults International</x-about.client-pill>
                <x-about.client-pill>Uganda Institution of Professional Engineers</x-about.client-pill>
                <x-about.client-pill>Higher Education Students' Financing Board</x-about.client-pill>
                <x-about.client-pill>IGAD</x-about.client-pill>
                <x-about.client-pill>Flourish Hub</x-about.client-pill>
                <x-about.client-pill>Kafu Prime Cuts</x-about.client-pill>
                <x-about.client-pill>UVTAB</x-about.client-pill>
                <x-about.client-pill>Winner Global Enterprises</x-about.client-pill>
            </ul>
        </div>
    </section>
    <!-- Who We Serve End -->

    <!-- Team Start -->
    <section class="py-12 md:py-20" aria-labelledby="team-heading">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="reveal text-center mx-auto max-w-2xl mb-12">
                <p class="text-bytewave-blue font-semibold text-base uppercase tracking-wider mb-4">Our Team</p>
                <h2 id="team-heading" class="text-3xl md:text-4xl font-bold text-bytewave-gold">Our Leadership</h2>
            </div>

            <div class="reveal-group grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                @php
                    $leaders = [
                        ['name' => 'Masambu Emanuel', 'role' => 'Managing Director', 'bio' => 'Leads strategy, client partnerships, and project delivery.', 'photo' => asset('images/masambu_emmanuel.png')],
                        ['name' => 'Kasaija Gavin', 'role' => 'Business Manager', 'bio' => 'Leads operations, business development, and client relationships.', 'photo' => asset('images/gavin_kasaija.png')],
                    ];
                @endphp

                @foreach ($leaders as $leader)
                    <div class="reveal group">
                        <div class="relative overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500">
                            <!-- Image with grayscale effect -->
                            <img src="{{ $leader['photo'] }}"
                                 class="w-full h-96 object-contain grayscale group-hover:grayscale-0 transition-all duration-500"
                                 alt="{{ $leader['name'] }}" loading="lazy">

                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>

                            <!-- Content -->
                            <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                <h3 class="text-2xl font-bold mb-1">{{ $leader['name'] }}</h3>
                                <p class="text-bytewave-gold font-medium mb-2">{{ $leader['role'] }}</p>
                                <p class="text-gray-200 mb-4">{{ $leader['bio'] }}</p>

                                <!-- Social Icons -->
                                <div class="flex gap-3 md:opacity-0 md:group-hover:opacity-100 md:transform md:translate-y-4 md:group-hover:translate-y-0 transition-all duration-500">
                                    <a class="w-10 h-10 bg-white text-bytewave-blue rounded-full flex items-center justify-center hover:bg-bytewave-gold hover:text-white hover:scale-110 transition-all duration-300" href="#" aria-label="Facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a class="w-10 h-10 bg-white text-bytewave-blue rounded-full flex items-center justify-center hover:bg-bytewave-gold hover:text-white hover:scale-110 transition-all duration-300" href="#" aria-label="Twitter">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a class="w-10 h-10 bg-white text-bytewave-blue rounded-full flex items-center justify-center hover:bg-bytewave-gold hover:text-white hover:scale-110 transition-all duration-300" href="#" aria-label="Instagram">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                    <a class="w-10 h-10 bg-white text-bytewave-blue rounded-full flex items-center justify-center hover:bg-bytewave-gold hover:text-white hover:scale-110 transition-all duration-300" href="#" aria-label="LinkedIn">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Team End -->

    <!-- CTA Banner Start -->
    <section class="bg-bytewave-blue py-16 md:py-20" aria-labelledby="cta-heading">
        <div class="reveal max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row md:items-center md:justify-between gap-8 text-center md:text-left">
            <div>
                <h2 id="cta-heading" class="text-3xl md:text-4xl font-bold text-white mb-3">Have a project in mind?</h2>
                <p class="text-xl text-bytewave-blue-100">Let's build something that works.</p>
            </div>
            <div class="flex-shrink-0">
                <x-cta-button :href="url('/contact')" text="Contact Us" bgColor="bg-bytewave-gold" hoverBgColor="hover:bg-bytewave-gold-500" textColor="text-bytewave-blue-900" arrowBgColor="bg-white" arrowColor="text-bytewave-blue" />
            </div>
        </div>
    </section>
    <!-- CTA Banner End -->

@endsection

@section('styles')
<style>
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .animate-fadeInDown {
        animation: fadeInDown 0.6s ease-out;
    }

    /* Scroll reveal: only hides content once JS has confirmed it can reveal it again */
    .reveal-ready .reveal {
        opacity: 0;
        transform: translateY(24px);
        transition: opacity 0.7s ease-out, transform 0.7s ease-out;
    }

    .reveal-ready .reveal.is-visible {
        opacity: 1;
        transform: none;
    }

    .reveal-ready .reveal-group > .reveal:nth-child(2) { transition-delay: 0.1s; }
    .reveal-ready .reveal-group > .reveal:nth-child(3) { transition-delay: 0.2s; }
    .reveal-ready .reveal-group > .reveal:nth-child(4) { transition-delay: 0.3s; }
    .reveal-ready .reveal-group > .reveal:nth-child(n+5) { transition-delay: 0.4s; }

    @media (prefers-reduced-motion: reduce) {
        .reveal-ready .reveal {
            opacity: 1;
            transform: none;
            transition: none;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (!('IntersectionObserver' in window)) {
            return;
        }

        document.documentElement.classList.add('reveal-ready');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });

        document.querySelectorAll('.reveal').forEach((el) => observer.observe(el));
    });
</script>
@endsection
