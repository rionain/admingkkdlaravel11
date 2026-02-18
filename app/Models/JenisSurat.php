<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    use HasFactory;

    protected $table = 'jenis_surat';
    protected $primaryKey = 'jenis_surat_id';
    // public $incrementing = false;

    protected $casts = [
        'ibadah_time_start' => 'datetime:H:i',
        'ibadah_time_end'   => 'datetime:H:i',
    ];


    protected $attributes = [
        'active'        => 1,
        'deleted'        => '0',
    ];

    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';
}
