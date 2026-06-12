<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $allowedSorts = [
            'kode' => 'employees.employee_code',
            'nama' => 'employees.nama',
            'divisi' => 'divisions.nama_divisi',
            'jabatan' => 'positions.nama_jabatan',
            'shift' => 'employees.shift',
            'tanggal_masuk' => 'employees.tanggal_masuk',
            'status' => 'employees.status',
        ];

        $sort = $request->get('sort', 'kode');
        $direction = $request->get('direction', 'asc');

        if (!array_key_exists($sort, $allowedSorts)) {
            $sort = 'kode';
        }

        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'asc';
        }

        $employees = Employee::with(['division', 'position'])
            ->join('divisions', 'employees.division_id', '=', 'divisions.id')
            ->join('positions', 'employees.position_id', '=', 'positions.id')
            ->select('employees.*')
            ->orderBy($allowedSorts[$sort], $direction)
            ->paginate(10)
            ->withQueryString();

        return view('employees.index', compact('employees', 'sort', 'direction'));
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