<?php

namespace Database\Seeders;

use App\Models\Tanaman;
use Illuminate\Database\Seeder;

class TanamanSeeder extends Seeder
{
    public function run(): void
    {

        Tanaman::updateOrCreate(
            ['nama_tanaman' => 'Monstera Deliciosa'],
            [
                'kategori_id' => 1,
                'harga' => 150000,
                'stok' => 15,
                'gambar' => 'https://images.unsplash.com/photo-1614594975525-e45190c55d0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'deskripsi' => 'Tanaman hias ikonik dengan daun berlubang alami yang cantik. Cocok untuk ruangan minimalis.',
            ]
        );

        Tanaman::updateOrCreate(
            ['nama_tanaman' => 'Kaktus Koboi'],
            [
                'kategori_id' => 2,
                'harga' => 85000,
                'stok' => 20,
                'gambar' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'deskripsi' => 'Kaktus minimalis yang tumbuh tegak lurus. Sangat mudah dirawat dan hemat air.',
            ]
        );

    }
}