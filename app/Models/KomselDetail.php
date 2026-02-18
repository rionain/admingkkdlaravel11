<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomselDetail extends Model
{
    use HasFactory;

    protected $table = 'komsel_detail';
    protected $primaryKey = 'komsel_detail_id';

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

    public function getTableName()
    {
        return $this->table;
    }
    public function komsel()
    {
        return $this->belongsTo(Komsel::class, 'lfk_komsel_id', 'komsel_id');
    }
}
