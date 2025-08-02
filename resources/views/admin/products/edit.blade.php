@extends('admin.admin')

@section('title', 'Edit Product - ' . $product->name)
@section('header', 'Edit Product')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm rounded-lg">
            <div class="card-body p-4">
                <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Basic Info -->
                    <div class="mb-4">
                        <h5>Product Information</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Product Name *</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Price *</label>
                                <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Description *</label>
                                <textarea name="description" rows="4" class="form-control" required>{{ old('description', $product->description) }}</textarea>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Stock Quantity *</label>
                                <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Featured</label>
                                <select name="featured" class="form-control">
                                    <option value="0" {{ $product->featured ? '' : 'selected' }}>No</option>
                                    <option value="1" {{ $product->featured ? 'selected' : '' }}>Yes</option>
                                </select>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Current Image</label><br>
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="120" class="mb-2">
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success rounded-pill mt-3">Update Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection