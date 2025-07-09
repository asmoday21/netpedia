<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;

class SiswaGuruController extends Controller
{
    public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'nama' => 'required|string|max:100',
        'email' => 'required|email|unique:siswas,email,' . $id,
        'telepon' => 'required|string|max:15',
        'kelas_id' => 'required|exists:kelas,id',
    ]);

    // Temukan siswa
    $siswa = Siswa::findOrFail($id);

    // Update data
    $siswa->update([
        'nama' => $request->nama,
        'email' => $request->email,
        'telepon' => $request->telepon,
        'kelas_id' => $request->kelas_id,
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('guru.siswa.index')
                     ->with('success', 'Data siswa berhasil diperbarui.');
}
}
