@extends('admin.admin')

@section('title', 'Edit Travel Plan - ' . $plan->title)

@section('header', 'Edit Travel Plan')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-sm rounded-lg">
            <div class="card-header d-flex justify-content-between align-items-center bg-white">
                <h5 class="mb-0 font-weight-bold">Edit Travel Plan</h5>
            </div>

            <!-- Show any errors -->
            @if ($errors->any())
                <div class="alert alert-danger m-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card-body p-4">
            <form action="{{ route('admin.plans.update', $plan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Basic Info -->
                    <div class="mb-4">
                        <h5>Basic Information</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Title *</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title', $plan->title) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Price per Person *</label>
                                <input type="number" step="0.01" name="price_per_person" class="form-control" value="{{ old('price_per_person', $plan->price_per_person) }}" required>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Start Date *</label>
                                <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $plan->start_date->format('Y-m-d')) }}" required>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Start Location *</label>
                                <input type="text" name="start_location" class="form-control" value="{{ old('start_location', $plan->start_location) }}" required>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Short Description *</label>
                                <textarea name="short_description" rows="2" class="form-control" required>{{ old('short_description', $plan->short_description) }}</textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Full Description *</label>
                                <textarea name="full_description" rows="4" class="form-control" required>{{ old('full_description', $plan->full_description) }}</textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Image (Optional)</label>
                                <input type="file" name="image" class="form-control">
                                @if($plan->image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $plan->image) }}" alt="Current Image" width="120">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Hotel Info -->
                    <div class="mb-4">
                        <h5>Hotel Details</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Hotel Name</label>
                                <input type="text" name="hotel_name" class="form-control" value="{{ old('hotel_name', $plan->hotel_name) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Hotel Rating</label>
                                <select name="hotel_rating" class="form-control">
                                    <option value="">Select Rating</option>
                                    <option value="1-star" {{ $plan->hotel_rating == '1-star' ? 'selected' : '' }}>1 Star</option>
                                    <option value="2-star" {{ $plan->hotel_rating == '2-star' ? 'selected' : '' }}>2 Star</option>
                                    <option value="3-star" {{ $plan->hotel_rating == '3-star' ? 'selected' : '' }}>3 Star</option>
                                    <option value="4-star" {{ $plan->hotel_rating == '4-star' ? 'selected' : '' }}>4 Star</option>
                                    <option value="5-star" {{ $plan->hotel_rating == '5-star' ? 'selected' : '' }}>5 Star</option>
                                    <option value="Luxury" {{ $plan->hotel_rating == 'Luxury' ? 'selected' : '' }}>Luxury</option>
                                    <option value="Boutique" {{ $plan->hotel_rating == 'Boutique' ? 'selected' : '' }}>Boutique</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Room Type</label>
                                <input type="text" name="room_type" class="form-control" value="{{ old('room_type', $plan->room_type) }}">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Nights Included</label>
                                <input type="number" name="nights_included" class="form-control" value="{{ old('nights_included', $plan->nights_included) }}" min="1">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Meal Plan</label>
                                <select name="meal_plan" class="form-control">
                                    <option value="Bed & Breakfast" {{ $plan->meal_plan == 'Bed & Breakfast' ? 'selected' : '' }}>Bed & Breakfast</option>
                                    <option value="Room Only" {{ $plan->meal_plan == 'Room Only' ? 'selected' : '' }}>Room Only</option>
                                    <option value="Half Board" {{ $plan->meal_plan == 'Half Board' ? 'selected' : '' }}>Half Board</option>
                                    <option value="Full Board" {{ $plan->meal_plan == 'Full Board' ? 'selected' : '' }}>Full Board</option>
                                    <option value="All Inclusive" {{ $plan->meal_plan == 'All Inclusive' ? 'selected' : '' }}>All Inclusive</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Hotel Location</label>
                                <input type="text" name="hotel_location" class="form-control" value="{{ old('hotel_location', $plan->hotel_location) }}">
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Hotel Description</label>
                                <textarea name="hotel_description" rows="3" class="form-control">{{ old('hotel_description', $plan->hotel_description) }}</textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Hotel Images (comma separated URLs)</label>
                                <input type="text" name="hotel_images" class="form-control" placeholder="https://example.com/image1.jpg,  https://example.com/image2.jpg"  value="{{ old('hotel_images', $plan->hotel_images ? implode(', ', json_decode($plan->hotel_images, true)) : '') }}">
                                @if($plan->hotel_images)
                                    <div class="d-flex flex-wrap mt-2">
                                        @foreach(json_decode($plan->hotel_images, true) as $image)
                                            <img src="{{ $image }}" alt="Hotel Image" class="img-thumbnail me-2 mb-2" style="max-height: 80px;">
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Amenities</label>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="has_wifi" name="has_wifi" {{ $plan->has_wifi ? 'checked' : '' }}>
                                            <label class="form-check-label" for="has_wifi">WiFi</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="has_pool" name="has_pool" {{ $plan->has_pool ? 'checked' : '' }}>
                                            <label class="form-check-label" for="has_pool">Pool</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="has_gym" name="has_gym" {{ $plan->has_gym ? 'checked' : '' }}>
                                            <label class="form-check-label" for="has_gym">Gym</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="has_spa" name="has_spa" {{ $plan->has_spa ? 'checked' : '' }}>
                                            <label class="form-check-label" for="has_spa">Spa</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="has_restaurant" name="has_restaurant" {{ $plan->has_restaurant ? 'checked' : '' }}>
                                            <label class="form-check-label" for="has_restaurant">Restaurant</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Info -->
                    <div class="mb-4">
                        <h5>Additional Information</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Nearby Attractions</label>
                                <textarea name="nearby_attractions" rows="2" class="form-control">{{ old('nearby_attractions', $plan->nearby_attractions) }}</textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Transportation Details</label>
                                <textarea name="transportation_details" rows="2" class="form-control">{{ old('transportation_details', $plan->transportation_details) }}</textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Cancellation Policy</label>
                                <textarea name="cancellation_policy" rows="2" class="form-control">{{ old('cancellation_policy', $plan->cancellation_policy) }}</textarea>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Hotel Phone</label>
                                <input type="text" name="hotel_phone" class="form-control" value="{{ old('hotel_phone', $plan->hotel_phone) }}">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Hotel Email</label>
                                <input type="email" name="hotel_email" class="form-control" value="{{ old('hotel_email', $plan->hotel_email) }}">
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="has_special_offer" name="has_special_offer" {{ old('has_special_offer', $plan->has_special_offer) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="has_special_offer">Has Special Offer</label>
                                </div>
                            </div>
                            <div class="col-md-12 mt-2" id="special_offer_field" style="{{ old('has_special_offer', $plan->has_special_offer) ? '' : 'display: none;' }}">
                                <label class="form-label">Special Offer Details</label>
                                <textarea name="special_offer_details" rows="2" class="form-control">{{ old('special_offer_details', $plan->special_offer_details) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success rounded-pill mt-3">Update Plan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JS to toggle special offer field -->
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkbox = document.getElementById('has_special_offer');
        const field = document.getElementById('special_offer_field');

        if (checkbox && field) {
            checkbox.addEventListener('change', function () {
                field.style.display = this.checked ? 'block' : 'none';
            });
        }
    });
</script>
@endpush
@endsection