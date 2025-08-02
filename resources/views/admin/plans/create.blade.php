@extends('admin.admin')

@section('title', 'Create New Travel Plan')

@section('header', 'Create New Travel Plan')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-sm rounded-lg">
            <div class="card-body p-4">
                <form action="{{ route('admin.plans.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Basic Info -->
                    <div class="mb-4">
                        <h5>Basic Information</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Title *</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Price per Person *</label>
                                <input type="number" step="0.01" name="price_per_person" class="form-control" required>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Start Date *</label>
                                <input type="date" name="start_date" class="form-control" required>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Start Location *</label>
                                <input type="text" name="start_location" class="form-control" required>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Short Description *</label>
                                <textarea name="short_description" rows="2" class="form-control" required></textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Full Description *</label>
                                <textarea name="full_description" rows="4" class="form-control" required></textarea>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Image *</label>
                                <input type="file" name="image" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <!-- Hotel Info -->
                    <div class="mb-4">
                        <h5>Hotel Details (Optional)</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Hotel Name</label>
                                <input type="text" name="hotel_name" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Hotel Rating</label>
                                <select name="hotel_rating" class="form-control">
                                    <option value="">Select Rating</option>
                                    <option value="1-star">1 Star</option>
                                    <option value="2-star">2 Star</option>
                                    <option value="3-star">3 Star</option>
                                    <option value="4-star">4 Star</option>
                                    <option value="5-star">5 Star</option>
                                    <option value="Luxury">Luxury</option>
                                    <option value="Boutique">Boutique</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Room Type</label>
                                <input type="text" name="room_type" class="form-control">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Nights Included</label>
                                <input type="number" name="nights_included" class="form-control" value="1">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Meal Plan</label>
                                <select name="meal_plan" class="form-control">
                                    <option value="Bed & Breakfast">Bed & Breakfast</option>
                                    <option value="Room Only">Room Only</option>
                                    <option value="Half Board">Half Board</option>
                                    <option value="Full Board">Full Board</option>
                                    <option value="All Inclusive">All Inclusive</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Hotel Location</label>
                                <input type="text" name="hotel_location" class="form-control">
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Hotel Description</label>
                                <textarea name="hotel_description" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success rounded-pill mt-3">Save Plan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection