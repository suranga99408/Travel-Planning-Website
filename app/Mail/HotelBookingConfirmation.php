<?php

namespace App\Mail;

use App\Models\HotelBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HotelBookingConfirmation extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $booking;

    public function __construct(HotelBooking $booking)
    {
        $this->booking = $booking;
    }

    public function build()
    {
        return $this->markdown('emails.hotel_booking_confirmation')
                    ->subject('Your Hotel Booking Confirmation - ' . $this->booking->hotel->name)
                    ->with([
                        'booking' => $this->booking,
                        'hotel' => $this->booking->hotel,
                    ]);
    }
}