<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HotelBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\HotelBookingConfirmation;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class HotelBookingController extends Controller
{
    public function create(Hotel $hotel)
    {
        return view('hotel-bookings.create', compact('hotel'));
    }

    public function store(Request $request, Hotel $hotel)
    {
        $validated = $request->validate([
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'adults' => 'required|integer|min:1|max:10',
            'children' => 'integer|min:0|max:10',
            'room_type' => 'required|in:standard,deluxe,suite,family',
            'room_count' => 'required|integer|min:1|max:5',
            'guest_name' => 'required|string|max:255',
            'guest_email' => 'required|email|max:255',
            'guest_phone' => 'required|string|max:20',
            'special_requests' => 'nullable|string|max:500',
        ]);

        $roomRate = $this->calculateRoomRate($hotel, $request->room_type);
        $nights = Carbon::parse($request->check_in)->diffInDays($request->check_out);
        $subtotal = $roomRate * $nights * $request->room_count;
        $taxes = $subtotal * 0.1;
        $total = $subtotal + $taxes;

        $booking = HotelBooking::create([
            'hotel_id' => $hotel->id,
            'user_id' => Auth::id(),
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'adults' => $request->adults,
            'children' => $request->children ?? 0,
            'room_type' => $request->room_type,
            'room_count' => $request->room_count,
            'room_rate' => $roomRate,
            'taxes' => $taxes,
            'total_price' => $total,
            'guest_name' => $request->guest_name,
            'guest_email' => $request->guest_email,
            'guest_phone' => $request->guest_phone,
            'special_requests' => $request->special_requests,
            'payment_status' => 'pending',
            'status' => 'confirmed'
        ]);

        Mail::to($request->guest_email)->send(new HotelBookingConfirmation($booking));

        return redirect()->route('hotel-bookings.show', $booking)
            ->with('success', 'Booking confirmed! Check your email for details.');
    }

    public function show(HotelBooking $hotelBooking)
    {
        if ($hotelBooking->user_id !== Auth::id()) {
            abort(403);
        }

        return view('hotel-bookings.show', compact('hotelBooking'));
    }

    private function calculateRoomRate(Hotel $hotel, string $roomType): float
    {
        $rates = [
            'standard' => $hotel->price_per_night,
            'deluxe' => $hotel->price_per_night * 1.2,
            'suite' => $hotel->price_per_night * 1.5,
            'family' => $hotel->price_per_night * 1.3
        ];

        return $rates[$roomType] ?? $hotel->price_per_night;
    }

    // app/Http/Controllers/HotelBookingController.php
public function index()
{
    $bookings = auth()->user()->hotelBookings()
                ->with('hotel')
                ->latest()
                ->paginate(10); // 10 bookings per page
    
    return view('hotel-bookings.index', compact('bookings'));
}
}