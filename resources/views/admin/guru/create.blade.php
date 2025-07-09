@extends('admin.admin_master')

@section('admin')
<div class="container mt-5">
    <div class="card shadow-lg rounded">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0 text-center">🧑‍🏫 Tambah Guru Baru</h4>
        </div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.guru.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control" required placeholder="Masukkan nama lengkap">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" required placeholder="guru@email.com">
                </div>

                <div class="mb-3">
                    <label for="telepon" class="form-label">Telepon <span class="text-danger">*</span></label>
                    <input type="text" name="telepon" class="form-control" required placeholder="08xxxx">
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat tempat tinggal"></textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary me-2">
                        <i class="bi bi-arrow-left"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
