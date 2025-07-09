<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Make sure the User model is imported
use App\Models\Kelas; // <<< Tambahkan ini untuk mengimpor model Kelas
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule; // Tambahkan ini untuk Rule::unique

class UserController extends Controller
{
    /**
     * Display a listing of all users (admin, guru, siswa).
     * This method handles the 'admin.users.index' page.
     */
    public function index()
    {
        // Memuat relasi 'kelas' untuk efisiensi jika nama kelas ditampilkan di tampilan admin.users.index
        $users = User::with('kelas')->orderBy('created_at', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $daftarKelas = Kelas::orderBy('nama_kelas')->get(); // <<< Ambil daftar kelas dari database
        return view('admin.users.create', compact('daftarKelas')); // <<< Kirim daftar kelas ke view
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users',
            'role'       => 'required|in:admin,guru,siswa',
            'password'   => 'required|string|min:6|confirmed',
            // <<< Ubah validasi dari 'class_name' menjadi 'kelas_id'
            'kelas_id'   => 'nullable|exists:kelas,id', // kelas_id boleh kosong, tapi harus ada di tabel kelas jika diisi
        ]);

        $user = User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'role'       => $request->role,
            'password'   => Hash::make($request->password),
            // <<< Simpan nilai kelas_id ke kolom kelas_id di database
            'kelas_id'   => ($request->role === 'siswa' && $request->filled('kelas_id')) ? $request->kelas_id : null,
            // Hapus 'profile_image' jika tidak ada di form atau atur defaultnya di model
            // 'profile_image' => 'default_profile.jpg', // Jika ini juga ada di form
        ]);

        // Optional: pakai Spatie
        // $user->assignRole($request->role);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $daftarKelas = Kelas::orderBy('nama_kelas')->get(); // <<< Ambil daftar kelas dari database
        return view('admin.users.edit', compact('user', 'daftarKelas')); // <<< Kirim daftar kelas ke view
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id), // Abaikan email user yang sedang diedit
            ],
            'role'       => 'required|in:admin,guru,siswa',
            'password'   => 'nullable|string|min:6|confirmed', // Password opsional saat update
            // <<< Ubah validasi dari 'class_name' menjadi 'kelas_id'
            'kelas_id'   => 'nullable|exists:kelas,id', // kelas_id boleh kosong, tapi harus ada di tabel kelas jika diisi
        ]);

        // Perbarui atribut satu per satu, atau siapkan array data yang lengkap
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // <<< Ini adalah baris kunci: Atur kelas_id berdasarkan role yang dipilih
        // Pastikan Anda mendapatkan input 'kelas_id' dari form, bukan 'class_name'
        $user->kelas_id = ($request->role === 'siswa' && $request->filled('kelas_id')) ? $request->kelas_id : null;

        // Simpan semua perubahan ke database
        $user->save(); // Menggunakan save() akan menyimpan semua atribut yang telah diatur

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }


    /**
     * Display a listing of the Guru users.
     * This method handles the 'admin.guru.index' page.
     * @return \Illuminate\Http\Response
     */
    public function guruIndex()
    {
        // Memuat relasi 'kelas' untuk guru (jika guru juga punya kelas, atau untuk filter)
        $users = User::where('role', 'guru')->orderBy('name', 'asc')->get();
        return view('admin.guru.index', compact('users')); // Pass $users to the view
    }

    /**
     * Display a listing of the Siswa users.
     * This method handles the 'admin.siswa.index' page.
     * @return \Illuminate\Http\Response
     */
    public function siswaIndex()
    {
        // Memuat relasi 'kelas' untuk siswa di halaman admin siswa
        $users = User::where('role', 'siswa')->with('kelas')->orderBy('name', 'asc')->get();
        return view('admin.siswa.index', compact('users')); // Pass $users to the view
    }
}
