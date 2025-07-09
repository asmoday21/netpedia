<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('materi', function (Blueprint $table) {
            $table->unsignedBigInteger('kelas_id')->nullable(); // Hilangkan 'after'
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('materi', function (Blueprint $table) {
            $table->dropForeign(['kelas_id']);
            $table->dropColumn('kelas_id');
        });
    }
};
