<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Booking;
use App\Models\HotelBooking;
use App\Models\VehicleBooking;

class BookingController extends Controller
{
    // List all users with bookings
    public function index()
    {
        $users = User::with(['bookings', 'hotelBookings', 'vehicleBookings'])
                    ->whereHas('bookings')
                    ->orWhereHas('hotelBookings')
                    ->orWhereHas('vehicleBookings')
                    ->get();

        return view('admin.bookings.index', compact('users'));
    }

    // Show all bookings for a specific user
    public function showUserBookings(User $user)
    {
        $user->load(['bookings', 'hotelBookings', 'vehicleBookings']);

        return view('admin.bookings.show', compact('user'));
    }
}