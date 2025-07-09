<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'mapel'; // Nama tabel di database

    // Relasi dengan nilai
    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
}

class Tugas extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'deskripsi', 'tanggal_pengumpulan'];
}
