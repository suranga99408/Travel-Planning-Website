<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get bookings from your models (customize based on your Booking model)
        $planBookings = $user->bookings ?? [];
        $hotelBookings = $user->hotelBookings ?? [];
        $vehicleBookings = $user->vehicleBookings ?? [];

        return view('dashboard.index', compact('planBookings', 'hotelBookings', 'vehicleBookings'));
    }

    public function profile()
    {
        return view('dashboard.profile');
    }

    public function updateName(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255']
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();
        $user->name = $request->input('name');
        $user->save();

        return back()->with('success', 'Your name has been updated.');
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();

        if (!Hash::check($request->input('current_password'), $user->password)) {
            return back()->with('error', 'Current password is incorrect.');
        }

        $user->password = bcrypt($request->input('password'));
        $user->save();

        return back()->with('success', 'Password changed successfully.');
    }

    public function deleteAccount(Request $request)
    {
        $user = Auth::user();

        // Optional: Add logic to delete related bookings, carts, etc.
        $user->delete();

        return redirect('/')->with('success', 'Your account has been deleted.');
    }
}