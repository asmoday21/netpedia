<?php

namespace App\Http\Controllers;

use App\Models\Elemen;
use Illuminate\Http\Request;

class ElemenController extends Controller
{
    // Menampilkan semua elemen
    public function index()
    {
        $elemen = Elemen::all();
        return view('guru.elemen.index', compact('elemen'));
    }

    // Menampilkan form untuk menambah elemen baru
    public function create()
    {
        return view('guru.elemen.create');
    }

    // Menyimpan elemen baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        Elemen::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('guru.elemen.index')->with('success', 'Elemen berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit elemen
    public function edit($id)
    {
        $elemen = Elemen::findOrFail($id);
        return view('guru.elemen.edit', compact('elemen'));
    }

    // Mengupdate elemen
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $elemen = Elemen::findOrFail($id);
        $elemen->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('guru.elemen.index')->with('success', 'Elemen berhasil diperbarui!');
    }

    // Menghapus elemen
    public function destroy($id)
    {
        $elemen = Elemen::findOrFail($id);
        $elemen->delete();

        return redirect()->route('guru.elemen.index')->with('success', 'Elemen berhasil dihapus!');
    }
}
