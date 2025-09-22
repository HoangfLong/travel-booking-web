<?php

namespace App\Services;

use App\Jobs\ProcessPaymentJob;
use App\Repositories\BookingRepository;
use App\Models\Tour;
use Exception;

class BookingService
{
    protected $bookingRepository;

    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    public function getAllBooking()
    {
        return $this->bookingRepository->getAll();
    }

    public function createBooking($userId, $tourId, $guestCount, $status = 'pending')
    {
        $tour = Tour::findOrFail($tourId);

        if ($guestCount > $tour->available_seats) {
            throw new Exception('Not enough available seats.');
        }

        $totalAmount = $tour->price * $guestCount;

        $booking = $this->bookingRepository->create([
            'user_id' => $userId,
            'tour_id' => $tour->id,
            'guest_count' => $guestCount,
            'start_date' => $tour->start_time,
            'end_date' => $tour->end_time,
            'total_amount' => $totalAmount,
        ]);

        // Giảm số ghế trống sau khi đặt chỗ
        $tour->decrement('available_seats', $guestCount);

        ProcessPaymentJob::dispatch($booking);

        return $booking;
    }

    public function getBookingById($id)
    {
        return $this->bookingRepository->findById($id);
    }

    public function getUserBookings($userId)
    {
        return $this->bookingRepository->getByUserId($userId);
    }
}
