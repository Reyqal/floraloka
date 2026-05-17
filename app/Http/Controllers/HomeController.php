<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Mengembalikan view halaman utama (welcome)
    public function beranda()
    {
        return view('welcome');
    }

    // Mengembalikan view halaman tentang kami (about)
    public function tentangKami()
    {
        return view('about');
    }
}