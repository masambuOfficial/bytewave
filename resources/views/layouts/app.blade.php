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
    <meta name="description" content="ByteWave Investments — Empowering smart financial and digital growth through innovation, insights, and technology.">
    <meta name="author" content="ByteWave Investments">

    <!-- Open Graph (Facebook, LinkedIn) -->
    <meta property="og:title" content="BYTEWAVE">
    <meta property="og:description" content="Empowering MSMEs to achieve smart digital growth by providing affordable ICT and multimedia solutions driven by innovation and technology.">
    <meta property="og:image" content="{{ asset('favicon.png') }}">
    <meta property="og:url" content="https://bytewaveinvestments.com/">
    <meta property="og:type" content="website">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="BYTEWAVE">
    <meta name="twitter:description" content="Empowering MSMEs to achieve smart digital growth by providing affordable ICT and multimedia solutions driven by innovation and technology.">
    <meta name="twitter:image" content="{{ asset('favicon.png') }}">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Vite TailwindCSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
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

    <!-- ✅ Structured Data for Google (Organization Schema) -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "ByteWave Investments",
      "url": "https://bytewaveinvestments.com/",
      "logo": "https://bytewaveinvestments.com/favicon.png",
      "sameAs": [
        "https://www.facebook.com/bytewaveinvestments",
        "https://www.linkedin.com/company/bytewaveinvestments"
      ]
    }
    </script>

    <style>
        /* Your existing custom styles remain unchanged */
        /* (Keep all fadeIn, carousel, and responsive styles here) */
    </style>
</head>

<body>
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

    @yield('scripts')
</body>
</html>