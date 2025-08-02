@extends('admin.adminlte')

@section('title', 'Plan Bookings - ' . $user->name)

@section('header', 'Plan Bookings for ' . $user->name)

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

    <!-- Plan Bookings -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow-sm rounded-lg">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 font-weight-bold"><i class="fas fa-map-marked-alt me-2"></i>Plan Bookings</h5>
                </div>
                <div class="card-body">
                    @if($user->bookings->isNotEmpty())
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Plan Title</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->bookings as $booking)
                                    <tr>
                                        <td>{{ $booking->plan->title ?? 'N/A' }}</td>
                                        <td>{{ $booking->created_at->format('M d, Y') }}</td>
                                        <td><span class="badge badge-success">Confirmed</span></td>
                                        <td>${{ number_format($booking->plan->price_per_person ?? 0, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">No plan bookings found for this user.</p>
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