<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanFile extends Model
{
    use HasFactory;

    protected $table = 'jawaban_files'; // Pastikan ini sesuai dengan nama tabel Anda

    protected $fillable = [
        'tugas_jawaban_id',
        'file_path',
        'original_name',
    ];

    public function tugasJawaban()
    {
        return $this->belongsTo(TugasJawaban::class, 'tugas_jawaban_id');
    }
}