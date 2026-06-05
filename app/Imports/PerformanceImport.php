<?php

namespace App\Imports;

use App\Models\Employee;
use App\Models\Performance;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PerformanceImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if (empty($row['employee_id'])) {
                continue;
            }

            $employee = Employee::where('employee_code', $row['employee_id'])->first();

            if (!$employee) {
                continue;
            }

            Performance::updateOrCreate(
                [
                    'employee_id' => $employee->id,
                    'bulan' => $row['bulan'],
                ],
                [
                    'disiplin' => $row['disiplin'],
                    'teamwork' => $row['teamwork'],
                    'kecepatan_kerja' => $row['kecepatan_kerja'],
                    'total_score' => $row['total_score'],
                ]
            );
        }
    }
}