<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTeachingClassesToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Untuk MySQL 5.7+ / PostgreSQL
            $table->json('teaching_classes')->nullable()->after('class_name');
            // Jika Anda menggunakan database yang lebih lama atau tidak mendukung JSON
            // $table->text('teaching_classes')->nullable()->after('class_name');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('teaching_classes');
        });
    }
}
