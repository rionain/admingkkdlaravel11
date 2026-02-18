<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengaturanSuratKeputusan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pengaturan_surat_keputusan';
    protected $primaryKey = 'pengaturan_surat_keputusan_id';
    // public $incrementing = false;

    protected $casts = [
        // 'created_at' => 'datetime:d F Y, H:i:s',
        // 'updated_at' => 'datetime:d F Y, H:i:s',
    ];

    protected $attributes = [
        'active' => 1,
    ];

    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';

    public function kop()
    {
        return $this->belongsTo(Kop::class, 'kop_id', 'kop_id');
    }
    public function tembusan()
    {
        return $this->belongsTo(Tembusan::class, 'tembusan_id', 'tembusan_id');
    }
    public function footer()
    {
        return $this->belongsTo(Footer::class, 'footer_id', 'template_footer_id');
    }
    public function detail_ttd()
    {
        return $this->hasMany(PengaturanSuratKeputusanTTD::class, 'pengaturan_surat_keputusan_id', 'pengaturan_surat_keputusan_id')->orderBy('order_ttd', 'ASC');
    }
}
