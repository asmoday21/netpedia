@extends('admin.admin_master')

@section('admin')
<div class="container mt-5">
    <h2 class="mb-4 text-center text-primary font-weight-bold">Tambah Siswa</h2>

    <form action="{{ route('admin.siswa.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="name">Nama</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>

        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>

        <div class="form-group mb-3">
            <label for="telepon">Telepon</label>
            <input type="text" class="form-control" name="telepon" id="telepon">
        </div>

        <div class="form-group mb-4">
            <label for="kelas_id">Kelas</label>
            <select class="form-control" name="kelas_id" id="kelas_id" required>
                <option value="">-- Pilih Kelas --</option>
                @forelse ($kelasList as $kelas)
                    <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                @empty
                    <option disabled>Tidak ada kelas tersedia</option>
                @endforelse
            </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">Tambah Siswa</button>
    </form>
</div>
@endsection
