<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TanamanController;
use App\Http\Controllers\ProfileController; 
use App\Http\Controllers\PesananController;
use App\Http\Controllers\DashboardController;

// RUTE UMUM / PUBLIC (Bisa Diakses Semua Orang)

// Halaman Utama / Beranda (Welcome)
Route::get('/', [DashboardController::class, 'beranda'])->name('beranda');

// Halaman Katalog Produk & Detail Tanaman
Route::get('/katalog', [TanamanController::class, 'index'])->name('tanaman.index');
Route::get('/tanaman/detail/{id}', [TanamanController::class, 'show'])->name('tanaman.show');

// Halaman Tentang Kami
Route::get('/tentang-kami', [DashboardController::class, 'tentangKami'])->name('tentang-kami');

// RUTE AUTENTIKASI (Hanya Bisa Diakses Pengunjung Belum Login)
Route::middleware('guest')->group(function () {
    // Register
    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'store'])->name('auth.store');

    // Login
    Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');
});

// RUTE PROTEKSI / WAJIB LOGIN (Auth Middleware)
Route::middleware('auth')->group(function () {
    
    // Proses Keluar Aplikasi (Logout)
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    
    // Rute Jembatan Pengalihan Otomatis URL /dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // AREA AMAN 1: KHUSUS ADMIN (Dashboard Admin)
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->middleware('can:admin-access')
        ->name('admin.dashboard');

    // AREA AMAN 2: KHUSUS ADMIN (Manajemen CRUD Tanaman)
    Route::middleware('can:admin-access')->group(function () {
        Route::get('/tanaman/create/baru', [TanamanController::class, 'create'])->name('tanaman.create');
        Route::post('/tanaman', [TanamanController::class, 'store'])->name('tanaman.store');
        Route::get('/tanaman/{id}/edit', [TanamanController::class, 'edit'])->name('tanaman.edit');
        Route::put('/tanaman/{id}', [TanamanController::class, 'update'])->name('tanaman.update');
        Route::delete('/tanaman/{id}', [TanamanController::class, 'destroy'])->name('tanaman.destroy');
    });

    // MANAJEMEN PESANAN / TRANSAKSI (Customer & Admin)
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::post('/pesanan', [PesananController::class, 'store'])->name('pesanan.store');
    Route::put('/pesanan/{id}', [PesananController::class, 'update'])->name('pesanan.update');
    Route::post('/pesanan/{id}/bukti', [PesananController::class, 'uploadBukti'])->name('pesanan.bukti');
    
    // PROFIL PENGGUNA & ALAMAT (Customer & Admin)
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});