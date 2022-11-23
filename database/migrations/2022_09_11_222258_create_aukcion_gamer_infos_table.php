<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAukcionGamerInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aukcion_gamer_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\AukcionGamer::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('rating')->default(0);
            $table->integer('played')->default(0);
            $table->integer('won')->default(0);
            $table->text('about')->nullable();
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
        Schema::dropIfExists('aukcion_gamer_infos');
    }
}
