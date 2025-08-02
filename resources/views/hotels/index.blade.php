@extends('layouts.app')

@section('title', 'Hotels')

@section('content')
<div class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="fw-bold">Our Hotels</h1>
            <p class="lead text-muted">Find the perfect accommodation for your trip</p>
        </div>
        
        <div class="row mb-4">
            <div class="col-md-6">
                <form class="d-flex">
                    <input type="text" class="form-control me-2" placeholder="Search hotels...">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </form>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="dropdown d-inline-block me-2">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="typeDropdown" data-bs-toggle="dropdown">
                        {{ request('type') ?: 'All Types' }}
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('hotels.index') }}">All Types</a></li>
                        <li><a class="dropdown-item" href="{{ route('hotels.index') }}?type=Room only">Room only</a></li>
                        <li><a class="dropdown-item" href="{{ route('hotels.index') }}?type=Bed & Breakfast">Bed & Breakfast</a></li>
                        <li><a class="dropdown-item" href="{{ route('hotels.index') }}?type=Half Board">Half Board</a></li>
                        <li><a class="dropdown-item" href="{{ route('hotels.index') }}?type=All Inclusive">All Inclusive</a></li>
                    </ul>
                </div>
                <div class="dropdown d-inline-block">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="categoryDropdown" data-bs-toggle="dropdown">
                        {{ request('category') ?: 'All Categories' }}
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('hotels.index') }}">All Categories</a></li>
                        <li><a class="dropdown-item" href="{{ route('hotels.index') }}?category=Honeymoon">Honeymoon</a></li>
                        <li><a class="dropdown-item" href="{{ route('hotels.index') }}?category=Family">Family</a></li>
                        <li><a class="dropdown-item" href="{{ route('hotels.index') }}?category=Business">Business</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="row g-4">
            @forelse($hotels as $hotel)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/' . $hotel->image) }}" class="card-img-top" alt="{{ $hotel->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $hotel->name }}</h5>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="badge bg-primary">{{ $hotel->type }}</span>
                            <span class="badge bg-success">{{ $hotel->category }}</span>
                        </div>
                        <p class="card-text">{{ Str::limit($hotel->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-primary fw-bold">${{ number_format($hotel->price_per_night, 2) }}/night</span>
                            <a href="{{ route('hotels.show', $hotel->id) }}" class="btn btn-sm btn-outline-primary">View Plan</a>
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <small class="text-muted">Location: {{ $hotel->location }}</small>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    No hotels found matching your criteria.
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>


<style>
    /* Full screen styling */
    .bg-light {
        min-height: 100vh;
        background-color: #f5f7fa; /* Light blue-gray background */
        padding: 4rem 0 !important;
        margin: 0;
        width: 100%;
    }

    /* Container adjustments */
    .container {
        max-width: 95%;
    }

    /* Card enhancements */
    .card {
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease;
        border: none;
        border-radius: 12px;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .card-img-top {
        height: 200px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .card:hover .card-img-top {
        transform: scale(1.03);
    }

    .card-body {
        flex: 1;
        background-color: #fff;
    }

    .card-footer {
        background-color: #f8f9fa;
    }

    /* Search and filter section */
    .row.mb-4 {
        background-color: rgba(255,255,255,0.9);
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        margin-bottom: 2rem !important;
    }

    /* Badge styling */
    .badge {
        font-size: 0.75rem;
        padding: 0.35em 0.65em;
    }

    /* Button styling */
    .btn-outline-primary {
        border-width: 2px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .text-md-end {
            text-align: left !important;
            margin-top: 1rem;
        }
    }
</style>
@endsection