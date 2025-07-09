<?php

namespace App\Http\Controllers\Guru; // Perhatikan namespace diubah ke Guru

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Import model User
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan user yang sedang login

class KelasController extends Controller
{
    /**
     * Tampilkan daftar siswa untuk kelas yang diajar oleh guru yang sedang login.
     * Metode ini bisa digunakan untuk berbagai kelas TJKT.
     *
     * @param string $className Contoh: 'X TJKT 1' atau 'X TJKT 2'
     * @return \Illuminate\View\View
     */
    public function showClassStudents($className)
    {
        // Mendapatkan ID guru yang sedang login
        $teacherId = Auth::id();

        // Anda perlu memastikan bahwa ada relasi atau cara untuk
        // mengetahui kelas mana yang diajar oleh guru ini.
        // Untuk contoh ini, kita asumsikan guru memiliki kolom 'teaching_class'
        // atau ada tabel pivot yang menghubungkan guru dengan kelas.
        // Jika tidak, Anda perlu menyesuaikan logika ini.

        // Logika dasar: Ambil siswa dari kelas tertentu.
        // Untuk skenario guru, Anda mungkin ingin memverifikasi
        // bahwa guru ini memang mengajar kelas tersebut.
        // Untuk kesederhanaan, contoh ini hanya menampilkan siswa berdasarkan $className.

        $students = User::where('role', 'siswa')
                        ->where('class_name', $className)
                        ->orderBy('name', 'asc')
                        ->get();

        // Anda bisa menambahkan logika otorisasi di sini,
        // misalnya memeriksa apakah guru yang login berhak melihat kelas ini.
        // Contoh: if (Auth::user()->canTeachClass($className)) { ... }

        // Tentukan nama view berdasarkan nama kelas, misalnya 'guru.kelas.x_tjkt_1'
        $viewName = 'guru.kelas.' . strtolower(str_replace(' ', '_', $className));
        // Ganti ' ' dengan '_' dan ubah menjadi huruf kecil untuk nama view
        // Contoh: 'X TJKT 1' menjadi 'x_tjkt_1'

        return view($viewName, compact('students', 'className'));
    }

    /**
     * Shortcut untuk menampilkan daftar siswa Kelas X TJKT 1.
     */
    public function tjkt1()
    {
        return $this->showClassStudents('X TJKT 1');
    }

    /**
     * Shortcut untuk menampilkan daftar siswa Kelas X TJKT 2.
     */
    public function tjkt2()
    {
        return $this->showClassStudents('X TJKT 2');
    }

    // Anda bisa menambahkan method shortcut lain untuk kelas-kelas lainnya
}