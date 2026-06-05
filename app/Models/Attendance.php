<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'employee_id',
        'tanggal',
        'hadir',
        'jam_masuk',
        'telat_menit',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}