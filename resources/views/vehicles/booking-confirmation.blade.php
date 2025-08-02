@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-0">Booking Confirmed!</h2>
                        <span class="badge bg-light text-success fs-5">#{{ $vehicleBooking->id }}</span>
                    </div>
                </div>
                
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h4><i class="bi bi-car-front"></i> Vehicle Details</h4>
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5>{{ $vehicleBooking->vehicle->name }}</h5>
                                    <p class="text-muted mb-2">
                                        {{ $vehicleBooking->vehicle->type }} • {{ $vehicleBooking->vehicle->category }}
                                    </p>
                                    <p class="mb-1"><strong>Pickup:</strong> {{ $vehicleBooking->pickup_date->format('l, F j, Y') }} at {{ $vehicleBooking->pickup_location }}</p>
                                    <p><strong>Return:</strong> {{ $vehicleBooking->return_date->format('l, F j, Y') }} at {{ $vehicleBooking->return_location }}</p>
                                </div>
                            </div>
                            
                            <h4><i class="bi bi-person"></i> Driver Information</h4>
                            <div class="card mb-4">
                                <div class="card-body">
                                    <p class="mb-1"><strong>Name:</strong> {{ Auth::user()->name }}</p>
                                    <p class="mb-1"><strong>Email:</strong> {{ Auth::user()->email }}</p>
                                    <p class="mb-0"><strong>Age:</strong> {{ $vehicleBooking->driver_age }}</p>
                                </div>
                            </div>
                            
                            @if($vehicleBooking->special_requests)
                            <h4><i class="bi bi-chat-square-text"></i> Special Requests</h4>
                            <div class="card">
                                <div class="card-body">
                                    <p>{{ $vehicleBooking->special_requests }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                        
                        <div class="col-md-6">
                            <h4><i class="bi bi-receipt"></i> Booking Summary</h4>
                            <div class="card mb-4">
                                <div class="card-body">
                                    <table class="table">
                                        <tr>
                                            <td>Daily Rate ({{ $vehicleBooking->days }} days)</td>
                                            <td class="text-end">${{ number_format($vehicleBooking->daily_rate, 2) }}/day</td>
                                        </tr>
                                        <tr>
                                            <td>Subtotal</td>
                                            <td class="text-end">${{ number_format($vehicleBooking->total_price, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Insurance ({{ ucfirst($vehicleBooking->insurance_type) }})</td>
                                            <td class="text-end">${{ number_format($vehicleBooking->insurance_cost, 2) }}</td>
                                        </tr>
                                        <tr class="table-active">
                                            <th>Total</th>
                                            <th class="text-end">${{ number_format($vehicleBooking->total_price + $vehicleBooking->insurance_cost, 2) }}</th>
                                        </tr>
                                        <tr>
                                            <td>Payment Method</td>
                                            <td class="text-end">
                                                Credit Card (ending in ****)
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            
                            <h4><i class="bi bi-info-circle"></i> Next Steps</h4>
                            <div class="card">
                                <div class="card-body">
                                    <ul>
                                        <li>A confirmation email has been sent to {{ Auth::user()->email }}</li>
                                        <li>Present your ID and this confirmation at pickup</li>
                                        <li>Inspect the vehicle before driving off</li>
                                        <li>Cancellation policy: Free cancellation up to 24 hours before pickup</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <a href="{{ route('vehicles.index') }}" class="btn btn-outline-secondary me-md-2">
                            <i class="bi bi-car-front"></i> Browse More Vehicles
                        </a>
                        <button class="btn btn-primary" onclick="window.print()">
                            <i class="bi bi-printer"></i> Print Confirmation
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection