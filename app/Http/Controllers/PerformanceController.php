<?php

namespace App\Http\Controllers;

use App\Models\Performance;
use App\Models\Employee;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    public function index()
    {
        $performances = Performance::with('employee')
            ->orderByDesc('bulan')
            ->paginate(10);

        return view('performances.index', compact('performances'));
    }

    public function create()
    {
        $employees = Employee::orderBy('employee_code')->get();

        return view('performances.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'bulan' => 'required|string|max:20',
            'disiplin' => 'required|integer|min:0|max:100',
            'teamwork' => 'required|integer|min:0|max:100',
            'kecepatan_kerja' => 'required|integer|min:0|max:100',
        ]);

        $totalScore = round(
            ($request->disiplin + $request->teamwork + $request->kecepatan_kerja) / 3,
            2
        );

        Performance::updateOrCreate(
            [
                'employee_id' => $request->employee_id,
                'bulan' => $request->bulan,
            ],
            [
                'disiplin' => $request->disiplin,
                'teamwork' => $request->teamwork,
                'kecepatan_kerja' => $request->kecepatan_kerja,
                'total_score' => $totalScore,
            ]
        );

        return redirect()
            ->route('performances.index')
            ->with('success', 'Data KPI berhasil disimpan.');
    }

    public function edit(Performance $performance)
    {
        $employees = Employee::orderBy('employee_code')->get();

        return view('performances.edit', compact('performance', 'employees'));
    }

    public function update(Request $request, Performance $performance)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'bulan' => 'required|string|max:20',
            'disiplin' => 'required|integer|min:0|max:100',
            'teamwork' => 'required|integer|min:0|max:100',
            'kecepatan_kerja' => 'required|integer|min:0|max:100',
        ]);

        $totalScore = round(
            ($request->disiplin + $request->teamwork + $request->kecepatan_kerja) / 3,
            2
        );

        $performance->update([
            'employee_id' => $request->employee_id,
            'bulan' => $request->bulan,
            'disiplin' => $request->disiplin,
            'teamwork' => $request->teamwork,
            'kecepatan_kerja' => $request->kecepatan_kerja,
            'total_score' => $totalScore,
        ]);

        return redirect()
            ->route('performances.index')
            ->with('success', 'Data KPI berhasil diperbarui.');
    }

    public function destroy(Performance $performance)
    {
        $performance->delete();

        return redirect()
            ->route('performances.index')
            ->with('success', 'Data KPI berhasil dihapus.');
    }
}