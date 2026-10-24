<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class AlatBerat extends Model
{
    protected $table = 'alat_berat';
    protected $fillable = ['nama', 'merek', 'kapasitas', 'harga', 'tersedia'];

    public function sewa(): HasMany
    {
        return $this->hasMany(DetailSewa::class, 'alat_berat_id');
    }
}
