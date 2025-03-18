<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAktivityQc extends Model
{
    protected $table = 'log_aktivitas_qc';
    protected $primaryKey = 'id_aktivitas_qc';
    public $timestamps = false;
    protected $guarded = ['id_aktivitas_qc '];
}
