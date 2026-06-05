<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('turnover_predictions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_id')
                  ->constrained('employees')
                  ->cascadeOnDelete();

            $table->decimal('rata_rata_kpi', 5, 2)->default(0);
            $table->integer('jumlah_tidak_hadir')->default(0);
            $table->integer('total_telat')->default(0);
            $table->decimal('rata_rata_telat', 5, 2)->default(0);

            $table->decimal('skor_prediksi', 5, 2)->default(0);
            $table->enum('kategori_risiko', ['Rendah', 'Sedang', 'Tinggi']);
            $table->enum('hasil_prediksi', ['Bertahan', 'Berisiko Resign']);

            $table->date('tanggal_prediksi');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('turnover_predictions');
    }
};