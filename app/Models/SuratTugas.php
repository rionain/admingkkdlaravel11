<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratTugas extends Model
{
    use HasFactory;

    protected $table = 'surat_tugas';
    protected $primaryKey = 'surat_tugas_id';
    // public $incrementing = false;

    protected $casts = [
        'waktu_awal_tugas' => 'datetime:H:i',
        'waktu_akhir_tugas' => 'datetime:H:i',
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
    public function pengaturan_surat_tugas()
    {
        return $this->belongsTo(PengaturanSuratTugas::class, 'pengaturan_surat_tugas_id', 'pengaturan_surat_tugas_id');
    }
}
