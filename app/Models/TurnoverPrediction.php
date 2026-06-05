<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TurnoverPrediction extends Model
{
    protected $fillable = [
        'employee_id',
        'rata_rata_kpi',
        'jumlah_tidak_hadir',
        'total_telat',
        'rata_rata_telat',
        'skor_prediksi',
        'kategori_risiko',
        'hasil_prediksi',
        'tanggal_prediksi',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}