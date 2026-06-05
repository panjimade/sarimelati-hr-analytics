<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('performances', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_id')
                  ->constrained('employees')
                  ->cascadeOnDelete();

            $table->string('bulan', 20);
            $table->integer('disiplin');
            $table->integer('teamwork');
            $table->integer('kecepatan_kerja');
            $table->decimal('total_score', 5, 2);

            $table->timestamps();

            $table->unique(['employee_id', 'bulan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('performances');
    }
};