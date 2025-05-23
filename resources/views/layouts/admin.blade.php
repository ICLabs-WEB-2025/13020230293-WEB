<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title', 'Dashboard')</title> {{-- Default title --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- File: resources/views/layouts/admin.blade.php --}}
{{-- ... (bagian <head> lainnya) ... --}}
<style>
    :root {
        /* Variabel Warna Utama dari Suara Siswa */
        --ss-primary-color: #5887B2;
        --ss-primary-dark: #2c5277; /* Ini untuk sidebar Suara Siswa jika dark, bisa kita adopsi untuk admin sidebar dark jika mau */
        --ss-primary-light: #7ba7d0;

        /* Variabel Tema Light (diambil dari Suara Siswa) */
        --ss-bg-light: #f8f9fa;
        --ss-card-light: #fff;
        --ss-text-light: #333;
        --ss-border-light: #dee2e6;

        /* Variabel Tema Dark (diambil dari Suara Siswa) */
        --ss-bg-dark: #121212;
        --ss-card-dark: #2a2a2a;
        --ss-text-dark: #e0e0e0;
        --ss-border-dark: #444;

        /* Variabel Admin Panel - Default ke Light Mode (menggunakan variabel Suara Siswa) */
        --admin-primary-color: var(--ss-primary-color);
        --admin-sidebar-bg: var(--ss-primary-color); /* Sidebar admin tetap biru */
        --admin-sidebar-text: white;
        --admin-sidebar-link-hover-bg: rgba(255, 255, 255, 0.15);

        --admin-content-bg: var(--ss-bg-light);
        --admin-main-header-bg: var(--ss-card-light); /* Header pakai warna kartu light */
        --admin-main-header-text: var(--ss-text-light);
        --admin-main-header-border: var(--ss-border-light);
        --admin-page-title-text: var(--admin-primary-color);
        --admin-hamburger-btn-color: #0c4c84; /* Anda punya warna ini, bisa disesuaikan */
        --admin-card-bg: var(--ss-card-light);
        --admin-card-text: var(--ss-text-light);
        --admin-card-border: var(--ss-border-light);
        --admin-table-text: var(--ss-text-light); /* Bootstrap text-muted untuk dark mode perlu override */
        --admin-table-header-bg: #f8f9fa; /* Mirip --ss-bg-light atau lebih spesifik */
        --admin-link-color: var(--admin-primary-color);
        --admin-text-muted-color: #6c757d;
    }

    body.dark-theme-admin {
        /* Override Variabel Admin Panel untuk Dark Mode (menggunakan variabel Suara Siswa) */
        /* Sidebar admin bisa tetap biru, atau menggunakan --ss-primary-dark jika ingin sedikit beda di dark mode */
        /* --admin-sidebar-bg: var(--ss-primary-dark); */

        --admin-content-bg: var(--ss-bg-dark);
        --admin-main-header-bg: var(--ss-card-dark); /* Header pakai warna kartu dark */
        --admin-main-header-text: var(--ss-text-dark);
        --admin-main-header-border: var(--ss-border-dark);
        --admin-page-title-text: var(--ss-primary-light); /* Biru lebih terang agar kontras di dark mode */
        --admin-hamburger-btn-color: var(--ss-text-dark);
        --admin-card-bg: var(--ss-card-dark);
        --admin-card-text: var(--ss-text-dark);
        --admin-card-border: var(--ss-border-dark);
        --admin-table-text: var(--ss-text-dark);
        --admin-table-header-bg: #343a40; /* Warna yang lebih gelap untuk header tabel dark mode */
        --admin-link-color: var(--ss-primary-light); /* Link biru lebih terang */
        --admin-text-muted-color: #868e96; /* text-muted lebih terang */
    }

    /* CSS Anda yang sudah ada sebelumnya, pastikan menggunakan variabel di atas */
    body {
        font-family: 'Poppins', sans-serif; /* Font Poppins Anda sebelumnya */
        background-color: var(--admin-content-bg);
        display: flex;
        transition: background-color 0.3s ease, color 0.3s ease; /* Tambahkan transisi color untuk teks body */
        color: var(--admin-card-text); /* Teks body utama mengikuti tema */
    }

    .sidebar {
        /* ... (style sidebar Anda yang sudah ada, pastikan background-color: var(--admin-sidebar-bg); etc.) ... */
        height: 100vh;
        width: 260px;
        position: fixed;
        top: 0;
        left: 0;
        background-color: var(--admin-sidebar-bg);
        padding: 20px;
        color: var(--admin-sidebar-text);
        transition: margin-left 0.3s ease-in-out, left 0.3s ease-in-out;
        z-index: 1030;
        display: flex;
        flex-direction: column;
        overflow-y: auto;
    }
    .sidebar.collapsed { margin-left: -260px; }
    .sidebar .admin-info { display: flex; align-items: center; padding-bottom: 15px; margin-bottom: 15px; border-bottom: 1px solid rgba(255, 255, 255, 0.2); }
    .sidebar .admin-info img.admin-avatar { height: 50px; width: 50px; border-radius: 50%; margin-right: 15px; border: 2px solid white; object-fit: cover; }
    .sidebar .admin-info .admin-details h5 { margin-bottom: 2px; font-size: 1rem; font-weight: 600; color: var(--admin-sidebar-text); } /* Menggunakan variabel */
    .sidebar .admin-info .admin-details small { font-size: 0.8rem; color: rgba(255, 255, 255, 0.8); }
    .sidebar .nav-section-title { font-size: 0.75rem; font-weight: 600; text-transform: uppercase; color: rgba(255, 255, 255, 0.6); padding: 15px 0 5px 0; }
    .sidebar .nav-link { color: rgba(255, 255, 255, 0.8); margin-bottom: 8px; padding: 10px 15px; border-radius: 0.375rem; display: flex; align-items: center; transition: background-color 0.2s ease, color 0.2s ease; }
    .sidebar .nav-link i { margin-right: 10px; width: 20px; text-align: center; }
    .sidebar .nav-link.active, .sidebar .nav-link:hover { color: var(--admin-sidebar-text); background-color: var(--admin-sidebar-link-hover-bg); font-weight: 500; } /* Menggunakan variabel */
    .sidebar .nav-link.btn-logout { color: #ffdddd; }
    .sidebar .nav-link.btn-logout:hover { background-color: #7199BD; color: var(--admin-sidebar-text); }
    .sidebar .theme-toggle-section { margin-top: auto; padding-top: 20px; border-top: 1px solid rgba(255, 255, 255, 0.2); }
    .sidebar .theme-toggle-section p { font-size: 0.85rem; color: rgba(255, 255, 255, 0.8); margin-bottom: 10px; text-align: center; }
    .theme-switch-buttons { display: flex; background-color: rgba(0, 0, 0, 0.2); border-radius: 50px; padding: 4px; }
    .theme-switch-buttons button { flex: 1; background: transparent; border: none; color: var(--admin-sidebar-text); padding: 8px 10px; border-radius: 50px; cursor: pointer; font-size: 0.8rem; transition: background-color 0.3s ease, color 0.3s ease; } /* Menggunakan variabel */
    .theme-switch-buttons button.active { background-color: var(--admin-sidebar-text); color: var(--admin-primary-color); font-weight: 600; } /* Menggunakan variabel */

    .main-content-wrapper {
        margin-left: 260px;
        padding: 0;
        width: calc(100% - 260px);
        transition: margin-left 0.3s ease-in-out, width 0.3s ease-in-out, background-color 0.3s ease;
        flex-grow: 1;
        background-color: var(--admin-content-bg);
    }
    .main-content-wrapper.collapsed { margin-left: 0; width: 100%; }

    .main-header {
        background-color: var(--admin-main-header-bg);
        color: var(--admin-main-header-text);
        padding: 0.75rem 1.5rem;
        display: flex;
        align-items: center;
        border-bottom: 1px solid var(--admin-main-header-border);
        box-shadow: 0 2px 4px rgba(0, 0, 0, .1); /* Anda menambahkan shadow ini, bagus */
        transition: background-color 0.3s ease, color 0.3s ease, border-bottom-color 0.3s ease;
    }

    .hamburger-btn {
        background: transparent;
        border: none;
        font-size: 1.25rem;
        cursor: pointer;
        color: var(--admin-hamburger-btn-color);
        padding: 0.5rem;
        margin-right: 1rem;
        transition: color 0.3s ease;
    }

    .page-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0;
        color: var(--admin-page-title-text);
        transition: color 0.3s ease;
    }

    .actual-content {
        padding: 1.5rem;
        color: var(--admin-card-text); /* Teks umum di konten */
    }
    body.dark-theme-admin .actual-content { /* Pastikan teks umum juga berubah */
        color: var(--admin-card-text);
    }

    /* Style untuk Card, Table, dll. dari respons sebelumnya yang sudah menggunakan variabel */
    /* Card Styling */
    .card {
        background-color: var(--admin-card-bg) !important;
        color: var(--admin-card-text) !important;
        border: 1px solid var(--admin-card-border) !important;
        transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
    }
    .card-header {
        background-color: color-mix(in srgb, var(--admin-card-bg) 95%, #808080) !important;
        border-bottom: 1px solid var(--admin-card-border) !important;
        transition: background-color 0.3s ease, border-bottom-color 0.3s ease;
        color: var(--admin-card-text) !important; /* Tambahkan ini agar teks header card ikut tema */
    }
     .card .card-title,
    .card-header h1, .card-header h2, .card-header h3, .card-header h4, .card-header h5, .card-header h6,
    .card-body h1, .card-body h2, .card-body h3, .card-body h4, .card-body h5, .card-body h6 {
        color: var(--admin-card-text) !important;
        transition: color 0.3s ease;
    }
    .card .text-muted { /* Target spesifik untuk text-muted di dalam card */
        color: var(--admin-text-muted-color) !important;
        transition: color 0.3s ease;
    }

    /* Table Styling */
    .table {
        color: var(--admin-table-text) !important;
        transition: color 0.3s ease;
    }
    .table th,
    .table td {
         border-color: var(--admin-card-border) !important;
         transition: border-color 0.3s ease;
    }
    .table > :not(caption) > * > * {
        background-color: var(--admin-card-bg);
        color: var(--admin-table-text);
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    .table-hover > tbody > tr:hover > * {
        background-color: color-mix(in srgb, var(--admin-card-bg) 90%, #808080);
        color: var(--admin-table-text);
    }
    thead.table-light th {
        background-color: var(--admin-table-header-bg) !important;
        color: var(--admin-card-text) !important;
        border-color: var(--admin-card-border) !important;
        transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
    }

    /* List Group Styling */
    .list-group-item {
        background-color: var(--admin-card-bg) !important;
        color: var(--admin-card-text) !important;
        border-color: var(--admin-card-border) !important;
        transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
    }

    /* Alert Styling (Contoh untuk alert success) */
    .alert-success {
        /* Menggunakan variabel bootstrap agar lebih mudah jika bootstrap punya dark mode sendiri nantinya */
        /* Atau definisikan warna spesifik menggunakan var() kita */
        background-color: var(--bs-success-bg-subtle);
        border-color: var(--bs-success-border-subtle);
        color: var(--bs-success-text);
    }
     body.dark-theme-admin .alert-success {
        background-color: color-mix(in srgb, var(--bs-success) 20%, var(--admin-card-bg)); /* contoh custom */
        border-color: color-mix(in srgb, var(--bs-success) 30%, var(--admin-card-bg));
        color: color-mix(in srgb, var(--bs-success) 90%, #fff);
    }


    /* General Link Styling */
    .actual-content a:not(.btn) {
        color: var(--admin-link-color);
        transition: color 0.3s ease;
    }
    .actual-content a:not(.btn):hover {
        color: color-mix(in srgb, var(--admin-link-color) 80%, black);
    }
    body.dark-theme-admin .actual-content a:not(.btn):hover {
        color: color-mix(in srgb, var(--admin-link-color) 80%, white);
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

   {{-- File: resources/views/layouts/admin.blade.php --}}
{{-- ... (bagian atas file, <head>, <style>, <nav class="sidebar">, <div class="main-content-wrapper">) ... --}}

{{-- File: resources/views/layouts/admin.blade.php --}}
{{-- ... (bagian atas file HTML, <head>, <style>, <nav>, <div class="main-content-wrapper">) ... --}}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('adminSidebar');
        const mainContentWrapper = document.getElementById('mainContentWrapper');
        const sidebarToggleBtn = document.getElementById('sidebarToggleBtn');

        // --- Sidebar Toggle Functionality (Sama seperti sebelumnya) ---
        if (sidebarToggleBtn && sidebar && mainContentWrapper) {
            sidebarToggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                mainContentWrapper.classList.toggle('collapsed');
                if (sidebar.classList.contains('collapsed')) {
                    localStorage.setItem('adminSidebarCollapsed', 'true');
                } else {
                    localStorage.removeItem('adminSidebarCollapsed');
                }
            });
        }
        if (localStorage.getItem('adminSidebarCollapsed') === 'true' && sidebar && mainContentWrapper) {
            sidebar.classList.add('collapsed');
            mainContentWrapper.classList.add('collapsed');
        }
        function checkScreenWidth() {
            if (sidebar && mainContentWrapper) {
                if (window.innerWidth < 992) {
                    if (!sidebar.classList.contains('collapsed')) {
                        sidebar.classList.add('collapsed');
                        mainContentWrapper.classList.add('collapsed');
                    }
                } else {
                    if (localStorage.getItem('adminSidebarCollapsed') !== 'true') {
                         sidebar.classList.remove('collapsed');
                         mainContentWrapper.classList.remove('collapsed');
                    }
                }
            }
        }
        checkScreenWidth();
        window.addEventListener('resize', checkScreenWidth);

        // --- Theme Toggle Functionality ---
        const lightThemeAdminBtn = document.getElementById('lightThemeAdmin');
        const darkThemeAdminBtn = document.getElementById('darkThemeAdmin');
        const bodyElement = document.body;

        // Untuk menyimpan instance chart yang aktif
        window.adminActiveCharts = {}; // e.g., window.adminActiveCharts.lineChart, window.adminActiveCharts.barChart

        // Fungsi untuk mendapatkan palet warna chart berdasarkan tema
        function getChartThemeColors(theme) {
            const isAdminPrimaryColor = getComputedStyle(document.documentElement).getPropertyValue('--admin-primary-color').trim() || '#5887B2';
            const isAdminPrimaryLightColor = getComputedStyle(document.documentElement).getPropertyValue('--ss-primary-light').trim() || '#7ba7d0'; // Dari variabel Suara Siswa Anda

            if (theme === 'dark') {
                return {
                    gridColor: 'rgba(255, 255, 255, 0.15)',
                    ticksColor: '#adb5bd', // Warna teks muted di dark mode Anda
                    legendColor: '#e0e0e0', // Warna teks utama di dark mode Anda
                    datasetLineBorderColor: isAdminPrimaryLightColor, // Biru lebih terang untuk garis/border di dark
                    datasetLineBackgroundColor: `rgba(${hexToRgb(isAdminPrimaryLightColor)}, 0.2)`,
                    datasetBarBackgroundColor: `rgba(${hexToRgb(isAdminPrimaryLightColor)}, 0.6)`,
                    datasetBarBorderColor: isAdminPrimaryLightColor,
                    pointBorderColor: '#fff', // Titik pada line chart
                    pointBackgroundColor: isAdminPrimaryLightColor
                };
            } else { // Light theme
                return {
                    gridColor: 'rgba(0, 0, 0, 0.1)',
                    ticksColor: '#6c757d', // Warna teks muted di light mode Anda
                    legendColor: '#333',   // Warna teks utama di light mode Anda
                    datasetLineBorderColor: isAdminPrimaryColor,
                    datasetLineBackgroundColor: `rgba(${hexToRgb(isAdminPrimaryColor)}, 0.1)`,
                    datasetBarBackgroundColor: `rgba(${hexToRgb(isAdminPrimaryColor)}, 0.7)`,
                    datasetBarBorderColor: isAdminPrimaryColor,
                    pointBorderColor: '#fff',
                    pointBackgroundColor: isAdminPrimaryColor
                };
            }
        }
        // Helper function to convert hex to rgb for rgba usage
        function hexToRgb(hex) {
            let r = 0, g = 0, b = 0;
            if (hex.length == 4) { // #RGB
                r = "0x" + hex[1] + hex[1];
                g = "0x" + hex[2] + hex[2];
                b = "0x" + hex[3] + hex[3];
            } else if (hex.length == 7) { // #RRGGBB
                r = "0x" + hex[1] + hex[2];
                g = "0x" + hex[3] + hex[4];
                b = "0x" + hex[5] + hex[6];
            }
            return `${+r},${+g},${+b}`;
        }


        // Fungsi untuk memperbarui warna pada semua chart yang aktif
        function updateAllChartThemes(theme) {
            const newColors = getChartThemeColors(theme);

            for (const chartKey in window.adminActiveCharts) {
                if (Object.hasOwnProperty.call(window.adminActiveCharts, chartKey)) {
                    const chartInstance = window.adminActiveCharts[chartKey];
                    if (chartInstance && chartInstance.options && chartInstance.data) {
                        // Update scales (axes)
                        ['x', 'y', 'r'].forEach(axis => {
                            if (chartInstance.options.scales && chartInstance.options.scales[axis]) {
                                if(chartInstance.options.scales[axis].ticks) chartInstance.options.scales[axis].ticks.color = newColors.ticksColor;
                                if(chartInstance.options.scales[axis].grid) chartInstance.options.scales[axis].grid.color = newColors.gridColor;
                                if(chartInstance.options.scales[axis].grid) chartInstance.options.scales[axis].grid.borderColor = newColors.gridColor; // Untuk beberapa versi Chart.js
                            }
                        });

                        // Update legend
                        if (chartInstance.options.plugins && chartInstance.options.plugins.legend && chartInstance.options.plugins.legend.labels) {
                            chartInstance.options.plugins.legend.labels.color = newColors.legendColor;
                        }

                        // Update dataset colors
                        chartInstance.data.datasets.forEach(dataset => {
                            if (chartInstance.config.type === 'line') {
                                dataset.borderColor = newColors.datasetLineBorderColor;
                                dataset.backgroundColor = newColors.datasetLineBackgroundColor;
                                dataset.pointBackgroundColor = newColors.pointBackgroundColor;
                                dataset.pointBorderColor = newColors.pointBorderColor;
                            } else if (chartInstance.config.type === 'bar') {
                                dataset.backgroundColor = newColors.datasetBarBackgroundColor;
                                dataset.borderColor = newColors.datasetBarBorderColor;
                            }
                            // Anda bisa menambahkan tipe chart lain jika perlu
                        });
                        chartInstance.update();
                    }
                }
            }
        }

        // Fungsi untuk menerapkan tema utama dan memperbarui chart
        function applyTheme(theme) {
            if (theme === 'dark') {
                bodyElement.classList.add('dark-theme-admin');
                if(lightThemeAdminBtn) lightThemeAdminBtn.classList.remove('active');
                if(darkThemeAdminBtn) darkThemeAdminBtn.classList.add('active');
                localStorage.setItem('adminPreferredTheme', 'dark');
            } else {
                bodyElement.classList.remove('dark-theme-admin');
                if(darkThemeAdminBtn) darkThemeAdminBtn.classList.remove('active');
                if(lightThemeAdminBtn) lightThemeAdminBtn.classList.add('active');
                localStorage.setItem('adminPreferredTheme', 'light');
            }
            updateAllChartThemes(theme); // Panggil update chart di sini
            console.log(`Admin ${theme} theme applied`);
        }

        // Terapkan tema yang tersimpan atau default saat load
        const currentTheme = localStorage.getItem('adminPreferredTheme') || 'light';
        applyTheme(currentTheme); // Ini akan otomatis mengupdate chart saat load awal

        // Event listener untuk tombol tema
        if (lightThemeAdminBtn) {
            lightThemeAdminBtn.addEventListener('click', function(e) { e.preventDefault(); applyTheme('light'); });
        }
        if (darkThemeAdminBtn) {
            darkThemeAdminBtn.addEventListener('click', function(e) { e.preventDefault(); applyTheme('dark'); });
        }
    });
</script>
@stack('scripts')
</body>
</html>
