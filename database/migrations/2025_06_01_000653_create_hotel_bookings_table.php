<?php
// database/migrations/[timestamp]_create_hotel_bookings_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hotel_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Booking Details
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('adults')->default(1);
            $table->integer('children')->default(0);
            
            // Room Configuration
            $table->string('room_type');
            $table->integer('room_count')->default(1);
            $table->json('selected_rooms')->nullable();
            
            // Pricing
            $table->decimal('room_rate', 10, 2);
            $table->decimal('taxes', 10, 2)->default(0);
            $table->decimal('total_price', 10, 2);
            
            // Guest Information
            $table->string('guest_name');
            $table->string('guest_email');
            $table->string('guest_phone');
            $table->text('special_requests')->nullable();
            
            // Payment Status
            $table->string('payment_status')->default('pending');
            $table->string('payment_method')->nullable();
            
            // Booking Status
            $table->string('status')->default('confirmed');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hotel_bookings');
    }
};