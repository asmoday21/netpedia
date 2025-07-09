@extends('guru.guru_master')

@section('guru')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">

      <div class="card shadow rounded-4 border-0">
        <div class="card-body p-5">
          <h3 class="mb-4 text-warning fw-bold d-flex align-items-center">
            <i class="bi bi-pencil-square me-2"></i> Edit Materi
          </h3>

          <form action="{{ route('guru.materi.update', $materi->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div class="mb-4">
              <label for="judul" class="form-label fw-semibold">
                <i class="bi bi-type me-2 text-warning"></i> Judul Materi <span class="text-danger">*</span>
              </label>
              <input type="text" class="form-control rounded-3 @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $materi->judul) }}" required>
              @error('judul')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle-fill me-2"></i> {{ $message }}
                </div>
              @enderror
            </div>

            <!-- Konten -->
            <div class="mb-4">
              <label for="konten" class="form-label fw-semibold">
                <i class="bi bi-file-text me-2 text-warning"></i> Deskripsi / Konten
              </label>
              <textarea class="form-control rounded-3 @error('konten') is-invalid @enderror" id="konten" name="konten" rows="5" placeholder="Uraikan isi materi...">{{ old('konten', $materi->konten) }}</textarea>
              @error('konten')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle-fill me-2"></i> {{ $message }}
                </div>
              @enderror
            </div>

            <!-- File Upload -->
            <div class="mb-4">
              <label for="file" class="form-label fw-semibold">
                <i class="bi bi-upload me-2 text-warning"></i> Unggah Ulang File <small class="text-muted">(opsional)</small>
              </label>

              @if ($materi->file)
                <div class="alert alert-light d-flex align-items-center mb-2 border rounded-3">
                  <i class="bi bi-file-earmark-text me-2 fs-5 text-secondary"></i>
                  <div>
                    <strong>File saat ini:</strong><br>
                    <a href="{{ asset('storage/' . $materi->file) }}" target="_blank" class="text-decoration-underline">
                      {{ basename($materi->file) }}
                    </a>
                  </div>
                </div>
              @endif

              <input type="file" class="form-control rounded-3 @error('file') is-invalid @enderror" id="file" name="file" accept=".pdf,.doc,.docx,.ppt,.pptx,.zip,.jpg,.jpeg,.png,.mp4">
              @error('file')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle-fill me-2"></i> {{ $message }}
                </div>
              @enderror
              <small class="text-muted">Kosongkan jika tidak ingin mengganti file.</small>
            </div>

            <!-- Tombol Aksi -->
            <div class="d-flex justify-content-between mt-4">
              <a href="{{ route('guru.materi.index') }}" class="btn btn-outline-secondary px-4 py-2 rounded-3">
                <i class="bi bi-arrow-left-circle me-2"></i> Kembali
              </a>
              <button type="submit" class="btn btn-warning px-4 py-2 rounded-3 text-white">
                <i class="bi bi-check-circle me-2"></i> Simpan Perubahan
              </button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- Validasi Form -->
<script>
  (() => {
    'use strict'
    const forms = document.querySelectorAll('.needs-validation')
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
        form.classList.add('was-validated')
      }, false)
    })
  })()
</script>

<style>
  .form-label {
    display: flex;
    align-items: center;
    font-size: 1rem;
  }
  .invalid-feedback {
    display: flex;
    align-items: center;
  }
</style>
@endsection
