@extends('admin.admin_master')

@section('admin')
<div class="container mt-5">
    <h2 class="mb-4 text-center text-primary font-weight-bold">Edit Siswa</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST">
        <div id="validation-message" class="mt-3"></div>

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $siswa->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $siswa->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="telepon" class="form-label">Telepon</label>
            <input type="text" class="form-control" name="telepon" id="telepon" value="{{ old('telepon', $siswa->telepon) }}">
        </div>

        <div class="mb-4">
            <label for="kelas" class="form-label">Kelas</label>
            <select class="form-select" name="kelas_id" id="kelas" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach ($kelasList as $kelas)
                    <option value="{{ $kelas->id }}" {{ $siswa->kelas_id == $kelas->id ? 'selected' : '' }}>
                        {{ $kelas->nama_kelas }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-warning">Perbarui Siswa</button>
        <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary ms-2">Batal</a>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const name = document.getElementById('name');
    const email = document.getElementById('email');
    const telepon = document.getElementById('telepon');
    const messageBox = document.getElementById('validation-message');

    function showError(message) {
        messageBox.innerHTML = `<div class="alert alert-danger">${message}</div>`;
    }

    form.addEventListener('submit', function (e) {
        messageBox.innerHTML = ''; // clear

        if (!name.value.trim()) {
            e.preventDefault();
            showError("Nama tidak boleh kosong.");
            name.focus();
            return;
        }

        if (!email.value.trim() || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
            e.preventDefault();
            showError("Masukkan email yang valid.");
            email.focus();
            return;
        }

        if (telepon.value.trim() && telepon.value.length < 8) {
            e.preventDefault();
            showError("Masukkan nomor telepon yang valid (minimal 8 karakter).");
            telepon.focus();
            return;
        }
    });
});
</script>
@endsection
