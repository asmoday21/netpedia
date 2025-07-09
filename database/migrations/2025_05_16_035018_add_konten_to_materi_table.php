<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('materi', function (\Illuminate\Database\Schema\Blueprint $table) {
        $table->text('konten')->nullable()->after('judul');
    });
}

public function down()
{
    Schema::table('materi', function (\Illuminate\Database\Schema\Blueprint $table) {
        $table->dropColumn('konten');
    });
}


};
