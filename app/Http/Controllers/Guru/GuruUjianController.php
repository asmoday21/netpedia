<?php

namespace App\Http\Controllers\Guru;

use App\Models\Ujian;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class GuruUjianController extends Controller
{
    // Tampilkan daftar ujian milik guru yang login
    public function index()
    {
        $ujian = Ujian::where('guru_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('guru.ujian.index', compact('ujian'));
    }

    // Tampilkan form buat ujian baru
    public function create()
    {
        return view('guru.ujian.create');
    }

    // Simpan ujian baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after_or_equal:waktu_mulai',
        ]);

        $ujian = Ujian::create([
            'judul' => $request->judul,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'guru_id' => Auth::id(),
        ]);

        return redirect()->route('guru.ujian.edit', $ujian->id)
                         ->with('success', 'Ujian berhasil dibuat. Sekarang tambah soal.');
    }

    // Tampilkan halaman edit ujian dan tambah soal
    public function edit($id)
    {
        $ujian = Ujian::with('soal')->where('guru_id', Auth::id())->findOrFail($id);
        return view('guru.ujian.edit', compact('ujian'));
    }

    // Tambah soal ke ujian
    public function storeSoal(Request $request, $ujian_id)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'pilihan' => 'required|array|min:2',
            'pilihan.*' => 'required|string',
            'jawaban_benar' => 'required|string',
        ]);

        Soal::create([
            'ujian_id' => $ujian_id,
            'pertanyaan' => $request->pertanyaan,
            'pilihan' => json_encode($request->pilihan),
            'jawaban_benar' => $request->jawaban_benar,
        ]);

        return back()->with('success', 'Soal berhasil ditambahkan.');
    }

    // Optional: Hapus soal
    public function destroySoal($id)
    {
        $soal = Soal::findOrFail($id);
        $soal->delete();

        return back()->with('success', 'Soal berhasil dihapus.');
    }
}
