<?php

namespace Database\Seeders;

use App\Models\AlatBerat;
use Illuminate\Database\Seeder;

class AlatBeratSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Excavator PC200', 'kategori' => 'Excavator', 'jumlah' => 5],
            ['nama' => 'Bulldozer D6',    'kategori' => 'Bulldozer', 'jumlah' => 3],
            ['nama' => 'Vibro Roller',    'kategori' => 'Compactor', 'jumlah' => 4],
            ['nama' => 'Wheel Loader',    'kategori' => 'Loader',    'jumlah' => 2],
            ['nama' => 'Dump Truck',      'kategori' => 'Truck',     'jumlah' => 6],
        ];

        foreach ($data as $item) {
            AlatBerat::create($item);   
        }
    }
}