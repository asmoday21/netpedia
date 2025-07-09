<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Guru',
                'email' => 'guru@gmail.com',
                'role' => 'guru',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Siswa',
                'email' => 'siswa@gmail.com',
                'role' => 'siswa',
                'password' => bcrypt('123456'),
            ],
        ];

        foreach ($userData as $val) {
            User::updateOrCreate(
                ['email' => $val['email']],  // Cari berdasarkan email
                [
                    'name' => $val['name'],
                    'role' => $val['role'],
                    'password' => $val['password'],
                ]
            );
        }
    }
}
