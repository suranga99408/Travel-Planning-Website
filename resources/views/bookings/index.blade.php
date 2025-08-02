@extends('layouts.app')

@section('title', 'My Bookings')

@section('content')
<div class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4">My Bookings</h2>
                
                @if($bookings->isEmpty())
                    <div class="alert alert-info">
                        You haven't made any bookings yet.
                        <a href="{{ route('plans.index') }}" class="alert-link">Browse travel plans</a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Plan</th>
                                    <th>Travel Date</th>
                                    <th>People</th>
                                    <th>Total Amount</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $booking)
                                    <tr>
                                        <td>#{{ $booking->id }}</td>
                                        <td>{{ $booking->plan->title }}</td>
                                        <td>{{ $booking->plan->start_date->format('M d, Y') }}</td>
                                        <td>{{ $booking->number_of_people }}</td>
                                        <td>${{ number_format($booking->total_amount, 2) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : 'warning' }}">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    {{ $bookings->links() }}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection