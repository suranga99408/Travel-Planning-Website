@extends('layouts.app')

@section('title', $hotel->name)

@section('styles')
<style>
    :root {
        --primary-color: #3490dc;
        --secondary-color: #6c757d;
        --accent-color: #ff6b6b;
        --light-bg: #f8f9fa;
        --dark-text: #2d3748;
        --light-text: #718096;
    }
    
    .hotel-header {
        position: relative;
        height: 500px;
        overflow: hidden;
        border-radius: 12px;
        margin-bottom: 40px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    .hotel-gallery {
        height: 100%;
        background-color: var(--light-bg);
        position: relative;
    }
    
    .hotel-main-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .hotel-gallery:hover .hotel-main-image {
        transform: scale(1.02);
    }
    
    .hotel-thumbnails {
        display: flex;
        margin-top: 20px;
        overflow-x: auto;
        padding-bottom: 10px;
    }
    
    .hotel-thumbnail {
        width: 120px;
        height: 80px;
        object-fit: cover;
        margin-right: 15px;
        border-radius: 8px;
        cursor: pointer;
        border: 3px solid transparent;
        transition: all 0.3s ease;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .hotel-thumbnail:hover, .hotel-thumbnail.active {
        border-color: var(--primary-color);
        transform: translateY(-5px);
    }
    
    .amenity-badge {
        margin-right: 10px;
        margin-bottom: 10px;
        padding: 10px 15px;
        background-color: white;
        border-radius: 25px;
        display: inline-flex;
        align-items: center;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
    }
    
    .amenity-badge:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .amenity-icon {
        margin-right: 8px;
        color: var(--primary-color);
        font-size: 1.2rem;
    }
    
    .room-card {
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 25px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        transition: all 0.4s ease;
        background: white;
        border: none;
    }
    
    .room-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }
    
    .room-card img {
        height: 200px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .room-card:hover img {
        transform: scale(1.05);
    }
    
    .rating-stars {
        color: #ffc107;
        font-size: 1.3rem;
        letter-spacing: 2px;
    }
    
    .price-highlight {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--primary-color);
        position: relative;
    }
    
    .price-highlight::before {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 50px;
        height: 3px;
        background: var(--primary-color);
    }
    
    .section-title {
        position: relative;
        padding-bottom: 15px;
        margin-bottom: 25px;
        font-weight: 600;
        color: var(--dark-text);
    }
    
    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        border-radius: 2px;
    }
    
    .contact-info {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        padding: 15px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }
    
    .contact-info:hover {
        transform: translateX(5px);
    }
    
    .contact-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--primary-color);
        color: white;
        border-radius: 50%;
        margin-right: 15px;
        font-size: 1.2rem;
    }
    
    .map-container {
        height: 300px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .booking-card {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border: none;
    }
    
    .booking-card .card-header {
        background: linear-gradient(135deg, var(--primary-color), #4a7dff);
        padding: 20px;
    }
    
    .btn-book-now {
        background: linear-gradient(135deg, var(--primary-color), #4a7dff);
        border: none;
        padding: 15px 30px;
        font-size: 1.1rem;
        font-weight: 600;
        letter-spacing: 1px;
        border-radius: 50px;
        box-shadow: 0 5px 15px rgba(52, 144, 220, 0.4);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .btn-book-now:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(52, 144, 220, 0.6);
    }
    
    .btn-book-now::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: 0.5s;
    }
    
    .btn-book-now:hover::before {
        left: 100%;
    }
    
    .policy-item {
        background: white;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .policy-item h5 {
        color: var(--primary-color);
        margin-bottom: 10px;
    }
    
    .attraction-card {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: all 0.4s ease;
        height: 100%;
        border: none;
    }
    
    .attraction-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }
    
    .attraction-card img {
        height: 150px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .attraction-card:hover img {
        transform: scale(1.1);
    }
    
    .attraction-card .card-body {
        padding: 20px;
    }
    
    .attraction-card .card-title {
        font-weight: 600;
        color: var(--dark-text);
    }
    
    .attraction-card .card-text {
        color: var(--light-text);
        font-size: 0.9rem;
    }
    
    .floating-book-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 1000;
        box-shadow: 0 10px 30px rgba(52, 144, 220, 0.4);
    }
    
    @media (max-width: 768px) {
        .hotel-header {
            height: 350px;
        }
        
        .floating-book-btn {
            bottom: 20px;
            right: 20px;
            width: calc(100% - 40px);
        }
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Hotel Gallery -->
            <div class="hotel-header">
                <div class="hotel-gallery">
                    @if($hotel->images && count($hotel->images) > 0)
                        <img src="{{ Storage::url($hotel->images[0]) }}" alt="{{ $hotel->name }}" class="hotel-main-image" id="mainHotelImage">
                    @else
                        <div class="d-flex align-items-center justify-content-center h-100 bg-light">
                            <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                        </div>
                    @endif
                </div>
            </div>
            
            @if($hotel->images && count($hotel->images) > 1)
            <div class="hotel-thumbnails">
                @foreach($hotel->images as $image)
                <img src="{{ Storage::url($image) }}" alt="Hotel Image" class="hotel-thumbnail {{ $loop->first ? 'active' : '' }}" 
                     onclick="document.getElementById('mainHotelImage').src = this.src; 
                              document.querySelectorAll('.hotel-thumbnail').forEach(t => t.classList.remove('active'));
                              this.classList.add('active');">
                @endforeach
            </div>
            @endif
            
            <!-- Hotel Info -->
            <div class="mb-5">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h1 class="mb-2">{{ $hotel->name }}</h1>
                        <div class="d-flex align-items-center mb-3">
                            <div class="rating-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= str_replace('-star', '', $hotel->rating))
                                        <i class="bi bi-star-fill"></i>
                                    @else
                                        <i class="bi bi-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="badge bg-primary ms-3" style="font-size: 0.9rem; padding: 5px 10px;">{{ $hotel->rating }}</span>
                        </div>
                        <p class="text-muted mb-0"><i class="bi bi-geo-alt-fill me-2"></i> {{ $hotel->location }}</p>
                    </div>
                    <div class="text-end">
                        <div class="price-highlight">${{ number_format($hotel->price_per_night, 2) }}</div>
                        <small class="text-muted">per night</small>
                    </div>
                </div>
                
                <p class="lead mb-4">{{ $hotel->description }}</p>
                
                <!-- Amenities -->
                <h4 class="section-title">Amenities</h4>
                <div class="mb-5">
                    @if($hotel->has_wifi)
                    <span class="amenity-badge">
                        <i class="bi bi-wifi amenity-icon"></i> Free WiFi
                    </span>
                    @endif
                    
                    @if($hotel->has_pool)
                    <span class="amenity-badge">
                        <i class="bi bi-water amenity-icon"></i> Swimming Pool
                    </span>
                    @endif
                    
                    @if($hotel->has_gym)
                    <span class="amenity-badge">
                        <i class="bi bi-activity amenity-icon"></i> Fitness Center
                    </span>
                    @endif
                    
                    @if($hotel->has_spa)
                    <span class="amenity-badge">
                        <i class="bi bi-flower1 amenity-icon"></i> Spa Services
                    </span>
                    @endif
                    
                    @if($hotel->has_restaurant)
                    <span class="amenity-badge">
                        <i class="bi bi-cup-hot amenity-icon"></i> On-site Restaurant
                    </span>
                    @endif
                    
                    @if($hotel->meal_plan)
                    <span class="amenity-badge">
                        <i class="bi bi-egg-fried amenity-icon"></i> {{ $hotel->meal_plan }} Plan
                    </span>
                    @endif
                </div>
                
                <!-- Room Types -->
                <h4 class="section-title">Room Types</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="room-card card">
                            <img src="{{ asset('storage/rooms/standard/kh5.jpg') }}" class="card-img-top" alt="Standard Room">
                            <div class="card-body">
                                <h5 class="card-title">Standard Room</h5>
                                <p class="card-text text-muted">Comfortable room with all basic amenities including a queen bed, work desk, and modern bathroom.</p>
                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <span class="text-primary fw-bold">${{ number_format($hotel->price_per_night * 0.8, 2) }}</span>
                                    <button class="btn btn-sm btn-outline-primary px-3">View Details</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="room-card card">
                            <img src="{{ asset('storage/rooms/deluxe/kh8.jpeg') }}" class="card-img-top" alt="Deluxe Room">
                            <div class="card-body">
                                <h5 class="card-title">Deluxe Room</h5>
                                <p class="card-text text-muted">Spacious room with premium amenities including king bed, sitting area, and luxury bathroom.</p>
                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <span class="text-primary fw-bold">${{ number_format($hotel->price_per_night, 2) }}</span>
                                    <button class="btn btn-sm btn-outline-primary px-3">View Details</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="room-card card">
                            <img src="{{ asset('storage/rooms/suite/kh9.jpeg') }}" class="card-img-top" alt="Suite">
                            <div class="card-body">
                                <h5 class="card-title">Executive Suite</h5>
                                <p class="card-text text-muted">Luxurious suite with separate living area, bedroom, and premium bathroom amenities.</p>
                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <span class="text-primary fw-bold">${{ number_format($hotel->price_per_night * 1.5, 2) }}</span>
                                    <button class="btn btn-sm btn-outline-primary px-3">View Details</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Hotel Policies -->
                <h4 class="section-title">Policies</h4>
                <div class="mb-5">
                    <div class="policy-item">
                        <h5><i class="bi bi-x-circle-fill me-2"></i> Cancellation Policy</h5>
                        <p class="mb-0">Free cancellation up to 7 days before check-in. Cancellations within 7 days will incur a one-night charge.</p>
                    </div>
                    
                    <div class="policy-item">
                        <h5><i class="bi bi-clock-fill me-2"></i> Check-in/Check-out</h5>
                        <p class="mb-0">Check-in: 2:00 PM | Check-out: 12:00 PM. Early check-in and late check-out available upon request.</p>
                    </div>
                    
                    <div class="policy-item">
                        <h5><i class="bi bi-people-fill me-2"></i> Children & Extra Beds</h5>
                        <p class="mb-0">Children under 12 stay free when using existing bedding. Extra beds available for $20 per night.</p>
                    </div>
                </div>
                
                <!-- Nearby Attractions -->
                <h4 class="section-title">Nearby Attractions</h4>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="attraction-card card">
                            <img src="{{ asset('storage/attractions/local-market/m1.jpeg') }}" class="card-img-top" alt="Local Market">
                            <div class="card-body">
                                <h6 class="card-title">Local Market</h6>
                                <p class="card-text small"><i class="bi bi-geo-alt-fill me-1"></i> 0.5 km away</p>
                                <p class="card-text small text-muted">Explore local crafts and traditional products at this vibrant market.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="attraction-card card">
                            <img src="{{ asset('storage/attractions/city-park/m2.jpeg') }}" class="card-img-top" alt="City Park">
                            <div class="card-body">
                                <h6 class="card-title">City Park</h6>
                                <p class="card-text small"><i class="bi bi-geo-alt-fill me-1"></i> 1.2 km away</p>
                                <p class="card-text small text-muted">Beautiful green space perfect for picnics and leisurely walks.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="attraction-card card">
                            <img src="{{ asset('storage/attractions/museum/m3.jpeg') }}" class="card-img-top" alt="Museum">
                            <div class="card-body">
                                <h6 class="card-title">City Museum</h6>
                                <p class="card-text small"><i class="bi bi-geo-alt-fill me-1"></i> 2.0 km away</p>
                                <p class="card-text small text-muted">Discover the rich history and culture of our region.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="sticky-top" style="top: 20px;">
                <!-- Booking Widget -->
                <div class="booking-card card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0 text-white">Book Your Stay</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="checkIn" class="form-label fw-bold">Check-in Date</label>
                                <input type="date" class="form-control py-2" id="checkIn">
                            </div>
                            <div class="mb-3">
                                <label for="checkOut" class="form-label fw-bold">Check-out Date</label>
                                <input type="date" class="form-control py-2" id="checkOut">
                            </div>
                            <div class="mb-3">
                                <label for="guests" class="form-label fw-bold">Guests</label>
                                <select class="form-select py-2" id="guests">
                                    <option value="1">1 Adult</option>
                                    <option value="2" selected>2 Adults</option>
                                    <option value="3">3 Adults</option>
                                    <option value="4">4 Adults</option>
                                    <option value="family">Family (2 Adults + 2 Children)</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="roomType" class="form-label fw-bold">Room Type</label>
                                <select class="form-select py-2" id="roomType">
                                    <option value="standard">Standard Room</option>
                                    <option value="deluxe">Deluxe Room</option>
                                    <option value="suite">Executive Suite</option>
                                </select>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary py-2 fw-bold">Check Availability</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Contact Information -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Contact Information</h5>
                    </div>
                    <div class="card-body p-3">
                        <div class="contact-info">
                            <i class="bi bi-geo-alt-fill contact-icon"></i>
                            <div>
                                <h6 class="mb-0 fw-bold">Address</h6>
                                <p class="mb-0 small">{{ $hotel->location }}</p>
                            </div>
                        </div>
                        <div class="contact-info">
                            <i class="bi bi-telephone-fill contact-icon"></i>
                            <div>
                                <h6 class="mb-0 fw-bold">Phone</h6>
                                <p class="mb-0 small">{{ $hotel->phone ?? 'Not available' }}</p>
                            </div>
                        </div>
                        <div class="contact-info">
                            <i class="bi bi-envelope-fill contact-icon"></i>
                            <div>
                                <h6 class="mb-0 fw-bold">Email</h6>
                                <p class="mb-0 small">{{ $hotel->email ?? 'Not available' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Location Map -->
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Location</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="map-container">
                            <!-- Replace with your actual map embed code -->
                            <div class="d-flex flex-column align-items-center justify-content-center h-100 bg-light p-4">
                                <i class="bi bi-map text-muted mb-2" style="font-size: 2.5rem;"></i>
                                <span class="text-center">Interactive map would display here showing the hotel location</span>
                                <small class="text-muted mt-2">Click to view in Google Maps</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Floating Book Now Button -->
<a href="{{ route('hotel-bookings.create', $hotel) }}" class="btn btn-primary btn-lg floating-book-btn btn-book-now">
    <i class="bi bi-calendar-check me-2"></i> Book Now
</a>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize date pickers with tomorrow's date as default
        const today = new Date();
        const tomorrow = new Date(today);
        tomorrow.setDate(today.getDate() + 1);
        
        const checkInInput = document.getElementById('checkIn');
        const checkOutInput = document.getElementById('checkOut');
        
        checkInInput.valueAsDate = tomorrow;
        checkOutInput.valueAsDate = new Date(tomorrow);
        checkOutInput.valueAsDate.setDate(tomorrow.getDate() + 1);
        
        // Format dates as YYYY-MM-DD
        function formatDate(date) {
            const d = new Date(date);
            let month = '' + (d.getMonth() + 1);
            let day = '' + d.getDate();
            const year = d.getFullYear();
            
            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;
            
            return [year, month, day].join('-');
        }
        
        checkInInput.min = formatDate(today);
        checkOutInput.min = formatDate(tomorrow);
        
        // Set checkout date to be at least one day after checkin
        checkInInput.addEventListener('change', function() {
            const checkInDate = new Date(this.value);
            const minCheckOut = new Date(checkInDate);
            minCheckOut.setDate(checkInDate.getDate() + 1);
            
            checkOutInput.valueAsDate = minCheckOut;
            checkOutInput.min = formatDate(minCheckOut);
        });
        
        // Smooth scroll for amenities
        document.querySelectorAll('.amenity-badge').forEach(badge => {
            badge.addEventListener('click', function() {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 200);
            });
        });
    });
</script>
@endsection