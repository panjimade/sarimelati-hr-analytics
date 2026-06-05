<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    protected $fillable = [
        'employee_id',
        'bulan',
        'disiplin',
        'teamwork',
        'kecepatan_kerja',
        'total_score',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}