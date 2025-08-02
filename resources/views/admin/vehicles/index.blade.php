@extends('admin.admin')

@section('title', 'Manage Vehicles')
@section('header', 'Vehicles')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm rounded-lg">
            <div class="card-header d-flex justify-content-between align-items-center bg-white">
                <h5 class="mb-0 font-weight-bold">All Vehicles</h5>
                <a href="{{ route('admin.vehicles.create') }}" class="btn btn-success btn-sm rounded-pill px-3">
                    <i class="fas fa-plus"></i> Add New Vehicle
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($vehicles as $vehicle)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $vehicle->name }}</td>
                                <td>{{ $vehicle->type }}</td>
                                <td>${{ number_format($vehicle->price_per_day, 2) }}</td>
                                <td>{{ $vehicle->location }}</td>
                                <td>
                                    @if ($vehicle->available)
                                        <span class="badge badge-success">Available</span>
                                    @else
                                        <span class="badge badge-danger">Not Available</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}" class="btn btn-sm btn-primary mr-1" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No vehicles found.</td>
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