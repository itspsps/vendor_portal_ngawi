<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAktivitySpvQc extends Model
{
    protected $table = 'log_aktivitas_spvqc';
    protected $primaryKey = 'id_aktivitas_spvqc';
    public $timestamps = false;
    protected $guarded = ['id_aktivitas_spvqc '];
}
