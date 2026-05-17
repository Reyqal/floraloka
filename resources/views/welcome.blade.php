<x-default-layout title="Selamat Datang - FloraLoka">
    
    <div class="relative bg-gradient-to-br from-green-50 to-emerald-100/50 rounded-3xl p-8 md:p-16 overflow-hidden mb-12 shadow-sm">
        <div class="max-w-2xl relative z-10">
            <span class="bg-green-100 text-green-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">🌿 Solusi Rumah Segar</span>
            <h1 class="text-4xl md:text-6xl font-black text-zinc-900 mt-4 leading-tight">
                Bawa Kesegaran Alam ke <span class="text-green-600">Ruanganmu</span>
            </h1>
            <p class="text-zinc-600 mt-4 text-base md:text-lg leading-relaxed">
                Temukan berbagai macam tanaman hias premium untuk mempercantik sudut rumah dan ruang kerjamu. Kualitas terbaik, dirawat dengan kasih sayang langsung dari petani.
            </p>
            <div class="mt-8 flex gap-4">
                <a href="{{ route('tanaman.index') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-xl shadow-sm transition">
                    Jelajahi Katalog
                </a>
                <a href="{{ route('tentang-kami') }}" class="bg-white hover:bg-zinc-50 border border-zinc-200 text-zinc-700 font-semibold px-6 py-3 rounded-xl transition">
                    Kenali Kami
                </a>
            </div>
        </div>
        <div class="absolute right-0 bottom-0 top-0 w-1/3 hidden lg:block">
            <img src="https://images.unsplash.com/photo-1545241047-6083a3684587?auto=format&fit=crop&w=600&q=80" alt="Plant Decoration" class="w-full h-full object-cover rounded-l-3xl">
        </div>
    </div>

    <div class="mb-16">
        <div class="text-center max-w-xl mx-auto mb-10">
            <h2 class="text-2xl font-bold text-zinc-900">Kenapa Harus FloraLoka?</h2>
            <p class="text-zinc-500 text-sm mt-1">Kami memastikan pengalaman belanja tanaman hias terbaik untuk Anda.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="bg-white border border-zinc-100 p-6 rounded-2xl shadow-sm">
                <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center text-green-600 text-2xl mb-4">
                    <i class="ph ph-truck"></i>
                </div>
                <h3 class="font-bold text-zinc-800 mb-1">Pengiriman Aman</h3>
                <p class="text-zinc-500 text-xs leading-relaxed">Packing khusus menggunakan rangka kardus tebal tegar agar tanaman sampai tanpa layu atau patah.</p>
            </div>
            <div class="bg-white border border-zinc-100 p-6 rounded-2xl shadow-sm">
                <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center text-green-600 text-2xl mb-4">
                    <i class="ph ph-shield-check"></i>
                </div>
                <h3 class="font-bold text-zinc-800 mb-1">Garansi Segar</h3>
                <p class="text-zinc-500 text-xs leading-relaxed">Tanaman mati atau rusak parah di jalan? Kami ganti 100% dengan tanaman baru tanpa biaya tambahan.</p>
            </div>
            <div class="bg-white border border-zinc-100 p-6 rounded-2xl shadow-sm">
                <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center text-green-600 text-2xl mb-4">
                    <i class="ph ph-handshake"></i>
                </div>
                <h3 class="font-bold text-zinc-800 mb-1">Bebas Konsultasi</h3>
                <p class="text-zinc-500 text-xs leading-relaxed">Masih pemula? Tenang, tim kami siap memandu cara perawatan via chat kapan saja Anda butuhkan.</p>
            </div>
        </div>
    </div>

</x-default-layout>