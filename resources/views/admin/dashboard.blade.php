@extends('admin.admin')

@section('title', 'Dashboard - Gamanak Travel Planner')

@section('header', 'Admin Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row text-center mb-4">
        <div class="col-md-12">
            <h2 class="font-weight-bold" style="color: #2C3E50;">Welcome to Gamanak Travel Planner Admin</h2>
            <p class="text-muted">Manage trips, hotels, vehicles, and store items from here.</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row justify-content-center">
        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm border-left-success rounded-lg">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="p-2 bg-success rounded-circle text-white">
                            <i class="fas fa-map-marked-alt fa-lg"></i>
                        </div>
                        <div class="ml-3">
                            <h5 class="mb-0 font-weight-bold">Trips</h5>
                            <small class="text-muted">Manage trip plans</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm border-left-primary rounded-lg">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="p-2 bg-primary rounded-circle text-white">
                            <i class="fas fa-hotel fa-lg"></i>
                        </div>
                        <div class="ml-3">
                            <h5 class="mb-0 font-weight-bold">Hotels</h5>
                            <small class="text-muted">Manage hotel listings</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 mt-3 mt-sm-0">
            <div class="card shadow-sm border-left-warning rounded-lg">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="p-2 bg-warning rounded-circle text-white">
                            <i class="fas fa-car-side fa-lg"></i>
                        </div>
                        <div class="ml-3">
                            <h5 class="mb-0 font-weight-bold">Vehicles</h5>
                            <small class="text-muted">Manage vehicle rentals</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 mt-3 mt-sm-0">
            <div class="card shadow-sm border-left-danger rounded-lg">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="p-2 bg-danger rounded-circle text-white">
                            <i class="fas fa-shopping-bag fa-lg"></i>
                        </div>
                        <div class="ml-3">
                            <h5 class="mb-0 font-weight-bold">Store Items</h5>
                            <small class="text-muted">Manage travel store products</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card shadow-sm rounded-lg">
                <div class="card-header bg-white border-0">
                    <h5 class="font-weight-bold" style="color: #2C3E50;">Recent Activity</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            New trip plan added
                            <span class="badge badge-success badge-pill">Just now</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Hotel listing updated
                            <span class="badge badge-primary badge-pill">1 hour ago</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Vehicle rental request received
                            <span class="badge badge-warning badge-pill">3 hours ago</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Product added to store
                            <span class="badge badge-danger badge-pill">Yesterday</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection