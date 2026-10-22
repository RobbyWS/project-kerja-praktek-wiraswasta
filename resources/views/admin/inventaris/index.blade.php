@extends('layouts.admin')

@section('title', 'Inventaris')

@section('content')

    @php
        $habis   = collect($inventaris)->where('jumlah', 0)->count();
        $menipis = collect($inventaris)->filter(fn ($b) => $b['jumlah'] > 0 && $b['jumlah'] <= $b['minimum'])->count();
        $kategori = collect($inventaris)->pluck('kategori')->unique()->sort()->values();
    @endphp

    {{-- Ringkasan stok --}}
    <div class="grid gap-4 sm:grid-cols-3 mb-6">
        <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-gray-800">
            <p class="text-sm text-gray-500">Jenis Barang</p>
            <p class="text-3xl font-bold mt-1">{{ count($inventaris) }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-yellow-400">
            <p class="text-sm text-gray-500">Stok Menipis</p>
            <p class="text-3xl font-bold mt-1">{{ $menipis }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-red-500">
            <p class="text-sm text-gray-500">Stok Habis</p>
            <p class="text-3xl font-bold mt-1">{{ $habis }}</p>
        </div>
    </div>

    {{-- Toolbar --}}
    <div class="flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between mb-4">
        <div class="flex flex-col sm:flex-row gap-3">
            <input id="cari" type="text" placeholder="Cari nama / kode barang..."
                   class="border rounded-lg px-3 py-2 text-sm w-full sm:w-64 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            <select id="filter-kategori"
                    class="border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                <option value="">Semua kategori</option>
                @foreach ($kategori as $k)
                    <option value="{{ $k }}">{{ $k }}</option>
                @endforeach
            </select>
        </div>
        <a href="{{ route('admin.inventaris.create') }}"
           class="bg-yellow-400 text-gray-900 text-sm font-semibold px-4 py-2 rounded-lg hover:bg-yellow-300 text-center">
            + Tambah Barang
        </a>
    </div>

    {{-- Tabel barang --}}
    <div class="bg-white rounded-xl shadow-sm overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-500 text-left">
                <tr>
                    <th class="px-5 py-3">Kode</th>
                    <th class="px-5 py-3">Nama Barang</th>
                    <th class="px-5 py-3">Kategori</th>
                    <th class="px-5 py-3 text-right">Jumlah</th>
                    <th class="px-5 py-3">Lokasi</th>
                    <th class="px-5 py-3">Tgl Masuk</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="tabel-barang" class="divide-y">
                @forelse ($inventaris as $b)
                    @php
                        if ($b['jumlah'] == 0) {
                            [$label, $warna] = ['Habis', 'bg-red-100 text-red-700'];
                        } elseif ($b['jumlah'] <= $b['minimum']) {
                            [$label, $warna] = ['Menipis', 'bg-yellow-100 text-yellow-700'];
                        } else {
                            [$label, $warna] = ['Aman', 'bg-green-100 text-green-700'];
                        }
                    @endphp
                    <tr class="hover:bg-gray-50"
                        data-cari="{{ strtolower($b['kode'] . ' ' . $b['nama']) }}"
                        data-kategori="{{ $b['kategori'] }}">
                        <td class="px-5 py-3 font-mono">{{ $b['kode'] }}</td>
                        <td class="px-5 py-3 font-medium">{{ $b['nama'] }}</td>
                        <td class="px-5 py-3">{{ $b['kategori'] }}</td>
                        <td class="px-5 py-3 text-right">
                            {{ $b['jumlah'] }} <span class="text-gray-400">{{ $b['satuan'] }}</span>
                            <p class="text-[10px] text-gray-400">min. {{ $b['minimum'] }}</p>
                        </td>
                        <td class="px-5 py-3">{{ $b['lokasi'] }}</td>
                        <td class="px-5 py-3">{{ $b['tanggal'] }}</td>
                        <td class="px-5 py-3">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $warna }}">{{ $label }}</span>
                        </td>
                        <td class="px-5 py-3 text-center space-x-2 whitespace-nowrap">
                            <button class="text-blue-600 hover:underline">Edit</button>
                            <button class="text-red-600 hover:underline" onclick="return confirm('Hapus {{ $b['nama'] }}?')">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="px-5 py-8 text-center text-gray-400">Belum ada barang di inventaris.</td></tr>
                @endforelse
                <tr id="kosong" class="hidden">
                    <td colspan="8" class="px-5 py-8 text-center text-gray-400">Tidak ada barang yang cocok.</td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        const cari     = document.getElementById('cari');
        const kategori = document.getElementById('filter-kategori');

        function saring() {
            const kata = cari.value.toLowerCase();
            const kat  = kategori.value;
            let tampil = 0;

            document.querySelectorAll('#tabel-barang tr[data-cari]').forEach(baris => {
                const cocok = baris.dataset.cari.includes(kata) && (!kat || baris.dataset.kategori === kat);
                baris.classList.toggle('hidden', !cocok);
                if (cocok) tampil++;
            });

            document.getElementById('kosong').classList.toggle('hidden', tampil > 0);
        }

        cari.addEventListener('input', saring);
        kategori.addEventListener('change', saring);
    </script>

@endsection