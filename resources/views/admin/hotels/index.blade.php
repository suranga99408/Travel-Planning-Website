@extends('admin.admin')

@section('title', 'Manage Hotels')
@section('header', 'Hotels')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm rounded-lg">
            <div class="card-header d-flex justify-content-between align-items-center bg-white">
                <h5 class="mb-0 font-weight-bold">All Hotels</h5>
                <a href="{{ route('admin.hotels.create') }}" class="btn btn-success btn-sm rounded-pill px-3">
                    <i class="fas fa-plus"></i> Add New Hotel
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
                                <th>Category</th>
                                <th>Price/Night</th>
                                <th>Location</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($hotels as $hotel)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $hotel->name }}</td>
                                <td>{{ $hotel->type }}</td>
                                <td>{{ $hotel->category }}</td>
                                <td>${{ number_format($hotel->price_per_night, 2) }}</td>
                                <td>{{ $hotel->location }}</td>
                                <td>
                                    <a href="{{ route('admin.hotels.edit', $hotel->id) }}" class="btn btn-sm btn-primary mr-1" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.hotels.destroy', $hotel->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
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
                                <td colspan="7" class="text-center text-muted py-4">No hotels found.</td>
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