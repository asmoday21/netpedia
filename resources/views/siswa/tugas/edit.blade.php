@extends('siswa.siswa_master')

@section('siswa')
<div class="container mx-auto py-8 max-w-xl">
    <h1 class="text-2xl font-bold mb-6">Edit Jawaban Tugas: {{ $tugas->judul }}</h1>

    @if(session('error'))
        <div class="bg-red-200 text-red-800 px-4 py-2 rounded mb-4">{{ session('error') }}</div>
    @endif

    <form action="{{ route('siswa.tugas.update', $tugas->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <p class="mb-2 font-semibold">File Jawaban Saat Ini:</p>
            @if ($pengumpulan->file)
                <a href="{{ asset('storage/jawaban/' . $pengumpulan->file) }}" target="_blank" class="text-blue-600 underline">Lihat File</a>
            @else
                <p class="italic text-gray-500">Tidak ada file yang diunggah.</p>
            @endif
        </div>

        <div class="mb-4">
            <label for="file" class="block font-semibold mb-2">Ganti File Jawaban (pdf, doc, docx, zip)</label>
            <input type="file" name="file" id="file" class="border rounded w-full">
            @error('file')
                <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
            @enderror
            <p class="text-sm text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti file.</p>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan Perubahan</button>
        <a href="{{ route('siswa.tugas.show', $tugas->id) }}" class="ml-4 text-gray-700 hover:underline">Batal</a>
    </form>
</div>
@endsection
