<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $allowedSorts = [
            'tanggal' => 'attendances.tanggal',
            'kode' => 'employees.employee_code',
            'nama' => 'employees.nama',
            'hadir' => 'attendances.hadir',
            'jam_masuk' => 'attendances.jam_masuk',
            'telat_menit' => 'attendances.telat_menit',
        ];

        $sort = $request->get('sort', 'tanggal');
        $direction = $request->get('direction', 'desc');

        if (!array_key_exists($sort, $allowedSorts)) {
            $sort = 'tanggal';
        }

        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'desc';
        }

        $attendances = Attendance::with('employee')
            ->join('employees', 'attendances.employee_id', '=', 'employees.id')
            ->select('attendances.*')
            ->orderBy($allowedSorts[$sort], $direction)
            ->paginate(10)
            ->withQueryString();

        return view('attendances.index', compact('attendances', 'sort', 'direction'));
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