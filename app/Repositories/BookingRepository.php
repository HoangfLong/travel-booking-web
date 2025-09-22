<?php

namespace App\Repositories;

use App\Interfaces\IBaseRepository;
use App\Models\Booking;
use Illuminate\Support\Facades\Cache;

class BookingRepository implements IBaseRepository
{
    public function getAll()
    {
        return Cache::remember('bookings.paginated', 60, function () {
            return Booking::paginate(10);
        });
    }

    public function findById($id)
    {
        return Cache::remember("booking.{$id}", 60, function () use ($id) {
            return Booking::findOrFail($id);
        });
    }

    public function create(array $data)
    {
        $booking = Booking::create($data);

        // Xoá cache danh sách cũ
        Cache::forget('bookings.paginated');

        return $booking;
    }

    public function update($id, array $data)
    {
        $booking = Booking::findOrFail($id);
        $booking->update($data);

        // Xoá cache booking cũ và list
        Cache::forget("booking.$id");
        Cache::forget('bookings.paginated');

        return $booking;
    }

    public function delete($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        // Xoá cache liên quan
        Cache::forget("booking.$id");
        Cache::forget('bookings.paginated');

        return true;
    }

    public function getByUserId($userId)
    {
        return Cache::remember("bookings.user.$userId", 60, function () use ($userId) {
            return Booking::where('user_id', $userId)
                ->with('tour')
                ->paginate(10);
        });
    }
}
