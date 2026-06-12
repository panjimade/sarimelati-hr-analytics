<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class TurnoverSheetExport implements FromCollection, WithHeadings, WithTitle, WithStrictNullComparison, WithColumnFormatting
{
    public function collection()
    {
        return Employee::with('turnover')
            ->orderBy('employee_code', 'asc')
            ->get()
            ->map(function ($employee) {
                return [
                    'employee_id' => $employee->employee_code,
                    'status_keluar' => $employee->turnover ? (int) $employee->turnover->status_keluar : 0,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'employee_id',
            'status_keluar',
        ];
    }

    public function title(): string
    {
        return 'Turnover';
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_NUMBER,
        ];
    }
}