<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TanamanController;
use App\Http\Controllers\ProfileController; 
use App\Http\Controllers\PesananController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;

Route::get('/', [TanamanController::class, 'index'])->name('tanaman.index');
Route::get('/tanaman/detail/{id}', [TanamanController::class, 'show'])->name('tanaman.show');

Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthController::class, 'store'])->name('auth.store');
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');

Route::get('/', [HomeController::class, 'beranda'])->name('beranda');
Route::get('/katalog', [TanamanController::class, 'index'])->name('tanaman.index');
Route::get('/tentang-kami', [HomeController::class, 'tentangKami'])->name('tentang-kami');

Route::middleware('auth')->group(function () {
    // Rute Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    
    // Redirect otomatis ke halaman depan jika mengakses 
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    // Rute CRUD Tanaman (Hanya bisa diproses jika lolos Gate di dalam Controllernya)
    Route::get('/tanaman/create/baru', [TanamanController::class, 'create'])->name('tanaman.create');
    Route::post('/tanaman', [TanamanController::class, 'store'])->name('tanaman.store');
    Route::get('/tanaman/{id}/edit', [TanamanController::class, 'edit'])->name('tanaman.edit');
    Route::put('/tanaman/{id}', [TanamanController::class, 'update'])->name('tanaman.update');
    Route::delete('/tanaman/{id}', [TanamanController::class, 'destroy'])->name('tanaman.destroy');

    // Rute Pesanan / Transaksi (Wajib Login)
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::post('/pesanan', [PesananController::class, 'store'])->name('pesanan.store');
    Route::put('/pesanan/{id}', [PesananController::class, 'update'])->name('pesanan.update');
    Route::post('/pesanan/{id}/bukti', [PesananController::class, 'uploadBukti'])->name('pesanan.bukti');
    
    // Rute Pengelolaan Profil & Alamat Pelanggan
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password');
});