@extends('admin.adminlte')

@section('title', 'Hotel Bookings - ' . $user->name)

@section('header', 'Hotel Bookings for ' . $user->name)

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-secondary btn-sm">
                &larr; Back to All Users
            </a>
        </div>
    </div>

    <!-- User Info -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow-sm rounded-lg border-left-success">
                <div class="card-body">
                    <h5><i class="fas fa-user-circle"></i> User Information</h5>
                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Hotel Bookings -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow-sm rounded-lg">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 font-weight-bold"><i class="fas fa-hotel me-2"></i>Hotel Bookings</h5>
                </div>
                <div class="card-body">
                    @if($user->hotelBookings->isNotEmpty())
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Hotel Name</th>
                                        <th>Check-in / Check-out</th>
                                        <th>Room Type</th>
                                        <th>Nights</th>
                                        <th>Meal Plan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->hotelBookings as $booking)
                                    <tr>
                                        <td>{{ $booking->hotel->name ?? 'N/A' }}</td>
                                        <td>
                                            {{ $booking->check_in_date->format('M d, Y') }}<br>
                                            {{ $booking->check_out_date->format('M d, Y') }}
                                        </td>
                                        <td>{{ $booking->room_type }}</td>
                                        <td>{{ $booking->nights }}</td>
                                        <td>{{ $booking->meal_plan }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">No hotel bookings found for this user.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Print Button -->
    <div class="row mb-4">
        <div class="col-md-12">
            <button onclick="window.print()" class="btn btn-outline-primary rounded-pill px-4">
                <i class="fas fa-print"></i> Print This Page
            </button>
        </div>
    </div>
</div>
@endsection