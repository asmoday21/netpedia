<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNilaiCatatanToTugasJawabansTable extends Migration
{
    public function up()
    {
        Schema::table('tugas_jawabans', function (Blueprint $table) {
            if (!Schema::hasColumn('tugas_jawabans', 'nilai')) {
                $table->integer('nilai')->nullable();
            }

            if (!Schema::hasColumn('tugas_jawabans', 'catatan')) {
                $table->text('catatan')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('tugas_jawabans', function (Blueprint $table) {
            if (Schema::hasColumn('tugas_jawabans', 'nilai')) {
                $table->dropColumn('nilai');
            }

            if (Schema::hasColumn('tugas_jawabans', 'catatan')) {
                $table->dropColumn('catatan');
            }
        });
    }
}

