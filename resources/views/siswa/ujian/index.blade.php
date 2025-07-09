@extends('siswa.siswa_master')

@section('siswa')
<div class="container mt-4">
  <h4 class="mb-4">Ujian yang Tersedia</h4>

  @forelse($ujian as $item)
    <div class="card mb-3 shadow-sm">
      <div class="card-body">
        <h5 class="card-title">{{ $item->judul }}</h5>
        <p class="card-text">
          <strong>Waktu:</strong> 
          {{ \Carbon\Carbon::parse($item->waktu_mulai)->translatedFormat('d M Y, H:i') }} 
          - 
          {{ \Carbon\Carbon::parse($item->waktu_selesai)->translatedFormat('d M Y, H:i') }}
        </p>
        <a href="{{ route('siswa.ujian.show', $item->id) }}" class="btn btn-success btn-sm">Mulai Ujian</a>
      </div>
    </div>
  @empty
    <div class="alert alert-info">Belum ada ujian yang tersedia saat ini.</div>
  @endforelse
</div>
@endsection
