@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">User Management</h1>

    <!-- Navigation buttons -->
    <div class="d-flex justify-content-between mb-3">
        <!-- Back to Dashboard -->
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>

        <!-- Action buttons -->
        <div class="ms-auto">
            <a href="{{ route('admin.users.trash') }}" class="btn btn-danger">
                <i class="fas fa-trash-alt"></i> View Deleted Users
            </a>
        </div>
    </div>

    <!-- Success message -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- User table -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">User List</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Birthday</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->gender }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('admin.users.show' , $user->id) }} " class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-4" data-aos-delay="600">
        {{ $users->links('components.nav-link') }}
    </div>
</div>
@endsection
