<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAktivityTimbangan extends Model
{
    protected $table = 'log_aktivitas_timbangan';
    protected $primaryKey = 'id_aktivitas_timbangan';
    public $timestamps = false;
    protected $guarded = ['id_aktivitas_timbangan '];
}
