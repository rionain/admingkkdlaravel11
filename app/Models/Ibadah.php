<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ibadah extends Model
{
    use HasFactory;

    protected $table = 'ibadah_header';
    protected $primaryKey = 'ibadah_id';
    // public $incrementing = false;

    protected $casts = [
        'ibadah_time_start' => 'datetime:H:i',
        'ibadah_time_end'   => 'datetime:H:i',
        // 'created_at' => 'datetime:d F Y, H:i:s',
        // 'updated_at' => 'datetime:d F Y, H:i:s',
    ];

    protected $attributes = [
        'active'        => 1,
        'deleted'       => '0',
        'ibadah_status' => 1,
    ];

    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'lfk_cabang_id', 'cabang_id');
    }
    public function ibadah_detail()
    {
        return $this->hasMany(IbadahDetail::class, 'lfk_ibadah_id', 'ibadah_id');
    }
}
