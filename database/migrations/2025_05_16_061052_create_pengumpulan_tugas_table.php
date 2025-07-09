<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengumpulan_tugas', function (Blueprint $table) {
            $table->id(); // Primary key auto-increment
            $table->unsignedBigInteger('tugas_id'); // Foreign key ke tabel 'tugas'
            $table->unsignedBigInteger('siswa_id'); // Foreign key ke tabel 'siswas' (siswa)

            // Kolom untuk waktu pengumpulan tugas oleh siswa
            $table->timestamp('waktu_kumpul')->nullable(); // Ditambahkan: Menggunakan waktu_kumpul seperti yang Anda inginkan

            $table->timestamps(); // Kolom created_at dan updated_at

            // Definisi foreign key constraints
            $table->foreign('tugas_id')->references('id')->on('tugas')->onDelete('cascade');
            // PERBAIKAN: Mengubah referensi foreign key dari 'users' ke 'siswas'
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengumpulan_tugas');
    }
};
