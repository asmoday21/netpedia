<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('moduls', function (Blueprint $table) {
        $table->text('konten')->nullable()->change();
    });
}

public function down()
{
    Schema::table('moduls', function (Blueprint $table) {
        $table->text('konten')->nullable(false)->change();
    });
}

};
