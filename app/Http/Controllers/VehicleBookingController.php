<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleBookingController extends Controller
{
    public function store(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'pickup_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after:pickup_date',
            'pickup_location' => 'required|string',
            'return_location' => 'required|string',
            'driver_age' => 'required|integer|min:18|max:99',
            'insurance_type' => 'required|in:basic,premium,complete',
        ]);

        // Check availability
        $isAvailable = !$vehicle->bookings()
            ->whereBetween('pickup_date', [$request->pickup_date, $request->return_date])
            ->orWhereBetween('return_date', [$request->pickup_date, $request->return_date])
            ->exists();

        if (!$isAvailable) {
            return back()->with('error', 'Vehicle is no longer available for the selected dates.');
        }

        // Calculate total price
        $days = (strtotime($request->return_date) - strtotime($request->pickup_date)) / (60 * 60 * 24);
        $insuranceCost = match ($request->insurance_type) {
            'premium' => 20 * $days,
            'complete' => 35 * $days,
            default => 0,
        };

        $booking = VehicleBooking::create([
            'user_id' => Auth::id(),
            'vehicle_id' => $vehicle->id,
            'pickup_date' => $request->pickup_date,
            'return_date' => $request->return_date,
            'pickup_location' => $request->pickup_location,
            'return_location' => $request->return_location,
            'driver_age' => $request->driver_age,
            'daily_rate' => $vehicle->price_per_day,
            'total_price' => ($vehicle->price_per_day * $days) + $insuranceCost,
            'insurance_type' => $request->insurance_type,
            'insurance_cost' => $insuranceCost,
            'special_requests' => $request->special_requests,
        ]);

        return redirect()->route('bookings.show', $booking->id)
            ->with('success', 'Booking confirmed!');
    }

    public function show(VehicleBooking $booking)
    {
        return view('bookings.show', compact('booking'));
    }

    
}