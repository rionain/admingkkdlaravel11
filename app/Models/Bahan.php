<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    use HasFactory;

    protected $table = 'bahan_pa_header';
    protected $primaryKey = 'bahan_pa_id';
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

    public function kelompok_pa()
    {
        return $this->belongsTo(KelompokPA::class, 'lfk_kelompok_pa_id', 'kelompok_pa_id');
    }
    public function kakak_pa()
    {
        return $this->belongsTo(KakakPA::class, 'lfk_kakak_pa_user_id', 'user_id');
    }
}
