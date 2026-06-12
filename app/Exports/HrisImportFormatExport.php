<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class HrisImportFormatExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new EmployeesSheetExport(),
            new AttendanceSheetExport(),
            new PerformanceSheetExport(),
            new TurnoverSheetExport(),
        ];
    }
}