@extends('guru.guru_master') {{-- Changed back to guru_master --}}

@section('guru') {{-- Changed back to guru section --}}
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.5.95/css/materialdesignicons.min.css" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: '#3a7bd5',
                    secondary: '#00d2ff',
                    info: '#3a7bd5',
                    warning: '#ffc107',
                    success: '#28a745',
                    darkblue: '#1a569a', // A darker shade for text/elements
                },
                boxShadow: {
                    'xl-custom': '0 10px 20px rgba(0, 0, 0, 0.1)',
                    '2xl-custom': '0 12px 35px rgba(0, 0, 0, 0.12)',
                },
                borderRadius: {
                    '4xl': '2rem', // Custom large radius
                }
            }
        }
    }
</script>

<div class="container-fluid px-0 font-inter">
    {{-- Header Section: Refactored for cleaner look and reduced text clutter --}}
    <div class="relative w-full py-16 lg:py-20 overflow-hidden rounded-b-4xl shadow-2xl-custom header-bg">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col items-center text-center">
                {{-- Main Welcome Message --}}
                    <h2 class="font-bold mb-2 text-white text-3xl sm:text-4xl lg:text-5xl leading-tight break-words drop-shadow-lg">
                        Selamat Datang, {{ Auth::user()->name }}
                    </h2>
                {{-- Combined Subject and Class Information --}}
                <p class="text-white text-lg sm:text-xl lg:text-2xl font-medium mb-4 opacity-90 drop-shadow-md animate-fade-in-up">
                    Elemen Media dan Jaringan Telekomunikasi | Semester Genap Kelas X TJKT
                </p>
                {{-- Concise Tagline/Description --}}
                <p class="text-white text-base sm:text-lg opacity-80 max-w-2xl mx-auto mb-8 animate-fade-in-up delay-100">
                    Kelola materi, tugas, dan nilai siswa dengan mudah.
                </p>
                
                {{-- Date and Time Display --}}
                <div class="flex flex-col sm:flex-row items-center justify-center space-y-3 sm:space-y-0 sm:space-x-4 animate-fade-in-up delay-200">
                    <div class="flex items-center bg-white text-primary px-4 py-2 rounded-full shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-lg border border-white/50">
                        <i class="mdi mdi-calendar-check mdi-18px mr-2 text-xl"></i>
                        <span id="current-date" class="text-sm sm:text-base font-semibold"></span>
                    </div>
                    <div class="flex items-center bg-white text-primary px-4 py-2 rounded-full shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-lg border border-white/50">
                        <i class="mdi mdi-clock-outline mdi-18px mr-2 text-xl"></i>
                        <span id="current-time" class="text-sm sm:text-base font-semibold"></span>
                    </div>
                </div>
            </div>
        </div>
        {{-- Wave Shape at the bottom of the header --}}
        <div class="wave-shape absolute bottom-0 left-0 w-full overflow-hidden leading-none">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-full h-10 sm:h-12 lg:h-16">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" fill="#ffffff"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" fill="#ffffff"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="#ffffff"></path>
            </svg>
        </div>
    </div>

    <div class="main-panel bg-gray-50 min-h-screen">
        {{-- Main content padding adjusted to reduce space from header --}}
        <div class="container mx-auto py-0 px-4 sm:px-6 lg:px-8">
            {{-- Gap between main sections reduced --}}
            <div class="grid grid-cols-1 gap-6 mb-6">
                <div class="col-span-1">
                    {{-- Margin bottom for learning section cards reduced --}}
                    <div class="mb-6 learning-section-card">
                        {{-- Header padding reverted to original guru version --}}
                        <div class="flex items-center p-6 lg:p-8 relative overflow-hidden rounded-t-2xl section-header-bg">
                            <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center mr-6 backdrop-blur-md border border-white/30 flex-shrink-0">
                                <i class="mdi mdi-target text-white text-3xl"></i>
                            </div>
                            <div class="flex-1">
                                {{-- Font size reverted to original guru version --}}
                                <h3 class="text-white text-2xl font-bold m-0 mb-1 drop-shadow-sm">Capaian Pembelajaran</h3>
                                {{-- Text reverted for guru dashboard --}}
                                <p class="text-white/90 text-sm m-0 font-normal">Target kompetensi yang akan dicapai</p>
                            </div>
                        </div>
                        {{-- Content padding reverted to original guru version --}}
                        <div class="p-8 bg-white rounded-b-2xl">
                            <div class="flex flex-col lg:flex-row items-center bg-white rounded-xl p-6 shadow-md border border-gray-200 relative overflow-hidden achievement-card-border">
                                <div class="w-20 h-20 bg-primary rounded-full flex items-center justify-center mr-0 lg:mr-6 mb-4 lg:mb-0 flex-shrink-0">
                                    <i class="mdi mdi-school text-white text-4xl"></i>
                                </div>
                                <div class="flex-1 text-center lg:text-left">
                                    {{-- Text reverted for guru dashboard --}}
                                    <p class="m-0 text-base leading-relaxed text-gray-700">Pada akhir fase E, peserta didik mampu memahami prinsip dasar sistem IPV4/IPV6, TCP IP, Networking Service, Sistem Keamanan Jaringan Telekomunikasi, Sistem Seluler, Sistem Microwave, Sistem VSAT IP, Sistem Optik, dan Sistem WLAN.</p>
                                </div>
                                {{-- Font size reverted to original guru version --}}
                                <div class="ml-0 lg:ml-4 mt-4 lg:mt-0 flex-shrink-0">
                                    <span class="bg-primary text-white px-4 py-2 rounded-full font-semibold text-sm badge-gradient">Fase E</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="learning-section-card">
                        {{-- Header padding reverted to original guru version --}}
                        <div class="flex items-center p-6 lg:p-8 relative overflow-hidden rounded-t-2xl section-header-bg-tp">
                            <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center mr-6 backdrop-blur-md border border-white/30 flex-shrink-0">
                                <i class="mdi mdi-bullseye-arrow text-white text-3xl"></i>
                            </div>
                            <div class="flex-1">
                                {{-- Font size reverted to original guru version --}}
                                <h3 class="text-white text-2xl font-bold m-0 mb-1 drop-shadow-sm">Tujuan Pembelajaran</h3>
                                {{-- Font size reverted to original guru version --}}
                                <p class="text-white/90 text-sm m-0 font-normal">Indikator pencapaian kompetensi</p>
                            </div>
                        </div>
                        {{-- Content padding reverted to original guru version --}}
                        <div class="p-8 bg-white rounded-b-2xl">
                            {{-- Gap between objective cards reverted to original guru version --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <div class="bg-white rounded-xl p-6 shadow-md border border-gray-200 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg relative overflow-hidden objective-card-1">
                                    {{-- Padding, border-radius, and font size reverted to original guru version --}}
                                    <div class="absolute pill-indicator bg-gradient-to-r from-primary to-secondary text-white font-bold text-base shadow-xl z-10">
                                        <span>Indikator 6.1</span>
                                    </div>
                                    <div class="pt-4">
                                        <div class="w-12 h-12 bg-gray-50 rounded-lg flex items-center justify-center mb-4 border-2 border-gray-200">
                                            <i class="mdi mdi-network text-2xl text-gray-600"></i>
                                        </div>
                                        {{-- Font size reverted to original guru version --}}
                                        <h5 class="text-xl font-bold text-gray-900 mb-3">Sistem Jaringan Dasar</h5>
                                        {{-- Font size reverted to original guru version --}}
                                        <p class="text-base text-gray-600 leading-relaxed mb-4">Memahami prinsip dasar sistem IPV4/IPV6, TCP IP, Networking Service, dan Sistem Keamanan Jaringan Telekomunikasi</p>
                                    </div>
                                </div>

                                <div class="bg-white rounded-xl p-6 shadow-md border border-gray-200 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg relative overflow-hidden objective-card-2">
                                    {{-- Padding, border-radius, and font size reverted to original guru version --}}
                                    <div class="absolute pill-indicator bg-gradient-to-r from-red-500 to-orange-500 text-white font-bold text-base shadow-xl z-10">
                                        <span>Indikator 6.2</span>
                                    </div>
                                    <div class="pt-4">
                                        <div class="w-12 h-12 bg-gray-50 rounded-lg flex items-center justify-center mb-4 border-2 border-gray-200">
                                            <i class="mdi mdi-satellite-variant text-2xl text-gray-600"></i>
                                        </div>
                                        {{-- Font size reverted to original guru version --}}
                                        <h5 class="text-xl font-bold text-gray-900 mb-3">Sistem Komunikasi Nirkabel</h5>
                                        {{-- Font size reverted to original guru version --}}
                                        <p class="text-base text-gray-600 leading-relaxed mb-4">Memahami prinsip dasar Sistem Seluler, Sistem Microwave, dan Sistem VSAT IP</p>
                                    </div>
                                </div>

                                <div class="bg-white rounded-xl p-6 shadow-md border border-gray-200 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg relative overflow-hidden objective-card-3">
                                    {{-- Padding, border-radius, and font size reverted to original guru version --}}
                                    <div class="absolute pill-indicator bg-gradient-to-r from-green-400 to-green-600 text-white font-bold text-base shadow-xl z-10">
                                        <span>Indikator 6.3</span>
                                    </div>
                                    <div class="pt-4">
                                        <div class="w-12 h-12 bg-gray-50 rounded-lg flex items-center justify-center mb-4 border-2 border-gray-200">
                                            <i class="mdi mdi-wifi text-2xl text-gray-600"></i>
                                        </div>
                                        {{-- Font size reverted to original guru version --}}
                                        <h5 class="text-xl font-bold text-gray-900 mb-3">Sistem Optik & WLAN</h5>
                                        {{-- Font size reverted to original guru version --}}
                                        <p class="text-base text-gray-600 leading-relaxed mb-4">Memahami prinsip dasar Sistem Optik dan Sistem WLAN</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12">
                    {{-- Font size reverted to original guru version --}}
                    <h4 class="font-bold mb-6 text-2xl sm:text-3xl text-gray-800">Menu Utama</h4>
                    {{-- Gap between menu cards reverted to original guru version --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @php
                            $cards = [
                                ['title' => 'Materi', 'icon' => 'mdi-cloud-upload', 'color' => 'bg-blue-500', 'route' => route('guru.materi.index'), 'desc' => 'Materi pembelajaran untuk siswa'],
                                ['title' => 'Tugas', 'icon' => 'mdi-file-edit', 'color' => 'bg-yellow-500', 'route' => route('guru.tugas.index'), 'desc' => 'Tugas untuk siswa'],
                                ['title' => 'Laporan Nilai', 'icon' => 'mdi-chart-bar', 'color' => 'bg-indigo-500', 'route' => route('guru.nilai.index'), 'desc' => 'Nilai siswa'],
                                ['title' => 'Quiz', 'icon' => 'mdi-file-chart', 'color' => 'bg-green-500', 'route' => route('guru.quiz.index'), 'desc' => 'Laporan perkembangan siswa'],
                            ];
                        @endphp

                        @foreach ($cards as $card)
                            <div class="col-span-1">
                                <a href="{{ $card['route'] }}" class="block h-full bg-white rounded-xl shadow-md border border-gray-200 text-decoration-none transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                                    <div class="flex flex-col items-center p-6 text-center">
                                        <div class="w-20 h-20 rounded-full flex items-center justify-center mb-4 {{ $card['color'] }} shadow-lg">
                                            <i class="mdi {{ $card['icon'] }} mdi-36px text-white text-4xl"></i>
                                        </div>
                                        {{-- Font size reverted to original guru version --}}
                                        <h5 class="font-bold mb-2 text-gray-900 text-xl">{{ $card['title'] }}</h5>
                                        {{-- Font size reverted to original guru version --}}
                                        <p class="text-gray-600 text-sm leading-relaxed">{{ $card['desc'] }}</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom font */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    body {
        font-family: 'Inter', sans-serif;
    }

    /* Header Background Gradient */
    .header-bg {
        background: linear-gradient(135deg, #3a7bd5, #00d2ff);
        /* Adding subtle pattern for extra flair */
        background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zm0 36v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0 36v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zM12 34v-4H10v4H6v2h4v4h2v-4h4v-2h-4zm0-30V0H10v4H6v2h4v4h2V6h4V4h-4zm0 36v-4H10v4H6v2h4v4h2v-4h4v-2h-4zm0 36v-4H10v4H6v2h4v4h2v-4h4v-2h-4z"%3E%3C/path%3E%3C/g%3E%3C/g%3E%3C/svg%3E'), linear-gradient(135deg, #3a7bd5, #00d2ff);
        background-repeat: repeat, no-repeat;
        background-position: top left, center center;
        background-size: 60px 60px, cover;
    }

    /* CP Section Header Background */
    .section-header-bg {
        background: linear-gradient(135deg, #3a7bd5, #00d2ff);
    }

    /* TP Section Header Background */
    .section-header-bg-tp {
        background: linear-gradient(135deg, #ff6b6b, #ee5a24);
    }

    /* CP Achievement Card Left Border */
    .achievement-card-border::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(135deg, #3a7bd5, #00d2ff);
        border-top-left-radius: 15px;
        border-bottom-left-radius: 15px;
    }

    /* Pill shape indicator for 6.1, 6.2, 6.3 */
    .pill-indicator {
        padding: 0.25rem 0.75rem; /* Adjusted padding for a more compact pill */
        border-radius: 9999px; /* Fully rounded corners for pill shape */
        top: 0.5rem; /* Adjusted top to be inside the card, more visually appealing */
        right: 0.5rem; /* Adjusted right for better spacing */
        font-size: 0.875rem; /* Equivalent to text-sm */
        line-height: 1.25rem; /* Equivalent to text-sm line height */
    }


    /* Specific Objective Card Number Backgrounds - now applied to the new pill-indicator class */
    .objective-card-1 .pill-indicator {
        background: linear-gradient(135deg, #3a7bd5, #00d2ff);
    }
    .objective-card-2 .pill-indicator {
        background: linear-gradient(135deg, #ff6b6b, #ee5a24);
    }
    .objective-card-3 .pill-indicator {
        background: linear-gradient(135deg, #26de81, #20bf6b);
    }

    /* Wave shape transformation */
    .wave-shape {
        transform: rotate(180deg);
    }

    /* Animations for header elements */
    @keyframes fade-in-down {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in-down {
        animation: fade-in-down 0.8s ease-out forwards;
    }

    .animate-fade-in-up {
        animation: fade-in-up 0.8s ease-out forwards;
    }

    .animate-fade-in-up.delay-100 {
        animation-delay: 0.1s;
    }

    .animate-fade-in-up.delay-200 {
        animation-delay: 0.2s;
    }
</style>

<script>
    function updateDateTime() {
        const now = new Date();
        
        // Format tanggal: Hari, DD MMMM (contoh: Senin, 01 Januari 2023)
        const optionsDate = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('current-date').textContent = now.toLocaleDateString('id-ID', optionsDate);
        
        // Format waktu: HH:MM:SS (contoh: 14:30:00)
        const optionsTime = { hour: '2-digit', minute: '2-digit', second: '2-digit' };
        document.getElementById('current-time').textContent = now.toLocaleTimeString('id-ID', optionsTime);
    }
    
    // Update setiap detik
    setInterval(updateDateTime, 1000);
    
    // Jalankan pertama kali
    updateDateTime();
</script>
@endsection
