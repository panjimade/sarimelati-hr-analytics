<?php

namespace App\Exports;

use App\Models\Performance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class PerformanceSheetExport implements FromCollection, WithHeadings, WithTitle
{
    public function collection()
    {
        return Performance::with('employee')
            ->join('employees', 'performances.employee_id', '=', 'employees.id')
            ->select('performances.*')
            ->orderBy('employees.employee_code', 'asc')
            ->get()
            ->map(function ($performance) {
                return [
                    'id' => $performance->id,
                    'employee_id' => $performance->employee->employee_code ?? '-',
                    'bulan' => $performance->bulan,
                    'disiplin' => $performance->disiplin,
                    'teamwork' => $performance->teamwork,
                    'kecepatan_kerja' => $performance->kecepatan_kerja,
                    'total_score' => $performance->total_score,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'id',
            'employee_id',
            'bulan',
            'disiplin',
            'teamwork',
            'kecepatan_kerja',
            'total_score',
        ];
    }

    public function title(): string
    {
        return 'Performance';
    }
}