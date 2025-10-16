<header>
    <!-- Topbar Start -->
    <div class="container-fluid bg-warning py-2 d-none d-lg-flex">
        <div class="container">
            <div class="d-flex justify-content-between topbar"> <!-- Added inline padding -->
                <div class="top-info">
                    <small class="me-3 text-white">
                        <i class="fas fa-map-marker-alt me-2 text-primary"></i>Kampala, Uganda
                    </small>
                    <small class="me-3 text-white">
                        <i class="fas fa-envelope me-2 text-primary"></i><a href="mailto:info@bytewaveinvestments.com" class="text-white text-decoration-none">info@bytewaveinvestments.com</a>
                    </small>
                </div>
                <div class="d-none d-xl-flex align-items-center text-primary">
                    <small>Quality Digital Services You Really Need!</small>
                </div>
                <div class="top-link">
                    <a href="#" class="bg-light nav-fill btn btn-sm-square rounded-circle" title="Facebook">
                        <i class="fab fa-facebook-f text-primary"></i>
                    </a>
                    <a href="#" class="bg-light nav-fill btn btn-sm-square rounded-circle" title="Twitter">
                        <i class="fab fa-twitter text-primary"></i>
                    </a>
                    <a href="#" class="bg-light nav-fill btn btn-sm-square rounded-circle" title="Instagram">
                        <i class="fab fa-instagram text-primary"></i>
                    </a>
                    <a href="#" class="bg-light nav-fill btn btn-sm-square rounded-circle me-0" title="LinkedIn">
                        <i class="fab fa-linkedin-in text-primary"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark sticky-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-4">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('css/img/BYTEWAVE_INVESTMENTS-LOGO.png') }}" alt="BYTEWAVE Logo" height="40"
                     class="d-inline-block align-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto p-0">
                    <a href="{{ url('/') }}" class="nav-item nav-link {{ Request::is('/') ? 'active' : '' }}">Home</a>
                    <a href="{{ url('/about') }}" class="nav-item nav-link {{ Request::is('about*') ? 'active' : '' }}">About</a>
                    <a href="{{ url('/services') }}" class="nav-item nav-link {{ Request::is('services*') ? 'active' : '' }}">Services</a>
                    <a href="{{ url('/products') }}" class="nav-item nav-link {{ Request::is('products*') ? 'active' : '' }}">Solutions</a>
                    <a href="{{ url('/portfolios') }}" class="nav-item nav-link {{ Request::is('portfolios*') ? 'active' : '' }}">Portfolio</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu rounded-0 rounded-bottom m-0">
                            <a href="{{ url('/blog') }}" class="dropdown-item {{ Request::is('blog*') ? 'active' : '' }}">Our Blog</a>
                            <a href="{{ url('/contact') }}" class="dropdown-item {{ Request::is('contact*') ? 'active' : '' }}">Contact</a>
                            @auth
                                <a href="{{ url('/admin/dashboard') }}" class="dropdown-item">Dashboard</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="d-none d-xl-flex align-items-center">
                    <div id="phone-tada" class="d-flex align-items-center justify-content-center me-4">
                        <a href="tel:+256123456789" class="position-relative">
                            <i class="fa fa-phone-alt text-white fa-2x"></i>
                            <div class="position-absolute" style="top: -7px; left: 20px;">
                                <span><i class="fa fa-comment-dots text-warning"></i></span>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex flex-column pe-4 border-end">
                        <span class="text-white-50">Have any questions?</span>
                        <span class="text-warning">+256 782 440 907</span>
                    </div>
                    <a href="{{ url('/contact') }}" class="btn btn-warning rounded-pill py-2 px-4 ms-4">Get A Quote</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->
</header>
