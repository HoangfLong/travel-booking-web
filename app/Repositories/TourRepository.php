<?php

namespace App\Repositories;

use App\Interfaces\IBaseRepository;
use App\Models\Tour;

class TourRepository implements IBaseRepository
{
    public function getAll()
    {
        return Tour::paginate(10);
    }

    public function findById($id)
    {
        return Tour::findOrFail($id);
    }

    public function create(array $data)
    {
        return Tour::create($data);
    }

    public function update($id, array $data)
    {
        $tour = Tour::findOrFail($id);
        $tour->update($data);
        return $tour;
    }

    public function delete($id)
    {
        $tour = Tour::find($id);
        return $tour ? $tour->delete() : false;
    }

    public function restore($id)
    {
        $tour = Tour::withTrashed()->find($id);
        return $tour ? $tour->restore() : false;
    }

    public function forceDelete($id)
    {
        $tour = Tour::withTrashed()->find($id);
        return $tour ? $tour->forceDelete() : false;
    }

    public function getAllWithTrashed()
    {
        return Tour::onlyTrashed()->get();
    }
}
