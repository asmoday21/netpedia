<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use Illuminate\Http\Request;

class SiswaMateriController extends Controller
{
    public function index(Request $request)
        {
            $search = $request->input('search');

            $materi = Materi::query()
                ->when($search, fn($query) =>
                    $query->where('judul', 'like', '%' . $search . '%')
                        ->orWhere('konten', 'like', '%' . $search . '%'))
                ->orderByDesc('created_at')
                ->paginate(9);

            return view('siswa.materi.index', compact('materi'));
    }
    
    public function show($id)
    {
        $materi = Materi::findOrFail($id);
        return view('siswa.materi.show', compact('materi'));
    }

}
