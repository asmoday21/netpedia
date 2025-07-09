<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
    {
        Schema::table('nilai', function (Blueprint $table) {
            $table->unsignedBigInteger('guru_id')->nullable()->after('siswa_id');
            // Asumsi guru disimpan di tabel users
            $table->foreign('guru_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('nilai', function (Blueprint $table) {
            // Ganti 'nilai_guru_id_foreign' dengan nama constraint yang benar, misal:
            $table->dropForeign(['guru_id']); 
            // atau hapus baris ini kalau foreign key tidak ada
            $table->dropColumn('guru_id');
        });
    }

};
