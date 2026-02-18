<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnakPADetail extends Model
{
    use HasFactory;

    protected $table = 'anak_pa';
    protected $primaryKey = 'lfk_user_id';
    // public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        // 'created_at' => 'datetime:d F Y, H:i:s',
        // 'updated_at' => 'datetime:d F Y, H:i:s',
    ];

    // protected $attributes = [
    //     'active' => 1,
    //     'deleted' => '0',
    // ];

    // const CREATED_AT = 'created_date';
    // const UPDATED_AT = 'updated_date';

    public function anak_pa()
    {
        return $this->hasOne(User::class, 'user_id');
    }
    public function kelompok_pa()
    {
        return $this->belongsTo(KelompokPA::class, 'lfk_kelompok_pa_id', 'kelompok_pa_id')->where('kelompok_pa_header.deleted', '0');
    }
    public function bahan()
    {
        return $this->belongsTo(Bahan::class, 'lfk_bahan_pa_id', 'bahan_pa_id')->where('bahan_pa_header.deleted', '0');
    }
}
