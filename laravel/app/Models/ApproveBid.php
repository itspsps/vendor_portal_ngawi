<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApproveBid extends Model
{
    protected $table = 'approve_bid';
    protected $primaryKey = 'id_approvebid';
    public $timestamps = false;
    protected $fillable = ['user_idbid', 'bid_id', 'biduser_id', 'message_admin','message_vendor', 'image_biduser'];

}
