<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @hasSection('title')
            @yield('title')
        @else
            BYTEWAVE
        @endif
    </title>

    <!-- Primary Meta Tags -->
    <meta name="description" content="@yield('meta_description', 'ByteWave Investments — Empowering smart financial and digital growth through innovation, insights, and technology.')">
    <meta name="author" content="ByteWave Investments">
    <link rel="canonical" href="@yield('canonical', url()->current())">

    <!-- Open Graph (Facebook, LinkedIn) -->
    <meta property="og:title" content="@yield('og_title', trim($__env->yieldContent('title', 'BYTEWAVE')))">
    <meta property="og:description" content="@yield('og_description', 'Empowering MSMEs to achieve smart digital growth by providing affordable ICT and multimedia solutions driven by innovation and technology.')">
    <meta property="og:image" content="@yield('og_image', asset('favicon.png'))">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:type" content="@yield('og_type', 'website')">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="@yield('twitter_card', 'summary_large_image')">
    <meta name="twitter:title" content="@yield('og_title', trim($__env->yieldContent('title', 'BYTEWAVE')))">
    <meta name="twitter:description" content="@yield('og_description', 'Empowering MSMEs to achieve smart digital growth by providing affordable ICT and multimedia solutions driven by innovation and technology.')">
    <meta name="twitter:image" content="@yield('og_image', asset('favicon.png'))">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mona+Sans:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Vite TailwindCSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <!-- Lenis Smooth Scroll -->
    <script src="https://unpkg.com/@studio-freight/lenis@1.0.42/dist/lenis.min.js"></script>
    
    <!-- Framer Motion (via CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/framer-motion@11/dist/framer-motion.js"></script>
    
    <!-- Alpine.js with Collapse Plugin -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    @yield('styles')
    
    <!-- ✅ Favicon (All Devices + Crawlers) -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">
    <meta name="msapplication-TileImage" content="{{ asset('favicon.png') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- ✅ Structured Data for Google/AI engines (LocalBusiness Schema, sourced from config/company.php) -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "LocalBusiness",
      "name": @json(config('company.name')),
      "url": "https://bytewaveinvestments.com/",
      "logo": @json(asset(config('company.logo'))),
      "image": @json(asset(config('company.logo'))),
      "telephone": @json(config('company.phone')),
      "email": @json(config('company.email')),
      "address": {
        "@type": "PostalAddress",
        "streetAddress": @json(config('company.address2') . ', ' . config('company.address3')),
        "postOfficeBoxNumber": @json(config('company.address')),
        "addressLocality": "Kampala",
        "addressCountry": "UG"
      },
      "sameAs": [
        "https://www.facebook.com/bytewaveinvestments",
        "https://www.linkedin.com/company/bytewaveinvestments"
      ]
    }
    </script>

    @stack('schema')

    <style>
        /* Your existing custom styles remain unchanged */
        /* (Keep all fadeIn, carousel, and responsive styles here) */
        
        /* Hide scrollbar for horizontal scroll */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Logo Ticker Animation */
        .logo-ticker {
            display: flex;
            overflow: hidden;
            user-select: none;
        }

        .logo-track {
            display: flex;
            gap: 3rem;
            animation: scroll 40s linear infinite;
            will-change: transform;
        }

        .logo-track:hover {
            animation-play-state: paused;
        }

        .logo-item {
            flex-shrink: 0;
            width: 10rem;
            height: 6rem;
            background-color: white;
            border-radius: 0.5rem;
            padding: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            filter: grayscale(100%);
            transition: all 0.3s ease;
            border: 1px solid rgba(229, 231, 235, 1);
        }

        .logo-item:hover {
            filter: grayscale(0%);
            border-color: rgba(147, 197, 253, 1);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            transform: scale(1.05);
        }

        @keyframes scroll {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }

        @media (max-width: 768px) {
            .logo-item {
                width: 8rem;
                height: 5rem;
            }
            
            .logo-track {
                gap: 2rem;
            }
        }
    </style>
</head>

<body style="background-color: #F6F6F6;">
    @include('layouts.partials.header')

    <main>
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Animation Script -->
    <script>
        // Simple WOW.js alternative
        function initWow() {
            const elements = document.querySelectorAll('.wow');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animated');
                        entry.target.style.visibility = 'visible';
                        observer.unobserve(entry.target);
                    }
                });
            });

            elements.forEach(el => observer.observe(el));
        }

        // Initialize animations
        document.addEventListener('DOMContentLoaded', initWow);
    </script>

    <!-- Initialize Lenis Smooth Scroll -->
    <script>
        // Initialize Lenis
        const lenis = new Lenis({
            duration: 1,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
            direction: 'vertical',
            gestureDirection: 'vertical',
            smooth: true,
            mouseMultiplier: 1,
            smoothTouch: false,
            touchMultiplier: 2,
            infinite: false,
            lerp: 0.1,
        });

        // Animation frame loop with timestamp
        function raf(time) {
            lenis.raf(time);
            requestAnimationFrame(raf);
        }

        // Start the loop
        requestAnimationFrame(raf);

        // Anchor link smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    lenis.scrollTo(target, { offset: 0, duration: 1.5 });
                }
            });
        });
    </script>

    @yield('scripts')
</body>
</html>