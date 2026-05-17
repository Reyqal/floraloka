<x-default-layout title="Katalog Produk - FloraLoka">
    
    <div class="bg-[#F4FDF4] overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between min-h-[360px]">
            <div class="w-full md:w-1/2 py-12 md:py-0 md:pr-12">
                <h1 class="text-4xl md:text-5xl font-extrabold text-zinc-900 leading-tight">
                    <span class="text-green-600">Ruanganmu</span>
                </h1>
                <p class="mt-4 text-zinc-600 text-lg max-w-md leading-relaxed">
                    Temukan berbagai macam tanaman hias premium untuk mempercantik sudut rumah dan ruang kerjamu. Kualitas terbaik, langsung dari petani.
                </p>
            </div>
            
            <div class="w-full md:w-1/2 h-64 md:h-[360px]">
                <img src="https://images.unsplash.com/photo-1604762524889-3e2fcc145683?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Rak Tanaman Hias" class="w-full h-full object-cover rounded-tl-[100px] shadow-sm">
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="max-w-7xl mx-auto px-6 mt-8">
            <div class="bg-green-50 border border-green-500 text-green-700 px-4 py-3 text-sm rounded-lg flex items-center gap-2">
                <i class="ph-fill ph-check-circle text-lg"></i> {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="max-w-7xl mx-auto px-6 mt-16">
        
        <div class="flex flex-col md:flex-row justify-between items-end md:items-center mb-8 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-zinc-900">Katalog Produk</h2>
                
                @can('admin-access')
                    <a href="{{ route('tanaman.create') }}" class="inline-flex items-center gap-2 bg-green-600 text-white px-4 py-2 mt-3 text-sm font-medium rounded-lg hover:bg-green-700 transition shadow-sm">
                        <i class="ph ph-plus text-base"></i> Tambah Tanaman Baru
                    </a>
                @endcan
            </div>

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($tanamans as $tanaman)
                <div class="bg-white rounded-2xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-md transition duration-300 flex flex-col">
                    
                    <div class="relative h-56 bg-zinc-100 overflow-hidden group">
                        <img src="{{ $tanaman->url_gambar }}" 
                            alt="{{ $tanaman->nama_tanaman }}" 
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        
                        <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-green-700 text-[11px] font-bold px-3 py-1 rounded-full shadow-sm">
                            {{ $tanaman->kategori->nama_kategori }}
                        </span>
                        
                        @can('admin-access')
                            <div class="absolute top-3 right-3 flex gap-1">
                                <a href="{{ route('tanaman.edit', $tanaman->id) }}" class="bg-white/90 backdrop-blur-sm text-yellow-600 p-1.5 rounded-md hover:bg-yellow-50 shadow-sm">
                                    <i class="ph ph-note-pencil text-sm"></i>
                                </a>
                                <form onsubmit="return confirm('Hapus data tanaman ini?')" method="POST" action="{{ route('tanaman.destroy', $tanaman->id) }}" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-white/90 backdrop-blur-sm text-red-600 p-1.5 rounded-md hover:bg-red-50 shadow-sm">
                                        <i class="ph ph-trash-simple text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        @endcan
                    </div>
                    
                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="text-base font-bold text-zinc-900 mb-1">{{ $tanaman->nama_tanaman }}</h3>
                        <p class="text-lg font-bold text-green-600 mb-4">
                            Rp {{ number_format($tanaman->harga, 0, ',', '.') }}
                        </p>
                        
                        <div class="mt-auto">
                            <a href="{{ route('tanaman.show', $tanaman->id) }}" class="w-full flex items-center justify-center gap-2 bg-zinc-50 border border-zinc-200 text-zinc-700 py-2.5 rounded-xl text-sm font-semibold hover:bg-green-50 hover:text-green-700 hover:border-green-200 transition cursor-pointer">
                                <i class="ph ph-shopping-cart text-lg"></i> Lihat Detail & Beli
                            </a>
                        </div>
                    </div>
                    
                </div>
            @empty
                <div class="col-span-1 sm:col-span-2 lg:col-span-4 text-center py-12 bg-zinc-50 rounded-2xl border border-zinc-100">
                    <i class="ph ph-potted-plant text-4xl text-zinc-300 mb-2"></i>
                    <p class="text-zinc-500">Belum ada koleksi tanaman yang tersedia saat ini.</p>
                </div>
            @endforelse
        </div>

    </div>
</x-default-layout>