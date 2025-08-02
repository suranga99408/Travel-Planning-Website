@extends('layouts.app')

@section('title', 'My Vehicle Bookings')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-0"><i class="bi bi-car-front"></i> My Vehicle Bookings</h2>
                        <a href="{{ route('vehicles.index') }}" class="btn btn-light btn-sm">
                            <i class="bi bi-plus-circle"></i> New Booking
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    @if($bookings->isEmpty())
                        <div class="alert alert-info">
                            You haven't made any vehicle bookings yet.
                            <a href="{{ route('vehicles.index') }}" class="alert-link">Browse available vehicles</a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Booking #</th>
                                        <th>Vehicle</th>
                                        <th>Pickup Date</th>
                                        <th>Return Date</th>
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
                                                <strong>{{ $booking->vehicle->name }}</strong>
                                                <div class="text-muted small">
                                                    {{ $booking->vehicle->type }} • {{ $booking->vehicle->category }}
                                                </div>
                                            </td>
                                            <td>
                                                {{ $booking->pickup_date->format('M j, Y') }}
                                                <div class="text-muted small">
                                                    {{ $booking->pickup_location }}
                                                </div>
                                            </td>
                                            <td>
                                                {{ $booking->return_date->format('M j, Y') }}
                                                <div class="text-muted small">
                                                    {{ $booking->return_location }}
                                                </div>
                                            </td>
                                            <td>${{ number_format($booking->total_price + $booking->insurance_cost, 2) }}</td>
                                            <td>
                                                <span class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : 'warning' }}">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('vehicle-bookings.show', $booking->id) }}" 
                                                   class="btn btn-sm btn-outline-primary"
                                                   title="View Details">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                @if($booking->status === 'confirmed')
                                                    <button class="btn btn-sm btn-outline-danger"
                                                            title="Cancel Booking"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#cancelModal{{ $booking->id }}">
                                                        <i class="bi bi-x-circle"></i>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                        
                                        <!-- Cancel Booking Modal -->
                                        <div class="modal fade" id="cancelModal{{ $booking->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger text-white">
                                                        <h5 class="modal-title">Cancel Booking #{{ $booking->id }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to cancel your booking for the {{ $booking->vehicle->name }}?</p>
                                                        <p><strong>Pickup:</strong> {{ $booking->pickup_date->format('M j, Y') }}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <form action="{{ route('vehicle-bookings.cancel', $booking->id) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-danger">
                                                                Confirm Cancellation
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
    </div>
</div>
@endsection