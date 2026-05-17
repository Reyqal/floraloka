<x-auth-layout title="Daftar Akun - FloraLoka" section_title="Buat Akun Baru" section_description="Daftar sekarang untuk mulai melengkapi koleksi tanaman hiasmu">
    
    <form action="{{ route('auth.store') }}" method="POST" class="flex flex-col gap-4 mt-2">
        @csrf
        @method('POST')

        <div class="flex flex-col gap-1.5">
            <label for="name" class="font-semibold text-xs text-zinc-700 uppercase tracking-wider">Nama Lengkap</label>
            <div class="relative">
                <i class="ph ph-user absolute left-3 top-1/2 -translate-y-1/2 text-zinc-400 text-lg"></i>
                <input type="text" id="name" name="name" 
                       class="w-full pl-10 pr-4 py-2.5 border border-zinc-200 rounded-xl bg-zinc-50 text-sm outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-600 transition" 
                       placeholder="Masukkan nama lengkap Anda" value="{{ old('name') }}">
            </div>
            @error('name')
                <div class="text-red-500 text-xs font-medium mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex flex-col gap-1.5">
            <label for="email" class="font-semibold text-xs text-zinc-700 uppercase tracking-wider">Alamat Email</label>
            <div class="relative">
                <i class="ph ph-envelope absolute left-3 top-1/2 -translate-y-1/2 text-zinc-400 text-lg"></i>
                <input type="email" id="email" name="email" 
                       class="w-full pl-10 pr-4 py-2.5 border border-zinc-200 rounded-xl bg-zinc-50 text-sm outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-600 transition" 
                       placeholder="contoh@gmail.com" value="{{ old('email') }}">
            </div>
            @error('email')
                <div class="text-red-500 text-xs font-medium mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex flex-col gap-1.5">
            <label for="password" class="font-semibold text-xs text-zinc-700 uppercase tracking-wider">Password</label>
            <div class="relative">
                <i class="ph ph-lock absolute left-3 top-1/2 -translate-y-1/2 text-zinc-400 text-lg"></i>
                <input type="password" id="password" name="password" 
                       class="w-full pl-10 pr-4 py-2.5 border border-zinc-200 rounded-xl bg-zinc-50 text-sm outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-600 transition" 
                       placeholder="Buat password aman Anda">
            </div>
            @error('password')
                <div class="text-red-500 text-xs font-medium mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex flex-col gap-1.5">
            <label for="confirm_password" class="font-semibold text-xs text-zinc-700 uppercase tracking-wider">Konfirmasi Password</label>
            <div class="relative">
                <i class="ph ph-lock-keyhole absolute left-3 top-1/2 -translate-y-1/2 text-zinc-400 text-lg"></i>
                <input type="password" id="confirm_password" name="confirm_password" 
                       class="w-full pl-10 pr-4 py-2.5 border border-zinc-200 rounded-xl bg-zinc-50 text-sm outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-600 transition" 
                       placeholder="Ulangi password Anda">
            </div>
            @error('confirm_password')
                <div class="text-red-500 text-xs font-medium mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="w-full bg-green-600 border border-green-700 text-white py-3 rounded-xl text-center text-sm font-semibold cursor-pointer mt-4 hover:bg-green-700 transition shadow-sm flex items-center justify-center gap-2">
            <i class="ph ph-user-plus text-lg"></i>
            <span>Daftar Akun Baru</span>
        </button>

        <p class="text-zinc-500 text-xs text-center mt-2">
            Sudah memiliki akun FloraLoka? 
            <a href="{{ route('auth.login') }}" class="text-green-600 font-bold hover:underline transition">Masuk Disini</a>
        </p>
    </form>
</x-auth-layout>