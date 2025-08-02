@extends('layouts.app')

@section('title', 'Booking Confirmation')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Booking Confirmed!</h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>
                            Your booking has been confirmed. A confirmation has been sent to your email.
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5>Booking Details</h5>
                                <ul class="list-unstyled">
                                    <li><strong>Booking ID:</strong> #{{ $booking->id }}</li>
                                    <li><strong>Booking Date:</strong> {{ $booking->created_at->format('M d, Y h:i A') }}</li>
                                    <li><strong>Status:</strong> <span class="badge bg-success">{{ ucfirst($booking->status) }}</span></li>
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

                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Travel Plan Details</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    <li><strong>Plan Title:</strong> {{ $booking->plan->title }}</li>
                                    <li><strong>Start Location:</strong> {{ $booking->plan->start_location }}</li>
                                    <li><strong>Start Date:</strong> {{ $booking->plan->start_date->format('M d, Y') }}</li>
                                    <li><strong>Number of People:</strong> {{ $booking->number_of_people }}</li>
                                    <li><strong>Special Requests:</strong> {{ $booking->special_requests ?? 'None' }}</li>
                                </ul>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Payment Summary</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    <li><strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', $booking->payment_method)) }}</li>
                                    <li><strong>Price per Person:</strong> ${{ number_format($booking->plan->price_per_person, 2) }}</li>
                                    <li><strong>Total Amount:</strong> ${{ number_format($booking->total_amount, 2) }}</li>
                                </ul>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button onclick="window.print()" class="btn btn-outline-primary">
                                <i class="fas fa-print me-2"></i>Print Confirmation
                            </button>
                            <a href="{{ route('plans.index') }}" class="btn btn-primary">
                                <i class="fas fa-search me-2"></i>Browse More Plans
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .card, .card * {
            visibility: visible;
        }
        .card {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            border: none;
            box-shadow: none;
        }
        .no-print {
            display: none !important;
        }
    }
</style>
@endsection