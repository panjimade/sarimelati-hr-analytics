<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turnover extends Model
{
    protected $fillable = [
        'employee_id',
        'status_keluar',
    ];

    protected $casts = [
        'status_keluar' => 'boolean',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}