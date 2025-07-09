<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Digunakan untuk data guru yang login
use App\Models\Siswa; // Digunakan untuk data siswa
use App\Models\Nilai;
use App\Models\Tugas;
use App\Models\Materi;
use App\Models\Ujian;
use App\Models\Kelas; // Digunakan untuk data kelas

// Pastikan model Soal sudah ada, jika belum, buat dengan perintah artisan:
// php artisan make:model Soal
use App\Models\Soal;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    // Metode index dari pembahasan sebelumnya (untuk menampilkan siswa yang diajar guru berdasarkan User model)
    // Jika Anda ingin menggunakan ini, pastikan siswa juga terdaftar di model User dengan class_name yang sesuai.
    // Jika tidak, metode siswaIndex di bawah akan menjadi yang utama.
    /*
    public function index()
    {
        $guru = Auth::user();

        if ($guru->role !== 'guru' || empty($guru->teaching_classes)) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman ini atau belum mengajar kelas.');
        }

        $teachingClasses = $guru->teaching_classes;

        $students = User::where('role', 'siswa')
                        ->whereIn('class_name', $teachingClasses)
                        ->orderBy('name', 'asc')
                        ->get();

        return view('guru.students.index', compact('students', 'guru'));
    }
    */

    /**
     * Menampilkan daftar siswa yang diajar oleh guru yang sedang login,
     * dengan mempertimbangkan filter pencarian dan kelas.
     * Menggunakan model Siswa dan Kelas.
     */
    public function siswaIndex(Request $request)
    {
        $guru = Auth::user();

        // Pastikan guru memiliki kelas yang diajarkan.
        // teaching_classes seharusnya sudah di-cast ke array di model User.
        $teachingClassesNames = $guru->teaching_classes;

        // Jika guru tidak mengajar kelas apapun atau teaching_classes null/tidak valid
        if (empty($teachingClassesNames) || !is_array($teachingClassesNames)) {
            // Kembalikan koleksi siswa kosong dan daftar kelas kosong untuk dropdown
            $semuaSiswa = (new Siswa())->newCollection();
            $daftarKelas = (new Kelas())->newCollection();
            return view('guru.siswa.index', compact('semuaSiswa', 'daftarKelas'));
        }

        // Ambil ID kelas dari nama kelas yang diajarkan oleh guru
        // Asumsikan tabel 'kelas' memiliki kolom 'nama' yang sesuai dengan string di teaching_classes
        $teachingKelasIds = Kelas::whereIn('nama', $teachingClassesNames)->pluck('id')->toArray();

        // Jika tidak ada ID kelas yang ditemukan (misalnya, nama kelas di teaching_classes tidak cocok di tabel kelas)
        if (empty($teachingKelasIds)) {
            $semuaSiswa = (new Siswa())->newCollection(); // Koleksi kosong
            $daftarKelas = (new Kelas())->newCollection();
            return view('guru.siswa.index', compact('semuaSiswa', 'daftarKelas'));
        }

        // Query dasar untuk siswa yang diajar oleh guru ini
        $query = Siswa::with('kelas')
                      ->whereIn('kelas_id', $teachingKelasIds); // Filter siswa berdasarkan kelas yang diajar guru

        // --- Filter Tambahan dari Request ---
        // Filter nama
        if ($request->filled('cari')) {
            $query->where('nama', 'like', '%' . $request->cari . '%');
        }

        // Filter kelas_id dari request (jika guru memilih filter spesifik dari dropdown)
        if ($request->filled('kelas')) {
            $requestedKelasId = $request->kelas;
            // Penting: Pastikan kelas yang difilter oleh request juga termasuk dalam kelas yang diajar guru
            if (in_array($requestedKelasId, $teachingKelasIds)) {
                 $query->where('kelas_id', $requestedKelasId);
            } else {
                // Opsi: Jika guru mencoba memfilter kelas yang tidak diajarkannya,
                // bisa abaikan filter ini atau berikan pesan error.
                // Untuk saat ini, kita akan mengabaikan filter yang tidak valid.
                // Anda bisa menambahkan: return redirect()->back()->with('error', 'Anda tidak mengajar kelas tersebut.');
            }
        }

        $semuaSiswa = $query->paginate(10);

        // Hanya tampilkan kelas yang diajar guru di dropdown filter
        $daftarKelas = Kelas::whereIn('id', $teachingKelasIds)->get();

        return view('guru.siswa.index', compact('semuaSiswa', 'daftarKelas'));
    }


    public function siswaCreate()
    {
        // Pastikan guru hanya bisa membuat siswa untuk kelas yang diajarkannya
        $guru = Auth::user();
        $teachingClassesNames = $guru->teaching_classes;
        $teachingKelasIds = empty($teachingClassesNames) ? [] : Kelas::whereIn('nama', $teachingClassesNames)->pluck('id')->toArray();
        $kelasList = Kelas::whereIn('id', $teachingKelasIds)->get();

        return view('guru.siswa.create', compact('kelasList'));
    }

    public function siswaStore(Request $request)
    {
        $guru = Auth::user();
        $teachingClassesNames = $guru->teaching_classes;
        $teachingKelasIds = empty($teachingClassesNames) ? [] : Kelas::whereIn('nama', $teachingClassesNames)->pluck('id')->toArray();

        // Validasi data input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:siswas',
            'telepon' => 'required',
            // Validasi kelas_id: harus ada di tabel kelas dan termasuk dalam kelas yang diajar guru
            'kelas_id' => ['required', 'exists:kelas,id', function ($attribute, $value, $fail) use ($teachingKelasIds) {
                if (!in_array($value, $teachingKelasIds)) {
                    $fail('Kelas yang dipilih tidak termasuk dalam kelas yang Anda ajarkan.');
                }
            }],
        ]);

        // Simpan data siswa ke database
        Siswa::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'kelas_id' => $request->kelas_id,
            // Tambahkan field lain jika ada di model Siswa Anda
        ]);

        return redirect()->route('guru.siswa.index')->with('success', 'Siswa berhasil ditambahkan!');
    }

    public function siswaEdit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $guru = Auth::user();
        $teachingClassesNames = $guru->teaching_classes;
        $teachingKelasIds = empty($teachingClassesNames) ? [] : Kelas::whereIn('nama', $teachingClassesNames)->pluck('id')->toArray();
        $kelasList = Kelas::whereIn('id', $teachingKelasIds)->get();

        // Pastikan guru hanya bisa mengedit siswa dari kelas yang diajarkannya
        if (!in_array($siswa->kelas_id, $teachingKelasIds)) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengedit siswa dari kelas ini.');
        }

        return view('guru.siswa.edit', compact('siswa', 'kelasList'));
    }

    public function siswaUpdate(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);
        $guru = Auth::user();
        $teachingClassesNames = $guru->teaching_classes;
        $teachingKelasIds = empty($teachingClassesNames) ? [] : Kelas::whereIn('nama', $teachingClassesNames)->pluck('id')->toArray();

        // Validasi data input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:siswas,email,' . $id,
            'telepon' => 'required',
            // Validasi kelas_id: harus ada di tabel kelas dan termasuk dalam kelas yang diajar guru
            'kelas_id' => ['required', 'exists:kelas,id', function ($attribute, $value, $fail) use ($teachingKelasIds) {
                if (!in_array($value, $teachingKelasIds)) {
                    $fail('Kelas yang dipilih tidak termasuk dalam kelas yang Anda ajarkan.');
                }
            }],
        ]);

        // Pastikan guru hanya bisa mengupdate siswa dari kelas yang diajarkannya
        if (!in_array($siswa->kelas_id, $teachingKelasIds) && !in_array($request->kelas_id, $teachingKelasIds)) {
             return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengupdate siswa ini atau memindahkannya ke kelas yang tidak Anda ajarkan.');
        }

        // Update data siswa
        $siswa->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()->route('guru.siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
    }


    public function siswaDestroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $guru = Auth::user();
        $teachingClassesNames = $guru->teaching_classes;
        $teachingKelasIds = empty($teachingClassesNames) ? [] : Kelas::whereIn('nama', $teachingClassesNames)->pluck('id')->toArray();

        // Pastikan guru hanya bisa menghapus siswa dari kelas yang diajarkannya
        if (!in_array($siswa->kelas_id, $teachingKelasIds)) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus siswa dari kelas ini.');
        }

        // Hapus data siswa
        $siswa->delete();

        return redirect()->route('guru.siswa.index')->with('success', 'Siswa berhasil dihapus!');
    }


    public function Profile()
    {
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('guru.guru_profile', compact('editData'));
    }

    public function EditProfile()
    {
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('guru.guru_edit_profile', compact('editData'));
    }

    public function StoreProfile(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->name = $request->name;
        $data->email = $request->email;

        if ($request->file('profile_image')) {
            $file = $request->file('profile_image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/guru_images'), $filename);
            $data->profile_image = $filename;
        }

        $data->save();

        return redirect()->route('guru.profile')->with('success', 'Profil berhasil diperbarui!');
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function update(Request $request, $id) // Ini mungkin metode untuk update Tugas, hati-hati dengan nama
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'deadline' => 'required|date|after_or_equal:today',
        ]);

        $tugas = Tugas::findOrFail($id);
        $tugas->update($request->all());

        return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil diperbarui!');
    }

    public function uploadMateri(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'nullable|string',
            'file' => 'nullable|file|max:10240',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('materi_files', 'public');
        }

        Materi::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'file' => $filePath,
            'guru_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Materi berhasil diunggah.');
    }

    public function laporanNilai()
    {
        $nilai = \App\Models\Nilai::with('siswa', 'tugas')->get();
        return view('guru.laporan.index', compact('nilai'));
    }


    public function kelolaSiswa() // Metode ini tampaknya duplikat dari siswaIndex
    {
        // Sebaiknya arahkan ke siswaIndex atau hapus jika tidak digunakan
        return $this->siswaIndex(request());
    }

    // Metode store dan create berikut tampaknya duplikat atau tidak lengkap,
    // karena Anda sudah punya siswaStore dan siswaCreate di atas.
    // Pastikan Anda menggunakan hanya satu set metode untuk manajemen siswa.
    /*
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email', // Ini memvalidasi di tabel users
            'telepon'  => 'required|string|min:8|max:20',
            'kelas'    => 'required|exists:kelas,id',
        ]);

        User::create([ // Ini membuat User, bukan Siswa
            'nama'     => $validated['nama'],
            'email'    => $validated['email'],
            'telepon'  => $validated['telepon'],
            'kelas'    => $validated['kelas'],
            'role'     => 'siswa',
            'password' => Hash::make('password123'),
        ]);

        return redirect()->route('guru.siswa.index')->with('success', 'Siswa berhasil ditambahkan!');
    }

    public function create() // Ini juga tampaknya duplikat dari siswaCreate
    {
        $kelasList = Kelas::all();
        return view('guru.siswa.create', compact('kelasList'));
    }

    public function edit($id) // Ini juga tampaknya duplikat dari siswaEdit
    {
        $siswa = User::findOrFail($id); // Ini mencari User, bukan Siswa
        $kelasList = Kelas::all();
        return view('guru.siswa.edit', compact('siswa', 'kelasList'));
    }
    */
}
