<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('moduls', function (Blueprint $table) {
        $table->string('file.pdf')->nullable();
        $table->string('gambar')->nullable();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('moduls', function (Blueprint $table) {
            //
        });
    }
};
