<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Elemen;

class ElemenSeeder extends Seeder
{
    public function run(): void
    {
        Elemen::create(['nama' => 'Media']);
        Elemen::create(['nama' => 'Jaringan Telekomunikasi']);
    }
}

