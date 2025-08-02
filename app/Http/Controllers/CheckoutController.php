<?php

// app/Http/Controllers/CheckoutController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = session()->get('cart', []);
        
        if (empty($cartItems)) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty!');
        }
        
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('checkout.index', compact('cartItems', 'total'));
    }

    public function processPayment(Request $request)
    {
        $user = Auth::user();
        $cartItems = session()->get('cart', []);
        $total = 0;
        
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        try {
            $payment = $user->charge(
                $total * 100, // Convert to cents
                $request->payment_method_id,
                [
                    'receipt_email' => $user->email,
                    'description' => 'Purchase from Travel Store',
                ]
            );
            
            // Clear the cart
            session()->forget('cart');
            
            return redirect()->route('checkout.success')->with('success', 'Payment successful!');
            
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function success()
    {
        return view('checkout.success');
    }
}