<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Tanaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PesananController extends Controller
{
    // Menampilkan daftar pesanan (Berbeda untuk Admin dan Customer)
    public function index()
    {
        if (Gate::allows('admin-access')) {
            // Admin melihat semua pesanan
            $pesanans = Pesanan::with(['user', 'detailPesanans.tanaman'])->latest()->get();
        } else {
            // Customer hanya melihat pesanannya sendiri
            $pesanans = Pesanan::with('detailPesanans.tanaman')
                               ->where('user_id', Auth::id())
                               ->latest()
                               ->get();
        }

        return view('pesanan.index', compact('pesanans'));
    }

    // Memproses pembuatan pesanan baru (Khusus Customer)
    public function store(Request $request)
    {
        $request->validate([
            'tanaman_id' => 'required|exists:tanamans,id',
            'jumlah' => 'required|integer|min:1'
        ]);

        $tanaman = Tanaman::findOrFail($request->tanaman_id);

        // Cek ketersediaan stok
        abort_if($tanaman->stok < $request->jumlah, 400, 'Stok tanaman tidak mencukupi.');

        // Hitung total harga
        $total_harga = $tanaman->harga * $request->jumlah;

        // 1. Buat record Pesanan Induk
        $pesanan = Pesanan::create([
            'user_id' => Auth::id(),
            'total_harga' => $total_harga,
            'status' => 'pending' // Status awal pesanan
        ]);

        // 2. Buat record Detail Pesanan
        DetailPesanan::create([
            'pesanan_id' => $pesanan->id,
            'tanaman_id' => $tanaman->id,
            'jumlah' => $request->jumlah,
            'subtotal' => $total_harga
        ]);

        // 3. Kurangi stok tanaman secara otomatis
        $tanaman->decrement('stok', $request->jumlah);

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.');
    }

    // Admin mengupdate status pesanan (Pending -> Dibayar -> Dikirim -> Selesai)
    public function update(Request $request, string $id)
    {
        if (! Gate::allows('admin-access')) { abort(401); }

        $request->validate([
            'status' => 'required|in:pending,dibayar,dikirim,selesai'
        ]);

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update(['status' => $request->status]);

        return back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    // Customer mengunggah bukti pembayaran
    public function uploadBukti(Request $request, string $id)
    {
        // Validasi file gambar
        $request->validate([
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        // Cari pesanan milik user yang sedang login
        $pesanan = \App\Models\Pesanan::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // Simpan gambar bukti ke folder public/storage/bukti_bayar
        $path = $request->file('bukti_bayar')->store('bukti_bayar', 'public');

        // Update database pesanan
        $pesanan->update([
            'bukti_bayar' => $path,
            'status' => 'menunggu_verifikasi' // Status otomatis berubah
        ]);

        return back()->with('success', 'Bukti pembayaran berhasil diunggah! Menunggu konfirmasi Admin.');
    }
}
