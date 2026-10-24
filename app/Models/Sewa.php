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

    public function alatBerat(): HasMany
    {
        return $this->hasMany(DetailSewa::class, 'sewa_id');
    }
}
