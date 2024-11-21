<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAktivityUser extends Model
{
    protected $table = 'log_aktivitas_user';
    protected $primaryKey = 'id_aktivitas_user';
    public $timestamps = false;
    protected $guarded = ['id_aktivitas_user '];
}
