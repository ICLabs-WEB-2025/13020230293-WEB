<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title', 'Dashboard')</title> {{-- Default title --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --admin-primary-color: #5887B2; /* Biru Suara Siswa */
            --admin-sidebar-bg: #5887B2;
            --admin-sidebar-text: white;
            --admin-sidebar-link-hover-bg: rgba(255, 255, 255, 0.15);
            --admin-content-bg: #f4f6f9; /* Latar belakang konten yang lebih cerah */
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--admin-content-bg);
            display: flex; /* Untuk layout sidebar fixed */
        }

        .sidebar {
            height: 100vh;
            width: 260px;
            position: fixed; /* Sidebar tetap di tempat */
            top: 0;
            left: 0;
            background-color: var(--admin-sidebar-bg);
            padding: 20px;
            color: var(--admin-sidebar-text);
            transition: margin-left 0.3s ease-in-out, left 0.3s ease-in-out; /* Animasi untuk toggle */
            z-index: 1030; /* Di atas konten lain */
            display: flex;
            flex-direction: column;
            overflow-y: auto; /* Scroll jika menu panjang */
        }
        .sidebar.collapsed {
            margin-left: -260px; /* Sembunyikan sidebar */
        }

        /* Style sidebar lainnya dari sebelumnya (admin-info, nav-link, dll.) tetap di sini */
        .sidebar .admin-info { display: flex; align-items: center; padding-bottom: 15px; margin-bottom: 15px; border-bottom: 1px solid rgba(255, 255, 255, 0.2); }
        .sidebar .admin-info img.admin-avatar { height: 50px; width: 50px; border-radius: 50%; margin-right: 15px; border: 2px solid white; object-fit: cover; }
        .sidebar .admin-info .admin-details h5 { margin-bottom: 2px; font-size: 1rem; font-weight: 600; color: white; }
        .sidebar .admin-info .admin-details small { font-size: 0.8rem; color: rgba(255, 255, 255, 0.8); }
        .sidebar .nav-section-title { font-size: 0.75rem; font-weight: 600; text-transform: uppercase; color: rgba(255, 255, 255, 0.6); padding: 15px 0 5px 0; }
        .sidebar .nav-link { color: rgba(255, 255, 255, 0.8); margin-bottom: 8px; padding: 10px 15px; border-radius: 0.375rem; display: flex; align-items: center; transition: background-color 0.2s ease, color 0.2s ease; }
        .sidebar .nav-link i { margin-right: 10px; width: 20px; text-align: center; }
        .sidebar .nav-link.active, .sidebar .nav-link:hover { color: white; background-color: var(--admin-sidebar-link-hover-bg); font-weight: 500; }
        .sidebar .nav-link.btn-logout { color: #ffdddd; }
        .sidebar .nav-link.btn-logout:hover { background-color: rgba(220, 53, 69, 0.2); color: white; }
        .sidebar .theme-toggle-section { margin-top: auto; padding-top: 20px; border-top: 1px solid rgba(255, 255, 255, 0.2); }
        .sidebar .theme-toggle-section p { font-size: 0.85rem; color: rgba(255, 255, 255, 0.8); margin-bottom: 10px; text-align: center; }
        .theme-switch-buttons { display: flex; background-color: rgba(0, 0, 0, 0.2); border-radius: 50px; padding: 4px; }
        .theme-switch-buttons button { flex: 1; background: transparent; border: none; color: white; padding: 8px 10px; border-radius: 50px; cursor: pointer; font-size: 0.8rem; transition: background-color 0.3s ease, color 0.3s ease; }
        .theme-switch-buttons button.active { background-color: white; color: var(--admin-primary-color); font-weight: 600; }


        .main-content-wrapper { /* Wrapper baru untuk konten utama */
            margin-left: 260px; /* Sesuaikan dengan lebar sidebar */
            padding: 0; /* Padding akan dihandle oleh header dan content-fluid */
            width: calc(100% - 260px); /* Lebar sisa setelah sidebar */
            transition: margin-left 0.3s ease-in-out, width 0.3s ease-in-out;
            flex-grow: 1; /* Agar mengisi sisa ruang jika body display:flex */
        }
        .main-content-wrapper.collapsed {
            margin-left: 0;
            width: 100%;
        }
        .main-header {
            background-color: white; /* Atau var(--admin-primary-color) jika ingin header biru */
            color: #333; /* Atau white jika header biru */
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #dee2e6;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }

        .hamburger-btn {
            background: transparent;
            border: none;
            font-size: 1.25rem;
            cursor: pointer;
            color: #0c4c84; /* Warna ikon hamburger */
            padding: 0.5rem;
            margin-right: 1rem;
        }
        .page-title {
            font-size: 1.5rem; /* h2 like */
            font-weight: 600;
            margin-bottom: 0;
             color: var(--admin-primary-color); /* Judul halaman berwarna biru */
        }
        .actual-content {
            padding: 1.5rem; /* Padding untuk konten di bawah header */
        }

    </style>
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
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
        </li>
    </ul>

    <div class="nav-section-title">Master</div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.comments.index') ? 'active' : '' }}" href="{{ route('admin.comments.index') }}">
                <i class="fas fa-comments"></i> Management Data
            </a>
        </li>
    </ul>

    <ul class="nav flex-column mt-auto mb-3">
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('adminSidebar');
        const mainContentWrapper = document.getElementById('mainContentWrapper');
        const sidebarToggleBtn = document.getElementById('sidebarToggleBtn');

        if (sidebarToggleBtn) {
            sidebarToggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                mainContentWrapper.classList.toggle('collapsed');
            });
        }

        // Responsive: sembunyikan sidebar secara default di layar kecil
        function checkScreenWidth() {
            if (window.innerWidth < 992) { // md breakpoint
                if (!sidebar.classList.contains('collapsed')) {
                    sidebar.classList.add('collapsed');
                    mainContentWrapper.classList.add('collapsed');
                }
            } else {
                // Di layar besar, jika sebelumnya 'collapsed' karena resize,
                // bisa dipertimbangkan untuk membukanya kembali atau biarkan user yang kontrol.
                // Untuk sekarang, biarkan state 'collapsed' jika sudah di-set manual.
            }
        }
        checkScreenWidth(); // Panggil saat load
        window.addEventListener('resize', checkScreenWidth); // Panggil saat resize

        // Theme toggle buttons (hanya UI, belum ada fungsionalitas ganti tema)
        const lightThemeAdminBtn = document.getElementById('lightThemeAdmin');
        const darkThemeAdminBtn = document.getElementById('darkThemeAdmin');
        if(lightThemeAdminBtn && darkThemeAdminBtn) {
            lightThemeAdminBtn.addEventListener('click', function() {
                lightThemeAdminBtn.classList.add('active');
                darkThemeAdminBtn.classList.remove('active');
                // TODO: Tambahkan logika ganti tema ke light
                console.log('Admin Light theme selected');
            });
            darkThemeAdminBtn.addEventListener('click', function() {
                darkThemeAdminBtn.classList.add('active');
                lightThemeAdminBtn.classList.remove('active');
                // TODO: Tambahkan logika ganti tema ke dark
                console.log('Admin Dark theme selected');
            });
        }
    });
</script>
@stack('scripts')
</body>
</html>
