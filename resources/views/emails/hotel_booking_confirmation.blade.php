<!-- resources/views/emails/hotel_booking_confirmation.blade.php -->
@component('mail::message')
# Hotel Booking Confirmation

Thank you for your booking at **{{ $hotel->name }}**! Here are your reservation details:

**Booking Reference:** #{{ $booking->id }}  
**Status:** {{ ucfirst($booking->status) }}  

## Hotel Information
**Name:** {{ $hotel->name }}  
**Location:** {{ $hotel->location }}  
**Check-in:** {{ $booking->check_in->format('l, F j, Y') }} (from 3:00 PM)  
**Check-out:** {{ $booking->check_out->format('l, F j, Y') }} (by 11:00 AM)  
**Nights:** {{ $booking->nights }}  

## Room Details
**Type:** {{ ucfirst($booking->room_type) }} Room  
**Number of Rooms:** {{ $booking->room_count }}  
**Guests:** {{ $booking->adults }} Adult(s), {{ $booking->children }} Child(ren)  

## Pricing Summary
@component('mail::table')
| Description          | Amount          |
|----------------------|----------------:|
| Room Rate ({{ $booking->nights }} nights) | ${{ number_format($booking->room_rate * $booking->nights * $booking->room_count, 2) }} |
| Taxes & Fees         | ${{ number_format($booking->taxes, 2) }} |
| **Total**            | **${{ number_format($booking->total_price, 2) }}** |
@endcomponent

@if($booking->special_requests)
**Special Requests:**  
{{ $booking->special_requests }}
@endif

@component('mail::button', ['url' => route('hotel-bookings.show', $booking)])
View Booking Details
@endcomponent

If you have any questions, please contact the hotel directly at **{{ $hotel->phone }}** or reply to this email.

Thank you for choosing us!  
**{{ config('app.name') }} Team**
@endcomponent