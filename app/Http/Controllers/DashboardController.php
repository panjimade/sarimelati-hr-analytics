<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Performance;
use App\Models\TurnoverPrediction;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEmployees = Employee::count();

        $attendanceSummary = Attendance::select('hadir', DB::raw('COUNT(*) as total'))
            ->groupBy('hadir')
            ->pluck('total', 'hadir');

        $totalHadir = $attendanceSummary['Ya'] ?? 0;
        $totalTidakHadir = $attendanceSummary['Tidak'] ?? 0;

        $highRiskEmployees = TurnoverPrediction::where('kategori_risiko', 'Tinggi')->count();

        $rankingPerformance = Employee::select(
                'employees.id',
                'employees.employee_code',
                'employees.nama',
                'positions.nama_jabatan',
                DB::raw('AVG(performances.total_score) as rata_rata_kpi')
            )
            ->join('positions', 'employees.position_id', '=', 'positions.id')
            ->join('performances', 'employees.id', '=', 'performances.employee_id')
            ->groupBy(
                'employees.id',
                'employees.employee_code',
                'employees.nama',
                'positions.nama_jabatan'
            )
            ->orderByDesc('rata_rata_kpi')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalEmployees',
            'totalHadir',
            'totalTidakHadir',
            'highRiskEmployees',
            'rankingPerformance'
        ));
    }
}