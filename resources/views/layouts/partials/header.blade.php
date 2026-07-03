<header class="absolute top-0 left-0 right-0 z-50">
    <!-- Navbar Start -->
    <nav class="bg-transparent" x-data="{ open: false }">
        <div class="container mx-auto px-4 py-6">
            <div class="flex items-center justify-between">
                <!-- Logo (Left) -->
                <a href="{{ url('/') }}" class="flex items-center flex-shrink-0">
                    <img src="{{ asset('css/img/BYTEWAVE_INVESTMENTS-LOGO.png') }}" alt="BYTEWAVE Logo" class="h-10">
                </a>

                <!-- Desktop Navigation (Center) -->
                <div class="hidden lg:flex items-center space-x-8 flex-1 justify-center">
                    <a href="{{ url('/') }}" class="hover:text-blue-500 transition-colors font-medium flex items-center gap-2 group {{ Request::path() == '/' ? 'text-blue-500' : 'text-white' }}">
                        <span class="w-1.5 h-1.5 bg-blue-500 transition-opacity {{ Request::path() == '/' ? 'opacity-100' : 'opacity-0 group-hover:opacity-100' }}"></span>
                        Home
                    </a>
                    
                    <!-- Who we are Dropdown -->
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="hover:text-blue-500 transition-colors font-medium flex items-center gap-2 group {{ Request::is('about*') || Request::is('services*') || Request::is('products*') || Request::is('portfolios*') ? 'text-blue-500' : 'text-white' }}">
                            <span class="w-1.5 h-1.5 bg-blue-500 transition-opacity {{ Request::is('about*') || Request::is('services*') || Request::is('products*') || Request::is('portfolios*') ? 'opacity-100' : 'opacity-0 group-hover:opacity-100' }}"></span>
                            Who we are
                            <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform -translate-y-2"
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 transform translate-y-0"
                             x-transition:leave-end="opacity-0 transform -translate-y-2"
                             class="absolute top-full left-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50"
                             style="display: none;">
                            <a href="{{ url('/about') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-500 {{ Request::is('about*') ? 'bg-blue-50 text-blue-500 font-semibold' : '' }}">About Us</a>
                            <a href="{{ url('/services') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-500 {{ Request::is('services*') ? 'bg-blue-50 text-blue-500 font-semibold' : '' }}">Services</a>
                            <a href="{{ url('/products') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-500 {{ Request::is('products*') ? 'bg-blue-50 text-blue-500 font-semibold' : '' }}">Solutions</a>
                            <a href="{{ url('/portfolios') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-500 {{ Request::is('portfolios*') ? 'bg-blue-50 text-blue-500 font-semibold' : '' }}">Portfolio</a>
                        </div>
                    </div>
                    
                    <a href="{{ url('/blog') }}" class="hover:text-blue-500 transition-colors font-medium flex items-center gap-2 group {{ Request::is('blog*') ? 'text-blue-500' : 'text-white' }}">
                        <span class="w-1.5 h-1.5 bg-blue-500 transition-opacity {{ Request::is('blog*') ? 'opacity-100' : 'opacity-0 group-hover:opacity-100' }}"></span>
                        Blog
                    </a>
                    <a href="{{ url('/contact') }}" class="hover:text-blue-500 transition-colors font-medium flex items-center gap-2 group {{ Request::is('contact*') ? 'text-blue-500' : 'text-white' }}">
                        <span class="w-1.5 h-1.5 bg-blue-500 transition-opacity {{ Request::is('contact*') ? 'opacity-100' : 'opacity-0 group-hover:opacity-100' }}"></span>
                        Contact
                    </a>
                </div>

                <!-- CTA Button (Right) -->
                <div class="hidden lg:flex items-center">
                    <x-cta-button href="{{ url('/contact') }}" />
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
                 class="lg:hidden mt-4 pb-4 bg-black/90 backdrop-blur-sm rounded-lg px-4 pt-4"
                 style="display: none;">
                <div class="flex flex-col space-y-3">
                    <a href="{{ url('/') }}" class="hover:text-blue-500 transition-colors font-medium flex items-center gap-2 group {{ Request::path() == '/' ? 'text-blue-500' : 'text-white' }}">
                        <span class="w-1.5 h-1.5 bg-blue-500 transition-opacity {{ Request::path() == '/' ? 'opacity-100' : 'opacity-0 group-hover:opacity-100' }}"></span>
                        Home
                    </a>
                    
                    <!-- Who we are Mobile Dropdown -->
                    <div x-data="{ subOpen: false }">
                        <button @click="subOpen = !subOpen" class="hover:text-blue-500 transition-colors font-medium flex items-center gap-2 w-full group {{ Request::is('about*') || Request::is('services*') || Request::is('products*') || Request::is('portfolios*') ? 'text-blue-500' : 'text-white' }}">
                            <span class="w-1.5 h-1.5 bg-blue-500 transition-opacity {{ Request::is('about*') || Request::is('services*') || Request::is('products*') || Request::is('portfolios*') ? 'opacity-100' : 'opacity-0 group-hover:opacity-100' }}"></span>
                            Who we are
                            <svg class="w-4 h-4 ml-auto transition-transform" :class="subOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="subOpen" x-collapse class="ml-6 mt-2 space-y-2">
                            <a href="{{ url('/about') }}" class="block text-white hover:text-blue-500 transition-colors {{ Request::is('about*') ? 'text-blue-500 font-semibold' : '' }}">About Us</a>
                            <a href="{{ url('/services') }}" class="block text-white hover:text-blue-500 transition-colors {{ Request::is('services*') ? 'text-blue-500 font-semibold' : '' }}">Services</a>
                            <a href="{{ url('/products') }}" class="block text-white hover:text-blue-500 transition-colors {{ Request::is('products*') ? 'text-blue-500 font-semibold' : '' }}">Solutions</a>
                            <a href="{{ url('/portfolios') }}" class="block text-white hover:text-blue-500 transition-colors {{ Request::is('portfolios*') ? 'text-blue-500 font-semibold' : '' }}">Portfolio</a>
                        </div>
                    </div>
                    
                    <a href="{{ url('/blog') }}" class="hover:text-blue-500 transition-colors font-medium flex items-center gap-2 group {{ Request::is('blog*') ? 'text-blue-500' : 'text-white' }}">
                        <span class="w-1.5 h-1.5 bg-blue-500 transition-opacity {{ Request::is('blog*') ? 'opacity-100' : 'opacity-0 group-hover:opacity-100' }}"></span>
                        Blog
                    </a>
                    <a href="{{ url('/contact') }}" class="hover:text-blue-500 transition-colors font-medium flex items-center gap-2 group {{ Request::is('contact*') ? 'text-blue-500' : 'text-white' }}">
                        <span class="w-1.5 h-1.5 bg-blue-500 transition-opacity {{ Request::is('contact*') ? 'opacity-100' : 'opacity-0 group-hover:opacity-100' }}"></span>
                        Contact
                    </a>
                    @auth
                        <a href="{{ url('/admin/dashboard') }}" class="text-white hover:text-blue-500 transition-colors font-medium flex items-center gap-2 group">
                            <span class="w-1.5 h-1.5 bg-blue-500 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-white hover:text-red-500 transition-colors text-left font-medium">Logout</button>
                        </form>
                    @endauth
                    <div class="mt-4">
                        <x-cta-button href="{{ url('/contact') }}" :fullWidthMobile="true" />
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->
</header>
