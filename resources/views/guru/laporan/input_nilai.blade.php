@extends('guru.guru_master')

@section('guru')
<div class="container py-5">
  <h3 class="text-center mb-4 text-primary">✏️ Input Nilai Siswa</h3>

  @if(session('success'))
    <div class="alert alert-success text-center">{{ session('success') }}</div>
  @endif

  <div class="card shadow-sm">
    <div class="card-body">
      <form action="{{ route('guru.nilai.store') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="siswa_id" class="form-label">Pilih Siswa</label>
          <select name="siswa_id" class="form-select" required>
            <option value="">-- Pilih Siswa --</option>
            @foreach ($siswas as $siswa)
              <option value="{{ $siswa->id }}">{{ $siswa->nama }} ({{ $siswa->kelas }})</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="elemen_id" class="form-label">Pilih Elemen</label>
          <select name="elemen_id" class="form-select" required>
            <option value="">-- Pilih Elemen --</option>
            @foreach ($elemens as $elemen)
              <option value="{{ $elemen->id }}">{{ $elemen->nama }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="nilai" class="form-label">Nilai</label>
          <input type="number" name="nilai" class="form-control" min="0" max="100" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Nilai</button>
      </form>
    </div>
  </div>
</div>
@endsection
