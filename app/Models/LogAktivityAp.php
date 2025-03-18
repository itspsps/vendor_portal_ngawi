<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAktivityAp extends Model
{
    protected $table = 'log_aktivitas_ap';
    protected $primaryKey = 'id_aktivitas_ap';
    public $timestamps = false;
    protected $guarded = ['id_aktivitas_ap '];
}
