@extends('adminPanel.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">

        <!-- Statistics Cards Row 1 -->
        <div class="row">
            <!-- Total Bookings Card -->
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card stats-card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase text-white-50 mb-1">Total Bookings</h6>
                                <h2 class="mb-0">{{ $statistics['total_bookings'] }}</h2>
                            </div>
                            <div class="stats-icon">
                                <i class="fas fa-ticket-alt fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Revenue Card -->
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card stats-card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase text-white-50 mb-1">Total Revenue</h6>
                                <h2 class="mb-0">${{ $statistics['total_revenue'] }}</h2>
                            </div>
                            <div class="stats-icon">
                                <i class="fas fa-dollar-sign fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Cabins Card -->
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card stats-card bg-info text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase text-white-50 mb-1">Total Cabins</h6>
                                <h2 class="mb-0">{{ $statistics['total_cabins'] }}</h2>
                            </div>
                            <div class="stats-icon">
                                <i class="fas fa-bed fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Customers Card -->
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card stats-card bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase text-white-50 mb-1">Total Customers</h6>
                                <h2 class="mb-0">{{ $statistics['total_customers'] }}</h2>
                            </div>
                            <div class="stats-icon">
                                <i class="fas fa-users fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards Row 2 -->
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card stats-card bg-gradient-purple text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase text-white-50 mb-1">Available Cabins</h6>
                                <h2 class="mb-0">{{ $statistics['available_cabins'] }}</h2>
                            </div>
                            <div class="stats-icon">
                                <i class="fas fa-door-open fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card stats-card bg-gradient-danger text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase text-white-50 mb-1">Reserved Cabins</h6>
                                <h2 class="mb-0">{{ $statistics['reserved_cabins'] }}</h2>
                            </div>
                            <div class="stats-icon">
                                <i class="fas fa-door-closed fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card stats-card bg-gradient-dark text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase text-white-50 mb-1">Total Trips</h6>
                                <h2 class="mb-0">{{ $statistics['total_trips'] }}</h2>
                            </div>
                            <div class="stats-icon">
                                <i class="fas fa-ship fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts and Recent Activity Row -->
        <div class="row">
            <!-- Revenue Chart -->
            <div class="col-md-8 mb-3">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-chart-line"></i> Monthly Revenue Trend
                    </div>
                    <div class="card-body">
                        <canvas id="revenueChart" height="80"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Bookings -->
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-list"></i> Recent Bookings
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @forelse($recentBookings as $booking)
                            <a href="{{ route('adminPanel.reservations.show', $booking->id) }}"
                               class="list-group-item list-group-item-action">
                                <div class="d-flex justify-content-between">
                                    <strong>{{ $booking->user->first_name }} {{ $booking->user->last_name }}</strong>
                                    <span class="badge badge-{{ $booking->status === 1 ? 'success' : ($booking->status === 0 ? 'danger' : 'warning') }}">
                                        {{ $booking->status === 1 ? 'Success' : ($booking->status === 0 ? 'Failed' : 'Pending') }}
                                    </span>
                                </div>
                                <small class="text-muted">${{ number_format($booking->price, 2) }} - {{ $booking->created_at->diffForHumans() }}</small>
                            </a>
                            @empty
                            <div class="list-group-item text-center text-muted">
                                <i class="fas fa-inbox"></i> No recent bookings
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
$(document).ready(function() {
    // Revenue Chart
    const revenueData = @json($monthlyRevenue);
    const labels = revenueData.map(item => {
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        return months[item.month - 1] + ' ' + item.year;
    });
    const data = revenueData.map(item => item.revenue);

    new Chart(document.getElementById('revenueChart'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Revenue ($)',
                data: data,
                borderColor: '#4a90e2',
                backgroundColor: 'rgba(74, 144, 226, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Revenue: $' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '$' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });
});
</script>
@endpush
