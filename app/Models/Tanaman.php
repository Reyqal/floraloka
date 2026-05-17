<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tanaman extends Model
{
    // Beri tahu Laravel secara paksa bahwa nama tabelnya adalah 'tanamans'
    protected $table = 'tanamans'; 

    protected $fillable = [
        'kategori_id',
        'nama_tanaman',
        'harga',
        'stok',
        'gambar',
        'deskripsi',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function getUrlGambarAttribute()
    {
        if ($this->gambar && strpos($this->gambar, 'http') === 0) {
            return $this->gambar;
        }
        if ($this->gambar) {
            return asset('storage/' . $this->gambar);
        }
        return 'https://placehold.co/600x600/e2e8f0/475569?text=FloraLoka'; 
    }
}