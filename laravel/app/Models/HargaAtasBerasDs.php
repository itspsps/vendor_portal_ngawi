<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HargaAtasBerasDs extends Model
{
    protected $table = 'harga_atas_beras_ds';
    protected $primaryKey = 'id_harga_atas_ds';
    public $timestamps = false;
    protected $guarded = ['id_harga_atas_ds'];
    protected $fillable = ['harga_atas_ds', 'waktu_harga_atas_ds'];

}
