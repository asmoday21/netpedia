@extends('siswa.siswa_master')

@section('siswa')
    {{-- Import Material Design Icons and SweetAlert2 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.5.95/css/materialdesignicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <div class="container-fluid px-4">
        {{-- Page Header and Breadcrumb --}}
        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
            <div>
                <h2 class="fw-bold mb-0">Daftar Siswa</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('siswa.siswa_master') }}" class="text-decoration-none">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Siswa</li>
                    </ol>
                </nav>
            </div>
            {{-- Optional: Add a button for "Tambah Siswa" here if applicable --}}
            {{-- <div>
                <a href="{{ route('siswa.tambah_siswa') }}" class="btn btn-success rounded-pill shadow-sm">
                    <i class="mdi mdi-plus-circle me-2"></i>Tambah Siswa Baru
                </a>
            </div> --}}
        </div>

        {{-- Student Filter Card --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0"><i class="mdi mdi-filter-variant me-2"></i>Filter Siswa</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('siswa.semua_siswa') }}" class="row g-3 align-items-center">
                    {{-- Search Input --}}
                    <div class="col-md-6 col-lg-4">
                        <label for="search" class="form-label visually-hidden">Cari Siswa</label>
                        <div class="input-group shadow-sm-sm"> {{-- Added shadow-sm-sm for a subtle shadow --}}
                            <span class="input-group-text bg-white border-end-0 rounded-pill-start pe-0">
                                <i class="mdi mdi-magnify text-muted"></i>
                            </span>
                            <input type="text" name="cari" id="search"
                                class="form-control border-start-0 rounded-pill-end ps-0"
                                placeholder="Cari berdasarkan nama atau email..." value="{{ request('cari') }}">
                        </div>
                    </div>
                    {{-- Class Filter Dropdown --}}
                    <div class="col-md-6 col-lg-4">
                        <label for="kelas" class="form-label visually-hidden">Filter Kelas</label>
                        <select name="kelas" id="kelas" class="form-select rounded-pill shadow-sm-sm">
                            <option value="">Semua Kelas</option>
                            @foreach ($daftarKelas as $kelas)
                                <option value="{{ $kelas->id }}" {{ request('kelas') == $kelas->id ? 'selected' : '' }}>
                                    {{ $kelas->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- Action Buttons --}}
                    <div class="col-12 col-lg-auto d-flex gap-2">
                        <button type="submit" class="btn btn-primary rounded-pill shadow-sm">
                            <i class="mdi mdi-filter-variant me-1"></i>Filter
                        </button>
                        @if (request('cari') || request('kelas'))
                            <a href="{{ route('siswa.semua_siswa') }}" class="btn btn-outline-secondary rounded-pill shadow-sm">
                                <i class="mdi mdi-close-circle-outline me-1"></i>Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        {{-- Student Data Table Card --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0"><i class="mdi mdi-account-box-multiple me-2"></i>Data Siswa</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" width="50">No.</th>
                                <th>Nama Siswa</th>
                                <th>Email</th>
                                <th>Kelas</th>
                                {{-- <th class="text-center" width="120">Aksi</th> Add action column if needed --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($semuaSiswa as $index => $siswa)
                                <tr>
                                    <td class="text-center align-middle">{{ $semuaSiswa->firstItem() + $index }}</td>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            {{-- Dynamic Avatar (e.g., first letter of name or placeholder) --}}
                                            <div class="avatar-sm me-3">
                                                <div class="avatar-title rounded-circle bg-success-subtle text-success d-flex align-items-center justify-content-center">
                                                    {{-- You can display the first letter of the student's name here --}}
                                                    <span class="fw-bold">{{ substr($siswa->name, 0, 1) }}</span>
                                                    {{-- Or keep the icon: <i class="mdi mdi-account fs-5"></i> --}}
                                                </div>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $siswa->name }}</h6>
                                                <small class="text-muted">ID: {{ $siswa->id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <a href="mailto:{{ $siswa->email }}"
                                            class="text-decoration-none text-primary">{{ $siswa->email }}</a>
                                    </td>
                                    <td class="align-middle">
                                        @if ($siswa->kelas)
                                            <span class="badge rounded-pill bg-info-light text-info py-2 px-3">
                                                {{ $siswa->kelas->nama_kelas }}
                                            </span>
                                        @else
                                            <span class="badge rounded-pill bg-warning-subtle text-warning py-2 px-3">
                                                Belum Ditentukan
                                            </span>
                                        @endif
                                    </td>
                                    {{-- Optional: Action Buttons for each row (Edit, Delete, View) --}}
                                    {{-- <td class="text-center align-middle">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="#" class="btn btn-sm btn-outline-info rounded-pill" data-bs-toggle="tooltip" title="Lihat Detail">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-outline-warning rounded-pill" data-bs-toggle="tooltip" title="Edit Siswa">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger rounded-pill delete-btn" data-id="{{ $siswa->id }}" data-bs-toggle="tooltip" title="Hapus Siswa">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </td> --}}
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 bg-light">
                                        <i class="mdi mdi-account-off display-4 text-muted mb-3"></i>
                                        <h5 class="fw-medium text-muted">Tidak ada data siswa ditemukan</h5>
                                        <p class="text-muted mb-0">Coba sesuaikan filter pencarian Anda.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Pagination --}}
        @if ($semuaSiswa->hasPages())
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-3">
                <div class="text-muted small mb-2 mb-md-0">
                    Menampilkan {{ $semuaSiswa->firstItem() }} sampai {{ $semuaSiswa->lastItem() }} dari
                    {{ $semuaSiswa->total() }} entri
                </div>
                <div>
                    {{ $semuaSiswa->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif

    </div>

@endsection

@push('styles')
    <style>
        /* Custom styles for rounded-pill on form controls */
        .form-control.rounded-pill-start {
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
            border-right: none;
        }

        .form-control.rounded-pill-end {
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
            border-left: none;
        }

        .input-group-text.rounded-pill-start {
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
        }

        /* Avatar styles */
        .avatar-sm {
            width: 40px; /* Smaller avatar size */
            height: 40px;
            font-size: 1rem; /* Adjust font size for initials */
        }

        .avatar-title {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Subtle shadow for form elements */
        .shadow-sm-sm {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
        }
    </style>
@endpush

@push('scripts')
    {{-- Ensure jQuery and Bootstrap Bundle are loaded if not already in master --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Bootstrap Tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });

            // SweetAlert2 for Delete Confirmation (example)
            // If you add delete buttons, uncomment and adapt this section
            // $('.delete-btn').on('click', function(e) {
            //     e.preventDefault();
            //     const siswaId = $(this).data('id');
            //     Swal.fire({
            //         title: 'Apakah Anda yakin?',
            //         text: "Data siswa ini akan dihapus permanen!",
            //         icon: 'warning',
            //         showCancelButton: true,
            //         confirmButtonColor: '#3085d6',
            //         cancelButtonColor: '#d33',
            //         confirmButtonText: 'Ya, hapus!',
            //         cancelButtonText: 'Batal'
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             // Perform deletion via AJAX or redirect to a delete route
            //             // Example: window.location.href = '/siswa/delete/' + siswaId;
            //             Swal.fire(
            //                 'Dihapus!',
            //                 'Data siswa telah berhasil dihapus.',
            //                 'success'
            //             );
            //         }
            //     });
            // });
        });
    </script>
@endpush