@extends('admin.admin')

@section('title', 'Manage Travel Plans')

@section('header', 'Travel Plans')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm rounded-lg">
            <div class="card-header d-flex justify-content-between align-items-center bg-white">
                <h5 class="mb-0 font-weight-bold">All Travel Plans</h5>
                <a href="{{ route('admin.plans.create') }}" class="btn btn-success btn-sm rounded-pill px-3">
                    <i class="fas fa-plus"></i> Add New Plan
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Start Date</th>
                                <th>Location</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($plans as $plan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $plan->title }}</td>
                                <td>${{ number_format($plan->price_per_person, 2) }}</td>
                                <td>{{ $plan->start_date->format('M d, Y') }}</td>
                                <td>{{ $plan->start_location }}</td>
                                <td>
                                    <a href="{{ route('admin.plans.edit', $plan->id) }}" class="btn btn-sm btn-primary mr-1" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.plans.destroy', $plan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
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
                                <td colspan="6" class="text-center text-muted py-4">No plans found.</td>
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