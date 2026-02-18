<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSurat extends Model
{
    use HasFactory;

    protected $table = 'template_master';
    protected $primaryKey = 'template_master_id';
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

    public function kop()
    {
        return $this->belongsTo(Kop::class, 'lfk_kop_id', 'kop_id');
    }
    public function tembusan()
    {
        return $this->belongsTo(Tembusan::class, 'lfk_tembusan_id', 'tembusan_id');
    }
    public function footer()
    {
        return $this->belongsTo(Footer::class, 'lfk_template_footer_id', 'template_footer_id');
    }
    public function jenis_surat()
    {
        return $this->belongsTo(JenisSurat::class, 'jenis_surat_id', 'jenis_surat_id');
    }
    public function detail_body()
    {
        return $this->hasMany(MasterSuratDetailBody::class, 'lfk_template_master_id', 'template_master_id')->orderBy('order_body', 'ASC');
    }
    public function detail_ttd()
    {
        return $this->hasMany(MasterSuratDetailTTD::class, 'lfk_template_master_id', 'template_master_id')->orderBy('order_ttd', 'ASC');
    }
}
