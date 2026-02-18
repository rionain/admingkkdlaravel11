<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = 'user_header';
    protected $primaryKey = 'user_id';
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

    public function role()
    {
        return $this->belongsTo(RoleUsers::class, 'lfk_role_id', 'role_id');
    }

    public function role_user()
    {
        return $this->belongsTo(RoleUsers::class, 'lfk_role_id', 'role_id');
    }
    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'lfk_cabang_id', 'cabang_id');
    }
    public function bahan()
    {
        return $this->belongsTo(Bahan::class, 'lfk_bahan_id', 'bahan_pa_id');
    }
    public function anak_pa_detail()
    {
        return $this->hasOne(AnakPADetail::class, 'lfk_user_id', 'user_id');
    }
    public function ttd()
    {
        return $this->hasOne(TandaTangan::class, 'lfk_user_id', 'user_id');
    }
}
