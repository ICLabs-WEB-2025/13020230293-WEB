{{-- File: resources/views/partials/sidebar.blade.php --}}
<div id="sidebar" class="sidebar">
    <div class="logo">
       <img src="{{ asset('images/logo sma angkasa.png') }}" alt="Logo">
        <div class="logo-text">
            <h5>Siswa293</h5>
            <small>siswa293@example.com</small>
        </div>
    </div>

    <div class="section-title">MAIN</div>
    <div class="menu-item">
        <a href="{{ route('landing') }}">
            <i class="fas fa-home"></i> Home
        </a>
    </div>

    <div class="section-title">MASTER</div>
    <div class="menu-item">
        <a href="javascript:void(0);">
            <i class="fas fa-user-graduate"></i> Student
        </a>
        <div class="submenu">
            <div class="menu-item">
                <a href="{{ route('comments.index') }}" class="{{ request()->routeIs('comments.index') ? 'active' : '' }}">
                    <i class="fas fa-database"></i> Student Data
                </a>
            </div>
            <div class="menu-item">
                <a href="{{ route('comments.listAll') }}" class="{{ request()->routeIs('comments.listAll') ? 'active' : '' }}">
                    <i class="fas fa-comments"></i> Daftar Comment
                </a>
            </div>
        </div>
    </div>

    <!-- Theme Toggle inside Sidebar -->
    <div class="theme-toggle">
        <p>Tampilan</p>
        <div class="theme-switch-buttons">
            <button id="lightTheme" class="active">Light</button>
            <button id="darkTheme">Dark</button>
        </div>
    </div>
</div>
