<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifSpvap extends Model
{
    protected $table = 'notifikasi_spvap';
    protected $primaryKey = 'id_notif';
    public $timestamps = false;
    protected $guarded = ['id_notif '];
}
