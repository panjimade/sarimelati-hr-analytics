<?php

namespace App\Imports;

use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;

class AttendanceImport implements ToCollection, WithHeadingRow
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

            Attendance::updateOrCreate(
                [
                    'employee_id' => $employee->id,
                    'tanggal' => $this->formatDate($row['tanggal']),
                ],
                [
                    'hadir' => $row['hadir'],
                    'jam_masuk' => $this->formatTime($row['jam_masuk'] ?? null),
                    'telat_menit' => $row['telat_menit'] ?? 0,
                ]
            );
        }
    }

    private function formatDate($value)
    {
        if (empty($value)) {
            return null;
        }

        if (is_numeric($value)) {
            return Date::excelToDateTimeObject($value)->format('Y-m-d');
        }

        return Carbon::parse($value)->format('Y-m-d');
    }

    private function formatTime($value)
    {
        if (empty($value)) {
            return null;
        }

        if (is_numeric($value)) {
            return Date::excelToDateTimeObject($value)->format('H:i:s');
        }

        return Carbon::parse($value)->format('H:i:s');
    }
}