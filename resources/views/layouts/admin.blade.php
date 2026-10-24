<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
<div class="flex min-h-screen">

    <aside class="w-64 bg-gray-900 text-gray-300 flex-shrink-0 hidden md:flex md:flex-col">
        <div class="px-6 py-5 border-b border-gray-800">
            <span class="text-xl font-bold text-yellow-400">PT. MARGODADI</span>
            <p class="text-xs text-gray-500">Panel Admin</p>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1 text-sm">
            @php
                $menu = [
                    ['label' => 'Dashboard',    'url' => route('admin.dashboard'),        'pola' => 'admin'],
                    ['label' => 'Katalog Alat', 'url' => route('admin.alat.index'),       'pola' => 'admin/alat'],
                    ['label' => 'Inventaris',   'url' => route('admin.inventaris.index'), 'pola' => 'admin/inventaris'],
                    ['label' => 'Chat',         'url' => route('admin.chat'),             'pola' => 'admin/chat'],
                ];
            @endphp

            @foreach ($menu as $item)
                <a href="{{ $item['url'] }}"
                   class="block px-4 py-2 rounded-lg transition
                          {{ request()->is($item['pola'])
                                ? 'bg-yellow-400 text-gray-900 font-semibold'
                                : 'hover:bg-gray-800 hover:text-white' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="px-6 py-4 border-t border-gray-800 text-xs text-gray-500">
            &copy; {{ date('Y') }} PT. MARGODADI. All Rights Reserved.
        </div>
    </aside>

    <div class="flex-1 flex flex-col">
        <header class="bg-white shadow-sm px-6 py-4 flex items-center justify-between">
            <h1 class="text-lg font-semibold">@yield('title', 'Dashboard')</h1>
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" target="_blank" class="text-sm text-gray-500 hover:text-yellow-600">
                    Lihat Website
                </a>
                <span class="text-sm text-gray-600">{{ auth()->user()->name }}</span>
                <div class="w-9 h-9 rounded-full bg-yellow-400 flex items-center justify-center font-bold text-gray-900">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-sm text-red-500 hover:underline">Keluar</button>
                </form>
            </div>
        </header>

        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

</div>
</body>
</html>