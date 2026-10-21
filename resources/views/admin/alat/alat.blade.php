@extends('layouts.admin')

@section('title', 'Katalog Alat')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-500">Total {{ count($alat) }} unit</p>
    <a href="{{ route('admin.alat.create') }}" class="bg-yellow-400 text-gray-900 text-sm font-semibold px-4 py-2 rounded-lg hover:bg-yellow-300">
        + Tambah Alat
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-500 text-left">
            <tr>
                <th class="px-5 py-3">Foto</th>
                <th class="px-5 py-3">Nama</th>
                <th class="px-5 py-3">Merek</th>
                <th class="px-5 py-3">Kapasitas</th>
                <th class="px-5 py-3 text-right">Harga / Hari</th>
                <th class="px-5 py-3">Status</th>
                <th class="px-5 py-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @foreach ($alat as $unit)
                <tr class="hover:bg-gray-50">
                    <td class="px-5 py-3">
                        <div class="w-14 h-10 bg-gray-200 rounded flex items-center justify-center text-[10px] text-gray-400">Foto</div>
                    </td>
                    <td class="px-5 py-3 font-medium">{{ $unit['nama'] }}</td>
                    <td class="px-5 py-3">{{ $unit['merek'] }}</td>
                    <td class="px-5 py-3">{{ $unit['kapasitas'] }}</td>
                    <td class="px-5 py-3 text-right">Rp {{ number_format($unit['harga'], 0, ',', '.') }}</td>
                    <td class="px-5 py-3">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                            {{ $unit['tersedia'] ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $unit['tersedia'] ? 'Tersedia' : 'Disewa' }}
                        </span>
                    </td>
                    <td class="px-5 py-3 text-center space-x-2 whitespace-nowrap">
                        <button class="text-blue-600 hover:underline">Edit</button>
                        <button class="text-red-600 hover:underline" onclick="return confirm('Hapus {{ $unit['nama'] }}?')">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection