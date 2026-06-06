<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ImportExcelController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\TurnoverPredictionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');

    Route::resource('attendances', AttendanceController::class)
        ->except(['show'])
        ->middleware('role:admin,supervisor');

    Route::resource('performances', PerformanceController::class)
        ->except(['show'])
        ->middleware('role:admin,supervisor');

    Route::get('/predictions', [TurnoverPredictionController::class, 'index'])
        ->name('predictions.index')
        ->middleware('role:admin,hrd_manager');

    Route::post('/predictions/run', [TurnoverPredictionController::class, 'runPrediction'])
        ->name('predictions.run')
        ->middleware('role:admin,hrd_manager');

    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index')
        ->middleware('role:admin,hrd_manager');

    Route::get('/reports/export/pdf', [ReportController::class, 'exportPdf'])
        ->name('reports.export.pdf')
        ->middleware('role:admin,hrd_manager');

    Route::get('/reports/export/excel', [ReportController::class, 'exportExcel'])
        ->name('reports.export.excel')
        ->middleware('role:admin,hrd_manager');

    Route::resource('users', UserController::class)
        ->except(['show'])
        ->middleware('role:admin');

    Route::get('/import-excel', [ImportExcelController::class, 'index'])
        ->name('import.index')
        ->middleware('role:admin');

    Route::post('/import-excel', [ImportExcelController::class, 'store'])
        ->name('import.store')
        ->middleware('role:admin');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';