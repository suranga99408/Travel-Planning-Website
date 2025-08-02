@extends('admin.admin')

@section('title', 'Add New Product')
@section('header', 'Add New Product')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm rounded-lg">
            <div class="card-body p-4">
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Basic Info -->
                    <div class="mb-4">
                        <h5>Product Information</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Product Name *</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Price *</label>
                                <input type="number" step="0.01" name="price" class="form-control" required>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Description *</label>
                                <textarea name="description" rows="4" class="form-control" required></textarea>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Stock Quantity *</label>
                                <input type="number" name="stock" class="form-control" value="10" required>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Featured</label>
                                <select name="featured" class="form-control">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Product Image *</label>
                                <input type="file" name="image" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success rounded-pill mt-3">Save Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection