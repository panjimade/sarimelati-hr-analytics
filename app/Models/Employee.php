<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'employee_code',
        'user_id',
        'division_id',
        'position_id',
        'nama',
        'shift',
        'tanggal_masuk',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function performances()
    {
        return $this->hasMany(Performance::class);
    }

    public function turnover()
    {
        return $this->hasOne(Turnover::class);
    }

    public function turnoverPredictions()
    {
        return $this->hasMany(TurnoverPrediction::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}