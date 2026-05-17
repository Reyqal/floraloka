<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        Kategori::updateOrCreate(['id' => 1], ['nama_kategori' => 'Indoor']);
        Kategori::updateOrCreate(['id' => 2], ['nama_kategori' => 'Outdoor']);
    }
}