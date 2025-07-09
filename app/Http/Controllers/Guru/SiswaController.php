<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Siswa;

class SiswaController extends Controller
{
    /**
     * Menampilkan daftar siswa untuk guru, dengan filter pencarian dan kelas.
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'siswa')->with('kelas');

        // Filter kelas
        if ($request->filled('kelas')) {
            $query->where('kelas_id', $request->kelas);
        }

        // Filter nama atau email
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $semuaSiswa = $query->orderBy('name')->paginate(10);
        $daftarKelas = Kelas::orderBy('nama_kelas')->get();

        return view('guru.siswa.index', compact('semuaSiswa', 'daftarKelas'));
    }


    // Tambahan (opsional): detail siswa jika guru perlu akses
    public function show($id)
    {
        $siswa = Siswa::with('kelas')->findOrFail($id);
        return view('guru.siswa.show', compact('siswa'));
    }
    /**
     * Tampilkan form edit siswa.
     */
    public function edit($id)
    {
        try {
            $siswa = User::where('role', 'siswa')->findOrFail($id);
            $kelasList = Kelas::orderBy('nama_kelas')->get();

            return view('guru.siswa.edit', compact('siswa', 'kelasList'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('guru.siswa.index')->with('error', 'Siswa tidak ditemukan.');
        }
    }

    /**
     * Perbarui data siswa.
     */
    public function update(Request $request, $id)
    {
        try {
            $siswa = User::where('role', 'siswa')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('guru.siswa.index')->with('error', 'Siswa tidak ditemukan.');
        }

        $request->validate([
            'name' => 'required|string|max:100',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $siswa->update([
            'name' => $request->name,
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()->route('guru.siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }
}
