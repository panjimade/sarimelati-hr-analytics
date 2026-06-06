<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ImportExcelController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\TurnoverPredictionController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');

    Route::resource('attendances', AttendanceController::class)->except(['show']);
    Route::resource('performances', PerformanceController::class)->except(['show']);

    Route::get('/predictions', [TurnoverPredictionController::class, 'index'])->name('predictions.index');
    Route::post('/predictions/run', [TurnoverPredictionController::class, 'runPrediction'])->name('predictions.run');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export/pdf', [ReportController::class, 'exportPdf'])->name('reports.export.pdf');
    Route::get('/reports/export/excel', [ReportController::class, 'exportExcel'])->name('reports.export.excel');

    Route::get('/import-excel', [ImportExcelController::class, 'index'])->name('import.index');
    Route::post('/import-excel', [ImportExcelController::class, 'store'])->name('import.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';