<?php

namespace App\Repositories;

use App\Models\Booking;
use Illuminate\Support\Facades\Cache;

class RevenueRepository
{
    public function getTotalRevenue(): float
    {
        return Cache::remember('revenue.total', 300, function () {
            return Booking::sum('total_amount');
        });
    }

    public function getRevenueByMonth(int $year): array
    {
        return Cache::remember("revenue.by_month.$year", 300, function () use ($year) {
            return Booking::selectRaw('MONTH(created_at) as month, SUM(total_amount) as revenue')
                ->whereYear('created_at', $year)
                ->groupBy('month')
                ->orderBy('month')
                ->get()
                ->toArray();
        });
    }
}
