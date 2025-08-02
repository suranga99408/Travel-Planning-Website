@extends('layouts.app')

@section('title', $vehicle->name)

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Vehicle Image Gallery -->
                <div class="mb-4">
                    @if($vehicle->images && count($vehicle->images) > 0)
                        <div class="ratio ratio-16x9 mb-3">
                            <img src="{{ asset('storage/' . $vehicle->images[0]) }}" 
                                 class="img-fluid rounded" alt="{{ $vehicle->name }}">
                        </div>
                        @if(count($vehicle->images) > 1)
                            <div class="row g-2">
                                @foreach(array_slice($vehicle->images, 1) as $image)
                                    <div class="col-3">
                                        <img src="{{ asset('storage/' . $image) }}" 
                                             class="img-fluid rounded" alt="{{ $vehicle->name }}">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div class="ratio ratio-16x9 bg-light rounded d-flex align-items-center justify-content-center">
                            <i class="fas fa-car fa-5x text-muted"></i>
                        </div>
                    @endif
                </div>

                <!-- Vehicle Details -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title">{{ $vehicle->name }}</h2>
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="badge bg-primary">{{ $vehicle->type }}</span>
                            <span class="badge bg-secondary">{{ $vehicle->category }}</span>
                            <span class="badge bg-success">{{ $vehicle->transmission }}</span>
                            <span class="badge bg-info">Capacity: {{ $vehicle->capacity }}</span>
                        </div>
                        
                        <h5 class="mt-4">Description</h5>
                        <p class="card-text">{{ $vehicle->full_description ?? $vehicle->description }}</p>
                        
                        @if($vehicle->features && count($vehicle->features) > 0)
                            <h5 class="mt-4">Features</h5>
                            <div class="row">
                                @foreach($vehicle->features as $feature)
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-check-circle text-success me-2"></i>
                                            <span>{{ $feature }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card shadow-sm sticky-top" style="top: 20px;">
                    <div class="card-body">
                        <h4 class="card-title">Book This Vehicle</h4>
                        <p class="text-primary fw-bold h3 mb-4">${{ number_format($vehicle->price_per_day, 2) }} <small class="text-muted fs-6">per day</small></p>
                        
                        <form action="{{ route('bookings.store', $vehicle->id) }}" method="POST" id="bookingForm">
                            @csrf
                            <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
                            
                            <!-- Date Selection -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="pickup_date" class="form-label">Pickup Date</label>
                                    <input type="date" class="form-control" id="pickup_date" name="pickup_date" 
                                           min="{{ date('Y-m-d') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="return_date" class="form-label">Return Date</label>
                                    <input type="date" class="form-control" id="return_date" name="return_date" 
                                           min="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>
                            
                            <!-- Availability Status -->
                            <div id="availability-message" class="alert d-none mb-3"></div>
                            
                            <!-- Location Selection -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="pickup_location" class="form-label">Pickup Location</label>
                                    <select class="form-select" id="pickup_location" name="pickup_location" required>
                                        <option value="{{ $vehicle->location }}" selected>{{ $vehicle->location }}</option>
                                        <option value="Airport">Airport</option>
                                        <option value="City Center">City Center</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="return_location" class="form-label">Return Location</label>
                                    <select class="form-select" id="return_location" name="return_location" required>
                                        <option value="{{ $vehicle->location }}" selected>{{ $vehicle->location }}</option>
                                        <option value="Airport">Airport</option>
                                        <option value="City Center">City Center</option>
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Driver Information -->
                            <div class="mb-3">
                                <label for="driver_age" class="form-label">Driver Age</label>
                                <input type="number" class="form-control" id="driver_age" name="driver_age" 
                                       min="18" max="99" value="25" required>
                            </div>
                            
                            <!-- Insurance Options -->
                            <div class="mb-3">
                                <label class="form-label">Insurance Type</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="insurance_type" 
                                           id="insurance_basic" value="basic" checked>
                                    <label class="form-check-label" for="insurance_basic">
                                        Basic (Free)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="insurance_type" 
                                           id="insurance_premium" value="premium">
                                    <label class="form-check-label" for="insurance_premium">
                                        Premium ($20/day)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="insurance_type" 
                                           id="insurance_complete" value="complete">
                                    <label class="form-check-label" for="insurance_complete">
                                        Complete ($35/day)
                                    </label>
                                </div>
                            </div>
                            
                            <!-- Price Summary -->
                            <div class="alert alert-info" id="bookingSummary">
                                <p><strong>Total Days:</strong> <span id="totalDays">0</span></p>
                                <p><strong>Base Price:</strong> $<span id="basePrice">0.00</span></p>
                                <p><strong>Insurance:</strong> $<span id="insuranceCost">0.00</span></p>
                                <p class="fw-bold">Total Price: $<span id="totalPrice">0.00</span></p>
                            </div>
                            
                            <!-- Special Requests -->
                            <div class="mb-3">
                                <label for="special_requests" class="form-label">Special Requests</label>
                                <textarea class="form-control" id="special_requests" name="special_requests" 
                                          rows="2" placeholder="Any special requirements..."></textarea>
                            </div>
                            
                            <!-- Submit Button -->
                            @auth
                                <button type="submit" id="book-button" class="btn btn-primary w-100 py-3 fw-bold">
                                    Confirm Booking
                                </button>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary w-100 py-3 fw-bold">
                                    Login to Book
                                </a>
                            @endauth

                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const pickupDate = document.getElementById('pickup_date');
    const returnDate = document.getElementById('return_date');
    const bookingSummary = document.getElementById('bookingSummary');
    const totalDays = document.getElementById('totalDays');
    const basePrice = document.getElementById('basePrice');
    const insuranceCost = document.getElementById('insuranceCost');
    const totalPrice = document.getElementById('totalPrice');
    const insuranceRadios = document.querySelectorAll('input[name="insurance_type"]');
    const availabilityMessage = document.getElementById('availability-message');
    const bookButton = document.getElementById('book-button');
    const vehicleId = {{ $vehicle->id }};
    const dailyRate = {{ $vehicle->price_per_day }};
    
    // Set default dates (today and tomorrow)
    const today = new Date();
    const tomorrow = new Date();
    tomorrow.setDate(today.getDate() + 1);
    
    pickupDate.valueAsDate = today;
    returnDate.valueAsDate = tomorrow;
    
    function calculateBooking() {
        if (pickupDate.value && returnDate.value) {
            const start = new Date(pickupDate.value);
            const end = new Date(returnDate.value);
            
            if (start > end) {
                alert('Return date must be after pickup date');
                returnDate.value = '';
                return;
            }
            
            const days = Math.floor((end - start) / (1000 * 60 * 60 * 24)) + 1;
            const selectedInsurance = document.querySelector('input[name="insurance_type"]:checked').value;
            
            // Calculate prices
            const base = days * dailyRate;
            let insurance = 0;
            
            switch(selectedInsurance) {
                case 'premium': insurance = 20 * days; break;
                case 'complete': insurance = 35 * days; break;
                default: insurance = 0;
            }
            
            const total = base + insurance;
            
            // Update display
            totalDays.textContent = days;
            basePrice.textContent = base.toFixed(2);
            insuranceCost.textContent = insurance.toFixed(2);
            totalPrice.textContent = total.toFixed(2);
            
            // Check availability
            checkAvailability();
        }
    }
    
    function checkAvailability() {
        if (pickupDate.value && returnDate.value) {
            fetch(`/vehicles/${vehicleId}/check-availability`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    start_date: pickupDate.value,
                    end_date: returnDate.value
                })
            })
            .then(response => response.json())
            .then(data => {
                availabilityMessage.textContent = data.message;
                availabilityMessage.classList.remove('d-none', 'alert-success', 'alert-danger');
                availabilityMessage.classList.add(data.available ? 'alert-success' : 'alert-danger');
                if (bookButton) bookButton.disabled = !data.available;
            });
        }
    }
    
    // Event listeners
    pickupDate.addEventListener('change', calculateBooking);
    returnDate.addEventListener('change', calculateBooking);
    insuranceRadios.forEach(radio => {
        radio.addEventListener('change', calculateBooking);
    });
    
    // Initial calculation
    calculateBooking();
});
</script>
@endpush