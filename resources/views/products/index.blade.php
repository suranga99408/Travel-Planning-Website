{{-- resources/views/products/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Travel Store')

@section('content')
<div class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="fw-bold">Travel Store</h1>
            <p class="lead text-muted">Get all the gear you need for your next adventure</p>
        </div>
        
        <div class="row mb-4">
            <div class="col-md-6">
                <form class="d-flex">
                    <input type="text" class="form-control me-2" placeholder="Search products...">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </form>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown">
                        Sort By
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Price: Low to High</a></li>
                        <li><a class="dropdown-item" href="#">Price: High to Low</a></li>
                        <li><a class="dropdown-item" href="#">Newest First</a></li>
                        <li><a class="dropdown-item" href="#">Most Popular</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="row g-4">
            @forelse($products as $product)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-primary fw-bold">${{ number_format($product->price, 2) }}</span>
                            <span class="badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }}">
                                {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                            </span>
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        @if($product->stock > 0)
                            <form action="{{ route('cart.add', $product) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary w-100">Add to Cart</button>
                            </form>
                        @else
                            <button class="btn btn-secondary w-100" disabled>Out of Stock</button>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    No products available at the moment.
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection