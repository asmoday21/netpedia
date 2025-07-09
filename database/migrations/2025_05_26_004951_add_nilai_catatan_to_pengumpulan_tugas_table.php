<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNilaiCatatanToPengumpulanTugasTable extends Migration
{
    public function up()
    {
        Schema::table('pengumpulan_tugas', function (Blueprint $table) {
            $table->integer('nilai')->nullable()->after('file_jawaban');
            $table->text('catatan')->nullable()->after('nilai');
        });
    }

    public function down()
    {
        Schema::table('pengumpulan_tugas', function (Blueprint $table) {
            $table->dropColumn(['nilai', 'catatan']);
        });
    }
}
