<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permuridan extends Model
{
    use HasFactory;

    protected $table = 'permuridan_header';
    protected $primaryKey = 'permuridan_id';
    // public $incrementing = false;

    protected $casts = [
        // 'created_at' => 'datetime:d F Y, H:i:s',
        // 'updated_at' => 'datetime:d F Y, H:i:s',
    ];

    protected $attributes = [
        'active'        => 1,
        'deleted'       => '0',
    ];

    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';

    public function kelompok_pa()
    {
        return $this->belongsTo(KelompokPA::class, 'lfk_kelompok_pa_id', 'kelompok_pa_id');
    }
    public function kakak_pa()
    {
        return $this->belongsTo(KakakPA::class, 'lfk_kakak_pa_user_id', 'kakak_pa_id');
    }
    public function bahan_pa()
    {
        return $this->belongsTo(Bahan::class, 'lfk_bahan_pa_id', 'bahan_pa_id');
    }
    public function bab_pa()
    {
        return $this->belongsTo(BAB::class, 'lfk_bab_pa_id', 'bab_pa_id');
    }
    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'lfk_cabang_id', 'cabang_id');
    }
    public function permuridan_detail()
    {
        return $this->hasMany(PermuridanDetail::class, 'lfk_permuridan_id');
    }
}
