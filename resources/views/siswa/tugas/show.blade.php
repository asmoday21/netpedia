@extends('siswa.siswa_master')

{{-- Menentukan judul halaman dinamis --}}
@section('title', 'Detail Tugas: ' . $tugas->judul)

@section('siswa')
    <div class="container-fluid py-4">
        <div class="row mb-5">
            <div class="col-12">
                <div class="header-card bg-primary text-white rounded-4 p-4 p-md-5 shadow-lg position-relative overflow-hidden">
                    <div class="header-overlay"></div>
                    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between position-relative z-index-1">
                        <div class="text-center text-md-start mb-3 mb-md-0">
                            <h1 class="h4 fw-bold mb-2 text-white">
                                <i class="fas fa-book-reader me-3 opacity-75"></i>Detail Tugas
                            </h1>
                            <p class="mb-0 opacity-75 text-white-75 fs-6">Lihat instruksi lengkap dan kelola jawabanmu untuk tugas ini.</p>
                        </div>
                        <a href="{{ route('siswa.tugas.index') }}" class="btn btn-light btn-md shadow-sm hover-lift-shadow rounded-pill px-4 py-2">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Tugas
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

        {{-- Menambahkan penanganan pesan error dari controller --}}
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
            $isOverdue = \Carbon\Carbon::parse($tugas->batas_pengumpulan)->isPast();
            $deadlineColorClass = $isOverdue ? 'text-danger' : 'text-success';
            $deadlineIconClass = $isOverdue ? 'fas fa-clock text-danger' : 'fas fa-clock text-success';
            // Perbaikan: Pastikan $tugas->lampiran ada sebelum memeriksa
            $lampiranExists = !empty($tugas->lampiran);

            // Kondisi apakah siswa bisa mengirim/mengubah jawaban (memerlukan lampiran dari guru DAN belum kedaluwarsa)
            $canSubmitOrUpdate = $lampiranExists && !$isOverdue;
        @endphp

        <div class="row g-4">
            <div class="col-lg-12"> {{-- Changed to col-lg-12 since the right column is removed --}}
                <div class="card rounded-4 shadow-sm border-0 h-100 p-4">
                    <div class="card-body">
                        <h2 class="h4 fw-bold mb-3 text-primary">{{ $tugas->judul }}</h2>
                        <hr class="mb-4">

                        <h5 class="fw-semibold mb-2">Deskripsi Tugas:</h5>
                        <p class="text-muted mb-4">{{ $tugas->deskripsi }}</p>

                        <div class="info-grid mb-4">
                            <div class="info-item d-flex align-items-center mb-3">
                                <div class="info-icon bg-primary-light rounded-3 p-2 me-3">
                                    <i class="{{ $deadlineIconClass }} fs-7"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="small text-muted mb-1">Tenggat Waktu Pengumpulan:</p>
                                    <p class="fw-semibold mb-0 fs-6 {{ $deadlineColorClass }}">
                                        {{ \Carbon\Carbon::parse($tugas->batas_pengumpulan)->translatedFormat('d M Y, H:i') }}
                                        @if ($isOverdue)
                                            <span class="badge bg-danger ms-2">Telah Kedaluwarsa</span>
                                        @else
                                            <span class="badge bg-success ms-2">Masih Aktif</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="info-item d-flex align-items-center mb-3">
                                <div class="info-icon bg-info-light rounded-3 p-2 me-3">
                                    <i class="fas fa-paperclip text-info fs-7"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="small text-muted mb-1">Sumber Tugas:</p>
                                    @if (!empty($tugas->link_tugas) && empty($tugas->lampiran))
                                        {{-- Jika hanya link dan tidak ada lampiran, tampilkan link --}}
                                        <a href="{{ $tugas->link_tugas }}" target="_blank" class="fw-semibold mb-0 text-decoration-none file-link fs-6">
                                            <i class="fas fa-external-link-alt me-1"></i> Link Tugas Eksternal
                                        </a>
                                        <p class="text-danger small mt-1">*Tugas ini hanya berupa link, tidak ada file lampiran.</p>
                                    @elseif ($lampiranExists)
                                        {{-- Jika ada lampiran, tampilkan lampiran (walaupun ada link juga) --}}
                                        <a href="{{ asset('storage/' . $tugas->lampiran) }}" target="_blank" class="fw-semibold mb-0 text-decoration-none file-link fs-6">
                                            <i class="fas fa-file-alt me-1"></i> {{ $tugas->original_filename ?? 'Lampiran File' }}
                                        </a>
                                        @if(!empty($tugas->link_tugas))
                                            <a href="{{ $tugas->link_tugas }}" target="_blank" class="fw-semibold mb-0 text-decoration-none file-link fs-6 d-block mt-1">
                                                <i class="fas fa-external-link-alt me-1"></i> (Juga) Link Eksternal
                                            </a>
                                        @endif
                                    @else
                                        {{-- Jika tidak ada link maupun lampiran --}}
                                        <p class="fw-semibold mb-0 text-muted small">- Tidak Ada Sumber Tambahan -</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Konfirmasi Penghapusan (tetap dipertahankan jika masih diperlukan untuk fitur lain) --}}
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 shadow-lg p-3">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="deleteConfirmationModalLabel">Konfirmasi Penghapusan File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-muted">
                    Apakah Anda yakin ingin menghapus file "<strong id="fileNameToDelete"></strong>" ini? Aksi ini tidak dapat dibatalkan.
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger rounded-pill" id="confirmDeleteFileBtn">Hapus</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    {{-- Gaya CSS kustom untuk halaman ini. Ini akan ditambahkan ke bagian <head> dari master layout. --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlalHbhJ0ZcM5b/2z+o8lKxW/W9U+sT1V4/0aN/4P+g0z/aQ02Nq6z5/1/2+Q=" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            --warning-light: rgba(245, 158, 11, 0.1);
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

        .hover-bounce {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .hover-bounce:hover {
            transform: translateY(-3px);
        }

        .hover-link {
            transition: color 0.2s ease-in-out;
        }
        .hover-link:hover {
            color: var(--secondary-color) !important;
            text-decoration: underline;
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

        .alert-info {
            background: linear-gradient(135deg, #e0f7fa 0%, #b2ebf2 100%);
            color: #00838f;
            border-left: 5px solid var(--info-color);
        }

        .alert-warning {
            background: linear-gradient(135deg, #fffde7 0%, #fff59d 100%);
            color: #fbc02d;
            border-left: 5px solid var(--warning-color);
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
        .alert-info .alert-icon {
            background: var(--info-light);
            color: var(--info-color);
        }
        .alert-warning .alert-icon {
            background: var(--warning-light);
            color: var(--warning-color);
        }

        .btn-close {
            font-size: 0.8rem;
            padding: 0.5rem;
            margin: -0.25rem -0.5rem -0.25rem auto;
        }

        /* Gaya Tombol */
        .btn {
            font-weight: 600;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            border-width: 1.5px;
            font-size: 0.9rem;
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

        .btn-warning {
            background-color: var(--warning-color);
            border-color: var(--warning-color);
            color: white;
        }
        .btn-warning:hover {
            background-color: #e38d0a;
            border-color: #e38d0a;
        }

        .btn-success {
            background-color: var(--success-color);
            border-color: var(--success-color);
            color: white;
        }
        .btn-success:hover {
            background-color: #0c9f6d;
            border-color: #0c9f6d;
        }

        .btn-danger-light {
            background-color: var(--danger-light);
            color: var(--danger-color);
        }
        .btn-danger-light:hover {
            background-color: rgba(239, 68, 68, 0.2);
            color: var(--danger-color);
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

        /* Animasi untuk konten */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card {
            animation: fadeIn 0.6s ease-out forwards;
        }

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
    <script>
        // Menambahkan perilaku smooth scrolling untuk tautan internal
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

        // Menangani penutupan alert (pesan notifikasi) secara visual dan otomatis
        document.addEventListener('DOMContentLoaded', function() {
            const alertElement = document.querySelector('.alert');
            if (alertElement) {
                if (typeof bootstrap !== 'undefined' && bootstrap.Alert) {
                    const bsAlert = new bootstrap.Alert(alertElement);
                    setTimeout(() => {
                        bsAlert.dispose();
                    }, 7000);
                } else {
                    setTimeout(() => {
                        alertElement.style.display = 'none';
                    }, 7000);
                }
            }
        });

        // Logika untuk konfirmasi hapus file (Still needed for other file deletions potentially)
        document.addEventListener('DOMContentLoaded', function() {
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
            let formToSubmit = null;

            document.querySelectorAll('.delete-file-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const fileName = this.dataset.fileName;
                    document.getElementById('fileNameToDelete').textContent = fileName;
                    formToSubmit = this.closest('.delete-file-form');
                    deleteModal.show();
                });
            });

            document.getElementById('confirmDeleteFileBtn').addEventListener('click', function() {
                if (formToSubmit) {
                    formToSubmit.submit();
                }
            });

            // Optional: Reset modal state on close
            const deleteConfirmationModalElement = document.getElementById('deleteConfirmationModal');
            deleteConfirmationModalElement.addEventListener('hidden.bs.modal', function () {
                formToSubmit = null;
            });
        });
    </script>
@endpush