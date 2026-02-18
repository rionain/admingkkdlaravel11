<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;

    protected $table = 'cabang_header';
    protected $primaryKey = 'cabang_id';
    // public $incrementing = false;

    protected $casts = [
        // 'created_at' => 'datetime:d F Y, H:i:s',
        // 'updated_at' => 'datetime:d F Y, H:i:s',
    ];

    protected $attributes = [
        'active' => 1,
        'deleted' => '0',
    ];

    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';

    public function kategori_gereja()
    {
        return $this->belongsTo(KategoriGereja::class, 'lfk_kategori_gereja_id', 'kategori_gereja_id');
    }

    public function kakak_pa()
    {
        return $this->hasMany(KakakPA::class, 'lfk_cabang_id', 'cabang_id');
    }

    public function sub_cabang()
    {
        return $this->hasMany(SubCabang::class, 'lfk_cabang_id', 'cabang_id');
    }
}
