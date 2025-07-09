<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiTable extends Migration
{
    public function up()
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade'); // siswa

            $table->foreignId('guru_id')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null'); // guru pemberi nilai

            $table->foreignId('materi_id')
                  ->nullable()
                  ->constrained('materi')
                  ->onDelete('set null');

            $table->foreignId('tugas_id')
                  ->nullable()
                  ->constrained('tugas')
                  ->onDelete('set null');

            $table->decimal('nilai_angka', 5, 2)->nullable(); // renamed dari 'nilai' → 'nilai_angka'
            $table->text('keterangan')->nullable();
            $table->string('link_eksternal')->nullable();

            $table->timestamps();

            $table->index(['user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('nilai');
    }
}
