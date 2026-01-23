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
    <!-- Outfit Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Outfit', ui-sans-serif, system-ui, sans-serif;
        }
    </style>
    
    <style>
        :root {
            --bytewave-blue: #0773B8;
            --bytewave-blue-dark: #04456E;
            --bytewave-blue-light: #E6F3FB;
            --bytewave-gold: #FBB145;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f8f9fa;
        }

        /* Top Bar Styling */
        .admin-topbar {
            background: linear-gradient(135deg, var(--bytewave-blue) 0%, #055C93 100%);
            box-shadow: 0 4px 12px rgba(7, 115, 184, 0.15);
            padding: 0 2rem;
            height: 70px;
            display: flex;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .topbar-logo {
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            flex-shrink: 0;
        }

        .topbar-logo img {
            height: 40px;
            width: auto;
        }

        .topbar-logo span {
            color: white;
            font-weight: 700;
            font-size: 1.3rem;
            letter-spacing: -0.5px;
        }

        .topbar-spacer {
            flex: 1;
        }

        .admin-dropdown {
            margin-left: auto;
        }

        .admin-dropdown .dropdown-toggle {
            color: white !important;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 8px;
        }

        .admin-dropdown .dropdown-toggle:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--bytewave-gold) !important;
        }

        .admin-dropdown .dropdown-toggle::after {
            border-top-color: currentColor;
        }

        .admin-dropdown .dropdown-menu {
            border: none;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            min-width: 220px;
        }

        .admin-dropdown .dropdown-item {
            color: var(--bytewave-blue-dark);
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            transition: all 0.2s ease;
            border-radius: 8px;
            margin: 0.25rem;
        }

        .admin-dropdown .dropdown-item:hover {
            background-color: var(--bytewave-blue-light);
            color: var(--bytewave-blue);
            padding-left: 2rem;
        }

        .admin-dropdown form {
            display: contents;
        }

        /* Sidebar Styling */
        .admin-sidebar {
            background: linear-gradient(180deg, var(--bytewave-blue-dark) 0%, var(--bytewave-blue) 100%);
            min-height: calc(100vh - 70px);
            padding: 2rem 0;
            position: fixed;
            left: 0;
            top: 70px;
            width: 280px;
            overflow-y: auto;
            box-shadow: 4px 0 12px rgba(0, 0, 0, 0.1);
        }

        .admin-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .admin-sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .admin-sidebar::-webkit-scrollbar-thumb {
            background: var(--bytewave-gold);
            border-radius: 3px;
        }

        .sidebar-item {
            list-style: none;
            margin: 0.5rem 0;
            padding: 0 1rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1.25rem;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
            position: relative;
        }

        .sidebar-link:hover {
            background-color: rgba(251, 177, 69, 0.15);
            color: white;
            padding-left: 1.75rem;
        }

        .sidebar-link.active {
            background: rgba(251, 177, 69, 0.15);
            color: white;
            font-weight: 700;
            padding-left: 1.75rem;
            border-left: 4px solid var(--bytewave-gold);
        }

        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background-color: var(--bytewave-gold);
            border-radius: 0 4px 4px 0;
        }

        .sidebar-link i {
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
        }

        .sidebar-section-title {
            color: var(--bytewave-gold);
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 1.5rem 1.5rem 0.75rem 1.5rem;
            margin-top: 1rem;
        }

        .sidebar-section-title:first-child {
            margin-top: 0;
        }

        .sidebar-toggle {
            display: none;
            position: fixed;
            bottom: 2rem;
            left: 2rem;
            width: 50px;
            height: 50px;
            background-color: var(--bytewave-blue);
            border: none;
            border-radius: 50%;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(7, 115, 184, 0.3);
            z-index: 999;
        }

        .sidebar-toggle:hover {
            background-color: var(--bytewave-blue-dark);
            transform: scale(1.1);
        }

        /* Main Content */
        .admin-main {
            margin-left: 280px;
            padding: 2rem;
            min-height: calc(100vh - 70px);
        }

        /* Alert Styling */
        .alert-success {
            border: none;
            background: linear-gradient(135deg, rgba(7, 115, 184, 0.1) 0%, rgba(251, 177, 69, 0.05) 100%);
            color: var(--bytewave-blue-dark);
            border-left: 4px solid var(--bytewave-blue);
            border-radius: 8px;
        }

        .alert-danger {
            border: none;
            background: linear-gradient(135deg, rgba(220, 38, 38, 0.1) 0%, rgba(248, 113, 113, 0.05) 100%);
            color: #991B1B;
            border-left: 4px solid #DC2626;
            border-radius: 8px;
        }

        .btn-close {
            filter: brightness(0) saturate(100%) invert(20%) sepia(60%) saturate(800%) hue-rotate(185deg);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .admin-sidebar {
                width: 100%;
                position: fixed;
                left: 0;
                top: 70px;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                z-index: 999;
                border-radius: 0;
            }

            .admin-sidebar.show {
                transform: translateX(0);
            }

            .sidebar-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .admin-main {
                margin-left: 0;
                padding: 1.5rem;
            }

            .topbar-logo span {
                font-size: 1.1rem;
            }

            .admin-topbar {
                padding: 0 1rem;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Top Bar -->
    <nav class="admin-topbar">
        <a href="{{ route('admin.dashboard') }}" class="topbar-logo">
            <img src="{{ asset('css/img/BYTEWAVE_INVESTMENTS-LOGO.png') }}" alt="BYTEWAVE">
        </a>

        <div class="topbar-spacer"></div>

        <!-- Admin Dropdown -->
        <div class="admin-dropdown dropdown">
            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user-circle" style="font-size: 1.2rem;"></i>
                <span>{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="fas fa-sign-out-alt" style="margin-right: 0.5rem;"></i>Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside class="admin-sidebar" id="adminSidebar">
        <!-- Dashboard -->
        <ul style="list-style: none;">
            <li class="sidebar-item">
                <a href="{{ route('admin.dashboard') }}" 
                   class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        </ul>

        <!-- Website Content Section -->
        <div class="sidebar-section-title">Website Content</div>
        <ul style="list-style: none;">
            <li class="sidebar-item">
                <a href="{{ route('admin.products.index') }}" 
                   class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="fas fa-box"></i>
                    <span>Products</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.services.index') }}" 
                   class="sidebar-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                    <i class="fas fa-handshake"></i>
                    <span>Services</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.posts.index') }}" 
                   class="sidebar-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                    <i class="fas fa-pen-fancy"></i>
                    <span>Blog Posts</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.portfolios.index') }}" 
                   class="sidebar-link {{ request()->routeIs('admin.portfolios.*') ? 'active' : '' }}">
                    <i class="fas fa-briefcase"></i>
                    <span>Portfolio</span>
                </a>
            </li>
        </ul>

        <!-- Business Management Section -->
        <div class="sidebar-section-title">Business Management</div>
        <ul style="list-style: none;">
            <li class="sidebar-item">
                <a href="{{ route('admin.clients.index') }}" 
                   class="sidebar-link {{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Clients</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.tasks.index') }}" 
                   class="sidebar-link {{ request()->routeIs('admin.tasks.*') ? 'active' : '' }}">
                    <i class="fas fa-tasks"></i>
                    <span>Task Management</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.client-services.index') }}" 
                   class="sidebar-link {{ request()->routeIs('admin.client-services.*') ? 'active' : '' }}">
                    <i class="fas fa-cogs"></i>
                    <span>Client Services</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.quotations.index') }}" 
                   class="sidebar-link {{ request()->routeIs('admin.quotations.*') ? 'active' : '' }}">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <span>Quotations</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.invoices.index') }}" 
                   class="sidebar-link {{ request()->routeIs('admin.invoices.*') ? 'active' : '' }}">
                    <i class="fas fa-file-invoice"></i>
                    <span>Invoices</span>
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="admin-main">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle" style="margin-right: 0.5rem;"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle" style="margin-right: 0.5rem;"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Sidebar Toggle for Mobile -->
    <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle Sidebar">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('adminSidebar');
            const toggleBtn = document.getElementById('sidebarToggle');

            if (toggleBtn) {
                toggleBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });

                // Close sidebar when clicking a link on mobile
                sidebar.querySelectorAll('.sidebar-link').forEach(link => {
                    link.addEventListener('click', function() {
                        if (window.innerWidth <= 768) {
                            sidebar.classList.remove('show');
                        }
                    });
                });
            }

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 768) {
                    const isClickInside = sidebar.contains(event.target) || toggleBtn.contains(event.target);
                    if (!isClickInside && sidebar.classList.contains('show')) {
                        sidebar.classList.remove('show');
                    }
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>
