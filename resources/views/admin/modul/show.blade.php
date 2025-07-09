@extends('admin.admin_master')

@section('admin')
<!-- Load Font Awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<!-- Load Material Design Icons -->
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.5.95/css/materialdesignicons.min.css" rel="stylesheet">
<!-- Load SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">


<div class="container-fluid px-4 py-4"> {{-- Tambah padding Y agar ada sedikit ruang di atas dan bawah --}}
    <!-- Header Halaman -->
    <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div>
            <h2 class="fw-bold mb-0">Detail Modul Ajar</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.admin_master') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.modul.index') }}" class="text-decoration-none">Daftar Modul Ajar</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($modul->judul, 30) }}</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.modul.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center rounded-pill px-4 py-2">
                <i class="mdi mdi-arrow-left me-2"></i>Kembali ke Daftar Modul
            </a>
        </div>
    </div>

    <!-- Konten Utama Modul -->
    <div class="card shadow-lg mb-4 rounded-4 overflow-hidden border-0"> {{-- Tambah shadow-lg, rounded-4, border-0 --}}
        <div class="card-header bg-primary text-white py-4 px-4"> {{-- Padding lebih besar --}}
            <h5 class="mb-0 fs-5"><i class="mdi mdi-information-outline me-2"></i>Informasi Lengkap Modul</h5>
        </div>
        <div class="card-body p-0">
            {{-- Bagian Thumbnail / Media --}}
            <div class="row g-0">
                <div class="col-md-5 bg-light d-flex align-items-stretch">
                    @php
                        $youtube_id = null;
                        $thumbnail_url = null;

                        if ($modul->embed_link) {
                            preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/))([\w\-]{11})/', $modul->embed_link, $matches);
                            $youtube_id = $matches[1] ?? null;
                            $thumbnail_url = $youtube_id ? "https://img.youtube.com/vi/{$youtube_id}/hqdefault.jpg" : null;
                        }
                    @endphp

                    @if($thumbnail_url)
                        <img src="{{ $thumbnail_url }}" alt="Thumbnail YouTube" class="img-fluid w-100 object-fit-cover module-media-thumb rounded-start-4">
                    @elseif($modul->gambar)
                        <img src="{{ asset('storage/' . $modul->gambar) }}" alt="Gambar Modul" class="img-fluid w-100 object-fit-cover module-media-thumb rounded-start-4">
                    @else
                        <div class="d-flex flex-column align-items-center justify-content-center bg-light text-muted w-100 h-100 p-4 rounded-start-4" style="min-height: 350px;">
                            <i class="mdi mdi-image-off display-3 mb-3 text-secondary"></i>
                            <span class="fw-semibold text-center text-secondary fs-6">Tidak ada gambar atau video pratinjau</span>
                        </div>
                    @endif
                </div>

                {{-- Konten Deskripsi & Aksi --}}
                <div class="col-md-7 p-4 d-flex flex-column">
                    <header class="mb-3 border-bottom pb-3">
                        <h1 class="fw-bold text-primary mb-2 display-6">{{ $modul->judul }}</h1>
                        <div class="d-flex flex-wrap align-items-center gap-3">
                            @if($modul->kategori)
                                <span class="badge bg-primary-subtle text-primary fs-6 rounded-pill px-3 py-2">
                                    <i class="mdi mdi-tag me-1"></i> {{ $modul->kategori }}
                                </span>
                            @endif
                            @if($modul->youtube_title)
                                <span class="badge bg-danger-subtle text-danger fs-6 rounded-pill px-3 py-2">
                                    <i class="mdi mdi-youtube me-1"></i> Video: {{ Str::limit($modul->youtube_title, 40) }}
                                </span>
                            @endif
                            <small class="text-muted ms-auto fs-6"><i class="mdi mdi-calendar-clock me-1"></i> Dibuat: <strong>{{ $modul->created_at->format('d M Y') }}</strong></small>
                        </div>
                    </header>

                    {{-- Tab Navigasi --}}
                    <ul class="nav nav-tabs mb-3 nav-tabs-custom" id="modulTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc" type="button" role="tab" aria-controls="desc" aria-selected="true"><i class="mdi mdi-text-box-outline me-2"></i>Deskripsi</button>
                        </li>
                        {{-- <li class="nav-item" role="presentation">
                            <button class="nav-link" id="konten-tab" data-bs-toggle="tab" data-bs-target="#konten" type="button" role="tab" aria-controls="konten" aria-selected="false"><i class="mdi mdi-file-document-outline me-2"></i>Konten Teks</button>
                        </li> --}}
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="video-tab" data-bs-toggle="tab" data-bs-target="#video" type="button" role="tab" aria-controls="video" aria-selected="false"><i class="mdi mdi-video me-2"></i>Video YouTube</button>
                        </li>
                        @if($modul->file_pdf)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pdf-tab" data-bs-toggle="tab" data-bs-target="#pdf" type="button" role="tab" aria-controls="pdf" aria-selected="false"><i class="mdi mdi-file-pdf me-2"></i>Dokumen PDF</button>
                        </li>
                        @endif
                    </ul>

                    <div class="tab-content mb-3 flex-grow-1 overflow-auto p-2 border rounded bg-light" style="max-height: 300px;">
                        {{-- Deskripsi --}}
                        <div class="tab-pane fade show active" id="desc" role="tabpanel" aria-labelledby="desc-tab">
                            @if($modul->deskripsi)
                                <p class="text-secondary lh-base">{{ $modul->deskripsi }}</p>
                            @else
                                <p class="text-muted fst-italic text-center py-4">Tidak ada deskripsi untuk modul ini.</p>
                            @endif
                        </div>

                        {{-- Konten Teks --}}
                        {{-- <div class="tab-pane fade" id="konten" role="tabpanel" aria-labelledby="konten-tab">
                            @if($modul->konten)
                                <p style="white-space: pre-line;" class="text-secondary lh-base">{!! nl2br(e($modul->konten)) !!}</p>
                            @else
                                <p class="text-muted fst-italic text-center py-4">Tidak ada konten teks yang tersedia.</p>
                            @endif
                        </div> --}}

                        {{-- Video --}}
                        <div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="video-tab">
                            @if($youtube_id)
                                <div class="ratio ratio-16x9 mb-3 rounded shadow-sm">
                                    <iframe src="https://www.youtube.com/embed/{{ $youtube_id }}?autoplay=0&rel=0" frameborder="0" allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" class="rounded"></iframe>
                                </div>
                                <div class="small text-muted fst-italic text-center">
                                    <span>ID Video YouTube: <strong class="text-primary">{{ $youtube_id }}</strong></span>
                                </div>
                            @else
                                <p class="text-muted fst-italic text-center py-4">Tidak ada video YouTube terkait modul ini.</p>
                            @endif
                        </div>

                        {{-- Dokumen PDF (New Tab) --}}
                        @if($modul->file_pdf)
                        <div class="tab-pane fade" id="pdf" role="tabpanel" aria-labelledby="pdf-tab">
                            <div class="d-flex flex-column align-items-center justify-content-center p-3 text-center">
                                <i class="mdi mdi-file-pdf display-3 text-danger mb-2"></i>
                                <p class="mb-3 text-secondary">Dokumen PDF tersedia. Klik tombol di bawah untuk melihat pratinjau.</p>
                                <button type="button" class="btn btn-primary px-4 py-2" data-bs-toggle="modal" data-bs-target="#pdfPreviewModal">
                                    <i class="mdi mdi-file-find me-2"></i>Pratinjau Dokumen PDF
                                </button>
                            </div>
                        </div>
                        @endif
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="d-flex flex-wrap gap-2 mt-auto pt-3 border-top">
                        <a href="{{ route('admin.modul.edit', $modul->id) }}" class="btn btn-warning px-4 py-2 d-inline-flex align-items-center rounded-pill">
                            <i class="mdi mdi-pencil me-2"></i>Edit Modul
                        </a>
                        <form action="{{ route('admin.modul.destroy', $modul->id) }}" method="POST" class="d-inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger px-4 py-2 d-inline-flex align-items-center rounded-pill">
                                <i class="mdi mdi-delete me-2"></i>Hapus Modul
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Preview PDF --}}
@if($modul->file_pdf)
<div class="modal fade" id="pdfPreviewModal" tabindex="-1" aria-labelledby="pdfPreviewLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="pdfPreviewLabel"><i class="mdi mdi-file-pdf me-2"></i>Pratinjau Dokumen PDF</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body" style="height: 80vh;">
                <iframe src="{{ asset('storage/' . $modul->file_pdf) }}" width="100%" height="100%" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="{{ asset('storage/' . $modul->file_pdf) }}" target="_blank" class="btn btn-primary">Buka di Tab Baru <i class="mdi mdi-open-in-new ms-1"></i></a>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Load JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // SweetAlert for delete confirmation
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const currentForm = this; // Use a variable for the current form

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Modul ajar ini akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        currentForm.submit(); // Submit the form if confirmed
                    }
                });
            });
        });

        // Activate Bootstrap tabs
        var modulTabEl = document.getElementById('modulTab');
        if (modulTabEl) {
            var tab = new bootstrap.Tab(modulTabEl.querySelector('.nav-link.active'));
            tab.show();
        }
    });
</script>

<style>
    /* General body background for a cleaner look */
    body {
        background-color: #f8f9fa; /* Light grey background */
        font-family: 'Inter', sans-serif; /* Menggunakan font Inter */
    }

    /* Page Header Enhancements */
    .page-header {
        border-bottom: 1px solid #e9ecef;
        padding-bottom: 1rem;
        margin-bottom: 1.5rem;
    }

    .page-header h2 {
        color: #212529; /* Darker heading color */
        font-size: 1.75rem; /* Slightly larger heading */
    }

    .breadcrumb-item a {
        color: #0d6efd; /* Bootstrap primary blue for links */
    }

    .breadcrumb-item.active {
        color: #6c757d; /* Muted color for active breadcrumb */
    }

    /* Card Styling */
    .card {
        border: none;
        border-radius: 0.75rem; /* More rounded corners */
        overflow: hidden;
    }

    .card-header {
        border-bottom: none;
        background-color: #0d6efd !important;
        color: white !important;
        padding: 1.25rem 1.5rem;
        display: flex;
        align-items: center;
    }

    .card-header h5 {
        font-weight: 600;
    }

    .card-body {
        padding: 1.5rem;
    }

    /* Badge Styling */
    .badge.bg-primary-subtle {
        background-color: rgba(13, 110, 253, 0.1) !important; /* Lebih lembut */
        color: #0d6efd !important;
        font-weight: 600;
    }
    .badge.bg-danger-subtle {
        background-color: rgba(220, 53, 69, 0.1) !important; /* Lebih lembut */
        color: #dc3545 !important;
        font-weight: 600;
    }
    .badge.rounded-pill {
        padding: 0.4em 0.8em;
    }

    /* Image/Video Thumbnail Styling */
    .object-fit-cover {
        object-fit: cover;
    }
    .module-media-thumb {
        height: 350px; /* Tinggi standar untuk thumbnail */
    }
    .rounded-start-4 {
        border-top-left-radius: 0.75rem !important;
        border-bottom-left-radius: 0.75rem !important;
        border-top-right-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
    }
    @media (max-width: 767.98px) {
        .rounded-start-4 {
            border-top-right-radius: 0.75rem !important;
            border-bottom-left-radius: 0 !important;
        }
        .module-media-thumb {
            height: 250px; /* Tinggi lebih kecil di mobile */
        }
    }


    /* Tab Navigation Custom Styling */
    .nav-tabs-custom .nav-link {
        color: #495057; /* Default tab text color */
        border: none; /* Remove default border */
        border-bottom: 2px solid transparent; /* Highlight active tab with bottom border */
        transition: all 0.3s ease;
        padding: 0.75rem 1.25rem; /* More padding */
        font-weight: 500;
    }

    .nav-tabs-custom .nav-link.active {
        color: #0d6efd; /* Active tab text color */
        border-bottom-color: #0d6efd; /* Active tab underline color */
        background-color: transparent; /* No background on active */
    }

    .nav-tabs-custom .nav-link:hover:not(.active) {
        color: #0d6efd; /* Hover color */
        border-bottom-color: #a7d3ff; /* Lighter underline on hover */
    }
    .nav-tabs-custom .nav-item {
        margin-bottom: -1px; /* Align tabs correctly */
    }

    /* Tab Content Styling */
    .tab-content {
        padding-top: 0.5rem;
    }

    /* Button Styling */
    .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
        font-weight: 500;
        transition: all 0.2s ease-in-out;
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
        transform: translateY(-1px);
    }

    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
        font-weight: 500;
        transition: all 0.2s ease-in-out;
        color: #212529; /* Darker text for warning buttons */
    }

    .btn-warning:hover {
        background-color: #e0a800;
        border-color: #d39e00;
        transform: translateY(-1px);
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        font-weight: 500;
        transition: all 0.2s ease-in-out;
    }

    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
        transform: translateY(-1px);
    }

    .btn-outline-secondary {
        border-color: #6c757d;
        color: #6c757d;
        font-weight: 500;
        transition: all 0.2s ease-in-out;
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: white;
        transform: translateY(-1px);
    }

    /* Modal Styling */
    .modal-content {
        border-radius: 0.75rem;
    }
    .modal-header {
        border-bottom: none;
        padding-bottom: 0.5rem;
    }
    .modal-title {
        font-weight: 600;
        color: #343a40;
    }
    .modal-footer {
        border-top: none;
        padding-top: 0.5rem;
    }
</style>
@endsection
