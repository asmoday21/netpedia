@extends('admin.admin_master')

@section('admin')
<div class="container py-5">
  <div class="card border-0 shadow rounded-4 p-4">
    <h4 class="mb-4 fw-bold text-warning">
      <i class="mdi mdi-pencil-outline me-2"></i> Edit Quiz
    </h4>

    <form action="{{ route('admin.quiz.update', $quiz->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label fw-semibold">Judul Quiz</label>
        <input type="text" name="judul" class="form-control rounded-3 shadow-sm" 
               value="{{ old('judul', $quiz->judul) }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Platform</label>
        <select name="platform" class="form-select rounded-3 shadow-sm" required>
          <option disabled>-- Pilih Platform --</option>
          <option value="Kahoot" {{ old('platform', $quiz->platform) == 'Kahoot' ? 'selected' : '' }}>Kahoot</option>
          <option value="Quizizz" {{ old('platform', $quiz->platform) == 'Quizizz' ? 'selected' : '' }}>Quizizz</option>
          <option value="Wordwall" {{ old('platform', $quiz->platform) == 'Wordwall' ? 'selected' : '' }}>Wordwall</option>
          <option value="Lainnya" {{ old('platform', $quiz->platform) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
        </select>
      </div>

      <div class="mb-4">
        <label class="form-label fw-semibold">Link Quiz</label>
        <input type="url" name="link" class="form-control rounded-3 shadow-sm"
               placeholder="https://..." value="{{ old('link', $quiz->link) }}" required>
      </div>

      <div class="d-flex justify-content-end">
        <a href="{{ route('admin.quiz.index') }}" class="btn btn-light border me-2 rounded-pill px-4">Batal</a>
        <button type="submit" class="btn btn-warning text-white rounded-pill px-4 shadow-sm">
          <i class="mdi mdi-content-save-edit-outline me-1"></i> Update
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
