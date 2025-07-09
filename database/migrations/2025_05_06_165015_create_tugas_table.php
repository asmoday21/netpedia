<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->dateTime('batas_pengumpulan')->nullable();
            
            // Kolom 'lampiran' untuk menyimpan path file yang di-hash di storage
            $table->string('lampiran')->nullable();
            // Kolom baru untuk menyimpan nama file asli yang diunggah oleh pengguna
            $table->string('original_filename')->nullable(); 

            // >>> TAMBAHAN: Kolom untuk menyimpan link tugas eksternal <<<
            $table->string('link_tugas')->nullable(); 

            // Relasi ke kelas (foreign key)
            $table->unsignedBigInteger('kelas_id');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');

            // Relasi ke guru (user foreign key)
            $table->unsignedBigInteger('guru_id');
            $table->foreign('guru_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tugas');
    }
}
