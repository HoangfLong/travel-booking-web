<!-- filepath: c:\Users\Admin\Documents\Laravel\travel-booking-web\resources\views\admin\dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Revenue Management</h1>

    <!-- Tổng doanh thu -->
    <div class="row">
        <div class="col-md-4">
            <div class="info-box bg-success">
                <span class="info-box-icon"><i class="fas fa-dollar-sign"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Revenue</span>
                    <span class="info-box-number">VND {{ number_format($totalRevenue, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Nút điều hướng đến trang quản lý tour -->
        <div class="col-md-8 mt-3">
            <div class="d-flex justify-content-start gap-3 flex-wrap">
                <a href="{{ route('admin.tours.index') }}" class="btn btn-primary">
                    <i class="fas fa-route"></i> Manage Tours
                </a>
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary">
                    <i class="fas fa-users"></i> Manage Users
                </a>
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-primary">
                    <i class="fas fa-book"></i> Manage Bookings
                </a>
            </div>
        </div>        
    </div>

    <!-- Biểu đồ doanh thu theo tháng -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Monthly Revenue for {{ $year }}</h3>
                </div>
                <div class="card-body">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Bảng doanh thu theo tháng -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Monthly Revenue Table</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Month</th>
                                <th>Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($monthlyRevenue as $data)
                                <tr>
                                    <td>{{ DateTime::createFromFormat('!m', $data['month'])->format('F') }}</td>
                                    <td>VND {{ number_format($data['revenue'], 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json(array_map(fn($data) => DateTime::createFromFormat('!m', $data['month'])->format('F'), $monthlyRevenue)),
            datasets: [{
                label: 'Revenue',
                data: @json(array_column($monthlyRevenue, 'revenue')),
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection