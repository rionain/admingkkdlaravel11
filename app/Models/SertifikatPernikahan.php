<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SertifikatPernikahan extends Model
{
    use HasFactory;

    protected $table = 'sertifikat_pernikahan';
    protected $primaryKey = 'sertifikat_pernikahan_id';
    // public $incrementing = false;

    protected $casts = [
        // 'created_at' => 'datetime:d F Y, H:i:s',
        // 'updated_at' => 'datetime:d F Y, H:i:s',
    ];

    protected $attributes = [];

    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';

    public function status_sertifikat()
    {
        return $this->belongsTo(StatusSertifikat::class, 'lfk_status_sertifikat_id', 'status_sertifikat_id');
    }
    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'lfk_cabang_id', 'cabang_id');
    }
}
