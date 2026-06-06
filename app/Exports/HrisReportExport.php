<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HrisReportExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = collect($data);
    }

    public function collection()
    {
        return new Collection($this->data);
    }

    public function headings(): array
    {
        return [
            'Kode Karyawan',
            'Nama Karyawan',
            'Divisi',
            'Jabatan',
            'Shift',
            'Status',
            'Total Hadir',
            'Total Tidak Hadir',
            'Total Telat',
            'Rata-rata KPI',
            'Skor Prediksi',
            'Kategori Risiko',
            'Hasil Prediksi',
        ];
    }
}