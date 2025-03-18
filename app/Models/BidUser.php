<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BidUser extends Model
{
    protected $table = 'bid_user';
    protected $primaryKey = 'id_biduser';
    public $timestamps = false;
    protected $fillable = ['id_biduser', 'user_id', 'price_biduser','site_id','jumlah_kirim','date_biduser' ,'description_biduser', 'image_biduser','status_biduser'];

}
