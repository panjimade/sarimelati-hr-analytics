<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@sarimelati.com'],
            [
                'name' => 'Admin Sistem',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'supervisor@sarimelati.com'],
            [
                'name' => 'Supervisor Outlet',
                'password' => Hash::make('password123'),
                'role' => 'supervisor',
            ]
        );

        User::updateOrCreate(
            ['email' => 'hrd@sarimelati.com'],
            [
                'name' => 'HRD Manager',
                'password' => Hash::make('password123'),
                'role' => 'hrd_manager',
            ]
        );
    }
}