<x-default-layout title="Tambah Tanaman" section_title="Tambah Data Tanaman Baru">
    
    <form action="{{ route('tanaman.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4 p-6 bg-white border border-zinc-200 shadow-sm col-span-3 lg:col-span-2">
        @csrf
        @method('POST')

        <div class="flex flex-col gap-2">
            <label class="font-semibold text-sm">Nama Tanaman</label>
            <input type="text" name="nama_tanaman" class="px-3 py-2 border border-zinc-300 bg-slate-50" placeholder="Misal: Monstera" value="{{ old('nama_tanaman') }}">
            @error('nama_tanaman') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
        </div>

        <div class="flex flex-col gap-2">
            <label class="font-semibold text-sm">Kategori</label>
            <select name="kategori_id" class="px-3 py-2 border border-zinc-300 bg-slate-50">
                <option value="" disabled selected>Pilih Kategori</option>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
            @error('kategori_id') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div class="flex flex-col gap-2">
                <label class="font-semibold text-sm">Harga (Rp)</label>
                <input type="number" name="harga" class="px-3 py-2 border border-zinc-300 bg-slate-50" value="{{ old('harga') }}">
                @error('harga') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label class="font-semibold text-sm">Stok Tersedia</label>
                <input type="number" name="stok" class="px-3 py-2 border border-zinc-300 bg-slate-50" value="{{ old('stok') }}">
                @error('stok') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="flex flex-col gap-2">
            <label for="gambar" class="font-semibold text-sm">Foto Tanaman</label>
            <input type="file" id="gambar" name="gambar" class="px-3 py-2 border border-zinc-300 bg-slate-50 text-sm outline-none focus:border-zinc-500" accept="image/*">
            @error('gambar')
                <div class="text-red-500 text-xs font-medium">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex flex-col gap-2">
            <label class="font-semibold text-sm">Deskripsi</label>
            <textarea name="deskripsi" rows="3" class="px-3 py-2 border border-zinc-300 bg-slate-50">{{ old('deskripsi') }}</textarea>
            @error('deskripsi') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
        </div>

        <div class="self-end flex gap-2 mt-4">
            <a href="{{ route('tanaman.index') }}" class="bg-slate-50 border border-slate-500 text-slate-600 px-4 py-2 cursor-pointer">Batal</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 flex items-center gap-2 cursor-pointer">
                <i class="ph ph-floppy-disk block text-white"></i> Simpan Data
            </button>
        </div>
    </form>
</x-default-layout>