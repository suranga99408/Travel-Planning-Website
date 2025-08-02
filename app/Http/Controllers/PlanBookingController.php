<?php

// app/Http/Controllers/PlanBookingController.php
namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\PlanBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanBookingController extends Controller
{
    public function store(Request $request, Plan $plan)
    {
        $request->validate([
            'number_of_people' => 'required|integer|min:1',
            'special_requests' => 'nullable|string',
            'payment_method' => 'required|in:credit_card,paypal'
        ]);

        $booking = PlanBooking::create([
            'user_id' => Auth::id(),
            'plan_id' => $plan->id,
            'number_of_people' => $request->number_of_people,
            'special_requests' => $request->special_requests,
            'payment_method' => $request->payment_method,
            'total_amount' => $plan->price_per_person * $request->number_of_people,
            'status' => 'confirmed'
        ]);

        return redirect()->route('bookings.show', $booking->id)
                         ->with('success', 'Booking confirmed successfully!');
    }

    public function show(PlanBooking $booking)
    {
        // Ensure the booking belongs to the authenticated user
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        return view('bookings.plans-show', compact('booking'));
    }

   // app/Http/Controllers/PlanBookingController.php
public function index()
{
    // Change get() to paginate()
    $bookings = PlanBooking::with(['plan', 'user'])
                ->where('user_id', auth()->id())
                ->latest()
                ->paginate(10); // 10 items per page
    
    return view('bookings.index', compact('bookings'));
}
}