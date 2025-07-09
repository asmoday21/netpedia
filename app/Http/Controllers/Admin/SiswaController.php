<?php

namespace App\Http\Controllers\Admin;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiswaController extends Controller
{
    // Menampilkan halaman kelola siswa
    public function index(Request $request)
    {
        $query = Siswa::with('kelas');

        // Filter berdasarkan ID kelas
        if ($request->filled('kelas')) {
            $query->where('kelas_id', $request->kelas);
        }

        // Filter berdasarkan nama
        if ($request->filled('cari')) {
            $query->where('nama', 'like', '%' . $request->cari . '%');
        }

        $semuaSiswa = $query->orderBy('nama')->paginate(10);
        $daftarKelas = Kelas::orderBy('nama_kelas')->get();

        return view('admin.siswa.index', compact('semuaSiswa', 'daftarKelas'));
    }

    // Menampilkan form tambah siswa
    public function create()
    {
        $daftarKelas = Kelas::orderBy('nama_kelas')->get();
        return view('admin.siswa.create', compact('daftarKelas'));
    }

    // Menyimpan data siswa
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:siswas',
            'telepon' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        Siswa::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil ditambahkan!');
    }

    // Menampilkan form edit siswa
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $daftarKelas = Kelas::orderBy('nama_kelas')->get();

        return view('admin.siswa.edit', compact('siswa', 'daftarKelas'));
    }

    // Memperbarui data siswa
    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:siswas,email,' . $siswa->id,
            'telepon' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $siswa->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    // Menghapus siswa
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil dihapus!');
    }

    public function siswaIndex()
    {
        $users = User::where('role', 'siswa')->orderBy('name', 'asc')->get();
        return view('admin.siswa.index', compact('users'));
    }

}
