@extends('siswa.siswa_master')

@section('siswa')
<div class="container mt-4 text-center">
  <h3>Hasil Ujian: {{ $ujian->judul }}</h3>
  <h4 class="my-4">Nilai Anda: <span class="text-success">{{ number_format($nilai, 2) }}%</span></h4>

  <a href="{{ route('siswa.ujian.index') }}" class="btn btn-secondary">Kembali ke Daftar Ujian</a>
</div>
@endsection
