<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardHistory extends Model
{
    use HasFactory;

    protected $table = 'dashboard_history';
    protected $primaryKey = 'dashboard_history_id';
    public $timestamps = false;
    // public $incrementing = false;
}
