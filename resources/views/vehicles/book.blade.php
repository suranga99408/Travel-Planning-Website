@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2>Book Your Vehicle: {{ $vehicle->name }}</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('vehicle-bookings.store', $vehicle) }}" id="bookingForm">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="pickup_date" class="form-label">Pickup Date</label>
                                <input type="date" class="form-control" id="pickup_date" name="pickup_date" 
                                       min="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="return_date" class="form-label">Return Date</label>
                                <input type="date" class="form-control" id="return_date" name="return_date" 
                                       min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="pickup_location" class="form-label">Pickup Location</label>
                                <input type="text" class="form-control" id="pickup_location" name="pickup_location" 
                                       value="{{ $vehicle->location }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="return_location" class="form-label">Return Location</label>
                                <input type="text" class="form-control" id="return_location" name="return_location" 
                                       value="{{ $vehicle->location }}" required>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="driver_age" class="form-label">Driver's Age</label>
                                <input type="number" class="form-control" id="driver_age" name="driver_age" 
                                       min="21" max="75" value="25" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Insurance Type</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="insurance_type" id="basic" value="basic" checked>
                                    <label class="form-check-label" for="basic">
                                        Basic (+10%)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="insurance_type" id="premium" value="premium">
                                    <label class="form-check-label" for="premium">
                                        Premium (+15%)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="insurance_type" id="full" value="full">
                                    <label class="form-check-label" for="full">
                                        Full Coverage (+20%)
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="special_requests" class="form-label">Special Requests</label>
                            <textarea class="form-control" id="special_requests" name="special_requests" 
                                      rows="3" placeholder="Child seat, GPS, etc."></textarea>
                        </div>
                        
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Payment Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Payment Method</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="creditCard" value="credit_card" checked>
                                        <label class="form-check-label" for="creditCard">
                                            Credit Card
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="paypal" value="paypal">
                                        <label class="form-check-label" for="paypal">
                                            PayPal
                                        </label>
                                    </div>
                                </div>
                                
                                <div id="creditCardFields">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="card_number" class="form-label">Card Number</label>
                                            <input type="text" class="form-control" id="card_number" name="card_number" 
                                                   placeholder="1234 5678 9012 3456" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="expiry_date" class="form-label">Expiry Date</label>
                                            <input type="text" class="form-control" id="expiry_date" name="expiry_date" 
                                                   placeholder="MM/YY" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="cvv" class="form-label">CVV</label>
                                            <input type="text" class="form-control" id="cvv" name="cvv" 
                                                   placeholder="123" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="card_holder" class="form-label">Card Holder Name</label>
                                        <input type="text" class="form-control" id="card_holder" name="card_holder" 
                                               placeholder="John Doe" required>
                                    </div>
                                </div>
                                
                                <div class="alert alert-info">
                                    <h5 class="alert-heading">Booking Summary</h5>
                                    <p class="mb-1"><strong>Vehicle:</strong> {{ $vehicle->name }}</p>
                                    <p class="mb-1"><strong>Daily Rate:</strong> $<span id="dailyRate">{{ number_format($vehicle->price_per_day, 2) }}</span></p>
                                    <p class="mb-1"><strong>Days:</strong> <span id="daysCount">1</span></p>
                                    <p class="mb-1"><strong>Subtotal:</strong> $<span id="subtotal">{{ number_format($vehicle->price_per_day, 2) }}</span></p>
                                    <p class="mb-1"><strong>Insurance:</strong> $<span id="insuranceCost">{{ number_format($vehicle->price_per_day * 0.1, 2) }}</span> (<span id="insuranceType">Basic</span>)</p>
                                    <h5 class="mt-2 mb-0"><strong>Total:</strong> $<span id="totalAmount">{{ number_format($vehicle->price_per_day * 1.1, 2) }}</span></h5>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Confirm Booking</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h3 class="mb-0">Vehicle Details</h3>
                </div>
                <div class="card-body">
                    @if($vehicle->images && count($vehicle->images) > 0)
                        <img src="{{ asset('storage/' . $vehicle->images[0]) }}" class="img-fluid rounded mb-3" alt="{{ $vehicle->name }}">
                    @endif
                    <h5>{{ $vehicle->name }}</h5>
                    <p class="text-muted">{{ $vehicle->type }} • {{ $vehicle->category }}</p>
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item">
                            <i class="bi bi-people"></i> {{ $vehicle->capacity }} Seats
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-gear"></i> {{ $vehicle->transmission }}
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-fuel-pump"></i> {{ $vehicle->fuel_type }}
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-snow"></i> {{ $vehicle->air_conditioned ? 'Air Conditioned' : 'No AC' }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const pickupDate = document.getElementById('pickup_date');
    const returnDate = document.getElementById('return_date');
    const insuranceRadios = document.querySelectorAll('input[name="insurance_type"]');
    const dailyRate = {{ $vehicle->price_per_day }};
    
    // Set initial dates
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(today.getDate() + 1);
    
    pickupDate.value = today.toISOString().split('T')[0];
    returnDate.value = tomorrow.toISOString().split('T')[0];
    
    function calculateBooking() {
        const pickup = new Date(pickupDate.value);
        const returnD = new Date(returnDate.value);
        const days = Math.ceil((returnD - pickup) / (1000 * 60 * 60 * 24));
        
        const insuranceType = document.querySelector('input[name="insurance_type"]:checked').value;
        const insuranceRates = {
            'basic': 0.1,
            'premium': 0.15,
            'full': 0.2
        };
        
        const subtotal = dailyRate * days;
        const insuranceCost = subtotal * insuranceRates[insuranceType];
        const total = subtotal + insuranceCost;
        
        // Update display
        document.getElementById('daysCount').textContent = days;
        document.getElementById('subtotal').textContent = subtotal.toFixed(2);
        document.getElementById('insuranceCost').textContent = insuranceCost.toFixed(2);
        document.getElementById('insuranceType').textContent = insuranceType.charAt(0).toUpperCase() + insuranceType.slice(1);
        document.getElementById('totalAmount').textContent = total.toFixed(2);
    }
    
    // Event listeners
    pickupDate.addEventListener('change', function() {
        const pickup = new Date(this.value);
        const minReturn = new Date(pickup);
        minReturn.setDate(pickup.getDate() + 1);
        returnDate.min = minReturn.toISOString().split('T')[0];
        
        if (new Date(returnDate.value) < minReturn) {
            returnDate.value = minReturn.toISOString().split('T')[0];
        }
        
        calculateBooking();
    });
    
    returnDate.addEventListener('change', calculateBooking);
    insuranceRadios.forEach(radio => {
        radio.addEventListener('change', calculateBooking);
    });
    
    // Initialize calculation
    calculateBooking();
});
</script>
@endsection