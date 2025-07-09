<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabanFilesTable extends Migration
{
    public function up(): void
    {
        Schema::create('jawaban_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tugas_jawaban_id')->constrained('pengumpulan_tugas')->onDelete('cascade');
            $table->string('file_path');
            $table->string('original_name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jawaban_files');
    }
}
