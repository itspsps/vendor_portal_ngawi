<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifLab extends Model
{
    protected $table = 'notifikasi_lab';
    protected $primaryKey = 'id_notif';
    public $timestamps = false;
    protected $guarded = ['id_notif '];
}
