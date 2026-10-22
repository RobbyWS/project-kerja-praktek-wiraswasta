<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sewa extends Model
{
    protected $table = 'sewa';

    protected $fillable = ['user_id', 'tanggal_transaksi', 'total'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function alatBerat(): BelongsToMany
    {
        return $this->belongsToMany(AlatBerat::class, 'detail_sewa', 'sewa_id', 'alat_berat_id')
            ->using(DetailSewa::class)
            ->withPivot('id', 'tanggal_awal_sewa', 'tanggal_akhir_sewa', 'harga_per_hari', 'subtotal')
            ->withTimestamps();
    }
}
