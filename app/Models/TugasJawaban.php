<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasJawaban extends Model
{
    use HasFactory;

    // Pastikan ini sesuai dengan nama tabel di database
    protected $table = 'pengumpulan_tugas';

    protected $fillable = [
        'tugas_id',
        'siswa_id',
        'file_jawaban',
        'waktu_kumpul',
        'nilai',
        'catatan',
        
    ];

    /**
     * Relasi ke tabel tugas.
     */
    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'tugas_id');
    }

    /**
     * Relasi ke user siswa.
     */
    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }

    /**
     * Jika jawaban memiliki banyak file.
     */
    public function jawabanFiles()
    {
        return $this->hasMany(JawabanFile::class, 'tugas_jawaban_id');
    }
}
