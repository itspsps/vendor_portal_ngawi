<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HargaAtasGabahBasah extends Model
{
    protected $table = 'harga_atas_gabah_basah';
    protected $primaryKey = 'id_harga_atas_gb';
    public $timestamps = false;
    protected $guarded = ['id_harga_atas_gb'];
    protected $fillable = ['harga_atas_gb', 'waktu_harga_atas_gb'];

}
