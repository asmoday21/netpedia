<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // database/migrations/xxxx_create_materis_table.php
        Schema::create('materis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mapel_id')->constrained();
            $table->foreignId('guru_id')->constrained('users');
            $table->string('judul');
            $table->text('deskripsi');
            $table->longText('konten');
            $table->string('video_url')->nullable();
            $table->string('file_path')->nullable();
            $table->integer('durasi');
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materi');
    }
};
