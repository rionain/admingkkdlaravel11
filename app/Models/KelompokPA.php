<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokPA extends Model
{
    use HasFactory;

    protected $table = 'kelompok_pa_header';
    protected $primaryKey = 'kelompok_pa_id';
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

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'lfk_cabang_id', 'cabang_id');
    }
    public function kakak_pa()
    {
        return $this->belongsTo(KakakPA::class, 'lfk_kakak_pa_user_id', 'user_id');
    }
    public function anak_pa()
    {
        return $this->hasMany(AnakPA::class, 'lfk_kelompok_pa_id', 'kelompok_pa_id');
    }
}
