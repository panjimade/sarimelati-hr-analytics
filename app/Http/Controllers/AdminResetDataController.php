<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AdminResetDataController extends Controller
{
    public function index()
    {
        return view('admin.reset-data');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'confirmation' => ['required', 'string', 'in:RESET DATA HRIS'],
            'current_password' => ['required', 'string'],
        ], [
            'confirmation.in' => 'Konfirmasi harus diketik persis: RESET DATA HRIS',
            'current_password.required' => 'Password admin wajib diisi.',
        ]);

        if (!Hash::check($request->current_password, $request->user()->password)) {
            return back()->withErrors([
                'current_password' => 'Password admin tidak sesuai.',
            ]);
        }

        $tables = [
            'turnover_predictions',
            'turnovers',
            'performances',
            'attendances',
            'reports',
            'employees',
        ];

        try {
            Schema::disableForeignKeyConstraints();

            foreach ($tables as $table) {
                if (Schema::hasTable($table)) {
                    DB::table($table)->truncate();
                }
            }

            Schema::enableForeignKeyConstraints();

            return redirect()
                ->route('admin.reset-data.index')
                ->with('success', 'Data HRIS berhasil dikosongkan. Data user, divisi, dan jabatan tetap aman.');
        } catch (\Throwable $e) {
            Schema::enableForeignKeyConstraints();

            return back()->withErrors([
                'error' => 'Gagal mengosongkan data: ' . $e->getMessage(),
            ]);
        }
    }
}