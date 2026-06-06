<?php

namespace App\Http\Controllers;

use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['division', 'position'])
            ->orderBy('employee_code')
            ->paginate(10);

        return view('employees.index', compact('employees'));
    }

    public function show(Employee $employee)
    {
        $employee->load([
            'division',
            'position',
            'attendances' => function ($query) {
                $query->orderByDesc('tanggal')->limit(10);
            },
            'performances' => function ($query) {
                $query->orderByDesc('bulan');
            },
            'turnoverPredictions' => function ($query) {
                $query->orderByDesc('tanggal_prediksi');
            }
        ]);

        $totalHadir = $employee->attendances()->where('hadir', 'Ya')->count();
        $totalTidakHadir = $employee->attendances()->where('hadir', 'Tidak')->count();
        $totalTelat = $employee->attendances()->sum('telat_menit');
        $rataRataKpi = round((float) $employee->performances()->avg('total_score'), 2);
        $latestPrediction = $employee->turnoverPredictions()->orderByDesc('tanggal_prediksi')->first();

        return view('employees.show', compact(
            'employee',
            'totalHadir',
            'totalTidakHadir',
            'totalTelat',
            'rataRataKpi',
            'latestPrediction'
        ));
    }
}