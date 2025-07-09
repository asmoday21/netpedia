<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Siswa turunan User untuk autentikasi
use Illuminate\Notifications\Notifiable;

class Siswa extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'siswas'; // Tabel yang sesuai

    protected $fillable = [
        'user_id', 
        'nama', 
        'nis',
        'email', 
        'profile_image', 
        'kelas_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relasi ke pengumpulan tugas
    public function pengumpulanTugas()
    {
        return $this->hasMany(PengumpulanTugas::class);
    }

    // Relasi ke kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    // Relasi ke user (karena ini extend Authenticatable)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

