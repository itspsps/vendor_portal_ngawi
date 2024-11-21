<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PotonganBongkarPk extends Model
{
    protected $table = 'potongan_bongkar_gt_04_pecah_kulit';
    protected $primaryKey = 'id_potongan_bongkar_gt_04_pk';
    public $timestamps = false;
    protected $guarded = ['id_potongan_bongkar_gt_04_pk'];
    protected $fillable = ['potongan_bongkar_gt_04_pk','transparasi_pk' ,'waktu_potongan_bongkar_gt_04_pk'];

}
