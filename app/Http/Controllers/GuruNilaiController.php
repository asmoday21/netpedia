<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Elemen;
use Illuminate\Http\Request;

class GuruNilaiController extends Controller
{
    public function index(Request $request)
    {
        // Query untuk Nilai, dengan relasi Siswa dan Elemen
        $query = Nilai::with('siswa', 'elemen'); // Menyertakan relasi siswa dan elemen

        // Pencarian berdasarkan nama siswa
        if ($request->has('cari')) {
            $cari = $request->input('cari');
            $query->whereHas('siswa', function ($q) use ($cari) {
                $q->where('nama', 'like', '%' . $cari . '%');
            });
        }

        // Filter berdasarkan elemen penilaian
        if ($request->has('elemen') && $request->input('elemen') != '') {
            $elemen_id = $request->input('elemen');
            $query->where('elemen_id', $elemen_id); // Misalnya 'elemen_id' adalah kolom pada tabel 'nilai'
        }

        // Ambil data nilai dengan paginasi
        $nilai = $query->paginate(10);

        // Ambil semua elemen untuk dropdown
        $elemen = Elemen::all();

        // Kembalikan tampilan dengan data nilai dan elemen
        return view('guru.nilai.index', compact('nilai', 'elemen'));
    }

    // GuruNilaiController.php
public function store(Request $request)
{
    $request->validate([
        'siswa_id' => 'required|exists:siswas,id',
        'elemen_id' => 'required|exists:elemens,id',
        'nilai' => 'required|integer|min:0|max:100',
    ]);

    Nilai::create([
        'siswa_id' => $request->siswa_id,
        'elemen_id' => $request->elemen_id,
        'nilai' => $request->nilai,
    ]);

    return back()->with('success', 'Nilai berhasil disimpan.');
}

}

