@extends('layouts.app')

@section('title', 'Travel Plans')

@section('content')
<!-- Hero Carousel Section -->
<div id="travelCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @for($i = 0; $i < 3; $i++) <!-- Adjust number based on your images -->
            <button type="button" data-bs-target="#travelCarousel" data-bs-slide-to="{{ $i }}" class="{{ $i === 0 ? 'active' : '' }}"></button>
        @endfor
    </div>
    <div class="carousel-inner">
        <!-- Replace these with your actual images -->
        <div class="carousel-item active">
            <img src="{{ asset('storage/IMG_E0057.jpg') }}" class="d-block w-100" alt="Travel Image 1" style="height: 500px; object-fit: cover;">
            <div class="carousel-caption d-none d-md-block">
                <h5>First Image Title</h5>
                <p>Description for first image</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{ asset('storage/IMG_E0032.jpg') }}" class="d-block w-100" alt="Travel Image 2" style="height: 500px; object-fit: cover;">
            <div class="carousel-caption d-none d-md-block">
                <h5>Second Image Title</h5>
                <p>Description for second image</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{ asset('storage/IMG_E9996.jpg') }}" class="d-block w-100" alt="Travel Image 3" style="height: 500px; object-fit: cover;">
            <div class="carousel-caption d-none d-md-block">
                <h5>Third Image Title</h5>
                <p>Description for third image</p>
            </div>
        </div>
        <!-- Add more items if you have more images -->
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#travelCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#travelCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- Original Content (unchanged) -->
<div class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="fw-bold">Our Travel Plans</h1>
            <p class="lead text-muted">Explore our carefully curated travel packages</p>
        </div>
        
        <div class="row g-4">
            @foreach($plans as $plan)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/' . $plan->image) }}" class="card-img-top" alt="{{ $plan->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $plan->title }}</h5>
                        <p class="card-text">{{ $plan->short_description }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-primary fw-bold">${{ number_format($plan->price_per_person, 2) }}/person</span>
                            <a href="{{ route('plans.show', $plan->id) }}" class="btn btn-sm btn-outline-primary">View Plan</a>
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <small class="text-muted">Starts from {{ $plan->start_location }} on {{ $plan->start_date->format('M d, Y') }}</small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    /* Carousel Styles */
    .carousel-item {
        height: 500px;
    }
    
    .carousel-caption {
        background-color: rgba(0, 0, 0, 0.5);
        padding: 20px;
        border-radius: 10px;
    }
    
    /* Original Styles (unchanged) */
    .full-screen-light {
        min-height: 100vh;
        padding: 4rem 0 !important;
        margin: 0;
        width: 100%;
    }
    
    .full-screen-container {
        width: 100%;
        max-width: 100%;
        padding: 0 2rem;
    }
    
    .bg-light {
        background-color: #f8f9fa;
        background-image: linear-gradient(to bottom, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.9) 100%), 
                          url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        background-blend-mode: overlay;
    }
    
    .card {
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
    }
    
    .card-img-top {
        height: 200px;
        object-fit: cover;
    }
    
    .card-body {
        flex: 1;
    }
</style>

<!-- Initialize the carousel with auto-rotation -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var myCarousel = new bootstrap.Carousel(document.getElementById('travelCarousel'), {
            interval: 3000, // Change slide every 3 seconds
            ride: 'carousel'
        });
    });
</script>
@endsection