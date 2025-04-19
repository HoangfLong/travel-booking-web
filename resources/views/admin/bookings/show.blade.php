@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Booking Details</h1>

    <div class="card mb-4">
        <div class="card-header">Booking Info</div>
        <div class="card-body">
            <p><strong>Booking ID:</strong> {{ $booking->id }}</p>
            <p><strong>Status:</strong> 
                <span class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : 'secondary' }}">
                    {{ ucfirst($booking->status) }}
                </span>
            </p>
            <p><strong>Guests:</strong> {{ $booking->guest_count }}</p>
            <p><strong>Total Amount:</strong> {{ number_format($booking->total_amount, 0, ',', '.') }} VND</p>
            <p><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($booking->start_date)->format('d/m/Y') }}</p>
            <p><strong>End Date:</strong> {{ \Carbon\Carbon::parse($booking->end_date)->format('d/m/Y') }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">User Info</div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $booking->user->first_name }} {{ $booking->user->last_name }}</p>
            <p><strong>Email:</strong> {{ $booking->user->email }}</p>
            <p><strong>Phone:</strong> {{ $booking->user->phone ?? 'N/A' }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Tour Info</div>
        <div class="card-body">
            <p><strong>Tour Title:</strong> {{ $booking->tour->title ?? 'N/A' }}</p>
            <p><strong>Description:</strong> {{ $booking->tour->description ?? 'N/A' }}</p>
            <p><strong>Price per Guest:</strong> {{ number_format($booking->tour->price ?? 0, 0, ',', '.') }} VND</p>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Back to Bookings</a>
    </div>
</div>
@endsection
