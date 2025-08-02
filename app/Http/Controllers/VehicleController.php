<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $query = Vehicle::query();

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        $vehicles = $query->where('available', true)->paginate(12);

        return view('vehicles.index', compact('vehicles'));
    }

    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show', compact('vehicle'));
    }

    public function checkAvailability(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $isAvailable = !$vehicle->bookings()
            ->whereBetween('pickup_date', [$request->start_date, $request->end_date])
            ->orWhereBetween('return_date', [$request->start_date, $request->end_date])
            ->exists();

        return response()->json([
            'available' => $isAvailable,
            'message' => $isAvailable ? 'Vehicle is available!' : 'Vehicle is already booked for selected dates.',
        ]);
    }
}