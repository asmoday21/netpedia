@extends('guru.guru_master')

@section('guru')
<div class="container py-5">
  <div class="card shadow-lg rounded-4">
    <div class="card-body px-5 py-4">
      <h3 class="mb-4 text-warning text-center">📊 Generate Laporan Nilai</h3>

      @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
      @endif

      <form action="{{ route('guru.laporan.generate') }}" method="GET">
        @csrf
        <div class="mb-3">
          <label for="kelas" class="form-label fw-semibold">Pilih Kelas</label>
          <select name="kelas" id="kelas" class="form-select" required>
            <option value="" disabled selected>-- Pilih Kelas --</option>
            <option value="kelas1">Kelas TJKT 1</option>
            <option value="kelas2">Kelas TJKT 2</option>
          </select>
        </div>

        <div class="text-center">
          <button type="submit" class="btn btn-warning px-4">
            📥 Generate Laporan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
