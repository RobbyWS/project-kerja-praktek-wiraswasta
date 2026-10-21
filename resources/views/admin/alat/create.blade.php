@extends('layouts.admin')

@section('title', 'Tambah Alat')

@section('content')
<a href="{{ route('admin.alat.index') }}" class="text-sm text-gray-500 hover:text-yellow-600">&larr; Kembali ke katalog</a>

<form id="form-alat" class="mt-4 bg-white rounded-xl shadow-sm p-6 grid gap-5 md:grid-cols-3">

    {{-- Foto --}}
    <div class="md:row-span-3">
        <label class="block text-sm font-medium mb-1">Foto Alat</label>
        <label for="foto" class="flex items-center justify-center aspect-square border-2 border-dashed rounded-xl cursor-pointer hover:border-yellow-400 overflow-hidden">
            <img id="preview" class="hidden w-full h-full object-cover" alt="Preview">
            <span id="placeholder" class="text-sm text-gray-400 text-center px-4">Klik untuk memilih foto<br>(JPG/PNG)</span>
        </label>
        <input id="foto" type="file" accept="image/*" class="hidden">
    </div>

    <div class="md:col-span-2 grid gap-5 sm:grid-cols-2">
        <div>
            <label class="block text-sm font-medium mb-1">Nama Alat</label>
            <input type="text" required placeholder="Contoh: Excavator"
                   class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Merek / Tipe</label>
            <input type="text" required placeholder="Contoh: Komatsu PC200"
                   class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Kapasitas</label>
            <input type="text" placeholder="Contoh: 20 ton"
                   class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Harga Sewa per Hari (Rp)</label>
            <input type="number" min="0" step="50000" required placeholder="3500000"
                   class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>
        <div class="sm:col-span-2">
            <label class="block text-sm font-medium mb-1">Status</label>
            <select class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                <option value="1">Tersedia</option>
                <option value="0">Disewa / Tidak Tersedia</option>
            </select>
        </div>
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Deskripsi</label>
        <textarea rows="4" placeholder="Spesifikasi, kondisi unit, ketentuan sewa, dll."
                  class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400"></textarea>
    </div>

    <div class="md:col-span-2 flex justify-end gap-3">
        <a href="{{ route('admin.alat.index') }}" class="px-5 py-2 rounded-lg border text-sm hover:bg-gray-50">Batal</a>
        <button class="px-5 py-2 rounded-lg bg-yellow-400 text-gray-900 text-sm font-semibold hover:bg-yellow-300">Simpan</button>
    </div>
</form>

<script>
    document.getElementById('foto').addEventListener('change', e => {
        const file = e.target.files[0];
        if (!file) return;
        const img = document.getElementById('preview');
        img.src = URL.createObjectURL(file);
        img.classList.remove('hidden');
        document.getElementById('placeholder').classList.add('hidden');
    });

    document.getElementById('form-alat').addEventListener('submit', e => {
        e.preventDefault();
        alert('UI saja — proses simpan belum dibuat.');
    });
</script>
@endsection