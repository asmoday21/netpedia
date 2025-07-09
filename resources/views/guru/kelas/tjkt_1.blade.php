@extends('guru.guru_master') {{-- Pastikan layout ini tersedia dan benar --}}

@section('guru')
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.5.95/css/materialdesignicons.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<div class="container-fluid px-4">
    <!-- Header Halaman -->
    <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div>
            {{-- Menggunakan $className dari controller untuk membuat judul dinamis --}}
            <h2 class="fw-bold mb-0">Daftar Siswa Kelas {{ $className }}</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('guru.guru_master') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kelas {{ $className }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Tabel Siswa -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white py-3">
            {{-- Menggunakan $className untuk judul kartu juga --}}
            <h5 class="mb-0"><i class="mdi mdi-school me-2"></i>Siswa Kelas {{ $className }}</h5>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table id="students-table" class="table table-hover table-striped" style="width:100%">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" width="50">No.</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanggal Daftar</th>
                            {{-- Kolom "Aksi" dihapus karena guru tidak mengelola akun siswa dari sini --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $index => $student)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-3">
                                        <div class="avatar-title rounded-circle bg-success-subtle text-success">
                                            <i class="mdi fs-5 mdi-school"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $student->name }}</h6>
                                        <small class="text-muted">ID: {{ $student->id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->created_at->format('d M Y') }}</td>
                            {{-- Tombol Aksi (Edit/Hapus) dihapus --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $('#students-table').DataTable({
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Tidak ada data yang ditemukan",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered: "(disaring dari total _MAX_ data)",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                },
                aria: {
                    sortAscending: ": aktifkan untuk mengurutkan kolom naik",
                    sortDescending: ": aktifkan untuk mengurutkan kolom turun"
                },
                infoThousands: ".",
                loadingRecords: "Memuat...",
                processing: "Memproses...",
                emptyTable: "Tidak ada data tersedia di tabel",
                buttons: {
                    copy: "Salin",
                    csv: "CSV",
                    excel: "Excel",
                    pdf: "PDF",
                    print: "Cetak"
                }
            },
            responsive: true,
        });

        // Tooltip initialization (tetap dipertahankan meskipun tombol aksi dihapus,
        // jika ada elemen lain yang menggunakan tooltip)
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Script SweetAlert untuk hapus (dihapus karena tombol aksi dihapus)
        // $('.delete-form').on('submit', function(e) { /* ... */ });
    });
</script>

<style>
    /* Add the same styling as in guru.users.index for consistency */
    body { background-color: #f8f9fa; }
    .page-header { border-bottom: 1px solid #e9ecef; padding-bottom: 1rem; margin-bottom: 1.5rem; }
    .page-header h2 { color: #212529; font-size: 1.75rem; }
    .breadcrumb-item a { color: #0d6efd; }
    .breadcrumb-item.active { color: #6c757d; }
    .card { border: none; border-radius: 0.75rem; overflow: hidden; }
    .card-header { border-bottom: none; background-color: #0d6efd !important; color: white !important; padding: 1.25rem 1.5rem; display: flex; align-items: center; }
    .card-header h5 { font-weight: 600; }
    .card-body { padding: 1.5rem; }
    .alert-success { background-color: #d1e7dd; color: #0f5132; border-color: #badbcc; border-radius: 0.5rem; padding: 1rem 1.5rem; font-weight: 500; display: flex; align-items: center; }
    .alert-success .mdi { font-size: 1.5rem; margin-right: 0.75rem; }
    .alert-success .btn-close { font-size: 0.9rem; }
    .avatar-sm { width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border-radius: 50%; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    .avatar-title { font-size: 1.3rem; line-height: 1; display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; border-radius: 50%; }
    .badge { padding: 0.4em 0.8em; font-weight: 600; border-radius: 0.375rem; font-size: 0.85em; }
    .bg-primary-light { background-color: rgba(13, 110, 253, 0.15) !important; }
    .text-primary { color: #0d6efd !important; }
    .bg-warning-light { background-color: rgba(255, 193, 7, 0.15) !important; }
    .text-warning { color: #ffc107 !important; }
    .bg-success-light { background-color: rgba(25, 135, 84, 0.15) !important; }
    .text-success { color: #198754 !important; }
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
    .btn-primary { background-color: #0d6efd; border-color: #0d6efd; font-weight: 500; transition: all 0.2s ease-in-out; }
    .btn-primary:hover { background-color: #0b5ed7; border-color: #0a58ca; transform: translateY(-1px); }
    .btn-outline-primary { border-color: #0d6efd; color: #0d6efd; font-weight: 500; transition: all 0.2s ease-in-out; }
    .btn-outline-primary:hover { background-color: #0d6efd; color: white; transform: translateY(-1px); }
    .btn-outline-danger { border-color: #dc3545; color: #dc3545; font-weight: 500; transition: all 0.2s ease-in-out; }
    .btn-outline-danger:hover { background-color: #dc3545; color: white; transform: translateY(-1px); }
    .tooltip-inner { background-color: #343a40; color: white; border-radius: 0.3rem; padding: 0.4rem 0.8rem; font-size: 0.8rem; }
    .tooltip.bs-tooltip-auto[data-popper-placement^=top] .tooltip-arrow::before { border-top-color: #343a40; }
    .tooltip.bs-tooltip-auto[data-popper-placement^=right] .tooltip-arrow::before { border-right-color: #343a40; }
    .tooltip.bs-tooltip-auto[data-popper-placement^=bottom] .tooltip-arrow::before { border-bottom-color: #343a40; }
    .tooltip.bs-tooltip-auto[data-popper-placement^=left] .tooltip-arrow::before { border-left-color: #343a40; }
</style>
