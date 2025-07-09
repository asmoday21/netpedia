@foreach($moduls as $modul)
<div class="col-md-6 col-lg-4 mb-4 modul-card">
    <div class="card shadow-sm border-0 h-100">
        @if($modul->youtube_thumbnail)
        <img src="{{ $modul->youtube_thumbnail }}" class="card-img-top" style="height: 200px; object-fit: cover;">
        @elseif($modul->gambar)
        <img src="{{ asset('storage/' . $modul->gambar) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
        @endif

        <div class="card-body d-flex flex-column">
            <h5 class="card-title text-primary">{{ $modul->judul }}</h5>
            @if($modul->youtube_title)
            <p class="text-muted small mb-1">🎬 {{ $modul->youtube_title }}</p>
            @endif
            <p class="text-muted mb-2">Kategori: {{ $modul->kategori ?? 'Umum' }}</p>

            <div class="mt-auto d-flex gap-2">
                <a href="{{ route('admin.modul.show', $modul->id) }}" class="btn btn-sm btn-outline-primary w-100">Lihat</a>
                <a href="{{ route('admin.modul.edit', $modul->id) }}" class="btn btn-sm btn-outline-warning w-100">Edit</a>
                <form action="{{ route('admin.modul.destroy', $modul->id) }}" method="POST" class="w-100" onsubmit="return confirm('Yakin ingin menghapus modul ini?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger w-100" type="submit">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
