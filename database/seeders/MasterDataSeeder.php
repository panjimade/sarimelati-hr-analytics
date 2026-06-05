<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Division;
use App\Models\Position;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        Division::updateOrCreate(
            ['nama_divisi' => 'Operasional Outlet'],
            [
                'deskripsi' => 'Divisi utama untuk operasional restoran cabang.',
            ]
        );

        $positions = [
            'Crew FOH' => 'Karyawan bagian front of house atau pelayanan pelanggan.',
            'Crew BOH' => 'Karyawan bagian back of house atau operasional dapur.',
            'Cashier' => 'Karyawan bagian kasir dan transaksi pelanggan.',
            'Shift Leader' => 'Penanggung jawab operasional pada shift kerja.',
        ];

        foreach ($positions as $nama => $deskripsi) {
            Position::updateOrCreate(
                ['nama_jabatan' => $nama],
                ['deskripsi' => $deskripsi]
            );
        }
    }
}