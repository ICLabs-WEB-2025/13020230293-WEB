<?php
// File: database/seeders/AdminUserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash; // Pastikan ini di-import

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'], // Email unik untuk admin
            [
                'name' => 'Admin Aplikasi', // Nama Admin
                'password' => Hash::make('123!'), // GANTI DENGAN PASSWORD YANG AMAN & KUAT
                'role' => 'admin', // Tetapkan peran sebagai admin [cite: 117]
                'email_verified_at' => now(), // Verifikasi email langsung
            ]
        );
    }
}
