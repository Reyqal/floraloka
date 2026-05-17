<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Menampilkan halaman profil
    public function index()
    {
        $user = Auth::user(); 
        return view('profile', compact('user'));
    }

    // Memproses update data profil, alamat, dan no hp
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        // Mengupdate data user ke database
        $user->update($validated);

        return redirect()->route('profile.index')->with('success', 'Profil dan Alamat Pengiriman berhasil diperbarui!');
    }
    
    // Customer mengunggah bukti pembayaran
    public function uploadBukti(Request $request, string $id)
    {
        $request->validate([
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $pesanan = Pesanan::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // Simpan gambar bukti ke storage
        $path = $request->file('bukti_bayar')->store('bukti_bayar', 'public');

        // Update database pesanan
        $pesanan->update([
            'bukti_bayar' => $path,
            'status' => 'menunggu_verifikasi' // Status otomatis berubah
        ]);

        return back()->with('success', 'Bukti pembayaran berhasil diunggah! Menunggu konfirmasi Admin.');
    }
}