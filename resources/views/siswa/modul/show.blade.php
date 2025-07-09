@extends('siswa.siswa_master')

@section('siswa')

<style>
    /* Styling Tab Navigasi agar lebih menonjol */
    .nav-tabs .nav-link {
        font-weight: 600;
        font-size: 1rem; /* standar font size */
        padding: 10px 16px; /* padding standar agar tidak terlalu besar */
        color: #0056b3;
        border: 2px solid transparent;
        border-radius: 8px 8px 0 0;
        transition: background-color 0.3s ease, color 0.3s ease;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .nav-tabs .nav-link:hover {
        background-color: #e7f1ff;
        color: #003d80;
    }

    .nav-tabs .nav-link.active {
        background-color: #0056b3;
        color: white;
        border-color: #0056b3 #0056b3 white;
        font-weight: 700;
        box-shadow: 0 3px 10px rgba(0, 86, 179, 0.4);
    }

    .nav-link:focus-visible {
        outline: 3px solid #004080;
        outline-offset: 2px;
    }

    /* Icon kecil di sebelah teks */
    .nav-link i {
        font-size: 1rem; /* sesuaikan icon dengan font size */
        line-height: 1;
        vertical-align: middle;
    }
</style>

<div class="container mt-4 fade-in">
    <article class="card shadow-sm rounded-4 overflow-hidden">
        <div class="row g-0">

            {{-- Bagian Thumbnail --}}
            <div class="col-md-5">
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
                    <img src="{{ $thumbnail_url }}" alt="Thumbnail YouTube" class="img-fluid w-100 h-100 object-fit-cover">
                @elseif($modul->gambar)
                    <img src="{{ asset('storage/' . $modul->gambar) }}" alt="Gambar Modul" class="img-fluid w-100 h-100 object-fit-cover">
                @else
                    <div class="d-flex align-items-center justify-content-center bg-light text-muted h-100" style="min-height: 300px;">
                        <span class="fw-semibold fs-6">Tidak ada gambar</span>
                    </div>
                @endif
            </div>

            {{-- Konten --}}
            <div class="col-md-7 p-4 d-flex flex-column">
                <header class="mb-3">
                    <h2 class="fw-bold" style="font-size: 1.5rem;">{{ $modul->judul }}</h2>
                    @if($modul->kategori)
                        <span class="badge bg-primary fs-6">Kategori: {{ $modul->kategori }}</span>
                    @endif
                </header>

                {{-- Tab Navigasi --}}
                <ul class="nav nav-tabs mb-3 fs-6" id="modulTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc" type="button" role="tab">
                            <i class="bi bi-info-circle-fill"></i> Deskripsi
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="konten-tab" data-bs-toggle="tab" data-bs-target="#konten" type="button" role="tab">
                            <i class="bi bi-file-text-fill"></i> Konten
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="video-tab" data-bs-toggle="tab" data-bs-target="#video" type="button" role="tab">
                            <i class="bi bi-camera-video-fill"></i> Video
                        </button>
                    </li>
                </ul>

                <div class="tab-content mb-3" id="modulTabContent">
                    {{-- Deskripsi --}}
                    <div class="tab-pane fade show active" id="desc" role="tabpanel">
                        @if($modul->deskripsi)
                            <p class="text-muted fst-italic fs-6">{{ $modul->deskripsi }}</p>
                        @else
                            <p class="text-muted fs-6">Tidak ada deskripsi.</p>
                        @endif
                    </div>

                    {{-- Konten --}}
                    <div class="tab-pane fade" id="konten" role="tabpanel">
                        <div class="content-scroll overflow-auto" style="max-height: 160px;">
                            <p style="white-space: pre-line;" class="fs-6">{!! e($modul->konten) !!}</p>
                        </div>
                    </div>

                    {{-- Video --}}
                    <div class="tab-pane fade" id="video" role="tabpanel">
                        @if($youtube_id)
                            <div class="ratio ratio-16x9 mb-3 rounded shadow-sm">
                                <iframe src="https://www.youtube.com/embed/{{ $youtube_id }}?autoplay=1&rel=0" frameborder="0" allowfullscreen allow="autoplay; encrypted-media" class="rounded"></iframe>
                            </div>
                            <div class="small text-muted fst-italic fs-6">
                                <span>Video YouTube ID: {{ $youtube_id }}</span>
                            </div>
                        @else
                            <p class="text-muted fs-6">Video tidak tersedia.</p>
                        @endif
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="d-flex flex-column flex-md-row gap-2 mt-auto">
                    @if($modul->file_pdf)
                        <a href="#" class="btn btn-outline-primary fs-6" data-bs-toggle="modal" data-bs-target="#pdfPreviewModal">
                            📄 Preview PDF Modul
                        </a>
                    @endif

                    <a href="{{ route('guru.modul.index') }}" class="btn btn-secondary fs-6">
                        ← Kembali ke Daftar Modul
                    </a>
                </div>
            </div>
        </div>
    </article>
</div>

{{-- Modal Preview PDF --}}
@if($modul->file_pdf)
<div class="modal fade" id="pdfPreviewModal" tabindex="-1" aria-labelledby="pdfPreviewLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="pdfPreviewLabel">📄 Preview PDF Modul</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body" style="height: 80vh;">
                <iframe src="{{ asset('storage/' . $modul->file_pdf) }}" width="100%" height="100%" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
