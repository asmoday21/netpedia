<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ujian;

class UjianController extends Controller
{
    public function show($id) {
    $ujian = Ujian::with('soal')->findOrFail($id);
    return view('siswa.ujian.show', compact('ujian'));
}

public function submit(Request $request, $id) {
    $ujian = Ujian::with('soal')->findOrFail($id);

    $soal_ids = $ujian->soal->pluck('id')->toArray();
    $jawabanSiswa = $request->input('jawaban'); // array soal_id => jawaban

    $nilai = 0;
    $totalSoal = count($soal_ids);

    foreach ($soal_ids as $soal_id) {
        $jawabanBenar = $ujian->soal->where('id', $soal_id)->first()->jawaban_benar;
        if (isset($jawabanSiswa[$soal_id]) && $jawabanSiswa[$soal_id] == $jawabanBenar) {
            $nilai++;
        }
    }

    $skor = ($nilai / $totalSoal) * 100;

    // Simpan ke DB jika perlu, contoh:
    // JawabanUjian::updateOrCreate(
    //   ['ujian_id' => $id, 'siswa_id' => Auth::id()],
    //   ['nilai' => $skor, 'jawaban' => json_encode($jawabanSiswa)]
    // );

    return view('siswa.ujian.hasil', [
        'ujian' => $ujian,
        'nilai' => $skor,
        'jawabanSiswa' => $jawabanSiswa,
    ]);
}

}
