@props(['title' => 'FloraLoka - Toko Tanaman Hias', 'section_title' => ''])

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/fill/style.css" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-white text-zinc-800 antialiased min-h-screen flex flex-col">

    <nav class="bg-white border-b border-zinc-100 sticky top-0 z-50 shadow-sm relative">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            
            <a href="{{ route('beranda') }}" class="flex items-center gap-2 font-bold text-zinc-800 text-xl tracking-tight hover:text-green-600 transition">
                <i class="ph-fill ph-plant text-3xl text-green-600"></i>
                FloraLoka
            </a>

            <div class="hidden md:flex items-center gap-8 font-medium text-sm">
                @auth
                    @can('admin-access')
                        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'text-green-600 font-bold' : 'text-zinc-600 hover:text-green-600' }} transition">Dashboard</a>
                        <a href="{{ route('tanaman.index') }}" class="{{ request()->routeIs('tanaman.*') ? 'text-green-600 font-bold' : 'text-zinc-600 hover:text-green-600' }} transition">Kelola Katalog</a>
                        <a href="{{ route('pesanan.index') }}" class="{{ request()->routeIs('pesanan.*') ? 'text-green-600 font-bold' : 'text-zinc-600 hover:text-green-600' }} transition">Pesanan Masuk</a>
                    @else
                        <a href="{{ route('tanaman.index') }}" class="{{ request()->routeIs('tanaman.*') ? 'text-green-600 font-bold' : 'text-zinc-600 hover:text-green-600' }} transition">Katalog</a>
                        <a href="{{ route('pesanan.index') }}" class="{{ request()->routeIs('pesanan.*') ? 'text-green-600 font-bold' : 'text-zinc-600 hover:text-green-600' }} transition">Pesanan Saya</a>
                    @endcan
                @endauth

                @guest
                    <a href="{{ route('beranda') }}" class="{{ request()->routeIs('beranda') ? 'text-green-600 font-bold' : 'text-zinc-600 hover:text-green-600' }} transition">Beranda</a>
                    <a href="{{ route('tanaman.index') }}" class="{{ request()->routeIs('tanaman.*') ? 'text-green-600 font-bold' : 'text-zinc-600 hover:text-green-600' }} transition">Katalog</a>
                    <a href="{{ route('tentang-kami') }}" class="{{ request()->routeIs('tentang-kami') ? 'text-green-600 font-bold' : 'text-zinc-600 hover:text-green-600' }} transition">Tentang Kami</a>
                @endguest
            </div>

            <div class="flex items-center gap-4">
                
                <div class="hidden md:flex items-center gap-4">
                    @guest
                        <a href="{{ route('auth.login') }}" class="bg-green-600 text-white px-6 py-2.5 text-sm font-medium rounded-full hover:bg-green-700 transition shadow-sm">Masuk</a>
                    @endguest

                    @auth
                        <div class="flex items-center gap-4 border-l border-zinc-200 pl-6">
                            <a href="{{ route('profile.index') ?? '#' }}" class="text-sm font-medium text-zinc-700 hidden sm:block hover:text-green-600">Hai, {{ Auth::user()->name }}</a>
                            
                            <form action="{{ route('auth.logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-red-50 text-red-600 px-4 py-2 text-sm font-medium rounded-full hover:bg-red-100 transition cursor-pointer">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>

                <button id="mobile-menu-btn" class="md:hidden text-2xl text-zinc-800 focus:outline-none p-1 hover:bg-zinc-50 rounded-lg transition">
                    <i class="ph ph-list"></i>
                </button>

            </div>
        </div>
        
        <div id="mobile-menu" class="hidden absolute top-20 left-0 w-full bg-white border-b border-zinc-100 shadow-lg flex flex-col p-6 gap-4 z-50 md:hidden">
            @auth
                <div class="flex items-center gap-3 bg-zinc-50 p-3 rounded-xl mb-2 border border-zinc-100">
                    <a href="{{ route('profile.index') ?? '#' }}" class="font-medium text-sm text-zinc-700 hover:text-green-600 py-2"> Hai, {{ Auth::user()->name }}</a>
                </div>

                @can('admin-access')
                    <a href="{{ route('admin.dashboard') }}" class="font-medium text-sm text-zinc-700 hover:text-green-600 py-2">Dashboard</a>
                    <a href="{{ route('tanaman.index') }}" class="font-medium text-sm text-zinc-700 hover:text-green-600 py-2">Kelola Katalog</a>
                    <a href="{{ route('pesanan.index') }}" class="font-medium text-sm text-zinc-700 hover:text-green-600 py-2">Pesanan Masuk</a>
                @else
                    <a href="{{ route('tanaman.index') }}" class="font-medium text-sm text-zinc-700 hover:text-green-600 py-2">Katalog</a>
                    <a href="{{ route('pesanan.index') }}" class="font-medium text-sm text-zinc-700 hover:text-green-600 py-2">Pesanan Saya</a>
                @endcan
                
                <form method="POST" action="{{ route('auth.logout') }}" class="mt-2 border-t border-zinc-100 pt-4">
                    @csrf
                    <button type="submit" class="w-full text-center text-sm font-bold bg-red-50 text-red-600 py-3 rounded-xl">
                        Logout
                    </button>
                </form>
            @endauth

            @guest
                <a href="{{ route('beranda') }}" class="font-medium text-sm text-zinc-700 hover:text-green-600 py-2">Beranda</a>
                <a href="{{ route('tanaman.index') }}" class="font-medium text-sm text-zinc-700 hover:text-green-600 py-2">Katalog</a>
                <a href="{{ route('tentang-kami') }}" class="font-medium text-sm text-zinc-700 hover:text-green-600 py-2">Tentang Kami</a>
                
                <div class="mt-2 border-t border-zinc-100 pt-4">
                    <a href="{{ route('auth.login') }}" class="block w-full text-center text-sm font-bold bg-green-600 text-white py-3 rounded-xl shadow-sm">Masuk / Daftar</a>
                </div>
            @endguest
        </div>
    </nav>

    <main class="flex-grow pb-10">
        {{ $slot }}
    </main>

    <footer class="bg-zinc-50 border-t border-zinc-200 mt-20 py-8 text-center text-sm text-zinc-500">
        &copy; 2026 FloraLoka. Proyek UAS Pemrograman Web.
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const menuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');

            if (menuBtn && mobileMenu) {
                menuBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    mobileMenu.classList.toggle('hidden');
                });

                document.addEventListener('click', function (e) {
                    if (!mobileMenu.classList.contains('hidden') && !mobileMenu.contains(e.target) && e.target !== menuBtn) {
                        mobileMenu.classList.add('hidden');
                    }
                });
            }
        });
    </script>

</body>
</html>