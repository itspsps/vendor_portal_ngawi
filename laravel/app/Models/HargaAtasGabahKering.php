<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HargaAtasGabahKering extends Model
{
    protected $table = 'harga_atas_gabah_kering';
    protected $primaryKey = 'id_harga_atas_gk';
    public $timestamps = false;
    protected $guarded = ['id_harga_atas_gk'];
    protected $fillable = ['harga_atas_gk', 'waktu_harga_atas_gk'];

}
