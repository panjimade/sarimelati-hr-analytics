<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Exports\HrisReportExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function exportPdf(Request $request)
    {
        $data = $this->buildReportData($request);
        $periodeAwal = $request->periode_awal;
        $periodeAkhir = $request->periode_akhir;

        $pdf = Pdf::loadView('reports.pdf', [
            'data' => $data,
            'periodeAwal' => $periodeAwal,
            'periodeAkhir' => $periodeAkhir,
        ])->setPaper('a4', 'landscape');

        return $pdf->download('laporan-hris-sarimelati.pdf');
    }

    public function exportExcel(Request $request)
    {
        $data = $this->buildReportData($request);

        return Excel::download(
            new HrisReportExport($data),
            'laporan-hris-sarimelati.xlsx'
        );
    }

    private function buildReportData(Request $request)
    {
        $periodeAwal = $request->periode_awal;
        $periodeAkhir = $request->periode_akhir;

        $employees = Employee::with([
            'division',
            'position',
            'performances',
            'turnoverPredictions' => function ($query) {
                $query->orderByDesc('tanggal_prediksi');
            },
            'attendances' => function ($query) use ($periodeAwal, $periodeAkhir) {
                if ($periodeAwal && $periodeAkhir) {
                    $query->whereBetween('tanggal', [$periodeAwal, $periodeAkhir]);
                }
            }
        ])
        ->orderBy('employee_code')
        ->get();

        return $employees->map(function ($employee) {
            $latestPrediction = $employee->turnoverPredictions->first();

            return [
                'kode' => $employee->employee_code,
                'nama' => $employee->nama,
                'divisi' => $employee->division->nama_divisi ?? '-',
                'jabatan' => $employee->position->nama_jabatan ?? '-',
                'shift' => $employee->shift,
                'status' => $employee->status,

                'total_hadir' => $employee->attendances->where('hadir', 'Ya')->count(),
                'total_tidak_hadir' => $employee->attendances->where('hadir', 'Tidak')->count(),
                'total_telat' => $employee->attendances->sum('telat_menit'),

                'rata_rata_kpi' => round((float) $employee->performances->avg('total_score'), 2),

                'skor_prediksi' => $latestPrediction
                    ? $latestPrediction->skor_prediksi . '%'
                    : '-',

                'kategori_risiko' => $latestPrediction->kategori_risiko ?? '-',
                'hasil_prediksi' => $latestPrediction->hasil_prediksi ?? '-',
            ];
        });
    }
}