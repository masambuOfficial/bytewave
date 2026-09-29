<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GSMXYXJ375"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-GSMXYXJ375');
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - BYTEWAVE Admin</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Mona Sans: the same font as the public site -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mona+Sans:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Mona Sans', ui-sans-serif, system-ui, sans-serif;
        }
    </style>

    <style>
        /* Brand palette (BRAND.md): Blue, White, Ink. The old variable names are kept so page CSS keeps working:
           --bytewave-blue-dark is now Ink, --bytewave-blue-light is Blue at 10%. */
        :root {
            --bytewave-blue: #0773B9;
            --bytewave-blue-dark: #0B1F33;
            --bytewave-blue-light: #E6F1F8;

            /* Bootstrap, pointed at the brand palette */
            --bs-primary: #0773B9;
            --bs-primary-rgb: 7, 115, 185;
            --bs-secondary: #546270;
            --bs-secondary-rgb: 84, 98, 112;
            --bs-success: #17703F;
            --bs-success-rgb: 23, 112, 63;
            --bs-danger: #C0392B;
            --bs-danger-rgb: 192, 57, 43;
            --bs-warning: #92600C;
            --bs-warning-rgb: 146, 96, 12;
            --bs-info: #0773B9;
            --bs-info-rgb: 7, 115, 185;
            --bs-light: #F3F8FC;
            --bs-light-rgb: 243, 248, 252;
            --bs-dark: #0B1F33;
            --bs-dark-rgb: 11, 31, 51;
            --bs-body-color: #0B1F33;
            --bs-body-color-rgb: 11, 31, 51;
            --bs-secondary-color: #546270;
            --bs-border-color: #CDE3F1;
            --bs-link-color: #0773B9;
            --bs-link-color-rgb: 7, 115, 185;
            --bs-link-hover-color: #0B1F33;
            --bs-link-hover-color-rgb: 11, 31, 51;
            --bs-body-font-family: 'Mona Sans', ui-sans-serif, system-ui, sans-serif;
        }

        /* Buttons: Blue, hover Ink (BRAND.md 6.1) */
        .btn-primary {
            --bs-btn-bg: #0773B9; --bs-btn-border-color: #0773B9;
            --bs-btn-hover-bg: #0B1F33; --bs-btn-hover-border-color: #0B1F33;
            --bs-btn-active-bg: #0B1F33; --bs-btn-active-border-color: #0B1F33;
            --bs-btn-disabled-bg: #0773B9; --bs-btn-disabled-border-color: #0773B9;
            --bs-btn-focus-shadow-rgb: 7, 115, 185;
        }
        .btn-outline-primary {
            --bs-btn-color: #0773B9; --bs-btn-border-color: #0773B9;
            --bs-btn-hover-bg: #0773B9; --bs-btn-hover-border-color: #0773B9;
            --bs-btn-active-bg: #0B1F33; --bs-btn-active-border-color: #0B1F33;
            --bs-btn-focus-shadow-rgb: 7, 115, 185;
        }
        .btn-secondary, .btn-outline-secondary {
            --bs-btn-color: #546270; --bs-btn-border-color: #546270;
            --bs-btn-hover-bg: #546270; --bs-btn-hover-border-color: #546270;
            --bs-btn-active-bg: #0B1F33; --bs-btn-active-border-color: #0B1F33;
        }
        .btn-secondary { --bs-btn-color: #FFFFFF; --bs-btn-bg: #546270; }
        .btn-danger { --bs-btn-bg: #C0392B; --bs-btn-border-color: #C0392B; --bs-btn-hover-bg: #0B1F33; --bs-btn-hover-border-color: #0B1F33; --bs-btn-active-bg: #0B1F33; --bs-btn-active-border-color: #0B1F33; }
        .btn-outline-danger { --bs-btn-color: #C0392B; --bs-btn-border-color: #C0392B; --bs-btn-hover-bg: #C0392B; --bs-btn-hover-border-color: #C0392B; --bs-btn-active-bg: #C0392B; --bs-btn-active-border-color: #C0392B; }
        .btn-success { --bs-btn-bg: #17703F; --bs-btn-border-color: #17703F; --bs-btn-hover-bg: #0B1F33; --bs-btn-hover-border-color: #0B1F33; --bs-btn-active-bg: #0B1F33; --bs-btn-active-border-color: #0B1F33; }
        .btn-outline-success { --bs-btn-color: #17703F; --bs-btn-border-color: #17703F; --bs-btn-hover-bg: #17703F; --bs-btn-hover-border-color: #17703F; --bs-btn-active-bg: #17703F; --bs-btn-active-border-color: #17703F; }
        .btn-warning { --bs-btn-color: #FFFFFF; --bs-btn-bg: #92600C; --bs-btn-border-color: #92600C; --bs-btn-hover-color: #FFFFFF; --bs-btn-hover-bg: #0B1F33; --bs-btn-hover-border-color: #0B1F33; --bs-btn-active-color: #FFFFFF; --bs-btn-active-bg: #0B1F33; --bs-btn-active-border-color: #0B1F33; }
        .btn-dark { --bs-btn-bg: #0B1F33; --bs-btn-border-color: #0B1F33; --bs-btn-hover-bg: #0773B9; --bs-btn-hover-border-color: #0773B9; --bs-btn-active-bg: #0773B9; --bs-btn-active-border-color: #0773B9; }
        .alert-info { --bs-alert-color: #0B1F33; --bs-alert-bg: #E6F1F8; --bs-alert-border-color: #CDE3F1; }
        .btn-light { --bs-btn-bg: #F3F8FC; --bs-btn-border-color: #CDE3F1; --bs-btn-color: #0B1F33; --bs-btn-hover-bg: #E6F1F8; --bs-btn-hover-border-color: #CDE3F1; --bs-btn-hover-color: #0B1F33; }

        /* The ByteWave button (the admin.button component): same format as the public site's call-to-action */
        .bw-btn {
            --bw-bg: #0773B9; --bw-fg: #FFFFFF; --bw-hover: #0B1F33; --bw-arrow-bg: #FFFFFF; --bw-arrow-fg: #0773B9; --bw-move: 28px;
            display: inline-flex; align-items: center; gap: 0.75rem;
            height: 48px; padding: 6px 6px 6px 20px;
            border: 0; border-radius: 8px 8px 16px 8px;
            background: var(--bw-bg); color: var(--bw-fg);
            font-size: 0.9rem; font-weight: 600; line-height: 1; white-space: nowrap;
            text-decoration: none; cursor: pointer; overflow: hidden;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .bw-btn:hover { background: var(--bw-hover); color: var(--bw-fg); text-decoration: none; }
        .bw-btn:focus-visible { outline: 3px solid #0773B9; outline-offset: 2px; }
        .bw-btn:disabled, .bw-btn.disabled { opacity: 0.6; cursor: not-allowed; }
        .bw-btn__label { position: relative; display: inline-block; overflow: hidden; height: 20px; line-height: 20px; }
        .bw-btn__label > span { display: inline-block; transition: transform 0.3s ease; }
        .bw-btn__label > span + span { position: absolute; left: 0; top: 100%; }
        .bw-btn:hover .bw-btn__label > span { transform: translateY(-100%); }
        .bw-btn__arrow {
            position: relative; overflow: hidden; flex: 0 0 36px; width: 36px; height: 36px;
            border-radius: 6px; background: var(--bw-arrow-bg); color: var(--bw-arrow-fg);
        }
        .bw-btn__arrow svg { position: absolute; inset: 0; margin: auto; width: 16px; height: 16px; transition: transform 0.3s ease; }
        .bw-btn__arrow svg + svg { transform: translateX(calc(var(--bw-move) * -1)); }
        .bw-btn:hover .bw-btn__arrow svg:first-child { transform: translateX(var(--bw-move)); }
        .bw-btn:hover .bw-btn__arrow svg + svg { transform: translateX(0); }
        /* Cancel, back and reset are solid Blue like every other button, so pairs such as Filter and Reset stay balanced.
           The variant name is kept so existing markup keeps working. */
        .bw-btn--secondary { }
        .bw-btn--danger { --bw-bg: #C0392B; --bw-arrow-fg: #C0392B; }
        /* Compact, for toolbars and table headers */
        .bw-btn--sm { height: 40px; padding: 4px 4px 4px 16px; gap: 0.6rem; font-size: 0.85rem; border-radius: 6px 6px 12px 6px; }
        .bw-btn--sm .bw-btn__arrow { flex-basis: 32px; width: 32px; height: 32px; }
        @media (prefers-reduced-motion: reduce) { .bw-btn, .bw-btn * { transition: none !important; } }

        /* Form fields: Ink 50% border (3:1), Blue focus */
        .form-control, .form-select { border-color: #858F99; color: #0B1F33; }
        .form-control::placeholder { color: #546270; }
        .form-control:focus, .form-select:focus { border-color: #0773B9; box-shadow: 0 0 0 0.2rem rgba(7, 115, 185, 0.2); }
        .form-check-input:checked { background-color: #0773B9; border-color: #0773B9; }
        .text-muted { color: #546270 !important; }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #F3F8FC;
            color: #0B1F33;
        }

        /* Top Bar Styling */
        .admin-topbar {
            background: var(--bytewave-blue);
            box-shadow: 0 4px 12px rgba(7, 115, 185, 0.15);
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
            color: #FFFFFF !important;
        }

        .admin-dropdown .dropdown-toggle::after {
            border-top-color: currentColor;
        }

        .admin-dropdown .dropdown-menu {
            border: none;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(11, 31, 51, 0.15);
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
            background: var(--bytewave-blue);
            min-height: calc(100vh - 70px);
            padding: 2rem 0;
            position: fixed;
            left: 0;
            top: 70px;
            width: 280px;
            overflow-y: auto;
            box-shadow: 4px 0 12px rgba(11, 31, 51, 0.1);
        }

        .admin-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .admin-sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .admin-sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.5);
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
            color: #FFFFFF;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
            position: relative;
        }

        .sidebar-link:hover {
            background-color: rgba(255, 255, 255, 0.12);
            color: white;
            padding-left: 1.75rem;
        }

        .sidebar-link.active {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            font-weight: 700;
            padding-left: 1.75rem;
            border-left: 4px solid #F1C442;
        }

        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background-color: #F1C442;
            border-radius: 0 4px 4px 0;
        }

        .sidebar-link i {
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
        }

        .sidebar-badge {
            margin-left: auto;
            min-width: 22px;
            height: 22px;
            padding: 0 7px;
            border-radius: 11px;
            background-color: #FFFFFF;
            color: var(--bytewave-blue);
            font-size: 0.75rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-section-title {
            color: #FFFFFF;
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
            box-shadow: 0 4px 12px rgba(7, 115, 185, 0.3);
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
            background: rgba(7, 115, 185, 0.08);
            color: var(--bytewave-blue-dark);
            border-left: 4px solid var(--bytewave-blue);
            border-radius: 8px;
        }

        .alert-danger {
            border: none;
            background: rgba(192, 57, 43, 0.08);
            color: #C0392B;
            border-left: 4px solid #C0392B;
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
            <img src="{{ asset('images/BYTEWAVE_INVESTMENTS-LOGO.png') }}" alt="BYTEWAVE">
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
            <li class="sidebar-item">
                <a href="{{ route('admin.testimonials.index') }}" 
                   class="sidebar-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                    <i class="fas fa-comments"></i>
                    <span>Testimonials</span>
                    @php $pendingTestimonials = \App\Models\Testimonial::where('status', 'pending')->count(); @endphp
                    @if($pendingTestimonials > 0)
                        <span class="sidebar-badge" title="{{ $pendingTestimonials }} awaiting approval">{{ $pendingTestimonials > 99 ? '99+' : $pendingTestimonials }}</span>
                    @endif
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
        // Changes only the label of a ByteWave button (.bw-btn), so the arrow and the hover animation survive
        window.bwLabel = function (btn, text) {
            btn.querySelectorAll('.bw-btn__label > span').forEach(function (s) { s.textContent = text; });
        };
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
    
    {{-- Shared Send Email Modal --}}
    <div class="modal fade" id="sendEmailModal" tabindex="-1" aria-labelledby="sendEmailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="sendEmailForm" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="sendEmailModalLabel">
                            <i class="fas fa-paper-plane me-2 text-primary"></i>
                            <span id="sendEmailModalTitle">Send Document</span>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 p-2 rounded d-flex align-items-center justify-content-between" style="background:#CDE3F1;border:1px solid #CDE3F1">
                            <span style="font-size:.85rem;color:#0773B9"><i class="fas fa-eye me-2"></i>Always preview before sending</span>
                            <a id="sendEmailPreviewBtn" href="#" target="_blank"
                               class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-external-link-alt me-1"></i> Preview
                            </a>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">To</label>
                            <input type="text" id="sendEmailTo" class="form-control bg-light" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">CC <span class="text-muted fw-normal">(optional — comma-separated)</span></label>
                            <input type="text" name="cc" id="sendEmailCc" class="form-control" placeholder="e.g. manager@company.com, boss@company.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">BCC <span class="text-muted fw-normal">(optional — comma-separated)</span></label>
                            <input type="text" name="bcc" id="sendEmailBcc" class="form-control" placeholder="e.g. accounts@company.com">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <x-admin.button type="button" data-bs-dismiss="modal" variant="secondary">Cancel</x-admin.button>
                        <x-admin.button type="submit" id="sendEmailSubmitBtn">Send</x-admin.button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var modalEl = document.getElementById('sendEmailModal');
            if (!modalEl) return;

            var sendForm = document.getElementById('sendEmailForm');
            var sendBtn  = document.getElementById('sendEmailSubmitBtn');

            document.querySelectorAll('[data-send-modal]').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    document.getElementById('sendEmailModalTitle').textContent = this.dataset.title;
                    document.getElementById('sendEmailTo').value = this.dataset.to;
                    sendForm.action = this.dataset.action;
                    document.getElementById('sendEmailCc').value = '';
                    document.getElementById('sendEmailBcc').value = '';
                    sendBtn.disabled = false;
                    bwLabel(sendBtn, 'Send');
                    var previewBtn = document.getElementById('sendEmailPreviewBtn');
                    if (previewBtn) previewBtn.href = this.dataset.preview || '#';
                    bootstrap.Modal.getOrCreateInstance(modalEl).show();
                });
            });

            sendForm.addEventListener('submit', function () {
                sendBtn.disabled = true;
                bwLabel(sendBtn, 'Sending…');
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
