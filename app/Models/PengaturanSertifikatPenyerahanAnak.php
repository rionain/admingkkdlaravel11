<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaturanSertifikatPenyerahanAnak extends Model
{
    use HasFactory;

    protected $table = 'pengaturan_sertifikat_penyerahan_anak';
    protected $primaryKey = 'pengaturan_sertifikat_penyerahan_anak_id';
    public $incrementing = false;

    protected $casts = [
        // 'created_at' => 'datetime:d F Y, H:i:s',
        // 'updated_at' => 'datetime:d F Y, H:i:s',
    ];

    protected $attributes = [
        // 'active'        => 1,
        // 'deleted'       => '0',
        'pengaturan_sertifikat_penyerahan_anak_id' => 1,
    ];
    public $timestamps = false;
    // const CREATED_AT = 'created_date';
    // const UPDATED_AT = 'updated_date';
    protected $fillable = [
        'logo_header',
        'header_html',
        'foto_kanan',
        'ayat1_html',
        'deskripsi_html',
        'ayat2_html',
    ];
}
