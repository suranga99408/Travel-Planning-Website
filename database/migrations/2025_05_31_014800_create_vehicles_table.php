<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->text('full_description')->nullable();
            $table->json('images')->nullable();
            $table->string('type'); // Car, SUV, Van, Motorcycle
            $table->string('category'); // Economy, Luxury, Family, Sports
            $table->decimal('price_per_day', 10, 2);
            $table->integer('capacity');
            $table->string('transmission')->default('Automatic'); // Automatic, Manual
            $table->string('fuel_type')->default('Petrol'); // Petrol, Diesel, Electric, Hybrid
            $table->boolean('air_conditioned')->default(true);
            $table->integer('doors')->default(4);
            $table->integer('bags')->default(2);
            $table->string('color')->nullable();
            $table->integer('year')->nullable();
            $table->string('plate_number')->nullable();
            $table->json('features')->nullable(); // JSON array of features
            $table->boolean('available')->default(true);
            $table->string('location');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}