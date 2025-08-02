@extends('admin.admin')

@section('title', 'Add New Hotel')
@section('header', 'Add New Hotel')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-sm rounded-lg">
            <div class="card-body p-4">
                <form action="{{ route('admin.hotels.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Basic Info -->
                    <div class="mb-4">
                        <h5>Basic Information</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Hotel Name *</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Type *</label>
                                <select name="type" class="form-control" required>
                                    <option value="">Select Type</option>
                                    <option value="Room only">Room Only</option>
                                    <option value="Bed & Breakfast">Bed & Breakfast</option>
                                    <option value="Half Board">Half Board</option>
                                    <option value="All Inclusive">All Inclusive</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Category *</label>
                                <select name="category" class="form-control" required>
                                    <option value="">Select Category</option>
                                    <option value="Honeymoon">Honeymoon</option>
                                    <option value="Family">Family</option>
                                    <option value="Business">Business</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Price per Night *</label>
                                <input type="number" step="0.01" name="price_per_night" class="form-control" required>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Description *</label>
                                <textarea name="description" rows="3" class="form-control" required></textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Location *</label>
                                <input type="text" name="location" class="form-control" required>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Main Image *</label>
                                <input type="file" name="image" class="form-control" required>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Gallery Images (multiple allowed)</label>
                                <input type="file" name="images[]" multiple class="form-control">
                            </div>
                        </div>
                    </div>

                    <!-- Amenities -->
                    <div class="mb-4">
                        <h5>Amenities</h5>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="has_wifi" name="has_wifi">
                                    <label class="form-check-label" for="has_wifi">WiFi</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="has_pool" name="has_pool">
                                    <label class="form-check-label" for="has_pool">Pool</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="has_gym" name="has_gym">
                                    <label class="form-check-label" for="has_gym">Gym</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="has_spa" name="has_spa">
                                    <label class="form-check-label" for="has_spa">Spa</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="has_restaurant" name="has_restaurant">
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
                            <option value="Breakfast Included">Breakfast Included</option>
                            <option value="Lunch Included">Lunch Included</option>
                            <option value="Dinner Included">Dinner Included</option>
                            <option value="All Inclusive">All Inclusive</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success rounded-pill mt-3">Save Hotel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection