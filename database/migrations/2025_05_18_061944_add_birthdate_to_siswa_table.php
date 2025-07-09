<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('siswa', function (Blueprint $table) {
        $table->date('birthdate')->nullable();
        // sesuaikan posisi dan tipe data
    });
}

public function down()
{
    Schema::table('siswa', function (Blueprint $table) {
        $table->dropColumn('birthdate');
    });
}

};
