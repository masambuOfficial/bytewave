@extends('layouts.app')

@section('title', 'About Us - BYTEWAVE')

@section('content')

    <!-- Page Header Start -->
    <div class="relative bg-cover bg-center py-20 mb-12" style="background: linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)), url('{{ asset('css/img/bytewave_computer_repair_and_maintenance.jpg') }}') center center no-repeat; background-size: cover;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-12">
            <h1 class="text-5xl md:text-6xl font-bold text-bytewave-gold mb-6 animate-fadeInDown">About Us</h1>
            <nav aria-label="breadcrumb" class="animate-fadeInDown">
                <ol class="flex justify-center items-center space-x-2 text-white text-lg">
                    <li><a href="{{ url('/') }}" class="hover:text-bytewave-gold transition-colors">Home</a></li>
                    <li class="text-white/50">/</li>
                    <li class="text-bytewave-gold" aria-current="page">About</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->



    <!-- About Start -->
    <div class="py-12 md:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <div class="animate-fadeIn">
                    <div class="relative h-full">
                        <img src="{{ asset('css/img/bytewave_livestreaming_about_us.png') }}" alt="BYTEWAVE Office">
                    </div>
                </div>
                <div class="animate-fadeIn">
                    <h5 class="text-bytewave-blue font-semibold text-base uppercase tracking-wider mb-4">About Us</h5>
                    <h1 class="text-3xl md:text-4xl font-bold text-bytewave-gold mb-6">About BYTEWAVE And Its Innovative IT Solutions</h1>
                    <div class="text-justify">
                        <p class="text-gray-600 text-lg mb-4 leading-relaxed">At BYTEWAVE, we are passionate about leveraging technology to empower businesses and drive
                        innovation. Founded by Masambu Emanuel and Kasaija Gavin, we bring together a team of experts
                        dedicated to providing cutting-edge IT solutions tailored to your unique needs.</p>
                    <p class="text-gray-600 text-lg mb-8 leading-relaxed">We believe in building strong partnerships with our clients, working closely with
                        you to understand your challenges and goals. Our commitment to excellence and customer
                        satisfaction sets us apart. Let us help you navigate the ever-evolving digital landscape and
                        achieve sustainable growth.</p>
                    </div>
                    <a href="{{ url('/contact') }}" class="inline-block bg-bytewave-blue text-white font-semibold px-8 py-3 rounded-full hover:bg-bytewave-gold transition-all duration-300 hover:scale-105 shadow-lg">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Team Start -->
    <div class="py-12 md:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mx-auto max-w-2xl mb-12 animate-fadeIn">
                <h5 class="text-bytewave-blue font-semibold text-base uppercase tracking-wider mb-4">Our Team</h5>
                <h1 class="text-3xl md:text-4xl font-bold text-bytewave-gold">Meet Our Expert Team</h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8 max-w-5xl mx-auto">
                <!-- Masambu Emanuel -->
                <div class="animate-fadeIn group">
                    <div class="relative overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500">
                        <!-- Image with grayscale effect -->
                        <img src="{{ asset('masambu_emmanuel.png') }}" 
                             class="w-full h-96 object-contain grayscale group-hover:grayscale-0 transition-all duration-500"
                             alt="Masambu Emanuel">
                        
                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                        
                        <!-- Content -->
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h4 class="text-2xl font-bold mb-1">Masambu Emanuel</h4>
                            <p class="text-gray-300 mb-4">Managing Director</p>
                            
                            <!-- Social Icons -->
                            <div class="flex gap-3 opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                                <a class="w-10 h-10 bg-white text-bytewave-blue rounded-full flex items-center justify-center hover:bg-bytewave-gold hover:text-white hover:scale-110 transition-all duration-300" href="#">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a class="w-10 h-10 bg-white text-bytewave-blue rounded-full flex items-center justify-center hover:bg-bytewave-gold hover:text-white hover:scale-110 transition-all duration-300" href="#">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a class="w-10 h-10 bg-white text-bytewave-blue rounded-full flex items-center justify-center hover:bg-bytewave-gold hover:text-white hover:scale-110 transition-all duration-300" href="#">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a class="w-10 h-10 bg-white text-bytewave-blue rounded-full flex items-center justify-center hover:bg-bytewave-gold hover:text-white hover:scale-110 transition-all duration-300" href="#">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kasaija Gavin -->
                <div class="animate-fadeIn group">
                    <div class="relative overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500">
                        <!-- Image with grayscale effect -->
                        <img src="{{ asset('gavin_kasaija.png') }}" 
                             class="w-full h-96 object-contain grayscale group-hover:grayscale-0 transition-all duration-500"
                             alt="Kasaija Gavin">
                        
                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                        
                        <!-- Content -->
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h4 class="text-2xl font-bold mb-1">Kasaija Gavin</h4>
                            <p class="text-gray-300 mb-4">Business Manager</p>
                            
                            <!-- Social Icons -->
                            <div class="flex gap-3 opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                                <a class="w-10 h-10 bg-white text-bytewave-blue rounded-full flex items-center justify-center hover:bg-bytewave-gold hover:text-white hover:scale-110 transition-all duration-300" href="#">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a class="w-10 h-10 bg-white text-bytewave-blue rounded-full flex items-center justify-center hover:bg-bytewave-gold hover:text-white hover:scale-110 transition-all duration-300" href="#">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a class="w-10 h-10 bg-white text-bytewave-blue rounded-full flex items-center justify-center hover:bg-bytewave-gold hover:text-white hover:scale-110 transition-all duration-300" href="#">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a class="w-10 h-10 bg-white text-bytewave-blue rounded-full flex items-center justify-center hover:bg-bytewave-gold hover:text-white hover:scale-110 transition-all duration-300" href="#">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->

    <!-- Fact Start -->
    <div class="bg-bytewave-gold py-12 md:py-16 relative overflow-hidden">
        <!-- Animated Background Particles -->
        <div class="particles-container absolute inset-0 pointer-events-none"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="flex items-start gap-4 animate-fadeIn stat-item">
                    <h1 class="text-5xl md:text-6xl font-bold text-bytewave-blue counter-value" data-target="99">0</h1>
                    <h5 class="text-white text-lg font-medium mt-2 leading-tight">Success in getting happy customer</h5>
                </div>
                <div class="flex items-start gap-4 animate-fadeIn stat-item">
                    <h1 class="text-5xl md:text-6xl font-bold text-bytewave-blue counter-value" data-target="25">0</h1>
                    <h5 class="text-white text-lg font-medium mt-2 leading-tight">Thousands of successful business</h5>
                </div>
                <div class="flex items-start gap-4 animate-fadeIn stat-item">
                    <h1 class="text-5xl md:text-6xl font-bold text-bytewave-blue counter-value" data-target="120">0</h1>
                    <h5 class="text-white text-lg font-medium mt-2 leading-tight">Total clients who love BYTEWAVE</h5>
                </div>
                <div class="flex items-start gap-4 animate-fadeIn stat-item">
                    <h1 class="text-5xl md:text-6xl font-bold text-bytewave-blue counter-value" data-target="5">0</h1>
                    <h5 class="text-white text-lg font-medium mt-2 leading-tight">Stars reviews given by satisfied clients</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Fact End -->


@endsection

@section('styles')
<style>
    /* Fade in animation */
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
    
    .animate-fadeIn {
        animation: fadeInDown 0.8s ease-out;
    }

    /* Particles Animation */
    .particles-container {
        background: radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.05) 0%, transparent 50%),
                    radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px) translateX(0px);
            opacity: 0.3;
        }
        50% {
            transform: translateY(-20px) translateX(10px);
            opacity: 0.6;
        }
    }

    @keyframes float-reverse {
        0%, 100% {
            transform: translateY(0px) translateX(0px);
            opacity: 0.4;
        }
        50% {
            transform: translateY(20px) translateX(-10px);
            opacity: 0.7;
        }
    }

    .particle {
        position: absolute;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        pointer-events: none;
    }

    .stat-item {
        transition: transform 0.3s ease;
    }

    .stat-item:hover {
        transform: translateY(-5px);
    }

    .counter-value {
        transition: color 0.3s ease;
    }

    .stat-item:hover .counter-value {
        text-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Counter Animation
        const counters = document.querySelectorAll('.counter-value');
        const speed = 200; // Animation speed
        
        const animateCounter = (counter) => {
            const target = +counter.getAttribute('data-target');
            const increment = target / speed;
            let count = 0;
            
            const updateCount = () => {
                count += increment;
                if (count < target) {
                    counter.textContent = Math.ceil(count);
                    requestAnimationFrame(updateCount);
                } else {
                    counter.textContent = target;
                }
            };
            
            updateCount();
        };
        
        // Intersection Observer for counter animation
        const observerOptions = {
            threshold: 0.5,
            rootMargin: '0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target.querySelector('.counter-value');
                    if (counter && counter.textContent === '0') {
                        animateCounter(counter);
                    }
                }
            });
        }, observerOptions);
        
        document.querySelectorAll('.stat-item').forEach(item => {
            observer.observe(item);
        });
        
        // Particle Generation
        const particlesContainer = document.querySelector('.particles-container');
        const particleCount = 30;
        
        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.classList.add('particle');
            
            // Random size between 3px and 15px
            const size = Math.random() * 12 + 3;
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            
            // Random position
            particle.style.left = `${Math.random() * 100}%`;
            particle.style.top = `${Math.random() * 100}%`;
            
            // Random animation
            const animation = i % 2 === 0 ? 'float' : 'float-reverse';
            const duration = Math.random() * 3 + 2; // 2-5 seconds
            const delay = Math.random() * 2; // 0-2 seconds delay
            
            particle.style.animation = `${animation} ${duration}s ease-in-out ${delay}s infinite`;
            
            particlesContainer.appendChild(particle);
        }
    });
</script>
@endsection