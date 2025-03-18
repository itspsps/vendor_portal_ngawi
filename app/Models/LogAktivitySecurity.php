<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAktivitySecurity extends Model
{
    protected $table = 'log_aktivitas_security';
    protected $primaryKey = 'id_aktivitas_security';
    public $timestamps = false;
    protected $guarded = ['id_aktivitas_security '];
}
