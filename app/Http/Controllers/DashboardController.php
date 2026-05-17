<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Tanaman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Total Pendapatan (Hanya dari pesanan yang sudah 'selesai')
        $totalPendapatan = Pesanan::where('status', 'selesai')->sum('total_harga');
        
        // 2. Pesanan yang Butuh Perhatian (Pending / Menunggu Verifikasi)
        $pesananPending = Pesanan::where('status', 'menunggu_verifikasi')->count();
        
        // 3. Total Tanaman di Katalog
        $totalTanaman = Tanaman::count();
        
        // 4. Ambil 5 pesanan paling baru masuk beserta data user-nya
        $pesananTerbaru = Pesanan::with('user')->latest()->take(5)->get();

        return view('dashboard.admin', compact('totalPendapatan', 'pesananPending', 'totalTanaman', 'pesananTerbaru'));
    }
        
    public function beranda()
    {
        return view('welcome');
    }

    // Mengembalikan view halaman tentang kami (about)
    public function tentangKami()
    {
        return view('about');
    }

    public function dashboard()
        {
            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            
            return redirect()->route('tanaman.index');
        }
}