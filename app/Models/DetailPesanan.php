<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailPesanan extends Model
{
    protected $fillable = ['pesanan_id', 'tanaman_id', 'jumlah', 'subtotal']; // [cite: 613-622]

    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }

    public function tanaman(): BelongsTo
    {
        return $this->belongsTo(Tanaman::class, 'tanaman_id');
    }
}