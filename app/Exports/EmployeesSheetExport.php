<?php

namespace App\Exports;

use App\Models\Employee;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class EmployeesSheetExport implements FromCollection, WithHeadings, WithTitle
{
    public function collection()
    {
        return Employee::with(['position'])
            ->orderBy('employee_code', 'asc')
            ->get()
            ->map(function ($employee) {
                return [
                    'employee_id' => $employee->employee_code,
                    'nama' => $employee->nama,
                    'posisi' => $employee->position->nama_jabatan ?? '-',
                    'shift' => $employee->shift,
                    'tanggal_masuk' => $employee->tanggal_masuk,
                    'status' => $employee->status,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'employee_id',
            'nama',
            'posisi',
            'shift',
            'tanggal_masuk',
            'status',
        ];
    }

    public function title(): string
    {
        return 'Employees';
    }
}