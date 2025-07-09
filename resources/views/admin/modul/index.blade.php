@extends('admin.admin_master')
@section('admin')

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold text-primary"><i class="fas fa-book"></i> Daftar Modul Ajar</h3>
        <a href="{{ route('admin.modul.create') }}" class="btn btn-success">+ Tambah Modul</a>
    </div>

    <!-- Search Bar -->
    <div class="input-group mb-4">
        <input type="text" id="searchInput" class="form-control" placeholder="Cari judul modul..." aria-label="Cari Modul">
        <button class="btn btn-outline-primary" type="button" id="searchBtn">Cari</button>
    </div>

    <!-- Daftar Modul -->
    <div class="row" id="modulContainer">
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
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $moduls->links() }}
    </div>
</div>

@push('scripts')
<script>
document.getElementById('searchBtn').addEventListener('click', function() {
    const query = document.getElementById('searchInput').value;

    fetch(`{{ route('admin.modul.index') }}?search=${query}`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.text())
    .then(data => {
        const container = document.getElementById('modulContainer');
        container.innerHTML = data;
    });
});
</script>
@endpush

@endsection
