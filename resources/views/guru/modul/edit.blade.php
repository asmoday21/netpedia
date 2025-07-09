@extends('guru.guru_master')
@section('guru')

<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-body p-4">
            <h4 class="mb-4">✏️ Edit Modul: <strong>{{ $modul->judul }}</strong></h4>

            <form action="{{ route('guru.modul.update', $modul->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div class="mb-3">
                    <label for="judul" class="form-label">📘 Judul Modul</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $modul->judul) }}" required>
                    @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                {{-- Link YouTube --}}
                <div class="mb-3">
                    <label for="embed_link" class="form-label">🔗 Link Video YouTube</label>
                    <input type="url" class="form-control @error('embed_link') is-invalid @enderror" id="embed_link" name="embed_link" value="{{ old('embed_link', $modul->embed_link) }}">
                    @error('embed_link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <small class="form-text text-muted">Contoh: https://www.youtube.com/watch?v=VIDEO_ID</small>
                </div>

                {{-- Preview Video --}}
                @if($modul->embed_link)
                    @php
                        preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/))([\w\-]{11})/', $modul->embed_link, $matches);
                        $videoId = $matches[1] ?? null;
                    @endphp
                    @if($videoId)
                        <div class="mb-4 text-center">
                            <label class="form-label d-block">🎞️ Preview Video</label>
                            <div class="ratio ratio-16x9 rounded overflow-hidden shadow-sm">
                                <iframe src="https://www.youtube.com/embed/{{ $videoId }}" allowfullscreen></iframe>
                            </div>
                        </div>
                    @endif
                @endif

                {{-- Judul YouTube --}}
                <div class="mb-3">
                    <label for="youtube_title" class="form-label">🎬 Judul Video (opsional)</label>
                    <input type="text" class="form-control" id="youtube_title" name="youtube_title" value="{{ old('youtube_title', $modul->youtube_title) }}">
                </div>

                {{-- Kategori --}}
                <div class="mb-3">
                    <label for="kategori" class="form-label">🏷️ Kategori</label>
                    <input type="text" class="form-control" id="kategori" name="kategori" value="{{ old('kategori', $modul->kategori) }}">
                </div>

                {{-- Gambar --}}
                <div class="mb-3">
                    <label for="gambar" class="form-label">🖼️ Upload Gambar</label>
                    <input class="form-control @error('gambar') is-invalid @enderror" type="file" id="gambar" name="gambar" accept="image/*" onchange="previewImage(event)">
                    @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror

                    <div class="mt-3 text-center">
                        <img id="previewImg" src="{{ $modul->gambar ? asset('storage/' . $modul->gambar) : '#' }}" alt="Preview Gambar" class="img-thumbnail shadow" style="max-width: 300px; {{ $modul->gambar ? '' : 'display: none;' }}">
                    </div>
                </div>

                {{-- PDF --}}
                <div class="mb-3">
                    <label for="file_pdf" class="form-label">📄 Upload File PDF</label>
                    <input class="form-control @error('file_pdf') is-invalid @enderror" type="file" id="file_pdf" name="file_pdf" accept="application/pdf">
                    @error('file_pdf')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    @if($modul->file_pdf)
                        <div class="mt-2">
                            <a href="{{ asset('storage/' . $modul->file_pdf) }}" target="_blank" class="btn btn-outline-primary btn-sm">📂 Lihat File PDF Saat Ini</a>
                        </div>
                    @endif
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('guru.modul.index') }}" class="btn btn-secondary">
                        ← Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        💾 Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

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
    }
}
</script>

@endsection
