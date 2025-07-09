<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanSoal extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'jawaban_soal'; // Pastikan nama tabel sesuai di database

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tugas_jawaban_id', // ID dari record TugasJawaban utama
        'soal_tugas_id',    // ID dari soal tugas yang dijawab
        'jawaban_siswa',    // Jawaban yang dipilih siswa (misal: 'A', 'B', 'C', 'D')
        'is_correct',       // Boolean: apakah jawaban siswa benar
    ];

    /**
     * Mendefinisikan relasi "belongs to" dengan model TugasJawaban.
     * JawabanSoal adalah bagian dari satu TugasJawaban.
     */
    public function tugasJawaban()
    {
        return $this->belongsTo(TugasJawaban::class, 'tugas_jawaban_id');
    }

    /**
     * Mendefinisikan relasi "belongs to" dengan model SoalTugas.
     * JawabanSoal adalah jawaban untuk satu SoalTugas.
     */
    public function soalTugas()
    {
        return $this->belongsTo(SoalTugas::class, 'soal_tugas_id');
    }
}

