<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Services\BookingService;
class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function index()
    {
        $bookings = $this->bookingService->getAllBooking();

        return response()->json([
            'status' => 200,
            'bookings' => $bookings,
        ]);
    }

    public function show($id)
    {
        $booking = $this->bookingService->getBookingById($id);

        return response()->json([
            'status' => 200,
            'booking' => $booking,
        ]);
    }
}
