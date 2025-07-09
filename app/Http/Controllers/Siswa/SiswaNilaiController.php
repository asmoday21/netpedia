<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Nilai;
use App\Models\TugasJawaban;
use App\Models\Tugas;
use App\Models\Materi;
use Illuminate\Http\Request;

class SiswaNilaiController extends Controller
{
    public function index(Request $request)
    {
        $siswaId = auth()->id();

        $query = TugasJawaban::with('tugas')
                    ->where('siswa_id', $siswaId)
                    ->orderBy('updated_at', 'desc');

        // Filter berdasarkan materi (materi_id)
        if ($request->has('materi') && $request->materi != '') {
            $query->whereHas('tugas', function ($q) use ($request) {
                $q->where('materi_id', $request->materi);
            });
        }

        $nilai = $query->paginate(10);

        // Ambil daftar materi yang tersedia dari tabel materi
        $daftarMateri = Materi::orderBy('judul')->get();

        return view('siswa.nilai.index', compact('nilai', 'daftarMateri'));
    }
}
