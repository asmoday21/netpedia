<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'embed_link',
        'kategori',
        'gambar',
        'file_pdf',
        'youtube_title',
        'youtube_thumbnail',
    ];
}

