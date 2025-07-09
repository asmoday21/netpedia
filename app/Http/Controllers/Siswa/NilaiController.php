<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    /**
     * Menampilkan daftar nilai yang tersedia untuk siswa.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = auth()->user();

        $nilais = Nilai::with(['guru', 'materi'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('siswa.nilai.index', compact('nilais'));
    }

}
