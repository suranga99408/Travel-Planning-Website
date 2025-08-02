<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            // Existing columns (keep these)
            $table->id();
            $table->string('title');
            $table->text('short_description');
            $table->text('full_description');
            $table->string('image');
            $table->decimal('price_per_person', 10, 2);
            $table->date('start_date');
            $table->string('start_location');
            $table->timestamps();

            // New columns for hotel details
            $table->string('hotel_name')->nullable();
            $table->text('hotel_description')->nullable();
            $table->json('hotel_images')->nullable(); // Will store multiple image paths as JSON
            $table->string('hotel_rating')->nullable(); // e.g., "5-star", "4-star"
            $table->string('hotel_location')->nullable();
            
            // Hotel amenities
            $table->boolean('has_wifi')->default(false);
            $table->boolean('has_pool')->default(false);
            $table->boolean('has_gym')->default(false);
            $table->boolean('has_spa')->default(false);
            $table->boolean('has_restaurant')->default(false);
            
            // Room details
            $table->string('room_type')->nullable(); // e.g., "Deluxe", "Suite"
            $table->integer('nights_included')->default(1);
            
            // Meal plans
            $table->enum('meal_plan', ['Room Only', 'Bed & Breakfast', 'Half Board', 'Full Board', 'All Inclusive'])->default('Bed & Breakfast');
            
            // Additional features
            $table->text('nearby_attractions')->nullable();
            $table->text('transportation_details')->nullable();
            $table->text('cancellation_policy')->nullable();
            
            // Hotel contact
            $table->string('hotel_phone')->nullable();
            $table->string('hotel_email')->nullable();
            
            // Special offers
            $table->boolean('has_special_offer')->default(false);
            $table->text('special_offer_details')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('plans');
    }
}