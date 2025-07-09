@extends('guru.guru_master') {{-- Pastikan ini mengarah ke layout master guru Anda --}}

@section('guru') {{-- Sesuaikan section name jika diperlukan --}}
<!-- Load Material Design Icons (jika belum dimuat secara global) -->
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.5.95/css/materialdesignicons.min.css" rel="stylesheet">
{{-- Memuat SweetAlert2 CSS karena kemungkinan digunakan di bagian lain aplikasi --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">


<div class="container-fluid px-4">
    <!-- Header Halaman -->
    <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div>
            <h2 class="fw-bold mb-0">Edit Siswa</h2> {{-- Judul disesuaikan --}}
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('guru.guru_master') }}" class="text-decoration-none">Dashboard</a></li> {{-- Rute disesuaikan untuk guru --}}
                    <li class="breadcrumb-item"><a href="{{ route('guru.siswa.index') }}" class="text-decoration-none">Manajemen Siswa</a></li> {{-- Rute disesuaikan untuk guru --}}
                    <li class="breadcrumb-item active" aria-current="page">Edit Siswa</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('guru.siswa.index') }}" class="btn btn-outline-secondary rounded-pill d-inline-flex align-items-center"> {{-- Menambahkan rounded-pill --}}
                <i class="mdi mdi-arrow-left me-2"></i>Kembali ke Daftar Siswa
            </a>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0"><i class="mdi mdi-account-edit me-2"></i>Informasi Siswa</h5> {{-- Judul card disesuaikan --}}
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('guru.siswa.update', $siswa->id) }}" method="POST" id="userForm"> {{-- Rute diperbarui untuk guru --}}
                <div id="validation-message" class="mt-3"></div>

                @csrf
                @method('PUT') {{-- Penting: Gunakan method PUT untuk update --}}

                <div class="row g-3">
                    {{-- Nama Lengkap --}}
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control rounded-pill @error('name') is-invalid @enderror" {{-- Menambahkan rounded-pill --}}
                               id="name" name="name" value="{{ old('name', $siswa->name) }}"
                               placeholder="Masukkan nama lengkap siswa" required autocomplete="name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Kelas Siswa --}}
                    <div class="col-md-6"> {{-- Ditempatkan di col-md-6 untuk tata letak yang konsisten --}}
                        <label for="kelas" class="form-label fw-semibold">Kelas Siswa <span class="text-danger">*</span></label>
                        <select class="form-select rounded-pill @error('kelas_id') is-invalid @enderror" name="kelas_id" id="kelas" required> {{-- Menambahkan rounded-pill --}}
                            <option value="">-- Pilih Kelas --</option>
                            @foreach ($kelasList as $kelas)
                                <option value="{{ $kelas->id }}" {{ old('kelas_id', $siswa->kelas_id) == $kelas->id ? 'selected' : '' }}>
                                    {{ $kelas->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                        @error('kelas_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Form Actions --}}
                    <div class="col-12 mt-4 d-flex justify-content-end gap-2">
                        <button type="reset" class="btn btn-outline-danger rounded-pill px-4 py-2 d-inline-flex align-items-center"> {{-- Menambahkan rounded-pill --}}
                            <i class="mdi mdi-refresh me-2"></i>Reset Form
                        </button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 d-inline-flex align-items-center"> {{-- Menambahkan rounded-pill --}}
                            <i class="mdi mdi-content-save me-2"></i>Perbarui Siswa {{-- Teks tombol disesuaikan --}}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> {{-- Mungkin sudah dimuat di master, tapi lebih baik disertakan jika ini file terpisah --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> {{-- Memuat Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> {{-- Memuat SweetAlert2 JS --}}

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const nameInput = document.getElementById('name');
    const messageBox = document.getElementById('validation-message');

    function showError(message) {
        messageBox.innerHTML = `<div class="alert alert-danger">${message}</div>`;
    }

    form.addEventListener('submit', function (e) {
        messageBox.innerHTML = ''; // clear any previous messages

        if (!nameInput.value.trim()) {
            e.preventDefault();
            showError("Nama tidak boleh kosong.");
            nameInput.focus();
            return;
        }
        // Validasi untuk email, telepon, dan password dihapus karena bidangnya sudah tidak ada
    });

    // Inisialisasi Tooltip Bootstrap (jika ada tooltips di halaman ini)
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
});
</script>

<style>
    /* Styling Anda yang sudah ada */
    body { background-color: #f8f9fa; }
    .page-header { border-bottom: 1px solid #e9ecef; padding-bottom: 1rem; margin-bottom: 1.5rem; }
    .page-header h2 { color: #212529; font-size: 1.75rem; }
    .breadcrumb-item a { color: #0d6efd; }
    .breadcrumb-item.active { color: #6c757d; }
    .card { border: none; border-radius: 0.75rem; overflow: hidden; }
    .card-header { border-bottom: none; background-color: #0d6efd !important; color: white !important; padding: 1.25rem 1.5rem; display: flex; align-items: center; }
    .card-header h5 { font-weight: 600; }
    .card-body { padding: 1.5rem; } /* Disamakan dengan halaman Manajemen Siswa */
    .alert-success { background-color: #d1e7dd; color: #0f5132; border-color: #badbcc; border-radius: 0.5rem; padding: 1rem 1.5rem; font-weight: 500; display: flex; align-items: center; }
    .alert-success .mdi { font-size: 1.5rem; margin-right: 0.75rem; }
    .alert-success .btn-close { font-size: 0.9rem; }
    /* Styling untuk badge dan avatar tidak relevan di halaman ini, tapi disertakan agar konsisten jika suatu saat diperlukan */
    .avatar-sm { width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border-radius: 50%; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    .avatar-title { font-size: 1.3rem; line-height: 1; display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; border-radius: 50%; }
    .badge { padding: 0.4em 0.8em; font-weight: 600; border-radius: 0.375rem; font-size: 0.85em; }
    .bg-primary-light { background-color: rgba(13, 110, 253, 0.15) !important; }
    .text-primary { color: #0d6efd !important; }
    .bg-warning-light { background-color: rgba(255, 193, 7, 0.15) !important; }
    .text-warning { color: #ffc107 !important; }
    .bg-success-light { background-color: rgba(25, 135, 84, 0.15) !important; }
    .text-success { color: #198754 !important; }

    /* Table styling tidak relevan di halaman edit, tapi disertakan agar konsisten jika suatu saat diperlukan */
    .table thead th { background-color: #f1f4f8; color: #495057; font-weight: 600; border-bottom: 2px solid #e9ecef; padding: 1rem 1rem; }
    .table tbody tr { vertical-align: middle; }
    .table-hover tbody tr:hover { background-color: #f0f4f7; }
    .table-striped tbody tr:nth-of-type(odd) { background-color: #fafafa; }
    .dataTables_wrapper .dataTables_filter input { border-radius: 0.375rem; padding: 0.5rem 0.75rem; border: 1px solid #ced4da; }
    .dataTables_wrapper .dataTables_length select { border-radius: 0.375rem; padding: 0.5rem 0.75rem; border: 1px solid #ced4da; }
    .dataTables_wrapper .dataTables_paginate .paginate_button { border-radius: 0.375rem; padding: 0.5em 1em; margin: 0 0.2em; color: #0d6efd !important; border: 1px solid transparent; }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover { background-color: #0d6efd; color: white !important; border-color: #0d6efd; }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover { background-color: #e2e6ea; border-color: #dae0e5; }
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled { color: #6c757d !important; opacity: 0.6; cursor: not-allowed; }


    /* Form Element Styling */
    .form-label {
        font-weight: 600; /* Bolder labels */
        color: #343a40; /* Darker grey for labels */
        margin-bottom: 0.5rem;
    }

    /* Ini mengoverride default Bootstrap rounding untuk form-control dan form-select */
    /* Rounded-pill akan diterapkan secara langsung di HTML */
    .form-control, .form-select {
        padding: 0.75rem 1rem !important; /* Disamakan dengan halaman Manajemen Siswa */
        font-size: 0.95rem;
    }

    /* Memastikan rounded-pill bekerja pada elemen form control */
    .form-control.rounded-pill, .form-select.rounded-pill {
        border-radius: 9999px !important;
    }


    .form-control:focus, .form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    /* Input group styles are kept in case you add other types of inputs with them */
    .input-group .btn-outline-secondary {
        border-left: none; /* Remove left border for toggle button */
        border-color: #ced4da;
        background-color: #e9ecef; /* Light grey background for button */
    }

    .input-group .btn-outline-secondary:hover {
        background-color: #dee2e6;
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
        transform: translateY(-1px); /* Slight lift effect */
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

    /* Accessibility for password toggle button (kept for general utility if needed, though no password fields now) */
    .toggle-password {
        cursor: pointer;
        outline: none; /* Remove default outline */
    }

    /* Tambahan styling untuk rounded-pill pada tombol, memastikan konsisten */
    /* Menghapus padding spesifik dan mengandalkan padding default dari Bootstrap */
    .btn.rounded-pill {
        border-radius: 9999px !important;
    }

    /* Perbaikan untuk input-group agar rounded-pill tetap di sudut akhir */
    /* Aturan ini memastikan bahwa ketika .rounded-pill ada pada form-control, input group tetap terlihat kohesif */
    .input-group > .form-control:not(:last-child).rounded-pill,
    .input-group > .form-select:not(:last-child).rounded-pill {
        border-top-right-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
    }

    .input-group > .form-control:not(:first-child).rounded-pill,
    .input-group > .form-select:not(:first-child).rounded-pill {
        border-top-left-radius: 0 !important;
        border-bottom-left-radius: 0 !important;
    }

    /* Untuk tombol di dalam input group, jika ada, menjaga konsistensi */
    .input-group > .btn:not(:last-child).rounded-pill {
        border-top-right-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
    }

    .input-group > .btn:not(:first-child).rounded-pill {
        border-top-left-radius: 0 !important;
        border-bottom-left-radius: 0 !important;
    }
</style>
