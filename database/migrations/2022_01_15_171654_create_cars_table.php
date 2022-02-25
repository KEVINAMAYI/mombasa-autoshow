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
            $table->unsignedBigInteger('user_id');
            $table->string('carfor');
            $table->string('make');
            $table->string('category');
            $table->string('model');
            $table->integer('manufacture_year');
            $table->string('location');
            $table->string('engine_cc');
            $table->string('transmission');
            $table->string('fuel_type');
            $table->string('interior_color');
            $table->string('exterior_color');
            $table->string('vehicle_reg');
            $table->integer('price')->nullable();
            $table->string('vehicle_name')->nullable();
            $table->string('sacco_name')->nullable();
            $table->string('route')->nullable();
            $table->string('description');
            $table->integer('votes');
            $table->string('published');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');

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
