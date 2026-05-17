<x-default-layout title="Pesanan - FloraLoka" section_title="{{ Gate::allows('admin-access') ? 'Kelola Pesanan Masuk' : 'Riwayat Pesanan Saya' }}">
    
    @if (session('success'))
        <div class="bg-green-50 border border-green-500 text-green-700 px-4 py-3 text-sm mb-6 rounded-xl flex items-center gap-2">
            <i class="ph-fill ph-check-circle text-lg"></i> {{ session('success') }}
        </div>
    @endif

    @if(!Gate::allows('admin-access'))
        <div class="bg-blue-50 border border-blue-200 rounded-2xl p-6 mb-4 flex flex-col lg:flex-row items-center gap-6 shadow-sm">
            <div class="bg-white p-3 rounded-xl shadow-sm flex-shrink-0 flex flex-col items-center border border-zinc-100">
                <img src="https://upload.wikimedia.org/wikipedia/commons/a/a2/Logo_QRIS.svg" alt="QRIS" class="w-24 h-8 object-contain mb-2">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=Pembayaran+FloraLoka" alt="QR Code" class="w-20 h-20">
            </div>
            
            <div class="flex-grow w-full">
                <h3 class="text-lg font-bold text-blue-900 mb-1">Informasi Pembayaran</h3>
                <p class="text-sm text-blue-700 mb-4">Silakan lakukan pembayaran untuk pesanan berstatus <span class="font-bold bg-yellow-100 text-yellow-800 px-2 py-0.5 rounded text-xs">PENDING</span> ke salah satu rekening resmi FloraLoka berikut:</p>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-white px-4 py-3 rounded-xl border border-blue-100 flex items-center gap-3 shadow-sm hover:border-blue-300 transition">
                        <i class="ph-fill ph-bank text-3xl text-blue-600"></i>
                        <div>
                            <p class="text-xs text-zinc-500 font-semibold uppercase">Bank BCA</p>
                            <p class="font-bold text-zinc-800 tracking-wider">8732-9011-22</p>
                            <p class="text-[10px] text-zinc-400 font-medium">a.n. FloraLoka Official</p>
                        </div>
                    </div>
                    
                    <div class="bg-white px-4 py-3 rounded-xl border border-blue-100 flex items-center gap-3 shadow-sm hover:border-green-300 transition">
                        <i class="ph-fill ph-wallet text-3xl text-green-500"></i>
                        <div>
                            <p class="text-xs text-zinc-500 font-semibold uppercase">GoPay / DANA</p>
                            <p class="font-bold text-zinc-800 tracking-wider">0812-3456-7890</p>
                            <p class="text-[10px] text-zinc-400 font-medium">a.n. FloraLoka Official</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="bg-white border border-zinc-200 shadow-sm rounded-b-2xl overflow-hidden mb-10">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left text-zinc-600">
                <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 border-b border-zinc-200">
                    <tr>
                        <th class="px-6 py-4">ID Pesanan</th>
                        @can('admin-access')
                            <th class="px-6 py-4">Pelanggan & Alamat</th>
                        @endcan
                        <th class="px-6 py-4">Item Tanaman</th>
                        <th class="px-6 py-4">Total Bayar</th>
                        <th class="px-6 py-4">Status & Bukti Bayar</th>
                        @can('admin-access')
                            <th class="px-6 py-4 text-center">Aksi (Admin)</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pesanans as $pesanan)
                        <tr class="border-b border-zinc-100 hover:bg-zinc-50/50">
                            <td class="px-6 py-4 font-bold text-zinc-900 align-top">#ORD-{{ str_pad($pesanan->id, 4, '0', STR_PAD_LEFT) }}</td>
                            
                            @can('admin-access')
                                <td class="px-6 py-4 align-top">
                                    <div class="font-bold text-zinc-800">{{ $pesanan->user->name }}</div>
                                    <div class="text-xs text-zinc-500 mt-1"><i class="ph-fill ph-phone"></i> {{ $pesanan->user->no_hp ?? '-' }}</div>
                                    <div class="text-xs text-zinc-500 mt-1 line-clamp-2 max-w-xs"><i class="ph-fill ph-map-pin"></i> {{ $pesanan->user->alamat ?? '-' }}</div>
                                </td>
                            @endcan

                            <td class="px-6 py-4 align-top">
                                @foreach ($pesanan->detailPesanans as $detail)
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="font-bold text-green-700 bg-green-100 px-1.5 py-0.5 rounded text-xs">{{ $detail->jumlah }}x</span>
                                        <span>{{ $detail->tanaman->nama_tanaman ?? 'Tanaman Dihapus' }}</span>
                                    </div>
                                @endforeach
                            </td>

                            <td class="px-6 py-4 font-bold text-zinc-800 align-top">
                                Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4 align-top">
                                @php
                                    $color = match($pesanan->status) {
                                        'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                        'menunggu_verifikasi' => 'bg-orange-100 text-orange-800 border-orange-200',
                                        'dibayar' => 'bg-blue-100 text-blue-800 border-blue-200',
                                        'dikirim' => 'bg-purple-100 text-purple-800 border-purple-200',
                                        'selesai' => 'bg-green-100 text-green-800 border-green-200',
                                        default => 'bg-zinc-100 text-zinc-800 border-zinc-200'
                                    };
                                @endphp
                                <span class="px-2.5 py-1 text-[10px] font-bold uppercase rounded border {{ $color }} block w-max mb-2 shadow-sm">
                                    {{ str_replace('_', ' ', $pesanan->status) }}
                                </span>

                                @if(!Gate::allows('admin-access'))
                                    @if($pesanan->bukti_bayar)
                                        <a href="{{ asset('storage/' . $pesanan->bukti_bayar) }}" target="_blank" class="text-[11px] font-bold text-blue-600 hover:underline flex items-center gap-1 mb-2">
                                            <i class="ph-fill ph-receipt"></i> Bukti Saat Ini
                                        </a>
                                    @endif

                                    @if(in_array($pesanan->status, ['pending', 'menunggu_verifikasi']))
                                        <form action="{{ route('pesanan.bukti', $pesanan->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-2">
                                            @csrf
                                            <input type="file" name="bukti_bayar" accept="image/*" required class="text-[10px] file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:font-semibold file:bg-zinc-100 file:text-zinc-700 w-full max-w-[180px] border border-zinc-200 rounded">
                                            <button type="submit" class="bg-green-600 text-white text-[10px] font-bold py-1.5 px-3 rounded hover:bg-green-700 w-max cursor-pointer transition">
                                                {{ $pesanan->bukti_bayar ? 'Upload Ulang Bukti' : 'Upload Bukti' }}
                                            </button>
                                        </form>
                                    @endif
                                @endif

                                @if(Gate::allows('admin-access'))
                                    @if($pesanan->bukti_bayar)
                                        <a href="{{ asset('storage/' . $pesanan->bukti_bayar) }}" target="_blank" class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 border border-blue-200 px-2 py-1.5 rounded text-[10px] font-bold hover:bg-blue-100 transition mt-1 w-max">
                                            <i class="ph-fill ph-receipt text-sm"></i> Lihat Bukti
                                        </a>
                                    @else
                                        <span class="inline-block text-[10px] text-zinc-400 font-medium italic mt-1">Belum ada bukti</span>
                                    @endif
                                @endif
                            </td>

                            @can('admin-access')
                                <td class="px-6 py-4">
                                    <form action="{{ route('pesanan.update', $pesanan->id) }}" method="POST" class="flex items-center justify-center gap-2">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="text-xs border border-zinc-300 rounded px-2 py-1.5 outline-none focus:border-green-500">
                                            <option value="pending" {{ $pesanan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="menunggu_verifikasi" {{ $pesanan->status == 'menunggu_verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                                            <option value="dibayar" {{ $pesanan->status == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                                            <option value="dikirim" {{ $pesanan->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                            <option value="selesai" {{ $pesanan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                        <button type="submit" class="bg-zinc-800 text-white p-1.5 rounded hover:bg-green-600 transition cursor-pointer">
                                            <i class="ph ph-check-fat"></i>
                                        </button>
                                    </form>
                                </td>
                            @endcan
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ Gate::allows('admin-access') ? 6 : 5 }}" class="px-6 py-16 text-center">
                                <div class="bg-zinc-50 inline-block p-4 rounded-full mb-3">
                                    <i class="ph-fill ph-receipt text-4xl text-zinc-400"></i>
                                </div>
                                <h3 class="text-zinc-800 font-bold mb-1">Belum Ada Pesanan</h3>
                                <p class="text-zinc-500 text-sm">Transaksi yang masuk akan ditampilkan di sini.</p>
                            </td>
                        </tr>
                    @endempty
                </tbody>
            </table>
        </div>
    </div>
</x-default-layout>