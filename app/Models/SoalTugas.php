<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalTugas extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'soal_tugas'; // Pastikan nama tabel sesuai di database

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tugas_id',
        'pertanyaan',
        'opsi_a',
        'opsi_b',
        'opsi_c',
        'opsi_d',
        'kunci_jawaban',
    ];

    /**
     * Mendefinisikan relasi "belongs to" dengan model Tugas.
     * SoalTugas adalah bagian dari satu Tugas.
     */
    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'tugas_id');
    }
}

