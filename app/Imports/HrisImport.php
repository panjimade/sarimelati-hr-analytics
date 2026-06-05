<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class HrisImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Employees' => new EmployeesImport(),
            'Attendance' => new AttendanceImport(),
            'Performance' => new PerformanceImport(),
            'Turnover' => new TurnoverImport(),
        ];
    }
}