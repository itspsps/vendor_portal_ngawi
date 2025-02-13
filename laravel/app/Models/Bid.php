<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $table = 'bid';
    protected $primaryKey = 'id_bid';
    public $timestamps = false;
    protected $fillable = ['id_bid', 'name_bid', 'open_po', 'unload_date', 'mulai_bid', 'date_bid', 'description_bid', 'image_bid'];
}
