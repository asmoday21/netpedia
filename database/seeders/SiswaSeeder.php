<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        Siswa::create(['nama' => 'Rifki Fuadi']);
        Siswa::create(['nama' => 'Ari Gunawan']);
        Siswa::create(['nama' => 'Reski Wulandari']);
    }
}

