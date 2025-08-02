<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;

class BookingController extends Controller
{
    public function create($planId)
    {
        $plan = Plan::findOrFail($planId);
        return view('bookings.create', compact('plan'));
    }

    public function store(Request $request, $planId)
    {
        $request->validate([
            'number_of_people' => 'required|integer|min:1',
            'special_requests' => 'nullable|string',
        ]);

        $plan = Plan::findOrFail($planId);
        
        $booking = new Booking();
        $booking->user_id = Auth::id();
        $booking->plan_id = $plan->id;
        $booking->number_of_people = $request->number_of_people;
        $booking->total_price = $plan->price_per_person * $request->number_of_people;
        $booking->special_requests = $request->special_requests;
        $booking->save();

        // Send confirmation email
        Mail::to(Auth::user()->email)->send(new BookingConfirmation($booking));

        return redirect()->route('plans.index')->with('success', 'Booking confirmed! Check your email for details.');
    }

    
}