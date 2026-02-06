<?php

namespace App\Services;

use App\Models\Reservation;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class DashboardService
{
    /**
     * Get dashboard statistics with optional date filtering
     *
     * @param string|null $dateFrom
     * @param string|null $dateTo
     * @return array
     */
    public function getStatistics($dateFrom = null, $dateTo = null)
    {
        $query = Reservation::query();

        if ($dateFrom && $dateTo) {
            $query->whereBetween('created_at', [$dateFrom, $dateTo]);
        }

        // Total bookings (success only)
        $totalBookings = (clone $query)->where('status', 1)->count();

        // Total revenue (success only)
        $totalRevenue = (clone $query)->where('status', 1)->sum('price');

        // Customers count (distinct users with successful bookings)
        $totalCustomers = (clone $query)
            ->where('status', 1)
            ->distinct('user_id')
            ->count('user_id');

        // Trips in date range
        $tripsQuery = Trip::query();
        if ($dateFrom && $dateTo) {
            $tripsQuery->whereBetween('check_in', [$dateFrom, $dateTo]);
        }
        $totalTrips = $tripsQuery->count();

        // Cabin statistics (current state, not date-filtered)
        $cabinStats = Trip::selectRaw('
            SUM(cabin_count + suite_count) as total_cabins,
            SUM(cabin_available) as available_cabins,
            SUM(suite_available) as available_suites,
            SUM(cabin_count + suite_count - cabin_available - suite_available) as reserved_cabins
        ')->first();

        return [
            'total_bookings' => $totalBookings,
            'total_revenue' => number_format($totalRevenue, 2),
            'total_trips' => $totalTrips,
            'total_customers' => $totalCustomers,
            'total_cabins' => $cabinStats->total_cabins ?? 0,
            'available_cabins' => ($cabinStats->available_cabins ?? 0) + ($cabinStats->available_suites ?? 0),
            'reserved_cabins' => $cabinStats->reserved_cabins ?? 0,
        ];
    }

    /**
     * Get recent bookings for dashboard widget
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRecentBookings($limit = 5)
    {
        return Reservation::with(['user', 'trip.tripCategory'])
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * Get monthly revenue data for chart
     *
     * @param int $months
     * @return \Illuminate\Support\Collection
     */
    public function getMonthlyRevenue($months = 6)
    {
        return Reservation::where('status', 1)
            ->selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, SUM(price) as revenue')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->limit($months)
            ->get()
            ->reverse();
    }
}
