@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-0">Booking Confirmed!</h2>
                        <span class="badge bg-light text-success fs-5">Confirmation #{{ $hotelBooking->id }}</span>
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
                            <h4><i class="bi bi-building"></i> Hotel Details</h4>
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5>{{ $hotelBooking->hotel->name }}</h5>
                                    <p class="text-muted mb-2">
                                        <i class="bi bi-geo-alt"></i> {{ $hotelBooking->hotel->location }}
                                    </p>
                                    <p class="mb-1"><strong>Check-in:</strong> {{ $hotelBooking->check_in->format('l, F j, Y') }} (3:00 PM)</p>
                                    <p><strong>Check-out:</strong> {{ $hotelBooking->check_out->format('l, F j, Y') }} (11:00 AM)</p>
                                </div>
                            </div>
                            
                            <h4><i class="bi bi-person"></i> Guest Information</h4>
                            <div class="card mb-4">
                                <div class="card-body">
                                    <p class="mb-1"><strong>Name:</strong> {{ $hotelBooking->guest_name }}</p>
                                    <p class="mb-1"><strong>Email:</strong> {{ $hotelBooking->guest_email }}</p>
                                    <p class="mb-1"><strong>Phone:</strong> {{ $hotelBooking->guest_phone }}</p>
                                    <p class="mb-0"><strong>Guests:</strong> {{ $hotelBooking->adults }} Adult(s), {{ $hotelBooking->children }} Child(ren)</p>
                                </div>
                            </div>
                            
                            @if($hotelBooking->special_requests)
                            <h4><i class="bi bi-chat-square-text"></i> Special Requests</h4>
                            <div class="card">
                                <div class="card-body">
                                    <p>{{ $hotelBooking->special_requests }}</p>
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
                                            <td>{{ $hotelBooking->room_count }} {{ str($hotelBooking->room_type)->title() }} Room(s)</td>
                                            <td class="text-end">${{ number_format($hotelBooking->room_rate, 2) }}/night</td>
                                        </tr>
                                        <tr>
                                            <td>{{ $hotelBooking->nights }} Nights</td>
                                            <td class="text-end">x{{ $hotelBooking->nights }}</td>
                                        </tr>
                                        <tr>
                                            <td>Subtotal</td>
                                            <td class="text-end">${{ number_format($hotelBooking->room_rate * $hotelBooking->nights * $hotelBooking->room_count, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Taxes & Fees</td>
                                            <td class="text-end">${{ number_format($hotelBooking->taxes, 2) }}</td>
                                        </tr>
                                        <tr class="table-active">
                                            <th>Total</th>
                                            <th class="text-end">${{ number_format($hotelBooking->total_price, 2) }}</th>
                                        </tr>
                                        <tr>
                                            <td>Payment Status</td>
                                            <td class="text-end">
                                                <span class="badge bg-{{ $hotelBooking->payment_status === 'paid' ? 'success' : 'warning' }}">
                                                    {{ str($hotelBooking->payment_status)->title() }}
                                                </span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            
                            <h4><i class="bi bi-info-circle"></i> Next Steps</h4>
                            <div class="card">
                                <div class="card-body">
                                    <ul>
                                        <li>A confirmation email has been sent to {{ $hotelBooking->guest_email }}</li>
                                        <li>Present this confirmation at check-in</li>
                                        <li>Contact the hotel directly for any changes</li>
                                        <li>Cancellation policy: Free cancellation up to 48 hours before check-in</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary me-md-2">
                            <i class="bi bi-house"></i> Back to Home
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