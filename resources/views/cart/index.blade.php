@extends('layouts.app')

@section('title', 'Your Shopping Cart')

@section('content')
<div class="py-5 bg-light">
    <div class="container">
        <h1 class="fw-bold mb-4">Your Shopping Cart</h1>
        
        @if(count($cartItems) > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $id => $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('storage/' . $item['image']) }}" width="60" class="img-thumbnail me-3" alt="{{ $item['name'] }}">
                                        <span>{{ $item['name'] }}</span>
                                    </div>
                                </td>
                                <td>${{ number_format($item['price'], 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control form-control-sm" style="width: 70px;">
                                        <button type="submit" class="btn btn-sm btn-outline-primary ms-2">Update</button>
                                    </form>
                                </td>
                                <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end fw-bold">Total:</td>
                            <td colspan="2" class="fw-bold">${{ number_format($total, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Continue Shopping</a>
                <a href="{{ route('checkout.index') }}" class="btn btn-primary">Proceed to Checkout</a>
            </div>
        @else
            <div class="alert alert-info">
                Your cart is empty. <a href="{{ route('products.index') }}">Browse our products</a>
            </div>
        @endif
    </div>
</div>
@endsection