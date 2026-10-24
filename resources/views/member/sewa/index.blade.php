@extends('layouts.app')

@section('title', 'Sewa Saya')

@section('content')
<section>
    <p class="text-sm text-gray-500 mb-4">Total {{ $inventaris->total() }} barang</p>
    @php
        $warna = [
            'Menunggu' => 'bg-yellow-100 text-yellow-700',
            'Disetujui' => 'bg-blue-100 text-blue-700',
            'Berjalan' => 'bg-indigo-100 text-indigo-700',
            'Selesai'  => 'bg-green-100 text-green-700',
            'Ditolak'  => 'bg-red-100 text-red-700',
        ];
    @endphp

    <div class="bg-white border rounded-xl shadow-sm overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-500 text-left">
                <tr>
                    <th class="px-5 py-3">Kode</th>
                    <th class="px-5 py-3">Alat</th>
                    <th class="px-5 py-3">Periode</th>
                    <th class="px-5 py-3">Lokasi</th>
                    <th class="px-5 py-3 text-right">Total</th>
                    <th class="px-5 py-3">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse ($riwayat as $r)
                    <tr class="hover:bg-gray-50">
                        <td class="px-5 py-3 font-mono">{{ $r['kode'] }}</td>
                        <td class="px-5 py-3 font-medium">{{ $r['alat'] }}</td>
                        <td class="px-5 py-3">{{ $r['mulai'] }} s/d {{ $r['selesai'] }}</td>
                        <td class="px-5 py-3">{{ $r['lokasi'] }}</td>
                        <td class="px-5 py-3 text-right">Rp {{ number_format($r['total'], 0, ',', '.') }}</td>
                        <td class="px-5 py-3">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $warna[$r['status']] ?? 'bg-gray-100' }}">
                                {{ $r['status'] }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-5 py-8 text-center text-gray-400">Belum ada penyewaan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection