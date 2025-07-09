@extends('admin.admin_master')

@section('admin')
<div class="container py-5">
  <div class="card border-0 shadow rounded-4 p-4">
    <h4 class="mb-4 fw-bold text-primary">
      <i class="mdi mdi-plus-circle-outline me-2"></i> Tambah Quiz
    </h4>

    <form action="{{ route('admin.quiz.store') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label class="form-label fw-semibold">Judul Quiz</label>
        <input type="text" name="judul" class="form-control rounded-3 shadow-sm" placeholder="Contoh: Quiz Pemrograman" required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Platform</label>
        <select name="platform" class="form-select rounded-3 shadow-sm" required>
          <option disabled selected>-- Pilih Platform --</option>
          <option value="Kahoot">Kahoot</option>
          <option value="Quizizz">Quizizz</option>
          <option value="Wordwall">Wordwall</option>
          <option value="Lainnya">Lainnya</option>
        </select>
      </div>

      <div class="mb-4">
        <label class="form-label fw-semibold">Link Quiz</label>
        <input type="url" name="link" class="form-control rounded-3 shadow-sm" placeholder="https://quiz.example.com" required>
      </div>

      <div class="d-flex justify-content-end">
        <a href="{{ route('admin.quiz.index') }}" class="btn btn-light border me-2 rounded-pill px-4">Batal</a>
        <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
          <i class="mdi mdi-content-save-outline me-1"></i> Simpan
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
<style>
  .text-gradient {
    background: linear-gradient(90deg, #0d6efd, #6610f2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }
</style>
