@extends('admin.adminlte')

@section('title', 'User Bookings - Gamanak Travel Planner')

@section('header', 'User Bookings')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm rounded-lg">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0 font-weight-bold">Users with Bookings</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Plan Bookings</th>
                                <th>Hotel Bookings</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->bookings->count() }}</td>
                                <td>{{ $user->hotelBookings->count() }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.bookings.plans', $user->id) }}" class="btn btn-sm btn-outline-primary me-1">
                                            <i class="fas fa-map-marked-alt"></i> View Plans
                                        </a>
                                        <a href="{{ route('admin.bookings.hotels', $user->id) }}" class="btn btn-sm btn-outline-info">
                                            <i class="fas fa-hotel"></i> View Hotels
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">No users found with bookings.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection