<?php

namespace App\Http\Controllers\Api\V1;

use App\Services\TourService;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\TourRequest;

class TourController extends Controller
{
    protected $tourService;

    public function __construct(TourService $tourService)
    {
        $this->tourService = $tourService;
    }

    public function index()
    {
        $tours = $this->tourService->getAllTours();

        // return response()->json([
        //     // 'status' => 'success',
        //     'tours' => $tours
        // ]);
        return [
            // 'status' => 'success',
            $tours,
        ];
    }

    public function show($id)
    {
        $tour = $this->tourService->getTourById($id);
        return response()->json([
            'status' => 'success',
            'tours' => $tour
        ]);
    }

    public function store(TourRequest $request)
    {
        $tour = $this->tourService->createTour($request->validated());
        return response()->json([
            'status' => 'success',
            'tours' => $tour
        ]);
    }

    // Update
    public function update(TourRequest $request, $id)
    {
        $tour = $this->tourService->updateTour($id, $request->validated());
          return response()->json([
            'status' => 'success',
            'tours' => $tour
        ]);
    }

    // Soft delete
    public function destroy($id)
    {
        $tour = $this->tourService->deleteTour($id);
        return response()->json([
            'status' => 'success',
            'tours' => $tour,
            'message' => 'Tour deleted successfully'
        ]);
    }
    
    // Restore delete
    public function restore($id)
    {
        $this->tourService->restoreTour($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Tour restore successfully'
        ]);
    }

    // Force delete
    public function forceDelete($id)
    {
        $this->tourService->forceDeleteTour($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Tour permanently deleted successfully'
        ]);
    }

    // Get all trashed
    public function getAllTrashed()
    {
        $tours = $this->tourService->getAllToursWithTrashed();
        return response()->json([
            'status' => 'success',
            'tours' => $tours,
            'message' => "all tours trashed",
        ]);
    }
}
