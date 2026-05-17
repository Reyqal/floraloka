<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Master Admin (Hanya jika belum ada)
        User::updateOrCreate(
            ['email' => 'admin@floraloka.com'],
            [
                'name' => 'Admin FloraLoka',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'no_hp' => '08123456789',
                'alamat' => 'Kantor Pusat FloraLoka, Kota Palu'
            ]
        );

        // 2. Buat Akun Customer Dummy untuk Percobaan
        User::updateOrCreate(
            ['email' => 'rekal@gmail.com'],
            [
                'name' => 'Reyqal Syawalano',
                'password' => Hash::make('password123'),
                'role' => 'customer',
                'no_hp' => '085299887766',
                'alamat' => 'Jl. Soekarno Hatta No. 40, Tondo, Kota Palu'
            ]
        );

        $this->command->info('✅ Seeder Akun Pengguna berhasil dijalankan.');

        // 3. Panggil seeder lainnya secara berurutan
        $this->call([
            KategoriSeeder::class,
            TanamanSeeder::class,
        ]);
    }
}