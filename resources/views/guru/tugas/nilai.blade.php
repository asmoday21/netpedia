@extends('guru.guru_master')

@section('guru')
<div class="container py-5">
  <h3 class="text-center mb-4 text-primary">📝 Beri Nilai Tugas</h3>

  <div class="card shadow-sm">
    <div class="card-body">
      <h5 class="mb-3">Siswa: <strong>{{ $jawaban->siswa->name }}</strong></h5>
      <p><strong>Judul Tugas:</strong> {{ $jawaban->tugas->judul }}</p>

      <p>
        <strong>File Jawaban:</strong><br>
        <a href="{{ asset('storage/' . $jawaban->file_jawaban) }}" class="btn btn-sm btn-info mt-1" target="_blank">
          📄 Lihat Jawaban
        </a>
      </p>

      @if ($errors->any())
        <div class="alert alert-danger mt-3">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('guru.tugas.nilai.store', $jawaban->id) }}" method="POST" class="mt-4">
        @csrf
        <div class="mb-3">
          <label for="nilai" class="form-label">Nilai (0 - 100)</label>
          <input type="number" name="nilai" id="nilai" class="form-control @error('nilai') is-invalid @enderror"
                 value="{{ old('nilai', $jawaban->nilai) }}" min="0" max="100" required>
          @error('nilai')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="catatan" class="form-label">Catatan</label>
          <textarea name="catatan" id="catatan" rows="4" class="form-control @error('catatan') is-invalid @enderror">{{ old('catatan', $jawaban->catatan) }}</textarea>
          @error('catatan')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <button type="submit" class="btn btn-success w-100">
          <i class="mdi mdi-check-circle-outline"></i> Simpan Nilai
        </button>
      </form>
    </div>
  </div>
</div>
@endsection
