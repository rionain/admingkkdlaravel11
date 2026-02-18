<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnakPA extends Model
{
    use HasFactory;

    protected $table = 'v_user_anak_pa';
    protected $primaryKey = 'user_id';
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
        return $this->belongsTo(Cabang::class, 'lfk_cabang_id', 'cabang_id', 'left');
    }
}
