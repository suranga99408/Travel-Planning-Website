<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    // Show all vehicles
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('admin.vehicles.index', compact('vehicles'));
    }

    // Show create form
    public function create()
    {
        return view('admin.vehicles.create');
    }

    // Store new vehicle
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'price_per_day' => 'required|numeric',
            'capacity' => 'required|integer',
            'transmission' => 'required|string|max:100',
            'fuel_type' => 'required|string|max:100',
            'air_conditioned' => 'required|boolean',
            'location' => 'required|string',
            'description' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $vehicle = new Vehicle($request->except(['images', 'features']));

        // Handle images
        if ($request->hasFile('images')) {
            $paths = [];
            foreach ($request->file('images') as $image) {
                $paths[] = $image->store('vehicles', 'public');
            }
            $vehicle->images = json_encode($paths);
        }

        // Handle features
        $vehicle->features = json_encode(array_filter(explode("\n", $request->input('features'))));

        $vehicle->save();

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle added successfully.');
    }

    // Show edit form
    public function edit(Vehicle $vehicle)
    {
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    // Update vehicle
    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'price_per_day' => 'required|numeric',
            'capacity' => 'required|integer',
            'transmission' => 'required|string|max:100',
            'fuel_type' => 'required|string|max:100',
            'air_conditioned' => 'required|boolean',
            'location' => 'required|string',
            'description' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $vehicle->fill($request->except(['images', 'features']));

        // Handle image uploads
        if ($request->hasFile('images')) {
            // Delete old images
            if ($vehicle->images && is_array(json_decode($vehicle->images, true))) {
                foreach (json_decode($vehicle->images, true) as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            // Upload new images
            $paths = [];
            foreach ($request->file('images') as $image) {
                $paths[] = $image->store('vehicles', 'public');
            }
            $vehicle->images = json_encode($paths);
        }

        // Handle features list
        $vehicle->features = json_encode(array_filter(explode("\n", $request->input('features'))));

        $vehicle->save();

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    // Delete vehicle
    public function destroy(Vehicle $vehicle)
    {
        // Delete images
        if ($vehicle->images && is_array(json_decode($vehicle->images, true))) {
            foreach (json_decode($vehicle->images, true) as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $vehicle->delete();

        return back()->with('success', 'Vehicle deleted successfully.');
    }
}