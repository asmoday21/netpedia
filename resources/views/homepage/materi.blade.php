<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Materi - Teknik Jaringan Komputer dan Telekomunikasi</title>
    <!-- Font Inter dan JetBrains Mono -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        // Palet warna pendidikan yang harmonis
                        'edu-primary': '#667eea',
                        'edu-secondary': '#764ba2',
                        'edu-accent': '#f093fb',
                        'edu-success': '#4facfe',
                        'edu-warning': '#43e697',
                        'edu-light': '#f8faff',
                        'edu-dark': '#2d3748',
                        'edu-gray': '#718096',
                        'edu-muted': '#e2e8f0',
                    },
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                        'mono': ['JetBrains Mono', 'monospace'],
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'float-delayed': 'float 6s ease-in-out infinite 2s',
                        'gradient': 'gradient 8s ease infinite',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'bounce-gentle': 'bounceGentle 2s infinite',
                        'pulse-soft': 'pulseSoft 3s infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px) rotate(0deg)' },
                            '50%': { transform: 'translateY(-20px) rotate(5deg)' },
                        },
                        gradient: {
                            '0%, 100%': { backgroundPosition: '0% 50%' },
                            '50%': { backgroundPosition: '100% 50%' },
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(50px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        bounceGentle: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                        pulseSoft: {
                            '0%, 100%': { opacity: '0.6' },
                            '50%': { opacity: '1' },
                        }
                    },
                    backgroundSize: {
                        '400%': '400% 400%',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .bg-gradient-education {
            background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #4facfe);
            background-size: 400% 400%;
            animation: gradient 8s ease infinite;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        
        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-hover:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 25px 50px rgba(102, 126, 234, 0.25);
        }
        
        .text-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }
        
        .shape {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(240, 147, 251, 0.1));
            animation: float 6s ease-in-out infinite;
        }
        
        .shape:nth-child(1) { width: 80px; height: 80px; top: 10%; left: 10%; animation-delay: 0s; }
        .shape:nth-child(2) { width: 120px; height: 120px; top: 20%; right: 10%; animation-delay: 2s; }
        .shape:nth-child(3) { width: 100px; height: 100px; bottom: 20%; left: 20%; animation-delay: 4s; }
        .shape:nth-child(4) { width: 60px; height: 60px; top: 60%; right: 30%; animation-delay: 1s; }
        .shape:nth-child(5) { width: 90px; height: 90px; bottom: 10%; right: 15%; animation-delay: 3s; }
        
        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 50%;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
    </style>
</head>
<body class="bg-edu-light font-inter overflow-x-hidden">
    
    <!-- Floating Background Shapes -->
    <div class="floating-shapes fixed inset-0 z-0">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <!-- Navigation -->
    <nav class="glass-effect fixed w-full top-0 z-50 backdrop-blur-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-edu-primary to-edu-secondary rounded-xl flex items-center justify-center animate-bounce-gentle">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold text-gradient">Materi</span>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ url('/') }}" class="nav-link text-edu-dark hover:text-edu-primary font-medium flex items-center">
                        <svg class="w-5 h-5 mr-2 text-edu-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4-8l2 2m-2-2l-2 2"/>
                        </svg>
                        Beranda
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg glass-effect">
                    <svg class="w-6 h-6 text-edu-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden mt-4 p-4 glass-effect rounded-2xl">
                <div class="flex flex-col space-y-3">
                    <a href="{{ url('/') }}" class="text-edu-dark hover:text-edu-primary font-medium py-2">Beranda</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-28 pb-20 bg-gradient-education overflow-hidden">
        <div class="container mx-auto px-6 text-center relative z-10">
            <div class="animate-slide-up">
                <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight">
                    Daftar Materi
                    <span class="block text-3xl md:text-4xl font-medium opacity-90 mt-2">Pembelajaran</span>
                </h1>
                <p class="text-xl md:text-2xl text-white/90 mb-4 max-w-3xl mx-auto">
                    Dasar-Dasar Teknik Jaringan Komputer dan Telekomunikasi
                </p>
                <p class="text-lg text-white/80 font-mono">SMK/MAK Kelas X</p>
            </div>

            <!-- Decorative Elements -->
            <div class="absolute top-10 left-10 w-20 h-20 border-4 border-white/20 rounded-full animate-pulse-soft"></div>
            <div class="absolute bottom-10 right-10 w-16 h-16 bg-white/10 rounded-full animate-float"></div>
            <div class="absolute top-1/2 left-5 w-3 h-3 bg-white/30 rounded-full animate-bounce-gentle"></div>
            <div class="absolute top-1/4 right-20 w-4 h-4 bg-white/25 rounded-full animate-float-delayed"></div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-16 relative z-10">
        <!-- Section Title -->
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-gradient mb-4">Materi Pembelajaran</h2>
            <p class="text-xl text-edu-gray max-w-2xl mx-auto">
                Jelajahi konsep fundamental dalam jaringan komputer dan telekomunikasi
            </p>
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <!-- Card 1: TCP/IP -->
            <div class="card-hover bg-white rounded-3xl p-8 shadow-xl border border-edu-muted/30">
                <div class="flex items-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-r from-edu-primary to-edu-success rounded-2xl flex items-center justify-center mr-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-edu-dark">TCP/IP & Alamat IP</h3>
                        <p class="text-edu-gray text-sm">Protokol Jaringan</p>
                    </div>
                </div>
                
                <p class="text-edu-dark mb-6 leading-relaxed">
                    Mempelajari fundamental komunikasi data dalam jaringan komputer, struktur dan fungsi protokol TCP/IP serta implementasi alamat IP untuk identifikasi perangkat.
                </p>

                <div class="space-y-3">
                    <h4 class="font-semibold text-edu-dark flex items-center">
                        <span class="w-2 h-2 bg-edu-success rounded-full mr-2"></span>
                        Poin Pembelajaran:
                    </h4>
                    <div class="space-y-2">
                        <div class="flex items-center p-3 bg-gradient-to-r from-edu-light to-white rounded-xl border border-edu-muted/20">
                            <span class="text-edu-success font-bold mr-3">✓</span>
                            <span class="text-sm text-edu-dark">Analisis prinsip dasar TCP/IP</span>
                        </div>
                        <div class="flex items-center p-3 bg-gradient-to-r from-edu-light to-white rounded-xl border border-edu-muted/20">
                            <span class="text-edu-success font-bold mr-3">✓</span>
                            <span class="text-sm text-edu-dark">Penjelasan alamat IPv4 & IPv6</span>
                        </div>
                        <div class="flex items-center p-3 bg-gradient-to-r from-edu-light to-white rounded-xl border border-edu-muted/20">
                            <span class="text-edu-success font-bold mr-3">✓</span>
                            <span class="text-sm text-edu-dark">Implementasi praktis networking</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2: Network Services -->
            <div class="card-hover bg-white rounded-3xl p-8 shadow-xl border border-edu-muted/30">
                <div class="flex items-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-r from-edu-secondary to-edu-accent rounded-2xl flex items-center justify-center mr-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-edu-dark">Layanan Jaringan</h3>
                        <p class="text-edu-gray text-sm">Network Services</p>
                    </div>
                </div>
                
                <p class="text-edu-dark mb-6 leading-relaxed">
                    Memahami berbagai layanan yang berjalan di atas infrastruktur jaringan untuk berbagi sumber daya dan informasi secara efisien antar pengguna.
                </p>

                <div class="space-y-3">
                    <h4 class="font-semibold text-edu-dark flex items-center">
                        <span class="w-2 h-2 bg-edu-accent rounded-full mr-2"></span>
                        Poin Pembelajaran:
                    </h4>
                    <div class="space-y-2">
                        <div class="flex items-center p-3 bg-gradient-to-r from-purple-50 to-white rounded-xl border border-edu-muted/20">
                            <span class="text-edu-accent font-bold mr-3">✓</span>
                            <span class="text-sm text-edu-dark">Prinsip dasar networking service</span>
                        </div>
                        <div class="flex items-center p-3 bg-gradient-to-r from-purple-50 to-white rounded-xl border border-edu-muted/20">
                            <span class="text-edu-accent font-bold mr-3">✓</span>
                            <span class="text-sm text-edu-dark">DNS, DHCP & Web Server</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3: Network Security -->
            <div class="card-hover bg-white rounded-3xl p-8 shadow-xl border border-edu-muted/30 md:col-span-2 lg:col-span-1">
                <div class="flex items-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-r from-edu-warning to-edu-primary rounded-2xl flex items-center justify-center mr-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-edu-dark">Keamanan Jaringan</h3>
                        <p class="text-edu-gray text-sm">Network Security</p>
                    </div>
                </div>
                
                <p class="text-edu-dark mb-6 leading-relaxed">
                    Mengenali ancaman dan kerentanan dalam jaringan, mempelajari metode perlindungan data dan sistem dari akses tidak sah atau kerusakan.
                </p>

                <div class="space-y-3">
                    <h4 class="font-semibold text-edu-dark flex items-center">
                        <span class="w-2 h-2 bg-edu-warning rounded-full mr-2"></span>
                        Poin Pembelajaran:
                    </h4>
                    <div class="space-y-2">
                        <div class="flex items-center p-3 bg-gradient-to-r from-green-50 to-white rounded-xl border border-edu-muted/20">
                            <span class="text-edu-warning font-bold mr-3">✓</span>
                            <span class="text-sm text-edu-dark">Keamanan jaringan & WLAN</span>
                        </div>
                        <div class="flex items-center p-3 bg-gradient-to-r from-green-50 to-white rounded-xl border border-edu-muted/20">
                            <span class="text-edu-warning font-bold mr-3">✓</span>
                            <span class="text-sm text-edu-dark">Standar WEP, WPA, WPA2</span>
                        </div>
                        <div class="flex items-center p-3 bg-gradient-to-r from-green-50 to-white rounded-xl border border-edu-muted/20">
                            <span class="text-edu-warning font-bold mr-3">✓</span>
                            <span class="text-sm text-edu-dark">Enkripsi RC4, TKIP, AES</span>
                        </div>
                        <div class="flex items-center p-3 bg-gradient-to-r from-green-50 to-white rounded-xl border border-edu-muted/20">
                            <span class="text-edu-warning font-bold mr-3">✓</span>
                            <span class="text-sm text-edu-dark">WPA2-PSK Implementation</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="mt-20 text-center">
            <div class="glass-effect rounded-3xl p-8 md:p-12 max-w-4xl mx-auto">
                <h3 class="text-3xl md:text-4xl font-bold text-edu-dark mb-4">
                    Siap Memulai Perjalanan Belajar?
                </h3>
                <p class="text-xl text-edu-gray mb-8 max-w-2xl mx-auto">
                    Bergabunglah dengan ribuan siswa yang telah menguasai teknologi jaringan komputer
                </p>
                <a href="{{ route('login') }}" class="bg-gradient-to-r from-edu-primary to-edu-secondary text-white px-8 py-4 rounded-2xl font-semibold text-lg shadow-lg hover:shadow-xl transform transition-all duration-300 hover:scale-105">
                    Mulai Belajar Sekarang
                </a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-edu-dark to-gray-900 text-white py-12 mt-20">
        <div class="container mx-auto px-6 text-center">
            <div class="mb-8">
                <div class="flex items-center justify-center space-x-3 mb-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-edu-primary to-edu-secondary rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold">NetPedia</span>
                </div>
                <p class="text-gray-300 max-w-2xl mx-auto">
                    Platform pembelajaran modern untuk Teknik Jaringan Komputer dan Telekomunikasi. 
                    Membangun masa depan teknologi Indonesia.
                </p>
            </div>
            
            <div class="border-t border-gray-700 pt-8">
                <p class="text-gray-400">
                    &copy; 2025 NetPedia. Dibuat dengan ❤️ untuk pendidikan Indonesia.
                </p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Smooth scroll animation on page load
        window.addEventListener('load', () => {
            document.body.style.opacity = '0';
            setTimeout(() => {
                document.body.style.transition = 'opacity 0.5s ease-in-out';
                document.body.style.opacity = '1';
            }, 100);
        });

        // Add scroll effect to navbar
        window.addEventListener('scroll', () => {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) {
                nav.style.background = 'rgba(255, 255, 255, 0.95)';
            } else {
                nav.style.background = 'rgba(255, 255, 255, 0.25)';
            }
        });
    </script>
</body>
</html>