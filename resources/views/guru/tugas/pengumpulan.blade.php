@extends('guru.guru_master')

@section('guru')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Pengumpulan Tugas: {{ $tugas->judul }}</h1>

    <div class="overflow-x-auto">
        <table class="w-full text-left table-auto border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-3 border">Nama Siswa</th>
                    <th class="p-3 border">Jawaban</th>
                    <th class="p-3 border">Nilai</th>
                    <th class="p-3 border">Catatan</th>
                    <th class="p-3 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tugas->pengumpulan as $pengumpulan)
                    <tr class="hover:bg-gray-50">
                        <td class="p-3 border">{{ $pengumpulan->siswa->name }}</td>
                        <td class="p-3 border">
                            @if ($pengumpulan->file)
                                <a href="{{ asset('storage/jawaban/' . $pengumpulan->file) }}" target="_blank" class="text-blue-600 underline">Lihat</a>
                            @else
                                -
                            @endif
                        </td>
                        <td class="p-3 border">{{ $pengumpulan->nilai ?? '-' }}</td>
                        <td class="p-3 border">{{ $pengumpulan->catatan ?? '-' }}</td>
                        <td class="p-3 border">
                            <form action="{{ route('guru.tugas.nilai', $pengumpulan->id) }}" method="POST" class="space-x-2 flex">
                                @csrf
                                <input type="number" name="nilai" value="{{ $pengumpulan->nilai }}" min="0" max="100" class="border p-1 rounded w-20">
                                <input type="text" name="catatan" value="{{ $pengumpulan->catatan }}" class="border p-1 rounded">
                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded">Simpan</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
