@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Tour Management</h1>

    <!-- Nút điều hướng -->
    <div class="d-flex justify-content-between mb-3">
        <!-- Nút quay lại Dashboard -->
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>

        <!-- Nút thêm tour mới -->
        <div class="ms-auto">
            <a href="{{ route('admin.tours.create') }}" class="btn btn-primary me-2">
                <i class="fas fa-plus"></i> Add New Tour
            </a>
            <a href="{{ route('admin.tours.trash') }}" class="btn btn-danger">
                <i class="fas fa-trash"></i> Trash
            </a>
        </div>
    </div>

    <!-- Hiển thị thông báo thành công -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Bảng danh sách tour -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tour List</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Destinations</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tours as $tour)
                    <tr>
                        <td>{{ $tour->id }}</td>
                        <td>{{ $tour->title }}</td>
                        <td>{{ $tour->destinations }}</td>
                        <td>{{ $tour->start_time }}</td>
                        <td>{{ $tour->end_time }}</td>
                        <td>${{ number_format($tour->price, 2) }}</td>
                        <td>
                            <a href="{{ route('admin.tours.show', $tour->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <a href="{{ route('admin.tours.edit', $tour->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.tours.destroy', $tour->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-4" data-aos-delay="600">
        {{ $tours->links('components.nav-link') }}
    </div>
</div>
@endsection