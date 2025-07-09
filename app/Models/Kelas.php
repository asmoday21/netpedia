<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas'; // Tetap dipertahankan untuk kejelasan

    protected $fillable = [
        'nama_kelas',
        // Tambahkan field lain jika ada, seperti:
        // 'tingkat_kelas', 'jurusan', 'tahun_ajaran', dll
    ];

    /**
     * Relasi ke model User untuk siswa
     * Menggunakan type-hinting HasMany untuk better IDE support
     */
    public function siswas(): HasMany
    {
        return $this->hasMany(User::class, 'kelas_id')
            ->where('usertype', 'siswa'); // Filter hanya siswa
    }

    /**
     * Scope untuk query yang sering digunakan
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif'); // Contoh jika ada field status
    }

    /**
     * Accessor untuk nama kelas formal
     */
    public function getNamaFormalAttribute()
    {
        return "Kelas {$this->nama_kelas}";
    }

    /**
     * Mutator untuk memastikan format nama kelas konsisten
     */
    public function setNamaKelasAttribute($value)
    {
        $this->attributes['nama_kelas'] = ucwords(strtolower($value));
    }
}