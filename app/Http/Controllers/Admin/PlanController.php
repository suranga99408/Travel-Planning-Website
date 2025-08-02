<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use Illuminate\Support\Facades\Storage;

class PlanController extends Controller
{
    // Show all plans
    public function index()
    {
        $plans = Plan::all();
        return view('admin.plans.index', compact('plans'));
    }

    // Show create form
    public function create()
    {
        return view('admin.plans.create');
    }

    // Store new plan
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price_per_person' => 'required|numeric',
            'start_date' => 'required|date',
            'start_location' => 'required|string',
            'short_description' => 'required',
            'full_description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $plan = new Plan($request->except('image'));

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('plans', 'public');
            $plan->image = $path;
        }

        $plan->save();

        return redirect()->route('admin.plans.index')->with('success', 'Plan created successfully.');
    }

    // Show edit form
    public function edit(Plan $plan)
    {
        return view('admin.plans.edit', compact('plan'));
    }

    // Update plan
    public function update(Request $request, Plan $plan)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price_per_person' => 'required|numeric',
            'start_date' => 'required|date',
            'start_location' => 'required|string',
            'short_description' => 'required',
            'full_description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $plan->fill($request->except('image'));

        if ($request->hasFile('image')) {
            // Delete old image
            if ($plan->image) {
                Storage::disk('public')->delete($plan->image);
            }
            $path = $request->file('image')->store('plans', 'public');
            $plan->image = $path;
        }

        $plan->save();

        return redirect()->route('admin.plans.index')->with('success', 'Plan updated successfully.');
    }

    // Delete plan
    public function destroy(Plan $plan)
    {
        if ($plan->image) {
            Storage::disk('public')->delete($plan->image);
        }

        $plan->delete();

        return back()->with('success', 'Plan deleted successfully.');
    }
}