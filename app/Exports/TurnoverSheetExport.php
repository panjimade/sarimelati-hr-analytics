<?php

namespace App\Exports;

use App\Models\Turnover;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class TurnoverSheetExport implements FromCollection, WithHeadings, WithTitle
{
    public function collection()
    {
        return Turnover::with('employee')
            ->join('employees', 'turnovers.employee_id', '=', 'employees.id')
            ->select('turnovers.*')
            ->orderBy('employees.employee_code', 'asc')
            ->get()
            ->map(function ($turnover) {
                return [
                    'employee_id' => $turnover->employee->employee_code ?? '-',
                    'status_keluar' => $turnover->status_keluar,
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
}