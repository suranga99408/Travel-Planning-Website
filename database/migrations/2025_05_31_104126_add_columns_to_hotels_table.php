<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToHotelsTable extends Migration
{
    public function up()
    {
        Schema::table('hotels', function (Blueprint $table) {
            // Add your new columns here
            $table->text('full_description')->nullable()->after('description');
            $table->json('images')->nullable()->after('image');
            $table->text('food_options')->nullable()->after('price_per_night');
            $table->boolean('has_nightlife')->default(false)->after('food_options');
            $table->text('nightlife_description')->nullable()->after('has_nightlife');
            $table->string('phone')->nullable()->after('location');
            $table->string('email')->nullable()->after('phone');
            $table->string('rating')->default('3-star')->after('email');
            $table->boolean('has_wifi')->default(false)->after('rating');
            $table->boolean('has_pool')->default(false)->after('has_wifi');
            $table->boolean('has_gym')->default(false)->after('has_pool');
            $table->boolean('has_spa')->default(false)->after('has_gym');
            $table->boolean('has_restaurant')->default(false)->after('has_spa');
            $table->string('meal_plan')->nullable()->after('has_restaurant');
        });
    }

    public function down()
    {
        Schema::table('hotels', function (Blueprint $table) {
            // Reverse the changes (for rollback)
            $table->dropColumn([
                'full_description',
                'images',
                'food_options',
                'has_nightlife',
                'nightlife_description',
                'phone',
                'email',
                'rating',
                'has_wifi',
                'has_pool',
                'has_gym',
                'has_spa',
                'has_restaurant',
                'meal_plan'
            ]);
        });
    }
}