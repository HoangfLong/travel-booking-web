<?php

namespace App\Http\Controllers\Api\V1;

use App\Services\TourService;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\TourRequest;
use App\Models\Tour;
use Illuminate\Support\Facades\DB;

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

        // $tours = DB::table('tours')->where('id',9)->first(); 

        // $tours = Tour::with('bookings')->take(2)->get();

        return response()->json([
            'status' => 'success',
            'tours' => $tours
        ]);
        // return [
        //     // 'status' => 'success',
        //     $tours,
        // ];
    }

    public function show($id)
    {
        $tour = $this->tourService->getTourById($id);
        return response()->json([
            'status' => 'success',
            'tours' => $tour
        ]);
    }
}
