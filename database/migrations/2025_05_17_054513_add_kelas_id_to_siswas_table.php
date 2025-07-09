<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('siswas', 'kelas_id')) {
            Schema::table('siswas', function (Blueprint $table) {
                $table->unsignedBigInteger('kelas_id')->nullable()->after('telepon');
                $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('set null');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('siswas', 'kelas_id')) {
            Schema::table('siswas', function (Blueprint $table) {
                $table->dropForeign(['kelas_id']);
                $table->dropColumn('kelas_id');
            });
        }
    }
};

