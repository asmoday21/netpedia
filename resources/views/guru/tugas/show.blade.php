@extends('guru.guru_master')

@section('guru')
<div class="container py-5">
    <h3 class="mb-4 text-warning text-center">📄 Detail Tugas</h3>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h4>{{ $tugas->judul }}</h4>
            <p>{!! nl2br(e($tugas->deskripsi)) !!}</p>
            <p><strong>Batas Pengumpulan:</strong> {{ $tugas->batas_pengumpulan->format('d M Y, H:i') }}</p>
        </div>
    </div>

    <h5 class="mb-3">Jawaban Siswa</h5>

    @if($tugas->jawabanSiswa->count())
    <table class="table table-bordered text-center align-middle">
        <thead class="table-warning">
            <tr>
                <th>#</th>
                <th>Nama Siswa</th>
                <th>File Jawaban</th>
                <th>Nilai</th>
                <th>Komentar</th>
                <th>Tanggal Kumpul</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tugas->jawabanSiswa as $index => $jawaban)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $jawaban->siswa->nama ?? 'Nama Siswa' }}</td>
                <td>
                    @if($jawaban->file_jawaban)
                    <a href="{{ asset('storage/' . $jawaban->file_jawaban) }}" target="_blank">Lihat File</a>
                    @else
                    Tidak ada file
                    @endif
                </td>
                <td>{{ $jawaban->nilai ?? '-' }}</td>
                <td>{{ $jawaban->komentar ?? '-' }}</td>
                <td>{{ $jawaban->tanggal_kumpul ? $jawaban->tanggal_kumpul->format('d M Y, H:i') : '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="alert alert-info">Belum ada jawaban siswa untuk tugas ini.</div>
    @endif

    <div class="mt-3">
        <a href="{{ route('guru.tugas.index') }}" class="btn btn-secondary">Kembali ke Daftar Tugas</a>
    </div>
</div>
@endsection
