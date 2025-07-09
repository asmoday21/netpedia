@extends('admin.admin_master')

@section('admin')
<div class="container mt-5">
    <div class="card shadow-lg rounded">
        <div class="card-header bg-info text-white text-center">
            <h4 class="mb-0">✏️ Edit Guru</h4>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.guru.update', $guru->id) }}" method="POST">
                @csrf
                @method('POST')

                <div class="mb-3">
                    <label for="nama" class="form-label fw-bold">Nama</label>
                    <input type="text" name="nama" class="form-control" value="{{ $guru->nama }}" required placeholder="Masukkan nama lengkap">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $guru->email }}" required placeholder="guru@email.com">
                </div>

                <div class="mb-3">
                    <label for="telepon" class="form-label fw-bold">Telepon</label>
                    <input type="text" name="telepon" class="form-control" value="{{ $guru->telepon }}" required placeholder="08xxxx">
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label fw-bold">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat tempat tinggal">{{ $guru->alamat }}</textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary me-2">
                        <i class="bi bi-arrow-left-circle"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
