<header>
    <!-- Topbar Start -->
    <div class="bg-yellow-500 py-2 hidden lg:flex">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <small class="text-white flex items-center">
                        <i class="fas fa-map-marker-alt mr-2 text-blue-600"></i>Kampala, Uganda
                    </small>
                    <small class="text-white flex items-center">
                        <i class="fas fa-envelope mr-2 text-blue-600"></i>
                        <a href="mailto:info@bytewaveinvestments.com" class="text-white hover:text-blue-600 transition-colors">info@bytewaveinvestments.com</a>
                    </small>
                </div>
                <div class="hidden xl:flex items-center text-blue-600">
                    <small>Quality Digital Services You Really Need!</small>
                </div>
                <div class="flex gap-2">
                    <a href="#" class="bg-bytewave-blue w-8 text-white hover:text-bytewave-blue h-8 rounded-full flex items-center justify-center hover:bg-bytewave-gold transition-all duration-500 ease-in-out hover:scale-110 social-icon" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="bg-bytewave-blue w-8 text-white hover:text-bytewave-blue h-8 rounded-full flex items-center justify-center hover:bg-bytewave-gold transition-all duration-500 ease-in-out hover:scale-110 social-icon" title="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="bg-bytewave-blue w-8 text-white hover:text-bytewave-blue h-8 rounded-full flex items-center justify-center hover:bg-bytewave-gold transition-all duration-500 ease-in-out hover:scale-110 social-icon" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="bg-bytewave-blue w-8 text-white hover:text-bytewave-blue h-8 rounded-full flex items-center justify-center hover:bg-bytewave-gold transition-all duration-500 ease-in-out hover:scale-110 social-icon" title="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <nav class="bg-blue-600 sticky top-0 z-50 shadow-lg" x-data="{ open: false, pagesOpen: false }">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center">
                    <img src="{{ asset('css/img/BYTEWAVE_INVESTMENTS-LOGO.png') }}" alt="BYTEWAVE Logo" class="h-10">
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-6">
                    <a href="{{ url('/') }}" class="text-white hover:text-yellow-400 transition-colors {{ Request::is('/') ? 'text-yellow-400 font-semibold' : '' }}">Home</a>
                    <a href="{{ url('/about') }}" class="text-white hover:text-yellow-400 transition-colors {{ Request::is('about*') ? 'text-yellow-400 font-semibold' : '' }}">About</a>
                    <a href="{{ url('/services') }}" class="text-white hover:text-yellow-400 transition-colors {{ Request::is('services*') ? 'text-yellow-400 font-semibold' : '' }}">Services</a>
                    <a href="{{ url('/products') }}" class="text-white hover:text-yellow-400 transition-colors {{ Request::is('products*') ? 'text-yellow-400 font-semibold' : '' }}">Solutions</a>
                    <a href="{{ url('/portfolios') }}" class="text-white hover:text-yellow-400 transition-colors {{ Request::is('portfolios*') ? 'text-yellow-400 font-semibold' : '' }}">Portfolio</a>
                    
                    <!-- Pages Dropdown -->
                    <div class="relative" @click.away="pagesOpen = false">
                        <button @click="pagesOpen = !pagesOpen" class="text-white hover:text-yellow-400 transition-colors flex items-center">
                            Pages
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="pagesOpen" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-95"
                             class="absolute top-full left-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50"
                             style="display: none;">
                            <a href="{{ url('/blog') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 {{ Request::is('blog*') ? 'bg-blue-50 text-blue-600 font-semibold' : '' }}">Our Blog</a>
                            <a href="{{ url('/contact') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 {{ Request::is('contact*') ? 'bg-blue-50 text-blue-600 font-semibold' : '' }}">Contact</a>
                            @auth
                                <a href="{{ url('/admin/dashboard') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-50">Dashboard</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-gray-800 hover:bg-blue-50">Logout</button>
                                </form>
                            @endauth
                        </div>
                    </div>
                </div>

                <!-- Contact Info & CTA (Desktop) -->
                <div class="hidden xl:flex items-center space-x-4">
                    <div class="flex items-center">
                        <a href="tel:+256782440907" class="relative">
                            <i class="fa fa-phone-alt text-white text-2xl"></i>
                            <span class="absolute -top-1 left-5">
                                <i class="fa fa-comment-dots text-yellow-400 text-sm"></i>
                            </span>
                        </a>
                    </div>
                    <div class="flex flex-col border-r border-blue-400 pr-4">
                        <span class="text-blue-200 text-xs">Have any questions?</span>
                        <span class="text-yellow-400 font-semibold">+256 782 440 907</span>
                    </div>
                    <a href="{{ url('/contact') }}" class="bg-yellow-400 hover:bg-yellow-500 text-blue-900 font-semibold px-6 py-2 rounded-full transition-colors">
                        Get A Quote
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button @click="open = !open" class="lg:hidden text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" style="display: none;"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 transform translate-y-0"
                 x-transition:leave-end="opacity-0 transform -translate-y-2"
                 class="lg:hidden mt-4 pb-4"
                 style="display: none;">
                <div class="flex flex-col space-y-3">
                    <a href="{{ url('/') }}" class="text-white hover:text-yellow-400 transition-colors {{ Request::is('/') ? 'text-yellow-400 font-semibold' : '' }}">Home</a>
                    <a href="{{ url('/about') }}" class="text-white hover:text-yellow-400 transition-colors {{ Request::is('about*') ? 'text-yellow-400 font-semibold' : '' }}">About</a>
                    <a href="{{ url('/services') }}" class="text-white hover:text-yellow-400 transition-colors {{ Request::is('services*') ? 'text-yellow-400 font-semibold' : '' }}">Services</a>
                    <a href="{{ url('/products') }}" class="text-white hover:text-yellow-400 transition-colors {{ Request::is('products*') ? 'text-yellow-400 font-semibold' : '' }}">Solutions</a>
                    <a href="{{ url('/portfolios') }}" class="text-white hover:text-yellow-400 transition-colors {{ Request::is('portfolios*') ? 'text-yellow-400 font-semibold' : '' }}">Portfolio</a>
                    <a href="{{ url('/blog') }}" class="text-white hover:text-yellow-400 transition-colors {{ Request::is('blog*') ? 'text-yellow-400 font-semibold' : '' }}">Our Blog</a>
                    <a href="{{ url('/contact') }}" class="text-white hover:text-yellow-400 transition-colors {{ Request::is('contact*') ? 'text-yellow-400 font-semibold' : '' }}">Contact</a>
                    @auth
                        <a href="{{ url('/admin/dashboard') }}" class="text-white hover:text-yellow-400 transition-colors">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-white hover:text-yellow-400 transition-colors text-left">Logout</button>
                        </form>
                    @endauth
                    <a href="{{ url('/contact') }}" class="bg-yellow-400 hover:bg-yellow-500 text-blue-900 font-semibold px-6 py-2 rounded-full transition-colors text-center mt-4">
                        Get A Quote
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->
</header>
