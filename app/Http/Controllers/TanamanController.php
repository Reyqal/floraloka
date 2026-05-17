<?php

namespace App\Http\Controllers;

use App\Models\Tanaman;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate; 

class TanamanController extends Controller
{
    // Menampilkan daftar tanaman
    public function index()
    {
        $tanamans = Tanaman::with('kategori')->get();
        return view('tanaman.index', compact('tanamans'));
    }

    // Menampilkan form tambah (Hanya Admin)
    public function create()
    {
        if (! Gate::allows('admin-access')) { abort(401); } 
        $kategoris = Kategori::all();
        return view('tanaman.create', compact('kategoris'));
    }

    // Menyimpan data tanaman baru (Hanya Admin)
    public function store(Request $request)
    {
        if (! Gate::allows('admin-access')) { abort(401); }

        $validated = $request->validate([
            'nama_tanaman' => 'required',
            'kategori_id'  => 'required',
            'harga'        => 'required|numeric',
            'stok'         => 'required|numeric',
            'deskripsi'    => 'required',
            'gambar'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // 2. Logika pemindahan file gambar dari form ke folder storage publik
        if ($request->hasFile('gambar')) {
            // Simpan gambar ke folder storage/app/public/tanaman
            $path = $request->file('gambar')->store('tanaman', 'public');
            
            // Masukkan path gambar ke dalam array $validated sebelum di-create
            $validated['gambar'] = $path;
        }

        // 3. Sekarang data yang di-create sudah lengkap termasuk path gambarnya
        Tanaman::create($validated);

        return redirect()->route('tanaman.index')->with('success', 'Data Tanaman berhasil ditambahkan!');
    }

    // Menampilkan detail tanaman
    public function show(string $id)
    {
        $tanaman = Tanaman::with('kategori')->findOrFail($id);
        return view('tanaman.show', compact('tanaman'));
    }

    // Menampilkan form edit (Hanya Admin)
    public function edit(string $id)
    {
        if (! Gate::allows('admin-access')) { abort(401); }
        $tanaman = Tanaman::findOrFail($id);
        $kategoris = Kategori::all();
        return view('tanaman.edit', compact('tanaman', 'kategoris'));
    }

   public function update(Request $request, string $id)
    {
        if (! Gate::allows('admin-access')) { abort(401); }

        $validated = $request->validate([
            'nama_tanaman' => 'required',
            'kategori_id' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Validasi file gambar
        ]);

        $tanaman = \App\Models\Tanaman::findOrFail($id);

        // Jika admin mengunggah gambar baru saat proses edit
        if ($request->hasFile('gambar')) {
            // Hapus file foto lama di server agar penyimpanan tidak penuh
            if ($tanaman->gambar) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($tanaman->gambar);
            }
            // Simpan foto baru ke folder storage
            $validated['gambar'] = $request->file('gambar')->store('tanaman', 'public');
        }

        $tanaman->update($validated);

        return redirect()->route('tanaman.index')->with('success', 'Data Tanaman berhasil diperbarui!');
    }

    // Menghapus data tanaman (Hanya Admin)
    public function destroy(string $id)
    {
        if (! Gate::allows('admin-access')) { abort(401); } 
        $tanaman = Tanaman::findOrFail($id);
        $tanaman->delete();

        return redirect()->route('tanaman.index')->with('success', 'Data Tanaman berhasil dihapus!');
    }
}
