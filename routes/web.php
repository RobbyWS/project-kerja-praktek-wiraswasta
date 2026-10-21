<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;

// Route::get('/', function () {
//     return view('home');
// });

$alat = [
    1 => ['id' => 1, 'nama' => 'Excavator',    'merek' => 'Komatsu PC200',  'kapasitas' => '20 ton',      'harga' => 3500000, 'tersedia' => true],
    2 => ['id' => 2, 'nama' => 'Bulldozer',    'merek' => 'Caterpillar D6', 'kapasitas' => '18 ton',      'harga' => 4000000, 'tersedia' => true],
    3 => ['id' => 3, 'nama' => 'Wheel Loader', 'merek' => 'Volvo L90',      'kapasitas' => '2,5 m³',      'harga' => 2800000, 'tersedia' => false],
    4 => ['id' => 4, 'nama' => 'Motor Grader', 'merek' => 'Komatsu GD535',  'kapasitas' => '3,7 m blade', 'harga' => 3200000, 'tersedia' => true],
    5 => ['id' => 5, 'nama' => 'Vibro Roller', 'merek' => 'Sakai SV512',    'kapasitas' => '10 ton',      'harga' => 2000000, 'tersedia' => true],
    6 => ['id' => 6, 'nama' => 'Dump Truck',   'merek' => 'Hino 500',       'kapasitas' => '24 m³',       'harga' => 1500000, 'tersedia' => false],
];

$chat = [
    ['dari' => 'member', 'isi' => 'Halo admin, apakah excavator tersedia untuk minggu depan?', 'waktu' => '09.12'],
    ['dari' => 'admin',  'isi' => 'Halo, tersedia. Untuk berapa hari dan lokasinya di mana?',   'waktu' => '09.15'],
    ['dari' => 'member', 'isi' => 'Sekitar 5 hari, lokasi proyek di Gresik.',                   'waktu' => '09.18'],
    ['dari' => 'admin',  'isi' => 'Baik, silakan ajukan lewat menu sewa, nanti kami proses.',   'waktu' => '09.20'],
];

// #region auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
// #endregion

// #region home routes
Route::get('/', function () use ($alat) {
    $keunggulan = [
        ['ikon' => '🚜', 'judul' => 'Unit Terawat',     'deskripsi' => 'Perawatan rutin agar alat selalu siap kerja.'],
        ['ikon' => '👷', 'judul' => 'Operator Ahli',    'deskripsi' => 'Operator berpengalaman dan bersertifikat.'],
        ['ikon' => '🚚', 'judul' => 'Pengiriman Cepat', 'deskripsi' => 'Mobilisasi unit tepat waktu ke lokasi proyek.'],
        ['ikon' => '📞', 'judul' => 'Respons Cepat',    'deskripsi' => 'Tim siap membantu kebutuhan Anda.'],
    ];

    return view('home', compact('keunggulan', 'alat'));
})->name('home');



Route::middleware(['auth', 'role:member'])->group(function () use ($alat, $chat) {
    Route::get('/sewa/{id}', function ($id) use ($alat) {
        abort_unless(isset($alat[$id]), 404);
        return view('member.sewa.create', ['unit' => $alat[$id]]);
    })->name('sewa.create');

    Route::get('/sewa-saya', function () {
        $riwayat = [
            ['kode' => 'SW-0003', 'alat' => 'Excavator',    'mulai' => '27-10-2026', 'selesai' => '31-10-2026', 'lokasi' => 'Gresik',   'total' => 17500000, 'status' => 'Menunggu'],
            ['kode' => 'SW-0002', 'alat' => 'Vibro Roller', 'mulai' => '10-10-2026', 'selesai' => '12-10-2026', 'lokasi' => 'Sidoarjo', 'total' => 6000000,  'status' => 'Berjalan'],
            ['kode' => 'SW-0001', 'alat' => 'Bulldozer',    'mulai' => '01-09-2026', 'selesai' => '05-09-2026', 'lokasi' => 'Surabaya', 'total' => 20000000, 'status' => 'Selesai'],
        ];
        return view('member.sewa.index', compact('riwayat'));
    })->name('sewa.index');

    Route::get('/chat', fn () => view('member.chat', ['pesan' => $chat]))->name('chat');
});

//#endregion

// #region admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () use ($alat, $chat) {
    Route::get('/', function () {
        $stats = [
            ['label' => 'Pengajuan Sewa',    'value' => 24, 'border' => 'border-blue-500'],
            ['label' => 'Menunggu Proses',   'value' => 5,  'border' => 'border-yellow-400'],
            ['label' => 'Unit Alat Berat',   'value' => 6,  'border' => 'border-green-500'],
            ['label' => 'Chat Belum Dibaca', 'value' => 3,  'border' => 'border-purple-500'],
        ];
        $inquiries = [
            ['nama' => 'PT Sinar Jaya',   'alat' => 'Excavator',    'tanggal' => '20-10-2026', 'status' => 'Baru'],
            ['nama' => 'CV Maju Bersama', 'alat' => 'Bulldozer',    'tanggal' => '19-10-2026', 'status' => 'Diproses'],
            ['nama' => 'Budi Santoso',    'alat' => 'Vibro Roller', 'tanggal' => '18-10-2026', 'status' => 'Selesai'],
        ];
        return view('admin.dashboard', compact('stats', 'inquiries'));
    })->name('dashboard');

    // Katalog alat
    Route::get('/alat',        fn () => view('admin.alat.alat', ['alat' => $alat]))->name('alat.index');
    Route::get('/alat/create', fn () => view('admin.alat.create'))->name('alat.create');

    // Inventaris
    Route::get('/inventaris', fn () => view('admin.inventaris.inventaris', ['alat' => $alat]))->name('inventaris.index');

    // Chat
    Route::get('/chat', function (Request $request) use ($chat) {
        $percakapan = [
            ['id' => 1, 'nama' => 'Member',          'terakhir' => 'Sekitar 5 hari, lokasi proyek...', 'waktu' => '09.18',   'belum_dibaca' => 2],
            ['id' => 2, 'nama' => 'PT Sinar Jaya',   'terakhir' => 'Terima kasih, Pak.',               'waktu' => 'Kemarin', 'belum_dibaca' => 0],
            ['id' => 3, 'nama' => 'CV Maju Bersama', 'terakhir' => 'Apakah termasuk operator?',        'waktu' => '18/10',   'belum_dibaca' => 1],
        ];
        $aktif = collect($percakapan)->firstWhere('id', (int) $request->query('user', 1)) ?? $percakapan[0];

        return view('admin.chat.index', ['percakapan' => $percakapan, 'aktif' => $aktif, 'pesan' => $chat]);
    })->name('chat');
});

// #endregion
