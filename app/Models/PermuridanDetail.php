<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermuridanDetail extends Model
{
    use HasFactory;

    protected $table = 'permuridan_detail';
    protected $primaryKey = 'permuridan_detail_id';
    // public $incrementing = false;

    protected $casts = [
        // 'created_at' => 'datetime:d F Y, H:i:s',
        // 'updated_at' => 'datetime:d F Y, H:i:s',
    ];

    protected $attributes = [
        'active'        => 1,
        'deleted'       => '0',
    ];

    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';

    public function permuridan()
    {
        return $this->belongsTo(Permuridan::class, 'lfk_permuridan_id', 'permuridan_id');
    }
    public function anak_pa()
    {
        return $this->belongsTo(User::class, 'lfk_anak_pa_user_id', 'user_id');
    }
}
