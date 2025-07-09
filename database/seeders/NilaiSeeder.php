<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nilai;

class NilaiSeeder extends Seeder
{
    public function run(): void
    {
        Nilai::create([
            'siswa_id' => 1,
            'elemen_id' => 1,
            'nilai' => 85,
        ]);

        Nilai::create([
            'siswa_id' => 2,
            'elemen_id' => 1,
            'nilai' => 90,
        ]);

        Nilai::create([
            'siswa_id' => 3,
            'elemen_id' => 2,
            'nilai' => 88,
        ]);
    }
}
