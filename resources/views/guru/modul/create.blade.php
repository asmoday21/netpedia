@extends('guru.guru_master')
@section('guru')

<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-body">
            <h3 class="card-title mb-4"><i class="fas fa-plus-circle me-2 text-success"></i>Tambah Modul Baru</h3>

            <form action="{{ route('guru.modul.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Judul Modul --}}
                <div class="mb-3">
                    <label for="judul" class="form-label fw-semibold">📘 Judul Modul</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}" required placeholder="Contoh: Pengantar Jaringan Telekomunikasi">
                    @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                {{-- Link YouTube --}}
                <div class="mb-3">
                    <label for="youtube_link" class="form-label fw-semibold">📺 Link Video YouTube</label>
                    <input type="url" class="form-control @error('youtube_link') is-invalid @enderror" id="youtube_link" name="youtube_link" value="{{ old('youtube_link') }}" placeholder="https://www.youtube.com/watch?v=VIDEO_ID" oninput="updateYoutubePreview()">
                    @error('youtube_link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <small class="text-muted">Contoh: https://www.youtube.com/watch?v=VIDEO_ID</small>

                    <div class="mt-3" id="youtube-preview" style="display:none;">
                        <p class="fw-semibold mb-2">Preview Thumbnail:</p>
                        <img id="youtube-thumbnail" class="img-fluid rounded shadow border" style="max-width: 320px;">
                    </div>
                </div>

                {{-- Judul Video (opsional) --}}
                <div class="mb-3">
                    <label for="youtube_title" class="form-label fw-semibold">📝 Judul Video YouTube (opsional)</label>
                    <input type="text" class="form-control" id="youtube_title" name="youtube_title" value="{{ old('youtube_title') }}" placeholder="Judul yang lebih deskriptif...">
                </div>

                {{-- Kategori --}}
                <div class="mb-3">
                    <label for="kategori" class="form-label fw-semibold">🏷️ Kategori</label>
                    <input type="text" class="form-control" id="kategori" name="kategori" value="{{ old('kategori') }}" placeholder="Contoh: Media, Jaringan Telekomunikasi">
                </div>

                {{-- Gambar Modul --}}
                <div class="mb-3">
                    <label for="gambar" class="form-label fw-semibold">🖼️ Upload Gambar Modul</label>
                    <input class="form-control @error('gambar') is-invalid @enderror" type="file" id="gambar" name="gambar" accept="image/*" onchange="previewImage(event)">
                    @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <img id="previewImg" src="#" class="mt-3 img-fluid rounded border shadow-sm" style="max-width: 320px; display: none;" alt="Preview Gambar">
                </div>

                {{-- File PDF --}}
                <div class="mb-4">
                    <label for="file_pdf" class="form-label fw-semibold">📄 Upload File PDF</label>
                    <input class="form-control @error('file_pdf') is-invalid @enderror" type="file" id="file_pdf" name="file_pdf" accept="application/pdf">
                    @error('file_pdf')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('guru.modul.index') }}" class="btn btn-secondary">
                        ← Batal
                    </a>
                    <button type="submit" class="btn btn-success">
                        💾 Simpan Modul
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Script --}}
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
        preview.style.display = 'none';
    }
}

function updateYoutubePreview() {
    const link = document.getElementById('youtube_link').value;
    const match = link.match(/(?:youtu\.be\/|youtube\.com\/watch\?v=)([^&]+)/);
    const youtubeId = match ? match[1] : null;

    const previewContainer = document.getElementById('youtube-preview');
    const thumbnail = document.getElementById('youtube-thumbnail');

    if (youtubeId) {
        thumbnail.src = `https://img.youtube.com/vi/${youtubeId}/hqdefault.jpg`;
        previewContainer.style.display = 'block';
    } else {
        thumbnail.src = '';
        previewContainer.style.display = 'none';
    }
}
</script>

@endsection
