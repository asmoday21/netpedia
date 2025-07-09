<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// use Illuminate\Support\Facades\Auth; // Dihapus karena Auth tidak bisa digunakan di sini
// use App\Models\Siswa; // Dihapus karena Model tidak bisa digunakan di sini

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique(); // Jika relasi ke user
            $table->string('nama'); // Konsisten menggunakan 'nama'
            $table->string('email')->unique();
            // $table->string('telepon')->nullable(); // Kolom 'telepon' dihapus sesuai permintaan
            $table->string('profile_image')->nullable();
            $table->foreignId('kelas_id')->nullable()->constrained('kelas')->onDelete('set null');
            $table->timestamps();
        });

        // Bagian di bawah ini (logika Auth::user()) harus DIHAPUS dari migrasi.
        // Migrasi hanya bertugas untuk mengubah struktur database.
        // Logika pembuatan data siswa setelah login harus ditempatkan
        // di tempat lain, misalnya di Seeder, atau di Event Listener
        // saat user baru diregistrasi atau login.
        /*
        if (Auth::user()->role == 'siswa') {
            $user = Auth::user();
            if (!$user->siswa) {
                Siswa::create([
                    'user_id' => $user->id,
                    'nama' => $user->name,
                    'email' => $user->email,
                    'telepon' => '', // optional: minta update profil
                    'kelas_id' => null,
                ]);
            }
        }
        */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};

