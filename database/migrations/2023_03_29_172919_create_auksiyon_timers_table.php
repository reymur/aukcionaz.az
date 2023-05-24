<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuksiyonTimersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auksiyon_timers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('auksiyon_id')->nullable();
            $table->string('time')->nullable();
            $table->string('current_save_time')->nullable();
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
        Schema::dropIfExists('auksiyon_timers');
    }
}
