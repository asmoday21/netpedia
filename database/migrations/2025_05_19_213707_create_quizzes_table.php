<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('platform'); // Kahoot, Quizizz, Wordwall, dll
            $table->text('link');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Admin/guru
            $table->foreignId('materi_id')->nullable()->constrained()->onDelete('cascade'); // Jika terkait materi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
