<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Aukcion::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('marka');
            $table->string('model');
            $table->string('color');
            $table->string('motor');
            $table->string('fuel_type');
            $table->string('transmission');
            $table->string('body_type');
            $table->string('year');
            $table->integer('kilometer');
            $table->string('condition');
            $table->string('city');
            $table->tinyInteger('public')->default(1);
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
        Schema::dropIfExists('cars');
    }
}
