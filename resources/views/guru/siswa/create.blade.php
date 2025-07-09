@extends('guru.guru_master')

@section('guru')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-person-plus me-2"></i> Tambah Siswa Baru</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('guru.siswa.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                            <div class="mb-3">
                                <label for="kelas_id" class="form-label">
                                    <i class="bi bi-people-fill me-1"></i> Kelas
                                </label>
                                <select class="form-select @error('kelas_id') is-invalid @enderror" 
                                        id="kelas_id" 
                                        name="kelas_id"
                                        required>
                                    <option value="" disabled {{ old('kelas_id') == null ? 'selected' : '' }}>-- Pilih Kelas --</option>
                                    @foreach($kelasList as $kelas)
                                        <option value="{{ $kelas->id }}" 
                                            {{ old('kelas_id', $siswa->kelas_id ?? '') == $kelas->id ? 'selected' : '' }}>
                                            {{ $kelas->nama_kelas }}
                                            @if(isset($kelas->tingkat)) - Tingkat {{ $kelas->tingkat }} @endif
                                        </option>
                                    @endforeach
                                </select>
                                @error('kelas_id')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>                        
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('guru.siswa.index') }}" class="btn btn-secondary me-md-2">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection