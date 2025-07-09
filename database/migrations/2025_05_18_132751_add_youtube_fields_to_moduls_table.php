<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddYoutubeFieldsToModulsTable extends Migration
{
    public function up()
    {
        Schema::table('moduls', function (Blueprint $table) {
            $table->string('youtube_thumbnail')->nullable()->after('embed_link');
            $table->string('youtube_title')->nullable()->after('youtube_thumbnail');
        });
    }

    public function down()
    {
        Schema::table('moduls', function (Blueprint $table) {
            $table->dropColumn(['youtube_thumbnail', 'youtube_title']);
        });
    }
}

