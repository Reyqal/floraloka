<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Master Admin
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

        // 2. Buat Akun costumer untuk Percobaan
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

        // 3. Memanggil seeder lainnya secara berurutan
        $this->call([
            KategoriSeeder::class,
            TanamanSeeder::class,
        ]);
    }
}