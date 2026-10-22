<?php

namespace Database\Seeders;

use App\Models\AlatBerat;
use App\Models\Sewa;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailSewaSeeder extends Seeder
{
    public function run(): void
    {
        $sewa  = Sewa::orderBy('id')->get();
        $alat  = AlatBerat::orderBy('id')->get();

        // [index sewa, index alat, tanggal awal, tanggal akhir, harga per hari]
        $data = [
            [0, 0, '2026-10-12', '2026-10-16', 2500000],
            [0, 2, '2026-10-12', '2026-10-14', 1200000],
            [1, 1, '2026-10-17', '2026-10-21', 3500000],
            [2, 3, '2026-10-21', '2026-10-25', 2800000],
            [2, 4, '2026-10-21', '2026-10-23', 1500000],
        ];

        foreach ($data as [$s, $a, $awal, $akhir, $harga]) {
            $hari = (int) Carbon::parse($awal)->diffInDays(Carbon::parse($akhir)) + 1;

            DB::table('detail_sewa')->insert([
                'sewa_id'            => $sewa[$s]->id,
                'alat_berat_id'      => $alat[$a]->id,
                'tanggal_awal_sewa'  => $awal,
                'tanggal_akhir_sewa' => $akhir,
                'harga_per_hari'     => $harga,
                'subtotal'           => $harga * $hari,
                'created_at'         => now(),
                'updated_at'         => now(),
            ]);
        }

        // Hitung ulang total tiap sewa dari jumlah subtotal detailnya
        foreach ($sewa as $item) {
            $item->update([
                'total' => DB::table('detail_sewa')->where('sewa_id', $item->id)->sum('subtotal'),
            ]);
        }
    }
}