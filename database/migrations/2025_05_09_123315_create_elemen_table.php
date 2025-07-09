<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('elemen', function (Blueprint $table) {
            $table->id();
            $table->string('nama');        // Nama elemen
            $table->text('deskripsi');     // Deskripsi elemen
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('elemen');
    }
};
