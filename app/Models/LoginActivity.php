<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginActivity extends Model
{
    use HasFactory;

    // Nama tabel jika tidak sesuai konvensi plural dari model
    // protected $table = 'login_activities';

    // Kolom yang boleh diisi massal
    protected $fillable = [
        'user_id',    // id user yang login
        'role',       // role user, misal: 'guru', 'siswa', 'admin'
        'ip_address', // opsional, menyimpan IP login
        'user_agent', // opsional, info browser/device
        'created_at', // otomatis pakai timestamps Laravel
        'updated_at',
    ];

    // Jika kamu ingin menggunakan timestamps otomatis Laravel
    public $timestamps = true;

    /**
     * Relasi ke model User (jika ada)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
