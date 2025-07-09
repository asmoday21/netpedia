@extends('guru.guru_master')

@section('guru')
<div class="container py-5">
  <h3 class="text-center mb-4 text-primary">Tambah Elemen Penilaian</h3>

  <form action="{{ route('guru.elemen.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="nama" class="form-label">Nama Elemen</label>
      <input type="text" name="nama" id="nama" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
  </form>
</div>
@endsection
