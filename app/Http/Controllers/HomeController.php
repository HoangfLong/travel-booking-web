<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function home(): View
    {
        $tours = Tour::latest()->take(3)->get();
        //
        return view('tours.home', compact('tours'));
    }
}
