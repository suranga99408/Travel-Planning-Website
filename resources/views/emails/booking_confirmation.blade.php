<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #3490dc; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; border: 1px solid #ddd; border-top: none; }
        .footer { margin-top: 20px; text-align: center; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Booking Confirmation</h1>
        </div>
        
        <div class="content">
            <p>Dear {{ $booking->user->name }},</p>
            
            <p>Thank you for booking with Travel Planner! Here are your booking details:</p>
            
            <h3>Plan Details</h3>
            <p><strong>Plan:</strong> {{ $booking->plan->title }}</p>
            <p><strong>Start Date:</strong> {{ $booking->plan->start_date->format('M d, Y') }}</p>
            <p><strong>Start Location:</strong> {{ $booking->plan->start_location }}</p>
            <p><strong>Number of People:</strong> {{ $booking->number_of_people }}</p>
            <p><strong>Total Price:</strong> ${{ number_format($booking->total_price, 2) }}</p>
            
            @if($booking->special_requests)
            <h3>Special Requests</h3>
            <p>{{ $booking->special_requests }}</p>
            @endif
            
            <p>We're excited to help you with your travel plans. If you have any questions, please don't hesitate to contact us.</p>
            
            <p>Safe travels!</p>
            <p>The Travel Planner Team</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} Travel Planner. All rights reserved.</p>
        </div>
    </div>
</body>
</html>