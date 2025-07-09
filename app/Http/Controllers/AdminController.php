<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Modul;
use App\Models\Guru;
use App\Models\Siswa;

class AdminController extends Controller
{
    
    public function destroy(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            Log::info('User logging out: ' . $user->email);
        } else {
            Log::info('Logout called but no authenticated user found.');
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $cookie = cookie()->forget('remember_web');

        Log::info('User logged out successfully');

        return redirect('/')->withCookie($cookie);
    }

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials, $request->remember)) {
        $user = Auth::user();

        // Tambahkan ini: Auto-entry ke tabel siswa
        if ($user->role === 'siswa' && !$user->siswa) {
            Siswa::create([
                'user_id' => $user->id,
                'nama' => $user->name,
                'email' => $user->email,
            ]);
        }

        return redirect()->intended('/siswa/dashboard');
    } else {
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ]);
    }
}


    public function profile()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view', compact('adminData'));
    }
    public function editprofile()
    {
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('admin.admin_profile_edit', compact('editData'));
    }

    public function filter(Request $request)
    {
        $role = $request->get('role');
        $users = User::when($role, function ($query, $role) {
            return $query->where('role', $role);
        })->get();

        return view('admin.users.index', compact('users'));
    }

    public function storeprofile(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $id = Auth::user()->id;
    $storeData = User::find($id);
    $storeData->name = $request->name;
    $storeData->email = $request->email;

    if ($request->hasFile('profile_image')) {
        $file = $request->file('profile_image');

        // Hapus gambar lama jika ada dan bukan default
        if (!empty($storeData->profile_image)) {
            $oldImagePath = public_path('upload/admin_images/' . $storeData->profile_image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        // Simpan gambar baru
        $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
        $file->move(public_path('upload/admin_images'), $filename);

        $storeData->profile_image = $filename;
    }

    $storeData->save();

    return redirect()->route('admin.profile')->with('success', 'Profil berhasil diperbarui.');
}

public function index()
{
    // Ambil data untuk statistik
    $totalUsers = User::count();
    $totalAdmins = User::where('role', 'admin')->count();
    $totalGurus = User::where('role', 'guru')->count();
    $totalSiswas = User::where('role', 'siswa')->count();

    // Ambil data aktivitas login terakhir
    $lastLogin = Auth::user()->last_login ? \Carbon\Carbon::parse(Auth::user()->last_login)->diffForHumans() : 'Belum ada login';

    return view('admin.dashboard', compact('totalUsers', 'totalAdmins', 'totalGurus', 'totalSiswas', 'lastLogin'));
}

// Menampilkan halaman kelola guru
public function indexGuru()
{
    $gurus = Guru::all();
    return view('admin.guru.index', compact('gurus'));
}

// Menampilkan form tambah guru
public function createGuru()
{
    return view('admin.guru.create');
}

// Menyimpan data guru baru
public function storeGuru(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|unique:gurus',
        'telepon' => 'required',
        'alamat' => 'nullable|string',
    ]);

    Guru::create($request->all());

    return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil ditambahkan!');
}

// Menampilkan form edit guru
public function editGuru($id)
{
    $guru = Guru::findOrFail($id);
    return view('admin.guru.edit', compact('guru'));
}

// Memperbarui data guru
public function updateGuru(Request $request, $id)
{
    $guru = Guru::findOrFail($id);

    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|unique:gurus,email,' . $guru->id,
        'telepon' => 'required',
        'alamat' => 'nullable|string',
    ]);

    $guru->update($request->all());

    return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil diperbarui!');
}

// Menghapus guru
public function destroyGuru($id)
{
    $guru = Guru::findOrFail($id);
    $guru->delete();

    return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil dihapus!');
}


public function indexTJKT1()
{
    $siswa = Siswa::where('kelas', 'TJKT 1')->get();
    return view('admin.siswa.tjkt1', compact('siswa'));
}

public function indexTJKT2()
{
    $siswa = Siswa::where('kelas', 'TJKT 2')->get();
    return view('admin.siswa.tjkt2', compact('siswa'));
}



    public function modul3()
    {
        return view('admin.admin_modul3_view');
        
    }
    public function modul2()
    {
        return view('admin.admin_modul2_view');
        
    }

    public function quiz()
    {
        return view('admin.admin_quiz_view');
    }

    public function adminIndex()
    {
        return view('admin.admin_master'); 
    }

    public function guruIndex()
    {
        return view('guru.guru_master');
    }

    public function siswaIndex()
    {
        return view('siswa.siswa_master');
    }

    public function store(Request $request)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'konten' => 'nullable|string',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'qr_code' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'file_pdf' => 'nullable|mimes:pdf|max:10000',
    ]);

    $modul = new Modul();
    $modul->judul = $request->judul;
    $modul->deskripsi = $request->deskripsi;
    $modul->konten = $request->konten;

    // Upload gambar
    if ($request->hasFile('gambar')) {
        $modul->gambar = $request->file('gambar')->store('modul', 'public');
    }

    // Upload QR code
    if ($request->hasFile('qr_code')) {
        $modul->qr_code = $request->file('qr_code')->store('modul/qr', 'public');
    }

    // Upload file PDF
    if ($request->hasFile('file_pdf')) {
        $modul->file_pdf = $request->file('file_pdf')->store('modul/pdf', 'public');
    }

    $modul->save();

    return redirect()->route('admin.modul')->with('success', 'Modul berhasil ditambahkan.');
}

  
}