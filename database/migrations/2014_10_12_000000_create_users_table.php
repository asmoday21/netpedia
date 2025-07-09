<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'guru', 'siswa'])->default('siswa'); // <<< Ganti 'usertype' menjadi 'role'

            // Student specific fields
            $table->foreignId('kelas_id')->nullable()->constrained('kelas')->onDelete('set null'); // <<< Gunakan foreignId lebih baik
            $table->date('birthdate')->nullable();
            $table->string('alamat', 255)->nullable();
            $table->string('profile_image')->nullable()->default('default_profile.jpg');

            $table->rememberToken();
            $table->timestamps();

            // Add indexes
            $table->index('role'); // <<< Ganti 'usertype' menjadi 'role'
            $table->index('kelas_id');
        });
    }
}