<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\BookingService;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function index()
    {
        $userId = Auth::id();
        $bookings = $this->bookingService->getUserBookings($userId);

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
