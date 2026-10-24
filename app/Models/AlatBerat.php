<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class AlatBerat extends Model
{
    protected $table = 'alat_berat';

    protected $fillable = ['nama', 'kategori', 'jumlah'];

    public function sewa(): BelongsToMany
    {
        return $this->belongsToMany(Sewa::class, 'detail_sewa', 'alat_berat_id', 'sewa_id')
            ->using(DetailSewa::class)
            ->withPivot('id', 'tanggal_awal_sewa', 'tanggal_akhir_sewa', 'harga_per_hari', 'subtotal')
            ->withTimestamps();
    }
}
