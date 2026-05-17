<x-default-layout title="Admin Dashboard - FloraLoka">
    
    <div class="bg-[#F4FDF4] overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between min-h-[360px] py-10 md:py-0">
            <div class="w-full md:w-1/2 md:pr-12">
                <span class="bg-green-100 text-green-700 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-4 inline-block">
                    Pusat Komando
                </span>
                <h1 class="text-4xl md:text-5xl font-extrabold text-zinc-900 leading-tight">
                    Halo, <span class="text-green-600">Admin!</span> 👋
                </h1>
                <p class="mt-4 text-zinc-600 text-lg max-w-md leading-relaxed">
                    Pantau ringkasan operasional tokomu hari ini. Segera proses pesanan yang masuk agar pelanggan selalu puas dengan layanan FloraLoka.
                </p>
                
                <div class="mt-6 flex items-center gap-2 text-sm font-semibold text-zinc-700 bg-white border border-zinc-200 shadow-sm w-max px-4 py-2.5 rounded-xl">
                    <i class="ph-fill ph-calendar-blank text-green-600 text-lg"></i>
                    {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                </div>
            </div>
            
            <div class="w-full md:w-1/2 h-64 md:h-[360px] mt-8 md:mt-0">
                <img src="https://images.unsplash.com/photo-1497215728101-856f4ea42174?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                     alt="Admin Workspace" 
                     class="w-full h-full object-cover rounded-tl-[100px] shadow-sm">
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 mt-12 mb-16">
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            
            <div class="bg-white p-6 rounded-2xl border border-zinc-100 shadow-sm flex flex-col justify-center">
                <div class="flex items-center gap-4 mb-3">
                    <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center text-green-600 text-xl flex-shrink-0">
                        <i class="ph-fill ph-wallet"></i>
                    </div>
                    <p class="text-xs font-bold text-zinc-400 uppercase tracking-wider">Total Pendapatan</p>
                </div>
                <h3 class="text-3xl font-black text-zinc-800">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
            </div>
            
            <div class="bg-white p-6 rounded-2xl border border-zinc-100 shadow-sm flex flex-col justify-center relative overflow-hidden">
                @if($pesananPending > 0)
                    <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-orange-500"></div>
                @endif
                <div class="flex items-center gap-4 mb-3">
                    <div class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center text-orange-600 text-xl flex-shrink-0">
                        <i class="ph-fill ph-bell-ringing"></i>
                    </div>
                    <p class="text-xs font-bold text-zinc-400 uppercase tracking-wider">Perlu Verifikasi</p>
                </div>
                <h3 class="text-3xl font-black text-zinc-800">{{ $pesananPending }} <span class="text-base text-zinc-500 font-bold">Pesanan</span></h3>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-zinc-100 shadow-sm flex flex-col justify-center">
                <div class="flex items-center gap-4 mb-3">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 text-xl flex-shrink-0">
                        <i class="ph-fill ph-plant"></i>
                    </div>
                    <p class="text-xs font-bold text-zinc-400 uppercase tracking-wider">Total Katalog</p>
                </div>
                <h3 class="text-3xl font-black text-zinc-800">{{ $totalTanaman }} <span class="text-base text-zinc-500 font-bold">Item</span></h3>
            </div>

        </div>

        <div class="bg-white border border-zinc-200 shadow-sm rounded-2xl overflow-hidden">
            <div class="px-6 py-5 border-b border-zinc-100 flex justify-between items-center bg-zinc-50/50">
                <h3 class="font-bold text-zinc-900 text-base">Pesanan Masuk Terbaru</h3>
                <a href="{{ route('pesanan.index') }}" class="text-sm font-bold text-green-600 hover:text-green-700 transition flex items-center gap-1">
                    Lihat Semua <i class="ph-bold ph-arrow-right"></i>
                </a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-zinc-600">
                    <tbody class="divide-y divide-zinc-100">
                        @forelse($pesananTerbaru as $pesanan)
                            <tr class="hover:bg-zinc-50/50 transition">
                                <td class="py-4 px-6">
                                    <p class="font-bold text-zinc-900 text-base">{{ $pesanan->user->name }}</p>
                                    <p class="text-xs text-zinc-400 mt-0.5">#ORD-{{ str_pad($pesanan->id, 4, '0', STR_PAD_LEFT) }} • {{ $pesanan->created_at->diffForHumans() }}</p>
                                </td>
                                <td class="py-4 px-6 font-bold text-zinc-800 text-right">
                                    Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                                </td>
                                <td class="py-4 px-6 text-right w-40">
                                    @php
                                        $style = match($pesanan->status) {
                                            'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                            'menunggu_verifikasi' => 'bg-orange-100 text-orange-800 border-orange-200',
                                            'dibayar' => 'bg-blue-100 text-blue-800 border-blue-200',
                                            'dikirim' => 'bg-purple-100 text-purple-800 border-purple-200',
                                            'selesai' => 'bg-green-100 text-green-800 border-green-200',
                                            default => 'bg-zinc-100 text-zinc-800 border-zinc-200'
                                        };
                                    @endphp
                                    <span class="inline-flex items-center justify-center w-full px-2.5 py-1 rounded text-[10px] font-bold border {{ $style }} uppercase tracking-wide">
                                        {{ str_replace('_', ' ', $pesanan->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-12 text-center">
                                    <i class="ph-fill ph-inbox text-4xl text-zinc-300 mb-2 block"></i>
                                    <p class="text-zinc-500 font-medium">Belum ada pesanan terbaru masuk.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-default-layout>