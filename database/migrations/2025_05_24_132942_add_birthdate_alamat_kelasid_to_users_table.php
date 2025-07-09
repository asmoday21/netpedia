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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'birthdate')) {
                $table->date('birthdate')->nullable();
            }

            if (!Schema::hasColumn('users', 'alamat')) {
                $table->string('alamat')->nullable();
            }

            if (!Schema::hasColumn('users', 'kelas_id')) {
                $table->unsignedBigInteger('kelas_id')->nullable();
                $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
