<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameNameToNamaInSiswasTable extends Migration
{
    public function up()
    {
        Schema::table('siswas', function (Blueprint $table) {
            // Cek dulu kolom 'name' ada, baru rename jadi 'nama'
            if (Schema::hasColumn('siswas', 'name')) {
                $table->renameColumn('name', 'nama');
            }
            // Tidak menambah kolom telepon karena sudah ada
        });
    }

    public function down()
    {
        Schema::table('siswas', function (Blueprint $table) {
            // Kembalikan nama kolom 'nama' ke 'name' kalau ada
            if (Schema::hasColumn('siswas', 'nama')) {
                $table->renameColumn('nama', 'name');
            }
        });
    }
}
