<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class AttendanceSheetExport implements FromCollection, WithHeadings, WithTitle
{
    public function collection()
    {
        return Attendance::with('employee')
            ->orderBy('tanggal', 'asc')
            ->get()
            ->map(function ($attendance) {
                return [
                    'id' => $attendance->id,
                    'employee_id' => $attendance->employee->employee_code ?? '-',
                    'tanggal' => $attendance->tanggal,
                    'hadir' => $attendance->hadir,
                    'jam_masuk' => $attendance->jam_masuk,
                    'telat_menit' => $attendance->telat_menit,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'id',
            'employee_id',
            'tanggal',
            'hadir',
            'jam_masuk',
            'telat_menit',
        ];
    }

    public function title(): string
    {
        return 'Attendance';
    }
}