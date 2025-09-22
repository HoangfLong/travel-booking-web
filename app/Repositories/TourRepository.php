<?php

namespace App\Repositories;

use App\Interfaces\IBaseRepository;
use App\Models\Tour;
use Illuminate\Support\Facades\Cache;

class TourRepository implements IBaseRepository
{
    public function getAll()
    {
        return Cache::remember('tours.paginated', 60, function () {
            return Tour::paginate(10);
        });
    }

    public function findById($id)
    {
        return Cache::remember("tour.{$id}", 60, function () use ($id) {
            return Tour::findOrFail($id);
        });

    }

    public function create(array $data)
    {
        $tour = Tour::create($data);

        // clear cache
        Cache::forget('tours.paginated');

        return $tour;
    }


    public function update($id, array $data)
    {
        $tour = Tour::findOrFail($id);
        $tour->update($data);

        Cache::forget("tour.{$id}");
        Cache::forget('tours.paginated');

        return $tour;
    }

    public function delete($id)
    {
        $tour = Tour::find($id);
        if ($tour) {
            $tour->delete();
            Cache::forget("tour.{$id}");
            Cache::forget('tours.paginated');
            return true;
        }
        return false;
    }

    public function restore($id)
    {
        $tour = Tour::withTrashed()->find($id);
        if ($tour) {
            $tour->restore();
            Cache::forget('tours.paginated');
            return true;
        }
        return false;
    }

    public function forceDelete($id)
    {
        $tour = Tour::withTrashed()->find($id);
        if ($tour) {
            $tour->forceDelete();
            Cache::forget("tour.{$id}");
            Cache::forget('tours.paginated');
            return true;
        }
        return false;
    }

    public function getAllWithTrashed()
    {
        return Cache::remember('tours.trashed', 60, function () {
            return Tour::onlyTrashed()->get();
        });
    }
}
