<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elemen extends Model
{
    use HasFactory;

    protected $table = 'elemen';

    protected $fillable = ['nama'];

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
}
