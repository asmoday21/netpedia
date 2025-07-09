<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Ujian;

class SiswaUjianController extends Controller
{

        public function indexUjian()
    {
        $ujian = Ujian::latest()->get(); // ambil semua ujian terbaru
        return view('siswa.ujian.index', compact('ujian'));
    }
}
