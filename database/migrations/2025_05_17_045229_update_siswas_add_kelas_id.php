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
        // Kosongkan atau beri pengecekan agar tidak error saat migrasi
        if (!Schema::hasColumn('siswas', 'kelas_id')) {
            Schema::table('siswas', function (Blueprint $table) {
                $table->unsignedBigInteger('kelas_id')->nullable();
            });
        }
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            //
        });
    }
};
