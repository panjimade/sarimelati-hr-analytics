<?php

namespace App\Imports;

use App\Models\Employee;
use App\Models\Division;
use App\Models\Position;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;

class EmployeesImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $division = Division::firstOrCreate(
            ['nama_divisi' => 'Operasional Outlet'],
            ['deskripsi' => 'Divisi utama operasional restoran cabang']
        );

        foreach ($rows as $row) {
            if (empty($row['employee_id'])) {
                continue;
            }

            $position = Position::firstOrCreate(
                ['nama_jabatan' => $row['posisi']],
                ['deskripsi' => 'Jabatan dari data Excel']
            );

            Employee::updateOrCreate(
                [
                    'employee_code' => $row['employee_id'],
                ],
                [
                    'division_id' => $division->id,
                    'position_id' => $position->id,
                    'nama' => $row['nama'],
                    'shift' => trim($row['shift']),
                    'tanggal_masuk' => $this->formatDate($row['tanggal_masuk']),
                    'status' => $row['status'],
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
}