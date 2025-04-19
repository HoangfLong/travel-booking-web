<?php

namespace App\Repositories;

use App\Interfaces\IBaseRepository;
use App\Models\Booking;

class BookingRepository implements IBaseRepository
{
    public function getAll()
    {
        return Booking::paginate(10);
    }

    public function findById($id)
    {
        return Booking::findOrFail($id);
    }

    public function create(array $data)
    {
        return Booking::create($data);
    }

    public function update($id, array $data)
    {
        $booking = Booking::findOrFail($id);
        $booking->update($data);
        return $booking;
    }

    public function delete($id)
    {
        return false;
    }

    public function getByUserId($userId)
    {
        return Booking::where('user_id', $userId)
                        ->with('tour')
                        ->paginate(10);
    }
}