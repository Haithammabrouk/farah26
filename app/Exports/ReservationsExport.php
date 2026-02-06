<?php

namespace App\Exports;

use App\Models\Reservation;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReservationsExport implements FromQuery, WithHeadings, WithMapping, WithStyles, WithTitle
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
        $query = Reservation::query()
            ->with(['user', 'trip.tripCategory'])
            ->latest();

        if ($this->dateFrom && $this->dateTo) {
            $query->whereBetween('created_at', [$this->dateFrom, $this->dateTo]);
        }

        return $query;
    }

    public function headings(): array
    {
        return [
            'ID',
            'UUID',
            'Trip Category',
            'Customer Name',
            'Email',
            'Mobile',
            'Price',
            'Status',
            'Check-in Date',
            'Check-out Date',
            'IP Address',
            'Created At',
        ];
    }

    public function map($reservation): array
    {
        $status = 'Pending';
        if ($reservation->status === 1) {
            $status = 'Success';
        } elseif ($reservation->status === 0) {
            $status = 'Failed';
        }

        return [
            $reservation->id,
            $reservation->uuid,
            $reservation->trip->tripCategory->name ?? 'N/A',
            $reservation->user->first_name . ' ' . $reservation->user->last_name,
            $reservation->user->email,
            $reservation->user->mobile,
            '$' . number_format($reservation->price, 2),
            $status,
            $reservation->trip->check_in ?? 'N/A',
            $reservation->trip->check_out ?? 'N/A',
            $reservation->ip_address,
            $reservation->created_at->format('Y-m-d H:i:s'),
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
        return 'Reservations';
    }
}
