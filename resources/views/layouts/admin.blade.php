<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title', 'Dashboard')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin/admin-layout.css') }}">

    @yield('styles')
</head>

<body>

    <nav class="sidebar" id="adminSidebar">
        <div class="admin-info">
            <img src="{{ asset('images/logo sma angkasa.png') }}" alt="Admin Avatar" class="admin-avatar">
            <div class="admin-details">
                @auth
                    <h5>{{ Auth::user()->name }}</h5>
                    <small>{{ Auth::user()->email }}</small>
                @else
                    <h5>Admin Panel</h5>
                @endauth
            </div>
        </div>

        <div class="nav-section-title">Main</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
        </ul>

        <div class="nav-section-title">Master</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.comments.index') ? 'active' : '' }}"
                    href="{{ route('admin.comments.index') }}">
                    <i class="fas fa-comments"></i> Management Data
                </a>
            </li>
        </ul>
        <div class="nav-section-title">Service</div>
        <ul class="nav flex-column">
            <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST" id="logout-form-admin">
                @csrf
                <a class="nav-link btn-logout" href="#" onclick="event.preventDefault(); document.getElementById('logout-form-admin').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </form>
        </li>
        </ul>

        <div class="theme-toggle-section">
            <p>Tampilan</p>
            <div class="theme-switch-buttons">
                <button id="lightThemeAdmin" class="active">Light</button>
                <button id="darkThemeAdmin">Dark</button>
            </div>
        </div>
    </nav>

    <div class="main-content-wrapper" id="mainContentWrapper">
        <header class="main-header">
            <button class="hamburger-btn" id="sidebarToggleBtn">
                <i class="fas fa-bars"></i>
            </button>
            <h2 class="page-title">@yield('title', 'Dashboard')</h2> {{-- Judul halaman utama --}}
        </header>
        <main class="actual-content">
            @yield('content')
        </main>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/admin/admin-layout.js') }}"></script>

@stack('scripts')
</body>
</html>
