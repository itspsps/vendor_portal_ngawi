<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifSourching extends Model
{
    protected $table = 'notifikasi_sourching';
    protected $primaryKey = 'id_notif';
    public $timestamps = false;
    protected $guarded = ['id_notif '];
}
