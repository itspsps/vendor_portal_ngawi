<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAktivitySpvAp extends Model
{
    protected $table = 'log_aktivitas_spvap';
    protected $primaryKey = 'id_aktivitas_spvap';
    public $timestamps = false;
    protected $guarded = ['id_aktivitas_spvap '];
}
