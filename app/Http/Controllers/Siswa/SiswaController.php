<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Materi;
use App\Models\Tugas;
use App\Models\PengumpulanTugas;

class SiswaController extends Controller
{
    // Dashboard Siswa: menampilkan daftar materi terbaru
    public function index()
    {
        $materi = Materi::latest()->paginate(10);
        return view('siswa.siswa_master', compact('materi'));
    }

    // Tampilkan profil siswa
    public function profile()
    {
        return view('siswa.profile');
    }

    // Form edit profil siswa
    public function editProfile()
    {
        $editData = Auth::user();
        $allKelas = Kelas::orderBy('nama')->get();
        return view('siswa.siswa_edit_profile', compact('editData', 'allKelas'));
    }

    // Simpan perubahan profil siswa
    public function storeProfile(Request $request)
    {
        $user = User::find(Auth::id());

        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|max:255|unique:users,email,' . $user->id,
            'kelas_id'       => 'required|exists:kelas,id',
            'profile_image'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->kelas_id = $validated['kelas_id'];

        // Handle upload foto profil baru
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/siswa_images'), $filename);

            // Hapus file lama jika ada
            if ($user->profile_image && file_exists(public_path('upload/siswa_images/' . $user->profile_image))) {
                unlink(public_path('upload/siswa_images/' . $user->profile_image));
            }

            $user->profile_image = $filename;
        }

        $user->save();

        return redirect()->route('siswa.profile')->with('success', 'Profil berhasil diperbarui.');
    }

    // Halaman nilai (jika pakai view statis atau nanti dikembangkan)
    public function nilai()
    {
        return view('siswa.nilai');
    }

    // Logout siswa
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    // Tampilkan daftar tugas
    public function tugasIndex()
    {
        $tugas = Tugas::where('batas_pengumpulan', '>=', now())
                      ->orderBy('batas_pengumpulan', 'asc')
                      ->paginate(10);

        return view('siswa.tugas.index', compact('tugas'));
    }

    // Upload jawaban siswa ke tugas tertentu
    public function uploadJawaban(Request $request, $id)
    {
        $request->validate([
            'file_jawaban' => 'required|file|mimes:pdf,docx,zip|max:10240'
        ]);

        $path = $request->file('file_jawaban')->store('jawaban', 'public');

        PengumpulanTugas::updateOrCreate(
            ['siswa_id' => auth()->id(), 'tugas_id' => $id],
            [
                'file_jawaban' => $path,
                'waktu_pengumpulan' => now()
            ]
        );

        return back()->with('success', 'Jawaban berhasil diunggah.');
    }

    // Lihat data siswa (readonly)
    public function lihatDataSiswa()
    {
        $user = Auth::user();
        return view('siswa.lihat_data', [
            'siswa' => $user,
            'kelas' => $user->kelas,
        ]);
    }
}
