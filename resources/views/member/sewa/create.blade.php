@extends('layouts.app')

@section('title', 'Sewa ' . $unit['nama'])

@section('content')
<section class="max-w-5xl mx-auto px-4 py-10">
    <a href="{{ url('/#katalog') }}" class="text-sm text-gray-500 hover:text-yellow-600">&larr; Kembali ke katalog</a>
    <h1 class="text-2xl font-bold mt-3 mb-6">Form Penyewaan</h1>

    <div class="grid md:grid-cols-5 gap-8">

        {{-- Info unit --}}
        <div class="md:col-span-2">
            <div class="rounded-xl border overflow-hidden shadow-sm">
                <div class="h-48 bg-gray-200 flex items-center justify-center text-gray-400 text-sm">Foto {{ $unit['nama'] }}</div>
                <div class="p-5 space-y-1 text-sm">
                    <h2 class="text-lg font-bold">{{ $unit['nama'] }}</h2>
                    <p class="text-gray-500">Merek: {{ $unit['merek'] }}</p>
                    <p class="text-gray-500">Kapasitas: {{ $unit['kapasitas'] }}</p>
                    <p class="text-xl font-bold pt-2">
                        Rp {{ number_format($unit['harga'], 0, ',', '.') }}
                        <span class="text-sm font-normal text-gray-500">/ hari</span>
                    </p>
                </div>
            </div>
        </div>

        {{-- Form --}}
        <form id="form-sewa" class="md:col-span-3 bg-white rounded-xl border shadow-sm p-6 space-y-5">
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Tanggal Mulai</label>
                    <input id="mulai" type="date" min="{{ date('Y-m-d') }}" required
                           class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Tanggal Selesai</label>
                    <input id="selesai" type="date" min="{{ date('Y-m-d') }}" required
                           class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Lokasi Proyek</label>
                <textarea rows="2" required placeholder="Alamat lengkap lokasi proyek"
                          class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Catatan (opsional)</label>
                <textarea rows="3" placeholder="Contoh: butuh operator, jam kerja, dsb."
                          class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400"></textarea>
            </div>

            {{-- Estimasi biaya --}}
            <div class="bg-gray-50 rounded-lg p-4 text-sm space-y-1">
                <div class="flex justify-between"><span class="text-gray-500">Harga per hari</span><span>Rp {{ number_format($unit['harga'], 0, ',', '.') }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">Durasi</span><span id="durasi">-</span></div>
                <div class="flex justify-between font-bold text-base pt-2 border-t"><span>Estimasi Total</span><span id="total">-</span></div>
            </div>

            <button type="submit" class="w-full bg-yellow-400 text-gray-900 font-semibold py-3 rounded-lg hover:bg-yellow-300">
                Ajukan Sewa
            </button>
        </form>
    </div>
</section>

<script>
    const harga   = {{ $unit['harga'] }};
    const mulai   = document.getElementById('mulai');
    const selesai = document.getElementById('selesai');

    function hitung() {
        const durasi = document.getElementById('durasi');
        const total  = document.getElementById('total');
        if (!mulai.value || !selesai.value) { durasi.textContent = '-'; total.textContent = '-'; return; }

        const hari = Math.floor((new Date(selesai.value) - new Date(mulai.value)) / 86400000) + 1;
        if (hari < 1) { durasi.textContent = 'Tanggal tidak valid'; total.textContent = '-'; return; }

        durasi.textContent = hari + ' hari';
        total.textContent  = 'Rp ' + (hari * harga).toLocaleString('id-ID');
    }

    mulai.addEventListener('change', () => { selesai.min = mulai.value; hitung(); });
    selesai.addEventListener('change', hitung);

    document.getElementById('form-sewa').addEventListener('submit', e => {
        e.preventDefault();
        alert('UI saja — proses simpan belum dibuat.');
        // code submit
    });
</script>
@endsection