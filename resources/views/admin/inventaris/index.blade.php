@extends('layouts.admin')

@section('title', 'Inventaris Barang')

@section('content')
<section>
    <p class="text-sm text-gray-500 mb-4">Total {{ $inventaris->total() }} barang</p>

    @if (session('success'))
        <div class="mb-4 rounded-lg bg-green-100 text-green-700 px-4 py-3 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white border rounded-xl shadow-sm overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-600 text-left">
                <tr>
                    <th class="px-4 py-3 w-12 text-center">No</th>
                    <th class="px-4 py-3">Nama Barang</th>
                    <th class="px-4 py-3 text-center">Jumlah</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Diinput oleh</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse ($inventaris as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-center text-gray-500">
                            {{ $inventaris->firstItem() + $loop->index }}
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $item->nama_barang }}</td>
                        <td class="px-4 py-3 text-center">{{ $item->jumlah }}</td>
                        <td class="px-4 py-3">
                            @if ($item->nama_peminjam)
                                <span class="inline-block rounded-full bg-yellow-100 text-yellow-700 px-3 py-1 text-xs font-semibold">
                                    Dipinjam: {{ $item->nama_peminjam }}
                                </span>
                            @else
                                <span class="inline-block rounded-full bg-green-100 text-green-700 px-3 py-1 text-xs font-semibold">
                                    Tersedia
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-gray-600">{{ $item->user->name ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                            Belum ada data inventaris.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($inventaris->hasPages())
        <div class="mt-4">
            {{ $inventaris->links() }}
        </div>
    @endif
</section>
@endsection