@extends('layouts.app')

@section('title', 'My Hotel Bookings')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4"><i class="bi bi-calendar-check"></i> My Hotel Bookings</h2>
            
            @if($bookings->isEmpty())
                <div class="alert alert-info">
                    You haven't made any hotel bookings yet.
                    <a href="{{ route('hotels.index') }}" class="alert-link">Browse hotels</a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Booking #</th>
                                <th>Hotel</th>
                                <th>Dates</th>
                                <th>Room Type</th>
                                <th>Guests</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                                <tr>
                                    <td>#{{ $booking->id }}</td>
                                    <td>
                                        <a href="{{ route('hotels.show', $booking->hotel->id) }}">
                                            {{ $booking->hotel->name }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $booking->check_in->format('M j') }} - 
                                        {{ $booking->check_out->format('M j, Y') }}
                                        <br>
                                        <small class="text-muted">{{ $booking->nights }} nights</small>
                                    </td>
                                    <td>{{ Str::title($booking->room_type) }}</td>
                                    <td>
                                        {{ $booking->adults }} Adult(s)
                                        @if($booking->children > 0)
                                            <br>
                                            <small>{{ $booking->children }} Child(ren)</small>
                                        @endif
                                    </td>
                                    <td>${{ number_format($booking->total_price, 2) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $booking->payment_status === 'paid' ? 'success' : 'warning' }}">
                                            {{ Str::title($booking->payment_status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('hotel-bookings.show', $booking->id) }}" 
                                           class="btn btn-sm btn-outline-primary"
                                           title="View Details">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        @if($booking->check_in > now())
                                            <button class="btn btn-sm btn-outline-danger ms-1"
                                                    title="Cancel Booking">
                                                <i class="bi bi-x-circle"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="d-flex justify-content-center mt-4">
                    {{ $bookings->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection