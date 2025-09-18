<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Services\RevenueService;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    protected $revenueService;

    public function __construct(RevenueService $revenueService)
    {
        $this->revenueService = $revenueService;
    }

    public function index(Request $request)
    {
        $year = $request->get('year', now()->year);
        $totalRevenue = $this->revenueService->getTotalRevenue();
        $monthlyRevenue = $this->revenueService->getMonthlyRevenue($year);

        return response()->json([
            'status' => 200,
            'year' => $year,
            'totalRevenue' => $totalRevenue,
            'monthlyRevenue' => $monthlyRevenue,
        ]);
    }
}
