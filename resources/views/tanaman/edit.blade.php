<x-default-layout title="Edit Tanaman - FloraLoka" section_title="Edit Data Tanaman">
    
    <div class="p-3 border-t border-zinc-100 bg-zinc-50 flex ">
        <a href="{{ route('tanaman.index') }}" class="bg-zinc-800 text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-zinc-700 transition flex items-center gap-2">
            <i class="ph ph-arrow-left" text-lg></i> Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-1">
            <div class="bg-zinc-50 border border-zinc-200 rounded-2xl p-4 text-center shadow-sm">
                <p class="text-sm font-semibold text-zinc-600 mb-3">Foto Saat Ini</p>
                <div class="aspect-square rounded-xl overflow-hidden bg-white border border-zinc-100 mb-4">
                    <img src="{{ $tanaman->url_gambar }}" 
                        alt="{{ $tanaman->nama_tanaman }}" 
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                </div>
                <p class="text-xs text-zinc-400">Jika tidak ingin mengubah foto, biarkan input foto pada form di samping kosong.</p>
            </div>
        </div>

        <div class="lg:col-span-2 bg-white border border-zinc-200 rounded-2xl p-6 shadow-sm">
            <form action="{{ route('tanaman.update', $tanaman->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-5">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="flex flex-col gap-2">
                        <label for="nama_tanaman" class="font-semibold text-sm text-zinc-700">Nama Tanaman</label>
                        <input type="text" id="nama_tanaman" name="nama_tanaman" class="px-4 py-2.5 border border-zinc-200 rounded-xl bg-zinc-50 text-sm outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-600 transition" value="{{ old('nama_tanaman', $tanaman->nama_tanaman) }}">
                        @error('nama_tanaman') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="kategori_id" class="font-semibold text-sm text-zinc-700">Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="px-4 py-2.5 border border-zinc-200 rounded-xl bg-zinc-50 text-sm outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-600 transition">
                            <option value="" disabled>Pilih Kategori</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategori_id', $tanaman->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="harga" class="font-semibold text-sm text-zinc-700">Harga Jual (Rp)</label>
                        <input type="number" id="harga" name="harga" class="px-4 py-2.5 border border-zinc-200 rounded-xl bg-zinc-50 text-sm outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-600 transition" value="{{ old('harga', $tanaman->harga) }}">
                        @error('harga') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="stok" class="font-semibold text-sm text-zinc-700">Stok Tersedia</label>
                        <input type="number" id="stok" name="stok" class="px-4 py-2.5 border border-zinc-200 rounded-xl bg-zinc-50 text-sm outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-600 transition" value="{{ old('stok', $tanaman->stok) }}">
                        @error('stok') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="gambar" class="font-semibold text-sm text-zinc-700">Ganti Foto Tanaman (Opsional)</label>
                    <input type="file" id="gambar" name="gambar" accept="image/*" class="px-4 py-2 border border-zinc-200 rounded-xl bg-zinc-50 text-sm outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 transition">
                    @error('gambar') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label for="deskripsi" class="font-semibold text-sm text-zinc-700">Deskripsi Lengkap</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" class="px-4 py-2.5 border border-zinc-200 rounded-xl bg-zinc-50 text-sm outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-600 transition">{{ old('deskripsi', $tanaman->deskripsi) }}</textarea>
                    @error('deskripsi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end gap-3 mt-4">
                    <a href="{{ route('tanaman.index') }}" class="bg-zinc-100 border border-zinc-200 text-zinc-600 font-semibold py-2.5 px-6 rounded-xl text-sm hover:bg-zinc-200 transition">
                        Batal
                    </a>
                    <button type="submit" class="bg-blue-600 border border-blue-700 text-white font-semibold py-2.5 px-6 rounded-xl text-sm shadow-sm hover:bg-blue-700 transition cursor-pointer flex items-center gap-2">
                        <i class="ph ph-check-circle text-lg"></i>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-default-layout>