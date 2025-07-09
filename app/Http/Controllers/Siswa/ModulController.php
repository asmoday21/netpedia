<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Modul;

class ModulController extends Controller
{
    public function index(Request $request)
    {
        $query = Modul::query();

        // Fitur pencarian jika diketik
        if ($request->ajax() && $request->has('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
            $moduls = $query->latest()->get();

            return view('siswa.modul._modul_cards', compact('moduls'));
        }

        // Default: tampilkan dengan paginasi
        $moduls = $query->latest()->paginate(12);
        return view('siswa.modul.index', compact('moduls'));
    }

    public function show(Modul $modul)
    {
        return view('siswa.modul.show', compact('modul'));
    }
}
