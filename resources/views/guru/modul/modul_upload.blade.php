@extends('guru.guru_master')

@section('guru')
<div class="container mt-4">
    <h3>Upload Model 3D Modul</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('guru.modul.upload3d') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label for="judul" class="form-label">Judul Modul</label>
            <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') }}" required>
        </div>

        <div class="mb-3">
            <label for="model3d" class="form-label">File Model 3D (.glb / .gltf)</label>
            <input type="file" name="model3d" id="model3d" class="form-control" accept=".glb,.gltf" required>
            <small class="form-text text-muted">Format file harus .glb atau .gltf dan maksimal 20MB.</small>
        </div>

        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection
