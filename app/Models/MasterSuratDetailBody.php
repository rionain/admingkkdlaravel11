<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSuratDetailBody extends Model
{
    use HasFactory;

    protected $table = 'template_master_detail_body';
    protected $primaryKey = 'template_master_detail_body_id';
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

    public function template_body()
    {
        return $this->belongsTo(Body::class, 'lfk_template_body', 'template_body_id');
    }
}
