@extends('siswa.siswa_master')

@section('siswa')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
  .container-custom {
    max-width: 600px;
    margin: 1.5rem auto;
    padding: 0 1rem;
  }

  #dropzone {
    border: 2px dashed #ced4da;
    border-radius: 0.375rem;
    padding: 2.5rem 1.5rem;
    text-align: center;
    color: #6c757d;
    cursor: pointer;
    user-select: none;
    transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
    outline-offset: 2px;
    outline: none;
  }

  #dropzone:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 8px rgba(13, 110, 253, 0.6);
  }

  #dropzone.dragover {
    background-color: #0d6efd;
    color: white;
    border-color: #0a58ca;
    box-shadow: 0 0 12px rgba(13, 110, 253, 0.7);
  }

  #dropzone.dragover i {
    color: white;
    transform: scale(1.1);
    transition: transform 0.3s ease, color 0.3s ease;
  }

  #filePreview {
    margin-top: 1rem;
    display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;
    gap: 0.75rem;
    padding-bottom: 0.5rem;
  }

  #filePreview > div {
    flex: 0 0 auto;
    width: 100px;
    border-radius: 0.375rem;
    background-color: #f8f9fa;
    padding: 0.5rem;
    box-shadow: 0 2px 5px rgb(0 0 0 / 0.1);
    transition: transform 0.3s ease;
  }

  #filePreview > div:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 15px rgb(0 0 0 / 0.15);
    cursor: default;
    z-index: 2;
  }

  #filePreview img,
  #filePreview canvas {
    max-width: 100%;
    border-radius: 0.25rem;
    object-fit: contain;
    height: 110px;
  }

  [data-bs-toggle="tooltip"] {
    cursor: help;
  }

  @media (max-width: 576px) {
    #submitBtn {
      width: 100%;
      font-size: 1.1rem;
      padding: 0.75rem;
    }

    .btn-outline-secondary {
      width: 100%;
      margin-bottom: 0.5rem;
    }

    .container-custom {
      padding: 0 0.75rem;
      max-width: 100%;
    }
  }
</style>

<div class="container-custom">
  <div class="card shadow-sm border-secondary">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h4 class="mb-0">{{ isset($jawaban) ? 'Edit Jawaban Tugas' : 'Upload Jawaban Tugas' }}</h4>
      <button type="button" class="btn btn-light btn-sm" data-bs-toggle="tooltip" data-bs-placement="left" title="Drag & drop file ke area ini atau klik untuk memilih file. Bisa upload lebih dari satu file.">
        <i class="bi bi-info-circle"></i>
      </button>
    </div>

    <form id="jawabanForm" action="{{ route('siswa.tugas.kirim', $tugas->id) }}" method="POST" enctype="multipart/form-data" novalidate class="card-body">
      @csrf

      <section class="mb-3">
        <h5 class="fw-semibold text-dark">{{ $tugas->judul }}</h5>
        <p class="text-secondary" style="white-space: pre-line;">{{ $tugas->deskripsi ?? '-' }}</p>
        <small class="text-muted">
          Batas pengumpulan: 
          <span class="fw-semibold">{{ \Carbon\Carbon::parse($tugas->batas_pengumpulan)->translatedFormat('d F Y, H:i') }}</span>
        </small>
      </section>

      <section class="mb-3">
        <label for="file_jawaban" class="form-label fw-semibold">
          Upload File Jawaban <span class="text-danger">*</span>
        </label>

        <div id="dropzone" tabindex="0" role="button" aria-label="Drag and drop files here or click to select files">
          <i class="bi bi-cloud-arrow-up display-4 mb-2" id="uploadIcon"></i>
          <p class="mb-1">Tarik dan lepas file di sini atau klik untuk memilih file (boleh lebih dari satu)</p>
          <small class="text-muted">(Format: pdf, doc, docx, ppt, pptx, xls, xlsx, zip, rar, 7z, txt, jpg, png, gif)</small>
        </div>

        <input
          type="file"
          name="file_jawaban[]"
          id="file_jawaban"
          accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.zip,.rar,.7z,.txt,.jpg,.jpeg,.png,.gif"
          multiple
          class="form-control d-none"
          {{ isset($jawaban) ? '' : 'required' }}
        >

        <div class="invalid-feedback d-block" id="fileError" style="display:none;"></div>

        @error('file_jawaban')
          <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror

        @if(isset($jawaban) && $jawaban->file_jawaban)
          <p class="text-secondary small mt-2">
            File saat ini: 
            <a href="{{ asset('storage/jawaban/' . $jawaban->file_jawaban) }}" target="_blank" class="link-primary text-decoration-underline">
              {{ $jawaban->file_jawaban }}
            </a>
          </p>
        @endif

        <div id="filePreview" aria-live="polite" aria-atomic="true"></div>
      </section>

      <section class="mb-3">
        <label for="catatan" class="form-label fw-semibold">Catatan (Opsional)</label>
        <textarea
          name="catatan"
          id="catatan"
          rows="3"
          placeholder="Tambahkan catatan untuk guru..."
          class="form-control @error('catatan') is-invalid @enderror"
        >{{ old('catatan', $jawaban->catatan ?? '') }}</textarea>
        @error('catatan')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </section>

      <section class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
        <a href="{{ route('siswa.tugas.show', $tugas->id) }}" class="btn btn-outline-secondary d-flex align-items-center justify-content-center gap-1">
          <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <button
          type="submit"
          id="submitBtn"
          class="btn btn-primary d-flex align-items-center gap-2 justify-content-center"
        >
          <span id="btnText">
            <i class="bi bi-cloud-arrow-up"></i> {{ isset($jawaban) ? 'Update Jawaban' : 'Kirim Jawaban' }}
          </span>
          <div class="spinner-border spinner-border-sm text-light d-none" id="btnSpinner" role="status" aria-hidden="true"></div>
        </button>
      </section>
    </form>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.9.179/pdf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
  // Init Bootstrap tooltip
  const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  tooltipTriggerList.forEach(t => new bootstrap.Tooltip(t));

  const dropzone = document.getElementById('dropzone');
  const fileInput = document.getElementById('file_jawaban');
  const filePreview = document.getElementById('filePreview');
  const fileError = document.getElementById('fileError');
  const form = document.getElementById('jawabanForm');
  const submitBtn = document.getElementById('submitBtn');
  const btnText = document.getElementById('btnText');
  const btnSpinner = document.getElementById('btnSpinner');

  const allowedTypes = [
    'application/pdf',
    'application/msword',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    'application/vnd.ms-powerpoint',
    'application/vnd.openxmlformats-officedocument.presentationml.presentation',
    'application/vnd.ms-excel',
    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    'application/zip',
    'application/x-rar-compressed',
    'application/x-7z-compressed',
    'text/plain',
    'image/jpeg',
    'image/png',
    'image/gif',
  ];
  const maxSize = 10 * 1024 * 1024; // 10MB

  // Klik dropzone buka file dialog
  dropzone.addEventListener('click', () => fileInput.click());

  dropzone.addEventListener('dragover', e => {
    e.preventDefault();
    dropzone.classList.add('dragover');
  });

  dropzone.addEventListener('dragleave', e => {
    e.preventDefault();
    dropzone.classList.remove('dragover');
  });

  dropzone.addEventListener('drop', e => {
    e.preventDefault();
    dropzone.classList.remove('dragover');
    if (e.dataTransfer.files.length) {
      fileInput.files = e.dataTransfer.files;
      validateAndPreviewFiles(e.dataTransfer.files);
    }
  });

  // Support touch feedback
  dropzone.addEventListener('touchstart', () => dropzone.classList.add('dragover'));
  dropzone.addEventListener('touchend', () => dropzone.classList.remove('dragover'));

  fileInput.addEventListener('change', () => {
    if (fileInput.files.length) {
      validateAndPreviewFiles(fileInput.files);
    } else {
      clearPreview();
    }
  });

  function clearPreview() {
    filePreview.innerHTML = '';
    fileError.style.display = 'none';
  }

  function validateAndPreviewFiles(files) {
    clearPreview();
    fileError.style.display = 'none';

    let errorMessages = [];
    const validFiles = [];

    for (const file of files) {
      if (!allowedTypes.includes(file.type)) {
        errorMessages.push(`File "${file.name}" tipe tidak didukung.`);
        continue;
      }
      if (file.size > maxSize) {
        errorMessages.push(`File "${file.name}" melebihi ukuran maksimum 10MB.`);
        continue;
      }
      validFiles.push(file);
    }

    if (errorMessages.length) {
      fileError.textContent = errorMessages.join(' ');
      fileError.style.display = 'block';
    }

    if (validFiles.length === 0) {
      fileInput.value = '';
      return;
    }

    // Tampilkan preview valid file
    validFiles.forEach(file => {
      const fileDiv = document.createElement('div');

      if (file.type.startsWith('image/')) {
        const img = document.createElement('img');
        img.alt = file.name;
        img.title = file.name;
        const reader = new FileReader();
        reader.onload = e => img.src = e.target.result;
        reader.readAsDataURL(file);
        fileDiv.appendChild(img);
      } else if (file.type === 'application/pdf') {
        // Tampilkan icon PDF + nama file
        const pdfIcon = document.createElement('i');
        pdfIcon.className = 'bi bi-file-earmark-pdf-fill text-danger display-5';
        pdfIcon.style.fontSize = '5rem';
        pdfIcon.title = file.name;

        const label = document.createElement('div');
        label.textContent = file.name;
        label.style.fontSize = '0.85rem';
        label.style.wordBreak = 'break-word';
        label.style.marginTop = '0.2rem';

        fileDiv.classList.add('d-flex', 'flex-column', 'align-items-center');
        fileDiv.appendChild(pdfIcon);
        fileDiv.appendChild(label);
      } else {
        // Icon file generic berdasarkan extensi
        const ext = file.name.split('.').pop().toLowerCase();
        const iconMap = {
          doc: 'bi-file-earmark-word-fill text-primary',
          docx: 'bi-file-earmark-word-fill text-primary',
          ppt: 'bi-file-earmark-ppt-fill text-danger',
          pptx: 'bi-file-earmark-ppt-fill text-danger',
          xls: 'bi-file-earmark-excel-fill text-success',
          xlsx: 'bi-file-earmark-excel-fill text-success',
          zip: 'bi-file-earmark-zip-fill text-warning',
          rar: 'bi-file-earmark-zip-fill text-warning',
          '7z': 'bi-file-earmark-zip-fill text-warning',
          txt: 'bi-file-earmark-text-fill text-secondary',
        };
        const iconClass = iconMap[ext] || 'bi-file-earmark-fill text-secondary';

        const fileIcon = document.createElement('i');
        fileIcon.className = `bi ${iconClass} display-5`;
        fileIcon.style.fontSize = '5rem';
        fileIcon.title = file.name;

        const label = document.createElement('div');
        label.textContent = file.name;
        label.style.fontSize = '0.85rem';
        label.style.wordBreak = 'break-word';
        label.style.marginTop = '0.2rem';

        fileDiv.classList.add('d-flex', 'flex-column', 'align-items-center');
        fileDiv.appendChild(fileIcon);
        fileDiv.appendChild(label);
      }

      filePreview.appendChild(fileDiv);
    });
  }

  form.addEventListener('submit', (e) => {
    // Validasi file jika tidak ada file dan wajib ada file (untuk create)
    if (!fileInput.files.length && !{{ isset($jawaban) ? 'true' : 'false' }}) {
      e.preventDefault();
      fileError.textContent = 'Silakan pilih file jawaban terlebih dahulu.';
      fileError.style.display = 'block';
      fileInput.focus();
      return false;
    }

    // Jika error masih muncul, blokir submit
    if (fileError.style.display === 'block') {
      e.preventDefault();
      fileInput.focus();
      return false;
    }

    // Disable tombol submit & tampilkan spinner
    submitBtn.disabled = true;
    btnText.classList.add('d-none');
    btnSpinner.classList.remove('d-none');
  });
});
</script>
@endsection
