@extends('layouts.app')

@section('title', 'Booking Confirmation')

@section('content')
<div class="container py-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Booking Confirmed!</h3>
        </div>
        <div class="card-body">
            <h4>{{ $booking->vehicle->name }}</h4>
            <p><strong>From:</strong> {{ $booking->pickup_date->format('M d, Y') }}</p>
            <p><strong>To:</strong> {{ $booking->return_date->format('M d, Y') }}</p>
            <p><strong>Pickup Location:</strong> {{ $booking->pickup_location }}</p>
            <p><strong>Total Price:</strong> ${{ number_format($booking->total_price, 2) }}</p>
            <p><strong>Status:</strong> <span class="badge bg-success">{{ ucfirst($booking->status) }}</span></p>
            
            <div class="mt-4">
                <a href="{{ route('vehicles.index') }}" class="btn btn-primary">
                    Back to Vehicles
                </a>
                <a href="#" class="btn btn-outline-secondary">
                    View Invoice
                </a>
            </div>
        </div>
    </div>
</div>
@endsection