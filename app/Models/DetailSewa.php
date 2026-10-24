<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use app\Models\Sewa;
use app\Models\AlatBerat;

class DetailSewa extends Pivot
{
    protected $table = 'detail_sewa';
    public $incrementing = true;

    protected $fillable = [
        'sewa_id', 
        'alat_berat_id',
        'tanggal_awal_sewa', 
        'tanggal_akhir_sewa',
        'harga_per_hari', 
        'subtotal',
    ];

    public function sewa(): BelongsTo
    {
        return $this->belongsTo(Sewa::class, 'sewa_id');
    }

    public function alatBerat(): BelongsTo
    {
        return $this->belongsTo(AlatBerat::class, 'alat_berat_id');
    }
}
