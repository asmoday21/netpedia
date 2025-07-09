<?php

namespace App\Http\Controllers\Guru;

use Illuminate\Http\Request;
use App\Models\Tugas;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class GuruTugasController extends Controller
{
    // List semua tugas dengan pagination
    
    public function index()
    {
        $tugas = Tugas::orderBy('batas_pengumpulan', 'asc')->get();
        return view('guru.tugas.index', compact('tugas'));
    }


    // Form tambah tugas
    public function create()
    {
        return view('guru.tugas.create');
    }

    // Simpan tugas baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'batas_pengumpulan' => 'required|date',
        ]);

        // Simpan:
        Tugas::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'batas_pengumpulan' => $request->batas_pengumpulan,
        ]);

        return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil dibuat.');
    }

    // Detail tugas
    public function show($id)
    {
        // Ambil tugas beserta relasi jawaban siswa jika ada
        $tugas = Tugas::with('jawabanSiswa')->findOrFail($id);
        return view('guru.tugas.show', compact('tugas'));
    }

    // Form edit tugas
    public function edit($id)
    {
        $tugas = Tugas::findOrFail($id);
        return view('guru.tugas.edit', compact('tugas'));
    }

    // Update tugas
    public function update(Request $request, $id)
    {
        $tugas = Tugas::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'deadline' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tugas->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'batas_pengumpulan' => $request->batas_pengumpulan,
        ]);

        return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil diperbarui.');
    }

    // Hapus tugas
    public function destroy($id)
    {
        $tugas = Tugas::findOrFail($id);
        $tugas->delete();

        return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil dihapus.');
    }

    public function sort(Request $request)
    {
        foreach ($request->order as $item) {
            Tugas::where('id', $item['id'])->update(['urutan' => $item['position']]);
        }

        return response()->json(['status' => 'ok']);
    }

}
