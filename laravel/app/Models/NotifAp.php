<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifAp extends Model
{
    protected $table = 'notifikasi_ap';
    protected $primaryKey = 'id_notif';
    public $timestamps = false;
    protected $guarded = ['id_notif '];
}
