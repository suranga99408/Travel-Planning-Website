@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2 class="fw-bold mb-4">Billing Details</h2>
                
                <form id="payment-form">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                        <div class="col-md-6">
                            <label for="postal_code" class="form-label">Postal Code</label>
                            <input type="text" class="form-control" id="postal_code" name="postal_code" required>
                        </div>
                    </div>
                    
                    <h2 class="fw-bold mt-5 mb-4">Payment Information</h2>
                    
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Payment Method</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="stripe" value="stripe" checked>
                                    <label class="form-check-label" for="stripe">
                                        Credit/Debit Card
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="paypal" value="paypal">
                                    <label class="form-check-label" for="paypal">
                                        PayPal
                                    </label>
                                </div>
                            </div>
                            
                            <!-- Stripe Card Element -->
                            <div id="stripe-card-element" class="mb-3">
                                <label for="card-element" class="form-label">Card Details</label>
                                <div id="card-element" class="form-control p-2" style="height: 40px;"></div>
                                <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                            </div>
                            
                            <!-- PayPal Button Container -->
                            <div id="paypal-button-container" style="display: none;"></div>
                            
                            <div class="alert alert-info mt-3">
                                <p class="mb-0">Total Amount: <strong>${{ number_format($total, 2) }}</strong></p>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 py-2" id="submit-button">Complete Order</button>
                </form>
            </div>
            
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @foreach($cartItems as $item)
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                                    <span>${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                                </li>
                            @endforeach
                            <li class="list-group-item d-flex justify-content-between fw-bold">
                                <span>Total</span>
                                <span>${{ number_format($total, 2) }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stripe Elements JS -->
<script src="https://js.stripe.com/v3/"></script>
<!-- PayPal SDK -->
<script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}&currency=USD"></script>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle between payment methods
    const stripeRadio = document.getElementById('stripe');
    const paypalRadio = document.getElementById('paypal');
    const stripeCardElement = document.getElementById('stripe-card-element');
    const paypalButtonContainer = document.getElementById('paypal-button-container');
    
    stripeRadio.addEventListener('change', function() {
        if (this.checked) {
            stripeCardElement.style.display = 'block';
            paypalButtonContainer.style.display = 'none';
        }
    });
    
    paypalRadio.addEventListener('change', function() {
        if (this.checked) {
            stripeCardElement.style.display = 'none';
            paypalButtonContainer.style.display = 'block';
        }
    });
    
    // Initialize Stripe
    const stripe = Stripe('{{ env("STRIPE_KEY") }}');
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');
    
    // Handle Stripe form submission
    const form = document.getElementById('payment-form');
    const submitButton = document.getElementById('submit-button');
    
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        // If PayPal is selected, don't process Stripe
        if (paypalRadio.checked) return;
        
        submitButton.disabled = true;
        submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...';
        
        const { paymentMethod, error } = await stripe.createPaymentMethod({
            type: 'card',
            card: cardElement,
            billing_details: {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                address: {
                    line1: document.getElementById('address').value,
                    city: document.getElementById('city').value,
                    postal_code: document.getElementById('postal_code').value,
                }
            }
        });
        
        if (error) {
            document.getElementById('card-errors').textContent = error.message;
            submitButton.disabled = false;
            submitButton.textContent = 'Complete Order';
        } else {
            // Add payment method ID to form and submit
            const hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'payment_method_id');
            hiddenInput.setAttribute('value', paymentMethod.id);
            form.appendChild(hiddenInput);
            
            // Submit to server
            fetch('{{ route("checkout.process") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    payment_method: 'stripe',
                    payment_method_id: paymentMethod.id,
                    name: document.getElementById('name').value,
                    email: document.getElementById('email').value,
                    address: document.getElementById('address').value,
                    city: document.getElementById('city').value,
                    postal_code: document.getElementById('postal_code').value,
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    document.getElementById('card-errors').textContent = data.error;
                    submitButton.disabled = false;
                    submitButton.textContent = 'Complete Order';
                } else {
                    window.location.href = data.redirect;
                }
            });
        }
    });
    
    // Initialize PayPal button
    paypal.Buttons({
        style: {
            layout: 'vertical',
            color: 'blue',
            shape: 'rect',
            label: 'paypal'
        },
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '{{ $total }}'
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                // Submit to server
                fetch('{{ route("checkout.process") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        payment_method: 'paypal',
                        paypal_order_id: data.orderID,
                        name: document.getElementById('name').value,
                        email: document.getElementById('email').value,
                        address: document.getElementById('address').value,
                        city: document.getElementById('city').value,
                        postal_code: document.getElementById('postal_code').value,
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        window.location.href = data.redirect;
                    }
                });
            });
        },
        onError: function(err) {
            console.error('PayPal error:', err);
            alert('An error occurred with PayPal. Please try again or use another payment method.');
        }
    }).render('#paypal-button-container');
});
</script>
@endsection