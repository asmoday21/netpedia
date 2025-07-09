@extends('admin.admin_master')

@section('admin')
<div class="container py-5">
  <h3 class="text-center mb-4 fw-bold" style="color: #0d6efd;">
    🧠 <span class="text-gradient">Daftar Quiz</span>
  </h3>

  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.quiz.create') }}" class="btn btn-outline-primary fw-semibold shadow-sm rounded-pill px-4">
      <i class="mdi mdi-plus-circle-outline me-2"></i> Tambah Quiz
    </a>
  </div>

  <div class="card border-0 shadow rounded-4">
    <div class="card-body px-4 py-4">
      <div class="table-responsive">
        <table class="table table-hover align-middle text-nowrap">
          <thead class="table-light text-center">
            <tr>
              <th style="width: 5%;">#</th>
              <th style="width: 25%;">Judul</th>
              <th style="width: 15%;">Platform</th>
              <th style="width: 30%;">Link</th>
              <th style="width: 15%;">Dibuat Oleh</th>
              <th style="width: 10%;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($quizzes as $index => $quiz)
              <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="fw-semibold">{{ $quiz->judul }}</td>
                <td class="text-center">
                  <span class="badge bg-primary-subtle text-primary fw-normal">{{ $quiz->platform }}</span>
                </td>
                <td>
                  <a href="{{ $quiz->link }}" target="_blank" class="text-decoration-none text-primary fw-medium">
                    <i class="mdi mdi-open-in-new me-1"></i> {{ Str::limit($quiz->link, 40) }}
                  </a>
                </td>
                <td class="text-center text-muted">{{ $quiz->user->name ?? 'N/A' }}</td>
                <td class="text-center">
                  <a href="{{ route('admin.quiz.edit', $quiz->id) }}" class="btn btn-sm btn-outline-warning rounded-pill px-3 me-1">
                    <i class="mdi mdi-pencil-outline"></i>
                  </a>
                  {{-- Optional: tombol hapus --}}
                  <form action="{{ route('admin.quiz.destroy', $quiz->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus quiz ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                      <i class="mdi mdi-delete-outline"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center py-5 text-muted">
                  <i class="mdi mdi-emoticon-sad-outline fs-4 d-block mb-2"></i>
                  Belum ada quiz yang tersedia.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
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
