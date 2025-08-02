@extends('layouts.app')

@section('title', 'Home')
@section('styles')
<style>
    /* Hero Section Enhancement */
    /* Full-screen video hero fix */
    .hero-section {
        position: relative;
        height: 100vh;
        min-height: 600px; /* Fallback for mobile */
        width: 100%;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .hero-video {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        min-width: 100%;
        min-height: 100%;
        width: auto;
        height: auto;
        z-index: -1;
        object-fit: cover;
        filter: brightness(0.8);
    }
    
    /* Fallback for mobile devices */
    @media (max-aspect-ratio: 16/9) {
        .hero-video {
            width: auto;
            height: 100%;
        }
    }
    
    @media (min-aspect-ratio: 16/9) {
        .hero-video {
            width: 100%;
            height: auto;
        }
    }
    
    /* Ensure content stays centered */
    .hero-content {
        position: relative;
        z-index: 2;
        width: 100%;
        text-align: center;
        padding: 20px;
    }
    
    .hero-content h1 {
        font-size: 3.5rem;
        text-shadow: 2px 2px 8px rgba(0,0,0,0.3);
        margin-bottom: 1.5rem;
    }
    
    .hero-content .lead {
        font-size: 1.5rem;
        text-shadow: 1px 1px 4px rgba(0,0,0,0.3);
        margin-bottom: 2.5rem;
    }
    
    /* Feature Cards Enhancement */
    .feature-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.2);
    }
    
    .feature-card .card-img-top {
        height: 200px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .feature-card:hover .card-img-top {
        transform: scale(1.05);
    }
    
    .feature-card .card-body {
        padding: 1.5rem;
    }
    
    .feature-card .card-title {
        color: #0062b9;
        font-weight: 600;
    }
    
    /* Section Styling */
    .bg-light {
        background-color: #f8fafc !important;
    }
    
    /* About Section */
    .py-5:not(.bg-primary):not(.bg-light) {
        background-color: white;
    }
    
    /* CTA Section */
    .bg-primary {
        background: linear-gradient(135deg, #0062b9 0%, #00a896 100%) !important;
        padding: 5rem 0 !important;
    }
    
    /* Buttons */
    .btn-primary {
        background-color: #0062b9;
        border-color: #0062b9;
        padding: 0.5rem 1.5rem;
    }
    
    .btn-outline-primary {
        border-color: #0062b9;
        color: #0062b9;
    }
    
    .btn-outline-primary:hover {
        background-color: #0062b9;
        color: white;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .hero-content h1 {
            font-size: 2.5rem;
        }
        
        .hero-content .lead {
            font-size: 1.2rem;
        }
    }
</style>
@endsection

@section('content')
<div class="hero-section">
    <video autoplay muted loop class="hero-video">
        <source src="{{ asset('videos/homevideo.mp4.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="hero-content">
        <div class="container">
            <h1 class="display-3 fw-bold mb-4">Discover Your Next Adventure</h1>
            <p class="lead mb-5">Plan your perfect trip with our comprehensive travel services</p>
            <a href="{{ route('plans.index') }}" class="btn btn-primary btn-lg px-4 me-2">Explore Plans</a>
            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-4">Join Now</a>
        </div>
    </div>
</div>

<div class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Why Choose Our Travel Planner?</h2>
            <p class="lead text-muted">We provide everything you need for a perfect vacation</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card feature-card h-100 shadow-sm">
                    <img src="{{ asset('images/travel-plans.jpg') }}" class="card-img-top" alt="Travel Plans">
                    <div class="card-body">
                        <h5 class="card-title">Custom Travel Plans</h5>
                        <p class="card-text">Explore our carefully curated travel plans to the most beautiful destinations around the world.</p>
                        <a href="{{ route('plans.index') }}" class="btn btn-outline-primary">View Plans</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card feature-card h-100 shadow-sm">
                    <img src="{{ asset('images/hotels.jpg') }}" class="card-img-top" alt="Hotels">
                    <div class="card-body">
                        <h5 class="card-title">Premium Accommodations</h5>
                        <p class="card-text">Find the perfect place to stay with our wide selection of hotels and resorts.</p>
                        <a href="{{ route('hotels.index') }}" class="btn btn-outline-primary">Browse Hotels</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card feature-card h-100 shadow-sm">
                    <img src="{{ asset('images/vehicles.jpg') }}" class="card-img-top" alt="Vehicles">
                    <div class="card-body">
                        <h5 class="card-title">Vehicle Rentals</h5>
                        <p class="card-text">Rent the perfect vehicle for your travels, from economy cars to luxury SUVs.</p>
                        <a href="{{ route('vehicles.index') }}" class="btn btn-outline-primary">Rent Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-4">About Our Travel Planner</h2>
                <p class="lead">We're dedicated to making your travel planning experience seamless and enjoyable.</p>
                <p>Our platform brings together all the elements you need for a perfect trip - from travel plans and hotel bookings to vehicle rentals and travel gear. With our expert-curated options and easy-to-use interface, you can plan your entire vacation in one place.</p>
                <a href="{{ route('about') }}" class="btn btn-primary mt-3">Learn More</a>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('images/about-travel.jpg') }}" alt="About Travel Planner" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</div>

<div class="py-5 bg-primary text-white">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">Ready to Start Your Journey?</h2>
        <p class="lead mb-5">Join thousands of travelers who have planned their perfect trips with us</p>
        <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4 me-2">Sign Up Free</a>
        <a href="{{ route('plans.index') }}" class="btn btn-outline-light btn-lg px-4">Browse Plans</a>
    </div>
</div>
@endsection