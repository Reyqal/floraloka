<x-default-layout title="Tambah Tanaman" section_title="Tambah Data Tanaman Baru">
    
    <div class="max-w-4xl mx-auto px-4 mt-8 mb-20">
        
        <div class="mb-8">
            <h2 class="text-2xl font-extrabold text-zinc-900">Tambah Data Tanaman</h2>
            <p class="text-zinc-500 text-sm mt-1">Masukkan informasi detail produk tanaman hias baru untuk katalog FloraLoka.</p>
        </div>

        <form action="{{ route('tanaman.store') }}" method="POST" enctype="multipart/form-data" 
              class="flex flex-col gap-6 p-6 md:p-10 bg-white border border-zinc-100 rounded-3xl shadow-sm">
            @csrf
            @method('POST')

            <div class="flex flex-col gap-2">
                <label class="font-bold text-sm text-zinc-800">Nama Tanaman</label>
                <input type="text" name="nama_tanaman" 
                       class="px-4 py-3 rounded-xl border border-zinc-200 bg-zinc-50/50 outline-none focus:border-green-500 focus:bg-white focus:ring-4 focus:ring-green-50 transition placeholder:text-zinc-400 text-sm font-medium" 
                       placeholder="Misal: Monstera Obliqua" 
                       value="{{ old('nama_tanaman') }}">
                @error('nama_tanaman') <div class="text-red-500 text-xs font-semibold mt-0.5"><i class="ph-fill ph-warning-circle"></i> {{ $message }}</div> @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label class="font-bold text-sm text-zinc-800">Kategori</label>
                <div class="relative">
                    <select name="kategori_id" 
                            class="w-full px-4 py-3 rounded-xl border border-zinc-200 bg-zinc-50/50 outline-none focus:border-green-500 focus:bg-white focus:ring-4 focus:ring-green-50 transition text-sm font-medium text-zinc-700 appearance-none">
                        <option value="" disabled selected>Pilih Kategori Tanaman</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-zinc-400">
                        <i class="ph-bold ph-caret-down"></i>
                    </div>
                </div>
                @error('kategori_id') <div class="text-red-500 text-xs font-semibold mt-0.5"><i class="ph-fill ph-warning-circle"></i> {{ $message }}</div> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="flex flex-col gap-2">
                    <label class="font-bold text-sm text-zinc-800">Harga (Rp)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-4 flex items-center text-sm font-bold text-zinc-400">Rp</span>
                        <input type="number" name="harga" 
                               class="w-full pl-10 pr-4 py-3 rounded-xl border border-zinc-200 bg-zinc-50/50 outline-none focus:border-green-500 focus:bg-white focus:ring-4 focus:ring-green-50 transition text-sm font-medium" 
                               placeholder="0"
                               value="{{ old('harga') }}">
                    </div>
                    @error('harga') <div class="text-red-500 text-xs font-semibold mt-0.5"><i class="ph-fill ph-warning-circle"></i> {{ $message }}</div> @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label class="font-bold text-sm text-zinc-800">Stok Tersedia</label>
                    <input type="number" name="stok" 
                           class="px-4 py-3 rounded-xl border border-zinc-200 bg-zinc-50/50 outline-none focus:border-green-500 focus:bg-white focus:ring-4 focus:ring-green-50 transition text-sm font-medium" 
                           placeholder="Contoh: 15"
                           value="{{ old('stok') }}">
                    @error('stok') <div class="text-red-500 text-xs font-semibold mt-0.5"><i class="ph-fill ph-warning-circle"></i> {{ $message }}</div> @enderror
                </div>
            </div>

            <div class="flex flex-col gap-2">
                <label for="gambar" class="font-bold text-sm text-zinc-800">Foto Tanaman</label>
                <input type="file" id="gambar" name="gambar" 
                       class="px-4 py-2.5 rounded-xl border border-zinc-200 bg-zinc-50/50 text-sm outline-none focus:border-zinc-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 file:transition cursor-pointer transition w-full text-zinc-500" 
                       accept="image/*">
                @error('gambar') <div class="text-red-500 text-xs font-semibold mt-0.5"><i class="ph-fill ph-warning-circle"></i> {{ $message }}</div> @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label class="font-bold text-sm text-zinc-800">Deskripsi Tanaman</label>
                <textarea name="deskripsi" rows="4" 
                          class="px-4 py-3 rounded-xl border border-zinc-200 bg-zinc-50/50 outline-none focus:border-green-500 focus:bg-white focus:ring-4 focus:ring-green-50 transition text-sm font-medium leading-relaxed placeholder:text-zinc-400"
                          placeholder="Jelaskan karakteristik tanaman, cara perawatan singkat, atau ukuran pot...规格">{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <div class="text-red-500 text-xs font-semibold mt-0.5"><i class="ph-fill ph-warning-circle"></i> {{ $message }}</div> @enderror
            </div>

            <div class="flex items-center justify-end gap-3 mt-4 pt-6 border-t border-zinc-100">
                <a href="{{ route('tanaman.index') }}" 
                   class="bg-zinc-50 hover:bg-zinc-100 border border-zinc-200 text-zinc-600 font-semibold px-5 py-3 rounded-xl text-sm transition text-center min-w-[100px]">
                    Batal
                </a>
                <button type="submit" 
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-xl text-sm flex items-center justify-center gap-2 shadow-sm shadow-green-100 transition min-w-[140px] cursor-pointer">
                    <i class="ph-fill ph-floppy-disk text-base"></i> Simpan Data
                </button>
            </div>
        </form>
    </div>
</x-default-layout>