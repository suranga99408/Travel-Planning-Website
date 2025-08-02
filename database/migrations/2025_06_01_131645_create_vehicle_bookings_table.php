<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vehicle_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('pickup_date');
            $table->date('return_date');
            $table->string('pickup_location');
            $table->string('return_location');
            $table->integer('driver_age');
            $table->decimal('daily_rate', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->string('status')->default('confirmed');
            $table->text('special_requests')->nullable();
            $table->string('insurance_type')->default('basic');
            $table->decimal('insurance_cost', 10, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vehicle_bookings');
    }
};