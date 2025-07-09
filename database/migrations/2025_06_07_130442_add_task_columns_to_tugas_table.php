<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::table('tugas', function (Blueprint $table) {
            // Periksa apakah kolom sudah ada sebelum menambahkannya
            if (!Schema::hasColumn('tugas', 'original_filename')) {
                $table->string('original_filename')->nullable()->after('lampiran');
            }
            if (!Schema::hasColumn('tugas', 'link_tugas')) {
                $table->string('link_tugas', 2048)->nullable()->after('original_filename');
            }
            if (!Schema::hasColumn('tugas', 'urutan')) {
                $table->integer('urutan')->nullable()->after('batas_pengumpulan');
            }
            if (!Schema::hasColumn('tugas', 'materi')) {
                $table->text('materi')->nullable()->after('urutan'); // Menggunakan 'text' untuk materi
            }
        });
    }

    /**
     * Balikkan migrasi.
     */
    public function down(): void
    {
        Schema::table('tugas', function (Blueprint $table) {
            // Periksa apakah kolom ada sebelum menghapusnya
            if (Schema::hasColumn('tugas', 'materi')) {
                $table->dropColumn('materi');
            }
            if (Schema::hasColumn('tugas', 'urutan')) {
                $table->dropColumn('urutan');
            }
            if (Schema::hasColumn('tugas', 'link_tugas')) {
                $table->dropColumn('link_tugas');
            }
            if (Schema::hasColumn('tugas', 'original_filename')) {
                $table->dropColumn('original_filename');
            }
        });
    }
};
