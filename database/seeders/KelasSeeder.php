<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    public function run()
    {
        DB::table('kelas')->insert([
            ['nama_kelas' => 'X TJKT 1'],
            ['nama_kelas' => 'X TJKT 2'],
        ]);
    }
}

