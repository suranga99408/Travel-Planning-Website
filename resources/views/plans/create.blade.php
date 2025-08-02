@extends('layouts.app')

@section('title', 'Create New Travel Plan')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Create New Travel Plan</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('plans.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Basic Plan Information -->
                        <div class="mb-4">
                            <h5>Basic Information</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="title" class="form-label">Plan Title*</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="price_per_person" class="form-label">Price Per Person*</label>
                                    <input type="number" step="0.01" class="form-control" id="price_per_person" name="price_per_person" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="start_date" class="form-label">Start Date*</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="start_location" class="form-label">Start Location*</label>
                                    <input type="text" class="form-control" id="start_location" name="start_location" required>
                                </div>
                                <div class="col-12">
                                    <label for="short_description" class="form-label">Short Description*</label>
                                    <textarea class="form-control" id="short_description" name="short_description" rows="2" required></textarea>
                                </div>
                                <div class="col-12">
                                    <label for="full_description" class="form-label">Full Description*</label>
                                    <textarea class="form-control" id="full_description" name="full_description" rows="4" required></textarea>
                                </div>
                                <div class="col-12">
                                    <label for="image" class="form-label">Plan Image*</label>
                                    <input type="file" class="form-control" id="image" name="image" required>
                                </div>
                            </div>
                        </div>

                        <!-- Hotel Information -->
                        <div class="mb-4">
                            <h5>Hotel Details</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="hotel_name" class="form-label">Hotel Name</label>
                                    <input type="text" class="form-control" id="hotel_name" name="hotel_name">
                                </div>
                                <div class="col-md-6">
                                    <label for="hotel_rating" class="form-label">Hotel Rating</label>
                                    <select class="form-select" id="hotel_rating" name="hotel_rating">
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
                                <div class="col-md-6">
                                    <label for="room_type" class="form-label">Room Type</label>
                                    <input type="text" class="form-control" id="room_type" name="room_type" placeholder="e.g., Deluxe Room, Suite">
                                </div>
                                <div class="col-md-6">
                                    <label for="nights_included" class="form-label">Nights Included</label>
                                    <input type="number" class="form-control" id="nights_included" name="nights_included" value="1" min="1">
                                </div>
                                <div class="col-md-6">
                                    <label for="meal_plan" class="form-label">Meal Plan</label>
                                    <select class="form-select" id="meal_plan" name="meal_plan">
                                        <option value="Bed & Breakfast">Bed & Breakfast</option>
                                        <option value="Room Only">Room Only</option>
                                        <option value="Half Board">Half Board</option>
                                        <option value="Full Board">Full Board</option>
                                        <option value="All Inclusive">All Inclusive</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="hotel_location" class="form-label">Hotel Location</label>
                                    <input type="text" class="form-control" id="hotel_location" name="hotel_location">
                                </div>
                                <div class="col-12">
                                    <label for="hotel_description" class="form-label">Hotel Description</label>
                                    <textarea class="form-control" id="hotel_description" name="hotel_description" rows="3"></textarea>
                                </div>
                                <div class="col-12">
                                    <label for="hotel_images" class="form-label">Hotel Images (comma separated URLs)</label>
                                    <input type="text" class="form-control" id="hotel_images" name="hotel_images" placeholder="https://example.com/image1.jpg, https://example.com/image2.jpg">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Amenities</label>
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
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div class="mb-4">
                            <h5>Additional Information</h5>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="nearby_attractions" class="form-label">Nearby Attractions</label>
                                    <textarea class="form-control" id="nearby_attractions" name="nearby_attractions" rows="2"></textarea>
                                </div>
                                <div class="col-12">
                                    <label for="transportation_details" class="form-label">Transportation Details</label>
                                    <textarea class="form-control" id="transportation_details" name="transportation_details" rows="2"></textarea>
                                </div>
                                <div class="col-12">
                                    <label for="cancellation_policy" class="form-label">Cancellation Policy</label>
                                    <textarea class="form-control" id="cancellation_policy" name="cancellation_policy" rows="2"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="hotel_phone" class="form-label">Hotel Phone</label>
                                    <input type="text" class="form-control" id="hotel_phone" name="hotel_phone">
                                </div>
                                <div class="col-md-6">
                                    <label for="hotel_email" class="form-label">Hotel Email</label>
                                    <input type="email" class="form-control" id="hotel_email" name="hotel_email">
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="has_special_offer" name="has_special_offer">
                                        <label class="form-check-label" for="has_special_offer">Has Special Offer</label>
                                    </div>
                                </div>
                                <div class="col-12" id="special_offer_field" style="display: none;">
                                    <label for="special_offer_details" class="form-label">Special Offer Details</label>
                                    <textarea class="form-control" id="special_offer_details" name="special_offer_details" rows="2"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Create Plan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle special offer details field
        const specialOfferCheckbox = document.getElementById('has_special_offer');
        const specialOfferField = document.getElementById('special_offer_field');
        
        specialOfferCheckbox.addEventListener('change', function() {
            specialOfferField.style.display = this.checked ? 'block' : 'none';
        });
    });
</script>
@endsection
@endsection