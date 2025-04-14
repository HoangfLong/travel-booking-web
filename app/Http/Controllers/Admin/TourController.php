<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TourRequest;
use App\Services\TourService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TourController extends Controller
{
    protected $tourService;

    public function __construct(TourService $tourService)
    {
        $this->tourService = $tourService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $tours = $this->tourService->getAllTours();
        return view('admin.tours.index', compact('tours'));
    }
    // Detail
    public function show($id): View
    {
        $tour = $this->tourService->getTourById($id);
        return view('admin.tours.show', compact('tour'));
    }

    // Create
    public function create(): View
    {
        return view('admin.tours.create');
    }

    public function store(TourRequest $request) : RedirectResponse
    {
        $this->tourService->createTour($request->validated());
        return redirect()->route('admin.tours.index')->with('success', 'Tour created successfully');
    }

    // Edit
    public function edit($id): View
    {
        $tour = $this->tourService->getTourById($id);
        return view('admin.tours.edit', compact('tour'));
    }

    // Update
    public function update(TourRequest $request, $id): RedirectResponse
    {
        $this->tourService->updateTour($id, $request->validated());
        return redirect()->route('admin.tours.index')->with('success', 'Tour updated successfully');
    }

    // Soft delete
    public function destroy($id): RedirectResponse
    {
        $this->tourService->deleteTour($id);
        return redirect()->route('admin.tours.index')->with('success', 'Tour deleted successfully');
    }
    
    // Restore delete
    public function restore($id): RedirectResponse
    {
        $this->tourService->restoreTour($id);
        return redirect()->route('admin.tours.trash')->with('success', 'Tour restored successfully');
    }

    // Force delete
    public function forceDelete($id): RedirectResponse
    {
        $this->tourService->forceDeleteTour($id);
        return redirect()->route('admin.tours.trash')->with('success', 'Tour permanently deleted successfully');
    }

    // Get all trashed
    public function getAllTrashed(): View
    {
        $tours = $this->tourService->getAllToursWithTrashed();
        return view('admin.tours.trash', compact('tours'));
    }
}
