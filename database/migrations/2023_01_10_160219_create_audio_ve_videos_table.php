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
            $table->foreignIdFor(\App\Models\User::class)->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\SubCategory::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('type');
            $table->string('title');
            $table->string('new')->nullable();
            $table->string('delivery')->nullable();
            $table->integer('price');
            $table->string('city');
            $table->text('about')->nullable();
            $table->string('name');
            $table->string('email');
            $table->boolean('publish')->default(0);
            $table->string('pin')->nullable();
            $table->string('number')->nullable();
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
