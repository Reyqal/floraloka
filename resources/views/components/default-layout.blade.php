@props(['title', 'section_title' => ''])

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    @vite(['resources/css/app.css', 'resources/js/app.js']) <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/fill/style.css" />
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
    
    <title>{{ $title }}</title>
</head>
<body class="bg-white text-zinc-800">
    <nav class="bg-white border-b border-zinc-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            
            <a href="{{ route('tanaman.index') }}" class="flex items-center gap-2 font-bold text-zinc-800 text-xl tracking-tight">
                <i class="ph-fill ph-plant text-3xl text-green-600"></i>
                FloraLoka
            </a>
            
            <div class="hidden md:flex items-center gap-8 font-medium text-sm">
                <a href="{{ route('beranda') }}" 
                class="{{ request()->routeIs('beranda') ? 'text-green-600 font-bold' : 'text-zinc-600 hover:text-green-600' }} transition">
                    Beranda
                </a>

                <a href="{{ route('tanaman.index') }}" 
                class="{{ request()->routeIs('tanaman.index') ? 'text-green-600 font-bold' : 'text-zinc-600 hover:text-green-600' }} transition">
                    Katalog
                </a>

                <a href="{{ route('tentang-kami') }}" 
                class="{{ request()->routeIs('tentang-kami') ? 'text-green-600 font-bold' : 'text-zinc-600 hover:text-green-600' }} transition">
                    Tentang Kami
                </a>
            </div>
            
            <div class="flex items-center gap-6">

                @guest
                    <a href="{{ route('auth.login') }}" class="bg-green-600 text-white px-6 py-2.5 text-sm font-medium rounded-full hover:bg-green-700 transition shadow-sm">
                        Masuk
                    </a>
                @endguest

                @auth
                    <div class="flex items-center gap-4 border-l border-zinc-200 pl-6">
                        <a href="{{ route('pesanan.index') }}" class="relative text-zinc-600 hover:text-green-600 transition" title="Pesanan Saya">
                            <i class="ph ph-receipt text-2xl"></i>
                        </a>

                        <a href="{{ route('profile.index') }}" class="text-sm font-medium text-zinc-700 hidden sm:block hover:text-green-600">Hai, {{ Auth::user()->name }}</a>
                        
                        <form action="{{ route('auth.logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-50 text-red-600 px-4 py-2 text-sm font-medium rounded-full hover:bg-red-100 transition cursor-pointer">
                                Logout
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    <footer class="bg-zinc-50 border-t border-zinc-200 mt-20 py-8 text-center text-sm text-zinc-500">
        &copy; 2026 FloraLoka. Proyek UAS Pemrograman Web.
    </footer>
</body>
</html>