<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilai';

    protected $fillable = [
        'user_id',
        'guru_id',
        'materi_id',
        'tugas_id',
        'nilai_angka',
        'file_path',
        'link_eksternal',
        'keterangan',
    ];

    // ========================
    //        RELATIONSHIPS
    // ========================

    /**
     * Relasi ke user (siswa).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke guru (juga dari tabel users).
     */
    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    /**
     * Relasi ke materi (jika nilai terkait materi tertentu).
     */
    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }

    /**
     * Relasi ke tugas (jika nilai dari tugas tertentu).
     */
    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }
    
}
