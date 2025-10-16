<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - BYTEWAVE Admin</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-warning">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="{{ route('admin.dashboard') }}">BYTEWAVE Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                           href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    
                    <!-- Website Content -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                            Website Content
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.products.index') }}">Products</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.services.index') }}">Services</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.posts.index') }}">Blog Posts</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.portfolios.index') }}">Portfolio</a></li>
                        </ul>
                    </li>
                    
                    <!-- Business Management -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-briefcase"></i>
                            <span>Business Management</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.clients.index') }}">
                                <i class="fas fa-users"></i> Clients
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.tasks.index') }}">
                                <i class="fas fa-tasks"></i> Task Management
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.client-services.index') }}">
                                <i class="fas fa-cogs"></i> Client Services
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.quotations.index') }}">
                                <i class="fas fa-file-invoice-dollar"></i> Quotations
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.invoices.index') }}">
                                <i class="fas fa-file-invoice"></i> Invoices
                            </a></li>
                        </ul>
                    </li>
                </ul>
                
                <!-- Right Side -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid py-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    @stack('scripts')
</body>
</html>
