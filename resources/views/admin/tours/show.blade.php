@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">{{ $tour->title }}</h2>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Description</th>
                        <td>{{ $tour->description }}</td>
                    </tr>
                    <tr>
                        <th>Destinations</th>
                        <td>{{ $tour->destinations }}</td>
                    </tr>
                    <tr>
                        <th>Number of Days</th>
                        <td>{{ $tour->number_of_days }}</td>
                    </tr>
                    <tr>
                        <th>Start Time</th>
                        <td>{{ date('F d, Y H:i', strtotime($tour->start_time)) }}</td>
                    </tr>
                    <tr>
                        <th>End Time</th>
                        <td>{{ date('F d, Y H:i', strtotime($tour->end_time)) }}</td>
                    </tr>
                    <tr>
                        <th>Number of Guests</th>
                        <td>{{ $tour->number_of_guests }}</td>
                    </tr>
                    <tr>
                        <th>Available Seats</th>
                        <td>{{ $tour->available_seats }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge 
                                @if($tour->status == 'active') bg-success
                                @elseif($tour->status == 'canceled') bg-danger
                                @else bg-secondary
                                @endif">
                                {{ ucfirst($tour->status) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td>{{ number_format($tour->price, 2) }} VND</td>
                    </tr>
                    <tr>
                        <th>Images</th>
                        <td>
                            @if ($tour->images)
                                <div class="d-flex flex-wrap">
                                    @foreach (explode(',', $tour->images) as $image)
                                        <img src="{{ asset('storage/' . trim($image)) }}" class="img-thumbnail me-2" style="width: 150px; height: 100px;">
                                    @endforeach
                                </div>
                            @else
                                <span class="text-muted">No images available.</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('admin.tours.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
                <a href="{{ route('admin.tours.edit', $tour->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>
</div>
@endsection