<x-auth-layout title="Masuk - FloraLoka" section_title="Selamat Datang Kembali" section_description="Silakan masuk ke akun Anda untuk melanjutkan aktivitas belanja tanaman hias.">
    
    @if(session('error'))
        <div class="bg-red-50 border border-red-500 text-red-700 px-4 py-3 text-sm mb-5 rounded-xl flex items-center gap-2 shadow-sm">
            <i class="ph-fill ph-warning-circle text-lg"></i> 
            <span class="font-medium">{{ session('error') }}</span>
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-50 border border-green-500 text-green-700 px-4 py-3 text-sm mb-5 rounded-xl flex items-center gap-2 shadow-sm">
            <i class="ph-fill ph-check-circle text-lg"></i> 
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <form action="{{ route('auth.authenticate') }}" method="POST" class="flex flex-col gap-4 mt-2">
        @csrf

        <div class="flex flex-col gap-1.5">
            <label for="email" class="font-semibold text-xs text-zinc-700 uppercase tracking-wider">Alamat Email</label>
            <div class="relative">
                <i class="ph ph-envelope absolute left-3 top-1/2 -translate-y-1/2 text-zinc-400 text-lg"></i>
                <input type="email" id="email" name="email" 
                       class="w-full pl-10 pr-4 py-2.5 border border-zinc-200 rounded-xl bg-zinc-50 text-sm outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-600 transition" 
                       placeholder="contoh@gmail.com" value="{{ old('email') }}" required autofocus>
            </div>
            @error('email')
                <div class="text-red-500 text-xs font-medium mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex flex-col gap-1.5">
            <div class="flex justify-between items-center">
                <label for="password" class="font-semibold text-xs text-zinc-700 uppercase tracking-wider">Password</label>
            </div>
            <div class="relative">
                <i class="ph ph-lock absolute left-3 top-1/2 -translate-y-1/2 text-zinc-400 text-lg"></i>
                <input type="password" id="password" name="password" 
                       class="w-full pl-10 pr-4 py-2.5 border border-zinc-200 rounded-xl bg-zinc-50 text-sm outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-600 transition" 
                       placeholder="Masukkan password Anda" required>
            </div>
            @error('password')
                <div class="text-red-500 text-xs font-medium mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="w-full bg-green-600 border border-green-700 text-white py-3 rounded-xl text-center text-sm font-semibold cursor-pointer mt-4 hover:bg-green-700 transition shadow-sm flex items-center justify-center gap-2">
            <i class="ph ph-sign-in text-lg"></i>
            <span>Masuk ke Sistem</span>
        </button>

        <p class="text-zinc-500 text-xs text-center mt-3">
            Belum memiliki akun FloraLoka? 
            <a href="{{ route('auth.register') }}" class="text-green-600 font-bold hover:underline transition">Daftar Sekarang</a>
        </p>
    </form>
</x-auth-layout>