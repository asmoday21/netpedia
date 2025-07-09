<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Referensi | Teknik Jaringan Komputer</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --accent-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --success-gradient: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            --dark-bg: #0f1419;
            --card-bg: rgba(255, 255, 255, 0.95);
            --glass-bg: rgba(255, 255, 255, 0.1);
            --text-primary: #2d3748;
            --text-secondary: #718096;
            --shadow-light: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-medium: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-heavy: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        * {
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            background-attachment: fixed;
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
            position: relative;
        }
        
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(120, 219, 255, 0.3) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
        }
        
        .navbar {
            background: var(--glass-bg) !important;
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: var(--shadow-light);
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.8rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .navbar-brand i {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-size: 2rem;
        }
        
        .hero-section {
            background: var(--glass-bg);
            backdrop-filter: blur(30px);
            color: white;
            padding: 4rem 0;
            border-radius: 0 0 40px 40px;
            margin-bottom: 3rem;
            box-shadow: var(--shadow-heavy);
            border: 1px solid rgba(255, 255, 255, 0.2);
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
            background: 
                radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
        }
        
        .hero-section h1 {
            font-weight: 700;
            font-size: 3.5rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .hero-section p {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .search-section {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 3rem;
            box-shadow: var(--shadow-medium);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .form-control, .form-select {
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 15px;
            padding: 0.75rem 1rem;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            background: rgba(255, 255, 255, 0.9);
        }
        
        .input-group-text {
            background: rgba(255, 255, 255, 0.8);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-right: none;
            border-radius: 15px 0 0 15px;
        }
        
        .card-reference {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 25px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: var(--shadow-medium);
            height: 100%;
            position: relative;
        }
        
        .card-reference::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, transparent 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .card-reference:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: var(--shadow-heavy);
        }
        
        .card-reference:hover::before {
            opacity: 1;
        }
        
        .card-reference .card-body {
            padding: 2rem;
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 2;
        }
        
        .card-reference .card-title {
            font-weight: 600;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
            min-height: 3.5rem;
            font-size: 1.25rem;
        }
        
        .card-reference .card-text {
            color: var(--text-secondary);
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }
        
        .btn-primary {
            background: var(--primary-gradient);
            border: none;
            padding: 0.75rem 2rem;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-primary:hover::before {
            left: 100%;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }
        
        .iframe-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 20px;
            box-shadow: var(--shadow-medium);
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            margin-bottom: 1.5rem;
            border: 3px solid rgba(255, 255, 255, 0.3);
        }
        
        .iframe-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 17px;
            border: none;
        }
        
        .fullscreen-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            border: none;
            padding: 0.75rem 1.25rem;
            border-radius: 50px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            z-index: 10;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            font-weight: 500;
        }
        
        .fullscreen-btn:hover {
            background: rgba(0, 0, 0, 0.9);
            transform: scale(1.05);
        }
        
        .badge-category {
            background: var(--accent-gradient);
            color: white;
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.8rem;
            margin-bottom: 1rem;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: var(--shadow-light);
        }
        
        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }
        
        .shape {
            position: absolute;
            border-radius: 50%;
            animation: float-shapes 20s infinite linear;
        }
        
        .shape:nth-child(1) {
            width: 100px;
            height: 100px;
            background: rgba(102, 126, 234, 0.1);
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .shape:nth-child(2) {
            width: 60px;
            height: 60px;
            background: rgba(245, 87, 108, 0.1);
            top: 60%;
            right: 20%;
            animation-delay: -5s;
        }
        
        .shape:nth-child(3) {
            width: 80px;
            height: 80px;
            background: rgba(67, 233, 123, 0.1);
            bottom: 30%;
            left: 20%;
            animation-delay: -10s;
        }
        
        @keyframes float-shapes {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            25% { transform: translateY(-20px) rotate(90deg); }
            50% { transform: translateY(0px) rotate(180deg); }
            75% { transform: translateY(20px) rotate(270deg); }
        }
        
        .container {
            position: relative;
            z-index: 1;
        }
        
        @media (max-width: 768px) {
            .hero-section {
                padding: 2.5rem 0;
            }
            
            .hero-section h1 {
                font-size: 2.5rem;
            }
            
            .search-section {
                padding: 1.5rem;
            }
        }
        
        @media (max-width: 576px) {
            .hero-section h1 {
                font-size: 2rem;
            }
            
            .card-reference .card-body {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Floating Background Shapes -->
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-book-half"></i>Referensi
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

                        <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto"> <!-- Added ms-auto for right alignment -->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('/') }}">
                            <i class="bi bi-house-door-fill me-1"></i> Beranda
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center hero-content">
            <h1 class="display-4 fw-bold mb-3">Koleksi Referensi</h1>
            <p class="lead mb-4">
                Akses berbagai dokumen referensi untuk mendukung pembelajaran Teknik Jaringan Komputer dan Telekomunikasi
            </p>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container my-4">
        <!-- Search Section -->
        <div class="search-section">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control" placeholder="Cari referensi...">
                        <button class="btn btn-primary">Cari</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <select class="form-select">
                        <option selected>Semua Kategori</option>
                        <option>Jaringan Komputer</option>
                        <option>Telekomunikasi</option>
                        <option>K3LH</option>
                        <option>Proses Bisnis</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- References Grid -->
        <div class="row g-4">
            <!-- Reference 1 -->
            <div class="col-md-6 col-lg-4">
                <div class="card card-reference">
                    <div class="card-body">
                        <span class="badge-category">Dasar-Dasar</span>
                        <h5 class="card-title">Dasar-Dasar Teknik Jaringan Komputer dan Telekomunikasi</h5>
                        <p class="card-text">Referensi lengkap tentang konsep dasar jaringan komputer dan sistem telekomunikasi modern.</p>
                        
                        <div class="iframe-container" id="ref1">
                            <iframe 
                                src="https://drive.google.com/file/d/1eTeH2jcGu8J930ishR0qHuhFXwneIyhw/preview"
                                allow="autoplay"
                                loading="lazy">
                            </iframe>
                            <button class="fullscreen-btn" onclick="toggleFullscreen('ref1')">
                                <i class="bi bi-arrows-fullscreen"></i> Layar Penuh
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Additional Reference Cards (for demo) -->
            <div class="col-md-6 col-lg-4">
                <div class="card card-reference">
                    <div class="card-body">
                        <span class="badge-category">Jaringan</span>
                        <h5 class="card-title">Protokol Jaringan dan Komunikasi Data</h5>
                        <p class="card-text">Panduan komprehensif tentang protokol jaringan, TCP/IP, dan arsitektur komunikasi data.</p>
                        
                        <div class="iframe-container" id="ref2">
                            <iframe 
                                src="https://drive.google.com/file/d/1eTeH2jcGu8J930ishR0qHuhFXwneIyhw/preview"
                                allow="autoplay"
                                loading="lazy">
                            </iframe>
                            <button class="fullscreen-btn" onclick="toggleFullscreen('ref2')">
                                <i class="bi bi-arrows-fullscreen"></i> Layar Penuh
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="card card-reference">
                    <div class="card-body">
                        <span class="badge-category">Keamanan</span>
                        <h5 class="card-title">Keamanan Jaringan dan Sistem Informasi</h5>
                        <p class="card-text">Materi lengkap tentang keamanan jaringan, enkripsi, dan perlindungan sistem informasi.</p>
                        
                        <div class="iframe-container" id="ref3">
                            <iframe 
                                src="https://drive.google.com/file/d/1eTeH2jcGu8J930ishR0qHuhFXwneIyhw/preview"
                                allow="autoplay"
                                loading="lazy">
                            </iframe>
                            <button class="fullscreen-btn" onclick="toggleFullscreen('ref3')">
                                <i class="bi bi-arrows-fullscreen"></i> Layar Penuh
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function toggleFullscreen(refId) {
            var iframeContainer = document.getElementById(refId);

            if (!iframeContainer.classList.contains('fullscreen')) {
                iframeContainer.classList.add('fullscreen');
                if (iframeContainer.requestFullscreen) {
                    iframeContainer.requestFullscreen();
                } else if (iframeContainer.mozRequestFullScreen) {
                    iframeContainer.mozRequestFullScreen();
                } else if (iframeContainer.webkitRequestFullscreen) {
                    iframeContainer.webkitRequestFullscreen();
                } else if (iframeContainer.msRequestFullscreen) {
                    iframeContainer.msRequestFullscreen();
                }
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                }
                iframeContainer.classList.remove('fullscreen');
            }
        }

        // Handle fullscreen change event to update UI
        document.addEventListener('fullscreenchange', handleFullscreenChange);
        document.addEventListener('webkitfullscreenchange', handleFullscreenChange);
        document.addEventListener('mozfullscreenchange', handleFullscreenChange);
        document.addEventListener('MSFullscreenChange', handleFullscreenChange);

        function handleFullscreenChange() {
            var fullscreenElement = document.fullscreenElement || 
                                  document.webkitFullscreenElement || 
                                  document.mozFullScreenElement || 
                                  document.msFullscreenElement;
            
            if (!fullscreenElement) {
                document.querySelectorAll('.iframe-container').forEach(function(container) {
                    container.classList.remove('fullscreen');
                });
            }
        }

        // Add smooth scrolling and entrance animations
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card-reference');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            });

            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(50px)';
                card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
                observer.observe(card);
            });
        });
    </script>
</body>
</html>