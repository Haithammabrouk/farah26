<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use App\Exports\ReservationsExport;
use App\Exports\UsersExport;
use App\Exports\StatisticsExport;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index(Request $request)
    {
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        // Validate dates
        $request->validate([
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date|after_or_equal:date_from',
        ]);

        // Default to last 30 days if not specified
        if (!$dateFrom || !$dateTo) {
            $dateTo = Carbon::now()->format('Y-m-d');
            $dateFrom = Carbon::now()->subDays(30)->format('Y-m-d');
        }

        $statistics = $this->dashboardService->getStatistics($dateFrom, $dateTo);

        return view('adminPanel.reports.index', compact('statistics', 'dateFrom', 'dateTo'));
    }

    public function exportStatistics(Request $request)
    {
        $dateFrom = $request->input('date_from', Carbon::now()->subDays(30)->format('Y-m-d'));
        $dateTo = $request->input('date_to', Carbon::now()->format('Y-m-d'));

        $statistics = $this->dashboardService->getStatistics($dateFrom, $dateTo);

        $filename = 'statistics_' . Carbon::parse($dateFrom)->format('Ymd') . '_to_' . Carbon::parse($dateTo)->format('Ymd') . '.xlsx';

        return Excel::download(new StatisticsExport($statistics, $dateFrom, $dateTo), $filename);
    }

    public function exportReservations(Request $request)
    {
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        $filename = 'reservations_' . Carbon::now()->format('Ymd_His') . '.xlsx';

        return Excel::download(new ReservationsExport($dateFrom, $dateTo), $filename);
    }

    public function exportUsers(Request $request)
    {
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        $filename = 'customers_' . Carbon::now()->format('Ymd_His') . '.xlsx';

        return Excel::download(new UsersExport($dateFrom, $dateTo), $filename);
    }
}
