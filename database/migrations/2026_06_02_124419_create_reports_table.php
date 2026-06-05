<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_id')
                  ->constrained('employees')
                  ->cascadeOnDelete();

            $table->date('periode_awal');
            $table->date('periode_akhir');

            $table->enum('jenis_laporan', [
                'Absensi',
                'KPI',
                'Prediksi Turnover',
                'Gabungan'
            ]);

            $table->string('hasil_performa', 100)->nullable();
            $table->string('hasil_prediksi', 100)->nullable();
            $table->string('file_laporan', 255)->nullable();
            $table->date('tanggal_cetak');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};