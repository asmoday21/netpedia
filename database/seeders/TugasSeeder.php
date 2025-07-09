<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tugas;
use Illuminate\Support\Carbon;

class TugasSeeder extends Seeder
{
    public function run(): void
    {
        Tugas::create([
            'judul' => 'Tugas 1 - Pemrograman',
            'deskripsi' => 'Buat program kalkulator sederhana.',
            'deadline' => Carbon::now()->addDays(5),
        ]);

        Tugas::create([
            'judul' => 'Tugas 2 - Jaringan',
            'deskripsi' => 'Gambarkan topologi jaringan dan jelaskan fungsinya.',
            'deadline' => Carbon::now()->addDays(7),
        ]);

        Tugas::create([
            'judul' => 'Tugas 3 - Multimedia',
            'deskripsi' => 'Buat presentasi video animasi berdurasi 1 menit.',
            'deadline' => Carbon::now()->addDays(10),
        ]);
    }
}

