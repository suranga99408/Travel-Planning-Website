@extends('admin.admin')

@section('title', 'Manage Users')

@section('header', 'Users')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm rounded-lg">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0 font-weight-bold">All Users</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Admin</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->is_admin)
                                        <span class="badge badge-success">Yes</span>
                                    @else
                                        <span class="badge badge-secondary">No</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No users found.</td>
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