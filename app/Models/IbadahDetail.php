<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IbadahDetail extends Model
{
    use HasFactory;

    protected $table = 'ibadah_detail';
    protected $primaryKey = 'ibadah_detail_id';
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

    public function kakak_pa()
    {
        return $this->belongsTo(User::class, 'lfk_kakak_pa_user_id', 'user_id');
    }
    public function anak_pa()
    {
        return $this->belongsTo(User::class, 'lfk_anak_pa_user_id', 'user_id');
    }
    public function ibadah()
    {
        return $this->belongsTo(Ibadah::class, 'lfk_ibadah_id', 'ibadah_id');
    }
}
