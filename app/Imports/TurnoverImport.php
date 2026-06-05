<?php

namespace App\Imports;

use App\Models\Employee;
use App\Models\Turnover;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TurnoverImport implements ToCollection, WithHeadingRow
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

            Turnover::updateOrCreate(
                [
                    'employee_id' => $employee->id,
                ],
                [
                    'status_keluar' => $row['status_keluar'],
                ]
            );
        }
    }
}