<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            $table->string('employee_code', 20)->unique();

            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->foreignId('division_id')
                  ->constrained('divisions')
                  ->cascadeOnUpdate();

            $table->foreignId('position_id')
                  ->constrained('positions')
                  ->cascadeOnUpdate();

            $table->string('nama', 100);
            $table->string('shift', 20);
            $table->date('tanggal_masuk');
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};