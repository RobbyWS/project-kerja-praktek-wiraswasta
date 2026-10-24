<?php

namespace Database\Seeders;

use App\Models\AlatBerat;
use Illuminate\Database\Seeder;

class AlatBeratSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
           ['nama' => 'Excavator PC200',  'merek' => 'Komatsu',   'kapasitas' => '0.9 m³',    'harga' => 2500000, 'tersedia' => true],
            ['nama' => 'Excavator ZX210',  'merek' => 'Hitachi',   'kapasitas' => '1.0 m³',    'harga' => 2700000, 'tersedia' => true],
            ['nama' => 'Bulldozer D6R',    'merek' => 'Caterpillar', 'kapasitas' => '20 ton',  'harga' => 3500000, 'tersedia' => true],
            ['nama' => 'Vibro Roller',     'merek' => 'Sakai',     'kapasitas' => '10 ton',    'harga' => 1200000, 'tersedia' => false],
            ['nama' => 'Wheel Loader WA320', 'merek' => 'Komatsu', 'kapasitas' => '3.0 m³',    'harga' => 2800000, 'tersedia' => true],
            ['nama' => 'Dump Truck HD465', 'merek' => 'Komatsu',   'kapasitas' => '30 ton',    'harga' => 1500000, 'tersedia' => true],
            ['nama' => 'Motor Grader GD535', 'merek' => 'Komatsu', 'kapasitas' => '15 ton',    'harga' => 2200000, 'tersedia' => false],
        ];

        foreach ($data as $item) {
            AlatBerat::create($item);
        }
    }
}