@extends('siswa.siswa_master')

@section('siswa')
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWtIXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS CDN -->

    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
            min-height: 100vh;
            overflow-x: hidden;
            color: #212529; 
        }

        /* Floating Particles Background */
        .floating-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        /* Navbar Styling */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Main Content Container */
        .main-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 25px;
            margin: 2rem auto;
            max-width: 1200px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            padding: 3rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>') repeat;
            animation: moveBackground 20s linear infinite;
        }

        @keyframes moveBackground {
            0% { transform: translate(0, 0); }
            100% { transform: translate(-50px, -50px); }
        }

        .hero-title {
            color: white;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 2;
        }

        .hero-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.2rem;
            font-weight: 300;
            position: relative;
            z-index: 2;
        }

        .tech-icons {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 2rem;
            position: relative;
            z-index: 2;
        }

        .tech-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            animation: bounce 2s ease-in-out infinite;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .tech-icon:nth-child(1) { animation-delay: 0s; }
        .tech-icon:nth-child(2) { animation-delay: 0.5s; }
        .tech-icon:nth-child(3) { animation-delay: 1s; }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }

        /* Content Section General Styling */
        .content-section {
            padding: 3rem 2rem;
        }

        /* Section Card Styling */
        .section-card {
            background: linear-gradient(145deg, #ffffff, #f8f9ff);
            border-radius: 20px;
            padding: 2.5rem;
            margin-bottom: 2.5rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .section-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #667eea, #764ba2);
        }

        .section-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: #212529; 
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .section-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        /* Visual Container for Illustrations/Animations */
        .visual-container {
            background: linear-gradient(145deg, #f7fafc, #edf2f7);
            border-radius: 15px;
            padding: 2rem;
            margin: 1.5rem 0;
            text-align: center;
            border: 2px dashed #cbd5e0;
        }

        /* Signal Animation */
        .signal-animation {
            display: inline-block;
            position: relative;
            margin: 1rem;
        }

        .signal-tower {
            width: 4px;
            height: 60px;
            background: #4a5568;
            margin: 0 auto;
            position: relative;
        }

        .signal-wave {
            position: absolute;
            border: 2px solid #667eea;
            border-radius: 50%;
            animation: ripple 2s ease-out infinite;
        }

        .signal-wave:nth-child(1) { animation-delay: 0s; }
        .signal-wave:nth-child(2) { animation-delay: 0.5s; }
        .signal-wave:nth-child(3) { animation-delay: 1s; }

        @keyframes ripple {
            0% {
                width: 0;
                height: 0;
                opacity: 1;
                top: 30px;
                left: 50%;
                transform: translateX(-50%);
            }
            100% {
                width: 100px;
                height: 100px;
                opacity: 0;
                top: -20px;
                left: 50%;
                transform: translateX(-50%);
            }
        }

        /* Satellite Animation */
        .satellite-container {
            position: relative;
            height: 200px;
            margin: 2rem 0;
        }

        .satellite {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 3rem;
            color: #4a5568;
            animation: satelliteFloat 3s ease-in-out infinite;
        }

        @keyframes satelliteFloat {
            0%, 100% { transform: translateX(-50%) translateY(0px); }
            50% { transform: translateX(-50%) translateY(-10px); }
        }

        .satellite-beam {
            position: absolute;
            top: 80px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 50px solid transparent;
            border-right: 50px solid transparent;
            border-top: 80px solid rgba(102, 126, 234, 0.3);
            animation: beamPulse 2s ease-in-out infinite;
        }

        @keyframes beamPulse {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 0.7; }
        }

        .ground-station {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 2rem;
            color: #4a5568;
        }

        /* Generation Timeline */
        .generation-timeline {
            display: flex;
            justify-content: space-between;
            margin: 2rem 0;
            padding: 2rem;
            background: linear-gradient(90deg, #667eea, #764ba2);
            border-radius: 15px;
            color: white;
        }

        .generation-item {
            text-align: center;
            flex: 1;
            padding: 1rem;
            position: relative;
        }

        .generation-item::after {
            content: '';
            position: absolute;
            right: -1px;
            top: 50%;
            transform: translateY(-50%);
            width: 2px;
            height: 60%;
            background: rgba(255, 255, 255, 0.3);
        }

        .generation-item:last-child::after {
            display: none;
        }

        .generation-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            display: block;
        }

        /* Microwave Diagram */
        .microwave-diagram {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 2rem;
            background: linear-gradient(145deg, #f7fafc, #edf2f7);
            border-radius: 15px;
            margin: 2rem 0;
        }

        .tower {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #4a5568;
        }

        .tower-icon {
            font-size: 3rem;
            margin-bottom: 0.5rem;
        }

        .microwave-signal {
            flex: 1;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            position: relative;
            margin: 0 2rem;
            border-radius: 2px;
        }

        .microwave-signal::after {
            content: '';
            position: absolute;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-left: 15px solid #764ba2;
            border-top: 8px solid transparent;
            border-bottom: 8px solid transparent;
        }

        .pulse {
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: rgba(102, 126, 234, 0.7);
            animation: movePulse 3s linear infinite;
        }

        @keyframes movePulse {
            0% { left: 0; opacity: 1; }
            100% { left: calc(100% - 20px); opacity: 0.3; }
        }

        .simple-explanation {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            border-radius: 15px;
            padding: 1.5rem;
            margin: 1.5rem 0;
            border-left: 5px solid #2196f3;
        }

        .simple-explanation h6 {
            color: #1976d2;
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .simple-explanation p {
            color: #495057 !important; 
        }
        .simple-explanation p[style*="color: #1565c0;"] {
            color: #1565c0 !important;
        }
        .simple-explanation p[style*="color: #e65100;"] {
            color: #e65100 !important;
        }


        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .feature-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .feature-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .feature-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-bottom: 1rem;
        }

        .back-button {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            border-radius: 50px;
            padding: 1rem 2rem;
            color: white;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .back-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .loading-dots {
            display: inline-block;
        }

        .loading-dots span {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #667eea;
            margin: 0 2px;
            animation: loadingDots 1.4s ease-in-out infinite both;
        }

        .loading-dots span:nth-child(1) { animation-delay: -0.32s; }
        .loading-dots span:nth-child(2) { animation-delay: -0.16s; }

        @keyframes loadingDots {
            0%, 80%, 100% { transform: scale(0); }
            40% { transform: scale(1); }
        }

        /* Quiz Section Styles - Keeping current design consistent */
        .quiz-card {
            background: #ffffff;
            border-radius: 1.5rem;
            padding: 2rem;
            margin: 1rem 0;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            border: 1px solid #e0e6ec;
            color: #333;
        }

        .quiz-option {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 0.75rem;
            padding: 1rem;
            margin-bottom: 0.75rem;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #333;
        }

        /* DIPERKUAT: Gaya untuk opsi yang dipilih */
        .quiz-option.selected {
            border-color: #667eea; /* Border warna gradien utama */
            background: #e0e9f8; /* Latar belakang biru muda yang lebih terlihat */
            font-weight: bold;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.2); /* Sedikit bayangan untuk efek "terpilih" */
        }
        
        .quiz-option.correct-answer {
            border-color: #28a745;
            background: #e9f8ed;
            font-weight: bold;
        }
        .quiz-option.incorrect {
            border-color: #dc3545;
            background: #fdf0f1;
            font-weight: bold;
        }
        .quiz-option label {
            cursor: inherit;
            width: 100%;
            display: block;
        }

        #quiz-feedback {
            font-size: 1.1rem;
        }
        #quiz-feedback.text-success {
            color: #28a745 !important;
        }
        #quiz-feedback.text-danger {
            color: #dc3545 !important;
        }
        #quiz-feedback.text-warning {
            color: #ffc107 !important;
        }

        /* --- MEDIA QUERIES for Responsiveness --- */
        @media (max-width: 992px) { /* Medium devices (tablets) */
            .main-container {
                margin: 1.5rem auto;
                border-radius: 20px;
                padding: 0;
            }

            .content-section {
                padding: 2.5rem 1.5rem;
            }
            
            .hero-section {
                padding: 2.5rem 1.5rem;
            }

            .hero-title {
                font-size: 2.2rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .tech-icons {
                gap: 1.5rem;
            }

            .tech-icon {
                width: 70px;
                height: 70px;
                font-size: 1.8rem;
            }

            .section-card {
                padding: 2rem;
                margin-bottom: 2rem;
            }

            .section-title {
                font-size: 1.6rem;
                gap: 0.8rem;
            }
            .section-icon {
                width: 45px;
                height: 45px;
                font-size: 1.3rem;
            }

            .generation-timeline {
                flex-wrap: wrap;
                padding: 1.5rem;
                gap: 1rem;
            }
            .generation-item {
                flex-basis: 48%;
                margin-bottom: 1rem;
            }
            .generation-item:nth-child(odd):not(:last-child)::after {
                height: 60%;
                right: -1px;
                top: 50%;
                transform: translateY(-50%) rotate(0deg);
            }
            .generation-item:nth-child(even):not(:last-child)::after {
                display: none;
            }
            .generation-item:last-child:nth-child(odd)::after {
                display: none;
            }


            .microwave-diagram {
                flex-direction: column;
                gap: 1.5rem;
            }
            .microwave-signal {
                width: 90%;
                margin: 1rem 0;
            }

            .feature-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 1rem;
            }
            .feature-card {
                padding: 1rem;
            }
            .feature-icon {
                width: 35px;
                height: 35px;
                font-size: 1.2rem;
            }
            .feature-card h6 {
                font-size: 1rem;
            }
            .feature-card p {
                font-size: 0.85rem;
            }

            /* Tables need overflow for small screens */
            table {
                width: 100%;
                display: block;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            th, td {
                white-space: nowrap;
            }

            .quiz-card {
                padding: 1.5rem;
                border-radius: 1rem;
            }
            .quiz-card h2 {
                font-size: 1.2rem;
            }
            .quiz-option {
                padding: 0.8rem;
                font-size: 0.95rem;
            }
        }

        @media (max-width: 767px) { /* Small devices (phones) */
            .navbar .container {
                flex-direction: column;
                align-items: center;
            }
            .navbar h4 {
                margin-bottom: 0.5rem !important;
            }
            .back-button {
                width: 100%;
                justify-content: center;
            }

            .main-container {
                margin: 1rem auto;
                border-radius: 15px;
            }

            .content-section {
                padding: 1.5rem 1rem;
            }

            .hero-section {
                padding: 1.5rem 1rem;
            }
            .hero-title {
                font-size: 1.8rem;
            }
            .hero-subtitle {
                font-size: 1rem;
            }

            .tech-icons {
                flex-direction: column;
                gap: 0.8rem;
            }
            .tech-icon {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }

            .section-card {
                padding: 1.5rem;
                margin-bottom: 1.5rem;
            }
            .section-title {
                font-size: 1.4rem;
                flex-direction: column;
                text-align: center;
            }
            .section-icon {
                width: 40px;
                height: 40px;
                font-size: 1.2rem;
                margin-bottom: 0.5rem;
            }

            .visual-container {
                padding: 1.2rem;
            }
            .signal-animation {
                transform: scale(0.8);
            }
            .satellite-container {
                height: 150px;
            }
            .satellite {
                font-size: 2.5rem;
            }
            .ground-station {
                font-size: 1.5rem;
            }
            .satellite-beam {
                border-left: 40px solid transparent;
                border-right: 40px solid transparent;
                border-top: 60px solid rgba(102, 126, 234, 0.3);
                top: 65px;
            }

            .generation-timeline {
                flex-direction: column;
                padding: 1rem;
                gap: 0.5rem;
            }
            .generation-item {
                flex-basis: 100%;
                margin-bottom: 0.5rem;
                font-size: 0.9rem;
            }
            .generation-item::after {
                display: none !important;
            }
            .generation-number {
                font-size: 1.8rem;
            }

            .microwave-diagram {
                padding: 1.5rem;
            }
            .tower-icon {
                font-size: 2.5rem;
            }
            .microwave-signal {
                width: 90%;
            }

            .simple-explanation {
                padding: 1rem;
                font-size: 0.9rem;
            }
            .simple-explanation h6 {
                font-size: 1.1rem;
                margin-bottom: 0.8rem;
            }

            .feature-grid {
                grid-template-columns: 1fr;
            }
            .feature-card {
                padding: 1rem;
            }
            .feature-icon {
                width: 30px;
                height: 30px;
                font-size: 1.0rem;
                margin-bottom: 0.8rem;
            }
            .feature-card h6 {
                font-size: 0.95rem;
            }
            .feature-card p {
                font-size: 0.8rem;
            }

            .quiz-card {
                padding: 1rem;
                border-radius: 1rem;
            }
            .quiz-card h2 {
                font-size: 1.2rem;
            }
            .quiz-option {
                padding: 0.7rem;
                font-size: 0.9rem;
            }
            #quiz-feedback {
                font-size: 0.95rem;
            }
            .btn-primary, .btn-success {
                padding: 0.75rem;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>

<div class="bg-light min-h-screen">
    <!-- Menambahkan floating-particles di sini -->
    <div class="floating-particles"></div> 
    <div class="container py-5">
        <!-- Header dengan Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('siswa.siswa_master')}}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('siswa.materi.index')}}">Materi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sistem Seluler, Microwave, & VSAT IP</li>
            </ol>
        </nav>

        <!-- Header Utama -->
        <header class="position-relative overflow-hidden rounded-4 shadow-lg mb-5 hero-section">
            <div class="hero-title">Sistem Komunikasi Nirkabel</div>
            <div class="hero-subtitle">Memahami Teknologi yang Menghubungkan Dunia</div>
            <div class="tech-icons">
                <div class="tech-icon"><i class="bi bi-phone"></i></div> <!-- Ikon Ponsel -->
                <div class="tech-icon"><i class="bi bi-broadcast"></i></div> <!-- Ikon Gelombang Radio/Broadcast -->
                <div class="tech-icon"><i class="bi bi-satellite"></i></div> <!-- Ikon Satelit -->
            </div>
        </header>

        <!-- Main Content -->
        <main id="materi-content">
            
            <!-- Introduction Section -->
            <div class="simple-explanation">
                <h6><i class="bi bi-lightbulb"></i> Apa yang Akan Kita Pelajari?</h6>
                <p style="margin: 0; color: #1565c0;">
                    Bayangkan kamu bisa mengirim pesan ke teman di luar negeri dalam hitungan detik, atau menonton video YouTube di tempat yang jauh dari kota. Semua itu bisa terjadi karena teknologi komunikasi nirkabel! Hari ini kita akan belajar tentang 3 teknologi super keren yang membuat semua itu mungkin.
                </p>
            </div>

            <!-- Sistem Seluler Section -->
            <div class="section-card">
                <div class="section-title">
                    <div class="section-icon"><i class="bi bi-phone"></i></div>
                    1. Sistem Seluler - HP dan Internet di Saku Kamu
                </div>

                <div class="simple-explanation">
                    <h6><i class="bi bi-question-circle"></i> Apa itu Sistem Seluler?</h6>
                    <p style="margin: 0;">
                        Sistem seluler adalah teknologi yang membuat HP kamu bisa digunakan untuk telepon, SMS, dan internet di mana saja. Namanya "seluler" karena jaringannya terbagi-bagi seperti sel-sel yang saling terhubung!
                    </p>
                </div>

                <!-- Visual: Signal Animation -->
                <div class="visual-container">
                    <h6 style="color: #4a5568; margin-bottom: 1.5rem;">Animasi Sinyal Seluler</h6>
                    <div class="signal-animation">
                        <div class="signal-tower"></div>
                        <div class="signal-wave"></div>
                        <div class="signal-wave"></div>
                        <div class="signal-wave"></div>
                    </div>
                    <p style="color: #718096; margin-top: 1rem; font-size: 0.9rem;">
                        [Image of Signal Tower] Tower seluler mengirim sinyal seperti gelombang air yang menyebar ke segala arah
                    </p>
                </div>

                <!-- Generation Timeline -->
                <div class="generation-timeline">
                    <div class="generation-item">
                        <span class="generation-number">2G</span>
                        <small>Telepon & SMS</small>
                    </div>
                    <div class="generation-item">
                        <span class="generation-number">3G</span>
                        <small>Internet Lambat</small>
                    </div>
                    <div class="generation-item">
                        <span class="generation-number">4G</span>
                        <small>Internet Kencang</small>
                    </div>
                    <div class="generation-item">
                        <span class="generation-number">5G</span>
                        <small>Super Kencang!</small>
                    </div>
                </div>

                <div class="simple-explanation">
                    <h6><i class="bi bi-gear"></i> Bagaimana Cara Kerjanya?</h6>
                    <div class="feature-grid">
                        <div class="feature-card">
                            <div class="feature-icon"><i class="bi bi-broadcast-pin"></i></div>
                            <h6>Tower BTS</h6>
                            <p style="font-size: 0.9rem; margin: 0;">Tower tinggi yang "ngobrol" langsung sama HP kamu</p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon"><i class="bi bi-hdd-network"></i></div>
                            <h6>Pusat Kontrol</h6>
                            <p style="font-size: 0.9rem; margin: 0;">Seperti "otak" yang mengatur semua tower</p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon"><i class="bi bi-globe"></i></div>
                            <h6>Jaringan Internet</h6>
                            <p style="font-size: 0.9rem; margin: 0;">Menghubungkan kamu ke seluruh dunia</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sistem Microwave Section -->
            <div class="section-card">
                <div class="section-title">
                    <div class="section-icon"><i class="bi bi-broadcast"></i></div>
                    2. Sistem Microwave - Mengirim Data dengan Gelombang Super
                </div>

                <div class="simple-explanation">
                    <h6><i class="bi bi-question-circle"></i> Apa itu Microwave?</h6>
                    <p style="margin: 0;">
                        Bukan microwave buat masak ya! Ini adalah teknologi yang mengirim data menggunakan gelombang radio super kencang dari satu tower ke tower lain. Seperti main lempar bola, tapi bolanya adalah data!
                    </p>
                </div>

                <!-- Visual: Microwave Diagram -->
                <div class="visual-container">
                    <h6 style="color: #4a5568; margin-bottom: 1.5rem;">Cara Kerja Microwave</h6>
                    <div class="microwave-diagram">
                        <div class="tower">
                            <div class="tower-icon"><i class="bi bi-broadcast-pin"></i></div>
                            <small>Tower A</small>
                        </div>
                        <div class="microwave-signal">
                            <div class="pulse"></div>
                        </div>
                        <div class="tower">
                            <div class="tower-icon"><i class="bi bi-broadcast-pin"></i></div>
                            <small>Tower B</small>
                        </div>
                    </div>
                    <p style="color: #718096; margin-top: 1rem; font-size: 0.9rem;">
                        [Image of Microwave Signal Transmission] Data "terbang" dari tower ke tower dengan kecepatan cahaya!
                    </p>
                </div>

                <div class="simple-explanation">
                    <h6><i class="bi bi-check-circle"></i> Kelebihan Microwave</h6>
                    <div class="feature-grid">
                        <div class="feature-card">
                            <div class="feature-icon"><i class="bi bi-lightning"></i></div>
                            <h6>Super Cepat</h6>
                            <p style="font-size: 0.9rem; margin: 0;">Data sampai dalam waktu sangat singkat</p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon"><i class="bi bi-cash"></i></div>
                            <h6>Hemat Biaya</h6>
                            <p style="font-size: 0.9rem; margin: 0;">Lebih murah daripada pasang kabel panjang</p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon"><i class="bi bi-geo-alt"></i></div>
                            <h6>Jangkauan Jauh</h6>
                            <p style="font-size: 0.9rem; margin: 0;">Bisa menghubungkan tempat yang berjauhan</p>
                        </div>
                    </div>
                </div>

                <div class="simple-explanation" style="background: linear-gradient(135deg, #fff3e0, #ffe0b2); border-left-color: #ff9800;">
                    <h6 style="color: #e65100;"><i class="bi bi-exclamation-triangle"></i> Yang Perlu Diperhatikan</h6>
                    <p style="margin: 0; color: #e65100;">
                        Microwave butuh "pandangan langsung" antara dua tower (gak boleh ada gunung atau gedung tinggi yang menghalangi). Plus, kalau hujan deras, sinyalnya bisa terganggu!
                    </p>
                </div>
            </div>

            <!-- Sistem VSAT IP Section -->
            <div class="section-card">
                <div class="section-title">
                    <div class="section-icon"><i class="bi bi-satellite"></i></div>
                    3. Sistem VSAT IP - Internet dari Luar Angkasa!
                </div>

                <div class="simple-explanation">
                    <h6><i class="bi bi-question-circle"></i> Apa itu VSAT IP?</h6>
                    <p style="margin: 0;">
                        VSAT adalah singkatan dari "Very Small Aperture Terminal" - basically, ini adalah antena parabola kecil yang bisa dapat internet dari satelit di luar angkasa! Keren banget kan?
                    </p>
                </div>

                <!-- Visual: Satellite Communication -->
                <div class="visual-container">
                    <h6 style="color: #4a5568; margin-bottom: 1.5rem;">Komunikasi Satelit</h6>
                    <div class="satellite-container">
                        <div class="satellite">🛰️</div> <!-- Emoji satelit -->
                        <div class="satellite-beam"></div> <!-- Animasi pancaran sinyal -->
                        <div class="ground-station">📡</div> <!-- Emoji antena penerima di darat -->
                    </div>
                    <p style="color: #718096; margin-top: 1rem; font-size: 0.9rem;">
                        [Image of Satellite Communication] Satelit di luar angkasa "ngobrol" dengan antena parabola di Bumi
                    </p>
                </div>

                <div class="simple-explanation">
                    <h6><i class="bi bi-arrow-right-circle"></i> Cara Kerja VSAT (Step by Step)</h6>
                    <div style="background: white; border-radius: 10px; padding: 1.5rem; margin: 1rem 0;">
                        <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                            <div style="width: 30px; height: 30px; background: #667eea; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 1rem; font-weight: bold;">1</div>
                            <p style="margin: 0;">Kamu kirim data dari komputer ke antena parabola</p>
                        </div>
                        <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                            <div style="width: 30px; height: 30px; background: #667eea; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 1rem; font-weight: bold;">2</div>
                            <p style="margin: 0;">Antena kirim data ke satelit di luar angkasa</p>
                        </div>
                        <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                            <div style="width: 30px; height: 30px; background: #667eea; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 1rem; font-weight: bold;">3</div>
                            <p style="margin: 0;">Satelit teruskan data ke stasiun bumi yang terhubung internet</p>
                        </div>
                        <div style="display: flex; align-items: center;">
                            <div style="width: 30px; height: 30px; background: #667eea; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 1rem; font-weight: bold;">4</div>
                            <p style="margin: 0;">Data kamu sampai ke tujuan di seluruh dunia!</p>
                        </div>
                    </div>
                </div>

                <div class="simple-explanation">
                    <h6><i class="bi bi-star"></i> Kegunaan VSAT</h6>
                    <div class="feature-grid">
                        <div class="feature-card">
                            <div class="feature-icon"><i class="bi bi-house"></i></div>
                            <h6>Daerah Terpencil</h6>
                            <p style="font-size: 0.9rem; margin: 0;">Internet untuk desa atau pulau yang jauh dari kota</p>
                        </div>
                        <div class="feature-card">
                            <!-- ICON KAPAL LAUT: bi bi-ship -->
                            <div class="feature-icon"><i class="bi bi-ship"></i></div> 
                            <h6>Kapal Laut</h6>
                            <p style="font-size: 0.9rem; margin: 0;">Internet di tengah laut untuk kapal dan pelaut</p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon"><i class="bi bi-building"></i></div>
                            <h6>Backup Internet</h6>
                            <p style="font-size: 0.9rem; margin: 0;">Cadangan kalau internet utama bermasalah</p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon"><i class="bi bi-activity"></i></div>
                            <h6>Monitoring Jarak Jauh</h6>
                            <p style="font-size: 0.9rem; margin: 0;">Mengawasi mesin atau peralatan dari tempat jauh</p>
                        </div>
                    </div>
                </div>

                <div class="simple-explanation" style="background: linear-gradient(135deg, #fff3e0, #ffe0b2); border-left-color: #ff9800;">
                    <h6 style="color: #e65100;"><i class="bi bi-exclamation-triangle"></i> Yang Perlu Diperhatikan</h6>
                    <p style="margin: 0; color: #e65100;">
                        Sinyal VSAT bisa punya "latency" atau jeda waktu yang agak lama karena datanya harus menempuh perjalanan jauh ke luar angkasa dan kembali. Tapi, untuk internet di daerah terpencil, ini adalah solusi terbaik!
                    </p>
                </div>
            </div>
            
            <!-- Kesimpulan (Conclusion) -->
            <div class="section-card" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white;">
                <div class="section-title" style="color: white;">
                    <div class="section-icon" style="background: rgba(255,255,255,0.2);"><i class="bi bi-check-circle"></i></div>
                    Kesimpulan - Teknologi yang Mengubah Dunia
                </div>

                <div style="background: rgba(255,255,255,0.1); border-radius: 15px; padding: 2rem; backdrop-filter: blur(10px);">
                    <div class="row">
                        <div class="col-md-4 text-center mb-3">
                            <div style="font-size: 4rem; margin-bottom: 1rem;">📱</div>
                            <h5>Sistem Seluler</h5>
                            <p style="font-size: 0.9rem; opacity: 0.9;">Membuat kita selalu terhubung di mana saja</p>
                        </div>
                        <div class="col-md-4 text-center mb-3">
                            <div style="font-size: 4rem; margin-bottom: 1rem;">📡</div>
                            <h5>Microwave</h5>
                            <p style="font-size: 0.9rem; opacity: 0.9;">Menghubungkan kota-kota dengan cepat</p>
                        </div>
                        <div class="col-md-4 text-center mb-3">
                            <div style="font-size: 4rem; margin-bottom: 1rem;">🛰️</div>
                            <h5>VSAT IP</h5>
                            <p style="font-size: 0.9rem; opacity: 0.9;">Membawa internet ke ujung dunia</p>
                        </div>
                    </div>
                    
                    <div style="text-align: center; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.2);">
                        <h5 style="margin-bottom: 1rem;">🌟 Ingat Selalu!</h5>
                        <p style="font-size: 1.1rem; margin: 0; opacity: 0.95;">
                            Ketiga teknologi ini bekerja sama untuk membuat dunia menjadi tempat yang terhubung. Dari HP di saku kamu, tower microwave di puncak gunung, sampai satelit di luar angkasa - semuanya berkolaborasi untuk membuat hidup kita lebih mudah!
                        </p>
                    </div>
                </div>
            </div>

            <!-- Quiz Sederhana Section -->
            <section id="quiz-section" class="mb-5">
                <div class="quiz-card">
                    <h2 class="h3 mb-4 text-primary text-center">
                        <i class="fas fa-question-circle me-3"></i>Uji Pemahaman: Kuis Sederhana
                    </h2>
                    <div id="quiz-container">
                        <!-- Question 1 -->
                        <div class="question-block mb-4">
                            <p class="mb-3"><strong>1. Teknologi seluler generasi ke berapa yang pertama kali memperkenalkan internet mobile dengan kecepatan lebih tinggi?</strong></p>
                            <div class="quiz-option" data-question="q1" data-choice="a">
                                <label class="w-100 cursor-pointer">a. 2G (GSM)</label>
                            </div>
                            <div class="quiz-option" data-question="q1" data-choice="b">
                                <label class="w-100 cursor-pointer">b. 3G (UMTS/CDMA2000)</label>
                            </div>
                            <div class="quiz-option" data-question="q1" data-choice="c">
                                <label class="w-100 cursor-pointer">c. 4G (LTE/WiMAX)</label>
                            </div>
                            <div class="quiz-option" data-question="q1" data-choice="d">
                                <label class="w-100 cursor-pointer">d. 5G</label>
                            </div>
                        </div>

                        <!-- Question 2 -->
                        <div class="question-block mb-4">
                            <p class="mb-3"><strong>2. Apa komponen utama dalam sistem seluler yang mengelola komunikasi radio dengan perangkat seluler (HP kita)?</strong></p>
                            <div class="quiz-option" data-question="q2" data-choice="a">
                                <label class="w-100 cursor-pointer">a. MSC (Mobile Switching Center)</label>
                            </div>
                            <div class="quiz-option" data-question="q2" data-choice="b">
                                <label class="w-100 cursor-pointer">b. HLR (Home Location Register)</label>
                            </div>
                            <div class="quiz-option" data-question="q2" data-choice="c">
                                <label class="w-100 cursor-pointer">c. BTS (Base Transceiver Station)</label>
                            </div>
                            <div class="quiz-option" data-question="q2" data-choice="d">
                                <label class="w-100 cursor-pointer">d. Packet Core Network</label>
                            </div>
                        </div>

                        <!-- Question 3 -->
                        <div class="question-block mb-4">
                            <p class="mb-3"><strong>3. Sistem Microwave memerlukan apa antara antena pemancar dan penerima agar dapat bekerja dengan baik?</strong></p>
                            <div class="quiz-option" data-question="q3" data-choice="a">
                                <label class="w-100 cursor-pointer">a. Kabel serat optik</label>
                            </div>
                            <div class="quiz-option" data-question="q3" data-choice="b">
                                <label class="w-100 cursor-pointer">b. Garis pandang (Line-of-Sight - LoS) yang jelas</label>
                            </div>
                            <div class="quiz-option" data-question="q3" data-choice="c">
                                <label class="w-100 cursor-pointer">c. Koneksi Wi-Fi</label>
                            </div>
                            <div class="quiz-option" data-question="q3" data-choice="d">
                                <label class="w-100 cursor-pointer">d. VPN</label>
                            </div>
                        </div>

                        <!-- Question 4 -->
                        <div class="question-block mb-4">
                            <p class="mb-3"><strong>4. Apa keunggulan utama Sistem VSAT IP dibandingkan dengan serat optik untuk daerah terpencil?</strong></p>
                            <div class="quiz-option" data-question="q4" data-choice="a">
                                <label class="w-100 cursor-pointer">a. Kecepatan transfer data yang jauh lebih tinggi</label>
                            </div>
                            <div class="quiz-option" data-question="q4" data-choice="b">
                                <label class="w-100 cursor-pointer">b. Biaya instalasi yang lebih murah untuk jarak dekat</label>
                            </div>
                            <div class="quiz-option" data-question="q4" data-choice="c">
                                <label class="w-100 cursor-pointer">c. Kemampuan menyediakan konektivitas tanpa infrastruktur terestrial</label>
                            </div>
                            <div class="quiz-option" data-question="q4" data-choice="d">
                                <label class="w-100 cursor-pointer">d. Latensi yang sangat rendah</label>
                            </div>
                        </div>

                        <!-- Question 5 -->
                        <div class="question-block mb-4">
                            <p class="mb-3"><strong>5. Sistem komunikasi nirkabel jarak jauh mana yang paling sensitif terhadap kondisi atmosfer seperti hujan atau kabut?</strong></p>
                            <div class="quiz-option" data-question="q5" data-choice="a">
                                <label class="w-100 cursor-pointer">a. Sistem Seluler (5G)</label>
                            </div>
                            <div class="quiz-option" data-question="q5" data-choice="b">
                                <label class="w-100 cursor-pointer">b. Sistem Microwave</label>
                            </div>
                            <div class="quiz-option" data-question="q5" data-choice="c">
                                <label class="w-100 cursor-pointer">d. Sistem VSAT IP</label>
                            </div>
                            <div class="quiz-option" data-question="q5" data-choice="d">
                                <label class="w-100 cursor-pointer">d. Semua sama sensitifnya</label>
                            </div>
                        </div>
                        
                        <button onclick="checkQuiz()" class="btn btn-primary w-100 mt-3 fw-bold">Periksa Jawaban</button>
                        <p id="quiz-feedback" class="mt-4 font-weight-bold text-center"></p>
                        {{-- Mengubah tautan ke materi berikutnya (Materi 5) --}}
                        <a href="{{ route('siswa.materi.optik', ['id' => 5]) }}" id="nextMaterialBtn" class="btn btn-success w-100 mt-3 d-none fw-bold">Lanjut ke Materi Berikutnya <i class="fas fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </section>
        </main>
    </div>
</div>

<!-- Bootstrap JS Bundle (popper included) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eP7In6jI3RxhqQ" crossorigin="anonymous"></script>
<!-- Mermaid JS (Jika ada diagram Mermaid di konten) -->
<script src="https://cdn.jsdelivr.net/npm/mermaid/dist/mermaid.min.js"></script>
<script>
    // Inisialisasi Mermaid (jika ada diagram Mermaid)
    mermaid.initialize({ startOnLoad: true });

    // Fungsi untuk scroll ke bagian tertentu (jika ada tombol "Mulai Belajar")
    function scrollToSection(id) {
        const element = document.getElementById(id);
        if (element) {
            element.scrollIntoView({ behavior: 'smooth' });
        }
    }

    // Jawaban Kuis untuk halaman "Sistem Seluler, Microwave, & VSAT IP"
    const quizAnswers = {
        q1: 'b', // 3G
        q2: 'c', // BTS
        q3: 'b', // Garis pandang (Line-of-Sight - LoS)
        q4: 'c', // Kemampuan menyediakan konektivitas tanpa infrastruktur terestrial
        q5: 'b'  // Sistem Microwave
    };

    // Skor minimum untuk melanjutkan ke materi berikutnya
    const REQUIRED_SCORE = 80; // Misalnya, 80%

    // Fungsi untuk membuat partikel mengambang di latar belakang
    function createParticles() {
        const particlesContainer = document.querySelector('.floating-particles');
        const numberOfParticles = 50; 

        // Pastikan container partikel ditemukan
        if (!particlesContainer) {
            console.error("Elemen '.floating-particles' tidak ditemukan di DOM.");
            return; // Hentikan fungsi jika elemen tidak ada
        }

        for (let i = 0; i < numberOfParticles; i++) {
            const particle = document.createElement('div');
            particle.classList.add('particle');
            const size = Math.random() * 5 + 2; 
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            particle.style.left = `${Math.random() * 100}%`;
            particle.style.top = `${Math.random() * 100}%`;
            const animationDuration = Math.random() * 3 + 3;
            particle.style.animationDuration = `${animationDuration}s`;
            const animationDelay = Math.random() * 2;
            particle.style.animationDelay = `${animationDelay}s`;
            particlesContainer.appendChild(particle);
        }
    }

    // Fungsi untuk memeriksa jawaban kuis (diperbaiki agar berfungsi dengan struktur data-question)
    function checkQuiz() {
        let score = 0;
        const totalQuestions = Object.keys(quizAnswers).length;
        const feedback = document.getElementById('quiz-feedback');
        const nextMaterialBtn = document.getElementById('nextMaterialBtn');

        let allAnswered = true;

        // Iterate over each question to check answers
        document.querySelectorAll('.question-block').forEach(questionBlock => {
            const qId = questionBlock.querySelector('.quiz-option').dataset.question;
            const selectedOption = questionBlock.querySelector(`.quiz-option.selected`);
            const correctAnswer = quizAnswers[qId];

            // Reset styling for all options in this question block
            questionBlock.querySelectorAll('.quiz-option').forEach(opt => {
                opt.classList.remove('correct-answer', 'incorrect', 'selected');
                opt.disabled = true; // Nonaktifkan opsi setelah diperiksa
            });

            if (!selectedOption) {
                allAnswered = false;
                return;
            }

            const selectedChoice = selectedOption.dataset.choice;

            if (selectedChoice === correctAnswer) {
                score += 1;
                selectedOption.classList.add('correct-answer');
            } else {
                selectedOption.classList.add('incorrect');
                const correctOption = questionBlock.querySelector(`.quiz-option[data-choice="${correctAnswer}"]`);
                if (correctOption) {
                    correctOption.classList.add('correct-answer');
                }
            }
        });

        if (!allAnswered) {
            feedback.textContent = "Mohon jawab semua pertanyaan sebelum memeriksa.";
            feedback.className = "mt-4 fw-bold text-warning";
            nextMaterialBtn.classList.add('d-none');
            nextMaterialBtn.disabled = true;
            
            document.querySelectorAll('.question-block').forEach(block => {
                const selected = block.querySelector('.quiz-option.selected');
                if (!selected) {
                     block.querySelectorAll('.quiz-option').forEach(opt => opt.disabled = false); // Aktifkan kembali opsi yang belum dipilih
                }
            });
            return;
        }

        const percentage = (score / totalQuestions) * 100;
        feedback.innerHTML = `Skor Anda: ${score} dari ${totalQuestions} (${percentage.toFixed(0)}%).<br>`;

        if (percentage >= REQUIRED_SCORE) {
            feedback.innerHTML += `Selamat! Anda berhasil memahami materi ini dengan baik!`;
            feedback.className = "mt-4 fw-bold text-success";
            nextMaterialBtn.classList.remove('d-none');
            nextMaterialBtn.disabled = false;
            // Menyimpan skor untuk Materi 4
            localStorage.setItem('material_4_score', percentage.toFixed(0));
        } else {
            feedback.innerHTML += `Terus semangat belajar! Anda perlu mencapai setidaknya ${REQUIRED_SCORE}% untuk melanjutkan.`;
            feedback.className = "mt-4 fw-bold text-danger";
            nextMaterialBtn.classList.add('d-none');
            nextMaterialBtn.disabled = true;
            // Menyimpan skor untuk Materi 4 meskipun gagal (untuk melacak upaya)
            localStorage.setItem('material_4_score', percentage.toFixed(0));
            
            setTimeout(() => {
                resetQuizUI();
            }, 3000);
        }
    }

    // Fungsi untuk mereset tampilan kuis
    function resetQuizUI() {
        document.querySelectorAll('.quiz-option').forEach(option => {
            option.classList.remove('selected', 'correct-answer', 'incorrect');
            option.disabled = false; // Aktifkan kembali semua opsi
        });
        document.getElementById('quiz-feedback').textContent = "";
        document.getElementById('nextMaterialBtn').classList.add('d-none');
        document.getElementById('nextMaterialBtn').disabled = true;
    }

    // Scroll reveal animations
    document.addEventListener('DOMContentLoaded', function() {
        const sections = document.querySelectorAll('.section-card');

        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                    entry.target.style.transition = 'opacity 0.8s ease-out, transform 0.8s ease-out';
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        sections.forEach(section => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(30px)';
            observer.observe(section);
        });

        // Initialize floating particles
        createParticles();

        // Animation for generation numbers
        const generationNumbers = document.querySelectorAll('.generation-number');
        generationNumbers.forEach((num, index) => {
            setTimeout(() => {
                num.style.transform = 'scale(1.2)';
                setTimeout(() => {
                    num.style.transform = 'scale(1)';
                }, 200);
            }, index * 300);
        });

        // Hover effects for feature cards
        document.querySelectorAll('.feature-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Enable/disable 'Next Material' button based on stored score
        // Memeriksa skor untuk Materi 4
        const savedScore = parseInt(localStorage.getItem('material_4_score')) || 0;
        const nextMaterialBtn = document.getElementById('nextMaterialBtn');
        if (savedScore >= REQUIRED_SCORE) {
            nextMaterialBtn.classList.remove('d-none');
        } else {
            nextMaterialBtn.classList.add('d-none');
        }

        // Back button functionality
        const backButtons = document.querySelectorAll('.back-button');
        backButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                event.preventDefault();
                window.history.back();
            });
        });

        // Delegate event listener for quiz options on quiz-container
        document.getElementById('quiz-container').addEventListener('click', function(event) {
            const option = event.target.closest('.quiz-option');
            if (option && !option.disabled) {
                const questionBlock = option.closest('.question-block');
                if (questionBlock) {
                    questionBlock.querySelectorAll('.quiz-option').forEach(opt => {
                        opt.classList.remove('selected');
                    });
                    option.classList.add('selected');
                }
            }
        });
    });
</script>
@endsection
