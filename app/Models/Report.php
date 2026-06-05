<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'employee_id',
        'periode_awal',
        'periode_akhir',
        'jenis_laporan',
        'hasil_performa',
        'hasil_prediksi',
        'file_laporan',
        'tanggal_cetak',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}