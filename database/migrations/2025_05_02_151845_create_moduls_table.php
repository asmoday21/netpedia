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
    Schema::create('moduls', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->string('embed_link')->nullable();
        $table->string('kategori')->nullable();
        $table->string('gambar')->nullable();
        $table->string('file_pdf')->nullable();
        $table->string('youtube_title')->nullable();
        $table->string('youtube_thumbnail')->nullable();
        $table->string('kategori')->nullable()->after('deskripsi');
        $table->timestamps();
    });
    
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moduls');
    }
};
