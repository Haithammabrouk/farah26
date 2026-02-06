@extends('adminPanel.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">

        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><i class="fas fa-chart-bar"></i> Reports</li>
        </ol>

        <!-- Date Range Filter Card -->
        <div class="card">
            <div class="card-header">
                <i class="fa fa-filter"></i> Filter Reports by Date Range
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('adminPanel.reports.index') }}">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>From Date:</label>
                                <input type="text"
                                       name="date_from"
                                       class="form-control datetimepicker"
                                       value="{{ $dateFrom }}"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>To Date:</label>
                                <input type="text"
                                       name="date_to"
                                       class="form-control datetimepicker"
                                       value="{{ $dateTo }}"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fa fa-search"></i> Generate Report
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Report Period Info -->
        <div class="alert alert-info">
            <i class="fa fa-info-circle"></i>
            <strong>Report Period:</strong> {{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }}
            to {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }}
            ({{ \Carbon\Carbon::parse($dateFrom)->diffInDays(\Carbon\Carbon::parse($dateTo)) + 1 }} days)
        </div>

        <!-- Statistics Cards Row 1 -->
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card stats-card bg-primary text-white">
                    <div class="card-body text-center">
                        <h6 class="text-uppercase text-white-50">Bookings</h6>
                        <h2>{{ $statistics['total_bookings'] }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card stats-card bg-success text-white">
                    <div class="card-body text-center">
                        <h6 class="text-uppercase text-white-50">Revenue</h6>
                        <h2>${{ $statistics['total_revenue'] }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card stats-card bg-info text-white">
                    <div class="card-body text-center">
                        <h6 class="text-uppercase text-white-50">Total Cabins</h6>
                        <h2>{{ $statistics['total_cabins'] }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card stats-card bg-warning text-white">
                    <div class="card-body text-center">
                        <h6 class="text-uppercase text-white-50">Customers</h6>
                        <h2>{{ $statistics['total_customers'] }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards Row 2 -->
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card stats-card bg-gradient-purple text-white">
                    <div class="card-body text-center">
                        <h6 class="text-uppercase text-white-50">Available Cabins</h6>
                        <h2>{{ $statistics['available_cabins'] }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card stats-card bg-gradient-danger text-white">
                    <div class="card-body text-center">
                        <h6 class="text-uppercase text-white-50">Reserved Cabins</h6>
                        <h2>{{ $statistics['reserved_cabins'] }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card stats-card bg-gradient-dark text-white">
                    <div class="card-body text-center">
                        <h6 class="text-uppercase text-white-50">Trips</h6>
                        <h2>{{ $statistics['total_trips'] }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Export Options -->
        <div class="card mt-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fa fa-download"></i> Export Reports</h5>
            </div>
            <div class="card-body">
                <p class="text-muted mb-4">Download detailed reports in Excel format for the selected date range</p>

                <div class="row">
                    <!-- Statistics Export -->
                    <div class="col-md-4 mb-3">
                        <div class="card border-success h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-chart-pie fa-3x text-success mb-3"></i>
                                <h5 class="card-title">Statistics Summary</h5>
                                <p class="card-text text-muted">Export all statistics for the selected period</p>
                                <a href="{{ route('adminPanel.reports.exportStatistics', ['date_from' => $dateFrom, 'date_to' => $dateTo]) }}"
                                   class="btn btn-success btn-block">
                                    <i class="fa fa-file-excel"></i> Export Excel
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Reservations Export -->
                    <div class="col-md-4 mb-3">
                        <div class="card border-info h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-ticket-alt fa-3x text-info mb-3"></i>
                                <h5 class="card-title">Reservations Report</h5>
                                <p class="card-text text-muted">Detailed list of all reservations</p>
                                <a href="{{ route('adminPanel.reports.exportReservations', ['date_from' => $dateFrom, 'date_to' => $dateTo]) }}"
                                   class="btn btn-info btn-block">
                                    <i class="fa fa-file-excel"></i> Export Excel
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Users/Customers Export -->
                    <div class="col-md-4 mb-3">
                        <div class="card border-warning h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-users fa-3x text-warning mb-3"></i>
                                <h5 class="card-title">Customers Report</h5>
                                <p class="card-text text-muted">Customer data with booking history</p>
                                <a href="{{ route('adminPanel.reports.exportUsers', ['date_from' => $dateFrom, 'date_to' => $dateTo]) }}"
                                   class="btn btn-warning btn-block">
                                    <i class="fa fa-file-excel"></i> Export Excel
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-info mt-3">
                    <i class="fas fa-info-circle"></i>
                    <strong>Note:</strong> Excel files will include all data for the selected date range.
                    The filename will automatically include the date range for easy identification.
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
