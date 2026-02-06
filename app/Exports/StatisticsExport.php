<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StatisticsExport implements FromArray, WithHeadings, WithStyles, WithTitle
{
    protected $statistics;
    protected $dateFrom;
    protected $dateTo;

    public function __construct($statistics, $dateFrom, $dateTo)
    {
        $this->statistics = $statistics;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
    }

    public function array(): array
    {
        return [
            ['Report Period', \Carbon\Carbon::parse($this->dateFrom)->format('M d, Y') . ' to ' . \Carbon\Carbon::parse($this->dateTo)->format('M d, Y')],
            ['', ''],
            ['Metric', 'Value'],
            ['Total Bookings', $this->statistics['total_bookings']],
            ['Total Revenue', '$' . $this->statistics['total_revenue']],
            ['Total Trips', $this->statistics['total_trips']],
            ['Total Customers', $this->statistics['total_customers']],
            ['Total Cabins', $this->statistics['total_cabins']],
            ['Available Cabins', $this->statistics['available_cabins']],
            ['Reserved Cabins', $this->statistics['reserved_cabins']],
        ];
    }

    public function headings(): array
    {
        return [];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 14]],
            3 => ['font' => ['bold' => true]],
        ];
    }

    public function title(): string
    {
        return 'Statistics Summary';
    }
}
