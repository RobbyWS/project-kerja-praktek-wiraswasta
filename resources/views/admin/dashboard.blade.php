@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    <div class="bg-gray-900 text-white rounded-xl p-6 mb-6">
        <p class="text-sm text-gray-400">Selamat datang,</p>
        <h2 class="text-2xl font-bold text-yellow-400">{{ auth()->user()->name }}</h2>
        <p class="text-sm text-gray-300 mt-1">Panel admin PT. MARGODADI - kelola katalog alat berat dan balas pesan member dari sini.</p>
    </div>

    
    <div class="grid gap-4 sm:grid-cols-3">
        <a href="{{ route('admin.alat.index') }}"
           class="bg-white rounded-xl shadow-sm p-6 border-t-4 border-yellow-400 hover:shadow-md transition">
            <p class="text-3xl mb-2">🚜</p>
            <h3 class="font-bold">Katalog Alat</h3>
            <p class="text-sm text-gray-500">Lihat dan tambah unit alat berat.</p>
        </a>

        <a href="{{ route('admin.inventaris.index') }}"
           class="bg-white rounded-xl shadow-sm p-6 border-t-4 border-green-500 hover:shadow-md transition">
            <p class="text-3xl mb-2">📦</p>
            <h3 class="font-bold">Inventaris</h3>
            <p class="text-sm text-gray-500">Pantau ketersediaan unit.</p>
        </a>

        <a href="{{ route('admin.chat') }}"
           class="bg-white rounded-xl shadow-sm p-6 border-t-4 border-blue-500 hover:shadow-md transition">
            <p class="text-3xl mb-2">💬</p>
            <h3 class="font-bold">Chat</h3>
            <p class="text-sm text-gray-500">Balas pesan dari member.</p>
        </a>
    </div>

@endsection