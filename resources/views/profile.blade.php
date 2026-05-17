<x-default-layout title="Profil Saya - FloraLoka" section_title="Pengaturan Akun & Alamat Pengiriman">
    
    <div class="max-w-4xl mx-auto">
        @if (session('success'))
            <div class="bg-green-50 border border-green-500 text-green-600 px-4 py-3 text-sm mb-6 rounded-xl flex items-center gap-2">
                <i class="ph-fill ph-check-circle text-lg"></i> {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
            
            <div class="bg-zinc-50 border border-zinc-200 rounded-2xl p-6 text-center">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="ph ph-user text-4xl text-green-700"></i>
                </div>
                <h3 class="font-bold text-lg text-zinc-900">{{ $user->name }}</h3>
                <p class="text-xs text-zinc-400 mt-1 uppercase font-semibold tracking-wider bg-zinc-200/60 inline-block px-2.5 py-0.5 rounded-full border border-zinc-300">
                    {{ $user->role }}
                </p>
                <div class="h-[1px] bg-zinc-200 my-4"></div>
                <p class="text-zinc-500 text-xs flex items-center justify-center gap-1.5">
                    <i class="ph ph-envelope text-sm"></i> {{ $user->email }}
                </p>
            </div>

            <form action="{{ route('profile.update') }}" method="POST" class="md:col-span-2 bg-white border border-zinc-200 rounded-2xl p-6 sm:p-8 flex flex-col gap-5 shadow-sm">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="flex flex-col gap-2">
                        <label for="name" class="font-semibold text-sm text-zinc-700">Nama Lengkap</label>
                        <input type="text" id="name" name="name" class="px-3 py-2.5 border border-zinc-200 rounded-xl bg-zinc-50 text-sm outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-600 transition" value="{{ old('name', $user->name) }}">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="no_hp" class="font-semibold text-sm text-zinc-700">Nomor WhatsApp / HP</label>
                        <input type="text" id="no_hp" name="no_hp" class="px-3 py-2.5 border border-zinc-200 rounded-xl bg-zinc-50 text-sm outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-600 transition" placeholder="e.g. 0852xxxx" value="{{ old('no_hp', $user->no_hp) }}">
                        @error('no_hp') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="email" class="font-semibold text-sm text-zinc-700">Alamat Email Akun</label>
                    <input type="email" id="email" name="email" class="px-3 py-2.5 border border-zinc-200 rounded-xl bg-zinc-50 text-sm outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-600 transition" value="{{ old('email', $user->email) }}">
                    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label for="alamat" class="font-semibold text-sm text-zinc-700">Alamat Lengkap Pengiriman Tanaman</label>
                    <textarea id="alamat" name="alamat" rows="4" class="px-3 py-2.5 border border-zinc-200 rounded-xl bg-zinc-50 text-sm outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-600 transition placeholder-zinc-400" placeholder="Tuliskan alamat lengkap pengiriman rumah Anda (Nama jalan, nomor rumah, RT/RW, kecamatan, kota)...">{{ old('alamat', $user->alamat) }}</textarea>
                    @error('alamat') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="self-end bg-green-600 border border-green-700 text-white font-semibold py-2.5 px-6 rounded-xl text-sm shadow-sm hover:bg-green-700 transition cursor-pointer flex items-center gap-2">
                    <i class="ph ph-floppy-disk text-lg"></i>
                    <span>Simpan Perubahan Akun</span>
                </button>
            </form>
            
        </div>
    </div>
</x-default-layout>