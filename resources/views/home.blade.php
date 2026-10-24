@extends('layouts.app')

@section('content')

    {{-- Hero --}}
    <section id="beranda" class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32 grid md:grid-cols-2 gap-10 items-center">
            <div>
                <span class="inline-block bg-yellow-400/10 text-yellow-400 text-xs font-semibold px-3 py-1 rounded-full mb-4">
                    Solusi Alat Berat Proyek Anda
                </span>
                <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-6">
                    Alat Berat <span class="text-yellow-400">Andal</span> untuk Setiap Proyek
                </h1>
                <p class="text-gray-300 mb-8">
                    Kami menyediakan berbagai unit alat berat berkualitas dengan operator berpengalaman
                    dan layanan yang responsif.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="#katalog" class="bg-yellow-400 text-gray-900 font-semibold px-6 py-3 rounded-lg hover:bg-yellow-300">
                        Lihat Katalog
                    </a>
                    <a href="#kontak" class="border border-gray-500 px-6 py-3 rounded-lg hover:border-yellow-400 hover:text-yellow-400">
                        Hubungi Kami lewat Chat
                    </a>
                </div>
            </div>
            <div class="hidden md:flex justify-center">
                <div class="w-full max-w-md aspect-square rounded-2xl bg-yellow-400/10 border-2 border-dashed border-yellow-400/40 flex items-center justify-center text-yellow-400/60 text-sm">
                    Foto alat berat perusahaan
                </div>
            </div>
        </div>
    </section>

    {{-- Keunggulan --}}
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="bg-white rounded-xl p-6 shadow-sm border-t-4 border-yellow-400">
                        <p class="text-3xl mb-3">🚜</p>
                        <h3 class="font-bold mb-1">Unit Terawat</h3>
                        <p class="text-sm text-gray-500">Perawatan rutin agar alat selalu siap kerja.</p>
                    </div>
                    <div class="bg-white rounded-xl p-6 shadow-sm border-t-4 border-yellow-400">
                        <p class="text-3xl mb-3">👷</p>
                        <h3 class="font-bold mb-1">Operator Ahli</h3>
                        <p class="text-sm text-gray-500">Operator berpengalaman dan bersertifikat.</p>
                    </div>
                                        <div class="bg-white rounded-xl p-6 shadow-sm border-t-4 border-yellow-400">
                        <p class="text-3xl mb-3">🚚</p>
                        <h3 class="font-bold mb-1">Pengiriman Cepat</h3>
                        <p class="text-sm text-gray-500">Mobilisasi unit tepat waktu ke lokasi proyek.</p>
                    </div>
                                        <div class="bg-white rounded-xl p-6 shadow-sm border-t-4 border-yellow-400">
                        <p class="text-3xl mb-3">📞</p>
                        <h3 class="font-bold mb-1">Respons Cepat</h3>
                        <p class="text-sm text-gray-500">Tim siap membantu kebutuhan Anda.</p>
                    </div>

            </div>
        </div>
    </section>

    {{-- Katalog --}}
    <section id="katalog" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-2">Katalog Alat Berat</h2>
                <p class="text-gray-500">Unit yang tersedia untuk kebutuhan proyek Anda</p>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($alat as $unit)
                    <div class="rounded-xl overflow-hidden shadow-sm border hover:shadow-lg transition">
                        <div class="h-48 bg-gray-200 flex items-center justify-center text-gray-400 text-sm">
                            Foto {{ $unit['nama'] }}
                        </div>
                        <div class="p-5">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="font-bold text-lg">{{ $unit['nama'] }}</h3>
                                <span class="text-xs px-2 py-1 rounded-full font-semibold
                                    {{ $unit['tersedia'] ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $unit['tersedia'] ? 'Tersedia' : 'Tidak Tersedia' }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-500 mb-1">Merek: {{ $unit['merek'] }}</p>
                            <p class="text-sm text-gray-500 mb-3">Kapasitas: {{ $unit['kapasitas'] }}</p>
                            <p class="text-lg font-bold mb-4">
                                Rp {{ number_format($unit['harga'], 0, ',', '.') }}
                                <span class="text-sm font-normal text-gray-500">/ hari</span>
                            </p>

                            @if ($unit['tersedia'])
                                <a href="{{ route('sewa.create', $unit['id']) }}"
                                class="block text-center bg-gray-900 text-white text-sm font-semibold py-2 rounded-lg hover:bg-yellow-400 hover:text-gray-900">
                                    Sewa Sekarang
                                </a>
                            @else
                                <button disabled class="block w-full text-center bg-gray-200 text-gray-400 text-sm font-semibold py-2 rounded-lg cursor-not-allowed">
                                    Sedang Disewa
                                </button>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-400">Belum ada data alat.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Tentang --}}
    <section id="tentang" class="py-20 bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-2 gap-12 items-center">
            <div class="aspect-video rounded-2xl bg-gray-800 flex items-center justify-center text-gray-500 text-sm">
                Foto kantor / lokasi usaha
            </div>
            <div>
                <h2 class="text-3xl font-bold mb-4">Tentang <span class="text-yellow-400">Kami</span></h2>
                <p class="text-gray-300 mb-4">
                    {{ config('app.name') }} merupakan usaha di bidang alat berat yang melayani kebutuhan
                    proyek konstruksi, pertambangan, dan pekerjaan tanah.
                </p>
                <p class="text-gray-300 mb-6">
                    Komitmen kami: unit terawat, pengiriman tepat waktu, dan pelayanan yang jujur.
                </p>
                <div class="grid grid-cols-3 gap-4 text-center">
                    <div>
                        <p class="text-3xl font-bold text-yellow-400">10+</p>
                        <p class="text-xs text-gray-400">Tahun Pengalaman</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-yellow-400">50+</p>
                        <p class="text-xs text-gray-400">Proyek Selesai</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-yellow-400">{{ count($alat) }}</p>
                        <p class="text-xs text-gray-400">Unit Alat</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- Ajakan Chat --}}
        <section id="kontak" class="py-20 bg-gray-50">
            <div class="max-w-3xl mx-auto px-4 text-center">
                <h2 class="text-3xl font-bold mb-3">Ada Pertanyaan?</h2>
                <p class="text-gray-500 mb-8">Konsultasikan kebutuhan alat berat Anda langsung dengan admin kami.</p>

                @guest
                    <a href="{{ route('login') }}" class="inline-block bg-yellow-400 text-gray-900 font-semibold px-8 py-3 rounded-lg hover:bg-yellow-300">
                        Masuk untuk Chat dengan Admin
                    </a>
                @endguest

                @auth
                    @if (auth()->user()->role === 'member')
                        <a href="{{ route('chat') }}" class="inline-block bg-yellow-400 text-gray-900 font-semibold px-8 py-3 rounded-lg hover:bg-yellow-300">
                            Chat dengan Admin
                        </a>
                    @endif
                @endauth
            </div>
        </section>

@endsection