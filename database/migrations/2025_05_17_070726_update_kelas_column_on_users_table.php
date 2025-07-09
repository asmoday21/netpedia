<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom kelas_id setelah kolom 'email' (ganti sesuai kolom yang ada)
            if (!Schema::hasColumn('users', 'kelas_id')) {
                $table->unsignedBigInteger('kelas_id')->nullable()->after('email');
                $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('set null');
            }
        });

        Schema::table('users', function (Blueprint $table) {
            // Tambah kolom kelas_id jika belum ada
            if (!Schema::hasColumn('users', 'kelas_id')) {
                $table->unsignedBigInteger('kelas_id')->nullable()->after('telepon');
                $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('set null');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'kelas_id')) {
                $table->dropForeign(['kelas_id']);
                $table->dropColumn('kelas_id');
            }

            if (!Schema::hasColumn('users', 'kelas')) {
                $table->string('kelas')->nullable();
            }
        });
    }
};

