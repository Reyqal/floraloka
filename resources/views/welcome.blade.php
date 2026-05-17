<x-default-layout title="Selamat Datang - FloraLoka">
    
    <div class="bg-[#F4FDF4] overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between min-h-[480px] py-12 md:py-0">
            
            <div class="w-full md:w-1/2 md:pr-12">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-zinc-900 leading-tight">
                    Bawa Kesegaran Alam ke <span class="text-green-600">Ruanganmu</span>
                </h1>
                <p class="mt-4 text-zinc-600 text-lg max-w-md leading-relaxed">
                    Temukan berbagai macam tanaman hias premium untuk mempercantik sudut rumah dan ruang kerjamu. Kualitas terbaik, dirawat dengan kasih sayang langsung dari petani.
                </p>
                
                <div class="mt-4 mb-4 flex flex-wrap gap-4">
                    <a href="{{ route('tanaman.index') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3.5 rounded-xl shadow-sm transition">
                        Jelajahi Katalog
                    </a>
                    <a href="{{ route('tentang-kami') }}" class="bg-white hover:bg-zinc-50 border border-zinc-200 text-zinc-700 font-semibold px-6 py-3.5 rounded-xl shadow-sm transition">
                        Kenali Kami
                    </a>
                </div>
            </div>
            
            <div class="w-full md:w-1/2 h-72 md:h-[480px] mt-10 md:mt-0">
                <img src="https://images.unsplash.com/photo-1545241047-6083a3684587?auto=format&fit=crop&w=1000&q=80" 
                     alt="Plant Decoration" 
                     class="w-full h-full object-cover rounded-tl-[120px] shadow-sm">
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 mt-20 mb-20">
        <div class="text-center max-w-xl mx-auto mb-12">
            <h2 class="text-3xl font-extrabold text-zinc-900">Kenapa Harus FloraLoka?</h2>
            <p class="text-zinc-500 text-base mt-2">Kami memastikan pengalaman belanja tanaman hias terbaik untuk Anda.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white border border-zinc-100 p-8 rounded-3xl shadow-sm hover:shadow-md transition duration-300">
                <div class="w-14 h-14 rounded-2xl bg-green-50 flex items-center justify-center text-green-600 text-3xl mb-6">
                    <i class="ph-fill ph-truck"></i>
                </div>
                <h3 class="text-lg font-bold text-zinc-900 mb-2">Pengiriman Aman</h3>
                <p class="text-zinc-500 text-sm leading-relaxed">Packing khusus menggunakan rangka kardus tebal tegar agar tanaman sampai tanpa layu atau patah di perjalanan.</p>
            </div>
            
            <div class="bg-white border border-zinc-100 p-8 rounded-3xl shadow-sm hover:shadow-md transition duration-300">
                <div class="w-14 h-14 rounded-2xl bg-green-50 flex items-center justify-center text-green-600 text-3xl mb-6">
                    <i class="ph-fill ph-shield-check"></i>
                </div>
                <h3 class="text-lg font-bold text-zinc-900 mb-2">Garansi Segar</h3>
                <p class="text-zinc-500 text-sm leading-relaxed">Tanaman mati atau rusak parah di jalan? Kami ganti 100% dengan tanaman baru tanpa biaya tambahan sedikit pun.</p>
            </div>
            
            <div class="bg-white border border-zinc-100 p-8 rounded-3xl shadow-sm hover:shadow-md transition duration-300">
                <div class="w-14 h-14 rounded-2xl bg-green-50 flex items-center justify-center text-green-600 text-3xl mb-6">
                    <i class="ph-fill ph-handshake"></i>
                </div>
                <h3 class="text-lg font-bold text-zinc-900 mb-2">Bebas Konsultasi</h3>
                <p class="text-zinc-500 text-sm leading-relaxed">Masih pemula merawat tanaman? Tenang, tim kami siap memandu cara perawatan via chat kapan saja Anda butuhkan.</p>
            </div>
        </div>
    </div>

</x-default-layout>