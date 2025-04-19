@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="mb-4">Trashed Tours</h1>

        <a href="{{ route('admin.tours.index') }}" class="btn btn-secondary mb-3">
            <i class="fas fa-arrow-left"></i> Back to Tour List
        </a>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Deleted Tours</h3>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Destinations</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tours as $tour)
                            <tr>
                                <td>{{ $tour->id }}</td>
                                <td>{{ $tour->title }}</td>
                                <td>{{ $tour->destinations }}</td>
                                <td>
                                    <form action="{{ route('admin.tours.restore', $tour->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fas fa-undo"></i> Restore
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.tours.forceDelete', $tour->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i> Delete Permanently
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
