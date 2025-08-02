@extends('layouts.app')

@section('title', $plan->title)

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="mb-4">
                    <h1 class="fw-bold">{{ $plan->title }}</h1>
                    <div class="d-flex align-items-center mb-3">
                        <span class="badge bg-primary me-2">Starting from {{ $plan->start_location }}</span>
                        <span class="badge bg-success">{{ $plan->start_date->format('M d, Y') }}</span>
                    </div>
                    <img src="{{ asset('storage/' . $plan->image) }}" alt="{{ $plan->title }}" class="img-fluid rounded mb-4">
                    <div class="mb-4">
                        <h4>About This Plan</h4>
                        <p>{{ $plan->full_description }}</p>
                    </div>
                </div>
                
                <!-- Hotel Information -->
                @if($plan->hotel_name)
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0">Hotel Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                @if($plan->hotel_images)
                                    <div id="hotelCarousel" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                        @foreach(json_decode($plan->hotel_images, true) as $index => $image)
    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
        <img src="{{ asset($image) }}" 
             class="d-block w-100 rounded" 
             alt="Hotel Image"
             loading="lazy"
             onerror="this.onerror=null;this.src='{{ asset('images/default-hotel.jpg') }}'">
    </div>
@endforeach
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#hotelCarousel" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#hotelCarousel" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-8">
                                <h3>{{ $plan->hotel_name }}</h3>
                                @if($plan->hotel_rating)
                                    <span class="badge bg-warning text-dark mb-2">{{ $plan->hotel_rating }}</span>
                                @endif
                                <p><i class="bi bi-geo-alt"></i> {{ $plan->hotel_location }}</p>
                                
                                <div class="mb-3">
                                    <h5>Description</h5>
                                    <p>{{ $plan->hotel_description }}</p>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <h5>Room Details</h5>
                                        <p><strong>Type:</strong> {{ $plan->room_type }}</p>
                                        <p><strong>Nights Included:</strong> {{ $plan->nights_included }}</p>
                                        <p><strong>Meal Plan:</strong> {{ $plan->meal_plan }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Amenities</h5>
                                        <div class="d-flex flex-wrap">
                                            @if($plan->has_wifi)<span class="badge bg-light text-dark me-2 mb-2"><i class="bi bi-wifi"></i> WiFi</span>@endif
                                            @if($plan->has_pool)<span class="badge bg-light text-dark me-2 mb-2"><i class="bi bi-water"></i> Pool</span>@endif
                                            @if($plan->has_gym)<span class="badge bg-light text-dark me-2 mb-2"><i class="bi bi-activity"></i> Gym</span>@endif
                                            @if($plan->has_spa)<span class="badge bg-light text-dark me-2 mb-2"><i class="bi bi-flower1"></i> Spa</span>@endif
                                            @if($plan->has_restaurant)<span class="badge bg-light text-dark me-2 mb-2"><i class="bi bi-cup-hot"></i> Restaurant</span>@endif
                                        </div>
                                    </div>
                                </div>
                                
                                @if($plan->hotel_phone || $plan->hotel_email)
                                <div class="mb-3">
                                    <h5>Contact Information</h5>
                                    @if($plan->hotel_phone)<p><i class="bi bi-telephone"></i> {{ $plan->hotel_phone }}</p>@endif
                                    @if($plan->hotel_email)<p><i class="bi bi-envelope"></i> {{ $plan->hotel_email }}</p>@endif
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- Additional Information -->
                <div class="card mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h4 class="mb-0">Additional Information</h4>
                    </div>
                    <div class="card-body">
                        @if($plan->nearby_attractions)
                        <div class="mb-3">
                            <h5>Nearby Attractions</h5>
                            <p>{{ $plan->nearby_attractions }}</p>
                        </div>
                        @endif
                        
                        @if($plan->transportation_details)
                        <div class="mb-3">
                            <h5>Transportation Details</h5>
                            <p>{{ $plan->transportation_details }}</p>
                        </div>
                        @endif
                        
                        @if($plan->cancellation_policy)
                        <div class="mb-3">
                            <h5>Cancellation Policy</h5>
                            <p>{{ $plan->cancellation_policy }}</p>
                        </div>
                        @endif
                        
                        @if($plan->has_special_offer && $plan->special_offer_details)
                        <div class="alert alert-warning">
                            <h5><i class="bi bi-star-fill"></i> Special Offer</h5>
                            <p>{{ $plan->special_offer_details }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card shadow-sm sticky-top" style="top: 20px;">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Plan Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h6>Price per person</h6>
                            <h4 class="text-primary">${{ number_format($plan->price_per_person, 2) }}</h4>
                        </div>
                        
                        <div class="mb-4">
                            <h6>Starting Location</h6>
                            <p>{{ $plan->start_location }}</p>
                            
                            <h6>Start Date</h6>
                            <p>{{ $plan->start_date->format('M d, Y') }}</p>
                            
                            @if($plan->hotel_name)
                            <h6>Hotel</h6>
                            <p>{{ $plan->hotel_name }}</p>
                            
                            <h6>Nights Included</h6>
                            <p>{{ $plan->nights_included }}</p>
                            @endif
                        </div>
                        
                        @auth
                            <a href="{{ route('bookings.create', $plan->id) }}" class="btn btn-primary w-100">Book This Plan</a>
                        @else
                            <div class="alert alert-info">
                                <p class="mb-2">Please login to book this plan</p>
                                <a href="{{ route('login') }}" class="btn btn-sm btn-primary me-2">Login</a>
                                <a href="{{ route('register') }}" class="btn btn-sm btn-outline-primary">Register</a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection