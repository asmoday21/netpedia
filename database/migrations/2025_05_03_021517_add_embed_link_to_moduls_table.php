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
    Schema::table('moduls', function (Blueprint $table) {
        $table->text('embed_link')->nullable();
    });
}

public function down(): void
{
    Schema::table('moduls', function (Blueprint $table) {
        $table->dropColumn('embed_link');
    });
}

};
