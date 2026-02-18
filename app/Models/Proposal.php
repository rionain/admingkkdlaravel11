<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $table = 'proposal_header';
    protected $primaryKey = 'proposal_id';
    // public $incrementing = false;

    protected $casts = [
        // 'created_at' => 'datetime:d F Y, H:i:s',
        // 'updated_at' => 'datetime:d F Y, H:i:s',
    ];

    protected $attributes = [
        'active'        => 1,
        'deleted'       => '0',
    ];

    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';

    public function jenis_proposal()
    {
        return $this->belongsTo(JenisProposal::class, 'lfk_jenis_proposal_id', 'jenis_proposal_id');
    }
    public function status_proposal()
    {
        return $this->belongsTo(StatusProposal::class, 'lfk_status_proposal_id', 'status_proposal_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'lfk_requester_user_id', 'user_id');
    }
}
