@extends('guru.guru_master')

@section('guru')
<div class="container py-5">
  <h3 class="text-center mb-4 text-primary">📋 Daftar Elemen Penilaian</h3>

  @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

  <a href="{{ route('guru.elemen.create') }}" class="btn btn-primary mb-3">Tambah Elemen</a>

  <div class="card shadow-sm">
    <div class="card-body">
      <table class="table table-hover table-bordered">
        <thead class="table-primary text-center">
          <tr>
            <th>Nama Elemen</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($elemen as $e)
            <tr class="text-center">
              <td>{{ $e->nama }}</td>
              <td>
                <a href="{{ route('guru.elemen.edit', $e->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('guru.elemen.destroy', $e->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus elemen ini?')">Hapus</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
