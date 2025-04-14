@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">User Details</h1>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $user->first_name }} {{ $user->last_name }}</h3>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item"><strong>ID:</strong> {{ $user->id }}</li>
                <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
                <li class="list-group-item"><strong>Gender:</strong> {{ $user->gender }}</li>
                <li class="list-group-item"><strong>Birthday:</strong> {{ $user->date_of_birth }}</li>
                <li class="list-group-item"><strong>Phone:</strong> {{ $user->phone }}</li>
                <li class="list-group-item"><strong>Created At:</strong> {{ $user->created_at }}</li>
                <li class="list-group-item"><strong>Updated At:</strong> {{ $user->updated_at }}</li>
                <strong>Login Method:</strong>
                <li class="list-group-item">
                    <strong>Login Method:</strong>
                    @if ($user->google_id)
                        <span class="badge bg-danger"><i class="fab fa-google"></i> Google</span>
                    @elseif ($user->facebook_id)
                        <span class="badge bg-primary"><i class="fab fa-facebook-f"></i> Facebook</span>
                    @else
                        <span class="badge bg-secondary">Email/Password</span>
                    @endif
                </li>             
            </ul>
        </div>
    </div>
</div>
@endsection
