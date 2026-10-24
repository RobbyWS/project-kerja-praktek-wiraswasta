<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inventaris;
use App\Models\User;

class InventarisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $userId = User::query()->value('id');

        if (! $userId) {
            $this->command->error('Tabel users masih kosong, jalankan user seeder terlebih dahulu.');
            return;
        }

        $data = [
            ['nama_barang' => 'Kunci Pas Set',        'jumlah' => 10,   'nama_peminjam' => null],
            ['nama_barang' => 'Dongkrak Hidrolik',    'jumlah' => 4,    'nama_peminjam' => 'Budi'],
            ['nama_barang' => 'Helm Safety',          'jumlah' => 25,   'nama_peminjam' => null],
            ['nama_barang' => 'Rompi Safety',         'jumlah' => 20,   'nama_peminjam' => 'Andi'],
            ['nama_barang' => 'Laptop Kantor',        'jumlah' => 3,    'nama_peminjam' => null],
            ['nama_barang' => 'Handy Talky',          'jumlah' => 8,    'nama_peminjam' => 'Sari'],
            ['nama_barang' => 'Genset Portable',      'jumlah' => 2,'nama_peminjam' => null],
        ];

        foreach ($data as $item) {
            Inventaris::create($item + ['user_id' => $userId]);
        }
    }
}
