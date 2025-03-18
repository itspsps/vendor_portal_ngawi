<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAktivitySourching extends Model
{
    protected $table = 'log_aktivitas_sourching';
    protected $primaryKey = 'id_aktivitas_sourching';
    public $timestamps = false;
    protected $guarded = ['id_aktivitas_sourching '];
}
