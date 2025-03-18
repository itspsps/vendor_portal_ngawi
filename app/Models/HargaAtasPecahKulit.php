<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HargaAtasPecahKulit extends Model
{
    protected $table = 'harga_atas_pecah_kulit';
    protected $primaryKey = 'id_harga_atas_pk';
    public $timestamps = false;
    protected $guarded = ['id_harga_atas_pk'];
    protected $fillable = ['harga_atas_pk', 'waktu_harga_atas_pk'];

}
