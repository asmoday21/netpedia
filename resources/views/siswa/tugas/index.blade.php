@extends('siswa.siswa_master')

{{-- Jika siswa_master punya @yield('title'), bisa pakai ini: --}}
@section('title', 'Daftar Tugasmu!')

@section('siswa')
    <div class="container-fluid py-4">
        <div class="row mb-5">
            <div class="col-12">
                <div class="header-card bg-primary text-white rounded-4 p-4 p-md-5 shadow-lg position-relative overflow-hidden">
                    <div class="header-overlay"></div>
                    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between position-relative z-index-1">
                        <div class="text-center text-md-start mb-3 mb-md-0">
                            <h1 class="h4 fw-bold mb-2 text-white">
                                <i class="fas fa-tasks me-3 opacity-75"></i>Daftar Tugasmu!
                            </h1>
                            <p class="mb-0 opacity-75 text-white-75 fs-6">Lihat semua tugas yang diberikan gurumu dan jangan sampai terlewat!</p>
                        </div>
                        {{-- Tombol 'Buat Tugas Baru' tidak ada di sini karena ini adalah tampilan siswa. --}}
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm border-0 mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <div class="alert-icon me-3">
                        <i class="fas fa-check-circle fs-5"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="alert-heading fw-bold mb-1">Berhasil!</h6>
                        <p class="mb-0 small">{{ session('success') }}</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm border-0 mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <div class="alert-icon me-3">
                        <i class="fas fa-exclamation-circle fs-5"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="alert-heading fw-bold mb-1">Terjadi Kesalahan!</h6>
                        <p class="mb-0 small">{{ session('error') }}</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @php
            // Variabel untuk gradien latar belakang kartu tugas
            $bgGradients = [
                'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
                'linear-gradient(135deg, #a7bfe8 0%, #619afc 100%)',
                'linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%)',
                'linear-gradient(135deg, #fbc2eb 0%, #a6c1ee 100%)',
                'linear-gradient(135deg, #b3e5fc 0%, #d1c4e9 100%)'
            ];
        @endphp

        @if ($tugas->count() > 0)
            <div class="row mb-5 g-4">
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card bg-white rounded-4 p-3 shadow-sm border-0 hover-lift-sm">
                        <div class="d-flex align-items-center">
                            <div class="stats-icon bg-primary-light rounded-3 p-3 me-3">
                                <i class="fas fa-tasks text-primary fs-4"></i>
                            </div>
                            <div>
                                <h3 class="h5 fw-bold mb-0">{{ $tugas->total() }}</h3>
                                <p class="text-muted mb-0 small">Total Tugas</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card bg-white rounded-4 p-3 shadow-sm border-0 hover-lift-sm">
                        <div class="d-flex align-items-center">
                            <div class="stats-icon bg-success-light rounded-3 p-3 me-3">
                                <i class="fas fa-hourglass-half text-success fs-4"></i>
                            </div>
                            <div>
                                <h3 class="h5 fw-bold mb-0">{{ $aktiveTugas }}</h3>
                                <p class="text-muted mb-0 small">Tugas Aktif</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card bg-white rounded-4 p-3 shadow-sm border-0 hover-lift-sm">
                        <div class="d-flex align-items-center">
                            <div class="stats-icon bg-danger-light rounded-3 p-3 me-3">
                                <i class="fas fa-exclamation-triangle text-danger fs-4"></i>
                            </div>
                            <div>
                                <h3 class="h5 fw-bold mb-0">{{ $kedaluwarsaTugas }}</h3>
                                <p class="text-muted mb-0 small">Kedaluwarsa</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card bg-white rounded-4 p-3 shadow-sm border-0 hover-lift-sm">
                        <div class="d-flex align-items-center">
                            <div class="stats-icon bg-info-light rounded-3 p-3 me-3">
                                <i class="fas fa-link text-info fs-4"></i> {{-- Mengganti ikon paperclip dengan link --}}
                            </div>
                            <div>
                                <h3 class="h5 fw-bold mb-0">{{ $tugasWithLinks }}</h3> {{-- Menggunakan $tugasWithLinks --}}
                                <p class="text-muted mb-0 small">Dengan Link Tugas</p> {{-- Mengubah teks --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                @foreach ($tugas as $index => $item)
                    @php
                        $bgGradient = $bgGradients[$index % count($bgGradients)];
                        $isOverdue = \Carbon\Carbon::parse($item->batas_pengumpulan)->isPast();
                        $deadlineColorClass = $isOverdue ? 'text-danger' : 'text-success';
                        $deadlineIconClass = $isOverdue ? 'fas fa-clock text-danger' : 'fas fa-clock text-success';
                        $statusBadgeClass = $isOverdue ? 'bg-danger' : 'bg-success';
                    @endphp

                    <div class="col-xl-4 col-lg-6 col-md-6 d-flex">
                        <div class="tugas-card bg-white rounded-4 shadow-sm border-0 h-100 overflow-hidden hover-lift-shadow flex-grow-1">
                            <div class="card-header-gradient position-relative p-4 text-white" style="background: {{ $bgGradient }};">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div class="status-badge">
                                        <span class="badge {{ $statusBadgeClass }} bg-opacity-75 text-white border border-white border-opacity-25 rounded-pill px-3 py-2 fw-semibold fs-7">
                                            <i class="fas {{ $isOverdue ? 'fa-exclamation-triangle' : 'fa-check-circle' }} me-2"></i>
                                            {{ $isOverdue ? 'Sudah Lewat Batas' : 'Masih Aktif' }}
                                        </span>
                                    </div>
                                    {{-- Dropdown aksi (edit/hapus) tidak ada di sini karena ini adalah tampilan siswa. --}}
                                </div>
                                <h5 class="fw-bold mb-2 text-truncate-2" title="{{ $item->judul }}">
                                    {{ $item->judul }}
                                </h5>
                            </div>

                            <div class="card-body p-4 d-flex flex-column">
                                <p class="text-muted small mb-3">
                                    {{ Str::limit($item->deskripsi, 100) }}
                                    Ini adalah ringkasan singkat tugasmu. Baca baik-baik ya!
                                </p>

                                <div class="info-grid mb-4 flex-grow-1">
                                    <div class="info-item d-flex align-items-center mb-3">
                                        <div class="info-icon bg-primary-light rounded-3 p-2 me-3">
                                            <i class="{{ $deadlineIconClass }} fs-7"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="small text-muted mb-1">Kapan Harus Selesai?</p>
                                            <p class="fw-semibold mb-0 fs-6 {{ $deadlineColorClass }}">
                                                {{ \Carbon\Carbon::parse($item->batas_pengumpulan)->translatedFormat('d M Y, H:i') }}
                                                Ini adalah batas waktu terakhir kamu bisa mengumpulkan tugas ini. Jangan sampai terlewat!
                                            </p>
                                        </div>
                                    </div>

                                    <div class="info-item d-flex align-items-center mb-3">
                                        <div class="info-icon bg-info-light rounded-3 p-2 me-3">
                                            <i class="fas fa-link text-info fs-7"></i> {{-- Mengganti ikon paperclip dengan link --}}
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="small text-muted mb-1">Sumber Tugas (Kalau Ada)</p>
                                            @if (!empty($item->link_tugas))
                                                <a href="{{ $item->link_tugas }}" target="_blank" class="fw-semibold mb-0 text-decoration-none file-link fs-6">
                                                    <i class="fas fa-external-link-alt me-1"></i>Link Tugas Eksternal
                                                </a>
                                            @else
                                                <p class="fw-semibold mb-0 text-muted small">- Tidak Ada Sumber Tambahan -</p>
                                                <p class="mb-0 text-muted small">Gurumu tidak melampirkan link tambahan untuk tugas ini.</p> {{-- Mengubah teks --}}
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid gap-3 mt-auto">
                                    <a href="{{ route('siswa.tugas.show', $item->id) }}"
                                       class="btn btn-primary rounded-pill py-2 fw-semibold hover-bounce btn-sm">
                                        <i class="fas fa-eye me-2"></i>
                                        Lihat Detail Tugas
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-5 d-flex justify-content-center">
                {{-- Menggunakan pagination dari Laravel Paginator --}}
                {{ $tugas->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="empty-state text-center py-5">
                <div class="empty-state-card bg-white rounded-4 shadow-sm p-5 mx-auto" style="max-width: 500px;">
                    <div class="empty-icon mb-4">
                        <div class="bg-primary-light rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="fas fa-clipboard-list fs-3 text-primary"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold text-dark mb-3 h5">Belum Ada Tugas Baru!</h3>
                    <p class="text-muted mb-4 small">Sepertinya gurumu belum memberikan tugas baru untukmu. Santai dulu, ya! Nanti kalau ada tugas, akan muncul di sini.</p>
                    {{-- Tombol aksi 'Buat Tugas Pertama' tidak ada di sini karena siswa tidak membuat tugas. --}}
                </div>
            </div>
        @endif
    </div>
@endsection

@push('styles')
    {{-- Gaya CSS kustom untuk halaman ini. Ini akan ditambahkan ke bagian <head> dari master layout. --}}
    <style>
        /* Variabel Warna dan Ukuran */
        :root {
            --primary-color: #6366f1; /* Indigo */
            --secondary-color: #8b5cf6; /* Violet */
            --success-color: #10b981; /* Emerald */
            --danger-color: #ef4444; /* Red */
            --warning-color: #f59e0b; /* Amber */
            --info-color: #06b6d4; /* Cyan */
            --light-color: #f8fafc; /* Slate 50 */
            --dark-color: #1e293b; /* Slate 900 */
            --text-muted: #64748b; /* Slate 500 */

            --primary-light: rgba(99, 102, 241, 0.1);
            --success-light: rgba(16, 185, 129, 0.1);
            --danger-light: rgba(239, 68, 68, 0.1);
            --info-light: rgba(6, 182, 212, 0.1);

            --border-radius-sm: 0.5rem;
            --border-radius-md: 0.75rem;
            --border-radius-lg: 1rem;
            --border-radius-pill: 9999px;

            --shadow-xs: 0 1px 1px rgba(0, 0, 0, 0.05);
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --shadow-inner: inset 0 2px 4px 0 rgba(0, 0, 0, 0.06);
        }

        /* Karena master layout sudah mengurus body, font, dan link/icon Bootstrap & Font Awesome,
            maka saya hanya menyertakan gaya kustom yang tidak duplikat atau konflik.
            Saya asumsikan siswa_master memiliki:
            - <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            - <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
            - Font Inter untuk body atau menggunakan @import di CSS.
        */
        body {
            /* Pastikan properti ini tidak diduplikasi jika sudah diatur di master layout */
            background: var(--light-color);
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            line-height: 1.6;
            color: var(--dark-color);
            font-size: 1rem;
        }

        /* Ukuran Font Bootstrap */
        .fs-1 { font-size: calc(1.375rem + 1.5vw) !important; }
        .fs-2 { font-size: calc(1.325rem + 0.9vw) !important; }
        .fs-3 { font-size: calc(1.3rem + 0.6vw) !important; }
        .fs-4 { font-size: calc(1.275rem + 0.3vw) !important; }
        .fs-5 { font-size: 1.25rem !important; }
        .fs-6 { font-size: 1rem !important; }
        .fs-7 { font-size: 0.875rem !important; } /* Ukuran kustom yang lebih kecil */

        /* Ukuran Icon */
        .fa-lg { font-size: 1.125em; }

        /* Gaya Umum */
        .rounded-4 { border-radius: var(--border-radius-lg) !important; }
        .rounded-3 { border-radius: var(--border-radius-md) !important; }
        .rounded-pill { border-radius: var(--border-radius-pill) !important; }
        .shadow-sm { box-shadow: var(--shadow-sm) !important; }
        .shadow-md { box-shadow: var(--shadow-md) !important; }
        .shadow-lg { box-shadow: var(--shadow-lg) !important; }

        /* Header Card (Judul Halaman) */
        .header-card {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border: none;
            position: relative;
            overflow: hidden;
            color: white;
        }

        .header-overlay {
            position: absolute;
            top: -50px;
            left: -50px;
            right: -50px;
            bottom: -50px;
            background-image: radial-gradient(circle at 10% 20%, rgba(255, 255, 255, 0.08) 0%, rgba(255, 255, 255, 0.02) 80%);
            transform: rotate(5deg);
            z-index: 0;
        }

        /* Efek Hover */
        .hover-lift-shadow {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .hover-lift-shadow:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-xl);
        }

        .hover-lift-sm {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .hover-lift-sm:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .hover-bounce {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .hover-bounce:hover {
            transform: translateY(-3px);
        }

        .hover-scale {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .hover-scale:hover {
            transform: scale(1.02);
        }

        /* Gaya Kartu Tugas */
        .tugas-card {
            border: 1px solid var(--primary-light);
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .tugas-card:hover {
            border-color: var(--primary-color);
        }

        .card-header-gradient {
            position: relative;
            overflow: hidden;
            color: white;
        }

        .card-header-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.15);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .tugas-card:hover .card-header-gradient::before {
            opacity: 1;
        }

        /* Gaya Kartu Statistik */
        .stats-card {
            border: 1px solid rgba(0, 0, 0, 0.05);
            background-color: white;
        }

        .stats-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--border-radius-md);
        }

        /* Icon Info Item */
        .info-icon {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--border-radius-sm);
        }

        /* Warna Link File */
        .file-link {
            color: var(--primary-color);
        }
        .file-link:hover {
            color: var(--secondary-color);
            text-decoration: underline !important;
        }

        /* Gaya Tombol */
        .btn {
            font-weight: 600;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            border-width: 1.5px;
            font-size: 0.9rem;
        }

        .btn-lg {
            font-size: 1rem;
            padding: 0.75rem 1.5rem;
        }

        .btn-md {
            font-size: 0.95rem;
            padding: 0.625rem 1.25rem;
        }

        .btn-sm {
            font-size: 0.85rem;
            padding: 0.5rem 1rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            border-color: #4f46e5;
            box-shadow: var(--shadow-md);
        }

        /* Gaya Alert (Pesan Notifikasi) */
        .alert {
            border: none;
            box-shadow: var(--shadow-sm);
            padding: 1rem 1.25rem;
        }

        .alert-success {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
            color: #065f46;
            border-left: 5px solid var(--success-color);
        }

        .alert-icon {
            width: 40px;
            height: 40px;
            background: var(--success-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--success-color);
        }

        .btn-close {
            font-size: 0.8rem;
            padding: 0.5rem;
            margin: -0.25rem -0.5rem -0.25rem auto;
        }

        /* Gaya Tampilan Kosong (Saat Tidak Ada Tugas) */
        .empty-state-card {
            border: 2px dashed #e2e8f0;
            transition: all 0.3s ease;
            background-color: white;
        }

        .empty-state-card:hover {
            border-color: var(--primary-color);
            transform: translateY(-2px);
        }

        .empty-icon .rounded-circle {
            background: var(--primary-light);
            color: var(--primary-color);
        }

        /* Animasi Dropdown Menu */
        .animated-dropdown {
            animation: fadeInScale 0.2s ease-out;
            transform-origin: top right;
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.95) translateY(-10px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        /* Gaya Pagination */
        .pagination .page-item .page-link {
            color: var(--primary-color);
            border: 1px solid #e2e8f0;
            border-radius: var(--border-radius-md);
            margin: 0 0.2rem;
            padding: 0.6rem 0.9rem;
            transition: all 0.2s ease;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border-color: var(--primary-color);
            color: white;
            box-shadow: var(--shadow-md);
        }

        .pagination .page-item .page-link:hover {
            background: var(--primary-light);
            border-color: var(--primary-color);
            color: var(--primary-color);
            transform: translateY(-1px);
        }

        /* Penyesuaian Responsif (untuk Layar Kecil) */
        @media (max-width: 768px) {
            .container-fluid {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .header-card {
                text-align: center;
                padding: 1.5rem;
            }

            .header-card .d-flex {
                flex-direction: column;
                gap: 1rem;
            }

            .header-card h1 {
                font-size: 1.5rem;
            }

            .header-card p {
                font-size: 0.875rem;
            }

            .btn-lg, .btn-md {
                width: 100%;
            }

            .stats-card {
                margin-bottom: 0;
            }

            .tugas-card .d-flex.flex-column.flex-sm-row {
                flex-direction: column !important;
                gap: 0.75rem !important;
            }
        }

        /* Animasi untuk Kartu */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .tugas-card {
            animation: fadeInUp 0.6s ease forwards;
        }

        /* Penyesuaian Jeda Animasi */
        .tugas-card:nth-child(1) { animation-delay: 0.05s; }
        .tugas-card:nth-child(2) { animation-delay: 0.10s; }
        .tugas-card:nth-child(3) { animation-delay: 0.15s; }
        .tugas-card:nth-child(4) { animation-delay: 0.20s; }
        .tugas-card:nth-child(5) { animation-delay: 0.25s; }
        .tugas-card:nth-child(6) { animation-delay: 0.30s; }

        .alert {
            animation: fadeInDown 0.5s ease-out;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush

@push('scripts')
    {{-- JavaScript kustom untuk halaman ini. Ini akan ditambahkan di akhir <body> dari master layout. --}}
    {{-- Anda mungkin tidak perlu memuat bootstrap.bundle.min.js lagi di sini jika sudah ada di master layout. --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script>
        // Menambahkan perilaku smooth scrolling untuk tautan internal
        // Fungsi ini membuat halaman bergerak dengan mulus ke bagian yang dituju (misalnya, jika ada navigasi ke ID tertentu)
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault(); // Mencegah perilaku default tautan (loncat langsung)
                const target = document.querySelector(this.getAttribute('href')); // Menemukan elemen tujuan berdasarkan atribut href
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth' // Membuat efek scroll menjadi halus
                    });
                }
            });
        });

        // Menangani penutupan alert (pesan notifikasi) secara visual dan otomatis
        // Fungsi ini membuat pesan 'Berhasil!' hilang secara otomatis setelah beberapa detik
        document.addEventListener('DOMContentLoaded', function() {
            const alertElement = document.querySelector('.alert'); // Mencari elemen alert (notifikasi) di halaman
            if (alertElement) {
                // Memastikan objek Bootstrap tersedia dan memiliki komponen Alert
                if (typeof bootstrap !== 'undefined' && bootstrap.Alert) {
                    const bsAlert = new bootstrap.Alert(alertElement); // Membuat objek Bootstrap Alert
                    setTimeout(() => {
                        bsAlert.dispose(); // Menutup alert (menghapusnya dari DOM)
                    }, 7000); // Alert akan hilang setelah 7 detik (7000 milidetik)
                } else {
                    // Fallback sederhana jika Bootstrap Alert tidak tersedia (misalnya, jika Bootstrap JS tidak dimuat)
                    setTimeout(() => {
                        alertElement.style.display = 'none'; // Menyembunyikan elemen alert
                    }, 7000);
                }
            }
        });
    </script>
@endpush