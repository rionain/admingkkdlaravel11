<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCabang extends Model
{
    use HasFactory;

    protected $table = 'sub_cabang';
    protected $primaryKey = 'sub_cabang_id';
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
        return $this->belongsTo(Cabang::class, 'sub_cabang', 'cabang_id');
    }
}
