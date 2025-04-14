@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Booking Management</h1>

    <!-- Navigation Buttons -->
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Booking Table -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Bookings List</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tour</th>
                        <th>Booker</th>
                        <th>Guests</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $booking)
                        <tr>
                            <td>{{ $booking->id }}</td>
                            <td>{{ $booking->tour->title ?? 'N/A' }}</td>
                            <td>{{ $booking->user->first_name }} {{ $booking->user->last_name }}</td>
                            <td>{{ $booking->guest_count }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->start_date)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->end_date)->format('d/m/Y') }}</td>
                            <td>{{ number_format($booking->total_amount, 0, ',', '.') }} VND</td>
                            <td>
                                <span class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                {{-- You can add "edit" or "cancel" action buttons here if needed --}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No bookings found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4" data-aos-delay="600">
        {{ $bookings->links('components.nav-link') }}
    </div>
</div>
@endsection
