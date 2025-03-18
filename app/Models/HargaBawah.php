<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HargaBawah extends Model
{
    protected $table = 'harga_bawah_gabah_basah';
    protected $primaryKey = 'id_harga_bawah_gb';
    public $timestamps = false;
    protected $guarded = ['id_harga_bawah_gb'];
}
