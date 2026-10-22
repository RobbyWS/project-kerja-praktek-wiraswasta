<?php

namespace Database\Seeders;

use App\Models\Sewa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SewaSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin', 'password' => Hash::make('password')]
        );

        // total diisi 0 dulu, nanti dihitung di DetailSewaSeeder
        Sewa::create(['user_id' => $user->id, 'tanggal_transaksi' => now()->subDays(10), 'total' => 0]);
        Sewa::create(['user_id' => $user->id, 'tanggal_transaksi' => now()->subDays(5),  'total' => 0]);
        Sewa::create(['user_id' => $user->id, 'tanggal_transaksi' => now()->subDays(1),  'total' => 0]);
    }
}