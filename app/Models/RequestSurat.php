<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestSurat extends Model
{
    use HasFactory;

    protected $table = 'surat_header';
    protected $primaryKey = 'surat_id';
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

    public function jenis_surat()
    {
        return $this->belongsTo(JenisSurat::class, 'lfk_jenis_surat', 'jenis_surat_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'lfk_requester_user_id', 'user_id');
    }
    public function status_surat()
    {
        return $this->belongsTo(StatusSurat::class, 'lfk_status_surat_id', 'status_surat_id');
    }
    public function master_surat()
    {
        return $this->belongsTo(MasterSurat::class, 'lfk_template_master', 'template_master_id');
    }
}
