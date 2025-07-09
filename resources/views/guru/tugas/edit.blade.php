@extends('guru.guru_master')

@section('guru')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            <div class="card border-0 shadow-lg rounded-4 p-0 overflow-hidden hover-lift-shadow">
                <div class="bg-primary text-white py-4 px-5 card-header-gradient">
                    <h2 class="mb-1 fw-bold text-white">
                        <i class="fas fa-edit me-2 opacity-75"></i> Edit Tugas
                    </h2>
                    <p class="mb-0 text-white-75">Ubah detail tugas yang sudah ada di bawah ini.</p>
                </div>
                <div class="p-4 p-md-5 bg-white">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-4 rounded-3 shadow-sm border-0 animated-alert" role="alert">
                            <strong><i class="fas fa-exclamation-triangle me-2"></i> Terjadi Kesalahan!</strong>
                            <ul class="mt-2 mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Form action points to the update route with the task ID --}}
                    <form action="{{ route('guru.tugas.update', $tugas->id) }}" method="POST" id="formTugas">
                        @csrf
                        @method('PUT') {{-- Method spoofing for PUT request --}}

                        {{-- Judul --}}
                        <div class="mb-4 form-group-animated">
                            <label for="judul" class="form-label fw-semibold">Judul Tugas <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text form-icon"><i class="fas fa-heading"></i></span>
                                <input type="text" name="judul" id="judul"
                                    class="form-control form-control-lg @error('judul') is-invalid @enderror"
                                    value="{{ old('judul', $tugas->judul) }}" placeholder="Contoh: Latihan TCP/IP" required>
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="form-text text-muted">Berikan judul yang jelas dan deskriptif untuk tugas.</small>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-4 form-group-animated">
                            <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                            <div class="input-group">
                                <span class="input-group-text form-icon"><i class="fas fa-align-left"></i></span>
                                <textarea name="deskripsi" id="deskripsi"
                                    class="form-control @error('deskripsi') is-invalid @enderror"
                                    rows="5" placeholder="Jelaskan tujuan atau instruksi tugas.">{{ old('deskripsi', $tugas->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="form-text text-muted">Detailkan persyaratan, sumber daya, atau petunjuk tambahan.</small>
                        </div>

                        {{-- Batas Pengumpulan --}}
                        <div class="mb-4 form-group-animated">
                            <label for="batas_pengumpulan" class="form-label fw-semibold">Batas Pengumpulan <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text form-icon"><i class="fas fa-calendar-alt"></i></span> 
                                <input type="datetime-local" name="batas_pengumpulan" id="batas_pengumpulan"
                                    class="form-control @error('batas_pengumpulan') is-invalid @enderror"
                                    value="{{ old('batas_pengumpulan', $tugas->batas_pengumpulan) }}" required>
                                @error('batas_pengumpulan')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="form-text text-muted">Tentukan tanggal dan waktu terakhir tugas dapat dikumpulkan (zona waktu Asia/Jakarta).</small>
                        </div>

                        {{-- Section untuk Link Tugas --}}
                        <div class="mb-4 p-4 border rounded-3 shadow-sm bg-light">
                            <h5 class="fw-bold mb-3 text-primary"><i class="fas fa-link me-2"></i> Sumber Tugas</h5>
                            
                            {{-- Link Tugas --}}
                            <div class="form-group-animated">
                                <label for="link_tugas" class="form-label fw-semibold">Sediakan Link Tugas Eksternal <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text form-icon"><i class="fas fa-external-link-alt"></i></span>
                                    <input type="url" class="form-control @error('link_tugas') is-invalid @enderror" id="link_tugas" name="link_tugas" value="{{ old('link_tugas', $tugas->link_tugas) }}" placeholder="Contoh: https://forms.gle/xxxxxxxxxx" required>
                                    @error('link_tugas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted">Sediakan link tugas dari platform eksternal (misalnya Google Form, Quizizz, Kahoot, Wordwall, dll).</small>

                                @if ($tugas->link_tugas)
                                    <div class="mt-2 p-2 bg-white rounded-3 border border-info">
                                        <p class="mb-1 small text-muted">Link tugas saat ini:</p>
                                        <p class="mb-2 fw-semibold"><a href="{{ $tugas->link_tugas }}" target="_blank" class="text-decoration-none text-info"><i class="fas fa-external-link-alt me-1"></i> {{ $tugas->link_tugas }}</a></p>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="hapus_link_tugas" id="hapus_link_tugas" value="1" {{ old('hapus_link_tugas') ? 'checked' : '' }}>
                                            <label class="form-check-label text-danger" for="hapus_link_tugas">
                                                <i class="fas fa-trash-alt me-1"></i> Hapus Link Tugas Ini
                                            </label>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <hr class="my-5 border-light-subtle">

                        {{-- Tombol --}}
                        <div class="d-flex justify-content-between flex-column flex-sm-row gap-3">
                            <a href="{{ route('guru.tugas.index') }}" class="btn btn-outline-secondary btn-lg rounded-pill px-4 hover-scale">
                                <i class="fas fa-arrow-left me-2"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill px-4 hover-bounce">
                                <i class="fas fa-save me-2"></i> Perbarui Tugas
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" xintegrity="sha512-Fo3rlalHbhJ0ZcM5b/2z+o8lKxW/W9U+sT1V4/0aN/4P+g0z/aQ02Nq6z5/1/2+Q=" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
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
    }

    /* General Card & Shadow Styles */
    .rounded-4 { border-radius: var(--border-radius-lg) !important; }
    .rounded-3 { border-radius: var(--border-radius-md) !important; }
    .rounded-pill { border-radius: var(--border-radius-pill) !important; }

    .shadow-sm { box-shadow: var(--shadow-sm) !important; }
    .shadow-md { box-shadow: var(--shadow-md) !important; }
    .shadow-lg { box-shadow: var(--shadow-lg) !important; }

    /* Card Header Gradient (reused from index) */
    .card-header-gradient {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
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
    .card:hover .card-header-gradient::before {
        opacity: 1;
    }


    /* Form Control Enhancements */
    .form-control, .form-select {
        border: 1px solid #e2e8f0;
        transition: all 0.2s ease-in-out;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem var(--primary-light);
        outline: none;
    }

    .form-control-lg, .form-select-lg {
        font-size: 1rem;
        padding: 0.75rem 1rem;
        border-radius: var(--border-radius-md);
    }

    .input-group-text.form-icon {
        background-color: #f0f4f8; /* Light gray background for icons */
        border: 1px solid #e2e8f0;
        border-right: none;
        color: var(--text-muted);
        border-radius: var(--border-radius-md) 0 0 var(--border-radius-md);
    }

    .input-group .form-control, .input-group .form-select {
        border-left: none; /* Remove duplicate border */
    }

    /* Helper text */
    .form-text {
        font-size: 0.875rem;
        color: var(--text-muted);
        margin-top: 0.25rem;
        display: block; /* Ensure it takes full width */
    }

    /* Buttons */
    .btn {
        font-weight: 600;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        border-width: 1.5px;
        font-size: 0.95rem;
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

    .btn-outline-secondary {
        color: var(--text-muted);
        border-color: #e2e8f0;
    }
    .btn-outline-secondary:hover {
        background-color: #e2e8f0;
        color: var(--dark-color);
        border-color: #cbd5e1;
    }

    /* Hover effects (reused from index) */
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

    .hover-scale {
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .hover-scale:hover {
        transform: scale(1.02);
    }

    /* Alerts */
    .alert {
        border: none;
        box-shadow: var(--shadow-sm);
        padding: 1.25rem 1.5rem;
        border-left: 5px solid var(--danger-color);
    }

    .alert-danger {
        background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
        color: #991b1b;
    }

    .alert-icon {
        width: 48px;
        height: 48px;
        background: var(--danger-light);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--danger-color);
    }

    .btn-close {
        font-size: 0.85rem;
        padding: 0.75rem;
        margin: -0.5rem -0.75rem -0.5rem auto;
    }

    /* Info Alert for file */
    .alert-info {
        background: linear-gradient(135deg, #ecfdfb 0%, #dcf8f5 100%);
        color: #0d8794;
        border-left: 5px solid var(--info-color);
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .btn-lg {
            width: 100%;
        }
        .d-flex.flex-column.flex-sm-row {
            flex-direction: column !important;
            gap: 0.75rem !important;
        }
    }

    /* Animations */
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
    .animated-alert {
        animation: fadeInDown 0.5s ease-out forwards;
    }

    /* Input focus animation */
    .form-group-animated .input-group:focus-within .form-icon {
        color: var(--primary-color);
        transition: color 0.2s ease-in-out;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const formTugas = document.getElementById('formTugas');
        const linkTugasInput = document.getElementById('link_tugas');
        const hapusLinkTugasCheckbox = document.getElementById('hapus_link_tugas');

        // Function to validate that the link_tugas input is not empty
        function validateLinkInput() {
            const hasNewLink = linkTugasInput.value.trim() !== '';
            const hasExistingLink = "{{ $tugas->link_tugas }}" !== '';
            const willDeleteLink = hapusLinkTugasCheckbox ? hapusLinkTugasCheckbox.checked : false;

            let sourceExistsAfterEdit = false;

            // Check if there will be a source after editing
            if (hasNewLink) {
                sourceExistsAfterEdit = true;
            } else if (hasExistingLink && !willDeleteLink) {
                sourceExistsAfterEdit = true;
            }

            // Get the container for general errors, or create if it doesn't exist
            let errorDiv = document.getElementById('link-error'); // Mengubah ID untuk lebih spesifik
            if (!errorDiv) {
                const sourceTaskSection = document.querySelector('.mb-4.p-4.border.rounded-3.shadow-sm.bg-light');
                if (sourceTaskSection) {
                    errorDiv = document.createElement('div');
                    errorDiv.id = 'link-error'; // Mengubah ID untuk lebih spesifik
                    errorDiv.className = 'alert alert-danger mt-3 mb-0 animated-alert';
                    sourceTaskSection.appendChild(errorDiv);
                }
            }

            if (!sourceExistsAfterEdit) {
                // Display error if neither new nor existing link will be present
                if (errorDiv) {
                    errorDiv.innerHTML = '<i class="fas fa-exclamation-circle me-2"></i> Anda harus menyediakan link tugas.';
                    errorDiv.style.display = 'block';
                }
                return false; // Prevent form submission
            } else {
                // Hide error message if valid
                if (errorDiv) {
                    errorDiv.style.display = 'none';
                }
                return true; // Allow form submission
            }
        }

        // Add event listeners to validate on change/input
        if (linkTugasInput) {
            linkTugasInput.addEventListener('input', validateLinkInput);
        }
        if (hapusLinkTugasCheckbox) {
            hapusLinkTugasCheckbox.addEventListener('change', validateLinkInput);
        }

        if (formTugas) {
            formTugas.addEventListener('submit', function(e) {
                e.preventDefault(); // Mencegah submit default

                // Jalankan validasi kustom sebelum menampilkan modal konfirmasi
                if (!validateLinkInput()) {
                    // Jika validasi gagal, jangan lanjutkan ke modal atau submit
                    return;
                }

                const submitBtn = formTugas.querySelector('button[type="submit"]');

                const confirmModal = document.createElement('div');
                confirmModal.className = 'modal fade show d-block';
                confirmModal.style.backgroundColor = 'rgba(0,0,0,0.5)';
                confirmModal.setAttribute('tabindex', '-1');
                confirmModal.setAttribute('role', 'dialog');
                confirmModal.innerHTML = `
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content rounded-4 shadow-lg p-4">
                            <div class="modal-header border-0 pb-0">
                                <h5 class="modal-title fw-bold">Konfirmasi Pembaruan Tugas</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-muted pt-2">
                                Apakah Anda yakin ingin memperbarui tugas ini? Pastikan semua data sudah benar.
                            </div>
                            <div class="modal-footer border-0 pt-0">
                                <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-primary rounded-pill px-4 confirm-submit-btn">Perbarui</button>
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

                confirmModal.querySelector('.confirm-submit-btn').addEventListener('click', () => {
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memperbarui...';
                    }
                    bsModal.hide();
                    confirmModal.remove();
                    formTugas.submit(); // Submit form secara programatis
                });

                confirmModal.addEventListener('hidden.bs.modal', () => {
                    confirmModal.remove();
                });
            });
        }
    });
</script>
@endpush