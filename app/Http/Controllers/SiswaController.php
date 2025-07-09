<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Kelas;

class SiswaController extends Controller
{
    public function viewProfile()
    {
        return view('siswa.siswa_profile'); // pastikan nama Blade file sesuai
    }

    
    // Tampilkan form edit profil lengkap dengan data kelas
public function editProfile()
{
    $user = auth()->user();

    // Ambil semua kelas dari DB
    $allKelas = \App\Models\Kelas::all();

    return view('siswa.siswa_edit_profile', [
        'editData' => $user,
        'allKelas' => $allKelas,
    ]);
}


    // Simpan perubahan profil siswa
    public function storeProfile(Request $request)
    {
        $user = User::find(Auth::id());

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'nullable|string|max:20|unique:users,nis,' . $user->id, // Validasi NIS unik
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user->name = $validated['name'];
        $user->nis = $request->input('nis'); // Simpan NIS jika ada
        $user->email = $validated['email'];

        if ($request->file('profile_image')) {
            $file = $request->file('profile_image');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/siswa_images'), $filename);

            // Hapus gambar lama jika ada
            if ($user->profile_image && file_exists(public_path('upload/siswa_images/' . $user->profile_image))) {
                unlink(public_path('upload/siswa_images/' . $user->profile_image));
            }

            $user->profile_image = $filename;
        }

        $user->save();

        return redirect()->route('siswa.siswa_profile')->with('success', 'Profil berhasil diperbarui!');    
    }

    // Logout siswa
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    

    public function modul()
    {
        return view('siswa.siswa_modul_view'); // Pastikan view ini ada
    }
   
    
    public function modul3()
    {
        return view('siswa.siswa_modul3_view');
        
    }
    public function modul2()
    {
        return view('siswa.siswa_modul2_view');
        
    }

    public function quiz()
    {
        return view('siswa.siswa_quiz_view'); // Pastikan view ini ada
    }
    
    public function lihatDataSiswa()
    {
        $user = Auth::user();
        return view('siswa.lihat_data', [
            'siswa' => $user,
            'kelas' => $user->kelas,
        ]);

    }

    public function semuaSiswa(Request $request)
    {
        // Ambil daftar kelas untuk dropdown filter
        $daftarKelas = \App\Models\Kelas::orderBy('nama_kelas')->get();

        // Ambil semua siswa dengan relasi kelas
        $query = \App\Models\User::where('role', 'siswa')->with('kelas');

        // Filter berdasarkan pencarian nama
        if ($request->filled('cari')) {
            $query->where('name', 'like', '%' . $request->cari . '%');
        }

        // Filter berdasarkan kelas
        if ($request->filled('kelas')) {
            $query->where('kelas_id', $request->kelas);
        }

        $semuaSiswa = $query->orderBy('name')->paginate(10);

        // Kirim data ke view
        return view('siswa.semua_siswa', compact('semuaSiswa', 'daftarKelas'));
    }


    public function register(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
    ]);

    // Buat akun user
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 'siswa', // atau gunakan spatie role
    ]);

    // Buat data siswa
    Siswa::create([
        'user_id' => $user->id,
        'nama' => $request->name,
        'email' => $request->email,
    ]);

    Auth::login($user);
    return redirect()->route('siswa.siswa_master')->with('success', 'Registrasi berhasil! Selamat datang, ' . $user->name);
    // Redirect ke halaman yang sesuai
}


}
