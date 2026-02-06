<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function dashboard(Request $request)
    {
        $statistics = $this->dashboardService->getStatistics();
        $recentBookings = $this->dashboardService->getRecentBookings();
        $monthlyRevenue = $this->dashboardService->getMonthlyRevenue();

        return view('adminPanel.home', compact('statistics', 'recentBookings', 'monthlyRevenue'));
    }
}
