@extends('guru.guru_master')

@section('guru')
<div class="container py-5">
  <h3 class="text-center mb-4 text-primary">Edit Elemen Penilaian</h3>

  <form action="{{ route('guru.elemen.update', $elemen->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label for="nama" class="form-label">Nama Elemen</label>
      <input type="text" name="nama" id="nama" class="form-control" value="{{ $elemen->nama }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
</div>
@endsection
