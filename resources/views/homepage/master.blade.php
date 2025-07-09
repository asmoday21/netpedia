<!DOCTYPE html>
<html lang="en" style="scroll-behavior: smooth;">

<head>
    <meta charset="utf-8">
    <title>NetPedia</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('homepage/img/logo.png')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('homepage/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{ asset('homepage/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{ asset('homepage/lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('homepage/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('homepage/css/style.css')}}" rel="stylesheet">

    <style>
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            overflow-x: hidden;
        }
    
        .container-xxl {
            max-width: 100% !important;
            padding: 0;
        }
        /* Removed .hero-header as its properties are now handled by .telecom-hero */

        .telecom-hero {
            /* Set minimum height to 100vh for full viewport height on larger screens */
            min-height: 100vh; 
            display: flex; /* Use flexbox to center content vertically */
            align-items: center; /* Center items vertically */
            justify-content: center; /* Center items horizontally */
            padding: 4rem 0; /* Add some padding for smaller screens */
            background: linear-gradient(152deg, #0b1120 0%, #1e3a8a 100%);
            overflow: hidden;
            position: relative; /* Ensure background elements are positioned relative to this */
        }

        /* Ensure content is centered within the hero section */
        .telecom-hero .container {
            position: relative;
            z-index: 10;
            padding-top: 3rem; /* Adjust padding as flexbox handles vertical centering */
            padding-bottom: 3rem; /* Adjust padding as flexbox handles vertical centering */
        }

        .network-grid {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(to right, rgba(99, 102, 241, 0.08) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(99, 102, 241, 0.08) 1px, transparent 1px);
            background-size: 50px 50px;
        }

        .floating-dots {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 25px 25px;
            animation: float-bg 15s infinite linear; /* Renamed to avoid conflict with icon float */
        }

        .radar-scan {
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: conic-gradient(from 0deg, rgba(56, 182, 255, 0) 0%, rgba(56, 182, 255, 0.03) 5%, rgba(56, 182, 255, 0) 10%);
            animation: radar 8s linear infinite;
            z-index: 0;
        }

        .text-gradient {
            background: linear-gradient(90deg, #38b6ff 0%, #6366f1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .btn-gradient {
            background: linear-gradient(90deg, #38b6ff 0%, #6366f1 100%);
            border: none;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(56, 182, 255, 0.3);
        }

        /* Moved hero-badge style from inline to CSS */
        .hero-badge {
            color: white;
            display: inline-flex; /* Use flex to align icon and text */
            align-items: center;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            backdrop-filter: blur(5px); /* Add a subtle blur for depth */
            -webkit-backdrop-filter: blur(5px);
        }

        .hero-badge i {
            margin-right: 0.5rem;
        }

        .tech-visual {
            position: relative;
            height: 100%;
            min-height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .globe-container {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .globe {
            position: relative;
            width: 320px;
            height: 320px;
            border-radius: 50%;
            perspective: 1000px;
        }

        .ring {
            position: absolute;
            width: 100%;
            height: 100%;
            border: 1px solid rgba(56, 182, 255, 0.3);
            border-radius: 50%;
            animation: rotate 20s linear infinite;
        }

        .ring:nth-child(1) {
            transform: rotateX(65deg);
        }

        .ring:nth-child(2) {
            transform: rotateX(25deg) rotateY(15deg);
            animation-direction: reverse;
        }

        .ring:nth-child(3) {
            transform: rotateX(25deg) rotateY(-15deg);
            animation-duration: 25s;
        }

        .nodes {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .node {
            position: absolute;
            width: 10px;
            height: 10px;
            background: #38b6ff;
            border-radius: 50%;
            box-shadow: 0 0 15px #38b6ff;
            transform-origin: center;
        }

        .node:nth-child(1) { top: 10%; left: 50%; transform: translateX(-50%); }
        .node:nth-child(2) { top: 50%; right: 10%; transform: translateY(-50%); }
        .node:nth-child(3) { bottom: 10%; left: 50%; transform: translateX(-50%); }
        .node:nth-child(4) { top: 50%; left: 10%; transform: translateY(-50%); }
        .node:nth-child(5) { top: 30%; left: 30%; transform: translate(-50%, -50%); }

        .connections {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .connections::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 80%;
            height: 80%;
            transform: translate(-50%, -50%);
            background: radial-gradient(circle, rgba(56, 182, 255, 0.2) 0%, transparent 70%);
            border-radius: 50%;
            animation: pulse 4s infinite;
        }

        .floating-icons {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }

        .floating-icons i {
            position: absolute;
            color: rgba(56, 182, 255, 0.7);
            font-size: 1.5rem;
            animation: float 6s infinite ease-in-out;
        }

        .floating-icons i:nth-child(1) {
            top: 15%;
            left: 20%;
            animation-delay: 0s;
        }
        .floating-icons i:nth-child(2) {
            top: 25%;
            right: 15%;
            animation-delay: 1s;
        }
        .floating-icons i:nth-child(3) {
            bottom: 20%;
            left: 25%;
            animation-delay: 2s;
        }
        .floating-icons i:nth-child(4) {
            bottom: 30%;
            right: 20%;
            animation-delay: 3s;
        }

        @keyframes rotate {
            0% { transform: rotateX(0) rotateY(0) rotateZ(0); }
            100% { transform: rotateX(360deg) rotateY(360deg) rotateZ(360deg); }
        }

        @keyframes pulse {
            0% { opacity: 0.3; transform: translate(-50%, -50%) scale(0.95); }
            50% { opacity: 0.6; transform: translate(-50%, -50%) scale(1.05); }
            100% { opacity: 0.3; transform: translate(-50%, -50%) scale(0.95); }
        }

        @keyframes float {
            0% { transform: translateY(0) translateX(0); }
            50% { transform: translateY(-20px) translateX(10px); }
            100% { transform: translateY(0) translateX(0); }
        }

        @keyframes float-bg { /* New animation for background dots */
            0% { background-position: 0 0; }
            100% { background-position: 50px 50px; }
        }

        @keyframes radar {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @media (max-width: 992px) {
            .telecom-hero {
                min-height: auto; /* Remove min-height on small screens */
                padding: 5rem 0; /* Adjust padding for mobile */
                text-align: center;
            }
            
            .telecom-hero .container {
                padding-top: 2rem;
                padding-bottom: 2rem;
            }

            .tech-visual {
                margin-top: 3rem;
                min-height: 300px;
            }
            
            .d-flex {
                justify-content: center;
            }
            
            .border-end {
                border-right: none !important;
            }
            
            .globe {
                width: 260px;
                height: 260px;
            }
        }
    </style>
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="m-0">
                        <img src="{{ asset('homepage/img/logo.png') }}" alt="NetPedia Logo" style="height: 40px; margin-right: 10px;">
                        NetPedia<span class="fs-5"></span>
                    </h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="#" class="nav-item nav-link active">Home</a>
                        <a href="{{ route('cp-atp') }}" class="nav-item nav-link">CP/ATP</a>
                        <a href="{{ route('materi')}}" class="nav-item nav-link">Materi</a>
                        <a href="{{ route('referensi') }}" class="nav-item nav-link">Referensi</a>
                    </div>
                    <a href="{{ route('login')}}" class="btn btn-secondary text-light rounded-pill py-2 px-4 ms-3">Sign In</a>
                </div>
            </nav>
            <div class="telecom-hero bg-dark position-relative overflow-hidden">
                <div class="network-grid"></div>
                <div class="floating-dots"></div>
                <div class="radar-scan"></div>
                
                <!-- Content container for hero section -->
                <div class="container">
                    <div class="row align-items-center">
                        <!-- Text Content -->
                        <div class="col-lg-6 mb-5 mb-lg-0">
                            <div class="pe-lg-5">
                                <div class="hero-badge fade-in-up">
                                    <i class="fas fa-graduation-cap me-2"></i>
                                    SMK TJKT Kelas X
                                </div> 
                                <h1 class="text-white mb-4 animate__animated animate__fadeInUp">
                                    <span class="text-gradient">Menguasai</span> Jaringan Telekomunikasi Masa Depan
                                </h1>
                                <p class="lead text-light mb-5 animate__animated animate__fadeInUp animate__delay-1s">
                                    Pelajari dasar-dasar jaringan komputer, sistem telekomunikasi, dan teknologi digital bersama para ahli di bidangnya.
                                </p>
                                <div class="d-flex flex-wrap gap-3 animate__animated animate__fadeInUp animate__delay-2s">
                                    <a href="{{ route('register')}}" class="btn btn-gradient btn-lg rounded-pill px-4 py-3">
                                        Mulai Belajar <i class="fas fa-book-open ms-2"></i>
                                    </a>
                                </div>
                                
                                <div class="d-flex mt-5 pt-2 animate__animated animate__fadeIn animate__delay-3s">
                                    <div class="pe-4 border-end border-light border-opacity-25">
                                        <h3 class="text-white mb-1">100+</h3>
                                        <p class="text-light opacity-75 mb-0 small">Modul Pembelajaran</p>
                                    </div>
                                    <div class="px-4 border-end border-light border-opacity-25">
                                        <h3 class="text-white mb-1">Praktik</h3>
                                        <p class="text-light opacity-75 mb-0 small">Langsung di Lab</p>
                                    </div>
                                    <div class="ps-4">
                                        <h3 class="text-white mb-1">Sertifikasi</h3>
                                        <p class="text-light opacity-75 mb-0 small">Kompetensi</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Image Content -->
                        <div class="col-lg-6 animate__animated animate__fadeIn">
                            <div class="tech-visual">
                                <div class="globe-container">
                                    <div class="globe">
                                        <div class="ring"></div>
                                        <div class="ring"></div>
                                        <div class="ring"></div>
                                        <div class="nodes">
                                            <div class="node"></div>
                                            <div class="node"></div>
                                            <div class="node"></div>
                                            <div class="node"></div>
                                            <div class="node"></div>
                                        </div>
                                        <div class="connections"></div>
                                    </div>
                                </div>
                                <div class="floating-icons">
                                    <i class="fas fa-network-wired"></i>
                                    <i class="fas fa-router"></i>
                                    <i class="fas fa-server"></i>
                                    <i class="fas fa-wifi"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <!-- Navbar & Hero End -->

        <!-- About Start -->
        <div class="container-xxl py-5" id="about-us"> <!-- Menambahkan ID untuk tombol "Mulai Belajar" -->
            <div class="container px-lg-5">
                <div class="row g-5">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="section-title position-relative mb-4 pb-2">
                            <h6 class="position-relative text-primary ps-4">About Us</h6>
                            <h2 class="mt-2">Tentang NetPedia</h2>
                        </div>
                        <p class="mb-4">NetPedia adalah platform pembelajaran digital yang dirancang untuk memberikan pengalaman belajar yang lebih interaktif, dinamis, dan mudah diakses. Kami menghadirkan berbagai materi edukatif dengan pendekatan yang lebih inovatif, sehingga pembelajaran menjadi lebih menarik dan efektif.Dengan fitur video pembelajaran, latihan interaktif, dan sistem pemantauan progres, kami membantu siswa dan pendidik untuk mencapai hasil belajar yang lebih optimal. Akses kapan saja, di mana saja, dan mulai belajar dengan cara yang lebih fleksibel!</p>
                        <p class="mb-4">Dengan fitur video pembelajaran, latihan interaktif, dan sistem pemantauan progres, kami membantu siswa dan pendidik untuk mencapai hasil belajar yang lebih optimal. Akses kapan saja, di mana saja, dan mulai belajar dengan cara yang lebih fleksibel!</p>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <h6 class="mb-3"><i class="fa fa-check text-primary me-2"></i>Inovatif</h6>
                                <h6 class="mb-0"><i class="fa fa-check text-primary me-2"></i>Menyenangkan</h6>
                            </div>
                            <div class="col-sm-6">
                                <h6 class="mb-3"><i class="fa fa-check text-primary me-2"></i>Terstruktur</h6>
                                <h6 class="mb-0"><i class="fa fa-check text-primary me-2"></i>Gratis & Fleksibel</h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mt-4">
                            <a class="btn btn-primary rounded-pill px-4 me-3" href="">Read More</a>
                            <a class="btn btn-outline-primary btn-square me-3" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-primary btn-square me-3" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-primary btn-square me-3" href=""><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <img class="img-fluid wow zoomIn" data-wow-delay="0.5s" src="{{ asset('homepage/img/about.jpg')}}">
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        <!-- Newsletter Start -->
        <div class="container-xxl bg-primary newsletter my-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container px-lg-5">
                <div class="row align-items-center" style="height: 250px;">
                    <div class="col-12 col-md-6">
                        <h3 class="text-white">Ready to get started</h3>
                        <small class="text-white">Diam elitr est dolore at sanctus nonumy.</small>
                        <div class="position-relative w-100 mt-3">
                            <input class="form-control border-0 rounded-pill w-100 ps-4 pe-5" type="text" placeholder="Enter Your Email" style="height: 48px;">
                            <button type="button" class="btn shadow-none position-absolute top-0 end-0 mt-1 me-2"><i class="fa fa-paper-plane text-primary fs-4"></i></button>
                        </div>
                    </div>
                    <div class="col-md-6 text-center mb-n5 d-none d-md-block">
                        <img class="img-fluid mt-5" style="height: 250px;" src="{{ asset('homepage/img/newsletter.png')}}">
                    </div>
                </div>
            </div>
        </div>
        <!-- Newsletter End -->
        
        <!-- Portfolio Start -->
        <div class="container-xxl py-5">
            <div class="container px-lg-5">
                <div class="section-title position-relative text-center mb-5 pb-2 wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="position-relative d-inline text-primary ps-4">Our Projects</h6>
                    <h2 class="mt-2">Recently Launched Projects</h2>
                </div>
                <div class="row mt-n2 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="col-12 text-center">
                        <ul class="list-inline mb-5" id="portfolio-flters">
                            <li class="btn px-3 pe-4 active" data-filter="*">Semua</li>
                            <li class="btn px-3 pe-4" data-filter=".first">Jaringan</li>
                            <li class="btn px-3 pe-4" data-filter=".second">Telekomunikasi</li>
                        </ul>
                    </div>
                </div>

                <div class="row g-4 portfolio-container">
                    <div class="col-lg-4 col-md-6 portfolio-item first wow zoomIn" data-wow-delay="0.1s">
                        <div class="position-relative rounded overflow-hidden">
                            <img class="img-fluid w-100" src="{{ asset('homepage/img/portfolio-1.jpg')}}" alt="">
                            <div class="portfolio-overlay">
                                <a class="btn btn-light" href="{{ asset('homepage/img/portfolio-1.jpg')}}" data-lightbox="portfolio"><i class="fa fa-plus fa-2x text-primary"></i></a>
                                <div class="mt-auto">
                                    <small class="text-white"><i class="fa fa-folder me-2"></i>Debi Sartika Roza</small>
                                    <a class="h5 d-block text-white mt-1 mb-0" href="">Proses bisnis di bidang teknik jaringan komputer dan telekomunikasi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 portfolio-item second wow zoomIn" data-wow-delay="0.3s">
                        <div class="position-relative rounded overflow-hidden">
                            <img class="img-fluid w-100" src="{{ asset('homepage/img/portfolio-2.jpg')}}" alt="">
                            <div class="portfolio-overlay">
                                <a class="btn btn-light" href="{{ asset('homepage/img/portfolio-2.jpg')}}" data-lightbox="portfolio"><i class="fa fa-plus fa-2x text-primary"></i></i></a>
                                <div class="mt-auto">
                                    <small class="text-white"><i class="fa fa-folder me-2"></i>Ari Gunawan Giawa</small>
                                    <a class="h5 d-block text-white mt-1 mb-0" href="">Perkembangan teknologi di bidang teknik jaringan komputer dan telekomunikasi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 portfolio-item first wow zoomIn" data-wow-delay="0.6s">
                        <div class="position-relative rounded overflow-hidden">
                            <img class="img-fluid w-100" src="{{ asset('homepage/img/portfolio-3.jpg')}}" alt="">
                            <div class="portfolio-overlay">
                                <a class="btn btn-light" href="{{ asset('homepage/img/portfolio-3.jpg')}}" data-lightbox="portfolio"><i class="fa fa-plus fa-2x text-primary"></i></a>
                                <div class="mt-auto">
                                    <small class="text-white"><i class="fa fa-folder me-2"></i>Nadiyahtul Bariyyah</small>
                                    <a class="h5 d-block text-white mt-1 mb-0" href="">Profesi dan Kewirausahaan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 portfolio-item second wow zoomIn" data-wow-delay="0.1s">
                        <div class="position-relative rounded overflow-hidden">
                            <img class="img-fluid w-100" src="{{ asset('homepage/img/portfolio-4.jpg')}}" alt="">
                            <div class="portfolio-overlay">
                                <a class="btn btn-light" href="{{ asset('homepage/img/portfolio-4.jpg')}}" data-lightbox="portfolio"><i class="fa fa-plus fa-2x text-primary"></i></a>
                                <div class="mt-auto">
                                    <small class="text-white"><i class="fa fa-folder me-2"></i>Reski Wulandari</small>
                                    <a class="h5 d-block text-white mt-1 mb-0" href="">Keselamatan dan Kesehatan Kerja Lingkungan Hidup (K3LH) dan budaya kerja industri</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 portfolio-item first wow zoomIn" data-wow-delay="0.3s">
                        <div class="position-relative rounded overflow-hidden">
                            <img class="img-fluid w-100" src="{{ asset('homepage/img/portfolio-5.jpg')}}" alt="">
                            <div class="portfolio-overlay">
                                <a class="btn btn-light" href="{{ asset('homepage/img/portfolio-5.jpg')}}" data-lightbox="portfolio"><i class="fa fa-plus fa-2x text-primary"></i></a>
                                <div class="mt-auto">
                                    <small class="text-white"><i class="fa fa-folder me-2"></i>Ferju Prihamdani</small>
                                    <a class="h5 d-block text-white mt-1 mb-0" href="">Media dan Jaringan Telekomunikasi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 portfolio-item second wow zoomIn" data-wow-delay="0.6s">
                        <div class="position-relative rounded overflow-hidden">
                            <img class="img-fluid w-100" src="{{ asset('homepage/img/portfolio-6.jpg')}}" alt="">
                            <div class="portfolio-overlay">
                                <a class="btn btn-light" href="{{ asset('homepage/img/portfolio-6.jpg')}}" data-lightbox="portfolio"><i class="fa fa-plus fa-2x text-primary"></i></a>
                                <div class="mt-auto">
                                    <small class="text-white"><i class="fa fa-folder me-2"></i>Rifki Fuadi</small>
                                    <a class="h5 d-block text-white mt-1 mb-0" href="">Penggunaan Alat Ukur</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio End -->

        <!-- Footer Start -->
        <div class="container-fluid bg-primary text-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5 px-lg-5">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-3">
                        <h5 class="text-white mb-4">Kontak</h5>
                        <p><i class="fa fa-map-marker-alt me-3"></i>Jl. Dr. Moh. Hatta - Painan</p>
                        <p><i class="fa fa-phone-alt me-3"></i>+62 75621123</p>
                        <p><i class="fa fa-envelope me-3"></i>info@smkn1pnn.sch.id</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href="https://web.facebook.com/smkn1painan?_rdc=1&_rdr&checkpoint_src=any#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <h5 class="text-white mb-4">Popular Link</h5>
                        <a class="btn btn-link" href="#">About Us</a>
                        <a class="btn btn-link" href="#">Contact Us</a>
                        <a class="btn btn-link" href="#">Privacy Policy</a>
                        <a class="btn btn-link" href="#">Terms & Condition</a>
                        <a class="btn btn-link" href="#">Career</a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <h5 class="text-white mb-4">Project Gallery</h5>
                        <div class="row g-2">
                            <div class="col-4">
                                <img class="img-fluid" src="{{ asset('homepage/img/portfolio-1.jpg')}}" alt="Image">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid" src="{{ asset('homepage/img/portfolio-2.jpg')}}" alt="Image">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid" src="{{ asset('homepage/img/portfolio-3.jpg')}}" alt="Image">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid" src="{{ asset('homepage/img/portfolio-4.jpg')}}" alt="Image">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid" src="{{ asset('homepage/img/portfolio-5.jpg')}}" alt="Image">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid" src="{{ asset('homepage/img/portfolio-6.jpg')}}" alt="Image">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <h5 class="text-white mb-4">Newsletter 📢</h5>
                        <p>Gabung dengan ribuan pembelajar lainnya dan dapatkan konten eksklusif, info terbaru, serta tips belajar langsung di inbox kamu!</p>
                        <div class="position-relative w-100 mt-3">
                            <input class="form-control border-0 rounded-pill w-100 ps-4 pe-5" type="text" placeholder="Your Email" style="height: 48px;">
                            <button type="button" class="btn shadow-none position-absolute top-0 end-0 mt-1 me-2"><i class="fa fa-paper-plane text-primary fs-4"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container px-lg-5">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">NetPedia</a>, All Right Reserved. 
                            
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a class="border-bottom" href="#">Ferju Prihamdani</a>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="">Home</a>
                                <a href="">Cookies</a>
                                <a href="">Help</a>
                                <a href="">FQAs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top pt-2"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('homepage/lib/wow/wow.min.js')}}"></script>
    <script src="{{ asset('homepage/lib/easing/easing.min.js')}}"></script>
    <script src="{{ asset('homepage/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{ asset('homepage/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('homepage/lib/isotope/isotope.pkgd.min.js')}}"></script>
    <script src="{{ asset('homepage/lib/lightbox/js/lightbox.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('homepage/js/main.js')}}"></script>
</body>

</html>
