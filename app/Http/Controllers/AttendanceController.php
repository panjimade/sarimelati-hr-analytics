<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('employee')
            ->orderByDesc('tanggal')
            ->paginate(10);

        return view('attendances.index', compact('attendances'));
    }

    public function create()
    {
        $employees = Employee::orderBy('employee_code')->get();

        return view('attendances.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'tanggal' => 'required|date',
            'hadir' => 'required|in:Ya,Tidak',
            'jam_masuk' => 'nullable',
            'telat_menit' => 'nullable|integer|min:0',
        ]);

        Attendance::updateOrCreate(
            [
                'employee_id' => $request->employee_id,
                'tanggal' => $request->tanggal,
            ],
            [
                'hadir' => $request->hadir,
                'jam_masuk' => $request->jam_masuk,
                'telat_menit' => $request->telat_menit ?? 0,
            ]
        );

        return redirect()
            ->route('attendances.index')
            ->with('success', 'Data absensi berhasil disimpan.');
    }

    public function edit(Attendance $attendance)
    {
        $employees = Employee::orderBy('employee_code')->get();

        return view('attendances.edit', compact('attendance', 'employees'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'tanggal' => 'required|date',
            'hadir' => 'required|in:Ya,Tidak',
            'jam_masuk' => 'nullable',
            'telat_menit' => 'nullable|integer|min:0',
        ]);

        $attendance->update([
            'employee_id' => $request->employee_id,
            'tanggal' => $request->tanggal,
            'hadir' => $request->hadir,
            'jam_masuk' => $request->jam_masuk,
            'telat_menit' => $request->telat_menit ?? 0,
        ]);

        return redirect()
            ->route('attendances.index')
            ->with('success', 'Data absensi berhasil diperbarui.');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()
            ->route('attendances.index')
            ->with('success', 'Data absensi berhasil dihapus.');
    }
}