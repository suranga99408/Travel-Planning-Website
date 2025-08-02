@extends('layouts.app')

@section('title', 'Order Confirmation')

@section('content')
<div class="py-5 bg-light">
    <div class="container text-center">
        <div class="card border-0 shadow-sm mx-auto" style="max-width: 600px;">
            <div class="card-body p-5">
                <div class="mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#28a745" class="bi bi-check-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                    </svg>
                </div>
                <h1 class="fw-bold mb-3">Thank You For Your Order!</h1>
                <p class="lead mb-4">Your payment was successful. We've sent a confirmation email to your address.</p>
                <p class="text-muted mb-4">Order ID: #{{ session('order_id') ?? 'N/A' }}</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <a href="{{ route('products.index') }}" class="btn btn-primary px-4">Continue Shopping</a>
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary px-4">Back to Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection