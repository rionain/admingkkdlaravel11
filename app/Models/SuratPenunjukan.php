<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPenunjukan extends Model
{
    use HasFactory;

    protected $table = 'surat_penunjukan';
    protected $primaryKey = 'surat_penunjukan_id';
    // public $incrementing = false;

    protected $casts = [
        // 'created_at' => 'datetime:d F Y, H:i:s',
        // 'updated_at' => 'datetime:d F Y, H:i:s',
    ];

    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    public function status_surat()
    {
        return $this->belongsTo(StatusSurat::class, 'status_surat_id', 'status_surat_id');
    }
    public function pengaturan_surat_penunjukan()
    {
        return $this->belongsTo(PengaturanSuratPenunjukan::class, 'pengaturan_surat_penunjukan_id', 'pengaturan_surat_penunjukan_id');
    }
}
