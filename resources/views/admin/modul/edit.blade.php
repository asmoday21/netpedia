@extends('admin.admin_master')

@section('admin')
<!-- Load Font Awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<!-- Load Material Design Icons -->
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.5.95/css/materialdesignicons.min.css" rel="stylesheet">
<!-- Load SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">


<div class="container-fluid px-4">
    <!-- Header Halaman -->
    <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div>
            <h2 class="fw-bold mb-0">Edit Modul Ajar</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.admin_master') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.modul.index') }}" class="text-decoration-none">Daftar Modul Ajar</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit: {{ Str::limit($modul->judul, 30) }}</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.modul.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center">
                <i class="mdi mdi-arrow-left me-2"></i>Kembali ke Daftar Modul
            </a>
        </div>
    </div>

    <!-- Form Edit Modul -->
    <div class="card shadow-sm mb-4 rounded-4 overflow-hidden">
        <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0"><i class="mdi mdi-pencil me-2"></i>Edit Informasi Modul</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.modul.update', $modul->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    {{-- Judul --}}
                    <div class="col-md-6">
                        <label for="judul" class="form-label fw-semibold"><i class="mdi mdi-book-open me-2"></i>Judul Modul <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $modul->judul) }}" placeholder="Masukkan judul modul" required>
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Kategori --}}
                    <div class="col-md-6">
                        <label for="kategori" class="form-label fw-semibold"><i class="mdi mdi-tag me-2"></i>Kategori</label>
                        <input type="text" class="form-control @error('kategori') is-invalid @enderror" id="kategori" name="kategori" value="{{ old('kategori', $modul->kategori) }}" placeholder="Contoh: Pemrograman Dasar">
                        @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Link Video YouTube --}}
                    <div class="col-12">
                        <label for="embed_link" class="form-label fw-semibold"><i class="mdi mdi-youtube me-2"></i>Link Video YouTube</label>
                        <input type="url" class="form-control @error('embed_link') is-invalid @enderror" id="embed_link" name="embed_link" value="{{ old('embed_link', $modul->embed_link) }}" placeholder="Contoh: https://www.youtube.com/watch?v=VIDEO_ID">
                        @error('embed_link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <small class="form-text text-muted">Masukkan URL video YouTube lengkap.</small>
                    </div>

                    {{-- Judul Video YouTube (opsional) --}}
                    <div class="col-12">
                        <label for="youtube_title" class="form-label fw-semibold"><i class="mdi mdi-text-shadow me-2"></i>Judul Video YouTube (opsional)</label>
                        <input type="text" class="form-control @error('youtube_title') is-invalid @enderror" id="youtube_title" name="youtube_title" value="{{ old('youtube_title', $modul->youtube_title) }}" placeholder="Judul video akan diambil otomatis jika link YouTube valid">
                        @error('youtube_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Preview Video YouTube --}}
                    @php
                        $youtube_id = null;
                        if ($modul->embed_link) {
                            preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/))([\w\-]{11})/', $modul->embed_link, $matches);
                            $youtube_id = $matches[1] ?? null;
                        }
                    @endphp
                    @if($youtube_id)
                    <div class="col-12 mb-3">
                        <label class="form-label fw-semibold"><i class="mdi mdi-monitor-play me-2"></i>Pratinjau Video</label>
                        <div class="ratio ratio-16x9 rounded shadow-sm">
                            <iframe src="https://www.youtube.com/embed/{{ $youtube_id }}" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <small class="form-text text-muted mt-2">Pratinjau video YouTube saat ini.</small>
                    </div>
                    @endif

                    {{-- Deskripsi Modul --}}
                    <div class="col-12">
                        <label for="deskripsi" class="form-label fw-semibold"><i class="mdi mdi-text-box-outline me-2"></i>Deskripsi Modul</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4" placeholder="Tulis deskripsi singkat tentang modul ini.">{{ old('deskripsi', $modul->deskripsi) }}</textarea>
                        @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Konten Teks Modul --}}
                    {{-- <div class="col-12">
                        <label for="konten" class="form-label fw-semibold"><i class="mdi mdi-file-document-outline me-2"></i>Konten Teks Modul</label>
                        <textarea class="form-control @error('konten') is-invalid @enderror" id="konten" name="konten" rows="8" placeholder="Masukkan konten teks lengkap modul ini.">{{ old('konten', $modul->konten) }}</textarea>
                        @error('konten')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div> --}}

                    {{-- Gambar --}}
                    <div class="col-md-6">
                        <label for="gambar" class="form-label fw-semibold"><i class="mdi mdi-image-plus me-2"></i>Upload Gambar</label>
                        <input class="form-control @error('gambar') is-invalid @enderror" type="file" id="gambar" name="gambar" accept="image/*" onchange="previewImage(event)">
                        @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <small class="form-text text-muted">Ukuran maksimal: 2MB. Hanya gambar.</small>
                        <div class="mt-3 text-center">
                            <img id="previewImg" src="{{ $modul->gambar ? asset('storage/' . $modul->gambar) : 'https://placehold.co/300x200/e9ecef/495057?text=No+Image' }}" alt="Pratinjau Gambar" class="img-thumbnail shadow" style="max-width: 300px; {{ $modul->gambar ? '' : 'display: block;' }}">
                        </div>
                    </div>

                    {{-- PDF --}}
                    <div class="col-md-6">
                        <label for="file_pdf" class="form-label fw-semibold"><i class="mdi mdi-file-upload me-2"></i>Upload File PDF</label>
                        <input class="form-control @error('file_pdf') is-invalid @enderror" type="file" id="file_pdf" name="file_pdf" accept="application/pdf">
                        @error('file_pdf')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <small class="form-text text-muted">Ukuran maksimal: 5MB. Hanya file PDF.</small>
                        @if($modul->file_pdf)
                            <div class="mt-3 d-flex align-items-center gap-2">
                                <a href="{{ asset('storage/' . $modul->file_pdf) }}" target="_blank" class="btn btn-outline-primary btn-sm d-inline-flex align-items-center">
                                    <i class="mdi mdi-file-find me-2"></i>Lihat PDF Saat Ini
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center" onclick="removeFile('file_pdf', this)">
                                    <i class="mdi mdi-close me-2"></i>Hapus PDF
                                </button>
                                <input type="hidden" name="remove_file_pdf" id="remove_file_pdf" value="0">
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                    <a href="{{ route('admin.modul.index') }}" class="btn btn-secondary px-4 py-2 d-inline-flex align-items-center">
                        <i class="mdi mdi-cancel me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-primary px-4 py-2 d-inline-flex align-items-center">
                        <i class="mdi mdi-content-save me-2"></i>Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Load JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('previewImg');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            // If file is cleared, show placeholder again
            preview.src = 'https://placehold.co/300x200/e9ecef/495057?text=No+Image';
            preview.style.display = 'block'; // Keep it visible to show placeholder
        }
    }

    function removeFile(fileType, buttonElement) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: `Anda akan menghapus file ${fileType === 'gambar' ? 'gambar' : 'PDF'} ini.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Set hidden input value to indicate removal
                document.getElementById(`remove_${fileType}`).value = 1;
                
                // Clear the file input visually
                const fileInput = document.getElementById(fileType);
                fileInput.value = ''; // Clear the selected file

                // Hide the current file display/button
                if (fileType === 'gambar') {
                    document.getElementById('previewImg').src = 'https://placehold.co/300x200/e9ecef/495057?text=No+Image';
                }
                if (buttonElement && buttonElement.closest('.d-flex')) {
                    buttonElement.closest('.d-flex').style.display = 'none'; // Hide the whole div
                }
                
                Swal.fire('Terhapus!', `File ${fileType === 'gambar' ? 'gambar' : 'PDF'} telah ditandai untuk dihapus.`, 'success');
            }
        });
    }
</script>

<style>
    /* General body background for a cleaner look */
    body {
        background-color: #f8f9fa; /* Light grey background */
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
        padding: 2rem; /* Increased padding inside the card body */
    }

    /* Form Element Styling */
    .form-label {
        font-weight: 600; /* Bolder labels */
        color: #343a40; /* Darker grey for labels */
        margin-bottom: 0.5rem;
    }

    .form-control, .form-select {
        border-radius: 0.375rem; /* Slightly rounded inputs */
        padding: 0.75rem 1rem; /* More comfortable padding */
        font-size: 0.95rem;
    }

    .form-control:focus, .form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
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

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
        font-weight: 500;
        transition: all 0.2s ease-in-out;
    }

    .btn-secondary:hover {
        background-color: #5c636a;
        border-color: #565e64;
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

    .btn-outline-primary {
        border-color: #0d6efd;
        color: #0d6efd;
        font-weight: 500;
        transition: all 0.2s ease-in-out;
    }

    .btn-outline-primary:hover {
        background-color: #0d6efd;
        color: white;
        transform: translateY(-1px);
    }

    .btn-outline-danger {
        border-color: #dc3545;
        color: #dc3545;
        font-weight: 500;
        transition: all 0.2s ease-in-out;
    }

    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
        transform: translateY(-1px);
    }

    .form-text {
        font-size: 0.875em; /* Smaller text for help block */
        color: #6c757d;
    }

    /* Image Preview Styling */
    .img-thumbnail {
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        padding: 0.25rem;
    }
</style>
@endsection
