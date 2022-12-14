<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAudioVeVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audio_ve_videos', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('type');
            $table->string('title');
            $table->string('new')->nullable();
            $table->string('delivery')->nullable();
            $table->integer('price');
            $table->string('city');
            $table->text('about');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audio_ve_videos');
    }
}
