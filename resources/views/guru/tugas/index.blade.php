@extends('guru.guru_master')

@section('guru')
<div class="container-fluid py-4">
    <div class="row mb-5">
        <div class="col-12">
            <div class="header-card bg-primary text-white rounded-4 p-4 p-md-5 shadow-lg position-relative overflow-hidden">
                <div class="header-overlay"></div>
                <div class="d-flex flex-column flex-md-row align-items-center justify-content-between position-relative z-index-1">
                    <div class="text-center text-md-start mb-3 mb-md-0">
                        <h1 class="h4 fw-bold mb-2 text-white">
                            <i class="fas fa-chalkboard-teacher me-3 opacity-75"></i>Kelola Tugas
                        </h1>
                        <p class="mb-0 opacity-75 text-white-75 fs-6">Kelola dan pantau tugas untuk siswa Anda dengan mudah.</p>
                    </div>
                    <a href="{{ route('guru.tugas.create') }}" class="btn btn-light btn-md shadow-sm hover-lift-shadow rounded-pill px-4 py-2">
                        <i class="fas fa-plus me-2"></i>Buat Tugas Baru
                    </a>
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

    @php
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
                            @php
                                $aktiveTugas = $tugas->filter(function($item) {
                                    return !\Carbon\Carbon::parse($item->batas_pengumpulan)->isPast();
                                })->count();
                            @endphp
                            <h3 class="h5 fw-bold mb-0">{{ $tugas->count() }}</h3>
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
                            @php
                                $kedaluwarsaTugas = $tugas->filter(function($item) {
                                    return \Carbon\Carbon::parse($item->batas_pengumpulan)->isPast();
                                })->count();
                            @endphp
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
                            <i class="fas fa-link text-info fs-4"></i> {{-- Changed icon to fa-link --}}
                        </div>
                        <div>
                            @php
                                $tugasWithLinks = $tugas->filter(function($item) {
                                    return !empty($item->link_tugas);
                                })->count();
                            @endphp
                            <h3 class="h5 fw-bold mb-0">{{ $tugasWithLinks }}</h3>
                            <p class="text-muted mb-0 small">Dengan Link Tugas</p>
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
                                        {{ $isOverdue ? 'Kedaluwarsa' : 'Aktif' }}
                                    </span>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-link text-white p-0 shadow-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v opacity-75"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end animated-dropdown">
                                        <li><a class="dropdown-item" href="{{ route('guru.tugas.edit', $item->id) }}"><i class="fas fa-edit me-2 text-primary"></i>Edit</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="{{ route('guru.tugas.destroy', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger delete-task-btn"><i class="fas fa-trash-alt me-2"></i>Hapus</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <h5 class="fw-bold mb-2 text-truncate-2" title="{{ $item->judul }}">
                                {{ $item->judul }}
                            </h5>
                        </div>

                        <div class="card-body p-4 d-flex flex-column">
                            {{-- Menambahkan Deskripsi Tugas --}}
                            <p class="text-muted small mb-3">
                                {{ Str::limit($item->deskripsi, 100) }} {{-- Batasi 100 karakter --}}
                            </p>

                            <div class="info-grid mb-4 flex-grow-1">
                                <div class="info-item d-flex align-items-center mb-3">
                                    <div class="info-icon bg-primary-light rounded-3 p-2 me-3">
                                        <i class="{{ $deadlineIconClass }} fs-7"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="small text-muted mb-1">Tenggat Waktu</p>
                                        <p class="fw-semibold mb-0 fs-6 {{ $deadlineColorClass }}">
                                            {{ \Carbon\Carbon::parse($item->batas_pengumpulan)->translatedFormat('d M Y, H:i') }}
                                        </p>
                                    </div>
                                </div>

                                <div class="info-item d-flex align-items-center mb-3">
                                    <div class="info-icon bg-info-light rounded-3 p-2 me-3">
                                        <i class="fas fa-link text-info fs-7"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="small text-muted mb-1">Sumber Tugas</p>
                                        @if (!empty($item->link_tugas))
                                            {{-- Menampilkan Link Tugas Eksternal --}}
                                            <a href="{{ $item->link_tugas }}" target="_blank" class="fw-semibold mb-0 text-decoration-none file-link fs-6">
                                                <i class="fas fa-external-link-alt me-1"></i> Link Tugas
                                            </a>
                                        @else
                                            <p class="fw-semibold mb-0 text-muted small">- Tidak Ada Link -</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-3 mt-auto">
                                {{-- The "Lihat Jawaban" button is removed as per your request --}}
                                <div class="d-flex gap-2 flex-column flex-sm-row">
                                    <a href="{{ route('guru.tugas.edit', $item->id) }}"
                                       class="btn btn-outline-primary rounded-pill flex-grow-1 py-2 hover-scale btn-sm">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                    <form action="{{ route('guru.tugas.destroy', $item->id) }}" method="POST"
                                          class="flex-grow-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger rounded-pill w-100 py-2 delete-task-btn btn-sm">
                                            <i class="fas fa-trash-alt me-1"></i>Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-5 d-flex justify-content-center">
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
                <h3 class="fw-bold text-dark mb-3 h5">Belum Ada Tugas</h3>
                <p class="text-muted mb-4 small">Mulai buat tugas pertama Anda untuk dibagikan kepada siswa dan pantau kemajuan mereka.</p>
                <a href="{{ route('guru.tugas.create') }}" class="btn btn-primary btn-md rounded-pill px-4 py-3 shadow-sm hover-bounce">
                    <i class="fas fa-plus me-2"></i>Buat Tugas Pertama
                </a>
            </div>
        </div>
    @endif
</div>
@endsection

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlalHbhJ0ZcM5b/2z+o8lKxW/W9U+sT1V4/0aN/4P+g0z/aQ02Nq6z5/1/2+Q=" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    /* Your existing styles remain unchanged */
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

    body {
        background: var(--light-color);
        font-family: 'Inter', sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        line-height: 1.6;
        color: var(--dark-color);
        /* Set base font-size for rem units to scale from */
        font-size: 1rem; /* Default browser font size is typically 16px */
    }

    /* Bootstrap's default font sizes */
    .fs-1 { font-size: calc(1.375rem + 1.5vw) !important; }
    .fs-2 { font-size: calc(1.325rem + 0.9vw) !important; }
    .fs-3 { font-size: calc(1.3rem + 0.6vw) !important; }
    .fs-4 { font-size: calc(1.275rem + 0.3vw) !important; }
    .fs-5 { font-size: 1.25rem !important; }
    .fs-6 { font-size: 1rem !important; }
    .fs-7 { font-size: 0.875rem !important; } /* Custom smaller size */

    /* Adjusted icon sizes using fs classes */
    .fa-lg { font-size: 1.125em; /* Default Bootstrap size for fa-lg */ }


    /* Your existing styles remain unchanged, just ensuring they don't override the general font settings too aggressively */
    .rounded-4 { border-radius: var(--border-radius-lg) !important; }
    .rounded-3 { border-radius: var(--border-radius-md) !important; }
    .rounded-pill { border-radius: var(--border-radius-pill) !important; }
    .shadow-sm { box-shadow: var(--shadow-sm) !important; }
    .shadow-md { box-shadow: var(--shadow-md) !important; }
    .shadow-lg { box-shadow: var(--shadow-lg) !important; }

    /* Header Card Enhancements */
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

    /* Hover Effects */
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

    /* Tugas Card Specific Styles */
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

    /* Stats Card Styles */
    .stats-card {
        border: 1px solid rgba(0, 0, 0, 0.05);
        background-color: white;
    }

    .stats-icon {
        width: 50px; /* Reduced from 60px */
        height: 50px; /* Reduced from 60px */
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: var(--border-radius-md);
    }

    /* Info Item Icons */
    .info-icon {
        width: 36px; /* Reduced from 40px */
        height: 36px; /* Reduced from 40px */
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: var(--border-radius-sm);
    }

    /* Link color and hover for file links */
    .file-link {
        color: var(--primary-color);
    }
    .file-link:hover {
        color: var(--secondary-color);
        text-decoration: underline !important;
    }

    /* Button Styles */
    .btn {
        font-weight: 600;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        border-width: 1.5px;
        font-size: 0.9rem; /* Slightly smaller default button font size */
    }

    .btn-lg {
        font-size: 1rem; /* Adjust if btn-lg is still used, but changed to btn-md above */
        padding: 0.75rem 1.5rem;
    }

    .btn-md {
        font-size: 0.95rem; /* Adjusted for btn-md */
        padding: 0.625rem 1.25rem;
    }

    .btn-sm {
        font-size: 0.85rem; /* Adjusted for btn-sm */
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

    .btn-outline-primary {
        color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-outline-primary:hover {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
    }

    .btn-outline-danger {
        color: var(--danger-color);
        border-color: var(--danger-color);
    }

    .btn-outline-danger:hover {
        background: var(--danger-color);
        border-color: var(--danger-color);
        color: white;
    }

    .btn-light {
        color: var(--primary-color);
    }
    .btn-light:hover {
        color: var(--secondary-color);
        background-color: #e2e8f0;
    }

    /* Alert Styles */
    .alert {
        border: none;
        box-shadow: var(--shadow-sm);
        padding: 1rem 1.25rem; /* Slightly reduced padding */
    }

    .alert-success {
        background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
        color: #065f46;
        border-left: 5px solid var(--success-color);
    }

    .alert-icon {
        width: 40px; /* Reduced from 48px */
        height: 40px; /* Reduced from 48px */
        background: var(--success-light);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--success-color);
    }

    .btn-close {
        font-size: 0.8rem; /* Slightly smaller close button */
        padding: 0.5rem;
        margin: -0.25rem -0.5rem -0.25rem auto;
    }

    /* Empty State */
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

    /* Dropdown Menu Animation */
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

    /* Pagination Styles */
    .pagination .page-item .page-link {
        color: var(--primary-color);
        border: 1px solid #e2e8f0;
        border-radius: var(--border-radius-md);
        margin: 0 0.2rem; /* Slightly reduced margin */
        padding: 0.6rem 0.9rem; /* Reduced padding */
        transition: all 0.2s ease;
        font-weight: 600;
        font-size: 0.9rem; /* Adjusted font size for pagination */
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

    /* Responsive Adjustments */
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
            font-size: 1.5rem; /* Adjusted for smaller screens */
        }

        .header-card p {
            font-size: 0.875rem; /* Adjusted for smaller screens */
        }

        .btn-lg, .btn-md { /* Ensure btn-lg and btn-md are also adjusted if they end up being used */
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

    /* Animation for cards */
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

    /* Adjusted delays for better staggering */
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
<script>
    // Add smooth scrolling behavior
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // Add loading state for delete buttons with confirmation modal
    document.querySelectorAll('.delete-task-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('form');
            const submitBtn = this;

            const confirmModal = document.createElement('div');
            confirmModal.className = 'modal fade show d-block';
            confirmModal.style.backgroundColor = 'rgba(0,0,0,0.5)';
            confirmModal.setAttribute('tabindex', '-1');
            confirmModal.setAttribute('role', 'dialog');
            confirmModal.innerHTML = `
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content rounded-4 shadow-lg p-3">
                        <div class="modal-header border-0 pb-0">
                            <h5 class="modal-title fw-bold">Konfirmasi Penghapusan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-muted">
                            Apakah Anda yakin ingin menghapus tugas ini? Tindakan ini tidak dapat dibatalkan.
                        </div>
                        <div class="modal-footer border-0 pt-0">
                            <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-danger rounded-pill confirm-delete-btn">Hapus</button>
                        </div>
                    </div>
                </div>
            `;
            document.body.appendChild(confirmModal);

            const bsModal = new bootstrap.Modal(confirmModal);
            bsModal.show();

            confirmModal.querySelector('.btn-close').addEventListener('click', () => {
                bsModal.hide();
                confirmModal.remove();
            });

            confirmModal.querySelector('.confirm-delete-btn').addEventListener('click', () => {
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Menghapus...';
                }
                bsModal.hide();
                confirmModal.remove();
                form.submit();
            });

            confirmModal.addEventListener('hidden.bs.modal', () => {
                confirmModal.remove();
            });
        });
    });

    // Handle alert dismissal visually
    document.addEventListener('DOMContentLoaded', function() {
        const alertElement = document.querySelector('.alert');
        if (alertElement) {
            const bsAlert = new bootstrap.Alert(alertElement);
            setTimeout(() => {
                bsAlert.dispose();
            }, 7000);
        }
    });
</script>
@endpush