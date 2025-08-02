<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();
        return view('admin.hotels.index', compact('hotels'));
    }

    public function create()
    {
        return view('admin.hotels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'category' => 'required|string|max:100',
            'price_per_night' => 'required|numeric',
            'location' => 'required|string',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'has_wifi' => 'boolean',
            'has_pool' => 'boolean',
            'has_gym' => 'boolean',
            'has_spa' => 'boolean',
            'has_restaurant' => 'boolean',
            'meal_plan' => 'nullable|string'
        ]);

        $hotel = new Hotel($request->except(['image', 'images']));

        // Handle main image
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('hotels', 'public');
            $hotel->image = $path;
        }

        // Handle gallery images
        if ($request->hasFile('images')) {
            $paths = [];
            foreach ($request->file('images') as $img) {
                $paths[] = $img->store('hotels/gallery', 'public');
            }
            $hotel->images = json_encode($paths);
        }

        $hotel->save();

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel added successfully.');
    }

    public function edit(Hotel $hotel)
    {
        return view('admin.hotels.edit', compact('hotel'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'category' => 'required|string|max:100',
            'price_per_night' => 'required|numeric',
            'location' => 'required|string',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'has_wifi' => 'boolean',
            'has_pool' => 'boolean',
            'has_gym' => 'boolean',
            'has_spa' => 'boolean',
            'has_restaurant' => 'boolean',
            'meal_plan' => 'nullable|string'
        ]);

        $hotel->fill($request->except(['image', 'images']));

        // Update main image
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($hotel->image);
            $path = $request->file('image')->store('hotels', 'public');
            $hotel->image = $path;
        }

        // Update gallery images
        if ($request->hasFile('images')) {
            // Delete old images
            if ($hotel->images && is_array(json_decode($hotel->images, true))) {
                foreach (json_decode($hotel->images, true) as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            // Upload new images
            $paths = [];
            foreach ($request->file('images') as $img) {
                $paths[] = $img->store('hotels/gallery', 'public');
            }
            $hotel->images = json_encode($paths);
        }

        $hotel->save();

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel updated successfully.');
    }

    public function destroy(Hotel $hotel)
    {
        if ($hotel->image) {
            Storage::disk('public')->delete($hotel->image);
        }

        if ($hotel->images && is_array(json_decode($hotel->images, true))) {
            foreach (json_decode($hotel->images, true) as $img) {
                Storage::disk('public')->delete($img);
            }
        }

        $hotel->delete();

        return back()->with('success', 'Hotel deleted successfully.');
    }
}