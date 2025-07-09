<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kelas;

class KelasController extends Controller
{
    // Menampilkan semua kelas
    public function index()
    {
        $daftar_kelas = Kelas::orderBy('nama_kelas')->get();
        return view('admin.kelas.index', compact('daftar_kelas'));
    }

    // Menampilkan siswa dari satu kelas

    public function show($id, Request $request)
    {
        $kelas = Kelas::findOrFail($id);

        $query = $kelas->siswas(); // relasi dengan where('usertype', 'siswa')

        if ($request->has('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%')
                ->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }

        $students = $query->orderBy('name')->get();

        return view('admin.kelas.show', compact('kelas', 'students'));
    }


    // Halaman tambah kelas
    public function create()
    {
        return view('admin.kelas.create');
    }

    // Simpan kelas baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255|unique:kelas,nama_kelas',
        ]);

        Kelas::create($request->only('nama_kelas'));

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil ditambahkan!');
    }

    // Halaman edit kelas
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('admin.kelas.edit', compact('kelas'));
    }

    // Update kelas
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255|unique:kelas,nama_kelas,' . $id,
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update($request->only('nama_kelas'));

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil diupdate!');
    }

    // Hapus kelas
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }
}
