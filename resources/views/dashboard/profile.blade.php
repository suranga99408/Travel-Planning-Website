@extends('layouts.app')

@section('title', 'Edit Profile')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h4>Edit Profile</h4>
                </div>
                <div class="card-body">

                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <!-- Edit Name Form -->
                    <form action="{{ route('user.update.name') }}" method="POST" class="mb-4">
                        @csrf
                        <h5>Update Name</h5>
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
                            </div>
                            <div class="col-md-4 d-grid">
                                <button type="submit" class="btn btn-success">Save Name</button>
                            </div>
                        </div>
                    </form>

                    <!-- Change Password Form -->
                    <form action="{{ route('user.change.password') }}" method="POST" class="mb-4">
                        @csrf
                        <h5>Change Password</h5>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" name="current_password" class="form-control" required>
                            </div>
                            <div class="col-md-12">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="col-md-12">
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                            <div class="col-md-12 d-grid">
                                <button type="submit" class="btn btn-primary mt-3">Change Password</button>
                            </div>
                        </div>
                    </form>

                    <!-- Delete Account -->
                    <form action="{{ route('user.delete.account') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <h5>Delete Account</h5>
                        <p class="text-muted">This action cannot be undone.</p>
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete My Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection