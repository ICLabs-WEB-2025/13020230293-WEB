<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#5887B2">
    <title>Landing Page - Suara Siswa</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #5887B2;
            --primary-dark: #3c6a96;
            --primary-light: #7ba7d0;
            --secondary-color: #448bb9;
            --light-bg: #f8f9fa;
            --dark-text: #343a40;
            --light-text: #f8f9fa;
        }

        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            color: var(--dark-text);
            background-color: #fff;
        }

        /* Navbar styling */
        .navbar {
            background-color: transparent !important;
            transition: all 0.3s ease-in-out;
            padding: 20px 0;
        }

        .navbar.scrolled {
            background-color: white !important;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
        }

        .navbar.scrolled .navbar-brand,
        .navbar.scrolled .nav-link {
            color: var(--dark-text) !important;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.8rem;
            color: var(--light-text);
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }

        .nav-link {
            font-weight: 500;
            color: var(--light-text) !important;
            margin: 0 10px;
            position: relative;
            transition: all 0.3s;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--secondary-color);
            transition: width 0.3s;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        .navbar-toggler {
            border: none;
            padding: 0;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .login-btn {
            font-weight: 600;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            transition: all 0.3s;
        }

        .login-btn:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(88, 135, 178, 0.2);
        }

        .navbar.scrolled .login-btn {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .navbar.scrolled .login-btn:hover {
            background-color: var(--primary-color);
            color: white;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-light));
            color: white;
            padding: 180px 0 100px;
            position: relative;
            overflow: hidden;
        }

        .hero-waves {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            min-height: 100px;
            margin-bottom: -7px;
        }

        .parallax>use {
            animation: move-forever 25s cubic-bezier(.55, .5, .45, .5) infinite;
        }

        .parallax>use:nth-child(1) {
            animation-delay: -2s;
            animation-duration: 7s;
            fill: rgba(255, 255, 255, 0.7);
        }

        .parallax>use:nth-child(2) {
            animation-delay: -3s;
            animation-duration: 10s;
            fill: rgba(255, 255, 255, 0.5);
        }

        .parallax>use:nth-child(3) {
            animation-delay: -4s;
            animation-duration: 13s;
            fill: rgba(255, 255, 255, 0.3);
        }

        .parallax>use:nth-child(4) {
            animation-delay: -5s;
            animation-duration: 20s;
            fill: rgba(255, 255, 255, 1);
        }

        @keyframes move-forever {
            0% {
                transform: translate3d(-90px, 0, 0);
            }

            100% {
                transform: translate3d(85px, 0, 0);
            }
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .hero-btn {
            padding: 12px 30px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 50px;
            background-color: var(--secondary-color);
            border: none;
            color: white;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.3);
        }

        .hero-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
            background-color: rgb(212, 212, 212);
            color: rgb(7, 5, 5);

        }

        .hero-img {
            max-width: 100%;
            height: auto;
            border: 5px solid white;
            transition: all 0.5s ease;
        }

        .hero-img:hover {
            transform: scale(1.02);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2) !important;
        }

        /* Features Section */
        .features-section {
            padding: 80px 0;
            background-color: var(--light-bg);
        }

        .section-title {
            position: relative;
            margin-bottom: 60px;
            text-align: center;
        }

        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: -15px;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: var(--primary-color);
        }

        .feature-box {
            text-align: center;
            padding: 30px 20px;
            border-radius: 10px;
            background-color: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            height: 100%;
        }

        .feature-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            height: 70px;
            width: 70px;
            margin: 0 auto 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: white;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            border-radius: 50%;
            box-shadow: 0 5px 15px rgba(88, 135, 178, 0.3);
        }

        .feature-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .feature-text {
            color: #6c757d;
            font-size: 0.95rem;
        }

        /* Testimonials Section */
        .testimonials-section {
            padding: 80px 0;
            background-color: white;
        }

        .testimonial-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            padding: 30px;
            margin-bottom: 30px;
            position: relative;
            border-top: 4px solid var(--primary-color);
        }

        .testimonial-img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary-light);
        }

        .testimonial-text {
            margin-top: 20px;
            color: #6c757d;
            font-size: 0.95rem;
            font-style: italic;
        }

        .testimonial-name {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 3px;
        }

        .testimonial-position {
            color: #6c757d;
            font-size: 0.85rem;
        }

        /* CTA Section */
        .cta-section {
            padding: 100px 0;
            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(35, 132, 201, 0.7)), url('https://source.unsplash.com/random/1920x1080/?classroom');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
        }

        .cta-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .cta-text {
            font-size: 1.1rem;
            margin-bottom: 30px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            opacity: 0.9;
        }

        /* Footer */
        .footer {
            background-color: #343a40;
            color: white;
            padding: 60px 0 20px;
        }

        .footer-logo {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .footer-text {
            font-size: 0.95rem;
            opacity: 0.8;
            margin-bottom: 25px;
        }

        .footer-links h5 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-links h5::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 40px;
            height: 2px;
            background-color: var(--primary-light);
        }

        .footer-links ul {
            list-style: none;
            padding-left: 0;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: #adb5bd;
            text-decoration: none;
            transition: all 0.3s;
        }

        .footer-links a:hover {
            color: white;
            padding-left: 5px;
        }

        .social-icons {
            margin-top: 20px;
        }

        .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            margin-right: 10px;
            transition: all 0.3s;
        }

        .social-icons a:hover {
            background-color: var(--primary-color);
            transform: translateY(-3px);
        }

        .copyright {
            text-align: center;
            padding-top: 20px;
            margin-top: 40px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.9rem;
            color: #adb5bd;
        }

        /* Statistik Counter */
        .counter-box {
            text-align: center;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            margin-bottom: 30px;
        }

        .counter-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .counter-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .counter-title {
            font-size: 1rem;
            color: #6c757d;
        }

        /* Modal Login */
        .modal-login .modal-header {
            background-color: var(--primary-color);
            color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .modal-login .btn-close {
            filter: brightness(0) invert(1);
        }

        .modal-login .modal-footer {
            justify-content: center;
        }

        .modal-login .btn-submit {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 10px 30px;
            font-weight: 500;
        }

        .modal-login .btn-submit:hover {
            background-color: var(--primary-dark);
        }

        .modal-login .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(88, 135, 178, 0.25);
        }

        .modal-login .forgot-link {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
        }

        .modal-login .forgot-link:hover {
            text-decoration: underline;
        }

        /* Responsive Adjustments */
        @media (max-width: 991.98px) {
            .navbar {
                background-color: white !important;
                padding: 10px 0;
            }

            .navbar-brand,
            .nav-link {
                color: var(--dark-text) !important;
            }

            .navbar-toggler-icon {
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(0, 0, 0, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            }

            .hero-section {
                padding: 120px 0 80px;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-img {
                margin-top: 40px;
            }
        }

        @media (max-width: 767.98px) {
            .hero-section {
                text-align: center;
                padding: 100px 0 70px;
            }

            .hero-title {
                font-size: 2rem;
            }

            .hero-waves {
                height: 50px;
                min-height: 50px;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            .cta-title {
                font-size: 2rem;
            }

            .footer {
                text-align: center;
            }

            .footer-links h5::after {
                left: 50%;
                transform: translateX(-50%);
            }
        }

        @media (max-width: 575.98px) {
            .hero-title {
                font-size: 1.75rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .hero-btn {
                padding: 10px 25px;
                font-size: 0.9rem;
            }

            .section-title h2 {
                font-size: 1.75rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logo sma angkasa.png') }}" alt="Logo" style="height: 50px; margin-right: 15px;"
                    class="d-inline-block align-top"> SMA ANGKASA
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonials">Testimonial</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('comments.index') }}">Suara Siswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Kontak</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-light rounded-pill px-4 login-btn" href="#" data-bs-toggle="modal"
                            data-bs-target="#loginModal">
                            <i class="fas fa-user me-1"></i> Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section with Wave Animation -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000">
                    <h1 class="hero-title">Suarakan Pendapatmu, Bangun Sekolah Bersama</h1>
                    <p class="hero-subtitle">Platform digital untuk berbagi aspirasi, ide, dan masukan demi kemajuan SMA
                        Angkasa Maros dan pendidikan yang lebih baik.</p>
                    <a href="{{ route('comments.index') }}" class="btn hero-btn">Berikan Suaramu Sekarang</a>
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <img src="{{ asset('images/Hand drawn school students indonesian national education day illustration _ Premium Vector 1.png') }}" alt="Logo">
            </div>
        </div>

        <!-- Wave Animation -->
        <div class="hero-waves">
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="gentle-wave"
                        d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="parallax">
                    <use xlink:href="#gentle-wave" x="48" y="0" />
                    <use xlink:href="#gentle-wave" x="48" y="3" />
                    <use xlink:href="#gentle-wave" x="48" y="5" />
                    <use xlink:href="#gentle-wave" x="48" y="7" />
                </g>
            </svg>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-duration="800">
                    <div class="counter-box">
                        <div class="counter-value">1234</div>
                        <div class="counter-title">Siswa Aktif</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                    <div class="counter-box">
                        <div class="counter-value">2300+</div>
                        <div class="counter-title">Suara Tersalurkan</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="counter-box">
                        <div class="counter-value">85%</div>
                        <div class="counter-title">Tingkat Respons</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
                    <div class="counter-box">
                        <div class="counter-value">45+</div>
                        <div class="counter-title">Perubahan Positif</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features-section">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Fitur Utama</h2>
                <p>Berbagai fitur menarik yang memudahkan siswa menyampaikan aspirasi</p>
            </div>

            <div class="row">
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-duration="800">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-comment-dots"></i>
                        </div>
                        <h3 class="feature-title">Komentar Real-time</h3>
                        <p class="feature-text">Sampaikan pendapat, saran, dan kritik yang langsung dapat dilihat dan
                            ditanggapi.</p>
                    </div>
                </div>

                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <h3 class="feature-title">Privasi Terjamin</h3>
                        <p class="feature-text">Dengan sistem yang aman, identitas siswa tetap terlindungi saat
                            memberikan masukan sensitif.</p>
                    </div>
                </div>

                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="feature-title">Analisis Respons</h3>
                        <p class="feature-text">Sistem analisis canggih untuk mengelompokkan dan memprioritaskan
                            masukan siswa.</p>
                    </div>
                </div>

                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <h3 class="feature-title">Kampanye Aspirasi</h3>
                        <p class="feature-text">Fitur untuk mengumpulkan dukungan dari siswa lain untuk ide-ide
                            perbaikan yang penting.</p>
                    </div>
                </div>

                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h3 class="feature-title">Laporan Kemajuan</h3>
                        <p class="feature-text">Lihat status dari saran yang telah disampaikan dan tindak lanjut dari
                            pihak sekolah.</p>
                    </div>
                </div>

                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="500">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h3 class="feature-title">Akses Multiperangkat</h3>
                        <p class="feature-text">Akses Suara Siswa dari berbagai perangkat dengan tampilan yang
                            responsif dan optimal.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials-section">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Testimonial Siswa</h2>
                <p>Apa kata mereka tentang platform Suara Siswa</p>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="800">
                    <div class="testimonial-card">
                        <div class="d-flex align-items-center">
                            <img src="https://randomuser.me/api/portraits/men/41.jpg" alt="Testimonial"
                                class="testimonial-img">
                            <div class="ms-3">
                                <h5 class="testimonial-name">Ahmad Ridwan</h5>
                                <p class="testimonial-position">Kelas 11 IPA</p>
                            </div>
                        </div>
                        <p class="testimonial-text">"Saya senang akhirnya ada platform di mana suara kami benar-benar
                            didengar. Saran saya tentang perbaikan laboratorium komputer ditanggapi dengan sangat baik."
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                    <div class="testimonial-card">
                        <div class="d-flex align-items-center">
                            <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Testimonial"
                                class="testimonial-img">
                            <div class="ms-3">
                                <h5 class="testimonial-name">Siti Rahma</h5>
                                <p class="testimonial-position">Kelas 12 IPS</p>
                            </div>
                        </div>
                        <p class="testimonial-text">"Platform ini membantu saya yang pemalu untuk berani menyampaikan
                            ide. Saya bisa memberikan masukan tanpa harus berbicara di depan umum. Terima kasih Suara
                            Siswa!"</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="testimonial-card">
                        <div class="d-flex align-items-center">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Testimonial"
                                class="testimonial-img">
                            <div class="ms-3">
                                <h5 class="testimonial-name">Deni Kurniawan</h5>
                                <p class="testimonial-position">Kelas 10 IPS</p>
                            </div>
                        </div>
                        <p class="testimonial-text">"Setelah saya dan teman-teman mengusulkan kegiatan ekskul baru
                            melalui Suara Siswa, dalam waktu sebulan ekskul tersebut sudah terbentuk. </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container" data-aos="fade-up">
            <h2 class="cta-title">Jadilah Bagian dari Perubahan</h2>
            <p class="cta-text">Bergabunglah dengan ribuan siswa lainnya yang telah memberikan suara mereka untuk
                menciptakan lingkungan sekolah yang lebih baik. Setiap pendapat penting, termasuk pendapatmu!</p>
            <a href="{{ route('comments.index') }}" class="btn hero-btn">Mulai Bersuara Sekarang</a>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-5">
                    <h3 class="footer-logo">
                        <img src="{{ asset('images/logo sma angkasa.png') }}" alt="Logo" style="height: 50px; margin-right: 15px;">
                        SMA ANGKASA
                    </h3>
                    <p class="footer-text">Platform digital untuk menyalurkan aspirasi siswa dan membangun komunikasi
                        yang lebih baik antara siswa dan SMA Negeri Pangkajene Maros.</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 mb-5 footer-links">
                    <h5>Navigation</h5>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#features">Fitur</a></li>
                        <li><a href="#testimonials">Testimonial</a></li>
                        <li><a href="{{ route('comments.index') }}">Suara Siswa</a></li>
                        <li><a href="#contact">Kontak</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-5 footer-links">
                    <h5>Tautan Terkait</h5>
                    <ul>
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Bantuan</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-5 footer-links">
                    <h5>Kontak</h5>
                    <ul>
                        <li><i class="fas fa-map-marker-alt me-2"></i> Lanud Sultan, Jl. Dakota, Hasanuddin, Kec.
                            Mandai, Kabupaten Maros, Sulawesi Selatan</li>
                        <li><i class="fas fa-phone me-2"></i> (0410) xxxxxxxx</li>
                        <li><i class="fas fa-envelope me-2"></i> info@smangkasamaros.sch.id</li>
                        <li><i class="fas fa-clock me-2"></i> Senin - Jumat: 07:00 - 15:00</li>
                    </ul>
                </div>
            </div>

            <div class="copyright">
                <p>&copy; 2025 Suara Siswa SMA Angkasa Maros, Lanud Sultan Hasanuddin. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Modal Login -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-login">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login Suara Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Perlu diubah pada resources/views/landingpage.blade.php --}}
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            {{-- Tambahkan value="{{ old('email') }}" --}}
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" placeholder="Masukkan email" required
                                value="{{ old('email') }}">
                            {{-- Tampilkan pesan error untuk email --}}
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Masukkan password" required>
                            {{-- Tampilkan pesan error untuk password (jarang, karena error biasanya dikaitkan ke field email oleh AuthController) --}}
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe"
                                {{ old('rememberMe') ? 'checked' : '' }}>
                            <label class="form-check-label" for="rememberMe">Ingat saya</label>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        // Initialize AOS Animation
        AOS.init();

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 70,
                        behavior: 'smooth'
                    });

                    // Close navbar collapse on mobile
                    const navbarCollapse = document.querySelector('.navbar-collapse');
                    if (navbarCollapse.classList.contains('show')) {
                        navbarCollapse.classList.remove('show');
                    }
                }
            });
        });

        // Active link highlighting
        const sections = document.querySelectorAll('section[id]');

        function highlightNavLink() {
            const scrollY = window.pageYOffset;

            sections.forEach(section => {
                const sectionHeight = section.offsetHeight;
                const sectionTop = section.offsetTop - 100;
                const sectionId = section.getAttribute('id');

                if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
                    document.querySelector('.navbar-nav a[href*=' + sectionId + ']').classList.add('active');
                } else {
                    document.querySelector('.navbar-nav a[href*=' + sectionId + ']').classList.remove('active');
                }
            });
        }

        window.addEventListener('scroll', highlightNavLink);
    </script>
</body>

</html>
