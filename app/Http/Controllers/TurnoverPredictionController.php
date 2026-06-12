<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\TurnoverPrediction;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TurnoverPredictionController extends Controller
{
    public function index(Request $request)
    {
        $allowedSorts = [
            'tanggal' => 'turnover_predictions.tanggal_prediksi',
            'kode' => 'employees.employee_code',
            'nama' => 'employees.nama',
            'jabatan' => 'positions.nama_jabatan',
            'rata_rata_kpi' => 'turnover_predictions.rata_rata_kpi',
            'jumlah_tidak_hadir' => 'turnover_predictions.jumlah_tidak_hadir',
            'total_telat' => 'turnover_predictions.total_telat',
            'skor_prediksi' => 'turnover_predictions.skor_prediksi',
        ];

        $sort = $request->get('sort', 'skor_prediksi');
        $direction = $request->get('direction', 'desc');

        if (!array_key_exists($sort, $allowedSorts)) {
            $sort = 'skor_prediksi';
        }

        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'desc';
        }

        $predictions = TurnoverPrediction::with('employee.position')
            ->join('employees', 'turnover_predictions.employee_id', '=', 'employees.id')
            ->join('positions', 'employees.position_id', '=', 'positions.id')
            ->select('turnover_predictions.*')
            ->orderBy($allowedSorts[$sort], $direction)
            ->paginate(10)
            ->withQueryString();

        $totalPredictions = TurnoverPrediction::count();
        $highRisk = TurnoverPrediction::where('kategori_risiko', 'Tinggi')->count();
        $mediumRisk = TurnoverPrediction::where('kategori_risiko', 'Sedang')->count();
        $lowRisk = TurnoverPrediction::where('kategori_risiko', 'Rendah')->count();

        return view('predictions.index', compact(
            'predictions',
            'totalPredictions',
            'highRisk',
            'mediumRisk',
            'lowRisk',
            'sort',
            'direction'
        ));
    }

    public function runPrediction()
    {
        $employees = Employee::with(['attendances', 'performances', 'turnover'])
            ->orderBy('employee_code')
            ->get();

        if ($employees->isEmpty()) {
            return redirect()
                ->route('predictions.index')
                ->with('error', 'Data karyawan masih kosong. Silakan import Excel terlebih dahulu.');
        }

        $payloadEmployees = $employees->map(function ($employee) {
            $rataRataKpi = round((float) $employee->performances->avg('total_score'), 2);
            $jumlahTidakHadir = $employee->attendances->where('hadir', 'Tidak')->count();
            $jumlahHariHadir = $employee->attendances->where('hadir', 'Ya')->count();
            $totalTelat = (int) $employee->attendances->sum('telat_menit');
            $rataRataTelat = round((float) $employee->attendances->avg('telat_menit'), 2);

            return [
                'employee_id' => $employee->id,
                'employee_code' => $employee->employee_code,
                'nama' => $employee->nama,
                'rata_rata_kpi' => $rataRataKpi,
                'jumlah_tidak_hadir' => $jumlahTidakHadir,
                'total_telat' => $totalTelat,
                'rata_rata_telat' => $rataRataTelat,
                'jumlah_hari_hadir' => $jumlahHariHadir,
                'status_keluar' => optional($employee->turnover)->status_keluar ? 1 : 0,
            ];
        })->values()->toArray();

        try {
            $response = Http::timeout(60)->post('http://127.0.0.1:5000/predict-turnover', [
                'employees' => $payloadEmployees
            ]);

            if ($response->failed()) {
                return redirect()
                    ->route('predictions.index')
                    ->with('error', 'Python API gagal memproses prediksi: ' . $response->body());
            }

            $result = $response->json();

            if (($result['status'] ?? null) !== 'success') {
                return redirect()
                    ->route('predictions.index')
                    ->with('error', 'Prediksi gagal: ' . ($result['message'] ?? 'Terjadi kesalahan.'));
            }

            DB::transaction(function () use ($result) {
                foreach ($result['predictions'] as $prediction) {
                    TurnoverPrediction::updateOrCreate(
                        [
                            'employee_id' => $prediction['employee_id'],
                            'tanggal_prediksi' => now()->toDateString(),
                        ],
                        [
                            'rata_rata_kpi' => $prediction['rata_rata_kpi'],
                            'jumlah_tidak_hadir' => $prediction['jumlah_tidak_hadir'],
                            'total_telat' => $prediction['total_telat'],
                            'rata_rata_telat' => $prediction['rata_rata_telat'],
                            'skor_prediksi' => $prediction['skor_prediksi'],
                            'kategori_risiko' => $prediction['kategori_risiko'],
                            'hasil_prediksi' => $prediction['hasil_prediksi'],
                        ]
                    );
                }
            });

            return redirect()
                ->route('predictions.index')
                ->with(
                    'success',
                    'Prediksi turnover berhasil dijalankan. Model: ' .
                    ($result['model'] ?? 'Random Forest') .
                    ', akurasi training: ' .
                    ($result['training_accuracy'] ?? '-') .
                    '%'
                );
        } catch (\Exception $e) {
            return redirect()
                ->route('predictions.index')
                ->with('error', 'Tidak dapat terhubung ke Python API. Pastikan python-service sedang berjalan. Detail: ' . $e->getMessage());
        }
    }
}