@extends('admin.admin')

@section('title', 'Edit Hotel - ' . $hotel->name)
@section('header', 'Edit Hotel')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-sm rounded-lg">
            <div class="card-body p-4">
                <form action="{{ route('admin.hotels.update', $hotel->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Basic Info -->
                    <div class="mb-4">
                        <h5>Basic Information</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Hotel Name *</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $hotel->name) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Type *</label>
                                <select name="type" class="form-control" required>
                                    <option value="Room only" {{ $hotel->type == 'Room only' ? 'selected' : '' }}>Room Only</option>
                                    <option value="Bed & Breakfast" {{ $hotel->type == 'Bed & Breakfast' ? 'selected' : '' }}>Bed & Breakfast</option>
                                    <option value="Half Board" {{ $hotel->type == 'Half Board' ? 'selected' : '' }}>Half Board</option>
                                    <option value="All Inclusive" {{ $hotel->type == 'All Inclusive' ? 'selected' : '' }}>All Inclusive</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Category *</label>
                                <select name="category" class="form-control" required>
                                    <option value="Honeymoon" {{ $hotel->category == 'Honeymoon' ? 'selected' : '' }}>Honeymoon</option>
                                    <option value="Family" {{ $hotel->category == 'Family' ? 'selected' : '' }}>Family</option>
                                    <option value="Business" {{ $hotel->category == 'Business' ? 'selected' : '' }}>Business</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Price per Night *</label>
                                <input type="number" step="0.01" name="price_per_night" class="form-control" value="{{ old('price_per_night', $hotel->price_per_night) }}" required>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Description *</label>
                                <textarea name="description" rows="3" class="form-control" required>{{ old('description', $hotel->description) }}</textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Location *</label>
                                <input type="text" name="location" class="form-control" value="{{ old('location', $hotel->location) }}" required>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Main Image</label>
                                <input type="file" name="image" class="form-control">
                                @if($hotel->image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $hotel->image) }}" alt="Current Image" width="120">
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Gallery Images</label>
                                <input type="file" name="images[]" multiple class="form-control">
                                @if(is_array($hotel->images))
                                    <div class="mt-2">
                                        @foreach($hotel->images as $img)
                                            <img src="{{ asset('storage/' . $img) }}" alt="Gallery Image" style="max-height: 80px;" class="me-2 mt-2">
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Amenities -->
                    <div class="mb-4">
                        <h5>Amenities</h5>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="has_wifi" name="has_wifi" {{ $hotel->has_wifi ? 'checked' : '' }}>
                                    <label class="form-check-label" for="has_wifi">WiFi</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="has_pool" name="has_pool" {{ $hotel->has_pool ? 'checked' : '' }}>
                                    <label class="form-check-label" for="has_pool">Pool</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="has_gym" name="has_gym" {{ $hotel->has_gym ? 'checked' : '' }}>
                                    <label class="form-check-label" for="has_gym">Gym</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="has_spa" name="has_spa" {{ $hotel->has_spa ? 'checked' : '' }}>
                                    <label class="form-check-label" for="has_spa">Spa</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="has_restaurant" name="has_restaurant" {{ $hotel->has_restaurant ? 'checked' : '' }}>
                                    <label class="form-check-label" for="has_restaurant">Restaurant</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Meal Plan -->
                    <div class="mb-4">
                        <h5>Meal Plan</h5>
                        <select name="meal_plan" class="form-control">
                            <option value="">Select Meal Plan</option>
                            <option value="Breakfast Included" {{ $hotel->meal_plan == 'Breakfast Included' ? 'selected' : '' }}>Breakfast Included</option>
                            <option value="Lunch Included" {{ $hotel->meal_plan == 'Lunch Included' ? 'selected' : '' }}>Lunch Included</option>
                            <option value="Dinner Included" {{ $hotel->meal_plan == 'Dinner Included' ? 'selected' : '' }}>Dinner Included</option>
                            <option value="All Inclusive" {{ $hotel->meal_plan == 'All Inclusive' ? 'selected' : '' }}>All Inclusive</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success rounded-pill mt-3">Update Hotel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection