<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BAB extends Model
{
    use HasFactory;

    protected $table = 'bab_pa_header';
    protected $primaryKey = 'bab_pa_id';
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

    public function bahan()
    {
        return $this->belongsTo(Bahan::class, 'lfk_bahan_pa_id', 'bahan_pa_id')->where('bahan_pa_header.deleted', '0');
    }
}
