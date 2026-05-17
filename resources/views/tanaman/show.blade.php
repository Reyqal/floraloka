<x-default-layout title="Detail Tanaman - FloraLoka" section_title="Detail Koleksi Tanaman">
    

    <div class="p-3 border-t border-zinc-100 bg-zinc-50 flex ">
        <a href="{{ route('tanaman.index') }}" class="bg-zinc-800 text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-zinc-700 transition flex items-center gap-2">
            <i class="ph ph-arrow-left" text-lg></i> Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start m-3"> 
        
        <div class="lg:col-span-5 bg-zinc-50 border border-zinc-200 rounded-2xl overflow-hidden shadow-sm aspect-square relative group">
            <img src="{{ $tanaman->url_gambar }}" 
                alt="{{ $tanaman->nama_tanaman }}" 
                class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
            
            <span class="absolute top-4 left-4 bg-white/95 backdrop-blur-sm text-green-700 text-xs font-bold px-3 py-1.5 rounded-full shadow-sm border border-zinc-100">
                <i class="ph ph-tag inline-block align-middle mr-1"></i> {{ $tanaman->kategori->nama_kategori }}
            </span>
        </div>

        <div class="lg:col-span-7 bg-white border border-zinc-100 shadow-sm rounded-2xl p-6 sm:p-8 flex flex-col justify-between h-full">
            
            <div class="space-y-6">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-zinc-900 tracking-tight">
                        {{ $tanaman->nama_tanaman }}
                    </h1>
                    <div class="h-[2px] bg-green-100 w-16 mt-3"></div>
                </div>

                <div class="bg-green-50/50 border border-green-100 rounded-xl p-4 flex items-center justify-between">
                    <span class="text-xs font-semibold uppercase text-zinc-500 tracking-wider">Harga Terbaik</span>
                    <span class="text-2xl font-extrabold text-green-600">
                        Rp {{ number_format($tanaman->harga, 0, ',', '.') }}
                    </span>
                </div>

                <div class="flex items-center gap-6 text-sm text-zinc-600 border-b border-zinc-100 pb-4">
                    <div class="flex items-center gap-1.5">
                        <i class="ph ph-package text-lg text-zinc-400"></i>
                        <span>Stok Tersedia: <strong class="text-zinc-900 font-semibold">{{ $tanaman->stok }} pcs</strong></span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <i class="ph ph-shield-check text-lg text-zinc-400"></i>
                        <span class="text-green-700 font-medium">Garansi Segar</span>
                    </div>
                </div>

                <div class="space-y-2">
                    <h3 class="text-sm font-bold uppercase text-zinc-400 tracking-wider">Deskripsi Tanaman</h3>
                    <p class="text-zinc-600 text-sm leading-relaxed whitespace-pre-line">
                        {{ $tanaman->deskripsi ?? 'Belum ada deskripsi spesifik untuk tanaman hias ini.' }}
                    </p>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-zinc-100">
                @auth
                    <form action="{{ route('pesanan.store') }}" method="POST" class="flex flex-col sm:flex-row gap-3">
                        @csrf
                        <input type="hidden" name="tanaman_id" value="{{ $tanaman->id }}">
                        
                        <div class="flex items-center border border-zinc-200 rounded-xl bg-zinc-50 px-2 h-12 w-full sm:w-32">
                            <label for="jumlah" class="sr-only">Jumlah</label>
                            <input type="number" id="jumlah" name="jumlah" value="1" min="1" max="{{ $tanaman->stok }}" class="w-full text-center bg-transparent border-none text-sm font-semibold text-zinc-800 outline-none focus:ring-0">
                        </div>
                        
                        <button type="submit" class="flex-grow flex items-center justify-center gap-2 bg-green-600 border border-green-700 text-white font-semibold py-3 px-6 rounded-xl text-sm shadow-sm hover:bg-green-700 transition cursor-pointer disabled:bg-zinc-400 disabled:border-zinc-400" {{ $tanaman->stok < 1 ? 'disabled' : '' }}>
                            <i class="ph ph-shopping-bag text-xl"></i>
                            <span>{{ $tanaman->stok < 1 ? 'Stok Habis' : 'Beli Sekarang' }}</span>
                        </button>
                    </form>
                @else
                    <a href="{{ route('auth.login') }}" class="w-full flex items-center justify-center gap-2 bg-zinc-800 text-white font-semibold py-3 px-6 rounded-xl text-sm shadow-sm hover:bg-zinc-700 transition">
                        <i class="ph ph-sign-in text-xl"></i>
                        <span>Login untuk Membeli</span>
                    </a>
                @endauth
            </div>

        </div>
    </div>

</x-default-layout>