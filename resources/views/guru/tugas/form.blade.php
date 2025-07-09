  @extends('guru.guru_master')

  @section('guru')
  <div class="container">
      <h2>Buat Tugas Baru - Prinsip Dasar TCP/IP</h2>
      <form action="{{ route('guru.tugas.simpan') }}" method="POST">
          @csrf
          @include('guru.tugas.partials.informasi')
          @include('guru.tugas.partials.pilihan_ganda')
          @include('guru.tugas.partials.jawaban_singkat')
          @include('guru.tugas.partials.essay')
          <div class="text-center mb-4">
              <button type="submit" class="btn btn-primary btn-lg">Simpan Tugas</button>
              <a href="{{ route('guru.tugas') }}" class="btn btn-secondary btn-lg ml-2">Batal</a>
          </div>
      </form>
  </div>
  @endsection
