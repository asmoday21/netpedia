@extends('guru.guru_master')

@section('guru')
<div class="container py-5">
  <h3 class="text-center mb-4 text-warning">✏️ Edit Nilai Siswa</h3>

  <div class="card shadow-sm">
    <div class="card-body">
      <form action="{{ route('guru.nilai.update', $nilai->id) }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="siswa_id" class="form-label">Pilih Siswa</label>
          <select name="siswa_id" class="form-select" required>
            @foreach ($siswas as $siswa)
              <option value="{{ $siswa->id }}" {{ $nilai->siswa_id == $siswa->id ? 'selected' : '' }}>
                {{ $siswa->nama }} ({{ $siswa->kelas }})
              </option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="elemen_id" class="form-label">Pilih Elemen</label>
          <select name="elemen_id" class="form-select" required>
            @foreach ($elemens as $elemen)
              <option value="{{ $elemen->id }}" {{ $nilai->elemen_id == $elemen->id ? 'selected' : '' }}>
                {{ $elemen->nama }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="nilai" class="form-label">Nilai</label>
          <input type="number" name="nilai" class="form-control" value="{{ $nilai->nilai }}" min="0" max="100" required>
        </div>

        <button type="submit" class="btn btn-success">Update Nilai</button>
      </form>
    </div>
  </div>
</div>
@endsection
