@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
            </div>
            <div class="col-md-6">
                <h1 class="fw-bold">{{ $product->name }}</h1>
                <p class="lead">${{ number_format($product->price, 2) }}</p>
                <p>{{ $product->description }}</p>
                
                <div class="mb-3">
                    <span class="badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }}">
                        {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                    </span>
                </div>
                
                @if($product->stock > 0)
                    <form action="{{ route('cart.add', $product) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                @else
                    <button class="btn btn-secondary" disabled>Out of Stock</button>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection