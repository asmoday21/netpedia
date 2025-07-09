<?php

// app/Http/Controllers/GuruController.php

namespace App\Http\Controllers\Guru;

use App\Models\Nilai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaporanController extends Controller
{
    // Metode untuk menampilkan laporan nilai
    public function laporanNilai()
    {
        // Misalnya mengambil semua nilai yang ada
        $nilai = Nilai::all();

        // Mengembalikan view dengan data nilai
        return view('guru.laporan', compact('nilai'));
    }
    public function generate(Request $request)
{
    // Logika cetak PDF atau laporan lainnya
    return response()->download(...);
}

}
