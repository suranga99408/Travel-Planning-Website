@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2>Book Your Stay at {{ $hotel->name }}</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('hotel-bookings.store', $hotel) }}" id="bookingForm">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="check_in" class="form-label">Check-in Date</label>
                                <input type="date" class="form-control" id="check_in" name="check_in" 
                                       min="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="check_out" class="form-label">Check-out Date</label>
                                <input type="date" class="form-control" id="check_out" name="check_out" 
                                       min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="adults" class="form-label">Adults</label>
                                <select class="form-select" id="adults" name="adults" required>
                                    @for($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ $i == 2 ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="children" class="form-label">Children</label>
                                <select class="form-select" id="children" name="children">
                                    @for($i = 0; $i <= 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="room_type" class="form-label">Room Type</label>
                                <select class="form-select" id="room_type" name="room_type" required>
                                    <option value="standard">Standard Room</option>
                                    <option value="deluxe">Deluxe Room</option>
                                    <option value="suite">Suite</option>
                                    <option value="family">Family Room</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="room_count" class="form-label">Number of Rooms</label>
                                <select class="form-select" id="room_count" name="room_count" required>
                                    @for($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="guest_name" class="form-label">Guest Name</label>
                            <input type="text" class="form-control" id="guest_name" name="guest_name" 
                                   value="{{ Auth::user()->name }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="guest_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="guest_email" name="guest_email" 
                                   value="{{ Auth::user()->email }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="guest_phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="guest_phone" name="guest_phone" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="special_requests" class="form-label">Special Requests</label>
                            <textarea class="form-control" id="special_requests" name="special_requests" 
                                      rows="3"></textarea>
                        </div>
                        
                        <!-- Payment Information Section -->
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
                                            <input type="text" class="form-control" id="card_number" name="card_number" placeholder="1234 5678 9012 3456">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="expiry_date" class="form-label">Expiry Date</label>
                                            <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="MM/YY">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="cvv" class="form-label">CVV</label>
                                            <input type="text" class="form-control" id="cvv" name="cvv" placeholder="123">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="card_holder" class="form-label">Card Holder Name</label>
                                        <input type="text" class="form-control" id="card_holder" name="card_holder" placeholder="John Doe">
                                    </div>
                                </div>
                                
                                <div class="alert alert-info">
                                    <p class="mb-0">Total Amount: <span id="totalAmount">${{ number_format($hotel->price_per_night, 2) }}</span></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Complete Booking</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h3>Booking Summary</h3>
                </div>
                <div class="card-body">
                    <h4>{{ $hotel->name }}</h4>
                    <p class="text-muted">{{ $hotel->location }}</p>
                    
                    <div id="price-summary" class="bg-light p-3 rounded">
                        <h5>Price Details</h5>
                        <table class="table table-sm">
                            <tr>
                                <td>Room Type:</td>
                                <td id="summary-room-type">Standard</td>
                            </tr>
                            <tr>
                                <td>Price per night:</td>
                                <td>$<span id="summary-price">{{ number_format($hotel->price_per_night, 2) }}</span></td>
                            </tr>
                            <tr>
                                <td>Nights:</td>
                                <td id="summary-nights">1</td>
                            </tr>
                            <tr>
                                <td>Rooms:</td>
                                <td id="summary-room-count">1</td>
                            </tr>
                            <tr>
                                <td>Subtotal:</td>
                                <td>$<span id="summary-subtotal">{{ number_format($hotel->price_per_night, 2) }}</span></td>
                            </tr>
                            <tr>
                                <td>Taxes (10%):</td>
                                <td>$<span id="summary-taxes">{{ number_format($hotel->price_per_night * 0.1, 2) }}</span></td>
                            </tr>
                            <tr class="table-active">
                                <th>Total:</th>
                                <th>$<span id="summary-total">{{ number_format($hotel->price_per_night * 1.1, 2) }}</span></th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkInInput = document.getElementById('check_in');
    const checkOutInput = document.getElementById('check_out');
    const roomTypeSelect = document.getElementById('room_type');
    const roomCountSelect = document.getElementById('room_count');
    const basePrice = {{ $hotel->price_per_night }};
    
    const roomTypeMultipliers = {
        'standard': 1.0,
        'deluxe': 1.2,
        'suite': 1.5,
        'family': 1.3
    };
    
    function updatePriceSummary() {
        const roomType = roomTypeSelect.value;
        const roomCount = roomCountSelect.value;
        const roomTypeName = roomTypeSelect.options[roomTypeSelect.selectedIndex].text;
        
        let nights = 1;
        if (checkInInput.value && checkOutInput.value) {
            const checkIn = new Date(checkInInput.value);
            const checkOut = new Date(checkOutInput.value);
            nights = Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24));
        }
        
        const pricePerNight = basePrice * roomTypeMultipliers[roomType];
        const subtotal = pricePerNight * nights * roomCount;
        const taxes = subtotal * 0.1;
        const total = subtotal + taxes;
        
        // Update summary
        document.getElementById('summary-room-type').textContent = roomTypeName;
        document.getElementById('summary-price').textContent = pricePerNight.toFixed(2);
        document.getElementById('summary-nights').textContent = nights;
        document.getElementById('summary-room-count').textContent = roomCount;
        document.getElementById('summary-subtotal').textContent = subtotal.toFixed(2);
        document.getElementById('summary-taxes').textContent = taxes.toFixed(2);
        document.getElementById('summary-total').textContent = total.toFixed(2);
        
        // Update payment total
        document.getElementById('totalAmount').textContent = '$' + total.toFixed(2);
    }
    
    // Set initial dates
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(today.getDate() + 1);
    
    checkInInput.value = today.toISOString().split('T')[0];
    checkOutInput.value = tomorrow.toISOString().split('T')[0];
    
    // Update price summary when inputs change
    [checkInInput, checkOutInput, roomTypeSelect, roomCountSelect].forEach(element => {
        element.addEventListener('change', updatePriceSummary);
    });
    
    // Toggle payment fields based on payment method
    document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const creditCardFields = document.getElementById('creditCardFields');
            if (this.value === 'credit_card') {
                creditCardFields.style.display = 'block';
            } else {
                creditCardFields.style.display = 'none';
            }
        });
    });
    
    // Initialize summary
    updatePriceSummary();
    
    // Form submission handling
    document.getElementById('bookingForm').addEventListener('submit', function(e) {
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
        
        if (paymentMethod === 'credit_card') {
            const cardNumber = document.getElementById('card_number').value;
            const expiryDate = document.getElementById('expiry_date').value;
            const cvv = document.getElementById('cvv').value;
            const cardHolder = document.getElementById('card_holder').value;
            
            if (!cardNumber || !expiryDate || !cvv || !cardHolder) {
                e.preventDefault();
                alert('Please fill in all credit card details');
                return false;
            }
        }
        
        return true;
    });
});
</script>
@endsection