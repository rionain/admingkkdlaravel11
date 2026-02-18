<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusSurat extends Model
{
    use HasFactory;

    protected $table = 'status_surat';
    protected $primaryKey = 'status_surat_id';
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
}
