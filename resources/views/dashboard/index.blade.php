@extends('layouts.app')

@section('title', 'Dashboard')
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-3">
            @include('dashboard.sidebar')
        </div>
        <div class="col-md-9">
            <h2 class="mb-4">Welcome to Your Dashboard</h2>

            <!-- Show success/error messages -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <!-- Recent Bookings -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0">Recent Bookings</h5>
                </div>
                <div class="card-body">
                    <p>You can display recent plan, hotel, and vehicle bookings here.</p>
                    <!-- TODO: Add booking cards or table -->
                </div>
            </div>

            <!-- Account Actions -->
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('user.dashboard.profile') }}" class="card card-body text-center shadow-sm rounded-lg h-100">
                        <i class="fas fa-user-circle fa-2x text-primary mb-2"></i>
                        <h5>Edit Profile</h5>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="#" class="card card-body text-center shadow-sm rounded-lg h-100">
                        <i class="fas fa-history fa-2x text-success mb-2"></i>
                        <h5>Booking History</h5>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection