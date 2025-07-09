<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth; // Digunakan untuk relasi yang berhubungan dengan user yang login
use Carbon\Carbon; // Digunakan untuk manipulasi tanggal

class Tugas extends Model
{
    use HasFactory;
    
    // Nama tabel yang terkait dengan model ini. Defaultnya adalah bentuk plural dari nama model ('tugas').
    protected $table = 'tugas';

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     * Pastikan semua kolom yang akan diisi dari request ada di sini.
     * 'original_filename' ditambahkan untuk menyimpan nama file asli.
     * 'nilai' dan 'catatan' dihapus karena ini umumnya atribut dari 'TugasJawaban', bukan 'Tugas'.
     */
    protected $fillable = [
        'judul',
        'deskripsi',
        'batas_pengumpulan',
        'urutan', // Asumsi 'urutan' adalah properti tugas itu sendiri
        'kelas_id',
        'guru_id',
        'materi', // Asumsi 'materi' adalah properti tugas itu sendiri
        'lampiran', // Tambahkan kolom lampiran
        'original_filename', // Tambahkan kolom untuk nama file asli
        'link_tugas', // Tambahkan kolom untuk link tugas eksternal
    ];

    /**
     * Mengatur casting untuk atribut tanggal agar secara otomatis menjadi instance Carbon.
     * Ini lebih disukai daripada `$dates` di Laravel versi modern (7+).
     */
    protected $casts = [
        'batas_pengumpulan' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relasi Model
    |--------------------------------------------------------------------------
    */

    /**
     * Relasi dengan model Kelas (many-to-one).
     * Sebuah Tugas dimiliki oleh satu Kelas.
     */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    /**
     * Relasi dengan model User (guru) (many-to-one).
     * Sebuah Tugas dibuat oleh satu Guru.
     */
    public function guru()
    {
        // Asumsi model User adalah representasi dari guru
        return $this->belongsTo(User::class, 'guru_id');
    }

    /**
     * Relasi dengan model TugasJawaban (one-to-many).
     * Sebuah Tugas dapat memiliki banyak Jawaban Tugas dari siswa.
     * Nama method 'jawabanTugas' lebih deskriptif.
     */
    public function jawabanTugas()
    {
        return $this->hasMany(TugasJawaban::class);
    }

    /**
     * Relasi dengan model TugasJawaban (one-to-one), khusus untuk jawaban dari siswa yang sedang login.
     * Berguna untuk mengecek apakah siswa saat ini sudah mengumpulkan tugas ini.
     */
    public function jawabanSiswa()
    {
        // Menggunakan nama method yang lebih spesifik jika ingin membedakan dari jawabanTugas()
        // Misalnya, jika Anda punya relasi lain bernama 'jawaban()', Anda bisa mempertahankan ini.
        // Atau gabungkan logika ini ke 'jawabanTugas' dengan filter di controller.
        return $this->hasOne(TugasJawaban::class)->where('siswa_id', Auth::id());
    }

    /**
     * Relasi dengan model PengumpulanTugas (one-to-many).
     * Pastikan model PengumpulanTugas ada dan relevan.
     */
    public function pengumpulan()
    {
        return $this->hasMany(PengumpulanTugas::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Aksesor & Mutator
    |--------------------------------------------------------------------------
    */

    /**
     * Aksesor untuk mendapatkan format tanggal 'batas_pengumpulan' yang diformat.
     * Menggunakan timezone Asia/Jakarta untuk konsistensi.
     */
    public function getBatasPengumpulanFormattedAttribute()
    {
        return Carbon::parse($this->batas_pengumpulan)
                     ->timezone('Asia/Jakarta')
                     ->translatedFormat('d M Y, H:i');
    }
}
