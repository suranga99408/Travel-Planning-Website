<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlanController extends Controller
{
    // Show all plans
    public function index()
    {
        $plans = Plan::all();
        return view('plans.index', compact('plans'));
    }

    // Show create form
    public function create()
    {
        return view('plans.create');
    }

    // Store new plan
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'short_description' => 'required',
            'full_description' => 'required',
            'price_per_person' => 'required|numeric',
            'start_date' => 'required|date',
            'start_location' => 'required',
            'hotel_name' => 'nullable',
            'hotel_description' => 'nullable',
            'hotel_rating' => 'nullable',
            'hotel_location' => 'nullable',
            'room_type' => 'nullable',
            'nights_included' => 'nullable|integer',
            'meal_plan' => 'nullable',
            'nearby_attractions' => 'nullable',
            'transportation_details' => 'nullable',
            'cancellation_policy' => 'nullable',
            'hotel_phone' => 'nullable',
            'hotel_email' => 'nullable',
            'special_offer_details' => 'nullable'
        ]);

        // Handle amenities
        $formFields['has_wifi'] = $request->has('has_wifi');
        $formFields['has_pool'] = $request->has('has_pool');
        $formFields['has_gym'] = $request->has('has_gym');
        $formFields['has_spa'] = $request->has('has_spa');
        $formFields['has_restaurant'] = $request->has('has_restaurant');
        $formFields['has_special_offer'] = $request->has('has_special_offer');

        // Handle image upload
        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('plans', 'public');
        }

        // Handle hotel images (comma separated to array)
        if ($request->filled('hotel_images')) {
            $images = explode(',', $request->hotel_images);
            $formFields['hotel_images'] = json_encode(array_map('trim', $images));
        }

        Plan::create($formFields);

        return redirect()->route('plans.index')->with('success', 'Plan created successfully!');
    }

    // Show single plan
    public function show(Plan $plan)
    {
        return view('plans.show', compact('plan'));
    }

    // Show edit form
    public function edit(Plan $plan)
    {
        return view('plans.edit', compact('plan'));
    }

    // Update plan
    public function update(Request $request, Plan $plan)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'short_description' => 'required',
            'full_description' => 'required',
            'price_per_person' => 'required|numeric',
            'start_date' => 'required|date',
            'start_location' => 'required',
            'hotel_name' => 'nullable',
            'hotel_description' => 'nullable',
            'hotel_rating' => 'nullable',
            'hotel_location' => 'nullable',
            'room_type' => 'nullable',
            'nights_included' => 'nullable|integer',
            'meal_plan' => 'nullable',
            'nearby_attractions' => 'nullable',
            'transportation_details' => 'nullable',
            'cancellation_policy' => 'nullable',
            'hotel_phone' => 'nullable',
            'hotel_email' => 'nullable',
            'special_offer_details' => 'nullable'
        ]);

        // Handle amenities
        $formFields['has_wifi'] = $request->has('has_wifi');
        $formFields['has_pool'] = $request->has('has_pool');
        $formFields['has_gym'] = $request->has('has_gym');
        $formFields['has_spa'] = $request->has('has_spa');
        $formFields['has_restaurant'] = $request->has('has_restaurant');
        $formFields['has_special_offer'] = $request->has('has_special_offer');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($plan->image) {
                Storage::disk('public')->delete($plan->image);
            }
            $formFields['image'] = $request->file('image')->store('plans', 'public');
        }

        // Handle hotel images
        if ($request->filled('hotel_images')) {
            $images = explode(',', $request->hotel_images);
            $formFields['hotel_images'] = json_encode(array_map('trim', $images));
        }

        $plan->update($formFields);

        return redirect()->route('plans.index')->with('success', 'Plan updated successfully!');
    }

    // Delete plan
    public function destroy(Plan $plan)
    {
        if ($plan->image) {
            Storage::disk('public')->delete($plan->image);
        }
        $plan->delete();
        return redirect()->route('plans.index')->with('success', 'Plan deleted successfully!');
    }
}