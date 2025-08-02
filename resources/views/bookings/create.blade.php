@extends('layouts.app')

@section('title', 'Book Travel Plan')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Book Travel Plan: {{ $plan->title }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('bookings.store', $plan->id) }}" method="POST">
                            @csrf
                            
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h5>Plan Details</h5>
                                    <ul class="list-unstyled">
                                        <li><strong>Start Location:</strong> {{ $plan->start_location }}</li>
                                        <li><strong>Start Date:</strong> {{ $plan->start_date->format('M d, Y') }}</li>
                                        <li><strong>Price per person:</strong> ${{ number_format($plan->price_per_person, 2) }}</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h5>Your Information</h5>
                                    <ul class="list-unstyled">
                                        <li><strong>Name:</strong> {{ auth()->user()->name }}</li>
                                        <li><strong>Email:</strong> {{ auth()->user()->email }}</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="number_of_people" class="form-label">Number of People</label>
                                <input type="number" class="form-control" id="number_of_people" name="number_of_people" min="1" value="1" required>
                            </div>
                            
                            <div class="mb-4">
                                <label for="special_requests" class="form-label">Special Requests</label>
                                <textarea class="form-control" id="special_requests" name="special_requests" rows="3"></textarea>
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
                                                <input type="text" class="form-control" id="card_number" placeholder="1234 5678 9012 3456">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="expiry_date" class="form-label">Expiry Date</label>
                                                <input type="text" class="form-control" id="expiry_date" placeholder="MM/YY">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="cvv" class="form-label">CVV</label>
                                                <input type="text" class="form-control" id="cvv" placeholder="123">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="card_holder" class="form-label">Card Holder Name</label>
                                            <input type="text" class="form-control" id="card_holder" placeholder="John Doe">
                                        </div>
                                    </div>
                                    
                                    <div class="alert alert-info">
                                        <p class="mb-0">Total Amount: <span id="totalAmount">${{ number_format($plan->price_per_person, 2) }}</span></p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">Confirm Booking</button>
                                <a href="{{ route('plans.show', $plan->id) }}" class="btn btn-outline-secondary">Back to Plan</a>
                            </div>
                        </form>
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
        const numberInput = document.getElementById('number_of_people');
        const totalAmount = document.getElementById('totalAmount');
        const pricePerPerson = {{ $plan->price_per_person }};
        
        numberInput.addEventListener('change', function() {
            const total = pricePerPerson * this.value;
            totalAmount.textContent = '$' + total.toFixed(2);
        });
        
        // Toggle payment fields based on selected method
        const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
        const creditCardFields = document.getElementById('creditCardFields');
        
        paymentMethods.forEach(method => {
            method.addEventListener('change', function() {
                if (this.value === 'credit_card') {
                    creditCardFields.style.display = 'block';
                } else {
                    creditCardFields.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection