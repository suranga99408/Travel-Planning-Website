@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="fw-bold">About Travel Planner</h1>
            <p class="lead text-muted">Your perfect travel companion</p>
        </div>
        
        <div class="row align-items-center mb-5">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-4">Our Story</h2>
                <p>Founded in 2023, Travel Planner was born out of a passion for making travel planning easier and more enjoyable. We understand how overwhelming it can be to organize all the elements of a trip - from accommodations and transportation to activities and gear.</p>
                <p>Our mission is to provide a one-stop platform where travelers can plan their entire vacation, with carefully curated options and seamless booking processes.</p>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('images/about-story.jpg') }}" alt="Our Story" class="img-fluid rounded shadow">
            </div>
        </div>
        
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 order-lg-2">
                <h2 class="fw-bold mb-4">Our Team</h2>
                <p>We're a team of travel enthusiasts, tech experts, and customer service professionals dedicated to creating the best travel planning experience.</p>
                <p>With decades of combined experience in the travel industry, we've handpicked every hotel, vehicle, and travel plan to ensure quality and reliability.</p>
            </div>
            <div class="col-lg-6 order-lg-1">
                <img src="{{ asset('images/about-team.jpg') }}" alt="Our Team" class="img-fluid rounded shadow">
            </div>
        </div>
        
        <div class="text-center my-5">
            <h2 class="fw-bold mb-4">Contact Us</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-envelope fs-1 text-primary mb-3"></i>
                            <h5>Email</h5>
                            <p class="mb-0">info@travelplanner.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-telephone fs-1 text-primary mb-3"></i>
                            <h5>Phone</h5>
                            <p class="mb-0">+1 (123) 456-7890</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-geo-alt fs-1 text-primary mb-3"></i>
                            <h5>Address</h5>
                            <p class="mb-0">123 Travel Street, Adventure City, 12345</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="my-5">
            <h2 class="fw-bold text-center mb-4">Photo Gallery</h2>
            <div class="row g-3">
                <div class="col-md-4">
                    <img src="{{ asset('images/gallery1.jpg') }}" alt="Gallery Image 1" class="img-fluid rounded shadow">
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('images/gallery2.jpg') }}" alt="Gallery Image 2" class="img-fluid rounded shadow">
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('images/gallery3.jpg') }}" alt="Gallery Image 3" class="img-fluid rounded shadow">
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('images/gallery4.jpg') }}" alt="Gallery Image 4" class="img-fluid rounded shadow">
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('images/gallery5.jpg') }}" alt="Gallery Image 5" class="img-fluid rounded shadow">
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('images/gallery6.jpg') }}" alt="Gallery Image 6" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection