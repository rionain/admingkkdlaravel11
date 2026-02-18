<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaturanSuratKeputusanTTD extends Model
{
    use HasFactory;

    protected $table = 'pengaturan_surat_keputusan_ttd';
    protected $primaryKey = 'pengaturan_surat_keputusan_ttd_id';
    // public $incrementing = false;

    protected $casts = [
        // 'created_at' => 'datetime:d F Y, H:i:s',
        // 'updated_at' => 'datetime:d F Y, H:i:s',
    ];

    protected $attributes = [];

    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';
    public function ttd()
    {
        return $this->belongsTo(TandaTangan::class, 'ttd_id', 'ttd_id');
    }
}
