@extends('layouts.admin')

@section('title', 'Tambah Barang')

@section('content')

    <a href="{{ route('admin.inventaris.index') }}" class="text-sm text-gray-500 hover:text-yellow-600">&larr; Kembali ke inventaris</a>

    <form id="form-barang" class="mt-4 bg-white rounded-xl shadow-sm p-6 grid gap-5 sm:grid-cols-2 max-w-4xl">

        <div>
            <label class="block text-sm font-medium mb-1">Kode Barang</label>
            <input type="text" required placeholder="Contoh: INV-007"
                   class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Nama Barang</label>
            <input type="text" required placeholder="Contoh: Filter Solar"
                   class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Kategori</label>
            <select required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                <option value="">-- Pilih kategori --</option>
                <option>Suku Cadang</option>
                <option>Pelumas</option>
                <option>Perkakas</option>
                <option>Perlengkapan K3</option>
                <option>Perlengkapan Kantor</option>
                <option>Lainnya</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Lokasi Penyimpanan</label>
            <input type="text" placeholder="Contoh: Gudang A - Rak 2"
                   class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block text-sm font-medium mb-1">Jumlah</label>
                <input type="number" min="0" required placeholder="0"
                       class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Satuan</label>
                <select class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    <option>pcs</option>
                    <option>set</option>
                    <option>liter</option>
                    <option>drum</option>
                    <option>pail</option>
                    <option>box</option>
                    <option>roll</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Stok Minimum</label>
            <input type="number" min="0" placeholder="Batas peringatan stok menipis"
                   class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Tanggal Masuk</label>
            <input type="date" value="{{ date('Y-m-d') }}"
                   class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>

        <div class="sm:col-span-2">
            <label class="block text-sm font-medium mb-1">Keterangan (opsional)</label>
            <textarea rows="3" placeholder="Contoh: kompatibel untuk Excavator PC200, pemasok, dll."
                      class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400"></textarea>
        </div>

        <div class="sm:col-span-2 flex justify-end gap-3">
            <a href="{{ route('admin.inventaris.index') }}" class="px-5 py-2 rounded-lg border text-sm hover:bg-gray-50">Batal</a>
            <button class="px-5 py-2 rounded-lg bg-yellow-400 text-gray-900 text-sm font-semibold hover:bg-yellow-300">Simpan</button>
        </div>
    </form>

    <script>
        document.getElementById('form-barang').addEventListener('submit', e => {
            e.preventDefault();
            alert('UI saja — proses simpan belum dibuat.');
        });
    </script>

@endsection