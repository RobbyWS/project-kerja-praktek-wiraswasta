<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-800 min-h-screen flex flex-col">

    @php
        $menuPublik = [
            ['label' => 'Beranda',      'url' => url('/#beranda')],
            ['label' => 'Katalog',      'url' => url('/#katalog')],
            ['label' => 'Tentang Kami', 'url' => url('/#tentang')],
        ];
        $isMember = auth()->check() && auth()->user()->role === 'member';
        $isAdmin  = auth()->check() && auth()->user()->role === 'admin';
    @endphp

    <nav class="bg-gray-900 text-white sticky top-0 z-50 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
            <a href="{{ route('home') }}" class="text-xl font-bold text-yellow-400">{{ config('app.name') }}</a>

            <div class="hidden md:flex items-center gap-6 text-sm">
                @foreach ($menuPublik as $m)
                    <a href="{{ $m['url'] }}" class="hover:text-yellow-400">{{ $m['label'] }}</a>
                @endforeach

                @if ($isMember)
                    <a href="{{ route('sewa.index') }}" class="hover:text-yellow-400 {{ request()->routeIs('sewa.*') ? 'text-yellow-400' : '' }}">Sewa Saya</a>
                    <a href="{{ route('chat') }}" class="hover:text-yellow-400 {{ request()->routeIs('chat') ? 'text-yellow-400' : '' }}">Chat Admin</a>
                @endif

                @if ($isAdmin)
                    <a href="{{ route('admin.dashboard') }}" class="text-yellow-400 font-semibold">Panel Admin</a>
                @endif

                @guest
                    <a href="{{ route('login') }}" class="bg-yellow-400 text-gray-900 font-semibold px-4 py-2 rounded-lg hover:bg-yellow-300">Masuk</a>
                @endguest

                @auth
                    <span class="text-gray-400">Halo, {{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="border border-gray-600 px-4 py-2 rounded-lg hover:border-yellow-400 hover:text-yellow-400">Keluar</button>
                    </form>
                @endauth
            </div>

            <button id="menu-btn" class="md:hidden text-2xl" aria-label="Menu">&#9776;</button>
        </div>

        <div id="menu-mobile" class="hidden md:hidden px-4 pb-4 space-y-1 text-sm">
            @foreach ($menuPublik as $m)
                <a href="{{ $m['url'] }}" class="block py-2 hover:text-yellow-400">{{ $m['label'] }}</a>
            @endforeach
            @if ($isMember)
                <a href="{{ route('sewa.index') }}" class="block py-2 hover:text-yellow-400">Sewa Saya</a>
                <a href="{{ route('chat') }}" class="block py-2 hover:text-yellow-400">Chat Admin</a>
            @endif
            @if ($isAdmin)
                <a href="{{ route('admin.dashboard') }}" class="block py-2 text-yellow-400 font-semibold">Panel Admin</a>
            @endif
            @guest
                <a href="{{ route('login') }}" class="block py-2 text-yellow-400 font-semibold">Masuk</a>
            @endguest
            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="py-2 text-gray-400 hover:text-yellow-400">Keluar ({{ auth()->user()->name }})</button>
                </form>
            @endauth
        </div>
    </nav>

    <main class="flex-1">
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-gray-400">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 grid gap-8 md:grid-cols-3 text-sm">
            <div>
                <p class="text-lg font-bold text-yellow-400 mb-2">{{ config('app.name') }}</p>
                <p>Penyewaan alat berat terpercaya untuk kebutuhan proyek konstruksi Anda.</p>
            </div>
            <div>
                <p class="font-semibold text-white mb-2">Kontak</p>
                <p>Alamat perusahaan, Kota</p>
                <p>Telp: 08xx-xxxx-xxxx</p>
                <p>Email: info@perusahaan.com</p>
            </div>
            <div>
                <p class="font-semibold text-white mb-2">Jam Operasional</p>
                <p>Senin – Jumat: 08.00 – 17.00</p>
                <p>Sabtu: 08.00 – 12.00</p>
            </div>
        </div>
        <div class="border-t border-gray-800 py-4 text-center text-xs">
            &copy; {{ date('Y') }} {{ config('app.name') }}. Semua hak dilindungi.
        </div>
    </footer>

    <script>
        document.getElementById('menu-btn').addEventListener('click', () => {
            document.getElementById('menu-mobile').classList.toggle('hidden');
        });
    </script>
</body>
</html>