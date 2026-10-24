<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventaris extends Model
{
    //
    protected $table = 'inventaris';

    protected $fillable = [
        'user_id',
        'nama_barang',
        'jumlah',
        'nama_peminjam',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
