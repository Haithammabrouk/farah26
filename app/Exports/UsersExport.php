<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Reservation;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromQuery, WithHeadings, WithMapping, WithStyles, WithTitle
{
    protected $dateFrom;
    protected $dateTo;

    public function __construct($dateFrom = null, $dateTo = null)
    {
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
    }

    public function query()
    {
        $query = User::query()
            ->with(['country', 'reservation'])
            ->latest();

        if ($this->dateFrom && $this->dateTo) {
            $query->whereHas('reservation', function($q) {
                $q->whereBetween('created_at', [$this->dateFrom, $this->dateTo]);
            });
        }

        return $query;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'First Name',
            'Last Name',
            'Email',
            'Mobile',
            'Country',
            'Total Bookings',
            'Total Spent',
            'Last Booking Date',
            'Registered At',
        ];
    }

    public function map($user): array
    {
        $totalBookings = $user->reservation()->where('status', 1)->count();
        $totalSpent = $user->reservation()->where('status', 1)->sum('price');
        $lastBooking = $user->reservation()->where('status', 1)->latest()->first();

        return [
            $user->id,
            $user->title ?? 'N/A',
            $user->first_name,
            $user->last_name,
            $user->email,
            $user->mobile,
            $user->country->name ?? 'N/A',
            $totalBookings,
            '$' . number_format($totalSpent, 2),
            $lastBooking ? $lastBooking->created_at->format('Y-m-d') : 'N/A',
            $user->created_at->format('Y-m-d H:i:s'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function title(): string
    {
        return 'Customers';
    }
}
