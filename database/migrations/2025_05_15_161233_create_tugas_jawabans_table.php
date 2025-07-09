<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tugas_jawabans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tugas_id');
            $table->unsignedBigInteger('siswa_id');
            $table->text('jawaban')->nullable(); // Bisa path file atau isi teks
            $table->integer('nilai')->nullable(); // Opsional
            $table->text('catatan')->nullable();  // Opsional
            $table->timestamps();

            // Optional foreign keys
            $table->foreign('tugas_id')->references('id')->on('tugas')->onDelete('cascade');
            $table->foreign('siswa_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('tugas_jawabans');
    }
};
