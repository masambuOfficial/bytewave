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

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Saira:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <!-- Vite TailwindCSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    @yield('styles')
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">
    <meta name="msapplication-TileImage" content="{{ asset('favicon.png') }}">

    <style>
        /* Animation Classes */
        .fadeInUp {
            animation: fadeInUp 1s ease-out;
        }
        
        .fadeInLeft {
            animation: fadeInLeft 1s ease-out;
        }
        
        .fadeInRight {
            animation: fadeInRight 1s ease-out;
        }
        
        .fadeInDown {
            animation: fadeInDown 1s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
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

        /* Utility Classes */
        .wow {
            visibility: hidden;
        }
        
        .animated {
            animation-duration: 1s;
            animation-fill-mode: both;
        }


        .hero-carousel-container {
            position: relative;
            overflow: hidden;
        }
        
        .carousel-image-container {
            position: relative;
            height: 80vh;
            min-height: 600px;
            overflow: hidden;
        }
        
        .carousel-image-container img {
            object-fit: cover;
            height: 100%;
            width: 100%;
        }
        
        .carousel-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(0,0,0,0.5) 0%, rgba(0,0,0,0.3) 50%, rgba(0,0,0,0.1) 100%);
        }
        
       
        
        /* Enhanced carousel controls */
        .carousel-control-prev,
        .carousel-control-next {
            width: 80px;
            height: 80px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
            margin: 0 20px;
            opacity: 0.7;
            transition: all 0.3s ease;
        }
        
        .carousel-control-prev {
            left: 100px;
        }
        
        .carousel-control-next {
            right: 100px;
        }
        
        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            background-color: rgba(255, 255, 255, 0.3);
            opacity: 1;
            transform: translateY(-50%) scale(1.05);
        }
        
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            width: 30px;
            height: 30px;
            background-size: 30px;
        }
        
        /* Responsive adjustments */
        @media (max-width: 992px) {
            .carousel-control-prev,
            .carousel-control-next {
                width: 60px;
                height: 60px;
                margin: 0 10px;
               
            }
            
            .carousel-control-prev-icon,
            .carousel-control-next-icon {
                width: 25px;
                height: 25px;
                background-size: 25px;
                
            }
            
            .carousel-title {
                font-size: 2.5rem;
            }
            
            .carousel-control-prev {
                left: 50px;
            }
        
            .carousel-control-next {
                right: 50px;
            }
        }
        
        @media (max-width: 768px) {
            .carousel-control-prev,
            .carousel-control-next {
                width: 50px;
                height: 50px;
                margin: 0 5px;
            }
            
            .carousel-control-prev-icon,
            .carousel-control-next-icon {
                width: 20px;
                height: 20px;
                background-size: 20px;
            }
            
            .carousel-title {
                font-size: 2rem;
            }
            
            .carousel-text {
                font-size: 1rem;
            }
        }
        
        /* Carousel indicator improvements */
        .carousel-indicators button {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin: 0 6px;
            background-color: rgba(255, 255, 255, 0.5);
            border: none;
        }
        
        .carousel-indicators button.active {
            background-color: #fff;
        }

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