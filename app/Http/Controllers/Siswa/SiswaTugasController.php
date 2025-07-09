<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tugas; // Memastikan model Tugas diimport
use App\Models\PengumpulanTugas; // Menggunakan model PengumpulanTugas
use Illuminate\Support\Facades\Auth; // Menggunakan facade Auth untuk mendapatkan ID siswa yang login
use Illuminate\Support\Facades\Storage; // Untuk mengelola file lampiran/jawaban
use Carbon\Carbon; // Untuk manipulasi tanggal dan waktu

class SiswaTugasController extends Controller
{
    /**
     * Menampilkan daftar tugas yang tersedia untuk siswa.
     * Tugas yang dibuat oleh guru akan muncul di sini.
     */
    public function index()
    {
        // Mengambil semua tugas yang dibuat oleh guru (karena tidak ada filter kelas di GuruTugasController)
        // dan mengurutkannya berdasarkan batas pengumpulan terbaru.
        $tugas = Tugas::orderBy('batas_pengumpulan', 'desc')->paginate(10);

        // Untuk akurasi statistik, lebih baik hitung dari query tanpa paginasi, lalu paginasi untuk tampilan
        $allTugas = Tugas::orderBy('batas_pengumpulan', 'desc')->get();

        $aktiveTugas = $allTugas->filter(function($item) {
            return !Carbon::parse($item->batas_pengumpulan)->isPast();
        })->count();

        $kedaluwarsaTugas = $allTugas->filter(function($item) {
            return Carbon::parse($item->batas_pengumpulan)->isPast();
        })->count();

        // Untuk menghitung tugas dengan link saja
        $tugasWithLinks = $allTugas->filter(function($item) {
            return !empty($item->link_tugas);
        })->count();

        // Mengirimkan data tugas yang sudah dipaginasi dan statistik ke view
        return view('siswa.tugas.index', compact('tugas', 'aktiveTugas', 'kedaluwarsaTugas', 'tugasWithLinks'));
    }

    /**
     * Menampilkan detail tugas tertentu.
     * Siswa dapat melihat instruksi lengkap dan status jawaban mereka.
     *
     * @param int $id ID tugas
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Mencari tugas berdasarkan ID, jika tidak ditemukan akan menghasilkan 404
        $tugas = Tugas::findOrFail($id);

        // Mencari apakah siswa yang sedang login sudah pernah mengirimkan jawaban untuk tugas ini.
        // Ini akan digunakan untuk menampilkan formulir jawaban atau status jawaban.
        $jawaban = PengumpulanTugas::where('tugas_id', $id)
                               ->where('siswa_id', Auth::id())
                               ->first();

        return view('siswa.tugas.show', compact('tugas', 'jawaban'));
    }

    /**
     * Menampilkan formulir untuk mengirimkan atau memperbarui jawaban tugas.
     *
     * @param int $id ID tugas
     * @return \Illuminate\View\View
     */
    public function formJawaban($id)
    {
        // Mencari tugas yang akan dijawab
        $tugas = Tugas::findOrFail($id);

        // Memeriksa apakah siswa sudah memiliki jawaban untuk tugas ini
        $jawaban = PengumpulanTugas::where('tugas_id', $id)
                               ->where('siswa_id', Auth::id())
                               ->first();

        return view('siswa.tugas.form', compact('tugas', 'jawaban'));
    }

    /**
     * Menyimpan atau memperbarui jawaban tugas yang dikirimkan oleh siswa.
     *
     * @param \Illuminate\Http\Request $request Data dari form jawaban
     * @param int $id ID tugas
     * @return \Illuminate\Http\RedirectResponse
     */
    public function kirimJawaban(Request $request, $id)
    {
        // Mencari tugas yang sedang dijawab
        $tugas = Tugas::findOrFail($id);
        $siswaId = Auth::id(); // Mendapatkan ID siswa yang sedang login

        // Validasi input dari form jawaban: hanya catatan yang valid
        $request->validate([
            'catatan' => 'nullable|string|max:1000', // Catatan opsional dari siswa
        ]);

        // Mencari apakah siswa sudah pernah mengirimkan jawaban untuk tugas ini
        $jawaban = PengumpulanTugas::where('siswa_id', $siswaId)->where('tugas_id', $id)->first();

        // Karena file jawaban tidak lagi diunggah, file_jawaban akan selalu null
        $fileJawaban = null;

        // Jika siswa sudah memiliki jawaban, perbarui jawaban tersebut
        if ($jawaban) {
            $jawaban->update([
                'file_jawaban' => $fileJawaban, // Pastikan ini selalu null
                'catatan' => $request->catatan,
                'waktu_kumpul' => Carbon::now(), // Menggunakan waktu_kumpul
            ]);
        } else {
            // Jika siswa belum memiliki jawaban, buat jawaban baru
            PengumpulanTugas::create([
                'siswa_id' => $siswaId,
                'tugas_id' => $id,
                'file_jawaban' => $fileJawaban, // Pastikan ini selalu null
                'catatan' => $request->catatan,
                'waktu_kumpul' => Carbon::now(), // Menggunakan waktu_kumpul
            ]);
        }

        // Redirect kembali ke halaman detail tugas dengan pesan sukses
        return redirect()->route('siswa.tugas.show', $id)->with('success', 'Jawaban berhasil dikirim!');
    }

    /**
     * Menampilkan daftar nilai tugas siswa.
     * Ini sesuai dengan `nilaiSiswa()` di GuruTugasController, tetapi di sini untuk siswa itu sendiri.
     *
     * @return \Illuminate\View\View
     */
    public function indexNilai()
    {
        // Mengambil semua jawaban tugas yang sudah dinilai (atau belum, tergantung kebutuhan UI)
        // dari siswa yang sedang login.
        // Memuat relasi 'tugas' agar bisa menampilkan detail tugas.
        $jawaban = PengumpulanTugas::with('tugas')
            ->where('siswa_id', Auth::id())
            ->orderBy('waktu_kumpul', 'desc') // Menggunakan waktu_kumpul
            ->get();

        return view('siswa.nilai.index', compact('jawaban'));
    }
}