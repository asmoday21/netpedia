<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nis', // NIS untuk siswa
        'email',
        'password',
        'role',
        'kelas_id',
        'profile_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function jawabanTugas()
    {
        return $this->hasMany(TugasJawaban::class, 'siswa_id');
    }
    

    public function siswa()
    {
        return $this->hasOne(Siswa::class);
    }
    

     // Relasi untuk siswa
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    // Relasi untuk guru (jika User bisa jadi guru)
    public function tugasDibuat()
    {
        return $this->hasMany(Tugas::class, 'guru_id');
    }

    // Relasi untuk pengumpulan tugas (jika User bisa jadi siswa)
    public function pengumpulanTugas()
    {
        return $this->hasMany(PengumpulanTugas::class, 'siswa_id');
    }
}
