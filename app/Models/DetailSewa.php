<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Model;

class DetailSewa extends Pivot
{
    protected $table = 'detail_sewa';
    public $incrementing = true;

    protected $fillable = [
        'sewa_id', 'alat_berat_id',
        'tanggal_awal_sewa', 'tanggal_akhir_sewa',
        'harga_per_hari', 'subtotal',
    ];
}
