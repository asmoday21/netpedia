<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengumpulanTugas extends Model
{
    use HasFactory;

    protected $table = 'pengumpulan_tugas';

    protected $fillable = [
        'tugas_id',
        'siswa_id',
        'file_jawaban',
        'waktu_kumpul',
        'nilai',
        'catatan', // Menambahkan kembali kolom catatan siswa
        'catatan_guru',
    ];

    protected $casts = [
        'file_jawaban' => 'array',
        'waktu_kumpul' => 'datetime',
    ];

    // Relasi ke tugas
    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }
    // Relasi ke siswa
    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }
}
