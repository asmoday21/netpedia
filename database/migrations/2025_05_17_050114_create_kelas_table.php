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
        if (!Schema::hasTable('kelas')) {
            Schema::create('kelas', function (Blueprint $table) {
                $table->id();
                $table->string('nama_kelas');
                $table->timestamps();
            });
        }
    }

    public function down(): void
{
    // Hapus foreign key kelas_id di tabel siswas dulu
    Schema::table('siswas', function (Blueprint $table) {
        $table->dropForeign(['kelas_id']);
    });

    // Baru hapus tabel kelas
    Schema::dropIfExists('kelas');
}

};
