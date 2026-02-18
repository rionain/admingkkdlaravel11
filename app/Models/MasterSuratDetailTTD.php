<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSuratDetailTTD extends Model
{
    use HasFactory;

    protected $table = 'template_master_detail_ttd';
    protected $primaryKey = 'template_master_detail_ttd_id';
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
    public function ttd()
    {
        return $this->belongsTo(TandaTangan::class, 'lfk_ttd_id', 'ttd_id');
    }
}
