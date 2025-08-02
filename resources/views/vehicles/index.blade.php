@extends('layouts.app')

@section('title', 'Rent Vehicles')

@section('content')
<div class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="fw-bold">Rent Vehicles</h1>
            <p class="lead text-muted">Find the perfect vehicle for your travels</p>
        </div>
        
        <div class="row mb-4">
            <div class="col-md-6">
                <form class="d-flex">
                    <input type="text" class="form-control me-2" placeholder="Search vehicles..." aria-label="Search vehicles">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </form>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="vehicleTypeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ request('type') ?: 'All Vehicle Types' }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="vehicleTypeDropdown">
                        <li><a class="dropdown-item" href="{{ route('vehicles.index') }}"><i class="fas fa-car me-2"></i>All Types</a></li>
                        <li><a class="dropdown-item" href="{{ route('vehicles.index') }}?type=Car"><i class="fas fa-car-side me-2"></i>Cars</a></li>
                        <li><a class="dropdown-item" href="{{ route('vehicles.index') }}?type=SUV"><i class="fas fa-truck me-2"></i>SUVs</a></li>
                        <li><a class="dropdown-item" href="{{ route('vehicles.index') }}?type=Van"><i class="fas fa-shuttle-van me-2"></i>Vans</a></li>
                        <li><a class="dropdown-item" href="{{ route('vehicles.index') }}?type=Bike"><i class="fas fa-motorcycle me-2"></i>Bikes</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="row g-4">
            @forelse($vehicles as $vehicle)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    @if($vehicle->images && count($vehicle->images) > 0)
                        <img src="{{ asset('storage/' . $vehicle->images[0]) }}" class="card-img-top" alt="{{ $vehicle->name }}" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="fas fa-car fa-3x text-muted" aria-hidden="true"></i>
                            <span class="visually-hidden">No vehicle image available</span>
                        </div>
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $vehicle->name }}</h5>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="badge bg-primary">{{ $vehicle->type }}</span>
                            <span class="badge bg-info">Capacity: {{ $vehicle->capacity }}</span>
                        </div>
                        <p class="card-text flex-grow-1">{{ Str::limit($vehicle->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="text-primary fw-bold">${{ number_format($vehicle->price_per_day, 2) }}/day</span>
                            <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn btn-sm btn-outline-primary">Rent Now</a>
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <small class="text-muted">Status: 
                            <span class="{{ $vehicle->available ? 'text-success' : 'text-danger' }}">
                                {{ $vehicle->available ? 'Available' : 'Not Available' }}
                            </span>
                        </small>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle me-2"></i>No vehicles found matching your criteria.
                </div>
            </div>
            @endforelse
        </div>
        
        @if($vehicles->hasPages())
        <div class="row mt-4">
            <div class="col-12">
                {{ $vehicles->links() }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection