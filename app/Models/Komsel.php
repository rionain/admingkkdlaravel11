<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komsel extends Model
{
    use HasFactory;

    protected $table = 'komsel_header';
    protected $primaryKey = 'komsel_id';
    // public $incrementing = false;

    protected $casts = [
        // 'created_at' => 'datetime:d F Y, H:i:s',
        // 'updated_at' => 'datetime:d F Y, H:i:s',
        'tanggal'       => 'date:Y-m-d',
    ];

    protected $attributes = [
        'active' => 1,
        'deleted' => '0',
    ];

    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'lfk_cabang_id', 'cabang_id');
    }
    public function kategori_komsel()
    {
        return $this->belongsTo(KategoriKomsel::class, 'lfk_kategori_komsel_id', 'kategori_komsel_id');
    }
}
