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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('make_id')->constrained()->cascadeOnDelete();
            $table->foreignId('vehicle_model_id')->constrained()->cascadeOnDelete();
            $table->enum('reason',['award']);
            $table->string('location');
            $table->string('eng_cc');
            $table->string('transmission');
            $table->string('manufacturing_year');
            $table->enum('fuel_type',['petrol','diesel']);
            $table->enum('interior_color',['dark','white']);
            $table->enum('exterior_color',['black','pearl_white']);
            $table->string('vehicle_reg');
            $table->string('price');
            $table->string('name');
            $table->string('sacco');
            $table->string('route');
            $table->longText('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
