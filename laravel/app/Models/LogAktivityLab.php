<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAktivityLab extends Model
{
    protected $table = 'log_aktivitas_lab';
    protected $primaryKey = 'id_aktivitas_lab';
    public $timestamps = false;
    protected $guarded = ['id_aktivitas_lab '];
}
