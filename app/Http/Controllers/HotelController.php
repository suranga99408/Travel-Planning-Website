<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->input('type');
        $category = $request->input('category');
        
        $query = Hotel::query();
        
        if ($type) {
            $query->where('type', $type);
        }
        
        if ($category) {
            $query->where('category', $category);
        }
        
        $hotels = $query->get();
        
        return view('hotels.index', compact('hotels'));
    }
    public function show($id)
{
    $hotel = Hotel::findOrFail($id);
    
    // Convert JSON images to array if needed
    if (is_string($hotel->images)) {
        $hotel->images = json_decode($hotel->images, true);
    }
    
    return view('hotels.show', compact('hotel'));
}
}