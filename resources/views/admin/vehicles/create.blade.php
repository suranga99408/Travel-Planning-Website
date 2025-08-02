@extends('admin.admin')

@section('title', 'Add New Vehicle')
@section('header', 'Add New Vehicle')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-sm rounded-lg">
            <div class="card-body p-4">
                <form action="{{ route('admin.vehicles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Basic Info -->
                    <div class="mb-4">
                        <h5>Basic Information</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Name *</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Type (Car/SUV/Bike etc.) *</label>
                                <input type="text" name="type" class="form-control" placeholder="e.g., Car, SUV, Bike" required>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Category (Sedan, SUV, etc.)</label>
                                <input type="text" name="category" class="form-control" placeholder="e.g., Luxury, Economy">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Price per Day *</label>
                                <input type="number" step="0.01" name="price_per_day" class="form-control" required>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Transmission *</label>
                                <input type="text" name="transmission" value="Automatic" class="form-control" required>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Fuel Type *</label>
                                <input type="text" name="fuel_type" value="Petrol" class="form-control" required>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Capacity *</label>
                                <input type="number" name="capacity" class="form-control" value="5" required>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Location *</label>
                                <input type="text" name="location" class="form-control" value="Airport" required>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Description *</label>
                                <textarea name="description" rows="3" class="form-control" required></textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Features (one per line)</label>
                                <textarea name="features" rows="4" class="form-control" placeholder="e.g., GPS, Sunroof, Bluetooth"></textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Upload Images</label>
                                <input type="file" name="images[]" multiple class="form-control" required>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="available" name="available" checked>
                                    <label class="form-check-label" for="available">Available for Rent</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success rounded-pill mt-3">Save Vehicle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection