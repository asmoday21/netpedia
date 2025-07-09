@extends('siswa.siswa_master')

@section('siswa')
<div class="container mx-auto py-8 max-w-xl">
    <h1 class="text-2xl font-bold mb-6">Upload Jawaban Tugas: {{ $tugas->judul }}</h1>

    @if(session('error'))
        <div class="bg-red-200 text-red-800 px-4 py-2 rounded mb-4">{{ session('error') }}</div>
    @endif

    <form action="{{ route('siswa.tugas.store', $tugas->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
        @csrf

        <div class="mb-4">
            <label for="file" class="block font-semibold mb-2">File Jawaban (pdf, doc, docx, zip) <span class="text-red-600">*</span></label>
            <input type="file" name="file" id="file" class="border rounded w-full" required>
            @error('file')
                <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Upload Jawaban</button>
        <a href="{{ route('siswa.tugas.show', $tugas->id) }}" class="ml-4 text-gray-700 hover:underline">Batal</a>
    </form>
</div>
@endsection
