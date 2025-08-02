@extends('admin.admin')

@section('title', 'Edit Vehicle - ' . $vehicle->name)
@section('header', 'Edit Vehicle')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-sm rounded-lg">
            <div class="card-body p-4">
                <form action="{{ route('admin.vehicles.update', $vehicle->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Basic Info -->
                    <div class="mb-4">
                        <h5>Basic Information</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Name *</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $vehicle->name) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Type (Car/SUV/Bike etc.) *</label>
                                <input type="text" name="type" class="form-control" value="{{ old('type', $vehicle->type) }}" required>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Category (Sedan, SUV, etc.)</label>
                                <input type="text" name="category" class="form-control" value="{{ old('category', $vehicle->category) }}">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Price per Day *</label>
                                <input type="number" step="0.01" name="price_per_day" class="form-control" value="{{ old('price_per_day', $vehicle->price_per_day) }}" required>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Transmission *</label>
                                <input type="text" name="transmission" class="form-control" value="{{ old('transmission', $vehicle->transmission) }}" required>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Fuel Type *</label>
                                <input type="text" name="fuel_type" class="form-control" value="{{ old('fuel_type', $vehicle->fuel_type) }}" required>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Capacity *</label>
                                <input type="number" name="capacity" class="form-control" value="{{ old('capacity', $vehicle->capacity) }}" required>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Location *</label>
                                <input type="text" name="location" class="form-control" value="{{ old('location', $vehicle->location) }}" required>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Description *</label>
                                <textarea name="description" rows="3" class="form-control" required>{{ old('description', $vehicle->description) }}</textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Features (one per line)</label>
                                <textarea name="features" rows="4" class="form-control">{{ old('features', implode("\n", $vehicle->features ?: [])) }}</textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Upload New Images</label>
                                <input type="file" name="images[]" multiple class="form-control">
                                @if(is_array($vehicle->images))
                                    <div class="mt-2">
                                        @foreach($vehicle->images as $image)
                                            <img src="{{ asset('storage/' . $image) }}" alt="Vehicle Image" width="100" class="me-2 mt-2">
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="available" name="available" {{ $vehicle->available ? 'checked' : '' }}>
                                    <label class="form-check-label" for="available">Available for Rent</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success rounded-pill mt-3">Update Vehicle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection